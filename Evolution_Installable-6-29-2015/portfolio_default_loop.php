<?php 
$pageId = $post->ID;
$_SESSION['Evolution_page_id'] = $pageId;

get_template_part('portfolio_header');

$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '3';
$portfolio_type = get_post_meta($post->ID, "_portfolio_type", $single = false);
$paginationEnabled = (isset($portfolio_type) && !(empty ($portfolio_type))) ? $portfolio_type[0] : 1;
$alc_options = get_option('alc_general_settings');
$breadcrumbs = $alc_options['alc_show_breadcrumbs'];
$titles = $alc_options['alc_show_page_titles'];
$page_template_name = get_post_meta($post->ID,'_wp_page_template',true); 	
	$thumbsize = 'portfolio-2-col';



if( get_post_meta($post->ID, "_page_portfolio_num_items_page", $single = true) != '' && $paginationEnabled ) 
{ 
	$items_per_page = get_post_meta($post->ID, "_page_portfolio_num_items_page", $single = false);
} 
else 
{ // else don't paginate
	$items_per_page[0] = 777;
}
$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $items_per_page[0])); 
$cats = get_post_meta($post->ID, "_page_portfolio_cat", $single = true);
?>


<div class="row main-content">
    <div class="large-12 columns">
	<div class="row">
         <?php if ($layout == '3'):?><aside class="large-3 columns sidebar-left"> <?php generated_dynamic_sidebar() ?></aside><?php endif; ?>
                <div class="<?php echo $layout == '1' ? 'large-12' : 'large-9'?> columns">
                <?php echo do_shortcode(getPageContent($pageId)); ?>
                <div class="row">
                    <div class="large-12 columns">
                        <ul class="clearing-thumbs" data-clearing>
                        <?php
                        if( $cats == '' ): ?>
                            <p><?php _e('No categories selected. To fix this, please login to your WP Admin area and set
					the categories you want to show by editing this page and setting one or more categories 
					in the multi checkbox field "Portfolio Categories".', 'Evolution')?>
                            </p>
			<?php else: ?>		
                            <?php 
			// If the user hasn't set a number of items per page, then use JavaScript filtering
                                if( $items_per_page == 777 ) : endif; 
                                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				//  query the posts in selected terms
                                    $portfolio_posts_to_query = get_objects_in_term( explode( ",", $cats ), 'portfolio_category');
                            ?>
                            <?php if (!empty($portfolio_posts_to_query)):
                                $wp_query = new WP_Query( array( 'post_type' => 'portfolio', 'orderby' => 'menu_order', 'order' => 'ASC', 'post__in' => $portfolio_posts_to_query, 'paged' => $paged, 'showposts' => $items_per_page[0] ) ); 
				$counter = 1;	
                                if ($wp_query->have_posts()):  ?>
                                    <?php while ($wp_query->have_posts()) : 							
                                        $wp_query->the_post();
					$custom = get_post_custom($post->ID);
				// Get the portfolio item categories
					$cats = wp_get_object_terms($post->ID, 'portfolio_category');               
                                        if ($cats):
                                            $cat_slugs = '';
                                            foreach( $cats as $cat ) {$cat_slugs .= $cat->slug . " ";}
					endif;
                                    ?>	
                                    <?php $link = ''; $thumbnail = get_the_post_thumbnail($post->ID, $thumbsize);
                                          $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false); 
                                          $link = $full_image[0];
                                          $title=get_the_title($post->ID);
                                          ?>
                                    <li><a href="<?php echo $link; ?>">
                                        
                                            <?php if (!empty($thumbnail)): ?>
                                                <?php 
                                                    
                                                the_post_thumbnail($thumbsize, array('class' => 'th', 'data-caption'=>"$title")); ?>
                                            <?php else :?>
                                                <img src="<?php echo get_template_directory_uri()?>/images/picture.jpg" alt="<?php _e ('No preview image', 'Evolution') ?>" />
                                            <?php endif?>	
                                            
					</a>
                                    </li>						
                                    <?php $counter ++; endwhile; ?>
				<?php endif;?>
                            <?php endif;?>
                        <?php endif?>	
                    </ul>
                 </div>
                </div>
		<?php if ($paginationEnabled ):?>
                    <?php if ( $wp_query->max_num_pages > 1 ): ?>
                <div class="row">
                    <div class="large-12 columns">
                        <?php include(Evolution_PLUGINS . '/wp-pagenavi.php' ); wp_pagenavi(); ?> 
			<div class="clear"></div>
                    </div>
                </div>
                <?php endif?>
		<?php endif?>		
		
            </div>
         <?php if ($layout == '2'): wp_reset_query()?><aside class="large-3 columns sidebar-right"> <?php generated_dynamic_sidebar() ?></aside><?php endif; ?>
	<div class="clear"></div>
        </div>
    </div>
</div>

<?php get_template_part('portfolio_footer'); ?>