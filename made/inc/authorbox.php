<?php //get theme options
global $oswc_single;

//set theme options
$oswc_authorbox_hide = $oswc_single['authorbox_hide']; //false
?>

<?php // use variables from page custom fields instead of made options page (if they exist)
$override = get_post_meta($post->ID, "Hide Authorbox", $single = true);
if($override!="" && $override!="null") {
	$oswc_authorbox_hide=$override;
	if($oswc_authorbox_hide=="false") {
		$oswc_authorbox_hide=false;	
	} else {
		$oswc_authorbox_hide=true;
	}
}
?>

<?php if(!$oswc_authorbox_hide) { ?>

    <div id="authorbox">
        
        <h2><?php echo the_author_meta('display_name'); ?></h2> 
                    
        <div class="arrow-catpanel-bottom">&nbsp;</div>
    
        <div class="inner">
            
            <div class="author-image">
            
                <?php echo get_avatar(get_the_author_meta('user_email'), 70); ?>
                
            </div>
            
            <div class="description">
            
            	<?php echo the_author_meta('description'); ?>
                
            </div>
            
            <br class="clearer" />

            <ul class="social-links">
                <?php if(get_the_author_meta('twitter')): ?>
                <li class="twitter"><a title="<?php _e( 'Twitter', 'made' ); ?>" href='http://twitter.com/<?php the_author_meta('twitter'); ?>'>&nbsp;</a></li>
                <?php endif; ?>
                <?php if(get_the_author_meta('facebook')): ?>
                <li class="facebook"><a title="<?php _e( 'Facebook', 'made' ); ?>" href='http://www.facebook.com/<?php the_author_meta('facebook'); ?>'>&nbsp;</a></li>
                <?php endif; ?>
                <?php if(get_the_author_meta('linkedin')): ?>
                <li class="linkedin"><a title="<?php _e( 'LinkedIn', 'made' ); ?>" href='http://www.linkedin.com/in/<?php the_author_meta('linkedin'); ?>'>&nbsp;</a></li>
                <?php endif; ?>
                <?php if(get_the_author_meta('googleplus')): ?>
                <li class="googleplus"><a title="<?php _e( 'Google+', 'made' ); ?>" href='http://plus.google.com/<?php the_author_meta('googleplus'); ?>'>&nbsp;</a></li>
                <?php endif; ?>
                <?php if(get_the_author_meta('youtube')): ?>
                <li class="youtube"><a title="<?php _e( 'YouTube', 'made' ); ?>" href='http://www.youtube.com/user/<?php the_author_meta('youtube', $author->post_author); ?>/'>&nbsp;</a></li>
                <?php endif; ?>
                <?php if(get_the_author_meta('flickr')): ?>
                <li class="flickr"><a title="<?php _e( 'Flickr', 'made' ); ?>" href='http://www.flickr.com/photos/<?php the_author_meta('flickr', $author->post_author); ?>/'>&nbsp;</a></li>
                <?php endif; ?>
                <?php if(get_the_author_meta('digg')): ?>
                <li class="digg"><a title="<?php _e( 'Digg', 'made' ); ?>" href='http://digg.com/users/<?php the_author_meta('digg'); ?>'>&nbsp;</a></li>
                <?php endif; ?>
                <?php if(get_the_author_meta('user_email')): ?>
                <li class="email"><a title="<?php _e( 'Email', 'made' ); ?>" href='mailto:<?php the_author_meta('user_email'); ?>'>&nbsp;</a></li>
                <?php endif; ?>
                <?php if(get_the_author_meta('user_url')): ?>
                <li class="url"><a title="<?php _e( 'Website', 'made' ); ?>" href='<?php the_author_meta('user_url'); ?>' target="_blank">&nbsp;</a></li>
                <?php endif; ?>                     
            </ul>
            
            <br class="clearer" />
            
            <div class="more-articles">
        
                <?php _e( 'More articles by', 'made'); ?> <?php the_author_posts_link(); ?> &raquo;
                
            </div>	
            
        </div>
    
    </div> 
    
<?php } ?>