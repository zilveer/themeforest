<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'customize_register', 'gorilla_customize_register' );
function gorilla_customize_register($wp_customize) {

	if (class_exists('WP_Customize_Control')) {
		class Customize_Number_Control extends WP_Customize_Control {
			public $type = 'number';
		 
			public function render_content() {
				?>
				<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input type="number" name="quantity" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>" style="width:70px;">
				</label>
				<?php
			}
		}
	
	    class Customize_CategorySelect_Control extends WP_Customize_Control {
	        /**
	         * Render the control's content.
	         *
	         * @since 3.4.0
	         */
	        public function render_content() {
	            $dropdown = wp_dropdown_categories(
	                array(
	                	'orderby'           => 'name',
	                    'name'              => '_customize-dropdown-categories-' . $this->id,
	                    'echo'              => 0,
	                    'show_option_none'  => __( '&mdash; Select &mdash;', 'alison' ),
	                    'option_none_value' => '0',
	                    'selected'          => $this->value(),
	                )
	            );
	 
	            // Hackily add in the data link parameter.
	            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
	 
	            printf(
	                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
	                $this->label,
	                $dropdown
	            );
	        }
	    }

	    class Customize_MultipleCategorySelect_Control extends WP_Customize_Control {
	    	/**
		     * The type of customize control being rendered.
		     *
		     * @since  1.0.0
		     * @access public
		     * @var    string
		     */
		    public $type = 'checkbox-multiple';

		    /**
		     * Displays the control content.
		     *
		     * @since  1.0.0
		     * @access public
		     * @return void
		     */
		    public function render_content() {
		    	$type = 'checkbox-multiple';

				$category_args = array(
				  'orderby' => 'name',
				  'order' => 'ASC'
				);
				$choice_categories = get_categories($category_args);

				foreach($choice_categories as $category) {
					$choice_categories_array[$category->term_id] = $category->name;
				}

		        if ( empty( $choice_categories_array ) )
		            return; ?>

		        <?php if ( !empty( $this->label ) ) : ?>
		            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		        <?php endif; ?>

		        <?php if ( !empty( $this->description ) ) : ?>
		            <span class="description customize-control-description"><?php echo $this->description; ?></span>
		        <?php endif; ?>

		        <?php 
		        	$multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); 
		        	if($multi_values[0] == "Array"){
		        		$multi_values = "";
		        	}
		        ?>

		        <ul style="max-height:250px; overflow-y:auto;">
		            <?php foreach ( $choice_categories_array as $value => $label ) : ?>

		                <li>
		                    <label>
		                        <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
		                        <?php echo esc_html( $label ); ?>
		                    </label>
		                </li>

		            <?php endforeach; ?>
		        </ul>

		        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
		    <?php }
	    }

		class Google_Font_Dropdown_Custom_Control extends WP_Customize_Control {
		    private $fonts = false;
		    public function __construct($manager, $id, $args = array(), $options = array())
		    {
		        $this->fonts = $this->get_fonts();
		        parent::__construct( $manager, $id, $args );
		    }

		    /**
		     * Render the content of the category dropdown
		     *
		     * @return HTML
		     */
		    public function render_content() {
		        if(!empty($this->fonts))
		        {
		            ?> <!-- //fonts.googleapis.com/css?family=Playfair+Display:400,700,900,400italic,700italic,900italic&subset=latin,latin-ext 
		        			//fonts.googleapis.com/css?family=Alegreya:regular,italic,700,700italic,900,900italic,-->
		                <label>
		                    <span class="customize-control-title customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
		                    <select <?php $this->link(); ?>>
		                        <?php
		                        	$url = "//fonts.googleapis.com/css?";
		                        	printf('<option value="0">Use Theme Font</option>');
		                            foreach ( $this->fonts as $k => $v )
		                            {

									    $font_family = str_replace(" ", "+", $v->family);
									    $str = 'family='.$font_family.":";
									    $numItems = count($v->variants);
									    $i = 0;
									    foreach ($v->variants as $variants) {
									    	$i++;
									      	$str .= $variants;
									      	if($i !== $numItems) {
										    	$str .= ",";
										  	}
									    }

									    $z = 0;
									    $numItems = count($v->subsets);
									    if( isset($numItems)) { 
									    	$str .= '&subsets=';
									    	foreach ($v->subsets as $subsets) {
									    		$z++;
										     	$str .= $subsets;
										       	if($z !== $numItems) {
											    	$str .= ",";
											  	}
											  	
										    }
									   	}
									    
		                                printf('<option value="%s" %s>%s</option>', $url.$str, selected($this->value(), $k, false), $v->family);
		                            }
		                        ?>
		                    </select>
		                </label>
		            <?php
		        }
		    }

		    /**
		     * Get the google fonts from the API or in the cache
		     *
		     * @param  integer $amount
		     *
		     * @return String
		     */
		    public function get_fonts( $amount = 'all' ){
		        $selectDirectory = get_stylesheet_directory().'/wordpress-theme-customizer-custom-controls/select/';
		        $selectDirectoryInc = get_stylesheet_directory().'/inc/wordpress-theme-customizer-custom-controls/select/';
		        $finalselectDirectory = get_template_directory() . '/inc/customizer';
		        if(is_dir($selectDirectory))
		        {
		            $finalselectDirectory = $selectDirectory;
		        }
		        if(is_dir($selectDirectoryInc))
		        {
		            $finalselectDirectory = $selectDirectoryInc;
		        }
		        $fontFile = $finalselectDirectory . '/cache/google-web-fonts.txt';
		        //Total time the file will be cached in seconds, set to a week
		        $cachetime = 86400 * 7;
		        if(file_exists($fontFile) && $cachetime < filemtime($fontFile))
		        {
		            $content = json_decode(file_get_contents($fontFile));
					
		        } else {
		            $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key={API_KEY}';
		            $fontContent = wp_remote_get( $googleApi, array('sslverify'   => false) );
		            $fp = fopen($fontFile, 'w');
		            fwrite($fp, $fontContent['body']);
		            fclose($fp);
		            $content = json_decode($fontContent['body']);
		        }
		        if($amount == 'all')
		        {
		            return $content->items;
		        } else {
		            return array_slice($content->items, 0, $amount);
		        }
		    }
		}
	}
}

?>