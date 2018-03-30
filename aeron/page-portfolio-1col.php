<?php

/*
Template Name: Portfolio Single Column
*/

get_header();
$read_more=__('Read More','ABdev_aeron').' <i class="ci_icon-forward"></i>';

get_template_part('title_breadcrumb_bar'); 

?>

<?php //check if portfolio plugin is activated
if(current_user_can( 'manage_options' ) && !in_array( 'abdev-portfolio/abdev-portfolio.php', get_option( 'active_plugins') )):?>
	<section>
		<div class="container">
			<p>
				<strong><?php _e('This page requires Portfolio plugin to be activated','ABdev_aeron');?></strong>
			</p>
		</div>
	</section>
<?php 
endif; 

if (have_posts()) : while (have_posts()) : the_post();
	$content = do_shortcode(get_the_content());
	if ($content != ''):?>
		<section>
			<div class="container">
				<?php echo $content;?>
			</div>
		</section>
<?php endif; endwhile; endif;?>



<section class="<?php echo ($content != '') ? 'section_border_top' : '';?>">
	<div class="container">
		<div id="portfolio_single_column">
			<?php
			$values = get_post_custom( $post->ID );
			$selected_categories = isset($values['categories'][0]) ? $values['categories'][0] : '';
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$args = array(
				'post_type' => 'portfolio',
				'portfolio-category' => $selected_categories,
				'paged'=>$paged,
			);
			$posts = new WP_Query( $args );
			$out = $error = '';
			if ($posts->have_posts()){
				while ($posts->have_posts()){
					$posts->the_post();

					global $more;
					$more = 0;
					$terms = get_the_terms( $post->ID , 'portfolio-category' );
					foreach ( $terms as $term ) {
						if(is_object($term)){
							$item_categories[] = $term->name;
						}
					}
					$item_categories_out = implode(', ', $item_categories);
					$item_categories = '';

					echo '<div class="portfolio_single_column_item">
						<div class="row">
							<div class="span6">
								' . get_the_post_thumbnail() . '
							</div>
							<div class="span6">
								<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
								<p class="single_portfolio_meta"><i class="ci_icon-folder"></i> '.$item_categories_out.' <i class="ci_icon-calendar2"></i> '.get_the_date().'</p>
								' . get_the_content($read_more) . '
							</div>
						</div>
					</div>';
				}

			}
			else{
				echo '<p>' . __('No Portfolio Posts Found.', 'ABdev_aeron') . '</p>';
			}
			
			?> 

		</div>
	</div>
</section>


<?php get_template_part( 'pagination-portfolio' ); ?>

<?php get_footer();