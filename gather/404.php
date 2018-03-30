<?php
/**
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

global $cththemes_options;

get_header('404'); 
?>
<main id="top" class="text-center vertical-space-lg">
    <div class="container">
        <!-- Startup Logo -->
        <div class="logo">
            <?php _e('<h1 class="head404">404</h1>','gather');?>
        </div>
        <!-- Hero Title -->
        <h1 class="headline"><?php _e('Oops!','gather');?></h1>
        <!-- Sub Title -->
        <?php if($cththemes_options['404_intro']) :?>
		<h5 class="headline-support"><?php echo wp_kses_post($cththemes_options['404_intro'] ); ?></h5>
		<?php endif;?>
    </div>
</main>
<p class="text-center"> <a href="<?php echo esc_url(home_url('/' ) );?>" class="btn btn-link"><?php _e(' ← Back to Home','gather');?></a> </p>

<?php get_footer(); ?>