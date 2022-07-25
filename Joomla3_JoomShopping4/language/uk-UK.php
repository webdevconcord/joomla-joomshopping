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
const ADMIN_CFG_CONCORDPAY_MERCHANT_ID = 'Ідентифікатор торговця';
const ADMIN_CFG_CONCORDPAY_MERCHANT_ID_DESCRIPTION = "Унікальний ID торговця в системі ConcordPay";
const ADMIN_CFG_CONCORDPAY_SECRET_KEY = 'Секретний ключ';
const ADMIN_CFG_CONCORDPAY_SECRET_KEY_DESCRIPTION = 'Секретний ключ продавця в системі ConcordPay';
const ADMIN_CFG_CONCORDPAY_PAYMODE = 'Платіжний метод';
const ADMIN_CFG_CONCORDPAY_TRANSACTION_REFUNDED = 'Статус замовлення для повернутого платежу';
const ADMIN_CFG_CONCORDPAY_APPROVE_URL = 'URL перенаправлення успішного платежу';
const ADMIN_CFG_CONCORDPAY_APPROVE_URL_DESCRIPTION = 'URL перенаправлення для успішного платежу';
const ADMIN_CFG_CONCORDPAY_DECLINE_URL = 'URL перенаправлення неуспішного платежу';
const ADMIN_CFG_CONCORDPAY_DECLINE_URL_DESCRIPTION = 'URL перенаправлення для неуспішного платежу';
const ADMIN_CFG_CONCORDPAY_CANCEL_URL = 'URL перенаправлення відмови від платежу';
const ADMIN_CFG_CONCORDPAY_CANCEL_URL_DESCRIPTION = 'URL перенаправления в разі відмови від платежу';
const PLG_JOOMSHOPPING_CONCORDPAY_STATUS_SUCCESS_DESC = 'Статус замовлення після успішної оплати';
const PLG_JOOMSHOPPING_CONCORDPAY_STATUS_FAIL_DESC = 'Статус замовлення після неуспішної оплати';
const PLG_JOOMSHOPPING_CONCORDPAY_STATUS_REFUND_DESC = 'Статус замовлення після повернення оплати';

const CONCORDPAY_UNKNOWN_ERROR = 'Сталася помилка при оплаті. Зв\'яжіться з нами, щоб переконатися, що ваше замовлення відправлене.';
const CONCORDPAY_MERCHANT_DATA_ERROR = 'Сталася помилка при оплаті. Дані продавця невірні.';
const CONCORDPAY_ORDER_DECLINED = 'Дякуємо за покупку. Однак транзакція була відхилена.';
const CONCORDPAY_SIGNATURE_ERROR = 'Сталася помилка при оплаті. Підпис недійсний.';
const CONCORDPAY_REDIRECT_PENDING_STATUS_ERROR = 'Помилка при оплаті.';

const CONCORDPAY_ORDER_APPROVED = 'Платіж пройшов успішно. ID ConcordPay:';
const CONCORDPAY_PAYMENT_REFUNDED = 'Платіж успішно повернений. ID ConcordPay:';

const CONCORDPAY_PAY = 'Оплатити';
const CONCORDPAY_ORDER_DESCRIPTION = 'Оплата карткою на сайті';

const PLG_JOOMSHOPPING_CONCORDPAY_SUCCESS = 'Вітаємо! Оплата успішна.';
const PLG_JOOMSHOPPING_CONCORDPAY_FAIL = 'На жаль, під час оплати виникла помилка.';
const PLG_JOOMSHOPPING_CONCORDPAY_CANCEL = 'Оплата відхилена користувачем.';
const PLG_JOOMSHOPPING_CONCORDPAY_UNKNOWN_ERROR = 'Під час оплати виникла невідома помилка.';
