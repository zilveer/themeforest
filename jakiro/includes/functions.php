<?php
function dh_placeholder_img_src() {
	return apply_filters( 'dh_placeholder_img_src', get_template_directory_uri() . '/assets/images/placeholder.png' );
}

function dh_do_not_reply_address(){
	$sitename = strtolower( $_SERVER['SERVER_NAME'] );
	if ( substr( $sitename, 0, 4 ) === 'www.' ) {
		$sitename = substr( $sitename, 4 );
	}
	return apply_filters( 'dh_do_not_reply_address', 'noreply@' . $sitename );
}

function dh_instagram($username,$images_number=12,$refresh_hour){
	return null;
}

function dh_print_string($string=''){
	$allowedtags = array(
		'div'=>array(
			'class'=>array(),
		),
		'a' => array(
			'href' => array(),
			'target' => array(),
			'title' => array(),
			'rel' => array(),
		),
		'img' => array(
			'src' => array()
		),
		'h1' => array(),
		'h2' => array(),
		'h3' => array(),
		'h4' => array(),
		'h5' => array(),
		'p' => array(),
		'br' => array(),
		'hr' => array(),
		'span' => array(
			'class'=>array()
		),
		'em' => array(),
		'strong' => array(),
		'small' => array(),
		'b' => array(),
		'i' => array(
			'class'=>array()
		),
		'u' => array(),
		'ul' => array(),
		'ol' => array(),
		'li' => array(),
		'blockquote' => array(),
	);
	$allowedtags = apply_filters('dh_print_string_allowed_tags', $allowedtags);
	//$string = wp_kses($string, $allowedtags);
	return $string;
}

function dh_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	if ( $args && is_array( $args ) ) {
		extract( $args );
	}
	// Look within passed path within the theme - this is priority
	$located = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);
	if ( ! file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '2.1' );
		return;
	}
	$located = apply_filters( 'dh_get_template', $located, $template_name, $args, $template_path, $default_path );

	do_action( 'dh_before_get_template', $template_name, $template_path, $located, $args );
	include( $located );
	do_action( 'dh_after_get_template', $template_name, $template_path, $located, $args );
}

function dh_visibility_class($visibility = ''){
	$class='';
	switch ($visibility) {
		case 'hidden-phone':
			$class = ' hidden-xs';
			break;
		case 'hidden-tablet':
			$class = ' hidden-sm hidden-md';
			break;
		case 'hidden-pc':
			$class = ' hidden-lg';
			break;
		case 'visible-phone':
			$class = ' visible-xs-inline-block';
			break;
		case 'visible-tablet':
			$class = ' visible-sm-inline-block visible-md-inline-block visible-lg-inline-block';
			break;
		case 'visible-pc':
			$class = ' visible-lg-inline-block';
			break;
		default:
			break;
	}
	return apply_filters('dh-visibility-class', $class);
}

function dh_get_youtube_id($videoUrl) {
	$query_string = array();
	parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query_string);

	if (empty($query_string["v"])) {
		//explode at ? mark
		$yt_short_link_parts_explode1 = explode('?', $videoUrl);

		//short link: http://youtu.be/AgFeZr5ptV8
		$yt_short_link_parts = explode('/', $yt_short_link_parts_explode1[0]);
		if (!empty($yt_short_link_parts[3])) {
			return $yt_short_link_parts[3];
		}

		return $yt_short_link_parts[0];
	} else {
		return $query_string["v"];
	}
}

function dh_get_youtube_time($videoUrl) {
	$query_string = array();
	parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query_string);
	if (!empty($query_string["t"])) {

		if (strpos($query_string["t"], 'm')) {
			//take minutes
			$explode_for_minutes = explode('m', $query_string["t"]);
			$minutes = trim($explode_for_minutes[0]);

			//take seconds
			$explode_for_seconds = explode('s', $explode_for_minutes[1]);
			$seconds = trim($explode_for_seconds[0]);

			$startTime = ($minutes * 60) + $seconds;
		} else {
			//take seconds
			$explode_for_seconds = explode('s', $query_string["t"]);
			$seconds = trim($explode_for_seconds[0]);

			$startTime = $seconds;
		}

		return '&start=' . $startTime;
	} else {
		return '';
	}
}

function dh_get_vimeo_id($videoUrl) {
	$pattern = '/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/';
	preg_match($pattern, $videoUrl, $matches);
	if (count($matches))
	{
		return end($matches);
	}
}

function dh_get_dailymotion_id($videoUrl) {
	$id = strtok(basename($videoUrl), '_');
	if (strpos($id,'#video=') !== false) {
		$videoParts = explode('#video=', $id);
		if (!empty($videoParts[1])) {
			return $videoParts[1];
		}
	} else {
		return $id;
	}

}

function dh_detect_video($videoUrl) {
	$videoUrl = strtolower($videoUrl);
	if (strpos($videoUrl,'youtube.com') !== false or strpos($videoUrl,'youtu.be') !== false) {
		return 'youtube';
	}
	if (strpos($videoUrl,'dailymotion.com') !== false) {
		return 'dailymotion';
	}
	if (strpos($videoUrl,'vimeo.com') !== false) {
		return 'vimeo';
	}

	return false;
}

function dh_is404($url) {
	$headers = get_headers($url);
	if (strpos($headers[0],'404') !== false) {
		return true;
	} else {
		return false;
	}
}

function dh_get_video_thumb_url($videoUrl) {
	return '';
}

function dh_is_video_support($videoUrl) {
	if (dh_detect_video($videoUrl) !== false) {
		return true;
	}
	return false;
}

function dh_setcookie( $name, $value, $expire = 0 ) {
	$secure = 'https' === parse_url( site_url(), PHP_URL_SCHEME );
	if ( ! headers_sent() ) {
		setcookie( $name, $value, $expire, COOKIEPATH, COOKIE_DOMAIN, $secure );
	} elseif ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		headers_sent( $file, $line );
		trigger_error( "{$name} cookie cannot be set - headers already sent by {$file} on line {$line}", E_USER_NOTICE );
	}
}

function dh_get_theme_option_name(){
	$lang = '';
	$theme_name = 'dh_theme_'.basename(get_template_directory());
	$theme_name = apply_filters('dh_get_theme_option_name', $theme_name);
	return $theme_name;
}

function dh_get_theme_option($option,$default = null){
	global $dh_theme_options;
	if(empty($option))
		return $default;

	
	$_option_name = dh_get_theme_option_name();
	
	if ( empty( $dh_theme_options ) ) {
		$dh_theme_options = get_option($_option_name);
	}
	
	if(is_page() || (defined('WOOCOMMERCE_VERSION') && is_woocommerce())){
		if($option == 'header-style'){
			$page_value = dh_get_post_meta('header_style');
			if( $page_value !== null && $page_value !== array() && $page_value !== false && $page_value != '-1'){
				return apply_filters('dh_get_theme_option', $page_value, $option);
			}
		}
		if($option == 'show-topbar'){
			$page_value = dh_get_post_meta('show_topbar');
			if($page_value !== null && $page_value !== array() && $page_value !== false && $page_value != '-1'){
				return apply_filters('dh_get_theme_option', $page_value, $option);
			}
		}
		if($option == 'menu-transparent'){
			$page_value = dh_get_post_meta('menu_transparent');
			if($page_value !== null && $page_value !== array() && $page_value !== false &&  $page_value != '-1'){
				return apply_filters('dh_get_theme_option', $page_value, $option);
			}
		}
		if($option == 'footer-area'){
			$page_value = dh_get_post_meta('footer_area');
			if($page_value !== null && $page_value !== array() && $page_value !== false &&  $page_value != '-1'){
				return apply_filters('dh_get_theme_option', $page_value, $option);
			}
		}
		if($option == 'footer-menu'){ 
			$page_value = dh_get_post_meta('footer_menu');
			if($page_value !== null && $page_value !== array() && $page_value !== false &&  $page_value != '-1'){
				return apply_filters('dh_get_theme_option', $page_value, $option);
			}
		}
	}
	if(isset($dh_theme_options[$option]) && $dh_theme_options[$option] !== '' && $dh_theme_options[$option] !== null && $dh_theme_options[$option] !== array() && $dh_theme_options[$option] !== false){
		$value = $dh_theme_options[$option];	
		return apply_filters('dh_get_theme_option', $value, $option);
	}else{
		return $default;
	}
}

function dh_get_main_class($body = false,$get_layout = false){

	$class = dh_get_main_col_class('',$body);
	
	if (is_home() || is_front_page()){
		$layout =  dh_get_theme_option('blog-layout','right-sidebar');
		$class = dh_get_main_col_class($layout,$body);
	}elseif (is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio_category' ) ){
		$layout =  dh_get_theme_option('portfolio-main-layout','full-width');
		$class = dh_get_main_col_class($layout,$body);
	}elseif (is_archive() || is_search()) {
		$layout = dh_get_theme_option('archive-layout', 'full-width');
		$class = dh_get_main_col_class($layout,$body);
	}elseif (is_singular('portfolio')){
		$layout = dh_get_theme_option('portfolio-single-layout', 'full-width');
		$class = dh_get_main_col_class($layout,$body);
	}elseif (is_single()){
		$layout = dh_get_theme_option('single-layout', 'right-sidebar');
		$class  =  dh_get_main_col_class($layout,$body);
	}else{
		$layout =  dh_get_theme_option('main-layout','right-sidebar');
		$class = dh_get_main_col_class($layout,$body);
	}
	
	if(defined('WOOCOMMERCE_VERSION')){
		if(is_shop())
		{
			remove_action('dh_left_sidebar','dh_get_sidebar');
			remove_action('dh_left_sidebar_extra','dh_get_extra_sidebar');
			remove_action('dh_right_sidebar','dh_get_sidebar');
			remove_action('dh_right_sidebar_extra','dh_get_extra_sidebar');
			$layout = dh_get_theme_option('woo-shop-layout','full-width');
			$class = dh_get_main_col_class($layout,$body,11);
		}
		elseif (is_product_category() || is_product_tag() || is_product_taxonomy())
		{
			remove_action('dh_left_sidebar','dh_get_sidebar');
			remove_action('dh_left_sidebar_extra','dh_get_extra_sidebar');
			remove_action('dh_right_sidebar','dh_get_sidebar');
			remove_action('dh_right_sidebar_extra','dh_get_extra_sidebar');
			$layout = dh_get_theme_option('woo-category-layout','right-sidebar');
			$class = dh_get_main_col_class($layout,$body,11);
		}
		elseif (is_product())
		{
			remove_action('dh_left_sidebar','dh_get_sidebar');
			remove_action('dh_left_sidebar_extra','dh_get_extra_sidebar');
			remove_action('dh_right_sidebar','dh_get_sidebar');
			remove_action('dh_right_sidebar_extra','dh_get_extra_sidebar');
			$layout =  dh_get_theme_option('woo-product-layout','full-width');
			$class = dh_get_main_col_class($layout,$body,11);
		}
		
	}
	
	if($get_layout)
		return $layout;
	
	if($body)
		return $class;
	
	$class .=' main-wrap';
	$class =  apply_filters('dh_get_main_class',$class);
	return esc_attr($class);
}

function dh_get_sidebar(){
	get_sidebar();
}

function dh_get_extra_sidebar(){
	get_sidebar('extra');
}

function dh_get_main_col_class($layout='',$body = false,$priority = 10){
	$col_class = 'col-md-12';
	if(empty($col_class))
		return $col_class;
	if(!$body){
		if($layout == 'full-width'){
			$col_class = 'col-md-12';
		}elseif ($layout == 'left-sidebar'){
			$col_class = 'col-md-9';
			//add_action('dh_left_sidebar','dh_get_sidebar',$priority);
			add_action('dh_right_sidebar','dh_get_sidebar',$priority);
		}elseif ($layout == 'right-sidebar'){
			$col_class = 'col-md-9';
			add_action('dh_right_sidebar','dh_get_sidebar',$priority);
		}
	}
	if($body){
		if(empty($layout))
			$layout = 'fullwidth';
		
		return 'page-layout-'.$layout;
	}
	return $col_class;
}

