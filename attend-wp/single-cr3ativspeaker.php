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

            <h1 class="title"><?php the_title (); ?></h1>

        </div>
        <!-- End of main content title -->

    </div>
    <!-- End of main image -->

    <!-- Start of main content -->
    <div class="main_content">

        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

        <?php
            $speakertitle = get_post_meta($post->ID, 'speakertitle', $single = true); 
            $speakerurltext = get_post_meta($post->ID, 'speakerurltext', $single = true);  
            $speakerurl = get_post_meta($post->ID, 'speakerurl', $single = true); 
        ?>
        
        <!-- Start of single speaker image -->
        <div class="single_speaker_image">
        
        <?php the_post_thumbnail( 'thumbnail'); ?>
            
        <div class="clear"></div>
            
        </div>
        <!-- End of single speaker image  -->
        
        <!-- Start of speaker info -->
        <div class="cr3ativconference_speaker_info">

            <!-- Start of speaker singletitle -->
            <div class="cr3ativconference_speaker_singletitle">

                <?php if ($speakertitle != ('')){ ?>
                <?php echo stripslashes($speakertitle); ?>
                <?php } ?>

            </div>
            <!-- End of speaker singletitle -->
            
            <!-- Start of speaker singletitle -->
            <div class="cr3ativconference_speaker_company_title">

                <?php if ($speakerurl != ('')){ ?>
                <a href="<?php echo ($speakerurl); ?>" target="_blank"><?php echo stripslashes($speakerurltext); ?></a>
                <?php } ?>

            </div>
            <!-- End of speaker singletitle -->
            

            <!-- Start of social icons -->
            <div class="cr3ativconference_social_icons">

                <?php $repeatable_fields = get_post_meta($post->ID, 'speakerrepeatable', true);
                if ($repeatable_fields != ('')){ 
                foreach ($repeatable_fields as $v) { ?>

                <a href="<?php echo $v['speakerrepeatable_socailurl']; ?>"><?php echo wp_get_attachment_image($v['speakerrepeatable_socailimage'], ''); ?></a>
                <?php } } ?>

            </div>
            <!-- End of social icons -->

            <div class="clear"></div>

            <?php the_content('        '); ?>

        </div>
        <!-- End of speaker info -->

        <!-- Start of speaker image single -->
        <div class="speaker_image_single">
            
            <?php $this_post = $post->ID; ?>

            <?php
            add_filter('posts_orderby','cr3ativoderby');
            $wp_query = new WP_Query(array(
            'post_type' => 'cr3ativconference',
            'posts_per_page' => 99999999,
            'meta_key' => 'cr3ativconfmeetingdate',

            'meta_query' => array(
                array(
            'key' => 'cr3ativconfmeetingdate',
            ),
                array(
            'key' => 'cr3ativ_confstarttime',
            ),
            array(
            'key' => 'cr3ativ_confspeaker',
            'value' => $this_post,
            'compare' => 'LIKE',
            ),

            ),
            )); 
            remove_filter('posts_orderby','cr3ativoderby');

            while (have_posts()) : the_post();

            ?>

            <?php $cr3ativconfmeetingdate = get_post_meta($post->ID, 'cr3ativconfmeetingdate', $single = true); 
            $confstarttime = get_post_meta($post->ID, 'cr3ativ_confstarttime', $single = true);
            $confendtime = get_post_meta($post->ID, 'cr3ativ_confendtime', $single = true); 
            $conflocation = get_post_meta($post->ID, 'cr3ativ_conflocation', $single = true); 
            $cr3ativ_highlight = get_post_meta($post->ID, 'cr3ativ_highlight', $single = true); 
            $confdisplaystarttime = get_post_meta($post->ID, 'cr3ativ_confdisplaystarttime', $single = true);
            $confdisplayendtime = get_post_meta($post->ID, 'cr3ativ_confdisplayendtime', $single = true);
            ?>

            <?php if ($cr3ativ_highlight != ('')){ ?>
            
            <!-- Start of single session wrapper -->
            <div class="single_session_wrapper highlight">
                
            <?php } else { ?>
            
            <!-- Start of single session wrapper -->
            <div class="single_session_wrapper">
                
            <?php } ?>

                <h6 class="session"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'cr3_attend_theme' ); ?>&nbsp;<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
                
                <?php $dateformat = get_option('date_format'); ?>

                <h5 class="date"><?php echo date_i18n($dateformat, $cr3ativconfmeetingdate); ?></h5>

                <!-- Start of single conference location -->
                <div class="single-conference-location">
                    
                    <?php if ($conflocation != ('')){ ?>
                    <?php echo stripslashes($conflocation); ?> 
                    <?php } ?>

                </div>
                <!-- End of single conference location -->

                <!-- Start of single conference time -->
                <div class="single-conference-time">
                    
                    <?php if ($confdisplaystarttime != ('')) { ?>

                    <?php if ($confdisplaystarttime != ('')) { echo ($confdisplaystarttime); }
                    if ($confdisplayendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confdisplayendtime); } ?>

                    <?php } else { ?> 

                    <?php if ($confstarttime != ('')){  echo ($confstarttime); }
                    if ($confendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confendtime); } ?>

                    <?php } ?>

                </div>
                <!-- End of single conference time -->

            </div>
            <!-- End of single session wrapper -->

        <?php endwhile; wp_reset_query(); ?>

        </div>
        <!-- End of speaker image single -->

        <?php endwhile; ?> 

        <?php else: ?> 
        <p><?php _e( 'There are no posts to display. Try using the search.', 'cr3_attend_theme' ); ?></p> 

        <?php endif; ?>

    <!-- Clear Fix --><div class="cr3ativconference_clear"></div>

    </div>
    <!-- End of main content -->

    <div class="clearfix"></div>

</div>
<!-- End of page wrap -->

<?php get_footer(); ?>