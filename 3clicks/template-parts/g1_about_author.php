<?php
/**
 * The Template Part for displaying "About Author" box.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme03
 * @since G1_Theme03 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php if ( post_type_supports( get_post_type(), 'author' ) && get_the_author_meta( 'description' )  ): ?>
<section itemscope itemtype="http://schema.org/Person" class="author-info">
	<header class="author-title g1-hgroup">
        <h6 class="g1-regular"><?php echo __( 'About the Author', 'g1_theme' ); ?></h6>
        <h3 class="g1-important">
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                <span itemprop="name"><?php echo get_the_author(); ?></span>
            </a>
        </h3>
	</header>
    <figure class="author-avatar">
        <?php echo get_avatar( get_the_author_meta('email'), 60 ); ?>
    </figure>
    <p itemprop="description" class="author-description">
        <?php the_author_meta( 'description' ) ?>
    </p>
</section>
<?php endif; ?>