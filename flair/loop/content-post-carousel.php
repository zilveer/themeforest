<li class="cbp-item">
	
	<?php if( has_post_thumbnail() ) : ?>
	    <a href="<?php the_permalink(); ?>" class="cbp-caption">
	        <div class="cbp-caption-defaultWrap">
	            <?php the_post_thumbnail('index'); ?>
	        </div>
	        <div class="cbp-caption-activeWrap">
	            <div class="cbp-l-caption-alignCenter">
	                <div class="cbp-l-caption-body">
	                    <div class="cbp-l-caption-text"><?php echo get_option('blog_read_more','read more'); ?></div>
	                </div>
	            </div>
	        </div>
	    </a>
    <?php endif; ?>
    
    <a href="<?php the_permalink(); ?>" class="cbp-l-grid-blog-title"><?php the_title(); ?></a>
    <div class="cbp-l-grid-blog-date"><?php the_time( get_option('date_format') ); ?></div>
    <div class="cbp-l-grid-blog-split">|</div>
    <a href="<?php comments_link(); ?>" class="cbp-l-grid-blog-comments">
    	<?php comments_number( __('0 Comments','flair'), __('1 Comment','flair'), __('% Comments','flair') ); ?>
    </a>
    
</li>