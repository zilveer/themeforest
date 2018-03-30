<?php
/**
 * Mental HTML shortcodes
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

/* ========================================================================= *\
   Section Shortcode
\* ========================================================================= */

add_shortcode( 'su_mental_section', 'mental_section_shortcode' );
function mental_section_shortcode( $atts, $content = null )
{
	$atts_orig = $atts;

	$atts = shortcode_atts( array(
		'no_container' => 'no',
	), $atts, 'su_mental_section' );

	ob_start();
	?>

	<?php echo get_section_header( $atts_orig ) ?>

	<?php if($atts['no_container'] != 'yes') echo '<div class="container">'; ?>
		<?php echo do_shortcode( $content ) ?>
	<?php if($atts['no_container'] != 'yes') echo '</div> <!-- container -->'; ?>

	<?php echo get_section_footer( $atts_orig ) ?>

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Animation Shortcode
\* ========================================================================= */

add_shortcode( 'su_mental_animation', 'mental_animation_shortcode' );
function mental_animation_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'animate'       => '',
	), $atts, 'su_mental_animation' );

	ob_start();
	?>

	<div <?php if ( ! empty( $atts['animate'] ) ) { echo ' data-animate="' . $atts['animate'] . '" '; } ?>>
		<?php echo do_shortcode( $content ) ?>
	</div> <!-- animated span -->

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Creative Minds Section
\* ========================================================================= */

add_shortcode( 'su_mental_creative_minds', 'mental_creative_minds_shortcode' );
function mental_creative_minds_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
			'id' => 'creative-mind-' . rand( 1, 999 ),
			'title' => '',
			'description' => '',
			'padding_top' => '',
			'padding_bottom' => '',
			'background_color' => '#FFFFFF',
			'background_image' => '',
			'background_parallax_image'  => '',
			'background_parallax_ratio' => 0.5,
			'background_parallax_offset'=> '-150',
			'background_video' => '',
			'background_video_opacity' => 0.1,
			'full_height' => 'no',
			'columns_count' => '',
			'classes'=> '',
	), $atts, 'su_mental_creative_minds' );

	ob_start();
	?>

	<?php echo get_section_header( $atts ) ?>

	<div class="creative-minds cm-cols-<?php echo $atts['columns_count']; ?>">
		<div class="row-cm">

			<?php echo do_shortcode( $content ) ?>

		</div>
	</div>

	<?php echo get_section_footer( $atts ) ?>

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Creative Minds Item
\* ========================================================================= */

add_shortcode( 'su_mental_creative_minds_item', 'mental_creative_minds_item_shortcode' );
function mental_creative_minds_item_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'title'       => '',
		'description' => '',
		'image'       => '',
		'active'      => 'no',
	), $atts, 'su_mental_creative_minds_item' );

	if( is_numeric( $atts['image'] ) ) {
		if( $img_data = wp_get_attachment_image_src( $atts['image'], 'medium' ) )
			$atts['image'] = $img_data[0];
	}

	ob_start();
	?>

	<div class="col-cm <?php echo ( $atts['active'] == 'yes' ) ? 'active' : '' ?>">
		<figure class="cm-item">
			<img src="<?php echo esc_url($atts['image']); ?>" alt="">
			<figcaption>
				<div class="middle">
					<div class="middle-inner">
						<h4 class="cm-title" data-animate="fadeInDown"><?php echo esc_html($atts['title']); ?></h4>
						<p class="cm-descr"><?php echo esc_html($atts['description']); ?></p>
					</div>
				</div>
			</figcaption>
		</figure>

	</div>

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Qoute Section
\* ========================================================================= */

