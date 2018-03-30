<?php
/**
 * @package WordPress
 * @subpackage Chocolate
 */
 
 $options = dt_get_theme_options();
?>

  <div id="aside">
    <div id="aside_t"></div>
    <div id="aside_c">

      <div id="logo">
        <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
          <?php if (isset($options['logo']) && $options['logo']): ?>
             <img src="<?php
				$up_dir = wp_upload_dir();
				$dir = $up_dir['baseurl'].'/dt_uploads/';
				//$file = get_template_directory_uri()).'/cache/'.$options['logo'];
				$url = $dir.$options['logo'];

        $tmp_src = dt_clean_thumb_url($url);

				echo esc_attr(get_template_directory_uri().'/thumb.php?src='.$tmp_src.'&w=220&zc=0&q=100&nores=1');
             ?>" alt="<?php wp_title(); ?>" />
          <?php else: ?>
             <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php wp_title(); ?>" width="181" height="110" />
          <?php endif; ?>
        </a>
      </div>
      
      <?php get_template_part( 'nav' ); ?>
      
      <?php
			if ( !defined('GAL_HOME') && !is_page_template('home-video.php') && !is_page_template('home-slider.php') && !is_page_template('home-static.php') && !is_page_template('home-3d.php') ) {
				get_template_part( 'widget_areas/primary-widget-area' );
			} else {
				get_template_part( 'widget_areas/homepage-widget-area' );
			}

      ?>

    </div>
    <div id="aside_b"></div>
  </div>