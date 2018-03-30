<?php
global $customize,$is_customize_mode;

function isHeaderBlog()
{
	$data = get_option(apply_filters('get_option',THEME_OPTIONS_NAME));
	echo '<pre>';
		var_dump($data);
	echo '</pre>';
}
// isHeaderBlog();
function displayLogo(){
	$data = get_option(apply_filters('get_option',THEME_OPTIONS_NAME));
	$logo = $data['logo']['image'];
	$with_1 = '';
	if($data['logo']['image_width'] != ''){
		$with_1 = 'width: '.$data['logo']['image_width'].'px;';
	}
	$height_1 = '';
	if($data['logo']['image_height']){
		$height_1 = 'height: '.$data['logo']['image_height'].'px';
	}
	$style_1 = '';
	if($with_1 != '' || $height_1 != ''){
		$style_1 = 'style="'.$with_1.$height_1.'"';
	}
	$logo_stickey = $data['logo_stickey']['image'];
	$with_2 = '';
	if($data['logo_stickey']['image_width']!= ''){
		$with_2 = 'width: '.$data['logo_stickey']['image_width'].'px;';
	}
	$height_2 = '';
	if($data['logo_stickey']['image_height'] != ''){
		$height_2 = 'height: '.$data['logo_stickey']['image_height'].'px';
	}
	$style_2 = '';
	if($with_2!='' || $height_2 != ''){
		$style_2 = 'style="'.$with_2.$height_2.'"';
	}
	
	?>
	<h1 class="logo">
		<?php if($logo!='') : ?>
       		<a href="<?php echo home_url(); ?>" <?php echo $style_1; ?> class="logo-image" title="<?php bloginfo('name') ?>"><img src="<?php echo esc_url($logo); ?>"></a>
       	<?php endif; ?>
       	<?php if($logo_stickey!='') : ?>
        	<a href="<?php echo home_url(); ?>" <?php echo $style_2; ?> class="logo-image-sticky" title="<?php bloginfo('name') ?>"><img src="<?php echo esc_url($logo_stickey); ?>"></a>
        <?php endif; ?>
    </h1>
    <?php
}

function displayPreloadLogo(){
    $name = apply_filters('awe_get_option_by_lang',THEME_OPTIONS_NAME);
	$data = get_option($name);
	$logo_1 = $data['logo_preload_1']['image'];
	$logo_2 = $data['logo_preload_2']['image'];
	$enable_preload = 1;
	if(array_key_exists('enable_preload', $data['extra']))
	{
		$enable_preload = $data['extra']['enable_preload'];
	}
	if($enable_preload) :
	?>
		<div id="preloader">
	        <div class="inner">
	            <div class="image">
	                <img class="img1" src="<?php echo esc_url($logo_1) ?>" alt="">
	                <img class="img2" src="<?php echo esc_url($logo_2) ?>" alt="">
	            </div>
	            <div class="circle-ef"></div>
	        </div>
	    </div>
	<?php
	endif;
}


function displaySectionInCustomize($section){
	global $customize,$is_customize_mode;
	if($customize[$section]['show'] == 0 && $is_customize_mode) return 'style="display:none"';

}

function displaySectionHeaderInCustomize($section){
	global $customize,$is_customize_mode;
	if($customize[$section]['header']['enable'] == 0 && $is_customize_mode) return 'style="display:none"';
}

function headerStyle($section){
	global $customize;
	echo $customize[$section]['header']['style'];
}

//====== display header from customize //

function displayHeader($section){
	global $customize,$is_customize_mode;
	if($customize[$section]['header']['enable'] || $is_customize_mode) :
	?>
	<div class="col-xs-12" <?php echo displaySectionHeaderInCustomize($section); ?> >
        <div class="awe-header wow <?php if(isset($customize[$section]['header']['animation']) && !empty($customize[$section]['header']['animation'])) echo $customize[$section]['header']['animation']; ?> js-header" data-wow-duration="0.6s" data-wow-delay="0.6s" data-animate="<?php if(isset($customize[$section]['header']['animation']) && !empty($customize[$section]['header']['animation'])) echo $customize[$section]['header']['animation']; ?>">
            <h2 class="js-title <?php echo $customize[$section]['header']['style']; ?>"><?php echo $customize[$section]['header']['title']; ?></h2>
            <?php if($customize[$section]['header']['subtitle']['enable'] || $is_customize_mode) : ?>
            	<p class="js-desc" <?php if($customize[$section]['header']['subtitle']['enable']==0 && $is_customize_mode) echo 'style="display:none"'; ?> ><?php echo $customize[$section]['header']['subtitle']['text'] ?></p>
            <?php endif; ?>
        </div>
    </div>
	<?php
	endif;
}

