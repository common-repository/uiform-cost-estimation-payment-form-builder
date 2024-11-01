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
if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}
if (class_exists('Uiform_Bootstrap')) {
    return;
}

class Uiform_Bootstrap extends Uiform_Base_Module {

    protected $modules;
    protected $models;

    const VERSION = '1.2';
    const PREFIX = 'wprofmr_';

    /*
     * Magic methods
     */

    /**
     * Constructor
     *
     * @mvc Controller
     */
    protected function __construct() {
        $this->register_hook_callbacks();
    }

    /**
     * Register callbacks for actions and filters
     *
     * @mvc Controller
     */
    public function register_hook_callbacks() {
        global $wp_version;



        add_action('admin_menu', array(&$this, 'loadMenu'));

        //add lang dir
        add_filter('rockfm_languages_directory', array(&$this, 'rockfm_lang_dir_filter'));
        add_filter('rockfm_languages_domain', array(&$this, 'rockfm_lang_domain_filter'));
        add_filter('plugin_locale', array(&$this, 'rockfm_lang_locale_filter'));
        
       
        //disable update notifications
        if(is_admin()){
            add_filter( 'site_transient_update_plugins', array(&$this, 'disable_plugin_updates'));
        }
        //load admin
        if (is_admin() && Uiform_Form_Helper::is_uiform_page()) {
            //deregister bootstrap in child themes
            add_action('admin_enqueue_scripts',array(&$this, 'remove_unwanted_css'), 1000 );
            //admin resources
            add_action('admin_enqueue_scripts', array(&$this, 'load_admin_resources'),20,1);
            
            $this->loadBackendControllers();
            //disabling wordpress update message
            add_action('admin_menu', array(&$this, 'wphidenag'));
            //format wordpress editor
            if (version_compare($wp_version, 4, '<')) {
                //for wordpress 3.x
                //event tinymce
                add_filter('tiny_mce_before_init', array(&$this, 'wpse24113_tiny_mce_before_init'));
                add_filter('tiny_mce_before_init', array(&$this, 'myformatTinyMCE'));
            } else {
                add_filter('tiny_mce_before_init', array(&$this, 'wpver411_tiny_mce_before_init'));
            }

            //end format wordpress editor    
            add_action('init', array($this, 'init'));
        } else {
            //load frontend
            $this->loadFrontendControllers();
        }

        //  i18n
        add_action('init', array(&$this, 'i18n'));

        //call post processing
        if (isset($_POST['_rockfm_type_submit']) && absint($_POST['_rockfm_type_submit']) === 0) {
            add_action('plugins_loaded', array(&$this, 'uiform_process_form'));
        }
        
         // register API endpoints
        add_action('init', array(&$this, 'add_endpoint'), 0);
        // handle  endpoint requests
        add_action('parse_request', array(&$this, 'handle_api_requests'), 0);
        add_action('uifm_costestimator_api_paypal_ipn_handler', array(&$this, 'paypal_ipn_handler'));
        add_action('uifm_costestimator_api_lmode_iframe_handler', array(&$this, 'lmode_iframe_handler'));
        
        add_action('uifm_costestimator_api_pdf_show_record', array(&$this, 'action_pdf_show_record'));
        add_action('uifm_costestimator_api_pdf_show_invoice', array(&$this, 'action_pdf_show_invoice'));
        add_action('uifm_costestimator_api_csv_show_allrecords', array(&$this, 'action_csv_show_allrecords'));
        
        //add_action( 'init',                  array( $this, 'upgrade' ), 11 );
    }
    
    
    /**
     * add_endpoint function.
     *
     * @access public
     * @since 1.0.0
     * @return void
     */
    public function add_endpoint() {
        //assigning variable to rewrite
        add_rewrite_endpoint('uifm_costestimator_api_handler', EP_ALL);
        
    }
    
    /**
     * API request - Trigger any API requests
     *
     * @access public
     * @since 1.0.0
     * @return void
     */
    public function handle_api_requests() {
        global $wp;
        if (isset($_GET['action']) && $_GET['action'] == 'uifm_est_api_handler') {
            $wp->query_vars['uifm_costestimator_api_handler'] = $_GET['action'];
        }

        // paypal-ipn-for-wordpress-api endpoint requests
        if (!empty($wp->query_vars['uifm_costestimator_api_handler'])) {

            // Buffer, we won't want any output here
            ob_start();

            // Get API trigger
            $api = $this->route_api_handler();
            // Trigger actions
            do_action('uifm_costestimator_api_' . $api);

            // Done, clear buffer and exit
            ob_end_clean();
            die('1');
        }
    }
    
