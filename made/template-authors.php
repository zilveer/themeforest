<?php
// Template Name: Authors Page
?>
<?php
//set theme options
$oswc_author_sidebar_unique = $oswc_other['author_sidebar_unique'];
$oswc_author_header_text = $oswc_other['author_header'];
$oswc_author_exclude = $oswc_other['author_exclude'];
$oswc_trending_show = $oswc_other['author_trending_enabled'];

//setup the authors exclude list
$oswc_author_exclude = str_replace(" ","",$oswc_author_exclude); //get rid of any spaces
if($oswc_author_exclude=="") {
	$oswc_author_exclude="'nullauthor'";
} else {
	$excluded=explode(",", $oswc_author_exclude);
	foreach ($excluded as $exclude) {
		$excluded_string .= "'" . $exclude . "',";	
	}	
	$excluded_string = mb_substr($excluded_string,0,-1); //remove last comma	
	$oswc_author_exclude=$excluded_string;
}
$override = get_post_meta($post->ID, "Hide Trending", $single = true);
if($override!="" && $override!="null") {
	$oswc_trending_hide=$override;
	if($oswc_trending_hide=="false") {
		$oswc_trending_hide=false;	
	} else {
		$oswc_trending_hide=true;
	}
}
?>

<?php
get_header(); // show header

// user specified a unique author sidebar
if ($oswc_author_sidebar_unique) {
	$sidebar="Author Sidebar";
} else {
	$sidebar="Default Sidebar";
}

?>

<div class="main-content-left">

    <div class="post-loop">

        <div class="ribbon-shadow-left">&nbsp;</div>       
        
        <div class="section-wrapper">
        
            <div class="section">
            
                <?php echo $oswc_author_header_text; ?>
            
            </div>        
        
        </div>
        
        <div class="ribbon-shadow-right">&nbsp;</div>   
    
        <div class="section-arrow">&nbsp;</div>
        
		<?php
        $authors = $wpdb->get_results("SELECT DISTINCT post_author FROM ".$wpdb->posts." INNER JOIN ".$wpdb->users." ON ".$wpdb->posts.".post_author = ".$wpdb->users.".ID WHERE ".$wpdb->users.".user_login NOT IN (".$oswc_author_exclude.") ORDER BY ".$wpdb->users.".display_name ASC");		
        if($authors):
        foreach($authors as $author):
            $postcount++;
            ?>
            
            <div id='author-<?php the_author_meta('user_login', $author->post_author); ?>'>	
                        
                <div id="authorbox" class="categorypanel<?php if($postcount % 2 == 0) { ?> right<?php } ?>"> 
                
                    <h2><?php echo the_author_meta('display_name', $author->post_author); ?></h2> 
                    
                    <div class="arrow-catpanel-bottom">&nbsp;</div>
                    
                    <div class="inner">                      
                    
                        <div class="author-image">
                        
                            <?php echo get_avatar(get_the_author_meta('user_email', $author->post_author), 80); ?>
                            
                        </div>
                        
                        <div class="description">
                        
                            <?php echo the_author_meta('description', $author->post_author); ?>
                            
                        </div>
                        
                        <br class="clearer" />
                        
