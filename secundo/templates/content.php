<?php
//The Query
global $wp_query;
$arrgs = $wp_query->query_vars;

$arrgs['posts_per_page'] = ct_get_option("posts_index_per_page", 3);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$arrgs['paged'] = $paged;

$wp_query->query($arrgs);
?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('blogPost'); ?>>
		<?php if (ct_get_option("posts_index_show_image", 1)): ?>
		<?php get_template_part('templates/content-featured-image'); ?>
		<?php endif;?>

		<?php if (ct_get_option("posts_index_show_title", 1)): ?>
	    <h2 class="vmedium vorange title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php endif;?>

	    <p class="vgray">
		    <?php $cats = get_the_terms(get_the_ID(), 'category');?>
			<?php if (ct_get_option("posts_index_show_date", 1)): ?>
			    <?php echo get_the_date();?>
		    <?php endif;?>

		    <?php if(ct_get_option("posts_index_show_date", 1) && ct_get_option("posts_index_show_categories", 1) && $cats):?> | <?php endif;?>
		    <?php if (ct_get_option("posts_index_show_categories", 1) && $cats): ?>
            <?php the_category(', ', '', get_the_ID()) ?>
            <?php endif;?>
		    <?php if(ct_get_option("posts_index_show_categories", 1) && $cats && ct_get_option("posts_index_show_comments_link", 1)):?> | <?php endif;?>
		    <?php if (ct_get_option("posts_index_show_comments_link", 1)): ?>
            <a href="<?php the_permalink()?>#comments"><?php echo wp_count_comments(get_the_ID())->approved?> <?php echo __("comments", "ct_theme");?></a>
            <?php endif;?>
		    <?php if(ct_get_option("posts_index_show_comments_link", 1) && ct_get_option("posts_index_show_author", 1)):?> | <?php endif;?>
		    <?php if (ct_get_option("posts_index_show_author", 1)): ?>
            <?php echo __('Author', 'ct_theme'); ?>: <?php the_author_posts_link() ?>
            <?php endif;?>
	    </p>

		<?php if (ct_get_option("posts_index_show_excerpt", 1)): ?>
        <p><?php the_excerpt();?></p>
		<?php endif;?>
	    <?php if (ct_get_option("posts_index_show_fulltext", 0)): ?>
        <p><?php the_content();?></p>
        <?php endif;?>

	    <hr class="simple">
    </div>
	<?php endwhile; ?>

	<?php if (isset($wp_query) && $wp_query->max_num_pages > 1) : ?>
		<div class="row-fluid">
	        <div class="span6 doLeft">
		        <?php if ($paged != 1): ?>
	            <a href="<?php echo get_previous_posts_page_link();?>" class="arrowIcon vsmall"><i class="arrow-mediumLeft"></i><?php echo __("NEWER POSTS", "ct_theme") ?></a>
	            <?php endif;?>
	        </div>
	        <div class="span6 doRight">
		        <?php if ($paged != $wp_query->max_num_pages): ?>
	            <a href="<?php echo get_next_posts_page_link() ?>" class="arrowIcon vsmall"><?php echo __("OLDER POSTS", "ct_theme") ?><i class="arrow-mediumRight"></i></a>
	            <?php endif; ?>

	        </div>
	    </div>
		<?php if (false): ?><?php posts_nav_link(); ?><?php endif; ?>
	<?php endif; ?>
<?php else: ?>
<div class="alert alert-block fade in">
    <a class="close" data-dismiss="alert">&times;</a>

    <p><?php _e('Sorry, no results were found.', 'ct_theme'); ?></p>
</div>
<?php get_search_form(); ?>
<?php endif; ?>
