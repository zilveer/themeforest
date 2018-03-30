<?php
global $wp_query;	
$image_width = get_option('product_image_width');
/*
 * Most functions called in this page can be found in the wpsc_query.php file
 */

if (is_tax())
    {
        //use the category page template
        include('wpsc-category-products_page.php');   
        return;
    }
 
 ?><div id="default_products_page_container" class="wrap wpsc_container"><?php wpsc_output_breadcrumbs(); ?>
	<?php do_action('wpsc_top_of_products_page'); // Plugin hook for adding things to the top of the products page, like the live search ?>
	<?php if(wpsc_display_categories()):
    
    
    ?><ul class="wpsc_categories"><?php
                
                    //get all prdouct categories 
                    $argv = array(
                                    'hide_empty'    =>   0
                                    );
                
                    $terms = get_terms('wpsc_product_category', $argv);
                    
                    foreach ($terms as $term)
                        {
                            $category_img = wpsc_category_image($term->term_id);
                            
                            if ($category_img != '')
                                $img_link = THEMETEAM_IMAGE_RESIZE."/timthumb.php?src=$category_img&amp;w=193&amp;h=193&amp;zc=1&amp;q=100";
                                else
                                $img_link = THEMETEAM_IMAGE_RESIZE."/timthumb.php?src=". get_bloginfo('template_url') ."/images/cat-image.png&amp;w=191&amp;h=191&amp;zc=1&amp;q=100";
                           ?><li><a href="<?php echo get_term_link( $term, 'wpsc_product_category'); ?>" class="wpsc_category_link wpsc_category_grid_item" title="<?php echo $term->name ?>"><img src="<?php echo $img_link ?>" alt="" /><span class="category-name"><?php echo $term->name ?></span></a></li><?php
                            
                        }
                    
                ?></ul><div class="clear"></div><?php 
    endif; 
    
    ?></div>