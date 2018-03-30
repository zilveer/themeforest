<?php

/**
 * Contains all the main functionality for printing the options options page. Uses some methods from
 * the parent PexetoWidgetsBuilder class for some general widgets.
 */
class PexetoOptionsBuilder extends PexetoWidgetsBuilder{

	private $options=array();
	private $images_url='';
	private $pexeto_version='';
	private $themename='';
	protected $resize_thumbnails = false;

	/**
	 * The main constructor for the class
	 *
	 * @param unknown $themename  the name of the the theme
	 * @param unknown $images_url the URL of the functions directory
	 * @param unknown $version    the version of the theme
	 * @param unknown $options    an array containing all the saved options for the theme
	 */
	function __construct( $themename, $images_url, $version, &$options_obj ) {
		parent::__construct( $options_obj );
		$this->themename=$themename;
		$this->images_url=$images_url;
		$this->pexeto_version=$version;
		$this->options = $this->data_obj->get_fields();
	}


	/**
	 * Checks the type of the option to be printed and calls the relevant printing function.
	 */
	public function print_options() {
		$i=0;
		foreach ( $this->options as $option ) {
			switch ( $option['type'] ) {
			case 'open':
				$this->print_subnavigation( $option, $i );
				break;
			case 'subtitle':
				$this->print_subtitle( $option, $i );
				break;
			case 'close':
				$this->print_close();
				break;
			case 'title':
				$i++;
				break;
			case 'custom':
				$this->print_custom( $option );
				break;
			case 'documentation':
				$this->print_text( $option );
				break;
			default:
				parent::print_field( $option );
				break;
			}
		}
	}


	/**
	 * Prints the subnavigation tabs for each of the main navigation blocks.
	 *
	 * @param unknown $option the option that contains the data that needs to be printed
	 * @param unknown $i      the index of the main navigation block to which the subnavigation belongs to
	 */
	protected function print_subnavigation( $option, $i ) {
		echo '<div id="tab-'.$i.'" class="op-tab">';
		if ( $option['subtitles'] ) {
			echo '<div id="tab-navigation-'.$i.'" class="op-tab-navigation"><ul>';
			foreach ( $option['subtitles'] as $subtitle ) {
				echo '<li><a href="#tab-'.$i.'-'.$subtitle['id'].'" class="tab"><span>'.$subtitle['name'].'</span></a></li>';
			}
			echo '</ul></div>';
		}
	}

	/**
	 * Prints a subtitle - a single tab title
	 *
	 * @param unknown $option the option array that contains the data to be printed
	 * @param unknown $i      the index of the content block that will be opened when the tab is clicked
	 */
	protected function print_subtitle( $option, $i ) {
		echo '<div id="tab-'.$i.'-'.$option['id'].'" class="op-sub-tab">';
	}


	/**
	 * Prints a custom set of fields with an Add button - this field will be mostly used when
	 * several items that share the same data structure needs to be added. For example, this can be very
	 * useful for adding images to the slider with different options- title, link, etc.
	 * So far the fields that are supported by this function are text field, text field with upload button and a
	 * textarea.
	 *
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 * "name"=>"Add Slider Image",
	 * "id"=>'thumbnail_slider',
	 * "type"=>"custom",
	 * "button_text"=>'Add image',
	 * "preview"=>"thumbnail_image_name",
	 *  "fields"=>array(
	 *   array('id'=>'thumbnail_image_name', 'type'=>'upload', 'name'=>'Image URL'),
	 *   array('id'=>'thumbnail_image_title', 'type'=>'text', 'name'=>'Image Title'),
	 *   array('id'=>'thumbnail_image_desc', 'type'=>'textarea', 'name'=>'Image Description')
	 *  )
	 * )
	 * ------------------------------------------------------------------------------------------
	 *
	 * @param unknown $option the array that contains all the data for the option
	 */
	protected function print_custom( $option ) {
		parent::print_before_field( $option );
		echo '<div id="'.$option['id'].'" >';

		$val = $this->data_obj->get_value( $option['id'] );

		foreach ( $val as $key => $itemval ) {
			foreach ( $itemval as $fkey => $fvalue ) {
				$val[$key][$fkey] = stripslashes( $fvalue );
			}
		}

		$preview = isset( $option['preview'] )?'preview:"'.$option['preview'].'",':'';
		$editable = isset( $option['editable'] ) && !$option['editable']?'editable:false,':'';
		$btnText = isset( $option['button_text'] )?'addText:"'.$option['button_text'].'",':'';
		$bind_to = isset ( $option['bind_to'] ) ? $option['bind_to'] : null;

		//call the script that enables the functionality for adding custom fields
		echo '<script type="text/javascript">
			jQuery(document).ready(function($){
				$("#'.$option["id"].'").pexetoCustom({fields:'.json_encode( $option['fields'] ).',
					values:'.json_encode( $val ).',
					'.$preview.'
					'.$btnText.'
					'.$editable.'
					parent:$("#pexeto-content-container"),
					bindTo:'.json_encode( $bind_to ).'
				});
			});
		</script>';

		echo '</div>';

		parent::print_after_field( $option );
	}

