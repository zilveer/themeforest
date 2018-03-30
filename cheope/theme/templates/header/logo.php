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

$logo_url = yit_get_option( 'logo-url' );
if ( is_ssl() ) $logo_url = str_replace( 'http://', 'https://', $logo_url );

if( function_exists( 'has_custom_logo' ) && has_custom_logo() ) :

the_custom_logo();

elseif( yit_get_option( 'custom-logo' ) && $logo_url != '' ) : ?>
<a id="logo-img" href="<?php echo home_url() ?>" title="<?php bloginfo( 'name' ) ?>">
    <img src="<?php echo $logo_url ?>" title="<?php bloginfo( 'name' ) ?>" alt="<?php bloginfo( 'name' ) ?>" />
</a>
<?php else : ?>
<a id="textual" href="<?php echo home_url() ?>" title="<?php echo str_replace( array( '[', ']' ), '', bloginfo( 'name' ) ) ?>">
    <?php echo str_replace( array( '[', ']' ), array( '<span>', '</span>' ), get_bloginfo( 'name' ) ) ?>
</a>
<?php endif; ?>

<?php if( yit_get_option( 'logo-tagline' ) ) { yit_string( '<p id="tagline">', str_replace( array( '[', ']' ), array( '<span>', '</span>' ), get_bloginfo( 'description' ) ), '</p>' ); } ?>