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
const CPAY_SETTINGS = 'Настройки ConcordPay';
const ADMIN_CFG_CONCORDPAY_MERCHANT_ID = 'Идентификатор торговца';
const ADMIN_CFG_CONCORDPAY_MERCHANT_ID_DESCRIPTION = "Уникальный ID торговца в системе ConcordPay";
const ADMIN_CFG_CONCORDPAY_SECRET_KEY = 'Секретный ключ';
const ADMIN_CFG_CONCORDPAY_SECRET_KEY_DESCRIPTION = 'Секретный ключ продавца в системе ConcordPay';
const ADMIN_CFG_CONCORDPAY_PAYMODE = 'Платёжный метод';
const ADMIN_CFG_CONCORDPAY_TRANSACTION_REFUNDED = 'Статус заказа для возвращённого платежа';
const ADMIN_CFG_CONCORDPAY_APPROVE_URL = 'URL перенаправления успешного платежа';
const ADMIN_CFG_CONCORDPAY_APPROVE_URL_DESCRIPTION = 'URL перенаправления для успешного платежа';
const ADMIN_CFG_CONCORDPAY_DECLINE_URL = 'URL перенаправления неуспешного платежа';
const ADMIN_CFG_CONCORDPAY_DECLINE_URL_DESCRIPTION = 'URL перенаправления для неуспешного платежа';
const ADMIN_CFG_CONCORDPAY_CANCEL_URL = 'URL перенаправления отказа от платежа';
const ADMIN_CFG_CONCORDPAY_CANCEL_URL_DESCRIPTION = 'URL перенаправления при отказе от платежа';
const PLG_JOOMSHOPPING_CONCORDPAY_STATUS_SUCCESS_DESC = 'Статус заказа после успешной оплаты';
const PLG_JOOMSHOPPING_CONCORDPAY_STATUS_FAIL_DESC = 'Статус заказа после неуспешной оплаты';
const PLG_JOOMSHOPPING_CONCORDPAY_STATUS_REFUND_DESC = 'Статус заказа после возврата оплаты';

const CONCORDPAY_UNKNOWN_ERROR = 'Произошла ошибка при оплате. Свяжитесь с нами, чтобы убедиться, что ваш заказ отправлен.';
const CONCORDPAY_MERCHANT_DATA_ERROR = 'Произошла ошибка при оплате. Данные продавца неверны.';
const CONCORDPAY_ORDER_DECLINED = 'Спасибо за покупку. Однако транзакция была отклонена.';
const CONCORDPAY_SIGNATURE_ERROR = 'Произошла ошибка при оплате. Подпись недействительна.';
const CONCORDPAY_REDIRECT_PENDING_STATUS_ERROR = 'Ошибка при оплате.';

const CONCORDPAY_ORDER_APPROVED = 'Платеж прошел успешно. ID ConcordPay:';
const CONCORDPAY_PAYMENT_REFUNDED = 'Платеж успешно возвращён. ID ConcordPay:';

const CONCORDPAY_PAY = 'Оплатить';
const CONCORDPAY_ORDER_DESCRIPTION = 'Оплата картой на сайте';

const PLG_JOOMSHOPPING_CONCORDPAY_SUCCESS = 'Поздравляем! Оплата успешна.';
const PLG_JOOMSHOPPING_CONCORDPAY_FAIL = 'К сожалению, во время оплаты произошла ошибка.';
const PLG_JOOMSHOPPING_CONCORDPAY_CANCEL = 'Оплата отменена пользователем.';
const PLG_JOOMSHOPPING_CONCORDPAY_UNKNOWN_ERROR = 'Во время оплаты произошла неизвестная ошибка.';
