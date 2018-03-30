<?php
/**
 *  visual composer things
 *
 * @package toranj theme
 * @author owwwlab
 */

// don't load directly
if (!defined('ABSPATH')) die('-1');

/**
 * class to extend visual composer.
 *
 * @since 1.0.0
 *
 * @package TORANJ
 * @author  owwwlab
 */

 class Owlab_vc_extend {

 	/**
	 * list of shortcodes to add to vc
	 *
	 * @since 1.0.0
	 */
   	public $shortcodes;

    public $inline_js='';


     /**
     * ----------------------------------------------------------------------------------------
     * Primary class constructor.
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     */
    public function __construct($shortcodes='') {

    	// grab shortcodes array
    	$this->shortcodes = $shortcodes;


		// We safely integrate with VC with this hook
		add_action( 'init', array( $this, 'integrateWithVC' ) );

		// Use this when creating a shortcode addon
		$this->add_all_shortcodes();

		// Register CSS and JS
		add_action( 'wp_enqueue_scripts', array( $this, 'loadCssAndJs' ) );

    }


    /**
    * ----------------------------------------------------------------------------------------
     * adds all shortcode css and js to the page
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function loadCssAndJs() {

        //enqueue styles here

    }

    /**
     * ----------------------------------------------------------------------------------------
     * remove vc elements
     * ----------------------------------------------------------------------------------------
     * @since 1.0.0
     * @param  void
     * @return void
     */
    public function remove_core_shortcodes(){
        vc_remove_element("vc_posts_grid");
        vc_remove_element("vc_carousel");
        vc_remove_element("vc_posts_slider");
        vc_remove_element("vc_cta_button");
        vc_remove_element("vc_cta_button2");
        //vc_remove_element("vc_video");
    }




    /**
    * ----------------------------------------------------------------------------------------
    * Show notice if your plugin is activated but Visual Composer is not
    * ----------------------------------------------------------------------------------------
    * @since 1.0.0
    * @param  void
    * @return void
    */
    // public function showVcVersionNotice() {
    //     $plugin_data = get_plugin_data(__FILE__);
    //     echo '
    //     <div class="updated is-dismissable">
    //       <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'toranj'), $plugin_data['Name']).'</p>
    //     </div>';
    // }


    /**
     * ----------------------------------------------------------------------------------------
     * integrate settings and maps with vc
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param  void
     * @return void
     */
    public function integrateWithVC() {

        //Check if Visual Composer is installed
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            // Display notice that Visual Compser is required
            //add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }



        //map all custom shortcodes
        if ( is_array($this->shortcodes) ){
        	foreach ($this->shortcodes as $sc_name => $sc_array) {
	        	vc_map($sc_array);

	        }
        }

        // remove unvanted
        $this->remove_core_shortcodes();


    }


    /**
     * ----------------------------------------------------------------------------------------
     * adds all shortcodes to wp
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param  void
     * @return void
     */
    public function add_all_shortcodes() {

        if ( ! defined( 'WPB_VC_VERSION' ) )
            return;

    	if ( is_array($this->shortcodes) ){
	    	foreach ($this->shortcodes as $sc_name => $sc_array) {
	    		add_shortcode( $sc_array['base'], array( $this, 'render_'.$sc_name ) );
	    	}
        }
    }


    /**
     * ----------------------------------------------------------------------------------------
     * helper class
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param  void
     * @return void
     */
    public static function getExtraClass( $el_class ) {
		$output = '';
		if ( $el_class != '' ) {
			$output = " " . str_replace( ".", "", $el_class );
		}
		return $output;
	}

    /**
     * ----------------------------------------------------------------------------------------
     * Render the shortcode
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_FontawesomeIcon($atts, $content = null) {

		extract(shortcode_atts(array(
			'icon_class' 	=>'fa-heart',
			'icon_size'		=>'20',
			'icon_color' 	=>'',
			'icon_display'	=>'block',
			'icon_align'	=>'center'

		), $atts));


		$output ='<i class="fa '.$icon_class.'" style="color:'.$icon_color.';font-size:'.$icon_size.'px ;display:'.$icon_display.';text-align:'.$icon_align.'"></i>';

		return $output;

    }

    /**
     * ----------------------------------------------------------------------------------------
     * IconBox
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_IconBox($atts, $content = null) {

       extract(shortcode_atts(array(
			'title' 	=>'enter your title',
			'style' 	=>'simple',
			'icon'		=>'fa-heart'

		), $atts));

    	switch ($style) {
    		case 'simple':
    			$class = "icon-box";
    			break;

    		case 'boxed':
    			$class ="icon-box ib-boxed";
    			break;

    		case 'center':
    			$class = "icon-box ib-center ib-boxed";
    			break;

    		default:
    			$class = "icon-box";
    			break;
    	}

       	$output = '<div class="'.esc_html( $class ).'">
						<i class="ib-icon fa '.esc_html( $icon ).'"></i>
						<h4 class="title">'.esc_html( $title ).'</h4>
						<div class="contents">
							'.$content.'
						</div>
					</div>';



    	return $output;

    }


    /**
    * ----------------------------------------------------------------------------------------
     * CallToAction
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_CallToAction($atts, $content = null) {

       extract(shortcode_atts(array(
			'text' 			=> 'Let\'s See How We Can Make You A Cup Of Tea!',
			'text_font' 	=> 18,
			'btn_text'		=> 'Contact us',
			'btn_url'		=> '#',

		), $atts));

    	if ($text_font != ''){
    		$size = "style='".intval($text_font)."px;'";
    	}

    	$url = vc_build_link($btn_url);
    	$href = $url['url'];
    	$target = $url['target'];

       	$output = '<div class="call-to-action">
						<div class="col-md-10">
							<h2 class="action-title" '.$size.'>
								'.esc_html( $text ).'
							</h2>
						</div>
						<div class="col-md-2">
							<a class="btn btn-toranj" href="'.$href.'" target="'.$target.'">'.esc_html($btn_text ).'</a>
						</div>
						<div class="clearfix"></div>
					</div>';



    	return $output;

    }

    /**
    * ----------------------------------------------------------------------------------------
     * button
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_button($atts, $content = null) {

       extract(shortcode_atts(array(
			'text' 			=>'change me',
			'btn_url' 		=>'',
			'style'			=>'default',
			'size'			=>'medium',
			'icon' 			=>'',
			'icon_align' 	=>'right',
            'el_class'      => ''
		), $atts));


        $target = $href = "";

        $url = vc_build_link($btn_url);
        if ($url){
    		$target = isset($url['target'])?$url['target']:'';
    		$href = isset($url['url'])?$url['url']:'';
    	}

    	$el_class = self::getExtraClass($el_class);

    	$class = 'btn'.$el_class;
    	switch ($style) {
    		case 'default':
    			$class.=' btn-default';
    			break;
    		case 'toranj':
    			$class.=' btn-toranj';
    			break;
    		case 'toranj_reverse':
    			$class.=' btn-toranj alt';
    			break;
    		case 'bs_primary':
    			$class.=' btn-primary';
    			break;
    		case 'bs_success':
    			$class.=' btn-success';
    			break;
    		case 'bs_info':
    			$class.=' btn-info';
    			break;
    		case 'bs_warninig':
    			$class.=' btn-warning';
    			break;
    		case 'bs_danger':
    			$class.=' btn-danger';
    			break;
    		default:
    			$class.=' btn-default';
    			break;
    	}

    	switch ($size) {
    		case 'large':
    			$class .=" btn-lg";
    			break;
    		case 'medium':
    			$class .="";
    			break;
    		case 'small':
    			$class .=" btn-sm";
    			break;
    		case 'extera_small':
    			$class .=" btn-xs";
    			break;
    		default:
    			$class .="";
    			break;
    	}

    	if ($icon != '') {
    		$class .=" btn-icon";
    		if ( $icon_align == 'right'){
    			$icon_text = esc_html($text).' <i class="fa '.esc_html( $icon ).'"></i>';
    		}else{
    			$icon_text = '<i class="fa '.esc_html( $icon ).'"></i> '.esc_html($text);
    		}

    	}else{
    		$icon_text = esc_html($text);
    	}


        $output = '<a class="'.$class.'" href="'.$href.'" target="'.$target.'">'.$icon_text.'</a>';





    	return $output;

    }



    /**
    * ----------------------------------------------------------------------------------------
     * image_with_hover
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_image_with_hover($atts, $content = null) {

       	extract(shortcode_atts(array(
			'image' 		=>'change me',
			'title' 		=>'Image Title',
			'des'			=>'Description',
			'style'			=>'style1',
			'icon' 			=>'fa-heart',
			'hyperlink' 	=>'',
			'btn_url' 		=>''
		), $atts));


       	$url = vc_build_link($btn_url);
    	if ($url){
    		$target = $url['target'];
    		$href = $url['url'];
    	}

    	$image_attributes = wp_get_attachment_image_src( $image , 'full' ); // returns an array
        $image_markup = '<img src="'.$image_attributes[0].'" class="img-responsive" alt="'.esc_html( $title ).'">';//owlab_lazy_image($image_attributes, esc_html( $title ), false);
    	$output = '';
    	switch ($style) {
    		case 'style1':
    			$output = '<div class="tj-hover-1">
								'.$image_markup.'
								<!-- Item Overlay -->
								<div class="tj-overlay">
									<h3 class="title">'.esc_html( $title ).'</h3>
									<h4 class="subtitle">'.esc_html( $des ).'</h4>
								</div>
								<!-- /Item Overlay -->
							</div>';
    			break;

    		case 'style2':
    			$output = '<div class="tj-hover-2">
								'.$image_markup.'
								<!-- Item Overlay -->
								<div class="tj-overlay">
									<i class="fa '.esc_html( $icon ).' overlay-icon"></i>
									<div class="overlay-texts">
										<h3 class="title">'.esc_html( $title ).'</h3>
										<h4 class="subtitle">'.esc_html( $des ).'</h4>
									</div>
								</div>
								<!-- /Item Overlay -->
							</div>';
    			break;

    		case 'style3':
    			$output = '<div class="tj-hover-4">
								'.$image_markup.'
								<!-- Item Overlay -->
								<div class="tj-overlay">
									<i class="fa '.esc_html( $icon ).' overlay-icon"></i>
								</div>
								<!-- /Item Overlay -->
							</div>';
    			break;

    		case 'style4':
    			$output = '<div class="tj-hover-3">
								'.$image_markup.'

								<!-- Item Overlay -->
								<div class="tj-overlay">
									<div class="vcenter-wrapper">
										<div class="overlay-texts vcenter">
											<h3 class="title">'.esc_html( $title ).'</h3>
											<h4 class="subtitle">'.esc_html( $des ).'</h4>
										</div>
									</div>
								</div>
								<!-- /Item Overlay -->
							</div>';
    			break;

    		case 'style5':
    			$output = '<div class="tj-circle-hover">
								'.$image_markup.'

								<!-- Item Overlay -->
								<div class="tj-overlay">
									<div class="content">
										<div class="circle">
											<i class="fa '.esc_html( $icon ).'"></i>
										</div>
										<div class="details">
											<h4 class="title">'.esc_html( $title ).'</h4>
											<h5 class="subtitle">'.esc_html( $des ).'</h5>
										</div>
									</div>
								</div>
								<!-- /Item Overlay -->
							</div>';
    			break;

    		case 'style6':
    			$output = '<div class="tj-hover-5">
								'.$image_markup.'

								<!-- Item Overlay -->
								<div class="tj-overlay"></div>
								<!-- /Item Overlay -->
							</div>';
    			break;

    		case 'style7':
    			$output = '<div class="tj-hover-5 reverse">
								'.$image_markup.'

								<!-- Item Overlay -->
								<div class="tj-overlay"></div>
								<!-- /Item Overlay -->
							</div>';
    			break;

    		case 'style8':
    			$output = '<div class="tj-hover-5 colorbg">
								'.$image_markup.'

								<!-- Item Overlay -->
								<div class="tj-overlay"></div>
								<!-- /Item Overlay -->
							</div>';
    			break;

    		default:
    			# code...
    			break;
    	}


    	if ($hyperlink == 'yes'){
    		$output = '<a href="'.$href.'" target="'.$target.'">'.$output.'</a>';
    	}

    	return $output;
    }


    /**
    * ----------------------------------------------------------------------------------------
     * services_container
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_services_container($atts, $content = null) {

    	$output ='';
		//
		extract(shortcode_atts(array(
			'title' => '',
			'el_class' => ''
		), $atts));

		$el_class = self::getExtraClass($el_class);
		$css_class = 'vertical-services'.$el_class;

		$output='<div class="'.$css_class.'"><ul>'.wpb_js_remove_wpautop($content).'</ul></div>';

		return $output;

    }

    /**
    * ----------------------------------------------------------------------------------------
     * services_single
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_services_single($atts, $content = null) {

       	extract(shortcode_atts(array(
			'title' 		=>'Image Title',
			'icon' 			=>'fa-heart',
		), $atts));

    	$output = '<li>
	                    <i class="fa '.esc_html( $icon ).'"></i>
	                    <div class="service-details">
	                        <h3 class="title">'.esc_html( $title ).'</h3>
	                        '.$content.'
	                    </div>
	                </li>';


    	return $output;
    }


    /**
    * ----------------------------------------------------------------------------------------
     * skill_item
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_skill_item($atts, $content = null) {

       	extract(shortcode_atts(array(
			'title' 		=>'Title',
			'percent' 		=>'50',
		), $atts));

    	$output = '<div class="skill-item">
						<span class="title">'.esc_html( $title ).'</span>
						<div class="rail">
							<div class="bar" style="width:'.intval( $percent ).'%"><span class="percentage">'.intval( $percent ).'%</span></div>
						</div>
						<!-- /Skill item -->
					</div>';


    	return $output;
    }

    /**
    * ----------------------------------------------------------------------------------------
     * personnel
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_personnel($atts, $content = null) {

       	extract(shortcode_atts(array(
			'name' 		=>'Title',
			'title' 	=>'Title',
			'image' 	=>'Title',
			'icon1' 	=>'fa-facebook',
			'title1' 	=>'',
			'icon2' 	=>'fa-twitter',
			'title2' 	=>'',
			'icon3' 	=>'fa-instagram',
			'title3' 	=>'',
		), $atts));

       	$image_attributes = wp_get_attachment_image_src( $image , 'full' ); // returns an array

    	$output = '<div class="team-members"><div class="team-item">
						<div class="team-head">
                            '.owlab_lazy_image($image_attributes, esc_html( $name ), false,'img-responsive').'
							<ul class="team-socials">';
		if ( $title1 !=''){
			$output .='<li><a href="'.esc_url( $title1 ).'" target="_blank"><i class="fa '.esc_html( $icon1 ).'"></i></a></li>';
		}
		if ( $title2 !=''){
			$output .='<li><a href="'.esc_url( $title2 ).'" target="_blank"><i class="fa '.esc_html( $icon2 ).'"></i></a></li>';
		}
		if ( $title3 !=''){
			$output .='<li><a href="'.esc_url( $title3 ).'" target="_blank"><i class="fa '.esc_html( $icon3 ).'"></i></a></li>';
		}
		$output .='
							</ul>
						</div>

						<div class="team-content">
							<h3 class="title">'.esc_html( $name ).'</h3>
							<h4 class="subtitle">'.esc_html( $title ).'</h4>
						</div>

					</div></div>';


    	return $output;
    }

    /**
    * ----------------------------------------------------------------------------------------
     * announce_box
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_announce_box($atts, $content = null) {

        $output = '<div class="announce-box">
						'.$content.'
					</div>';
		return $output;

    }

    /**
    * ----------------------------------------------------------------------------------------
     * single_light_box
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_single_light_box($atts, $content = null) {

    	extract(shortcode_atts(array(
			'image' 	=>'',
			'type' 		=>'image',
			'overlay' 	=>'style1',
			'icon' 		=>'fa-heart',
			'ext_url'   => 'http://www.youtube.com/watch?v=0O2aH4XLbto'
		), $atts));

    	$image_attributes = wp_get_attachment_image_src( $image , 'full' ); // returns an array

    	$iframe = "no";
    	switch ($type) {
    		case 'image':
    			$href = $image_attributes[0];
    			break;

    		default:
    			$href = $ext_url;
    			$iframe = "yes";
    			break;
    	}

    	switch ($overlay) {
    		case 'style1':
    			$overlay_html = '<div class="tj-overlay">
									<i class="fa '.esc_html( $icon ).' overlay-icon"></i>
								</div>';
				$class = "tj-hover-4";
    			break;
    		case 'style2':
    			$overlay_html = '<div class="tj-overlay"></div>';
    			$class = "tj-hover-5 colorbg";
    			break;
    		case 'style3':
    			$overlay_html = '<div class="tj-overlay"></div>';
    			$class = "tj-hover-5 reverse";
    			break;
    		case 'style4':
    			$overlay_html = '<div class="tj-overlay"></div>';
    			$class = "tj-hover-5";
    			break;
    		default:
    			$overlay_html = '<div class="tj-overlay"></div>';
    			$class = "tj-hover-5";
    			break;
    	}

        $output = '<a href="'.$href.'" class="tj-lightbox '.$class.'"';

        if( $iframe !="no" ){
        	$output .= ' data-type="iframe"';
        }

        $output .='>
						'.owlab_lazy_image($image_attributes, '', false,'img-fit').'
						'.$overlay_html.'
					</a>';

		return $output;

    }




    /**
    * ----------------------------------------------------------------------------------------
     * gallery_light_box_single
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_gallery_light_box_single($atts, $content = null) {

    	extract(shortcode_atts(array(
			'title'     => '',
			'image' 	=> '',
			'mp4'		=> '',
			'webm'		=> '',
			'ogv'		=> '',
			'type' 		=>'image',
			'overlay' 	=>'style1',
			'icon' 		=>'fa-heart',
			'ext_url'   => 'http://www.youtube.com/watch?v=0O2aH4XLbto'
		), $atts));

    	$image_attributes = wp_get_attachment_image_src( $image , 'full' ); // returns an array

    	$iframe = false;
    	switch ($type) {
    		case 'image':
    			$href = $image_attributes[0];
    			break;

    		default:
    			$href = $ext_url;
    			$iframe = true;
    			break;
    	}

    	switch ($overlay) {
    		case 'style1':
    			$overlay_html = '<div class="tj-overlay">
									<i class="fa '.esc_html( $icon ).' overlay-icon"></i>
								</div>';
				$class = "tj-hover-4";
    			break;
    		case 'style2':
    			$overlay_html = '<div class="tj-overlay"></div>';
    			$class = "tj-hover-5 colorbg";
    			break;
    		case 'style3':
    			$overlay_html = '<div class="tj-overlay"></div>';
    			$class = "tj-hover-5 reverse";
    			break;
    		case 'style4':
    			$overlay_html = '<div class="tj-overlay"></div>';
    			$class = "tj-hover-5";
    			break;
    		default:
    			$overlay_html = '<div class="tj-overlay"></div>';
    			$class = "tj-hover-5";
    			break;
    	}
        $output = '<a href="'.$href.'" class="lightbox-gallery-item '.$class.'" title="'.esc_html( $title ).'" ';

        if($iframe){
        	$output .= ' data-type="iframe"';
        }
        $output .='>';

        if ( $mp4 != ''){
        	$output .= '<div class="owl-videobg hoverPlay dark-overlay"';
        	$output .= 	' data-poster="'.$image_attributes[0].'"';
        	$output .= 	' data-src="'.esc_url( $mp4 ).'"';
        	if ( $webm != '')
        		$output .= 	' data-src-webm="'.esc_url( $webm ).'"';
        	if ( $ogv != '')
        		$output .= 	' data-src-ogg="'.esc_url( $ogv ).'"';
        	$output .= 	'></div>';
        	$output .= $overlay_html.'</a>';
        }else{
        	$output .= '<img class="img-fit" src="'.$image_attributes[0].'">'//owlab_lazy_image($image_attributes, '', false,'img-fit')
					   .$overlay_html.
					   '</a>';
		}

		return $output;

    }


    /**
    * ----------------------------------------------------------------------------------------
     * title
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_title($atts, $content = null) {


    	extract(shortcode_atts(array(
			'title' 	=>'',
			'title2' 	=>'',
			'style' 	=>'two-line',
			'heading' 	=>'h3',
            "el_class"  =>''
		), $atts));

        $css_class = trim( $el_class );

		switch ($heading) {
			case 'h5':
				$ot='<h5';
				$ct='</h5>';
				break;
			case 'h1':
				$ot='<h1';
				$ct='</h1>';
				break;
			case 'h2':
				$ot='<h2';
				$ct='</h2>';
				break;
			case 'h3':
				$ot='<h3';
				$ct='</h3>';
				break;
			case 'h4':
				$ot='<h4';
				$ct='</h4>';
				break;

			default:
				$ot='<h3';
				$ct='</h3>';
				break;
		}

		$span = false;
    	switch ($style) {
    		case 'two-line':

    			$ot = '<h2';
    			$ct = '</h2>';
    			$class="section-title double-title";
    			$span = true;
    			break;

    		case 'underlined':
    			$class="underlined";
    			break;

			case 'lined':
				$class="lined";
    			break;

			case 'bordered':
				$class="bordered";
    			break;

    	}

    	$output = $ot.' class="'.$class.' '.$css_class.'">';
    	if ($span){
    		$output .=	'<span>'.esc_html( $title2 ).'</span>';
    	}
    	$output .= esc_html( $title ).$ct;
		return $output;
    }


    /**
    * ----------------------------------------------------------------------------------------
     * list_container
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_list_container($atts, $content = null) {

    	$output ='';
		//
		extract(shortcode_atts(array(
			'border' => '',
			'hover' => '',
			'style' => 'with-icon',
			'iconstyle' => 'simple',
			'el_class' => ''
		), $atts));

 		$class = 'vc-item-container';
 		if($border == 'yes')
 			$class .=" list-border";
 		if ($hover == 'yes')
 			$class .= " list-hover";


 		if ($style == 'un-styled')
 			$class .= ' list-unstyled';

 		if ($style == 'with-icon'){
 			if ($iconstyle == 'square')
	 			$class .= " list-iconed-square";
	 		if ($iconstyle == 'circle')
	 			$class .= " list-iconed-circle";
	 		if ($iconstyle == 'simple')
	 			$class .= ' list-iconed';
 		}


		$el_class = self::getExtraClass($el_class);
		$css_class = $class.$el_class;

		$output='<ul class="'.$css_class.'">'.wpb_js_remove_wpautop($content).'</ul>';

		return $output;

    }

    /**
    * ----------------------------------------------------------------------------------------
     * list_item
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_list_item($atts, $content = null) {


		extract(shortcode_atts(array(
			'text' => '',
			'icon' => '',
			'btn_url' => '',
		), $atts));

 		$url = vc_build_link($btn_url);
    	$href = $url['url'];
    	$target = $url['target'];

 		if ($icon != ""){
 			$icon = '<i class="fa '.esc_html( $icon ).'"></i>';
 		}

 		if ( $href != ''){
 			$output = '<li><a href="' . $href . '" target="' . $target . '">' . $icon . esc_html( $text ) . '</a></li>';
 		}else{
 			$output='<li>'. $icon .esc_html( $text ).'</li>';
 		}

		return $output;

    }


    /**
    * ----------------------------------------------------------------------------------------
     * external_video
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
  //   public function render_external_video($atts, $content = null) {


		// extract(shortcode_atts(array(
		// 	'iframe' => 'Please include the <code>iframe</code> to your shortcode.',
		// ), $atts));

 	// 	$output = '<div class="video-container">'.$iframe.'</div>';

		// return $output;

  //   }


    /**
    * ----------------------------------------------------------------------------------------
     * html5_video
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_html5_video($atts, $content = null) {


		extract(shortcode_atts(array(
			'image' 	=> '',
			'mp4'		=> '',
			'webm'		=> '',
			'ogv'		=> ''
		), $atts));

 		$image_attributes = wp_get_attachment_image_src( $image , 'full' ); // returns an array

 		$output  = '<video class="mejs-player video-html5" controls preload="none" poster="'.$image_attributes[0].'">';
		$output .=		'<source src="'.esc_url( $mp4 ).'" type="video/mp4" />';
		if ( $webm != '')
			$output .=	'<source src="'.esc_url( $webm ).'" type="video/webm" />';
		if ( $ogv != '')
			$output .=	'<source src="'.esc_url( $ogv ).'" type="video/ogg" />';
		$output .= '</video>';

		return $output;

    }


    /**
    * ----------------------------------------------------------------------------------------
     * caption
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_caption($atts, $content = null) {


		extract(shortcode_atts(array(
            'preset'        => '',
			'title' 	    => 'input your text title',
			'sub_title'		=> 'input your description',
            'description'   =>'',
            'position4'     => 'bottom-left',
            'position2'     => 'bottom',
            'dark_light'    => 'dark',
            'add_button'    => '',
			'label'		    => 'change me',
			'link'		    => '',
			'style' 	    => 'default',
            'media_type'    => 'video',
			'image'		    => '',
            'img_size'      => 'blog-thumb',
			'mp4'		    => '',
			'webm'		    => '',
			'ogv'		    => '',
            'autoplay'      => '',
            'add_style'     => '',
            'el_class'      => ''
		), $atts));

        //prepare the image
 		$image_attributes = wp_get_attachment_image_src( $image , $img_size ); // returns an array

        $css_class = trim( $el_class );

        //prepare the button
        $btn_html= '';
        if ( $add_button == "yes"){

            $btn_class = 'btn';
            switch ($style) {
                case 'default':
                    $btn_class.=' btn-transparent';
                    break;
                case 'toranj':
                    $btn_class.=' btn-toranj';
                    break;
                case 'toranj_reverse':
                    $btn_class.=' btn-toranj alt';
                    break;
                case 'bs_primary':
                    $btn_class.=' btn-primary';
                    break;
                case 'bs_success':
                    $btn_class.=' btn-success';
                    break;
                case 'bs_info':
                    $btn_class.=' btn-info';
                    break;
                case 'bs_warninig':
                    $btn_class.=' btn-warning';
                    break;
                case 'bs_danger':
                    $btn_class.=' btn-danger';
                    break;
                default:
                    $btn_class.=' btn-default';
                    break;
            }

            //prepare the link
            $href=$target='';
            $url = vc_build_link($link);
            if (is_array($url)){
                $href = $url['url'];
                $target = $url['target'];
            }

            if ( $href != '')
                $btn_html .='<a href="'.esc_url( $href ).'" target="'.$target.'" class="'.$btn_class.' btn-lg">'.$label.'</a>';
        }



        //prepare media
        $media_html = $style = '';
        if ( $media_type == 'video'){

            $video_class = "hoverPlay";
            if ($autoplay=="yes"){
                $video_class="autoplay";
            }
            $media_html .= '<div class="owl-videobg '.$video_class.' dark-overlay"
                data-src="'.esc_url( $mp4 ).'"
                data-poster="'.$image_attributes[0].'"';
            if ( $webm != '')
                $media_html .= ' data-src-webm="'.esc_url( $webm ).'"';
            if ( $ogv != '')
                $media_html .= ' data-src-ogg="'.esc_url( $ogv ).'"';
            $media_html .='"></div>';
        }elseif( $media_type =="image"){
            $media_html .= '<img src="'.$image_attributes[0].'" alt="'.esc_html( $title ).'">';//owlab_lazy_image($image_attributes, esc_html( $title ), false,'');
        }elseif( $media_type == 'none'){
            $style = "style='width:100%;height:100%;'";
        }


        $output = '';
        switch ($preset) {
            case '1':
                $output .= '<div class="img-container dark-overlay '.$css_class.'" '.$style.'>';
                $output .= $media_html;
                $output .='<div class="caption cap-full">
                        <div class="vcenter-wrapper">
                            <div class="cap-lg vcenter">
                                <h2 class="cap-title allcaps">'.$title.'</h2>
                                <div class="cap-des">'.$content.'</div>';
                $output .=  $btn_html;
                $output .= '</div></div></div></div>';
                break;

            case '2':
                $output .= '<div class="img-container '.$css_class.'" '.$style.'>';
                $output .= $media_html;
                $output .='<div class="caption cap-full">
                        <div class="vcenter-wrapper">
                            <div class="cap-lg cap-lg-pushdown vcenter">
                                <h2 class="cap-title allcaps">'.$title.'</h2>';
                $output .=  $btn_html;
                $output .= '</div></div></div></div>';
                break;

            case '3':
                $output .= '<div class="img-container '.$css_class.'" '.$style.'>';
                $output .= $media_html;
                $output .='<div class="caption cap-toranj">
                            <h2 class="cap-title double-title"><span>'.esc_html( $sub_title ).'</span>'.$title.'</h2>
                        <div class="cap-des">'.$content.'</div>';
                $output .=  $btn_html;
                $output .= '</div></div>';
                break;

            case '4':
                //caption class
                $capcalss="caption cap-bordered";
                switch ($position4) {
                    case 'top-right':
                        $capcalss .= ' cap-top cap-right';
                        break;
                    case 'top-left':
                        $capcalss .= ' cap-top cap-left';
                        break;
                    case 'bottom-right':
                        $capcalss .= ' cap-bottom cap-right';
                        break;
                    case 'bottom-left':
                        $capcalss .= ' cap-bottom cap-left';
                        break;
                    default:
                        $capcalss .= ' cap-bottom cap-left';
                        break;
                }

                $output .= '<div class="img-container '.$css_class.'" '.$style.'>';
                $output .= $media_html;
                $output .='<div class="'.$capcalss.'">
                                <h2 class="cap-title">'.$title.'</h2>
                                    <div class="cap-des">'.$content.'</div>';
                $output .=  $btn_html;
                $output .= '</div></div>';
                break;

            case '5':
                $output .= '<div class="img-container '.$css_class.'" '.$style.'>';
                $output .= $media_html;
                $output .='<div class="caption cap-elegant">
                            <h2 class="cap-title allcaps">'.$title.'</h2>
                            <div class="cap-des">'.$content.'</div>';
                $output .=  $btn_html;
                $output .= '</div></div>';
                break;

            case '6':

                $poclass = 'caption cap-boxed';
                switch ($dark_light) {
                    case 'light':
                        $poclass.=' cap-light';
                        break;
                    case 'dark':
                        $poclass.=' cap-dark';
                        break;
                    default:
                        $poclass.=' btn-dark';
                        break;
                }
                switch ($position4) {
                    case 'top-right':
                        $poclass .= ' cap-top cap-right';
                        break;
                    case 'top-left':
                        $poclass .= ' cap-top cap-left';
                        break;
                    case 'bottom-right':
                        $poclass .= ' cap-bottom cap-right';
                        break;
                    case 'bottom-left':
                        $poclass .= ' cap-bottom cap-left';
                        break;
                    default:
                        $poclass .= ' cap-bottom cap-left';
                        break;
                }

                $output .= '<div class="img-container '.$css_class.'" '.$style.'>';
                $output .= $media_html;
                $output .='<div class="'.$poclass.'">
                            <h2 class="cap-title allcaps">'.$title.'</h2>
                            <div class="cap-des">'.$content.'</div>
                        </div>
                        </div>';
                break;

            case '7':

                $class = 'caption cap-boxed cap-ribbon';
                switch ($dark_light) {
                    case 'light':
                        $class.=' cap-light';
                        break;
                    case 'dark':
                        $class.=' cap-dark';
                        break;
                    default:
                        $class.=' btn-dark';
                        break;
                }

                switch ($position2) {
                    case 'top':
                        $class .= ' cap-top';
                        break;
                    case 'bottom':
                        $class .= ' cap-bottom';
                        break;
                    default:
                        $class .= ' cap-bottom';
                        break;
                }
                $output .= '<div class="img-container '.$css_class.'" '.$style.'>';
                $output .= $media_html;
                $output .='<div class="'.$class.'">

                    <h2 class="cap-title allcaps">'.$title.'</h2>
                    <div class="cap-des">'.$content.'</div>
                    </div>
                </div>';
                break;

            case '8':
                $class = 'caption cap-bordered cap-compact cap-bottom';
                switch ($position2) {
                    case 'right':
                        $class .= ' cap-right';
                        break;
                    case 'left':
                        $class .= ' cap-left';
                        break;
                    default:
                        $class .= ' cap-left';
                        break;
                }
                $sub_title = '<br>'.esc_html( $sub_title );
                $output .= '<div class="img-container '.$css_class.'" '.$style.'>';
                $output .= $media_html;
                $output .='<div class="'.$class.'">
                        <h2 class="cap-title allcaps">'.$title. $sub_title .'</h2>
                    </div>
                </div>';
                break;

            default:
                $class = 'caption cap-bordered cap-compact cap-bottom';
                switch ($position2) {
                    case 'right':
                        $class .= ' cap-right';
                        break;
                    case 'left':
                        $class .= ' cap-left';
                        break;
                    default:
                        $class .= ' cap-left';
                        break;
                }
                $sub_title = '<br>'.esc_html( $sub_title );
                $output .= '<div class="img-container '.$css_class.'" '.$style.'>';
                $output .= $media_html;
                $output .='<div class="'.$class.'">
                        <h2 class="cap-title allcaps">'.$title. $sub_title .'</h2>
                    </div>
                </div>';
                break;
        }


		return $output;

    }

    /**
    * ----------------------------------------------------------------------------------------
     * compare_image
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_compare_image ($atts, $content = null) {


		extract(shortcode_atts(array(
			'text1' 	=> 'before',
			'text2'		=> 'after',
			'image1'  	=> '',
			'image2'	=> '',
			'gap'		=> '300'
		), $atts));

 		$image1_attributes = wp_get_attachment_image_src( $image1 , 'full' ); // returns an array
 		$image2_attributes = wp_get_attachment_image_src( $image2 , 'full' ); // returns an array
 		$class = 'compare-'.rand();

 		$output = '<div class="toranj-compare '.$class.'">
                    <img src="'.$image1_attributes[0].'" alt="'.esc_html( $text1 ).'">
                    <img src="'.$image2_attributes[0].'" alt="'.esc_html( $text2 ).'">
                </div>';


		$this->inline_js .= '(function($){
                        $(".'.$class.'").imagesLoaded(function(){
                            $(".'.$class.'").ClassyCompare({
                                gap : '.intval($gap).',
                                caption: true
                            });
                        });
                    })(jQuery);
				    ';



		add_action('wp_footer', array( $this,'append_js_to_footer'),100000,1);
        return $output;



    }

    public function append_js_to_footer($inline) {
        $out = '<script type="text/javascript">';
        $out .= $this->inline_js;
        $out .='</script>';
        echo $out;
    }


    /**
    * ----------------------------------------------------------------------------------------
     * Helper function to loop to posts
     * ----------------------------------------------------------------------------------------
     *
     * Note: don't forget to use wp_reset_query() at the end of your usage
     *
     * @since 1.0.0
     * @param
     * @return
     */
    private function _prepare_posts_loop($post_type, $limit, $taxonomy, $term,$ids='') {

        if ( !empty($ids) ){
            // get specific posts
            $ids_array = explode( ",", trim($ids) );
            $args = array(
               'post_type' => $post_type,
               'post__in'  => $ids_array ,
               'posts_per_page' => count($ids_array),
               'orderby' => 'post__in'
            );
        }else{
            $args = array(
                'post_type' => $post_type,
                'orderby'  => 'menu_order',
                'order'     => 'ASC',
                'posts_per_page' => (intval($limit)==0) ? -1 : intval($limit)
            );
            // add taxonomy to query if there is one
            if ( !empty ($term) ){
                $args[$taxonomy] = $term;
            }
        }




        return new WP_Query( $args );


    }


    /**
    * ----------------------------------------------------------------------------------------
     * gallery_horizontal
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_gallery_horizontal ($atts, $content = null) {


        extract(shortcode_atts(array(
            'hide_sidebar'  => '',
            'title'         => '',
            'title2'        => '',
            'overlay_type'  => 'simple-icon',
            'album'         => '',
            'limit'         => '0',
            'default_width' => '350',
            'width_mode'    =>'fixed_width',
            'fill_mode'     =>'fill_cover'
        ), $atts));

        $output = "";

        $loop = $this->_prepare_posts_loop('owlabgal',$limit,'owlabgal_album',$album);


        $args = array(
            'loop'          => $loop,
            'hide_sidebar'  => $hide_sidebar,
            'title2'        => $title2,
            'title'         => $title,
            'content'       => $content,
            'width_mode'    => $width_mode,
            'default_width' => $default_width,
            'overlay_type'  => $overlay_type,
            'fill_mode'     => $fill_mode
        );

        $output = owlab_horizontalscroll_gallery($args,'loop');

        $output .= owlab_add_sharing(true);

        wp_reset_query();


        return $output;

    }

    /**
    * ----------------------------------------------------------------------------------------
     * gallery_bootstrap_grid
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_gallery_bootstrap_grid ($atts, $content = null) {


        extract(shortcode_atts(array(
            'cols'          => '2',
            'lightbox'      => '',
            'overlay_type'  => 'simple-icon',
            'album'         => '',
            'ids'           =>  '',
            'limit'         => '0'
        ), $atts));

        $output = "";

        if ( intval($cols) > 4 || intval($cols)<1 )
            $cols = 1;
        switch ( $cols ) {
            case '2':
                $class="col-md-6";
                $thumb_size = "large";
                break;
            case '3':
                $class="col-md-4";
                $thumb_size = "blog-thumb";
                break;
            case '4':
                $class="col-md-3";
                $thumb_size = "blog-thumb";
                break;
            default: //one column
                $class="col-md-12";
                $thumb_size = "full";
                break;
        }

        //get the data
        $loop = $this->_prepare_posts_loop('owlabgal',$limit,'owlabgal_album',$album,$ids);

        $output .='<div class="tj-lightbox-gallery"><div class="row mb-medium">';

        if ( $loop->have_posts() ) :

            $counter = 0;
            while( $loop->have_posts() ) :
                $loop->the_post();

                $owlabgal_meta = get_post_meta( $loop->post->ID );
                $item_overlay = owlab_get_gallery_overlay($overlay_type);
                $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($loop->post->ID), $thumb_size );
                $img_url = wp_get_attachment_url( get_post_thumbnail_id($loop->post->ID) );

                $output .='<div class="'.$class.'">';
                if ( $lightbox == "yes"){
                    $output .= '<div class="img-container"><a href="'.$img_url.'" class="lightbox-gallery-item '.$item_overlay['parent_class'].'">
                        '.owlab_lazy_image($thumb_url, get_the_title(), false,'img-fit').'
                        '.$item_overlay['markup'].'
                    </a></div>';
                }else{
                    $output .= owlab_lazy_image($thumb_url, get_the_title(), false,'img-fit');
                }
                $output .="</div>";
                $counter++;
                if( $counter == $cols  ){
                  $output .='</div><div class="row mb-medium">';
                  $counter =0; //reset
                }

            endwhile;
        else:
            $output.= __('No items found.','toranj');
        endif;

        $output .='</div></div>';

        wp_reset_query();

        //add sharing
        $output .= owlab_add_sharing(true);

        return $output;

    }

    /**
    * ----------------------------------------------------------------------------------------
     * gallery_grid
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_gallery_grid ($atts, $content = null) {


        extract(shortcode_atts(array(
            'hide_sidebar'  => '',
            'title'         => '',
            'title2'        => '',
            'show_filter'   => '',
            'show_filter_count' => '',
            'overlay_type'  => 'simple-icon',
            'album'         => '',
            'limit'         => '0',
            'same_ratio_thumbs' => '',
            'remove_spaces_between_images' => '',
            'larg_screen_column_count' => '5',
            'medium_screen_column_count' => '4',
            'small_screen_column_count' => '2',
            'xsmall_screen_column_count' => '1',
        ), $atts));

        $output = "";


        $loop = $this->_prepare_posts_loop('owlabgal',$limit,'owlabgal_album',$album);


        $nosideClass='';
        if($hide_sidebar=="yes"){
            $nosideClass = " no-side";
        }

        if ( $same_ratio_thumbs == "yes"){
            $same_ratio_thumbs = " same-ratio-items";
        }else{
            $same_ratio_thumbs = '';
        }

        if($remove_spaces_between_images=='yes'){
            $remove_spaces_between_images = " no-padding";
        }else{
            $remove_spaces_between_images = '';
        }


        //get the terms
        $owlabgal_albums = $this->_get_terms_by_term($album,'owlabgal_album');

        if ( $hide_sidebar != "yes" ){
            $output .= '<!-- Page sidebar -->
                        <div class="page-side">
                            <div class="inner-wrapper vcenter-wrapper">
                                <div class="side-content vcenter">

                                    <!-- Page title -->
                                    <h1 class="title">
                                        <span class="second-part">'.esc_html( $title2 ).'</span>
                                        <span>'.esc_html( $title ).'</span>
                                    </h1><!-- /Page title -->';
                          if( $show_filter == 'yes' && count($owlabgal_albums) > 0 ):
                          $output.='<div class="grid-filters-wrapper">
                                        <a href="#" class="select-filter"><i class="fa fa-filter"></i></a>
                                        <ul class="grid-filters">
                                            <li class="active"><a href="#" data-filter="*">'.__('All','toranj').'</a></li>';

                                        foreach ($owlabgal_albums as $album):

                                            $album = (array) $album;
                                            //what do we want?
                                            $count = '';
                                            if( $show_filter_count =="yes" ){
                                                $count = ' -'.$album['count'].'';
                                            }

                                            $output.='<li><a href="#" data-filter=".'.$album['slug'].'">'.$album['name'].$count.'</a></li>';
                                        endforeach;
                              $output.='</ul>
                                    </div><!--/.grid-filter-wrapper-->';
                           endif;//end show filter if
                                    if ( isset($content) ){
                                        $output .= $content;
                                    }
                    $output .= '</div><!-- /.side-content -->
                            </div><!-- /.inner-wrapper -->
                        </div><!-- /Page sidebar -->';
        }

        $output .= '
        <!-- Page main content -->
        <div class="page-main'. $nosideClass .'">

            <!-- Gallery wrapper -->
            <div class="grid-portfolio tj-lightbox-gallery'.$same_ratio_thumbs.$remove_spaces_between_images .'" lg-cols="'.intval($larg_screen_column_count).'" md-cols="'.intval($medium_screen_column_count).'" sm-cols="'.intval($small_screen_column_count).'" xs-cols="'.intval($xsmall_screen_column_count).'">
            ';

            $sizer_defined=0;
            if ( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();

            $owlabgal_meta = get_post_meta( $loop->post->ID );
            $item_overlay = owlab_get_gallery_overlay($overlay_type);

            //get the terms of each photo
            $the_terms = wp_get_post_terms( $loop->post->ID, 'owlabgal_album', array('fileds' => 'all') );

            $this_terms =array();
            if (is_array($the_terms)){
                foreach($the_terms as $term){
                    $this_terms[]= $term->slug;
                }
            }
            $album_terms = implode(' ', $this_terms);

            $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($loop->post->ID), 'blog-thumb' );
                    // [0] => url
                    // [1] => width
                    // [2] => height
            $img_url = wp_get_attachment_url( get_post_thumbnail_id($loop->post->ID) );


            $ratio ='';
            if (!empty($owlabgal_meta['owlabgal_grid_ratio'][0])){
                $ratio.= ' data-width-ratio="'. intval($owlabgal_meta['owlabgal_grid_ratio'][0]).'"';
            }


            $sizer='';
             if ( array_key_exists('owlabgal_grid_sizer', $owlabgal_meta) && $sizer_defined !=1 ){
                $sizer_defined == 1;
                $sizer=" grid-sizer";
             }

            $output .='

                <!-- Gallery Item -->
                <div class="gp-item '.$item_overlay['parent_class'].' '.$album_terms.$sizer.'"'.$ratio.'>
                    <a href="'.$img_url.'"  class="lightbox-gallery-item" title="'.get_the_title().'">

                        '.owlab_lazy_image($thumb_url, get_the_title(), false).'

                        <!-- Item Overlay -->
                        '.$item_overlay['markup'].'
                        <!-- /Item Overlay -->
                    </a>
                </div>
                <!-- /Gallery Item -->';

        endwhile; else:
            $output.= __('No items found.','toranj');
        endif;
            $output .='
            </div>
            <!-- /Gallery wrapper -->';

            if( $hide_sidebar == "yes" && $show_filter == "yes" && count($owlabgal_albums) > 0):
            $output.='<div class="fixed-filter">
                <a href="#" class="select-filter"><i class="fa fa-filter"></i>'.ot_get_option('gallery_grid___filter_title').'</a>
                <ul class="grid-filters">
                    <li class="active"><a href="#" data-filter="*">'.__('All','toranj').'</a></li>';

                foreach ($owlabgal_albums as $album):
                    //what do we want?
                    $album = (array) $album;
                    $count = '';
                    if( $show_filter_count =="yes" ){
                        $count = ' -'.$album['count'].'';
                    }

                    $output.='<li><a href="#" data-filter=".'.$album['slug'].'">'.$album['name'].$count.'</a></li>';
                endforeach;
      $output.='</ul>
            </div><!-- /Grid filter -->';
            endif; //end show filter

        $output.='</div>
        <!-- /Page main content -->';




        wp_reset_query();

        //add sharing
        $output .= owlab_add_sharing(true);


        return $output;
    }


    /**
    * ----------------------------------------------------------------------------------------
     * double_carousel_container
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_double_carousel_container($atts, $content = null) {



        extract(shortcode_atts(array(
            "rightsidedir"      => "down",
            "leftsidedir"       => "up",
            "leftsideduration"  => 1,
            "rightsideduration" => 1,
            "mouse"             => "",
            "keyboard"          => "",
            "touchswipe"        => "",
            "bulletcontroll"    => "",
            "bulletnumber"      => "",
            "bulletcenter"      => "vertical",
            'show_nav'          => '',
            'autoplay'          =>"",
            'duration'          =>5,
            'el_class'          => ''
        ), $atts));


        $class = 'vertical-carousel'.mt_rand();


        $el_class = self::getExtraClass($el_class);
        $css_class = $class.$el_class;

        $nav = '';
        if ( $show_nav == "yes"){
            $nav = '<!-- Carousel Counter -->
                        <div class="vcarousel-counter">
                            <span class="counter-current">1</span>
                            <span class="counter-divider">/</span>
                            <span class="counter-total"></span>
                        </div>
                        <!-- /Carousel Counter -->

                        <!-- Carousel Previous -->
                        <div class="vcarousel-prev">
                            <a href="#"><i class="fa fa-angle-up"></i></a>
                        </div>
                        <!-- /Carousel Previous -->

                        <!-- Carousel Next -->
                        <div class="vcarousel-next">
                            <a href="#"><i class="fa fa-angle-down"></i></a>
                        </div>
                        <!-- /Carousel Next -->';
        }


        $output = '<div class="vertical-carousel team-members '.$css_class.'">';
        $output .= '<div class="left-side" >
                        <div class="left-side-wrapper"></div>
                        '.$nav.'
                    </div><!-- /Contents Side-->

                    <div class="right-side" data-fill="auto-fill">
                        <!-- Image Carousel Wrapper -->
                        <div class="right-side-wrapper"></div>
                    </div>';

        $output .= '<div class="dc-contents" style="display:none;">'.wpb_js_remove_wpautop($content).'</div>';
        $output .= '</div><!-- /.team-members-->';

        $jsatts = array(
            "rightSideDir"      => $rightsidedir,
            "leftSideDir"       => $leftsidedir,
            "leftSideDuration"  => floatval($leftsideduration) > 0 ? floatval($leftsideduration) : 1,
            "rightSideDuration" => floatval($rightsideduration) > 0 ? floatval($rightsideduration) : 1,
            "mouse"             => $mouse == "no" ? "false" : "true",
            "keyboard"          => $keyboard == "no" ? "false" : "true",
            "touchSwipe"        => $touchswipe == "no" ? "false" : "true",
            "bulletControll"    => $bulletcontroll == "no" ? "false" : "true",
            "bulletNumber"      => $bulletnumber == "yes" ? "true" : "false",
            "bulletCenter"      => $bulletcenter,
            'autoplay'          => $autoplay == "yes" ? "true" : "false",
            'duration'          => $duration,
            "class"             => $class
        );
        $this->dcarousel_settings = $jsatts;
        add_action( 'wp_footer', array( $this, '_add_team_js_footer'), 1000 );

        return $output;

    }

    /**
    * ----------------------------------------------------------------------------------------
     * adds a js block to the footer
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function _add_team_js_footer() {

        $atts= $this->dcarousel_settings;

        $output = '<script>
                    if ( undefined !== window.jQuery ) {
                        (function($){
                            var $left = $(".'.$atts["class"].' .dc-item .dc-left-side");
                            var $right = $(".'.$atts["class"].' .dc-item .dc-right-side");
                            $left.each(function(){
                                $(".'.$atts["class"].' .left-side-wrapper").append($(this).html());
                            });
                            $right.each(function(){
                                $(".'.$atts["class"].' .right-side-wrapper").append($(this).html());
                            });
                            $("'.$atts["class"].' .dc-item").remove();
                            $(".'.$atts["class"].'").DoubleCarousel({
                                rightSideDir        : "'.$atts["rightSideDir"].'",
                                leftSideDir         :"'.$atts["leftSideDir"].'",
                                leftSideDuration    :'.$atts["leftSideDuration"].',
                                rightSideDuration   :'.$atts["rightSideDuration"].',
                                mouse               :'.$atts["mouse"].',
                                keyboard            :'.$atts["keyboard"].',
                                touchSwipe          :'.$atts["touchSwipe"].',
                                bulletControll      :'.$atts["bulletControll"].',
                                bulletNumber        :'.$atts["bulletNumber"].',
                                bulletCenter        :"'.$atts["bulletCenter"].'",
                                autoplay            :'.$atts["autoplay"].',
                                duration            :'.$atts["duration"].'
                            });

                        })(jQuery);
                    }
                    </script>';
        echo $output;

    }

    /**
    * ----------------------------------------------------------------------------------------
     * double_carousel_item
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_double_carousel_item($atts, $content = null) {

        extract(shortcode_atts(array(
            'content_type'  => 'default',
            'title'         => 'Firstname',
            'big_title'     => 'Lastname',
            'add_socials'   => '',
            'facebook'      => '',
            'twitter'       => '',
            'linkedin'      => '',
            'flicker'       => '',
            'instagram'     => '',
            'google'        => '',
            'my_left_content' => '',
            'image'        => '',
            'bgcolor'       => '#1c1c1c',
            'el_class'          => ''
        ), $atts));

        $right_image = wp_get_attachment_image_src( $image , 'full' ); // returns an array

        $el_class = self::getExtraClass($el_class);

        $output = '<div class="dc-item">';

        $output .= '<div class="dc-left-side">';
            $output .= '<div class="item vcenter-wrapper '.$el_class.'" style="background-color:'.$bgcolor.'">
                            <div class="item-wrapper vcenter">';
            if ( $content_type == "default"){

                        $output .= '<h3 class="team-title">'.esc_html($title).'<span>'.esc_html($big_title).'</span></h3>';
                    if ( !empty ($content) ){
                        $output .= '<div class="info"><div class="description">'.$content.'</div></div><!-- /.info-->';
                    }
                    if ( $add_socials == 'yes' ){
                        $output .= '<ul class="social-icons">';
                        if ( !empty ($facebook) )
                            $output .= '<li><a href="'.$facebook.'"><i class="fa fa-facebook"></i></a></li>';
                        if ( !empty ($twitter) )
                            $output .= '<li><a href="'.$twitter.'"><i class="fa fa-twitter"></i></a></li>';
                        if ( !empty ($linkedin) )
                            $output .= '<li><a href="'.$linkedin.'"><i class="fa fa-linkedin"></i></a></li>';
                        if ( !empty ($flicker) )
                            $output .= '<li><a href="'.$flicker.'"><i class="fa fa-flickr"></i></a></li>';
                        if ( !empty ($instagram) )
                            $output .= '<li><a href="'.$instagram.'"><i class="fa fa-instagram"></i></a></li>';
                        if ( !empty ($google) )
                            $output .= '<li><a href="'.$google.'"><i class="fa fa-google-plus"></i></a></li>';
                        $output .= '</ul><!-- /Team Item Social Icons-->';
                    }

            }else{
                $output .= rawurldecode(base64_decode(strip_tags($my_left_content))); // html content here
            }

                $output .='</div><!-- /.item-wrapper-->
                        </div><!-- /.item-->';
        $output .= '</div><!--/.dc-left-side-->';


        $output .= '<div class="dc-right-side">';
            $output .= '<!-- Image Item -->
                        <div class="item">
                            <img src="'.$right_image[0].'" alt="'.esc_html( $title ).'">
                        </div>
                        <!-- /Image Item -->';
        $output .= '</div><!--/.dc-right-side-->';

        $output .= '</div><!--/.dc-item-->';
        $output .= '<script></script>';

        return $output;
    }


    /**
    * ----------------------------------------------------------------------------------------
     * portfolio_groups_horizontal
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_portfolio_groups_horizontal ($atts, $content = null) {


        extract(shortcode_atts(array(
            'hide_sidebar'  => '',
            'title'         => '',
            'title2'        => '',
            'group_slugs'  => ''
        ), $atts));

        $output = "";

        $qargs  = array(
            'parent' => 0,
            'hierarchical' => 0
        );
        $owlabpfl_groups =  $this->_get_terms_by_term($group_slugs,'owlabpfl_group'); //get_terms( array('owlabpfl_group'),$qargs);

        $i =0; //it starts from 0
        foreach ($owlabpfl_groups as $the_group) {
            $the_group = (array) $the_group;
            $t_id = $the_group['term_id'];
            $term_meta = get_option( "owlab_group_$t_id" );
            $owlabpfl_groups[$i] = (object) array_merge((array) $the_group, (array) $term_meta);
            $i++;
        }

        //echo "<pre>"; var_dump($owlabpfl_groups); die();

        if ( $hide_sidebar != "yes" ){
            $output = '<!-- Page sidebar -->
            <div class="page-side">
                <div class="inner-wrapper vcenter-wrapper">
                    <div class="side-content vcenter">

                        <!-- Page title -->
                        <h1 class="title">
                            <span class="second-part">'.esc_html( $title2 ).'</span>
                            <span>'.esc_html( $title ).'</span>
                        </h1>
                        <!-- /Page title -->
            ';
            if ( isset($content) ){
                $output .='
                        <div class="hidden-sm hidden-xs">
                            '.$content.'
                        </div>
                ';
            }
                $output .= '
                    </div>
                </div>
            </div>
            <!-- /Page sidebar -->
            ';
        }

        $nosideClass='';
        if($hide_sidebar=="yes"){
            $nosideClass = " no-side";
        }

        $output .='
        <!-- Page main content -->
        <div class="page-main horizontal-folio-wrapper set-height-mobile'. $nosideClass .'">

            <!-- Portfolio wrapper -->
            <div class="horizontal-folio">';

        if ( !empty($owlabpfl_groups) ) : foreach( $owlabpfl_groups as $group ) :



            $term_link = get_term_link( $group );

            $output .='
                    <!-- Portfolio Item -->
                    <div class="gp-item tj-circle-hover">
                        <a href="'.$term_link.'" class="set-bg">';
                    $output.=owlab_lazy_image(isset($group->owlabpfl_group_image)?$group->owlabpfl_group_image:false,$group->name,false);
                    $output .='<div class="tj-overlay">
                                <div class="content">
                                    <div class="circle">
                                        <i class="fa fa-link"></i>
                                    </div>
                                    <div class="details">
                                        <h4 class="title">'.$group->name.'</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- /Portfolio Item -->
            ';
        endforeach; else:
            $output.= __('No items found.','toranj');
        endif;

            $output .='
            </div>
            <!-- /Portfolio wrapper -->
        </div>
        <!-- Page main content -->';




        return $output;

    }

    /**
    * ----------------------------------------------------------------------------------------
     * portfolio_groups_vertical
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_portfolio_groups_vertical ($atts, $content = null) {


        extract(shortcode_atts(array(
            'hide_sidebar'  => '',
            'title'         => '',
            'title2'        => '',
            'animate'       => '',
            'show_des'      => 'no',
            'group_slugs'        =>''
        ), $atts));

        $animate_class = '';
        if ( $animate == "yes" )
            $animate_class = " inview-animate inview-fadeleft";





        $output = "";

        $owlabpfl_groups = $this->_get_terms_by_term($group_slugs,'owlabpfl_group');


        $i =0; //it starts from 0
        foreach ($owlabpfl_groups as $the_group) {
            $the_group = (Array)$the_group;
            $t_id = $the_group['term_id'];
            $term_meta = get_option( "owlab_group_$t_id" );
            $owlabpfl_groups[$i] = array_merge((array) $the_group, (array) $term_meta);
            $i++;
        }

        //echo "<pre>"; var_dump($owlabpfl_groups); die();

        if ( $hide_sidebar != "yes" ){
            $output = '<!-- Page sidebar -->
            <div class="page-side">
                <div class="inner-wrapper vcenter-wrapper">
                    <div class="side-content vcenter">

                        <!-- Page title -->
                        <h1 class="title">
                            <span class="second-part">'.esc_html( $title2 ).'</span>
                            <span>'.esc_html( $title ).'</span>
                        </h1>
                        <!-- /Page title -->
            ';
            if ( isset($content) ){
                $output .='
                        <div class="hidden-sm hidden-xs">
                            '.$content.'
                        </div>
                ';
            }
                $output .= '
                    </div>
                </div>
            </div>
            <!-- /Page sidebar -->
            ';
        }

        $nosideClass='';
        if($hide_sidebar=="yes"){
            $nosideClass = " no-side";
        }

        $output .='
        <!-- Page main content -->
        <div class="page-main'. $nosideClass .'">

            <!-- Portfolio wrapper -->
            <div class="vertical-folio">';

        if ( !empty($owlabpfl_groups) ) : foreach( $owlabpfl_groups as $group ) :


            $des = '';
            if ( $show_des == "yes" )
                $des = '<h4 class="subtitle">'.$group->description.'</h4>';



            $term_link = get_term_link( $group['slug'],'owlabpfl_group' );

            $output .='
                    <!-- Item -->
                    <div class="vf-item tj-hover-3 set-bg '.$animate_class.'">
                        <a href="'.$term_link.'">';
                        $output.=owlab_lazy_image(isset($group['owlabpfl_group_image'])?$group['owlabpfl_group_image']:false,$group['name'],false);

                    $output .='<!-- Item Overlay -->
                                <div class="tj-overlay vcenter-wrapper">
                                    <div class="overlay-texts vcenter">
                                        <h3 class="title">'.$group['name'].'</h3>
                                        '.$des.'
                                    </div>
                                </div>
                                <!-- /Item Overlay -->
                        </a>
                    </div>
                    <!-- /Item -->
            ';
        endforeach; else:
            $output.= __('No items found.','toranj');
        endif;

            $output .='
            </div>
            <!-- /Portfolio wrapper -->
        </div>
        <!-- Page main content -->';




        return $output;

    }


    /**
    * ----------------------------------------------------------------------------------------
     * gallery_albums_horizontal
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_gallery_albums_horizontal ($atts, $content = null) {


        extract(shortcode_atts(array(
            'hide_sidebar'  => '',
            'title'         => '',
            'title2'        => '',
            'album'         =>''
        ), $atts));

        $output = "";


        $owlabgal_albums = $this->_get_terms_by_term($album,'owlabgal_album');

        $i =0; //it starts from 0
        foreach ($owlabgal_albums as $the_term) {
            $the_term = (Array) $the_term;
            $t_id = $the_term['term_id'];
            $term_meta = get_option( "owlab_album_$t_id" );
            $owlabgal_albums[$i] = array_merge((array) $the_term, (array) $term_meta);
            $i++;
        }



        $args = array(
            'loop'          => $owlabgal_albums,
            'hide_sidebar'  => $hide_sidebar,
            'title2'        => $title2,
            'title'         => $title,
            'content'       => $content
        );
        $output = owlab_horizontalscroll_gallery($args,'array');






        //add sharing
        $output .= owlab_add_sharing(true);

        return $output;

    }


    /**
    * ----------------------------------------------------------------------------------------
     * helper function to get the terms by term
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.2.0
     * @param
     * @return
     */
    public function _get_terms_by_term($slugs,$taxonomy,$get_childs = false){


        $terms = array();
        //if we have a group term passed try to get terms under that term
        if (!empty ($slugs) ){

            //turn the string of slugs into array
            $terms_array = explode(',', $slugs);


            //loop through passed slugs
            foreach ($terms_array as $g){

                $g = trim($g);
                // do nothing on nothing
                if ( $g == '') continue;

                // get extera info about term
                $term = get_term_by('slug', $g, $taxonomy); //will return false if no such term


                if( $term ){


                    $terms[] = (array) $term;

                    if ( $get_childs ){
                        //get the child terms of this term
                        $args = array('orderby' => 'count', 'parent' => $term->term_id );

                        $child_terms = get_terms( $taxonomy, $args );
                        foreach ($child_terms as $child){
                            $terms[] =  (array) $child;
                        }
                    }

                }
            }
        }

        //check if we have anything
        if ( count($terms) == 0){
            // get all the term of this taxonomy instead
            $terms = get_terms( $taxonomy, 'orderby=count&hierarchical=0&parent=0' );
            $terms = (array) $terms;
        }


        return $terms;
    }

    /**
    * ----------------------------------------------------------------------------------------
     * portfolio_grid
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.2.0
     * @param
     * @return
     */
    public function render_portfolio_grid ($atts, $content = null) {


        extract(shortcode_atts(array(
            'hide_sidebar'  => '',
            'title'         => '',
            'title2'        => '',
            'show_filter'   => '',
            'show_filter_count' => 'no',
            'overlay_type'  => '',
            'filter_group'  => '',
            'limit'         => '0',
            'same_ratio_thumbs' => 'no',
            'remove_spaces_between_images' => 'no',
            'larg_screen_column_count' => '5',
            'medium_screen_column_count' => '4',
            'small_screen_column_count' => '2',
            'xsmall_screen_column_count' => '1',
            'use_ajax'      => 'no'
        ), $atts));

        $output = "";

        //this contains an string of camma separated slugs
        $group=$filter_group;

        $loop = $this->_prepare_posts_loop('owlabpfl',$limit,'owlabpfl_group',$group);


        $nosideClass='';
        if($hide_sidebar=="yes"){
            $nosideClass = " no-side";
        }

        if ( $same_ratio_thumbs == "yes"){
            $same_ratio_thumbs = " same-ratio-items";
        }else{
            $same_ratio_thumbs = '';
        }

        if($remove_spaces_between_images=='yes'){
            $remove_spaces_between_images = " no-padding";
        }else{
            $remove_spaces_between_images = '';
        }

        $ajax_class = '';
        if ( $use_ajax == 'yes'){
            $ajax_class = 'ajax-portfolio normal';
        }

        //get the terms
        $owlabpfl_groups = $this->_get_terms_by_term($group,'owlabpfl_group');

        if ( $hide_sidebar != "yes" ){
            $output .= '<!-- Page sidebar -->
                        <div class="page-side">
                            <div class="inner-wrapper vcenter-wrapper">
                                <div class="side-content vcenter">

                                    <!-- Page title -->
                                    <h1 class="title">
                                        <span class="second-part">'.esc_html( $title2 ).'</span>
                                        <span>'.esc_html( $title ).'</span>
                                    </h1><!-- /Page title -->';
                                    if ( isset($content) ){
                                        $output .= '<p>'.$content.'</p>';
                                    }
                          if( $show_filter == 'yes' && count($owlabpfl_groups) > 0 ):
                          $output.='<div class="grid-filters-wrapper">
                                        <a href="#" class="select-filter"><i class="fa fa-filter"></i>'.ot_get_option('gallery_grid___filter_title').'</a>
                                        <ul class="grid-filters">
                                            <li class="active"><a href="#" data-filter="*">'.__('All','toranj').'</a></li>';

                                        foreach ($owlabpfl_groups as $group):

                                            $group = (array) $group;
                                            //what do we want? premium my baby!
                                            $count = '';
                                            if( $show_filter_count =="yes" ){
                                                $count = ' -'.$group['count'].'';
                                            }

                                            $output.='<li><a href="#" data-filter=".'.$group['slug'].'">'.$group['name'].$count.'</a></li>';
                                        endforeach;
                              $output.='</ul>
                                    </div><!--/.grid-filter-wrapper-->';
                           endif;//end show filter if

                    $output .= '</div><!-- /.side-content -->
                            </div><!-- /.inner-wrapper -->
                        </div><!-- /Page sidebar -->';
        }

        $output .= '
        <!-- Page main content -->
        <div class="page-main ajax-element'. $nosideClass .'">

            <!-- Portfolio wrapper -->
            <div class="grid-portfolio '.$same_ratio_thumbs.$remove_spaces_between_images .'" lg-cols="'.intval($larg_screen_column_count).'" md-cols="'.intval($medium_screen_column_count).'" sm-cols="'.intval($small_screen_column_count).'" xs-cols="'.intval($xsmall_screen_column_count).'">
            ';

            $sizer_defined=0;
            if ( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();

            $owlabpfl_meta = get_post_meta( $loop->post->ID );

            $description = isset($owlabpfl_meta['owlabpfl_short_des']) ? $owlabpfl_meta['owlabpfl_short_des'][0] : '';
            $item_overlay = owlab_get_portfolio_overlay($overlay_type,get_the_title(),$description);

            //get the terms of each photo
            $the_terms = wp_get_post_terms( $loop->post->ID, 'owlabpfl_group', array('fileds' => 'all') );

            $this_terms =array();
            if (is_array($the_terms)){
                foreach($the_terms as $term){
                    $this_terms[]= $term->slug;
                }
            }
            $group_terms = implode(' ', $this_terms);

            $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($loop->post->ID), 'blog-thumb' );
                    // [0] => url
                    // [1] => width
                    // [2] => height
            $img_url = wp_get_attachment_url( get_post_thumbnail_id($loop->post->ID) );


            $ratio ='';
            if (!empty($owlabpfl_meta['owlabpfl_grid_ratio'][0])){
                $ratio.= ' data-width-ratio="'. intval($owlabpfl_meta['owlabpfl_grid_ratio'][0]).'"';
            }


            $sizer='';
             if ( array_key_exists('owlabpfl_grid_sizer', $owlabpfl_meta) && $sizer_defined !=1 ){
                $sizer_defined == 1;
                $sizer=" grid-sizer";
            }

            $output .='

                <!-- Gallery Item -->
                <div class="gp-item '.$item_overlay['parent_class'].' '.$group_terms.$sizer.'"'.$ratio.'>
                    <a href="'.get_the_permalink().'"  class="'.$ajax_class.'" title="'.get_the_title().'">

                        '.owlab_lazy_image($thumb_url, get_the_title(), false).'

                        <!-- Item Overlay -->
                        '.$item_overlay['markup'].'
                        <!-- /Item Overlay -->
                    </a>
                </div>
                <!-- /Gallery Item -->';

        endwhile; else:
            $output.= __('No items found.','toranj');
        endif;
            $output .='
            </div>
            <!-- /Gallery wrapper -->';

            if( $hide_sidebar == "yes" && $show_filter == "yes" && count($owlabpfl_groups) > 0):
            $output.='<div class="fixed-filter">
                <a href="#" class="select-filter"><i class="fa fa-filter"></i>'.ot_get_option('gallery_grid___filter_title').'</a>
                <ul class="grid-filters">
                    <li class="active"><a href="#" data-filter="*">'.__('All','toranj').'</a></li>';

                foreach ($owlabpfl_groups as $group):
                    //what do we want?
                    $count = '';
                    if( $show_filter_count =="yes" ){
                        $count = ' -'.$group->count.'';
                    }

                    $output.='<li><a href="#" data-filter=".'.$group->slug.'">'.$group->name.$count.'</a></li>';
                endforeach;
      $output.='</ul>
            </div><!-- /Grid filter -->';
            endif; //end show filter

        $output.='</div>
        <!-- /Page main content -->
        <!--Ajax folio-->
        <div id="ajax-folio-loader">
            <!-- loading css3 -->
            <div id="followingBallsG">
                <div id="followingBallsG_1" class="followingBallsG">
                </div>
                <div id="followingBallsG_2" class="followingBallsG">
                </div>
                <div id="followingBallsG_3" class="followingBallsG">
                </div>
                <div id="followingBallsG_4" class="followingBallsG">
                </div>
            </div>
        </div>
        <div id="ajax-folio-item"></div>
        <!--Ajax folio-->
        ';




        wp_reset_query();


        return $output;
    }

    /**
    * ----------------------------------------------------------------------------------------
     * gallery_albums_vertical
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.0.0
     * @param
     * @return
     */
    public function render_gallery_albums_vertical ($atts, $content = null) {


        extract(shortcode_atts(array(
            'hide_sidebar'  => '',
            'title'         => '',
            'title2'        => '',
            'animate'       => '',
            'show_des'      => '',
            'album'         => ''
        ), $atts));

        $animate_class = '';
        if ( $animate == "yes" )
            $animate_class = " inview-animate inview-fadeleft";

        $output = "";

        $qargs  = array(
            'parent' => 0,
            'hierarchical' => 0
        );

        $owlabgal_albums=$this->_get_terms_by_term($album,'owlabgal_album');

        $i =0; //it starts from 0
        foreach ($owlabgal_albums as $the_term) {
            $the_term = (Array) $the_term;
            $t_id = $the_term['term_id'];
            $term_meta = get_option( "owlab_album_$t_id" );
            $owlabgal_albums[$i] =  array_merge((array) $the_term, (array) $term_meta);
            $i++;
        }

        //echo "<pre>"; var_dump($owlabgal_albums); die();

        if ( $hide_sidebar != "yes" ){
            $output = '<!-- Page sidebar -->
            <div class="page-side">
                <div class="inner-wrapper vcenter-wrapper">
                    <div class="side-content vcenter">

                        <!-- Page title -->
                        <h1 class="title">
                            <span class="second-part">'.esc_html( $title2 ).'</span>
                            <span>'.esc_html( $title ).'</span>
                        </h1>
                        <!-- /Page title -->
            ';
            if ( isset($content) ){
                $output .='
                        <div class="hidden-sm hidden-xs">
                            '.$content.'
                        </div>
                ';
            }
                $output .= '
                    </div>
                </div>
            </div>
            <!-- /Page sidebar -->
            ';
        }

        $nosideClass='';
        if($hide_sidebar=="yes"){
            $nosideClass = " no-side";
        }

        $output .='
        <!-- Page main content -->
        <div class="page-main'. $nosideClass .'">

            <!-- Portfolio wrapper -->
            <div class="vertical-folio">';

        if ( !empty($owlabgal_albums) ) : foreach( $owlabgal_albums as $term ) :

            $term = (Array) $term;

            $des = '';
            if ( $show_des == "yes" )
                $des = '<h4 class="subtitle">'.wpautop( $term['description'] ).'</h4>';

            $term_link = get_term_link( $term['slug'],'owlabgal_album' );

            $output .='
                    <!-- Item -->
                    <div class="vf-item tj-hover-3 set-bg '.$animate_class.'">
                        <a href="'.$term_link.'">';
                    $output.=owlab_lazy_image(isset($term['owlabgal_album_image'])?$term['owlabgal_album_image']:false,$term['name'],false);

                    $output .='<!-- Item Overlay -->
                                <div class="tj-overlay vcenter-wrapper">
                                    <div class="overlay-texts vcenter">
                                        <h3 class="title">'.$term['name'].'</h3>
                                        '.$des.'
                                    </div>
                                </div>
                                <!-- /Item Overlay -->
                        </a>
                    </div>
                    <!-- /Item -->
            ';
        endforeach; else:
            $output.= __('No items found.','toranj');
        endif;

            $output .='
            </div>
            <!-- /Portfolio wrapper -->
        </div>
        <!-- Page main content -->';


        //add sharing
        $output .= owlab_add_sharing(true);

        return $output;

    }

    /**
    * ----------------------------------------------------------------------------------------
     * video_background
     * ----------------------------------------------------------------------------------------
     *
     * @since 1.2.0
     * @param
     * @return
     */
    public function render_video_background($atts){
        extract(shortcode_atts(array(
            'image'         => '',
            'mp4'           => '',
            'webm'          => '',
            'ogv'           => '',
            'play_mode'     => 'hoverPlay', //autoplay
            'mute_off'      => '',
            'el_class'      => '',
            'link'          => '',
            'caption'       => '',
        ), $atts));

        $output='';
        $image_attributes = wp_get_attachment_image_src( $image , 'full' ); // returns an array
        $mute_off = $mute_off == 'yes'? ' muted' : ' unmuted';
        $dark_overlay = '';//$dark_overlay == 'no'? '' : ' dark-overlay';

        $target = $href = "";
        $url = vc_build_link($link);
        if ($url){
            $target = isset($url['target'])?$url['target']:'';
            $href = isset($url['url'])?$url['url']:'';
        }

        if ( $mp4 != ''){

            $output .= '<div class="img-container vc-video_background">';

            if ( $href != ''){
                $output.= '<a href="'.$href.'" target="'.$target.'">';
            }else{
                $output .= '<a href="'.esc_url( $mp4 ).'" class="videobg-fallback">';
            }

            $output.='<div class="owl-videobg '.$play_mode.$dark_overlay.$mute_off.'"';
            $output .=  ' data-poster="'.$image_attributes[0].'"';
            $output .=  ' data-src="'.esc_url( $mp4 ).'"';

            if ( $webm != '')
                $output .=  ' data-src-webm="'.esc_url( $webm ).'"';
            if ( $ogv != '')
                $output .=  ' data-src-ogg="'.esc_url( $ogv ).'"';
            $output .=  '></div><!--/owl-videobg-->';

            if ( $caption != '' ){
                $output .='<div class="caption cap-bordered cap-compact cap-bottom cap-left">
                                <h2 class="cap-title allcaps">
                                    '.$caption.'
                                </h2>
                            </div>';
            }

            $output .='</a>';
            $output .='</div><!--/img-container-->';


        }else{
            $output .= '<div class="img-container"><img src="'.$image_attributes[0].'" class="img-fit" alt=""></div>';
        }


        return $output;
    }


}