add_shortcode( 'su_mental_quote_section', 'mental_quote_section_shortcode' );
function mental_quote_section_shortcode( $atts, $content = null )
{
	$atts_orig = $atts;

	$atts = shortcode_atts( array(
		'quote'       => '',
		'author' => '',
		'animate' => ''
	), $atts, 'su_mental_quote_section' );

	$atts_orig['classes'] = isset($atts_orig['classes']) ? $atts_orig['classes'] : '' . ' st-padding-xl';

	ob_start();
	?>

	<?php echo get_section_header( $atts_orig ) ?>

	<div class="container testimonial" <?php if ( $atts['animate'] ) echo 'data-animate="' . esc_attr( $atts['animate'] ) . '"'; ?>>
		<h3 class="citation-big">&#8220;<?php echo esc_html($atts['quote']); ?>&#8221;</h3>

		<p class="author-big"><?php echo esc_html($atts['author']); ?></p>
	</div> <!-- container -->

	<?php echo get_section_footer( $atts_orig ) ?>

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Page Header Section
\* ========================================================================= */

add_shortcode( 'su_mental_page_header_section', 'mental_page_header_section_shortcode' );
function mental_page_header_section_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'header_main'       => '',
		'header_tag'        => '2',
		'header_sub' => '',
		'color_main' => '',
		'color_sub' => '',
		'background_color_main' => '',
		'background_color_sub' => '',
	), $atts, 'su_mental_page_header_section' );

	ob_start();
	?>

	<h<?php echo esc_attr( $atts['header_tag'] ); ?> class="header-main" style="color: <?php echo esc_attr( $atts['color_main'] ); ?>; background-color: <?php echo esc_attr( $atts['background_color_main'] ); ?>;"><?php echo esc_html($atts['header_main']); ?></h<?php echo esc_attr( $atts['header_tag'] ); ?>>
	<span class="header-sub" style="color: <?php echo esc_attr( $atts['color_sub'] ); ?>; background-color: <?php echo esc_attr( $atts['background_color_sub'] ); ?>;"><?php echo esc_html($atts['header_sub']); ?></span>

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Our Services Item
\* ========================================================================= */

add_shortcode( 'su_mental_our_services_item', 'mental_our_services_item_shortcode' );
function mental_our_services_item_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'title'       => '',
		'description' => '',
		'icon'        => '',
		'custom-icon' => '',
		'animate'     => ''
	), $atts, 'su_mental_our_services_item' );

	ob_start();
	?>

	<div class="col-md-4" <?php if ( ! empty( $atts['animate'] ) ) { echo 'data-animate="' . $atts['animate'] . '"'; } ?>>
		<div class="services-item">

		<?php if(!empty($atts['icon'])):?>
			<span class="sws-icon <?php echo esc_attr($atts['icon']) ?>"></span>
		<?php endif;?>

		<?php if( !empty($atts['custom-icon'])):?>
				<span class="text-center center-block"><img src="<?php echo esc_url($atts['custom-icon']) ?>" alt="" class="custom-icon"></span>
		<?php endif;?>

			<h5><?php echo esc_html($atts['title']); ?></h5>

			<p><?php echo wp_kses($atts['description'], mental_allowed_tags() ); ?></p>
		</div>
	</div>

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Testimonials
\* ========================================================================= */

add_shortcode( 'su_mental_testimonials', 'mental_testimonials_shortcode' );
function mental_testimonials_shortcode( $atts, $content = null )
{

	$atts = shortcode_atts( array(
		'limit' => 5,
	), $atts, 'su_mental_testimonials' );

	$rnd = rand( 1, 999 );

	$testimonials = new WP_Query( array(
		'tax_query'      => array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array(
					'post-format-quote',
				),
				'operator' => 'IN'
			)
		),
		'posts_per_page' => $atts['limit']
	) );

	ob_start();
	?>

	<div id="carousel-testimonials-<?php echo (int) $rnd; ?>" class="carousel-testimonials carousel slide"
	     data-ride="carousel">

		<!-- Wrapper for slides -->
		<div class="carousel-inner text-center testimonials">

			<?php if ( $testimonials->have_posts() ) : $i = 0;
				while( $testimonials->have_posts() ) : $testimonials->the_post(); ?>

					<?php $qoute_format_meta = get_post_meta( get_the_ID(), 'quote_format', true ); ?>

					<div class="item <?php echo ( $i == 0 ) ? 'active' : '' ?> testimonial">
						<p class="citation"><?php echo get_the_content() ?></p>
						<?php if ( ! empty( $qoute_format_meta['author'] ) ): ?>
							<p class="author"><?php echo esc_html($qoute_format_meta['author']); ?></p>
						<?php endif ?>
					</div>

					<?php $i ++; endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>

		</div>

		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php for ( $j = 0; $j < $i; $j ++ ): ?>
				<li data-target="#carousel-testimonials-<?php echo (int) $rnd; ?>" data-slide-to="<?php echo (int) $j; ?>"
				    class="<?php echo ( $j == 0 ) ? 'active' : '' ?>"></li>
			<?php endfor ?>
		</ol>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-testimonials-<?php echo (int) $rnd; ?>" data-slide="prev">
			<span></span>
		</a>
		<a class="right carousel-control" href="#carousel-testimonials-<?php echo (int) $rnd; ?>" data-slide="next">
			<span></span>
		</a>

	</div> <!-- carousel -->

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Pricing table
\* ========================================================================= */

