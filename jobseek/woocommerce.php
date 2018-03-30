<?php get_header();

$page_title = get_post_meta( get_the_ID(), '_jobseek_page_title_show', true );

if( $page_title != 'hide' ) {

	$page_subtitle = get_post_meta( get_the_ID(), '_jobseek_page_title_subtitle', true ); ?>

	<section id="title">
		<div class="container">
			<h1><?php the_title(); ?></h1>
			<?php if( !empty( $page_subtitle ) ) { ?><h4><?php echo esc_attr($page_subtitle); ?></h4><?php } ?>
		</div>
	</section>

<?php } ?> 

<section id="content"<?php if( $page_title != 'show' ) { ?> class="no-title"<?php } ?>>
	<div class="container">

		<?php if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				the_content();

			endwhile; 

		else :

			get_template_part( 'content', 'none' );

		endif; ?>

	</div>
</section>

<?php get_footer(); ?>