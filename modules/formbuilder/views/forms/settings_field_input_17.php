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

<div class="uifm-set-section-input17">
   
<div class="uifm-set-section-input17-optbox">
    <div class="row">
        <div class="col-md-6">
           <label ><?php echo __('Image Height','FRocket_admin'); ?></label>
            <input  
                class="uifm-f-setoption uifm_fld_inp17_thopt_spinner"
            id="uifm_fld_inp17_thopt_height"
            data-field-store="input17-thopt_height"
            type="text" >
                                   
        </div>
        <div class="col-md-6">
               <label ><?php echo __('Image width','FRocket_admin'); ?></label>
            <input  
                class="uifm-f-setoption uifm_fld_inp17_thopt_spinner"
            id="uifm_fld_inp17_thopt_width"
            data-field-store="input17-thopt_width"
            type="text" >
        </div>
    </div>
    <div class="space10"></div>
    <div class="row">
        <div class="col-md-12">
            <a href="javascript:void(0);"
               onclick="javascript:rocketform.input17settings_addNewOption();"
               class="btn btn-sm btn-success"
               ><?php echo __('Add new option','FRocket_admin'); ?></a>
            <button onclick="javascript:rocketform.input17settings_deleteAllOptions();" 
                    class="btn btn-sm btn-danger">
             <i class="fa fa-trash-o"></i> <?php echo __('Remove all options','FRocket_admin'); ?></button>
        </div>
        </div>
       <div class="row">
            <div class="col-md-12">
                <div id="uifm-fld-inp17-options-container">
                        
                </div>
            </div>
        </div>
      
   </div>
