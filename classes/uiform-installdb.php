<?php
/**
 * Frontend
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
if(class_exists('Uiform_InstallDB')){return;}

class Uiform_InstallDB {
    function __construct(){
        global $wpdb;
        $this->form         = $wpdb->prefix . "cest_uiform_form";
        $this->form_history = $wpdb->prefix . "cest_uiform_form_records";
        $this->form_fields = $wpdb->prefix . "cest_uiform_fields";
        $this->form_fields_type = $wpdb->prefix . "cest_uiform_fields_type";
        $this->settings = $wpdb->prefix . "cest_uiform_settings";
        $this->pay_gateways = $wpdb->prefix . "cest_uiform_pay_gateways";
        $this->pay_records = $wpdb->prefix . "cest_uiform_pay_records";
        $this->pay_logs = $wpdb->prefix . "cest_uiform_pay_logs";
        $this->visitor = $wpdb->prefix . "cest_uiform_visitor";
        $this->visitor_error = $wpdb->prefix . "cest_uiform_visitor_error";
    }
    
    public function install($networkwide = false){
        if ( $networkwide ) {
			deactivate_plugins( plugin_basename(UIFORM_ABSFILE) );
			wp_die( __( 'The plugin can not be network activated. You need to activate the plugin per site.', 'FRocket_admin' ) );
		}
        global $wpdb;
        $charset = '';
        if( $wpdb->has_cap( 'collation' ) ){
            if( !empty($wpdb->charset) )
                $charset = "DEFAULT CHARACTER SET $wpdb->charset";
            if( !empty($wpdb->collate) )
                $charset .= " COLLATE $wpdb->collate";
        }
        //forms
        $sql = "CREATE  TABLE IF NOT EXISTS $this->form (
            `fmb_id` INT(6) NOT NULL AUTO_INCREMENT ,
            `fmb_data` mediumtext ,
            `fmb_name` VARCHAR(255) NULL ,
            `fmb_html` MEDIUMTEXT NULL ,
            `fmb_html_backend` MEDIUMTEXT NULL ,
            `flag_status` SMALLINT(5) DEFAULT '1',
            `created_date` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ,
            `updated_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
            `created_ip` VARCHAR(20) NULL ,
            `updated_ip` VARCHAR(20) NULL ,
            `created_by` INT(6) NULL ,
            `updated_by` INT(6) NULL ,
            `fmb_html_css` MEDIUMTEXT NULL ,
            `fmb_default` TINYINT(1) NULL DEFAULT 0 ,
            `fmb_skin_status` TINYINT(1) NULL DEFAULT 0 ,
            `fmb_skin_data` TEXT NULL ,
            `fmb_skin_type` SMALLINT(5) NULL DEFAULT 1 ,
            `fmb_data2` TEXT NULL ,    
            PRIMARY KEY (`fmb_id`) ) " . $charset . ";";
        $wpdb->query($sql);
        //form request statitistics
        
        $sql = "CREATE  TABLE IF NOT EXISTS $this->form_history (
                `fbh_id` int(10) NOT NULL AUTO_INCREMENT,
                `fbh_data` longtext,
                `fbh_data_rec` longtext,
                `fbh_total_amount` varchar(45) DEFAULT NULL,
                `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `created_ip` varchar(20) DEFAULT NULL,
                `created_by` int(6) DEFAULT NULL,
                `flag_status` smallint(5) DEFAULT '1',
                `fbh_data_user` mediumtext,
                `form_fmb_id` int(6) NOT NULL,
                `fbh_data_rec_xml` longtext,
                `fbh_user_agent` varchar(200) DEFAULT NULL,
                `fbh_page` text,
                `fbh_referer` text,
                `fbh_params` text,
                `vis_uniqueid` varchar(10) NOT NULL,
                `fbh_error` text,    
            PRIMARY KEY (`fbh_id`) ) " . $charset . ";";
        $wpdb->query($sql);
        //fields type
        $sql="CREATE  TABLE IF NOT EXISTS $this->form_fields_type (
        `fby_id` INT(6) NOT NULL AUTO_INCREMENT ,
        `fby_name` VARCHAR(25) NULL ,
        `flag_status` SMALLINT(5) NULL ,
        `created_date` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ,
        `updated_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        `created_ip` VARCHAR(20) NULL ,
        `updated_ip` VARCHAR(20) NULL ,
        `created_by` INT(6) NULL ,
        `updated_by` INT(6) NULL ,
        PRIMARY KEY (`fby_id`) )" . $charset . ";";
       $wpdb->query($sql);
       //insert types
       $uifm_check_total = $wpdb->get_row("SELECT COUNT(*) AS total FROM ".$this->form_fields_type, ARRAY_A );
       if( isset($uifm_check_total['total']) && intval($uifm_check_total['total'])===0 ){
           $sql="INSERT INTO $this->form_fields_type VALUES 
        ('1', '1 Col', '1', '0000-00-00 00:00:00', '2014-05-24 01:10:27', null, null, null, null),
        ('2', '2 Cols', '1', '0000-00-00 00:00:00', '2014-05-24 01:10:44', null, null, null, null),
        ('3', '3 Cols', '1', '0000-00-00 00:00:00', '2014-05-24 01:10:57', null, null, null, null),
        ('4', '4 Cols', '1', '0000-00-00 00:00:00', '2014-05-24 01:11:36', null, null, null, null),
        ('5', '6 Cols', '1', '0000-00-00 00:00:00', '2014-05-24 01:11:45', null, null, null, null),
        ('6', 'Textbox', '1', '0000-00-00 00:00:00', '2014-05-24 01:11:58', null, null, null, null),
        ('7', 'Textarea', '1', '0000-00-00 00:00:00', '2014-05-24 01:12:12', null, null, null, null),
        ('8', 'Radio Button', '1', '0000-00-00 00:00:00', '2014-05-24 01:13:21', null, null, null, null),
        ('9', 'Checkbox', '1', '0000-00-00 00:00:00', '2014-05-24 01:13:33', null, null, null, null),
        ('10', 'Select', '1', '0000-00-00 00:00:00', '2014-05-24 01:13:44', null, null, null, null),
        ('11', 'Multiple Select', '1', '0000-00-00 00:00:00', '2014-05-24 01:13:57', null, null, null, null),
        ('12', 'File Upload', '1', '0000-00-00 00:00:00', '2014-05-24 01:28:55', null, null, null, null),
        ('13', 'Image Upload', '1', '0000-00-00 00:00:00', '2014-05-24 01:29:06', null, null, null, null),
        ('14', 'Custom HTML', '1', '0000-00-00 00:00:00', '2014-05-24 01:29:31', null, null, null, null),
        ('15', 'Password', '1', '0000-00-00 00:00:00', '2014-05-24 01:30:39', null, null, null, null),
        ('16', 'Slider', '1', '0000-00-00 00:00:00', '2014-05-24 01:30:53', null, null, null, null),
        ('17', 'Range', '1', '0000-00-00 00:00:00', '2014-05-24 01:35:41', null, null, null, null),
        ('18', 'Spinner', '1', '0000-00-00 00:00:00', '2014-05-24 01:37:09', null, null, null, null),
        ('19', 'Captcha', '1', '0000-00-00 00:00:00', '2014-05-24 01:37:19', null, null, null, null),
        ('20', 'Submit button', '1', '0000-00-00 00:00:00', '2014-05-24 01:39:59', null, null, null, null),
        ('21', 'Hidden field', '1', '0000-00-00 00:00:00', '2014-05-24 01:40:13', null, null, null, null),
        ('22', 'Star rating', '1', '0000-00-00 00:00:00', '2014-05-24 01:40:24', null, null, null, null),
        ('23', 'Color Picker', '1', '0000-00-00 00:00:00', '2014-05-24 01:40:37', null, null, null, null),
        ('24', 'Date Picker', '1', '0000-00-00 00:00:00', '2014-05-24 01:41:19', null, null, null, null),
        ('25', 'Time Picker', '1', '0000-00-00 00:00:00', '2014-05-24 01:41:46', null, null, null, null),
        ('26', 'Date and Time', '1', '0000-00-00 00:00:00', '2014-05-24 01:50:36', null, null, null, null),
        ('27', 'ReCaptcha', '1', '0000-00-00 00:00:00', '2014-05-24 01:50:53', null, null, null, null),
        ('28', 'Prepended text', '1', '0000-00-00 00:00:00', '2014-05-24 01:51:16', null, null, null, null),
        ('29', 'Appended text', '1', '0000-00-00 00:00:00', '2014-05-24 01:51:38', null, null, null, null),
        ('30', 'Append and prepend', '1', '0000-00-00 00:00:00', '2014-05-24 01:51:55', null, null, null, null),
        ('31', 'Panel', '1', '0000-00-00 00:00:00', '2014-05-24 01:55:32', null, null, null, null),
        ('32', 'Divider', '1', '0000-00-00 00:00:00', '2014-05-24 01:58:58', null, null, null, null),
        ('33', 'Heading 1', '1', '0000-00-00 00:00:00', '2014-05-24 02:25:51', null, null, null, null),
        ('34', 'Heading 2', '1', '0000-00-00 00:00:00', '2014-05-24 02:25:51', null, null, null, null),
        ('35', 'Heading 3', '1', '0000-00-00 00:00:00', '2014-05-24 02:25:51', null, null, null, null),
        ('36', 'Heading 4', '1', '0000-00-00 00:00:00', '2014-05-24 02:25:51', null, null, null, null),
        ('37', 'Heading 5', '1', '0000-00-00 00:00:00', '2014-05-24 02:25:51', null, null, null, null),
        ('38', 'Heading 6', '1', '0000-00-00 00:00:00', '2014-05-24 02:25:51', null, null, null, null),
        ('39', 'Wizard buttons', '1', '0000-00-00 00:00:00', '2014-05-24 02:25:51', null, null, null, null),
        ('40', 'Switch', '1', '0000-00-00 00:00:00', '2014-05-24 02:25:51', null, null, null, null),
        ('41', 'Dinamic Checkbox', '1', '0000-00-00 00:00:00', '2014-05-24 02:25:51', null, null, null, null),
        ('42', 'Dinamic RadioButton', '1', '0000-00-00 00:00:00', '2014-05-24 02:25:51', null, null, null, null);";
        $wpdb->query($sql);
       }
       
       
        //fields
        $sql="CREATE  TABLE IF NOT EXISTS $this->form_fields (
        `fmf_id` int(6) NOT NULL AUTO_INCREMENT,
        `fmf_uniqueid` varchar(255) DEFAULT NULL,
        `fmf_data` MEDIUMTEXT NULL ,
        `fmf_fieldname` varchar(255) DEFAULT NULL,
        `flag_status` smallint(5) DEFAULT NULL,
        `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
        `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `created_ip` varchar(20) DEFAULT NULL,
        `updated_ip` varchar(20) DEFAULT NULL,
        `created_by` int(6) DEFAULT NULL,
        `updated_by` int(6) DEFAULT NULL,
        `fmf_status_qu` smallint(5) NOT NULL DEFAULT '0',
        `type_fby_id` int(6) NOT NULL,
        `form_fmb_id` int(6) NOT NULL,
        `order_frm` smallint(5) DEFAULT NULL,
        `order_rec` smallint(5) DEFAULT NULL, 
        PRIMARY KEY (`fmf_id`,`form_fmb_id`) ) " . $charset . ";";
        $wpdb->query($sql);
        
        //settings
        $sql="CREATE  TABLE IF NOT EXISTS $this->settings (
        `version` varchar(10) DEFAULT NULL,
        `type_email` SMALLINT(1) NULL ,
        `smtp_host` VARCHAR(255) NULL ,
        `smtp_port` SMALLINT(6) NULL ,
        `smtp_user` VARCHAR(50) NULL ,
        `smtp_pass` VARCHAR(50) NULL ,
        `sendmail_path` VARCHAR(255) NULL ,
        `language` VARCHAR(45) NULL,
         `id` INT(1) NOT NULL AUTO_INCREMENT ,
         PRIMARY KEY (`id`)
        ) " . $charset . ";";
        
        $wpdb->query($sql);
        //insert data
        $uifm_check_total = $wpdb->get_row("SELECT COUNT(*) AS total FROM ".$this->settings, ARRAY_A );
       if( isset($uifm_check_total['total']) && intval($uifm_check_total['total'])===0 ){
           $sql="INSERT INTO $this->settings VALUES ('2.2', null, null, null, null, null, null, '', '1');";
        $wpdb->query($sql);
       }
        
        
        //payment gateways
        $sql="CREATE  TABLE IF NOT EXISTS $this->pay_gateways (
        `pg_id` int(6) NOT NULL AUTO_INCREMENT,
        `pg_name` varchar(255) DEFAULT NULL,
        `pg_modtest` smallint(5) DEFAULT NULL,
        `pg_data` text,
        `flag_status` smallint(5) DEFAULT NULL,
        `pg_order` smallint(5) DEFAULT '0',
        `pg_description` mediumtext,
        PRIMARY KEY (`pg_id`)
        ) " . $charset . ";";
        
        $wpdb->query($sql);
        //insert data
        $uifm_check_total = $wpdb->get_row("SELECT COUNT(*) AS total FROM ".$this->pay_gateways, ARRAY_A );
       if( isset($uifm_check_total['total']) && intval($uifm_check_total['total'])===0 ){
           $sql="INSERT INTO $this->pay_gateways VALUES 
            ('1', 'Offline', '0', '', '1', '3', 'Offline payment description'),
            ('2', 'Paypal', '0', '', '1', '0', 'paypal payment');";
            $wpdb->query($sql);
       }
       
        //payment records
        $sql="CREATE  TABLE IF NOT EXISTS $this->pay_records (
        `pgr_id` int(10) NOT NULL AUTO_INCREMENT,
        `type_pg_id` int(6) NOT NULL,
        `pgr_payment_status` varchar(100) DEFAULT NULL,
        `pgr_payment_amount` varchar(45) DEFAULT NULL,
        `pgr_currency` varchar(45) DEFAULT NULL,
        `pgr_data` mediumtext,
        `flag_status` smallint(5) DEFAULT NULL,
        `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
        `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `created_ip` varchar(20) DEFAULT NULL,
        `updated_ip` varchar(20) DEFAULT NULL,
        `created_by` int(6) DEFAULT NULL,
        `updated_by` int(6) DEFAULT NULL,
        `fbh_id` int(10) NOT NULL ,
        PRIMARY KEY (`pgr_id`)
        ) " . $charset . ";";
        
        $wpdb->query($sql);
        
        //payment logs
        $sql="CREATE  TABLE IF NOT EXISTS $this->pay_logs (
        `pgl_id` bigint(20) NOT NULL AUTO_INCREMENT,
        `type_pg_id` int(6) NOT NULL,
        `pgl_data` mediumtext,
        `pgl_data2` mediumtext,
        `pgl_error` mediumtext,
        `pgl_message` text,
        `pgr_id` int(10) NOT NULL ,
        `vis_last_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`pgl_id`)
        ) " . $charset . ";";
        
        $wpdb->query($sql);
        
        //visitor
        $sql="CREATE  TABLE IF NOT EXISTS $this->visitor (
        `vis_id` bigint(20) NOT NULL AUTO_INCREMENT,
        `fmb_id` INT(6) NOT NULL ,
        `vis_uniqueid` varchar(10) DEFAULT NULL,
        `vis_user_agent` varchar(200) DEFAULT NULL,
        `vis_page` text,
        `vis_referer` text,
        `vis_ip` text,
        `vis_last_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `vis_params` text,
        PRIMARY KEY (`vis_id`)
        ) " . $charset . ";";
        
        $wpdb->query($sql);
      
        //visitor error
        $sql="CREATE  TABLE IF NOT EXISTS $this->visitor_error (
        `vis_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        `vis_uniqueid` varchar(10) NOT NULL,
        `vis_user_agent` varchar(250) DEFAULT NULL,
        `vis_page` text,
        `vis_referer` text,
        `vis_error` longtext CHARACTER SET latin1,
        `vis_ip` varchar(40) DEFAULT NULL,
        `vis_last_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`vis_id`)
        ) " . $charset . ";";
        $wpdb->query($sql);
        
        update_option("uifmcostest_version", UIFORM_VERSION);
        
    }
    
    public function uninstall(){
        global $wpdb;
        $wpdb->query('DROP TABLE IF EXISTS '. $this->form_history);
        $wpdb->query('DROP TABLE IF EXISTS '. $this->form_fields);
        $wpdb->query('DROP TABLE IF EXISTS '. $this->form_fields_type);
        $wpdb->query('DROP TABLE IF EXISTS '. $this->form);
        $wpdb->query('DROP TABLE IF EXISTS '. $this->settings);
        $wpdb->query('DROP TABLE IF EXISTS '. $this->pay_gateways);
        $wpdb->query('DROP TABLE IF EXISTS '. $this->pay_records);
        $wpdb->query('DROP TABLE IF EXISTS '. $this->pay_logs);
        $wpdb->query('DROP TABLE IF EXISTS '. $this->visitor);
        $wpdb->query('DROP TABLE IF EXISTS '. $this->visitor_error);
    }
}
?>
