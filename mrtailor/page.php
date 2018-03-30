<?php
	global $mr_tailor_theme_options;

    $page_id = "";
    if ( is_single() || is_page() ) {
        $page_id = get_the_ID();
    } else if ( is_home() ) {
        $page_id = get_option('page_for_posts');		
    }

    $blog_with_sidebar = "";
    if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];

    $page_header_src = "";

    if (has_post_thumbnail()) $page_header_src = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

    if (get_post_meta( $page_id, 'page_title_meta_box_check', true )) {
		$page_title_option = get_post_meta( $page_id, 'page_title_meta_box_check', true );
	} else {
		$page_title_option = "off";
	}

?>

<?php get_header(); ?>

	<div id="primary" class="content-area">
       
        <div id="content" class="site-content" role="main">
        
       		<header class="entry-header <?php if ($page_header_src != "") : ?>with_featured_img<?php endif; ?>" style="background-image:url(<?php echo $page_header_src; ?>)">
        
                <div class="page_header_overlay"></div>
                
                <div class="row">
                    <?php if ( $blog_with_sidebar == "yes" ) : ?>
                    <div class="large-12 columns">
                    <?php else : ?>
                    <div class="large-8 large-centered columns without-sidebar">
                    <?php endif; ?>
        
                        <?php if ( is_page() ) : ?>
        
                        <?php if ( (isset($page_title_option)) && ($page_title_option == "off") ) : ?>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <?php endif; ?>
                        
                        <?php if($post->post_excerpt) : ?>
                            <div class="page-description"><?php the_excerpt(); ?></div>
                        <?php endif; ?>
                        
                        <?php else : ?>
        
                        <h1 class="entry-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h1>
        
                        <?php endif; // is_page() ?>
        
                    </div>
                </div>
        
            </header><!-- .entry-header -->

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'page' ); ?>
                    
                <?php if (function_exists('is_cart') && is_cart()) : ?>
                <?php else: ?>    
                <div class="clearfix"></div>
                <footer class="entry-meta">    
                    <?php //edit_post_link( __( 'Edit', 'mr_tailor' ), '<div class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</div>' ); ?>
                </footer><!-- .entry-meta -->
                <?php endif; ?>

                <?php
                    
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() ) comments_template();
                    
                ?>

            <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->           
        
    </div><!-- #primary -->
    
<?php get_footer(); ?>
