<?php get_header(); ?>
<?php
$crazyblog_meta = get_post_meta( get_the_ID(), 'crazyblog_page_meta', true );
$sidebar = (crazyblog_set( $crazyblog_meta, 'sidebar' )) ? crazyblog_set( $crazyblog_meta, 'sidebar' ) : 'primary-widget-area';
$layout = (crazyblog_set( $crazyblog_meta, 'layout' )) ? crazyblog_set( $crazyblog_meta, 'layout' ) : '';
$show_banner = crazyblog_set( $crazyblog_meta, 'page_title_section' );
$bg = (crazyblog_set( $crazyblog_meta, 'title_section_bg' )) ? 'background:url(' . crazyblog_set( $crazyblog_meta, 'title_section_bg' ) . ')' : "";
?>

<?php if ( $show_banner ) : ?>
	<div class="pagetop" style="<?php echo esc_attr( $bg ); ?>">
		<div class="page-name">
			<div class="container">
				<span><?php echo esc_html( get_the_title() ); ?></span>
				<?php echo crazyblog_get_breadcrumbs(); ?>
			</div>
		</div>
	</div><!-- Page Top -->
<?php endif; ?>

<section>
	<div class="block">
		<div class="container">
            <div class="row">
				<?php if ( $sidebar && $layout == 'left' && is_active_sidebar( $sidebar ) ): ?>
					<aside class="col-md-4 column right-sidebar sidebar">
						<?php dynamic_sidebar( $sidebar ); ?>
					</aside>
				<?php endif; ?>
                <div class="<?php echo esc_js( ($layout == 'full' || $layout == '') ? 'col-md-12' : 'col-md-8'  ); ?> column">
					<?php
					while ( have_posts() ): the_post();
						echo '<div class="page-content">';
						the_content();
						echo '</div>';
					endwhile;
					wp_reset_postdata();
					?> 
					<?php comments_template(); ?>
                </div>
				<?php if ( $sidebar && $layout == 'right' && is_active_sidebar( $sidebar ) ): ?>
					<aside class="col-md-4 left-sidebar column sidebar">
						<?php dynamic_sidebar( $sidebar ); ?>
					</aside>
				<?php endif; ?>
            </div>
		</div>
	</div>
</section>

<?php get_footer(); ?>