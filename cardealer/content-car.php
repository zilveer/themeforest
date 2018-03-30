<?php
if (!defined('ABSPATH')) exit();

$car_compare_list = TMM_Ext_PostType_Car::get_compare_list();
$car_watch_list = TMM_Ext_PostType_Car::get_watch_list();
?>
<div id="change-items" class="row tmm-view-mode <?php echo tmm_get_car_listing_layout_type() ?>">

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			if ( ! defined( 'ICL_LANGUAGE_CODE' ) && get_post_meta( $post->ID, '_icl_lang_duplicate_of', 1 ) ) {
				continue;
			}

			$GLOBALS['post_id'] = $post->ID;
			get_template_part( 'article', 'car' );

		endwhile;
	else:
		get_template_part( 'content', 'nothingfound' );
	endif;
	?>
</div>
