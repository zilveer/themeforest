<?php
/**
 * We display the widgets according to the ones saved in the user table
 * This function is inspired from https://github.com/WordPress/WordPress/blob/4.5-branch/wp-includes/widgets.php#L613
 *
 * @return nothing
 * @since 2.0.0
 */
function woffice_dashboard_widgets($widgets_order) {

    global $wp_registered_sidebars, $wp_registered_widgets;

    // hard written dashboard because we already know it.
    $index = 'dashboard';

    foreach ( (array) $wp_registered_sidebars as $key => $value ) {
        if ( sanitize_title( $value['name'] ) == $index ) {
            $index = $key;
            break;
        }
    }
    $sidebars_widgets = wp_get_sidebars_widgets();

    if ( empty( $wp_registered_sidebars[ $index ] ) || empty( $sidebars_widgets[ $index ] ) || ! is_array( $sidebars_widgets[ $index ] ) ) {
        do_action( 'dynamic_sidebar_before', $index, false );
        do_action( 'dynamic_sidebar_after',  $index, false );
        return apply_filters( 'dynamic_sidebar_has_widgets', false, $index );
    }
    do_action( 'dynamic_sidebar_before', $index, true );
    $sidebar = $wp_registered_sidebars[$index];
    $did_one = false;

    // $widgets_order in the loop was : $sidebars_widgets[$index]
    $widgets_order_ready = (array) unserialize($widgets_order);
    $sidebars_widgets[$index]= (array) $sidebars_widgets[$index];

    // We compare if there is the same number of widgets saved for the user than saved for this sidebar
    // If not, that means there was some new ones added from the admin :

    // Widgets has been added, let's add them at the end :
    if(count($widgets_order_ready) < count($sidebars_widgets[$index])) {
        $array_diff= array_diff($sidebars_widgets[$index],$widgets_order_ready);
        $widgets_order_ready = array_merge($widgets_order_ready, $array_diff);

    }
    // Widgets has been deleted from the admin, let's delete them :
    elseif(count($widgets_order_ready) > count($sidebars_widgets[$index])) {
        $array_diff= array_diff($widgets_order_ready,$sidebars_widgets[$index]);
        $widgets_order_ready = array_diff($widgets_order_ready,$array_diff);
    }

    // If there is an empty array (Woffice 2.0.3), that means all widgets have been deleted, we send back the new ones :
	$intersect = array_intersect($widgets_order_ready, $sidebars_widgets['dashboard']);
	if(empty($widgets_order_ready) || count($intersect) != count($sidebars_widgets['dashboard'])) {
	    dynamic_sidebar( 'dashboard' );
	    update_user_meta(get_current_user_id(), 'woffice_dashboard_order', serialize(array()));
	    return;
    }

    foreach ( (array) $widgets_order_ready as $id ) {
        if ( !isset($wp_registered_widgets[$id]) ) continue;
        $params = array_merge(
            array( array_merge( $sidebar, array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']) ) ),
            (array) $wp_registered_widgets[$id]['params']
        );
        // Substitute HTML id and class attributes into before_widget
        $classname_ = '';
        foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn ) {
            if ( is_string($cn) )
                $classname_ .= '_' . $cn;
            elseif ( is_object($cn) )
                $classname_ .= '_' . get_class($cn);
        }
        $classname_ = ltrim($classname_, '_');
        $params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, $classname_);
        $params = apply_filters( 'dynamic_sidebar_params', $params );
        $callback = $wp_registered_widgets[$id]['callback'];
        do_action( 'dynamic_sidebar', $wp_registered_widgets[ $id ] );
        if ( is_callable($callback) ) {
            call_user_func_array($callback, $params);
            $did_one = true;
        }
    }
    do_action( 'dynamic_sidebar_after', $index, true );
    return apply_filters( 'dynamic_sidebar_has_widgets', $did_one, $index );


}

/**
 * We update through AJAX the order
 *
 * @return nothing
 * @since 2.0.0
 */
