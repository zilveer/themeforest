<?php /* if the post has a WP 2.9+ Thumbnail */
if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
    <!--BEGIN .post-header -->
    <div class="post-header">
    <?php if( is_singular() ) { ?>
        <?php the_post_thumbnail('tz_featured'); ?>
    <?php } else { ?>
    	<a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('tz_featured'); /* post thumbnail settings configured in functions.php */ ?></a>
    <?php } ?>
    	<span class="hanger-left"></span>
    	<span class="hanger-right"></span>
    <!--END .post-header -->
    </div>
<?php } ?>


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