function skillColor(){
	global $customize;
	if($customize['style_color']=='custom') echo $customize['style_color_custom'];
	else echo $customize['style_color'];
}

function joinTeam(){
	global $customize,$is_customize_mode;
	if($customize['team']['content']['join'] == 0 && $is_customize_mode){
		echo 'style="display:none"';
	}
}

function joinTeamWow(){
	global $customize,$is_customize_mode;
	if($customize['team']['content']['join'] == 0 && $is_customize_mode){
		echo '';
	}else{
		echo 'wow';
	}
}

function contentSlider($section){
	global $customize;
	if(isset($customize[$section]['slider'])){
		$slider = json_decode($customize[$section]['slider']);

		if($slider->enable){
			echo $section.'-slider';
		}
	}
}
function hasSlider($section)
{
	global $customize;
	if(isset($customize[$section]['slider'])){
		$slider = json_decode($customize[$section]['slider']);

		if($slider->enable==0){
			if($section == 'pricing'){
				echo 'col-sm-4';
			}else{
				echo 'col-xs-6 col-md-3';
			}
		}
	}
}
function sliderCols($section){
	global $customize;
	if(isset($customize[$section]['slider'])){
		$slider = json_decode($customize[$section]['slider']);

		if($slider->enable){
			echo 'data-num="'.$slider->num.'"';
		}
	}	
}
function background_show($section){
	global $customize;
	//echo $customize[$session]['session_background'];
	$background = json_decode( urldecode($customize[$section]) );
																					
	if($background->type == 'video'){ 
		$url = $background->video->url;
		//parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$autoPlay = $background->video->autoplay;
		$loop = $background->video->loop;
		$mute = $background->video->mute;
	?>
		<div class="fullscreen-media video">
          <div id="bg-video" class="fullscreen-video" data-property="{videoURL:'<?php echo $url; ?>',containment:'.fullscreen-media', showControls:false, autoPlay:<?php echo $autoPlay; ?>, loop:<?php echo $loop; ?>, mute:<?php echo $mute; ?>, startAt:0, opacity:1, addRaster:false, quality:'default'}"></div>
          
        </div>
        
	<?php
	}
	if($background->type == 'slider'){ 
		$slider = $background->slider;
		echo '<div class="fullscreen-media slides" data-transition="'.$slider->transition.'" data-speed="'.$slider->speed.'" >';
        echo '<div class="slides-container">';
		foreach ($slider->images as $value) {
			echo '<img src="'.$value.'" alt="img alt">';
		}
		echo '</div></div>';
	}
	if($background->type == 'static'){
		$img = $background->static->image;
		echo '<div class="fullscreen-media" style="background-image: url('.$img.')"></div>';
	}
	if($background->type == 'color'){
		echo '';
	}

}

function clientItem(){
	global $customize;
	$slider = json_decode($customize['client']['slider']);
	if($slider->enable==0){
		echo 'item';
	}
}

//=========== display background color ============//
function display_background_color($section){
	global $customize;
	$background = json_decode(urldecode($customize[$section]));
	if($background->type == 'color'){
		echo 'style="background-color: '.$background->color.'"';
	}
	if($background->type == 'video' && $background->video->placeholder == 1){
		echo 'style="background-image: url('.$background->video->video_place_holder.')"';
	}
}

function display_blog_background(){
	global $customize;
	$background = json_decode(urldecode($customize['blog_bg']));
	echo 'style="background-image: url('.$background->static->image.')"';
}

//=========== display customize background ========//

