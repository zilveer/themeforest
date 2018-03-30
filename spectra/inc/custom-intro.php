<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			custom-intro.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */

global $spectra_opts, $wp_query, $post;

if ( class_exists( 'WooCommerce' ) && is_shop() ) {
    $intro_id = get_option( 'woocommerce_shop_page_id' );
} else {
	$intro_id = $wp_query->post->ID;
}

$intro_type = get_post_meta( $intro_id, '_intro_type', true );
if ( ! $intro_type || $intro_type === 'intro_none' ) {
	return;
}

$scroll_button = get_post_meta( $intro_id, '_scroll_button', true );
$overlay = get_post_meta( $intro_id, '_overlay', true );
$animated = get_post_meta( $intro_id, '_animated', true );
$intro_title = get_post_meta( $intro_id, '_intro_title', true );
$intro_subtitle = get_post_meta( $intro_id, '_intro_subtitle', true );

// Animated
if ( $animated && $animated === 'on' ) {
	$animated = 'anim-css';
} else {
	$animated = '';
}

$img_classes = '';

// Custom CSS
$custom_css = "";


// ==================================================== Intro Image ====================================================

if ( $intro_type === 'intro_image' || $intro_type === 'intro_full_image' || $intro_type === 'intro_full_image_content' ) : ?>

	<?php

		// Full resize image
		if ( $intro_type === 'intro_full_image' || $intro_type === 'intro_full_image_content' ) {
			$intro_full_image = 'intro-resize';
		} else {
			$intro_full_image = '';
		}

		// Get CSS data
		$img = get_post_meta( $intro_id, '_intro_image', true );
		$min_height = get_post_meta( $intro_id, '_min_height', true );

		// Min height only for intro_image
    	if ( $intro_type == 'intro_image' ) {
    		$min_height = 'min-height:' . $min_height . 'px';
		} else {
			$min_height = '';	
		}

		// Image effect
		$image_effect = get_post_meta( $intro_id, '_image_effect', true );


	 ?>
	
    <section class="intro-image intro <?php echo esc_attr( $intro_full_image ) ?> clearfix intro-id-<?php echo esc_attr( $intro_id ); ?>" style="<?php echo esc_attr( $min_height ) ?>">

    	<?php if ( $intro_type === 'intro_full_image_content' ) : ?>
    	<!-- Intro Content -->
    	<?php 
    		$intro_content = get_post_meta( $intro_id, '_intro_content', true );
    	?>
		<div class="intro-content <?php echo esc_attr( $animated ); ?>">
			<?php echo do_shortcode( $intro_content ); ?>			
		</div>

    	<?php endif; ?>

    	<?php if ( ( $intro_title !== '' || $intro_subtitle !== '' ) && ( $intro_type === 'intro_full_image' || $intro_type === 'intro_image' ) ) : ?>
        <!-- Captions -->
		<div class="intro-captions">
			<?php if ( $intro_title !== '' ) : ?>
			<h2 class="caption-title <?php echo esc_attr( $animated ); ?>"><?php echo esc_html( $intro_title ) ?></h2>
			<?php endif; ?>
			<?php if ( $intro_subtitle !== '' ) : ?>
			<h6 class="caption-subtitle <?php echo esc_attr( $animated ); ?>"><?php echo esc_html( $intro_subtitle ) ?></h6>
			<?php endif; ?>
		</div>
		<?php endif; ?>
        <!-- Image -->
        <?php

        	// If image exists
		   	if ( $img ) {
		   		$img = $spectra_opts->get_image( $img );
			} else {
				$img = '';
			}

        	// Intro Image
			if ( $image_effect && $image_effect === 'zoom' ) {
				$img_classes = 'image zoom';
			} else if ( $image_effect && $image_effect === 'parallax' ) {
				$img_classes = 'parallax';
			} else {
				$img_classes = 'image';
			}

			echo '<div class="' . esc_attr( $img_classes ) . '" style="background-image: url(' . esc_url( $img ) . ')"></div>';

        ?>
		
		<?php if ( $scroll_button && $scroll_button === 'on' ) : ?>
        <!-- Scroll Animation -->
        <a href="#page" class="scroll-anim smooth-scroll" data-offset="-110">
            <span class="scroll"></span>
            <span class="scroll-text"><?php _e( 'Scroll', SPECTRA_THEME ); ?></span>
        </a>
		<?php endif; ?>
       	<?php
       		// Overlay
			if ( $overlay && $overlay === 'black' ) {
				echo '<span class="overlay ' . esc_attr( $animated ) . '"></span>';
			} else if ( $overlay && $overlay === 'noise' ) {
				echo '<span class="overlay noise ' . esc_attr( $animated ) . '"></span>';
			} else if ( $overlay && $overlay === 'dots' ) {
				echo '<span class="overlay dots ' . esc_attr( $animated ) . '"></span>';
			}

       	 ?>
    </section>
