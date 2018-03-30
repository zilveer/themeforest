<?php
//define variables
$woocommerce_searchbar    = get_option('ka_woocommerce_searchbar');
$woocommerce_breadcrumbs  = get_option('ka_woocommerce_breadcrumbs');
$woocommerce_title        = get_option('ka_woocommerce_title');
$header_shadow_style       = get_option('ka_header_shadow_style');//@since 4.8

//define new options for backward compatible
if ('' == $header_shadow_style): 'no-shadow' ==  $header_shadow_style; endif;
?>

<div class="tools full-width-page-title-bar">
	<?php
	//header shadow style
	if ('no-shadow' != $header_shadow_style): ?>
	<div class="karma-header-shadow"></div><!-- END karma-header-shadow --> 
	<?php endif; //END header shadow style ?>
	
	<div class="tt-container">

<?php truethemes_before_article_title_hook();// action hook ?>

<h1><?php echo $woocommerce_title; ?></h1>
<?php if ($woocommerce_searchbar == "true"){get_template_part('searchform','childtheme');} ?>
<?php if ($woocommerce_breadcrumbs == "true"){ ?><p class="breadcrumb"><?php tt_woo_breadcrumbs(); ?></p><?php } ?>

<?php truethemes_after_searchform_hook();// action hook ?>

	</div><!-- END tt-container -->
</div><!-- END full-width-page-title-bar -->