<?php //get theme options
global $oswc_single, $oswcPostTypes;

//set theme options
$oswc_related_hide = $oswc_single['review_related_hide'];
$oswc_related_header_text = $oswc_single['review_related_header_text'];

//setup the post type object
$postTypeId = get_post_type( $wp_query->post->ID );
$postType = $oswcPostTypes->get_type_by_id($postTypeId, true);
$primaryTaxonomy = $postType->get_primary_taxonomy();
$reviewRelatedNumber=$postType->related_number;
$reviewSidebarEnabled=$postType->sidebar_enabled;
if ($reviewSidebarEnabled) { 
	$columns=3;
} else {
	$columns=5;
}
?>

<?php // use variables from page custom fields instead of made options page (if they exist)
$override = get_post_meta($post->ID, "Hide Related", $single = true);
if($override!="" && $override!="null") {
	$oswc_related_hide=$override;
	if($oswc_related_hide=="false") {
		$oswc_related_hide=false;	
	} else {
		$oswc_related_hide=true;
	}
}
?>

<?php // setup the query
$taxonomies = $postType->taxonomies;//get all taxonomies, not just excerpt ones...

$hiddentaxonomies = array('dummy_first_value'); //add this so a key of 0 cannot trigger an un-hidden taxonomy
$args = array();
$count_tax=0;
foreach($taxonomies as $taxonomy){
	$terms = wp_get_object_terms($post->ID,$taxonomy->id);	
	$names[$taxonomy->id] = $terms[0]->name;	
	$slugs[$taxonomy->id] = $terms[0]->slug;	

	$args[$taxonomy->id] = array( // get other articles of same taxonomy
		'post_type' => $postType->id,
		'paged' => $paged,
		'post__not_in' => array($post->ID),
		'posts_per_page' => $reviewRelatedNumber,
		'tax_query' => array( 
							 array( 
								   'taxonomy' => $taxonomy->id,
								   'field' => 'slug',
								   'terms' => $slugs[$taxonomy->id]
								   )
							 )		
	);

	//check to see if this query generates results
	$test_loop = new WP_Query($args[$taxonomy->id]);

	//if not...
	if(!$test_loop->have_posts()) {	
		//echo "hiding ".$taxonomy->name."<br />";
		$hiddentaxonomies[] = $taxonomy->name;//add this taxonomy to the "hide" list
	} else {
		$count_tax++;	
	}
	wp_reset_query();
}
//check parent taxonomies in case there aren't any posts in any of the same level taxonomies
if($count_tax==0) {	
	$hiddentaxonomies=array('dummy_first_value'); //add this so a key of 0 cannot trigger an un-hidden taxonomy
	$names=array();
	$slugs=array();
	$args=array();
	foreach($taxonomies as $taxonomy){
		$terms = wp_get_object_terms($post->ID,$taxonomy->id);	
		$top_parent = get_term_top_most_parent($terms[0]->term_id, $taxonomy->id); 	
		$names[$taxonomy->id] = $top_parent->name;	
		
		$args[$taxonomy->id] = array( // get other articles of parent taxonomy
			'post_type' => $postType->id,
			'paged' => $paged,
			'post__not_in' => array($post->ID),
			'posts_per_page' => $reviewRelatedNumber,
			'tax_query' => array( 
								 array( 
									   'taxonomy' => $taxonomy->id,
									   'field' => 'slug',
									   'terms' => $slugs[$taxonomy->id]
									   )
								 )		
		);
	
		//check to see if this query generates results
		$test_loop = new WP_Query($args[$taxonomy->id]);
	
		//if not...
		if(!$test_loop->have_posts()) {
			$hiddentaxonomies[] = $taxonomy->name;//add this taxonomy to the "hide" list
		} else {
			$count_tax++;	
		}
		wp_reset_query();	
	}
}
//check category in case there aren't any posts in any of the same taxonomies
if($count_tax==0) {	
	$hiddentaxonomies=array('dummy_first_value'); //add this so a key of 0 cannot trigger an un-hidden taxonomy
	$names=array();
	$slugs=array();
	$args=array();
	$count_cats=0;
	foreach($taxonomies as $taxonomy){		
		$terms = wp_get_object_terms($post->ID,'category');
		$names[$taxonomy->id] = $terms[$count_cats]->name;	
		$slugs[$taxonomy->id] = $terms[$count_cats]->slug;				
		
		$args[$taxonomy->id] = array( // get other articles of same category
			'post_type' => $postType->id,
			'paged' => $paged,
			'post__not_in' => array($post->ID),
			'posts_per_page' => $reviewRelatedNumber,
			'category_name' => $slugs[$taxonomy->id]		
		);
	
		//check to see if this query generates results
		$test_loop = new WP_Query($args[$taxonomy->id]);
	
		//if not...
		if(!$test_loop->have_posts()) {
			$hiddentaxonomies[] = $taxonomy->name;//add this taxonomy to the "hide" list
		} else {
			$count_tax++;	
		}
		$count_cats++;
		wp_reset_query();	
	}
}

?>

<?php if(!$oswc_related_hide) { ?>

    <div id="related">
            
        <ul class="tabnav">
        
            <li class="title"><?php echo $oswc_related_header_text; ?></li>
            
            <li class="arrow">&nbsp;</li>
    
            <?php
            $count=0;
            foreach($taxonomies as $taxonomy){
				$key=array_search($taxonomy->name, $hiddentaxonomies);
                if($key==false){ //must match value and type, incase the hidden taxonomy is first in the array (0 position)
                    $count++;	
                    ?>
                    <li><a title="<?php _e( $names[$taxonomy->id], 'made' ); ?>" href="#tab<?php echo $count; ?>"><?php _e( $names[$taxonomy->id], 'made' ); ?></a></li>
                    
                <?php        		
                }	
            }
            ?>
            
        </ul>
        
        <br class="clearer" />
        
        <div class="tabdiv-wrapper">
        
        	<?php
			$count=0;
			foreach($taxonomies as $taxonomy){
				$key=array_search($taxonomy->name, $hiddentaxonomies);
                if($key==false){
					$count++;
					$postcount=0;	
					$related_loop = new WP_Query($args[$taxonomy->id]);
					$related_exists = true;
					?>
					<div id="tab<?php echo $count; ?>" class="tabdiv">
                        
                        <?php if ($related_loop->have_posts()) : while ($related_loop->have_posts()) : $related_loop->the_post(); $postcount++; 						
							//show rating?
							$rating_hide = get_post_meta($post->ID, "Hide Rating", $single = true); 	
							//check if this is a video post
							$isvideo=false;
							$video = get_post_meta($post->ID, "Video", $single = true);
							if($video!="") $isvideo=true;	
							?>	
                        
                        	<div class="panel<?php if($postcount % $columns == 0) { ?> right<?php } ?>">
                            
                            	<?php if($rating_hide!="true") { ?>
                                
                            		<div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($postType); // show the rating ?></div>
                                    
                                <?php } ?>
                            
                        		<a class="darken small<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('related', array( 'title'=> '' )); ?></a>
                                
                                <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                                
                            </div>
                            
                            <?php if ($postcount % $columns == 0) { // new line every 3 panels ?>
                            
                                <br class="clearer hide-responsive" />
                        
                            <?php } ?> 
                        
                        <?php endwhile; 
        				endif; ?> 
                        
                        <br class="clearer" />
                        
                    </div>					
				<?php        		
				}	
			}
			?>
            
        </div>
    
    </div> 
    
<?php } wp_reset_query(); ?>