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
const CPAY_MERCHANT_ID = 'Идентификатор торговца';
const CPAY_MERCHANT_ID_DESC = "Идентификатор торговца в системе ConcordPay";
const CPAY_SECRET_KEY = 'Секретный ключ';
const CPAY_SECRET_KEY_DESC = 'Секретный ключ торговца в системе ConcordPay';
const CPAY_PAYMODE = 'Платёжный метод';
const CPAY_ORDER_STATUS_END = "Статус заказа успешного платежа";
const CPAY_ORDER_STATUS_END_DESC = "Статус заказа для успешного платежа";
const CPAY_ORDER_STATUS_FAILED = "Статус заказа неуспешного платежа";
const CPAY_ORDER_STATUS_FAILED_DESC = "Статус заказа для неуспешного платежа";
const CPAY_ORDER_STATUS_REFUNDED = "Статус заказа возвращённого платежа";
const CPAY_ORDER_STATUS_REFUNDED_DESC = "Order status for refunded payment";
const CPAY_LANGUAGE = "Язык";
const CPAY_LANGUAGE_DESC = "Язык страницы оплаты";

const CPAY_ERROR_UNKNOWN = 'Произошла ошибка при оплате. Свяжитесь с нами, чтобы убедиться, что ваш заказ отправлен.';
const CPAY_ERROR_MERCHANT = 'Произошла ошибка при оплате. Данные продавца неверны.';
const CPAY_ORDER_DECLINED = 'Спасибо за покупку. Однако транзакция была отклонена.';
const CPAY_ERROR_SIGNATURE = 'Произошла ошибка при оплате. Подпись недействительна.';
const CPAY_ERROR_REDIRECT_PENDING_STATUS = 'Ошибка при оплате.';
const CPAY_ERROR_OPERATION_TYPE = "Неизвестный тип операции";

const CPAY_ORDER_APPROVED = 'Платеж прошел успешно. ID ConcordPay:';
const CPAY_PAYMENT_REFUNDED = 'Платеж успешно возвращён. ID ConcordPay:';

const CPAY_PAY = 'Оплатить';
const CPAY_ORDER_DESC = 'Оплата картой на сайте';
const CPAY_REDIRECT_TO_PAYMENT_PAGE = 'Перенаправление на страницу оплаты';
