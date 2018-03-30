<?php $rentify_option_data = rentify_option_data(); ?>



<?php 

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    if ( is_plugin_active('sitepress-multilingual-cms/sitepress.php') && $rentify_option_data['sb-top-language'] == 1){
    	sb_wpml_languages();

    } else {  ?>


		<?php if(isset($rentify_option_data['sb-top-language']) && $rentify_option_data['sb-top-language'] == 1) : ?>
		<div class="language">
			<?php if(isset($rentify_option_data['sb-language']) && is_array($rentify_option_data['sb-language']) && !empty($rentify_option_data['sb-language'])) : ?>
			<a class = "toggle" href = "" >
				NDL
			</a>

				<ul>
					<?php foreach($rentify_option_data['sb-language'] as $key => $value){ ?>

					<li><a href="#"><?php echo esc_attr($value); ?></a></li>
					
					<?php } ?>
				</ul>

			<?php endif; ?>
		</div>
		<?php endif; ?>

<?php } ?>
<!-- End Header-Language -->