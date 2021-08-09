<?php

// Protection against direct access
defined('_JEXEC') or die();
define('ADMIN_CFG_CONCORDPAY_MERCHANT_ID', 'Merchant ID');
define('ADMIN_CFG_CONCORDPAY_MERCHANT_ID_DESCRIPTION', "Unique ID of the store in ConcordPay system");
define('ADMIN_CFG_CONCORDPAY_SECRET_KEY', 'Secret key');
define('ADMIN_CFG_CONCORDPAY_SECRET_KEY_DESCRIPTION', 'Custom character set is used to sign messages are forwarded.');
define('ADMIN_CFG_CONCORDPAY_PAYMODE', 'Payment method');
define('ADMIN_CFG_CONCORDPAY_TRANSACTION_REFUNDED', 'Order status for refunded payment');

define('CONCORDPAY_UNKNOWN_ERROR', 'An error has occurred during payment. Please contact us to ensure your order has submitted.');
define('CONCORDPAY_MERCHANT_DATA_ERROR', 'An error has occurred during payment. Merchant data is incorrect.');
define('CONCORDPAY_ORDER_DECLINED', 'Thank you for shopping with us. However, the transaction has been declined.');
define('CONCORDPAY_SIGNATURE_ERROR', 'An error has occurred during payment. Signature is not valid.');
define('CONCORDPAY_REDIRECT_PENDING_STATUS_ERROR', 'An error during payment.');

define('CONCORDPAY_ORDER_APPROVED', 'Concordpay payment successful. ConcordPay ID:');
define('CONCORDPAY_PAYMENT_REFUNDED', 'Concordpay payment refunded successful. ConcordPay ID:');

define('CONCORDPAY_PAY', 'Pay');
define('CONCORDPAY_ORDER_DESCRIPTION', 'Payment by card on the site');
