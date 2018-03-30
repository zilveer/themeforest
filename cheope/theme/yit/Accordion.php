<?php
/**
 * Your Inspiration Themes 
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

require_once YIT_CORE_PATH . '/lib/yit/Portfolio_type/Portfolio_type.php';  
 
class YIT_Accordion extends YIT_Portfolio_type  {
	
	/**
	 * Constructor
	 * 
	 */
	public function __construct() {}
	
	/**
	 * Init
	 * 
	 */       
	public function init($portfolio_type_name = false) {
    
        // change the basic configuration for the post type
        add_action( 'yit_portfolio_type_args_accordions', array( &$this, 'change_args' ) );
    
        // change the configuration for each item of post type
        add_action( 'yit_accordions_item_configuration', array( &$this, 'change_item_configuration' ) ); 
        
        // change something in the configuration of each element
        add_filter( 'yit_cpt_unlimited_settings_item_accordions', array( &$this, 'change_subtitle_label' ) );
		
        // set the name of the shortcode
        $this->shortcode_name = 'accordion';  
        
        // set the ID of the option used to define the type of portfolio
        $this->_fieldTypeName = 'accordions_type';
		
		parent::init('accordions');
	}
	
    /**
     * Change the basic configuration for the post type
     * 
     * @since 1.0.0
     */
    public function change_args( $args ) {
        return array(
            'settings' => array(
                array(
                    'type' => 'sep'
                ),                              
                array(
                    'desc' => __( 'Publish the team to configure it.', 'yit' ),
                    'type' => 'simple-text',
                    'only__not_saved' => true
                )
            ),
            
            'settings_item' => 'title, subtitle, content-editor',
            'labels' => array(
                'singular_name' => __( 'Team', 'yit' ),
                'plural_name' => __( 'Teams', 'yit' ),
                'item_name_sing' => __( 'Figure', 'yit' ),
                'item_name_plur' => __( 'Figures', 'yit' ),
            ),
            'icon_menu' => YIT_CORE_ASSETS_URL . '/images/menu/accordion.png',
        );
    }          
    
    /**
     * Change the configuration for each item 
     * 
     * @since 1.0.0
     */
    public function change_item_configuration( $args ) {
        return array(
			array(
                'type' => 'sep'
            ),
			array(
				'id' => 'social',
				'name' => __( 'Social', 'yit' ),
				'type' => 'textarea',
				'std' => '',
				'desc' => __( 'The social shortcodes of customer (leave empty to not use it)', 'yit' ),
			),
			array(
				'id' => 'website',
				'name' => __( 'Website', 'yit' ),
				'type' => 'text',
				'std' => '',
				'desc' => __( 'The website url of customer (leave empty to not use it)', 'yit' ),
			),
        );
    }      
    
    /**
     * Change label in the subtitle field of each element
     * 
     * @since 1.0.0
     */
    public function change_subtitle_label( $args ) {
		$args[0]['name'] = __( 'Title', 'yit' );
        $args[1]['name'] = __( 'Role', 'yit' );
        return $args;    
    }                   
    
}


/** 
 * Set the accordion loop and reset all indexes
 *  
 * @param $slider_id string/int  The ID (or the slug) of the slider post, where get the slides
 * 
 * @since 1.0  
 */ 
function yit_set_accordion_loop( $ID_or_slug ) {
    yit_get_model('accordion')->set_portfolio_loop( $ID_or_slug ); 
} 

/** 
 * Check if there is slides yet and increment the index and update the $current_slide 
 * attribute, with current slide arguments.
 * 
 * This function is used in the loop, to generate the markup of slider, on the main code.         
 * 
 * @since 1.0  
 */   
function yit_have_accordion_item() {
    return yit_get_model('accordion')->have_works();
}               

/** 
 * Check if there is slides yet and increment the index and update the $current_slide 
 * attribute, with current slide arguments.
 * 
 * This function is used in the loop, to generate the markup of slider, on the main code.         
 * 
 * @since 1.0  
 */   
function yit_is_accordion_empty() {
    return yit_get_model('accordion')->is_empty();
}   
                 
      
				 
				 
/** 
 * Echo the parameter of the current slide
 * 
 * @param string $var The parameter.        
 * 
 * @since 1.0  
 */   
function yit_accordion_item_the( $var, $args = array() ) {
    yit_get_model('accordion')->the( $var, $args );
}

/** 
 * Get the parameter of the current slide
 * 
 * @param string $var The parameter.        
 * 
 * @since 1.0  
 */   
function yit_accordion_item_get( $var, $args = array() ) {
    return yit_get_model('accordion')->get( $var, $args );
}
