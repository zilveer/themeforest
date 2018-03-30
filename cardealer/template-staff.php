<?php
if (!defined('ABSPATH')) exit();
/**
 * Template Name: -Theme Staff Page
 */

get_header();
get_template_part('content', 'header');

		$meta_query_array = array();
		if ( ! defined( 'ICL_LANGUAGE_CODE' ) ) {
			$meta_query_array[] = array(
				'key'     => '_icl_lang_duplicate_of',
				'value'   => '',
				'compare' => 'NOT EXISTS'
			);
		}

		$args = array(
			'post_type'      => TMM_Staff::$slug,
			'order'          => 'ASC',
			'orderby'        => 'post_title',
			'posts_per_page' => - 1,
			'meta_query'     => $meta_query_array,
			'status'     => 'publish',
		);

		$posts = get_posts($args);
		$cols_count = count($posts);
		$col_class = ' col-md-6';
		$max_cols = 4;
		if($cols_count === 2){
			$col_class = ' col-md-6';
			$max_cols = 2;
		}
		if($cols_count === 3){
			$col_class = ' col-md-4';
			$max_cols = 3;
		}
		if($cols_count >= 4){
			$col_class = ' col-md-3';
			$max_cols = 4;
		}
		$i = 0;

		global $wp_query;
		$old_wp_query = $wp_query;
		$wp_query = new WP_Query($args);
		?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

			$desc = get_post_meta($post->ID, 'desc', true);
			$custom = TMM_Staff::get_meta_data($post->ID);
			?>

			<?php
			if($i === 0){
			?>

			<div class="row padding-bottom-40 sales-reps">

			<?php
			}

			$i++;
			?>

			<div class="item-circled-3<?php echo $col_class; ?>">

				<div class="face-container">

					<div class="face">
						<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
							<img
								src="<?php echo TMM_Helper::get_post_featured_image( $post->ID, '280*280' ); ?>"
								alt="<?php the_title() ?>"/>
						<?php else: ?>
							<img src="<?php echo TMM_THEME_URI ?>/images/avatar.png"
							     alt="<?php the_title() ?>"/>
						<?php endif; ?>
					</div>

					<div class="spiner"></div>

				</div>

				<ul class="social-icons">
					<?php if (!empty($custom["facebook"])): ?>
						<li><a href="<?php echo get_post_meta($post->ID, 'facebook', true) ?>" title="<?php _e('Facebook', 'cardealer'); ?>" class="icon-facebook-squared"></a></li>
					<?php endif; ?>
					<?php if (!empty($custom["twitter"])): ?>
						<li><a href="<?php echo get_post_meta($post->ID, 'twitter', true) ?>" title="<?php _e('Twitter', 'cardealer'); ?>" class="icon-twitter-squared"></a></li>
					<?php endif; ?>
					<?php if (!empty($custom["gplus"])): ?>
						<li><a href="<?php echo get_post_meta($post->ID, 'gplus', true) ?>" title="<?php _e('Google+', 'cardealer'); ?>" class="icon-gplus-squared"></a></li>
					<?php endif; ?>
				</ul>

				<div class="item-content">
					<h4><?php the_title() ?></h4>
					<b><?php _e( 'Office', 'cardealer' ); ?>:</b>&nbsp;<?php echo get_post_meta( $post->ID, 'office_phone', true ) ?><br/>
					<b><?php _e( 'Mobile', 'cardealer' ); ?>:</b>&nbsp;<?php echo get_post_meta( $post->ID, 'mobile_phone', true ) ?><br/>
					<b><?php _e( 'Fax', 'cardealer' ); ?>:</b>&nbsp;<?php echo get_post_meta( $post->ID, 'fax', true ) ?><br/>
					<b><?php _e( 'Email', 'cardealer' ); ?>:</b>&nbsp;<a href="mailto:<?php echo get_post_meta( $post->ID, 'staff_email', true ) ?>"><?php echo get_post_meta( $post->ID, 'staff_email', true ) ?></a>
					<?php if(!empty($desc)){ ?>
						<p><?php echo $desc; ?></p>
					<?php } ?>
				</div>

			</div><!--/ .item-->

			<?php
			if($i === $max_cols){
				$i = 0;
				?>

				</div>
				<!--/ .row-->

			<?php
			}
			?>

		<?php
		endwhile;
		endif;

		$wp_query = $old_wp_query;
		wp_reset_postdata();
		?>

<?php
get_footer();

