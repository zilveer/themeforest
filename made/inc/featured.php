<?php //set theme options
global $oswc_front, $oswc_misc, $oswcPostTypes;
$oswc_featured_tag = $oswc_front['featured_tag'];
$oswc_featured_num = $oswc_front['featured_num'];
$oswc_featured_size = $oswc_front['featured_size'];
$oswc_skin = $oswc_misc['skin'];

//see if we're on a review listing page
$isReviewType=false;
$postTypeName = oswc_get_review_meta($post->ID);
if(!empty($postTypeName) && ($oswcPostTypes->has_type($postTypeName) || $oswcPostTypes->has_type(strtolower($postTypeName)))){	
	//if this is a review listing page, show only review post types in the featured slider	
	$isReviewType=true;
	$reviewType = $oswcPostTypes->get_type_by_name($postTypeName);	
	$oswc_featured_size = $reviewType->featured_size;	
	//setup wp_query args
	$featuredargs = array('post_type' => $reviewType->id, 'tag_id' => get_tag_id($oswc_featured_tag), 'posts_per_page' => $oswc_featured_num);
	$reviewSkin = $reviewType->skin; //get the review skin	
	if($reviewSkin=="dark") $oswc_skin="dark";
	if($reviewSkin=="light") $oswc_skin="";
} else {	
	//setup wp_query args
	$featuredargs = array('tag_id' => get_tag_id($oswc_featured_tag), 'posts_per_page' => $oswc_featured_num);
}

if($oswc_featured_size=="large") {
	$oswc_featured_image="featured-full";
} else {
	$oswc_featured_image="featured-small";
}
?>

<?php query_posts( $featuredargs );
if(have_posts()) { ?>

    <div id="featured-wrapper"<?php if($oswc_featured_size=="large") { ?> class="full"<?php } ?>>
    
        <div id="featured">
        
            <?php // the images for the slider
            $postcount=0;
            query_posts( $featuredargs );
            if (have_posts()) : while (have_posts()) : the_post();  $postcount++;				
                $title="#div".$postcount;								
                ?>
                                        
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($oswc_featured_image, array( 'title' => $title)); ?></a>
                    
                <?php                                
            endwhile; 
            endif; ?>
        
            <?php wp_reset_query(); ?>            
        
        </div>
        
        <?php // the captions for the slider - separate loop
        $postcount=0;
        query_posts( $featuredargs );
        if (have_posts()) : while (have_posts()) : the_post();  $postcount++;
            $title="div".$postcount;
            $postType = get_post_type(); //get post type
            $reviewType = $oswcPostTypes->get_type_by_id($postType); //get review type object			
            $isreview=false;
            if($postType!='post') $isreview=true; //set review variable
            //get review info
            if($isreview) {
                $reviewHideReviewVerbiage=$reviewType->hide_review_verbiage;	
                $cat = $reviewType->name;
                if(!$reviewHideReviewVerbiage) $cat = $cat . __(' Review','made');
                //show rating?
                $rating_hide = get_post_meta($post->ID, "Hide Rating", $single = true); 
				//get the icon
				$icon = $reviewType->icon;
				$icon_light = $reviewType->icon_light;	
				if($oswc_skin=="dark") $icon=$icon_light;		
            } else {
                $cats = get_the_category();
                $cat = $cats[0]->cat_name;	
            }		
            //check if this is a video post
            $isvideo=false;
            $video = get_post_meta($post->ID, "Video", $single = true);
            if($video!="") $isvideo=true;	
            ?>                     
            <div id="<?php echo $title; ?>" class="nivo-html-caption">         
                <?php if($isvideo) { ?>
                    <a class="video" href="<?php the_permalink(); ?>">&nbsp;</a>
                <?php } ?> 
                <div class="category"> 
                
                	<div class="ribbon-shadow-left">&nbsp;</div>
                
               		<?php if($isreview) { ?>
                            
                        <div class="icon" style="background:url(<?php echo $icon; ?>) no-repeat 0px 0px;">&nbsp;</div> 
                        
                    <?php } ?> 
                    
                    <div class="catname">
                               
                    	<?php echo $cat; ?> 
                        
                    </div> 
                    
                    <div class="category-arrow">&nbsp;</div>
                             
                </div>
                
                <div class="title">
                                    
                    <h1><a href="<?php the_permalink(); ?>" class="bebas"><?php the_title(); ?></a></h1>
                    
                </div>
                
                <?php if($rating_hide!="true") { ?>
                
                    <div class="rating-wrapper"><?php if($isreview) { $oswcPostTypes->the_rating($reviewType); } // show the rating ?></div>
                    
                <?php } ?>
                
                <br class="clearer" />
                
            </div>
            
            <?php                                
        endwhile; 
        endif; ?>
        
    </div>
<?php } else { ?>

	<div style="font-style:italic;width:600px;margin:20px 0px;"><?php _e('Could not find any featured posts. Make sure the value in Appearance >> Theme Options >> Front Page >> Featured Tag matches the slug for that tag in Posts >> Tags (must use the slug if it is different than the name of the tag). Also make sure you have assigned this tag to your posts, and that your posts have been given featured images','made'); ?></div>

<?php } ?>

<?php wp_reset_query(); ?>