<?php
/**
 * The Template for displaying a custom shortcode inside the Hero
 *
 * @author 		United Themes
 * @package 	Brooklyn
 * @version     1.0
 */

/* template config */
$ut_hero_shortcode = ut_return_hero_config('ut_hero_shortcode');

?>

<!-- hero section -->
<section class="ha-waypoint" data-animate-up="ha-header-hide" data-animate-down="ha-header-hide">

    <?php echo do_shortcode( ut_translate_meta($ut_hero_shortcode) ); ?>
    
</section>
<!-- end hero section -->