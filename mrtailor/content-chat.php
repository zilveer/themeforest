<?php
	global $mr_tailor_theme_options;

    $blog_with_sidebar = "";
    if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];    
?>

<div class="row">
            
	<?php if ( $blog_with_sidebar == "yes" ) : ?>
        <div class="large-12 columns">
    <?php else : ?>
        <div class="large-8 large-centered columns without-sidebar">
    <?php endif; ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php if ( is_single() ) : ?>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <?php else : ?>
                <h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h2>
                <?php endif; // is_single() ?>
                
                <div class="post_header_date"><?php mr_tailor_post_header_entry_date(); ?></div>
                
            </header><!-- .entry-header -->
        
            <div class="entry-content">
                <?php
                if( ($post->post_excerpt) && (!is_single()) ) {
                    the_excerpt();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Continue reading &rarr;', 'mr_tailor'); ?></a>
                <?php
                } else {
                    the_content();
                }
                ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'mr_tailor' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
            </div><!-- .entry-content -->
        
            <footer class="entry-meta">
                <ul>
                    <?php mr_tailor_entry_meta(); ?>
                    <?php //edit_post_link( __( 'Edit', 'mr_tailor' ), '<li class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</li>' ); ?>
                </ul>
            </footer><!-- .entry-meta -->
        </article><!-- #post -->

    </div><!-- .columns -->
</div><!-- .row -->
