<?php
/**
 * The Template for displaying all single posts.
 */

get_header(); 
	
?>
<div class="row">
    <div class="large-12 columns main-content-top">
        <div class="row">
            <div class="large-6 columns">
                <h2><?php the_title(); ?> </h2>
            </div>        
            <div class="large-6 columns">
                <?php if(class_exists('the_breadcrumb')){ $albc = new the_breadcrumb; } ?>
            </div>
        </div>
    </div>
</div>
<div class="shadow"></div>
<div class="row main-content">
    <div class="large-12 columns">
        <div class="row">
        <aside class="large-3 columns right">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?>
        </aside> 
        <div class="large-9 columns">
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <article class="post" id="post-<?php the_ID();?>">
                <div class="post_img">
                    <?php
                    $thumbnail = get_the_post_thumbnail($post->ID, 'blog-list1');
$postmeta = get_post_custom($post->ID); 
                    if(!empty($thumbnail)):?>
                    <a href="<?php the_permalink()?>"><?php the_post_thumbnail('blog-list1'); ?></a>
                    <?php elseif (isset($postmeta['_post_video'])): ?>
                    <iframe src="http://player.vimeo.com/video/<?php echo $postmeta['_post_video'][0]; ?>" width="960" height="450" class="post-image"></iframe>
<?php else:?>
                   
                    <?php endif ?>
                    <ul class="meta">
                        <!-- Show date and comments if set from admin panel -->
                        <?php if($alc_options['alc_blog_show_date']): ?>
                        <li>
                            <span class="icon-calendar"></span>
                            <time datetime="<?php echo get_the_time('Y-m-d'); ?>"><?php echo get_the_time('M d, Y'); ?></time>
                        </li>
                        <?php endif?>
                        <?php if( 'open' == $post->comment_status && $alc_options['alc_blog_show_comments']) : ?>        
                        <li>
                            <span class="icon-comment"></span>
                            <?php comments_popup_link( __( '0 Comments', 'Evolution' ), __( '1 Comment', 'Evolution' ), __( '% Comments', 'Evolution' )); ?>
                        </li>
                        <?php endif?>
                    </ul>
                </div>
                <h3><?php the_title(); ?></h3>
                <div class="post_text"><?php the_content(); ?></div>
            </article>
            <?php endwhile; ?>
<!--COMMENTS-->
                <?php comments_template(); ?>
				<?php $test = false; if ($test) {comment_form(); wp_link_pages( $args );} ?>

        </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>