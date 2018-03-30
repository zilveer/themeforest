<?php get_header(); ?>

		<!-- container -->
		<div class="container">
		<div class="boxed">
<?php
while ( have_posts() ) : the_post();
?>
		<?php
			if(is_page_title_uppercase() == true){
				echo '<div class="page-title uppercase">';
			} else {
				echo '<div class="page-title">';
			};
		?>
			<span class="heading-t"></span>
				<?php the_title('<h1>','</h1>'); ?>
			<?php
				iron_page_title_divider();
			?>
		</div>
			
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
		list( $has_sidebar, $sidebar_position, $sidebar_area ) = setup_dynamic_sidebar( $post->ID );

		if ( $has_sidebar ) :
?>
			<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $sidebar_position ) echo ' content--rev'; ?>">
				<div id="content" class="content__main">
<?php
		endif;
?>


				<?php the_content(); ?>
				
				<?php get_template_part('parts/gallery'); ?>

			
<?php
		if ( $has_sidebar ) :
?>
				</div>

				<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $sidebar_area ); ?>">
<?php
	do_action('before_ironband_sidebar_dynamic_sidebar', 'single-photo-album.php');

	dynamic_sidebar( $sidebar_area );

	do_action('after_ironband_sidebar_dynamic_sidebar', 'single-photo-album.php');
?>
				</aside>
			</div>
<?php
		endif;
?>
	
<?php
endwhile;
?>
		</div>
		</div>
		</div>
		
<?php get_footer(); ?>