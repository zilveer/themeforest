<?php
/**
 * @package WordPress
 * @subpackage NorthVantage
 */

	/* ------------------------------------
	:: Comments Alignment
	------------------------------------ */
 
	$NV_arhpostpostmeta = of_get_option('arhpostpostmeta'); // get postmeta data configuration
	$NV_postmetaalign	= of_get_option("postmetaalign"); // Align Postmeta Data

	if(is_single() && ($NV_arhpostpostmeta=='post_only' || $NV_arhpostpostmeta=='')) : 			
		$NV_arhpostpostmeta='display';
	elseif(!is_single() && ($NV_arhpostpostmeta=='' || $NV_arhpostpostmeta=='archive_only')) : 	
		$NV_arhpostpostmeta='display';
	endif;
	 
	if(
	 $NV_arhpostpostmeta=='display' && $NV_postmetaalign=='') { 
		$columns='ten columns last clearfix offset-by-two';
	} else { 
		$columns='';
	} 
	
	
	if ( post_password_required() ) 
	{
		echo '<p class="nopassword">'. __( 'This post is password protected. Enter the password to view any comments.', 'themeva' ) .'</p>';
		return;
	}
			
	?>	

    <div class="comments-wrapper comments-area"  id="comments">
        <div class="comments-wrap <?php echo $columns; ?>">
        <?php 
        
        if ( have_comments() ) : ?>
            <h4 id="comments-title">
                <?php
                    printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'themeva' ),
                        number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
                ?>
            </h4>
            <?php if ( get_comment_pages_count() > 1 && of_get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-above">
                <h3 class="assistive-text"><?php _e( 'Comment navigation', 'themeva' ); ?></h3>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'themeva' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'themeva' ) ); ?></div>
            </nav>
            <?php endif; // check for comment navigation ?>
    
            <ol class="commentlist">
                <?php wp_list_comments('callback=NorthVantage_comment'); ?>
            </ol>
    
            <?php 
			if ( get_comment_pages_count() > 1 && of_get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below">
				<h3 class="assistive-text"><?php _e( 'Comment navigation', 'themeva' ); ?></h3>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'themeva' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'themeva' ) ); ?></div>
			</nav>
			<?php 
			endif; ?>

     		<div class="page_nav clearfix">
  				<?php
				echo paginate_comments_links( array(
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',							
				)); ?> 
 			</div>	
           <br class="clear" />		
		
		<?php
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
  
       endif; ?>
    
        <?php comment_form(array(
            'comment_notes_after' => ' ',
        )); ?>
    	</div><!-- #comments-wrap -->
    </div><!-- #comments -->