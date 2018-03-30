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

/**
 * Sliders
 * 
 * General structure for the sliders, portfolio and gallery pages (and other similar)
 * where you are able to add many items for each post of a custom post type.
 * 
 * The logic is:
 * - each custom post type will be a general section (Sliders, Portfolios, Galleries, etc..)
 * - each post of a custom post type will be each individual element (a slider, a portfolio, a gallery, etc...)
 * - each post will contain several configurations and an array with all elements of each section, 
 * all this in several custom post meta of the post 
 * 
 * Examples: 
 * $args = array(
 *     
 *     'name' => '',    // nome generale della sezione (usato nel menu e in qualche label delle pagine admin)
 *     'icon_menu' => '',  // url dell'icona da far apparire nel menu, accanto al name  
 *     'settings' => array(),   // insieme di opzioni per la pagina di configurazione
 *     'settings_item' => array(),   // insieme di opzioni per la pagina di configurazione del singolo elemento
 *     'labels' => array(
 *         'item_name_sing' => ''  // nome dell'elemento singolo al singolare (slide, work, photo, etc...)
 *         'item_name_plur' => ''  // nome dell'elemento singolo al plurale (slides, works, photos, etc...)
 *     ), 
 *  
 * );                                                   
 * 
 * $yit->getModel('cpt_unlimited')->add( 'sliders', $args = array() );   
 * yit_add_unlimited_post_type( 'sliders', $args ); 
 * 
 * 
 * @since 1.0.0
 */

class YIT_Features_Tab {     
    
    /**
     * The object of CPT_Unlimited, used to add the post type of the slider
     * 
     * @var object
     * @since 1.0.0
     */
    protected $_theFeaturesTabObj = null;
    
    /**
	 * The html, after the text, for the links
	 *
	 * @since 1.0.0
	 * @access public
	 * @var array
	 */   
    public $shortcode_atts = array();    
    
    /**
	 * Actual form used for the loop
	 *
	 * @since 1.0.0
	 * @access public
	 * @var array
	 */   
    public $current_featurestab = array();     
    
    /**
	 * The error messages to show
	 *
	 * @since 1.0.0
	 * @access public
	 * @var array
	 */   
    public $messages = array();                      

	/**
	 * Constructor
	 * 
	 */
	public function __construct() { }
	
	/**
	 * Init
	 * 
	 */       
	public function init() {
        
        // add the post type for the features tab form
        add_action( 'init', array( &$this, 'add_post_type' ), 9 ); 

        // add the shortcode, used to show the features tab form
        add_shortcode( 'features_tab', array( &$this, 'featurestab_shortcode' ) );

		// ajax call for retrieving field option
        add_action( 'wp_ajax_add_featurestab_field', array( &$this, 'add_featurestab_field' ) );
        
        // add the scripts js for the features tab form
        add_action( 'wp_enqueue_scripts', array( &$this, 'add_featurestab_scripts' ) );
		
		// add the custom css for the features tab form
		add_action('wp_enqueue_scripts', array(&$this, 'add_featurestab_css'));

	}
    
    /**
     * Add the post type
     * 
     * @since 1.0.0
     */
    public function add_post_type() {
        $args = array(
            'settings' => array(
                array(
                    'type' => 'sep'
                ),                              
                array(
                    'desc' => __( 'Publish the features tab to configure it.', 'yit' ),
                    'type' => 'simple-text',
                    'only__not_saved' => true
                )
            ),
            'settings_items_file' => 'settings-featurestab.php',
            'labels' => array(
                'singular_name' => __( 'Features Tab', 'yit' ),
                'plural_name' => __( 'Features Tabs', 'yit' ),
                'item_name_sing' => __( 'Feature', 'yit' ),
                'item_name_plur' => __( 'Features', 'yit' ),
            ),
            'publicly_queryable' => false,
            'icon_menu' => YIT_CORE_ASSETS_URL . '/images/menu/featurestab.png'
        );
                                                     
        // add the post type for the slider
        $this->_theFeaturesTabObj = yit_add_unlimited_post_type( 'featurestab', $args );   
        
        // change the columns of the tables
        add_action( 'manage_featurestab_posts_custom_column', array( &$this, 'custom_columns' ) );
        add_filter( 'manage_edit-featurestab_columns', array( &$this, 'edit_columns' ) );
    }          
    
    
    /** 
     * The shortcode used to show theslider
     *
     * @since 1.0.0
     */                   
    public function featurestab_shortcode( $atts, $content = null ) {
        $atts = shortcode_atts(array(
            'name' => null
        ), $atts);  
        
        // don't show the slider if 'name' is empty or is 'none'
        if ( empty( $atts['name'] ) || 'none' == $atts['name'] ) return;
                                               
        // save the shortcode attributes in the global array, to get them with the ->get() method
        $this->shortcode_atts = $atts;
        
        return $this->print_tab( $atts['name'], false );
    
    }                      
	
