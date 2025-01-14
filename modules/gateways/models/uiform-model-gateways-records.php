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
if (class_exists('Uiform_Model_Gateways_Records')) {
    return;
}

/**
 * Model Setting class
 *
 * @category  PHP
 * @package   Rocket_form
 * @author    Softdiscover <info@softdiscover.com>
 * @copyright 2013 Softdiscover
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: 1.00
 * @link      http://wordpress-cost-estimator.uiform.com
 */
class Uiform_Model_Gateways_Records {

    private $wpdb = "";
    public $table = "";
    public $tbform_record = "";
    public $tbform = "";

    function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table = $wpdb->prefix . "cest_uiform_pay_records";
        $this->tbform_record = $wpdb->prefix . "cest_uiform_form_records";
        $this->tbform = $wpdb->prefix . "cest_uiform_form";
    }
    
    function getRecordById($id) {
        $query = sprintf('
            select uf.*
            from %s uf
            where uf.pgr_id=%s
            ', $this->table, $id);

        return $this->wpdb->get_row($query);
    }
    
    function getInvoiceDataByFormRecId($id_rec){
        $query = sprintf('select  f.fmb_name,f.fmb_data,frec.fbh_total_amount,pr.pgr_id,pr.created_date
        from %s frec
        join %s f on f.fmb_id=frec.form_fmb_id
        join %s pr on pr.fbh_id=frec.fbh_id
        where frec.flag_status>0
        and frec.fbh_id=%s', $this->tbform_record,$this->tbform,$this->table,$id_rec);
        return $this->wpdb->get_row($query);
    }
    
    function CountRecords() {
        $query = sprintf('
            select COUNT(*) AS counted
            from %s gr
            join %s fr on fr.fbh_id=gr.fbh_id
            join %s f on fr.form_fmb_id=f.fmb_id
            where gr.flag_status>0
            ORDER BY gr.created_date desc
            ',  $this->table, $this->tbform_record, $this->tbform);
        $row = $this->wpdb->get_row($query);
        if (isset($row->counted)) {
            return $row->counted;
        } else {
            return 0;
        }
    }
    
    function getListRecords($per_page = '', $segment = '') {
        $query = sprintf('
            select gr.*,f.fmb_name
            from %s gr
            join %s fr on fr.fbh_id=gr.fbh_id
            join %s f on fr.form_fmb_id=f.fmb_id
            where gr.flag_status>0
            ORDER BY gr.created_date desc
            ', $this->table, $this->tbform_record, $this->tbform);

 
        if ($per_page != '' || $segment != '') {
            $segment=(!empty($segment))?$segment:0;
            $query.=sprintf(' limit %s,%s', $segment, $per_page);
        }
        
        return $this->wpdb->get_results($query);
    }
    
}

?>
