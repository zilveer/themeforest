<?php get_header(); ?>

<div class="row no-bg">
    <div class="uxb-col large-12 columns no-padding">
        <div class="portfolio-root-wrapper col4">
        	<span class="loading-text"><?php _e('Loading portfolio ...', 'uxbarn'); ?></span>
        	<div class="portfolio-loaded-wrapper">
	            <div class="portfolio-wrapper grey-bg">
	
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	    
	    <?php
	
			// Load required scripts (moved to functions.php)
			/*wp_enqueue_script('uxbarn-hoverdir');
	        wp_enqueue_style('uxbarn-isotope');
	        wp_enqueue_script('uxbarn-isotope');*/
	    
	        $thumbnail = '';
	        if(has_post_thumbnail(get_the_ID())) {
	            $thumbnail = get_the_post_thumbnail(get_the_ID(), 'large-square');
	        } else {
	            $thumbnail = '<img src="' . IMAGE_PATH . '/placeholders/large-square.gif" alt="' . __('No Thumbnail', 'uxbarn'). '" />';
	        }
	        
	        $item_terms = get_the_terms(get_the_ID(), 'portfolio-category');
	        $item_terms_code = '';
	        if ($item_terms && ! is_wp_error($item_terms))  {
	            $item_terms_code .= '<ul>';
	            foreach ($item_terms as $term) {
	                $item_terms_code .= '<li><a href="' . get_term_link(intval($term->term_id), $term->taxonomy) . '">' . $term->name . '</a></li>';
	            }
	            $item_terms_code .= '</ul>';
	        }
	        
	        echo 
	            '<div class="portfolio-item">
	                <div class="portfolio-item-hover">
	                    <h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>
	                    ' . $item_terms_code . '
	                </div>
	                ' . $thumbnail . '
	            </div>';
	    
	    ?>
	    
	<?php endwhile; endif; ?>
	
	        	</div> <!-- close " class="portfolio-wrapper grey-bg" -->
			</div> <!-- close class="portfolio-loaded-wrapper" -->
        </div>
    </div>
</div>

<?php get_footer(); ?>