<?php

get_header();
?>

		<div class="block-full bg-color-main">
			<div class="block-inner">

				<div class="tbl-bottom">
					<div class="tbl-td">
						<h1 class="page-h1"><?php echo $wp_query->queried_object->name ?></h1>
					</div>
					<?php if(get_option(OM_THEME_PREFIX . 'show_breadcrumbs') == 'true') { ?>
						<div class="tbl-td">
							<?php om_breadcrumbs(get_option(OM_THEME_PREFIX . 'breadcrumbs_caption')) ?>
						</div>
					<?php } ?>
				</div>
				<div class="clear page-h1-divider"></div>

				<?php

				$arg=array (
					'type' => 'portfolio',
					'taxonomy' => 'portfolio-type'
				);
				$portfolio_root_cat=false;
				if($wp_query->queried_object->parent) {
					$tmp=get_term($wp_query->queried_object->parent,'portfolio-type');
					while($tmp->parent)
						$tmp=get_term($tmp->parent,'portfolio-type');
					$portfolio_root_cat=$tmp->term_id;
					$portfolio_root_cat_slug=$tmp->slug;
					$arg['child_of']=$portfolio_root_cat;
				}
				$categories=get_categories( $arg );
				if(!empty($categories)) {
				?>
					<!-- Categories -->
					<ul class="sort-menu">
						<?php
							$args = array(
								'post_type' => 'page',
								'posts_per_page' => 1,
								'meta_query' => array(
									array(
										'key' => '_wp_page_template',
										'value' => array('template-portfolio.php', 'template-portfolio-m.php'),
										'compare' => 'IN',
									)
								)
							);
							if($portfolio_root_cat) {
								$args['meta_query'][]=array(
									'key' => OM_THEME_SHORT_PREFIX.'portfolio_categories',
									'value' => $portfolio_root_cat
								);
							}
							$tmp_q = new WP_Query($args);
							if($tmp_q->post_count) {
								$portfolio_root_page_id=$tmp_q->posts[0]->ID;
							} else {
								$portfolio_root_page_id=false;
							}
							wp_reset_postdata();
							if($portfolio_root_page_id) {
								if($portfolio_root_cat) {
									$tmp_q = new WP_Query(array(
										'post_type' => 'portfolio',
										'posts_per_page' => -1,
										'portfolio-type' => $portfolio_root_cat_slug
									));
									$portfolio_count=$tmp_q->post_count;
									wp_reset_postdata();
								} else {
									$portfolio_count=wp_count_posts( 'portfolio');
									$portfolio_count=$portfolio_count->publish;
								}
								?><li><a href="<?php echo get_permalink($portfolio_root_page_id)?>" class="button single-color"><?php _e('All', 'om_theme'); ?><span class="count"><?php echo $portfolio_count ?></span></a></li><?php
							}
						?>
						<?php
							foreach($categories as $category) {
								if(!$category->count)
									continue;
								echo '<li><a href="'.get_term_link($category, 'portfolio-type').'" class="button single-color'.($wp_query->queried_object->term_taxonomy_id==$category->term_taxonomy_id?' active':'').'">'.$category->name.'<span class="count">'.$category->count.'</span></a></li>';
							}
						?>
					</ul>
					<div class="clear"></div>
					<!-- /Categories -->
				<?php } ?>
				
				<?php echo category_description(); ?>
			</div>
		</div>
		
		<div class="clear anti-mar">&nbsp;</div>
		
		<div class="portfolio-wrapper">
			<!-- Portfolio items -->
			
				<?php
				$arg=array (
					'post_type' => 'portfolio',
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'posts_per_page' => -1,
					'portfolio-type' => $wp_query->queried_object->slug
				);
				
				$sort=get_option(OM_THEME_PREFIX . 'portfolio_sort');
				if($sort == 'date_asc') {
					$arg['orderby'] = 'date';
					$arg['order'] = 'ASC';
				} elseif($sort == 'date_desc') {
					$arg['orderby'] = 'date';
					$arg['order'] = 'DESC';
				}

				$pagination=intval(get_option(OM_THEME_PREFIX . 'portfolio_per_page'));
				if($pagination) {
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$arg['posts_per_page']=$pagination;
					$arg['paged']=$paged;
				}
				
				$query = new WP_Query($arg);
				$max_num_pages=$query->max_num_pages;
				
				$layout=get_option(OM_THEME_PREFIX . 'portfolio_category_layout');
				if(!$layout)
					$layout='3colums';
					
				if($layout == 'masonry') {
					// Masonry layout
					
					while ( $query->have_posts() ) : $query->the_post(); 

						$size = get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'portfolio_size', true);
						$size=intval($size);
						if(!$size)
							$size=1;
						elseif($size > 3)
							$size=3;					

						$terms =  get_the_terms( $post->ID, 'portfolio-type' ); 
						$term_list = array();
						if( is_array($terms) ) {
							foreach( $terms as $term ) {
								$term_list[]=urldecode($term->slug);
							}
						}
						$term_list=implode(' ',$term_list);
						
						$link=get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'portfolio_custom_link', true);
						if(!$link)
							$link=get_permalink();
							
						?>
						
						<div <?php post_class('portfolio-thumb bg-color-alt isotope-item block-'.$size.' '.$term_list); ?> id="post-<?php the_ID(); ?>">
							<div class="pic block-h-<?php echo $size ?>">
								<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
								<?php the_post_thumbnail('portfolio-q-thumb'); ?>
								<?php } else { echo '&nbsp'; } ?>
							</div>
							<a href="<?php echo $link ?>" class="link show-hover-link"><span class="after"></span></a>
						</div>
						<?php
					endwhile;
				
				} else {
					// 3 columns layout
				
					while ( $query->have_posts() ) : $query->the_post(); 
					
						$terms =  get_the_terms( $post->ID, 'portfolio-type' ); 
						$term_list = array();
						if( is_array($terms) ) {
							foreach( $terms as $term ) {
								$term_list[]=urldecode($term->slug);
							}
						}
						$term_list=implode(' ',$term_list);
						
						$link=get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'portfolio_custom_link', true);
						if(!$link)
							$link=get_permalink();
							
						?>
					
						<div <?php post_class('portfolio-thumb bg-color-main isotope-item block-3 show-hover-link '.$term_list); ?> id="post-<?php the_ID(); ?>">
							<div class="pic block-h-2">
								<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
								<?php the_post_thumbnail('portfolio-thumb'); ?>
								<?php } else { echo '&nbsp'; } ?>
							</div>
							<div class="desc block-h-1">
								<div class="title"><?php the_title(); ?></div>
								<div class="tags"><?php the_terms($post->ID, 'portfolio-type', '', ', ', ''); ?></div>
							</div>
							<a href="<?php echo $link ?>" class="link"><span class="after"></span></a>
						</div>
						<?php
					endwhile;
				
				}
				
				wp_reset_postdata();
			
			  ?>

			<!-- /Portfolio items -->
			<div class="clear"></div>
		</div>									

		<div class="clear anti-mar">&nbsp;</div>

		<?php
			if($pagination) {
				$links=paginate_links( array(
					'base' => str_replace( '999999999', '%#%', esc_url( get_pagenum_link( '999999999' ) ) ),
					'format' => '?paged=%#%',
					'current' => $paged,
					'total' => $max_num_pages,
					'type' => 'array',
					'prev_text' => __('Previous', 'om_theme'),
					'next_text' => __('Next', 'om_theme'),
				) );
				if(!empty($links)) {
					echo '<div class="block-full bg-color-main"><div class="block-inner">';
					echo om_wrap_paginate_links($links);
					echo '</div></div><div class="clear anti-mar">&nbsp;</div>';
				}
			}
		?>		
		
<?php get_footer(); ?>