<?php 

// ==================================================== Intro Map ====================================================

elseif ( $intro_type === 'gmap' ) : ?>
	<?php  
		$map_address = get_post_meta( $intro_id, '_map_address', true );
		if ( $map_address === '' ) {
			$map_address = 'Plac Defilad 1, Warszawa';
		}
		
	?>
	
	<section id="intro-map-id-<?php echo esc_attr( $intro_id ) ?>" class="intro-map intro gmap clearfix intro-id-<?php echo esc_attr( $intro_id ); ?>" data-address="<?php echo esc_attr( $map_address ) ?>" data-zoom="14" data-zoom_control="true" data-scrollwheel="false"></section>

<?php 

// ==================================================== Intro Youtube ====================================================

elseif ( $intro_type === 'intro_youtube' ) : ?>
	<?php  
		$yt_id = get_post_meta( $intro_id, '_yt_id', true );
		$min_height = get_post_meta( $intro_id, '_min_height', true );
		$img = get_post_meta( $intro_id, '_intro_image', true );

		// Custom fields
		$mute_video = get_post_meta( $intro_id, 'mute_video', true );
		if ( $mute_video == '' ) {
			$mute_video = 'true';
		}
		$autoplay_video = get_post_meta( $intro_id, 'autoplay_video', true );
		if ( $autoplay_video == '' ) {
			$autoplay_video = 'true';
		}
	?>
	<?php if ( $yt_id && $yt_id !== '' ) : ?>
	<section id="intro-youtube" class="intro-youtube videobg intro clearfix intro-id-<?php echo esc_attr( $intro_id ); ?>" style="min-height:<?php echo esc_attr( $min_height ) ?>px">
		
		<?php if ( $intro_title !== '' || $intro_subtitle !== '' ) : ?>
		<!-- Captions -->
		<div class="intro-captions">
			<?php if ( $intro_title !== '' ) : ?>
			<h2 class="caption-title <?php echo esc_attr( $animated ); ?>"><?php echo esc_html( $intro_title ) ?></h2>
			<?php endif; ?>
			<?php if ( $intro_subtitle !== '' ) : ?>
			<h6 class="caption-subtitle <?php echo esc_attr( $animated ); ?>"><?php echo esc_html( $intro_subtitle ) ?></h6>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php if ( $scroll_button && $scroll_button === 'on' ) : ?>
        <!-- Scroll Animation -->
        <a href="#page" class="scroll-anim smooth-scroll" data-offset="-110">
            <span class="scroll"></span>
            <span class="scroll-text"><?php _e( 'Scroll', SPECTRA_THEME ); ?></span>
        </a>
		<?php endif; ?>
		<div id="video-bg" class="image-video image" style="background-image: url(<?php echo esc_url( $spectra_opts->get_image( $img ) ) ?>);min-height:<?php echo esc_attr( $min_height ) ?>px;">
		<a id="bgndVideo" class="player" data-property="{videoURL:'http://youtu.be/<?php echo esc_attr( $yt_id ) ?>',containment:'#video-bg',autoPlay:<?php echo esc_attr( $autoplay_video ) ?>, mute:<?php echo esc_attr( $mute_video ) ?>, startAt:0, opacity:1, showControls:false, showYTLogo:false, quality:'hd720'}"></a>
		</div>
		<?php
       		// Overlay
			if ( $overlay && $overlay === 'black' ) {
				echo '<span class="overlay ' . esc_attr( $animated ) . '"></span>';
			} else if ( $overlay && $overlay === 'noise' ) {
				echo '<span class="overlay noise ' . esc_attr( $animated ) . '"></span>';
			} else if ( $overlay && $overlay === 'dots' ) {
				echo '<span class="overlay dots ' . esc_attr( $animated ) . '"></span>';
			}

       	 ?>
		
	</section>
	<?php endif; ?>
