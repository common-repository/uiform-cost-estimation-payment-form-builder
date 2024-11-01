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
<div class="uiform-wrap">
    <div class="uiform-editing-dashboard">
        
    
    <div class="uiformc-menu-wrap">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#uiformc-menu-sec1"><?php echo __('Form editor','FRocket_admin'); ?></a></li>
            <li><a data-toggle="tab"
                   class="uiform-settings-email"
                   data-intro="<?php echo __('email section. you can set mail options. e.g. the recipient mail','FRocket_admin');?>"
                   href="#uiformc-menu-sec2"><?php echo __('Email Settings','FRocket_admin'); ?></a></li>
            <li><a data-toggle="tab"
                   class="uiform-settings-subm"
                   data-intro="<?php echo __('submission section. you can modify the success message and other messages','FRocket_admin');?>"
                   href="#uiformc-menu-sec3"><?php echo __('On Submission','FRocket_admin'); ?></a></li>
            <li><a data-toggle="tab"
                   class="uiform-settings-invoice"
                   data-intro="<?php echo __('configure your invoice','FRocket_admin');?>"
                   href="#uiformc-menu-sec4"><?php echo __('Invoice','FRocket_admin'); ?></a></li>       
            <li><a data-toggle="tab"
                   class="uiform-settings-main"
                   data-intro="<?php echo __('main settings','FRocket_admin');?>"
                   href="#uiformc-menu-sec5"><?php echo __('Main settings','FRocket_admin'); ?></a></li> 
        </ul>
    </div>
    <div class="tab-content">
        <div id="uiformc-menu-sec1" class="tab-pane in active">
            <!-- editing form -->    
            <?php include('create_form_main.php');?>
            <!--\end editing form -->
        </div>
        <div id="uiformc-menu-sec2" class="tab-pane ">
            <div class="uiformc-tab-content-inner">
                <?php include('settings_form_email.php');?>
            </div>
        </div>
        <div id="uiformc-menu-sec3" class="tab-pane ">
            <div class="uiformc-tab-content-inner">
               <?php include('settings_form_submission.php');?>
            </div>
        </div>
        <div id="uiformc-menu-sec4" class="tab-pane ">
            <div class="uiformc-tab-content-inner">
              <?php include('settings_form_invoice.php');?>
            </div>
        </div>
        <div id="uiformc-menu-sec5" class="tab-pane ">
            <div class="uiformc-tab-content-inner">
              <?php include('settings_form_main.php');?>
            </div>
        </div>
    </div>
<div id="uiform-editing-mbuttons">
        <?php if(UIFORM_DEBUG===1){?>
            <a 
            class="btn  btn-primary"
            id="uiform-set-button-checkData2"
            onclick="javascript:rocketform.testing_summbox();"
            href="javascript:void(0);">
                <?php echo __('test','FRocket_admin'); ?> 
        </a> 
        <a 
            class="btn  btn-primary"
            id="uiform-set-button-checkData"
            onclick="javascript:rocketform.printmaindata();"
            href="javascript:void(0);">
                <?php echo __('Show data','FRocket_admin'); ?> 
        </a> 
        <?php }?>
        <a 
            class="btn btn-primary"
            onclick="javascript:rocketform.previewform_showForm(1);"
            href="javascript:void(0);">
           <span class="fa fa-desktop"></span> <?php echo __('preview','FRocket_admin');?>
        </a> 
        <a 
            class="btn btn-success"
            id="uiform-set-button-save"
            onclick="javascript:rocketform.saveForm();"
            href="javascript:void(0);">
            <i class="fa fa-floppy-o"></i> <?php echo __('Save form','FRocket_admin'); ?> 
        </a> 
    </div>
    </div>
   
</div>
<!--templates -->    
    <?php include('templates_fields.php');?>
<!--\end templates -->
<!-- modals -->    
    <?php include('create_form_modals.php');?>
<!--\ modals -->