    private function route_api_handler() {
      
        $mode=isset($_GET['uifm_mode']) ? Uiform_Form_Helper::sanitizeInput($_GET['uifm_mode']) :'';
        $return='';
        switch ($mode) {
            case 'ipn':
                $type_payment=isset($_GET['paygat']) ? Uiform_Form_Helper::sanitizeInput($_GET['paygat']) :'';
                switch ($type_payment) {
                    case 2:
                        $return='paypal_ipn_handler';
                        break;
                    default:
                        break;
                }
                break;
            case 'lmode':
                $type_mode=isset($_GET['uifm_action']) ? Uiform_Form_Helper::sanitizeInput($_GET['uifm_action']) :'';
                switch ($type_mode) {
                    case 1:
                        $return='lmode_iframe_handler';
                        break;
                    default:
                        break;
                }
                break;
            case 'pdf':
                $process=isset($_GET['uifm_action']) ? Uiform_Form_Helper::sanitizeInput($_GET['uifm_action']) :'';
                switch ($process) {
                    case 'show_record':
                        $return='pdf_show_record';
                        break;
                    case 'show_invoice':
                        $return='pdf_show_invoice';
                        break;
                    default:
                        break;
                };
                break;
            case 'csv':
                $process=isset($_GET['uifm_action']) ? Uiform_Form_Helper::sanitizeInput($_GET['uifm_action']) :'';
                switch ($process) {
                    case 'show_allrecords':
                        $return='csv_show_allrecords';
                        break;
                    default:
                        break;
                };
                break;
            default:
                break;
        }
        
        return $return;
    }
    
    public function action_pdf_show_invoice() {
        
      
         $rec_id=isset($_GET['id']) ? Uiform_Form_Helper::sanitizeInput($_GET['id']) :'';
          
         if(intval($rec_id)>0){
                 ob_start();
               ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
        <html> 
        <head> 
        <meta	http-equiv="Content-Type"	content="charset=utf-8" />
            <style type="text/css">
                    * {
                        font-family: "DejaVu Sans Mono", monospace;
                        }
                </style>
                <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/common/bootstrap/2.3.2/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" >
               
                <style type="text/css">
                    .uifm_invoice_container h3{
                        margin-left:-20px;
                    }
                    .uifm_invoice_container .invoice_date{
                        margin-left:-20px;
                        margin-bottom: 20px;
                    }
                    .uifm_invoice_container{
                    margin: 10px 20px 20px;
                    }
                </style>
        </head> 
            <body>
                <div style="width:600px;margin: 0 100px;">
                    <!-- if p tag is removed, title will dissapear, idk -->
                    <p>&nbsp;</p>
                   <?php
                echo self::$_modules['formbuilder']['frontend']->get_summaryInvoice($rec_id);
                ?>
                </div>
            </body>
            </html>   
                    
               <?php
                $cntACmp = ob_get_contents();
                $cntACmp = preg_replace("/\s+/"," ", $cntACmp);
                    ob_end_clean();
                    $tmp_html=$cntACmp ;

                $tmp_recid=$rec_id;
                
                uifm_generate_pdf($tmp_html,'record_'.$tmp_recid, true);
         }
         //die all
         die();
    }
    
    public function action_pdf_show_record() {
         
         $rec_id=isset($_GET['id']) ? Uiform_Form_Helper::sanitizeInput($_GET['id']) :'';
         if(intval($rec_id)>0){
                 ob_start();
               ?>
                  <h3><?php echo __('Order summary','FRocket_admin');?></h3> 
                   <?php
                echo self::$_modules['formbuilder']['frontend']->get_summaryRecord($rec_id);
                $cntACmp = ob_get_contents();
                $cntACmp = preg_replace("/\s+/"," ", $cntACmp);
                    ob_end_clean();
                    $tmp_html=$cntACmp ;

                $tmp_recid=$rec_id;
                
                uifm_generate_pdf($tmp_html,'record_'.$tmp_recid, true);
         }
    
        die();
    }
    
