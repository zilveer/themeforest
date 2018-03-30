<?php
global $post;

if($post->ID):

$thumb_class ='post-thumbnail  hover-thumb'; // six
$content_class ='post-content'; // six
$is_small = false;
$pos_class ='blog-post-item b30';
$link =get_permalink($post->ID);
$date_format = get_option('date_format');

?>

<div <?php post_class($pos_class); ?>  id="post-<?php the_ID(); ?>">

        <div class="post-heading">
            <h2 class="blog-title">
                <a  title="<?php printf( esc_attr__( 'Permalink to %s', 'smooththemes' ), the_title_attribute( 'echo=0' ) ); ?>"  rel="bookmark" href="<?php echo $link; ?>"><?php the_title(); ?></a>
            </h2>
            <div class="blog-meta">
                <span class="blog-date"><i class="icon-time"></i><?php the_time($date_format); ?></span>
                <span class="blog-author"><i class="icon-user"></i><span><?php _e('By','smooththemes'); ?></span>
                <?php the_author_posts_link(); ?>
                </span>
                <span class="blog-comment"><i class="icon-comments-alt"></i><span> <?php comments_number(__('0 Comment','smooththemes'),__('1 Comment','smooththemes'),__('% Comments','smooththemes') ); ?> </span>
            </div>
        </div>

        <?php
         $image_size = (isset($settings['image_size']) && $settings['image_size'] !='' ) ? $settings['image_size']  : 'st_medium';
         $thumb_html = st_post_thumbnail($post->ID,$image_size);
         if($thumb_html){
         ?>
        <div class="<?php echo $thumb_class; ?>  blog-thumb-wrapper">                     
            <?php
           
                echo $thumb_html;
            ?>
            
            <div class="clear"></div>
        </div>
        <?php } ?>
        
        <div class="<?php echo $content_class; ?>">
  
            <?php if(!$is_small): ?>
            <div class="post-excerpt">
                <?php 

                  the_excerpt();
                ?>
            </div>
             <a href="<?php echo $link; ?>" class="blog-more"><i class="icon-plus"></i> <?php _e('Find Out More','smooththemes'); ?></a>
            <?php endif; ?>
        </div>
    <div class="clear"></div>   
</div>
<?php endif; ?>