function display_background_css($section){
	global $customize,$is_customize_mode;
	if( isset($customize[$section]['parallax']) ){
		$background = json_decode($customize[$section]['parallax'],true);
		//var_dump($background);
		$tranparent = '';
		$display = '';
		if($customize[$section]['show']==0 && $is_customize_mode) $display = "display: none";
		if($background['enable']){
			if($background['image'] == ''){
				echo 'style="background-color: '.$background['color'].';'.$display.'"';
			}else{
				if($background['transparent'] != '') $transparent = 'background-color: '.$background['transparent'];
				echo 'style="background-image: url('.$background['image'].'); background-size:cover; '.$display.'"';
			}
		}else{
			echo 'style="'.$display.'"';
		}
	}elseif( $is_customize_mode && $customize[$section]['show'] ==0 ){
		echo 'style="display:none"';
	}
}
//======== Animation of header content footer ===============//
function animationHeader($section)
{
	global $customize;
	echo $customize[$section]['header']['animation'];
}
function animationContent($section){
	global $customize;
	echo $customize[$section]['content']['animation'];
}
function animationFooter($section){
	global $customize;
	echo $customize[$section]['footer']['animation'];
}
//=========== display overlay =====================//

function display_overlay($section){			
	global $customize;
	//var_dump($customize[$session]);
	$background = json_decode(urldecode($customize[$section]));
	if($background->overlay->enable == "1"){
		$pattern = $color = '';
		if( in_array('pattern', $background->overlay->type ) ){
			$img = $background->overlay->pattern;
			$pattern = "background-image: url($img);";
		}
		if( in_array('color', $background->overlay->type) )
		{
			$color = $background->overlay->color;
			$color="background-color: $color";
		}
		echo '<div class="awe-overlay-bg" style="'.$pattern.' '.$color.'"></div>';
	}
	$style = '';
	if($section == 'intro_bg_data'){
		if($background->video->autoplay){
			$style = "style='display: inline-block'";
		}else{
			$style = "style='display: none'";
		}
		if($background->type == 'video'){
		?>
		<div class="pause-volume">
	        <a class="pause-btn" <?php echo $style; ?> onclick="jQuery('.fullscreen-video').pauseYTP()">
	            <span class="fa fa-pause"></span>
	        </a>
	        <a class="volume-btn" <?php echo $style; ?> onclick="jQuery('#bg-video').setYTPVolume(100)">
	            <span class="fa fa-volume-off"></span>
	        </a>
	    </div>
		<?php
		}
	}
	//var_dump($background->parallax->tranparent);
}


//================= display overlay of section ==========================//

function sectionOverLay($section){
	global $customize;
	if(isset($customize[$section]['overlay'])){
		$overlay = json_decode(urldecode($customize[$section]['overlay']));
		if($overlay->enable == "1"){
			$pattern = $color = '';
			if( in_array('pattern', $overlay->type ) ){
				$img = $overlay->pattern;
				$pattern = "background-image: url($img);";
			}
			if( in_array('color', $overlay->type) )
			{
				$color = $overlay->color;
				$color="background-color: $color";
			}
			echo '<div class="awe-overlay-bg" style="'.$pattern.' '.$color.'"></div>';
		}
	}

}

//================= Display Section Footer ===============================//

function sectionFooter($section){
	global $customize,$is_customize_mode;
	if(isset($customize[$section]['footer'])) :
		$footer = $customize[$section]['footer'];
		$wow = '';
		$style = '';
		if($footer['enable'] == 0 && $is_customize_mode)
		{
			//$wow = '';
			$style='style="display:none"';
		}else
		{
			$wow = 'wow';
			//$style='';
		}
		if($footer['enable'] || $is_customize_mode){ ?>
		<div class="js-footer col-xs-12 do-you-love-us-yet <?php echo $wow.' '; echo $footer['animation']; ?>" data-wow-delay="1s" data-animate="<?php echo $footer['animation']; ?>" <?php echo $style; ?>>
            <div class="awe-footer">
            <?php if($footer['title']['enable'] == 1 || $is_customize_mode) : ?>
                <h3 class="js-footer-title" <?php display_in_customize($footer['title']['enable']) ?>><?php echo $footer['title']['text']; ?></h3>
            <?php endif; // end title ?>
            <?php if($footer['subtitle']['enable'] == 1 || $is_customize_mode) : ?>
                <span class="js-footer-subtitle" <?php display_in_customize($footer['subtitle']['enable']) ?>><?php echo $footer['subtitle']['text'] ?></span>
            <?php endif; // end subtitle ?>
            <?php if($footer['desc']['enable'] == 1 || $is_customize_mode) : ?>
            	<p class="js-footer-desc" <?php display_in_customize($footer['desc']['enable']) ?> ><?php echo $footer['desc']['text']; ?></p>
            <?php endif; // end description  ?>
            <?php if($footer['button']['enable'] == 1 || $is_customize_mode) : ?>
                <a class="awe-button js-footer-button" <?php display_in_customize($footer['button']['enable']) ?> href="<?php echo $footer['button']['link'] ?>"><?php echo $footer['button']['text']; ?></a>
            <?php endif; // end button ?>
            </div>
        </div>
	<?php } // end footer enable
	endif;
}

