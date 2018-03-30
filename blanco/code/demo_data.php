<?php 

    if(@$_GET['etheme_install'] == 'blanco'):
    global $user_ID;
    
    $new_posts_array = array();
    
    global $e_installerrors;
    global $e_installsuccs;
    
    $new_posts_array = array(
        'home' => array(
            'post_title' => 'Home page',
            'post_content' => '
                <div>[layerslider id="1"]</div>
                <div class="banner one-half">
                    <img src="[etheme_template_url]/images/assets/b1.jpg" alt="" />
                    [etheme_btn title="Shop Now" url="test_url" class="active"]
                </div>
                <div class="banner one-half last">
                    <img src="[etheme_template_url]/images/assets/b2.jpg" alt="" />
                    [etheme_btn title="Shop Now" url="test_url" class="active"]
                </div>
                <div class="clear"></div>[etheme_featured][etheme_bestsellers][etheme_new title="Latest Products" ]',
            'post_status' => 'publish',
            'post_date' => date('Y-m-d H:i:s'),
            'post_author' => $user_ID,
            'post_type' => 'page',
            'post_category' => array(0)
        ),
        'blog' => array(
            'post_title' => 'Blog',
            'post_content' => '',
            'post_status' => 'publish',
            'post_date' => date('Y-m-d H:i:s'),
            'post_author' => $user_ID,
            'post_type' => 'page',
            'post_category' => array(0)
        ),
        'contacts' => array(
            'post_title' => 'Contact Us',
            'post_content' => '[etheme_contacts]',
            'post_status' => 'publish',
            'post_date' => date('Y-m-d H:i:s'),
            'post_author' => $user_ID,
            'post_type' => 'page',
            'post_category' => array(0)
        )
    );

    /* E-commerce Bug Fix (Call to undefined function get_current_screen()) */
        
    remove_filter( 'wp_insert_post_data','wpsc_pre_update', 99, 2 );
    remove_action( 'save_post', 'wpsc_admin_submit_product', 10, 2 );
    remove_action( 'admin_notices', 'wpsc_admin_submit_notices' );
    
    foreach($new_posts_array as $key => $post){
        $post_id = wp_insert_post($post);

        $e_installsuccs[] = '<strong>'.$post['post_title'].'</strong> successfully installed!';
        
        if($key == 'home') {
            add_post_meta($post_id, '_wp_page_template', 'frontpage.php');
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $post_id );
        }
        if($key == 'blog') {
            update_option( 'page_for_posts', $post_id );
        }
    }

    
    function ethemeShowAdminMessages(){

        global $e_installerrors,$e_installsuccs;
        if(count($e_installerrors) < 1){
            echo '<div id="message" class="updated fade">';
            foreach($e_installsuccs as $msg){
                echo "<p>$msg</p>";
            }
            
        }else {
            echo '<div id="message" class="error">';
            foreach($e_installerrors as $msg){
                echo "<p>$msg</p>";
            }
        }
        echo "</div>";
    }
    add_action('admin_notices', 'ethemeShowAdminMessages');    
endif; ?>