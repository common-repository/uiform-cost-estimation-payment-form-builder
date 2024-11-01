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
<div id="uiform-container" class="uiform-wrap uiform-page_records">
    <input type="hidden" id="rec_id" value="<?php echo $record_id;?>">
    
    <div id="uiform-inforecord-container">
         <div class="space20"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="uifm-inforecord-box-info clearfix">
                <h3><?php echo __('Submitted form data','FRocket_admin');?></h3>
                <ul>
              <?php foreach ($record_info as $value) {
               ?>
                 <?php if(is_array($value['value'])){?>   
                 <li><b><?php echo $value['field'];?></b> 
                     <ul>
                         <?php foreach ($value['value'] as $key2 => $value2) {
                                  ?>
                         <li><?php 
                         
                         echo $value2['label'];
                            if(isset($value2['qty']) && floatval($value2['qty'])>0){
                             echo ' - '.$value2['qty'].' '.__('Units','FRocket_admin').' - ';   
                            }
                         
                            if(isset($value2['qty'])&& isset($value2['amount'])&& floatval($value2['qty'])>0 && !empty($value2['label']) && floatval($value2['amount'])>0){
                                
                            } elseif( !empty($value2['label']) && isset($value2['amount']) && floatval($value2['amount'])>0){
                             echo ' : ';   
                            }else{
                             
                            }
                         ?>
                             <?php if(isset($value2['amount']) && floatval($value2['amount'])>0){?>
                              <?php echo $value2['amount'].' '.$form_currency;?>
                            <?php } ?>
                         </li>
                         
                            <?php }?>
                     </ul>
                 </li>
                 <?php }else{ ?>
                 <li><b><?php echo $value['field'];?></b> : <?php echo $value['value'];?></li>
                 <?php }?>
              <?php  
                }?>
                 <?php if(floatval($form_total_amount)>0){?>
                    <li><span class="uiform-inforecord-total-amount"><b><?php echo __('Total','FRocket_admin');?></b> : <?php echo $form_total_amount.' '.$form_currency;?></span></li>
                 <?php } ?>
                </ul>    
            </div>
        </div>
        <div class="col-md-6">
            <div class="uifm-inforecord-box-info2">
                <h3><?php echo __('Additional info','FRocket_admin');?></h3>
                <ul >
                    <li>
                        <b><?php echo __('Date','FRocket_admin');?></b>:
                        <span><?php echo $info_date;?></span>
                    </li>
                    <li>
                        <b><?php echo __('IP','FRocket_admin');?></b>:
                        <span><?php echo $info_ip;?></span>
                    </li>
                    <li>
                        <b><?php echo __('Client PC info','FRocket_admin');?></b>:
                        <span ><?php echo $info_useragent;?></span>
                    </li>
                    <li>
                        <b><?php echo __('URL page','FRocket_admin');?></b>:
                        <span><?php echo $info_referer;?></span>
                    </li>
                    <li>
                        <b><?php echo __('Form name','FRocket_admin');?></b>:
                        <span><?php echo $form_name;?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    <div class="space10"></div>
   <div class="row">
       <div class="col-md-12">
<a 
    href="javascript:void(0);"
    onclick="javascript:rocketform.genpdf_inforecord(<?php echo $record_id;?>);"
    class="btn btn-warning"><i class="fa fa-file-pdf-o"></i> <?php echo __('Export to PDF','FRocket_admin');?> <span class="rkfm-express-lock-wrap"
                       data-toggle="tooltip" data-placement="right" 
                       data-original-title="<?php echo __('feature locked','FRocket_admin'); ?>"
                       ><i class="fa fa-lock"></i></span></a>
       </div>
   </div>
</div>