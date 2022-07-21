<?php
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
// Protection against direct access
defined('_JEXEC') or die();
define('ADMIN_CFG_CONCORDPAY_MERCHANT_ID', 'Merchant ID');
define('ADMIN_CFG_CONCORDPAY_MERCHANT_ID_DESCRIPTION', "Unique ID of the store in ConcordPay system");
define('ADMIN_CFG_CONCORDPAY_SECRET_KEY', 'Secret key');
define('ADMIN_CFG_CONCORDPAY_SECRET_KEY_DESCRIPTION', 'Custom character set is used to sign messages are forwarded.');
define('ADMIN_CFG_CONCORDPAY_PAYMODE', 'Payment method');
define('ADMIN_CFG_CONCORDPAY_TRANSACTION_REFUNDED', 'Order status for refunded payment');
define('ADMIN_CFG_CONCORDPAY_RETURN_URL', 'Return URL');
define('ADMIN_CFG_CONCORDPAY_RETURN_URL_DESCRIPTION', 'Redirect URL after payment');

define('CONCORDPAY_UNKNOWN_ERROR', 'An error has occurred during payment. Please contact us to ensure your order has submitted.');
define('CONCORDPAY_MERCHANT_DATA_ERROR', 'An error has occurred during payment. Merchant data is incorrect.');
define('CONCORDPAY_ORDER_DECLINED', 'Thank you for shopping with us. However, the transaction has been declined.');
define('CONCORDPAY_SIGNATURE_ERROR', 'An error has occurred during payment. Signature is not valid.');
define('CONCORDPAY_REDIRECT_PENDING_STATUS_ERROR', 'An error during payment.');

define('CONCORDPAY_ORDER_APPROVED', 'Concordpay payment successful. ConcordPay ID:');
define('CONCORDPAY_PAYMENT_REFUNDED', 'Concordpay payment refunded successful. ConcordPay ID:');

define('CONCORDPAY_PAY', 'Pay');
define('CONCORDPAY_ORDER_DESCRIPTION', 'Payment by card on the site');

define('PLG_JOOMSHOPPING_CONCORDPAY_SUCCESS', 'Congratulations! Payment successful.');
define('PLG_JOOMSHOPPING_CONCORDPAY_FAIL', 'Sorry, there was an error during payment.');
define('PLG_JOOMSHOPPING_CONCORDPAY_CANCEL', 'The payment was canceled by the user.');
define('PLG_JOOMSHOPPING_CONCORDPAY_UNKNOWN_ERROR', 'An unknown error occurred during payment.');