	/**
	 * Get a specific setting of the featurestab form
	 * 
	 * @since 1.0.0
	 */
    public function get( $setting, $post_id = false ) {
        if ( ! $post_id ) $post_id = $this->current_featurestab;
        
        switch ( $setting ) {
            
            case 'fields':
                return array_values( yit_get_model('cpt_unlimited')->get_items( $post_id ) );
            
            default:
                return yit_get_model('cpt_unlimited')->get_setting( $setting, $post_id );
            
        } 
    }
    
    /**
     * Print the messages for the panel
     * 
     * @since 1.0.0
     */                   
    protected function _getMessage( $message, $form = false )
    {
        if ( ! $form ) $form = $this->current_featurestab;
        
        if ( isset( $this->messages[$form][$message] ) )
            return $this->messages[$form][$message];
    }

    /**
     * Print the messages for the panel
     * 
     * @since 1.0.0
     */                   
    protected function _generalMessage( $form = false, $echo = true )
    {
        if ( ! $form ) $form = $this->current_featurestab;    
    
        if ( ! $echo ) ob_start();
        
        echo $this->_getMessage( 'general', $form );
    
        if ( ! $echo ) return ob_get_clean();
    }        

    /**
     * Add the scripts js for the featurestab form
     * 
     * @since 1.0.0
     */                   
    public function add_featurestab_scripts() {
        global $is_IE;

        if( $is_IE ) {
            wp_enqueue_script( 'jquery-placeholder-plugin', YIT_CORE_ASSETS_URL . '/js/jquery.placeholder.js', array( 'jquery' ), '1.0', true );
        }

        wp_enqueue_script( 'tiny_mce' );
        wp_enqueue_script( 'features-tab', YIT_CORE_ASSETS_URL . '/js/featurestab.js', array( 'jquery', 'jquery.placeholder', 'tiny_mce' ), '1.0', true );
    
        wp_localize_script( 'features-tab', 'featuresTab', array(
    		'wait' => __( 'wait...', 'yit' )
    	) );
    }

	/**
	 * Add custom style
	 * 
	 */
	public function add_featurestab_css() {
	    $url = get_template_directory_uri() . '/theme/assets/css/featurestab.css';
	    yit_wp_enqueue_style(1200,'featurestab', $url);
	 }
    
    /* ADMIN
    ------------------------------------------------------------------------- */  
    
    /**
     * Customize the columns in the table of all post types
     * 
     * @since 1.0.0          
     */        
    public function custom_columns( $column ) {
        global $post;
                                              
        switch ( $column ) {
            //case "default":                          
            //    break;
            case "shortcode": 
                if ( isset( $post->post_name ) && ! empty( $post->post_name ) ) echo '[features_tab name="' . $post->post_name . '"]';                         
                break;
        }                                  
    
    }     
    
    /**
     * Edit the columns in the table of all post types
     * 
     * @since 1.0.0          
     */        
    public function edit_columns( $columns ) {
        //$columns['default'] = __( 'Set as Default', 'yit' );
        $columns['shortcode'] = __( 'Shortcode', 'yit' );
        
        return $columns;
    }   

