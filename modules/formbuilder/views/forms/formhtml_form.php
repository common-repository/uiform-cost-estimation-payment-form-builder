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
<div class="rockfm-form-container uiform-wrap">
<div class="rockfm-alert-container" style="display:none;"></div>
<form class="rockfm-form" 
      action="" 
      name="" 
      method="post" 
      enctype="multipart/form-data" 
      id="rockfm_form_<?php echo $form_id;?>">
    
    <input type="hidden" value="<?php echo $form_id;?>" class="_rockfm_form_id" name="_rockfm_form_id">
    <?php if(isset($wizard['enable_st']) 
            && intval($wizard['enable_st'])===1
            && count($wizard['tabs'])>1
            ){?>
        <input type="hidden" value="1" class="_rockfm_wizard_st" >
    <?php } else {?>
        <input type="hidden" value="0" class="_rockfm_wizard_st" >
    <?php } ?>
        
    <!--- ajax or post --->
    <?php if(isset($main['submit_ajax']) && intval($main['submit_ajax'])===1){?>
        <input type="hidden" value="1" class="_rockfm_type_submit" name="_rockfm_type_submit">
        <input type="hidden" value="rocket_front_submitajaxmode" name="action">
    <?php }else{?>
        <input type="hidden" value="0" class="_rockfm_type_submit" name="_rockfm_type_submit">
    <?php } ?>
        
     <!-- sticky content -->
       <?php if(isset($summbox['setting']['enable_st']) 
               && isset($main['price_st']) && intval($main['price_st'])===1
               && intval($summbox['setting']['enable_st'])===1){
           $tmp_sticky_pos='top';
           switch (intval($summbox['setting']['pos'])) {
               case 1:
                   $tmp_sticky_pos='right';
                   break;
               case 2:
                   $tmp_sticky_pos='left';
                   break;
               case 3:
                   $tmp_sticky_pos='bottom';
                   break;
               case 4:
                   $tmp_sticky_pos='topout';
                   break;
               case 5:
                   $tmp_sticky_pos='bottomout';
                   break;
                case 0:
               default:
                   $tmp_sticky_pos='top';
                   break;
           }
           
           ?>  
    <div  data-sticky-height=""
          
          data-sticky-pos="<?php echo $tmp_sticky_pos;?>"
          
          
          data-sticky-resp-pos="1"
           class="uiform-sticky-sidebar-box"
           style="display:none;"><?php  echo $form_sticky_content;?></div>
    <div class="uiform-sticky-topout-section"></div>
        <input type="hidden" value="1" 
           class="_rockfm_sticky_st" name="_rockfm_sticky_st">
    
        <input type="hidden" value="<?php echo __('Summary','FRocket_admin'); ?>" 
           class="_rockfm_sticky_cpt_modal_title" name="_rockfm_sticky_cpt_modal_title">
    <?php }else{ ?>
        <input type="hidden" value="0" 
           class="_rockfm_sticky_st" name="_rockfm_sticky_st">
    <?php }?>
      
    <?php if(isset($main['price_currency_symbol'])){?>
        <input type="hidden" class="_rockfm_form_price_symbol" value="<?php echo $main['price_currency_symbol'];?>">
    <?php } ?>
    <?php if(isset($main['price_currency'])){?>
        <input type="hidden" class="_rockfm_form_price_currency" value="<?php echo $main['price_currency'];?>">
    <?php } ?>    
        
    <!--/ sticky content -->
    <div class="uiform-main-form">
        <!-- sticky top section -->
        <div class="uiform-sticky-top-section"></div>
            <!--/ sticky top section -->
        <?php if(intval($tab_count)>1){
            echo $form_tab_head;
            }
          ?>
            <div class="uiform-step-content" >
                <?php  echo $form_content;?>
                <div class="clear"></div>
            </div>
            <?php 
            if(intval($tab_count)>1){
            ?>
            <?php    
            echo $form_tab_footer;
            }
            ?>
         <!-- sticky bottom section -->
        <div class="uiform-sticky-bottom-section"></div>
            <!--/ sticky bottom section -->
    </div>
    <!-- sticky bottom out section -->
    <div class="uiform-sticky-bottomout-section"></div>
    <!--/ sticky bottom out section -->
    
    
        <input type="hidden" class="rockfm_main_data" value="<?php echo htmlentities(json_encode($main)); ?>">
   
    <div class="space10"></div>
     
</form>
 <?php if(isset($main['add_js']) && !empty($main['add_js'])){?>
  <!-- Additional javascript -->
<?php echo stripslashes(urldecode($main['add_js']));?>
    <!-- adittional javascript -->
<?php } ?>
  <!-- Modal -->
<div class="modal fade uiform_modal_general"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title"></h4>

            </div>
            <div class="modal-body"><div class="te"></div></div>
            <div class="modal-footer">
                <button type="button" 
                        class="btn btn-default"
                        data-dismiss="modal"><?php echo __('Close','FRocket_admin'); ?></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->  
</div>
<?php
$cntACmp = ob_get_contents();
$cntACmp = str_replace("\n", '', $cntACmp);
$cntACmp = str_replace("\t", '', $cntACmp);
$cntACmp = str_replace("\r", '', $cntACmp);
$cntACmp = str_replace("//-->", ' ', $cntACmp);
$cntACmp = str_replace("//<!--", ' ', $cntACmp);
//$cntACmp = preg_replace('/\s+/',' ', $cntACmp);
//$cntACmp = Uiform_Form_Helper::remove_non_tag_space($cntACmp);
ob_end_clean();
echo $cntACmp;
?>