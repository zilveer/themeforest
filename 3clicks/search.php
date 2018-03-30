<?php
/**
 * The Template for displaying Search Results pages.
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
<?php get_header(); ?>

    <div id="primary">
        <div id="content" role="main">

        <header class="page-header">
            <div class="g1-hgroup">
                <h1 class="page-title"><?php printf( __( 'Phrase: %s', 'g1_theme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                <h3 class="page-subtitle"><?php echo __( 'Search Results', 'g1_theme' ); ?></h3>
            </div>

        </header>
						
		<?php if ( have_posts() ) : ?>
			<ul class="search-results">								
			<?php while( have_posts() ): the_post(); ?>
				<li>
					<p class="meta search-meta">
						<?php 
							$obj = get_post_type_object(get_post_type()); 
							echo $obj->labels->singular_name;
						?>
					</p>
					<h3 class="search-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr(__('Permalink to %s', 'g1_theme') ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					<div class="search-summary">
						<?php the_excerpt(); ?>
					</div>
				</li>
			<?php endwhile; ?>
			</ul>
			<?php
                $g1_pagination = G1_Pagination();
                $g1_pagination->render();
            ?>
		<?php else: ?>
			<?php get_template_part( 'template-parts/g1_no_results', 'search' ); ?>
		<?php endif; ?>

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_footer(); ?>