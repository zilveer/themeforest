<?php

/* Create Custom Post Type : Slide */
if( !function_exists( 'create_slide_post_type' ) ){
    function create_slide_post_type(){
        $labels = array(
            'name' => __( 'Slides','framework'),
            'singular_name' => __( 'Slide','framework' ),
            'add_new' => __('Add New','framework'),
            'add_new_item' => __('Add New Slide','framework'),
            'edit_item' => __('Edit Slide','framework'),
            'new_item' => __('New Slide','framework'),
            'view_item' => __('View Slide','framework'),
            'search_items' => __('Search Slide','framework'),
            'not_found' =>  __('No Slide found','framework'),
            'not_found_in_trash' => __('No Slide found in Trash','framework'),
            'parent_item_colon' => ''
          );

          $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'show_ui' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_icon' => 'dashicons-images-alt',
            'menu_position' => 5,
            'supports' => array('title','thumbnail')
          );

          register_post_type('slide',$args);
    }
}
add_action( 'init', 'create_slide_post_type' );


/* Add Custom Columns */
if( !function_exists( 'slide_edit_columns' ) ){
    function slide_edit_columns($columns){
        $columns = array(
              "cb" => '<input type="checkbox" >',
              "title" => __( 'Slide Title','framework' ),
              "slide_thumb" => __( 'Thumbnail','framework' ),
              "slide_sub_text" => __('Slide Sub Text','framework'),
              "date" => __( 'Date','framework' )
        );

        return $columns;
    }
}
add_filter("manage_edit-slide_columns", "slide_edit_columns");

if( !function_exists( 'slide_custom_columns' ) ){
    function slide_custom_columns($column){
        global $post;
        switch ($column)
        {
            case 'slide_thumb':
                if(has_post_thumbnail($post->ID)){
                    the_post_thumbnail('post-thumbnail');
                }else{
                    _e('No Slider Image','framework');
                }
                break;
            case 'slide_sub_text':
                $slide_sub_text = get_post_meta($post->ID,'slide_sub_text',true);
                if(!empty($slide_sub_text)){
                    echo $slide_sub_text;
                }else{
                    _e('NA','framework');
                }
                break;
        }
    }
}
add_action("manage_posts_custom_column", "slide_custom_columns");

/*-----------------------------------------------------------------------------------*/
/*	Add Metabox to Slide
/*-----------------------------------------------------------------------------------*/
add_action( 'add_meta_boxes', 'slide_meta_box_add' );

if( !function_exists( 'slide_meta_box_add' ) ){
    function slide_meta_box_add(){
        add_meta_box( 'slide-meta-box', __('Slide Information', 'framework'), 'slide_meta_box', 'slide', 'normal', 'high' );
    }
}

if( !function_exists( 'slide_meta_box' ) ){
    function slide_meta_box( $post )
    {
        $values = get_post_custom( $post->ID );

        $slide_sub_text = isset( $values['slide_sub_text'] ) ? esc_attr( $values['slide_sub_text'][0] ) : '';
        $slide_url = isset( $values['slide_url'] ) ? esc_attr( $values['slide_url'][0] ) : '';

        wp_nonce_field( 'slide_meta_box_nonce', 'meta_box_nonce_slide' );
        ?>
        <table style="width:100%;">
            <tr>
                <td style="width:25%; vertical-align: top;">
                    <label for="slide_sub_text"><strong><?php _e('Sub Text','framework');?></strong></label>
                </td>
                <td style="width:75%;">
                    <textarea name="slide_sub_text" id="slide_sub_text" cols="30" rows="3" style="width:60%; margin-right:4%;"><?php echo $slide_sub_text; ?></textarea>
                    <span style="color:#999; display:block;"><?php _e('This text will appear below Title on slide.','framework'); ?></span>
                </td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align:top;">
                    <label for="slide_url"><strong><?php _e('Target URL','framework');?></strong></label>
                </td>
                <td style="width:75%; ">
                    <input type="text" name="slide_url" id="slide_url" value="<?php echo $slide_url; ?>" style="width:60%; margin-right:4%;" />
                    <span style="color:#999; display:block;  margin-bottom:10px;"><?php _e('This URL will be applied on Slide Image.','framework'); ?></span>
                </td>
            </tr>
        </table>
        <?php
    }
}


add_action( 'save_post', 'slide_meta_box_save' );

if( !function_exists( 'slide_meta_box_save' ) ){
    function slide_meta_box_save( $post_id ){

        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

        if( !isset( $_POST['meta_box_nonce_slide'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_slide'], 'slide_meta_box_nonce' ) ) return;

        if( !current_user_can( 'edit_post' ) ) return;

        if( isset( $_POST['slide_sub_text'] ) )
            update_post_meta( $post_id, 'slide_sub_text', $_POST['slide_sub_text']  );

        if( isset( $_POST['slide_url'] ) )
            update_post_meta( $post_id, 'slide_url', $_POST['slide_url'] );

    }
}
?>