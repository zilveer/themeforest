<div class="sixteen columns">
		<!-- HEADLINE -->
		<div id="headline">				
			<?php $headline_main_caps = get_post_meta($post->ID,'_cmb_headline_main_caps',TRUE); ?>
			<?php $headline_sec_caps = get_post_meta($post->ID,'_cmb_headline_sec_caps',TRUE); ?>
			<?php $headline_para = get_post_meta($post->ID,'_cmb_headline_para',TRUE); ?>
			
			<?php if($headline_main_caps != '' || $headline_sec_caps != '') : ?>
			<hgroup>
				<h1><?php echo $headline_main_caps; ?></h1>
				<h2><?php echo $headline_sec_caps; ?></h2>
			</hgroup>
			<?php endif; ?>
			
			<?php if($headline_para != '') : ?>
			<p><?php echo do_shortcode( $headline_para ); ?></p>
			<?php endif; ?>
		</div>
		<!-- END HEADLINE -->
		<div class="clear"></div>
	</div>