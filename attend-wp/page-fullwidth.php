<?php  
/* 
Template Name: Fullwidth-Page 
*/  
?>

<?php get_header(); ?>

<!-- Start of page wrap -->
<div class="page_wrap">

    <?php 
    if ( has_post_thumbnail() ) {  ?>

    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>

        <!-- Start of main image -->
        <div class="main_image" style="background:url('<?php echo ($image[0]); ?>') no-repeat scroll center center transparent; background-size:cover; height:684px; position:relative; z-index:1;">

    <?php }  else { ?>
            
    <?php if ( get_theme_mod( 'cr3ativ_conference_defaultimg' ) ) : ?>

    <?php $blogbgrnd = ( get_theme_mod( 'cr3ativ_conference_defaultimg' ) ); ?>

    <?php else : $blogbgrnd =  esc_url_raw( get_stylesheet_directory_uri() . '/img/default_image.jpg' ); ?>
            
    <?php endif; ?>
            
        <!-- Start of main image -->
        <div class="main_image" style="background: url('<?php echo $blogbgrnd; ?>') no-repeat scroll center center transparent; background-size:cover; height:684px; position:relative; z-index:1;">
            
    <?php } ?>
        
        <!-- Start of button holder -->
        <div class="button_holder">
        <?php $topurl = ( get_theme_mod( 'cr3ativ_conference_url' ) ); ?>
            <?php $topurltext = ( get_theme_mod( 'cr3ativ_conference_url_text' ) ); ?>

            <?php if ($topurl != ('')){ ?>           

            <!-- Start of top of page button -->
            <div class="top_of_page_button">

                <a href="<?php echo ($topurl); ?>"><?php echo ($topurltext); ?></a>

            </div>
            <!-- End of top of page button -->

            <?php } ?>
        </div>
        <!-- End of button holder -->

        <!-- Start of main content title -->
        <div class="main_content_title">

            <h1 class="title"><?php the_title (); ?></h1>

        </div>
        <!-- End of main content title -->

    </div>
    <!-- End of main image -->

    <!-- Start of main content -->
    <div class="main_content">

        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

        <?php the_content( '        '); ?>

        <?php if ( $numpages > '1' ) { ?>

        <!-- Start of pagination -->
        <div id="pagination2"> 

            <!-- Start of pagination class -->
            <div class="pagination2">
            
                <?php wp_link_pages(); ?>

            </div>
            <!-- End of pagination class --> 

        </div>
        <!-- End of pagination -->

        <?php } ?>            

        <?php endwhile; ?>

        <?php else: ?>

        <p>
        <?php _e( 'There are no posts to display. Try using the search.', 'cr3_attend_theme' ); ?>
        </p>

        <?php endif; ?>

        <?php if ('open' == $post->comment_status) { ?>

        <!-- Start of comment wrapper -->
        <div class="comment_wrapper">

            <!-- Start of comment wrapper main -->
            <div class="comment_wrapper_main">

                <?php comments_template(); ?>
                <?php comment_form(); ?>

            </div>
            <!-- End of comment wrapper main -->

        <div class="clear"></div>

        </div>
        <!-- End of comment wrapper -->

        <?php } ?>

    </div>
    <!-- End of main content -->

<div class="clearfix"></div>

</div>
<!-- End of page wrap -->

<?php get_footer(); ?>