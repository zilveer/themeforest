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

/**
 * Portfolio
 * 
 * Class to manage the gallery posts. This classe use the other class Portfolio.
 * 
 * @see class YIT_Portfolio_type  
 * 
 * 
 * @since 1.0.0
 */

class YIT_Portfolio extends YIT_Portfolio_type {                        

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
        add_action( 'yit_portfolio_type_args_portfolios', array( &$this, 'change_args' ) ); 
    
        // change the configuration for each item of post type
        add_action( 'yit_portfolios_item_configuration', array( &$this, 'change_item_configuration' ) ); 
        
        // set the name of the shortcode
        $this->shortcode_name = 'portfolio';  
        
        // set the ID of the option used to define the type of portfolio
        $this->_fieldTypeName = 'portfolio_type';   
	   
	    // call the init of Portfolio, setting the name of post type to "galleries"
	    parent::init('portfolios');
	
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
                    'name' => __( 'Portfolio Type', 'yit' ),
                    'id' => 'portfolio_type',
                    'type' => 'select',
                    'options' => $this->_portfolioTypes,
                    'std' => '',
                    'desc' => 'Select the portfolio type.'
                ),          /*
                array(
                    'name' => __( 'Slug', 'yit' ),
                    'id' => 'rewrite',
                    'type' => 'text',
                    'desc' => __( 'Select the word to use in the URL of each element of the portfolio.', 'yit' ),
                    'std' => ''
                ),       */
                array(
                    'type' => 'sep'
                ),                              
                array(
                    'desc' => __( 'Publish the portfolio to configure it.', 'yit' ),
                    'type' => 'simple-text',
                    'only__not_saved' => true
                )
            ),
        //             'settings_item' => array( 
        //                 'slider_type:elastic' => 'title, subtitle, link, content'
        //             ),
            'settings_item' => 'title, subtitle, content-editor',
            'labels' => array(
                'singular_name' => __( 'Portfolio', 'yit' ),
                'plural_name' => __( 'Portfolios', 'yit' ),
                'item_name_sing' => __( 'Work', 'yit' ),
                'item_name_plur' => __( 'Works', 'yit' ),
            ),
            'icon_menu' => YIT_CORE_ASSETS_URL . '/images/menu/portfolio.png',
        );
    }          
    
    /**
     * Change the configuration for each item 
     * 
     * @since 1.0.0
     */
    public function change_item_configuration( $args ) {
        return array( 
            array( 'type' => 'sep' ),
            array(
                'id' => 'video_url',
                'name' => __( 'Video URL', 'yit' ),
                'type' => 'text',
                'std' => '',
                'desc' => __( 'If you want a video before the description, write here its URL (Youtube or Vimeo)', 'yit' ),
            ),
            array( 'type' => 'sep' ),    
            array(
                'id' => 'customer',
                'name' => __( 'Customer', 'yit' ),  
                'type' => 'text',
                'std' => '',
                'desc' => __( 'Insert the customer (leave empty to not use it)', 'yit' ),
            ), 
            array(
                'id' => 'year',
                'name' => __( 'Year', 'yit' ),     
                'type' => 'text',
                'std' => '',
                'desc' => __( 'Insert the year (leave empty to not use it)', 'yit' ),
            ),            
            array(
                'id' => 'skills_label',
                'name' => __( 'Skills Label', 'yit' ),     
                'type' => 'text',
                'std' => __( 'Project', 'yit' ),
                'desc' => __( 'The label for the "Skill" field', 'yit' ),
            ),     
            array(
                'id' => 'skills',
                'name' => __( 'Skills', 'yit' ),     
                'type' => 'text',
                'std' => '',
                'desc' => __( 'Type here if you want to show some skills', 'yit' ),
            ),
			array(
		        'id' => 'website_name',
		        'name' => __( 'Website', 'yit' ),     
		        'type' => 'text',
		        'std' => '',
		        'desc' => __( 'The website name of customer (leave empty to not use it)', 'yit' ),
		    ),
		    array(
		        'id' => 'website_url',
		        'name' => __( 'Website URL', 'yit' ),     
		        'type' => 'text',
		        'std' => '',
		        'desc' => __( 'The website url of customer (leave empty to not use it)', 'yit' ),
		    ),
            array( 'type' => 'sep' ),  
            array(
                'id' => 'excerpt_length',
                'name' => __( 'Text length', 'yit' ),     
                'type' => 'number',
                'std' => 20,
                'desc' => __( 'Insert length of the text of the post, in the list page.', 'yit' ),
            ),     
            array(
                'id' => 'read_more_text',
                'name' => __( 'Read More Text', 'yit' ),     
                'type' => 'text',
                'std' => __( 'View Project', 'yit' ),
                'desc' => __( 'Define the text of read more button (leave empty, to not use it).', 'yit' ),
            ),          
            array( 'type' => 'sep' ),   
            array(
                'id' => 'terms',
                'name' => __( 'Categories', 'yit' ),     
                'type' => 'categories',
                'desc' => __( 'Define the categories for this element.', 'yit' )
            ),                
            array( 'type' => 'sep' ),
            array(
                'id' => 'is_sticky',
                'name' => __( 'Featured item', 'yit' ),     
                'type' => 'checkbox',
                'std' => '',
                'desc' => __( 'Select if you want to show this item as a special item in section shortcode.', 'yit' ),
            ),                  
            array( 'type' => 'sep' ),
            array(
                'id' => 'extra-images',
                'name' => __( 'Additional Images', 'yit' ),     
                'type' => 'images',
                'desc' => __( 'Upload here if you want to attach some other images to the project (you can only upload image one by one).', 'yit' )
            ),          
            array( 'type' => 'sep' ),
        );
    }                    

} 
    