<?php

// ==================================================== Intro Content ====================================================

elseif ( $intro_type === 'intro_content' ) : ?>
	<?php  
		$intro_content = get_post_meta( $intro_id, '_intro_content', true );
		$intro_bg = get_post_meta( $intro_id, '_intro_bg', true );
	?>
	
	<section class="intro-custom-content intro clearfix intro-id-<?php echo esc_attr( $intro_id ); ?>" style="<?php echo esc_attr( $intro_bg ) ?>">
		<div class="container">
			
			<?php echo do_shortcode( $intro_content ); ?>

		</div>

	</section>
<?php

// ==================================================== Intro Page Title ====================================================

elseif ( $intro_type === 'intro_page_title' ) : ?>
	<?php  
		$page_subtitle = get_post_meta( $intro_id, '_page_subtitle', true );
		$title = get_the_title( $intro_id );
		
	?>
	
	<section class="intro-custom-content intro-page-title intro clearfix intro-id-<?php echo esc_attr( $intro_id ); ?>">
		<div class="container">
			<h1 class="content-title text-center"><?php echo esc_html( $title ) ?></h1>    
			<?php if ( $page_subtitle !== '' ) : ?>	
			<h4 class="page-subtitle"><?php echo esc_html( $page_subtitle ) ?></h4>
			<?php endif; ?>
		</div>
	</section>
<?php

// ==================================================== Intro Slider ====================================================

