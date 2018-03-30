<?php 
/**
 * The template for displaying Post Meta Data
 *
 * @package WordPress
 */
 
 	// get formats
	global $post_id;
 	$format = get_post_format( $post_id );
	
	if( $format == 'image' ) 
	{
		$icon_format = 'fa fa-picture-o';
	}
	elseif( $format == 'video' )
	{
		$icon_format = 'fa fa-film';
	}
	elseif( $format == 'audio' )
	{
		$icon_format = 'fa fa-headphones';
	}	
	elseif( $format == 'link' )
	{
		$icon_format = 'fa fa-link';
	}	
	elseif( $format == 'quote' )
	{
		$icon_format = 'fa fa-quote-left';
	}
	else
	{
		$icon_format = 'fa fa-pencil';
	} 

	
	?>
    
    <ul class="post-metadata-wrap clearfix">
        <li class="post-date">
        <?php if ( $NV_postmetaalign == 'post_title' ) : ?>
            <div class="date-day updated"><span class="date-icon"><i class="fa fa-calendar-o fa-large"></i></span><?php echo get_the_date(); ?></div>
        <?php else : ?>
        	<div class="updated">
                <div class="date-month"><?php the_time('M'); ?></div>
                <div class="date-day"><?php the_time('d'); ?></div>
                <div class="date-year"><?php the_time('Y'); ?></div>
            </div>
        <?php endif;?>
        </li>     
		<li class="post-format"><i class="<?php echo $icon_format; ?> fa-2x"></i></li>    
        <?php if( $NV_authorname != 'disable' ) { ?>
        <li class="author-title"><h6><?php _e('Created By:', 'themeva' ); ?></h6></li>
        <li class="author-name">
			<div class="vcard author">
				<div class="fn">        
        			<span class="author-icon"><i class="fa fa-user fa-lg"></i></span>
					<?php the_author_posts_link(); ?>
				</div>
			</div>
        </li>
        <?php } 
		
		if( comments_open() )
		{ ?>
        <li class="comments-list"><?php comments_popup_link( '<i class="fa fa-comment-o fa-lg"></i> 0', '<i class="fa fa-comment fa-lg"></i> 1', '<i class="fa fa-comments fa-lg"></i> %'); ?></li>    
		<?php
		} ?>

        <li class="category-title"><h6><?php _e('Categories:', 'themeva' ); ?></h6></li>
        <li class="category-list"><span class="category-icon">&nbsp;</span><?php the_category('',', '); ?></li>
		
		<?php if(get_the_tags()!='') { ?>
        <li class="tags-title"><h6><?php _e('Tags:', 'themeva' ); ?></h6></li>
        <li class="tags-list"><span class="tags-icon">&nbsp;</span><?php the_tags('',', '); ?></li>
        <?php } ?>
	
    </ul>