</div>
<!--  template option--->
<div id="uifm_frm_inp17_templates" style="display:none;">
    <div class="uifm-fld-inp17-options-row clearfix" data-opt-index="0">
        <div class="col-md-1">
            <input type="checkbox" 
                   data-option-store="checked"
                   onclick="javascript:rocketform.input17settings_enableCheckOption(this);"
                   value="1" class="uifm_frm_inp17_opt_ckeck">
            <div class="space10"></div>
                <a onclick="javascript:rocketform.input17settings_deleteOption(this);"
                   class="btn btn-sm btn-danger" href="javascript:void(0);">
                    <i class="fa fa-trash-o"></i> 
                </a>

        </div>
        <div class="col-md-11">
            <div class="col-md-12">
                <div class="col-md-12">
                    <textarea 
                        onkeyup="rocketform.input17settings_onChangeOption(this);"
                    onfocus="rocketform.input17settings_onChangeOption(this);"
                    onchange="rocketform.input17settings_onChangeOption(this);"
                        data-option-store="label"
                        class="form-control autogrow uifm_frm_inp17_opt_label" 
                        style="width: 100%; height: 34px;" 
                        placeholder="Type your content" ></textarea>
                </div>

            </div>
            <div class="space10"></div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <label><?php echo __('Price per unit','FRocket_admin'); ?></label>
                </div>
                    <div class="col-md-6">
                    <input type="text"
                           onkeyup="rocketform.input17settings_onChangeOption(this);"
                    onfocus="rocketform.input17settings_onChangeOption(this);"
                    onchange="rocketform.input17settings_onChangeOption(this);"
                           data-option-store="price"
                           placeholder="Price" 
                           class="uifm_frm_inp17_opt_price col-md-12">
                </div>
            </div>
            <div class="space10"></div>
            <div class="col-md-12">
                <div class="col-md-6">
                        <div class="form-group">
                        <label><?php echo __('Enable quantity','FRocket_admin'); ?></label>
                        <input 
                            class="switch-field-17 uifm_frm_inp17_opt_qty_st"
                            type="checkbox"/>
                    </div>

                </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo __('Maximum quantity','FRocket_admin'); ?></label>
                         <input  
                            class="uifm_fld_inp17_spinner uifm_frm_inp17_opt_qty_max"
                            type="text"
                            value="2">
                    </div>
                </div>
            </div>
            <div class="space10"></div>
            <div class="col-md-12">
                <div class="col-md-12">
                        <div class="form-group">
                        <label><?php echo __('Images','FRocket_admin'); ?></label>
                        <a href="javascript:void(0);" class="btn btn-sm btn-success"
                    onclick="javascript:rocketform.input17settings_addNewImg(this);">
                    <i class="fa fa-plus-square"></i> <?php echo __('Add new','FRocket_admin'); ?>
                </a>
                        <div class="space10"></div>
                        <div class="uifm_frm_inp17_opt_img_list_wrap clearfix">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="uifm_frm_inp17_opt_imgwrap clearfix" data-opt-index="0" >
        <div class="col-md-3">
        <div class="uifm_frm_inp17_opt_imgitem">
            <img class="img-thumbnail" src="">
            <div class="uifm_frm_inp17_opt_imgitem_addsrc">
                <a href="javascript:void(0);" class="btn btn-sm btn-info"
                    onclick="javascript:rocketform.input17settings_changeSrcImg(this);">
                    <i class="fa fa-pencil-square-o"></i> 
                </a>
            </div>
        </div>
        </div>
        <div class="col-md-8">
            <textarea class="form-control autogrow uifm_frm_inp17_opt_imgitem_title"
                      onkeyup="rocketform.input17settings_labelOption(this);"
                    onfocus="rocketform.input17settings_labelOption(this);"
                    onchange="rocketform.input17settings_labelOption(this);"
                              style="width: 100%; height: 34px;" 
                              placeholder="Type your content" ></textarea>
        </div>
        <div class="col-md-1">
            
        </div>
            <div class="uifm_frm_inp17_opt_imgitem_del">
                <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                    onclick="javascript:rocketform.input17settings_delImglistIndex(this);">
                    <i class="fa fa-trash-o"></i> 
                </a>
            </div>
    </div>
    <!--  item --->
                                    <div 
                                        data-gal-id="blueimp-gallery" 
                                        data-backend="1"
                                        data-opt-label=""
                                        data-opt-checked=""
                                        data-opt-price=""
                                        data-opt-qtyst=""
                                        data-opt-qtymax=""
                                        data-inp17-opt-index="0"
                                        data-toggle="tooltip" data-placement="bottom" data-html="true" title="Checkbox content"
                                        class="uifm-dcheckbox-item">
                                        <div class="uifm-dcheckbox-item-wrap">
                                            
                                            <div class="uifm-dcheckbox-item-chkst btn-default">
                                                <i class="fa fa-square-o"></i>
                                            </div>
                                            <div style="display:none" class="uifm-dcheckbox-item-qty-wrap">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default" data-value="decrease">
                                                            <span class="glyphicon glyphicon-minus"></span>
                                                        </button>
                                                    </span>
                                                    <span class="input-group-btn">
                                                        <input type="text" 
                                                               data-max="40"
                                                               data-min="1"
                                                               class="uifm-dcheckbox-item-qty-num" value="1">   
                                                    </span>
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default" data-value="increase">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="uifm-dcheckbox-item-showgallery  btn-primary">
                                              <i class="glyphicon glyphicon-search"></i>
                                            </div>
                                            <div class="uifm-dcheckbox-item-nextimg btn-primary">
                                                <i class="fa fa-chevron-right"></i>
                                            </div>
                                            <div class="uifm-dcheckbox-item-previmg btn-primary">
                                                <i class="fa fa-chevron-left"></i>
                                            </div>
                                            <div style="display: none;">
                                                <input class="uifm-dcheckbox-item-chkval" type="checkbox"  value="0">
                                            </div>
                                            <!-- image gallery -->
                                            <div style="display:none;">
                                                <div class="uifm-dcheckbox-item-gal-imgs">
                                               </div>
                                            </div>
                                            <canvas 
                                                data-uifm-nro="0"
                                                width="100" height="100" class="uifm-dcheckbox-item-viewport"></canvas>
                                        </div>
                                    </div>
    <div 
                                        data-gal-id="blueimp-gallery" 
                                        data-backend="1"
                                        data-opt-isrdobtn="1"
                                        data-opt-label=""
                                        data-opt-checked=""
                                        data-opt-price=""
                                        data-opt-qtyst=""
                                        data-opt-qtymax=""
                                        data-inp17-opt-index="0"
                                        data-toggle="tooltip" data-placement="bottom" data-html="true" title="Checkbox content"
                                        class="uifm-dradiobtn-item">
                                        <div class="uifm-dcheckbox-item-wrap">
                                            
                                            <div class="uifm-dcheckbox-item-chkst btn-default">
                                                <i class="fa fa-check-circle-o"></i>
                                            </div>
                                            <div style="display:none" class="uifm-dcheckbox-item-qty-wrap">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default" data-value="decrease">
                                                            <span class="glyphicon glyphicon-minus"></span>
                                                        </button>
                                                    </span>
                                                    <span class="input-group-btn">
                                                        <input type="text" 
                                                               data-max="40"
                                                               data-min="1"
                                                               class="uifm-dcheckbox-item-qty-num" value="1">   
                                                    </span>
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default" data-value="increase">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="uifm-dcheckbox-item-showgallery  btn-primary">
                                              <i class="glyphicon glyphicon-search"></i>
                                            </div>
                                            <div class="uifm-dcheckbox-item-nextimg btn-primary">
                                                <i class="fa fa-chevron-right"></i>
                                            </div>
                                            <div class="uifm-dcheckbox-item-previmg btn-primary">
                                                <i class="fa fa-chevron-left"></i>
                                            </div>
                                            <div style="display: none;">
                                                <input class="uifm-dcheckbox-item-chkval" type="checkbox"  value="0">
                                            </div>
                                            <!-- image gallery -->
                                            <div style="display:none;">
                                                <div class="uifm-dcheckbox-item-gal-imgs">
                                               </div>
                                            </div>
                                            <canvas 
                                                data-uifm-nro="0"
                                                width="100" height="100" class="uifm-dcheckbox-item-viewport"></canvas>
                                        </div>
                                    </div>
                                    <!--/ end item --->
    <a 
                data-inp17-opt2-index="0"
                href="" 
                class="uifm-dcheckbox-item-imgsrc"
                title="" data-gallery="">
                <img src=""></a>
   
</div>
<!--/ template option--> 
