<!--BEGIN .post-header -->
<div class="post-header">
    <?php tz_gallery($post->ID); ?>
    
    <!--BEGIN .slider -->
    <div id="slider-<?php echo $post->ID; ?>" class="slider" data-loader="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif">
        
    <?php 
        $image_ids_raw = get_post_meta($post->ID, 'tz_image_ids', true);

        if( $image_ids_raw ) {
            // Using WP3.5; use post__in orderby option
            $image_ids = explode(',', $image_ids_raw);
            $postid = null;
            $orderby = 'post__in';
            $include = $image_ids;
        } else {
            $postid = $post->ID;
            $orderby = 'menu_order';
            $include = '';
        }
    
        // get first 2 attachments for the post
        $args = array(
            'include' => $include,
            'orderby' => $orderby,
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1
        );
		$attachments = get_posts($args);
        
        if ($attachments) { ?>
    
            <div class="slides_container clearfix">
    
            <?php foreach ($attachments as $attachment) {
                $src = wp_get_attachment_image_src( $attachment->ID, 'tz_featured'); 
            ?>            
            	<div>
                    <img height="<?php echo $src[2]; ?>" width="<?php echo $src[1]; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" src="<?php echo $src[0]; ?>" />
                </div>
            <?php } ?>

            </div>
        <?php } ?>
    
    <!--END .slider -->
    </div>
    
	<a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('tz_featured'); /* post thumbnail settings configured in functions.php */ ?></a>

	<span class="hanger-left"></span>
	<span class="hanger-right"></span>
    
<!--END .post-header -->
</div>

<!--BEGIN .entry-header-->
<div class="entry-header">

<?php if( is_singular() ) : ?>
	<h1 class="entry-title"><?php the_title(); ?><?php edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' ); ?></h1>
<?php else : ?>
	<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>"> <?php the_title(); ?></a><?php edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' ); ?></h2>
<?php endif; ?>

<!--END entry-header -->
</div>

<!--BEGIN .entry-content -->
<div class="entry-content clearfix">
    <?php the_content(__('Read more...', 'framework')); ?>
<!--END .entry-content -->
</div>

<?php get_template_part('includes/post-meta'); ?>