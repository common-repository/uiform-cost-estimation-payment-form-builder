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
<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        <?php echo __('Previous','FRocket_admin'); ?>
                    </button>
                    <button type="button" class="btn btn-primary next">
                        <?php echo __('Next','FRocket_admin'); ?>
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--\ Fields templates -->
<div id="uiform-fields-templates" style="display:none;">
<?php ob_start();?>
<div class="uiform-fields-quick-options">
                <div class="uiform-fields-quick-options-wrap">
                    <a href="javascript:void(0);"
                       title="<?php echo __('Multiple select','FRocket_admin'); ?>"
                       class="uiform-fields-qopt-select">
                        <span class="uiform-field-qopt-block"><input type="checkbox" value="1"></span></a>
                    <a href="javascript:void(0);" title="<?php echo __('Move field block','FRocket_admin'); ?>" class="uiform-fields-qopt-move">
                        <span class="uiform-field-qopt-block"><i class="fa fa-arrows"></i><span><?php echo __('Block','FRocket_admin'); ?></span></span></a>
                    <a href="javascript:void(0);" onclick="javascript:rocketform.fieldQuickOptions_EditField(this);" title="<?php echo __('Edit','FRocket_admin'); ?>" class="uiform-fields-qopt-move">
                        <span class="uiform-field-qopt-block"><i class="fa fa-pencil"></i></span></a>    
                     <a href="javascript:void(0);" onclick="javascript:rocketform.fieldQuickOptions_DuplicateField(this);" title="<?php echo __('Duplicate','FRocket_admin'); ?>" class="uiform-fields-qopt-copy">
                        <span class="uiform-field-qopt-block"><i class="fa fa-files-o"></i></span></a>   
                    <a href="javascript:void(0);" onclick="javascript:rocketform.fieldsetting_deleteFieldFromPreview(this);" title="<?php echo __('Remove','FRocket_admin'); ?>" class="uiform-fields-qopt-remove">
                        <span class="uiform-field-qopt-block"><i class="fa fa-trash-o"></i></span></a>    
                </div>
        </div>
<?php $tmp_fields_quick_opts = ob_get_contents();
ob_end_clean();?>
<?php ob_start();?>
<div class="uiform-fields-quick-options2">
                <div class="uiform-fields-quick-options-wrap">

                    <a href="javascript:void(0);" title="<?php echo __('Move field block','FRocket_admin'); ?>" class="uiform-fields-qopt-move">
                        <span class="uiform-field-qopt-block"><i class="fa fa-arrows"></i><span><?php echo __('Block','FRocket_admin'); ?></span></span></a> 
                    <a href="javascript:void(0);" onclick="javascript:rocketform.fieldsetting_deleteFieldFromPreview(this);" title="<?php echo __('Remove','FRocket_admin'); ?>" class="uiform-fields-qopt-remove">
                        <span class="uiform-field-qopt-block"><i class="fa fa-trash-o"></i></span></a>    
                </div>
        </div>