	protected function print_text( $option ) {
		parent::print_before_field( $option );
		if(isset($option['text'])){
			echo $option['text'];
		}
		parent::print_after_field( $option );
	}

	/**
	 * Prints the heading of the options panel.
	 */
	public function print_heading() {
		if ( isset( $_GET['activated'] )&&$_GET['activated']=='true' ) {
			echo '<div class="note_box">Welcome to '.$this->themename.' theme! <br/>On this page you can set the main options
			of the theme. For more information about the theme setup, please refer to the <a href="http://pexetothemes.com/docs/story/?src=pexpanel"><b>documentation included</b></a>, which
			is located within the "documentation" folder of the main download zip package.<br/> We hope that you will enjoy working with the theme!</div>';
		}
		echo '<div id="pexeto-content-container"><form method="post" id="pexeto-options">';
		if ( function_exists( 'wp_nonce_field' ) ) {
			wp_nonce_field( 'pexeto-theme-update-options', 'pexeto-theme-options' );
		}
		echo '<div id="sidebar"><div class="logo-container"><div class="logo-pattern"><div id="logo"></div></div></div><div id="op-navigation"><ul>';

		$i=1;
		foreach ( $this->options as $option ) {

			if ( $option['type']=='title' ) {
				echo '<li><span><a href="#tab-'.$i.'"><span aria-hidden="true" class=" font-icon '.$option['img'].'"></span>'.$option['name'].' <div class="nav-arrow"></div></a></span></li>';
				$i++;
			}
		}

		echo '</ul></div></div><div id="content" class="content-loading"><div id="header"><h3 id="theme_name">'.$this->themename.' v.'.$this->pexeto_version.'</h3><a class="more-button" href="http://themeforest.net/user/pexeto/portfolio?ref=pexeto&utm_source=pex-panel&utm_medium=story">More Pexeto Themes &rarr;</a></div><div id="options_container">';
	}

	/**
	 * Prints the footer of the options panel.
	 */
	public function print_footer() {
		echo '</div></div><div id="pexeto-footer"><div id="follow-pexeto">
		<p>Follow Pexeto on:</p>
		<ul>
		<li><a href="http://twitter.com/pexeto" title="Follow Pexeto on Twitter" aria-hidden="true" class="icon-twitter"></a></li>
		<li><a href="http://www.facebook.com/pages/Pexeto/154921334549933" title="Like Pexeto on Facebook" aria-hidden="true" class="icon-facebook"></a></li>
		<li><a href="http://themeforest.net/user/pexeto/follow" title="Follow Our Work on ThemeForest" class="icon-tf"><img src="'.$this->images_url.'tf-icon.png" /></a></li>
		<li><a href="http://pexetothemes.com" class="icon-pexeto"><img src="'.$this->images_url.'pex-icon.png" title="Visit Our Website" /></a></li>
		</ul></div> 
		<input type="hidden" name="action" value="save" />
		<a class="save-button pex-button" id="op-save-button"><span><i aria-hidden="true" class="icon-save"></i>Save Changes</span></a>
		<div id="op-loader"></div>
		<div id="op-success"><span aria-hidden="true" class="icon-checkmark"></span>Saved</div>
		<div id="op-error">An error occurred, please try again later.</div>
		</div>
		</form></div>';
	}

	/**
	 * Prints a closing div tag.
	 */
	protected function print_close() {
		echo '</div>';
	}

}
