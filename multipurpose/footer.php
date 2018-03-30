	<?php 
	$disable_top_link = get_theme_mod('disable_top_link') ? get_theme_mod('disable_top_link') : 0;
	if(!$disable_top_link): ?>
		<a href="#top" class="go-top"><?php esc_attr_e('Top', 'multipurpose');?></a>
	<?php endif; ?>
	</section>

	<?php
	$fbg_color = get_theme_mod('footer_bg_color');
    if ($fbg_color) $style = 'style="background-color: ' . $fbg_color . '"';
    else $style = '';

    $footer_pattern = get_theme_mod('footer_pattern');
    if ($footer_pattern == 0) {
        $pattern_class = '';
    } else if ($footer_pattern == -1) {
    	$pattern_class = 'p-none';
    } else {
        if ($footer_pattern < 10) {
            $footer_pattern = "0" . $footer_pattern;
        }
        $pattern_class = "p".esc_attr($footer_pattern);
    }
	?>

	<footer <?php if($style) echo $style; ?> class="<?php echo $pattern_class; ?>">
		<?php if(is_active_sidebar('footer-widget-area')) : ?>
		<section class="widgets columns">
			<?php 
			$column_count = get_theme_mod('column_count') ? get_theme_mod('column_count') : 4;
			$col_class = 'col col' . $column_count;
			?>
			<?php if (!dynamic_sidebar('footer-widget-area') ) : ?><?php endif; ?>		
		</section>
		<?php endif; ?>
		<section class="bottom">
			<?php $show_footer_content = get_theme_mod('show_footer_content');
			if($show_footer_content) {
				$footer_content = get_theme_mod('footer_content');
				echo $footer_content;
			} else { ?>
				<p><?php esc_attr_e('2012-2016', 'multipurpose');?> <?php if( is_front_page() & !is_paged() ) { ?><a href="<?php echo esc_url('http://themeforest.net/item/multipurpose-responsive-wordpress-theme/9219359');?>"><?php esc_attr_e('MultiPurpose', 'multipurpose');?></a><?php } else { esc_attr_e('MultiPurpose', 'multipurpose'); } ?> <?php esc_attr_e('WordPress Theme by', 'multipurpose');?> <a href="<?php echo esc_url('http://thememotive.com/'); ?>"><?php esc_attr_e('ThemeMotive', 'multipurpose');?></a><?php esc_attr_e(' | All rights reserved.', 'multipurpose');?></p>
			<?php } ?>
			<nav class="social">
				<ul>
					<?php $social_links = multipurpose_get_social_links(); 
					foreach($social_links as $link) : ?>
					<li><a href="<?php echo $link->url ?>" class="<?php echo $link->class ?>" target="_blank"><?php echo $link->name ?></a></li>
					<?php endforeach; ?>
				</ul>
			</nav>
		</section>
		<?php wp_footer(); ?>
	</footer>
</div>
<!--[if lt IE 9]>
	<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/ie.js"></script>
<![endif]-->
</body>
</html>