<?php
/**
 * Intranet
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   Rocket_form
 * @author    Softdiscover <info@softdiscover.com>
 * @copyright 2015 Softdiscover
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://wordpress-cost-estimator.uiform.com
 */
if (!defined('ABSPATH')) {exit('No direct script access allowed');}
?>
<div id="uiform-container" class="uiform-wrap">
        <div class="col-md-12">
            <div class="space20"></div>
            <div class="row">
                <div class="col-md-12">
                <select name="uifm-record-form"
                        onchange="javascript:rocketform.viewchart_load();"
                        id="uifm-record-form-cmb"
                        >
                    <?php foreach ($list_forms as $value) { ?>
                    <option value="<?php echo $value->fmb_id;?>"><?php echo $value->fmb_name;?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <h2><?php echo __('View chart','FRocket_admin'); ?></h2>
            </div>
            <div class="row">
                <div class="alert alert-info"><?php echo __('Select your form in order to see the chart','FRocket_admin'); ?></div>
            </div>
            <div class="row">
                <div id="uiform-viewchart-result"   ></div>
            </div>
            <div class="space10"></div>
            
        </div>
    
</div>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function () {

   rocketform();
    rocketform.viewchart_load();
  
                  
});

//]]>
</script>