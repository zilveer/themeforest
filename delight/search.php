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


if (get_pix_option('pix_searchpage_sidebar')== 'leftsidebar'||(get_pix_option('pix_searchpage_sidebar')=='default' && get_pix_option('pix_general_sidebar')=='leftsidebar')) { 
get_sidebar();
}
wp_reset_query();
?>

<?php
if (get_pix_option('pix_searchpage_sliding_page')== 'open') { 
	$class = 'open_toggle';
} elseif (get_pix_option('pix_searchpage_sliding_page')== 'default' && get_pix_option('pix_sliding_page')=='open') {
	$class = 'open_toggle';
} elseif (get_pix_option('pix_searchpage_sliding_page')== 'always') { 
	$class = 'open_toggle always_open';
} elseif (get_pix_option('pix_searchpage_sliding_page')== 'default' && get_pix_option('pix_sliding_page')=='always') {
	$class = 'open_toggle always_open';
} 

if((get_pix_option('pix_searchpage_sidebar')=='nosidebar' && get_pix_option('pix_searchpage_maincolumn') == 'left')||get_pix_option('pix_searchpage_sidebar')== 'leftsidebar'){ 
	$left = 'margin-right';
} elseif (get_pix_option('pix_searchpage_sidebar')=='default'  && (get_pix_option('pix_general_sidebar')=='leftsidebar' || (get_pix_option('pix_general_sidebar')=='nosidebar' && get_pix_option('pix_general_template')=='right'))) {
	$left = 'margin-right';
}

if(get_pix_option('pix_searchpage_sidebar')=='nosidebar' && get_pix_option('pix_searchpage_maincolumn') == 'wide'){ $width = 'seveneighty'; }
?>
	<article class="<?php echo $class.' '.$left.' '.$width; ?>">
    	<div><div>
<?php if (have_posts()) : ?>
            <h1 class="entry-title"><?php printf( __( 'Results for: %s', 'delight' ), get_search_query() ); ?></h1>
            <div id="breadcrumb">
                <?php pix_breadcrumbs(); ?>
            </div><!-- #breadcrumb -->
            <?php while ( have_posts() ) : the_post();
    $meta_options = get_post_meta(get_the_ID(), $custom_options->get_the_id(), TRUE);
    $meta_title = get_post_meta(get_the_ID(), $custom_payoff->get_the_id(), TRUE);
    
    if(isset($meta_title['payoff']) && $meta_title['payoff']!='') {
        $the_title = $meta_title['payoff'];
    } else {
        $the_title = get_the_title();
    }
             ?>
    
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo get_the_title(); ?>"><?php echo $the_title; ?></a></h3>
                
                <?php if(isset($meta_title['subtitle']) && $meta_title['subtitle']!=''){?><p class="subtitle"><?php echo $meta_title['subtitle']; ?></p><?php } ?>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo get_the_title(); ?>" class="button small alignleft"><?php _e('Read more','delight'); ?></a>
                <div class="clear"></div>
            </div>
		<?php endwhile; ?>
<?php if(function_exists('pix_pagenavi')) { pix_pagenavi();} ?>
        </div></div>
<?php else : ?>
            <h2 class="entry-title"><?php printf( __( 'No results for: %s', 'delight' ), get_search_query() ); ?></h2>
            <div id="breadcrumb">
                <?php pix_breadcrumbs(); ?>
            </div><!-- #breadcrumb -->
            <p class="subtitle"><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'delight' ); ?></p>

<?php endif; ?>
    </article>

<?php 

if (get_pix_option('pix_searchpage_sidebar')== 'rightsidebar'||(get_pix_option('pix_searchpage_sidebar')=='default' && get_pix_option('pix_general_sidebar')=='rightsidebar')) { 
get_sidebar();
}
wp_reset_query();
?>

</section>
<?php get_footer(); ?>