<ul class="social-links">
    <?php if(get_the_author_meta('twitter', $author->post_author)): ?>
    <li class="twitter"><a title="<?php _e( 'Twitter', 'made' ); ?>" href='http://twitter.com/<?php the_author_meta('twitter', $author->post_author); ?>'>&nbsp;</a></li>
    <?php endif; ?>
    <?php if(get_the_author_meta('facebook', $author->post_author)): ?>
    <li class="facebook"><a title="<?php _e( 'Facebook', 'made' ); ?>" href='http://www.facebook.com/<?php the_author_meta('facebook', $author->post_author); ?>'>&nbsp;</a></li>
    <?php endif; ?>
    <?php if(get_the_author_meta('linkedin', $author->post_author)): ?>
    <li class="linkedin"><a title="<?php _e( 'LinkedIn', 'made' ); ?>" href='http://www.linkedin.com/in/<?php the_author_meta('linkedin', $author->post_author); ?>'>&nbsp;</a></li>
    <?php endif; ?>
    <?php if(get_the_author_meta('googleplus', $author->post_author)): ?>
    <li class="googleplus"><a title="<?php _e( 'Google+', 'made' ); ?>" href='http://plus.google.com/<?php the_author_meta('googleplus', $author->post_author); ?>'>&nbsp;</a></li>
    <?php endif; ?>
    <?php if(get_the_author_meta('youtube', $author->post_author)): ?>
    <li class="youtube"><a title="<?php _e( 'YouTube', 'made' ); ?>" href='http://www.youtube.com/user/<?php the_author_meta('youtube', $author->post_author, $author->post_author); ?>/'>&nbsp;</a></li>
    <?php endif; ?>
    <?php if(get_the_author_meta('flickr', $author->post_author)): ?>
    <li class="flickr"><a title="<?php _e( 'Flickr', 'made' ); ?>" href='http://www.flickr.com/photos/<?php the_author_meta('flickr', $author->post_author, $author->post_author); ?>/'>&nbsp;</a></li>
    <?php endif; ?>
    <?php if(get_the_author_meta('digg', $author->post_author)): ?>
    <li class="digg"><a title="<?php _e( 'Digg', 'made' ); ?>" href='http://digg.com/users/<?php the_author_meta('digg', $author->post_author); ?>'>&nbsp;</a></li>
    <?php endif; ?>
    <?php if(get_the_author_meta('user_email', $author->post_author)): ?>
    <li class="email"><a title="<?php _e( 'Email', 'made' ); ?>" href='mailto:<?php the_author_meta('user_email', $author->post_author); ?>'>&nbsp;</a></li>
    <?php endif; ?>
    <?php if(get_the_author_meta('user_url', $author->post_author)): ?>
    <li class="url"><a title="<?php _e( 'Website', 'made' ); ?>" href='<?php the_author_meta('user_url', $author->post_author); ?>' target="_blank">&nbsp;</a></li>
    <?php endif; ?>                     
</ul>
                        
                        <br class="clearer" />
                        
                        <div class="more-articles">
                    
                            <?php
                            $authorargs = array( 'post_type' => 'any', 'author' => $author->post_author, 'showposts' => 1);
                            $recentPost = new WP_Query($authorargs);
                            while($recentPost->have_posts()): $recentPost->the_post();
                            ?>
                                <?php _e( 'Latest: ', 'made' ); ?><a href='<?php the_permalink();?>'><?php the_title(); ?></a>
                            <?php endwhile; ?>
                            
                        </div>
                        
                    </div>
                    
                </div>
            
            </div> 
            
            <?php if($postcount % 2 == 0) { ?> <br class="clearer" /><?php } ?>
            
        <?php endforeach; endif; wp_reset_query(); ?> 
        
    </div>
    
    <br class="clearer" />
    
    <?php if($oswc_trending_show) { ?>
    
    	<?php oswc_get_template_part('trending'); // show trending ?>
        
    <?php } ?>

</div>

<div class="sidebar">

    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar) ) : else : ?>
        
        <div class="widget-wrapper">
        
        	<div class="widget">
    
                <div class="section-wrapper"><div class="section">
                
                    <?php _e(' Made Magazine ', 'made' ); ?>
                
                </div></div> 
                
                <div class="textwidget">  
                                              
                	<p><?php _e( 'This is a widget panel. To remove this text, login to your WordPress admin panel and go to Appearance >> Widgets, and drag &amp; drop a widget into the corresponding widget panel.', 'made' ); ?></p>
                    
                </div>
                            
            </div>
        
        </div>
    
    <?php endif; ?>

</div>		

<br class="clearer" />

<?php get_footer(); // show footer ?>