elseif ( $intro_type === 'intro_full_slider' || $intro_type === 'intro_slider' ) : ?>
	<?php
		$slider_id = get_post_meta( $intro_id, '_slider_id', true );
		
	?>

	<?php if ( $slider_id && $slider_id !== 'none' ) : ?>
	<?php 

		// Min height
		$min_height = get_post_meta( $intro_id, '_min_height', true );

		// Slider Settings
		if ( $intro_type === 'intro_full_slider' ) {
			$intro_resize = 'intro-resize';
			$slider_min_height = '';
		} else {
			$intro_resize = '';
	    	$slider_min_height = 'min-height:' . $min_height . 'px;';
		}

		// Zoom
		$zoom_effect = get_post_meta( $intro_id, '_zoom_effect', true );
		if ( $zoom_effect && $zoom_effect === 'on' ) {
			$zoom_effect = 'zoom';
		} else {
			$zoom_effect = '';
		}

		// Slider navigation
		$slider_nav = get_post_meta( $slider_id, '_slider_nav', true );
		if ( $slider_nav && $slider_nav === 'on' ) {
			$slider_nav = 'true';
		} else {
			$slider_nav = 'false';
		}

		// Slider pagination
		$slider_pagination = get_post_meta( $slider_id, '_slider_pagination', true );
		if ( $slider_pagination && $slider_pagination === 'on' ) {
			$slider_pagination = 'true';
		} else {
			$slider_pagination = 'false';
		}

		// Slider speed
		$slider_speed = get_post_meta( $slider_id, '_slider_speed', true );

		// Slider pause time
		$slider_pause_time = get_post_meta( $slider_id, '_slider_pause_time', true );
		if ( ! $slider_pause_time && $slider_pause_time === '0' ) {
			$slider_pause_time = 'false';
		}
	?>

    <section id="intro-slider" class="<?php echo esc_attr( $intro_resize ) ?> intro-slider carousel-slider intro <?php echo esc_attr( $zoom_effect ) ?> clearfix intro-id-<?php echo esc_attr( $intro_id ); ?>" data-slider-nav="<?php echo esc_attr( $slider_nav ) ?>" data-slider-pagination="<?php echo esc_attr( $slider_pagination ) ?>" data-slider-speed="<?php echo esc_attr( $slider_speed ) ?>" data-slider-pause-time="<?php echo esc_attr( $slider_pause_time ) ?>" style="<?php echo esc_attr( $slider_min_height ) ?>">
    	<?php  

    	/* Images ids */
		$images_ids = get_post_meta( $slider_id, '_custom_slider', true );

		if ( ! $images_ids || $images_ids == '' ) {
			 return '<p class="message error">' .  __( 'Slider error: Slider has no pictures or doesn\'t exists.', SPECTRA_THEME ) . '</p>';
		}

		$count = 0;
		$ids = explode( '|', $images_ids );
		$defaults = array(
			'title'                => '',
			'subtitle'             => '',
			'crop'                 => 'c',
			'slider_button_url'    => '',
			'slider_button_target' => '_self',
			'slider_button_title'  => ''
		);

		/* Start Loop */
		foreach ( $ids as $id ) {

			// Vars 
			$title = '';
			$subtitle = '';

			// Get image data
			$image_att = wp_get_attachment_image_src( $id );

			if ( ! $image_att[0] ) {
				continue;
			}
			
			/* Count */
		   	$count++;

			/* Get image meta */
			$image = get_post_meta( $slider_id, '_custom_slider_' . $id, true );

			/* Add default values */
			if ( isset( $image ) && is_array( $image ) ) {
				$image = array_merge( $defaults, $image );
			} else { 
				$image = $defaults;
			}

			// Min height
		   	if ( $min_height && $intro_type !== 'intro_full_slider'  ) {
				$slide_min_height = 'min-height:' . $min_height. 'px';
			} else {
				$slide_min_height = '';
			}

		   	?>
			<!-- Slide -->
	        <div class="slide" style="<?php echo esc_attr( $slide_min_height ) ?>">

				<?php if ( $image['title'] !== '' || $image['subtitle'] !== '' || $image['slider_button_url'] !== '' ) : ?>
		        <!-- Captions -->
				<div class="intro-captions">
					<?php if ( $image['title'] !== '' ) : ?>
					<h2 class="caption-title <?php echo esc_attr( $animated ); ?>"><?php echo esc_html( $image['title'] ) ?></h2>
					<?php endif; ?>
					<?php if ( $image['subtitle'] !== '' ) : ?>
					<h6 class="caption-subtitle <?php echo esc_attr( $animated ); ?>"><?php echo esc_html( $image['subtitle'] ) ?></h6>
					<?php endif; ?>
					<?php if ( $image['slider_button_url'] !== '' ) : ?>
					<a href="<?php echo esc_url( $image[ 'slider_button_url' ] ); ?>" class="stamp-button caption-button <?php echo esc_attr( $animated ); ?>" target="<?php echo esc_attr( $image[ 'slider_button_target' ] ); ?>"><span><?php echo esc_html( $image['slider_button_title'] ) ?></span></a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
	       
	            <!-- Image -->
	            <?php 
	            	/* Add image src to array */
				   	$image['src'] = wp_get_attachment_url( $id );
	             ?>
	            <div class="image slide-<?php echo esc_attr( $intro_id . '-' . $id ); ?>" style="background-image: url(<?php echo esc_url( $image['src'] ) ?>)" ></div>
	            <!-- Overlay -->
	            <?php
		       		// Overlay
					if ( $overlay && $overlay === 'black' ) {
						echo '<span class="overlay ' . esc_attr( $animated ) . '"></span>';
					} else if ( $overlay && $overlay === 'noise' ) {
						echo '<span class="overlay noise ' . esc_attr( $animated ) . '"></span>';
					} else if ( $overlay && $overlay === 'dots' ) {
						echo '<span class="overlay dots ' . esc_attr( $animated ) . '"></span>';
					}

		       	?>
	        </div>
	        <!-- /slide -->

		   	<?php
		}

    	?>
		
    </section>

	<?php endif; // Slider ID ?>

<?php endif; ?>