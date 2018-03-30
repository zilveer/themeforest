<?php
//
// Page Title
//

function page_title($type){		
	global $post;
	
	switch ($type) {
		case 'title':
		$tagline = get_post_meta($post->ID, 'page_tagline', true);
		if($tagline){
			echo $tagline;
		}else{
			echo get_the_title($post->ID);
		}
	break;	
		case 'blog_title':
		$frontpage_id = get_option('page_for_posts');
		$blog_tagline = get_post_meta($frontpage_id, 'page_tagline', true);
		
		if($blog_tagline){
			echo get_post_meta($frontpage_id, 'page_tagline', true);
		}else{
			echo get_the_title($frontpage_id);
		}	
	}
}

// Translation
$prefix = "st_"; 
if($of_option[$prefix.'translate']){	
	$tr_404_title = $of_option[$prefix.'tr_404_title'];
}else{			
	$tr_404_title = __('Page not found', 'spacing');
}
$of_option['st_tr_404_content'];
 /* If this is a 404 page error */ if (is_404()) { ?>
    <h1><?php echo $tr_404_title ?></h1>   
<?php /* If this is a tag archive */ } elseif (is_category() || is_category() || is_tag() || is_month() || is_year() || is_author()) { ?>
    <h1><?php _e('Archives', 'spacing'); ?></h1>
<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    <h1><?php _e('Archives', 'spacing'); ?></h1>   
<?php /* If this is a search page */ } elseif (is_search()) { ?>
    <h1>Search</h1>
<?php /* If this is a portfolio post page */ } elseif(is_single() && get_post_type() == 'portfolio') { ?>
    <h1>	
	<?php page_title(title); ?>
    </h1>
    <?php if($of_option[$prefix.'pnav_enabled']){ ?>
    <div class="portfolio-nav">
    	<div class="portfolio-prev">
		<?php previous_post_link('← %link');?>
        </div>
        <div class="portfolio-next">
        <?php next_post_link('%link →');  ?>
        </div>
    </div>
    <?php } /* If this is a portfolio post page */ } elseif(is_page()) { ?>
    <h1> <?php page_title(title); ?></h1>
<?php /* If this is a single post page */ } elseif(is_single() && get_post_type() !== 'portfolio') { ?>
    <h1> <?php page_title(blog_title); ?></h1>
<?php /* If this is a blog page */ } elseif (is_home()) { ?>
    <h1> <?php page_title(blog_title); ?> </h1>
<?php /* If other */ } else { ?>
    <h1> <?php page_title(title);  echo get_page_template();?></h1>
    <?php page_title(tagline); ?>
<?php
}
?>