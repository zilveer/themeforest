<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_grid_view_posts_tabs_category_based_VC_ShortCode extends crazyblog_VC_ShortCode {

	static $counter = 0;

	public static function crazyblog_grid_view_posts_tabs_category_based_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Grid View Posts Tabs Category Based", 'crazyblog' ),
				"base" => "crazyblog_grid_view_posts_tabs_category_based_outpupt",
				"icon" => crazyblog_URI . '',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Number of Posts', 'crazyblog' ),
						"param_name" => "number",
						"description" => esc_html__( 'Enter the number of posts to show', 'crazyblog' )
					),
					array(
						"type" => "multiselect",
						"class" => "",
						"heading" => esc_html__( 'Select Categories', 'crazyblog' ),
						"param_name" => "cat",
						"value" => crazyblog_get_categories( array( 'taxonomy' => 'category', 'hide_empty' => true ), true ),
						"description" => esc_html__( 'Choose posts categories for which posts you want to show', 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( 'Order', 'crazyblog' ),
						"param_name" => "order",
						"value" => array(
							esc_html__( 'Ascending', 'crazyblog' ) => 'ASC',
							esc_html__( 'Descending', 'crazyblog' ) => 'DESC'
						),
						"description" => esc_html__( "Select sorting order ascending or descending for posts listing", 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Order By", 'crazyblog' ),
						"param_name" => "orderby",
						"value" => array_flip(
								array(
									'date' => esc_html__( 'Date', 'crazyblog' ),
									'title' => esc_html__( 'Title', 'crazyblog' ),
									'name' => esc_html__( 'Name', 'crazyblog' ),
									'author' => esc_html__( 'Author', 'crazyblog' ),
									'comment_count' => esc_html__( 'Comment Count', 'crazyblog' ),
									'random' => esc_html__( 'Random', 'crazyblog' )
								)
						),
						"description" => esc_html__( "Select order by method for posts listing", 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_grid_view_posts_tabs_category_based_outpupt( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';


		$navCats = explode( ',', $cat );
		if ( !empty( $navCats ) && count( $navCats ) > 0 ) {
			crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-bootstrap-min' ) );
			$counter = 0;
			echo '<ul class="nav nav-tabs" id="myTabs"> ';
			foreach ( $navCats as $c ) {
				$info = get_term_by( 'slug', $c, 'category' );
				$active = ($counter == 0) ? 'active' : '';
				echo '<li class="' . $active . '"><a href="#tabgrid' . $counter . self::$counter . '" data-toggle="tab">' . ucwords( $info->name ) . '</a></li> ';
				$counter++;
			}
			echo '</ul>';
			$counter2 = 0;
			echo '<div class="tab-content" id="myTabContent">';
			foreach ( $navCats as $c ) {
				$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'orderby' => $orderby,
					'order' => $order,
					'showposts' => $number,
					'category_name' => $c,
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					$active = ($counter2 == 0) ? 'active' : '';
					echo '<div id="tabgrid' . esc_attr( $counter2 . self::$counter ) . '" class="tab-pane fade in ' . esc_attr( $active ) . '">
						<div class="weekly-tabs-blog">
							<div class="row">';

					while ( $query->have_posts() ) {
						$query->the_post();
						$format = get_post_format();
						$post_meta = get_post_meta( get_the_ID(), 'crazyblog_post_meta', true );
						$meta = crazyblog_set( crazyblog_set( $post_meta, 'crazyblog_post_format_options' ), '0' );
						$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
						?>
						<div class="col-md-6">
							<div class="weekly-tab-post">
								<a class="image-link" href="#" title="">
									<?php the_post_thumbnail( 'crazyblog_370x197' ) ?>
								</a>
								<h4><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h4>
								<span><?php echo get_the_date( get_option( 'post_format' ) ); ?></span>
								<ul class="meta">
									<li><i class="fa fa-heart"></i> <?php echo crazyblog_post_counter( get_the_ID() ) ?></li>
									<li><i class="fa fa-eye"></i> <?php echo crazyblog_restyle_text( $view ) ?></li>
								</ul>
							</div>
						</div>
						<?php
					}
					wp_reset_postdata();
					echo '</div></div></div>';
				}
				$counter2++;
			}
			echo '</div>';
		}
		self::$counter++;
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