<?php $tmp_fields_quick_opts2 = ob_get_contents();
ob_end_clean();?>   
  
    <!--\ Standard Fields -->
    <!--\ textbox -->
        <div id=""  data-typefield="6" class="uiform-textbox uiform-field uiform-field-childs">
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
                                      class="uifm-label uifm-f-option"><?php echo __('Textbox label','FRocket_admin'); ?></span>
                               <span data-field-store="sublabel-text"
                                      data-field-option="uifm-sublabel"
                                      class="uifm-sublabel uifm-f-option"><?php echo __('Textbox sublabel','FRocket_admin'); ?></span>
                            </label>
                        </div>
                    </div>
                    <div class="rkfm-col-sm-10">
                        <div class="uifm-input-container">
                            <input data-field-store="input-value"
                                   data-field-option="uifm-txtbox-inp-val"
                                   class="uifm-txtbox-inp-val form-control uifm-f-option"
                                   type="text" value="">
                        </div>
                        <div data-field-option="uifm-help-block"  class="uifm-help-block uifm-f-option">
                            <?php echo __('Help block text','FRocket_admin'); ?>
                        </div>
                    </div>
                </div>
                <?php echo $tmp_fields_quick_opts;?>
            </div>
        </div>
    <!--\ Textarea -->
        <div id=""  data-typefield="7" class="uiform-textarea uiform-field uiform-field-childs">
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
                
                <?php echo $tmp_fields_quick_opts;?>
            </div>
        </div>
     <!--\ radio button -->
        <div id=""  data-typefield="8" class="uiform-radiobtn uiform-field uiform-field-childs">
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
                                      class="uifm-label uifm-f-option"><?php echo __('Textbox label','FRocket_admin'); ?></span>
                               <span data-field-store="sublabel-text"
                                      data-field-option="uifm-sublabel"
                                      class="uifm-sublabel uifm-f-option"><?php echo __('Textbox sublabel','FRocket_admin'); ?></span>
                            </label>
                             
                        </div>
                    </div>
                    <div class="rkfm-col-sm-10">
                        <div class="uifm-input-container">
                            <div class="uifm-input2-wrap">
                                <div class="radio" data-inp2-opt-index="0">
                                    <label>
                                        <input class="uifm-inp2-rdo" type="radio"
                                            value="" 
                                            name="" 
                                             >
                                        <span class="uifm-inp2-label  uifm-input2-opt-main"><?php echo __('option','FRocket_admin'); ?> 1</span>
                                        <span class="uifm_frm_price_lbl_cont"></span>
                                    </label>
                                 </div>
                                <div class="radio" data-inp2-opt-index="1">
                                    <label>
                                        <input class="uifm-inp2-rdo" type="radio"
                                            value="" 
                                            name="" 
                                            >
                                        <span class="uifm-inp2-label  uifm-input2-opt-main"><?php echo __('option','FRocket_admin'); ?> 2</span>
                                        <span class="uifm_frm_price_lbl_cont"></span>
                                    </label>
                                 </div>
                                <div class="radio" data-inp2-opt-index="2">
                                    <label>
                                        <input class="uifm-inp2-rdo" type="radio" 
                                            value="" 
                                            name="" 
                                             >
                                        <span class="uifm-inp2-label  uifm-input2-opt-main"><?php echo __('option','FRocket_admin'); ?> 3</span>
                                        <span class="uifm_frm_price_lbl_cont"></span>
                                    </label>
                                 </div>
                            </div>
                        </div>
                        <div data-field-option="uifm-help-block"  class="uifm-help-block uifm-f-option">
                            <?php echo __('Help block text','FRocket_admin'); ?>
                        </div>
                    </div>
                </div>
                <?php echo $tmp_fields_quick_opts;?>
            </div>
        </div>
     <!-- checkbox -->
     <div id=""  data-typefield="9" class="uiform-checkbox uiform-field uiform-field-childs">
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
                                      class="uifm-label uifm-f-option"><?php echo __('Textbox label','FRocket_admin'); ?></span>
                               <span data-field-store="sublabel-text"
                                      data-field-option="uifm-sublabel"
                                      class="uifm-sublabel uifm-f-option"><?php echo __('Textbox sublabel','FRocket_admin'); ?></span>
                            </label>
                             
                        </div>
                    </div>
                    <div class="rkfm-col-sm-10">
                        <div class="uifm-input-container">
                            <div class="uifm-input2-wrap">
                                <div class="checkbox" data-inp2-opt-index="0">
                                    <label>
                                        <input class="uifm-inp2-rdo" type="checkbox"
                                            value="" 
                                            name="" 
                                             >
                                        <span class="uifm-inp2-label  uifm-input2-opt-main"><?php echo __('option','FRocket_admin'); ?> 1</span>
                                        <span class="uifm_frm_price_lbl_cont"></span>
                                    </label>
                                 </div>
                                <div class="checkbox" data-inp2-opt-index="1">
                                    <label>
                                        <input class="uifm-inp2-rdo" type="checkbox"
                                            value="" 
                                            name="" 
                                            >
                                        <span class="uifm-inp2-label  uifm-input2-opt-main"><?php echo __('option','FRocket_admin'); ?> 2</span>
                                        <span class="uifm_frm_price_lbl_cont"></span>
                                    </label>
                                 </div>
                                <div class="checkbox" data-inp2-opt-index="2">
                                    <label>
                                        <input class="uifm-inp2-rdo" type="checkbox" 
                                            value="" 
                                            name="" 
                                             >
                                        <span class="uifm-inp2-label  uifm-input2-opt-main"><?php echo __('option','FRocket_admin'); ?> 3</span>
                                        <span class="uifm_frm_price_lbl_cont"></span>
                                    </label>
                                 </div>
                            </div>
                        </div>
                        <div data-field-option="uifm-help-block"  class="uifm-help-block uifm-f-option">
                            <?php echo __('Help block text','FRocket_admin'); ?>
                        </div>
                    </div>
                </div>
                <?php echo $tmp_fields_quick_opts;?>
            </div>
        </div>
     <!-- select -->
     <div id=""  data-typefield="10" class="uiform-select uiform-field uiform-field-childs">
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
                                      class="uifm-label uifm-f-option"><?php echo __('Textbox label','FRocket_admin'); ?></span>
                               <span data-field-store="sublabel-text"
                                      data-field-option="uifm-sublabel"
                                      class="uifm-sublabel uifm-f-option"><?php echo __('Textbox sublabel','FRocket_admin'); ?></span>
                            </label>
                             
                        </div>
                    </div>
                    <div class="rkfm-col-sm-10">
                        <div class="uifm-input-container">
                            <div class="uifm-input2-wrap">
                                <select class="form-control uifm-input2-opt-main" >
                                    <option data-inp2-opt-index="0" > <?php echo __('option','FRocket_admin'); ?> 1 </option> 
                                    <option data-inp2-opt-index="1"> <?php echo __('option','FRocket_admin'); ?> 2 </option> 
                                    <option data-inp2-opt-index="2"> <?php echo __('option','FRocket_admin'); ?> 3 </option> 
                                </select>
                                <span class="uifm_frm_price_lbl_cont"></span>
                            </div>
                        </div>
                        <div data-field-option="uifm-help-block"  class="uifm-help-block uifm-f-option">
                            <?php echo __('Help block text','FRocket_admin'); ?>
                        </div>
                    </div>
                </div>
                <?php echo $tmp_fields_quick_opts;?>
            </div>
        </div>
     <!-- multiselect -->
     <div id=""  data-typefield="11" class="uiform-multiselect uiform-field uiform-field-childs">
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
                                      class="uifm-label uifm-f-option"><?php echo __('Textbox label','FRocket_admin'); ?></span>
                               <span data-field-store="sublabel-text"
                                      data-field-option="uifm-sublabel"
                                      class="uifm-sublabel uifm-f-option"><?php echo __('Textbox sublabel','FRocket_admin'); ?></span>
                            </label>
                             
                        </div>
                    </div>
                    <div class="rkfm-col-sm-10">
                        <div class="uifm-input-container">
                            <div class="uifm-input2-wrap">
                                <select class="form-control uifm-input2-opt-main" multiple >
                                    <option data-inp2-opt-index="0" > 
                                        <?php echo __('option','FRocket_admin'); ?> 1 
                                    </option> 
                                    <option data-inp2-opt-index="1"> <?php echo __('option','FRocket_admin'); ?> 2 </option> 
                                    <option data-inp2-opt-index="2"> <?php echo __('option','FRocket_admin'); ?> 3 </option> 
                                </select>
                                <span class="uifm_frm_price_lbl_cont"></span>
                            </div>
                        </div>
                        <div data-field-option="uifm-help-block"  class="uifm-help-block uifm-f-option">
                            <?php echo __('Help block text','FRocket_admin'); ?>
                        </div>
                    </div>
                </div>
                <?php echo $tmp_fields_quick_opts;?>
            </div>
        </div>
   <!-- slider -->
     <div id=""  data-typefield="16" class="uiform-slider uiform-field uiform-field-childs">
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
                                      class="uifm-label uifm-f-option"><?php echo __('Textbox label','FRocket_admin'); ?></span>
                               <span data-field-store="sublabel-text"
                                      data-field-option="uifm-sublabel"
                                      class="uifm-sublabel uifm-f-option"><?php echo __('Textbox sublabel','FRocket_admin'); ?></span>
                            </label>
                             
                        </div>
                    </div>
                    <div class="rkfm-col-sm-10">
                        <div class="uifm-input-container">
                                <div class="uifm-input4-wrap">
                                    <div class="uifm-inp4-number"></div>
                                    <input class="uifm-inp4-fld" 
                                           type="text"
                                           data-check-hash=""
                                           />
                                </div>
                            <span class="uifm_frm_price_lbl_cont"></span>
                        </div>
                        <div data-field-option="uifm-help-block"  class="uifm-help-block uifm-f-option">
                            <?php echo __('Help block text','FRocket_admin'); ?>
                        </div>
                    </div>
                </div>
                <?php echo $tmp_fields_quick_opts;?>
            </div>
        </div>
     <!-- range -->
     <div id=""  data-typefield="17" class="uiform-range uiform-field uiform-field-childs">
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
                                      class="uifm-label uifm-f-option"><?php echo __('Textbox label','FRocket_admin'); ?></span>
                               <span data-field-store="sublabel-text"
                                      data-field-option="uifm-sublabel"
                                      class="uifm-sublabel uifm-f-option"><?php echo __('Textbox sublabel','FRocket_admin'); ?></span>
                            </label>
                             
                        </div>
                    </div>
                    <div class="rkfm-col-sm-10">
                        <div class="uifm-input-container">
                                <div class="uifm-input4-wrap">
                                    <input 
                                           type="text" 
                                           class="uifm-inp4-fld" 
                                           data-check-hash=""
                                           />
                                </div>
                        </div>
                        <div data-field-option="uifm-help-block"  class="uifm-help-block uifm-f-option">
                            <?php echo __('Help block text','FRocket_admin'); ?>
                        </div>
                    </div>
                </div>
                <?php echo $tmp_fields_quick_opts;?>
            </div>
        </div>
     <!-- spinner -->
     <div id=""  data-typefield="18" class="uiform-spinner uiform-field uiform-field-childs">
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
                                      class="uifm-label uifm-f-option"><?php echo __('Textbox label','FRocket_admin'); ?></span>
                               <span data-field-store="sublabel-text"
                                      data-field-option="uifm-sublabel"
                                      class="uifm-sublabel uifm-f-option"><?php echo __('Textbox sublabel','FRocket_admin'); ?></span>
                            </label>
                             
                        </div>
                    </div>
                    <div class="rkfm-col-sm-10">
                        <div class="uifm-input-container">
                                <div class="uifm-input4-wrap">
                                   <input class="uifm-inp4-fld"
                                          type="text"
                                          data-check-hash="">
                                   
                                </div>
                            <span class="uifm_frm_price_lbl_cont"></span>
                        </div>
                        <div data-field-option="uifm-help-block"  class="uifm-help-block uifm-f-option">
                            <?php echo __('Help block text','FRocket_admin'); ?>
                        </div>
                    </div>
                </div>
                <?php echo $tmp_fields_quick_opts;?>
            </div>
        </div>
  
   <!-- Submit button -->
     <div id=""  data-typefield="20" class="uiform-submitbtn uiform-field uiform-field-childs">
            <div class="uiform-field-wrap uiform-field-move">
                <div class="rkfm-row">
                    <div class="rkfm-col-sm-2" style="display: none;">
                        <div class="uifm-control-label">
                            <label class="control-label">
                                <span 
                                   data-field-option="uifm-help-block"
                                    class="uifm-label-helpblock uifm-f-option">
                                    <span class="fa fa-question-circle"></span>
                                </span> 
                               <span  data-field-store="label-text"
                                      data-field-option="uifm-label"
                                      class="uifm-label uifm-f-option"><?php echo __('Textbox label','FRocket_admin'); ?></span>
                               <span data-field-store="sublabel-text"
                                      data-field-option="uifm-sublabel"
                                      class="uifm-sublabel uifm-f-option"><?php echo __('Textbox sublabel','FRocket_admin'); ?></span>
                            </label>
                        </div>
                    </div>
                    <div class="rkfm-col-sm-10">
                        <div class="uifm-input-container">
                            
                               <input 
                                   class="btn uifm-txtbox-inp-val"
                                   type="submit" 
                                   value="Submit button">
                        </div>
                        <div data-field-option="uifm-help-block"  style="display: none;" class="uifm-help-block uifm-f-option">
                            <?php echo __('Help block text','FRocket_admin'); ?>
                        </div>
                    </div>
                </div>
                <?php echo $tmp_fields_quick_opts;?>
            </div>
        </div>
  
   <!-- heading 1 -->
     <div id=""  data-typefield="33" class="uiform-heading1 uiform-field uiform-field-childs">
            <div class="uiform-field-wrap uiform-field-move">
                <div class="rkfm-row">
                    <div class="rkfm-col-sm-2" style="display: none;">
                        <div class="uifm-control-label">
                            <label class="control-label">
                                <span 
                                   data-field-option="uifm-help-block"
                                    class="uifm-label-helpblock uifm-f-option">
                                    <span class="fa fa-question-circle"></span>
                                </span> 
                               <span  data-field-store="label-text"
                                      data-field-option="uifm-label"
                                      class="uifm-label uifm-f-option"><?php echo __('Textbox label','FRocket_admin'); ?></span>
                               <span data-field-store="sublabel-text"
                                      data-field-option="uifm-sublabel"
                                      class="uifm-sublabel uifm-f-option"><?php echo __('Textbox sublabel','FRocket_admin'); ?></span>
                            </label>
                        </div>
                    </div>
                    <div class="rkfm-col-sm-10">
                        <div class="uifm-input-container">
                            <div class="uifm-input-heading-wrap">
                                <h1 class="uifm-txtbox-inp-val"><?php echo __('Type your heading H1 here','FRocket_admin'); ?></h1>
                            </div>
                        </div>
                        <div data-field-option="uifm-help-block"  style="display: none;" class="uifm-help-block uifm-f-option">
                            <?php echo __('Help block text','FRocket_admin'); ?>
                        </div>
                    </div>
                </div>
                <?php echo $tmp_fields_quick_opts;?>
            </div>
        </div>
 
   <!-- Modal -->
<div class="modal fade" id="modaltemplate" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
              <span class="fa fa-question-circle"></span>
            </h4>
         </div>
         <div class="modal-body">
           
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" 
               data-dismiss="modal"><?php echo __('Close','FRocket_admin'); ?>
            </button>
           
         </div>
      </div><!-- /.modal-content -->
</div>
</div><!-- /.modal --> 

</div><!--\ Fields templates -->
   
   