function dh_container_class(){
	$main_layout = dh_get_theme_option('site-layout','wide');
	$container_class = 'container'; 
	if($main_layout == 'wide'){
		$wide_container = dh_get_theme_option('wide-container','fixedwidth');
		if($wide_container == 'fullwidth'):
			if((is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio_category' )) && (dh_get_theme_option('portfolio-gap',1) != '1'))
				$container_class = 'container-full';
			else
				$container_class = 'container-fluid';
		endif;
	}
	$container_class = apply_filters('dh_container_class', $container_class);
	echo esc_attr($container_class);
}

function dh_social($use = array(),$hover = true,$soild_bg=false,$outlined=false){
	$socials = apply_filters('dh_social',array(
		'facebook'=>array(
				'label'=>esc_html__('Facebook','sitesao'),
				'url'=>dh_get_theme_option('facebook-url')
		),
		'twitter'=>array(
				'label'=>esc_html__('Twitter','sitesao'),
				'url'=>dh_get_theme_option('twitter-url')
		),
		'google-plus'=>array(
				'label'=>esc_html__('Google+','sitesao'),
				'url'=>dh_get_theme_option('google-plus-url')
		),
		'pinterest'=>array(
				'label'=>esc_html__('Pinterest','sitesao'),
				'url'=>dh_get_theme_option('pinterest-url')
		),
		'linkedin'=>array(
				'label'=>esc_html__('LinkedIn','sitesao'),
				'url'=>dh_get_theme_option('linkedin-url')
		),
		'rss'=>array(
				'label'=>esc_html__('RSS','sitesao'),
				'url'=>dh_get_theme_option('rss-url')
		),
		'instagram'=>array(
				'label'=>esc_html__('Instagram','sitesao'),
				'url'=>dh_get_theme_option('instagram-url')
		),
		'github'=>array(
				'label'=>esc_html__('GitHub','sitesao'),
				'url'=>dh_get_theme_option('github-url')
		),
		'behance'=>array(
				'label'=>esc_html__('Behance','sitesao'),
				'url'=>dh_get_theme_option('behance-url')
		),
		'stack-exchange'=>array(
				'label'=>esc_html__('StackExchange','sitesao'),
				'url'=>dh_get_theme_option('stack-exchange-url')
		),
		'tumblr'=>array(
				'label'=>esc_html__('Tumblr','sitesao'),
				'url'=>dh_get_theme_option('tumblr-url')
		),
		'soundcloud'=>array(
				'label'=>esc_html__('SoundCloud','sitesao'),
				'url'=>dh_get_theme_option('soundcloud-url')
		),
		'dribbble'=>array(
				'label'=>esc_html__('Dribbble','sitesao'),
				'url'=>dh_get_theme_option('dribbble-url')
		),
				
	));
	foreach ((array)$socials  as $social=>$data):
		if(in_array($social, $use)):
			if(empty($data['url']))
				$data['url'] = '#';
			echo '<a href="'.esc_url($data['url']).'" title="'.esc_attr($data['label']).'" target="_blank"><i class="fa fa-'.$social.' '.($hover ? $social.'-bg-hover':'').' '.($soild_bg ? $social.'-bg':'').' '.($outlined ? $social.'-outlined':'').'"></i></a>';
		endif;
	endforeach;
	return ;
}

function dh_enqueue_google_font(){
	//$protocol = is_ssl() ? 'https' : 'http';
	$typography_arr = array('body-typography','navbar-typography','h1-typography','h2-typography','h3-typography','h4-typography','h5-typography','h6-typography');
	$google_fonts = array();
	foreach ($typography_arr as $font){
		$typography = dh_get_theme_option($font);
		if(!empty($typography['font-family'])){
			$font_family = str_replace(" ", "+", $typography['font-family']);
			$font_style = array('400');
			if(!empty($typography['font-style'])){
				$font_style[] = $typography['font-style'];
			}
			$subset = array('latin');
			if(!empty($typography['subset'])  && $typography['subset'] !=="latin"){
				$subset[] = $typography['subset'];
			}
			$google_fonts[$font_family] = array('style'=>$font_style,'subset'=>$subset);
		}
	}
	if(!empty($google_fonts)){
		foreach ($google_fonts as $font=>$google_font){
			wp_enqueue_style( 'dh-'.sanitize_title($font), "http://fonts.googleapis.com/css?family=$font_family:".implode(',', $google_font['style'])."&subset=".implode(',', $google_font['subset']),false);
		}
	}
}

function dh_get_protocol(){
	return  is_ssl() ? 'https' : 'http';
}

function dh_share($title='',$facebook = true,$twitter = true,$google = true,$pinterest = true,$linkedin = true,$outlined=false){
	?>
	<div class="share-links">
		<?php if(!empty($title)):?>
		<h4><?php echo esc_html($title)?></h4>
		<?php endif;?>
		<div class="share-icons">
			<?php if($facebook):?>
			<span class="facebook-share">
				<a href="<?php echo esc_url('http://www.facebook.com/sharer.php?u='.get_the_permalink()) ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;" title="<?php echo esc_html__('Share on Facebook','sitesao')?>"><i class="fa fa-facebook<?php echo ($outlined ? ' facebook-outlined':'')?>"></i></a>
			</span>
			<?php endif;?>
			<?php if($twitter):?>
			<span  class="twitter-share">
				<a href="<?php echo esc_url('https://twitter.com/share?url='.get_the_permalink()) ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;" title="<?php echo esc_html__('Share on Twitter','sitesao')?>"><i class="fa fa-twitter<?php echo ($outlined ? ' twitter-outlined':'')?>"></i></a>
			</span>
			<?php endif;?>
			<?php if($google):?>
			<span class="google-plus-share">
				<a href="<?php echo esc_url('https://plus.google.com/share?url='.get_the_permalink()) ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="<?php echo esc_html__('Share on Google +','sitesao')?>"><i class="fa fa-google-plus<?php echo ($outlined ? ' google-plus-outlined':'')?>"></i></a>
			</span>
			<?php endif;?>
			<?php if($pinterest):?>
			<span class="pinterest-share">
				<a href="<?php echo esc_url('http://pinterest.com/pin/create/button/?url='.get_the_permalink().'&media='.(function_exists('the_post_thumbnail') ? wp_get_attachment_url(get_post_thumbnail_id()):'').'&description='.get_the_title()) ?>" title="<?php echo esc_html__('Share on Pinterest','sitesao')?>"><i class="fa fa-pinterest<?php echo ($outlined ? ' pinterest-outlined':'')?>"></i></a>
			</span>
			<?php endif;?>
			<?php if($linkedin):?>
			<span class="linkedin-share">
				<a href="<?php echo esc_url('http://www.linkedin.com/shareArticle?mini=true&url='.get_the_permalink().'&title='.get_the_title())?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="<?php echo esc_html__('Share on Linked In','sitesao')?>"><i class="fa fa-linkedin<?php echo ($outlined ? ' linkedin-outlined':'')?>"></i></a>
			</span>
			<?php endif;?>
		</div>
	</div>
<?php
}

function dh_get_post_meta($meta = '',$post_id='',$default=null){
	$post_id = empty($post_id) ? get_the_ID() : $post_id;
	if(defined('WOOCOMMERCE_VERSION')){
		if(is_shop() || is_search() && is_post_type_archive( 'product' ) )
			$post_id = wc_get_page_id( 'shop' );
		elseif (is_cart())
			$post_id = wc_get_page_id( 'cart' );
		elseif (is_checkout())
			$post_id = wc_get_page_id( 'checkout' );
		elseif (is_account_page())
			$post_id = wc_get_page_id( 'myaccount' );
		elseif (is_order_received_page())
			$post_id = wc_get_page_id( 'checkout' );
		elseif (is_add_payment_method_page())
			$post_id = wc_get_page_id( 'myaccount' );	
	}
	if(is_search() && !is_post_type_archive( 'product' )){
		$post_id = 0;
	}
	if(empty($meta))
		return false;
	$value = get_post_meta($post_id,'_dh_'.$meta, true);
	if($value !== '' && $value !== null && $value !== array() && $value !== false)
		return apply_filters('dh_get_post_meta', $value, $meta, $post_id);
	return $default;
}

function dh_highlighted_post($cats = null,$cats_extra=null,$post_type='post'){
	/**
	 * script
	 * {{
	 */
	wp_enqueue_script('vendor-carouFredSel');
	$args = array(
		'meta_key' => '_dh_featured',
		'meta_value' => '1', 
		'posts_per_page' => 5,
		'post_type'=>$post_type,
		'ignore_sticky_posts' => 1,
		'orderby' => 'date',
		'order' => 'DESC',
	);
	if(!empty($cats)):
		$args['cat'] = $cats;
	endif;
	$extra = '';
	$r = new WP_Query($args);
	if($r->have_posts()):
	?>
	<div class="highlighted">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-8">
					<div class="caroufredsel" data-infinite="1" data-height="variable" data-responsive="1" data-speed="7000" data-autoplay="1" data-scroll-fx="crossfade" data-visible="1">
						<div class="caroufredsel-wrap">
							<ul class="caroufredsel-items">
							<?php while ($r->have_posts()):$r->the_post(); global $post;?>
								<?php if(!has_post_thumbnail()) continue;?>
								<li class="caroufredsel-item">
									<?php 
									$post_format = get_post_format();
									$post_format_icon='';
									if($post_format == 'video')
										$post_format_icon = '<i class="highlighted-format-icon format-video"></i>';
									elseif ($post_format == 'gallery')
										$post_format_icon = '<i class="highlighted-format-icon format-gallery"></i>';
									echo dh_print_string($post_format_icon);
									?>
									<a href="<?php the_permalink();?>">
										<?php the_post_thumbnail('dh-thumbnail')?>
									</a>
									<div class="highlighted-caption">
										<time datetime="<?php echo get_the_date('Y-m-d\TH:i:sP')?>"><?php echo get_the_date('M j, Y') ?></time>
										<h3>
											<a href="<?php the_permalink()?>"><?php the_title()?></a>
										</h3>
									</div>
								</li>
							<?php endwhile;?>
							</ul>
							<a class="caroufredsel-prev" href="#" style="display: block;"></a>
							<a class="caroufredsel-next" href="#" style="display: block;"></a>
						</div>
						<div class="caroufredsel-pagination"></div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<?php if(!empty($cats_extra)):?>
						<?php 
						wp_reset_postdata();
						if(!empty($cats_extra))
							$args['cat'] = $cats_extra;
						
						$args['posts_per_page'] = 3;
						?>
						<?php 
						$e_r = new WP_Query($args);
						if($e_r->have_posts()):
						?>
						<div class="highlighted-extra">
							<?php $i=0;?>
							<?php while ($e_r->have_posts()):$e_r->the_post();global $post;?>
								<?php if(!has_post_thumbnail()) continue;?>
							<article class="highlighted-extra-item<?php echo(($i==0)?' large':' small') ?>">
								<div class="highlighted-extra-item-wrap">
									<?php 
									$post_format_icon='';
									$post_format = get_post_format();
									if($post_format == 'video')
										$post_format_icon = '<i class="highlighted-format-icon format-video"></i>';
									elseif ($post_format == 'gallery')
										$post_format_icon = '<i class="highlighted-format-icon format-gallery"></i>';
									echo dh_print_string($post_format_icon);
									?>
									<a href="<?php the_permalink();?>">
										<?php the_post_thumbnail('dh-thumbnail')?>
									</a>
									<div class="highlighted-caption">
										<time datetime="<?php echo get_the_date('Y-m-d\TH:i:sP') ?>"><?php echo get_the_date('M j, Y') ?></time>
										<h3>
											<a href="<?php the_permalink()?>"><?php the_title()?></a>
										</h3>
									</div>
								</div>
							</article>
							<?php $i++?>
							<?php endwhile;?>
						</div>
						<?php 
						endif;
						wp_reset_postdata();
						?>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
	<?php
	endif;
	wp_reset_postdata();
}

function dh_related_post(){
	global $post;
	$categories = get_the_category($post->ID);
	
	if (!$categories) {
		return;
	}
	
	$args = array(
		'posts_per_page' => 3,
		'post__not_in' => array($post->ID),
		'orderby' => 'rand', //random posts
		'meta_key' => "_thumbnail_id",
        'category__in' => wp_get_post_categories($post->ID)
	);

	$related = new WP_Query($args);
?>
<?php if($related->have_posts()): ?>
<div class="related-post">
	<div class="related-post-title">
		<h3><span><?php echo esc_html__("Related News",'sitesao')?></span></h3>
	</div>
	<div class="row related-post-items">
		<?php while ($related->have_posts()): $related->the_post();global $post;?>
			<div class="related-post-item col-md-4 col-sm-6">
				<?php dh_post_featured('','',false,true);?>
				<h4 class="post-title" data-itemprop="name"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
				<div class="entry-meta icon-meta">
				<?php dh_post_meta(true,true,false,false,true,' ',null,true)?>
				</div>
				<div class="excerpt">
				<?php 
					$excerpt = $post->post_excerpt;
					if(empty($excerpt))
						$excerpt = $post->post_content;
						
					$excerpt = strip_shortcodes($excerpt);
					$excerpt = wp_trim_words($excerpt,15,'...');
					echo  '<p>' . $excerpt . '</p>';
				?>
				</div>
				<div class="readmore-link">
					<a href="<?php the_permalink()?>"><?php esc_html_e("Read More", 'sitesao');?></a>
				</div>
			</div>
		<?php endwhile;?>
	</div>
</div>
	<?php endif;?>
<?php
	
	wp_reset_postdata();
}

function dh_list_comments($comment, $args, $depth) {
	global $post;
	$avatar_size = isset($args['avatar_size']) ? $args['avatar_size'] : 60;
	?>
		<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-wrap">
				<div class="comment-img">
					<?php echo get_avatar($comment, $avatar_size); ?>
				</div>
				<article id="comment-<?php comment_ID(); ?>" class="comment-block">
					<header class="comment-header">
						<div class="comment-info">
							<span class="comment-author">
								<?php echo get_comment_author_link(); ?>
							</span>
							<?php if ($comment->user_id === $post->post_author): ?>
							<span class="ispostauthor">
								<?php esc_html_e('Author', 'sitesao'); ?>
							</span>
							<?php endif; ?>
							<span class="comment-meta">
								<time datetime="<?php echo get_comment_time('c'); ?>">
									<?php echo sprintf(esc_html__('%1$s at %2$s', 'sitesao') , get_comment_date() , get_comment_time()); ?>
								</time>
								<span class="comment-edit">
									<?php edit_comment_link('' . esc_html__('Edit', 'sitesao')); ?>
								</span>
							</span>
						</div>
						<?php if ('0' == $comment->comment_approved): ?>
							<p class="comment-pending"><?php esc_html_e('Your comment is awaiting moderation.', 'sitesao'); ?></p>
						<?php endif; ?>
					</header>
					<section class="comment-content">
						<?php comment_text(); ?>
					</section>
					<div class="comment-reply-link-wrap">
						<?php comment_reply_link(array_merge($args, array(
							'reply_text' => (esc_html__('Reply', 'sitesao') . '') ,
							'depth' => $depth,
							'max_depth' => $args['max_depth']
						))); ?>
					</div>
				</article>
			</div>
		<?php
}

function dh_get_search_form($ajax=true){
	$search_form = '<form method="GET" class="searchform search-ajax" action="'.esc_url( home_url( '/' ) ).'" role="form">
					<input type="search" class="searchinput" name="s" autocomplete="off" value="" placeholder="'.esc_html__( 'Search...', 'sitesao' ).'" />
					<input type="submit" class="searchsubmit hidden" name="submit" value="'.esc_html__( 'Search', 'sitesao' ).'" />
					<input type="hidden" name="post_type" value="'.apply_filters('dh_ajax_search_form_post_type', 'product').'" />
				</form>';
	if($ajax)
		$search_form .='<div class="searchform-result"></div>';
	return $search_form;
}

function dh_comment_form( $args = array(), $post_id = null ) {
	global $id;
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	if ( null === $post_id ) {
		$post_id = $id;
	}
	else {
		$id = $post_id;
	}

	if ( comments_open( $post_id ) ) :
	?>
	<div id="respond-wrap">
		<?php 
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
			$fields =  array(
				'author' => '<div class="row"><p class="comment-form-author col-sm-4">' .'<input placeholder="'.esc_html__('Name *','sitesao').'" id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
				'email' => '<p class="comment-form-email col-sm-4">'.'<input id="email" placeholder="'.esc_html__('Email *','sitesao').'" name="email" type="text" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
				'url' => '<p class="comment-form-url col-sm-4"><input id="url"  placeholder="'.esc_html__('Website','sitesao').'"  name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div>'
			);
			$comments_args = array(
					'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
					'logged_in_as'		   => '<p class="logged-in-as">' . sprintf( __ ( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'sitesao' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
					'title_reply'          => sprintf('<span>%s</span>',esc_html__( 'Leave a reply', 'sitesao' )),
					'title_reply_to'       => sprintf('<span>%s</span>',esc_html__( 'Leave a reply to %s', 'sitesao' )),
					'cancel_reply_link'    => esc_html__( 'Click here to cancel the reply', 'sitesao' ),
					'label_submit'         => esc_html__( 'Submit', 'sitesao' ),
					'comment_field'		   => '<p class="comment-form-comment"><textarea placeholder="'.esc_html__('Comment','sitesao').'"  class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
					'must_log_in'		   => '<p class="must-log-in">' .  sprintf( __ ( 'You must be <a href="%s">logged in</a> to post a comment.', 'sitesao' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			);

		comment_form($comments_args); 
		?>
	</div>

	<?php
	endif;
}

function dh_nth_word($text, $nth = 1, $echo = true,$is_typed = false,$typed_color = ''){
	$text = strip_shortcodes($text);
	$text = wp_strip_all_tags( $text );
	if ( 'characters' == _x( 'words', 'word count: words or characters?','sitesao') && preg_match( '/^utf\-?8$/i', get_option( 'blog_charset' ) ) ) {
		$text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $text ), ' ' );
		preg_match_all( '/./u', $text, $words_array );
		$sep = '';
	} else {
		$words_array = preg_split( "/[\n\r\t ]+/", $text, null, PREG_SPLIT_NO_EMPTY );
		$sep = ' ';
	}
	$nth_class=$nth;
	if($nth == 'last')
		$nth = count($words_array) - 1;
	if($nth == 'first')
		$nth = 0;
	
	if(isset($words_array[$nth]) && !$is_typed){
		$words_array[$nth] = '<span class="nth-word-'.$nth_class.'">'.$words_array[$nth].'</span>';
	}
	if($is_typed){
		$string =  $words_array[$nth];
		$words_array[$nth] = '<span'.(!empty($typed_color) ? ' style="color:'.$typed_color.'" ' :'').'><span class="nth-typed"></span></span>';
		return array(implode($sep, $words_array),$string);
	}
	if($echo)
		echo implode($sep, $words_array);
	else 
		return implode($sep, $words_array);
}

function dh_trim_characters($string, $count=50, $ellipsis = FALSE)
{
	$trimstring = substr($string,0,$count);
	if (strlen($string) > $count) {
		if (is_string($ellipsis)){
			$trimstring .= $ellipsis;
		}
		elseif ($ellipsis){
			$trimstring .= '&hellip;';
		}
	}
	return $trimstring;
}


function dh_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="post-navigation" role="navigation">
		<div class="row">
			<?php $prev_link = get_previous_post_link( '%link', _x( '%title', 'Previous post link', 'sitesao' ) ); ?>
			<div class="col-sm-6">
			<?php if($prev_link):?>
				<div class="prev-post">
					<span>
					<?php echo esc_html__('Previous article','sitesao')?>
					</span>
					<?php echo dh_print_string($prev_link)?>
				</div>
			<?php endif;?>
			</div>
			<?php $next_link = get_next_post_link( '%link', _x( '%title', 'Next post link', 'sitesao' ) ); ?>
			<div class="col-sm-6">
			<?php if(!empty($next_link)):?>
				<div class="next-post">
					<span>
						<?php echo esc_html__('Next article','sitesao')?>
					</span>
					<?php echo dh_print_string($next_link)?>
				</div>
			<?php endif;?>
			</div>
		</div>
	</nav>
	<?php
}

function dh_the_breadcrumb(){
	if( ( defined('WOOCOMMERCE_VERSION') && is_woocommerce() ) || ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) ) {
		woocommerce_breadcrumb(array(
			'wrap_before' => '<ul class="breadcrumb" prefix="v: http://rdf.data-vocabulary.org/#">',
			'wrap_after' => '</ul>',
			'before' => '<li>',
			'after' => '</li>',
			'delimiter' => ''
		));
	}else{
		echo dh_get_breadcrumb();
	}
}

function dh_get_breadcrumb($args = array()){
	return apply_filters('dh_get_breadcrumb', false,$args);
}

function dh_page_title($echo = true){
	$title = "";
	
	if ( is_category() )
	{
		$title = single_cat_title('',false);
	}
	elseif (is_day())
	{
		$title = esc_html__('Archive for date:','sitesao')." ".get_the_time('F jS, Y');
	}
	elseif (is_month())
	{
		$title = esc_html__('Archive for month:','sitesao')." ".get_the_time('F, Y');
	}
	elseif (is_year())
	{
		$title = esc_html__('Archive for year:','sitesao')." ".get_the_time('Y');
	}
	elseif (is_search())
	{
		global $wp_query;
		if(!empty($wp_query->found_posts))
		{
			if($wp_query->found_posts > 1)
			{
				$title =  $wp_query->found_posts ." ". esc_html__('search results for','sitesao').' <span class="search-query">'.esc_attr( get_search_query() ).'</span>';
			}
			else
			{
				$title =  $wp_query->found_posts ." ". esc_html__('search result for','sitesao').' <span class="search-query">'.esc_attr( get_search_query() ).'</span>';
			}
		}
		else
		{
			if(!empty($_GET['s']))
			{
				$title = esc_html__('Search results for','sitesao').' <span class="search-query">'.esc_attr( get_search_query() ).'</span>';
			}
			else
			{
				$title = esc_html__('To search the site please enter a valid term','sitesao');
			}
		}
	
	}
	elseif (is_author())
	{
		$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
	
		if(isset($curauth->nickname)) $title = $curauth->nickname;
	
	}
	elseif (is_tag())
	{
		$title =single_tag_title('',false);
	}
	elseif(is_tax())
	{
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$title = $term->name;
	
	} elseif ( is_front_page() && !is_home() ) {
	    $title = get_the_title(get_option('page_on_front'));
	    
	} elseif ( is_home() && !is_front_page() ) {
	    $title = get_the_title(get_option('page_for_posts'));
	    
	} elseif ( is_404() ) {
	    $title = esc_html__('404 - Page not found','sitesao');
	}
	else {
		$title = get_the_title();
	}
	
	if (isset($_GET['paged']) && !empty($_GET['paged']))
	{
		$title .= " (".esc_html__('Page','sitesao')." ".$_GET['paged'].")";
	}

	if( defined('WOOCOMMERCE_VERSION') && is_woocommerce() && ( is_product() || is_shop() ) && !is_search() ) {
// 		if( ! is_product() ) {
// 			$title = woocommerce_page_title( false );
// 		}else{
// 			$title = 
// 		}
		$title = woocommerce_page_title( false );
	}
	if(is_post_type_archive( 'portfolio' )){
		$title = esc_html(dh_get_theme_option('portfolio-archive-title',esc_html__('My Portfolio','sitesao')));
	}
	if($echo)
		echo dh_print_string($title);
	else
		return $title;
}

function dh_portfolio_featured($post_id='',$post_format='',$is_shortcode = false,$hide_action = false,$layout = '',$link_to_project_url = false){
	/**
	 * script
	 * {{
	 */
	wp_enqueue_style('vendor-magnific-popup');
	wp_enqueue_script('vendor-magnific-popup');

	$post_id  = empty($post_id) ? get_the_ID() : $post_id;
	$format = dh_get_post_meta('portfolio_format');
	$post_id  = empty($post_id) ? get_the_ID() : $post_id;
	$post_format = $format;
	$thumb_size = !is_singular('portfolio') || $is_shortcode ? 'regular' : 'dh-full';
	if(dh_get_post_meta('masonry_size',$post_id,'normal') === 'double'):
	$thumb_size = 'wide';
	elseif (dh_get_post_meta('masonry_size',$post_id,'normal') === 'tall'):
	$thumb_size = 'tall';
	elseif (dh_get_post_meta('masonry_size',$post_id,'normal') === 'wide_tall'):
	$thumb_size = 'wide_tall';
	endif;
	if(is_singular('portfolio')){
		$thumb_size = 'dh-thumbnail';
	}
	if($layout == 'wall'){
		$thumb_size = 'dh-thumbnail';
	}
	if($layout == 'grid'){
		$thumb_size = 'regular';
	}

	$thumb_size = apply_filters('dh_portfolio_featured_thumbnail_size', $thumb_size,$post_id,$layout);

	$featured_class = !empty($post_format) ? ' '.$post_format.'-featured' : '';
	$view_action = get_the_permalink();
	$target='';
	if($link_to_project_url && ($project_url = dh_get_post_meta('url'))){
		$view_action = $project_url;
		$target = '  target="_blank"';
	}
	if($post_format == 'gallery'){
		/**
		 * script
		 * {{
		 */
		wp_enqueue_script('vendor-carouFredSel');

		$gallery_ids = explode(',',dh_get_post_meta('gallery'));
		$gallery_ids = array_filter($gallery_ids);
		if(!empty($gallery_ids) && is_array($gallery_ids)):
		?>
		<div class="portfolio-featured<?php echo esc_attr($featured_class) ?>">
			<div class="caroufredsel" data-visible="1" data-responsive="1" data-infinite="1" data-autoplay="0" data-height="variable">
				<div class="caroufredsel-wrap">
					<ul class="caroufredsel-items">
						<?php foreach ($gallery_ids as $id):?>
							<?php if($id):?>
							<?php 
							$image = wp_get_attachment_image_src($id,'dh-full');
							?>
							<li class="caroufredsel-item">
								<a href="<?php echo @$image[0] ?>" title="<?php echo get_the_title($id)?>" data-rel="magnific-popup">
									<?php echo wp_get_attachment_image($id,$thumb_size)?>
								</a>
							</li>
							<?php endif;?>
						<?php endforeach;?>
					</ul>
					<a href="#" class="caroufredsel-prev"></a>
					<a href="#" class="caroufredsel-next"></a>
					
				</div>
			</div>
		</div>
		<?php if(!$hide_action):?>
		<div class="portfolio-action">
			<a class="zoom-action" href="#"><i class="fa fa-search"></i></a>
			<a class="view-action" href="<?php echo esc_url($view_action)?>" <?php echo ($target) ?>><i class="fa fa-link"></i></a>
		</div>
		<div class="portfolio-overlay"></div>
		<?php endif;?>
		<?php
		endif;
	}elseif ($post_format == 'video'){
		/**
		 * script
		 * {{
		 */
		wp_enqueue_style( 'mediaelement' );
		wp_enqueue_script('mediaelement');
		
		$video_args = array();
		if($mp4 = dh_get_post_meta('video_mp4'))
			$video_args['mp4'] = $mp4;
		if ( $ogv = dh_get_post_meta('video_ogv') )
			$video_args['ogv'] = $ogv;
		if($webm = dh_get_post_meta('video_webm'))
			$video_args['webm'] = $webm;
		
		$video_poster = get_post_thumbnail_id($post_id);
		$poster='';
		if(has_post_thumbnail()){
			$post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id),$thumb_size);
			$poster_attr = ' poster="' . esc_url(@$post_thumb[0]) . '"';
			if(!is_singular() || $is_shortcode)
				$poster = @$post_thumb[0];
		}
		
		if(!empty($video_poster)){
			$poster_image = wp_get_attachment_image_src($video_poster, $thumb_size);
			$poster_attr = ' poster="' . esc_url(@$poster_image[0]) . '"';
			if(!is_singular() || $is_shortcode)
				$poster = @$poster_image[0];
		}
		
		
		if(!empty($video_args)):
			$video_html = '<div id="video-featured-'.$post_id.'" class="video-embed-wrap'.(!empty($poster) ? ' mfp-hide':'').'">';
			$video = '<video controls="controls" '.$poster_attr.' preload="0" class="video-embed'.(!empty($poster) ? ' video-embed-popup':'').'">';
			$source = '<source type="%s" src="%s" />';
			foreach ( $video_args as $video_type => $video_src ) {
				$video_type = wp_check_filetype( $video_src, wp_get_mime_types() );
				$video .= sprintf( $source, $video_type['type'], esc_url( $video_src ) );
			}
			$video .= '</video>';
			$video_html .=$video;
			$video_html .='</div>';
			echo '<div class="portfolio-featured'.$featured_class.'">';
				if(!empty($poster)){
					echo '<div class="video-poster"><img alt="'.get_the_title().'" src="'.$poster.'"></div>';
				}
				echo dh_print_string($video_html);
			echo '</div>';
			if(!$hide_action):
			echo '<div class="portfolio-action">';
			echo '<a class="zoom-action" data-video-inline="'.esc_attr($video).'" href="#video-featured-'.$post_id.'" data-rel="magnific-portfolio-video"><i class="fa fa-play"></i></a>';
			echo '<a class="view-action" href="'.$view_action.'" '.$target.'><i class="fa fa-link"></i></a>';
			echo '</div>';
			echo '<div class="portfolio-overlay"></div>';
			endif;
		elseif($embed = dh_get_post_meta('video_embed')):
			if(!empty($embed)){
				echo '<div class="portfolio-featured '.$post_format.'-featured">';
				
				echo '<div id="embed-featured-'.$post_id.'" class="embed-wrap'.(!empty($poster) ? ' mfp-hide':'').'">';
				echo apply_filters('dh_embed_video', $embed); 
				echo '</div>';
				if(!empty($poster)){
					echo '<div class="video-poster"><img alt="'.get_the_title().'" src="'.$poster.'"></div>';
				}
				echo '</div>';
				if(!$hide_action):
				echo '<div class="portfolio-action">';
				echo '<a class="zoom-action" href="#embed-featured-'.$post_id.'" data-rel="magnific-portfolio-video"><i class="fa fa-play"></i></a>';
				echo '<a class="view-action" href="'.$view_action.'"'.$target.'><i class="fa fa-link"></i></a>';
				echo '</div>';
				echo '<div class="portfolio-overlay"></div>';
				endif;
			}
		endif;
		
		
		
	}elseif (has_post_thumbnail()){
		$thumb_img = wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'dh-full');
		$thumb = wp_get_attachment_image(get_post_thumbnail_id($post_id), $thumb_size);
		echo '<div class="portfolio-featured'.$featured_class.'">';
		if(!is_singular() || $is_shortcode){
			echo '<a href="'.get_the_permalink().'">'.$thumb.'</a>';
		}else{
			if(is_singular('portfolio')){
				echo '<a href="'.esc_url($thumb_img[0]).'" data-rel="magnific-single-popup">'.$thumb.'</a>';
			}else{
				echo dh_print_string($thumb);
			}
		}
		echo '</div>';
		if(!$hide_action):
			echo '<div class="portfolio-action">';
			echo '<a class="zoom-action" href="'.esc_url($thumb_img[0]).'" title="'.esc_attr(get_the_title(get_post_thumbnail_id($post_id))).'" data-rel="magnific-single-popup"><i class="fa fa-search"></i></a>';
			echo '<a class="view-action" href="'.$view_action.'"'.$target.'><i class="fa fa-link"></i></a>';
			echo '</div>';
			echo '<div class="portfolio-overlay"></div>';
		endif;
	}
	return;
}

