<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_simple_post_by_category_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_simple_post_by_category_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Simple Post By Category", 'crazyblog' ),
				"base" => "crazyblog_simple_post_by_category",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/post-with-ajax-navigation.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Number', 'crazyblog' ),
						"param_name" => "number",
						"description" => esc_html__( 'Enter number of posts with multiple of five for awesome look (i-e 3,6,9). "Note: For use Pagination please leave blank"', 'crazyblog' )
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => esc_html__( 'Select Categories', 'crazyblog' ),
						"param_name" => "cat",
						"value" => array_flip( crazyblog_get_categories( array( 'taxonomy' => 'category', 'hide_empty' => true ), true ) ),
						"description" => esc_html__( 'Choose posts categories for which posts you want to show', 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( 'Order', 'crazyblog' ),
						"param_name" => "order",
						"value" => array( esc_html__( 'Ascending', 'crazyblog' ) => 'ASC', esc_html__( 'Descending', 'crazyblog' ) => 'DESC' ),
						"description" => esc_html__( "Select sorting order ascending or descending for posts listing", 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Order By", 'crazyblog' ),
						"param_name" => "orderby",
						"value" => array_flip( array( 'date' => esc_html__( 'Date', 'crazyblog' ), 'title' => esc_html__( 'Title', 'crazyblog' ), 'name' => esc_html__( 'Name', 'crazyblog' ), 'author' => esc_html__( 'Author', 'crazyblog' ), 'comment_count' => esc_html__( 'Comment Count', 'crazyblog' ), 'random' => esc_html__( 'Random', 'crazyblog' ) ) ),
						"description" => esc_html__( "Select order by method for posts listing", 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( 'Description', 'crazyblog' ),
						"param_name" => "show_desc",
						"value" => array( esc_html__( 'Show', 'crazyblog' ) => 'true', esc_html__( 'Hide', 'crazyblog' ) => 'false' ),
						"description" => esc_html__( "Show/Hide Description", 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Limit', 'crazyblog' ),
						"param_name" => "limit",
						"description" => esc_html__( 'Enter number of character limit to show post description', 'crazyblog' ),
						'dependency' => array(
							'element' => 'show_desc',
							'value' => array( 'true' )
						),
					),
				)
			);
		}
	}

	public static function crazyblog_simple_post_by_category( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';

		$category = explode( ',', $cat );
		global $wp_query;
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'orderby' => $orderby,
			'order' => $order,
			'showposts' => $number,
			'posts_per_page' => get_option( 'posts_per_page' ),
		);
		if ( !empty( $category ) )
			$args['tax_query'] = array( array( 'taxonomy' => 'category', 'field' => 'slug', 'terms' => (array) $category ) );

		$query = new WP_Query( $args );
		$found_posts = crazyblog_set( $query, 'found_posts' );

		$year = get_the_time( 'Y' );
		$month = get_the_time( 'm' );
		$day = get_the_time( 'd' );
		?>
		<div class="row">
			<div class="texty-style">
				<?php
				if ( $query->have_posts() ):
					while ( $query->have_posts() ):
						$query->the_post();
						$post_cols = 'col-md-4';
						$size = 'crazyblog_454x344';
						$show_conents = $show_desc;
						include crazyblog_ROOT . "core/application/library/formats/uneven_posts_list/image.php";
					endwhile;
					wp_reset_postdata();
				endif;
				?> 
			</div>
		</div>        
		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