    public function action_csv_show_allrecords() {
       
       die();
    }
    
    public function paypal_ipn_handler() {
       
        die();
    }
    
    public function lmode_iframe_handler() {
        $form_id=isset($_GET['id']) ? Uiform_Form_Helper::sanitizeInput($_GET['id']) :'';
        //removing actions
        remove_all_actions('wp_footer');
        remove_all_actions('wp_head');
        
        echo $this->modules['formbuilder']['frontend']->get_form_iframe($form_id);
        die();
    }
    
    function disable_plugin_updates( $value ) {
        if(isset($value->response['uiform-form-builder/uiform-form-builder.php'])){
        unset( $value->response['uiform-form-builder/uiform-form-builder.php'] );
        }
        return $value;
     }
     
    public function remove_unwanted_css(){
       /*
        //style
        wp_dequeue_style( 'bootstrap_css' );
        wp_deregister_style( 'bootstrap_css' );
        
        //script
        wp_dequeue_script( 'bootstrap.min_script' );*/
    } 
    
    public function is_uiformpage(){
        $vget_page=(isset($_GET['page']))?Uiform_Form_Helper::sanitizeInput($_GET['page']):'';
        $vpost_page=(isset($_POST['page']))?Uiform_Form_Helper::sanitizeInput($_POST['page']):'';
        if(( $vget_page === 'uiform_form_builder' ) || ( $vpost_page === 'uiform_form_builder' )) {
            return true;
        }else{
            return false;
        }
    }
    public function rockfm_lang_dir_filter($lang_dir) {
        if (is_admin() && Uiform_Form_Helper::is_uiform_page()) {
            $lang_dir = UIFORM_FORMS_DIR . '/i18n/languages/backend/';
        } else {
            //load frontend
            $lang_dir = UIFORM_FORMS_DIR . '/i18n/languages/front/';
        }
        return $lang_dir;
    }

    public function rockfm_lang_locale_filter($locale) {

        $tmp_lang = $this->models['formbuilder']['settings']->getLangOptions();
        if (!empty($tmp_lang->language)) {
            $locale = $tmp_lang->language;
        }

        return $locale;
    }

    public function rockfm_lang_domain_filter($domain) {
        if (is_admin() && Uiform_Form_Helper::is_uiform_page()) {
            $domain = 'FRocket_admin';
        } else {
            //load frontend
            $domain = 'FRocket_front';
        }
        return $domain;
    }

    function uiform_process_form() {
        $this->modules['formbuilder']['frontend']->process_form();
    }

    function wpver411_tiny_mce_before_init($initArray) {
        $initArray['setup'] = <<<JS
[function(ed) {
      ed.on('change KeyUp', function(e) {
         rocketform.captureEventTinyMCE(ed,e);
      });
}][0]
JS;
        return $initArray;
    }

    function wpse24113_tiny_mce_before_init($initArray) {
        $initArray['setup'] = <<<JS
[function(ed) {
    ed.onKeyUp.add(function(ed, e) {
        rocketform.captureEventTinyMCE(ed,e);
    });
    ed.onClick.add(function(ed, e) {
        rocketform.captureEventTinyMCE(ed,e);
        });
    ed.onChange.add(function(ed, e) {
        rocketform.captureEventTinyMCE(ed,e);
    });
}][0]
JS;
        return $initArray;
    }

    function myformatTinyMCE($in) {
        $in['plugins'] = 'tabfocus,paste,media,wordpress,wpeditimage,wpgallery,wplink,wpdialogs';
        $in['wpautop'] = true;
        $in['apply_source_formatting'] = true;
        $in['theme_advanced_buttons1'] = 'formatselect,forecolor,|,bold,italic,underline,|,bullist,numlist,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,wp_adv';
        $in['theme_advanced_buttons2'] = 'fontsizeselect,pastetext,pasteword,removeformat,|,charmap,|,outdent,indent,|,undo,redo';
        $in['theme_advanced_buttons3'] = '';
        $in['theme_advanced_buttons4'] = '';
        $in['fontsize_formats'] = "7px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 26px 27px 28px 29px 30px 31px 32px 34px 36px 45px";
        return $in;
    }