/**
 * ----------------------------------------------------------------------------------------
 * list shortcodes to add to vc as an array here
 * ----------------------------------------------------------------------------------------
 */
$shortcodes = array(



    /*----------------------------------------------------------------------------
    *   PORTFOLIO shortcodes
    *-----------------------------------------------------------------------------*/
    'portfolio_groups_vertical'  =>  array(

        "name" => __("Portfolio Groups (vertical scroll)", 'toranj'),
        "description" => __("List of Groups Page", 'toranj'),
        "base" => "toranj_portfolio_groups_vertical",
        "class" => "",
        "controls" => "full",
        "icon" => get_template_directory_uri().'/assets/img/vcicons/portfolio.png',
        "category" => __('Portfolio', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" => array(
            array(
                "type"          => "checkbox",
                "heading"       => __("Hide sidebar?", "toranj"),
                "param_name"    => "hide_sidebar",
                "value"         => array('yes' => "yes"),
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side Title", "toranj"),
                "param_name"    => "title",
                "value"         => __("Portfolio", "toranj"),
                "holder"        => "div"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side upper-Title", "toranj"),
                "param_name"    => "title2",
                "value"         => __("Browse our", "toranj"),
                "description"   => __("You can leave this blank", "toranj")

            ),
            array(
                "type"      => "textarea_html",
                "heading"   => __("Description", "toranj"),
                "param_name"    => "content"
            ),
            array(
                "type"      => "checkbox",
                "heading"   => __("Animate?", "toranj"),
                "param_name"=> "animate",
                "value"     => array(__("Yes, Please",'toranj') => 'yes')
            ),
            array(
                "type"      => "checkbox",
                "heading"   => __("Show Group descriptions?", "toranj"),
                "param_name"=> "show_des",
                "value"     => array(__("Yes, Please",'toranj') => 'yes')
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Group Slug", "toranj"),
                "value"         => '',
                "param_name"    => "group_slugs",
                'description'   => __('If you want to restrict to specific groups then input the <code>slug</code> of the Groups. Can be seperated with comma <code>album1,album2,...</code>','toranj')
            )
        )
    ),

    'portfolio_groups_horizontal'  =>  array(

        "name" => __("Portfolio Groups (horizontal scroll)", 'toranj'),
        "description" => __("List of Groups Page", 'toranj'),
        "base" => "toranj_portfolio_groups_horizontal",
        "class" => "",
        "controls" => "full",
        "icon" => get_template_directory_uri().'/assets/img/vcicons/portfolio.png',
        "category" => __('Portfolio', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" => array(
            array(
                "type"          => "checkbox",
                "heading"       => __("Hide sidebar?", "toranj"),
                "param_name"    => "hide_sidebar",
                "value"         => array('yes' => "yes"),
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side Title", "toranj"),
                "param_name"    => "title",
                "value"         => __("Portfolio", "toranj"),
                "holder"        => "div"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side upper-Title", "toranj"),
                "param_name"    => "title2",
                "value"         => __("Browse our", "toranj"),
                "description"   => __("You can leave this blank", "toranj")

            ),
            array(
                "type"      => "textarea_html",
                "heading"   => __("Description", "toranj"),
                "param_name"    => "content"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Group Slug", "toranj"),
                "value"         => '',
                "param_name"    => "group_slugs",
                'description'   => __('If you want to restrict to specific groups then input the <code>slug</code> of the Groups. Can be seperated with comma <code>album1,album2,...</code>','toranj')
            )
        )
    ),
    'portfolio_grid' => array(
        "name" => __("Portfolio Grid", 'toranj'),
        "description" => __("Make a grid of portfolios", 'toranj'),
        "base" => "toranj_portfolio_grid",
        "class" => "",
        "controls" => "full",
        "icon" => get_template_directory_uri().'/assets/img/vcicons/portfolio.png',
        "category" => __('Portfolio', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" => array(
            array(
                "type"          => "checkbox",
                "heading"       => __("Hide sidebar?", "toranj"),
                "param_name"    => "hide_sidebar",
                "value"         => array(__("Yes, Please",'toranj') => 'yes')
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side Title", "toranj"),
                "param_name"    => "title",
                "value"         => __("Portfolio", "toranj"),
                "holder"        => "div"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side upper-Title", "toranj"),
                "param_name"    => "title2",
                "value"         => __("Browse our", "toranj"),
                "description"   => __("You can leave this blank", "toranj")

            ),
            array(
                "type"      => "textarea_html",
                "heading"   => __("Description", "toranj"),
                "param_name"    => "content",
                "value"     => ""
            ),
            array(
                "type"          => "checkbox",
                "heading"       => __("Show filter?", "toranj"),
                "description"   => __("Displays group filter (if any)",'toranj'),
                "param_name"    => "show_filter",
                "value"         => array(__("Yes, Please",'toranj') => 'yes')
            ),
            array(
                "type"          => "checkbox",
                "heading"       => __("Show filter count?", "toranj"),
                "description"   => __("Displays count items in front of each filter?",'toranj'),
                "param_name"    => "show_filter_count",
                "value"         => array(__("Yes, Please",'toranj') => 'yes')
            ),
            array(
                "type"          => "dropdown",
                "heading"       => __("Hover style", "toranj"),
                "param_name"        => "overlay_type",
                "value"             => array(
                                        __('Style #1', "toranj")     => "tj-hover-1",
                                        __('Style #2', "toranj")     => "tj-hover-2",
                                    ),
                "description" => __("Select hover style", "toranj")
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Group Slug", "toranj"),
                "param_name"    => "filter_group",
                'description'   => __('If you want to restrict to a group then input the <code>slug</code> of the group. Can be seperated with comma <code>group1,group2,...</code>','toranj')
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Number of items", "toranj"),
                "param_name"    => "limit",
                'description'   => __('Limit the number of items, set to 0 to get all','toranj'),
                "value"         => "0"
            ),
            array(
                "type"          => "checkbox",
                "heading"       => __("Same ratio Images?", "toranj"),
                "description"   => __("If all your thumbnails are at the same ratio check yes, for example if you want all your thumbs to be at the same size, or even if you have two different same ratio images. If you want to use images with variable heightes leave this blank.",'toranj'),
                "param_name"    => "same_ratio_thumbs",
                "value"         => array(__("Yes, Please",'toranj') => 'yes')
            ),
            array(
                "type"          => "checkbox",
                "heading"       => __("Remove item's padding?", "toranj"),
                "description"   => __("Remove padding between images?",'toranj'),
                "param_name"    => "remove_spaces_between_images",
                "value"         => array(__("Yes, Please",'toranj') => 'yes')
            ),
            array(
                "type"          => "checkbox",
                "heading"       => __("Use ajax loading?", "toranj"),
                "description"   => __("check this just in case you want to use the fullwidth page templates and you just want to use this shortcode at your page. Else you will see odd things appear at your page upon navigating to portfolio items.",'toranj'),
                "param_name"    => "use_ajax",
                "value"         => array(__("Yes, Please",'toranj') => 'yes')
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("LG column count", "toranj"),
                "param_name"    => "larg_screen_column_count",
                'description'   => __('<code>Integer value</code>. Number of cols for large screen devices','toranj'),
                "value"         => "4"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("MD column count", "toranj"),
                "param_name"    => "medium_screen_column_count",
                'description'   => __('<code>Integer value</code>. Number of cols for medium screen devices','toranj'),
                "value"         => "3"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("SM column count", "toranj"),
                "param_name"    => "small_screen_column_count",
                'description'   => __('<code>Integer value</code>. Number of cols for small devices','toranj'),
                "value"         => "2"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("XS column count", "toranj"),
                "param_name"    => "small_screen_column_count",
                'description'   => __('<code>Integer value</code>. Number of cols for extra small devices','toranj'),
                "value"         => "2"
            ),
        )
    ),


    /*----------------------------------------------------------------------------
    *   Gallery shortcodes
    *-----------------------------------------------------------------------------*/

    'gallery_grid' => array(
        "name" => __("Gallery Grid", 'toranj'),
        "description" => __("Make a grid gallery page", 'toranj'),
        "base" => "toranj_gallery_grid",
        "class" => "",
        "controls" => "full",
        "icon" => get_template_directory_uri().'/assets/img/vcicons/gallery.png',
        "category" => __('Gallery', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" => array(
            array(
                "type"          => "checkbox",
                "heading"       => __("Hide sidebar?", "toranj"),
                "param_name"    => "hide_sidebar",
                "value"         => array('yes' => "yes"),
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side Title", "toranj"),
                "param_name"    => "title",
                "value"         => __("Gallery", "toranj"),
                "holder"        => "div"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side upper-Title", "toranj"),
                "param_name"    => "title2",
                "value"         => __("Browse our", "toranj"),
                "description"   => __("You can leave this blank", "toranj")

            ),
            array(
                "type"      => "textarea_html",
                "heading"   => __("Description", "toranj"),
                "param_name"    => "content",
                "value"     => ""
            ),
            array(
                "type"          => "checkbox",
                "heading"       => __("Show filter?", "toranj"),
                "description"   => __("Displays Album filter (if any)",'toranj'),
                "param_name"    => "show_filter",
                "value"         => array('yes' => "yes"),
            ),
            array(
                "type"          => "checkbox",
                "heading"       => __("Show filter count?", "toranj"),
                "description"   => __("Displays count items in front of each filter?",'toranj'),
                "param_name"    => "show_filter_count",
                "value"         => array('yes' => "yes"),
            ),
            array(
                "type"          => "dropdown",
                "heading"       => __("Hover style", "toranj"),
                "param_name"        => "overlay_type",
                "value"             => array(
                                        __('Simple Icon', "toranj")     => "simple-icon",
                                        __('Circle', "toranj")          => "circle",
                                        __('Plus light', "toranj")      => "plus-light",
                                        __('Plus dark', "toranj")       => "plus-dark",
                                        __('Plus colored', "toranj")    => "plus-color"
                                    ),
                "description"   => __("Select style", "toranj"),
                "std"           => "simple-icon",
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Albm Slug", "toranj"),
                "param_name"    => "album",
                'description'   => __('If you want to restrict to an album then input the <code>slug</code> of the Album. Can be seperated with comma <code>album1,album2,...</code>','toranj')
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Number of photos", "toranj"),
                "param_name"    => "limit",
                'description'   => __('Limit the number of photos, set to 0 to get all','toranj'),
                "value"         => "0"
            ),
            array(
                "type"          => "checkbox",
                "heading"       => __("Same ratio Images?", "toranj"),
                "description"   => __("If all your thumbnails are at the same ratio check yes, for example if you want all your thumbs to be at the same size, or even if you have two different same ratio images. If you want to use images with variable heightes leave this blank.",'toranj'),
                "param_name"    => "same_ratio_thumbs",
                "value"         => array('yes' => "yes"),
            ),
            array(
                "type"          => "checkbox",
                "heading"       => __("Remove item's padding?", "toranj"),
                "description"   => __("Remove padding between images?",'toranj'),
                "param_name"    => "remove_spaces_between_images",
                "value"         => array('yes' => "yes"),
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("LG column count", "toranj"),
                "param_name"    => "larg_screen_column_count",
                'description'   => __('<code>Integer value</code>. Number of cols for large screen devices','toranj'),
                "value"         => "5"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("MD column count", "toranj"),
                "param_name"    => "medium_screen_column_count",
                'description'   => __('<code>Integer value</code>. Number of cols for medium screen devices','toranj'),
                "value"         => "4"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("SM column count", "toranj"),
                "param_name"    => "small_screen_column_count",
                'description'   => __('<code>Integer value</code>. Number of cols for small devices','toranj'),
                "value"         => "2"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("XS column count", "toranj"),
                "param_name"    => "small_screen_column_count",
                'description'   => __('<code>Integer value</code>. Number of cols for extra small devices','toranj'),
                "value"         => "1"
            ),
        )
    ),

    'gallery_horizontal' => array(
        "name" => __("Gallery Horizontal", 'toranj'),
        "description" => __("Make a horizontal gallery page", 'toranj'),
        "base" => "toranj_gallery_horizontal",
        "class" => "",
        "controls" => "full",
        "icon" => get_template_directory_uri().'/assets/img/vcicons/gallery.png',
        "category" => __('Gallery', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" => array(
            array(
                "type"          => "checkbox",
                "heading"       => __("Hide sidebar?", "toranj"),
                "param_name"    => "hide_sidebar",
                "value"         => array('yes' => "yes"),
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side Title", "toranj"),
                "param_name"    => "title",
                "value"         => __("Gallery", "toranj"),
                "holder"        => "div"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side upper-Title", "toranj"),
                "param_name"    => "title2",
                "value"         => __("Browse our", "toranj"),
                "description"   => __("You can leave this blank", "toranj")

            ),
            array(
                "type"      => "textarea_html",
                "heading"   => __("Description", "toranj"),
                "param_name"    => "content",
                "value"     => ""
            ),
            array(
                "type"          => "dropdown",
                "heading"       => __("Hover style", "toranj"),
                "param_name"        => "overlay_type",
                "value"             => array(
                                        __('Simple Icon', "toranj")     => "simple-icon",
                                        __('Circle', "toranj")          => "circle",
                                        __('Plus light', "toranj")      => "plus-light",
                                        __('Plus dark', "toranj")       => "plus-dark",
                                        __('Plus colored', "toranj")    => "plus-color"
                                    ),
                "description"   => __("Select style", "toranj"),
                "std"           => "simple-icon"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Album Slug", "toranj"),
                "param_name"    => "album",
                'description'   => __('If you want to restrict to an album then input the <code>slug</code> of the Album. Can be seperated with comma <code>album1,album2,...</code>','toranj')
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Number of photos", "toranj"),
                "param_name"    => "limit",
                'description'   => __('Limit the number of photos, set to 0 to get all','toranj'),
                "value"         => "0"
            ),
            array(
                "type"          => "dropdown",
                "heading"       => __("Items width mode", "toranj"),
                "param_name"    => "width_mode",
                "value"         => array(
                                    __('Fixed Width', "toranj")     => "fixed_width",
                                    __('Width of image', "toranj")  => "image_width"
                                ),
                "std"           => "fixed_width",
                "description"   => __("If you set this to image width items can have different width related to the image ratio", "toranj")
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Item Width in px", "toranj"),
                "param_name"    => "default_width",
                'description'   => __('Width of each item in fixed width mode','toranj'),
                "value"         => "350",
                "dependency"    => array('element' => "width_mode", 'value' => array('fixed_width'))
            ),
            array(
                "type"          => "dropdown",
                "heading"       => __("Fill mode", "toranj"),
                "param_name"    => "fill_mode",
                "value"         => array(
                                    __('Cover', "toranj")     => "fill_cover",
                                    __('Fit', "toranj")  => "fill_fit"
                                ),
                "std"           => "fill_cover",
                "description"   => __("Image fill mode", "toranj"),
                "dependency"    => array('element' => "width_mode", 'value' => array('fixed_width'))
            )
        )
    ),

    'gallery_bootstrap_grid'  =>  array(

        "name" => __("Gallery bootstrap grid", 'toranj'),
        "base" => "toranj_gallery_bootstrap_grid",
        "class" => "",
        "controls" => "full",
        "icon" => get_template_directory_uri().'/assets/img/vcicons/gallery.png',
        "category" => __('Gallery', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" => array(
            array(
                "type"          => "textfield",
                "heading"       => __("Number of Columns", "toranj"),
                "param_name"    => "cols",
                'description'   => __('1 or 2 or 3 or 4','toranj'),
                "value"         => "2"
            ),
            array(
                "type"          => "checkbox",
                "heading"       => __("Enable lightbox?", "toranj"),
                "param_name"    => "lightbox",
                "value"         => array('yes' => "yes"),
            ),
            array(
                "type"          => "dropdown",
                "heading"       => __("Hover style", "toranj"),
                "param_name"        => "overlay_type",
                "value"             => array(
                                        __('Simple Icon', "toranj")     => "simple-icon",
                                        __('Circle', "toranj")          => "circle",
                                        __('Plus light', "toranj")      => "plus-light",
                                        __('Plus dark', "toranj")       => "plus-dark",
                                        __('Plus colored', "toranj")    => "plus-color"
                                    ),
                "std"           => "simple-icon",
                "description" => __("Select style", "toranj"),
                "dependency"        => Array('element' => "lightbox", 'value' => array('yes'))
            ),
            array(
                "type"          => "dropdown",
                "heading"       => __("Query", "toranj"),
                "param_name"        => "type",
                "value"             => array(
                                        __('All', "toranj")             => "all",
                                        __('Specific Album', "toranj")  => "album",
                                        __('Specidic IDs', "toranj")    => "ids",
                                    ),
                "std"           => "all",

            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Albm Slug", "toranj"),
                "param_name"    => "album",
                'description'   => __('If you want to restrict to an album then input the <code>slug</code> of the Album. Can be seperated with comma <code>album1,album2,...</code>','toranj'),
                "dependency"        => Array('element' => "type", 'value' => array('album'))
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Number of photos", "toranj"),
                "param_name"    => "limit",
                'description'   => __('Limit the number of photos, set to 0 to get all','toranj'),
                "value"         => "0",
                "dependency"        => Array('element' => "type", 'value' => array('album', 'all'))
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Specific IDs", "toranj"),
                "param_name"    => "ids",
                'description'   => __('Input Ids of photos, <strong>NO SPACES please</strong> eg: <code>2,33,42,12</code>','toranj'),
                "value"         => "0",
                "dependency"        => Array('element' => "type", 'value' => array('ids'))
            ),
        )
    ),

    'gallery_albums_vertical'  =>  array(

        "name" => __("Gallery Albums (vertical scroll)", 'toranj'),
        "description" => __("List of Albums Page", 'toranj'),
        "base" => "toranj_gallery_albums_vertical",
        "class" => "",
        "controls" => "full",
        "icon" => get_template_directory_uri().'/assets/img/vcicons/gallery.png',
        "category" => __('Gallery', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" => array(
            array(
                "type"          => "checkbox",
                "heading"       => __("Hide sidebar?", "toranj"),
                "param_name"    => "hide_sidebar",
                "value"         => array('yes' => "yes"),
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side Title", "toranj"),
                "param_name"    => "title",
                "value"         => __("Galleries", "toranj"),
                "holder"        => "div"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side upper-Title", "toranj"),
                "param_name"    => "title2",
                "value"         => __("Browse our", "toranj"),
                "description"   => __("You can leave this blank", "toranj")

            ),
            array(
                "type"      => "textarea_html",
                "heading"   => __("Description", "toranj"),
                "param_name"    => "content"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Album Slug", "toranj"),
                "param_name"    => "album",
                'description'   => __('If you want to restrict to an album then input the <code>slug</code> of the Album. Can be seperated with comma <code>album1,album2,...</code>','toranj')
            ),
            array(
                "type"      => "checkbox",
                "heading"   => __("Animate?", "toranj"),
                "param_name"=> "animate",
                "value"     => array(__("Yes, Please",'toranj') => 'yes')
            ),
            array(
                "type"      => "checkbox",
                "heading"   => __("Show album descriptions?", "toranj"),
                "param_name"=> "show_des",
                "value"     => array(__("Yes, Please",'toranj') => 'yes')
            )
        )
    ),

    'gallery_albums_horizontal'  =>  array(

        "name" => __("Gallery Albums (horizontal scroll)", 'toranj'),
        "description" => __("List of Albums Page", 'toranj'),
        "base" => "toranj_gallery_albums_horizontal",
        "class" => "",
        "controls" => "full",
        "icon" => get_template_directory_uri().'/assets/img/vcicons/gallery.png',
        "category" => __('Gallery', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" => array(
            array(
                "type"          => "checkbox",
                "heading"       => __("Hide sidebar?", "toranj"),
                "param_name"    => "hide_sidebar",
                "value"         => array('yes' => "yes"),
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side Title", "toranj"),
                "param_name"    => "title",
                "value"         => __("Galleries", "toranj"),
                "holder"        => "div"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Side upper-Title", "toranj"),
                "param_name"    => "title2",
                "value"         => __("Browse our", "toranj"),
                "description"   => __("You can leave this blank", "toranj")

            ),
            array(
                "type"      => "textarea_html",
                "heading"   => __("Description", "toranj"),
                "param_name"    => "content"
            ),
            array(
                "type"          => "textfield",
                "heading"       => __("Album Slug", "toranj"),
                "param_name"    => "album",
                'description'   => __('If you want to restrict to an album then input the <code>slug</code> of the Album. Can be seperated with comma <code>album1,album2,...</code>','toranj')
            )
        )
    ),



    /*----------------------------------------------------------------------------
    *   GENERAL shortcodes
    *-----------------------------------------------------------------------------*/
	'title' =>  array(
		"name" 			=> __("Title (Totanj Styles) ", 'toranj'),
        //"description" 	=> __("add an Icon-Box", 'toranj'),
        "base" 			=> "toranj_title",
        "class" 		=> "",
        "controls" 		=> "full",
        "icon" 			=> get_template_directory_uri().'/assets/img/vcicons/title.png',
        "category" 		=> __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" 		=> array(
        	array(
				"type" 		=> "textfield",
				"heading" 	=> __("title", "toranj"),
				"holder"    =>'h2',
                "param_name" 	=> "title"
			),
        	array(
				"type" 		=> "textfield",
				"heading" 	=> __("title - upper part", "toranj"),
				"param_name" 	=> "title2",
				'description' => __('Only used for two-line style','toranj')
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Style", "toranj"),
				"param_name" 	=> "style",
				"value" 		=> array(
									'two-line' => "two-line",
									'underlined' => "underlined",
									'lined' => "lined",
									'bordered' => "bordered"
				),
				"description" => __("Select type", "toranj"),
                "std"         => 'two-line'
			),

			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Heading", "toranj"),
				"param_name" 		=> "heading",
				"value" 			=> array(
										'h1' => "h1",
										'h2' => "h2",
										'h3' => "h3",
										'h4' => "h4",
										'h5' => "h5",
									),
				"description" => __("Select heading size", "toranj"),
                "std" => 'h3',
                 "dependency" => array(
                    'element' => 'style',
                    'value' => array( "underlined","lined","bordered" )
                )
			),
            array(
              "type" => "textfield",
              "heading" => __("Extra class name", "toranj"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "toranj")
            ),
        )
	),

	'button' => array(
		"name" => __("Button", 'toranj'),
        //"description" => __("Adds a call to action shortcode", 'toranj'),
        "base" => "toranj_button",
        "class" => "",
        "controls" => "full",
        "icon" => get_template_directory_uri().'/assets/img/vcicons/button.png',
        "category" => __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" => array(
        	array(
				"type" 			=> "textfield",
				"heading" 		=> __("Text", "toranj"),
				"param_name" 	=> "text",
                "holder"        => "button",
                "value"         => "Change me"
			),
			array(
				"type" 			=> "vc_link",
				"heading" 		=> __("Button Link", "toranj"),
				"param_name" 	=> "btn_url",
				'description' 	=> __('link of the button','toranj')
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Style", "toranj"),
				"param_name" 		=> "style",
				"value" 			=> array(
										__('Default', "toranj") 			=> "default",
										__('Toranj', "toranj") 				=> "toranj",
										__('Toranj reverse', "toranj") 		=> "toranj_reverse",
										__('Bootstrap Primary', "toranj") 	=> "bs_primary",
										__('Bootstrap Success', "toranj") 	=> "bs_success",
										__('Bootstrap Info', "toranj") 		=> "bs_info",
										__('Bootstrap Warning', "toranj") 	=> "bs_warninig",
										__('Bootstrap Danger', "toranj") 	=> "bs_danger",
									),
				"description" => __("Select style", "toranj"),
                "std"         => "default"
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Size", "toranj"),
				"param_name" 		=> "size",
				"value" 			=> array(
										__('Large', "toranj") => "large",
										__('Medium', "toranj") => "medium",
										__('Small', "toranj") => "small",
										__('Extra Small', "toranj") => "extera_small"
									),
				"description" => __("Select Size", "toranj"),
                "std"         => "medium"
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Icon class", "toranj"),
				"param_name" 	=> "icon",
				"description" => __("Find your icons at <a href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>. eg. <code>fa-heart</code>. Leave blank to ignore the icon", "toranj")
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Icon Align", "toranj"),
				"param_name" 		=> "icon_align",
				"value" 			=> array(
										__('right', "toranj") => "right",
										__('left', "toranj") => "left"
									),
                "std"           => "right",
				"description" => __("align icon with text", "toranj")
			),
			array(
              "type" => "textfield",
              "heading" => __("Extra class name", "toranj"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "toranj")
            )

        )
	),

	'FontawesomeIcon' => array(
		"name" 			=> __("fontawesome icon", "toranj"),
		"base" 			=> "toranj_single_icon",
		"category" 		=> __('TORANJ', 'toranj'),
		"description" 	=> __('Simple fontawesome icon', 'toranj'),
		"icon" 			=> get_template_directory_uri().'/assets/img/vcicons/flag.png',
		"params" 		=> array(
				array(
					"type" 		=> "textfield",
					"heading" 	=> __("Icon class", "toranj"),
					"param_name" 	=> "icon_class",
                    "value"     => 'fa-heart',
                    "holder"    => "code",
                    "std"       => "fa-heart",
					"description" => __("Enter the class of icon eg:fa-book ( see available class here :http://fontawesome.io/icons/)", "toranj")
				 ),
				 array(
					"type" 		=> "textfield",
					"heading" 	=> __("Icon font size", "toranj"),
					"param_name" 	=> "icon_size",
                    "value"     => '20',
					"description" => __("Enter the size of icon eg:20", "toranj")
				 ),
				array(
					"type" 			=> "colorpicker",
					"heading" 		=> __("Icon color", "toranj"),
					"param_name" 		=> "icon_color",
					"description" 	=> __("Select the color of icon", "toranj"),
                    "std"           => "#888",
					//"dependency" 		=> Array('element' => "bgcolor", 'value' => array('custom'))
				),
				array(
					"type"             => "dropdown",
					"heading" 		   => __("Text align", "toranj"),
					"param_name"       => "icon_align",
					"value"            => array(
						__('Align center', "toranj") => "center",
						__('Align left', "toranj") => "left",
						__('Align right', "toranj") => "right"
					),
                    "std" => 'center',
					"description" => __("Select text align.", "toranj")
				),
				 array(
					"type" => "dropdown",
					"heading" => __("Icon display", "toranj"),
					"param_name" => "icon_display",
					"value" => array(__("inline", "toranj") => "inline", __("block", "toranj") => "block"),
					"description" => __("Select type of display", "toranj"),
					"admin_label" => true
				)
			)
	),

	'IconBox' => array(
		"name" 			=> __("Icon-Box", 'toranj'),
        "description" 	=> __("add an Icon-Box", 'toranj'),
        "base" 			=> "toranj_iconbox",
        "class" 		=> "",
        "controls" 		=> "full",
        "icon" 			=> get_template_directory_uri().'/assets/img/vcicons/icon-box.png',
        "category" 		=> __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" 		=> array(
        	array(
				"type" 		=> "textfield",
				"heading" 	=> __("Title", "toranj"),
				"param_name" 	=> "title",
                "holder"    => "h3",
                "value"     => __("Title", "toranj"),
			),
			array(
				"type" 		=> "textarea_html",
				"heading" 	=> __("Description", "toranj"),
				"param_name" 	=> "content",
                "holder"    => "div",
                "value"     => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt",
			),

        	array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Style", "toranj"),
				"param_name" 		=> "style",
				"value" 			=> array(
										__('Simple', "toranj") => "simple",
										__('Boxed', "toranj") => "boxed",
										__('Centered box', "toranj") => "center"
									),
                "std"           => 'simple',
				"description" => __("Select style of the iconbox", "toranj")
			),
        	array(
				"type" 		=> "textfield",
				"heading" 	=> __("Icon class", "toranj"),
				"param_name" 	=> "icon",
				"description" => __("Find your icons at <a href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>. eg. <code>fa-heart</code>", "toranj")
			),
	   )
	),

	// call to action
	'CallToAction' => array(
		"name" => __("Call to action", 'toranj'),
        "description" => __("Adds a call to action shortcode", 'toranj'),
        "base" => "toranj_CallToAction",
        "class" => "",
        "controls" => "full",
        "icon" => get_template_directory_uri().'/assets/img/vcicons/action.png',
        "category" => __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" => array(
        	array(
				"type" 			=> "textfield",
				"heading" 		=> __("Text", "toranj"),
				"param_name" 	=> "text",
                "value"         => __("Text", "toranj"),
                "holder"        => "div"
			),
        	array(
				"type" 			=> "textfield",
				"heading" 		=> __("Text Font size", "toranj"),
				"param_name" 	=> "text_font",
				'description' 	=> __('Font size in px, input just a number like 18','toranj'),
                "value"         => 18,
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Button text", "toranj"),
				"param_name" 	=> "btn_text",
				'description' 	=> __('This will be displayed on the button','toranj'),
                "value"         => __("Change me", "toranj"),
                "holder"        => "button"
			),
			array(
				"type" 			=> "vc_link",
				"heading" 		=> __("Button Link", "toranj"),
				"param_name" 	=> "btn_url",
				'description' 	=> __('link of the button','toranj')
			)
        )
	),

	//8 styles
	'image_with_hover' => array(
		"name" => __("Image with Hover", 'toranj'),
        "description" => __("Add an image with hover effect", 'toranj'),
        "base" => "toranj_image_hover",
        "class" => "",
        "controls" => "full",
        "icon" => get_template_directory_uri().'/assets/img/vcicons/image.png',
        "category" => __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" => array(
        	array(
				"type" 		=> "attach_image",
				"heading" 	=> __("Image", "toranj"),
				"param_name" 	=> "image",
                "holder"    =>"img"
			),
        	array(
				"type" 		=> "textfield",
				"heading" 	=> __("Title", "toranj"),
				"param_name" 	=> "title",
                "value"     => __("Title", "toranj"),
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Description", "toranj"),
				"param_name" 	=> "des"

			),
        	array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Style", "toranj"),
				"param_name" 		=> "style",
				"value" 			=> array(
										__('Style #1', "toranj") => "style1",
										__('Style #2', "toranj") => "style2",
										__('Style #3', "toranj") => "style3",
										__('Style #4', "toranj") => "style4",
										__('Style #5', "toranj") => "style5",
										__('Style #6', "toranj") => "style6",
										__('Style #7', "toranj") => "style7",
										__('Style #8', "toranj") => "style8",
									),
				"description"   => __("Select style", "toranj"),
                "std"           => "style1"
			),
        	array(
				"type" 		=> "textfield",
				"heading" 	=> __("Icon class", "toranj"),
				"param_name" 	=> "icon",
				"description" => __("Find your icons at <a href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>. eg. <code>fa-heart</code>", "toranj")
			),

			array(
				"type" 			=> "checkbox",
				"heading" 		=> __("HyperLink the Image?", "toranj"),
				"param_name" 	=> "hyperlink",
				'value' 		=> array(
									__('yes','toranj') =>'yes'
					)
			),
			array(
				"type" 			=> "vc_link",
				"heading" 		=> __("Image Link", "toranj"),
				"param_name" 	=> "btn_url",
				'description' 	=> __('link of the Image','toranj'),

			),

        )
	),

	'services_container' => array(
		"name" => __("Services Container", "toranj"),
		"base" => "toranj_services_container",
		"as_parent" => array('only' => 'toranj_services_single'),
		"content_element" => true,
		"show_settings_on_create" => false,
		"icon" => get_template_directory_uri().'/assets/img/vcicons/services.png',
		"category" => __('TORANJ', 'toranj'),
		"js_view" => 'VcColumnView',
		"params" => array(

			array(
			  "type" => "textfield",
			  "heading" => __("Widget title", "toranj"),
			  "param_name" => "pos-widget_title",
			  "description" => __("Enter widget title", "toranj"),
              "value"   => __("Widget title", "toranj"),

			),
			array(
			  "type" => "textfield",
			  "heading" => __("Extra class name", "toranj"),
			  "param_name" => "el_class",
			  "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "toranj")
			)
		),
	),

	'services_single' => array(
		"name" => __("Services Single item", 'toranj'),
        //"description" => __("Add an image with hover effect", 'toranj'),
        "base" => "toranj_services_single",
        "class" => "",
        "controls" => "full",
        "as_child" => array('only' => 'toranj_services_container'),
        "icon" => get_template_directory_uri().'/assets/img/vcicons/services.png',
        "category" => __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" => array(
        	array(
				"type" 		=> "textfield",
				"heading" 	=> __("Title", "toranj"),
				"param_name"=> "title",
                "value"     => __("Title", "toranj"),
                "holder"    => "h2"
			),
			array(
				"type" 		=> "textarea_html",
				"heading" 	=> __("Description", "toranj"),
				"param_name" 	=> "content",
                "value"     => "Some contents here",
                "holder"    => "div"
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Icon class", "toranj"),
				"param_name" 	=> "icon",
				"description" => __("Find your icons at <a href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>. eg. <code>fa-heart</code>", "toranj")
			),
        )
	),

	'skill_item' => array(
		"name" 			=> __("Skill bar", 'toranj'),
        //"description" 	=> __("add an Icon-Box", 'toranj'),
        "base" 			=> "toranj_skillbar",
        "class" 		=> "",
        "controls" 		=> "full",
        "icon" 			=> get_template_directory_uri().'/assets/img/vcicons/skills.png',
        "category" 		=> __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" 		=> array(
        	array(
				"type" 		    => "textfield",
				"heading" 	    => __("Title", "toranj"),
				"param_name"    => "title",
                "value"         => __("Title", "toranj"),
                "holder"        => "span"
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Percentage", "toranj"),
				"param_name" 	=> "percent",
                "value"         => "50",
                "holder"        => "code"
			),
        )
	),

	'personnel' => array(

		"name" 			=> __("Personnel", 'toranj'),
        //"description" 	=> __("add an Icon-Box", 'toranj'),
        "base" 			=> "toranj_personnel",
        "class" 		=> "",
        "controls" 		=> "full",
        "icon" 			=> get_template_directory_uri().'/assets/img/vcicons/personnel.png',
        "category" 		=> __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" 		=> array(
        	array(
				"type" 		=> "textfield",
				"heading" 	=> __("Name", "toranj"),
				"param_name"=> "name",
                "value"     => "John Doe",
                "holder"    => "h4"
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("title", "toranj"),
				"param_name" 	=> "title"
			),
			array(
				"type" 		=> "attach_image",
				"heading" 	=> __("Image", "toranj"),
				"param_name" 	=> "image",
                "holder"    => "img"
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Social Icon #1", "toranj"),
				"param_name" 	=> "icon1",
				"description" => __("Find your icons at <a href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>. eg. <code>fa-heart</code>", "toranj")
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Social link #1", "toranj"),
				"param_name" 	=> "title1",
				"description" => __("Add social media link", "toranj")
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Social Icon #2", "toranj"),
				"param_name" 	=> "icon2",
				"description" => __("Find your icons at <a href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>. eg. <code>fa-heart</code>", "toranj")
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Social link #2", "toranj"),
				"param_name" 	=> "title2",
				"description" => __("Add social media link", "toranj")
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Social Icon #3", "toranj"),
				"param_name" 	=> "icon3",
				"description" => __("Find your icons at <a href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>. eg. <code>fa-heart</code>", "toranj")
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Social link #3", "toranj"),
				"param_name" 	=> "title3",
				"description" => __("Add social media link", "toranj")
			),
        )
	),

	'announce_box' => array(
		"name" 			=> __("Announce box", 'toranj'),
        //"description" 	=> __("add an Icon-Box", 'toranj'),
        "base" 			=> "toranj_announce_box",
        "class" 		=> "",
        "controls" 		=> "full",
        "icon" 			=> get_template_directory_uri().'/assets/img/vcicons/announce.png',
        "category" 		=> __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" 		=> array(
        	array(
				"type" 		=> "textarea_html",
				"heading" 	=> __("Content", "toranj"),
				"param_name" 	=> "content",
                "value"     => "Some Content",
                "holder"    => "div"
			)

        )
	),

	//container
	'list_container' =>  array(
		"name" 			=> __("List Container", 'toranj'),
        "description" 	=> __("Container for list items", 'toranj'),
        "base" 			=> "toranj_list_container",
        "class" 		=> "",
        "controls" 		=> "full",
        "icon" 			=> get_template_directory_uri().'/assets/img/vcicons/list.png',
        "category" 		=> __('TORANJ', 'toranj'),
        "as_parent" => array('only' => 'toranj_list_item'),
		"content_element" => true,
		"show_settings_on_create" => true,
		"js_view" => 'VcColumnView',
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" 		=> array(
        	array(
			  "type" => "textfield",
			  "heading" => __("Widget title", "toranj"),
			  "param_name" => "pos-widget_title",
			  "description" => __("Enter widget title", "toranj")
			),
			array(
			  "type" => "checkbox",
			  "heading" => __("Add border?", "toranj"),
			  "param_name" => "border",
			  'value' => array(
			  		'yes' => 'yes'
			  	)
			),
			array(
			  "type" => "checkbox",
			  "heading" => __("Add Hover effect?", "toranj"),
			  "param_name" => "hover",
			  'value' => array(
			  		'yes' => 'yes'
			  	)
			),

			array(
			  "type"         => "dropdown",
			  "heading"      => __("Style", "toranj"),
			  "param_name"   => "style",
			  'value'        => array(
			  		'with icon' => 'with-icon',
			  		'un-styled' => 'un-styled'
			  ),
              "std"         => "with-icon"
			),

			array(
			  "type" => "dropdown",
			  "heading" => __("Icon Style", "toranj"),
			  "param_name" => "iconstyle",
			  'value' => array(
			  		__('Simple', 'toranj') => 'simple',
			  		__('Circle border', 'toranj') => 'circle',
			  		__('Square border', 'toranj') => 'square',
			  ),
              "std"         => "simple"
			),

			array(
			  "type" => "textfield",
			  "heading" => __("Extra class name", "toranj"),
			  "param_name" => "el_class",
			  "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "toranj")
			),
        )
	),

	'list_item' =>  array(
		"name" 			=> __("List item", 'toranj'),
        "description" 	=> __("Single list item", 'toranj'),
        "base" 			=> "toranj_list_item",
        "class" 		=> "",
        "controls" 		=> "full",
        "icon" 			=> get_template_directory_uri().'/assets/img/vcicons/list.png',
        "category" 		=> __('TORANJ', 'toranj'),
        "as_child" => array('only' => 'toranj_list_container'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" 		=> array(

        	array(
			  "type" => "textfield",
			  "heading" => __("Content", "toranj"),
			  "param_name" => "text",
			  "description" => __("Enter item content", "toranj"),
              "value"       => "some content",
              "holder"      => "div"
			),

			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Icon class", "toranj"),
				"param_name" 	=> "icon",
				"description" => __("Note: You should set the <code>with-icon</code> style for the parent container.", "toranj"),
                "value"     => "fa-heart",
			),

			array(
				"type" 			=> "vc_link",
				"heading" 		=> __("Button Link", "toranj"),
				"param_name" 	=> "btn_url",
				'description' 	=> __('link of the button','toranj')
			),


        )
	),

	'single_light_box' => array(
		"name" 			=> __("Single Light box", 'toranj'),
        //"description" 	=> __("add an Icon-Box", 'toranj'),
        "base" 			=> "toranj_single_ligtbox",
        "class" 		=> "",
        "controls" 		=> "full",
        "icon" 			=> get_template_directory_uri().'/assets/img/vcicons/lightbox.png',
        "category" 		=> __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" 		=> array(
        	array(
				"type" 		=> "attach_image",
				"heading" 	=> __("Image", "toranj"),
				"param_name" 	=> "image",
                "holder"    => "img"
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Icon", "toranj"),
				"param_name" 	=> "icon",
				"description" => __("Find your icons at <a href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>. eg. <code>fa-heart</code>", "toranj"),
                "value"     => "fa-heart"
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("overlay", "toranj"),
				"param_name" 	=> "overlay",
				"value" 		=> array(
										__('Style #1', "toranj") => "style1",
										__('Style #2', "toranj") => "style2",
										__('Style #3', "toranj") => "style3",
										__('Style #4', "toranj") => "style4"
									),
				"description"   => __("Select overlay style", "toranj"),
                "std"           => "style1"
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Type", "toranj"),
				"param_name" 	=> "type",
				"value" 		=> array(
										__('Image', "toranj") => "image",
										__('Youtube', "toranj") => "youtube",
										__('Vimeo', "toranj") => "vimeo",
										//__('Hosted video', "toranj") => "style4" //i am not ready for this
									),
				"description"   => __("Select lightbox type", "toranj"),
                "std"           => "image"
			),
			array(
				"type"          => "textfield",
				"heading"       => __("External url", "toranj"),
				"param_name" 	=> "ext_url",
				"description"   => __('Youtube: <code>http://www.youtube.com/watch?v=0O2aH4XLbto</code><br>vimeo: <code>https://vimeo.com/45830194</code><br>','toranj')
			)
        )
	),

	'gallery_light_box_single' => array(

		"name" 			=> __("Single Light box For gallery", 'toranj'),
        //"description" 	=> __("add an Icon-Box", 'toranj'),
        "base" 			=> "toranj_gallery_light_box_single",
        "class" 		=> "",
        "controls" 		=> "full",
        "icon" 			=> get_template_directory_uri().'/assets/img/vcicons/lightbox.png',
        "category" 		=> __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" 		=> array(
        	array(
				"type" 		=> "textfield",
				"heading" 	=> __("Title at Gallery", "toranj"),
				"param_name" 	=> "title",
                "value"     => __("Title at Gallery", "toranj"),
                "holder"    => "div"
			),
        	array(
				"type" 		=> "attach_image",
				"heading" 	=> __("Image cover", "toranj"),
				"param_name" 	=> "image",
				"description"  => __('No mater what, I need an Image it is required','toranj'),
                "holder"    => "img",
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("MP4 URL", "toranj"),
				"param_name" 	=> "mp4",
				"description" => __("leave blank to use only the cover image, if you fill this field it will use this video as the cover instead of thumbnail.<br> Get the address from your media section or your external repository.", "toranj")
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("webm URL", "toranj"),
				"param_name" 	=> "webm",
				"description" => __("the <code>.webm</code> file. Get the address from your media section or your external repository.", "toranj")
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("ogv URL", "toranj"),
				"param_name" 	=> "ogv",
				"description" => __("the <code>.ogv</code> file. Get the address from your media section or your external repository.", "toranj")
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Icon", "toranj"),
				"param_name" 	=> "icon",
				"description" => __("Find your icons at <a href='http://fontawesome.io/icons/'>http://fontawesome.io/icons/</a>. eg. <code>fa-heart</code>", "toranj")
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("overlay", "toranj"),
				"param_name" 	=> "overlay",
				"value" 		=> array(
										__('Style #1', "toranj") => "style1",
										__('Style #2', "toranj") => "style2",
										__('Style #3', "toranj") => "style3",
										__('Style #4', "toranj") => "style4"
									),
				"description"   => __("Select overlay style", "toranj"),
                "std"           => "style1"
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Type", "toranj"),
				"param_name"    => "type",
				"value" 	   => array(
										__('Image', "toranj") => "image",
										__('Youtube', "toranj") => "youtube",
										__('Vimeo', "toranj") => "vimeo",
										//__('Hosted video', "toranj") => "style4" //i am not ready for this
									),
				"description"   => __("Select lightbox type", "toranj"),
                "std"           => "image"
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("External url", "toranj"),
				"param_name" 	=> "ext_url",
				"description" => __('Youtube: <code>http://www.youtube.com/watch?v=0O2aH4XLbto</code><br>vimeo: <code>https://vimeo.com/45830194</code><br>','toranj')
			)
        )
	),

	// 'external_video' => array(
	// 	"name" 			=> __("External Video", 'toranj'),
 //        "description" 	=> __("Youtube and Vimeo video player", 'toranj'),
 //        "base" 			=> "toranj_external_video",
 //        "class" 		=> "",
 //        "controls" 		=> "full",
 //        "icon" 			=> get_template_directory_uri().'/assets/img/vcicons/toranj-icon.png',
 //        "category" 		=> __('TORANJ', 'toranj'),
 //        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
 //        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
 //        "params" 		=> array(
 //        	array(
 //        		"type" 		=> "textarea",
	// 			"heading" 	=> __("Embed code", "toranj"),
	// 			"param_name" 	=> "iframe",
	// 			"description" => __('Youtube and Vimeo embed code, and iframe tage.','toranj'),
 //                "holder"    =>"iframe"
	// 		)
 //        )
	// ),

	'html5_video' => array(
		"name" 			=> __("HTML5 Video", 'toranj'),
        "description" 	=> __("HTML5 Video player", 'toranj'),
        "base" 			=> "toranj_html5_video",
        "class" 		=> "",
        "controls" 		=> "full",
        "icon" 			=> get_template_directory_uri().'/assets/img/vcicons/video.png',
        "category" 		=> __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" 		=> array(
        	array(
				"type" 		=> "attach_image",
				"heading" 	=> __("Image cover", "toranj"),
				"param_name" 	=> "image",
				"description"  => __('No mater what, I need an Image it is required','toranj'),
                "holder"    => "img"
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("MP4 URL", "toranj"),
				"param_name" 	=> "mp4",
				"description" => __("Get the address from your media section or your external repository.", "toranj")
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("webm URL", "toranj"),
				"param_name" 	=> "webm",
				"description" => __("the <code>.webm</code> file. Get the address from your media section or your external repository.", "toranj")
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("ogv URL", "toranj"),
				"param_name" 	=> "ogv",
				"description" => __("the <code>.ogv</code> file. Get the address from your media section or your external repository.", "toranj")
			),
        )
	),

	'caption' => array(
		"name" 			=> __("Caption for Media", 'toranj'),
        "base" 			=> "toranj_caption",
        "class" 		=> "",
        "controls" 		=> "full",
        "icon" 			=> get_template_directory_uri().'/assets/img/vcicons/caption.png',
        "category" 		=> __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" 		=> array(


            array(
                "type"          => "dropdown",
                "heading"       => __("Choose preset caption", "toranj"),
                "param_name"        => "preset",
                "value"             => array(
                                        __('-- Select a preset --', "toranj") => "",
                                        __('Big Title with Desc', "toranj") => "1",
                                        __('Big Title only', "toranj")      => "2",
                                        __('Two Line Title', "toranj")      => "3",
                                        __('Bordered', "toranj")            => "4",
                                        __('Center Bottom', "toranj")       => "5",
                                        __('Boxed', "toranj")               => "6",
                                        __('Ribbon', "toranj")              => "7",
                                        __('Accent', "toranj")              => "8",
                                    ),
                "description" => __("Select style", "toranj"),
            ),
            // ---------------------------------------------------------------------
            //general fileds
            //----------------------------------------------------------------------
        	array(
				"type" 		=> "textfield",
				"heading" 	=> __("Title", "toranj"),
				"param_name" 	=> "title",
                "value"     => "Title",
                "holder"    => "h4",
                'dependency' => array(
                    'element' => 'preset',
                    'value' => array( "1","2","3","4","5","6","7","8" )
                )
			),
            array(
                "type"      => "textfield",
                "heading"   => __("Sub-title", "toranj"),
                "param_name"    => "sub_title",
                "value"     => "sub_title",
                'dependency' => array(
                    'element' => 'preset',
                    'value' => array( "3","8" )
                )
            ),
        	array(
				"type" 		=> "textarea_html",
				"heading" 	=> __("Description", "toranj"),
				"param_name" 	=> "content",
                "value"     => "Description",
                "holder"    => "div",
                'dependency' => array(
                    'element' => 'preset',
                    'value' => array( "1","2","3","4","5","6","7" )
                )
			),

            array(
                "type"          => "dropdown",
                "heading"       => __("Position", "toranj"),
                "param_name"        => "position4",
                "value"             => array(
                                        __('bottom-left','toranj')  => 'bottom-left',
                                        __('top-left','toranj')     => 'top-left',
                                        __('bottom-right','toranj') => 'bottom-right',
                                        __('top-right','toranj')    => 'top-right',
                                    ),
                "description" => __("Caption postion", "toranj"),
                "std"           => "bottom-left",
                'dependency' => array(
                    'element' => 'preset',
                    'value' => array( "4","6" )
                )
            ),
            array(
                "type"          => "dropdown",
                "heading"       => __("Position", "toranj"),
                "param_name"        => "position2",
                "value"             => array(
                                        __('bottom','toranj')  => 'bottom',
                                        __('top','toranj')     => 'top',
                                    ),
                "description" => __("Caption postion", "toranj"),
                "std"           => "bottom",
                'dependency' => array(
                    'element' => 'preset',
                    'value' => array( "7" )
                )
            ),
            array(
                "type"          => "dropdown",
                "heading"       => __("Style of caption", "toranj"),
                "param_name"        => "dark_light",
                "value"             => array(
                                        __('dark','toranj')  => 'dark',
                                        __('light','toranj') => 'light',
                                    ),
                "std"           => "dark",
                'dependency'    => array(
                    'element' => 'preset',
                    'value' => array( "6","7" )
                )
            ),
            // ---------------------------------------------------------------------
            //button
            //----------------------------------------------------------------------
            array(
                "type"      => "checkbox",
                "heading"   => __("Add button?", "toranj"),
                "param_name"    => "add_button",
                "value"     => array(__("Yes, please", 'toranj')=>'yes'),
            ),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Button Label", "toranj"),
				"param_name" 	=> "label",
				"description" => __("Text on button", "toranj"),
                "value"     => "some text",
                'dependency' => array(
                    'element' => 'add_button',
                    'value' => array( 'yes' )
                )
			),

			array(
				"type" 		=> "vc_link",
				"heading" 	=> __("Button Hyperlink", "toranj"),
				"param_name" 	=> "link",
                'dependency' => array(
                    'element' => 'add_button',
                    'value' => array( 'yes' )
                )
			),

			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Button Style", "toranj"),
				"param_name" 		=> "style",
				"value" 			=> array(
										__('Default', "toranj") 			=> "default",
										__('Toranj', "toranj") 				=> "toranj",
										__('Toranj reverse', "toranj") 		=> "toranj_reverse",
										__('Bootstrap Primary', "toranj") 	=> "bs_primary",
										__('Bootstrap Success', "toranj") 	=> "bs_success",
										__('Bootstrap Info', "toranj") 		=> "bs_info",
										__('Bootstrap Warning', "toranj") 	=> "bs_warninig",
										__('Bootstrap Danger', "toranj") 	=> "bs_danger",
									),
				"description" => __("Select style", "toranj"),
                "std"           => "default",
                'dependency' => array(
                    'element' => 'add_button',
                    'value' => array( 'yes' )
                )
			),
            // ---------------------------------------------------------------------
            //media type
            //----------------------------------------------------------------------
            array(
                "type" => "dropdown",
                "heading" => __('Media type','toranj'),
                "param_name" => 'media_type',
                "description" => __('What media you want to use as the caption background?','toranj'),
                "value" => array(
                        __('image','toranj') => "image",
                        __('video','toranj') => "video",
                        __('none','toranj') => "none",
                    ),
                "std"           => "video",
            ),

        	array(
				"type" 		=> "attach_image",
				"heading" 	=> __("Image cover", "toranj"),
				"param_name" 	=> "image",
				"description"  => __('No mater what, I need an Image it is <strong>required</strong>','toranj'),
                "holder"    => "img",
                'dependency' => array(
                    'element' => 'media_type',
                    'value' => array( 'image','video' )
                )
			),
            array(
                'type' => 'textfield',
                'heading' => __( 'Image size', 'toranj' ),
                'param_name' => 'img_size',
                'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'toranj' ),
                'dependency' => array(
                    'element' => 'media_type',
                    'value' => array( 'image','video' )
                ),
                'value' => 'full'
            ),

			array(
				"type" 		=> "textfield",
				"heading" 	=> __("MP4 URL", "toranj"),
				"param_name" 	=> "mp4",
				"description" => __("<code>Required if you want it to be video</code> .mp4 file url. Get the address from your media section or your external repository.", "toranj"),
                'dependency' => array(
                    'element' => 'media_type',
                    'value' => array( 'video' )
                )
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("webm URL", "toranj"),
				"param_name" 	=> "webm",
				"description" => __("the <code>.webm</code> file. Get the address from your media section or your external repository.", "toranj"),
                'dependency' => array(
                    'element' => 'media_type',
                    'value' => array( 'video' )
                )
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("ogv URL", "toranj"),
				"param_name" 	=> "ogv",
				"description" => __("the <code>.ogv</code> file. Get the address from your media section or your external repository.", "toranj"),
                'dependency' => array(
                    'element' => 'media_type',
                    'value' => array( 'video' )
                )
			),
            array(
                "type"      => "checkbox",
                "heading"   => __("Autolay?", "toranj"),
                "desc"      => __("By default the video is hover play, check here to make it auto play.","toranj"),
                "param_name"    => "autoplay",
                "value"     => array(__("Yes, please", 'toranj')=>'yes'),
                'dependency' => array(
                    'element' => 'media_type',
                    'value' => array( 'video' )
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Extra class name', 'toranj' ),
                'param_name' => 'el_class',
                'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'toranj' )
            )
        )
	),


	'compare_image' => array(

		"name" 			=> __("Image Compare", 'toranj'),
        "base" 			=> "toranj_compare_image",
        "class" 		=> "",
        "controls" 		=> "full",
        "icon" 			=> get_template_directory_uri().'/assets/img/vcicons/compare.png',
        "category" 		=> __('TORANJ', 'toranj'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params" 		=> array(
        	array(
				"type" 		=> "attach_image",
				"heading" 	=> __("First Image", "toranj"),
				"param_name" 	=> "image1",
                "holder"    =>"img"
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Text on First Image", "toranj"),
				"param_name" 	=> "text1"
			),
			array(
				"type" 		=> "attach_image",
				"heading" 	=> __("Second Image", "toranj"),
				"param_name" 	=> "image2",
                "holder"    =>"img"
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Text on Second Image", "toranj"),
				"param_name" 	=> "text2"
			),
			array(
				"type" 		=> "textfield",
				"heading" 	=> __("Gap", "toranj"),
				"param_name" 	=> "gap",
				"description" => __('gap between two images compare in px','toranj')
			),
       	),
	),

    'double_carousel_container' => array(
        "name"          => __("Double Carousel", 'toranj'),
        "description"   => __("Build a Double carousel page", 'toranj'),
        "base"          => "toranj_double_carousel_container",
        "class"         => "",
        "controls"      => "full",
        "icon"          => get_template_directory_uri().'/assets/img/vcicons/toranj-icon.png',
        "category"      => __('TORANJ', 'toranj'),
        "as_parent" => array('only' => 'toranj_double_carousel_item'),
        "content_element" => true,
        "show_settings_on_create" => true,
        "js_view" => 'VcColumnView',
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params"        => array(


            array(
                "type"        => "dropdown",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Right Side dirrection", "toranj"),
                "param_name"  => "rightsidedir",
                "value"       => array(
                      __('down', 'toranj') => 'down',
                      __('up', 'toranj') => 'up',
                  ),
            ),
            array(
                "type"        => "textfield",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Right Side duration", "toranj"),
                "param_name"  => "rightsideduration",
                "value"       => "1",
                "description" => __("Seconds","toranj")
            ),
            array(
                "type"        => "dropdown",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Left Side dirrection", "toranj"),
                "param_name"  => "leftsidedir",
                "value"       => array(
                      __('down', 'toranj') => 'down',
                      __('up', 'toranj') => 'up',
                  ),
            ),
            array(
                "type"        => "textfield",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Left Side duration", "toranj"),
                "param_name"  => "leftsideduration",
                "value"       => "1",
                "description" => __("Seconds","toranj")
            ),

            array(
                "type"        => "checkbox",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Enable mouse wheel navigation?", "toranj"),
                "param_name"  => "mouse",
                "value"       => array(
                      __('No, thanks', 'toranj') => 'no'
                  )
            ),
            array(
                "type"        => "checkbox",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Enable keyboard navigation?", "toranj"),
                "param_name"  => "keyboard",
                "value"       => array(
                      __('No, thanks', 'toranj') => 'no'
                  ),
            ),
            array(
                "type"        => "checkbox",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Enable touch?", "toranj"),
                "param_name"  => "touchswipe",
                "value"       => array(
                      __('No, thanks', 'toranj') => 'no'
                  ),
            ),
            array(
                "type"        => "checkbox",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Show navigation bullets?", "toranj"),
                "param_name"  => "bulletcontroll",
                "value"       => array(
                      __('No, thanks', 'toranj') => 'no'
                  ),
            ),
            array(
                "type"        => "checkbox",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Show numbers instead of bullets?", "toranj"),
                "param_name"  => "bulletnumber",
                "value"       => array(
                      __('Yes, please', 'toranj') => 'yes'
                  ),
            ),
            array(
                "type"        => "dropdown",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Carousel pager position", "toranj"),
                "param_name"  => "bulletcenter",
                "value"       => array(
                      __('vertical', 'toranj') => 'vertical',
                      __('horizontal', 'toranj') => 'horizontal',
                  ),
            ),
            array(
                "type"        => "checkbox",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Show navigation arrows?", "toranj"),
                "param_name"  => "show_nav",
                "value"       => array(
                      __('Yes, please', 'toranj') => 'yes'
                  ),
            ),
            array(
                "type"        => "checkbox",
                "heading"     => __("Enable autoplay?", "toranj"),
                "param_name"  => "autoplay",
                "value"       => array(__('Yes, Please', 'toranj')=>'yes'),
            ),
            array(
              "type" => "textfield",
              "heading" => __("Autoplay duration", "toranj"),
              "param_name" => "duration",
              "description" => __("Duration of changing slides (in second)", "toranj"),
              'value'=>5,
              'dependency' => array(
                    'element' => 'autoplay',
                    'value' => array( 'yes')
                )
            ),

            array(
              "type" => "textfield",
              "heading" => __("Extra class name", "toranj"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "toranj")
            )
        ),

    ),

    'double_carousel_item' =>  array(
        "name"          => __("Double Carousel Slide", 'toranj'),
        "description"   => __("Add slide to your carousel", 'toranj'),
        "base"          => "toranj_double_carousel_item",
        "class"         => "",
        "controls"      => "full",
        "icon"          => get_template_directory_uri().'/assets/img/vcicons/toranj-icon.png',
        "category"      => __('TORANJ', 'toranj'),
        "as_child"      => array('only' => 'toranj_double_carousel_container'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
        "params"        => array(
            array(
                "type"        => "attach_image",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Image", "toranj"),
                "param_name"  => "image",
                "holder"      => 'img',
            ),
            array(
                "type"        => "colorpicker",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Background Color", "toranj"),
                "param_name"  => "bgcolor",
                "std"         => "#444"
            ),
            array(
                "type"        => "dropdown",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Content Type", "toranj"),
                "param_name"  => "content_type",
                "description" => __("Select the content type", "toranj"),
                "value"       => array(
                      __('Team carousel style', 'toranj') => 'default',
                      __('Let me do my own', 'toranj') => 'my_own',
                  ),
            ),

            array(
                "type"        => "textfield",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("title", "toranj"),
                "param_name"  => "title",
                "description" => __("title or the Firstname", "toranj"),
                "value"       => 'Firstname',
                'dependency' => array(
                    'element' => 'content_type',
                    'value' => array( 'default')
                )
            ),

            array(
                "type"        => "textfield",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Big Title", "toranj"),
                "param_name"  => "big_title",
                "description" => __("Big title of Lastname", "toranj"),
                "value"       => 'Lastname',
                "admin_label" => true,
                'dependency' => array(
                    'element' => 'content_type',
                    'value' => array( 'default')
                )
            ),

            array(
                "type"        => "textarea_html",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Description", "toranj"),
                "param_name"  => "content",
                //"description" => __("Big title of Lastname", "toranj"),
                "value"       => 'some description',
                'dependency' => array(
                    'element' => 'content_type',
                    'value' => array( 'default')
                )
            ),

            array(
                "type"        => "checkbox",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Add social icons?", "toranj"),
                "param_name"  => "add_socials",
                "value"       => array(__('Yes, Please', 'toranj')=>'yes'),
                'dependency' => array(
                    'element' => 'content_type',
                    'value' => array( 'default')
                )
            ),

            array(
                "type"        => "textfield",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Facebook URL", "toranj"),
                "param_name"  => "facebook",
                'dependency' => array(
                    'element' => 'content_type',
                    'value' => array( 'default')
                )

            ),
            array(
                "type"        => "textfield",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Twitter URL", "toranj"),
                "param_name"  => "twitter",
                'dependency' => array(
                    'element' => 'content_type',
                    'value' => array( 'default')
                )
            ),
            array(
                "type"        => "textfield",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("LinkedIn URL", "toranj"),
                "param_name"  => "linkedin",
                'dependency' => array(
                    'element' => 'content_type',
                    'value' => array( 'default')
                )
            ),
            array(
                "type"        => "textfield",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Instagram URL", "toranj"),
                "param_name"  => "instagram",
                'dependency' => array(
                    'element' => 'content_type',
                    'value' => array( 'default')
                )
            ),
            array(
                "type"        => "textfield",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Flickr URL", "toranj"),
                "param_name"  => "flicker",
                'dependency' => array(
                    'element' => 'content_type',
                    'value' => array( 'default')
                )
            ),
            array(
                "type"        => "textfield",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("Google+ URL", "toranj"),
                "param_name"  => "google",
                'dependency' => array(
                    'element' => 'content_type',
                    'value' => array( 'default')
                )
            ),
            array(
                "type"        => "textarea_raw_html",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                "heading"     => __("My own content", "toranj"),
                "description" => __("Add your own HTML markup here","toranj"),
                "param_name"  => "my_left_content",
                'dependency' => array(
                    'element' => 'content_type',
                    'value' => array( 'my_own')
                )
            ),
            array(
              "type" => "textfield",
              "heading" => __("Extra class name", "toranj"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "toranj")
            )

        )
    ),

    'video_background' =>  array(
        "name"          => __("Video background", 'toranj'),
        "description"   => __("Add Self hosted video", 'toranj'),
        "base"          => "toranj_video_background",
        "class"         => "",
        "controls"      => "full",
        "icon"          => get_template_directory_uri().'/assets/img/vcicons/toranj-icon.png',
        "category"      => __('TORANJ', 'toranj'),
        "params"        => array(

            array(
                "type"      => "attach_image",
                "heading"   => __("Image cover", "toranj"),
                "param_name"    => "image",
                "description"  => __('No mater what, I need an Image it is required','toranj'),
                "holder"    => "img"
            ),
            array(
                "type"      => "textfield",
                "heading"   => __("MP4 URL", "toranj"),
                "param_name"    => "mp4",
                "description" => __("Get the address from your media section or your external repository.", "toranj")
            ),
            array(
                "type"      => "textfield",
                "heading"   => __("webm URL", "toranj"),
                "param_name"    => "webm",
                "description" => __("the <code>.webm</code> file. Get the address from your media section or your external repository.", "toranj")
            ),
            array(
                "type"      => "textfield",
                "heading"   => __("ogv URL", "toranj"),
                "param_name"    => "ogv",
                "description" => __("the <code>.ogv</code> file. Get the address from your media section or your external repository.", "toranj")
            ),
            array(
                "type"          => "vc_link",
                "heading"       => __("Link", "toranj"),
                "param_name"    => "link",
                'description'   => __('link the video','toranj')
            ),
            array(
                "type"          => "dropdown",
                "heading"       => __("Play Mode", "toranj"),
                "param_name"        => "play_mode",
                "value"             => array(
                                        __('Hover Play', "toranj")     => "hoverPlay",
                                        __('Auto Play', "toranj")      => "autoplay",
                                    )
            ),
            array(
                "type"      => "textfield",
                "heading"   => __("Caption text", "toranj"),
                "param_name"    => "caption",
            ),
            array(
                "type"          => "checkbox",
                "heading"       => __("Turn off mute mode?", "toranj"),
                "param_name"    => "mute_off",
                "value"         => array(__('Yes, please','toranj') => "yes"),
            ),
            array(
              "type" => "textfield",
              "heading" => __("Extra class name", "toranj"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "toranj")
            )

        )
    ),
);

