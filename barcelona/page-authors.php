<?php
/*
 * Template Name: Authors
 */

get_header();

$barcelona_authors = get_users( array(
	'fields' => 'ID',
	'who'    => 'authors',
	'order'  => 'DESC',
	'orderby'=> 'post_count'
) );

?>
	<div class="container">

		<div class="<?php echo esc_attr( barcelona_row_class() ); ?>">

			<main id="main" class="<?php esc_attr( barcelona_main_class() ); ?>">

				<div class="box-header has-title">
					<h3 class="title"><?php echo esc_html( get_the_title() ); ?></h3>
				</div>

				<?php
				foreach ( $barcelona_authors as $barcelona_author_id ) {
					barcelona_author_box( $barcelona_author_id, false );
				}
				?>

				<?php
				if ( have_posts() ):
					while ( have_posts() ): the_post();
						$barcelona_post_content = get_the_content();
						if ( ! barcelona_is_empty( $barcelona_post_content ) ) {
							echo '<div class="post-content">'. apply_filters( 'the_content', $barcelona_post_content ) .'</div>';
						}
					endwhile;
				endif;
				?>

			</main>

			<?php get_sidebar(); ?>

		</div>

	</div>
<?php

get_footer();