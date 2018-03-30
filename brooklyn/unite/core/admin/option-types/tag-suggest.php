<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Tag Suggest
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_tag_suggest' ) ) {
  
    function ut_render_option_tag_suggest( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );

        $dependency = ut_create_dependency( $settings['required'] );        
        
        $all_tags = get_tags();
        $all_tags_json = array();        
        
        if( empty( $all_tags ) ) {
            
            echo 'No tags available. Please create some tgas first.';
            return;
            
        } else {
            
            foreach( $all_tags as $key => $tag ) {
                                
                $all_tags_json[$key]['label']    = $tag->slug;
                $all_tags_json[$key]['term_id']  = $tag->term_id;
            
            }
        
        }
        
        ?>
        
        <script type="text/javascript">
            /* <![CDATA[ */
            
            var unite_all_tags = <?php echo json_encode( $all_tags_json ); ?>;
            
            /* ]]> */
        </script>
        
        <?php
                   
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="text" data-panel-for="' , esc_attr( $id ) , '">';    
            
            echo '<input autocomplete="off" type="text" name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" value="' , esc_attr( $value ) , '" class="ut-full-width ut-option-element ut-tag-suggest" />'; 
                    
        echo '</div>';
           
        
    }

}