add_shortcode( 'su_mental_pricing_table', 'mental_pricing_table_shortcode' );
function mental_pricing_table_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'title' => '',
		'price' => '',
		'link' => '',
		'active' => 'no',
		'button' => 'yes',
		'button_text' => __( 'Buy it now', 'mental' ),
		'items' => '',
		'columns' => '4',
		'animate' => '',
	), $atts, 'su_mental_pricing_table' );

	$items = explode( ',', $atts['items'] );

	ob_start();
	?>

	<div class="col-md-<?php echo (int) $atts['columns'] ?>" <?php if ( ! empty( $atts['animate'] ) ) { echo 'data-animate="' . $atts['animate'] . '"'; } ?>>
		<div class="price-table <?php echo ( $atts['active'] == 'yes' ) ? 'active' : '' ?>">
			<header class="price-header">
				<h3><?php echo esc_html($atts['price']); ?></h3>

				<p><?php echo esc_html($atts['title']); ?></p>
			</header>
			<ul class="price-descr">
				<?php foreach ( $items as $item ): ?>
					<li><?php echo esc_html($item); ?></li>
				<?php endforeach ?>
			</ul>
	<?php if ( $atts['button'] == 'yes' ): ?>
			<footer class="price-footer">
				<a href="<?php echo esc_url($atts['link']); ?>" class="btn btn-default"><?php echo esc_html($atts['button_text']); ?></a>
			</footer>
	<?php endif ?>
		</div>
	</div>

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Pie Chart
\* ========================================================================= */

add_shortcode( 'su_mental_pie_chart', 'mental_pie_chart_shortcode' );
function mental_pie_chart_shortcode( $atts, $content = null )
{
	if( $skin_preset = get_mental_option('skin_preset') ) {
		$preset = Azl_Settings_Machine::instance()->get_skin( $skin_preset );;
		$color = get_mental_option( 'color_primary', isset($preset['color_primary']) ? $preset['color_primary'] : '' );
	}

	$atts = shortcode_atts( array(
		'title' => '',
		'value' => 50,
		'color' => empty($color) ? '#76d898' : $color,
	), $atts, 'su_mental_pie_chart' );

	ob_start();
	?>

	<div class="text-center">
		<input class="knob animate" data-width="170" data-min="0" data-max="100" data-percents="true" data-readOnly=true
		       data-fgColor="<?php echo esc_attr($atts['color']); ?>" data-thickness=".15" value="<?php echo esc_attr($atts['value']); ?>">
		<span class="pie-label"><?php echo esc_html($atts['title']); ?></span>
	</div>

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Call to Action
\* ========================================================================= */

add_shortcode( 'su_mental_call_to_action', 'mental_call_to_action_shortcode' );
function mental_call_to_action_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'title'           => '',
		'button_position' => 'bottom',
		'button_text'     => 'Lets go',
		'link'            => '',
		'animate'         => '',
	), $atts, 'su_mental_call_to_action' );

	ob_start();
	?>

	<?php if ( $atts['button_position'] == 'bottom' ): ?>

		<div class="well call-to-action text-center" <?php if ( ! empty( $atts['animate'] ) ) { echo 'data-animate="' . esc_attr($atts['animate']) . '"'; } ?>>
			<h3><?php echo esc_html($atts['title']); ?></h3>
			<a href="<?php echo esc_attr($atts['link']); ?>" class="btn btn-primary btn-lg btn-wider"><?php echo esc_html($atts['button_text']); ?></a>
		</div>

	<?php else: ?>

		<div class="well call-to-action text-center" <?php if ( ! empty( $atts['animate'] ) ) { echo 'data-animate="' . esc_attr($atts['animate']) . '"'; } ?>>
			<div class="row">
				<div class="col-lg-8">
					<h3><?php echo esc_html($atts['title']) ?></h3>
				</div>
				<div class="col-lg-4">
					<a href="<?php echo esc_attr($atts['link']); ?>" class="btn btn-primary btn-lg btn-wider"><?php echo esc_html($atts['button_text']); ?></a>
				</div>
			</div>
		</div>

	<?php endif ?>

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Progress Bar
\* ========================================================================= */

add_shortcode( 'su_mental_progress_bar', 'mental_progress_bar_shortcode' );
function mental_progress_bar_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'title' => '',
		'value' => '',
	), $atts, 'su_mental_progress_bar' );

	ob_start();
	?>

	<div class="progress-bar-block">
		<label><?php echo esc_html($atts['title']); ?></label>

		<div class="value"><?php echo esc_html($atts['value']); ?>%</div>
		<div class="progress">
			<div class="progress-bar animate" role="progressbar" aria-valuenow="<?php echo (int) $atts['value'] ?>"
			     aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (int) $atts['value'] ?>%;">
			</div>
		</div>
	</div>

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Accordion
\* ========================================================================= */

