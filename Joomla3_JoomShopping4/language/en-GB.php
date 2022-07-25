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
const CPAY_SETTINGS = 'ConcordPay Settings';
const ADMIN_CFG_CONCORDPAY_MERCHANT_ID = 'Merchant ID';
const ADMIN_CFG_CONCORDPAY_MERCHANT_ID_DESCRIPTION = "Unique ID of the store in ConcordPay system";
const ADMIN_CFG_CONCORDPAY_SECRET_KEY = 'Secret key';
const ADMIN_CFG_CONCORDPAY_SECRET_KEY_DESCRIPTION = 'Custom character set is used to sign messages are forwarded.';
const ADMIN_CFG_CONCORDPAY_PAYMODE = 'Payment method';
const ADMIN_CFG_CONCORDPAY_TRANSACTION_REFUNDED = 'Order status for refunded payment';
const ADMIN_CFG_CONCORDPAY_APPROVE_URL = 'Successful payment redirect URL';
const ADMIN_CFG_CONCORDPAY_APPROVE_URL_DESCRIPTION = 'Redirect URL after successful payment';
const ADMIN_CFG_CONCORDPAY_DECLINE_URL = 'Failed payment redirect URL';
const ADMIN_CFG_CONCORDPAY_DECLINE_URL_DESCRIPTION = 'Redirect URL on payment failure';
const ADMIN_CFG_CONCORDPAY_CANCEL_URL = 'Cancel payment redirect URL';
const ADMIN_CFG_CONCORDPAY_CANCEL_URL_DESCRIPTION = 'Redirect URL when canceling a payment';
const PLG_JOOMSHOPPING_CONCORDPAY_STATUS_SUCCESS_DESC = 'Order status after successful payment';
const PLG_JOOMSHOPPING_CONCORDPAY_STATUS_FAIL_DESC = 'Order status after failed payment';
const PLG_JOOMSHOPPING_CONCORDPAY_STATUS_REFUND_DESC = 'Order status after refund';

const CONCORDPAY_UNKNOWN_ERROR = 'An error has occurred during payment. Please contact us to ensure your order has submitted.';
const CONCORDPAY_MERCHANT_DATA_ERROR = 'An error has occurred during payment. Merchant data is incorrect.';
const CONCORDPAY_ORDER_DECLINED = 'Thank you for shopping with us. However, the transaction has been declined.';
const CONCORDPAY_SIGNATURE_ERROR = 'An error has occurred during payment. Signature is not valid.';
const CONCORDPAY_REDIRECT_PENDING_STATUS_ERROR = 'An error during payment.';

const CONCORDPAY_ORDER_APPROVED = 'Concordpay payment successful. ConcordPay ID:';
const CONCORDPAY_PAYMENT_REFUNDED = 'Concordpay payment refunded successful. ConcordPay ID:';

const CONCORDPAY_PAY = 'Pay';
const CONCORDPAY_ORDER_DESCRIPTION = 'Payment by card on the site';

const PLG_JOOMSHOPPING_CONCORDPAY_SUCCESS = 'Congratulations! Payment successful.';
const PLG_JOOMSHOPPING_CONCORDPAY_FAIL = 'Sorry, there was an error during payment.';
const PLG_JOOMSHOPPING_CONCORDPAY_CANCEL = 'The payment was canceled by the user.';
const PLG_JOOMSHOPPING_CONCORDPAY_UNKNOWN_ERROR = 'An unknown error occurred during payment.';
