<?php

// Protection against direct access.
defined('_JEXEC') or die('Restricted access');

require_once __DIR__ . '/ConcordPayApi.php';

/**
 * @package     JoomShopping
 * @subpackage  Plugins - ConcordPay
 * @package     JoomShopping
 * @subpackage  Payment
 * @author      ConcordPay
 * @link        https://concordpay.concord.ua
 * @copyright   2021 ConcordPay
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @since       3.0
 */
class pm_concordpay extends PaymentRoot
{
    /**
     * @var string[]
     * @since 3.0.0
     */
    protected $keysForResponseSignature = array(
        'merchantAccount',
        'orderReference',
        'amount',
        'currency'
    );

    /**
     * @var string[]
     * @since 3.0.0
     */
    protected $keysForSignature = array(
        'merchant_id',
        'order_id',
        'amount',
        'currency_iso',
        'description'
    );

    /**
     * Payment page languages.
     *
     * @var string[]
     * @since 3.0.0
     */
    protected $languages = array(
        'ua' => 'UA',
        'ru' => 'RU',
        'en' => 'EN'
    );

    const VERSION = '2.0';

    // From: components/com_jshopping/payments/payment.php
    const CPAY_STATUS_ERROR    = 0;
    const CPAY_STATUS_PAID     = 1;
    const CPAY_STATUS_REFUNDED = 7;

    /**
     * Load translations files
     *
     * @throws Exception
     *
     * @since 3.0.0
     */
    public function loadLanguageFile()
    {
        $app  = \JFactory::getApplication() or die();
        $lang = $app->getLanguage();

        $lang_tag  = ($lang !== null ? $lang->getTag() : 'en-GB');
        $lang_dir  = JPATH_ROOT . '/components/com_jshopping/payments/pm_concordpay/language/';
        $lang_file = "{$lang_dir}/{$lang_tag}.php";
        if (file_exists($lang_file)) {
            require_once $lang_file;
        } else {
            require_once $lang_dir . 'en-GB.php';
        }
    }

    /**
     * Shows payment form.
     *
     * @param $params
     * @param $pmconfigs
     *
     * @since 3.0.0
     */
    public function showPaymentForm($params, $pmconfigs)
    {
    }

    /**
     * This method is responsible for the plugin settings in the administrative section.
     *
     * @param array $params
     *
     * @throws Exception
     *
     * @since 3.0.0
     */
    public function showAdminFormParams($params)
    {
        if (empty($params)) {
            // Default ConcordPay settings.
            $params = [
                'concordpay_merchant_id'      => '',
                'concordpay_secret_key'       => '',
                'transaction_end_status'      => self::CPAY_STATUS_PAID,
                'transaction_failed_status'   => self::CPAY_STATUS_ERROR,
                'transaction_refunded_status' => self::CPAY_STATUS_REFUNDED,
                'concordpay_language'         => 'ua',
            ];
        }
        $orders = JModelLegacy::getInstance('orders', 'JshoppingModel');
        $this->loadLanguageFile();

        require_once __DIR__ . '/adminparamsform.php';
    }

    /**
     * Payment form creation.
     *
     * @param $pmconfigs
     * @param $order
     *
     * @throws Exception
     *
     * @since 3.0.0
     */
    public function showEndForm($pmconfigs, $order)
    {
        $this->loadLanguageFile();

        $client_first_name = $order->f_name ?? '';
        $client_last_name  = $order->l_name ?? '';
        $email = $order->email ?? '';
        $phone = $order->phone ?? '';

        $order_id    = $order->order_id;
        $description = CPAY_ORDER_DESC . ' ' . $_SERVER["HTTP_HOST"] . ", $client_first_name $client_last_name, $phone";

        $base_url    = JURI::root() . 'index.php?option=com_jshopping&controller=checkout&task=step7'
            . '&js_paymentclass=' . __CLASS__ . "&order_id={$order_id}";
        $success_url = $base_url . '&act=finish';
        $fail_url    = $base_url . '&act=cancel';
        $result_url  = $base_url . '&act=notify&nolang=1';

        $concordpay_args = array(
            'operation'    => 'Purchase',
            'merchant_id'  => $pmconfigs['concordpay_merchant_id'],
            'amount'       => $this->fixOrderTotal($order),
            'order_id'     => $order_id . ConcordPayApi::ORDER_SEPARATOR . time(),
            'currency_iso' => $order->currency_code_iso,
            'description'  => $description,
            'add_params'   => [],
            'approve_url'  => $success_url,
            'decline_url'  => $fail_url,
            'cancel_url'   => $fail_url,
            'callback_url' => $result_url,
            'language'     => $pmconfigs['concordpay_language'],
            // Statistics.
            'client_last_name'  => $client_last_name,
            'client_first_name' => $client_first_name,
            'email'             => $email,
            'phone'             => $phone
        );

        $concordpay = $this->getConcordpay($pmconfigs['concordpay_secret_key']);
        $concordpay_args['signature'] = $concordpay->getRequestSignature($concordpay_args);

        require_once __DIR__ . '/paymentform.php';
    }