add_shortcode( 'su_mental_accordion', 'mental_accordion_shortcode' );
function mental_accordion_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'id' => 'accordion',
	), $atts, 'su_mental_accordion' );

	ob_start();
	?>

	<div id="<?php echo esc_attr($atts['id']); ?>">
		<?php echo do_shortcode( $content ) ?>
	</div>

	<?php
	return ob_get_clean();
}

/* ========================================================================= *\
   Accordion Panel
\* ========================================================================= */

add_shortcode( 'su_mental_accordion_panel', 'mental_accordion_panel_shortcode' );
function mental_accordion_panel_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'title'     => '',
		'parent_id' => 'accordion',
		'opened'    => 'no',
	), $atts, 'su_mental_accordion_panel' );

	$collapse_id = 'collapse' . rand( 0, 9999 );

	ob_start();
	?>

	<div class="accordion-group panel">
		<a class="accordion-header" data-toggle="collapse" data-parent="#<?php echo esc_attr($atts['parent_id']) ?>" href="#<?php echo esc_attr($collapse_id); ?>">
			<?php echo esc_html($atts['title']); ?>
		</a>

		<div id="<?php echo esc_attr($collapse_id); ?>" class="collapse <?php echo ($atts['opened'] == 'yes') ? 'in' : '' ?>">
			<div class="accordion-body">
				<?php echo wpautop( do_shortcode( $content ) ) ?>
			</div>
		</div>
	</div>

	<?php
	return ob_get_clean();
}


/* ========================================================================= *\
   Some fun facts
\* ========================================================================= */

add_shortcode( 'su_mental_sff', 'mental_sff_shortcode' );
function mental_sff_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'title'   => '',
		'value'   => '1000',
		'opened'  => 'no',
		'icon'    => '',
		'custom-icon'    => '',
		'animate' => ''
	), $atts, 'su_mental_sff' );

	ob_start();
	?>

	<div class="some-ff-block" <?php if ( ! empty( $atts['animate'] ) ) { echo 'data-animate="' . $atts['animate'] . '"'; } ?>>
		<?php if(!empty($atts['icon'])):?>
		<span class="smm-icon <?php echo esc_attr($atts['icon']); ?>"></span>
		<?php endif;?>
		<?php if( !empty($atts['custom-icon'])):?>
				<span class="text-center center-block"><img src="<?php echo esc_url($atts['custom-icon']) ?>" alt="" class="custom-icon"></span>
		<?php endif;?>
		<div class="smm-descr">
			<em><?php echo esc_html($atts['value']); ?></em>

			<p><?php echo esc_html($atts['title']); ?></p>
		</div>
	</div>

	<?php
	return ob_get_clean();
}

/* ========================================================================= *\
   Icon Block
\* ========================================================================= */

add_shortcode( 'su_mental_contact_p', 'mental_contact_p_shortcode' );
function mental_contact_p_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'type'    => 'address-block',
		'animate' => ''
	), $atts, 'su_mental_contact_p' );

	ob_start();
	?>

	<div class="<?php echo esc_attr($atts['type']); ?>" <?php if ( ! empty( $atts['animate'] ) ) { echo 'data-animate="' . esc_attr($atts['animate']) . '"'; } ?>>
		<?php echo wpautop( do_shortcode( $content ) ) ?>
	</div>

	<?php
	return ob_get_clean();
}

/* ========================================================================= *\
   Map
\* ========================================================================= */

add_shortcode( 'su_mental_map', 'mental_map_shortcode' );
function mental_map_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'coord'  => '34.040842, -118.233977',
		'zoom'   => '12',
		'height' => '400',
		'marker' => get_site_url() . '/wp-content/themes/mental/assets/img/map_marker.png',
		'id'     => 'map-'.rand(1,999),
	), $atts, 'su_mental_map' );

	ob_start();
	?>

	<div id="<?php echo esc_attr($atts['id']); ?>" style="height: <?php echo (int) $atts['height'] ?>px;"></div>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
	<script type="text/javascript">
		function initialize_google_map(){
			var myLatlng = new google.maps.LatLng(<?php echo esc_js($atts['coord']); ?>);
			var mapOptions = {
				zoom: <?php echo (int) $atts['zoom']; ?>,
				center: myLatlng,
				scrollwheel: false
			}
			var map = new google.maps.Map(document.getElementById('<?php echo esc_attr($atts['id']); ?>'), mapOptions);

			var styles = <?php echo json_encode( json_decode( stripslashes( get_mental_option('google_maps_styles') ) ) ); ?>;

			map.setOptions({styles: styles});

			var marker_icon = {
				url: '<?php echo esc_url($atts['marker']); ?>',
				size: new google.maps.Size(44, 49),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(22, 49)
			};

			var marker = new google.maps.Marker({
				position: myLatlng,
				map: map,
				title: 'M',
				<?php if( $atts['marker'] ) { echo 'icon: marker_icon'; } ?>
			});
		}
		google.maps.event.addDomListener(window, 'load', initialize_google_map);
	</script>

	<?php
	return ob_get_clean();
}

