<?php
/**
 * The template for displaying image attachments.
 *
 * @package berg-wp
 *
 */
 
get_header();
?>
 <div id="attachment">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<div class="post-title container">
                <h1 class="entry-title"><?php the_title(); ?></h1>

                <div class="entry-meta">
                    <?php
                        $metadata = wp_get_attachment_metadata();
                        echo __('Published', 'BERG');
                        echo ' <span class="entry-date"><time class="entry-date" datetime="'. esc_attr( get_the_date( 'c' )) .'" pubdate>'. esc_html( get_the_date() ) .'</time></span> ';
                        echo __('at', 'BERG') .' '. sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>', wp_get_attachment_url(), esc_attr( __( 'Link to full-size image', 'BERG')), $metadata['width'], $metadata['height']).' in <a href="'.get_permalink( $post->post_parent ).'" title="'.__('Return to', 'BERG').' %7$s" rel="gallery">'.get_the_title( $post->post_parent ).'</a>';
                    ?>
                    <?php edit_post_link( __( 'Edit', 'BERG'), '<span class="sep"> | </span> <span class="edit-link">', '</span>' ); ?>
                </div><!-- .entry-meta -->

                <nav id="image-navigation" class="site-navigation">
                    <span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'BERG') ); ?></span>
                    <span class="next-image"><?php next_image_link( false, __( 'Next &rarr;', 'BERG') ); ?></span>
                </nav><!-- #image-navigation -->
            </div>
            </header><!-- .entry-header -->
            <div class="entry-content">
                <div class="entry-attachment">
                    <div class="attachment">
                        <?php
                            /**
                             * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
                             * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
                             */
                            $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );

                            foreach ( $attachments as $k => $attachment ) {
                                if ( $attachment->ID == $post->ID )
                                    break;
                            }

                            $k++;
                            // If there is more than 1 attachment in a gallery
                            if ( count( $attachments ) > 1 ) {
                                if ( isset( $attachments[ $k ] ) )
                                    // get the URL of the next image attachment
                                    $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
                                else
                                    // or get the URL of the first image attachment
                                    $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
                            } else {
                                // or, if there's only 1 image, get the URL of the image
                                $next_attachment_url = wp_get_attachment_url();
                            }
                        ?>

                        <a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
                            $attachment_size = 'original';
                            echo wp_get_attachment_image( $post->ID, $attachment_size );
                        ?></a>
                    </div><!-- .attachment -->

                    <?php if ( ! empty( $post->post_excerpt ) ) : ?>
                    <div class="entry-caption">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-caption -->
                    <?php endif; ?>
                </div><!-- .entry-attachment -->
 
                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'BERG'), 'after' => '</div>' ) ); ?>
 
            </div><!-- .entry-content -->
		</article>
	<?php endwhile; // end of the loop. ?>
</div>


<?php
    berg_getFooter();
    get_template_part('footer'); 
?>