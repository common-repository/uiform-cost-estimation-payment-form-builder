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
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <title> </title>
    <meta name="viewport" content="width=device-width, user-scalable=0">
    <meta name="author" content="Softdiscover Company">
    <meta http-equiv="X-UA-Compatible" content="IE=9">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0, private" >
    <meta http-equiv="Pragma" content="no-cache" >
    <meta http-equiv="Expires" content="0" >
     <!-- bootstrap -->
   <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/common/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/common/css/bootstrap-theme.css" rel="stylesheet">
    
     <!-- font awesome -->
    <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/common/css/font-awesome.min.css" rel="stylesheet">
   
    
    <!-- fton awesome -->
    <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/common/css/font-awesome.min.css" rel="stylesheet">
    <!-- jasny-->
    <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/common/js/bjasny/jasny-bootstrap.css" rel="stylesheet">
    <!-- bootstrap slider -->
    <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/backend/js/bslider/4.12.1/bootstrap-slider.min.css" rel="stylesheet">
    <!-- bootstrap touchspin -->
    <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/backend/js/btouchspin/jquery.bootstrap-touchspin.css" rel="stylesheet">
     <!-- bootstrap datetimepicker -->
    <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/backend/js/bdatetime/bootstrap-datetimepicker.css" rel="stylesheet">
     <!-- color picker -->
    <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/backend/js/colorpicker/bootstrap-colorpicker.css" rel="stylesheet">
    <!-- star rating -->
    <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/backend/js/bratestar/star-rating.css" rel="stylesheet">
    <!-- bootstrap switch -->
    <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/backend/js/bswitch/bootstrap-switch.css" rel="stylesheet">
    <!-- blueimp -->
    
    <!-- bootstrap gallery -->
    
    <!-- custom form -->
    <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/frontend/css/rockfm_form<?php echo $form_id;?>.css?<?php echo date("Ymdgis");?>" rel="stylesheet">
    <link href="<?php echo UIFORM_FORMS_URL; ?>/assets/frontend/css/css.css" rel="stylesheet">
    
     <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/frontend/js/iframe/iframeResizer.contentWindow.min.js"></script>
    <!-- jquery -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/common/js/jquery/1.11.3/jquery.min.js"></script>
    <!-- jqueryui -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/common/js/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <!-- bootstrap -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/common/js/bootstrap/3.2.0/bootstrap.min.js"></script>
    <!-- slider -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/backend/js/bslider/4.10.4/bootstrap-slider.js"></script>
    <!-- jasny -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/common/js/bjasny/jasny-bootstrap.js"></script>
    <!-- touchspin -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/backend/js/btouchspin/jquery.bootstrap-touchspin.js"></script>
    <!-- moment -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/backend/js/bdatetime/moment-with-locales.js"></script>
    <!-- dateiimepicker -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/backend/js/bdatetime/bootstrap-datetimepicker.js"></script>
    <!-- star ratingr -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/backend/js/bratestar/star-rating.js"></script>
    <!-- color picker -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/backend/js/colorpicker/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap switch -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/backend/js/bswitch/bootstrap-switch.js"></script>
    <!-- jquery form -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/frontend/js/jquery.form.js"></script>
    <!-- accounting -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/common/js/accounting/accounting.min.js"></script>
    <!-- blueimp -->
    
    <!-- uiform -->
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/frontend/js/js.js"></script>
    <script>
    window.iFrameResizer = {
        readyCallback: function(){
            /*var iframe_Id = window.parentIFrame.getId();*/
        }
    }
    </script>
    <script type="text/javascript" src="<?php echo UIFORM_FORMS_URL; ?>/assets/frontend/js/iframe/iframeResizer.contentWindow.min.js"></script>
     
      <?php
if (!empty($script_head)) {
    echo $script_head;
}
?>  
    <script type="text/javascript">
     
    $uifm(document).ready(function ($) {
          
        rocketfm();
        rocketfm.initialize();
        rocketfm.setExternalVars();
       //  $('#uifm_container_<?php echo $form_id;?>').append('<img src="<?php echo $imagesurl;?>/loader-form.gif"/></div>');
        rocketfm.loadform_init();
        
         
     });                
    
    </script>
    
  </head>
  <body>
         <?php
if (!empty($form_html)) {
    echo $form_html;
}
?> 
  </body>
</html>
<?php
$cntACmp = ob_get_contents();
//$cntACmp = str_replace("\n", '', $cntACmp);
//$cntACmp = str_replace("\t", '', $cntACmp);
//$cntACmp = str_replace("\r", '', $cntACmp);
$cntACmp = str_replace("//-->", ' ', $cntACmp);
$cntACmp = str_replace("//<!--", ' ', $cntACmp);
//@$cntACmp = eregi_replace("[[:space:]]+", " ", $cntACmp);
ob_end_clean();
echo $cntACmp;
?>