<?php get_header(); ?>

<?php
/* #Get Fullscreen Background
======================================================*/
$postspage_id = get_option('page_for_posts'); 
$pageimage = get_post_meta($postspage_id,'_thumbnail_id',false);
$pageimage = wp_get_attachment_image_src($pageimage[0], 'portfoliolarge', false); 
ag_fullscreen_bg($pageimage[0]); 
?>

<div class="contentarea">

<!-- Page Title
  ================================================== -->
<div class="container namecontainer">
    <div class="pagename">
        <h2><span><?php single_cat_title("", true);?></span></h2>
    </div>
</div>
<!-- End Page Title -->

 
<div class="clear"></div>
<!-- Page Content
  ================================================== -->
  <div class="portfoliowrap">
    
<!-- Project Container -->
<div id="portfoliocontainer">

<?php  
/* #Grab the global ProperPagination and WP_Query instances
===========================================================*/
global $pp, $wp_query, $wp;

$counter = 1; 
$current_sort = get_query_var('sort');
if($projects = of_get_option('of_projects_number')) { $posts_per_page = $projects; }else { $posts_per_page = 8;}
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('post_type' => 'portfolio', 'posts_per_page'=> $posts_per_page, 'sort' => $current_sort, 'meta_key' => 'ag_portfolio_page_display', 'meta_value'   => 'Yes', 'meta_compare' => '!=');
query_posts($args);

/* #Loop through your posts...
======================================================*/
 if (have_posts()) : while (have_posts()) : the_post(); 
	  
	$portfoliodisplay = get_post_meta(get_the_ID(), 'ag_portfolio_page_display', true);
	$terms = get_the_terms( get_the_ID(), 'sort' );
	$post_url = get_permalink(); //Get Permalink for post 
	$thumb = get_post_meta($post->ID,'_thumbnail_id',false); 
	$thumb = wp_get_attachment_image_src($thumb[0], 'portfoliosmall', false);  // URL of Featured Full Image

	
    ?>
    
    <!-- Portfolio Item -->
    <div class="portfoliothumb <?php if ($terms) { foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } } ?>">     
        <div class="blogpost portfolio">            
			<div class="nopadding portfolioitem" id="project-<?php the_ID(); ?>">
                <a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>">
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
    
<?php endwhile; endif; //End Loop ?>
   <div class="clear"></div>
  </div>
<!-- End Project Container -->   
     
<div id="nextpost">
    <?php next_posts_link(__('+ More Posts', 'framework'));
    previous_posts_link(__('Newer &rarr;', 'framework')); ?>
</div>
          
<div class="clear"></div>  
</div>
<!-- End Portfolio Wrap -->
    
<div class="clear"></div>   
</div>
<!-- End content wrap -->
<?php get_footer(); ?>