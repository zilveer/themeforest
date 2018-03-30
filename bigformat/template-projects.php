<?php
/*
Template Name: Page - All Projects
*/
?>
<?php get_header(); ?>

<?php 
/* #Start the Loop
======================================================*/
if (have_posts()) : while (have_posts()) : the_post(); 
?>

<?php
/* #Get Fullscreen Background
======================================================*/
$pageimage = get_post_meta($post->ID,'_thumbnail_id',false);
$pageimage = wp_get_attachment_image_src($pageimage[0], 'full', false); 
ag_fullscreen_bg($pageimage[0]); 
?>

<div class="contentarea">

<!-- Page Title
================================================== -->
<div class="container namecontainer">
    <div class="pagename">
        <h2><span><?php the_title(); ?></span></h2>
    </div>
</div>
<!-- End Page Title -->

<!--Filter Items-->
<div class="container filtercontainer clearfix">
	<div class="filtersection">
    	<div class="filterwrap">
            <ul class="filter" id="filters">
                <li><a href="#" data-filter="*" class="active"><?php _e('All', 'framework');?></a></li>
                <?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'sort', 'show_option_none'   => '', 'walker' => new Walker_Portfolio_Filter())); ?>
               <div class="clear"></div>
            </ul>
    	</div>
	</div>
</div>
<!--End Filter Items-->

<div class="clear"></div>

<!-- Page Content
================================================== -->
<div class="portfoliowrap">
	<?php the_content(); ?><div class="clear"></div>  
    
<?php endwhile; endif;?>

<!-- Project Container -->
<div id="portfoliocontainer" data-finished="<?php _e('You have reached the end!', 'framework'); ?>" data-loading="<?php _e('Loading More Projects...', 'framework'); ?>">

<?php  
/* #Grab the global ProperPagination and WP_Query instances
===========================================================*/
global $pp, $wp_query, $wp;

$counter = 1; 
if($projects = of_get_option('of_projects_number')) { $posts_per_page = $projects; }else { $posts_per_page = 8;}
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$wp_query = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page'=> $posts_per_page, 'paged' => $paged, 'meta_key' => 'ag_portfolio_page_display', 'meta_value'   => 'Yes', 'meta_compare' => '!=')); // Construct the custom WP_Query instance

/* #Loop through your posts...
======================================================*/
while ( $wp_query->have_posts() ) : $wp_query->the_post();
	  
	$portfoliodisplay = get_post_meta(get_the_ID(), 'ag_portfolio_page_display', true);
	$terms = get_the_terms( get_the_ID(), 'sort' );
	$post_url = get_permalink(); //Get Permalink for post 
	$thumb1 = get_post_meta($post->ID,'_thumbnail_id',false); 
	$thumb = wp_get_attachment_image_src($thumb1[0], 'portfoliosmall', false);  // URL of Featured Full Image
	$full = wp_get_attachment_image_src($thumb1[0], 'portfoliolarge', false);  // URL of Featured Full Image
	/* #Get Video URL */
	$video_url = get_post_meta(get_the_ID(), 'ag_video_url', true);	

	
	?>
  
    <!-- Portfolio Item -->
    <div class="portfoliothumb <?php if ($terms) { foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } } ?>">     
        <div class="blogpost portfolio">            
			<div class="nopadding portfolioitem" id="project-<?php the_ID(); ?>">
                <a href="<?php if($lightbox = of_get_option('of_project_lightbox')) { 
					if ($lightbox == 'true'){ 
						if ($video_url) { 
							echo $video_url; 
						} else { 
						echo $full[0]; 
						} 
					} else { 
					echo $post_url;} 
					} else { 
					echo $post_url;} ?>" data-url="<?php the_ID(); ?>" <?php if ($lightbox) { if($lightbox == 'true') { echo 'rel="prettyPhoto"'; }} ?>>
                  <img src="<?php  echo $thumb[0]; ?>" alt="" class="scale-with-grid"/>
                </a>
				<div class="clear"></div>      
			</div>
            
            <h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
            <p><?php if ($terms != null) {$output = array(); foreach($terms as $term){ $termname = str_replace(' ', '-', $term->name); $output[] = '<a href="#" data-filter=".'.strtolower($termname).'" class="filtersort">'.$term->name.'</a>'; } echo implode(', ', $output);  }?></p>
 			
            <div class="clear"></div>
		</div>
        
        <div class="clear"></div>      
	</div>
    <!-- Portfolio Item -->
    
<?php endwhile; //End Loop ?>

    
    <div class="clear"></div>
  </div>
<!-- End Project Container -->   
     
<div id="nextpost">
    <?php next_posts_link(__('+ Load More Posts', 'framework'));
    previous_posts_link(__('Newer &rarr;', 'framework')); ?>
</div>
          
<div class="clear"></div>  
</div>
<!-- End Portfolio Wrap -->
    
<div class="clear"></div>   
</div>
<!-- End content wrap -->

<?php get_footer(); ?>