    /**
     * Transaction processing.
     * Processing a response from the payment system.
     *
     * @param array $pmconfig
     * @param object $order
     * @param string $rescode
     * @return array
     * @throws Exception
     * @since 3.0.0
     */
    public function checkTransaction($pmconfig, $order, $rescode)
    {
        $this->loadLanguageFile();
        $callback = JFactory::$application->input->post->getArray();

        if (empty($callback)) {
            $fap = json_decode(file_get_contents("php://input"), true);
            foreach ($fap as $key => $val) {
                $callback[$key] = $val;
            }
        }

        return $this->isPaymentValid($callback, $pmconfig, $order);
    }

    /**
     * @param $option
     * @param $keys
     * @param $secret_key
     * @return string
     * @since 3.0.0
     */
    protected function getSignature($option, $keys, $secret_key)
    {
        $hash = array();
        foreach ($keys as $dataKey) {
            if (!isset($option[$dataKey])) {
                continue;
            }
            if (is_array($option[$dataKey])) {
                foreach ($option[$dataKey] as $v) {
                    $hash[] = $v;
                }
            } else {
                $hash[] = $option[$dataKey];
            }
        }

        $hash = implode(ConcordPayApi::SIGNATURE_SEPARATOR, $hash);

        return hash_hmac('md5', $hash, $secret_key);
    }

    /**
     * Payment response validation.
     *
     * @param $response
     * @param $pmconfig
     * @param $order
     *
     * @return array
     *
     * @throws Exception
     * @since 3.0.0
     */
    public function isPaymentValid($response, $pmconfig, $order)
    {
        list($orderId, ) = explode(ConcordPayApi::ORDER_SEPARATOR, $response['orderReference']);
        if ((int)$orderId !== (int)$order->order_id || !isset($response['transactionId'])) {
            throw new \RuntimeException(CPAY_ERROR_UNKNOWN);
        }

        $response['orderReference'] = $orderId;
        // Check merchant.
        if ($pmconfig['concordpay_merchant_id'] !== $response['merchantAccount']) {
            throw new \RuntimeException(CPAY_ERROR_MERCHANT);
        }

        // Check signature.
        $concordpay = $this->getConcordpay($pmconfig['concordpay_secret_key']);
        $signature = $concordpay->getResponseSignature($response);
        if ($signature !== $response['merchantSignature']) {
            throw new \RuntimeException(CPAY_ERROR_SIGNATURE);
        }

        // Check operation type.
        if (!isset($response['type']) || !in_array($response['type'], ConcordPayApi::getAllowedOperationTypes(), true)) {
            throw new \RuntimeException(CPAY_ERROR_OPERATION_TYPE);
        }

        if ($response['transactionStatus'] === ConcordPayApi::TRANSACTION_STATUS_APPROVED) {
            $app = JFactory::getApplication();
            if ($app === null) {
                throw new \RuntimeException(CPAY_ERROR_UNKNOWN);
            }

            // Refunded payment callback.
            if (ConcordPayApi::RESPONSE_TYPE_REVERSE === $response['type']) {
                $app->enqueueMessage(CPAY_PAYMENT_REFUNDED . $response['transactionId']);
                return array(self::CPAY_STATUS_REFUNDED, CPAY_ORDER_APPROVED . $response['transactionId']);
            }

            // Purchase callback.
            if (ConcordPayApi::RESPONSE_TYPE_PAYMENT === $response['type']) {
                $app->enqueueMessage(CPAY_ORDER_APPROVED . $response['transactionId']);
                return array(self::CPAY_STATUS_PAID, CPAY_ORDER_APPROVED . $response['transactionId']);
            }

            throw new \RuntimeException(CPAY_ERROR_UNKNOWN);
        }

        if ($response['transactionStatus'] === ConcordPayApi::TRANSACTION_STATUS_DECLINED
            && isset($response['reasonCode'])
            && !empty($response['reasonCode'])
        ) {
            $error = $response['reasonCode'];
            if (isset($response['reason']) && !empty($response['reason'])) {
                $error += $response['reason'];
            }
            return array(self::CPAY_STATUS_ERROR, $error);
        }

        throw new \RuntimeException(CPAY_ORDER_DECLINED);
    }

    /**
     * Parsing the response
     *
     * @param $concordpay_config
     * @return array
     * @since 3.0.0
     */
    public function getUrlParams($concordpay_config)
    {
        $params = array();
        $input  = JFactory::$application->input;

        $params['order_id']  = $input->getInt('order_id', null);
        $params['hash']      = "";
        $params['checkHash'] = 0;

        $params['checkReturnParams'] = 1;

        return $params;
    }

    /**
     * Get order amount
     *
     * @param $order
     * @return float|string
     * @since 3.0.0
     */
    public function fixOrderTotal($order)
    {
        return number_format($order->order_total, 2, '.', '');
    }

    /**
     * Returns ConcordPay API.
     *
     * @param $secretKey
     *
     * @return ConcordPayApi
     *
     * @since version
     */
    protected function getConcordpay($secretKey)
    {
      return new ConcordPayApi($secretKey);
    }

    /**
     * Payment page languages getter.
     *
     * @return string[]
     *
     * @since version
     */
    public function getPaymentPageLanguages()
    {
      return $this->languages;
    }
}