/**
 * ----------------------------------------------------------------------------------------
 * declare parrent elements
 * ----------------------------------------------------------------------------------------
 */
if ( defined( 'WPB_VC_VERSION' ) ) {

	class WPBakeryShortCode_toranj_services_container extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_toranj_list_container extends WPBakeryShortCodesContainer {}


    class WPBakeryShortCode_toranj_button extends WPBakeryShortCode{
        public function outputTitle($title){
            return '';
        }
    }

    class WPBakeryShortCode_toranj_double_carousel_container extends WPBakeryShortCodesContainer {}


}

/**
 * ----------------------------------------------------------------------------------------
 * add parameters to elements
 * ----------------------------------------------------------------------------------------
 */
if ( defined( 'WPB_VC_VERSION' ) ) {

    vc_add_param('vc_row',array(
        'type' => 'dropdown',
        'class' => '',
        'heading' => __('Content width','toranj'),
        'param_name' => 'row_content_width',
        'value' => array(
            __('Fullwidth','toranj') => 'fullwidth',
            __('Contained','toranj') => 'contained'
        ),
        'description' => __('This option only works at <code>fullwidth</code> page templates','toranj')

    ));


}


/**
 * ----------------------------------------------------------------------------------------
 * Finally initialize code
 * ----------------------------------------------------------------------------------------
 */
