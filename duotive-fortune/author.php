<?php
	/* ARCHIVE PAGES TEMPLATE */
	get_header();
?>
    <section id="content" class="clearfix page-widh-sidebar">
        <div class="page">       
		<?php if ( get_the_author_meta( 'description' ) ) : ?>
            <div id="author-info">
                <div id="author-avatar">
                    <?php $avatar_path = get_template_directory_uri().'/images/default-avatar.png'; ?>
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), $size = '74', $default = $avatar_path ); ?>
                <!--end of author avatar -->
                </div>
                <div id="author-description">
                    <h4>
                        <?php dt_AuthorAbout.get_the_author(); ?>
                    </h4>
                    <p><?php the_author_meta( 'description' ); ?></p>
                    <a class="more-link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                        <?php echo dt_AuthorViewAll; ?>
                    </a>                            
                <!-- end of author description -->
                </div>
            <!-- end of author info -->
            </div>
        <?php endif; ?>   
        <?php rewind_posts();?>
        <?php get_template_part( 'loop', 'archive' ); ?>

        <!-- end of page -->
        </div>
        <?php get_sidebar(); ?>
    <!-- end of content -->
    </section>
<?php get_footer(); ?>