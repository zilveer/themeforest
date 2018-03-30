<?php
/*
 * Page preloader
 */
if(!function_exists('a13_page_preloader')){
    function a13_page_preloader(){
        global $a13_apollo13;

        if($a13_apollo13->get_option( 'appearance', 'preloader' ) === 'on'){
            $text = $a13_apollo13->get_option( 'appearance', 'preloader_text' );
	        $class_attr = '';
	        if($a13_apollo13->get_option( 'appearance', 'preloader_hide_event' )){
		        $class_attr = ' class="onReady"';
	        }
        ?>
<div id="preloader"<?php echo $class_attr; ?>>
    <div class="preload-content">
        <div class="pace-progress"><div class="pace-progress-inner"></div></div>
        <div class="pace-activity"></div>
        <div class="preloader-text"><?php echo $text; ?></div>
        <a class="skip-preloader" href="#"><?php _e( 'Hide page preloader', 'fame' ); ?></a>
    </div>
</div>
        <?php
        }
    }
}

/*
 * Prints search form with custom id for each displayed form one one page
 */
if(!function_exists('a13_search_form')){
    function a13_search_form() {
        static $search_id = 1;
	    global $apollo13;

        $wpml_active = defined( 'ICL_SITEPRESS_VERSION');
	    $shop_search_option = @$apollo13->get_option( 'settings', 'shop_search' );
	    $shop_search = $shop_search_option === 'on';
        $helper_search = get_search_query() == '' ? true : false;
        $field_search = '<input' .
            ' placeholder="' . esc_attr(__('Search', 'fame' )) . '" ' .
            'type="search" name="s" id="s' . $search_id . '" value="' .
            esc_attr( $helper_search ? '' : get_search_query() ) .
            '" />';

        $form = '
                <form class="search-form" role="search" method="get" action="' . home_url( '/' ) . '" >
                    <fieldset class="semantic">
                        ' . $field_search . '
                        <input type="submit" id="searchsubmit' . $search_id . '" title="'. esc_attr( __('Search', 'fame' ) ) .'" value=" " />
                        '.($shop_search? '<input type="hidden" value="product" name="post_type">' : '').'
                        '.($wpml_active? ('<input type="hidden" name="lang" value="'.ICL_LANGUAGE_CODE.'"/>') : '').'
                    </fieldset>
                </form>';

        //next call will have different ID
        $search_id++;
        return $form;
    }
}

/*
 * Page title, Filter and others (ex. RSS for blog)
 */
