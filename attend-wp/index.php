<?php get_header(); ?>


<!-- Start of page wrap -->
<div class="page_wrap">

    <?php if ( get_theme_mod( 'cr3ativ_conference_defaultimg' ) ) : ?>

    <?php $blogbgrnd = ( get_theme_mod( 'cr3ativ_conference_defaultimg' ) ); ?>

    <?php else : $blogbgrnd =  esc_url_raw( get_stylesheet_directory_uri() . '/img/default_image.jpg' ); ?>
            
    <?php endif; ?>

    <!-- Start of main image -->
    <div class="main_image" style="background: url('<?php echo $blogbgrnd; ?>') no-repeat scroll center center transparent; background-size:cover; height:684px; position:relative; z-index:1;">
        
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

            <h1 class="title"><?php wp_title(''); ?></h1>

        </div>
        <!-- End of main content title -->

    </div>
    <!-- End of main image -->

    <!-- Start of main content -->
    <div class="main_content">

        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

        <?php get_template_part( 'content', get_post_format() ); ?>

        <?php endwhile; ?>

        <?php else: ?>

        <p>
        <?php _e( 'There are no posts to display. Try using the search.', 'cr3_attend_theme' ); ?>
        </p>

        <?php endif; ?>

        <?php
        $prev_link = get_previous_posts_link(__('Newer', 'cr3_attend_theme'));
        $next_link = get_next_posts_link(__('Older', 'cr3_attend_theme'));
        ?>

        <!-- Start of pagination -->
        <div id="pagination">

            <?php 
            if ($prev_link && $next_link) {
            if ($prev_link){
            echo '<div class="paginationprev">'.$prev_link .'</div>';
            }
            if ($next_link){
            echo '<div class="paginationnext">'.$next_link .'</div>';
            }
            } else if ($next_link) {
            echo '<div class="paginationnext">'.$next_link .'</div>';
            } else if ($prev_link) {
            echo '<div class="paginationprev">'.$prev_link .'</div>';
            }
            ?>

            <div class="clearfix"></div>    

        </div>
        <!-- End of pagination -->   

    </div>
    <!-- End of main content -->

    <div class="clearfix"></div>

</div>
<!-- End of page wrap -->

<?php get_footer(); ?>