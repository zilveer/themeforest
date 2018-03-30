	<?php get_header(); ?>
<div class="homepostload homereadybig" style="position: relative !important">
	
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1 class="pageposttitle"><?php the_title(); ?></h1>
            <h2 class="pagepostsub"><span><?php the_time('M j, Y') ?></span><span> &#124; <?php the_author(); ?></span><span> &#124; <?php the_category(', ') ?></span><span> &#124; <?php comments_number('No Comments','1 Comment','% Comments'); ?> </span></h2>
    <?php $subtitle = get_post_custom_values("title"); ?>
    <?php $content = get_post_custom_values("pex"); ?>
<?php if (has_post_thumbnail()) { ?> 
    <div class="pthumbnailbig">
            <?php $thumb = get_post_thumbnail_id();
            $image = vt_resize( $thumb,'' , 860, 220, true ); ?>
            <img src="<?php echo $image['url']; ?>" width="860" height="220" alt="<?php the_title(); ?>" />
            
    </div>
<?php } ?>
<?php the_content(); ?>
	        <?php comments_template(); ?>
	    </div>
	    
	   

    <?php endwhile; else: ?>
    <?php endif; ?>


	<?php get_footer(); ?>
