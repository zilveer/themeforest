<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$template = get_option('template');

switch( $template ) {
	case 'twentyeleven' :
		echo '<div id="primary"><div id="content" role="main">';
		break;
	case 'twentytwelve' :
		echo '<div id="primary" class="site-content"><div id="content" role="main">';
		break;
	case 'twentythirteen' :
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
		break;
	default :

		global $post;
		require(get_template_directory().'/inc/cb-general-options.php');
		require(get_template_directory().'/inc/cb-page-options.php');

		require(get_template_directory().'/inc/cb-little-head.php');
		$hst='';
		$hst1='';
		$hst2='';
		if($headtfc!=''||$headtsc!='') {
			if($headtfc!='') $hst1='color:'.$headtfc.';';
			if($headtsc!='') $hst2='text-shadow:1px 1px '.$headtsc.';';
			$hst='style="'.$hst1.$hst2.'"';
		}
		if($sidebar_shop!='')$side='yes';
		?>

		<?php if($show_bread=='yes'&&$header_type!='slider_head'){ echo'<div class="bread_wrap"><div class="wrapper_p"><div id="breadcrumbs">';?>
		<?php woocommerce_breadcrumb();?>
</div>
<div class="cl"></div>
</div>
</div>
		<?php } ?>


		<?php if(is_product_category()) { ?>
<div class="wrapper_p product_style_wrap">
	<div class="products_style">
		<a class="grid first active"><i class="icon-th-large"></i> <?php _e('Grid','cb-cosmetico'); ?>
		</a><a class="list"><i class="icon-align-justify"></i> <?php _e('List','cb-cosmetico'); ?>
		</a>
	</div>
</div>
		<?php } ?>

</div>

</div>
<!-- bg_head end -->

<div id="middle" class="woo">
	<div
		class="wrapper_p <?php if($fullg=='yes'&&$cb_type=='gallery') echo 'fullgallery'; ?>">

		<?php if($sidebar_shop=='left') { ?>
		<div id="sidebar_l">
		<?php dynamic_sidebar('shop'); ?>
		</div>
		<!-- sidebar #end -->
		<?php } ?>


		<div id="page" <?php if($side=='yes') { ?>
			class="side <?php if(is_product()) echo ' single_product '; if($sidebar_shop=='left') echo 'side_right'; else echo 'side_left'; ?>"
			<?php } ?>>

			<?php if($header_type!='slider_head'&&!is_product()) { ?>
			<div
				class="wrapper_p <?php if($header_bg_image=='') echo 'head_title'; if($woo_cat=='yes'&&is_product_category()) echo ''; else echo ' prodnobg' ?> product_category_def">
				<?php if(($title=='yes'||$title=='')&&$cb_type!='home') echo '<h1 class="title">';?>
				<?php ;
				if (strpos(woocommerce_page_title(false), 'Search Results') !== false) {
					echo ''; 
				} else echo woocommerce_page_title(false);
				?>
				</h1>
				<?php 
					global $wp_query;
					$cat = $wp_query->get_queried_object();
					if(is_product_category()) {
echo '<div class="term-description">'.$cat->description.'</div>';
   $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
					$image = wp_get_attachment_url( $thumbnail_id );
					if($image) echo '<img src="'.$image.'" alt="category image" class="category_image"/>';
} ?>
				<div class="cl"></div>
			</div>
			<div class="cl"></div>
			<?php } ?>


			<?php break; } //switch end ?>