if(!function_exists('a13_title_bar')){
    function a13_title_bar($title = '') {
        global $apollo13, $a13_apollo13;

        $page_type = a13_what_page_type_is_it();
        $home = $page_type['home'];
        $single = $page_type['single'];
        $shop = a13_is_woocommerce_no_title_page();
        $product = a13_is_woocommerce_activated() ? is_product() : false;

        //id from where
        $meta_id = false;
        if($shop || $product){
            $meta_id = wc_get_page_id( 'shop' );
        }
        elseif($page_type['single_not_post']){
            $meta_id = get_the_ID();
        }
        elseif(($page_type['blog_type'] || $single) && get_option( 'page_for_posts') !== '0'){
            $meta_id = get_option( 'page_for_posts');
        }

        //is it OFF?
        if(!a13_is_no_property_page()){ //checks if page can have meta fields
            if($apollo13->get_meta('_title_bar_settings', $meta_id) === 'off'){
                return;
            }
        }

        //title bar classes
        $fit = 'bg-'.a13_title_bar_look($meta_id); //get styles for current header bar and return fit method
        $title_bar_variant = ' title_bar_variant_'.$apollo13->get_option( 'appearance', 'title_bar_variant' );
        $tb_classes = $fit.$title_bar_variant;
		$title_on = $a13_apollo13->get_meta('_title_bar_title', $meta_id) === 'on' || strlen($a13_apollo13->get_meta('_title_bar_title', $meta_id) === 'on') === 0;
		$breadcrumbs_on = function_exists('bcn_display') && $a13_apollo13->get_meta('_breadcrumbs', $meta_id) === 'on';
		$tb_classes .= $title_on? '' : ' title_off';
        ?>
    <header class="title-bar <?php echo esc_attr($tb_classes); ?>">
        <div class="in">
            <?php
            $rss = ($apollo13->get_option( 'blog', 'info_bar_rss' ) === 'on');

            //use passed $title
            if(!empty( $title )){
                //change nothing
            }
            //works or galleries
            elseif ( $page_type['cpt'] ){
                $title = get_the_title();
            }
            //blog
            elseif ( $home ){
                if(get_option('page_for_posts') === '0'){
                    $title = __( 'Blog', 'fame' );
                }
                else{
                    $title = get_the_title(get_option('page_for_posts'));
                }
            }
            //pages, blog post, etc.
            else{
                $title = get_the_title();
            }

	        if($title_on) {
		        //woocommerce page
		        if ( $shop && ! $product ) {
			        $title = woocommerce_page_title(false);
		        }
		        echo '<h1 class="page-title">'.$title.'</h1>';
	        }

            if(!$product){
                //what else to display
                $what = $apollo13->get_meta('_subtitle_or_button', $meta_id);

                //subtitle
                $subtitle = $apollo13->get_meta('_subtitle', $meta_id);
                if($what !== 'off' && strlen($subtitle)){
                    echo '<h2>'.$subtitle.'</h2>';
                }

                //RSS
                if(!$shop && $home && $rss){
                    echo '<a href="'.esc_url(get_bloginfo('rss2_url')).'" class="fa fa-rss" title="'.__( 'RSS', 'fame' ).'"></a>';
                }

                //button
                if($what !== 'off'){
                    $url = $apollo13->get_meta('_button_url', $meta_id);
                    $text = $apollo13->get_meta('_button_text', $meta_id);
                    $new_tab = $apollo13->get_meta('_new_tab', $meta_id) === '1'? ' target="_blank"' : '';

                    if(strlen($url)){
                        echo '<a href="'.esc_url( $url ).'" class="a13-button"'.$new_tab.'>'.$text.'</a>';
                    }
                }

                //post meta
                if(is_single()){ a13_post_meta(); }
            }

            //breadcrumbs
            if($breadcrumbs_on){

                if(function_exists('bcn_display')){
                    echo '<div class="breadcrumbs">';
                    bcn_display();
                    echo '</div>';
                }

            }
            ?>
        </div>
    </header>
    <?php
    }
}


/*
 * Prints CSS for title bar
 */
if(!function_exists('a13_title_bar_look')){
    function a13_title_bar_look($id) {
        global $apollo13;

        if($id && get_post_meta($id, '_title_bar_settings', true) == 'custom'){
            $bg_image       = get_post_meta($id, '_title_bar_image', true);
            $bg_color       = get_post_meta($id, '_title_bar_bg_color', true);
            $title_color    = get_post_meta($id, '_title_bar_title_color', true);
            $custom_color_1 = get_post_meta($id, '_title_bar_color_1', true);
            $custom_color_2 = get_post_meta($id, '_title_bar_color_2', true);
            $fit            = get_post_meta($id, '_title_bar_image_fit', true);
            $space          = get_post_meta($id, '_title_bar_space_width', true);
        }
        //global setting
        else{
            $bg_image       = $apollo13->get_option( 'appearance', 'title_bar_image' );
            $bg_color       = $apollo13->get_option( 'appearance', 'title_bar_bg_color' );
            $title_color    = $apollo13->get_option( 'appearance', 'title_bar_title_color' );
            $custom_color_1 = $apollo13->get_option( 'appearance', 'title_bar_color_1' );
            $custom_color_2 = $apollo13->get_option( 'appearance', 'title_bar_color_2' );
            $fit            = $apollo13->get_option( 'appearance', 'title_bar_image_fit' );
            $space          = $apollo13->get_option( 'appearance', 'title_bar_space_width' );
        }

        $css = '
            .title-bar{
                background-image:url('.esc_url($bg_image).');
                background-color:'.$bg_color.';
            }
            .title-bar .in{
                padding-top:'.$space.';
                padding-bottom:'.$space.';
            }
            .title-bar h1,
            .title-bar .in h2{
                color:'.$title_color.';
            }
            .page-title:after,
            .page-title:before{
                background-color:'.$title_color.';
            }
            .breadcrumbs .sep,
            .breadcrumbs a, .title-bar .post-meta a{
                color:'.$custom_color_1.';
            }
            .breadcrumbs, .breadcrumbs a:hover,
            .title-bar .post-meta, .title-bar .post-meta a:hover, .title-bar .post-meta a .label{
                color:'.$custom_color_2.';
            }
            .title-bar .in .fa-rss{
                color:'.$title_color.';
                border-color:'.$custom_color_2.';
            }
            .title-bar .in .fa-rss:hover{
                color:'.$custom_color_2.';
                border-color:'.$title_color.';
            }
            ';

        echo "<style type='text/css'>\n";
        echo "$css\n";
        echo "</style>\n";

        return $fit;
    }
}


