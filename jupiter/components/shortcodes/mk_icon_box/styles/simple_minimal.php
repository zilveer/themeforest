<?php

if ( $view_params['circled'] == 'true' ) {
    
    echo '<h4 class="icon-circled icon-box-title">';

        echo !empty( $view_params['read_more_url'] ) ? '<a href="'.$view_params['read_more_url'].'">' : '';
            echo '<i class="mk-main-ico circled-icon '.$view_params['icon_size'].' '.$view_params['backward_icon'].'">'.$view_params['icon'].'</i>';
        echo !empty( $view_params['read_more_url'] ) ? '</a>' : '';
    

        echo !empty( $view_params['read_more_url'] ) ? '<a href="'.$view_params['read_more_url'].'">' : '';
            echo '<span class="'.$view_params['icon_size'].'">'.$view_params['title'].'</span>';
        echo !empty( $view_params['read_more_url'] ) ? '</a>' : '';

    echo '<div class="clearboth"></div>';
    echo '</h4>';


}   else {

    echo '<h4 class="icon-box-title">';
    
        echo '<i class="mk-main-ico '.$view_params['icon_size'].' '.$view_params['backward_icon'].'">'.$view_params['icon'].'</i>';
       
        echo !empty( $view_params['read_more_url'] ) ? '<a href="'.$view_params['read_more_url'].'">' : '';
            echo '<span>'.$view_params['title'].'</span>';
        echo !empty( $view_params['read_more_url'] ) ? '</a>' : '';

    echo '<div class="clearboth"></div>';
    echo '</h4>';
}

echo wpb_js_remove_wpautop( $view_params['content'], true );

echo mk_get_shortcode_view('mk_icon_box', 'components/read-more', true, ["read_more_txt" => $view_params["read_more_txt"], "read_more_url" => $view_params["read_more_url"]]);

