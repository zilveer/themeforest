<?php
/*
 Template Name: Portfolio Showcase Page
 Can be used for portfolio items with more content to them - displays the content of the item on the left
 and a list with the other items on the right.
 */
get_header();?>

<?php

if(have_posts()){
	while(have_posts()){
		the_post();
		
		//get all the page meta data (settings) needed (function located in lib/functions/meta.php)
		$page_settings=pexeto_get_post_meta($post->ID, array('show_filter', 'post_category', 'post_number', 'slider',
		'order', 'show_title'));
		
		//create a data object that will be used globally by the other files that are included
		$pex_page=new stdClass();
		$pex_page->layout='full';
		$pex_page->show_title='off';
		$pex_page->slider=$page_settings['slider'];
		
		if(!$page_settings['show_title'] || $page_settings['show_title']=='global'){
			$page_settings['show_title']=get_opt('_show_page_title');	
		}
			
		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );
	  	wp_reset_postdata();
		 if($page_settings['show_title']!='off'){?>
    	<h1 class="page-heading"><?php the_title(); ?></h1><div class="double-line margin-line"></div>
    <?php }
    the_content('');
	}
}

if($page_settings['show_filter']=='true'){
	echo('<div id="showcase-categories">');
	$args=array();
	if($page_settings['post_category']!='-1'){
		$args['parent']=$page_settings['post_category'];
	}
	$cats=get_terms('portfolio_category', $args);
	echo '<ul><li class="hover" data-category="-1">'.pex_text('_all_text').'</li>';
	foreach($cats as $cat){
		echo('<li class="hover" data-category="'.$cat->term_id.'" class="category">'.$cat->name.'</li>');
	}
	echo('</ul><div class="clear"></div></div>');
}
?>
<div id="portfolio-preview-container">
<div class="loading"></div>

<div class="preview-items">
<?php

//set the query_posts args
$args= array(
         'posts_per_page' =>-1, 
		 'post_type' => PEXETO_PORTFOLIO_POST_TYPE,
		 'orderby' => 'menu_order'
	);

	if($page_settings['post_category']!='-1'){
		$slug=pexeto_get_taxonomy_slug($page_settings['post_category']);
		$args['portfolio_category']=$slug;
	}
	
//set the order args	
if($page_settings['order']=='custom'){
	$args['orderby']='menu_order';
	$args['order']='asc';
}else{
	$args['orderby']='date';
	$args['order']='desc';
}
	
query_posts($args);
	
	if(have_posts()) {
		 while (have_posts()) {
		 	the_post(); ?>
		 	<div class="portfolio-showcase-item">
		 	<!-- BIG PREVIEW ITEM  -->
		 	<div class="preview-item">
			<?php 
			$preview=get_post_meta($post->ID, 'preview_value', true);	
			
			if(get_post_meta($post->ID, 'show_preview_value', true)!='hide'){ ?>
				<img class="img-frame portfolio-big-img" alt="" src="<?php echo $preview; ?>"/> <div class="clear"></div>
			<?php }
			if(get_post_meta($post->ID, 'show_title_value', true)!='hide'){ ?>
				<h1 class="page-heading"><?php echo get_the_title(); ?></h1><div class="double-line"></div>
			<?php }
			the_content(); ?>
			</div>
			
			<?php 
			//get the categories
			$terms=wp_get_post_terms($post->ID, 'portfolio_category');
			$term_ids=array();
			$term_names=array();
			foreach($terms as $term){
				$term_ids[]=$term->term_id;
				$term_names[]=$term->name;
			} ?>
			
			<!-- SMALL PREVIEW ITEM  -->
			<div class="showcase-item hover" data-category="<?php echo(implode(',',$term_ids)); ?>">
			<?php $thumbnail=get_post_meta($post->ID, 'thumbnail_value', true);
		 	if(!$thumbnail){
		 		$crop=get_post_meta($post->ID, 'crop_value', true);
				$thumbnail=pexeto_get_resized_image($preview, 141, 105, $crop);
			}
			?>
			<img class="alignleft img-frame" alt="" src="<?php echo($thumbnail); ?>">
			<h6><?php the_title(); ?></h6>
			<?php if($term_names){ ?>
				<span class="post-info"><?php echo(implode(' / ',$term_names)); ?></span>
			<?php } ?>
			</div>
			</div>
			<?php 
		}
	}
?>	
</div>

<?php $responsive_layout = get_opt('_responsive_layout')=='off'?'false':'true'; ?>

<script type="text/javascript">
jQuery(document).ready(function($){
	$('#portfolio-preview-container').pexetoShowcase({
		itemnum:<?php echo $page_settings['post_number']; ?>,
		order:"<?php echo $page_settings['order']; ?>",
		showCat:<?php echo $page_settings['show_filter']; ?>,
		responsive:<?php echo $responsive_layout; ?>
		});
});

</script>	

    </div>

<?php

//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>