/* ========================================================================= *\
   Load more
\* ========================================================================= */

add_shortcode( 'su_mental_load_more', 'mental_load_more_shortcode' );
function mental_load_more_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'target_id' => '',
	), $atts, 'su_mental_load_more' );

	ob_start();
	?>

	<div class="load-more-block">
		<a href="#" class="load-more-button blog-loadmore"
		   data-blog-id="<?php echo esc_attr($atts['target_id']); ?>"><?php _e( 'Load more', 'mental' ) ?></a>
		<span class="loading-spinner"></span>
		<span class="no-more-items-sign"><?php _e( 'No more items', 'mental' ) ?></span>
	</div>

	<?php
	return ob_get_clean();
}

/* ========================================================================= *\
   Sidebar
\* ========================================================================= */

add_shortcode( 'su_mental_sidebar', 'mental_sidebar_shortcode' );
function mental_sidebar_shortcode( $atts, $content = null )
{
	ob_start();
	?>

	<?php get_template_part( 'sidebar' ) ?>

	<?php
	return ob_get_clean();
}

/* ========================================================================= *\
   Tabs
\* ========================================================================= */

add_shortcode( 'su_mental_tabs', 'mental_tabs_shortcode' );
function mental_tabs_shortcode( $atts, $content = null )
{
	if ( isset( $GLOBALS['tabs_count'] ) ) {
		$GLOBALS['tabs_count'] ++;
	} else {
		$GLOBALS['tabs_count'] = 0;
	}
	$GLOBALS['tab_count']          = 0;
	$GLOBALS['tabs_default_count'] = 0;

	$atts_map = mental_attribute_map( $content );

	// Extract the tab titles for use in the tab widget.
	if ( $atts_map ) {

		$tabs = array();

		// Get active
		$GLOBALS['tabs_default_active'] = true;
		foreach ( $atts_map as $check ) {
			if ( ! empty( $check["su_mental_tab"]["active"] ) ) {
				$GLOBALS['tabs_default_active'] = false;
			}
		}

		// Generate nav-tabs
		$i = 0;
		foreach ( $atts_map as $tab ) {
			$nav_tab_class = ( ! empty( $tab["su_mental_tab"]["active"] ) || ( $GLOBALS['tabs_default_active'] && $i == 0 ) ) ? 'active' : '';
			if ( isset( $tab["su_mental_tab"]['highlight'] ) ) {
				$nav_tab_class .= ' highlight';
			}

			$tabs[] = sprintf(
				'<li class="%s"><a href="#%s" data-toggle="tab">%s</a></li>',
				$nav_tab_class,
				'custom-tab-' . $GLOBALS['tabs_count'] . '-' . $i,
				$tab["su_mental_tab"]["title"]
			);
			$i ++;
		}

	}

	return sprintf(
		'<ul class="nav nav-tabs">%s</ul><div class="tab-content">%s</div>',
		( $tabs ) ? implode( $tabs ) : '',
		do_shortcode( $content )
	);

}

/* ========================================================================= *\
   Tab
\* ========================================================================= */

add_shortcode( 'su_mental_tab', 'mental_tab_shortcode' );
function mental_tab_shortcode( $atts, $content = null )
{
	$atts = shortcode_atts( array(
		'title'     => '',
		'active'    => 'no',
		'highlight' => 'no',
	), $atts, 'su_mental_tab' );

	if ( $GLOBALS['tabs_default_active'] && $GLOBALS['tabs_default_count'] == 0 ) {
		$atts['active'] = true;
	}
	$GLOBALS['tabs_default_count'] ++;

	$class = 'tab-pane';
	$class .= ( $atts['active'] == 'yes' ) ? ' in active' : '';

	$id = 'custom-tab-' . $GLOBALS['tabs_count'] . '-' . $GLOBALS['tab_count'];

	$GLOBALS['tab_count'] ++;

	return sprintf(
		'<div id="%s" class="%s">%s</div>',
		esc_attr( $id ),
		esc_attr( $class ),
		do_shortcode( $content )
	);

}

