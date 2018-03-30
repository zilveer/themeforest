 <?php global $smof_data; ?> 
          

 <?php      global $root, $post_id, $portfolio_grid;
           $port_random_id = rand();
        $selectedfilters = get_post_meta(get_the_ID(), 'rnr_portfoliofilter', false);
        if($selectedfilters && $selectedfilters[0] == 0) {
            unset($selectedfilters[0]);
        }
		
		

        if($selectedfilters){
		  $portfolio_filters = get_terms('portfolio_filter', array(
			  'include'    => $selectedfilters,
			  'hide_empty' => 0
		  ) );
        }	else {
		  $portfolio_filters = get_terms('portfolio_filter');
		}
	
	
	  $portfolio_grid_size = get_post_meta(get_the_ID(), 'rnr_portfolio_grid',true);

		switch($portfolio_grid_size) {
			case '1' : $portfolio_grid = 'port-grid2'; break;
			case '2' : $portfolio_grid = 'port-grid3'; break;
			case '3' : $portfolio_grid = 'port-grid4'; break;
			case '4' : $portfolio_grid = 'port-grid5'; break;
			case '5' : $portfolio_grid = 'port-grid6'; break;			
			default : $portfolio_grid = 'port-grid5'; break;		
			
		} 	  
   

 if($smof_data['rnr_enable_portfolio_filter']==true) { ?>    
     <div class="container clearfix">  
   
   <!-- START PORTFOLIO FILTERING -->   
   <div  id="filters" class="sixteen columns">
    <ul class="clearfix">
<?php
								
		
		if($portfolio_filters): ?>
			<ul class="styled-list clearfix">
				<li><a href="#" data-filter="*" class="active"><h3><?php _e('All', 'rocknrolla'); ?></h3></a></li>	
				<?php foreach($portfolio_filters as $portfolio_filter): ?>
					<li><a href="#" data-filter=".term-<?php echo $portfolio_filter->slug; ?>"><h3><?php echo $portfolio_filter->name; ?></h3></a></li>					
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
    </div><!-- END PORTFOLIO FILTERING -->    
   </div><!-- END CONTAINER --> 
  <?php } ?>	


	

    <?php
	
if ( get_query_var('paged') ) {

    $paged = get_query_var('paged');

} elseif ( get_query_var('page') ) {

    $paged = get_query_var('page');

} else {

    $paged = 1;

}	
	
$temp_query = $wp_query;
$wp_query   = NULL;
       
       
		
	    $args = array(
            'post_type' 		=> 'portfolio',
            'posts_per_page' 	=> $smof_data['rnr_portfolio_number'],
            'post_status' 		=> 'publish',
            'orderby' 			=> 'menu_order',
            'order' 			=> 'DESC',
            'paged' 			=> $paged
        );
 
        $selectedfilters = get_post_meta(get_the_ID(), 'rnr_portfoliofilter', false);
        if($selectedfilters && $selectedfilters[0] == 0) {
            unset($selectedfilters[0]);
        }
		
		
        if($selectedfilters){
            $args['tax_query'][] = array(
                'taxonomy' 	=> 'portfolio_filter',
                'field' 	=> 'ID',
                'terms' 	=> $selectedfilters
            );
        }	
		
	       
        
        $wp_query = new WP_Query($args);
        if( $wp_query->have_posts() ) : ?>
		<div id="portfolio-wrap">
        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

        <?php $terms = get_the_terms( get_the_ID(), 'portfolio_filter' ); ?>      
                    
        <div class="<?php if($terms) : foreach ($terms as $term) { echo 'term-'.$term->slug.' '; } endif; ?>portfolio-item <?php echo $portfolio_grid; ?>">
            
            <?php 
                   $taxonomy = strip_tags( get_the_term_list($post->ID, 'portfolio_filter', '', ', ', '') );
			        $port_gallery = get_post_meta( get_the_ID( ), 'rnr_project_item_slides', false );
					$att=get_post_thumbnail_id();
					$portfolio_lightbox_image_src = wp_get_attachment_image_src( $att, 'full' );

					if( get_post_meta( get_the_ID(), 'rnr_project_video_embed', true ) != "") {							
						 $lightboxtype = '<div class="thumb-info"></i><h3>'. get_the_title() .'</h3><p class="portfolio-tags">'.$taxonomy.'</p></div>';
				     }
					 
					  else if(!empty($port_gallery)) {
                      $lightboxtype = '<div class="thumb-info"><h3>'. get_the_title() .'</h3><p class="portfolio-tags">'.$taxonomy.'</p></div>';						
		    	     }

				      else{
				      $lightboxtype = '<div class="thumb-info"><h3>'. get_the_title() .'</h3><p class="portfolio-tags">'.$taxonomy.'</p></div>';

				     } 
	
					  $link = '<a href="'.$portfolio_lightbox_image_src['0'].'" title="'. get_the_title() .'" class="portfolio-image portfolio-gallery-image" data-rel="prettyPhoto" rel="prettyPhoto[product-gallery]">';

					
					
					
					 ?>
               
        
            
            
          
            
            
            
                
            <?php
              // IF PORTFOLIO TYPE IS IMAGE					 
              if ( has_post_thumbnail()) { ?>				
                <div class="portfolio">

                  <?php echo $link;
                     
					 if( $portfolio_grid =='port-grid2') {
						 $image_src = wp_get_attachment_image_src( $att, 'span6' );
					 } else {
						 $image_src = wp_get_attachment_image_src( $att, 'span4' );
					 }
					 
					 $image_src = $image_src[0];
                     echo '<img class="portfolio-lazyLoad" src="'.RNR_INDEX_CSS.'/i?w=400&amp;h=250" width="400" height="250" data-original="' .$image_src. '" alt="'. get_the_title() .'"/><div class="portfolio-overlay">' .$lightboxtype. '</div></a>';
                   } ?>

                </div>
            
                        
        </div> <!-- END OF TERMS -->	
     
    <?php
	
	endwhile; 
	  ?>

	  
  </div><!-- END OF PORTFOLIO WRAP -->

 <?php if($smof_data['rnr_portfolio_number']!="-1") { ?>
    <div id="port-pagination">
	    <?php paginate(); ?>
     </div>    
	 <div id="port-infinite">
     <a href="#"><?php  _e('LOAD MORE POSTS','rocknrolla'); ?></a>
     </div>
 <?php } ?>	
	 
	 <?php endif;

	
	   // Reset main query object
$wp_query = NULL;
$wp_query = $temp_query; ?>
  
               


