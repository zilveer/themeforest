<?php //get theme options
global $oswc_front, $oswcPostTypes;

//set theme options
$oswc_front_sidebar_show = $oswc_front['sidebar_show'];
$oswc_tabs_cats = $oswc_front['tabs_cats'];
$oswc_tabs_numberpanel = $oswc_front['tabs_numberpanel'];
$oswc_tabs_type = $oswc_front['tabs_type'];

//determine layout margins
if($oswc_front_sidebar_show) {
	$cols=3;
	$cols_responsive=2;
} else {
	$cols=5;
	$cols_responsive=4;
}
?>

<div id="tabs-frontpage">

    <ul class="tabnav">
		<?php //loop through specified cats and setup tab headers
        $cats=explode(",",$oswc_tabs_cats); //setup array of latest categories		
        foreach ($cats as $catname) { //loop through each latest category
			$catsafe=trim(str_replace(" ","",str_replace("'","",str_replace("&","",$catname))));
			?>
        
        	<li><a href="#<?php echo $catsafe; ?>"><?php echo $catname; ?></a></li>
            
        <?php } ?>        
    </ul>
    <br class="clearer" />
    <div class="tabdiv-wrapper">

		<?php 
        $cats=explode(",",$oswc_tabs_cats); //setup array of latest categories
        foreach ($cats as $catname) { //loop through each latest category
			$catname=trim($catname);
			$catsafe=trim(str_replace(" ","",str_replace("'","",str_replace("&","",$catname))));			
            if($catname!="") {
                //setup wp_query args for this category
                if($oswc_tabs_type=="tag") {
                    $tabsargs = array('tag_id' => get_tag_id($catname), 'posts_per_page' => $oswc_tabs_numberpanel);
                    $terms = get_terms('post_tag', array('slug' => $catname)); //get term object for this tag
                    if(empty($terms)) $slidererror = __("You specified '$catname' for one of the tags in your Front Page Tabs, which doesn't match a tag in your database.","made");
                } elseif($oswc_tabs_type=="category") {
                    $tabsargs = array('cat' => get_category_id($catname), 'posts_per_page' => $oswc_tabs_numberpanel);
                    $terms = get_terms('category', array('slug' => $catname)); //get term object for this category
                    if(empty($terms)) $slidererror = __("You specified '$catname' for one of the categories in your Front Page Tabs, which doesn't match a category in your database.","made");
                } else {
					$thisReviewType = $oswcPostTypes->get_type_by_name($catname); //see if review type entered matches one in the system
					$reviewSlug = $thisReviewType->id; //get the slug for use in the query
                    $tabsargs = array('post_type' => $reviewSlug, 'posts_per_page' => $oswc_tabs_numberpanel);
					if($reviewSlug=='') $slidererror = __("You specified '$catname' for one of the review types in your Front Page Tabs, which doesn't match a review type in your database.","made");
                }
				?>
                
                <div id="<?php echo $catsafe; ?>" class="tabdiv">
                        
					<?php                    
                    // loop through articles in this tab
                    query_posts ( $tabsargs );
                    $postcount=0;
                    if (have_posts()) : while (have_posts()) : the_post(); $postcount++;
                        $postType = get_post_type(); //get post type
                        $reviewType = $oswcPostTypes->get_type_by_id($postType); //get review type object
                        $isreview=false;
                        if($postType!='post') $isreview=true; //set review variable		
                        //show rating?
                        $rating_hide = get_post_meta(get_the_ID(), "Hide Rating", $single = true); 
                        //check if this is a video post
                        $isvideo=false;
                        $video = get_post_meta(get_the_ID(), "Video", $single = true);
                        if($video!="") $isvideo=true;
                        ?>
                    
                        <div class="panel<?php if($postcount % $cols == 0) { ?> right<?php } ?>">
                        
                        	 <?php if($isreview && $rating_hide!="true") { ?>
                                <div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($reviewType); // show the rating ?></div>
                            <?php } ?> 
                        
                            <a href="<?php the_permalink(); ?>" class="thumbnail darken<?php if($isvideo) { ?> video<?php } ?> small" title="<?php the_title(); ?>"><?php the_post_thumbnail('latest', array( 'title'=> '' )); ?></a>				 
                            
                            <a class="post-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            
                        </div>
                        
                        <?php if ($postcount % $cols == 0) { // new line every x panels ?>
                                                
                            <div class="clearer hide-responsive"></div>
                    
                        <?php } ?>
                
                    <?php endwhile; 
                    endif; //end post loop ?> 
                    <?php wp_reset_query(); ?>
                    
                    <br class="clearer" />
                            
                </div>
                        
            <?php } //end if catname!=="" ?>
            
        <?php } //end category loop ?>
        
    </div>

</div>