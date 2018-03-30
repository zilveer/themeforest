<?php  
/* 
Template Name: Sitemap 
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

            <h1 class="title"><?php wp_title(''); ?></h1>

        </div>
        <!-- End of main content title -->

    </div>
    <!-- End of main image -->

    <!-- Start of main content -->
    <div class="main_content">

        <!-- Start of one third -->
        <div class="one_third">

            <h3><?php _e( 'Categories', 'cr3_attend_theme' ); ?></h3>

            <br />

            <ul>

            <?php $args = array(
                'show_option_all'    => '',
                'orderby'            => 'name',
                'order'              => 'ASC',
                'style'              => 'list',
                'show_count'         => 1,
                'hide_empty'         => 1,
                'use_desc_for_title' => 0,
                'child_of'           => 0,
                'feed'               => '',
                'feed_type'          => '',
                'feed_image'         => '',
                'exclude'            => '',
                'exclude_tree'       => '',
                'include'            => '',
                'hierarchical'       => true,
                'title_li'           => '',
                'show_option_none'   => __('No categories', 'cr3_attend_theme'),
                'number'             => NULL,
                'echo'               => 1,
                'depth'              => 0,
                'current_category'   => 0,
                'pad_counts'         => 0,
                'taxonomy'           => 'category',
                'walker'             => 'Walker_Category' ); ?> 

                <?php wp_list_categories( $args ); ?>

            </ul>

            <div class="clearbig"></div>


            <h3><?php _e( 'Feeds', 'cr3_attend_theme' ); ?></h3>

            <br />

            <ul>

            <li><a title="<?php _e( 'Full content', 'cr3_attend_theme' ); ?>" href="feed:<?php bloginfo('rss2_url'); ?>"><?php _e( 'Main RSS', 'cr3_attend_theme' ); ?></a></li>
            <li><a title="<?php _e( 'Comment Feed', 'cr3_attend_theme' ); ?>" href="feed:<?php bloginfo('comments_rss2_url'); ?>"><?php _e( 'Comment Feed', 'cr3_attend_theme' ); ?></a></li>

            </ul>

            <div class="clearbig"></div>

            <h3><?php _e( 'Archives', 'cr3_attend_theme' ); ?></h3>

            <br />

            <ul>

            <?php wp_get_archives('type=monthly&show_post_count=true'); ?>

            </ul>

            <div class="clearbig"></div>

        </div>
        <!-- End of one third -->

        <!-- Start of one third -->
        <div class="one_third">

            <h3><?php _e( 'Pages', 'cr3_attend_theme' ); ?></h3>

            <br />

            <ul>
            <?php wp_list_pages("title_li=" ); ?>

            </ul>

            <div class="clearbig"></div>

        </div>
        <!-- End of one third -->

        <!-- Start of one third -->
        <div class="one_third">

            <h3><?php _e( 'All Blog Posts', 'cr3_attend_theme' ); ?></h3>

            <br />

            <ul>

            <?php $archive_query = new WP_Query('showposts=1000&cat=-8');
            while ($archive_query->have_posts()) : $archive_query->the_post(); ?>

            <li>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'cr3_attend_theme' ); ?><?php the_title(); ?>"><?php the_title(); ?></a>
            (<?php comments_number('0', '1', '%'); ?>)
            </li>

            <?php endwhile; ?>

            </ul>

            <div class="clearbig"></div>

        </div>
        <!-- End of one third -->

    </div>
    <!-- End of main content -->

    <div class="clearfix"></div>

</div>
<!-- End of page wrap -->

<?php get_footer(); ?>