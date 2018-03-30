<?php if(file_exists('../../../../../wp-config.php')){include_once('../../../../../wp-config.php');} ?>
<?php if(!isset($_GET['wordpress'])){ ?>

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/admin/css/reset.css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/admin/css/960.css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/admin/css/style.css" />
    
<!-- Included JS Files -->
<script src="<?php bloginfo('template_url'); ?>/admin/js/jquery-1.7.1.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/admin/js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/admin/js/general.js"></script>
    
    
<?php } ?>
    
<style>
#outer-barG{
height:37px;
width:228px;
border:1px solid #db29c0;
overflow:hidden;
background-color:#ffffff}

.bar-lineG{
background-color:#db29c0;
float:left;
width:18px;
height:220px;
margin-right:20px;
margin-top:-88px;
-moz-transform:rotate(45deg);
-webkit-transform:rotate(45deg);
-o-transform:rotate(45deg);
-ms-transform:rotate(45deg);
}

.bar-animationG{
margin-left:168px;
width:268px;
-webkit-animation-name:bar-animationG;
-webkit-animation-duration:1.35s;
-webkit-animation-iteration-count:infinite;
-webkit-animation-direction:linear;
-moz-animation-name:bar-animationG;
-moz-animation-duration:1.35s;
-moz-animation-iteration-count:infinite;
-moz-animation-direction:linear;
-o-animation-name:bar-animationG;
-o-animation-duration:1.35s;
-o-animation-iteration-count:infinite;
-o-animation-direction:linear;
-ms-animation-name:bar-animationG;
-ms-animation-duration:1.35s;
-ms-animation-iteration-count:infinite;
-ms-animation-direction:linear;
}



@-webkit-keyframes bar-animationG{
0%{
margin-left:455px;
margin-top:19px}

100%{
margin-left:-128px;
margin-top:-37px}

}
</style>

<?php
global $wpdb;
$prefix = $wpdb->prefix;
?>
<?php
$templateUrl = get_bloginfo('template_url');
?>
<?php
$loadingBar = '<div class="progress"><div class="bar pink" style="width: 100%;"></div></div>';
$three_folder = '../../../../..';
?>