function woffice_dashboard_update_ajax() {

    // We just update the order in the database :
    if(isset($_POST['user_id']) && isset($_POST['order'])) {
        update_user_meta($_POST['user_id'], 'woffice_dashboard_order', serialize($_POST['order']));
    }
    // We close the connection
    wp_die();

}
add_action( 'wp_ajax_woffice_dashboard_update', 'woffice_dashboard_update_ajax' );
add_action( 'wp_ajax_nopriv_woffice_dashboard_update', 'woffice_dashboard_update_ajax' );

/**
 * We display the proper jquery lines according to the user's status (logged or not) and if that's allowed from the theme settings
 *
 * @return echo of the JS
 * @since 2.0.0
 */
function woffice_dashboard_scripts() {

    ?>
    <script type="text/javascript">
        (function($){
            <?php // Checking :
            $dashboard_drag_drop = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('dashboard_drag_drop') : '';
            if($dashboard_drag_drop == "yep" && is_user_logged_in() && is_page_template('page-templates/dashboard.php')) : ?>
                // Build :
                var $layout = $("#dashboard").packery({
                    // set itemSelector so .grid-sizer is not used in layout
                    itemSelector: '.widget',
                    layoutMode: 'masonry'
                });
                if(window.matchMedia('(min-width: 992px)').matches) {
                    $layout.find('.widget').each(function (i, itemElem) {

	                    $(this).append('<div class="widget-drag-button"><i class="fa fa-arrows"></i></div>');

                        var draggie = new Draggabilly(itemElem, {
                            containment: true
                        });
                        $layout.packery('bindDraggabillyEvents', draggie);
                        draggie.on('dragEnd', function () {
                            var order = [];
                            var itemElems = $layout.packery('getItemElements');
                            $(itemElems).each(function (i, itemElem) {
                                if ($(this).attr("id")) {
                                    order[i] = $(this).attr("id");
                                }
                            });
                            $.ajax({
                                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                data: {
                                    'order': order,
                                    'action': 'woffice_dashboard_update',
                                    'user_id': '<?php echo get_current_user_id(); ?>'
                                },
                                type: "POST",
                            });
                            PackeryRefreshLayoutJS();
                            return false;
                        });
                    });
                } else {
                    $('#dashboard').removeClass('is-draggie');
                }
                function PackeryRefreshLayoutJS(){
	                setTimeout(function(){
		                $layout.packery();
	                }, 1500);
                }
		        function PackeryRefreshLayoutWithoutIntervalJS(){
			        $layout.packery();
		        }
                $("#dashboard a.evcal_list_a,#dashboard .widget a,#dashboard p.evo_fc_day, #dashboard span.evcal_arrows").on('click', function($layout){
                    PackeryRefreshLayoutJS();
                });
                $("#nav-trigger, #nav-sidebar-trigger").on('click', function($layout){
                    PackeryRefreshLayoutJS();
                });
                $(document).ready(PackeryRefreshLayoutJS);
                $(window).on('resize',PackeryRefreshLayoutJS);
                // Refresh on every 5 seconds :
                setInterval(function(){
	                PackeryRefreshLayoutWithoutIntervalJS();
                }, 1500);
            <?php else : ?>
                var $dashboard = $('#dashboard').isotope({
                    // options
                    itemSelector: '.widget',
                    layoutMode: 'masonry'
                });
                setTimeout(function () {
                    $dashboard.isotope();
                }, 200);
            <?php endif; ?>
        }(jQuery));
    </script>
    <?php

}
add_action('wp_footer', 'woffice_dashboard_scripts', 99);

function woffice_dashboard_add_js() {
    $dashboard_drag_drop = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('dashboard_drag_drop') : '';
    if($dashboard_drag_drop == "yep" && is_user_logged_in() && is_page_template('page-templates/dashboard.php')) :
        wp_enqueue_script(
            'dashboard-js',
            get_template_directory_uri() . '/js/dashboard.min.js',
            array( 'jquery' ),
            '1.0',
            true
        );
    endif;
}
add_action( 'wp_enqueue_scripts', 'woffice_dashboard_add_js' );