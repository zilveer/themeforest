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

$the_category = get_query_var('cat');
$pix_array_category = get_pix_option('pix_array_category_'.$the_category);

if ($pix_array_category[1]== 'leftsidebar'|| ($pix_array_category[1]=='default' && get_pix_option('pix_general_sidebar')=='leftsidebar')) { 
get_sidebar();
}
wp_reset_query();
?>

<?php
if ($pix_array_category[0]== 'open') { 
	$class = 'open_toggle';
} elseif ($pix_array_category[0]== 'default' && get_pix_option('pix_sliding_page')=='open') {
	$class = 'open_toggle';
} elseif ($pix_array_category[0]== 'always') { 
	$class = 'open_toggle always_open';
} elseif ($pix_array_category[0]== 'default' && get_pix_option('pix_sliding_page')=='always') {
	$class = 'open_toggle always_open';
} 

if(($pix_array_category[1]=='nosidebar' && $pix_array_category[2] == 'right')||$pix_array_category[1]== 'leftsidebar'){ 
	$left = 'margin-right';
} elseif ($pix_array_category[1]=='default' && (get_pix_option('pix_general_sidebar')=='leftsidebar' || (get_pix_option('pix_general_sidebar')=='nosidebar' && get_pix_option('pix_general_template')=='right'))) {
	$left = 'margin-right';
}

if($pix_array_category[1]=='nosidebar' && $pix_array_category[2] == 'wide'){ $width = 'seveneighty'; }
?>
	<article class="<?php echo $class.' '.$left.' '.$width; ?>">
    	<div><div>
<?php if (have_posts()) : ?>
            <h1 class="entry-title"><?php single_cat_title(); ?></h1>
            <div id="breadcrumb">
                <?php pix_breadcrumbs(); ?>
            </div><!-- #breadcrumb -->
<?php if($paged==0){ echo category_description(); }?>
            <?php while ( have_posts() ) : the_post();
    $meta_options = get_post_meta(get_the_ID(), $custom_options->get_the_id(), TRUE);
    $meta_title = get_post_meta(get_the_ID(), $custom_payoff->get_the_id(), TRUE);
    
    if(isset($meta_title['payoff']) && $meta_title['payoff']!='') {
        $the_title = $meta_title['payoff'];
    } else {
        $the_title = get_the_title();
    }
             ?>
    
            <div id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?>>
                    <h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo get_the_title(); ?>"><?php echo $the_title; ?></a></h3>
				<?php if(get_pix_option('pix_archive_show_postmetadata')=='show') { ?>
                    <div class="postmetadata">
                        <span>
                            <?php echo get_the_date(); ?>
                        </span>
                        <?php delight_posted_on(); ?>
                    </div><!-- .postmetadata -->
				<?php }// show postmetadata ?>
                
                <?php if(isset($meta_title['subtitle']) && $meta_title['subtitle']!=''){?><p class="subtitle"><?php echo $meta_title['subtitle']; ?></p><?php } ?>
                <?php if(has_post_thumbnail() && $pix_array_category[4]!='true') { 
					?><div class="imgHentry"><?php the_post_thumbnail( 'thumbnail' ); ?><div class="linkIcon" style="width:150px; height:150px;"><a href="<?php the_permalink(); ?>" class="goto-icon" style="width:150px; height:150px;"></a></div></div><!-- .imgHentry --><?php
				} ?>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo get_the_title(); ?>" class="button small alignleft"><?php _e('Read more','delight'); ?></a>
                <div class="clear"></div>
            </div>
		<?php endwhile; ?>
<?php if(function_exists('pix_pagenavi')) { pix_pagenavi();} ?>
        </div></div>
<?php endif; ?>
    </article>

<?php 

if ($pix_array_category[1]== 'rightsidebar' || ($pix_array_category[1]=='default' && get_pix_option('pix_general_sidebar')=='rightsidebar')) { 
get_sidebar();
}
wp_reset_query();
?>

</section>
<?php get_footer(); ?>
