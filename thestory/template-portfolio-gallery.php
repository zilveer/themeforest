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
		$pexeto_page=pexeto_get_post_meta($post->ID, array('pg_show_filter', 'pg_filter_cats', 
			'pg_post_number', 'pg_columns','pg_order_items', 'pg_thumbnail_height', 
			'pg_masonry', 'pg_related_lightbox', 'slider', 'header_display', 'pg_spacing'));
		$pexeto_page['layout']='full';
		$pexeto_gal = new StdClass();

		$pexeto_gal->page_url = get_permalink($post->ID);

		//current CSS class
		$pexeto_gal->current_class = 'current';

		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );
		wp_reset_postdata();

		if(post_password_required()){
		//print the password protection form
		?><div class="content-box password-content-box"><?php echo get_the_password_form(); ?></div><?php
		}else{

?>
	

	<div class="pg-navigation">
		<div class="pg-nav-wrapper content-boxed">
		<?php
		$pexeto_gal->cat_key = is_front_page() ? 'pcat' : 'cat'; //do not use the "cat" parameter in the URL when the page is a front page or it will load the blog category archive
		$pexeto_gal->cat = isset($_GET[$pexeto_gal->cat_key]) ? $_GET[$pexeto_gal->cat_key] : '-1';
		$pexeto_gal->filter_cats = array();
		$pexeto_gal->filter_type = $pexeto_page['pg_filter_cats']['type'];
		if(!empty($pexeto_page['pg_filter_cats']['cats'])){
			$pexeto_gal->filter_cats = explode(',', $pexeto_page['pg_filter_cats']['cats']);
		}

		//display the category filter
		if($pexeto_page['pg_show_filter']=='true'){ ?>
			<div class="pg-cat-filter">
				<div class="pg-filter-btn"><span></span></div>
				<ul>
				<?php $pexeto_gal->cclass = $pexeto_gal->cat=='-1'?'class="'.$pexeto_gal->current_class.'"':''; ?>
				<li>
					<a data-cat="-1" href="<?php echo esc_url( $pexeto_gal->page_url ); ?>" <?php echo $pexeto_gal->cclass; ?>><?php _e( 'All', 'pexeto' ); ?></a>
				</li>
				<?php
				$pexeto_gal->cat_args = array("hide_empty"=>false, "hierarchical"=>true);

				if(!empty($pexeto_gal->filter_cats)){
					$filter = $pexeto_gal->filter_type=='include'?'include':'exclude_tree';
					$pexeto_gal->cat_args[$filter]=$pexeto_gal->filter_cats;
				}

				$pexeto_gal->cats=get_terms(PEXETO_PORTFOLIO_TAXONOMY, $pexeto_gal->cat_args);
				foreach ($pexeto_gal->cats as $c) {
					$pexeto_gal->cclass = $pexeto_gal->cat==$c->slug?'class="'.$pexeto_gal->current_class.'"':''; ?>
					<li>
						<a href="<?php echo esc_url (add_query_arg( $pexeto_gal->cat_key, $c->slug, $pexeto_gal->page_url ) ); ?>" <?php echo $pexeto_gal->cclass; ?> data-cat="<?php echo $c->slug; ?>"><?php echo $c->name; ?></a>
					</li><?php
				}

		?></ul></div><?php
		} //end if ?>
		</div>
	</div>

<div class="content-boxed">
	<?php 
	if(!empty($post->post_content)){
		?><div class="pg-page-content">
		<?php the_content(); ?>
		</div>
		<?php
	}

	$pexeto_gal->add_class=$pexeto_page['pg_spacing']=='false' ? 'pg-no-spacing':'pg-spacing';
	$pexeto_gal->add_class.=pexeto_get_portfolio_effect_classes('pg');

	 ?>
	<div id="portfolio-gallery" class="<?php echo $pexeto_gal->add_class; ?>">

	<div class="pg-items-wrapper">
<?php 
		//display the portfolio items
		$pexeto_gal->paged = isset($_GET['set']) ? $_GET['set'] : 1;

		//set the image height
		$pexeto_gal->image_height = $pexeto_page['pg_masonry']=='true' ? '' : $pexeto_page['pg_thumbnail_height'];

		$pexeto_gal->args = array(
				'number' => $pexeto_page['pg_post_number'],
				'page' => $pexeto_gal->paged,
				'filterCats' => $pexeto_gal->filter_cats,
				'filterType' => $pexeto_gal->filter_type,
				'orderby' => $pexeto_page['pg_order_items']['order_by'],
				'order' => $pexeto_page['pg_order_items']['order']
			);

		if($pexeto_gal->cat!='-1'){
			$pexeto_gal->args['cat'] = $pexeto_gal->cat;
		}

		$pexeto_gal->query = pexeto_get_portfolio_gallery_query($pexeto_gal->args);


		?><div class="pg-items">
			<div class="pg-page-wrapper">
			<?php

				while ($pexeto_gal->query->have_posts()) {
					$pexeto_gal->query->the_post();

					echo pexeto_get_gallery_thumbnail_html( $pexeto_gal->query->post, 
															intval($pexeto_page['pg_columns']), 
															$pexeto_gal->image_height );

				} //end while

			?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="pg-pagination">
			<?php 
				//print the pagination, this URL will be escaped in the pexeto_get_gallery_pagination_html() function
				$pexeto_gal->pagination_url = $pexeto_gal->cat=='-1'?$pexeto_gal->page_url:add_query_arg('cat', $pexeto_gal->cat, $pexeto_gal->page_url);
				echo pexeto_get_gallery_pagination_html( $pexeto_gal->query, 
												  $pexeto_page['pg_post_number'], 
												  $pexeto_gal->paged,
												  $pexeto_gal->pagination_url ); 
			?>
		</div>
	</div>
</div>
</div>
<?php

$pexeto_map_settings = $pexeto_gal->args;
if(isset($pexeto_map_settings['cat'])){
	unset($pexeto_map_settings['cat']);
}
	
//set the initialization scripts
global $pexeto_scripts;
$pexeto_gal->scr_args = array(
		'itemsPerPage' => $pexeto_page['pg_post_number'],
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'currentPage' => $pexeto_gal->paged,
		'imgheight' => $pexeto_gal->image_height,
		'columns' => intval($pexeto_page['pg_columns']),
		'filterCats' => $pexeto_gal->filter_cats,
		'filterType' => $pexeto_gal->filter_type,
		'parentSel' => '#full-width',
		'currentCat' => $pexeto_gal->cat,
		'pageUrl' => $pexeto_gal->page_url,
		'currentClass' => $pexeto_gal->current_class,
		'itemsMap' => pexeto_get_portfolio_items_map($pexeto_map_settings),
		'orderby' => $pexeto_page['pg_order_items']['order_by'],
		'order' => $pexeto_page['pg_order_items']['order'],
		'enableAJAX' => pexeto_option('portfolio_ajax')
	);
$pexeto_gal->scr_args['categoryFilter'] = $pexeto_page['pg_show_filter']=='true' ? true : false;
$pexeto_gal->scr_args['masonry'] = $pexeto_page['pg_masonry']=='true' ? true : false;
$pexeto_gal->scr_args['relatedLightbox'] = $pexeto_page['pg_related_lightbox']=='true' ? true : false;

if($pexeto_page['pg_spacing']=='false'){
	$pexeto_gal->scr_args['additionalWidth']=0;
}

$pexeto_scripts['portfolio-gallery'] = array('selector'=>'#portfolio-gallery', 'options'=>$pexeto_gal->scr_args);



//reset the inital page query
wp_reset_postdata();

		} //end if password required
	} //end while have posts

} //end if have posts


//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>
