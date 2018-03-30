<?php
if (!defined('ABSPATH')) exit();
/**
 * Template Name: Car Watch List
 */

get_header();

$car_compare_list = TMM_Ext_PostType_Car::get_compare_list();
$car_watch_list   = TMM_Ext_PostType_Car::get_watch_list();

if ( !empty($car_watch_list) ) {
	$GLOBALS['tmm_car_listing_layout_switcher'] = 1;
}

get_template_part('content', 'header');

if ( !empty($car_watch_list) ) { ?>

	<div id="change-items" class="row tmm-view-mode <?php echo tmm_get_car_listing_layout_type() ?>">

		<?php
		foreach ( $car_watch_list as $post_id ) {
			$GLOBALS['post_id'] = $post_id;
			get_template_part( 'article', 'car' );
		}
		?>

	</div><!--/ #change-items-->

<?php } else { ?>

	<p class="info"><?php _e( 'Ooops, You have not added any ad to your watch list yet!', 'cardealer' ); ?><a href="#" class="alert-close"></a></p>

<?php } ?>

<script type="text/javascript">
	var is_watch_list = true;
</script>

<?php get_footer(); ?>