function dh_post_featured($post_id='',$post_format='',$is_shortcode = false,$is_related = false,$entry_featured_class = '',$layout = ''){
	$post_id  = empty($post_id) ? get_the_ID() : $post_id;
	$post_format = empty($post_format) ? get_post_format() : $post_format;
	$thumb_size = !is_singular() || $is_shortcode || $is_related ? 'dh-thumbnail' : 'dh-full';
	if($layout == 'masonry'){
		$thumb_size = 'dh-full';
	}
	$thumb_size = apply_filters('dh_post_featured_thumbnail_size', $thumb_size,$post_id);
	$featured_class = !empty($post_format) ? ' '.$post_format.'-featured' : '';
	if($is_related){
		if(has_post_thumbnail()){
			$thumb = get_the_post_thumbnail($post_id,$thumb_size,array('itemprop'=>'image'));
			echo '<div class="entry-featured'.$featured_class.'">';
			echo '<a href="'.get_the_permalink().'" title="'.esc_attr(get_the_title(get_post_thumbnail_id($post_id))).'">'.$thumb.'</a>';
			echo '</div>';
		}
	}else{
		if($post_format == 'gallery'){
			/**
			 * script
			 * {{
			 */
			wp_enqueue_script('vendor-carouFredSel');
			$gallery_ids = explode(',',dh_get_post_meta('gallery'));
			$gallery_ids = array_filter($gallery_ids);
			if(!empty($gallery_ids) && is_array($gallery_ids)):
			?>
			<div class="entry-featured<?php echo esc_attr($featured_class) ?><?php echo ' '.$entry_featured_class?>">
				<div class="caroufredsel" data-visible="1" data-responsive="1" data-infinite="1" data-autoplay="1"  data-height="variable">
					<div class="caroufredsel-wrap">
						<ul class="caroufredsel-items">
							<?php foreach ($gallery_ids as $id):?>
								<?php if($id):?>
								<?php 
								$image = wp_get_attachment_image_src($id,'dh-full');
								?>
								<li class="caroufredsel-item">
									<a href="<?php echo @$image[0] ?>" title="<?php echo get_the_title($id)?>" data-rel="magnific-popup">
										<?php echo wp_get_attachment_image($id,$thumb_size);?>
									</a>
								</li>
								<?php endif;?>
							<?php endforeach;?>
						</ul>
						<a href="#" class="caroufredsel-prev"></a>
						<a href="#" class="caroufredsel-next"></a>
					</div>
				</div>
			</div>
			<?php
			endif;
		}elseif ($post_format == 'video'){
			/**
			 * script
			 * {{
			 */
			wp_enqueue_style( 'mediaelement' );
			wp_enqueue_script('mediaelement');
			if(is_single()){
				$video_args = array();
				if($mp4 = dh_get_post_meta('video_mp4'))
					$video_args['mp4'] = $mp4;
				if ( $ogv = dh_get_post_meta('video_ogv') )
					$video_args['ogv'] = $ogv;
				if($webm = dh_get_post_meta('video_webm'))
					$video_args['webm'] = $webm;
				
				$poster = dh_get_post_meta('video_poster');
				$poster_attr='';
				
				if(has_post_thumbnail()){
					$post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id),$thumb_size);
					$poster_attr = ' poster="' . esc_url(@$post_thumb[0]) . '"';
				}
				
				if(!empty($poster)){
					$poster_image = wp_get_attachment_image_src($poster, $thumb_size);
					$poster_attr = ' poster="' . esc_url(@$poster_image[0]) . '"';
				}
				
				
				if(!empty($video_args)):
					$video = '<div id="video-featured-'.$post_id.'" class="video-embed-wrap"><video controls="controls" '.$poster_attr.' preload="0" class="video-embed">';
					$source = '<source type="%s" src="%s" />';
					foreach ( $video_args as $video_type => $video_src ) {
						$video_type = wp_check_filetype( $video_src, wp_get_mime_types() );
						$video .= sprintf( $source, $video_type['type'], esc_url( $video_src ) );
					}
					$video .= '</video></div>';
					echo '<div class="entry-featured'.$featured_class.'">';
						echo dh_print_string($video);
					echo '</div>';
				elseif($embed = dh_get_post_meta('video_embed')):
					if(!empty($embed)){
						echo '<div class="entry-featured '.$post_format.'-featured '.$entry_featured_class.'">';
						echo '<div id="video-featured-'.$post_id.'" class="embed-wrap">';
						echo apply_filters('dh_embed_video', $embed); 
						echo '</div>';
						echo '</div>';
					}
				endif;
			}else{
				if(has_post_thumbnail()){
					$thumb = get_the_post_thumbnail($post_id,$thumb_size,array('data-itemprop'=>'image'));
				}else{
					$thumb = '<img src="'.get_template_directory_uri().'/assets/images/noo-thumb_700x350.png" alt="'.get_the_title().'">';
				}
				echo '<div class="entry-featured'.$featured_class.' '.$entry_featured_class.'">';
				echo '<a href="'.get_the_permalink().'" title="'.esc_attr(get_the_title(get_post_thumbnail_id($post_id))).'">'.$thumb.'</a>';
				echo '</div>';
			}
		}elseif ($post_format == 'audio'){
			/**
			 * script
			 * {{
			 */
			wp_enqueue_style( 'mediaelement' );
			wp_enqueue_script('mediaelement');
			$audio_args = array();
		
			if($mp3 = dh_get_post_meta('audio_mp3'))
				$audio_args['mp3'] = $mp3;
			
			if($ogg = dh_get_post_meta('audio_ogg'))
				$audio_args['ogg'] = $ogg;
			
			
			if(!empty($audio_args)){
				$audio = '<div id="audio-featured-'.$post_id.'" class="audio-embed-wrap"><audio class="audio-embed">';
				$source = '<source type="%s" src="%s" />';
				foreach ( $audio_args as $type => $audio_src ) {
					$audio_type = wp_check_filetype( $audio_src, wp_get_mime_types() );
					$audio .= sprintf( $source, $audio_type['type'], esc_url( $audio_src ) );
				}
				$audio .='</audio></div>';
				echo '<div class="entry-featured'.$featured_class.' '.$entry_featured_class.'">';
				echo dh_print_string($audio);
				echo '</div>';
			}
		}elseif (has_post_thumbnail()){
			$thumb = get_the_post_thumbnail($post_id,$thumb_size,array('data-itemprop'=>'image'));
			echo '<div class="entry-featured'.$featured_class.' '.$entry_featured_class.'">';
			if(!is_singular() || $is_shortcode){
				echo '<a href="'.get_the_permalink().'" title="'.esc_attr(get_the_title(get_post_thumbnail_id($post_id))).'">'.$thumb.'</a>';
			}else{
				echo dh_print_string($thumb);
			}
			echo '</div>';
		}
	}
	return;
}

