<?php
/**
 * Theme install
 * @package by Theme Record
 * @auther: MattMao
 *
*/


add_action( 'after_setup_theme', 'the_theme_setup' );

function the_theme_setup()
{
	// First we check the status
	$the_theme_status = get_option( 'theme_setup_status' );

	if ( $the_theme_status !== '1' ) {

		theme_create_pages();

		//Page ids
		$front_page_id = get_option( 'TR_theme_home_page_id' );
		$post_page_id = get_option( 'TR_theme_blog_page_id' );
		$portfolio_page_id = get_option( 'TR_theme_portfolio_page_id' );
		$shop_page_id = get_option( 'TR_theme_shop_page_id' );
		$shopping_cart_page_id = get_option( 'TR_theme_cart_page_id' );
		$shopping_thank_you_page_id = get_option( 'TR_theme_thank_you_page_id' );
		$gallery_page_id = get_option( 'TR_theme_gallery_page_id' );
		$contact_page_id = get_option( 'TR_theme_contact_page_id' );

		// Setup Default WordPress settings
		$core_settings = array(
			'show_on_front' => 'page',
			'page_on_front'	=> $front_page_id,
			'page_for_posts' => $post_page_id,			
			'posts_per_page' => -1
		);

		foreach ( $core_settings as $k => $v ) {
			update_option( $k, $v );
		}

		//Setup meta of page templates
		update_post_meta($front_page_id, '_wp_page_template', 'template-home.php');
		update_post_meta($portfolio_page_id, '_wp_page_template', 'template-portfolio.php');
		update_post_meta($shop_page_id, '_wp_page_template', 'template-shop.php');
		update_post_meta($gallery_page_id, '_wp_page_template', 'template-gallery.php');
		update_post_meta($contact_page_id, '_wp_page_template', 'template-contact.php');
		update_post_meta($shopping_cart_page_id, '_wp_page_template', 'template-fullwidth.php'); 
		update_post_meta($shopping_thank_you_page_id, '_wp_page_template', 'template-fullwidth.php'); 

		// Delete dummy post, page and comment.
		//wp_delete_post( 1, true );
		//wp_delete_post( 2, true );
		//wp_delete_comment( 1 );
		// Once done, we register our setting to make sure we don't duplicate everytime we activate.
		update_option( 'theme_setup_status', '1' );

		// Lets let the admin know whats going on.
		$msg = '<div class="error">';
		$msg .= '<p>The ' . get_option( 'current_theme' ) . ' theme has been ready for you!</p>';
		$msg .= '</div>';
		add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
	}
	elseif ( $the_theme_status === '1' and isset( $_GET['activated'] ) ) {

		//if we are re-activing the theme
		$msg = '<div class="error">';
		$msg .= '<p>The ' . get_option( 'current_theme' ) . ' theme was successfully re-activated.</p>';
		$msg .= '</div>';
		add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
	}
}



#
# Create pages
#
function theme_create_pages() 
{
	// home page
    theme_create_page( 
		esc_sql( _x('home', 'page_slug', 'TR') ), 
		'TR_theme_home_page_id', 
		__('Home', 'TR'), 
'[slogan]Rover is A perfect for business & eCommerce theme for the creative agency, freelancer or general business. Has a lot of modules, it’s simple-to-use, customize and install.[/slogan]

[br top="50"]

[column col="1/3"]
[icon_box title="Unlimited colors" icon="test_tube.png" link="http://google.com" show_button="yes" button_text="Purchase"] It happened that the eldest wanted to go into the forest to hew wood, and before he went his mother gave him a beautiful sweet cake. [/icon_box]
[/column]

[column col="1/3"]
[icon_box title="Responsive theme" icon="sport.png" link="http://google.com" show_button="yes" button_text="Read More"] It happened that the eldest wanted to go into the forest to hew wood, and before he went his mother gave him a beautiful sweet cake. [/icon_box]
[/column]

[column col="1/3" last="yes"]
[icon_box title="Background change" icon="leaf.png" link="http://google.com" show_button="yes" button_text="Buy Now"] It happened that the eldest wanted to go into the forest to hew wood, and before he went his mother gave him a beautiful sweet cake. [/icon_box]
[/column]

[br top="50"]

[portfolio_slide title="Recent Projects" posts_per_page="8"]

[br top="50"]

[product_slide title="Recent Products" posts_per_page="8"]

[br top="50"]

[blog_slide title="Recent News" posts_per_page="8"]' 
	);

	// portfolio page
    theme_create_page( esc_sql( _x('portfolio', 'page_slug', 'TR') ), 'TR_theme_portfolio_page_id', __('Portfolio', 'TR'), '' );

	// shop page
    theme_create_page( esc_sql( _x('shop', 'page_slug', 'TR') ), 'TR_theme_shop_page_id', __('Shop', 'TR'), '' );

	// cart page
    theme_create_page( esc_sql( _x('cart', 'page_slug', 'TR') ), 'TR_theme_cart_page_id', __('Cart', 'TR'), '[shopping_cart]', get_option('TR_theme_shop_page_id') );

	// thank you page
    theme_create_page( esc_sql( _x('thank-you', 'page_slug', 'TR') ), 'TR_theme_thank_you_page_id', __('Thank you', 'TR'), '[shopping_thank_you]', get_option('TR_theme_shop_page_id') );

	// gallery page
    theme_create_page( esc_sql( _x('gallery', 'page_slug', 'TR') ), 'TR_theme_gallery_page_id', __('Gallery', 'TR'), '' );

	// blog page
    theme_create_page( esc_sql( _x('blog', 'page_slug', 'TR') ), 'TR_theme_blog_page_id', __('Blog', 'TR'), '' );

	// contact page
    theme_create_page( esc_sql( _x('contact', 'page_slug', 'TR') ), 'TR_theme_contact_page_id', __('Contact', 'TR'), '' );
}




#
# Create a page
#
function theme_create_page( $slug, $option, $page_title = '', $page_content = '', $post_parent = 0 ) 
{
	global $wpdb;
	 
	$option_value = get_option($option); 
	 
	if ($option_value>0) :
		if (get_post( $option_value )) :
			// Page exists
			return;
		endif;
	endif;
	
	$page_found = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = '$slug' LIMIT 1;");
	if ($page_found) :
		// Page exists
		if (!$option_value)  update_option($option, $page_found);
		return;
	endif;
	
	$page_data = array(
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_author' => 1,
        'post_name' => $slug,
        'post_title' => $page_title,
        'post_content' => $page_content,
        'post_parent' => $post_parent,
        'comment_status' => 'closed'
    );
    $page_id = wp_insert_post($page_data);
    
    update_option($option, $page_id);
}



#
#Add order status
#
add_action('admin_init', 'theme_add_order_status');

function theme_add_order_status() 
{
	global $pagenow;
	if( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
	{     
		$order_status = array(
			'pending',
			'on-hold',
			'processing',
			'completed'
		);

		foreach($order_status as $status) 
		{
			if (!get_term_by( 'slug', sanitize_title($status), 'shop_order_status')) {
				wp_insert_term($status, 'shop_order_status');
			}
		}
	}
}

?>