    protected function loadBackendControllers() {

        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/controllers/uiform-fb-controller-forms.php');
        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/controllers/uiform-fb-controller-fields.php');
        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/models/uiform-model-form.php');
        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/models/uiform-model-fields.php');
        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/models/uiform-model-form-records.php');
        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/models/uiform-model-settings.php');
        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/controllers/uiform-fb-controller-frontend.php');
        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/controllers/uiform-fb-controller-records.php');
        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/controllers/uiform-fb-controller-settings.php');
        //gateway
        require_once( UIFORM_FORMS_DIR . '/modules/gateways/controllers/uiform-pg-controller-settings.php');
        require_once( UIFORM_FORMS_DIR . '/modules/gateways/controllers/uiform-pg-controller-records.php');
        require_once( UIFORM_FORMS_DIR . '/modules/gateways/models/uiform-model-gateways.php');
        require_once( UIFORM_FORMS_DIR . '/modules/gateways/models/uiform-model-gateways-records.php');
        require_once( UIFORM_FORMS_DIR . '/modules/gateways/models/uiform-model-gateways-logs.php');
        
        //visitor
        require_once( UIFORM_FORMS_DIR . '/modules/visitor/models/uiform-model-error.php');
        require_once( UIFORM_FORMS_DIR . '/modules/visitor/models/uiform-model-visitor.php');
        
        
        
        $this->models = array(
            'formbuilder' => array('form' => new Uiform_Model_Form(),
                'fields' => new Uiform_Model_Fields(),
                'settings' => new Uiform_Model_Settings(),
                'form_records' => new Uiform_Model_Form_Records()),
            'visitor' => array('visitor' => new Uiform_Model_Visitor(),
                'error' => new Uiform_Model_Visitor_Error()),
            'gateways' => array('gateways' => new Uiform_Model_Gateways(),
                                'records' => new Uiform_Model_Gateways_Records(),
                                'logs' => new Uiform_Model_Gateways_Logs()
                                )
        );
        self::$_models = $this->models;
        $this->modules = array(
            'formbuilder' => array('forms' => Uiform_Fb_Controller_Forms::get_instance(),
                'fields' => Uiform_Fb_Controller_Fields::get_instance(),
                'frontend' => Uiform_Fb_Controller_Frontend::get_instance(),
                'records' => Uiform_Fb_Controller_Records::get_instance(),
                'settings' => Uiform_Fb_Controller_Settings::get_instance()),
            'gateways' => array('settings' => Uiform_Pg_Controller_Settings::get_instance(),
                                'records' => Uiform_Pg_Controller_Records::get_instance())
        );
        self::$_modules = $this->modules;
    }

    protected function loadFrontendControllers() {

        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/controllers/uiform-fb-controller-frontend.php');
        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/controllers/uiform-fb-controller-records.php');
        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/models/uiform-model-form.php');
        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/models/uiform-model-fields.php');
        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/models/uiform-model-settings.php');
        require_once( UIFORM_FORMS_DIR . '/modules/formbuilder/models/uiform-model-form-records.php');
        //gateway
        require_once( UIFORM_FORMS_DIR . '/modules/gateways/models/uiform-model-gateways.php');
        require_once( UIFORM_FORMS_DIR . '/modules/gateways/models/uiform-model-gateways-records.php');
        require_once( UIFORM_FORMS_DIR . '/modules/gateways/models/uiform-model-gateways-logs.php');
        //visitor
        require_once( UIFORM_FORMS_DIR . '/modules/visitor/models/uiform-model-error.php');
        require_once( UIFORM_FORMS_DIR . '/modules/visitor/models/uiform-model-visitor.php');
        
        $this->models = array(
            'formbuilder' => array('form' => new Uiform_Model_Form(),
                'fields' => new Uiform_Model_Fields(),
                'settings' => new Uiform_Model_Settings(),
                'form_records' => new Uiform_Model_Form_Records()),
            'visitor' => array('visitor' => new Uiform_Model_Visitor(),
                'error' => new Uiform_Model_Visitor_Error()),
            'gateways' => array('gateways' => new Uiform_Model_Gateways(),
                                'records' => new Uiform_Model_Gateways_Records(),
                                'logs' => new Uiform_Model_Gateways_Logs()
                                )
        );
        self::$_models = $this->models;
        $this->modules = array(
            'formbuilder' => array('frontend' => Uiform_Fb_Controller_Frontend::get_instance(),
                                    'records' => Uiform_Fb_Controller_Records::get_instance())
        );
        self::$_modules = $this->modules;
    }

