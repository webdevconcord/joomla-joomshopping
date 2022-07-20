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
const CPAY_MERCHANT_ID = 'Merchant ID';
const CPAY_MERCHANT_ID_DESC = "Merchant ID in ConcordPay system";
const CPAY_SECRET_KEY = 'Secret key';
const CPAY_SECRET_KEY_DESC = 'Secret merchant\'s key in ConcordPay system';
const CPAY_PAYMODE = 'Payment method';
const CPAY_ORDER_STATUS_END = "Order status successful payment";
const CPAY_ORDER_STATUS_END_DESC = "Order status for successful payment";
const CPAY_ORDER_STATUS_FAILED = "Order status failed payment";
const CPAY_ORDER_STATUS_FAILED_DESC = "Order status for failed payment";
const CPAY_ORDER_STATUS_REFUNDED = "Order status refunded payment";
const CPAY_ORDER_STATUS_REFUNDED_DESC = "Order status for refunded payment";
const CPAY_LANGUAGE = "Language";
const CPAY_LANGUAGE_DESC = "Payment page language";

const CPAY_ERROR_UNKNOWN = 'An error has occurred during payment. Please contact us to ensure your order has submitted.';
const CPAY_ERROR_MERCHANT = 'An error has occurred during payment. Merchant data is incorrect.';
const CPAY_ORDER_DECLINED = 'Thank you for shopping with us. However, the transaction has been declined.';
const CPAY_ERROR_SIGNATURE = 'An error has occurred during payment. Signature is not valid.';
const CPAY_ERROR_REDIRECT_PENDING_STATUS = 'An error during payment.';
const CPAY_ERROR_OPERATION_TYPE = "Unknown operation type";

const CPAY_ORDER_APPROVED = 'Concordpay payment successful. ConcordPay ID:';
const CPAY_PAYMENT_REFUNDED = 'Concordpay payment refunded successful. ConcordPay ID:';

const CPAY_PAY = 'Pay';
const CPAY_ORDER_DESC = 'Payment by card on the site';
const CPAY_REDIRECT_TO_PAYMENT_PAGE = 'Redirect to payment page';
