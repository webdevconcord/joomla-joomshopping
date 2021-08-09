<?php

// Protection against direct access
defined('_JEXEC') or die();
define('ADMIN_CFG_CONCORDPAY_MERCHANT_ID', 'Ідентифікатор продавця');
define('ADMIN_CFG_CONCORDPAY_MERCHANT_ID_DESCRIPTION', "Унікальний ID продавця в системі ConcordPay");
define('ADMIN_CFG_CONCORDPAY_SECRET_KEY', 'Секретний ключ');
define('ADMIN_CFG_CONCORDPAY_SECRET_KEY_DESCRIPTION', 'Секретний ключ продавця в системі ConcordPay');
define('ADMIN_CFG_CONCORDPAY_PAYMODE', 'Платіжний метод');
define('ADMIN_CFG_CONCORDPAY_TRANSACTION_REFUNDED', 'Статус замовлення для повернутого платежу');

define('CONCORDPAY_UNKNOWN_ERROR', 'Сталася помилка при оплаті. Зв\'яжіться з нами, щоб переконатися, що ваше замовлення відправлене.');
define('CONCORDPAY_MERCHANT_DATA_ERROR', 'Сталася помилка при оплаті. Дані продавця невірні.');
define('CONCORDPAY_ORDER_DECLINED', 'Дякуємо за покупку. Однак транзакція була відхилена.');
define('CONCORDPAY_SIGNATURE_ERROR', 'Сталася помилка при оплаті. Підпис недійсний.');
define('CONCORDPAY_REDIRECT_PENDING_STATUS_ERROR', 'Помилка при оплаті.');

define('CONCORDPAY_ORDER_APPROVED', 'Платіж пройшов успішно. ID ConcordPay:');
define('CONCORDPAY_PAYMENT_REFUNDED', 'Платіж успішно повернений. ID ConcordPay:');

define('CONCORDPAY_PAY', 'Оплатити');
define('CONCORDPAY_ORDER_DESCRIPTION', 'Оплата карткою на сайті');