new Owlab_vc_extend($shortcodes);



/**
 * ----------------------------------------------------------------------------------------
 * add existing shortcodes to vc
 * ----------------------------------------------------------------------------------------
 */
if ( defined( 'WPB_VC_VERSION' ) ) {

    if (class_exists('Owlabkbs')) {
        add_action( 'vc_before_init', 'kenburnslider_integrateWithVC' );
        function kenburnslider_integrateWithVC(){
            vc_map(
                array(
                    "name"          => __("Kenburen Slider", 'toranj'),
                    "base"          => "owlabkbs",
                    "class"         => "",
                    "controls"      => "full",
                    "icon"          => get_template_directory_uri().'/assets/img/vcicons/toranj-icon.png',
                    "category"      => __('TORANJ', 'toranj'),
                    //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
                    //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
                    "params"        => array(
                        array(
                            "type"      => "textfield",
                            "heading"   => __("Slider ID", "toranj"),
                            "param_name"    => "id",
                            "admin_label"    =>true,
                            "description"   =>__("Input the numeric id of the slider","toranj")
                        ),

                    ),
                )
            );
        }
    }

    add_action( 'vc_before_init', 'dropcap_integrateWithVC' );
    function dropcap_integrateWithVC(){
        vc_map(
            array(
                "name"          => __("Drop-cap", 'toranj'),
                "base"          => "owlab_dropcap",
                "class"         => "",
                "controls"      => "full",
                "icon"          => get_template_directory_uri().'/assets/img/vcicons/dropcap.png',
                "category"      => __('TORANJ', 'toranj'),
                //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
                //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
                "params"        => array(
                    array(
                        "type"        => "dropdown",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                        "heading"     => __("Style", "toranj"),
                        "param_name"  => "style",
                        "description" => __("Select the Style of Drop-cap", "toranj"),
                        "value"       => array(
                              __('Default', 'toranj')   => 'default',
                              __('Circle', 'toranj')    => 'circle',
                              __('Square', 'toranj')    => 'square',
                          ),
                    ),
                    array(
                        "type"        => "colorpicker",//http://kb.wpbakery.com/index.php?title=Mapping_Params
                        "heading"     => __("Background Color", "toranj"),
                        "param_name"  => "bgcolor",
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array( 'circle', 'square')
                        ),
                        "std"         => "#444"
                    ),

                    array(
                        "type"          => "textarea_html",
                        "heading"       => __("Content", "toranj"),
                        "param_name"    => "content",
                        "description"   => __("First character of this text will be picked as the dropcap", "toranj"),
                        "value"         => "Some contents here",
                        "holder"        => "div"
                    ),
                    array(
                      "type" => "textfield",
                      "heading" => __("Extra class name", "toranj"),
                      "param_name" => "el_class",
                      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "toranj")
                    ),

                ),
            )
        );
    }

    if ( class_exists('Owlabbulkg') )
    {

        add_action( 'vc_before_init', 'owlabbulkg_Slider_Shortcode_integrateWithVC' );
        function owlabbulkg_Slider_Shortcode_integrateWithVC(){
            vc_map(
                array(
                    "name"          => __("Bulk gallery Slider", 'toranj'),
                    "description"   => __("Add simple slider from bulk gallery images", 'toranj'),
                    "base"          => "bulkgal_slider",
                    "class"         => "",
                    "controls"      => "full",
                    "icon"          => get_template_directory_uri().'/assets/img/vcicons/toranj-icon.png',
                    "category"      => __('BULK GALLERY', 'toranj'),
                    //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
                    //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
                    "params"        => array(
                        array(
                            "type"      => "textfield",
                            "heading"   => __("Gallery ID", "toranj"),
                            "param_name"    => "galleryid",
                            "admin_label"    =>true,
                            "description"   =>__("Input the numeric id of the bulk gallery, get it from Bulk Gallery at menu","toranj")
                        ),
                        array(
                            "type"      => "checkbox",
                            "heading"   => __("Use Cropped images?", "toranj"),
                            "param_name"=> "crop",
                            "value"     => array(__("Yes, Please",'toranj') => 'yes')
                        ),
                        array(
                            "type"      => "checkbox",
                            "heading"   => __("Auto play?", "toranj"),
                            "param_name"=> "auto",
                            "value"     => array(__("No, Thanks",'toranj') => 'no')
                        ),
                        array(
                            "type"      => "textfield",
                            "heading"   => __("Transition speed", "toranj"),
                            "param_name"    => "speed",
                            "description"   =>__("input a number default is 500","toranj"),
                            "value"         => 500
                        ),
                        array(
                            "type"      => "textfield",
                            "heading"   => __("Transition timeout", "toranj"),
                            "param_name"    => "timeout",
                            "description"   =>__("input a number default is 4000","toranj"),
                            "value"         => 4000
                        ),
                        array(
                            "type"      => "checkbox",
                            "heading"   => __("Display pager bullets?", "toranj"),
                            "param_name"=> "pager",
                            "value"     => array(__("Yes, Please",'toranj') => 'yes')
                        ),
                        array(
                            "type"      => "checkbox",
                            "heading"   => __("Remove Navigation arrows?", "toranj"),
                            "param_name"=> "nav",
                            "value"     => array(__("Yes, please",'toranj') => 'no')
                        ),
                        array(
                            "type"      => "checkbox",
                            "heading"   => __("Randomize images?", "toranj"),
                            "param_name"=> "random",
                            "value"     => array(__("Yes, Please",'toranj') => 'yes')
                        ),
                        array(
                            "type"      => "checkbox",
                            "heading"   => __("Pause on Hover?", "toranj"),
                            "param_name"=> "pause",
                            "value"     => array(__("Yes, Please",'toranj') => 'yes')
                        ),
                    ),
                )
            );
        }


        add_action( 'vc_before_init', 'owlabbulkg_grid_Shortcode_integrateWithVC' );
        function owlabbulkg_grid_Shortcode_integrateWithVC(){
            vc_map(
                array(
                    "name"          => __("Bulk gallery Grid", 'toranj'),
                    "description"   => __("Add a gallery to a page in grid style", 'toranj'),
                    "base"          => "bulkgal_grid",
                    "class"         => "",
                    "controls"      => "full",
                    "icon"          => get_template_directory_uri().'/assets/img/vcicons/toranj-icon.png',
                    "category"      => __('BULK GALLERY', 'toranj'),
                    //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // VC backend editor
                    //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), //  VC backend editor
                    "params"        => array(

                        array(
                            "type"          => "textfield",
                            "heading"       => __("Gallery ID", "toranj"),
                            "param_name"    => "galleryid",
                            "admin_label"   =>true,
                            "description"   =>__("Input the numeric id of the bulk gallery, get it from Bulk Gallery at menu","toranj")
                        ),

                        array(
                            "type"          => "dropdown",
                            "heading"       => __("Hover style", "toranj"),
                            "param_name"        => "overlay_type",
                            "value"             => array(
                                                    __('Simple Icon', "toranj")     => "simple-icon",
                                                    __('Plus light', "toranj")      => "plus-light",
                                                    __('Plus dark', "toranj")       => "plus-dark",
                                                    __('Plus colored', "toranj")    => "plus-color"
                                                ),
                            "description" => __("Select style", "toranj")
                        ),
                        array(
                            "type"          => "checkbox",
                            "heading"       => __("Remove item's padding?", "toranj"),
                            "description"   => __("Remove padding between images?",'toranj'),
                            "param_name"    => "remove_spaces_between_images",
                            "value"         => array('yes' => "yes"),
                        ),

                        array(
                            "type"          => "textfield",
                            "heading"       => __("LG column count", "toranj"),
                            "param_name"    => "lg_cols",
                            'description'   => __('<code>Integer value</code>. Number of cols for large screen devices','toranj'),
                            "value"         => "4"
                        ),
                        array(
                            "type"          => "textfield",
                            "heading"       => __("MD column count", "toranj"),
                            "param_name"    => "md_cols",
                            'description'   => __('<code>Integer value</code>. Number of cols for medium screen devices','toranj'),
                            "value"         => "3"
                        ),
                        array(
                            "type"          => "textfield",
                            "heading"       => __("SM column count", "toranj"),
                            "param_name"    => "sm_cols",
                            'description'   => __('<code>Integer value</code>. Number of cols for small devices','toranj'),
                            "value"         => "2"
                        ),
                        array(
                            "type"          => "textfield",
                            "heading"       => __("XS column count", "toranj"),
                            "param_name"    => "xs_cols",
                            'description'   => __('<code>Integer value</code>. Number of cols for extra small devices','toranj'),
                            "value"         => "2"
                        ),


                    )
                )
            );
        }



    }
}



