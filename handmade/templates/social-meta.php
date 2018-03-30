<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/1/2015
 * Time: 2:08 PM
 */
global $post, $g5plus_options;
$enable_social_meta = false;
if (isset($g5plus_options['enable_social_meta'])) {
	$enable_social_meta = $g5plus_options['enable_social_meta'];
}

if (!$post || ! is_singular() || class_exists('WPSEO_Admin') || !$enable_social_meta) {
	return;
}
$title             = strip_tags( get_the_title() );
$permalink         = get_permalink();
$site_name         = get_bloginfo( 'name' );
$excerpt           = get_the_excerpt();
$content           = get_the_content();
$twitter_author    = $g5plus_options['twitter_author_username'];
$googleplus_author = $g5plus_options['googleplus_author'];

if ( $excerpt != "" ) {
	$excerpt = strip_tags( trim( preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $content ) ) );
	if ( function_exists( 'mb_strimwidth' ) ) {
		$excerpt = mb_strimwidth( $excerpt, 0, 100, '...' );
	}
}

$logo = array();
if ( isset( $g5plus_options['logo'] ) ) {
	$logo = $g5plus_options['logo'];
}

$image_url = "";
if ( has_post_thumbnail( $post->ID ) ) {
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
	$image_url = esc_attr( $thumbnail[0] );
} else if ( isset( $logo['url'] ) && $logo['url'] != "" ) {
	$image_url = $logo['url'];
}
?>
<!-- Facebook Meta -->
<meta property="og:title" content="<?php echo esc_attr($title); ?> - <?php echo esc_attr($site_name); ?>"/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="<?php echo esc_url($permalink); ?>"/>
<meta property="og:site_name" content="<?php echo esc_attr($site_name); ?>"/>
<meta property="og:description" content="<?php echo esc_attr($excerpt);?>">
<?php if (!empty($image_url)) : ?>
	<meta property="og:image" content="<?php echo esc_url($image_url); ?>"/>
<?php endif; ?>

<?php if ( function_exists( 'is_product' ) && is_product() ) : ?>
	<?php $product = new WC_Product( $post->ID ); ?>
	<meta property="og:price:amount" content="<?php echo esc_attr($product->price);?>" />
	<meta property="og:price:currency" content="<?php echo esc_attr(get_woocommerce_currency()); ?>" />
<?php endif; ?>

<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo esc_attr($title); ?>">
<meta name="twitter:description" content="<?php echo esc_attr($excerpt); ?>">
<?php if(!empty($twitter_author)) : ?>
	<meta name="twitter:site" content="@<?php echo esc_attr($twitter_author); ?>">
	<meta name="twitter:creator" content="@<?php echo esc_attr($twitter_author); ?>">
<?php endif; ?>

<?php if (!empty($image_url)) : ?>
	<meta property="twitter:image:src" content="<?php echo esc_url($image_url); ?>"/>
<?php endif; ?>

<?php if ( function_exists( 'is_product' ) && is_product() ) : ?>
	<?php $product = new WC_Product( $post->ID ); ?>
	<meta name="twitter:data1" content="<?php echo esc_attr($product->price); ?>">
	<meta name="twitter:label1" content="Price">
<?php endif; ?>

<!-- Google Authorship and Publisher Markup -->
<?php if (!empty($googleplus_author)) : ?>
	<link rel="author" href="https://plus.google.com/<?php echo esc_attr($googleplus_author); ?>/posts"/>
	<link rel="publisher" href="https://plus.google.com/<?php echo esc_attr($googleplus_author); ?>"/>
<?php endif; ?>
