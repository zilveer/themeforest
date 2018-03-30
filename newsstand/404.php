<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package News Stand
 */

get_header(); ?>

	<section class="fof-page">
        <div class="container">
            <div class="fof-block" style="background-image: url(<?php echo esc_url($newsstand['newsstand_fofbg']['url']); ?>);">
                <div class="message">
                    <span class="title">404 Error</span>
                    <a href="javascript:history.back();"><?php echo _e( 'Go Back', 'newsstand' ); ?></a>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
