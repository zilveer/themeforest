<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_masonary_posts_with_tabs_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_masonary_posts_with_tabs_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Masonary Posts with Tabs", 'crazyblog' ),
				"base" => "crazyblog_masonary_posts_with_tabs",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/masonary-post-with-tabs.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Number', 'crazyblog' ),
						"param_name" => "number",
						"description" => esc_html__( 'Enter number of posts', 'crazyblog' )
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
						"heading" => esc_html__( 'Load More', 'crazyblog' ),
						"param_name" => "show_loadmore",
						"value" => array( esc_html__( 'Show', 'crazyblog' ) => 'true', esc_html__( 'Hide', 'crazyblog' ) => 'false' ),
						"description" => esc_html__( "Show/Hide Load more button", 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_masonary_posts_with_tabs( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		?>
		jQuery(document).ready(function ($) {
		var increment = 0;
		jQuery(".loadmore").on("click", function () {
		increment++;

		if (increment == 3)
		increment = 1;

		var offset = jQuery("div.grid-post").length;
		var action = "load_masonary_posts";
		var orderby = "<?php echo esc_js( $orderby ) ?>";
		var order = "<?php echo esc_js( $order ) ?>";
		var cat = "<?php echo esc_js( $cat ) ?>";

		data = "action=" + action + "&offset=" + offset + "&orderby=" + orderby + "&order=" + order + "&cat=" + cat + "&increment=" + increment;
		$.ajax({
		type: "POST",
		url: ajaxurl,
		data: data,
		beforeSend: function () {
		jQuery(".load-btn > a").addClass("active");
		jQuery(".loading").append("<img src='<?php echo crazyblog_URI ?>assets/assets/ajax-loader.gif' class='loader' />");

		},
		success: function (response) {
		if (response != "true") {
		var isoOptions = {
		masonry: {
		columnWidth: 0.5
		}
		};
		jQuery(".load-btn > a").removeClass("active");
		jQuery(".masonary").append(response).isotope("reloadItems").isotope({sortBy: "original-order"});

		jQuery(".masonary").isotope("destroy");
		jQuery(".masonary").isotope(isoOptions);
		} else {
		jQuery(".loading").children("img").remove();
		jQuery(".load-btn a").html('<i class="fa fa-stop"></i><?php esc_html_e( 'No More Posts', 'crazyblog' ) ?>');
		jQuery(".load-btn a").css("pointer-events", "none");
		}

		}
		});
		return false;
		});
		});
		<?php
		$jsOutput = ob_get_contents();
		ob_end_clean();
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-slick', 'df-isotope', 'df-init-isotope' ) );
		$category = explode( ',', $cat );
		//printr($cat);

		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'orderby' => $orderby,
			'order' => $order,
			'showposts' => $number,
		);
		if ( !empty( $category ) )
			$args['tax_query'] = array( array( 'taxonomy' => 'category', 'field' => 'slug', 'terms' => (array) $category ) );

		$query = new WP_Query( $args );

		$no_image = '';
		$year = get_the_time( 'Y' );
		$month = get_the_time( 'm' );
		$day = get_the_time( 'd' );
		$sizes = array( 'crazyblog_343x410', 'crazyblog_376x350', 'crazyblog_343x410', 'crazyblog_343x410', 'crazyblog_376x350', 'crazyblog_376x350' );
		$walker = 0;
		?>

		<?php if ( !empty( $category ) ) : ?>
			<div class="options">
				<div class="option-combo">
					<ul id="filter" class="option-set" data-option-key="filter">
						<li><a href="#showall" data-option-value="*" class="selected"><?php esc_html_e( 'Show all', 'crazyblog' ); ?></a></li>
						<?php
						foreach ( $category as $c ) :
							$cat_object = get_category_by_slug( $c );
							?>
							<li><a href="#<?php echo esc_attr( crazyblog_set( $cat_object, 'slug' ) ); ?>" data-option-value=".<?php echo esc_attr( crazyblog_set( $cat_object, 'slug' ) ); ?>"><?php echo esc_html( crazyblog_set( $cat_object, 'name' ) ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div><!-- FILTER BUTTONS -->
		<?php endif; ?>
		<div class="row no-gap">
			<div class="masonary">
				<?php
				if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post();
						$cats = get_the_category( get_the_ID() );
						?>
						<div class="col-md-4 <?php
						foreach ( $cats as $c )
							echo crazyblog_set( $c, 'slug' ) . " ";
						?>">
							<div class="grid-post">
								<div class="grid-post-img">
									<span><i class="fa fa-link"></i></span>
									<?php the_post_thumbnail( $sizes[$walker] ); ?>
									<a href="<?php the_permalink(); ?>" title=""><i class="fa fa-link"></i></a>
								</div>
								<div class="cat">
									<?php echo crazyblog_get_post_categories( get_the_ID(), ', ' ); ?>
								</div>
								<ul class="meta">
									<li><a title="" href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>"><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
									<li><?php esc_html_e( 'By ', 'crazyblog' ); ?><a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>                            
								</ul>
								<h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
							</div><!--Grid Post -->
						</div>
						<?php
						$walker++;
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>

		<?php if ( $show_loadmore == "true" ) : ?>
			<div class="load-btn style2">
				<a class="loadmore" href="#" title=""><i class="fa fa-refresh"></i><?php esc_html_e( 'Load More', 'crazyblog' ); ?></a>
			</div>
		<?php endif; ?>

		<?php
		if ( $show_loadmore == "true" ) :
			wp_add_inline_script( 'crazyblog_df-script', $jsOutput );
		endif;
		?>


		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
