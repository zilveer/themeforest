<?php
/** 
Template Name: Portfolio
**/
?>

<?php if (get_post_meta($post->ID, 'header_choice_select', true));{ get_header(get_post_meta($post->ID, 'header_choice_select', true)); } ?>
<div id="container_bg">
	<div id="pf-content">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			</div>
		<?php endwhile; ?>
		
		<?php
			$pf_item_category = get_post_meta($post->ID,'pf_item_category', true);
			$item_columns = get_post_meta($post->ID, 'pf_item_columns', true); 
			$item_count = get_post_meta($post->ID, 'pf_item_count', true); 
		?>

		<?php if (get_post_meta($post->ID,'pf_cat_filter', true) != 'hide') : ?>
			<?php
				if ($pf_item_category){
					$pf_item_slugs = str_replace(', ', ',', $pf_item_category);
					$pf_item_slugs = rtrim($pf_item_slugs, ',');
					$pf_item_slugs =  explode(",", $pf_item_slugs);
					
					foreach ($pf_item_slugs as $pf_item_slug) {
						$pf_show_only[] ='ul.pf-filter li a.'. $pf_item_slug;
					}
					$pf_show_only = implode(', ', $pf_show_only);
					echo '<style>ul.pf-filter li a{display:none;} ul.pf-filter li a.all, ' . $pf_show_only . '{display:inline !important;}</style>';
				}
			?>
			<ul class="pf-filter">
				<li class="active"><a href="javascript:void(0)" class="all"><?php _e('All', 'kickstart'); ?></a></li>
				<?php $terms = get_terms('portfolio_category');
					$count = count($terms); 
					$i=0;
					$term_list = '';
					if ($count > 0) {
						foreach ($terms as $term) {
							$i++;
							$term_list .= '<li><a href="javascript:void(0)" class="'. $term->slug .'">' . $term->name . '</a></li>';
							if ($count != $i) {
								$term_list .= '';
							} else {
								$term_list .= '';
							}
						}
						echo $term_list;
					}
				?>
				<div class="clear"></div>	
			</ul>
		<?php endif; ?>	

		<ul class="filterable-grid <?php echo $item_columns; ?>">
			
			<?php 
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
			$wpbp = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $item_count, 'portfolio_category' => $pf_item_category, 'paged' => $paged)); 

			if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post(); 
		
			$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
			$large_image = $large_image[0]; 
			$terms = wp_get_post_terms($post->ID, 'portfolio_category');
			if ($item_columns == 'pf-four-columns' || $item_columns == 'pf-three-columns') {
				$portfolio_img = aq_resize( $large_image, '460', '335', true );
			} elseif ($item_columns == 'pf-two-columns') {
				$portfolio_img = aq_resize( $large_image, '460', '290', true );
			} else {
				$portfolio_img = aq_resize( $large_image, '540', '270', true );
			}
			?>
			
			<li data-id="id-<?php echo $count; ?>" data-type="<?php foreach ($terms as $term) { echo $term->slug . ' ';} ?>">

				<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
					<img src="<?php echo $portfolio_img; ?>" />				
				<?php endif; ?>	
				
				<?php if($item_columns == 'pf-one-column'){				
					echo '<div class="pf-description">';
						if (get_post_meta($post->ID, 'portfolio_external_link', true)) {
							echo '<h3><a target="_BLANK" href="', get_post_meta($post->ID, 'portfolio_external_link', true) .'">'. get_the_title() .'</a></h3>';
						} else { 
							echo '<h3><a href="', the_permalink() .'">'. get_the_title() .'</a></h3>';
						}
						echo '<div class="pf-category">'. get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' ) .'</div>';
							if (get_post_meta($post->ID, 'portfolio_html', true)) {
								echo '<p>', do_shortcode (get_post_meta($post->ID, 'portfolio_html', true)) .'</p>' ;
							} else {
								echo '<p>', get_excerpt(65) .'</p>';
							}
						echo '<div class="link-button"><a href="', the_permalink() .'">'. __('Learn More', 'kickstart') .'</a></div>
					</div>
					<div class="mask">';
						if (get_post_meta($post->ID, 'portfolio_video_link', true)) {
							echo '<a href="', get_post_meta($post->ID, 'portfolio_video_link', true) .'" class="pf-zoom"><i class="moon-movie"></i></a>';
						} else {
							echo '<a href="', $large_image .'" class="pf-zoom"><i class="moon-camera-3"></i></a>';
						}
						echo '</div>';
				} else {
					echo '<div class="mask">';
						if (get_post_meta($post->ID, 'portfolio_video_link', true)) {
							echo '<a href="', get_post_meta($post->ID, 'portfolio_video_link', true) .'" class="pf-zoom"><i class="moon-movie"></i></a>';
						} else {
							echo '<a href="', $large_image .'" class="pf-zoom"><i class="moon-camera-3"></i></a>';
						}
						if (get_post_meta($post->ID, 'portfolio_external_link', true)) {
							echo '<a target="_BLANK" href="', get_post_meta($post->ID, 'portfolio_external_link', true) .'" class="pf-info"><i class="moon-link-4"></i></a>';
						} else {	
							echo '<a href="', the_permalink() .'" class="pf-info"><i class="moon-link-4"></i></a>';
						}	
					echo '</div><div class="pf-title">'. get_the_title() .'</div>';
				} ?>
			</li>
					
			<?php $count++; ?>		
			<?php endwhile; endif; ?>
			<?php wp_reset_query(); ?>
			<div class="clear"></div>
		</ul>
				
				
		<div class="post-navigation">
			<?php 
				if ( function_exists('wp_pagenavi')) {
						wp_pagenavi(array( 'query' => $wpbp ) );
						wp_reset_postdata();	// avoid errors further down the page
				} 
			?>
		</div>
		
	<div class="clear"></div>
	</div><!-- #content-->
</div><!--#container-->
<?php get_footer(); ?>