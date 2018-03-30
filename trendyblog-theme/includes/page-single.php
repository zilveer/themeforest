<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();


?>

	<?php get_template_part(THEME_LOOP."loop-start"); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <!-- Post -->
            <article <?php post_class('post'); ?>>
				<?php get_template_part(THEME_SINGLE."image");?>
				<div class="shortcode-content">
                    <!-- Entry content -->
                    <div class="entry_content">
						<?php get_template_part(THEME_SINGLE."page-title"); ?>
							<?php wp_reset_query();?>		
							<?php the_content();?>	
							<?php 
								$args = array(
									'before'           => '<div class="post-pages"><p>' . esc_html__('Pages:', THEME_NAME),
									'after'            => '</p></div>',
									'link_before'      => '',
									'link_after'       => '',
									'next_or_number'   => 'number',
									'nextpagelink'     => esc_html__('Next page', THEME_NAME),
									'previouspagelink' => esc_html__('Previous page', THEME_NAME),
									'pagelink'         => '%',
									'echo'             => 1
								);

								wp_link_pages($args); 
							?>
					</div>
					<!-- End Entry content -->

			 </article>
			<?php endwhile; else: ?>
				<p><?php  esc_html_e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
			<?php endif; ?>
			<?php wp_reset_query(); ?>
			<?php if ( comments_open() ) : ?>
				<?php comments_template(); // Get comments.php template ?>
			<?php endif; ?>
	<?php get_template_part(THEME_LOOP."loop-end"); ?>