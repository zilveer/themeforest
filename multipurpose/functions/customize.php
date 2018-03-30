<?php
function multipurpose_customize_register( $wp_customize ) {
	if( class_exists( 'WP_Customize_Control' ) ):
		class WP_Customize_Textarea_Control extends WP_Customize_Control {
			public $type = 'textarea';
	 
			public function render_content() {
				?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
			}
		}

		class WP_Customize_Select_Control extends WP_Customize_Control {
	        public function render_content() {
                ?>
                    <label>
                      <span><?php echo esc_html( $this->label ); ?></span>
                      <select>
                      	<option value="0" <?php if(!$this->value): ?>selected="selected"<?php endif; ?>><?php esc_attr_e('Default', 'multipurpose'); ?></option>
                      </select>
                    </label>
                <?php
	        }
	    }

	    class Multipurpose_Customize_Image_Media_Library_Control extends WP_Customize_Image_Control {
                public function __construct( $manager, $id, $args = array() )
                {
                        parent::__construct( $manager, $id, $args );
                        $this->add_tab( 'medialibrary',   esc_attr__('Media Library', 'multipurpose'),   array( $this, 'tab_medialibrary' ) );
                }
       
                public function tab_medialibrary()
                {
                ?>     
                        <div class="medialibrary-target"></div>
                                                       
                        <a class="choose-from-library-link button" data-controller = "<?php echo $this->id;?>">
                                <?php esc_attr_e( 'Open Library', 'multipurpose' ); ?>
                        </a>    
                <?php  
                }
        }

	endif;

	$wp_customize->get_section('title_tagline')->priority = 1;

}
add_action( 'customize_register', 'multipurpose_customize_register' );


function multipurpose_add_scripts()
{
    wp_enqueue_media();
    wp_enqueue_script('wpq-media-manager', get_stylesheet_directory_uri().'/js/shiba-media-manager.js', array( 'jquery' ), '1.0', true);
}
 
add_action( 'customize_controls_print_styles', 'multipurpose_add_scripts', 50 );


/*custom styles for Customize*/
function multipurpose_customize_style() {
    wp_enqueue_style('customize-styles', get_template_directory_uri() . '/styles/customize.css');
}
add_action( 'customize_controls_enqueue_scripts', 'multipurpose_customize_style' );