<?php get_header(); ?>

<div class="main-wrapper">
<?php 
$one_page_enabled = of_get_option('qs_one_page');
if(!$one_page_enabled) :
    include_once 'includes/index-loop.php';
else:
    include_once 'includes/one-page-loop.php';
endif;
?>
    
    <div class="push"></div>
</div>
    
<div id="scroll-top">
	<a href="#top"><span></span></a>	
</div>	


<?php get_footer(); ?>
