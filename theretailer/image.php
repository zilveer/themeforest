<?php
/**
 * The template for displaying image attachments.
 *
 * @package theretailer
 * @since theretailer 1.0
 */

get_header();
?>

<div class="container_12">

    <div id="primary" class="content-area image-attachment">
        <div id="content" class="site-content" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    
                    <div class="grid_12">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </div>
                    
                    <div class="grid_8 push_2">
                        <div class="entry-meta">
                            <?php
                                $metadata = wp_get_attachment_metadata();
                                printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at&nbsp;<a href="%3$s" title="Link to full-size image"> <i class="fa fa-picture-o"></i>&nbsp; %4$s &times; %5$s</a> in &nbsp;<a href="%6$s" title="Return to %7$s" rel="gallery"><i class="fa fa-folder-open"></i>&nbsp; %7$s</a>', 'theretailer' ),
                                    esc_attr( get_the_date( 'c' ) ),
                                    esc_html( get_the_date() ),
                                    wp_get_attachment_url(),
                                    $metadata['width'],
                                    $metadata['height'],
                                    get_permalink( $post->post_parent ),
                                    get_the_title( $post->post_parent )
                                );
                            ?>
                            <?php //edit_post_link( __( 'Edit', 'theretailer' ), '<span class="sep"> | </span> <span class="edit-link">', '</span>' ); ?>
                        </div><!-- .entry-meta -->
                    </div>

                    <div class="grid_2 pull_8">
                        <span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'theretailer' ) ); ?>&nbsp;</span>
                    </div>
                    
                    <div class="grid_2 gbtr_next_image">
                        <span class="next-image">&nbsp;<?php next_image_link( false, __( 'Next &rarr;', 'theretailer' ) ); ?></span>
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
                                $attachments = array_values( get_children( array(
                                    'post_parent'    => $post->post_parent,
                                    'post_status'    => 'inherit',
                                    'post_type'      => 'attachment',
                                    'post_mime_type' => 'image',
                                    'order'          => 'ASC',
                                    'orderby'        => 'menu_order ID'
                                ) ) );
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

                            <a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
                                $attachment_size = apply_filters( 'theretailer_attachment_size', array( 940, 940 ) );
                                echo wp_get_attachment_image( $post->ID, $attachment_size );
                            ?></a>
                        </div><!-- .attachment -->

                    </div><!-- .entry-attachment -->

                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->

        <?php endwhile; // end of the loop. ?>

        </div><!-- #content .site-content -->
    </div><!-- #primary .content-area .image-attachment -->
  
</div>

<?php get_template_part("light_footer"); ?>
<?php get_template_part("dark_footer"); ?>

<?php get_footer(); ?>