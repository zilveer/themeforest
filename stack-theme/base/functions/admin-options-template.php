<?php
	$message = null;

	// Call by URL with "fn" param
	if( isset( $_REQUEST['import_options'] ) ) {
		$message = import_options();
	}
	if( isset( $_REQUEST['reset_options'] ) ) {
		$message = reset_options();
	}
	if( isset( $_REQUEST['import_content'] ) ) {
		$message =  import_content();
	}

	function import_options() {
		if( $_FILES['import_options_file']['name'] != "" ) {
			$upload_overrides = array( 'test_form' => false );
			$movefile = wp_handle_upload( $_FILES['import_options_file'], $upload_overrides );
			if ( $movefile ) {
				$options = unserialize( base64_decode( file_get_contents($movefile['file']) ) );
				update_option(THEME_SLUG . '_options', $options);
				return __("Admin Options Imported", "theme_admin");
			} else {
			    
			}
		}
	}

	function reset_options() {
		delete_option( THEME_SLUG . '_options' );
	}

	function import_content() {
		if ( !class_exists("WP_Import") ) {
			if ( !defined("WP_LOAD_IMPORTERS") ) define("WP_LOAD_IMPORTERS", true);
			require_once( THEME_FRAMEWORK_DIR . '/libs/wordpress-importer/wordpress-importer.php' );
			require_once( THEME_FUNCTIONS_DIR . '/base-importer.php' );
		}
		$demo_file = THEME_CUSTOM_DIR . '/demo/demo.xml';
		
		$importer = new Base_Importer();
		
		ob_start();
		$importer->import( $demo_file );
		$import_message = ob_get_contents();
		ob_end_clean();
		return __("Demo Content Imported", "theme_admin");
	}

?>

<div id="theme-box-wrap">

	<?php if( $message ): ?>
		<div class="theme-box-message"><?php echo $message; ?></div>
	<?php endif; ?>

	<form id="theme-options-form" enctype="multipart/form-data" method="post">

	<div id="theme-box" class="wrap">
		
		<div id="theme-box-head">
			<div id="icon-options-general" class="icon32"></div>
			<h2><?php _e('Theme Options', 'theme_admin'); ?></h2>
		</div>
		
		<div id="theme-box-body" class="clearfix">
		
			<div id="theme-box-tabs">
				<ul>
					<?php 
					$counter = 0;
					foreach( $sections as $section_slug => $section ): ?>
						<li class="<?php echo ($counter++ == 0) ? 'active' : ''; ?>"><a href="#<?php echo $section_slug; ?>"><i class="icon icon-<?php echo $section['icon']; ?>"></i> <?php echo $section['name']; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			
			<div id="theme-box-content">
			
				<?php
					foreach( $sections as $section_slug => $section ){
						$section = include_once( THEME_OPTIONS_DIR.'/' . $section_slug . '.php' );
						$input_tool = new input_tool( $section['options'], $section['config'] );
						$input_tool->generate_theme_option();
					}
				?>
				
			</div>
		
		</div>
		
		
		<div id="theme-box-foot">		
			<input type="button" name="reset" value="<?php echo __('Reset Options', 'theme_admin'); ?>" class="button first-click" id="theme-options-reset" />
			<input type="submit" name="reset_options" value="<?php echo __('Confirm Reset Options', 'theme_admin'); ?>" class="button second-click" id="theme-options-reset-confirm" />
			<input type="button" name="save" value="<?php echo __('Save Options', 'theme_admin'); ?>" class="button-primary" id="theme-options-save" />
		</div>
		
		<div class="notification-box notification-ok">
			<?php _e('options saved', 'theme_admin'); ?>
		</div>
		
	</div>
	</form>

</div> <!-- #theme-box-wrap -->


<?php if( theme_options('advance', 'show_debug') == 'on' ): ?>
	<section id="debug-section">
		<textarea rows="20" cols="50"><?php var_dump(theme_options()); ?></textarea>
	</section>
<?php endif; ?>

<?php 
	// Autosave
	if( isset( $_GET['save'] ) ) : ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#theme-options-save').trigger('click');
		});	
	</script>
<?php endif; ?>