    public function wphidenag() {
        remove_action('admin_notices', 'update_nag', 3);
    }

    public function loadMenu() {

        add_menu_page('Uiform - Cost Estimator', 'Uiform Estimator Lite', "edit_posts", "uiform_cost_estimate", array(&$this, "route_page"), UIFORM_FORMS_URL . "/assets/backend/image/rockfm-logo-ico.png");
        add_submenu_page("uiform_cost_estimate", __('List by form', 'FRocket_admin'), __('Records', 'FRocket_admin'), 'manage_options', "?page=uiform_cost_estimate&mod=formbuilder&controller=records&action=info_records_byforms");
        add_submenu_page("uiform_cost_estimate", __('Import', 'FRocket_admin'), __('Import', 'FRocket_admin'), 'manage_options', "?page=uiform_cost_estimate&mod=formbuilder&controller=forms&action=create_uiform&opt=import");
        add_submenu_page("uiform_cost_estimate", __('Export', 'FRocket_admin'), __('Export', 'FRocket_admin'), 'manage_options', "?page=uiform_cost_estimate&mod=formbuilder&controller=forms&action=export_form");
        add_submenu_page("uiform_cost_estimate", __('Charts', 'FRocket_admin'), __('Charts', 'FRocket_admin'), 'manage_options', "?page=uiform_cost_estimate&mod=formbuilder&controller=records&action=view_charts");
        add_submenu_page("uiform_cost_estimate", __('Settings', 'FRocket_admin'), __('Settings', 'FRocket_admin'), 'manage_options', "?page=uiform_cost_estimate&mod=formbuilder&controller=settings&action=view_settings");
    }
    
    public function route_page() {

        $route = Uiform_Form_Helper::getroute();
        if (!empty($route['module']) && !empty($route['controller']) && !empty($route['action'])) {
            if ( isset($this->modules[$route['module']][$route['controller']])
                    && method_exists($this->modules[$route['module']][$route['controller']], $route['action'])) {
                $this->modules[$route['module']][$route['controller']]->$route['action']();
                
            } else {
                echo 'wrong url';
               
            }
        } else {
            $this->modules['formbuilder']['forms']->list_uiforms();
        }
    }

    /*
     * Static methods
     */

