<?php
/*
 Template Name: Portfolio Gallery
 Displays the portfolio items in a grid, separated by pages. The items can be also
 filtered by a category.
 */
get_header();


if(have_posts()){
	while(have_posts()){
		the_post();
		
		//get all the page meta data (settings) needed (function located in lib/functions/meta.php)
		$pexeto_page=pexeto_get_post_meta($post->ID, array('pg_show_filter', 'pg_exclude_cats', 
			'pg_post_number', 'pg_columns','pg_order', 'pg_order_by', 'pg_thumbnail_height', 
			'pg_masonry', 'pg_related_lightbox', 'slider', 'show_title'));
		$pexeto_page['layout']='full';
		$page_url = get_permalink($post->ID);

		//current CSS class
		$current_class = 'current';

		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );
		wp_reset_postdata();
		the_content(); 

		$add_class = $pexeto_page['show_title'] == 'off' ? ' pg-no-title':'';
?>
	

	<div class="pg-navigation<?php echo $add_class; ?>">
		<div class="pg-nav-wrapper content-boxed">
		<?php

		$cat_key = is_front_page() ? 'pcat' : 'cat'; //do not use the "cat" parameter in the URL when the page is a front page or it will load the blog category archive
		$cat = isset($_GET[$cat_key]) ? $_GET[$cat_key] : '-1';
		$exclude_cats = array();
		if(!empty($pexeto_page['pg_exclude_cats'])){
			$exclude_cats = explode(',', $pexeto_page['pg_exclude_cats']);
		}

		//display the category filter
		if($pexeto_page['pg_show_filter']=='true'){ ?>
			<div class="pg-cat-filter">
				<div class="pg-filter-btn"><span></span></div>
				<ul>
				<?php $cclass = $cat=='-1'?'class="'.$current_class.'"':''; ?>
				<li>
					<a data-cat="-1" href="<?php echo esc_url( $page_url ); ?>" <?php echo $cclass; ?>>
						<?php _e( 'All', 'pexeto' ); ?>
					</a>
				</li>
				<?php
				$cats=get_terms(PEXETO_PORTFOLIO_TAXONOMY, array("hide_empty"=>false, "hierarchical"=>true, "exclude_tree"=>$exclude_cats, "exclude"=>$exclude_cats));
				foreach ($cats as $c) {
					$cclass = $cat==$c->slug?'class="'.$current_class.'"':''; ?>
					<li>
						<a href="<?php echo esc_url (add_query_arg( $cat_key, $c->slug, $page_url ) ); ?>" <?php echo $cclass; ?> data-cat="<?php echo $c->slug; ?>">
							<?php echo $c->name; ?>
						</a>
					</li><?php
				}

		?></ul></div><?php
		} //end if ?>
		</div>
	</div>

<div class="content-boxed">
	<div id="portfolio-gallery">

	<div class="pg-items-wrapper">
<?php 
		//display the portfolio items
		$gal_paged = isset($_GET['set']) ? $_GET['set'] : 1;

		//set the image height
		$image_height = $pexeto_page['pg_masonry']=='true' ? '' : $pexeto_page['pg_thumbnail_height'];

		$args = array(
				'number' => $pexeto_page['pg_post_number'],
				'page' => $gal_paged,
				'excludeCats' => $exclude_cats,
				'orderby' => $pexeto_page['pg_order_by'],
				'order' => $pexeto_page['pg_order']
			);
		if($cat!='-1'){
			$args['cat'] = $cat;
		}

		$pg_query = pexeto_get_portfolio_gallery_query($args);


		?><div class="pg-items">
			<div class="pg-page-wrapper">
			<?php

				while ($pg_query->have_posts()) {
					$pg_query->the_post();

					echo pexeto_get_gallery_thumbnail_html( $pg_query->post, 
															intval($pexeto_page['pg_columns']), 
															$image_height );

				} //end while

			?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="pg-pagination">
			<?php 
				//print the pagination
				$pagination_url = $cat=='-1'?$page_url:add_query_arg($cat_key, $cat, $page_url);
				echo pexeto_get_gallery_pagination_html( $pg_query, 
												  $pexeto_page['pg_post_number'], 
												  $gal_paged,
												  $pagination_url ); 
			?>
		</div>
	</div>
</div>
</div>
<?php
	}
}
//set the initialization scripts
global $pexeto_scripts;
$items_map = pexeto_get_portfolio_items_map($args);
$scr_args = array(
		'itemsPerPage' => $pexeto_page['pg_post_number'],
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'currentPage' => $gal_paged,
		'imgheight' => $image_height,
		'columns' => intval($pexeto_page['pg_columns']),
		'excludeCats' => $exclude_cats,
		'parentSel' => '#full-width',
		'currentCat' => $cat,
		'pageUrl' => $page_url,
		'currentClass' => $current_class,
		'itemsMap' => $items_map,
		'orderby' => $pexeto_page['pg_order_by'],
		'order' => $pexeto_page['pg_order'],
		'enableAJAX' => pexeto_option('portfolio_ajax')
	);
$src_args['categoryFilter'] = $pexeto_page['pg_show_filter']=='true' ? true : false;
$scr_args['masonry'] = $pexeto_page['pg_masonry']=='true' ? true : false;
$scr_args['relatedLightbox'] = $pexeto_page['pg_related_lightbox']=='true' ? true : false;
$pexeto_scripts['portfolio-gallery'] = array('selector'=>'#portfolio-gallery', 'options'=>$scr_args);


//reset the inital page query
wp_reset_postdata();


//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>