/**
 * Add the slider configurations for the slider page 
 *     
 * @param $portfolio_type string   The slider type
 * @param $options     array    The fields of the configuration page, for the slider type defined    
 * @since 1.0.0
 */
function yit_add_portfolio_config( $portfolio_type, $options = array() ) {
    yit_get_model('portfolio')->add_portfolio_config( $portfolio_type, $options );
}    
    
/**
 * Add the slides support, to configure the information to add inside each slide.
 *     
 * @param $portfolio_type string   The slider type
 * @param $options     array    The fields of the configuration page, for the slider type defined    
 * @since 1.0.0
 */
function yit_add_work_support( $portfolio_type, $custom_options ) {
    yit_get_model('portfolio')->add_work_support( $portfolio_type, $custom_options );
}       
    
/**
 * Register the script javascript file in the common array, then used to enqueue the scripts
 * in the head of the webpage                  
 *      
 * @param $portfolio_type string  The type of the slider that needs of this asset
 * @param $asset string  The url of the asset (in case it's relative, it will be get from the slider folder)    
 * @since 1.0.0
 */
function yit_register_portfolio_script( $portfolio_type, $handle, $asset ) {
    yit_get_model('portfolio')->register_portfolio_script( $portfolio_type, $handle, $asset );
}     
    
/**
 * Register the css file in the common array, then used to enqueue the scripts
 * in the head of the webpage                  
 *      
 * @param $portfolio_type string  The type of the slider that needs of this asset
 * @param $asset string  The url of the asset (in case it's relative, it will be get from the slider folder)    
 * @since 1.0.0
 */
function yit_register_portfolio_style( $portfolio_type, $handle, $asset ) {
    yit_get_model('portfolio')->register_portfolio_style( $portfolio_type, $handle, $asset );
}                        
    
/** 
 * Get the slider type of current slider         
 * 
 * @since 1.0  
 */  
function yit_portfolio_type() {
    return yit_get_model('portfolio')->get('portfolio_type');
}    

/** 
 * Set the slider loop and reset all indexes
 *  
 * @param $slider_id string/int  The ID (or the slug) of the slider post, where get the slides
 * 
 * @since 1.0  
 */ 
function yit_set_portfolio_loop( $ID_or_slug ) {
    yit_get_model('portfolio')->set_portfolio_loop( $ID_or_slug ); 
} 

/** 
 * Check if there is slides yet and increment the index and update the $current_slide 
 * attribute, with current slide arguments.
 * 
 * This function is used in the loop, to generate the markup of slider, on the main code.         
 * 
 * @since 1.0  
 */   
function yit_have_works() {
    return yit_get_model('portfolio')->have_works();
}               

/** 
 * Check if there is slides yet and increment the index and update the $current_slide 
 * attribute, with current slide arguments.
 * 
 * This function is used in the loop, to generate the markup of slider, on the main code.         
 * 
 * @since 1.0  
 */   
