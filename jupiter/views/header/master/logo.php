<?php

/**
 * template part for header logo. views/header/master
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */

global $mk_options;

if(isset($mk_options['hide_header_logo']) && $mk_options['hide_header_logo'] == 'false') return false;

$logo = $mk_options['logo'];
$mobile_logo = $mk_options['responsive_logo'];
$light_logo = isset($mk_options['light_header_logo']) ? $mk_options['light_header_logo'] : '';
$sticky_logo = $mk_options['sticky_header_logo'];
$is_nav_item = isset($view_params['is_nav_item']) ? $view_params['is_nav_item'] : false;


$post_id = global_get_post_id();

if ($post_id) {
    
    global $post;

    $enable = get_post_meta($post_id, '_enable_local_backgrounds', true);
    
    if ($enable == 'true') {
        $logo_meta = get_post_meta($post_id, 'logo', true);
        $sticky_logo_meta = get_post_meta($post_id, 'sticky_header_logo', true);
        $light_logo_meta = get_post_meta($post_id, 'light_logo', true);
        $logo_mobile_meta = get_post_meta($post_id, 'responsive_logo', true);
        $logo = (isset($logo_meta) && !empty($logo_meta)) ? $logo_meta : $logo;
        $mobile_logo = (isset($logo_mobile_meta) && !empty($logo_mobile_meta)) ? $logo_mobile_meta : $mobile_logo;
        $sticky_logo = (isset($sticky_logo_meta) && !empty($sticky_logo_meta)) ? $sticky_logo_meta : $sticky_logo;
        $light_logo = (isset($light_logo_meta) && !empty($light_logo_meta)) ? $light_logo_meta : $light_logo;
    }
}

$tag = $is_nav_item ? 'li' : 'div';

$class[] = $is_nav_item ? 'nav-middle-logo menu-item' : 'header-logo';
$class[] = 'fit-logo-img';
$class[] = 'add-header-height';
$class[] = !empty($mobile_logo) ? 'logo-is-responsive' : '';
$class[] = !empty($sticky_logo) ? 'logo-has-sticky' : '';

if (!empty($logo) || !empty($sticky_logo)) {

    ?>
        <<?php echo $tag; ?> class=" <?php echo esc_attr( implode(' ', $class) ); ?>">

	    <a href="<?php echo home_url('/'); ?>" title="<?php esc_attr( bloginfo('name') ); ?>">
	    
			             <img class="mk-desktop-logo dark-logo" title="<?php esc_attr( bloginfo('description') ); ?>" alt="<?php esc_attr( bloginfo('description') ); ?>" src="<?php echo esc_url( $logo ); ?>" />
			    
			    <?php if ($light_logo) { ?>
			             <img class="mk-desktop-logo light-logo" title="<?php esc_attr( bloginfo('description') ); ?>" alt="<?php esc_attr( bloginfo('description') ); ?>" src="<?php echo esc_url( $light_logo ); ?>" />
			    <?php } ?>
			    
			    <?php if ($mobile_logo && !$is_nav_item) { ?>
			             <img class="mk-resposnive-logo" title="<?php esc_attr( bloginfo('description') ); ?>" alt="<?php esc_attr( bloginfo('description') ); ?>" src="<?php echo esc_url( $mobile_logo ); ?>" />
			    <?php } ?>
			    
			    <?php if ($sticky_logo) { ?>
			             <img class="mk-sticky-logo" title="<?php esc_attr( bloginfo('description') ); ?>" alt="<?php esc_attr( bloginfo('description') ); ?>" src="<?php echo esc_url( $sticky_logo ); ?>" />
			    <?php } ?>
	    </a>
    </<?php echo $tag; ?>>
<?php } else { ?>

    <<?php echo $tag; ?> class="<?php echo esc_attr( implode(' ', $class) ); ?>">
    	<a href="<?php echo home_url('/'); ?>" title="<?php esc_attr( get_bloginfo('name') ); ?>">
            <img title="<?php esc_attr( bloginfo('description') ); ?>" alt="<?php esc_attr( bloginfo('description') ); ?>" src="<?php echo THEME_IMAGES; ?>/jupiter-logo.png" />
        </a>
    </<?php echo $tag; ?>>

<?php }
