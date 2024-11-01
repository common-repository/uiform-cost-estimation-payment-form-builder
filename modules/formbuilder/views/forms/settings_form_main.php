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
<div class="uiform-set-field-wrap" id="uiform-set-form-main">
    <div class="row">
        <div class="col-md-12">
            <div class="divider2">
            <div class="mask"></div>
            <span><i><?php echo __('estimation','FRocket_admin'); ?></i></span>
            </div>
        </div>
    </div>
    <div class="space10"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                    <label for=""><?php echo __('Enable Cost estimation','FRocket_admin'); ?></label>
                     <input class="switch-field"
                                   id="uifm_frm_main_pricest"
                                   name="uifm_frm_main_pricest"
                                   type="checkbox"/>
                     <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('this will enable cost estimation for the whole form.','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
            </div>
        </div>
    </div>
    
    <div class="space10"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                    <label for=""><?php echo __('Enable Payment','FRocket_admin'); ?></label>
                     <input class="switch-field"
                            disabled="disabled"
                                   id="uifm_frm_main_paymentst"
                                   name="uifm_frm_main_paymentst"
                                   type="checkbox"/> <span class="rkfm-express-lock-wrap"
                                                            data-toggle="tooltip" data-placement="right" 
                                                            data-original-title="<?php echo __('feature locked','FRocket_admin'); ?>"
                                                            ><i class="fa fa-lock"></i></span>
                     <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('it will allow to show a payment page after submitting form','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                    <label for=""><?php echo __('Currency code','FRocket_admin'); ?>
                    <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('it allow you choose currency code','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
                    </label>
                    <input type="text" 
                           class="form-control" 
                           placeholder="" 
                           name="uifm_frm_main_price_currency"
                           id="uifm_frm_main_price_currency"
                           >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                    <label for=""><?php echo __('Currency symbol','FRocket_admin'); ?>
                    <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('it allow you choose currency symbol','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
                    </label>
                    <input type="text" 
                           class="form-control" 
                           placeholder="" 
                           name="uifm_frm_main_price_currency_symbol"
                           id="uifm_frm_main_price_currency_symbol"
                           >
                     
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                    <label for=""><?php echo __('Price format','FRocket_admin'); ?>
                        <a href="javascript:void(0);"
                        data-toggle="tooltip" data-placement="right" 
                        data-original-title="<?php echo __('it allows to put decimal and thousand options','FRocket_admin'); ?>"
                        ><span class="fa fa-question-circle"></span></a>
                    </label>
                
                    <input class="switch-field"
                                   id="uifm_frm_main_price_format_st"
                                   name="uifm_frm_main_price_format_st"
                                   type="checkbox"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                    <label for=""><?php echo __('Price decimal separator','FRocket_admin'); ?>
                    <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('it allow you choose decimal separator','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
                    </label>
                    <input type="text" 
                           class="form-control" 
                           placeholder="" 
                           name="uifm_frm_main_price_decimal"
                           id="uifm_frm_main_price_decimal"
                           >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                    <label for=""><?php echo __('Price thousand separator','FRocket_admin'); ?>
                    <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('it allow you choose decimal thousand','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
                    </label>
                    <input type="text" 
                           class="form-control" 
                           placeholder="" 
                           name="uifm_frm_main_price_thousand"
                           id="uifm_frm_main_price_thousand"
                           >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                    <label for=""><?php echo __('Price Precision for decimal places','FRocket_admin'); ?>
                    <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('it allow you choose currency precision for decimal places','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
                    </label>
                 <input  
                        class="uifm_main_spinner_1"
                        name="uifm_frm_main_price_precision"
                        id="uifm_frm_main_price_precision"
                        type="text" >
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="divider2">
            <div class="mask"></div>
            <span><i><?php echo __('Submit mode','FRocket_admin'); ?></i></span>
            </div>
        </div>
    </div>
    <div class="space10"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                    <label for="uifm_frm_main_title"><?php echo __('Ajax mode when submitting form','FRocket_admin'); ?></label>
                     <input class="switch-field"
                                   id="uifm_frm_main_ajaxmode"
                                   name="uifm_frm_main_ajaxmode"
                                   type="checkbox"/>
                     <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('You can switch the submit mode between POST and AJAX','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
            </div>
        </div>
    </div>-->
     <div class="row">
        <div class="col-md-12">
            <div class="divider2">
            <div class="mask"></div>
            <span><i><?php echo __('Import','FRocket_admin'); ?></i></span>
            </div>
        </div>
    </div>
    <div class="space10"></div>
    <div class="row">
        <div class="col-sm-1">
            <label for=""><?php echo __('Import form','FRocket_admin'); ?></label>
        </div>
        <div class="col-sm-9">
            <a href="javascript:void(0);"
               onclick="javascript:rocketform.importForm_openModal();"
               class="btn btn-warning"
               ><?php echo __('Import form','FRocket_admin'); ?></a>
            <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('Import the backuped form','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
        </div>
    </div>
    <div class="space10"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="divider2">
            <div class="mask"></div>
            <span><i><?php echo __('Custom css','FRocket_admin'); ?></i></span>
            </div>
        </div>
    </div>
    <div class="space10"></div>
    <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for=""><?php echo __('Additional css','FRocket_admin'); ?></label>
                    <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('This is not required. You can add extra css to your form. this will be added to css file ','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
                        <textarea 
                               id="uifm_frm_main_addcss"
                               name="uifm_frm_main_addcss"
                              
                               style="width:100%;"
                               class="form-control autogrow"></textarea>
                               <p class="help-block"><?php echo __('Just put the selectors. e.g. #id_form .control-label {color:red} ','FRocket_admin'); ?></p>      
                   
                </div>
            </div>
    </div>
    <div class="space10"></div>
    <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for=""><?php echo __('Additional javascript','FRocket_admin'); ?></label>
                    <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('This is not required. You can add extra javascript code or some script to your form.','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
                        <textarea 
                               id="uifm_frm_main_addjs"
                               name="uifm_frm_main_addjs"
                              
                               style="width:100%;"
                               class="form-control autogrow"></textarea>
                         <p class="help-block"><?php echo __('proceed with caution. if you put a wrong javascript code, the form will not work properly e.g. ','FRocket_admin'); ?>
                         <code>
                             <?php ob_start();?>
                        <script type="text/javascript">
                        window.onload = function () {
                            document.getElementsByClassName('uiform-step-content')[0].style.background = "red";
                        };
                        </script>
                            <?php 
                            $cntACmp = ob_get_contents();
                        ob_end_clean();
                        echo htmlentities($cntACmp);
                            ?>
                         </code>
                         </p>      
                   
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="divider2">
            <div class="mask"></div>
            <span><i><?php echo __('More options','FRocket_admin'); ?></i></span>
            </div>
        </div>
    </div>
    <div class="space10"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="col-sm-6">
            <label for=""><?php echo __('Refresh preview editor panel','FRocket_admin'); ?></label>
        </div>
        <div class="col-sm-6">
            <a href="javascript:void(0);"
               onclick="javascript:rocketform.refreshPreviewSection();"
               class="btn btn-success"
               ><?php echo __('Refresh','FRocket_admin'); ?></a>
            <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="top" 
                       data-original-title="<?php echo __('this is used in order to fix if something is not showing fine on the preview editor panel','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
        </div>
    </div>
        <div class="col-md-6">
            <div class="form-group">
                    <label for=""><?php echo __('Autoscroll after loading form  ','FRocket_admin'); ?></label>
                     <input class="switch-field"
                                   id="uifm_frm_main_onload_scroll"
                                   name="uifm_frm_main_onload_scroll"
                                   type="checkbox"/>
                     <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('if you want to stop the autoscroll when the form is loaded','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                    <label for=""><?php echo __('Enable no conflict option ','FRocket_admin'); ?></label>
                     <input class="switch-field"
                                   id="uifm_frm_main_preload_noconflict"
                                   name="uifm_frm_main_preload_noconflict"
                                   type="checkbox"/>
                     <a href="javascript:void(0);"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('if you see something weird when the form is loaded, maybe there is a conflict with your site, just enable this option','FRocket_admin'); ?>"
                       ><span class="fa fa-question-circle"></span></a>
            </div>
        </div>
        <div class="col-md-6">
            
        </div>
    </div>
</div>