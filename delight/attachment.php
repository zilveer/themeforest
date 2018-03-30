<?php
/**
 * @package WordPress
 * @subpackage Delight
 */

get_header(); ?>


<section>

<?php
	$class = 'open_toggle';
	$width = 'seveneighty';
	$size_th = 'wideCol';
?>
	<article class="<?php echo $class.' '.$width; ?>">
    	<div><div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            
            <?php if ( wp_attachment_is_image() ) { ?>
					<p><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'large' ); ?></a></p>
			<?php } else { ?>
					<p><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php the_title(); ?></a></p>
			<?php } ?>

                        
		<?php the_content(); ?>
        <?php edit_post_link( __( 'Edit','delight' ), '<span class="edit-link">', '</span>' ); ?>
            


		<?php comments_template( '', true ); ?>


<?php endwhile; ?>
        </div></div>
    </article>


</section>
<?php get_footer(); ?>
