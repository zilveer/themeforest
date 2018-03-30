<?php
/**
 * Page Header
 * @package by Theme Record
 * @auther: MattMao
 *
*/


#
#Page Header
#
function theme_page_header() 
{
	global $wp_query, $wp_rewrite, $post, $page, $paged, $tr_config;

	$post_page_id = $tr_config['blog_page_id'];
	$portfolio_page_id = $tr_config['portfolio_page_id'];
	$shop_page_id = $tr_config['shop_page_id'];
	$gallery_page_id = $tr_config['gallery_page_id'];
	$page_header_title = stripslashes(get_meta_option('page_header_title'));
	$blog_header_title = stripslashes(get_meta_option('page_header_title', $post_page_id));
	$portfolio_header_title = stripslashes(get_meta_option('page_header_title', $portfolio_page_id));
	$shop_header_title = stripslashes(get_meta_option('page_header_title', $shop_page_id));
	$gallery_header_title = stripslashes(get_meta_option('page_header_title', $gallery_page_id));
	$show_filter = $tr_config['portfolio_display_mode'];

	if(!is_front_page()) 
	{
		echo '<div class="site-page-header">',"\n";

		echo '<div class="col-width clearfix">';

		echo '<div class="page-header-left">';

		if($tr_config['enable_breadcrumb'] == true) { new theme_breadcrumbs(); }

		echo '<h3>';

		if ( is_category() ) 
		{ 		
			single_term_title();
		} 
		elseif (is_day()) 
		{
			echo get_the_time('F jS, Y');
		} 
		elseif (is_month())
		{ 
			echo get_the_time('F, Y'); 
		} 
		elseif (is_year()) 
		{ 
			echo get_the_time('Y'); 
		} 
		elseif (is_search()) 
		{
			echo __('Search results', 'TR'); 
		} 
		elseif (is_author()) 
		{ 
			echo __('Author', 'TR');

		} 
		elseif (is_tag()) 
		{
			echo __('Tags', 'TR'); 
		} 
		elseif(is_tax())
		{
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			echo $term->name;
		}
		elseif(is_home())
		{
			if($blog_header_title) {
				echo $blog_header_title;
			}else{
				echo get_page_name($post_page_id);
			}
		}
		elseif(is_page())
		{
			if($page_header_title) {
				echo $page_header_title;
			}else{
				echo get_the_title();
			}
		}
		elseif( is_single()) 
		{
			if(get_post_type( $post ) == 'post' )
			{
				if($blog_header_title) {
					echo $blog_header_title;
				}else{
					echo get_the_title($post_page_id);
				}				
			}
			elseif(get_post_type( $post ) == 'portfolio' )
			{
				if($portfolio_header_title) {
					echo $portfolio_header_title;
				}else{
					echo get_the_title($portfolio_page_id);
				}
			}
			elseif(get_post_type( $post ) == 'product' )
			{
				if($shop_header_title) {
					echo $shop_header_title;
				}else{
					echo get_the_title($shop_page_id);
				}
			}
			elseif(get_post_type( $post ) == 'gallery' )
			{
				if($gallery_header_title) {
					echo $gallery_header_title;
				}else{
					echo get_the_title($gallery_page_id);
				}
			}
		}
		elseif(is_404())
		{
			echo __('404', 'TR');
		}
		else
		{
			echo __('Archives', 'TR');
		}

		echo '</h3>',"\n";

		echo '</div>',"\n";

		if(get_the_ID() == $portfolio_page_id)
		{
			if($show_filter == '2')
			{
				theme_portfolio_classic_filter();
			}
			elseif($show_filter == '3')
			{
				theme_portfolio_jquery_filter();
			}
		}
		elseif(is_tax('portfolio-category'))
		{
			theme_portfolio_classic_filter();
		}
		elseif(get_the_ID() == $shop_page_id || is_tax('product-category'))
		{
			theme_product_classic_filter();
		}
		elseif( is_single()) 
		{
			theme_single_pagenation();
		}

		echo '</div>';

		echo '</div>',"\n";
	}
}




