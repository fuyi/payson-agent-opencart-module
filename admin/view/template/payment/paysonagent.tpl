<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
            <tr>
              <td>Agent ID *</td>
              <td><input type="text" name="paysonagent_agent_id" value="<?php echo $paysonagent_agent_id; ?>" /></td>
            </tr>
            <tr>
              <td>MD5 Key *</td>
              <td><input type="text" name="paysonagent_md5_key" value="<?php echo $paysonagent_md5_key; ?>" /></td>
            </tr>
            <tr>
              <td>Seller Email *</td>
              <td><input type="text" name="paysonagent_seller_email" value="<?php echo $paysonagent_seller_email; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $text_guarantee; ?></td>
              <td>
                  <select name="paysonagent_guarantee_offered">
                      <option value="2" <?php if($paysonagent_guarantee_offered==2) echo "selected='selected'"?>><?php echo $text_enabled; ?></option>
                      <option value="1" <?php if($paysonagent_guarantee_offered==1) echo "selected='selected'"?>><?php echo $text_disabled; ?></option>
                  </select>
              </td>
            </tr>
            <tr>
                          <td><?php echo $text_payment_method; ?></td>
                          <td>
                              <select name="paysonagent_payment_method">
                                  <option value="0" <?php if($paysonagent_payment_method==0) echo "selected='selected'"?>><?php echo $text_payment_all; ?></option>
                                  <option value="1" <?php if($paysonagent_payment_method==1) echo "selected='selected'"?>><?php echo $text_payment_card; ?></option>
                                  <option value="2" <?php if($paysonagent_payment_method==2) echo "selected='selected'"?>><?php echo $text_payment_bank; ?></option>
                                  <option value="3" <?php if($paysonagent_payment_method==3) echo "selected='selected'"?>><?php echo $text_payment_deposit; ?></option>
                              </select>
                          </td>
                        </tr>
          <tr>
            <td><?php echo $entry_total; ?></td>
            <td><input type="text" name="paysonagent_total" value="<?php echo $paysonagent_total; ?>" /></td>
          </tr>        
          <tr>
            <td><?php echo $entry_order_status; ?></td>
            <td><select name="paysonagent_order_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $paysonagent_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="paysonagent_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $paysonagent_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="paysonagent_status">
                <?php if ($paysonagent_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="paysonagent_sort_order" value="<?php echo $paysonagent_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?> 