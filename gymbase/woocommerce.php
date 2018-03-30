<?php
get_header();
global $post;
$post = get_post(get_option("woocommerce_shop_page_id"));
setup_postdata($post);
?>
<div class="theme_page relative">
	<div class="page_layout clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<h1><?php the_title(); ?></h1>
				<h4><?php echo get_post_meta(get_the_ID(), $themename. "_subtitle", true); ?></h4>
			</div>
			<div class="page_header_right">
				<?php
				get_sidebar('header');
				?>
			</div>
		</div>
		<ul class="bread_crumb clearfix">
			<li><?php _e('You are here:', 'gymbase'); ?></li>
			<li>
				<a href="<?php echo get_home_url(); ?>" title="<?php _e('Home', 'gymbase'); ?>">
					<?php _e('Home', 'gymbase'); ?>
				</a>
			</li>
			<li class="separator icon_small_arrow right_white">
				&nbsp;
			</li>
			<li>
				<?php the_title(); ?>
			</li>
		</ul>
		<div class="clearfix horizontal">
			<div class="vc_row wpb_row vc_row-fluid page_margin_top">
				<div class="vc_col-sm-8 wpb_column vc_column_container ">
					<div class="wpb_wrapper">
						<?php
						if(have_posts()):
							woocommerce_content();
						endif;
						?>
					</div> 
				</div>
				<div class="vc_col-sm-4 wpb_column vc_column_container">
					<div class="wpb_wrapper">
						<div class="wpb_widgetised_column wpb_content_element clearfix">
							<div class="wpb_wrapper">
								<?php dynamic_sidebar("sidebar-shop"); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
global $post;
$post = get_post(get_option("woocommerce_shop_page_id"));
setup_postdata($post);
get_footer(); 
?>