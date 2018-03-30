<?php global $options_data; ?>
<header id="header" class="header4 clearfix">
	<div class="container">
		<div class="span12">
			<div class="my-table">
				<div class="my-td"><div class="logo">
						<?php if($options_data['media_logo'] != "") { ?>
							<a href="<?php echo esc_url(home_url()); ?>/"><img src="<?php echo esc_attr($options_data['media_logo']); ?>" alt="<?php bloginfo('name'); ?>" class="logo_standard" /></a>
						<?php } else { ?>
							<a class="logo_text" href="<?php echo esc_url(home_url()); ?>/"><?php bloginfo('name'); ?></a>
							<?php if(get_bloginfo('description') != '' && $options_data['check_tagline'] != 1) echo '<span class="site-description">'.get_bloginfo('description').'</span>'; ?>
						<?php } ?>
					</div>
				</div>
				<?php if($options_data['check_header4_search'] == 1 || $options_data['header_content_info'] != "") { ?>
				<div class="my-td">
					<div class="content-area-info">
						<?php if($options_data['check_header4_search'] == 1){
							echo '<div class="header-search">';
							get_search_form();
							echo "</div>";
						} else {
							echo do_shortcode(apply_filters('richer_text_translate', 'header_content_info', $options_data['header_content_info']));
						} ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div id="navigation">
		<div class="container">
			<div class="span12">
				<?php get_template_part('framework/headers/main-nav');?>
			</div>
		</div>
	</div>
</header>