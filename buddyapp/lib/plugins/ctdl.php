<?php

/* Buddypress Notifications in menu item */
add_filter('kleo_nav_menu_items', 'kleo_add_tasks_nav_item' );
function kleo_add_tasks_nav_item( $menu_items ) {
    $menu_items[] = array(
        'name' => esc_html__( 'Tasks', 'buddyapp' ),
        'slug' => 'tasks',
        'link' => '#',
    );

    return $menu_items;
}



add_filter( 'kleo_setup_nav_item_tasks' , 'kleo_setup_tasks_nav' );
function kleo_setup_tasks_nav( $menu_item ) {
    $menu_item->classes[] = 'has-submenu kleo-tasks';
    if ( ! is_user_logged_in() ) {
        $menu_item->_invalid = true;
    } else {
        add_filter( 'walker_nav_menu_start_el_tasks', 'kleo_menu_tasks', 10, 4 );
    }

    return $menu_item;
}


function kleo_menu_tasks() {
    $count = CTDL_Lib::get_todos( get_current_user_id(), 5000, 0)->post_count;
    ob_start();
    ?>
        <a href="#">
            <i class="icon-tasks-line"></i>
            <span><?php esc_html_e( 'Tasks','buddyapp' ); ?></span>
            <b class="bubble"><?php echo esc_html($count);?></b>
        </a>
        <em class="menu-arrow"></em>
        <ul class="submenu">
            <li>
                <?php
                if( $count == 0  )  {
                    echo '<span>';
                }
                echo do_shortcode('[todolist]');
                if( $count = 0  )  {
                    echo '</span>';
                }
                ?>
            </li>
            <?php if( $count > 0  ) :
                $page_link = "#";
                if ( $page = get_page_by_title( 'My Tasks' ) ) {
                    $page_link = get_permalink( $page->ID );
                }
                ?>
                <li class="footer-item">
                    <a class="btn btn-link" href="<?php echo esc_url( $page_link ); ?>">
                        <?php esc_html_e( "View all", "buddyapp" );?>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    <?php
get_permalink();
    return ob_get_clean();
}



add_filter('walker_nav_menu_start_el', 'kleo_ctdl_replace_placeholders');

function kleo_ctdl_replace_placeholders( $output ) {

    if ( strpos( $output, '##my_tasks##' ) !== false ) {

        if ( ! is_user_logged_in() ) {
            return '';
        }

        $count = CTDL_Lib::get_todos( get_current_user_id(), 5000, 0)->post_count;
        $output = str_replace('##my_tasks##', "<b class='bubble'>" . $count . "</b>", $output);

    }

    return $output;
}