    /**
     * Enqueues CSS, JavaScript, etc
     *
     * @mvc Controller
     */
    public static function load_admin_resources() {
        //admin
        /*wp_register_script(
                self::PREFIX . 'rockfm_js_global_frontend', UIFORM_FORMS_URL . '/assets/backend/js/js_global_frontend.js', array(), UIFORM_VERSION, true
        );*/
        /*wp_register_script(
                self::PREFIX . 'uifm_js_recaptcha', 'https://www.google.com/recaptcha/api.js?render=explicit', array(), 1, true
        );*/
        wp_register_script(
                self::PREFIX . 'admin', UIFORM_FORMS_URL . '/assets/backend/js/admin-js.js', array(), UIFORM_VERSION, true
        );
        wp_register_style(
                self::PREFIX . 'admin', UIFORM_FORMS_URL . '/assets/backend/css/admin-css.css', array(), UIFORM_VERSION, 'all'
        );



        if (is_admin() && Uiform_Form_Helper::is_uiform_page()) {
            /* load css */
            //loas ui
            wp_enqueue_style('jquery-ui');            
            wp_enqueue_style('rockefform-ui', UIFORM_FORMS_URL . '/assets/common/js/jqueryui/1.10.3/themes/start/jquery-ui.min.css');
            //bootstrap
            wp_enqueue_style('rockefform-bootstrap', UIFORM_FORMS_URL . '/assets/common/js/bootstrap/3.2.0/bootstrap.css');
            wp_enqueue_style('rockefform-bootstrap-theme', UIFORM_FORMS_URL . '/assets/common/js/bootstrap/3.2.0/bootstrap-theme.css');
            wp_enqueue_style('rockefform-fontawesome', UIFORM_FORMS_URL . '/assets/common/css/font-awesome.min.css');
            
            //custom fonts
            wp_enqueue_style('rockefform-customfonts', UIFORM_FORMS_URL . '/assets/backend/css/custom/style.css');
            //animate
            wp_enqueue_style('rockefform-animate', UIFORM_FORMS_URL . '/assets/backend/css/animate.css');
            //jasny bootstrap
            wp_enqueue_style('rockefform-jasny-bootstrap', UIFORM_FORMS_URL . '/assets/common/js/bjasny/jasny-bootstrap.css');
            //jscrollpane
            wp_enqueue_style('rockefform-jscrollpane', UIFORM_FORMS_URL . '/assets/backend/js/jscrollpane/jquery.jscrollpane.css');
            wp_enqueue_style('rockefform-jscrollpane-lozenge', UIFORM_FORMS_URL . '/assets/backend/js/jscrollpane/jquery.jscrollpane.lozenge.css');
            //chosen
            wp_enqueue_style('rockefform-chosen', UIFORM_FORMS_URL . '/assets/backend/js/chosen/chosen.css');
            wp_enqueue_style('rockefform-chosen-style', UIFORM_FORMS_URL . '/assets/backend/js/chosen/style.css');
            //color picker
            wp_enqueue_style('rockefform-bootstrap-colorpicker', UIFORM_FORMS_URL . '/assets/backend/js/colorpicker/bootstrap-colorpicker.css');
            // bootstrap select
            wp_enqueue_style('rockefform-bootstrap-select', UIFORM_FORMS_URL . '/assets/backend/js/bselect/bootstrap-select.css');
            // bootstrap switch
            wp_enqueue_style('rockefform-bootstrap-switch', UIFORM_FORMS_URL . '/assets/backend/js/bswitch/bootstrap-switch.css');
            // bootstrap slider
            wp_enqueue_style('rockefform-bootstrap-slider', UIFORM_FORMS_URL . '/assets/backend/js/bslider/4.12.1/bootstrap-slider.min.css');
            // bootstrap touchspin
            wp_enqueue_style('rockefform-bootstrap-touchspin', UIFORM_FORMS_URL . '/assets/backend/js/btouchspin/jquery.bootstrap-touchspin.css');
            // bootstrap iconpicker
            wp_enqueue_style('rockefform-bootstrap-iconpicker', UIFORM_FORMS_URL . '/assets/backend/js/biconpicker/bootstrap-iconpicker.css');
            // bootstrap datetimepicker
            wp_enqueue_style('rockefform-bootstrap-datetimepicker', UIFORM_FORMS_URL . '/assets/backend/js/bdatetime/bootstrap-datetimepicker.css');
            // star rating
            wp_enqueue_style('rockefform-star-rating', UIFORM_FORMS_URL . '/assets/backend/js/bratestar/star-rating.css');
            //datatable
            wp_enqueue_style('rockefform-dataTables', UIFORM_FORMS_URL . '/assets/backend/js/bdatatable/1.10.9/jquery.dataTables.css');
            //graph
            wp_enqueue_style('rockefform-graph-morris', UIFORM_FORMS_URL . '/assets/backend/js/graph/morris.css');
            //intro 
            wp_enqueue_style('rockefform-introjs', UIFORM_FORMS_URL . '/assets/backend/js/introjs/introjs.css');
            //blueimp
            
            
            //load rocketform
            wp_enqueue_style(self::PREFIX . 'admin');


            /* load js */
            //load jquery
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-uiform-validation', UIFORM_FORMS_URL . '/assets/backend/js/jsvalidate/jquery.validate.min.js', array( 'jquery' ), '1.9.0', true );
            // load jquery ui
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-widget');
            wp_enqueue_script('jquery-ui-mouse');
            wp_enqueue_script("jquery-ui-dialog");
            wp_enqueue_script('jquery-ui-resizable');
            wp_enqueue_script('jquery-ui-position');
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script('jquery-ui-draggable');
            wp_enqueue_script('jquery-ui-droppable');
            wp_enqueue_script('jquery-ui-accordion');
            wp_enqueue_script('jquery-ui-autocomplete');
            wp_enqueue_script('jquery-ui-menu');
            wp_enqueue_script('jquery-ui-datepicker');
            wp_enqueue_script('jquery-ui-slider');
            wp_enqueue_script('jquery-ui-spinner');
            wp_enqueue_script('jquery-ui-button');
            
            //bootstrap
            wp_enqueue_script('rockefform-bootstrap', UIFORM_FORMS_URL . '/assets/common/js/bootstrap/3.2.0/bootstrap.js');
            //jasny bootstrap
            wp_enqueue_script('rockefform-jasny-bootstrap', UIFORM_FORMS_URL . '/assets/common/js/bjasny/jasny-bootstrap.js', array('jquery', 'rockefform-bootstrap'), '1.0', true);
            
            //md5
            wp_enqueue_script('rockefform-md5', UIFORM_FORMS_URL . '/assets/backend/js/md5.js');
            //graph morris
            wp_enqueue_script('rockefform-graph-morris', UIFORM_FORMS_URL . '/assets/backend/js/graph/morris.min.js');
            wp_enqueue_script('rockefform-graph-raphael', UIFORM_FORMS_URL . '/assets/backend/js/graph/raphael-min.js');
            //retina
            wp_enqueue_script('rockefform-retina', UIFORM_FORMS_URL . '/assets/backend/js/retina.js');
            //jscrollpane
            wp_enqueue_script('rockefform-mousewheel', UIFORM_FORMS_URL . '/assets/backend/js/jscrollpane/jquery.mousewheel.js');
            wp_enqueue_script('rockefform-jscrollpane', UIFORM_FORMS_URL . '/assets/backend/js/jscrollpane/jquery.jscrollpane.min.js');
            //chosen
            wp_enqueue_script('rockefform-chosen', UIFORM_FORMS_URL . '/assets/backend/js/chosen/chosen.jquery.min.js');
            //color picker
            wp_enqueue_script('rockefform-bootstrap-colorpicker', UIFORM_FORMS_URL . '/assets/backend/js/colorpicker/bootstrap-colorpicker-mod.js', array('jquery', 'rockefform-bootstrap'), '1.0', true);
            //bootstrap select
            wp_enqueue_script('rockefform-bootstrap-select', UIFORM_FORMS_URL . '/assets/backend/js/bselect/bootstrap-select.js', array('jquery', 'rockefform-bootstrap'), '1.0', true);
            //bootstrap switch
            wp_enqueue_script('rockefform-bootstrap-switch', UIFORM_FORMS_URL . '/assets/backend/js/bswitch/bootstrap-switch.js', array('jquery', 'rockefform-bootstrap'), '1.0', true);
            //bootstrap slider
            wp_enqueue_script('rockefform-bootstrap-slider', UIFORM_FORMS_URL . '/assets/backend/js/bslider/4.12.1/bootstrap-slider.js', array('jquery', 'rockefform-bootstrap'), '1.0', true);
            //bootstrap touchspin
            wp_enqueue_script('rockefform-bootstrap-touchspin', UIFORM_FORMS_URL . '/assets/backend/js/btouchspin/jquery.bootstrap-touchspin.js', array('jquery', 'rockefform-bootstrap'), '1.0', true);
            //bootstrap datetimepicker
            wp_enqueue_script('rockefform-bootstrap-dtpicker-locales', UIFORM_FORMS_URL . '/assets/backend/js/bdatetime/moment-with-locales.js', array('jquery', 'rockefform-bootstrap'), '1.0', true);
            wp_enqueue_script('rockefform-bootstrap-datetimepicker', UIFORM_FORMS_URL . '/assets/backend/js/bdatetime/bootstrap-datetimepicker.js', array('jquery', 'rockefform-bootstrap'), '1.0', true);
            //autogrow
            wp_enqueue_script('rockefform-autogrow-textarea', UIFORM_FORMS_URL . '/assets/backend/js/jquery.autogrow-textarea.js');
            //bootstrap iconpicker
            wp_enqueue_script('rockefform-bootstrap-iconpicker', UIFORM_FORMS_URL . '/assets/backend/js/biconpicker/bootstrap-iconpicker.js', array('jquery', 'rockefform-bootstrap'), '1.0', true);
            //star rating
            wp_enqueue_script('rockefform-star-rating', UIFORM_FORMS_URL . '/assets/backend/js/bratestar/star-rating.js', array('jquery', 'rockefform-bootstrap'), '1.0', true);
            //datatables
            wp_enqueue_script('rockefform-dataTables', UIFORM_FORMS_URL . '/assets/backend/js/bdatatable/1.10.9/jquery.dataTables.js');
            //bootbox
            wp_enqueue_script('rockefform-bootbox', UIFORM_FORMS_URL . '/assets/backend/js/bootbox/bootbox.js');
            //intro
            wp_enqueue_script('rockefform-introjs', UIFORM_FORMS_URL . '/assets/backend/js/introjs/intro.js');
            
            //lzstring
            wp_enqueue_script('rockefform-lzstring', UIFORM_FORMS_URL . '/assets/backend/js/lzstring/lz-string.min.js');
            //accounting
            wp_enqueue_script('rockfm-accounting', UIFORM_FORMS_URL . '/assets/common/js/accounting/accounting.min.js', array('jquery', 'rockefform-bootstrap'), '1.0', true);
            //iframe
            wp_enqueue_script('rockefform-iframe', UIFORM_FORMS_URL . '/assets/frontend/js/iframe/iframeResizer.min.js');
            
            
            //load recaptcha api
            //wp_enqueue_script(self::PREFIX . 'uifm_js_recaptcha');
            //load rocket form
            wp_enqueue_script(self::PREFIX . 'admin');
            wp_localize_script(self::PREFIX . 'admin', 'uiform_vars', array('url_site' => site_url(),'url_admin' => admin_url(), 'url_plugin' => UIFORM_FORMS_URL,'app_version' => UIFORM_VERSION,'url_assets' => UIFORM_FORMS_URL . "/assets"));
           // wp_enqueue_script(self::PREFIX . 'rockfm_js_global_frontend');
            
            
            //load form variables
           /* $form_variables=array();
            $form_variables['url_site']=site_url();
            $form_variables['ajaxurl']=admin_url('admin-ajax.php');
            $form_variables['imagesurl']=UIFORM_FORMS_URL . "/assets/frontend/images";
            $form_variables['_uifmvar']['fm_onload_scroll']="0";

            wp_localize_script(self::PREFIX . 'rockfm_js_global_frontend', 'rockfm_vars', $form_variables);*/
                    
        }
    }

