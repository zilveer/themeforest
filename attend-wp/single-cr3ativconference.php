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

    <!-- Start of main content session -->
    <div class="main_content session">

        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

        <?php
        $cr3ativconfmeetingdate = get_post_meta($post->ID, 'cr3ativconfmeetingdate', $single = true); 
        $conflocation = get_post_meta($post->ID, 'cr3ativ_conflocation', $single = true); 
        $confspeakers = get_post_meta($post->ID, 'cr3ativ_confspeaker', $single = true); 
        $confstarttime = get_post_meta($post->ID, 'cr3ativ_confstarttime', $single = true); 
        $confendtime = get_post_meta($post->ID, 'cr3ativ_confendtime', $single = true); 
        $confdisplaystarttime = get_post_meta($post->ID, 'cr3ativ_confdisplaystarttime', $single = true);
        $confdisplayendtime = get_post_meta($post->ID, 'cr3ativ_confdisplayendtime', $single = true);
        ?>
        <?php $dateformat = get_option('date_format'); ?>

        <?php if ($sessiondate != (date_i18n($dateformat, $cr3ativconfmeetingdate))){ ?>

        <!-- Start of session index date -->
        <div class="session_index_date">

        <h1 class="conference_date"><?php echo date_i18n($dateformat, $cr3ativconfmeetingdate); ?></h1>

        </div>
        <!-- End of session index date -->

        <div class="clear"></div>

        <?php } ?>

        <!-- Start of blog wrapper -->
        <div class="cr3ativconference_blog_wrapper">

            <!-- Start of conference meta -->
            <div class="conference_meta">

                <!-- Start of speaker list -->
                <div class="speaker_list">

                    <?php
                    $cr3ativ_confspeakers = get_post_meta($post->ID, 'cr3ativ_confspeaker', $single = true); 
                    ?>    
                    <?php
                    if ( $cr3ativ_confspeakers ) { 

                    foreach ( $cr3ativ_confspeakers as $cr3ativ_confspeaker ) :

                    $speaker = get_post($cr3ativ_confspeaker);
                    $speakerimg = get_the_post_thumbnail($speaker->ID);
                    $speakerlink = get_permalink( $speaker->ID );
                    $speakertitle = get_post_meta($speaker->ID, 'speakertitle', $single = true);
                    echo'<div class="speaker_list_wrapper">';
                    echo '<a title="'. $speaker->post_title .'" href="'. $speakerlink .'">'. $speakerimg .'</a>'; 
                    echo '<div class="speaker_info_singlesesh"><p class="seshspeakername"><a title="'. $speaker->post_title .'" href="'. $speakerlink .'">'. $speaker->post_title .'</a></p> <p class="seshtitle">'. $speakertitle .'</p></div></div>'; 
                    endforeach; 

                    } ?>

                </div>
                <!-- End of speaker list -->

            </div>
            <!-- End of conference meta -->

            <!-- Start of conference content -->
            <div class="conference_content">

                <hr />

                <div class="clear"></div>

                <!-- Start of conference time -->
                <div class="conference-time">

                    <?php if ($confdisplaystarttime != ('')) { ?>

                    <?php if ($confdisplaystarttime != ('')) { echo ($confdisplaystarttime); }
                    if ($confdisplayendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confdisplayendtime); } ?>

                    <?php } else { ?> 

                    <?php if ($confstarttime != ('')){  echo ($confstarttime); }
                    if ($confendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confendtime); } ?>

                    <?php } ?>

                </div>
                <!-- End of conference time -->

                <!-- Start of google share link -->
                <div class="google_share_link">
                    
                    <?php $desc = get_the_excerpt (); 
                    $new_confstarttime = str_replace(':', '', $confstarttime);
                    $new_confendtime = str_replace(':', '', $confendtime);
                    ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/calendar_general.png" alt="<?php _e( 'Add to Google Calendar', 'cr3_conf_theme' ); ?>" height="19" width="21" /><a href="https://www.google.com/calendar/render?action=TEMPLATE&amp;text=<?php the_title (); ?>&amp;dates=<?php echo date( 'Y', $cr3ativconfmeetingdate ); ?><?php echo date( 'm', $cr3ativconfmeetingdate ); ?><?php echo date( 'd', $cr3ativconfmeetingdate ); ?>T<?php echo ($new_confstarttime); ?>00/<?php echo date( 'Y', $cr3ativconfmeetingdate ); ?><?php echo date( 'm', $cr3ativconfmeetingdate ); ?><?php echo date( 'd', $cr3ativconfmeetingdate ); ?>T<?php echo ($new_confendtime); ?>00&amp;details=<?php echo stripslashes($desc); ?>&amp;location=<?php echo stripslashes($conflocation); ?>&amp;pli=1&amp;uid=&amp;sf=true&amp;output=xml#f" target="_blank"><?php _e( 'Add to Google Calendar', 'cr3_attend_theme' ); ?></a>

                </div>
                <!-- End of google share link -->

                <!-- Start of conference location -->
                <div class="conference-location">

                    <?php if ($conflocation != ('')){ ?>
                    <?php echo stripslashes($conflocation); ?> 
                    <?php } ?>

                </div>
                <!-- End of conference location -->

                <!-- Start of session content -->
                <div class="session_content">

                    <?php the_content(); ?> 

                </div>
                <!-- End of session content -->

                <hr />

                <div class="clearfix"></div>

                <p class="sessioncats"><?php echo custom_taxonomies_terms_links(); ?></p>

            </div>
            <!-- End of conference content -->

        </div>
        <!-- End of blog wrapper -->

        <?php endwhile; ?> 

        <?php else: ?> 
        <p><?php _e( 'There are no posts to display. Try using the search.', 'cr3_attend_theme' ); ?></p> 

        <?php endif; ?>

    </div>
    <!-- End of main content session -->

    <div class="clearfix"></div>

</div>
<!-- End of page wrap -->

<?php get_footer(); ?>