<?php  
/* 
Template Name: Cr3ativSpeaker
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

            <!-- Start of content -->
            <div class="content">

                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

                <?php the_content( '        '); ?>

                <?php endwhile; ?>

                <?php else: ?>

                <p>
                <?php _e( 'There are no posts to display. Try using the search.', 'cr3_attend_theme' ); ?>
                </p>

                <?php endif; ?>

            </div>
            <!-- End of content -->

        <div class="cr3ativconference_clearbig"></div>

            <?php 
            $temp = $wp_query; 
            $wp_query = null; 
            $wp_query = new WP_Query(); 
            $wp_query->query('post_type=cr3ativspeaker&posts_per_page=999999'); 
            ?>

            <?php while ($wp_query->have_posts()) : $wp_query->the_post();  ?>

            <?php
            $speakertitle = get_post_meta($post->ID, 'speakertitle', $single = true); 
            $speakerurltext = get_post_meta($post->ID, 'speakerurltext', $single = true); 
            $speakerurl = get_post_meta($post->ID, 'speakerurl', $single = true);
            ?>

            <!-- Start of conference speaker wrapper -->
            <div class="cr3ativconference_speaker_wrapper"> 

                <!-- Start of speaker image -->
                <div class="cr3ativconference_speaker_image">

                    <a href="<?php the_permalink (); ?>"><?php the_post_thumbnail(''); ?></a>

                </div>
                <!-- End of speaker image -->

                <!-- Start of speaker deats -->
                <div class="speaker_deats">

                    <!-- Start of vertical align -->
                    <div class="vertical_align">

                    <!-- Start of speaker name -->
                    <div class="cr3ativconference_speaker_name">

                        <a href="<?php the_permalink (); ?>"><?php the_title (); ?></a>

                    </div>
                    <!-- End of speaker name -->

                    <!-- Start of speaker content -->
                    <div class="speaker_content">

                        <?php 
                        global $more;    // Declare global $more (before the loop).
                        $more = 0;       // Set (inside the loop) to display content above the more tag.
                        the_content(__('More', 'cr3_attend_theme'));
                        ?>

                    </div>
                    <!-- End of speaker content -->

                    <hr class="center" />

                    <!-- Start of speaker title -->
                    <div class="cr3ativconference_speaker_company">

                        <?php if ($speakerurltext != ('')){ ?>

                        <?php if ($speakerurl != ('')){ ?>
                        <a href="<?php echo ($speakerurl); ?>" target="_blank"><?php echo stripslashes($speakerurltext); ?></a>
                        <?php }  else { ?>

                        <?php echo stripslashes($speakerurltext); ?>

                        <?php } } ?>

                    </div>
                    <!-- End of speaker title -->

                    </div>
                    <!-- End of vertical align -->

                <div class="clear"></div>

                </div>
                <!-- End of speaker deats -->

            </div>
            <!-- End of conference speaker wrapper -->

            <?php endwhile; ?> 

            <!-- Clear Fix --><div class="cr3ativconference_clear"></div>

            <?php $wp_query = null; $wp_query = $temp;  // Reset ?>            

        </div>
        <!-- End of main content -->

            <div class="clearfix"></div>

</div>
<!-- End of page wrap -->

<?php get_footer(); ?>