    /**
     * Internationalization.
     * Loads the plugin language files
     *
     * @access public
     * @return void
     */
    public function i18n() {

        // Set filter for plugin's languages directory
        $lang_dir = UIFORM_FORMS_DIR . '/i18n/languages/';
        $lang_dir = apply_filters('rockfm_languages_directory', $lang_dir);

        $lang_domain = 'FRocket_admin';
        $lang_domain = apply_filters('rockfm_languages_domain', $lang_domain);

        // Traditional WordPress plugin locale filter
        $locale = apply_filters('plugin_locale', get_locale(), 'uiform_cost_estimate');
        $mofile = sprintf('%1$s-%2$s.mo', 'wprockf', $locale);

        // Setup paths to current locale file
        $mofile_local = $lang_dir . $mofile;
 
        if (file_exists($mofile_local)) {
            // Look in local /wp-content/plugins/wpbp/languages/ folder
            load_textdomain($lang_domain, $mofile_local);
        } else {
            // Load the default language files - but this is not working for some reason
            load_plugin_textdomain($lang_domain, false, dirname(plugin_basename(__FILE__)) . '/i18n/languages/');
        }
    }

    /**
     * Initializes variables
     *
     * @mvc Controller
     */
    public function init() {
        try {
            
        } catch (Exception $exception) {
            add_notice(__METHOD__ . ' error: ' . $exception->getMessage(), 'error');
        }
    }

    /*
     * Instance methods
     */

    /**
     * Prepares sites to use the plugin during single or network-wide activation
     *
     * @mvc Controller
     *
     * @param bool $network_wide
     */
    public function activate($network_wide = false) {
        require_once( UIFORM_FORMS_DIR . '/classes/uiform-installdb.php');
        $installdb = new Uiform_InstallDB();
        $installdb->install($network_wide);
        return true;
    }

    /**
     * Rolls back activation procedures when de-activating the plugin
     *
     * @mvc Controller
     */
    public function deactivate() {
        
        return true;
    }
    
   
    
    /**
     * Checks if the plugin was recently updated and upgrades if necessary
     *
     * @mvc Controller
     *
     * @param string $db_version
     */
    public function upgrade($db_version = 0) {
        return true;
    }

    /**
     * Checks that the object is in a correct state
     *
     * @mvc Model
     *
     * @param string $property An individual property to check, or 'all' to check all of them
     * @return bool
     */
    protected function is_valid($property = 'all') {
        return true;
    }

}

?>
