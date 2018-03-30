<?php
//define variables
$woocommerce_searchbar    = get_option('ka_woocommerce_searchbar');
$woocommerce_breadcrumbs  = get_option('ka_woocommerce_breadcrumbs');
$woocommerce_title        = get_option('ka_woocommerce_title');
?>

<div class="tools">
	<span class="tools-top"></span>
        <div class="frame">

<?php truethemes_before_article_title_hook();// action hook ?>

<h1><?php echo $woocommerce_title; ?></h1>
<?php if ($woocommerce_searchbar == "true"){get_template_part('searchform','childtheme');} ?>
<?php if ($woocommerce_breadcrumbs == "true"){ ?><p class="breadcrumb"><?php tt_woo_breadcrumbs(); ?></p><?php } ?>

<?php truethemes_after_searchform_hook();// action hook ?>

        </div><!-- END frame -->
	<span class="tools-bottom"></span>
</div><!-- END tools -->