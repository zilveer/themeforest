<?php /* LOOP TO DISPLAY POSTS */ ?>

<?php // NO POSTS TO DISPLAY? ?>
<?php if ( ! have_posts() ) : ?>
	<h4><?php echo dt_NotFoundContent; ?></h4>
<?php endif; ?>
<?php // HAVE POSTS TO DISPLAY? ?>
<?php while ( have_posts() ) : the_post(); ?>
    <article class="post post-type-4 clearfix">
        <div class="post-content clearfix">
            <h4<?php if(is_search()) echo ' class="title-search"'; ?>><a href="<?php the_permalink(); ?>" title="<?php dt_Permalink.the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>                        
            <?php if ( has_post_thumbnail() ): ?>
                <?php $dt_CropLocation = get_option('dt_CropLocation','c'); ?>
                <?php $dt_PostImageCrop = get_post_meta($post->ID, "dt_croplocation", true); ?>
                <?php if ( $dt_PostImageCrop == '' || $dt_PostImageCrop == 'inherit' ) $dt_PostImageCrop = $dt_CropLocation; ?>                                                         
                <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                <a class="post-image" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                    <img src="<?php resizeimage($thumbnail_src,550,200,$dt_PostImageCrop); ?>" alt="<?php the_title(); ?>" />
                </a>
            <?php endif; ?>  
            <?php the_content(''); ?>
            <a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php echo dt_ReadMore; ?></a>
        </div>                            
        <div class="post-meta clearfix">
            <span class="date"><?php the_time('g:i a'); ?> - <?php the_time('F j, Y'); ?></span>
            <span class="author"><?php echo dt_PostedBy; ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></a></span> 
			<?php $dt_SinglePostComments = get_option('dt_SinglePostComments','no'); ?>
            <?php if ( $dt_SinglePostComments == 'no' ): ?>
                <span class="comments"><a title="<?php echo get_the_title().' - '.dt_Comments;?>" href="<?php the_permalink(); ?>#comments"><?php echo comments_number('0', '1', '%').' '.dt_Comments; ?></a></span>
            <?php endif; ?>
        </div>                   
    </article>	
<?php endwhile;?>
<?php if(function_exists('wp_pagenavi')): ?>
    <nav id="navigation">
        <?php wp_pagenavi();?>  
    </nav>                   
<?php endif; ?>