	/**
	 * Ajax call used to retrieve features tab form fields
	 * 
	 * @since 1.0.0
	 */
	public function add_featurestab_field( $args = array() ) {
	    extract( wp_parse_args( $args, array(
            'index'      => isset( $_POST['action'] ) && $_POST['action'] == 'add_featurestab_field' && isset( $_POST['index'] )      ? intval( $_POST['index'] )      : 0,
            'post_id'    => isset( $_POST['action'] ) && $_POST['action'] == 'add_featurestab_field' && isset( $_POST['post_id'] )    ? intval( $_POST['post_id'] )    : 0,
            'field_name' => isset( $_POST['action'] ) && $_POST['action'] == 'add_featurestab_field' && isset( $_POST['field_name'] ) ? $_POST['field_name'] : 0,
            'die'        => true
        ) ) );
        
        $index++; // evita di salvare in array un valore con chiave 0, perchè viene cancellato dal sistema, durante il salvataggio
	   
	    $items = array_values( yit_get_model('cpt_unlimited')->get_items( $post_id ) );
	    $value = wp_parse_args( isset( $items[$index-1] ) ? $items[$index-1] : array(), array(
            'order' => 0,
            'title' => '',
            'content' => '',
            'icon' => '',
        ) ); 
	    
	    $args = array(
            'name' => $field_name . '[items][' . $index . ']',
            'id' => $field_name . '_items_' . $index,
            'index' => $index,
            'value' => $value
        );
		yit_get_template( 'admin/post-type-unlimited/settings-featurestab-field.php', $args );
		
		if ( $die ) die();
	}
    
    /**
     * Features tab shortcode
     * 
     * @return string
     * @since 1.0.0
     */
    public function print_tab( $name_or_id, $echo = true ) {
        global $yit_is_feature_tab;
        $yit_is_feature_tab = true;

	    $this->current_featurestab = is_int( $name_or_id ) ? $name_or_id : yit_post_id_from_slug( $name_or_id, 'featurestab' );
        $tab_id = yit_post_slug_from_id( $this->current_featurestab );
        
        $fields = $this->get( 'fields' );
        
        if( !is_array( $fields ) OR empty( $fields ) )
    		return null;
        
        $features_label = '';
        $features_content = '';
        $i = 0;
        
        foreach( $fields as $id => $field ) :
            $current = ( !$i ) ? 'current-feature' : '';
            
            if( empty( $field['icon'] ) ) {
				$the_label = '<li class="features-tab-' . ( $i ) . ' ' . $current . '">';
			}else{
				$the_label = '<li class="features-tab-' . ( $i ) . ' ' . $current . ' withicon">';
                $the_label .= '<img src="' . $field['icon'] . '" title="' . $field['title'] . '" alt="' . $field['title'] . '" />';
            }
            
            $the_label .= $field['title'];
            $the_label .= '</li>';
            
            $the_content = '<div class="features-tab-content features-tab-' . ( $i ) . ' ' . $current . '">' . yit_addp( $field['content'] ) . '</div>';
            
            $features_label .= $the_label;
            $features_content .= $the_content;
            
            $i++;
            
        endforeach;
    
        $without_sidebar = ( yit_get_sidebar_layout() == 'sidebar-no' ) ? 'without-sidebar' : '';
        
        $html = '<div class="row">';
            $html .= '<div id="features-tab-' . $name_or_id . '" class="features-tab-container  group span' . ( yit_get_sidebar_layout() == 'sidebar-no' ? '12' : '9' ) . ' margin-bottom">';
                $html .= '<div class="row">';
					$html = apply_filters( 'yit_before_features_tab_menu', $html );
                    $html .= '<ul class="features-tab-labels span3">' . $features_label . '</ul>';
                    $html .= '<div class="features-tab-wrapper span' . ( yit_get_sidebar_layout() == 'sidebar-no' ? '9' : '6' ) . '">' . $features_content . '</div>';
					$html = apply_filters( 'yit_after_features_tab_content', $html );
                $html .= '</div>';
            $html .= '</div>';
        $html .= '</div>';
        
        if( $echo )
            { echo $html; }
        
        return $html;      
    
        $yit_is_feature_tab = false;
    }
}                     
