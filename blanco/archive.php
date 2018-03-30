<?php
$blog_layout = etheme_get_option('blog_layout');
$blog_sidebar = etheme_get_option('blog_sidebar');
get_header(); ?>
        <section id="main" class="columns2-<?php echo $blog_sidebar; ?> blog-<?php echo $blog_layout; ?>">
            <div class="content">
			<?php if ( have_posts() ) : ?>
				<h3 class="page-title">
					<?php if ( is_day() ) : ?>
						<?php printf( __( 'Daily Archives: %s', ETHEME_DOMAIN ), '<span>' . get_the_date() . '</span>' ); ?>
					<?php elseif ( is_month() ) : ?>
						<?php printf( __( 'Monthly Archives: %s', ETHEME_DOMAIN ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', ETHEME_DOMAIN ) ) . '</span>' ); ?>
					<?php elseif ( is_year() ) : ?>
						<?php printf( __( 'Yearly Archives: %s', ETHEME_DOMAIN ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', ETHEME_DOMAIN ) ) . '</span>' ); ?>
					<?php else : ?>
						<?php _e( 'Blog Archives', ETHEME_DOMAIN ); ?>
					<?php endif; ?>
				</h3>
				
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'loop', 'archive' );
				?>
				
			<?php else : ?>
                <h3 class="page-title"><?php _e( 'Nothing Found', ETHEME_DOMAIN ); ?></h3>
			<?php endif; ?>
			</div><!-- #content -->
            <aside id="sidebar">
                <?php get_sidebar(); ?>
            </aside>
            <div class="clear"></div>
		</section><!-- #container -->
<?php get_footer(); ?>