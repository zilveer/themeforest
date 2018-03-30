<?php
/**
 * @package by Theme Record
 * @auther: MattMao
 *
 *1--Add reorder page
 *2--Save portfolio order
 *3--Add the scripts for reorder
 *4--Add the styles for reorder
*/



#
#Reorder the portfolio items
#
function theme_create_reorder_page() {
    $add_portfolio_reorder_page = add_submenu_page('edit.php?post_type=portfolio', 'Reorder', __('Reorder',  'TR'), 'edit_posts', basename(__FILE__), 'theme_portfolio_reorder');
    
    add_action('admin_print_styles-' . $add_portfolio_reorder_page, 'theme_print_reorder_styles');
    add_action('admin_print_scripts-' . $add_portfolio_reorder_page, 'theme_print_reorder_scripts');
}

add_action('admin_menu', 'theme_create_reorder_page');


#
#Add the scripts for reorder
#
function theme_print_reorder_scripts() {
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('theme_portfolio_reorder', FUNCTIONS_URI.'/assets/js/jquery-reorder.js');
}


#
#Add the styles for reorder
#
function theme_print_reorder_styles() {
    wp_enqueue_style('nav-menu');
}


#
#Add the reorder functions
#
function theme_portfolio_reorder() {
    $portfolios = new WP_Query('post_type=portfolio&posts_per_page=-1&orderby=menu_order&order=ASC');
?>
    <div class="wrap">
        <div id="icon-tools" class="icon32"><br /></div>
        <h2><?php _e('Reorder Portfolios',  'TR'); ?></h2>
        <p><?php _e('Drag the items to reorder the portfolios.',  'TR'); ?></p>
        <ul id="portfolio-lists">
		<?php while( $portfolios->have_posts() ) : $portfolios->the_post(); ?>
		<?php if( get_post_status() == 'publish' ) { ?>
			<li id="<?php the_id(); ?>" class="menu-item">
				<dl class="menu-item-bar">
				<dt class="menu-item-handle">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail('admin-thumbnail'); } else { echo __('No featured image',  'TR'); } ?>
				<span class="menu-item-title"><?php the_title(); ?></span>
				</dt>
				</dl>
				<ul class="menu-item-transport"></ul>
			</li>
		<?php } ?>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
        </ul>
    </div>
<?php
}


#
#Save portfolio order
#
function theme_save_portfolio_order() {
    global $wpdb;
    
    $order = explode(',', $_POST['order']);
    $counter = 0;
    
    foreach($order as $portfolio_id) {
        $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $portfolio_id));
        $counter++;
    }
    die(1);
}

add_action('wp_ajax_portfolio_reorder', 'theme_save_portfolio_order');


?>