<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
?>

<?php if( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>

<?php the_custom_logo() ?>

<?php elseif( yit_get_option( 'custom-logo' ) && yit_get_option( 'logo-url' ) != '' ) :
    $logo_id = yit_get_attachment_id( yit_get_option( 'logo-url' ) );
    $logo_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true );
?>
<a id="logo-img" href="<?php echo home_url() ?>" title="<?php bloginfo( 'name' ) ?>">
    <img src="<?php echo yit_ssl_url( yit_get_option( 'logo-url' ) ) ?>" title="<?php bloginfo( 'name' ) ?>" alt="<?php echo !empty( $logo_alt ) ? $logo_alt : get_bloginfo( 'name' ) ?>" />
</a>
<?php else : ?>
<a id="textual" href="<?php echo home_url() ?>" title="<?php echo str_replace( array( '[', ']' ), '', bloginfo( 'name' ) ) ?>">
    <?php echo yit_decode_title( get_bloginfo( 'name' ) ) ?>
</a>
<?php endif; ?>

<?php if( yit_get_option( 'logo-tagline' ) ): 
    $class = array();
    if ( strpos( get_bloginfo( 'description' ), '|') ) $class[] = 'multiline';
    if ( ! yit_get_option('responsive-show-logo-tagline') ) $class[] = 'hidden-phone';
    $class = ! empty( $class ) ? ' class="' . implode( $class, ' ' ) . '"' : '';
    ?>
	<?php yit_string( "<p id='tagline'{$class}>", yit_decode_title( get_bloginfo( 'description' ) ), '</p>' );?>
<?php endif ?>
