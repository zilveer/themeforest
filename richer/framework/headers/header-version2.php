<?php global $options_data; ?>
<header id="header" class="header2 clearfix">
	<div class="container">
		<div class="span12">
			<div class="my-table">
				<div class="my-tr">
					<div class="my-td">
						<div class="logo aligncenter">
							<?php if($options_data['media_logo'] != "") { ?>
								<a href="<?php echo esc_url(home_url()); ?>/"><img src="<?php echo esc_attr($options_data['media_logo']); ?>" alt="<?php bloginfo('name'); ?>" class="logo_standard" /></a>
							<?php } else { ?>
								<a class="logo_text" href="<?php echo esc_url(home_url()); ?>/"><?php bloginfo('name'); ?></a>
								<?php if(get_bloginfo('description') != '' && $options_data['check_tagline'] != 1) echo '<span class="site-description">'.get_bloginfo('description').'</span>'; ?>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="my-tr">
					<div class="my-td">
						<div id="navigation">
							<?php get_template_part('framework/headers/main-nav');?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>