/*
 * Compare positions, used only in social widget
 */
function a13_cmp_socials_positions($a, $b){
    if ($a['pos'] == $b['pos']) {
        return 0;
    }
    return ($a['pos'] < $b['pos']) ? -1 : 1;
}


/*
 * Return HTML for social icons
 */
if(!function_exists('a13_social_icons')){
    function a13_social_icons($bg){
        global $apollo13;


        $socials = (array)$apollo13->get_option( 'socials', 'social_services' );
        $variant = ' '.$apollo13->get_option( 'socials', 'socials_variant' );
        uasort($socials, "a13_cmp_socials_positions");
        $soc_html = '';
        $has_active = false;
        $protocols = wp_allowed_protocols();
        $protocols[] = 'skype';

        foreach( $socials as $id => $value ){
            if( ! empty($value['value']) ){
                $soc_html .= '<a target="_blank" href="' . esc_url($value['value'], $protocols) . '" title="' . esc_attr(__( 'Follow us on ', 'fame' ) . $apollo13->all_theme_options[ 'socials' ][ 'social_services' ][ $id ]['name']) . '" class="a13_soc-'.$id.'"></a>';
                $has_active = true;
            }
        }

        if($has_active){
            $soc_html = '<div class="socials '.$bg.$variant.'">'.$soc_html.'</div>';
        }

        return $soc_html;
    }
}


if(!function_exists('a13_demo_switcher')){
    function a13_demo_switcher(){
        global $apollo13;

        if($apollo13->is_home_server() && $apollo13->get_option( 'advanced', 'demo_switcher' ) === 'on'){
            $dir = A13_TPL_ADV_DIR.'/demo_settings';
            $sets_html = array();
            $selected_set = isset($_COOKIE["a13_demo_set"])? $_COOKIE["a13_demo_set"] : 'default';
            $order = false;
            $title = esc_attr(sprintf( __( 'Use this switcher to see different possible combinations of settings. You can turn off this switcher in theme options: %s.', 'fame' ), A13_TPL_ALT_NAME . ' theme->Advanced->Demo switcher'));

            if( is_dir( $dir ) ) {
                foreach ( (array)glob($dir.'/*') as $file ){
                    $name = basename($file);
                    if($name === '_order'){
                        $order = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                        continue;
                    }
                    $img = A13_TPL_GFX.'/demos/'.$name.'.jpg';
                    $selected = ($name === $selected_set)? ' class="selected"' : '';
                    $sets_html[$name] = '<a href="?a13_demo_set='.urlencode($name).'" title="'.$name.'"'.$selected.'><img src="'.$img.'" alt="" /></a>';
                }
            }

            //sort array
            $sets_html = array_merge(array_flip($order), $sets_html);
            //join to string
            $sets_html = implode('', $sets_html);

            if(strlen($sets_html)){
                ?>
            <div id="a13-demo-switcher">
                <span class="before-label"><?php _e( 'Style switcher', 'fame' ); ?><a href="#" class="fa fa-wrench" title="<?php echo $title; ?>"></a></span>
                <div class="sets"><?php echo $sets_html; ?></div>
            </div>
            <?php
            }
        }
    }
}



add_filter( 'get_search_form','a13_search_form' );