<?php 
$postId = get_the_ID();

$categories = wp_get_post_terms($postId, 'categories');
$catsClass = '';
foreach($categories as $category) {
	$catsClass .= ' sort-'.$category->slug;
}

$columns = etheme_get_option('portfolio_columns');
if(isset($_GET['col'])) {
	$columns = $_GET['col'];
}

?>
<div class="portfolio-item article <?php echo $catsClass; ?>">        
	<div class="portfolio-image">
		<img src="<?php echo etheme_get_image(false, 600, 600); ?>" title="<?php the_title(); ?>"/>
        <div class="portfolio-mask"></div>
        <div class="portfolio-descr">
	        <?php if($columns != 1) : ?>
			    <h3><?php the_title(); ?></h3>
		    <?php endif; ?>
	        
			<?php if (has_post_thumbnail( $postId ) ): ?>
				<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
			
				<?php if(etheme_get_option('port_use_lightbox')): ?><a class="button small btn-icon zoom btn-enlarge" data-rel="lightbox[portfolio]" href="<?php echo $url; ?>"><i class="icon-fullscreen"></i></a><?php endif; ?>
			<?php endif; ?>
        	<a class="button small active btn-icon btn-link" href="<?php the_permalink($postId); ?>"><i class="icon-link"></i></a>
	        
        </div>
    </div>
    <?php if($columns == 1): ?>
    	<div class="portfolio-info">
	    	
	    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	    	
            
            <div class="entry-utility">
    			<?php etheme_posted_on(); ?>
                <?php if(etheme_get_option('portfolio_comments')): ?>
                       <span class="blog_icon_title">| </span><?php comments_popup_link( __( 'Leave a comment', ETHEME_DOMAIN ), __( '1 Comment', ETHEME_DOMAIN ), __( '% Comments', ETHEME_DOMAIN ) ); ?>
                <?php endif; ?>
				<?php edit_post_link( __( 'Edit', ETHEME_DOMAIN ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->  
            
            
	    	<p><?php the_content(); ?></p>
	         
	    	<a href="<?php the_permalink(); ?>" class="button fl-r"><span><?php _e('Read More', ETHEME_DOMAIN); ?></span></a>
	    	
    	</div>
    <?php endif; ?>
</div>