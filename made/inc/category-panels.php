<?php //get theme options
global $oswc_front, $oswcPostTypes;

//set theme options
$oswc_front_sidebar_show = $oswc_front['sidebar_show'];
$oswc_categorypanels_cats = $oswc_front['categorypanels_cats'];
$oswc_categorypanels_cats_headers = $oswc_front['categorypanels_cats_headers'];
$oswc_categorypanels_numperpanel = $oswc_front['categorypanels_numberpanel'];
$oswc_categorypanel_largepost = $oswc_front['categorypanel_largepost'];
$oswc_categorypanels_type = $oswc_front['categorypanels_type'];

//set variables
if($oswc_front_sidebar_show) {
	$columns = 2;
} else {
	$columns = 3;
}
?>

<div class="categorypanels-wrapper">

    <div class="ribbon-shadow-left">&nbsp;</div>
    
    <div class="section-wrapper"> <!-- spotlight section header -->
    
        <div class="section">
        
            <?php echo $oswc_categorypanels_cats_headers; ?>
        
        </div>        
    
    </div>
    
    <div class="ribbon-shadow-right">&nbsp;</div>   
    
    <div class="section-arrow">&nbsp;</div>
    
    <div class="categorypanels">
    
        <?php 
        $catcount=0;
        $cats=explode(",",$oswc_categorypanels_cats); //setup array of latest categories
        foreach ($cats as $cat) { //loop through each latest category
            $catcount++;
            $catname=trim($cat);				
            if($catname!="") {
                //setup wp_query args for this category
                if($oswc_categorypanels_type=="tag") {
                    $categorypanelsargs = array('tag_id' => get_tag_id($catname), 'posts_per_page' => $oswc_categorypanels_numperpanel);
                    $terms = get_terms('post_tag', array('name' => $catname)); //get term object for this tag
                    if(empty($terms)) $slidererror = __("You specified '$catname' for one of the tags in your Category Panels, which doesn't match a tag in your database.","made");
                    $termslug = $terms[0]->slug; //get the slug
                    $morelink = get_term_link($termslug,'post_tag'); //get the permalink for this tag	
                    //$catname = get_term_by('slug', $termslug, 'post_tag')->name;
                    $moretitle = "All articles in " . $catname . " &raquo;"; //link title
                } elseif($oswc_categorypanels_type=="category") {
                    $categorypanelsargs = array('cat' => get_category_id($catname), 'posts_per_page' => $oswc_categorypanels_numperpanel);
                    $terms = get_terms('category', array('name' => $catname)); //get term object for this category
                    if(empty($terms)) $slidererror = __("You specified '$catname' for one of the categories in your Category Panels, which doesn't match a category in your database.","made");
                    $termslug = $terms[0]->slug; //get the slug
                    $morelink = get_term_link($termslug,'category'); //get the permalink for this category
                    //$catname = get_category_by_slug($termslug)->name;
                    $moretitle = "All articles in " . $catname . " &raquo;"; //link title
                } else {
                    $thisReviewType = $oswcPostTypes->get_type_by_name($catname); //see if review type entered matches one in the system
					$reviewSlug = $thisReviewType->id; //get the slug for use in the query	
                    $categorypanelsargs = array('post_type' => $reviewSlug, 'posts_per_page' => $oswc_categorypanels_numperpanel);
                    $morelink = oswc_review_permalink($catname); //get permalink for this review page 	
                    $moretitle = "All articles in " . $catname . " &raquo;"; //link title	
                }	
                ?>
                
                <div class="categorypanel<?php if($catcount % $columns == 0) { ?> right<?php } ?>">
                
                    <?php if($slidererror!="") { ?>
            
                        <div style="font-style:italic;width:300px;margin:20px 0px;"><?php echo $slidererror; ?></div>
                        
                    <?php } else {
                        //execute the query
                        $postcount=0;
                        query_posts ( $categorypanelsargs );
                        if (have_posts()) : while (have_posts()) : the_post(); $postcount++;
                            $postType = get_post_type(); //get post type
                            $reviewType = $oswcPostTypes->get_type_by_id($postType); //get review type object	
                            $isreview=false;
                            if($postType!='post') $isreview=true; //set review variable
							if($isreview) { 
								$icon = $reviewType->icon;
								$icon_light = $reviewType->icon_light;
							}
                            //show rating?
                            $rating_hide = get_post_meta($post->ID, "Hide Rating", $single = true); 	                   
                            //check if this is a video post
                            $isvideo=false;
                            $video = get_post_meta($post->ID, "Video", $single = true);
                            if($video!="") $isvideo=true;	
                            ?>
                            
                            <?php //first article has full sized thumbnail
                            if($postcount==1 && $oswc_categorypanel_largepost) { ?>
                                
                                <div class="vertical"> 
                                
                                	<div class="category"> 
                    
                                        <div class="ribbon-shadow-left">&nbsp;</div>
                                    
                                        <?php if($isreview) { ?>
                                                
                                            <div class="icon" style="background:url(<?php echo $icon_light; ?>) no-repeat 0px 0px;">&nbsp;</div> 
                                            
                                        <?php } ?> 
                                        
                                        <div class="catname">
                                                   
                                            <?php echo $catname; ?> 
                                            
                                        </div> 
                                        
                                        <div class="category-arrow">&nbsp;</div> 
                                                 
                                    </div>
                        
                                    <a class="darken<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('spotlight', array( 'title'=> '' )); ?></a>       
                                    
                                    <div class="inner">   
                                                               
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        
                                        <div class="excerpt"><?php oswc_standard_excerpt(); ?></div>

										<div class="more-bar">
                                            
                                            <?php if($isreview && $rating_hide!="true") { ?>
                                        
                                                <div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($reviewType); // show the rating ?></div>  
                                                
                                            <?php } ?> 
                                            
                                            <?php if(comments_open()) { ?>
                                                
                                                <div class="comments">
                                                
                                                    <?php comments_popup_link(__('0 comments','made'), __('1 comment','made'), __('% comments','made'), '', '-'); ?>
                                                
                                                </div>
                                                
                                            <?php } ?>
                                            
                                            <div class="more"><a href="<?php the_permalink(); ?>"><?php _e('More','made'); ?></a></div>
                                        
                                        </div>
                                        <br class="clearer" />
                                        
                                    </div>
                                
                                </div>
                                
                            <?php } else { //smaller thumbnail with title only ?>
                            
                            	<div class="post-panel-wrapper<?php if($postcount==1 && !$oswc_categorypanel_largepost) { ?> first<?php } ?>">
                            
									<?php if($postcount==1) { //first article does not have larger thumbnail size ?>
                                    
                                        <div class="category"> 
                        
                                            <div class="ribbon-shadow-left">&nbsp;</div>
                                        
                                            <?php if($isreview) { ?>
                                                    
                                                <div class="icon" style="background:url(<?php echo $icon_light; ?>) no-repeat 0px 0px;">&nbsp;</div> 
                                                
                                            <?php } ?> 
                                            
                                            <div class="catname">
                                                       
                                                <?php echo $catname; ?> 
                                                
                                            </div> 
                                            
                                            <div class="category-arrow">&nbsp;</div> 
                                                     
                                        </div>
                                    
                                    <?php } ?>
                                
                                    <div class="post-panel"> 
                            
                                        <div class="post-thumbnail">
                                        
                                            <a class="darken small<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('widget-thumbnail', array( 'title'=> '' )); ?></a>
                                        
                                        </div>
                                           
                                        <div class="post-info">  
                                                              
                                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            
                                            <div class="post-meta">
                                            
                                                <?php if($rating_hide!="true" && $isreview) { ?>
                                            
                                                    <div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($reviewType); // show the rating ?></div>
                                                    
                                                <?php } ?>
                                                
                                                <?php if(comments_open()) { ?>
                                                
                                                    <div class="comments">
                                                    
                                                        <?php comments_popup_link(__('0 comments','made'), __('1 comment','made'), __('% comments','made'), '', '-'); ?>
                                                    
                                                    </div>
                                                    
                                                <?php } ?>
                                                
                                                <div class="clearer"></div>
                                            
                                            </div>   
                                        
                                        </div>                            
             
                                        <div class="clearer"></div>
                                    
                                    </div>
                                    
                                </div>
                            
                            <?php } ?>   
                            
                        <?php endwhile; endif; ?>
                        
                    <?php } ?> 
                    
                </div> <!-- end categorypanels section -->
                        
            <?php } ?>
            
            <?php if ($catcount % $columns == 0) { // new line every 2 panels ?>
                                
                <div class="clearer non-responsive"></div>
        
            <?php } ?>
            
            <?php if ($catcount % 2 == 0) { // responsive designs will only have one or two max panels, so clearing every 2 works for both cases  ?>
                                    
                <div class="clear-responsive">&nbsp;</div>
        
            <?php } ?>
            
        <?php } ?>
    
    </div>
    
</div>

<br class="clearer" />

<?php wp_reset_query(); ?>