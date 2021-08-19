<?php

// Protection against direct access
defined('_JEXEC') or die('Restricted access');

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

    const VERSION        = '1.0';
    const ORDER_APPROVED = 'Approved';
    const ORDER_DECLINED = 'Declined';

    const RESPONSE_TYPE_PAYMENT = 'payment';
    const RESPONSE_TYPE_REVERSE = 'reverse';

    const SIGNATURE_SEPARATOR = ';';
    const ORDER_SEPARATOR     = "#";

    // From: components/com_jshopping/payments/payment.php
    const CONCORDPAY_STATUS_ERROR    = 0;
    const CONCORDPAY_STATUS_PAID     = 1;
    const CONCORDPAY_STATUS_REFUNDED = 7;

    const URL = 'https://pay.concord.ua/api/';

    /**
     * Load translations files
     * @since 3.0.0
     */
    public function loadLanguageFile()
    {
        $lang      = JFactory::getLanguage();
        $lang_tag  = ($lang !== null ? $lang->getTag() : 'en-GB');
        $lang_dir  = JPATH_ROOT . '/components/com_jshopping/payments/pm_concordpay/language/';
        $lang_file = $lang_dir . $lang_tag . '.php';
        if (file_exists($lang_file)) {
            require_once $lang_file;
        } else {
            require_once $lang_dir . 'en-GB.php';
        }
    }

    public function showPaymentForm($params, $pmconfigs)
    {
        include(__DIR__ . "/paymentform.php");
    }

    /**
     * This method is responsible for the plugin settings in the administrative section.
     *
     * @param array $params
     * @since 3.0.0
     */
    public function showAdminFormParams($params)
    {
        if (empty($params)) {
            $params = [
                'concordpay_merchant_id'    => '',
                'concordpay_secret_key'     => '',
                'transaction_end_status'    => '',
                'transaction_failed_status' => ''
            ];
        }
        $orders = JModelLegacy::getInstance('orders', 'JshoppingModel');
        $this->loadLanguageFile();
        include __DIR__ . '/adminparamsform.php';
    }

    /**
     * Payment form creation.
     *
     * @param $pmconfigs
     * @param $order
     * @since 3.0.0
     */
    public function showEndForm($pmconfigs, $order)
    {
        $this->loadLanguageFile();

        $order_id    = $order->order_id;
        $description = CONCORDPAY_ORDER_DESCRIPTION . ' ' . $_SERVER["HTTP_HOST"] . ', '
            . $order->f_name  . ' ' . $order->l_name . ', ' . $order->phone;

        $base_url    = JURI::root() . 'index.php?option=com_jshopping&controller=checkout&task=step7&js_paymentclass=' . __CLASS__ . '&order_id=' . $order_id;
        $success_url = $base_url . '&act=finish';
        $fail_url    = $base_url . '&act=cancel';
        $result_url  = $base_url . '&act=notify&nolang=1';

        $concordpay_args = array(
            'operation'    => 'Purchase',
            'merchant_id'  => $pmconfigs['concordpay_merchant_id'],
            'amount'       => $this->fixOrderTotal($order),
            'order_id'     => $order_id . self::ORDER_SEPARATOR . time(),
            'currency_iso' => $order->currency_code_iso,
            'description'  => $description,
            'add_params'   => [],
            'approve_url'  => $success_url,
            'decline_url'  => $fail_url,
            'cancel_url'   => $fail_url,
            'callback_url' => $result_url,
            // Statistics.
            'client_last_name'  => $order->l_name ?? '',
            'client_first_name' => $order->f_name ?? '',
            'email'             => $order->email ?? '',
            'phone'             => $order->phone ?? ''
        );

        $concordpay_args['signature'] = $this->getSignature($concordpay_args, $this->keysForSignature, $pmconfigs['concordpay_secret_key']); ?>
        <html>
        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        </head>
        <body>
        <form id="paymentform" action="<?php print pm_concordpay::URL; ?>" name="paymentform" method="post">
            <?php
            foreach ($concordpay_args as $key => $value) :
                ?>
                <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
            <?php
            endforeach; ?>
        </form>
        <?php print _JSHOP_REDIRECT_TO_PAYMENT_PAGE ?>
        <br>
        <script type="text/javascript">document.getElementById('paymentform').submit();</script>
        </body>
        </html>
        <?php die(); ?>
        <?php
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

        $paymentInfo = $this->isPaymentValid($callback, $pmconfig, $order);

        return $paymentInfo;
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

        $hash = implode(self::SIGNATURE_SEPARATOR, $hash);

        return hash_hmac('md5', $hash, $secret_key);
    }

    /**
     * Payment responce validation
     *
     * @param $response
     * @param $pmconfig
     * @param $order
     * @return array
     * @throws Exception
     * @since 3.0.0
     */
    public function isPaymentValid($response, $pmconfig, $order)
    {
        list($orderId, ) = explode(self::ORDER_SEPARATOR, $response['orderReference']);
        if ($orderId !== $order->order_id || !isset($response['transactionId'])) {
            throw new Exception(CONCORDPAY_UNKNOWN_ERROR);
        }

        $response['orderReference'] = $orderId;
        if ($pmconfig['concordpay_merchant_id'] !== $response['merchantAccount']) {
            throw new Exception(CONCORDPAY_MERCHANT_DATA_ERROR);
        }

        $verificationSignature = $this->getSignature($response, $this->keysForResponseSignature, $pmconfig['concordpay_secret_key']);
        if ($verificationSignature !== $response['merchantSignature']) {
            throw new Exception(CONCORDPAY_SIGNATURE_ERROR);
        }

        if ($response['transactionStatus'] === self::ORDER_APPROVED && isset($response['type'])) {
            $app = JFactory::getApplication();
            if ($app === null) {
                throw new Exception(CONCORDPAY_UNKNOWN_ERROR);
            }

            if (self::RESPONSE_TYPE_REVERSE === $response['type']) {
                // Refunded payment callback.
                $app->enqueueMessage(CONCORDPAY_PAYMENT_REFUNDED . $response['transactionId']);
                return array(self::CONCORDPAY_STATUS_REFUNDED, CONCORDPAY_ORDER_APPROVED . $response['transactionId']);
            }

            if (self::RESPONSE_TYPE_PAYMENT === $response['type']) {
                // Purchase callback.
                $app->enqueueMessage(CONCORDPAY_ORDER_APPROVED . $response['transactionId']);
                return array(self::CONCORDPAY_STATUS_PAID, CONCORDPAY_ORDER_APPROVED . $response['transactionId']);
            }

            throw new Exception(CONCORDPAY_UNKNOWN_ERROR);
        }

        if ($response['transactionStatus'] === self::ORDER_DECLINED
            && isset($response['reasonCode'])
            && !empty($response['reasonCode'])
        ) {
            $error = $response['reasonCode'];
            if (isset($response['reason']) && !empty($response['reason'])) {
                $error += $response['reason'];
            }
            return array(self::CONCORDPAY_STATUS_ERROR, $error);
        }

        throw new Exception(CONCORDPAY_ORDER_DECLINED);
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
}

?>