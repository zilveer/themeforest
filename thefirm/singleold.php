	<?php get_header(); ?>
<div class="homepostload homereadyinner" style="position: relative !important;">
    


    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <?php if (has_post_thumbnail()) {
    $style = 'style= "float: right;" ' ;
    $style2 = 'style="width: 611px;"';
    }
    else {
    $style = '';
    $style2 = '';
    }
    ?>
        <?php if (has_post_thumbnail()) { ?>
        <div class="pthumbnail">
                <?php $thumb = get_post_thumbnail_id();
                if (has_post_thumbnail()) $image = vt_resize( $thumb,'' , 227, 500, true ); ?>
                <img src="<?php echo $image['url']; ?>" width="227" height="500" alt="<?php the_title(); ?>" />
        </div>
        <?php }; ?>
<div class="pcowrap"  <?php echo $style; ?> >
            <h1 class="pageposttitle"><?php the_title(); ?></h1>
	    <h2 class="pagepostsub"><span><?php the_time('M j, Y') ?></span><span> &#124; <?php the_author(); ?></span><span> &#124; <?php the_category(', ') ?></span><span> &#124; <?php comments_number('No Comments','1 Comment','% Comments'); ?> </span></h2>
	    <div style="height: 10px;"></div>
	<div class="pcontent" <?php echo $style2; ?> >
	    <div class="pconinnwr">
	       <?php the_content(); ?>
	        <?php comments_template(); ?>
	    </div>
	    
	   
</div>
</div>
    <?php endwhile; else: ?>
    <?php endif; ?>

</div> 
	<?php get_footer(); ?>
