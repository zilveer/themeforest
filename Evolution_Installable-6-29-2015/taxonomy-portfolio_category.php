<?php get_header();
get_template_part('portfolio_header'); 
	//global $paged;
 	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	
	$pageId = isset($_SESSION['Evolution_page_id']) ? $_SESSION['Evolution_page_id'] : '';
	if (!$pageId) $pageId = get_page_ID_by_page_template('portfolio-template-3columns.php');
	$custom =  get_post_custom($pageId);
	$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
	$items_per_page = isset ($custom['_page_portfolio_num_items_page']) ? $custom['_page_portfolio_num_items_page'][0] : '777';
	
	global $wp_query;
	$temp = $wp_query;   $wp_query= null;
	$wp_query = new WP_Query(array( 'taxonomy' => 'portfolio_category', 'term' => $term->slug, 'post_type' => 'portfolio',  'posts_per_page'=> $items_per_page, 'paged'=>$paged, 'showposts'=> $items_per_page));
	$alc_options = get_option('alc_general_settings');
	$breadcrumbs = $alc_options['alc_show_breadcrumbs'];
	$titles = $alc_options['alc_show_page_titles'];
	
	$page_template_name = isset ($_SESSION['Evolution_page_id']) ? get_post_meta($_SESSION['Evolution_page_id'],'_wp_page_template',true) : ''; 
	$itemsize = 'large-block-grid-3';	
	$thumbsize = 'portfolio-3-col';
	switch($page_template_name)
	{		
		case 'portfolio-template-3columns.php': default:
			$itemsize = 'large-block-grid-3';	
			$thumbsize = 'portfolio-3-col';
		break;
		
		case 'portfolio-template-4columns.php':
			$itemsize = 'large-block-grid-4';	
			$thumbsize = 'portfolio-4-col';
		break;		
	}
?>
<div class="row main-content">
    <div class="large-12 columns">
	<div class="row">
            <div class="large-12 columns">
                <ul class="filter portfolio-main">
                    <?php 
                        $cats = get_post_meta($post->ID, "_page_portfolio_cat", $single = true);
                        $MyWalker = new PortfolioWalker2();
			$args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '0', 'include' => $cats, 'title_li'=> '', 'walker' => $MyWalker, 'show_count' => '1');
			$categories = wp_list_categories ($args);
                    ?>
		<!-- End Portfolio Navigation -->
		</ul>
            </div>	
                <div class="large-12 columns">
                    <ul class="portfolio-content <?php echo $itemsize ?>">
			<?php echo getPageContent($pageId); 
                        $counter=1;
			if ($wp_query->have_posts()):
                            while ($wp_query->have_posts()) : 							
                                $wp_query->the_post();
				$custom = get_post_custom($post->ID);
				// Get the portfolio item categories
				$cats = wp_get_object_terms($post->ID, 'portfolio_category');
				if ($cats):
                                    $cat_slugs = '';
                                    foreach( $cats as $cat ) {$cat_slugs .= $cat->slug . " ";}
				endif;
				$link = ''; $thumbnail = get_the_post_thumbnail($post->ID, $thumbsize);
                         ?>
			<li class="prtfolio-item <?php echo $cat_slugs; ?>" data-id="id-<?php echo $counter;?>" data-type="<?php echo $cat_slugs; ?>">
                            <div class="view view-two">
                                <?php if (!empty($thumbnail)): ?>
                                    <?php the_post_thumbnail($thumbsize, array('class' => 'cover')); ?>
				<?php else :?>
                                     <img src="<?php echo get_template_directory_uri()?>/images/picture.jpg" alt="<?php _e ('No preview image', 'Universfolio') ?>" />
				<?php endif?>	
				<div class="mask">
                                    <h3><?php the_title() ?></h3>                                    
                                    <p><?php limit_words(the_excerpt(), 12) ?></p>
                                    <?php if( !empty ( $custom['_portfolio_video'][0] ) ) : $link = $custom['_portfolio_video'][0]; ?>
                                    <a href="<?php echo $link ?>" class="button btn-icon" rel="prettyPhoto" title="<?php get_the_title() ?>">
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
					<a href="<?php echo $link ?>" class="button btn-icon" rel="prettyPhoto" title="<?php get_the_title() ?>" >
                                            <i class="icon-picture icon-large"></i>
					</a>
                                    <?php   endif; ?>
                                </div>
                            </div>
			</li>					
			<?php $counter++; endwhile; ?>				
                    <?php endif?>
                </ul>
		<?php if ( $wp_query->max_num_pages > 1 ): ?>
		<div class="pagination-wrapper">
                    <?php include(Evolution_PLUGINS . '/wp-pagenavi.php' ); wp_pagenavi(); ?> 
                    <div class="clear"></div>
		</div>
		<?php endif?>
              <div class="clear"></div>
          </div>
	</div>
    </div>
</div>

<?php get_template_part('portfolio_footer'); ?>
<?php get_footer() ?>