// ================ header content slide display function ================//

function display_in_customize($boolean){
	global $is_customize_mode;
	if($is_customize_mode && $boolean == 0) echo 'style="display:none"';
}

function display_intro_content($section,$section_bg){
	global $customize,$is_customize_mode;
	$content = json_decode(urldecode($customize[$section]));
	$slogan = $content->slogan;
	if($slogan->enable == 1 || $is_customize_mode){
	if($slogan->type == "slider"){
		?>
		<div <?php if(!$is_customize_mode || $slogan->enable == 1) echo 'id="owl-banner"'; display_in_customize($slogan->enable); ?> class="col-xs-12 js-slide-content" data-transition="<?php echo $slogan->transition; ?>" data-speed="<?php echo $slogan->speed; ?>">
	        <!-- Content 1 -->
	        <?php if( is_array( $slogan->slider_text ) ): 
	        foreach ($slogan->slider_text as $value) {
	        	echo '<div class="item"><h2>'.$value.'</h2></div>';
	        }
	        endif;
	        ?>
	    </div>
	<?php 
		}else{ ?>
			<div class="col-xs-12 js-slide-content" <?php display_in_customize($slogan->enable); ?>>
				<div class="item">
					<?php echo '<h2>'.$slogan->static_text.'</h2>'; ?>
				</div>
			</div>
		<?php }// end slogan
	}
	if($content->button->enable == 1 || $is_customize_mode){ ?>
		<h3 class="js-intro-desc" <?php display_in_customize($content->button->enable); ?> ><?php echo $content->button->text; ?></h3>
	<?php 
	//var_dump($content);
	}
	if($section_bg == 'intro_bg_data'){
		//echo "sadasdas0";
		$video = json_decode(urldecode($customize[$section_bg]));
		$style = '';
		if($video->video->autoplay){
			$style = 'style="display:none"';
		}
		if($video->type == 'video'){
		?>
			<a class="play-btn" <?php echo $style; ?> onclick="jQuery('.fullscreen-video').playYTP()">
	            <span class="fa fa-play"></span>
	        </a>

		<?php
		}
	}
}

//==================== About section ============================//
//==================== get the content ==============================//

function getAboutContent(){
	global $customize;
	//echo $customize['aboutus'];
	$about = get_posts(array( 'post_type' => 'awe_aboutus','id'=>$customize['aboutus'] ));
	var_dump($about);
	// // while ($about->have_posts()) {
	// //   	$about->the_post();
	// //   }
	?>
	<div class="col-xs-12 wow swing" data-wow-duration="0.4s" data-wow-delay="0.4s">
        <div class="awe-header">
            <h2 class="line-top"><?php echo $about['post_title']; ?></h2>
        </div>
    </div>


    <!-- Text and a Button -->
    <div class="col-sm-7 title wow fadeInUp" data-wow-duration="0.6s" data-wow-delay="0.6s">

        <?php
        $content = $about->post_content; 
        $content = apply_filters('the_content', $content);
        echo $content;
        ?>
        <a href="" class="awe-button" title="Our work">Our work</a>
    </div>
                <!-- Image Mobile -->
    <div class="about-img">
        <img src="<?php echo get_template_directory_uri() ?>/assets/images/about/img-1.png" alt="">
    </div>
<?php
	//}
}


?>