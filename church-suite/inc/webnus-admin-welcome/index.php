<?php
// Add menu
function webnus_admin_page() {
	$webnus_theme = wp_get_theme();
	$theme_name = $webnus_theme->get( 'Name' );
	$page_title = $theme_name.' page';
	$menu_title = $theme_name;
	$capability = 'edit_theme_options';
	$menu_slug  = $theme_name.'-page';
	$function	= 'webnus_welcome';
	add_theme_page($page_title, $menu_title, $capability, sanitize_title_with_dashes( $menu_slug ), $function);	
}
add_action('admin_menu', 'webnus_admin_page');

// Redirect to welcome page
global $pagenow;
if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
	$webnus_theme = wp_get_theme();
	$theme_name = $webnus_theme->get( 'Name' );
	wp_redirect( admin_url( 'themes.php?page=' . sanitize_title_with_dashes( $theme_name ) . '-page' ) );
}

// Content
function webnus_welcome() {
	$webnus_theme = wp_get_theme();
	$theme_version = $webnus_theme->get( 'Version' );
	$theme_name = $webnus_theme->get( 'Name' );
	$mem_limit = ini_get('memory_limit');
	$mem_limit_byte = wp_convert_hr_to_bytes($mem_limit);
	$upload_max_filesize = ini_get('upload_max_filesize');
	$upload_max_filesize_byte = wp_convert_hr_to_bytes($upload_max_filesize);
	$post_max_size = ini_get('post_max_size');
	$post_max_size_byte = wp_convert_hr_to_bytes($post_max_size);
	$mem_limit_byte_boolean = ($mem_limit_byte < 268435456);
	$upload_max_filesize_byte_boolean = ($upload_max_filesize_byte < 67108864);
	$post_max_size_byte_boolean = ($post_max_size_byte < 67108864);
	$execution_time = ini_get('max_execution_time');
	$execution_time_boolean = ($execution_time < 300);
	$input_vars = ini_get('max_input_vars');
	$input_vars_boolean = ($input_vars < 2000);
	$input_time = ini_get('max_input_time');
	$input_time_boolean = ($input_time < 1000);
	$change_log = get_template_directory().'/Change_log.txt';
	$theme_name_lowercase = 'webnus_theme_options';
	$theme_option_address = admin_url("admin.php?page=$theme_name_lowercase");
	
	$keyses = array(
		'a' => array(
			'href' => array(),
			'title' => array(),
			'target' => array(),
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'code' => array(
			'class' => array(),
		),
		'p' => array(
			'class' => array(),
		),
	);

	ob_start();
	?>
	<div id="webnus-dashboard" class="wrap about-wrap">
		<div class="welcome-head w-clearfix">
			<div class="w-row">
				<div class="w-col-sm-10">
					<h1> <?php echo esc_html__('Welcome to','webnus_framework') .' '.$theme_name.'!'; ?> </h1>
					<div class="w-welcome">
						<p><?php echo  $theme_name.' '.esc_html__('is now installed and ready to use! Get ready to build something beautiful.','webnus_framework') ?></p>
					</div>
				</div>
				<div class="w-col-sm-2">
					<img src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>" />
					<span class="w-theme-version"><?php echo esc_html__('Version','webnus_framework'); ?> <?php echo $theme_version; ?></span>
				</div>
			</div>
		</div>
		<div class="welcome-content w-clearfix">
			<div class="w-row">
				<div class="w-col-sm-12">
					<h3> <?php echo esc_html__('To use the theme in best way, we suggest importing the demo first. please read below steps To install Theme and  import Dummy data:','webnus_framework'); ?> </h3>
				</div>
			</div>
			<div class="w-row">
				<div class="w-col-sm-6">
					<div class="w-box plugin">
						<div class="w-box-head">
							<span> 1 </span> <?php echo esc_html__('Install Plugins','webnus_framework'); ?>
						</div>
						<div class="w-box-content">
							<?php
							echo esc_html__('These are plugins we include or offer for design integration with ChurchSuite. Visual Composer, Revolution Slider, The Events Calendar, Webnus Causes, Webnus Sermons, Contact Form 7 and WP PageNavi are required plugins to use ChurchSuite. To install All plugins, click on "Install Plugins" button.' , 'webnus_framework');

							// plugins
							$plugins_arrays = array(
								'Visual Composer'		=> 'js_composer/js_composer.php',
								'Revolution Slider'		=> 'revslider/revslider.php',
								'The Events Calendar'	=> 'the-events-calendar/the-events-calendar.php',
								'Webnus Causes'			=> 'webnus-causes/webnus-causes.php',
								'Webnus Sermons'		=> 'webnus-sermons/webnus-sermons.php',
								'Contact Form 7'		=> 'contact-form-7/wp-contact-form-7.php',
								'WP PageNavi'			=> 'wp-pagenavi/wp-pagenavi.php',
							);

							foreach( $plugins_arrays as $plugin_name => $plugin_address ) :

								if ( ! is_plugin_active( $plugin_address ) ) :
									$status_icon = ' w-icon-red ti-close';
									$status_text = esc_html__( 'Not Active','webnus_framework' );
								else :
									$status_icon = ' w-icon-green ti-check';
									$status_text = esc_html__( 'Active','webnus_framework' );
								endif;

								echo '<div class="w-system-info">
										<span>' . esc_html__( $plugin_name, 'webnus_framework' ) . '</span>
										<i class="w-icon ' . $status_icon . '"></i>
										<span class="w-current">' . $status_text . '</span>
									</div>';

							endforeach; ?>

							<div class="w-button">
								<a href="<?php echo admin_url("themes.php?page=tgmpa-install-plugins") ?>" target="_blank"><?php echo esc_html__('Install Plugins','webnus_framework'); ?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="w-col-sm-6">
					<div class="w-box">
						<div class="w-box-head">
							<span> 2 </span> <?php echo esc_html__('Import Dummy','webnus_framework'); ?>
						</div>
						<div class="w-box-content">
							<?php echo esc_html__('When you install a demo it provides pages, images, theme options, posts, slider, widgets and etc. IMPORTANT: before installing a demo you need to install and activate included plugins. Please check below status to see if your server meets all essential requirements for a successful import.','webnus_framework') ?>
							<div class="w-system-info">
								<span> <?php echo esc_html__('WP Memory Limit','webnus_framework'); ?> </span>
								<?php
								$wp_memory_limit = WP_MEMORY_LIMIT;
								$wp_memory_limit_value = preg_replace("/[^0-9]/", '', $wp_memory_limit);
								if( $wp_memory_limit_value < 256 ){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Currently:','webnus_framework').' '.$wp_memory_limit.' </span>
									<span class="w-min"> '.esc_html__('(min:256M)','webnus_framework').'</span>
									<label class="hero button" for="wp-memory-limit">'.esc_html('How to fix it','webnus_framework').'</label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="wp-memory-limit" />
										<article class="content">
											<header class="header">
												<label class="button" for="wp-memory-limit"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												'.wp_kses( __('<p class="red"> We recommend setting memory to at least 256MB. Please define memory limit in wp-config.php file. you can read below link for more information:</p><a href="https://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank"> Increasing Wp Memory Limit </a>', 'webnus_framework'), $keyses ).'
											</main>
										</article>
										<label class="backdrop" for="wp-memory-limit"></label>
									</aside>
									';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Currently:','webnus_framework').' '.$wp_memory_limit.' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('Upload Max. Filesize','webnus_framework'); ?> </span>
								<?php
								if($upload_max_filesize_byte_boolean){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Currently:','webnus_framework').' '.$upload_max_filesize.' </span>
									<span class="w-min"> '.esc_html__('(min:64M)','webnus_framework').'</span>
									<label class="hero button" for="php-upload-size">'.esc_html('How to fix it','webnus_framework').'</label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="php-upload-size" />
										<article class="content">
											<header class="header">
												<label class="button" for="php-upload-size"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												'.wp_kses( __('<p class="red">It may not work with some shared hosts in which case you would have to ask your hosting service provider for support. </p>
												<strong>1-  Theme Functions File</strong><br>
												There are cases where we have seen that just by adding the following code in the theme function’s file, you can increase the upload size:<br>
												<code class="red">@ini_set( \'upload_max_size\' , \'64M\' );</code><br><br>
												<strong>2- Create or Edit an existing PHP.INI file</strong><br>
												In most cases if you are on a shared host, you will not see a php.ini file in your directory. If you do not see one, then create a file called php.ini and upload it in the root folder. In that file add the following code:<br>
												<code class="red"> upload_max_filesize = 64M </code><br><br>
												<strong>3- htaccess Method</strong><br>
												Some people have tried using the htaccess method where by modifying the .htaccess file in the root directory, you can increase the maximum upload size in WordPress. Open or create the .htaccess file in the root folder and add the following code:<br>
												<code class="red">php_value upload_max_filesize 64M</code><br><br>
												<a href="https://premium.wpmudev.org/blog/increase-memory-limit/?ench=b&utm_expid=3606929-78.ZpdulKKETQ6NTaUGxBaTgQ.1&utm_referrer=https%3A%2F%2Fpremium.wpmudev.org%2Fblog%2F%3Fench%3Db%26s%3Dmemory_limit" target="_blank">Increasing Upload Max. Filesize</a><br>', 'webnus_framework'), $keyses ).'
											</main>
										</article>
										<label class="backdrop" for="php-upload-size"></label>
									</aside>
									';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Currently:','webnus_framework').' '.$upload_max_filesize.' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('Max. Post Size','webnus_framework'); ?> </span>
								<?php
								if($post_max_size_byte_boolean){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Currently:','webnus_framework').' '.$post_max_size.' </span>
									<span class="w-min"> '.esc_html__('(min:64M)','webnus_framework').'</span>
									<label class="hero button" for="php-post-upload-size">'.esc_html('How to fix it','webnus_framework').'</label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="php-post-upload-size" />
										<article class="content">
											<header class="header">
												<label class="button" for="php-post-upload-size"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												'.wp_kses( __('<p class="red">It may not work with some shared hosts in which case you would have to ask your hosting service provider for support. </p>
												<strong>1-  Theme Functions File</strong><br>
												There are cases where we have seen that just by adding the following code in the theme function’s file, you can increase the post upload size:<br>
												<code class="red">@ini_set( \'post_max_size\' , \'64M\' );</code><br><br>
												<strong>2- Create or Edit an existing PHP.INI file</strong><br>
												In most cases if you are on a shared host, you will not see a php.ini file in your directory. If you do not see one, then create a file called php.ini and upload it in the root folder. In that file add the following code:<br>
												<code class="red"> post_max_size = 64M </code><br><br>
												<strong>3- htaccess Method</strong><br>
												Some people have tried using the htaccess method where by modifying the .htaccess file in the root directory, you can increase the maximum post upload size in WordPress. Open or create the .htaccess file in the root folder and add the following code:<br>
												<code class="red">php_value post_max_size 64M</code><br><br>
												<a href="https://premium.wpmudev.org/blog/increase-memory-limit/?ench=b&utm_expid=3606929-78.ZpdulKKETQ6NTaUGxBaTgQ.1&utm_referrer=https%3A%2F%2Fpremium.wpmudev.org%2Fblog%2F%3Fench%3Db%26s%3Dmemory_limit" target="_blank">Increasing Max. Post Size</a><br>
												', 'webnus_framework'), $keyses ).'
											</main>
										</article>
										<label class="backdrop" for="php-post-upload-size"></label>
									</aside>
									';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Currently:','webnus_framework').' '.$post_max_size.' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('Max. Execution Time','webnus_framework'); ?> </span>
								<?php
								if($execution_time_boolean){
									echo '<i class="w-icon w-icon-red ti-close"></i>
									<span class="w-current"> '.esc_html__('Currently:','webnus_framework').' '.$execution_time.' </span>
									<span class="w-min"> '.esc_html__('(min:300)','webnus_framework').'</span>
									<label class="hero button" for="execution-time">'.esc_html('How to fix it','webnus_framework').'</label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="execution-time" />
										<article class="content">
											<header class="header">
												<label class="button" for="execution-time"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												'.wp_kses( __('<p class="red">We recommend setting max execution time to at least 300. you can read below link for more information:</p> <a href="http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded" target="_blank"> Increasing Max. Execution Time </a>', 'webnus_framework'), $keyses ).'
											</main>
										</article>
										<label class="backdrop" for="execution-time"></label>
									</aside>';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Currently:','webnus_framework').' '.$execution_time.' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('PHP Max. Input Vars','webnus_framework'); ?> </span>
								<?php
								if($input_vars_boolean){
									echo '<i class="w-icon w-icon-red ti-close"></i>
									<span class="w-current"> '.esc_html__('Currently:','webnus_framework').' '.$input_vars.' </span>
									<span class="w-min"> '.esc_html__('(min:2000)','webnus_framework').'</span>
									<label class="hero button" for="input-variables">'.esc_html('How to fix it','webnus_framework').'</label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="input-variables" />
										<article class="content">
											<header class="header">
												<label class="button" for="input-variables"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												'.wp_kses( __('<p class="red">We recommend setting max execution time to at least 300. you can read below link for more information:</p> <a href="http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded" target="_blank"> Increasing PHP Max. Input Vars </a>', 'webnus_framework'), $keyses ).'
											</main>
										</article>
										<label class="backdrop" for="input-variables"></label>
									</aside>';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Currently:','webnus_framework').' '.$input_vars.' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('PHP Max. Input Time','webnus_framework'); ?> </span>
								<?php
								if($input_time_boolean){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Currently:','webnus_framework').' '.$input_time.' </span>
									<span class="w-min"> '.esc_html__('(min:1000)','webnus_framework').'</span>
									<label class="hero button" for="php-input-time">'.esc_html('How to fix it','webnus_framework').'</label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="php-input-time" />
										<article class="content">
											<header class="header">
												<label class="button" for="php-input-time"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												'.wp_kses( __('<p class="red">It may not work with some shared hosts in which case you would have to ask your hosting service provider for support. </p>
												<strong>1-  Theme Functions File</strong><br>
												There are cases where we have seen that just by adding the following code in the theme function’s file, you can increase the Max. Input Time:<br>
												<code class="red">@ini_set( \'max_input_time\' , \'1000\' );</code><br><br>
												<strong>2- Create or Edit an existing PHP.INI file</strong><br>
												In most cases if you are on a shared host, you will not see a php.ini file in your directory. If you do not see one, then create a file called php.ini and upload it in the root folder. In that file add the following code:<br>
												<code class="red"> max_input_time = 1000 </code><br><br>
												<strong>3- htaccess Method</strong><br>
												Some people have tried using the htaccess method where by modifying the .htaccess file in the root directory, you can increase the Max. Input Time in WordPress. Open or create the .htaccess file in the root folder and add the following code:<br>
												<code class="red">php_value max_input_time 1000</code><br>', 'webnus_framework'), $keyses ).'
											</main>
										</article>
										<label class="backdrop" for="php-input-time"></label>
									</aside>
									';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Currently:','webnus_framework').' '.$input_time.' </span>';
								}
								?>
							</div>
							<div class="w-button">
								<a href="<?php echo $theme_option_address; ?>" target="_blank"><?php echo esc_html__('Import Dummy','webnus_framework'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="welcome-content w-clearfix extra">
			<div class="w-row">
				<div class="w-col-sm-6">
					<div class="w-box doc">
						<div class="w-box-head">
							<?php echo esc_html__('Documentation','webnus_framework'); ?>
						</div>
						<div class="w-box-content">
							<p>
							<?php echo esc_html__('Our documentation is simple and functional wit full details and cover all essential aspects from beginning to the most advanced parts.' , 'webnus_framework'); ?>
							</p>
							<div class="w-button">
								<a href="http://webnus.biz/documentation/church-suite/" target="_blank"><?php echo esc_html__('DOCUMENTATION','webnus_framework'); ?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="w-col-sm-6">
					<div class="w-box support">
						<div class="w-box-head">
							<?php echo esc_html__('Support Forum','webnus_framework'); ?>
						</div>
						<div class="w-box-content">
							<p>
							<?php echo esc_html__('Webnus is elite and trusted author with high percentage of satisfied user. If you have any issues please don’t hesitate to contact us, we will reply as soon as possible.' , 'webnus_framework'); ?>
							</p>
							<div class="w-button">
								<a href="https://webnus.ticksy.com/" target="_blank"><?php echo esc_html__('OPEN A TICKET','webnus_framework'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="w-update-notices" class="w-row">
				<div class="w-col-sm-12">
					<br><br><br>
					<h3><?php echo esc_html__( 'Updates Notices:', 'webnus_framework' ); ?></h3>
					<div class="w-box change-log">
						<div class="w-box-head">
							<?php echo esc_html__( 'Updating ChurchSuite from earlier versions to version 2', 'webnus_framework' ); ?>
						</div>
						<div class="w-box-content">
							<p><?php esc_html_e( 'In this version we have structural changes and you need to follow below steps to update the theme completely:', 'webnus_framework' ); ?></p>
							<ol>
								<li><?php esc_html_e( 'Typography Options: in this version the structure of these options have changed and you need to set your configuration again. To do that go to appearance > theme options > typography.', 'webnus_framework' ); ?></li>
								<li><?php esc_html_e( 'Colors Options: in this version the structure of these options have changed and you need to set your configuration again. To do that go to appearance > theme options > styling options.', 'webnus_framework' ); ?></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="w-row">
				<div class="w-col-sm-12">
					<div class="w-box change-log">
						<div class="w-box-head">
							<?php echo esc_html__('Changelog (Updates)','webnus_framework'); ?>
						</div>
						<div class="w-box-content">
							<pre><?php echo file_get_contents($change_log); ?></pre>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
$out = ob_get_contents();
ob_end_clean();
echo $out;
}

