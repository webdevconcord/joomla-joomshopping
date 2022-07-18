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
// Protection against direct access.
defined('_JEXEC') or die();
/** @var $params array */
/** @var $orders \Joomla\Component\Jshopping\Administrator\Model\OrdersModel */
?>

<fieldset class="options-form">
    <legend><?php echo CPAY_SETTINGS; ?></legend>
  <div class="form-grid">
    <div class="control-group">
      <div class="control-label">
        <label for="concordpay_merchant_id"><?php echo CPAY_MERCHANT_ID; ?></label>
        <span class="star" aria-hidden="true">&nbsp;*</span>
      </div>
      <div class="controls">
        <input type="text" id="concordpay_merchant_id" name="pm_params[concordpay_merchant_id]"
               class="form-control required" value="<?php echo $params['concordpay_merchant_id']; ?>">
        <div class="form-text hide-aware-inline-help"><?php echo CPAY_MERCHANT_ID_DESC; ?></div>
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <label for="concordpay_secret_key"><?php echo CPAY_SECRET_KEY; ?></label>
        <span class="star" aria-hidden="true">&nbsp;*</span>
      </div>
      <div class="controls">
        <input type="text" id="concordpay_secret_key" name="pm_params[concordpay_secret_key]"
               class="form-control required" value="<?php echo $params['concordpay_secret_key']; ?>">
        <div class="form-text hide-aware-inline-help"><?php echo CPAY_SECRET_KEY_DESC; ?></div>
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <label for="transaction_end_status"><?php echo CPAY_ORDER_STATUS_END ?></label>
      </div>
      <div class="controls">
        <?php print JHTML::_('select.genericlist', $orders->getAllOrderStatus(), 'pm_params[transaction_end_status]', 'class = "form-select" size = "1"', 'status_id', 'name', $params['transaction_end_status'], 'transaction_end_status'); ?>
        <div class="form-text hide-aware-inline-help"><?php echo CPAY_ORDER_STATUS_END_DESC; ?></div>
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <label for="transaction_failed_status"><?php echo CPAY_ORDER_STATUS_FAILED ?></label>
      </div>
      <div class="controls">
        <?php print JHTML::_('select.genericlist', $orders->getAllOrderStatus(), 'pm_params[transaction_failed_status]', 'class = "form-select" size = "1"', 'status_id', 'name', $params['transaction_failed_status'], 'transaction_failed_status'); ?>
        <div class="form-text hide-aware-inline-help"><?php echo CPAY_ORDER_STATUS_FAILED_DESC; ?></div>
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <label for="transaction_refunded_status"><?php echo CPAY_ORDER_STATUS_REFUNDED ?></label>
      </div>
      <div class="controls">
        <?php print JHTML::_('select.genericlist', $orders->getAllOrderStatus(), 'pm_params[transaction_refunded_status]', 'class = "form-select" size = "1"', 'status_id', 'name', $params['transaction_refunded_status'], 'transaction_refunded_status'); ?>
        <div class="form-text hide-aware-inline-help"><?php echo CPAY_ORDER_STATUS_REFUNDED_DESC; ?></div>
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <label for="concordpay_language"><?php echo CPAY_LANGUAGE ?></label>
      </div>
      <div class="controls">
        <?php print JHTML::_('select.genericlist', $this->getPaymentpageLanguages(), 'pm_params[concordpay_language]', 'class = "form-select" size = "1"', 'status_id', 'name', $params['concordpay_language'], 'concordpay_language'); ?>
        <div class="form-text hide-aware-inline-help"><?php echo CPAY_LANGUAGE_DESC; ?></div>
      </div>
    </div>
  </div>
  </fieldset>
<div class="clr"></div>
<style>
    .form-grid {width: 60%;}
    .options-form {margin-top: 20px;}
    .controls input[type=text] {width: 100%;}
</style>