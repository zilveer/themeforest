<?php global $options_data; ?>
<header id="fixed_header" class="header1 fixed_header">
	<div class="container">
		<div class="span12">
			<div class="my-table">
				<div class="my-td"><div class="logo">
					<?php if($options_data['media_logo'] != "") { ?>
						<a href="<?php echo esc_url(home_url()); ?>/"><img src="<?php echo esc_attr($options_data['media_logo']); ?>" alt="<?php bloginfo('name'); ?>" class="logo_standard" /></a>
					<?php } else { ?>
						<a class="logo_text" href="<?php echo esc_url(home_url()); ?>/"><?php bloginfo('name'); ?></a>
						<?php if(get_bloginfo('description') != '' && $options_data['check_tagline'] != 1) echo '<h2 class="site-description"><span>'.get_bloginfo('description').'</span></h2>'; ?>
					<?php } ?>
				</div></div>
				<div class="my-td"><div id="navigation">
					<?php get_template_part('framework/headers/main-nav');?>
				</div></div>
			</div>
		</div>
	</div>
</header>