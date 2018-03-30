<?php
//set theme options
$oswc_page_sidebar_unique = $oswc_other['page_sidebar_unique'];
$oswc_trending_hide = $oswc_other['page_trending_hide'];

// use variables from page custom fields instead of made options page (if they exist)
$override = get_post_meta($post->ID, "Featured Image Size", $single = true);
if($override!="" && $override!="null") $oswc_featuredimage_size=$override;
$override = get_post_meta($post->ID, "Hide Trending", $single = true);
if($override!="" && $override!="null") {
	$oswc_trending_hide=$override;
	if($oswc_trending_hide=="false") {
		$oswc_trending_hide=false;	
	} else {
		$oswc_trending_hide=true;
	}
}

//setup variables
$sidebar="Default Sidebar";
if($oswc_page_sidebar_unique) { $sidebar="Page Sidebar"; } //which sidebar to display
?>

<?php get_header(); // show header ?>

<div class="hide-responsive"><?php if(get_post_type()!='forum') {oswc_get_template_part('sharebox');}// show the sharebox ?></div>

<div class="main-content-left">

    <div class="page-content">
        
        <div class="content-panel">
        
        	<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
            
            	<?php
                // Featured Image for FB Like
                $featured_image = get_the_post_thumbnail($post->ID);
                
                // Get image source
                if($featured_image) {
                    $doc = new DOMDocument();
                    $doc->loadHTML($featured_image);
                    $imageTags = $doc->getElementsByTagName('img');
                    
                    foreach($imageTags as $tag) {
                        $image_url = $tag->getAttribute('src');
                    }
                }				
                ?>
                <link rel="image_src" href="<?php echo $image_url; ?>" />           
            
                <h1><?php the_title(); ?></h1>
                
                <?php if($oswc_featuredimage_size=="full" && has_post_thumbnail()) { ?>
                
                	<div class="article-image">
                
                		<?php the_post_thumbnail('single', array( 'title' => '' )); ?>
                        
                    </div>
                    
                <?php } elseif($oswc_featuredimage_size=="medium" && has_post_thumbnail()) { ?>
                
                    <div class="article-image">
                
                        <?php the_post_thumbnail('single-medium', array( 'title' => '' )); ?>
                        
                    </div>
                                    
                <?php } elseif($oswc_featuredimage_size=="small" && has_post_thumbnail()) { ?>
                
                	<div class="article-image">
                
                        <?php the_post_thumbnail('single-small', array( 'title' => '' )); ?>
                        
                    </div>
                	
                <?php } ?>
                
                <div class="the-content">
            
                	<?php the_content(); ?>
                    
                </div>
            
			<?php endwhile;
            endif; ?>
            
        </div>      
        
    </div>
    
    <?php if(!$oswc_trending_hide) { ?>
    
    	<br class="clearer" />
    
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