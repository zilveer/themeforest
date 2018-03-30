<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

class UT_Taxonomy_Option {
    
    /**
     * Taxonomy Array
     * @var array
     */         
    private $unite_taxonomy_options;


    /**
     * Constructor
     * @since     1.0.0
     * @version   1.0.0
     */
    public function __construct( $unite_taxonomy_options ) {
        
        /* assign taxonomy settings */
        $this->taxonomy_options = $unite_taxonomy_options;   
        
        /* assign taxonomy option key */
        $this->taxonomy_key = 'unite_taxonomy_meta';
        
        /* load metabox */
        $this->hooks();
        
    }
    
    /**
     * Initiate our hooks
     * @since     1.0.0
     * @version   1.0.0
     */
    public function hooks() {
        
        foreach ( (array) $this->taxonomy_options['config']['taxonomy'] as $taxonomy ) {
            
            if( isset($_GET['taxonomy']) && $_GET['taxonomy'] == $taxonomy ) {
                
                /* only add if taxonomy has been set */
                add_action( $taxonomy . '_edit_form_fields', array( $this, 'render_taxonomy_option' ) );
                    
            }
            
        }            
        
        add_action( 'edit_category', array( $this, 'save_taxonomy_option' ) );
        add_action( 'edit_post_tag', array( $this, 'save_taxonomy_option' ) );
        add_action( 'edit_term', array( $this, 'save_taxonomy_option' ) );
        
        /* css */
        add_action('admin_print_scripts-term.php', array( $this, 'enqueue_css' ) );
        add_action('admin_print_scripts-edit-tags.php', array( $this, 'enqueue_css' ) );        
        
    }
    
    /**
     * Render our taxonomy option
     * @since     1.0.0
     * @version   1.0.0
     */
    public function render_taxonomy_option( $tag ) { 
        
        $category_meta = get_option( $this->taxonomy_key . '_' . $tag->term_id ); ?>
                
        <!-- close default options table -->
        </tbody></table>
        
        <!-- Start UT-Backend-Wrap -->
        <div class="ut-admin-wrap clearfix">
            
            <div class="ut-backend-top-bar clearfix">
                
                <a class="ut-backend-logo hide-on-tablet hide-on-mobile" href="http://www.unitedthemes.com" target="_blank" title="UnitedThemes">
                    <img src="<?php echo FW_WEB_ROOT . '/core/admin/assets/img/ut_logo_white.png'; ?>" alt="United Themes" />
                </a>
                
                <h2>
                    <?php esc_html_e( 'Options', 'unite-admin' ); ?>                    
                </h2>
               
            </div>
            <!-- Close UT-Backend-Topbar -->
        
            <!-- Start UT-Admin-Main -->                
            <div class="ut-admin-main">
        
                <div class="ut-admin-panel-group ut-show">
                                
                <?php foreach( (array) $this->taxonomy_options['settings'] as $settings) {
                    
                    echo '<section class="ut-admin-panel clearfix">';
                                    
                    /* assign value */
                    $settings['value'] = isset( $category_meta[ $settings['id'] ] ) ? $category_meta[ $settings['id'] ] : '';
                    
                    /* prepare options field settings */
                    $settings = ut_prepare_settings_field( $settings, 'meta_box', $this->taxonomy_key );
                    
                    /* assign name */
                    $settings['name'] = $this->taxonomy_key . '['. $settings['id'] . ']';
                    
                    /* start output */
                    echo '<header class="ut-admin-panel-header grid-40 mobile-grid-100 clearfix" data-action="collapse" data-collapse-panel="' , $settings['id'] , '">';
                    
                        echo '<h3 class="ut-admin-panel-header-title ' , ( empty( $settings['desc'] ) ? 'no-description' : '' ) , '">' , $settings['title'] , '</h3>';
                    
                        if( !empty( $settings['desc'] ) ) {
                
                            echo '<span class="ut-admin-panel-description">' , $settings['desc'] , '</span>';
                                            
                        }                    
                    
                    echo '</header>';
                    
                    /* assign settings grid */
                    $settings['grid'] = 'grid-60 mobile-grid-100';
                    
                    /* option function to call */                    
                    $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                    
                    if( function_exists($function_by_type) ) {
                                                            
                        call_user_func( $function_by_type, $settings );
                    
                    } else {
                        
                        esc_html_e( 'Function does not exist!', 'unite-admin' );
                        
                    }                    
                    
                    echo '</section>';
                    
                } ?>
                
                </div>
        
            <input type="hidden" name="<?php echo $tag->term_id; ?>" />
            
            </div>                
            <!-- Close UT-Admin-Main -->            
            
        </div>
        <!-- Close UT-Backend-Wrap -->
                
        <!-- re open table -->
        <table><tbody>
    
    <?php }
    
    
    /**
     * Enqueue Taxonomy CSS 
     *
     * @since     1.0.0
     * @version   1.0.0
     */
    public function enqueue_css() {
        
        $min = NULL;
            
        if( !WP_DEBUG ){
            $min = '.min';
        }
        
        wp_enqueue_style(
            'unite-taxonomy-admin', 
            FW_WEB_ROOT . '/core/admin/assets/css/unite-taxonomy' . $min . '.css',
            false, 
            UT_VERSION
        );        
    
    }            
    
    /**
     * Save our taxonomy option
     * @since     1.0.0
     * @version   1.0.0
     */
    public function save_taxonomy_option( $term_id ) {
                                            
        if ( isset( $_POST[ $this->taxonomy_key ] ) ) {
            
            $sanitized_options = array();
                            
            /* loop trough post data */
            foreach( (array) $_POST[$this->taxonomy_key] as $key => $taxonomy ) {
                                                                            
                foreach( (array) $this->taxonomy_options['settings'] as $setting ) {
                                            
                    if( $key == $setting['id']) {
                                                                                
                        $sanitized_options[$setting['id']] = ut_sanitize_option( $taxonomy , $setting['type'] , $setting['id'], 'taxonomy-options' );    
                        
                    }                        
                         
                }
                
            }                
            
            if ( !update_option($this->taxonomy_key . '_' . $term_id ,  $sanitized_options ) ) {
                
                add_option($this->taxonomy_key . '_' . $term_id , $sanitized_options );
            
            }                                               
            
        }            
        
    }
    
}

