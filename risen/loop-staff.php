<?php
/**
 * Staff Loop
 *
 * This outputs staff members for the staff page template
 */

global $staff_query;

// if no query given, use default
$staff_query = isset( $staff_query ) ? $staff_query : $wp_query;

?>

<?php if ( $staff_query->have_posts() ) : ?>

	<div id="staff-posts">

		<?php while ( $staff_query->have_posts() ) : $staff_query->the_post(); ?>

		<article id="<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'staff' ); ?>>
			
			<?php if ( has_post_thumbnail() ) : ?>
			<div class="image-frame staff-image">
				<?php the_post_thumbnail( 'risen-square-thumb', array( 'title' => '' ) ); ?>
			</div>
			<?php endif; ?>
			
			<div class="staff-content">
			
				<header>
						
					<h1><?php the_title(); ?></h1>
					
					<?php
					$position = get_post_meta( $post->ID, '_risen_staff_position', true );
					if ( $position ) :
					?>
					<div class="staff-position"><?php echo $position; ?></div>
					<?php endif; ?>
					
					<?php
					$contact = get_post_meta( $post->ID, '_risen_staff_contact', true );
					$contact_page_id = get_post_meta( $post->ID, '_risen_staff_contact_page', true );
					$contact_page_url = get_permalink( $contact_page_id );
					if ( $contact && $contact_page_id && $contact_page_url ) :
					?>
					<span class="staff-email-button"><a href="<?php echo esc_url( $contact_page_url ); ?>?contact=<?php echo $contact; ?>" class="button button-small"><?php printf( _x( 'E-mail %s', 'staff', 'risen' ),  get_the_title()); ?></a></span>
					<?php endif; ?>
					
				</header>
				
				<div class="post-content">
					<?php the_content(); ?>
				</div>
					
			</div>	

			<div class="clear"></div>		

		</article>

		<?php endwhile; ?>

	</div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>
