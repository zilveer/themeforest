<?php
/**
 * Template Name: Full Width Page
 */

get_header(); ?>

<div class="container container--main">

    <div class="grid">

        <?php 

        // let's get to know this post a little better

        // let's use what we know
        $the_content_width = 'one-whole';
        $featured_image_width = 'one-whole';
        ?>

       <?php
		if (has_post_thumbnail()):
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-big' );
			$image_ratio = bucket::get_image_aspect_ratio( $image );
		?>
		<div class="grid__item  float--left  <?php echo $featured_image_width; ?>  article__featured-image">
			<div class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
				<img src="<?php echo $image[0] ?>" alt="<?php echo $image[0] ?>" />
			</div>
		</div>
		<?php endif; ?>

        <div class="grid__item  main  float--left  <?php echo $the_content_width; ?>">

            <?php while (have_posts()): the_post(); ?>

                <h1 class="article__title  article__title--single"><?php the_title(); ?></h1>
                <?php
		        the_content();

	            $args = array(
		            'before' => "<ol class=\"nav pagination\"><!--",
		            'after' => "\n--></ol>",
		            'next_or_number' => 'next_and_number',
		            'previouspagelink' => __('Previous', 'bucket'),
		            'nextpagelink' => __('Next', 'bucket')
	            );
	            wp_link_pages( $args ); ?>

                <hr class="separator  separator--section">
				
                <?php
                // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                ?>
                
            <?php endwhile; ?>

        </div>    

    </div>

</div>
    
<?php get_footer(); ?>