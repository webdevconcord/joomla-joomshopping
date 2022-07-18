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

const CPAY_SETTINGS = 'Налаштування ConcordPay';
const CPAY_MERCHANT_ID = 'Ідентифікатор торговця';
const CPAY_MERCHANT_ID_DESC = "Ідентифікатор торговця в системі ConcordPay";
const CPAY_SECRET_KEY = 'Секретний ключ';
const CPAY_SECRET_KEY_DESC = 'Секретний ключ торговця в системі ConcordPay';
const CPAY_PAYMODE = 'Платіжний метод';
const CPAY_ORDER_STATUS_END = "Статус замовлення успішного платежу";
const CPAY_ORDER_STATUS_END_DESC = "Статус замовлення для успішного платежу";
const CPAY_ORDER_STATUS_FAILED = "Статус замовлення неуспішного платежу";
const CPAY_ORDER_STATUS_FAILED_DESC = "Статус замовлення для неуспішного платежу";
const CPAY_ORDER_STATUS_REFUNDED = "Статус замовлення поверненого платежу";
const CPAY_ORDER_STATUS_REFUNDED_DESC = "Статус замовлення для поверненого платежу";
const CPAY_LANGUAGE = "Мова";
const CPAY_LANGUAGE_DESC = "Мова сторінки оплати";

const CPAY_ERROR_UNKNOWN = 'Сталася помилка при оплаті. Зв\'яжіться з нами, щоб переконатися, що ваше замовлення відправлене.';
const CPAY_ERROR_MERCHANT = 'Сталася помилка при оплаті. Дані продавця невірні.';
const CPAY_ORDER_DECLINED = 'Дякуємо за покупку. Однак транзакція була відхилена.';
const CPAY_ERROR_SIGNATURE = 'Сталася помилка при оплаті. Підпис недійсний.';
const CPAY_ERROR_REDIRECT_PENDING_STATUS = 'Помилка при оплаті.';
const CPAY_ERROR_OPERATION_TYPE = "Невідомий тип операції";

const CPAY_ORDER_APPROVED = 'Платіж пройшов успішно. ID ConcordPay:';
const CPAY_PAYMENT_REFUNDED = 'Платіж успішно повернений. ID ConcordPay:';

const CPAY_PAY = 'Оплатити';
const CPAY_ORDER_DESC = 'Оплата карткою на сайті';
const CPAY_REDIRECT_TO_PAYMENT_PAGE = 'Перенаправлення на сторінку оплати';
