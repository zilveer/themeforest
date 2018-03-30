<?php
/**
 * Template Name: Home Page Template
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage trizzy
 * @since trizzy 1.0
 */

get_header();

$sliderstatus = ot_get_option( 'pp_slider_on' );
    if($sliderstatus == 'on') {
        if (function_exists('icl_get_languages')) {
              $languages = icl_get_languages('skip_missing=0&orderby=code');
               if(!empty($languages)){
                    foreach($languages as $l){
                        if(ICL_LANGUAGE_CODE == $l['language_code']) {
                        echo '<div class="container fullwidth-element home-slider">'; putRevSlider(ot_get_option( 'pp_revo_slider'.$l['language_code'])); echo "</div>";
                        }
                    }
               }
        } else {
            echo '<div class="container fullwidth-element home-slider">'; putRevSlider(ot_get_option( 'pp_revo_slider' )); echo "</div>";
        }
    }

while ( have_posts() ) : the_post(); ?>
<!-- 960 Container -->
<div class="container page-container home-page-container">
    <div <?php post_class("sixteen columns full-width"); ?>>
                <?php the_content(); ?>
    </div>
</div>
<?php endwhile; // end of the loop.

get_footer(); ?>