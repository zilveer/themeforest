<?php
get_header();
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
			<?php
			if(have_posts()) : while (have_posts()) : the_post();
				the_content();
			endwhile; endif;
			?>
		</div>
	</div>
</div>
<?php
get_footer(); 
?>