function dh_post_meta($show_date=true,$show_comment = true,$show_category= true,$show_author = true,$echo = true,$meta_separator= ', ',$date_format = null,$icon = false) {
	if(empty($date_format))
		$date_format = get_option( 'date_format' );
	$post_type = get_post_type();
	//$show_date = false;
	//$meta_separator = false;
	$html = array();
	
	// Date
	$date_html = '';
	if($show_date){
		$date_html .= '<span class="meta-date">';
		$date_html .= '<time datetime="' . esc_attr(get_the_date('c')) . '" data-itemprop="dateCreated">';
		if($icon)
			$date_html .= '<i class="fa fa-clock-o"></i>';
		$date_html .= esc_html(get_the_date($date_format));
		$date_html .= '</time>';
		$date_html .= '</span>';
		$html[] = $date_html;
	}
	// Author
	$author_html = '';
	if($show_author){
		$author_html .= '<span class="meta-author">';
		if($icon)
			$author_html .= '<i class="fa fa-user"></i>';
		$author = sprintf(
			'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'nicename' ) ) ),
			esc_attr( sprintf( esc_html__( 'Posts by %s', 'sitesao'), get_the_author() ) ),
			get_the_author()
		);
		$author_html .= sprintf(esc_html__('By %1$s', 'sitesao'),$author);
		$author_html .= '</span>';
		$html[] = $author_html;
	}
	// Categories
	$categories_html = '';
	if($show_category){
		$categories_html .= '<span class="meta-category">';
		if($icon)
			$categories_html .= '<i class="fa fa-folder-open-o"></i>';
		$categories_html .= sprintf(esc_html__('In %1$s','sitesao'),get_the_category_list(', '));
		$categories_html .= '</span>';
		$html[] = $categories_html;
	}
	
	
	// Comments
	$comments_html = '';
	if (comments_open()) {
		$comment_title = '';
		$comment_number = get_comments_number();
		if (get_comments_number() == 0) {
			$comment_title = sprintf(esc_html__('Leave a comment on: &ldquo;%s&rdquo;', 'sitesao') , get_the_title());
			$comment_number = '0 '.esc_html__('Comment', 'sitesao');
		} else if (get_comments_number() == 1) {
			$comment_title = sprintf(esc_html__('View a comment on: &ldquo;%s&rdquo;', 'sitesao') , get_the_title());
			$comment_number = '1 ' . esc_html__('Comment', 'sitesao');
		} else {
			$comment_title = sprintf(esc_html__('View all comments on: &ldquo;%s&rdquo;', 'sitesao') , get_the_title());
			$comment_number =  get_comments_number() . ' ' . esc_html__('Comments', 'sitesao');
		}
			
		$comments_html.= '<span class="meta-comment">';
		if($icon)
			$comments_html .= '<i class="fa fa-comment-o"></i>';
		$comments_html .= '<a' . ' href="' . esc_url(get_comments_link()) . '"' . ' title="' . esc_attr($comment_title) . '"' . ' class="meta-comments">';
		$comments_html.=  $comment_number . '</a></span> ';
		$comments_html.='<meta content="UserComments:'.get_comments_number().'" itemprop="interactionCount">';
	}
	if($show_comment)
		$html[] = $comments_html;
	
	if($meta_separator !== false && !$icon)
		$html = implode('<span class="meta-separator">'.$meta_separator.'</span>', $html);
	else 
		$html = implode("\n",$html);
	
	if($echo)
		echo dh_print_string($html);
	else 
		return $html;
}

function dh_timeline_date($args=array()){
	$defaults = array(
			'prev_post_month' 	=> null,
			'post_month' 		=> 'null'
	);
	$args = wp_parse_args( $args, $defaults );
	if( $args['prev_post_month'] != $args['post_month'] ) {
	?>
		<div class="timeline-date">
			<span class="timeline-date-title"><?php echo get_the_date('M Y')?></span>
		</div>
		<?php
	}
}

function dh_paginate_links_short($args = array(), $query = null){
	global $wp_rewrite, $wp_query;
	do_action( 'dh_pagination_short_start' );
	
	if ( empty($query)) {
		$query = $wp_query;
	}
	
	if ( 1 >= $query->max_num_pages )
		return;
	
	$paged = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
	$max_num_pages = intval( $query->max_num_pages );
	// Setting up default values based on the current URL.

	$defaults = array(
		'base' => esc_url_raw(add_query_arg( 'paged', '%#%' )),
		'format' => '',
		'total' => $max_num_pages,
		'current' => $paged,
		'prev_text' => '<i class="fa fa-angle-left"></i>',
		'next_text' => '<i class="fa fa-angle-right"></i>',
		'add_fragment' => '',
		'add_args'=>array(),
		'before' => '<div class="paginate"><div class="paginate_links"><span class="pagination-meta">'.sprintf(esc_html__("%d/%d", 'sitesao'), $paged, $max_num_pages).'</span>',
		'after' => '</div></div>',
		'echo' => true,
	);
	$defaults = apply_filters( 'dh_pagination_short_args_defaults', $defaults );
	
	if( $wp_rewrite->using_permalinks() && ! is_search() )
		$defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );
	
	if ( is_search() )
		$defaults['use_search_permastruct'] = false;
	
	if ( is_search() ) {
		if ( class_exists( 'BP_Core_User' ) || $defaults['use_search_permastruct'] == false ) {
			$search_query = get_query_var( 's' );
			$paged = get_query_var( 'paged' );
			$base = esc_url_raw(add_query_arg( 's', urlencode( $search_query ) ));
			$base = esc_url_raw(add_query_arg( 'paged', '%#%' ));
			$defaults['base'] = $base;
		} else {
			$search_permastruct = $wp_rewrite->get_search_permastruct();
			if ( ! empty( $search_permastruct ) ) {
				$base = get_search_link();
				$base = esc_url_raw(add_query_arg( 'paged', '%#%', $base ));
				$defaults['base'] = $base;
			}
		}
	}
	
	$args = wp_parse_args( $args, $defaults );
	
	$args = apply_filters( 'dh_pagination_short_args', $args );
	
	$pattern = '/\?(.*?)\//i';
	
	preg_match( $pattern, $args['base'], $raw_querystring );
	if(!empty($raw_querystring)){
		if( $wp_rewrite->using_permalinks() && $raw_querystring )
			$raw_querystring[0] = str_replace( '', '', $raw_querystring[0] );
		$args['base'] = str_replace( $raw_querystring[0], '', $args['base'] );
		$args['base'] .= substr( $raw_querystring[0], 0, -1 );
	}
	
	if ( isset( $url_parts[1] ) ) {
		// Find the format argument.
		$format_query = parse_url( str_replace( '%_%', $args['format'], $args['base'] ), PHP_URL_QUERY );
		wp_parse_str( $format_query, $format_arg );

		// Remove the format argument from the array of query arguments, to avoid overwriting custom format.
		wp_parse_str( esc_url_raw(remove_query_arg( array_keys( $format_arg ), $url_parts[1] ), $query_args ));
		$args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $query_args ) );
	}
	// Who knows what else people pass in $args
	$total = (int) $args['total'];
	if ( $total < 2 ) {
		return;
	}
	$add_args = $args['add_args'];
	$current  = (int) $args['current'];
	$prev_href='';
	$next_href='';
	if ($current && 1 < $current ) :
		$link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
		$link = str_replace( '%#%', $current - 1, $link );
		if ( $add_args )
			$link = esc_url_raw(add_query_arg( $add_args, $link ));
		$link .= $args['add_fragment'];
		$prev_href = ' href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '"';
	endif;
	if ($current && ( $current < $total || -1 == $total ) ) :
		$link = str_replace( '%_%', $args['format'], $args['base'] );
		$link = str_replace( '%#%', $current + 1, $link );
		if ( $add_args )
			$link = esc_url_raw(add_query_arg( $add_args, $link ));
		$link .= $args['add_fragment'];
		$next_href = ' href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '"';
	endif;
	$page_links[] = '<a class="prev page-numbers" '.$prev_href.'>' . $args['prev_text'] . '</a>';
	$page_links[] = '<a class="next page-numbers" ' .$next_href. '>' . $args['next_text'] . '</a>';
	$page_links = join("\n", $page_links);
	$page_links = $args['before'] . $page_links . $args['after'];
	$page_links = apply_filters( 'dh_pagination_short', $page_links );
	
	do_action( 'dh_pagination_short_end' );
	
	if ( $args['echo'] )
		echo dh_print_string($page_links);
	else
		return $page_links;
}