#
#Portfolio Classic Filter
#
function theme_portfolio_classic_filter() 
{
	$cat_args = array(
		'taxonomy' => 'portfolio-category',
		'orderby' => 'name',
		'show_count' => 0, // 1 for yes, 0 for no
		'hierarchical' => 1, // 1 for yes, 0 for no
		'hide_empty' => 0, // 1 for yes, 0 for no
		'title_li' => '',
		'depth' => 1
	);

	global $tr_config;
	$portfolio_page_id = $tr_config['portfolio_page_id'];
	$current_class = '';
	if(get_the_ID() == $portfolio_page_id ) { $current_class = ' class="current-cat"'; }

	echo '<nav class="sortable-menu portfolio-classic-menu">',"\n";
	echo '<ul class="clearfix">',"\n";

	if($portfolio_page_id) { echo '<li'.$current_class.'><a href="'.get_page_link($portfolio_page_id).'">'.__('All', 'TR').'</a></li>'; }

	wp_list_categories( $cat_args ); 
	echo '</ul>',"\n";
	echo '</nav>',"\n";
}



#
#Portfolio Jquery Filter
#
function theme_portfolio_jquery_filter() 
{
	$cat_args = array(	
		'taxonomy'	=> 'portfolio-category',
		'hide_empty' => 0
	);

	global $tr_config;
	$portfolio_page_id = $tr_config['portfolio_page_id'];
	$terms = get_categories($cat_args);

	echo '<nav class="sortable-menu portfolio-sortable-menu">',"\n";
	echo '<ul class="filter clearfix">',"\n";

	if($portfolio_page_id) { echo '<li class="active all-items"><a href="'.get_page_link($portfolio_page_id).'">'.__('All', 'TR').'</a></li>'."\n"; }

	foreach ($terms as $term) {
		echo '<li class="'.$term->slug.'"><a href="'.get_term_link($term->slug, 'portfolio-category').'" data-value="'.$term->slug.'">'.$term->name.'</a></li>'."\n";
	}

	echo '</ul>',"\n";
	echo '</nav>',"\n";
}




#
#Product Classic Filter
#
function theme_product_classic_filter() 
{
	$cat_args = array(
		'taxonomy' => 'product-category',
		'orderby' => 'name',
		'show_count' => 0, // 1 for yes, 0 for no
		'hierarchical' => 1, // 1 for yes, 0 for no
		'hide_empty' => 0, // 1 for yes, 0 for no
		'title_li' => '',
		'depth' => 1
	);

	global $tr_config;
	$shop_page_id = $tr_config['shop_page_id'];
	$current_class = '';
	if(get_the_ID() == $shop_page_id ) { $current_class = ' class="current-cat"'; }

	echo '<nav class="sortable-menu portfolio-classic-menu">',"\n";
	echo '<ul class="clearfix">',"\n";

	if($shop_page_id) { echo '<li'.$current_class.'><a href="'.get_page_link($shop_page_id).'">'.__('All', 'TR').'</a></li>'; }

	wp_list_categories( $cat_args ); 
	echo '</ul>',"\n";
	echo '</nav>',"\n";
}




#
#Single Pagenation
#
function theme_single_pagenation() 
{
	global $post, $page, $paged, $tr_config;

	$post_page_id = $tr_config['blog_page_id'];
	$portfolio_page_id = $tr_config['portfolio_page_id'];
	$shop_page_id = $tr_config['shop_page_id'];
	$gallery_page_id = $tr_config['gallery_page_id'];


	if(get_post_type( $post ) == 'post' )
	{
		$list_page_id = $post_page_id;	
	}
	elseif(get_post_type( $post ) == 'portfolio' )
	{
		$list_page_id = $portfolio_page_id;	
	}
	elseif(get_post_type( $post ) == 'product' )
	{
		$list_page_id = $shop_page_id;	
	}
	elseif(get_post_type( $post ) == 'gallery' )
	{
		$list_page_id = $gallery_page_id;	
	}
?>
	<nav class="single-post-pagenation">
		<ul class="clearfix">
		<?php if( get_previous_post() ) : ?>
		<li class="previous-link"><?php previous_post_link('%link', __( 'Previous', 'TR' )) ?></li>
		<?php endif; ?>
		<?php if($list_page_id) : ?>
		<li class="back-lists"><a href="<?php echo get_page_link($list_page_id); ?>"><?php _e('Back to lists', 'TR'); ?></a></li>
		<?php endif; ?>
		<?php if( get_next_post() ) : ?>
		<li class="next-link"><?php next_post_link('%link', __( 'Next', 'TR' )) ?></li>
		<?php endif; ?>
		</ul>
	</nav>
<?php
}
?>