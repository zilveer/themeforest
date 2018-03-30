<?php

/*
Template Name: Portfolio 4 Columns
*/

get_header();

get_template_part('title_breadcrumb_bar');

?>

<section>
	<div class="container">
		<?php 
		
		//check if portfolio plugin is activated
		if(current_user_can( 'manage_options' ) && !in_array( 'abdev-portfolio/abdev-portfolio.php', get_option( 'active_plugins') )){
			echo '<p><strong>' . __('This page requires Portfolio plugin to be activated','ABdev_aeron') . '</strong></p>';
		}


		if (have_posts()) : while (have_posts()) : the_post();?>
			<?php the_content();?>
		<?php endwhile; endif;?>

		<?php
		$values = get_post_custom( $post->ID );
		$selected_categories = isset($values['categories'][0]) ? $values['categories'][0] : '';

		$args = array(
			'post_type' => 'portfolio',
			'portfolio-category' => $selected_categories,
			'posts_per_page'=>-1,
		);
		$posts = new WP_Query( $args );
		$out = $error = '';
		if ($posts->have_posts()){
			while ($posts->have_posts()){
				$posts->the_post();
				$slugs=$in_category='';		
				$terms = get_the_terms( $post->ID , 'portfolio-category' );
				foreach ( $terms as $term ) {
					if(is_object($term)){
						$slugs.=' '.$term->slug;
						$filter_slugs[$term->slug] = $term->name;
						$in_category = $term->name;
					}
				}

				$thumbnail_id = get_post_thumbnail_id($post->ID);
				$thumbnail_object = get_post($thumbnail_id);
				$thumbnail_src=$thumbnail_object->guid;

				$out .= '<div class="portfolio_item overlayed_animated_highlight portfolio_item_4' . $slugs . '">
					<div class="overlayed">
						' . get_the_post_thumbnail() . '
						<div class="overlay">
							<p>
								<a href="'.get_permalink().'"><i class="ci_icon-forward"></i></a>
								<a href="'.$thumbnail_src.'" class="fancybox lightbox" data-fancybox-group="portfolio" data-lightbox="portfolio"><i class="ci_icon-search"></i></a>
							</p>
						</div>
					</div>
					<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>
					<span>' . get_the_date() . ' // ' . $in_category . '</span>
				</div>';
			}

		}
		else{
			echo '<p>' . __('No Portfolio Posts Found.', 'ABdev_aeron') . '</p>';
		}
		$filter_out='';
		if(isset($filter_slugs)){
			foreach($filter_slugs as $slug => $name){
				$filter_out.='<li><a href="#filter" data-option-value=".'.$slug.'">'.$name.'</a></li>';
			}

		?>
		<ul id="filters" class="option-set clearfix" data-option-key="filter">
			<li><i class="ci_icon-filter2"></i></li>
			<li><a href="#filter" data-option-value="*" class="selected"><?php _e('Show all', 'ABdev_aeron');?></a></li>
			<?php echo $filter_out;?>
		</ul>
		<?php 

		}	
		?> 
	</div>
</section>

<section class="section_border_top">
	<div class="container">
		<div id="portfolio_items">
			<?php echo $out;?>
		</div>
	</div>
</section>



<?php 
get_footer();