function yit_is_portfolio_empty() {
    return yit_get_model('portfolio')->is_empty();
}   
                 
/** 
 * Echo the parameter of the current slide
 * 
 * @param string $var The parameter.        
 * 
 * @since 1.0  
 */   
function yit_work_the( $var, $args = array() ) {
    yit_get_model('portfolio')->the( $var, $args );
}

/** 
 * Get the parameter of the current slide
 * 
 * @param string $var The parameter.        
 * 
 * @since 1.0  
 */   
function yit_work_get( $var, $args = array() ) {
    return yit_get_model('portfolio')->get( $var, $args );
}

/** 
 * Echo the classes of the current slide.  
 * 
 * @param string $class Extra class.        
 * 
 * @since 1.0  
 */   
function yit_work_class( $class = '', $echo = true ) {
    return yit_get_model('portfolio')->work_class( $class, $echo );
}

/** 
 * Echo the classes of the current slide.  
 * 
 * @param string $class Extra class.        
 * 
 * @since 1.0  
 */   
function yit_portfolio( $slider_name = false ) {       
    echo do_shortcode( '[portfolio name="' . $slider_name . '"]' );
}

/** 
 * Print the pagination of the current loop of portfolio  
 * 
 * @param string $class Extra class.        
 * 
 * @since 1.0  
 */   
function yit_portfolio_pagination( $pages = false ) {       
    yit_get_model('portfolio')->get_pagination( $pages );
}

/** 
 * Get the vars of single page of portfolio item  
 * 
 * @return array        
 * 
 * @since 1.0  
 */   
function yit_portfolio_query_vars() {       
    return (object) yit_get_model('cpt_unlimited')->query_vars;
}

/** 
 * Get portfolio item permalink  
 * 
 * @return array        
 * 
 * @since 1.0  
 */   
function yit_work_permalink( $item_id = false ) {       
    $args = ! $item_id ? array() : array( 'item_id' => $item_id );
    return yit_get_model('cpt_unlimited')->get_permalink( $args );
}

/** 
 * Get portfolio term permalink  
 * 
 * @return array        
 * 
 * @since 1.0  
 */   
function yit_term_link( $term ) {       
    $args = ! is_array( $term ) ? array( 'cat' => $term ) : $term;
    return yit_get_model('cpt_unlimited')->get_term_link( $args );
}

/** 
 * Get list of terms  
 * 
 * @return array        
 * 
 * @since 1.0  
 */   
function yit_the_terms( $sep = ',' ) {       
    $terms = yit_work_get('terms');
    
    if ( empty( $terms ) ) { 
        $vars = yit_portfolio_query_vars();
        if ( ! empty( $vars->item['terms'] ) ) {
            $terms = $vars->item['terms'];
        } else {
            return;
        }
    }
    
    $categories = yit_work_get('categories');
    
    foreach ( $terms as $i => $term ) {
        $terms[$i] = '<a href="' . yit_term_link( $term ) . '">' . $categories[$term] . '</a>';    
    }
    
    echo implode( "$sep ", $terms );
}


/** 
 * Get number of items in specified category
 * 
 * @return int        
 * 
 * @since 1.0  
 */  
function yit_work_items_in_category($category, $post_id = false) {
	return yit_get_model('portfolio')->get_items_in_category($category, $post_id);
}


/** 
 * Get the list of portfolios
 * 
 * @return array        
 * 
 * @since 1.0  
 */  
function yit_portfolios() {
	return yit_get_model('cpt_unlimited')->get_posts_types( 'portfolios' );
}

/** 
 * Print the pagination of the current loop of portfolio  
 * 
 * @param string $class Extra class.        
 * 
 * @since 1.0  
 */   
function yit_portfolio_get_setting( $var, $post_id = false ) {   
    if ( ! $post_id ) {
        $return = yit_get_model('portfolio')->get( $var );
    } else {   
        $return = yit_get_model('cpt_unlimited')->get_setting( $var, $post_id );
        
        if ( empty( $return ) ) {
            $portfolio_type = yit_get_model('cpt_unlimited')->get_setting( 'portfolio_type', $post_id );
            $return = yit_get_model('cpt_unlimited')->get_setting( $var . '_' . $portfolio_type, $post_id );
        }
    }
    
    return $return;
}