function dh_paginate_links( $args = array(), $query = null ){
	global $wp_rewrite, $wp_query;

	do_action( 'dh_pagination_start' );

	if ( empty($query)) {
		$query = $wp_query;
	}

	if ( 1 >= $query->max_num_pages )
		return;

	$paged = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );

	$max_num_pages = intval( $query->max_num_pages );

	$defaults = array(
			'base' => esc_url_raw(add_query_arg( 'paged', '%#%' )),
			'format' => '',
			'total' => $max_num_pages,
			'current' => $paged,
			'prev_next' => true,
			'prev_text' => '<span>Prev</span>',
			'next_text' => '<span>Next</span>',
			'show_all' => false,
			'end_size' => 1,
			'mid_size' => 1,
			'add_fragment' => '',
			'type' => 'plain',
			'before' => '<div class="paginate"><div class="paginate_links">',
			'after' => '</div></div>',
			'echo' => true,
			'use_search_permastruct' => true
	);

	$defaults = apply_filters( 'dh_pagination_args_defaults', $defaults );

	if( $wp_rewrite->using_permalinks() && ! is_search() )
		$defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

	if ( is_search() )
		$defaults['use_search_permastruct'] = false;

	if ( is_search() ) {
		if ( class_exists( 'BP_Core_User' ) || $defaults['use_search_permastruct'] == false ) {
			$search_query = get_query_var( 's' );
			$paged = get_query_var( 'paged' );
			$base = esc_url_raw(add_query_arg( 's', urlencode( $search_query ) ));
			$base = esc_url_raw(add_query_arg( 'paged', '%#%' ));
			$defaults['base'] = $base;
		} else {
			$search_permastruct = $wp_rewrite->get_search_permastruct();
			if ( ! empty( $search_permastruct ) ) {
				$base = get_search_link();
				$base = esc_url_raw(add_query_arg( 'paged', '%#%', $base ));
				$defaults['base'] = $base;
			}
		}
	}

	$args = wp_parse_args( $args, $defaults );

	$args = apply_filters( 'dh_pagination_args', $args );

	if ( 'array' == $args['type'] )
		$args['type'] = 'plain';

	$pattern = '/\?(.*?)\//i';

	preg_match( $pattern, $args['base'], $raw_querystring );
	if(!empty($raw_querystring)){
		if( $wp_rewrite->using_permalinks() && $raw_querystring )
			$raw_querystring[0] = str_replace( '', '', $raw_querystring[0] );
		$args['base'] = str_replace( $raw_querystring[0], '', $args['base'] );
		$args['base'] .= substr( $raw_querystring[0], 0, -1 );
	}
	$page_links = paginate_links( $args );

	$page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );

	$page_links = $args['before'] . $page_links . $args['after'];

	$page_links = apply_filters( 'dh_pagination', $page_links );

	do_action( 'dh_pagination_end' );

	if ( $args['echo'] )
		echo dh_print_string($page_links);
	else
		return $page_links;

}

/**
 * Returns the first found number from an string
 * Parsing depends on given locale (grouping and decimal)
 *
 * Examples for input:
 * '  2345.4356,1234' = 23455456.1234
 * '+23,3452.123' = 233452.123
 * ' 12343 ' = 12343
 * '-9456km' = -9456
 * '0' = 0
 * '2 054,10' = 2054.1
 * '2'054.52' = 2054.52
 * '2,46 GB' = 2.46
 *
 * @param string|float|int $value
 * @return float|null
 */
function dh_get_number($value)
{
	if (is_null($value)) {
		return null;
	}

	if (!is_string($value)) {
		return floatval($value);
	}

	//trim spaces and apostrophes
	$value = str_replace(array('\'', ' '), '', $value);

	$separatorComa = strpos($value, ',');
	$separatorDot  = strpos($value, '.');

	if ($separatorComa !== false && $separatorDot !== false) {
		if ($separatorComa > $separatorDot) {
			$value = str_replace('.', '', $value);
			$value = str_replace(',', '.', $value);
		}
		else {
			$value = str_replace(',', '', $value);
		}
	}
	elseif ($separatorComa !== false) {
		$value = str_replace(',', '.', $value);
	}

	return floatval($value);
}


function dh_format_color( $color ='' ) {
	if(strstr($color,'rgba')){
		return $color;
	}
	
	$hex = trim( str_replace( '#', '', $color ) );
	if(empty($hex))
		return '';

	if ( strlen( $hex ) == 3 ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}

	if ( $hex ){
		if ( ! preg_match( '/^#[a-f0-9]{6}$/i', $hex ) ) {
			return '#' . $hex;
		}
	}
	return '';
}


function dh_morphsearchform(){
	
	ob_start();
	?>
	<div class="morphsearch" id="morphsearch">
		<form class="morphsearch-form" method="get"  action="<?php echo esc_url( home_url( '/' ) ) ?>" role="form">
			<input type="search" name="s" placeholder="<?php esc_html_e('Search...','sitesao')?>" class="morphsearch-input">
			<button type="submit" class="morphsearch-submit"></button>
			<input type="hidden" value="post" name="post_type">
		</form>
		<div class="morphsearch-content<?php echo (defined( 'WOOCOMMERCE_VERSION' )  ? ' has-3colum':'') ?>">
			<?php if ( defined( 'WOOCOMMERCE_VERSION' ) ) { ?>
			<div class="dummy-column">
				<h2><?php esc_html_e('Product','sitesao') ?></h2>
				<?php 
				$query_args = array(
		    		'posts_per_page' => 6,
		    		'post_status' 	 => 'publish',
		    		'post_type' 	 => 'product',
		    		'no_found_rows'  => 1,
					'orderby'		 =>'date',
		    		'order'          => 'DESC'
		    	);
				$query_args['meta_query'] = WC()->query->get_meta_query();
				$r = new WP_Query( $query_args );
				if ( $r->have_posts() ) {
					while ( $r->have_posts() ) {
						$r->the_post();
						global $product;
						?>
						<a href="<?php the_permalink()?>" class="dummy-media-object">
							<?php echo dh_print_string($product->get_image('dh-thumbnail-square')); ?>
							<div>
								<h3><?php echo dh_print_string($product->get_title()); ?></h3>
								<?php if ( ! empty( $show_rating ) ) echo dh_print_string($product->get_rating_html()); ?>
								<div class="price">
									<?php echo dh_print_string($product->get_price_html()); ?>
								</div>
							</div>
						</a>
						<?php
					}
				}
				wp_reset_postdata();
				?>
			</div>
			<?php }?>
			<div class="dummy-column">
				<h2><?php esc_html_e('Popular','sitesao') ?></h2>
				<?php 
				$re = new WP_Query(array(
					'posts_per_page'      => 6,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'meta_key'			  => "_thumbnail_id",
					'orderby'			  =>'comment_count',
					'order' 			  => 'DESC',
				) );
				if ($re->have_posts()) :
				?>
				<?php while ( $re->have_posts() ) : $re->the_post(); ?>
				<a href="<?php the_permalink()?>" class="dummy-media-object">
					<?php the_post_thumbnail('dh-thumbnail-square')?>
					<div>
						<h3><?php the_title()?></h3>
						<?php echo '<span>'.sprintf(esc_html__('%s Comment','sitesao'),get_comments_number()).'</span>'; ?>
					</div>
				</a>
				<?php endwhile; ?>
				<?php 
				endif;
				wp_reset_postdata();
				?>
			</div>
			<div class="dummy-column">
				<h2><?php esc_html_e('Recent','sitesao') ?></h2>
				<?php 
				$rc = new WP_Query(array(
					'posts_per_page'      => 6,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'meta_key' => "_thumbnail_id",
				) );
				if ($rc->have_posts()) :
				?>
				<?php while ( $rc->have_posts() ) : $rc->the_post(); ?>
				<a href="<?php the_permalink()?>" class="dummy-media-object">
					<?php the_post_thumbnail('dh-thumbnail-square')?>
					<div>
						<h3><?php the_title()?></h3>
						<span>
							<time datetime="<?php echo get_the_date('Y-m-d\TH:i:sP') ?>"><?php echo get_the_date('M j, Y') ?></time>
						</span>
					</div>
				</a>
				<?php endwhile; ?>
				<?php 
				endif;
				wp_reset_postdata();
				?>
			</div>
		</div>
		<span class="morphsearch-close"></span>
	</div>
	<div class="morphsearch-overlay"></div>
	<?php
	return ob_get_clean();
}

function dh_mailchimp_form($echo = true){
	ob_start();
	?>
	<form id="mailchimp-form-<?php echo wp_create_nonce('mailchimp_subscribe_nonce')?>" method="get" class="mailchimp-form" action="<?php echo home_url('/')?>">
		<?php 
		$mailchimp_subscribe = isset($_GET['mailchimp_subscribe']) ? $_GET['mailchimp_subscribe']:'';
		if(!empty($mailchimp_subscribe)):
		?>
		<div class="mailchimp-form-result">
			<?php 
			if($mailchimp_subscribe == -1){
				echo '<span class="error">'.esc_html__( 'Not Subscribe to Mailchimp!', 'sitesao' ).'<span>';
			}elseif ($mailchimp_subscribe == 1){
				echo '<span class="success">'.esc_html__( 'Subscribe to Mailchimp Successful!', 'sitesao' ).'</span>';
			}
			?>
		</div>
		<?php endif;?>
		<div class="mailchimp-form-content clearfix">
			<div class="row">
				<div class="col-sm-8">
					<label for="" class="hide"><?php esc_html_e('Subscribe','sitesao')?></label>
					<input type="email" class="form-control"  required="required" autocomplete="off" placeholder="<?php _e('Enter your email...','sitesao')?>" name="email">
				</div>
				<div class="col-sm-4">
					<button type="submit" class="btn btn-outline mailchimp-submit"><?php esc_html_e('Subscribe','sitesao')?></button>
				</div>
			</div>
			<div style="display: none;">
				<input type="hidden" name="_subscribe_nonce" value="<?php echo wp_create_nonce('mailchimp_subscribe_nonce') ?>">
				<input type="hidden" name="action" value="dh_mailchimp_subscribe">
			</div>
		</div>
	</form>
	<?php
	$form = ob_get_clean();
	$form = apply_filters('mailchimp_form', $form);
	if($echo)
		echo dh_print_string($form);
	else 
		return $form;
}

