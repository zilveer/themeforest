<?php

/*

Template Name: Portfolio Timeline

*/
get_header();

GLOBAL $webnus_options;

$last_time = get_the_time(' F Y');

?>
  <section id="main-timeline" class="portfolio-timeline">
    <div class="container">
      <div id="tline-content">
        
        <?php
			$i=1;
			//$wpbp = new WP_Query(array( 'post_type' => 'post',  'orderby'=>'date' ) ); 
			$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$posts_per_page = $webnus_options->webnus_portfolio_count();
			$args = array(
				   'orderby'=>'date',
				   'order'=>'desc',
				   'post_type'=>'portfolio',
				   'paged' => $page,
				   'posts_per_page'=>$posts_per_page
			); 
			query_posts($args);
			 
			if (have_posts()) : while (have_posts()) : the_post();
			
			if(($last_time != date(' F Y',strtotime($post->post_date)) ) || $i==1) //&& $i < $post_per_page
			{
				$last_time = date(' F Y',strtotime($post->post_date));
				echo '<div class="tline-topdate">'.  date(' F Y',strtotime($post->post_date)) .'</div>';
				if( $i>1 ) $flag = true;
			}
		?>
		<article id="post-<?php the_ID(); ?>"  class="tline-box <?php if(($i%2)==0 && $flag) { $flag = false; $i++; } elseif( ($i%2)==0 ) echo ' rgtline'; ?>"> <span class="tline-row-<?php if(($i%2)==0) echo 'r'; else echo 'l'; ?>"></span>
		
		   <div class="port-tline-dt">
            <h3><?php the_time('d') ?></h3>
      
			</div>
		
		
		 <?php if(  $webnus_options->webnus_blog_featuredimage_enable() ) get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'portfolio_full' ) );?> <br>
          <div class="tline-ecxt">
            <h4><a href="<?php the_permalink(); ?>"><?php if(  $webnus_options->webnus_blog_posttitle_enable() ) the_title(); ?></a></h4>
            
			<h6 class="blog-cat-tline">at <?php 

				$terms = get_the_terms(get_the_id(), 'filter' );
				$terms_slug_str = '';
				//var_dump($terms);
				if ($terms && ! is_wp_error($terms)) :
					$term_slugs_arr = array();
					foreach ($terms as $term) {
						$term_slugs_arr[] = '<a href="'. get_term_link($term, 'filter') .'">' . $term->name . '</a>';
					}
					$terms_slug_str = join( ", ", $term_slugs_arr);
				endif;
				echo $terms_slug_str;

			?> - by <?php the_author(); ?></h6>
			
          </div>

          
        </article>
		<?php 
			$i++;
			endwhile;
			endif;
			
		?>
        <hr class="vertical-space1">
        <div class="tline-topdate enddte"><?php the_time(' F Y') ?></div>
      </div>
      <!-- end-pin-content -->
      <hr class="vertical-space2">
    </div>
    <section class="container aligncenter">
      <?php 
		if(function_exists('wp_pagenavi'))
		{
			wp_pagenavi();
			
		}
	  ?>
      <hr class="vertical-space2">
    </section>
    <!-- container -->
  </section>
  <?php wp_reset_query(); // Reset the Query Loop ?>
  <!-- end-main-content-pin -->
  <?php get_footer(); ?>