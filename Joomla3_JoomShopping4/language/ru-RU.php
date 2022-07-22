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
define('ADMIN_CFG_CONCORDPAY_MERCHANT_ID', 'Идентификатор продавца');
define('ADMIN_CFG_CONCORDPAY_MERCHANT_ID_DESCRIPTION', "Уникальный ID продавца в системе ConcordPay");
define('ADMIN_CFG_CONCORDPAY_SECRET_KEY', 'Секретный ключ');
define('ADMIN_CFG_CONCORDPAY_SECRET_KEY_DESCRIPTION', 'Секретный ключ продавца в системе ConcordPay');
define('ADMIN_CFG_CONCORDPAY_PAYMODE', 'Платёжный метод');
define('ADMIN_CFG_CONCORDPAY_TRANSACTION_REFUNDED', 'Статус заказа для возвращённого платежа');
define('ADMIN_CFG_CONCORDPAY_APPROVE_URL', 'URL перенаправления успешного платежа');
define('ADMIN_CFG_CONCORDPAY_APPROVE_URL_DESCRIPTION', 'URL перенаправления для успешного платежа');
define('ADMIN_CFG_CONCORDPAY_DECLINE_URL', 'URL перенаправления неуспешного платежа');
define('ADMIN_CFG_CONCORDPAY_DECLINE_URL_DESCRIPTION', 'URL перенаправления для неуспешного платежа');
define('ADMIN_CFG_CONCORDPAY_CANCEL_URL', 'URL перенаправления отказа от платежа');
define('ADMIN_CFG_CONCORDPAY_CANCEL_URL_DESCRIPTION', 'URL перенаправления при отказе от платежа');

define('CONCORDPAY_UNKNOWN_ERROR', 'Произошла ошибка при оплате. Свяжитесь с нами, чтобы убедиться, что ваш заказ отправлен.');
define('CONCORDPAY_MERCHANT_DATA_ERROR', 'Произошла ошибка при оплате. Данные продавца неверны.');
define('CONCORDPAY_ORDER_DECLINED', 'Спасибо за покупку. Однако транзакция была отклонена.');
define('CONCORDPAY_SIGNATURE_ERROR', 'Произошла ошибка при оплате. Подпись недействительна.');
define('CONCORDPAY_REDIRECT_PENDING_STATUS_ERROR', 'Ошибка при оплате.');

define('CONCORDPAY_ORDER_APPROVED', 'Платеж прошел успешно. ID ConcordPay:');
define('CONCORDPAY_PAYMENT_REFUNDED', 'Платеж успешно возвращён. ID ConcordPay:');

define('CONCORDPAY_PAY', 'Оплатить');
define('CONCORDPAY_ORDER_DESCRIPTION', 'Оплата картой на сайте');

define('PLG_JOOMSHOPPING_CONCORDPAY_SUCCESS', 'Поздравляем! Оплата успешна.');
define('PLG_JOOMSHOPPING_CONCORDPAY_FAIL', 'К сожалению, во время оплаты произошла ошибка.');
define('PLG_JOOMSHOPPING_CONCORDPAY_CANCEL', 'Оплата отменена пользователем.');
define('PLG_JOOMSHOPPING_CONCORDPAY_UNKNOWN_ERROR', 'Во время оплаты произошла неизвестная ошибка.');