function dh_font_awesome_options($none_select = true){
	$font_awesome =  array(
			esc_html__('None','sitesao') =>'none',
			'fa fa-adjust' => '\f042',
			'fa fa-adn' => '\f170',
			'fa fa-align-center' => '\f037',
			'fa fa-align-justify' => '\f039',
			'fa fa-align-left' => '\f036',
			'fa fa-align-right' => '\f038',
			'fa fa-ambulance' => '\f0f9',
			'fa fa-anchor' => '\f13d',
			'fa fa-android' => '\f17b',
			'fa fa-angellist' => '\f209',
			'fa fa-angle-double-down' => '\f103',
			'fa fa-angle-double-left' => '\f100',
			'fa fa-angle-double-right' => '\f101',
			'fa fa-angle-double-up' => '\f102',
			'fa fa-angle-down' => '\f107',
			'fa fa-angle-left' => '\f104',
			'fa fa-angle-right' => '\f105',
			'fa fa-angle-up' => '\f106',
			'fa fa-apple' => '\f179',
			'fa fa-archive' => '\f187',
			'fa fa-area-chart' => '\f1fe',
			'fa fa-arrow-circle-down' => '\f0ab',
			'fa fa-arrow-circle-left' => '\f0a8',
			'fa fa-arrow-circle-o-down' => '\f01a',
			'fa fa-arrow-circle-o-left' => '\f190',
			'fa fa-arrow-circle-o-right' => '\f18e',
			'fa fa-arrow-circle-o-up' => '\f01b',
			'fa fa-arrow-circle-right' => '\f0a9',
			'fa fa-arrow-circle-up' => '\f0aa',
			'fa fa-arrow-down' => '\f063',
			'fa fa-arrow-left' => '\f060',
			'fa fa-arrow-right' => '\f061',
			'fa fa-arrow-up' => '\f062',
			'fa fa-arrows' => '\f047',
			'fa fa-arrows-alt' => '\f0b2',
			'fa fa-arrows-h' => '\f07e',
			'fa fa-arrows-v' => '\f07d',
			'fa fa-asterisk' => '\f069',
			'fa fa-at' => '\f1fa',
			'fa fa-backward' => '\f04a',
			'fa fa-ban' => '\f05e',
			'fa fa-bar-chart' => '\f080',
			'fa fa-barcode' => '\f02a',
			'fa fa-bars' => '\f0c9',
			'fa fa-beer' => '\f0fc',
			'fa fa-behance' => '\f1b4',
			'fa fa-behance-square' => '\f1b5',
			'fa fa-bell' => '\f0f3',
			'fa fa-bell-o' => '\f0a2',
			'fa fa-bell-slash' => '\f1f6',
			'fa fa-bell-slash-o' => '\f1f7',
			'fa fa-bicycle' => '\f206',
			'fa fa-binoculars' => '\f1e5',
			'fa fa-birthday-cake' => '\f1fd',
			'fa fa-bitbucket' => '\f171',
			'fa fa-bitbucket-square' => '\f172',
			'fa fa-bold' => '\f032',
			'fa fa-bolt' => '\f0e7',
			'fa fa-bomb' => '\f1e2',
			'fa fa-book' => '\f02d',
			'fa fa-bookmark' => '\f02e',
			'fa fa-bookmark-o' => '\f097',
			'fa fa-briefcase' => '\f0b1',
			'fa fa-btc' => '\f15a',
			'fa fa-bug' => '\f188',
			'fa fa-building' => '\f1ad',
			'fa fa-building-o' => '\f0f7',
			'fa fa-bullhorn' => '\f0a1',
			'fa fa-bullseye' => '\f140',
			'fa fa-bus' => '\f207',
			'fa fa-calculator' => '\f1ec',
			'fa fa-calendar' => '\f073',
			'fa fa-calendar-o' => '\f133',
			'fa fa-camera' => '\f030',
			'fa fa-camera-retro' => '\f083',
			'fa fa-car' => '\f1b9',
			'fa fa-caret-down' => '\f0d7',
			'fa fa-caret-left' => '\f0d9',
			'fa fa-caret-right' => '\f0da',
			'fa fa-caret-square-o-down' => '\f150',
			'fa fa-caret-square-o-left' => '\f191',
			'fa fa-caret-square-o-right' => '\f152',
			'fa fa-caret-square-o-up' => '\f151',
			'fa fa-caret-up' => '\f0d8',
			'fa fa-cc' => '\f20a',
			'fa fa-cc-amex' => '\f1f3',
			'fa fa-cc-discover' => '\f1f2',
			'fa fa-cc-mastercard' => '\f1f1',
			'fa fa-cc-paypal' => '\f1f4',
			'fa fa-cc-stripe' => '\f1f5',
			'fa fa-cc-visa' => '\f1f0',
			'fa fa-certificate' => '\f0a3',
			'fa fa-chain-broken' => '\f127',
			'fa fa-check' => '\f00c',
			'fa fa-check-circle' => '\f058',
			'fa fa-check-circle-o' => '\f05d',
			'fa fa-check-square' => '\f14a',
			'fa fa-check-square-o' => '\f046',
			'fa fa-chevron-circle-down' => '\f13a',
			'fa fa-chevron-circle-left' => '\f137',
			'fa fa-chevron-circle-right' => '\f138',
			'fa fa-chevron-circle-up' => '\f139',
			'fa fa-chevron-down' => '\f078',
			'fa fa-chevron-left' => '\f053',
			'fa fa-chevron-right' => '\f054',
			'fa fa-chevron-up' => '\f077',
			'fa fa-child' => '\f1ae',
			'fa fa-circle' => '\f111',
			'fa fa-circle-o' => '\f10c',
			'fa fa-circle-o-notch' => '\f1ce',
			'fa fa-circle-thin' => '\f1db',
			'fa fa-clipboard' => '\f0ea',
			'fa fa-clock-o' => '\f017',
			'fa fa-cloud' => '\f0c2',
			'fa fa-cloud-download' => '\f0ed',
			'fa fa-cloud-upload' => '\f0ee',
			'fa fa-code' => '\f121',
			'fa fa-code-fork' => '\f126',
			'fa fa-codepen' => '\f1cb',
			'fa fa-coffee' => '\f0f4',
			'fa fa-cog' => '\f013',
			'fa fa-cogs' => '\f085',
			'fa fa-columns' => '\f0db',
			'fa fa-comment' => '\f075',
			'fa fa-comment-o' => '\f0e5',
			'fa fa-comments' => '\f086',
			'fa fa-comments-o' => '\f0e6',
			'fa fa-compass' => '\f14e',
			'fa fa-compress' => '\f066',
			'fa fa-copyright' => '\f1f9',
			'fa fa-credit-card' => '\f09d',
			'fa fa-crop' => '\f125',
			'fa fa-crosshairs' => '\f05b',
			'fa fa-css3' => '\f13c',
			'fa fa-cube' => '\f1b2',
			'fa fa-cubes' => '\f1b3',
			'fa fa-cutlery' => '\f0f5',
			'fa fa-database' => '\f1c0',
			'fa fa-delicious' => '\f1a5',
			'fa fa-desktop' => '\f108',
			'fa fa-deviantart' => '\f1bd',
			'fa fa-digg' => '\f1a6',
			'fa fa-dot-circle-o' => '\f192',
			'fa fa-download' => '\f019',
			'fa fa-dribbble' => '\f17d',
			'fa fa-dropbox' => '\f16b',
			'fa fa-drupal' => '\f1a9',
			'fa fa-eject' => '\f052',
			'fa fa-ellipsis-h' => '\f141',
			'fa fa-ellipsis-v' => '\f142',
			'fa fa-empire' => '\f1d1',
			'fa fa-envelope' => '\f0e0',
			'fa fa-envelope-o' => '\f003',
			'fa fa-envelope-square' => '\f199',
			'fa fa-eraser' => '\f12d',
			'fa fa-eur' => '\f153',
			'fa fa-exchange' => '\f0ec',
			'fa fa-exclamation' => '\f12a',
			'fa fa-exclamation-circle' => '\f06a',
			'fa fa-exclamation-triangle' => '\f071',
			'fa fa-expand' => '\f065',
			'fa fa-external-link' => '\f08e',
			'fa fa-external-link-square' => '\f14c',
			'fa fa-eye' => '\f06e',
			'fa fa-eye-slash' => '\f070',
			'fa fa-eyedropper' => '\f1fb',
			'fa fa-facebook' => '\f09a',
			'fa fa-facebook-square' => '\f082',
			'fa fa-fast-backward' => '\f049',
			'fa fa-fast-forward' => '\f050',
			'fa fa-fax' => '\f1ac',
			'fa fa-female' => '\f182',
			'fa fa-fighter-jet' => '\f0fb',
			'fa fa-file' => '\f15b',
			'fa fa-file-archive-o' => '\f1c6',
			'fa fa-file-audio-o' => '\f1c7',
			'fa fa-file-code-o' => '\f1c9',
			'fa fa-file-excel-o' => '\f1c3',
			'fa fa-file-image-o' => '\f1c5',
			'fa fa-file-o' => '\f016',
			'fa fa-file-pdf-o' => '\f1c1',
			'fa fa-file-powerpoint-o' => '\f1c4',
			'fa fa-file-text' => '\f15c',
			'fa fa-file-text-o' => '\f0f6',
			'fa fa-file-video-o' => '\f1c8',
			'fa fa-file-word-o' => '\f1c2',
			'fa fa-files-o' => '\f0c5',
			'fa fa-film' => '\f008',
			'fa fa-filter' => '\f0b0',
			'fa fa-fire' => '\f06d',
			'fa fa-fire-extinguisher' => '\f134',
			'fa fa-flag' => '\f024',
			'fa fa-flag-checkered' => '\f11e',
			'fa fa-flag-o' => '\f11d',
			'fa fa-flask' => '\f0c3',
			'fa fa-flickr' => '\f16e',
			'fa fa-floppy-o' => '\f0c7',
			'fa fa-folder' => '\f07b',
			'fa fa-folder-o' => '\f114',
			'fa fa-folder-open' => '\f07c',
			'fa fa-folder-open-o' => '\f115',
			'fa fa-font' => '\f031',
			'fa fa-forward' => '\f04e',
			'fa fa-foursquare' => '\f180',
			'fa fa-frown-o' => '\f119',
			'fa fa-futbol-o' => '\f1e3',
			'fa fa-gamepad' => '\f11b',
			'fa fa-gavel' => '\f0e3',
			'fa fa-gbp' => '\f154',
			'fa fa-gift' => '\f06b',
			'fa fa-git' => '\f1d3',
			'fa fa-git-square' => '\f1d2',
			'fa fa-github' => '\f09b',
			'fa fa-github-alt' => '\f113',
			'fa fa-github-square' => '\f092',
			'fa fa-gittip' => '\f184',
			'fa fa-glass' => '\f000',
			'fa fa-globe' => '\f0ac',
			'fa fa-google' => '\f1a0',
			'fa fa-google-plus' => '\f0d5',
			'fa fa-google-plus-square' => '\f0d4',
			'fa fa-google-wallet' => '\f1ee',
			'fa fa-graduation-cap' => '\f19d',
			'fa fa-h-square' => '\f0fd',
			'fa fa-hacker-news' => '\f1d4',
			'fa fa-hand-o-down' => '\f0a7',
			'fa fa-hand-o-left' => '\f0a5',
			'fa fa-hand-o-right' => '\f0a4',
			'fa fa-hand-o-up' => '\f0a6',
			'fa fa-hdd-o' => '\f0a0',
			'fa fa-header' => '\f1dc',
			'fa fa-headphones' => '\f025',
			'fa fa-heart' => '\f004',
			'fa fa-heart-o' => '\f08a',
			'fa fa-history' => '\f1da',
			'fa fa-home' => '\f015',
			'fa fa-hospital-o' => '\f0f8',
			'fa fa-html5' => '\f13b',
			'fa fa-ils' => '\f20b',
			'fa fa-inbox' => '\f01c',
			'fa fa-indent' => '\f03c',
			'fa fa-info' => '\f129',
			'fa fa-info-circle' => '\f05a',
			'fa fa-inr' => '\f156',
			'fa fa-instagram' => '\f16d',
			'fa fa-ioxhost' => '\f208',
			'fa fa-italic' => '\f033',
			'fa fa-joomla' => '\f1aa',
			'fa fa-jpy' => '\f157',
			'fa fa-jsfiddle' => '\f1cc',
			'fa fa-key' => '\f084',
			'fa fa-keyboard-o' => '\f11c',
			'fa fa-krw' => '\f159',
			'fa fa-language' => '\f1ab',
			'fa fa-laptop' => '\f109',
			'fa fa-lastfm' => '\f202',
			'fa fa-lastfm-square' => '\f203',
			'fa fa-leaf' => '\f06c',
			'fa fa-lemon-o' => '\f094',
			'fa fa-level-down' => '\f149',
			'fa fa-level-up' => '\f148',
			'fa fa-life-ring' => '\f1cd',
			'fa fa-lightbulb-o' => '\f0eb',
			'fa fa-line-chart' => '\f201',
			'fa fa-link' => '\f0c1',
			'fa fa-linkedin' => '\f0e1',
			'fa fa-linkedin-square' => '\f08c',
			'fa fa-linux' => '\f17c',
			'fa fa-list' => '\f03a',
			'fa fa-list-alt' => '\f022',
			'fa fa-list-ol' => '\f0cb',
			'fa fa-list-ul' => '\f0ca',
			'fa fa-location-arrow' => '\f124',
			'fa fa-lock' => '\f023',
			'fa fa-long-arrow-down' => '\f175',
			'fa fa-long-arrow-left' => '\f177',
			'fa fa-long-arrow-right' => '\f178',
			'fa fa-long-arrow-up' => '\f176',
			'fa fa-magic' => '\f0d0',
			'fa fa-magnet' => '\f076',
			'fa fa-male' => '\f183',
			'fa fa-map-marker' => '\f041',
			'fa fa-maxcdn' => '\f136',
			'fa fa-meanpath' => '\f20c',
			'fa fa-medkit' => '\f0fa',
			'fa fa-meh-o' => '\f11a',
			'fa fa-microphone' => '\f130',
			'fa fa-microphone-slash' => '\f131',
			'fa fa-minus' => '\f068',
			'fa fa-minus-circle' => '\f056',
			'fa fa-minus-square' => '\f146',
			'fa fa-minus-square-o' => '\f147',
			'fa fa-mobile' => '\f10b',
			'fa fa-money' => '\f0d6',
			'fa fa-moon-o' => '\f186',
			'fa fa-music' => '\f001',
			'fa fa-newspaper-o' => '\f1ea',
			'fa fa-openid' => '\f19b',
			'fa fa-outdent' => '\f03b',
			'fa fa-pagelines' => '\f18c',
			'fa fa-paint-brush' => '\f1fc',
			'fa fa-paper-plane' => '\f1d8',
			'fa fa-paper-plane-o' => '\f1d9',
			'fa fa-paperclip' => '\f0c6',
			'fa fa-paragraph' => '\f1dd',
			'fa fa-pause' => '\f04c',
			'fa fa-paw' => '\f1b0',
			'fa fa-paypal' => '\f1ed',
			'fa fa-pencil' => '\f040',
			'fa fa-pencil-square' => '\f14b',
			'fa fa-pencil-square-o' => '\f044',
			'fa fa-phone' => '\f095',
			'fa fa-phone-square' => '\f098',
			'fa fa-picture-o' => '\f03e',
			'fa fa-pie-chart' => '\f200',
			'fa fa-pied-piper' => '\f1a7',
			'fa fa-pied-piper-alt' => '\f1a8',
			'fa fa-pinterest' => '\f0d2',
			'fa fa-pinterest-square' => '\f0d3',
			'fa fa-plane' => '\f072',
			'fa fa-play' => '\f04b',
			'fa fa-play-circle' => '\f144',
			'fa fa-play-circle-o' => '\f01d',
			'fa fa-plug' => '\f1e6',
			'fa fa-plus' => '\f067',
			'fa fa-plus-circle' => '\f055',
			'fa fa-plus-square' => '\f0fe',
			'fa fa-plus-square-o' => '\f196',
			'fa fa-power-off' => '\f011',
			'fa fa-print' => '\f02f',
			'fa fa-puzzle-piece' => '\f12e',
			'fa fa-qq' => '\f1d6',
			'fa fa-qrcode' => '\f029',
			'fa fa-question' => '\f128',
			'fa fa-question-circle' => '\f059',
			'fa fa-quote-left' => '\f10d',
			'fa fa-quote-right' => '\f10e',
			'fa fa-random' => '\f074',
			'fa fa-rebel' => '\f1d0',
			'fa fa-recycle' => '\f1b8',
			'fa fa-reddit' => '\f1a1',
			'fa fa-reddit-square' => '\f1a2',
			'fa fa-refresh' => '\f021',
			'fa fa-renren' => '\f18b',
			'fa fa-repeat' => '\f01e',
			'fa fa-reply' => '\f112',
			'fa fa-reply-all' => '\f122',
			'fa fa-retweet' => '\f079',
			'fa fa-road' => '\f018',
			'fa fa-rocket' => '\f135',
			'fa fa-rss' => '\f09e',
			'fa fa-rss-square' => '\f143',
			'fa fa-rub' => '\f158',
			'fa fa-scissors' => '\f0c4',
			'fa fa-search' => '\f002',
			'fa fa-search-minus' => '\f010',
			'fa fa-search-plus' => '\f00e',
			'fa fa-share' => '\f064',
			'fa fa-share-alt' => '\f1e0',
			'fa fa-share-alt-square' => '\f1e1',
			'fa fa-share-square' => '\f14d',
			'fa fa-share-square-o' => '\f045',
			'fa fa-shield' => '\f132',
			'fa fa-shopping-cart' => '\f07a',
			'fa fa-sign-in' => '\f090',
			'fa fa-sign-out' => '\f08b',
			'fa fa-signal' => '\f012',
			'fa fa-sitemap' => '\f0e8',
			'fa fa-skype' => '\f17e',
			'fa fa-slack' => '\f198',
			'fa fa-sliders' => '\f1de',
			'fa fa-slideshare' => '\f1e7',
			'fa fa-smile-o' => '\f118',
			'fa fa-sort' => '\f0dc',
			'fa fa-sort-alpha-asc' => '\f15d',
			'fa fa-sort-alpha-desc' => '\f15e',
			'fa fa-sort-amount-asc' => '\f160',
			'fa fa-sort-amount-desc' => '\f161',
			'fa fa-sort-asc' => '\f0de',
			'fa fa-sort-desc' => '\f0dd',
			'fa fa-sort-numeric-asc' => '\f162',
			'fa fa-sort-numeric-desc' => '\f163',
			'fa fa-soundcloud' => '\f1be',
			'fa fa-space-shuttle' => '\f197',
			'fa fa-spinner' => '\f110',
			'fa fa-spoon' => '\f1b1',
			'fa fa-spotify' => '\f1bc',
			'fa fa-square' => '\f0c8',
			'fa fa-square-o' => '\f096',
			'fa fa-stack-exchange' => '\f18d',
			'fa fa-stack-overflow' => '\f16c',
			'fa fa-star' => '\f005',
			'fa fa-star-half' => '\f089',
			'fa fa-star-half-o' => '\f123',
			'fa fa-star-o' => '\f006',
			'fa fa-steam' => '\f1b6',
			'fa fa-steam-square' => '\f1b7',
			'fa fa-step-backward' => '\f048',
			'fa fa-step-forward' => '\f051',
			'fa fa-stethoscope' => '\f0f1',
			'fa fa-stop' => '\f04d',
			'fa fa-strikethrough' => '\f0cc',
			'fa fa-stumbleupon' => '\f1a4',
			'fa fa-stumbleupon-circle' => '\f1a3',
			'fa fa-subscript' => '\f12c',
			'fa fa-suitcase' => '\f0f2',
			'fa fa-sun-o' => '\f185',
			'fa fa-superscript' => '\f12b',
			'fa fa-table' => '\f0ce',
			'fa fa-tablet' => '\f10a',
			'fa fa-tachometer' => '\f0e4',
			'fa fa-tag' => '\f02b',
			'fa fa-tags' => '\f02c',
			'fa fa-tasks' => '\f0ae',
			'fa fa-taxi' => '\f1ba',
			'fa fa-tencent-weibo' => '\f1d5',
			'fa fa-terminal' => '\f120',
			'fa fa-text-height' => '\f034',
			'fa fa-text-width' => '\f035',
			'fa fa-th' => '\f00a',
			'fa fa-th-large' => '\f009',
			'fa fa-th-list' => '\f00b',
			'fa fa-thumb-tack' => '\f08d',
			'fa fa-thumbs-down' => '\f165',
			'fa fa-thumbs-o-down' => '\f088',
			'fa fa-thumbs-o-up' => '\f087',
			'fa fa-thumbs-up' => '\f164',
			'fa fa-ticket' => '\f145',
			'fa fa-times' => '\f00d',
			'fa fa-times-circle' => '\f057',
			'fa fa-times-circle-o' => '\f05c',
			'fa fa-tint' => '\f043',
			'fa fa-toggle-off' => '\f204',
			'fa fa-toggle-on' => '\f205',
			'fa fa-trash' => '\f1f8',
			'fa fa-trash-o' => '\f014',
			'fa fa-tree' => '\f1bb',
			'fa fa-trello' => '\f181',
			'fa fa-trophy' => '\f091',
			'fa fa-truck' => '\f0d1',
			'fa fa-try' => '\f195',
			'fa fa-tty' => '\f1e4',
			'fa fa-tumblr' => '\f173',
			'fa fa-tumblr-square' => '\f174',
			'fa fa-twitch' => '\f1e8',
			'fa fa-twitter' => '\f099',
			'fa fa-twitter-square' => '\f081',
			'fa fa-umbrella' => '\f0e9',
			'fa fa-underline' => '\f0cd',
			'fa fa-undo' => '\f0e2',
			'fa fa-university' => '\f19c',
			'fa fa-unlock' => '\f09c',
			'fa fa-unlock-alt' => '\f13e',
			'fa fa-upload' => '\f093',
			'fa fa-usd' => '\f155',
			'fa fa-user' => '\f007',
			'fa fa-user-md' => '\f0f0',
			'fa fa-users' => '\f0c0',
			'fa fa-video-camera' => '\f03d',
			'fa fa-vimeo-square' => '\f194',
			'fa fa-vine' => '\f1ca',
			'fa fa-vk' => '\f189',
			'fa fa-volume-down' => '\f027',
			'fa fa-volume-off' => '\f026',
			'fa fa-volume-up' => '\f028',
			'fa fa-weibo' => '\f18a',
			'fa fa-weixin' => '\f1d7',
			'fa fa-wheelchair' => '\f193',
			'fa fa-wifi' => '\f1eb',
			'fa fa-windows' => '\f17a',
			'fa fa-wordpress' => '\f19a',
			'fa fa-wrench' => '\f0ad',
			'fa fa-xing' => '\f168',
			'fa fa-xing-square' => '\f169',
			'fa fa-yahoo' => '\f19e',
			'fa fa-yelp' => '\f1e9',
			'fa fa-youtube' => '\f167',
			'fa fa-youtube-play' => '\f16a',
			'fa fa-youtube-square' => '\f166',
			'elegant_arrow_up' => '&#x21;',
			'elegant_arrow_down' => '&#x22;',
			'elegant_arrow_left' => '&#x23;',
			'elegant_arrow_right' => '&#x24;',
			'elegant_arrow_left-up' => '&#x25;',
			'elegant_arrow_right-up' => '&#x26;',
			'elegant_arrow_right-down' => '&#x27;',
			'elegant_arrow_left-down' => '&#x28;',
			'elegant_arrow-up-down' => '&#x29;',
			'elegant_arrow_up-down_alt' => '&#x2a;',
			'elegant_arrow_left-right_alt' => '&#x2b;',
			'elegant_arrow_left-right' => '&#x2c;',
			'elegant_arrow_expand_alt2' => '&#x2d;',
			'elegant_arrow_expand_alt' => '&#x2e;',
			'elegant_arrow_condense' => '&#x2f;',
			'elegant_arrow_expand' => '&#x30;',
			'elegant_arrow_move' => '&#x31;',
			'elegant_arrow_carrot-up' => '&#x32;',
			'elegant_arrow_carrot-down' => '&#x33;',
			'elegant_arrow_carrot-left' => '&#x34;',
			'elegant_arrow_carrot-right' => '&#x35;',
			'elegant_arrow_carrot-2up' => '&#x36;',
			'elegant_arrow_carrot-2down' => '&#x37;',
			'elegant_arrow_carrot-2left' => '&#x38;',
			'elegant_arrow_carrot-2right' => '&#x39;',
			'elegant_arrow_carrot-up_alt2' => '&#x3a;',
			'elegant_arrow_carrot-down_alt2' => '&#x3b;',
			'elegant_arrow_carrot-left_alt2' => '&#x3c;',
			'elegant_arrow_carrot-right_alt2' => '&#x3d;',
			'elegant_arrow_carrot-2up_alt2' => '&#x3e;',
			'elegant_arrow_carrot-2down_alt2' => '&#x3f;',
			'elegant_arrow_carrot-2left_alt2' => '&#x40;',
			'elegant_arrow_carrot-2right_alt2' => '&#x41;',
			'elegant_arrow_triangle-up' => '&#x42;',
			'elegant_arrow_triangle-down' => '&#x43;',
			'elegant_arrow_triangle-left' => '&#x44;',
			'elegant_arrow_triangle-right' => '&#x45;',
			'elegant_arrow_triangle-up_alt2' => '&#x46;',
			'elegant_arrow_triangle-down_alt2' => '&#x47;',
			'elegant_arrow_triangle-left_alt2' => '&#x48;',
			'elegant_arrow_triangle-right_alt2' => '&#x49;',
			'elegant_arrow_back' => '&#x4a;',
			'elegant_icon_minus-06' => '&#x4b;',
			'elegant_icon_plus' => '&#x4c;',
			'elegant_icon_close' => '&#x4d;',
			'elegant_icon_check' => '&#x4e;',
			'elegant_icon_minus_alt2' => '&#x4f;',
			'elegant_icon_plus_alt2' => '&#x50;',
			'elegant_icon_close_alt2' => '&#x51;',
			'elegant_icon_check_alt2' => '&#x52;',
			'elegant_icon_zoom-out_alt' => '&#x53;',
			'elegant_icon_zoom-in_alt' => '&#x54;',
			'elegant_icon_search' => '&#x55;',
			'elegant_icon_box-empty' => '&#x56;',
			'elegant_icon_box-selected' => '&#x57;',
			'elegant_icon_minus-box' => '&#x58;',
			'elegant_icon_plus-box' => '&#x59;',
			'elegant_icon_box-checked' => '&#x5a;',
			'elegant_icon_circle-empty' => '&#x5b;',
			'elegant_icon_circle-slelected' => '&#x5c;',
			'elegant_icon_stop_alt2' => '&#x5d;',
			'elegant_icon_stop' => '&#x5e;',
			'elegant_icon_pause_alt2' => '&#x5f;',
			'elegant_icon_pause' => '&#x60;',
			'elegant_icon_menu' => '&#x61;',
			'elegant_icon_menu-square_alt2' => '&#x62;',
			'elegant_icon_menu-circle_alt2' => '&#x63;',
			'elegant_icon_ul' => '&#x64;',
			'elegant_icon_ol' => '&#x65;',
			'elegant_icon_adjust-horiz' => '&#x66;',
			'elegant_icon_adjust-vert' => '&#x67;',
			'elegant_icon_document_alt' => '&#x68;',
			'elegant_icon_documents_alt' => '&#x69;',
			'elegant_icon_pencil' => '&#x6a;',
			'elegant_icon_pencil-edit_alt' => '&#x6b;',
			'elegant_icon_pencil-edit' => '&#x6c;',
			'elegant_icon_folder-alt' => '&#x6d;',
			'elegant_icon_folder-open_alt' => '&#x6e;',
			'elegant_icon_folder-add_alt' => '&#x6f;',
			'elegant_icon_info_alt' => '&#x70;',
			'elegant_icon_error-oct_alt' => '&#x71;',
			'elegant_icon_error-circle_alt' => '&#x72;',
			'elegant_icon_error-triangle_alt' => '&#x73;',
			'elegant_icon_question_alt2' => '&#x74;',
			'elegant_icon_question' => '&#x75;',
			'elegant_icon_comment_alt' => '&#x76;',
			'elegant_icon_chat_alt' => '&#x77;',
			'elegant_icon_vol-mute_alt' => '&#x78;',
			'elegant_icon_volume-low_alt' => '&#x79;',
			'elegant_icon_volume-high_alt' => '&#x7a;',
			'elegant_icon_quotations' => '&#x7b;',
			'elegant_icon_quotations_alt2' => '&#x7c;',
			'elegant_icon_clock_alt' => '&#x7d;',
			'elegant_icon_lock_alt' => '&#x7e;',
			'elegant_icon_lock-open_alt' => '&#xe000;',
			'elegant_icon_key_alt' => '&#xe001;',
			'elegant_icon_cloud_alt' => '&#xe002;',
			'elegant_icon_cloud-upload_alt' => '&#xe003;',
			'elegant_icon_cloud-download_alt' => '&#xe004;',
			'elegant_icon_image' => '&#xe005;',
			'elegant_icon_images' => '&#xe006;',
			'elegant_icon_lightbulb_alt' => '&#xe007;',
			'elegant_icon_gift_alt' => '&#xe008;',
			'elegant_icon_house_alt' => '&#xe009;',
			'elegant_icon_genius' => '&#xe00a;',
			'elegant_icon_mobile' => '&#xe00b;',
			'elegant_icon_tablet' => '&#xe00c;',
			'elegant_icon_laptop' => '&#xe00d;',
			'elegant_icon_desktop' => '&#xe00e;',
			'elegant_icon_camera_alt' => '&#xe00f;',
			'elegant_icon_mail_alt' => '&#xe010;',
			'elegant_icon_cone_alt' => '&#xe011;',
			'elegant_icon_ribbon_alt' => '&#xe012;',
			'elegant_icon_bag_alt' => '&#xe013;',
			'elegant_icon_creditcard' => '&#xe014;',
			'elegant_icon_cart_alt' => '&#xe015;',
			'elegant_icon_paperclip' => '&#xe016;',
			'elegant_icon_tag_alt' => '&#xe017;',
			'elegant_icon_tags_alt' => '&#xe018;',
			'elegant_icon_trash_alt' => '&#xe019;',
			'elegant_icon_cursor_alt' => '&#xe01a;',
			'elegant_icon_mic_alt' => '&#xe01b;',
			'elegant_icon_compass_alt' => '&#xe01c;',
			'elegant_icon_pin_alt' => '&#xe01d;',
			'elegant_icon_pushpin_alt' => '&#xe01e;',
			'elegant_icon_map_alt' => '&#xe01f;',
			'elegant_icon_drawer_alt' => '&#xe020;',
			'elegant_icon_toolbox_alt' => '&#xe021;',
			'elegant_icon_book_alt' => '&#xe022;',
			'elegant_icon_calendar' => '&#xe023;',
			'elegant_icon_film' => '&#xe024;',
			'elegant_icon_table' => '&#xe025;',
			'elegant_icon_contacts_alt' => '&#xe026;',
			'elegant_icon_headphones' => '&#xe027;',
			'elegant_icon_lifesaver' => '&#xe028;',
			'elegant_icon_piechart' => '&#xe029;',
			'elegant_icon_refresh' => '&#xe02a;',
			'elegant_icon_link_alt' => '&#xe02b;',
			'elegant_icon_link' => '&#xe02c;',
			'elegant_icon_loading' => '&#xe02d;',
			'elegant_icon_blocked' => '&#xe02e;',
			'elegant_icon_archive_alt' => '&#xe02f;',
			'elegant_icon_heart_alt' => '&#xe030;',
			'elegant_icon_star_alt' => '&#xe031;',
			'elegant_icon_star-half_alt' => '&#xe032;',
			'elegant_icon_star' => '&#xe033;',
			'elegant_icon_star-half' => '&#xe034;',
			'elegant_icon_tools' => '&#xe035;',
			'elegant_icon_tool' => '&#xe036;',
			'elegant_icon_cog' => '&#xe037;',
			'elegant_icon_cogs' => '&#xe038;',
			'elegant_arrow_up_alt' => '&#xe039;',
			'elegant_arrow_down_alt' => '&#xe03a;',
			'elegant_arrow_left_alt' => '&#xe03b;',
			'elegant_arrow_right_alt' => '&#xe03c;',
			'elegant_arrow_left-up_alt' => '&#xe03d;',
			'elegant_arrow_right-up_alt' => '&#xe03e;',
			'elegant_arrow_right-down_alt' => '&#xe03f;',
			'elegant_arrow_left-down_alt' => '&#xe040;',
			'elegant_arrow_condense_alt' => '&#xe041;',
			'elegant_arrow_expand_alt3' => '&#xe042;',
			'elegant_arrow_carrot_up_alt' => '&#xe043;',
			'elegant_arrow_carrot-down_alt' => '&#xe044;',
			'elegant_arrow_carrot-left_alt' => '&#xe045;',
			'elegant_arrow_carrot-right_alt' => '&#xe046;',
			'elegant_arrow_carrot-2up_alt' => '&#xe047;',
			'elegant_arrow_carrot-2dwnn_alt' => '&#xe048;',
			'elegant_arrow_carrot-2left_alt' => '&#xe049;',
			'elegant_arrow_carrot-2right_alt' => '&#xe04a;',
			'elegant_arrow_triangle-up_alt' => '&#xe04b;',
			'elegant_arrow_triangle-down_alt' => '&#xe04c;',
			'elegant_arrow_triangle-left_alt' => '&#xe04d;',
			'elegant_arrow_triangle-right_alt' => '&#xe04e;',
			'elegant_icon_minus_alt' => '&#xe04f;',
			'elegant_icon_plus_alt' => '&#xe050;',
			'elegant_icon_close_alt' => '&#xe051;',
			'elegant_icon_check_alt' => '&#xe052;',
			'elegant_icon_zoom-out' => '&#xe053;',
			'elegant_icon_zoom-in' => '&#xe054;',
			'elegant_icon_stop_alt' => '&#xe055;',
			'elegant_icon_menu-square_alt' => '&#xe056;',
			'elegant_icon_menu-circle_alt' => '&#xe057;',
			'elegant_icon_document' => '&#xe058;',
			'elegant_icon_documents' => '&#xe059;',
			'elegant_icon_pencil_alt' => '&#xe05a;',
			'elegant_icon_folder' => '&#xe05b;',
			'elegant_icon_folder-open' => '&#xe05c;',
			'elegant_icon_folder-add' => '&#xe05d;',
			'elegant_icon_folder_upload' => '&#xe05e;',
			'elegant_icon_folder_download' => '&#xe05f;',
			'elegant_icon_info' => '&#xe060;',
			'elegant_icon_error-circle' => '&#xe061;',
			'elegant_icon_error-oct' => '&#xe062;',
			'elegant_icon_error-triangle' => '&#xe063;',
			'elegant_icon_question_alt' => '&#xe064;',
			'elegant_icon_comment' => '&#xe065;',
			'elegant_icon_chat' => '&#xe066;',
			'elegant_icon_vol-mute' => '&#xe067;',
			'elegant_icon_volume-low' => '&#xe068;',
			'elegant_icon_volume-high' => '&#xe069;',
			'elegant_icon_quotations_alt' => '&#xe06a;',
			'elegant_icon_clock' => '&#xe06b;',
			'elegant_icon_lock' => '&#xe06c;',
			'elegant_icon_lock-open' => '&#xe06d;',
			'elegant_icon_key' => '&#xe06e;',
			'elegant_icon_cloud' => '&#xe06f;',
			'elegant_icon_cloud-upload' => '&#xe070;',
			'elegant_icon_cloud-download' => '&#xe071;',
			'elegant_icon_lightbulb' => '&#xe072;',
			'elegant_icon_gift' => '&#xe073;',
			'elegant_icon_house' => '&#xe074;',
			'elegant_icon_camera' => '&#xe075;',
			'elegant_icon_mail' => '&#xe076;',
			'elegant_icon_cone' => '&#xe077;',
			'elegant_icon_ribbon' => '&#xe078;',
			'elegant_icon_bag' => '&#xe079;',
			'elegant_icon_cart' => '&#xe07a;',
			'elegant_icon_tag' => '&#xe07b;',
			'elegant_icon_tags' => '&#xe07c;',
			'elegant_icon_trash' => '&#xe07d;',
			'elegant_icon_cursor' => '&#xe07e;',
			'elegant_icon_mic' => '&#xe07f;',
			'elegant_icon_compass' => '&#xe080;',
			'elegant_icon_pin' => '&#xe081;',
			'elegant_icon_pushpin' => '&#xe082;',
			'elegant_icon_map' => '&#xe083;',
			'elegant_icon_drawer' => '&#xe084;',
			'elegant_icon_toolbox' => '&#xe085;',
			'elegant_icon_book' => '&#xe086;',
			'elegant_icon_contacts' => '&#xe087;',
			'elegant_icon_archive' => '&#xe088;',
			'elegant_icon_heart' => '&#xe089;',
			'elegant_icon_profile' => '&#xe08a;',
			'elegant_icon_group' => '&#xe08b;',
			'elegant_icon_grid-2x2' => '&#xe08c;',
			'elegant_icon_grid-3x3' => '&#xe08d;',
			'elegant_icon_music' => '&#xe08e;',
			'elegant_icon_pause_alt' => '&#xe08f;',
			'elegant_icon_phone' => '&#xe090;',
			'elegant_icon_upload' => '&#xe091;',
			'elegant_icon_download' => '&#xe092;',
			'elegant_social_facebook' => '&#xe093;',
			'elegant_social_twitter' => '&#xe094;',
			'elegant_social_pinterest' => '&#xe095;',
			'elegant_social_googleplus' => '&#xe096;',
			'elegant_social_tumblr' => '&#xe097;',
			'elegant_social_tumbleupon' => '&#xe098;',
			'elegant_social_wordpress' => '&#xe099;',
			'elegant_social_instagram' => '&#xe09a;',
			'elegant_social_dribbble' => '&#xe09b;',
			'elegant_social_vimeo' => '&#xe09c;',
			'elegant_social_linkedin' => '&#xe09d;',
			'elegant_social_rss' => '&#xe09e;',
			'elegant_social_deviantart' => '&#xe09f;',
			'elegant_social_share' => '&#xe0a0;',
			'elegant_social_myspace' => '&#xe0a1;',
			'elegant_social_skype' => '&#xe0a2;',
			'elegant_social_youtube' => '&#xe0a3;',
			'elegant_social_picassa' => '&#xe0a4;',
			'elegant_social_googledrive' => '&#xe0a5;',
			'elegant_social_flickr' => '&#xe0a6;',
			'elegant_social_blogger' => '&#xe0a7;',
			'elegant_social_spotify' => '&#xe0a8;',
			'elegant_social_delicious' => '&#xe0a9;',
			'elegant_social_facebook_circle' => '&#xe0aa;',
			'elegant_social_twitter_circle' => '&#xe0ab;',
			'elegant_social_pinterest_circle' => '&#xe0ac;',
			'elegant_social_googleplus_circle' => '&#xe0ad;',
			'elegant_social_tumblr_circle' => '&#xe0ae;',
			'elegant_social_stumbleupon_circle' => '&#xe0af;',
			'elegant_social_wordpress_circle' => '&#xe0b0;',
			'elegant_social_instagram_circle' => '&#xe0b1;',
			'elegant_social_dribbble_circle' => '&#xe0b2;',
			'elegant_social_vimeo_circle' => '&#xe0b3;',
			'elegant_social_linkedin_circle' => '&#xe0b4;',
			'elegant_social_rss_circle' => '&#xe0b5;',
			'elegant_social_deviantart_circle' => '&#xe0b6;',
			'elegant_social_share_circle' => '&#xe0b7;',
			'elegant_social_myspace_circle' => '&#xe0b8;',
			'elegant_social_skype_circle' => '&#xe0b9;',
			'elegant_social_youtube_circle' => '&#xe0ba;',
			'elegant_social_picassa_circle' => '&#xe0bb;',
			'elegant_social_googledrive_alt2' => '&#xe0bc;',
			'elegant_social_flickr_circle' => '&#xe0bd;',
			'elegant_social_blogger_circle' => '&#xe0be;',
			'elegant_social_spotify_circle' => '&#xe0bf;',
			'elegant_social_delicious_circle' => '&#xe0c0;',
			'elegant_social_facebook_square' => '&#xe0c1;',
			'elegant_social_twitter_square' => '&#xe0c2;',
			'elegant_social_pinterest_square' => '&#xe0c3;',
			'elegant_social_googleplus_square' => '&#xe0c4;',
			'elegant_social_tumblr_square' => '&#xe0c5;',
			'elegant_social_stumbleupon_square' => '&#xe0c6;',
			'elegant_social_wordpress_square' => '&#xe0c7;',
			'elegant_social_instagram_square' => '&#xe0c8;',
			'elegant_social_dribbble_square' => '&#xe0c9;',
			'elegant_social_vimeo_square' => '&#xe0ca;',
			'elegant_social_linkedin_square' => '&#xe0cb;',
			'elegant_social_rss_square' => '&#xe0cc;',
			'elegant_social_deviantart_square' => '&#xe0cd;',
			'elegant_social_share_square' => '&#xe0ce;',
			'elegant_social_myspace_square' => '&#xe0cf;',
			'elegant_social_skype_square' => '&#xe0d0;',
			'elegant_social_youtube_square' => '&#xe0d1;',
			'elegant_social_picassa_square' => '&#xe0d2;',
			'elegant_social_googledrive_square' => '&#xe0d3;',
			'elegant_social_flickr_square' => '&#xe0d4;',
			'elegant_social_blogger_square' => '&#xe0d5;',
			'elegant_social_spotify_square' => '&#xe0d6;',
			'elegant_social_delicious_square' => '&#xe0d7;',
			'elegant_icon_printer' => '&#xe103;',
			'elegant_icon_calulator' => '&#xe0ee;',
			'elegant_icon_building' => '&#xe0ef;',
			'elegant_icon_floppy' => '&#xe0e8;',
			'elegant_icon_drive' => '&#xe0ea;',
			'elegant_icon_search-2' => '&#xe101;',
			'elegant_icon_id' => '&#xe107;',
			'elegant_icon_id-2' => '&#xe108;',
			'elegant_icon_puzzle' => '&#xe102;',
			'elegant_icon_like' => '&#xe106;',
			'elegant_icon_dislike' => '&#xe0eb;',
			'elegant_icon_mug' => '&#xe105;',
			'elegant_icon_currency' => '&#xe0ed;',
			'elegant_icon_wallet' => '&#xe100;',
			'elegant_icon_pens' => '&#xe104;',
			'elegant_icon_easel' => '&#xe0e9;',
			'elegant_icon_flowchart' => '&#xe109;',
			'elegant_icon_datareport' => '&#xe0ec;',
			'elegant_icon_briefcase' => '&#xe0fe;',
			'elegant_icon_shield' => '&#xe0f6;',
			'elegant_icon_percent' => '&#xe0fb;',
			'elegant_icon_globe' => '&#xe0e2;',
			'elegant_icon_globe-2' => '&#xe0e3;',
			'elegant_icon_target' => '&#xe0f5;',
			'elegant_icon_hourglass' => '&#xe0e1;',
			'elegant_icon_balance' => '&#xe0ff;',
			'elegant_icon_rook' => '&#xe0f8;',
			'elegant_icon_printer-alt' => '&#xe0fa;',
			'elegant_icon_calculator_alt' => '&#xe0e7;',
			'elegant_icon_building_alt' => '&#xe0fd;',
			'elegant_icon_floppy_alt' => '&#xe0e4;',
			'elegant_icon_drive_alt' => '&#xe0e5;',
			'elegant_icon_search_alt' => '&#xe0f7;',
			'elegant_icon_id_alt' => '&#xe0e0;',
			'elegant_icon_id-2_alt' => '&#xe0fc;',
			'elegant_icon_puzzle_alt' => '&#xe0f9;',
			'elegant_icon_like_alt' => '&#xe0dd;',
			'elegant_icon_dislike_alt' => '&#xe0f1;',
			'elegant_icon_mug_alt' => '&#xe0dc;',
			'elegant_icon_currency_alt' => '&#xe0f3;',
			'elegant_icon_wallet_alt' => '&#xe0d8;',
			'elegant_icon_pens_alt' => '&#xe0db;',
			'elegant_icon_easel_alt' => '&#xe0f0;',
			'elegant_icon_flowchart_alt' => '&#xe0df;',
			'elegant_icon_datareport_alt' => '&#xe0f2;',
			'elegant_icon_briefcase_alt' => '&#xe0f4;',
			'elegant_icon_shield_alt' => '&#xe0d9;',
			'elegant_icon_percent_alt' => '&#xe0da;',
			'elegant_icon_globe_alt' => '&#xe0de;',
			'elegant_icon_clipboard' => '&#xe0e6;'
	);
	$font_awesome = apply_filters('dh_font_awesome_options', $font_awesome);
	if(!$none_select)
		array_shift($font_awesome);
	
	
	$options = array();
	foreach ($font_awesome as $key=>$content){
		$text_val = str_replace('fa ', '', $key);
		$text_val = str_replace(array('_','-'), ' ', $text_val);
		$value = $key;
		if($content == 'none')
			$value = '';
		
		$options[$text_val] = $value;
	}
	return $options;
}

function dh_landing_hero_content(){
	ob_start();
	?>
	<div class="heading-hero-content parallax-content">
		<div class="heading-hero-top-title"><?php esc_html_e('Welcome to','sitesao')?></div>
		<div class="heading-hero-title"><?php esc_html_e('Vicky Restaurant','sitesao')?></div>
		<div class="heading-hero-bottom-title"><?php esc_html_e('A premium Restaurant WordPress theme','sitesao')?></div>
		<div class="heading-page-icon">
			<span class="soups"></span>
			<span class="chicken"></span>
			<span class="dizhes"></span>
		</div>
	</div>
	<?php
	return apply_filters('dh_landing_hero_content', ob_get_clean());
}