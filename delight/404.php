<?php
/**
 * @package WordPress
 * @subpackage Delight
 */

get_header(); ?>


<section>
<?php 
global $custom_options; 
global $custom_payoff; 


if (get_pix_option('pix_404_sidebar')== 'leftsidebar' || (get_pix_option('pix_404_sidebar')=='default' && get_pix_option('pix_general_sidebar')=='leftsidebar')) { 
get_sidebar();
}
wp_reset_query();
?>

<?php
if (get_pix_option('pix_404_sliding_page')== 'open') { 
	$class = 'open_toggle';
} elseif (get_pix_option('pix_404_sliding_page')== 'default' && get_pix_option('pix_sliding_page')=='open') {
	$class = 'open_toggle';
} elseif (get_pix_option('pix_404_sliding_page')== 'always') { 
	$class = 'open_toggle always_open';
} elseif (get_pix_option('pix_404_sliding_page')== 'default' && get_pix_option('pix_sliding_page')=='always') {
	$class = 'open_toggle always_open';
} 

if((get_pix_option('pix_404_sidebar')=='nosidebar' && get_pix_option('pix_404_maincolumn') == 'right')||get_pix_option('pix_404_sidebar')== 'leftsidebar'){ 
	$left = 'margin-right';
} elseif (get_pix_option('pix_404_sidebar')=='default' && (get_pix_option('pix_general_sidebar')=='leftsidebar' || (get_pix_option('pix_general_sidebar')=='nosidebar' && get_pix_option('pix_general_template')=='right'))) {
	$left = 'margin-right';
}

if(get_pix_option('pix_404_sidebar')=='nosidebar' && get_pix_option('pix_404_maincolumn') == 'wide'){ $width = 'seveneighty'; }
?>
	<article class="<?php echo $class.' '.$left.' '.$width; ?>">
    	<div><div>
            <h1 class="entry-title"><?php _e('Not Found','delight'); ?></h1>
            <div id="breadcrumb">
                <?php pix_breadcrumbs(); ?>
            </div><!-- #breadcrumb -->
    
            <div <?php post_class(); ?>>
                    <p><?php _e('Apologies, but the page you requested could not be found. Perhaps searching will help.','delight'); ?></p>
                
                <div class="clear"></div>
            </div>
        </div></div>
    </article>

<?php 

if (get_pix_option('pix_404_sidebar')== 'rightsidebar'||(get_pix_option('pix_404_sidebar')=='default' && get_pix_option('pix_general_sidebar')=='rightsidebar')) { 
get_sidebar();
}
wp_reset_query();
?>

</section>
<?php get_footer(); ?>
