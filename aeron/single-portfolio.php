<?php 
get_header();
$portfolio_data = get_post_custom();

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
<?php endif; ?>

<section>
	<div class="container">
		<?php if (have_posts()) : while (have_posts()) : the_post();?>
			<div class="row">
				<div class="span9 content_with_right_sidebar">
					<?php the_post_thumbnail('full', array('class' => 'portfolio_item_image')); ?>
				</div>
				<div id="portfolio_item_meta" class="span3">
					<h4><?php _e('Project Details', 'ABdev_aeron') ?></h4>
					<?php if(isset($portfolio_data['ABp_portfolio_client'])):?>
						<p>
							<span class="portfolio_item_meta_label"><?php _e('CLIENT', 'ABdev_aeron');?></span>
							<span class="portfolio_item_meta_data"><?php echo $portfolio_data['ABp_portfolio_client'][0];?></span>
						</p>
					<?php endif; ?>

					<p>
						<span class="portfolio_item_meta_label"><?php _e('DATE', 'ABdev_aeron');?></span>
						<span class="portfolio_item_meta_data"><?php the_date();?></span>
					</p>

					<p>
						<span class="portfolio_item_meta_label"><?php _e('IN', 'ABdev_aeron');?></span>
						<span class="portfolio_item_meta_data">
							<?php 
							$terms = get_the_terms( $post->ID , 'portfolio-category' );
							foreach ( $terms as $term ) {
								if(is_object($term)){
									echo $term->name . '<br>';
									$related_cat[] = $term->slug;
								}
							} ?>
						</span>
					</p>

					<?php if(isset($portfolio_data['ABp_portfolio_skills'])):?>
						<p>
							<span class="portfolio_item_meta_label"><?php _e('SKILLS', 'ABdev_aeron');?></span>
							<span class="portfolio_item_meta_data"><?php echo str_replace(',','<br>',$portfolio_data['ABp_portfolio_skills'][0]);?></span>
						</p>
					<?php endif; ?>

					<?php if(isset($portfolio_data['ABp_portfolio_link'])):?>
						<p>
							<span class="portfolio_item_meta_label"><?php _e('LINK', 'ABdev_aeron');?></span>
							<span class="portfolio_item_meta_data"><a href="<?php echo (!preg_match("~^(?:f|ht)tps?://~i", $portfolio_data['ABp_portfolio_link'][0])) ? "http://" . $portfolio_data['ABp_portfolio_link'][0] : $portfolio_data['ABp_portfolio_link'][0];?>" target="<?php echo $portfolio_data['ABp_portfolio_link_target'][0];?>"><?php echo $portfolio_data['ABp_portfolio_link'][0];?></a></span>
						</p>
					<?php endif; ?>

				</div>
			</div>
			<h2><?php _e('Project Description', 'ABdev_aeron'); ?></h2>
			<?php the_content();?>
		<?php endwhile; endif;?>
	</div>
</section>

<?php if(isset($portfolio_data['ABp_portfolio_show_related'][0]) && $portfolio_data['ABp_portfolio_show_related'][0]==1): ?>
	<section class="latest_portfolio section_border_top_pattern">
		<div class="container">
			<h3><?php _e('Related Projects', 'ABdev_aeron'); ?></h3>
			<div class="row">
				<?php 
				$args = array(
					'post_type' => 'portfolio',
					'portfolio-category' => implode(',', $related_cat),
					'posts_per_page'=>4,
					'post__not_in'=>array($post->ID),
				);
				$related = new WP_Query( $args );
				$out = $error = '';
				if ($related->have_posts()){
					while ($related->have_posts()){
						$related->the_post();
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

						echo '<div class="span3 portfolio_item overlayed_animated_highlight portfolio_item_4' . $slugs . '">
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
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
<?php endif; ?>


<section id="blog_pagination" class="clearfix">
	<div class="container">
		<div class="pagination pagination-centered">
			<span class="prev"><?php previous_post_link('%link','&laquo; %title'); ?></span>
			<span class="next"><?php next_post_link('%link','%title &raquo;'); ?></span>
		</div>
	</div>
</section>



<?php get_footer();