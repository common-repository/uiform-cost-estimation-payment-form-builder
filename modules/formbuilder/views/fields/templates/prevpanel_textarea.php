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
ob_start();
?>
<?php 
$id_field=(!empty($id))?$id:'';
?>
<div id="<?php echo $id_field;?>"  data-typefield="7" class="uiform-textarea uiform-field uiform-field-childs">
            <div class="uiform-field-wrap uiform-field-move">
                <div class="rkfm-row">
                    <div class="rkfm-col-sm-2">
                        <div class="uifm-control-label">
                            <label class="control-label">
                                <span 
                                   data-field-option="uifm-help-block"
                                    class="uifm-label-helpblock uifm-f-option">
                                    <span class="fa fa-question-circle"></span>
                                </span> 
                               <span  data-field-store="label-text"
                                      data-field-option="uifm-label"
                                      class="uifm-label uifm-f-option"><?php echo __('Textarea label','FRocket_admin'); ?></span>
                               <span data-field-store="sublabel-text"
                                      data-field-option="uifm-sublabel"
                                      class="uifm-sublabel uifm-f-option"><?php echo __('Textarea sublabel','FRocket_admin'); ?></span>
                            </label>
                             
                        </div>
                    </div>
                    <div class="rkfm-col-sm-10">
                        <div class="uifm-input-container">
                            <textarea data-field-store="input-value"
                                   data-field-option="uifm-txtbox-inp-val"
                                   class="uifm-txtbox-inp-val form-control uifm-f-option"
                                   ></textarea>
                        </div>
                        <div data-field-option="uifm-help-block"  class="uifm-help-block uifm-f-option">
                            <?php echo __('Help block text','FRocket_admin'); ?>
                        </div>
                    </div>
                </div>
                
                <?php echo $quick_options;?>
            </div>
        </div>
<?php
$cntACmp = ob_get_contents();
/*$cntACmp = str_replace("\n", '', $cntACmp);
$cntACmp = str_replace("\t", '', $cntACmp);
$cntACmp = str_replace("\r", '', $cntACmp);
$cntACmp = str_replace("//-->", ' ', $cntACmp);
$cntACmp = str_replace("//<!--", ' ', $cntACmp);
@$cntACmp = eregi_replace("[[:space:]]+", " ", $cntACmp);*/
ob_end_clean();
echo $cntACmp;
?>
