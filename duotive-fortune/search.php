<?php
/** SEARCH TEMPLATE **/
get_header(); ?>
    <section id="content" class="clearfix page-widh-sidebar">
            <div class="page">                 	
				<?php if ( have_posts() ) : ?>        
                    <?php get_template_part( 'loop', 'search' ); ?>            
                <?php else : ?>
                    <div class="post clearfix">            
                        <div class="entry-content widget_search">
                            <p class="intro"><?php echo dt_NotFoundContent; ?></p>
                            <?php get_search_form(); ?>
                        <!--end of entry content -->
                        </div>
                    </div>
                <?php endif; ?>	            
            <!-- end of page -->
            </div>
        <?php get_sidebar(); ?>
    <!-- end of content -->
    </section>
<?php get_footer(); ?>
