<?php
/*
 * Template Name: Page Builder
 */

$barcelona_is_pw_req = post_password_required();

get_header();

$barcelona_duplication_prevented_posts = array();
$barcelona_modules = get_post_meta( get_the_ID(), 'barcelona_mod', true );

if ( ! $barcelona_is_pw_req ) {
	barcelona_featured_img();
	barcelona_featured_posts();
}

?>
<div class="<?php echo esc_attr( barcelona_single_class() ); ?>">

	<div class="<?php echo esc_attr( barcelona_row_class() ); ?>">

		<main id="main" class="<?php echo esc_attr( barcelona_main_class() ); ?>">

			<?php if ( have_posts() ):

				while( have_posts() ): the_post();

					$barcelona_post_content = get_the_content();

					$barcelona_show_content = ( ! barcelona_is_empty( $barcelona_post_content ) && barcelona_get_option( 'show_content' ) == 'on' );

					echo $barcelona_show_content ? '<article id="post-'. intval( get_the_ID() ) .'" class="'. esc_attr( join( ' ', get_post_class() ) ) .'" role="article">' : '';

						barcelona_featured_img(); ?>

						<?php if ( $barcelona_show_content ): ?>
						<section class="post-content">
							<?php

							echo $barcelona_post_content;

							if ( ! $barcelona_is_pw_req ) {

								wp_link_pages( array(
									'before'   => '<div class="pagination"><span class="page-numbers title">' . esc_html__( 'Pages:', 'barcelona' ) . '</span>',
									'after'    => '</div>',
									'pagelink' => '%'
								) );

							}

							?>
						</section><!-- .post-content -->
						<?php endif;

					echo $barcelona_show_content ? '</article>' : '';

				endwhile;

			endif;

			if ( is_array( $barcelona_modules ) && ! $barcelona_is_pw_req ) {

				$barcelona_modules = array_values( $barcelona_modules );

				/*
				 * Display buttons only in the last module that has pagination buttons.
				 * "Infinite Scroll" can only be displayed if it is in the last module.
				 */
				foreach ( $barcelona_modules as $k => $v ) {

					if ( ! array_key_exists( 'pagination', $v ) || empty( $v['pagination'] ) ) {
						$barcelona_modules[ $k ]['pagination'] = $v['pagination'] = 'none';
					}

					if ( $k < ( count( $barcelona_modules ) - 1 ) && $v['pagination'] == 'infinite' ) {
						$barcelona_modules[ $k ]['pagination'] = 'none';
					}

					if ( in_array( $v['module_layout'], array( 'a', 'b', 'e', 'f', 'g', 'l' ) )
						&& ! in_array( $v['pagination'], array( 'numeric', 'nextprev' ) ) ) {
						$barcelona_modules[ $k ]['pagination'] = 'none';
					}

				}

				foreach ( $barcelona_modules as $k => $v ) {

					if ( isset( $barcelona_modules[ $k + 1 ] ) && $barcelona_modules[ $k + 1 ]['pagination'] != 'none' ) {
						$barcelona_modules[ $k ]['pagination'] = 'none';
					}

				}

				foreach ( $barcelona_modules as $k => $barcelona_mod ) {

					$barcelona_mod_header_classes = array( 'box-header' );
					$barcelona_prevent_duplication = array_key_exists( 'prevent_duplication', $barcelona_mod ) ? $barcelona_mod['prevent_duplication'] : 'on';

					/*
					 * Module Title
					 */
					$barcelona_mod_header = '';
					if ( ! empty( $barcelona_mod['title'] ) ) {
						$barcelona_mod_header .= '<h2 class="title">'. esc_html( $barcelona_mod['title'] ) .'</h2>';
						$barcelona_mod_header_classes[] = 'has-title';
					}

					/*
					 * Module Tabs
					 */
					if ( $barcelona_mod['module_layout'] != 'l' && $barcelona_mod['add_tabs'] == 'on' ) {

						/*
						 * Category Tabs
						 */
						if ( $barcelona_mod['tab_type'] == 't1' && ! empty( $barcelona_mod['filter_category'] ) && count( $barcelona_mod['filter_category'] ) > 1 ) {

							$barcelona_filtered_cats = get_categories( array(
								'orderby'       => 'date',
								'hide_empty'    => 0,
								'include'       => implode( ',', $barcelona_mod['filter_category'] )
							) );

							if ( ! empty( $barcelona_filtered_cats ) ) {

								$barcelona_mod_header_classes[] = 'has-tabs';

								$barcelona_mod_header .= '<div class="btn-group btn-group-items-'. count( $barcelona_filtered_cats ) .'" role="group">';
								foreach ( $barcelona_filtered_cats as $i => $barcelona_cat ) {
									$barcelona_mod_header .= '<button type="button" class="btn btn-default'. ( $i == 0 ? ' active' : '' ) .'" data-catid="'. intval( $barcelona_cat->term_id ) .'">'. esc_html( $barcelona_cat->name ) .'</button>';
								}
								$barcelona_mod_header .= '<button type="button" class="btn-toggle"><span class="fa fa-navicon"></span></button></div>';

							}

						}

						/*
						 * Statistical Tabs
						 */
						if ( $barcelona_mod['tab_type'] == 't2' ) {

							$barcelona_mod_header_classes[] = 'has-tabs';

							$barcelona_mod_header .= '<div class="btn-group btn-group-items-3" role="group">
														<button type="button" class="btn btn-default active">'. esc_html__( 'Most Recent', 'barcelona' ) .'</button>
														<button type="button" class="btn btn-default">'. esc_html__( 'Most Commented', 'barcelona' ) .'</button>
														<button type="button" class="btn btn-default">'. esc_html__( 'Most Viewed', 'barcelona' ) .'</button>
														<button type="button" class="btn-toggle"><span class="fa fa-navicon"></span></button>
													  </div>';

						}

					}

					if ( ! in_array( 'has-tabs', $barcelona_mod_header_classes ) ) {
						$barcelona_mod['tab_type'] = 'none';
					}

					if ( ! empty( $barcelona_mod_header ) ) {
						$barcelona_mod_header = '<div class="'. esc_attr( implode( ' ', $barcelona_mod_header_classes ) ) .'">'. $barcelona_mod_header .'</div>';
					}

					if ( $barcelona_mod['module_layout'] == 'a' ) {
						$barcelona_mod['max_number_of_posts'] = 3;
					} else if ( $barcelona_mod['module_layout'] == 'b' ) {
						$barcelona_mod['max_number_of_posts'] = 7;
					}

					if ( get_query_var( 'paged' ) ) {
						$paged = get_query_var( 'paged' );
					} elseif ( get_query_var( 'page' ) ) {
						$paged = get_query_var( 'page' );
					} else {
						$paged = 1;
					}

					if ( $barcelona_mod['pagination'] == 'none' ) {
						$paged = 1;
					}

					$barcelona_q_params = array(
						'posts_per_page'        => $barcelona_mod['max_number_of_posts'],
						'post_type'             => array( 'post', 'page' ),
						'post_status'           => 'publish',
						'ignore_sticky_posts'   => false,
						'no_found_rows'         => false,
						'paged'                 => $paged
					);

					if ( is_numeric( $barcelona_mod['posts_offset'] ) ) {
						$barcelona_q_params['offset'] = ( ( $paged - 1 ) * $barcelona_mod['max_number_of_posts'] ) + $barcelona_mod['posts_offset'];
					}

					if ( $barcelona_mod['tab_type'] != 't1' ) {
						$barcelona_q_params['post__not_in'] = $barcelona_duplication_prevented_posts;
					}

					/*
					 * Filter Posts by Category
					 */
					if ( ! empty( $barcelona_mod['filter_category'] ) ) {

						$barcelona_cat_in = array_values( $barcelona_mod['filter_category'] );
						if ( $barcelona_mod['tab_type'] == 't1' ) {
							$barcelona_cat_in = array( $barcelona_cat_in[0] );
						}

						$barcelona_q_params['category__in'] = $barcelona_cat_in;

					}

					/*
					 * Filter Posts by Post IDs
					 */
					if ( ! empty( $barcelona_mod['filter_post'] )  ) {

						$barcelona_q_params['post__in'] = array_values( array_filter( array_map( function ( $v ) {

							$v = trim( $v );
							if ( ! is_numeric( $v ) || $v <= 0 ) {
								$v = false;
							}

							return $v;

						}, explode( ',', $barcelona_mod['filter_post'] ) ), function( $v ) { return is_numeric( $v ); } ) );

					}

					/*
					 * Filter Posts by Tag Name
					 */
					if ( ! empty( $barcelona_mod['filter_tag'] ) ) {

						$barcelona_tag_names = array_filter( explode( ',', $barcelona_mod['filter_tag'] ) );
						if ( ! empty( $barcelona_tag_names ) ) {

							foreach( $barcelona_tag_names as $barcelona_tag ) {

								$barcelona_tag_term = get_term_by( 'name', trim( $barcelona_tag ), 'post_tag' );
								if ( $barcelona_tag_term ) {
									$barcelona_q_params['tag__in'][] = $barcelona_tag_term->term_id;
								}

							}

						}

					}

					/*
					 * Posts Ordering
					 */
					switch ( $barcelona_mod['orderby'] ) {
						case 'views':
							$barcelona_q_params['orderby'] = 'meta_value_num';
							$barcelona_q_params['meta_key'] = '_barcelona_views';
							break;
						case 'comments':
							$barcelona_q_params['orderby'] = 'comment_count';
							break;
						case 'votes':
							$barcelona_q_params['orderby'] = 'meta_value_num';
							$barcelona_q_params['meta_key'] = '_barcelona_vote_up';
							break;
						case 'random':
							$barcelona_q_params['orderby'] = 'rand';
							break;
						case 'posts':
							$barcelona_q_params['orderby'] = 'post__in';
							break;
						default:
							$barcelona_q_params['orderby'] = 'date';
					}

					$barcelona_q_params['order'] = ( $barcelona_mod['order'] != 'asc' ) ? 'DESC' : 'ASC';

					if ( $barcelona_mod['tab_type'] == 't2' ) {
						$barcelona_q_params['orderby'] = 'date';
						$barcelona_q_params['order'] = 'DESC';
					}

					/* We do not want html module to include wp_query */
					if ( $barcelona_mod['module_layout'] != 'l' ) {

						$barcelona_q = new WP_Query( $barcelona_q_params );
						$barcelona_async = false;

						$barcelona_mod_attr_data = array();

						if ( $barcelona_mod['module_layout'] != 'f' || ! is_single() ) {
							$barcelona_mod_attr_data['type'] = $barcelona_mod['tab_type'] . '_' . $k;
						}

						if ( $barcelona_mod['tab_type'] != 't1' ) {
							$barcelona_mod_attr_data['post-not'] = implode( ',', $barcelona_duplication_prevented_posts );
						}

						if ( $barcelona_q->have_posts() ) {

							if ( $barcelona_mod['tab_type'] != 't1' && $barcelona_prevent_duplication == 'on' ) {

								while ( $barcelona_q->have_posts() ) {
									$barcelona_q->the_post();
									$barcelona_duplication_prevented_posts[] = get_the_ID();
								}

								$barcelona_q->rewind_posts();

							}

						} else {

							$barcelona_mod['module_layout'] = 'none';

						}

						if ( $barcelona_mod['module_layout'] == 'g' ) {

							if ( $barcelona_mod['g_show_overlay_always'] == 'on' ) {
								$barcelona_show_overlay = true;
							}

							if ( $barcelona_mod['g_is_autoplay'] == 'on' ) {
								$barcelona_is_autoplay = true;
							}

						}

						$barcelona_mod_post_meta = array();
						if ( array_key_exists( 'post_meta_choices', $barcelona_mod ) ) {
							$barcelona_mod_post_meta = $barcelona_mod['post_meta_choices'];
						}

					} else {

						$barcelona_content = $barcelona_mod['html'];

					}

					include( locate_template( 'includes/modules/module-' . $barcelona_mod['module_layout'] . '.php' ) );

					if ( isset( $barcelona_q ) ) {
						barcelona_pagination( $barcelona_mod['pagination'], $barcelona_q );
					}

				}

			}

			?>
		</main>

		<?php get_sidebar(); ?>

	</div><!-- .row -->

</div><!-- .container -->

<?php

get_footer();