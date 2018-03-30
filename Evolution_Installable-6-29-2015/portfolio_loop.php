<?php

$pageId = $post->ID;
$_SESSION['Evolution_page_id'] = $pageId;



$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
$portfolio_type = get_post_meta($post->ID, "_portfolio_type", $single = false);
$paginationEnabled = (isset($portfolio_type) && !(empty ($portfolio_type))) ? $portfolio_type[0] : 0;
$alc_options = get_option('alc_general_settings');
$breadcrumbs = $alc_options['alc_show_breadcrumbs'];
$titles = $alc_options['alc_show_page_titles'];
$page_template_name = get_post_meta($post->ID,'_wp_page_template',true); 
if ($page_template_name !== 'homepage-template2.php')
{
	get_template_part('portfolio_header');
}
$itemsize = 'large-block-grid-3';	
$thumbsize = 'portfolio-3-col';
// Check which layout was selected
switch($page_template_name)
{
	case 'portfolio-template-3columns.php':
		$itemsize = 'large-block-grid-3';	
		$thumbsize = 'portfolio-3-col';
	break;
	
	case 'portfolio-template-4columns.php': case'homepage-template2.php':
		$itemsize = 'large-block-grid-4';	
		$thumbsize = 'portfolio-4-col';
	break;	
			
   case 'portfolio-template-5columns.php':
		$itemsize = 'large-block-grid-5';	
		$thumbsize = 'portfolio-5-col';
	break;
}


if( get_post_meta($post->ID, "_page_portfolio_num_items_page", $single = true) != '' && $paginationEnabled ) 
{ 
	$items_per_page = get_post_meta($post->ID, "_page_portfolio_num_items_page", $single = false);
} 
else 
{ // else don't paginate
	$items_per_page[0] = 777;
}
$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $items_per_page[0])); 
?>


<div class="row main-content">
    <div class="large-12 columns">
		<div class="row clearfix">
            <div class="large-12 columns">
				<?php echo do_shortcode(getPageContent($pageId)); ?>
                <ul class="splitter portfolio-main filter">
                    <?php if ($paginationEnabled):?>
						<li class="active"><a href="<?php echo get_page_link($pageId) ?>" class="all"><?php _e('All', 'Evolution')?></a></li>
						<?php 
							$cats = get_post_meta($post->ID, "_page_portfolio_cat", $single = true);
							$MyWalker = new PortfolioWalker2();
							$args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '0', 'include' => $cats, 'title_li'=> '', 'walker' => $MyWalker, 'show_count' => '1');
							$categories = wp_list_categories ($args);
						?>
					<?php else: ?>
						<li class="active"><a href="javascript:void(0)"  class="all"><?php _e('All', 'Evolution')?></a></li>
						<?php 
							$cats = get_post_meta($post->ID, "_page_portfolio_cat", $single = true);                                                 
							$MyWalker = new PortfolioWalker();
							$args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '0', 'include' => $cats, 'title_li'=> '', 'walker' => $MyWalker, 'show_count' => '1');
							$categories = wp_list_categories ($args);
						?>
                    <?php endif ?>
				</ul>
            </div>
            <div class="large-12 columns">                
				<?php if( $cats == '' ): ?>
					<p><?php _e('No categories selected. To fix this, please login to your WP Admin area and set
					the categories you want to show by editing this page and setting one or more categories 
					in the multi checkbox field "Portfolio Categories".', 'Evolution')?></p>
				<?php else: ?>
					<ul class="portfolio-content <?php echo $itemsize ?>">	
						 <?php 
						// If the user hasn't set a number of items per page, then use JavaScript filtering
						if( $items_per_page == 777 ) : endif; 
							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							//  query the posts in selected terms
							$portfolio_posts_to_query = get_objects_in_term( explode( ",", $cats ), 'portfolio_category');
                            if (!empty($portfolio_posts_to_query)):
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
                                    <?php $link = ''; $thumbnail = get_the_post_thumbnail($post->ID, $thumbsize);  ?>
                                    <li class="portfolio-item <?php echo $cat_slugs; ?>" data-id="id-<?php echo $counter;?>" data-type="<?php echo $cat_slugs; ?>">
                                        <div class="view view-two">
                                            <?php if (!empty($thumbnail)): ?>
                                                <?php the_post_thumbnail($thumbsize, array('class' => 'cover')); ?>
                                            <?php else :?>
                                                <img src="<?php echo get_template_directory_uri()?>/images/picture.jpg" alt="<?php _e ('No preview image', 'Universfolio') ?>" />
                                            <?php endif?>	
                                            <div class="mask">
                                                <h3><?php the_title() ?></h3>                                    
												<p><?php echo limit_words(get_the_excerpt(), 12) ?></p>
												<?php if( !empty ( $custom['_portfolio_video'][0] ) ) : $link = $custom['_portfolio_video'][0]; ?>
													<a href="<?php echo $link ?>" class="button btn-icon" data-rel="prettyPhoto[project1]" title="<?php the_title() ?>">
														<i class="icon-desktop icon-large"></i>
													</a>
												<?php elseif( isset($custom['_portfolio_link'][0]) && $custom['_portfolio_link'][0] != '' ) : ?>
													<a href="<?php echo $custom['_portfolio_link'][0] ?>" class="button btn-icon"  title="<?php the_title() ?>">
														<i class="icon-external-link icon-large"></i>
													</a>
												<?php elseif(  isset( $custom['_portfolio_no_lightbox'][0] )  &&  $custom['_portfolio_no_lightbox'][0] !='' ) : $link = get_permalink(get_the_ID());  ?>
													<a href="<?php echo $link; ?>" class="button btn-icon"  title="<?php the_title() ?>">
														<i class="icon-link icon-large"></i>
													</a>
												<?php else : ?>
                                                    <?php  
                                                        $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false); 
														$link = $full_image[0];
                                                    ?>
                                                    <a href="<?php echo $link ?>" class="button btn-icon" data-rel="prettyPhoto[project1]" title="<?php the_title() ?>" >
                                                        <i class="icon-picture icon-large"></i>
                                                    </a>
												<?php   endif; ?>	
                                            </div>
										</div>
                                    </li>						
								<?php $counter ++; endwhile; ?>
							<?php endif;?>
						<?php endif;?>
					</ul>
				<?php endif?>	     
				<?php if ($paginationEnabled ):?>
                    <?php if ( $wp_query->max_num_pages > 1 ): ?>
						<div class="large-10 columns">
							<?php include(Evolution_PLUGINS . '/wp-pagenavi.php' ); wp_pagenavi(); ?> 
							<div class="clear"></div>
						</div>
					<?php endif?>
				<?php endif?>		
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>