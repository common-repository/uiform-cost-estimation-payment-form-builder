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
if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}
ob_start();
?>
 <div class="row">
        <div class="col-md-12">
            <div class="uifm-inforecord-box-info">
                <ul>
                    
              <?php 
             
              foreach ($record_info as $value) {
               ?>
                 <?php if(is_array($value['value'])){?>   
                 <li><b><?php echo $value['field'];?></b> 
                     <ul>
                         <?php foreach ($value['value'] as $key2 => $value2) {
                                  ?>
                         <li><?php 
                         
                         echo $value2['label'];
                         
                        if(isset($value2['qty']) && floatval($value2['qty'])>0){
                             echo ' &#8594 '.$value2['qty'].' '.__('Units','FRocket_admin').' &#8594 ';   
                            }
                         
                            if(isset($value2['qty'])&& floatval($value2['qty'])>0 && !empty($value2['label']) && floatval($value2['amount'])>0){
                                
                            } elseif( !empty($value2['label']) && floatval($value2['amount'])>0){
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
                
                </ul> 
                 <?php if(floatval($form_total_amount)>0){?>
                    <span class="uiform-inforecord-total-amount"><b><?php echo __('Total','frocket_front');?></b> : <?php echo $form_total_amount.' '.$form_currency;?></span>
                 <?php } ?>
            </div>
        </div>
        
</div>
<?php
$cntACmp = ob_get_contents();
$cntACmp = str_replace("\n", '', $cntACmp);
$cntACmp = str_replace("\t", '', $cntACmp);
$cntACmp = str_replace("\r", '', $cntACmp);
$cntACmp = str_replace("//-->", ' ', $cntACmp);
$cntACmp = str_replace("//<!--", ' ', $cntACmp);
@$cntACmp = eregi_replace("[[:space:]]+", " ", $cntACmp);
ob_end_clean();
echo $cntACmp;
?>