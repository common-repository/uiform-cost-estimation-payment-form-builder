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
    <div class="col-sm-12">
        <div class="uifm_invoice_container">
            <h3><?php echo __('Invoice','frocket_front');?> #<?php echo $invoice_id; ?></h3>
            <span class="invoice_date"><?php echo __('Date','frocket_front');?>:<?php echo $invoice_date; ?></span>
            <br>
            <div class="row"  style="margin-top:20px;">
                <div class="col-sm-6">
                    <ul class="uifm_invoice_list_from">
                        <li>
                            <b><?php echo __('From','frocket_front');?></b>
                        </li>
                        <?php if(!empty($invoice_from_info1)){?>
                        <li>
                            <?php echo $invoice_from_info1; ?>
                        </li>
                        <?php }?>
                        <?php if(!empty($invoice_from_info2)){?>
                        <li>
                            <?php echo $invoice_from_info2; ?>
                        </li>
                        <?php }?>
                        <?php if(!empty($invoice_from_info3)){?>
                        <li>
                            <?php echo $invoice_from_info3; ?>
                        </li>
                        <?php }?>
                        <?php if(!empty($invoice_from_info4)){?>
                        <li>
                            <?php echo $invoice_from_info4; ?>
                        </li>
                        <?php }?>
                        <?php if(!empty($invoice_from_info5)){?>
                        <li>
                            <?php echo $invoice_from_info5; ?>
                        </li>
                        <?php }?>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="uifm_invoice_list_from">
                        <li>
                            <b><?php echo __('To','frocket_front');?></b>
                        </li>
                         <?php if(!empty($invoice_to_info1)){?>
                        <li>
                            <?php echo $invoice_to_info1; ?>
                        </li>
                        <?php }?>
                        <?php if(!empty($invoice_to_info2)){?>
                        <li>
                            <?php echo $invoice_to_info2; ?>
                        </li>
                        <?php }?>
                        <?php if(!empty($invoice_to_info3)){?>
                        <li>
                            <?php echo $invoice_to_info3; ?>
                        </li>
                        <?php }?>
                        <?php if(!empty($invoice_to_info4)){?>
                        <li>
                            <?php echo $invoice_to_info4; ?>
                        </li>
                        <?php }?>
                        <?php if(!empty($invoice_to_info5)){?>
                        <li>
                            <?php echo $invoice_to_info5; ?>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="table-responsive table-bordered  ">
        <table id="table-invoice" class="table table-striped dataTable" style="table-layout : fixed;" width="100%" >
            <tbody>
               
                <tr>
                    <th  style="width:10%;"><?php echo __('Item ID','frocket_front');?></th>
                    <th  style="width:15%;" ><?php echo __('Quantity','frocket_front');?></th>
                    <th  style="" ><?php echo __('Description','frocket_front');?></th>
                    <th  style="width:15%;"><?php echo __('Amount','frocket_front');?></th>
                </tr>
             </tbody> 
            <tbody>
                <?php if(!empty($record_info)){
                        foreach ($record_info as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?php echo $value['item_id'];?></td>
                                        <td><?php echo $value['item_qty'];?></td>
                                        <td><?php echo $value['item_desc'];?></td>
                                        <td><?php echo $value['item_amount'];?></td>
                                    </tr> 
                            <?php
                        }
                    ?>
                <?php }?>
                    </tbody>    
            <tfoot>
                <tr>
                    <th colspan="3" class="invoice_total_txt">
                        <?php echo __('Invoice Total','frocket_front');?>
                    </th>
                    <th class="uifm_invoice_amount_total">
                    <?php echo $form_total_amount; ?> <?php echo $form_currency; ?>
                    </th>
                </tr>
            </tfoot>
        </table>
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