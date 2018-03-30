<?php 
require_once('form-inputs.php');
wp_nonce_field( 'theme-post-meta-form', THEME_NAME_SEO . '_post_nonce' );
?>

<div id="px-container" class="post-meta">
	<div id="px-main">

		<div class="config sidebar-config">
			<!-- Sidebar section -->
			<div class="section">
				<div class="section-head">
					<div class="section-tooltip"><?php _e('Select a custom sidebar for your page that is defined in theme\'s option panel. You could use default page sidebar as well.', TEXTDOMAIN); ?></div>
					<div class="label"><?php _e('Sidebar', TEXTDOMAIN); ?></div>
				</div>

				<?php 
				$sidebars = array('' => 'Default Sidebar');
				if(opt('custom_sidebars') != '')
				{
					$arr = explode(',', opt('custom_sidebars'));
					
					foreach($arr as $bar)
						$sidebars[$bar] = str_replace('%666', ',', $bar);
				}
				
				SelectTag("sidebar", $sidebars); ?>
			</div>
		</div>
	</div>
</div>