/**
 * ----------------------------------------------------------------------------------------
 * add layout templates to vc      *** Do not indent this part ****
 * ----------------------------------------------------------------------------------------
 */
if ( defined( 'WPB_VC_VERSION' ) ) {

/** portfolio Page template */
$data               = array();
$data['name']       = __( 'Portfolio Single image style', 'toranj' );
$data['image_path'] = vc_asset_url( 'vc/templates/product_page.png' );
$data['content']    = <<<CONTENT
[vc_row el_class="custom-grid"][vc_column width="1/2"][vc_single_image image="576" alignment="center" border_color="grey" img_link_target="_self" img_size="blog-thumb" el_class="inview-animate inview-scale"][/vc_column][vc_column width="1/2"][vc_single_image image="575" alignment="center" border_color="grey" img_link_target="_self" img_size="blog-thumb" el_class="inview-animate inview-scale"][/vc_column][/vc_row][vc_row el_class="custom-grid"][vc_column width="1/1"][vc_single_image image="577" alignment="center" border_color="grey" img_link_target="_self" img_size="blog-thumb" el_class="inview-animate inview-scale"][/vc_column][/vc_row][vc_row el_class="custom-grid"][vc_column width="1/2"][vc_single_image image="580" alignment="center" border_color="grey" img_link_target="_self" img_size="blog-thumb" el_class="inview-animate inview-scale"][/vc_column][vc_column width="1/2"][vc_single_image image="578" alignment="center" border_color="grey" img_link_target="_self" img_size="blog-thumb" el_class="inview-animate inview-scale"][/vc_column][/vc_row][vc_row el_class="custom-grid"][vc_column width="1/1"][vc_single_image image="573" alignment="center" border_color="grey" img_link_target="_self" img_size="blog-thumb" el_class="inview-animate inview-scale"][/vc_column][/vc_row][vc_row el_class="custom-grid"][vc_column width="1/1"][vc_single_image image="571" alignment="center" border_color="grey" img_link_target="_self" img_size="blog-thumb" el_class="inview-animate inview-scale"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

/** Regular Contact Page template */
$data               = array();
$data['name']       = __( 'Regular Contact Page template', 'toranj' );
$data['image_path'] = vc_asset_url( 'vc/templates/product_page.png' );
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][vc_gmaps link="#E-8_JTNDaWZyYW1lJTIwc3JjJTNEJTIyaHR0cHMlM0ElMkYlMkZtYXBzZW5naW5lLmdvb2dsZS5jb20lMkZtYXAlMkZ1JTJGMCUyRmVtYmVkJTNGbWlkJTNEellmVXRpRXZYSHFVLmttVTAzTkVwaFQyRSUyMiUyMHdpZHRoJTNEJTIyNjQwJTIyJTIwaGVpZ2h0JTNEJTIyNDgwJTIyJTNFJTNDJTJGaWZyYW1lJTNF"][/vc_column][/vc_row][vc_row][vc_column width="1/4"][toranj_title style="bordered" heading="h3" title="ADRESSES"][toranj_list_container style="with-icon" iconstyle="circle"][toranj_list_item text="Email: john@doe.com" icon="fa-envelope" btn_url="url:mailto%3Ahi%40hi.com|title:Regular%20%7C%20contact%20us|"][toranj_list_item text="Phone: 555-5358-854200" icon="fa-phone"][toranj_list_item text="FAX: 1235125325" icon="fa-phone"][toranj_list_item text="Footscray VIC 3011 Australia" icon="fa-map-marker"][/toranj_list_container][/vc_column][vc_column width="3/4"][toranj_title style="bordered" heading="h3" title="HOW TO CONTACT"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/2"][toranj_title style="bordered" heading="h3" title="CONTACT FORM"][contact-form-7 id="668"][/vc_column][vc_column width="1/2"][toranj_title style="bordered" heading="h3" title="FAQ"][vc_toggle title="An awesome Question?" open="true"]<span style="font-weight: 600; color: #404040;">Some Content</span><span style="color: #404040;"></span><br style="color: #404040;" /><span style="color: #404040;">There are dozens of us! Dozens! That's my son, you pothead! So Ann, the question is, do you want a man or a boy? I know how I would answer</span>[/vc_toggle][vc_toggle title="An awesome Question?" open="false"]<span style="font-weight: 600; color: #404040;">Some Content</span><span style="color: #404040;"></span><br style="color: #404040;" /><span style="color: #404040;">There are dozens of us! Dozens! That's my son, you pothead! So Ann, the question is, do you want a man or a boy? I know how I would answer</span>[/vc_toggle][vc_toggle title="An awesome Question?" open="false"]<span style="font-weight: 600; color: #404040;">Some Content</span><span style="color: #404040;"></span><br style="color: #404040;" /><span style="color: #404040;">There are dozens of us! Dozens! That's my son, you pothead! So Ann, the question is, do you want a man or a boy? I know how I would answer</span>[/vc_toggle][vc_toggle title="An awesome Question?" open="false"]<span style="font-weight: 600; color: #404040;">Some Content</span><span style="color: #404040;"></span><br style="color: #404040;" /><span style="color: #404040;">There are dozens of us! Dozens! That's my son, you pothead! So Ann, the question is, do you want a man or a boy? I know how I would answer</span>[/vc_toggle][vc_toggle title="An awesome Question?" open="false"]<span style="font-weight: 600; color: #404040;">Some Content</span><span style="color: #404040;"></span><br style="color: #404040;" /><span style="color: #404040;">There are dozens of us! Dozens! That's my son, you pothead! So Ann, the question is, do you want a man or a boy? I know how I would answer</span>[/vc_toggle][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

/** Services Page template */
$data               = array();
$data['name']       = __( 'Services Page template', 'toranj' );
$data['image_path'] = vc_asset_url( 'vc/templates/product_page.png' );
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][vc_raw_html]JTNDcCUyMGNsYXNzJTNEJTIydGhpbi10ZXh0JTIyJTNFJTBBRXRpYW0lMjBsdWN0dXMlMjB0dXJwaXMlMjBzZWQlMjBtYWduYSUyMHBlbGxlbnRlc3F1ZSUyMGxvYm9ydGlzJTIwdmVzdGlidWx1bS4lMjBGdXNjZSUyMHV0JTIwbWklMjBhdCUyMHNlbSUyMGRpZ25pc3NpbSUyMGFsaXF1ZXQlMjBudW5jJTIwbGVvJTIwdGVsbHVzLiUyMEV0aWFtJTIwbHVjdHVzJTIwdHVycGlzJTBBJTNDJTJGcCUzRQ==[/vc_raw_html][/vc_column][/vc_row][vc_row css=".vc_custom_1409048520683{margin-bottom: 80px !important;}"][vc_column width="1/1"][vc_column_text]This is a simple pharagraph tag. The Love Boat soon will be making another run. The Love Boat promises something for everyone. Makin their way the only way they know how. That's just a little bit more than the law will allow. It's time to put on makeup. It's time to dress up right. It's time to raise the curtain on the Muppet Show tonight. Movin' on up to the east side. We finally got a piece of the pie. So lets make the most of this beautiful day. Since we're together And you know where you were then. Girls were girls and men were men. Mister we could use a man like Herbert Hoover again.
[/vc_column_text][/vc_column][/vc_row][vc_row css=".vc_custom_1409048537224{margin-bottom: 80px !important;}"][vc_column width="2/3"][toranj_services_container][toranj_services_single title="Shooting" icon="fa-search"]Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI[/toranj_services_single][toranj_services_single title="WEB DESIGN" icon="fa-heart"]Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI[/toranj_services_single][toranj_services_single title="CONSULTING" icon="fa-laptop"]Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI[/toranj_services_single][/toranj_services_container][/vc_column][vc_column width="1/3"][toranj_title style="bordered" heading="h4" title="Skills"][vc_column_text]

This is a simple pharagraph tag. The Love Boat soon will be making another run

[/vc_column_text][toranj_skillbar title="Graphic Design" percent="50"][toranj_skillbar title="Javascript Development" percent="80"][toranj_skillbar title="Photoshop" percent="90"][toranj_skillbar title="Wordpress" percent="70"][toranj_skillbar title="Photography" percent="50"][/vc_column][/vc_row][vc_row css=".vc_custom_1409048545443{margin-bottom: 80px !important;}"][vc_column width="1/1"][toranj_CallToAction text="Lets See How We Can Make You A Cup Of Tea!" text_font="30" btn_text="Contact us" btn_url="url:http%3A%2F%2Flocalhost%2Fwp-toranj%2Fcontact-us%2F|title:Contact%20us|"][/vc_column][/vc_row][vc_row css=".vc_custom_1409048563563{margin-bottom: 80px !important;}"][vc_column width="1/3"][toranj_iconbox title="WE LOVE TORANJ" style="center"]<span style="color: #404040;">Talk you off what, Pop Pop? Michael, I'm your older brother. I'll never be</span>proud of<span style="color: #404040;">you and my son an everyone else</span>[/toranj_iconbox][/vc_column][vc_column width="1/3"][toranj_iconbox title="TREASURE HOUSE" style="center" icon="fa-coffee"]<span style="color: #404040;">Talk you off what, Pop Pop? Michael, I'm your older brother. I'll never be</span>proud of<span style="color: #404040;">you and my son an everyone else</span>[/toranj_iconbox][/vc_column][vc_column width="1/3"][toranj_iconbox title="FALL IN LOVE" style="center" icon="fa-cloud"]<span style="color: #404040;">Talk you off what, Pop Pop? Michael, I'm your older brother. I'll never be</span>proud of<span style="color: #404040;">you and my son an everyone else</span>[/toranj_iconbox][/vc_column][/vc_row][vc_row][vc_column width="1/1"][toranj_caption preset="4" title="Work with us" sub_title="sub_title" description="We are seeking for talented,

and motivated team members" position4="bottom-left" position2="bottom" dark_light="dark" add_button="yes" label="Apply now" style="default" media_type="image" link="url:http%3A%2F%2Flocalhost%2Fwp-toranj%2Fcontact-us%2F|title:Contact%20us|" image="681" img_size="blog-thumb"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );


/** portfolio Page template */
$data               = array();
$data['name']       = __( 'About Page Template', 'toranj' );
$data['image_path'] = vc_asset_url( 'vc/templates/product_page.png' );
$data['content']    = <<<CONTENT
[vc_row css=".vc_custom_1409049268760{margin-bottom: 100px !important;}"][vc_column width="2/3"][vc_column_text el_class="thin-text"]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_column_text]This is a simple pharagraph tag. The Love Boat soon will be making another run. The Love Boat promises something for everyone. Makin their way the only way they know how. That's just a little bit more than the law will allow. It's time to put on makeup. It's time to dress up right. It's time to raise the curtain on the Muppet Show tonight. Movin' on up to the east side. We finally got a piece of the pie. So lets make the most of this beautiful day. Since we're together And you know where you were then. Girls were girls and men were men. Mister we could use a man like Herbert Hoover again.
[/vc_column_text][/vc_column][vc_column width="1/3"][toranj_announce_box]

We Do <span class="colored">Serious Bussiness</span> Here Boy!

[/toranj_announce_box][/vc_column][/vc_row][vc_row][vc_column width="1/3"][toranj_personnel name="Cora Grimhilt" title="DESIGNER" image="693" icon1="fa-facebook" title1="#" icon2="fa-twitter" title2="#"][/vc_column][vc_column width="1/3"][toranj_personnel name="Sachin Hudde" title="Developer" image="694" icon1="fa-facebook" title1="#" icon2="fa-twitter" title2="#"][/vc_column][vc_column width="1/3"][toranj_personnel name="Ivana Rasima" title="MONEY COUNTER" image="695" icon1="fa-facebook" title1="#" icon2="fa-twitter" title2="#"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][toranj_caption preset="5" title="Our Team" description="We are here since 1920's" position4="bottom-left" position2="bottom" dark_light="dark" label="some text" style="default" media_type="image" image="698"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );


/** Fullscreen kenburn slider with fixed caption */
$data               = array();
$data['name']       = __( 'Fullscreen kenburn slider with fixed caption', 'toranj' );
$data['image_path'] = vc_asset_url( 'vc/templates/product_page.png' );
$data['content']    = <<<CONTENT
[toranj_caption preset="1" title="FLY ME TO THE STARS" sub_title="sub_title" position4="bottom-left" position2="bottom" dark_light="dark" add_button="yes" label="Browse Our works" style="toranj_reverse" media_type="none"]Your task is not to seek for love, but merely to seek and find all the barriers within
yourself that you have built against it.[/toranj_caption][owlabkbs id="9"]
CONTENT;

vc_add_default_templates( $data );

/** Minimal corporate home page */
$data               = array();
$data['name']       = __( 'Minimal corporate home page', 'toranj' );
$data['image_path'] = vc_asset_url( 'vc/templates/product_page.png' );
$data['content']    = <<<CONTENT
[vc_row el_class="mb-xlarge"][vc_column width="1/1"][masterslider_pb id="1"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_empty_space height="32px"][/vc_column][/vc_row][vc_row el_class="tj-container mb-xlarge"][vc_column width="1/4"][toranj_title style="bordered" heading="h2" title="LATEST PROJECTS"][vc_column_text]I am text block. Click edit button to change this text.[/vc_column_text][toranj_button text="View Works" style="toranj" size="large" icon_align="boxed" btn_url="url:http%3A%2F%2Flocalhost%3A8888%2Fwp-toranj%2Fportfoliogroup%2Fvideography%2F|title:portfolio|" icon="fa-heart"][/vc_column][vc_column width="3/4"][vc_row_inner][vc_column_inner width="1/2"][toranj_caption preset="8" title="VIDEO" sub_title="Hover-play" position4="bottom-left" position2="bottom" dark_light="dark" label="View" style="default" media_type="video" mp4="http://localhost:8888/wp-toranj/wp-content/uploads/2014/09/04.mp4" webm="http://localhost:8888/wp-toranj/wp-content/uploads/2014/09/04.webm" add_button="yes" link="url:http%3A%2F%2Flocalhost%3A8888%2Fwp-toranj%2Fportfolio%2Fthe-dreams-time%2F|title:The%20Dream%E2%80%99s%20Time|"]Description[/toranj_caption][/vc_column_inner][vc_column_inner width="1/2"][toranj_caption preset="8" title="VIDEO" sub_title="AUTO-PLAY" position4="bottom-left" position2="bottom" dark_light="dark" label="some text" style="default" media_type="video" mp4="http://localhost:8888/wp-toranj/wp-content/uploads/2014/09/imstepf-extreme_fruit_action.mp4" webm="http://localhost:8888/wp-toranj/wp-content/uploads/2014/09/imstepf-extreme_fruit_action.webm" autoplay="yes"]Description[/toranj_caption][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_empty_space height="32px"][/vc_column][/vc_row][vc_row el_class="tj-container mb-xlarge"][vc_column width="1/1"][toranj_title style="bordered" heading="h2" title="OUR SERVICES"][vc_column_text el_class="thin-text"]Etiam luctus turpis sed magna pellentesque lobortis vestibulum. Fusce ut mi at sem dignissim aliquet nunc leo tellus. Etiam luctus turpis. Etiam luctus turpis sed magna pellentesque lobortis vestibulum. Fusce ut mi at sem dignissim aliquet nunc leo tellus. Etiam luctus turpis[/vc_column_text][/vc_column][/vc_row][vc_row el_class="tj-container"][vc_column width="1/3"][toranj_iconbox title="PHOTOGRAPHY" style="center" icon="fa-camera"]Talk you off what, Pop Pop? Michael, I'm your older brother. I'll never be proud ofyou and my son an everyone else[/toranj_iconbox][/vc_column][vc_column width="1/3"][toranj_iconbox title="WEB DESIGN" style="center" icon="fa-code"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt[/toranj_iconbox][/vc_column][vc_column width="1/3"][toranj_iconbox title="CONSULTING" style="center" icon="fa-cloud"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt[/toranj_iconbox][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_empty_space height="32px"][/vc_column][/vc_row][vc_row el_class="tj-container mb-xlarge"][vc_column width="1/1"][toranj_CallToAction text="Let’s See How We Can Make You A Cup Of Tea!" text_font="18" btn_text="Change me" btn_url="url:http%3A%2F%2Flocalhost%3A8888%2Fwp-toranj%2Fcontact%2F|title:Contact|"][/vc_column][/vc_row][vc_row el_class="tj-container mb-xlarge"][vc_column width="1/1"][vc_separator color="grey"][/vc_column][/vc_row][vc_row el_class="tj-container mb-xlarge"][vc_column width="1/4"][vc_raw_html]JTNDaW1nJTIwc3JjJTNEJTIyaHR0cCUzQSUyRiUyRmxvY2FsaG9zdCUzQTg4ODglMkZ3cC10b3JhbmolMkZ3cC1jb250ZW50JTJGdXBsb2FkcyUyRjIwMTQlMkYwOSUyRjk0OTU5NDIxNjZfNzBlYjY0MGViZV9vLTY4MngxMDI0MS1lMTQxMTA1NDYzNTc4Ny5qcGclMjIlMjBjbGFzcyUzRCUyMmNpcmN1bGFyJTIwaW1nLXJlc3BvbnNpdmUlMjBhdXRob3ItaW1hZ2UlMjIlMjBhbHQlM0QlMjJpbWFnZSUyMiUzRSUwQSUwOSUwOSUwOSUwOSUwOSUwOSUwOSUwOSUwOSUwQSUwOSUwOSUwOSUwOSUwOSUwOSUwOSUwOSUwOSUzQ2g1JTIwY2xhc3MlM0QlMjJ0ZXh0LWNlbnRlciUyMGFsbGNhcHMlMjIlM0VJdmFuYSUyMFJhc2ltYSUzQyUyRmg1JTNFJTBBJTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTNDdWwlMjBjbGFzcyUzRCUyMnNvY2lhbC1pY29ucyUyMHRleHQtY2VudGVyJTIyJTNFJTBBJTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTNDbGklM0UlM0NhJTIwaHJlZiUzRCUyMiUyMyUyMiUzRSUzQ2klMjBjbGFzcyUzRCUyMmZhJTIwZmEtZmFjZWJvb2slMjIlM0UlM0MlMkZpJTNFJTNDJTJGYSUzRSUzQyUyRmxpJTNFJTBBJTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTNDbGklM0UlM0NhJTIwaHJlZiUzRCUyMiUyMyUyMiUzRSUzQ2klMjBjbGFzcyUzRCUyMmZhJTIwZmEtdHdpdHRlciUyMiUzRSUzQyUyRmklM0UlM0MlMkZhJTNFJTNDJTJGbGklM0UlMEElMDklMDklMDklMDklMDklMDklMDklMDklMDklMDklM0NsaSUzRSUzQ2ElMjBocmVmJTNEJTIyJTIzJTIyJTNFJTNDaSUyMGNsYXNzJTNEJTIyZmElMjBmYS1pbnN0YWdyYW0lMjIlM0UlM0MlMkZpJTNFJTNDJTJGYSUzRSUzQyUyRmxpJTNFJTBBJTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTNDbGklM0UlM0NhJTIwaHJlZiUzRCUyMiUyMyUyMiUzRSUzQ2klMjBjbGFzcyUzRCUyMmZhJTIwZmEtZmxpY2tyJTIyJTNFJTNDJTJGaSUzRSUzQyUyRmElM0UlM0MlMkZsaSUzRSUwQSUwOSUwOSUwOSUwOSUwOSUwOSUwOSUwOSUwOSUwOSUzQ2xpJTNFJTNDYSUyMGhyZWYlM0QlMjIlMjMlMjIlM0UlM0NpJTIwY2xhc3MlM0QlMjJmYSUyMGZhLXlvdXR1YmUlMjIlM0UlM0MlMkZpJTNFJTNDJTJGYSUzRSUzQyUyRmxpJTNFJTBBJTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTNDbGklM0UlM0NhJTIwaHJlZiUzRCUyMiUyMyUyMiUzRSUzQ2klMjBjbGFzcyUzRCUyMmZhJTIwZmEtZ29vZ2xlLXBsdXMlMjIlM0UlM0MlMkZpJTNFJTNDJTJGYSUzRSUzQyUyRmxpJTNFJTBBJTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTA5JTNDJTJGdWwlM0UlMEElMDklMDklMDklMDklMDklMDklMDklMDk=[/vc_raw_html][/vc_column][vc_column width="1/4"][vc_widget_sidebar sidebar_id="footer_column_2"][/vc_column][vc_column width="1/4"][vc_widget_sidebar sidebar_id="footer_column_3"][/vc_column][vc_column width="1/4" el_class="widget"][toranj_title style="bordered" heading="h3" title="HTML section" el_class="widgettitle"][vc_raw_html]TG9yZW0lMjBpcHN1bSUyMGRvbG9yJTIwc2l0JTIwYW1ldCUyQyUyMGNvbnNlY3RldHVyJTIwYWRpcGlzaWNpbmclMjBlbGl0JTJDJTIwc2VkJTIwZG8lMjBlaXVzbW9kJTIwdGVtcG9yJTIwaW5jaWRpZHVudCUyMHV0JTIwbGFib3JlJTIwZXQlMjBkb2xvcmUlMjBtYWduYSUyMGFsaXF1YS4lMjBVdCUyMGVuaW0lMjBhZCUyMG1pbmltJTIwdmVuaWFtJTJDJTIwcXVpcyUyMG5vc3RydWQlMjBleGVyY2l0YXRpb24lMjB1bGxhbWNvJTIwbGFib3JpcyUyMG5pc2klMjB1dCUyMGFsaXF1aXAlMjBleCUyMGVhJTIwY29tbW9kbyUyMGNvbnNlcXVhdC4=[/vc_raw_html][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );


/** Services page */
$data               = array();
$data['name']       = __( 'Services page', 'toranj' );
$data['image_path'] = vc_asset_url( 'vc/templates/product_page.png' );
$data['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][vc_column_text el_class="thin-text"]Etiam luctus turpis sed magna pellentesque lobortis vestibulum. Fusce ut mi at sem dignissim aliquet nunc leo tellus. Etiam luctus turpis[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_column_text]This is a simple pharagraph tag. The Love Boat soon will be making another run. The Love Boat promises something for everyone. Makin their way the only way they know how. That's just a little bit more than the law will allow. It's time to put on makeup. It's time to dress up right. It's time to raise the curtain on the Muppet Show tonight. Movin' on up to the east side. We finally got a piece of the pie. So lets make the most of this beautiful day. Since we're together And you know where you were then. Girls were girls and men were men. Mister we could use a man like Herbert Hoover again.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_empty_space height="32px"][/vc_column][/vc_row][vc_row][vc_column width="2/3"][toranj_services_container][toranj_services_single title="Shooting" icon="fa-camera"]Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI[/toranj_services_single][toranj_services_single title="WEB DESIGN" icon="fa-code"]Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI[/toranj_services_single][toranj_services_single title="Consulting" icon="fa-laptop"]Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI[/toranj_services_single][/toranj_services_container][/vc_column][vc_column width="1/3"][toranj_title style="lined" heading="h3" title="Skills"][vc_column_text]This is a simple pharagraph tag. The Love Boat soon will be making another run[/vc_column_text][toranj_skillbar title="Graphic Design" percent="50"][toranj_skillbar title="JavaScript" percent="70"][toranj_skillbar title="Photoshop" percent="75"][toranj_skillbar title="Wordpress" percent="100"][toranj_skillbar title="Photography" percent="85"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_empty_space height="32px"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][toranj_CallToAction text="Let’s See How We Can Make You A Cup Of Tea!" text_font="18" btn_text="Contact us" btn_url="url:http%3A%2F%2Flocalhost%3A8888%2Fwp-toranj%2Fcontact%2F|title:Contact|"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_empty_space height="32px"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][toranj_caption preset="4" title="Work with us" sub_title="sub_title" position4="bottom-left" position2="bottom" dark_light="dark" add_button="yes" label="Or Contact us" style="default" media_type="image" link="url:http%3A%2F%2Flocalhost%3A8888%2Fwp-toranj%2Fcontact%2F|title:Contact|" image="721" img_size="full"]Email: john@doecorp.com
Call: +000000000![/toranj_caption][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

/** About page */
$data               = array();
$data['name']       = __( 'About page', 'toranj' );
$data['image_path'] = vc_asset_url( 'vc/templates/product_page.png' );
$data['content']    = <<<CONTENT
[vc_row][vc_column width="2/3"][vc_column_text el_class="thin-text"]Etiam luctus turpis sed magna pellentesque lobortis vestibulum. Fusce ut mi at sem dignissim aliquet nunc leo tellus. Etiam luctus turpis[/vc_column_text][vc_empty_space height="20px"][vc_column_text]This is a simple pharagraph tag. The Love Boat soon will be making another run. The Love Boat promises something for everyone. Makin their way the only way they know how. That's just a little bit more than the law will allow. It's time to put on makeup. It's time to dress up right. It's time to raise the curtain on the Muppet Show tonight. Movin' on up to the east side. We finally got a piece of the pie. So lets make the most of this beautiful day. Since we're together And you know where you were then. Girls were girls and men were men. Mister we could use a man like Herbert Hoover again.[/vc_column_text][/vc_column][vc_column width="1/3"][toranj_announce_box]We Do
<span class="colored">Serious Bussiness</span>
Here[/toranj_announce_box][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_empty_space height="32px"][/vc_column][/vc_row][vc_row][vc_column width="1/3"][toranj_personnel name="Cora Grimhilt" title="Designer" image="736" icon1="fa-facebook" title1="#" icon2="fa-twitter" title2="#"][/vc_column][vc_column width="1/3"][toranj_personnel name="Sachin Hudde" title="CEO" image="735" icon1="fa-facebook" title1="#" icon2="fa-twitter" title2="#"][/vc_column][vc_column width="1/3"][toranj_personnel name="Ivana Rasima" title="Mony Counter" image="734" icon1="fa-facebook" title1="#" icon2="fa-twitter" title2="#"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_empty_space height="32px"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][toranj_CallToAction text="Let’s See How We Can Make You A Cup Of Tea!" text_font="18" btn_text="contact us" btn_url="url:http%3A%2F%2Flocalhost%3A8888%2Fwp-toranj%2Fcontact%2F|title:Contact|"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

}

if ( defined( 'WPB_VC_VERSION' ) ) {

    //set as theme
    add_action( 'vc_before_init', 'owlab_vcSetAsTheme' );


    /**
     * ----------------------------------------------------------------------------------------
     * set the vc as theme and don't prompt for activation
     * ----------------------------------------------------------------------------------------
     * @since 1.0.0
     * @param  void
     * @return void
     */

    function owlab_vcSetAsTheme() {
        vc_set_as_theme();
    }


}
