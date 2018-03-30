<?php get_header(); ?>

<?php
$postspage_id = get_option('page_for_posts'); 
$pageimage = get_post_meta($postspage_id,'_thumbnail_id',false);
$pageimage = wp_get_attachment_image_src($pageimage[0], 'portfoliolarge', false); 
ag_fullscreen_bg($pageimage[0]); 
?>

<div class="contentarea">

<!-- Page Title
  ================================================== -->
<div class="namecontainer container">
        <div class="pagename">
            <h2><span><?php wp_title("",true);?></span></h2>
        </div>
</div>
<!-- End Page Title -->

<div class="clear"></div>

<!-- Page Content
  ================================================== -->
<div class="container clearfix">
<div class="smallpage">
        <?php $counter = 1;
		if (have_posts()) : while (have_posts()) : the_post();
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // This will be 3 per the above imaginery results
		$postsppage= get_option('posts_per_page'); // 10 per example
		$anothervar = $paged * $postsppage; // result would be 30.
		$morevar = $anothervar - $wp_query->found_posts; // 30 minus the amount of results (so will equal 3)..
		$endvar =  $postsppage - $morevar; // Will equal 7... ?>
		<div class="contentwrap pagebg">
        <div class="blogpost">
        <div class="clear"></div> <!-- for stupid ie7 --> 
            <div class="categories"><?php the_category(' '); ?> </div>
            	<div class="blogdate">
                    <h3>
                        <?php the_time('d'); ?>
                    </h3>
                    <p>
                        <?php the_time('M'); ?>
                    </p>
                   <div class="clear"></div>
                </div>
                      
                <h3 class="blogtitle">
               		<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">
						<?php the_title(); ?>
                    </a> 
                </h3>
                    
                     <ul class="smalldetails">
                     <li><?php _e('By ', 'framework'); the_author_link(); ?></li>
                     <li><?php if ( comments_open() ) : ?><a href=" <?php comments_link(); ?> ">
                   	 <?php comments_number( __('No Comments', 'framework'), __('One Comment', 'framework'), __('% Comments', 'framework') ); ?>
                     </a> <?php endif; ?></li>
                           <div class="clear"></div>
                     </ul>        
                    
                <div class="featuredimage">
                    <?php /* if the post has a WP 2.9+ Thumbnail */
					if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
                    <a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('blog', array('class' => 'scale-with-grid')); /* post thumbnail settings configured in functions.php */ ?>
                    </a>
                    <?php endif; ?>
                </div>
                
                <?php the_content(__('Read more...', 'framework')); ?>
                
                <?php //  edit_post_link( __('Edit Post', 'framework'), '<div class="edit-post"><p>[', ']</p></div>' ); ?>
                
                <div class="clear"></div>

    
        </div>
        <div class="clear"></div>
        </div>
       <?php if($endvar == 0 || $counter == $endvar) { echo '<div class="divider full sidetop"></div>'; } else { echo '<div class="divider full"></div>';} ?>

        <div class="clear"></div>
        <?php $counter++; endwhile; else :?>
        <!-- Else nothing found -->
                <div class="smallpage pagebg">
<div class="contentwrap">
        <h2>
            <?php _e('Error 404 - Not found.', 'framework'); ?>
        </h2>
        <p>
            <?php _e("Sorry, but you are looking for something that isn't here.", 'framework'); ?>
        </p>
        </div>
</div>
        <!--BEGIN .navigation .page-navigation -->
        <?php endif; ?>
        <?php if ( function_exists('pp_has_pagination') ) : ?>
        <?php if (pp_has_pagination()) : ?>
                        <div class="pagebg">
<div class="contentwrap">
        <div class="pagination_container">
            <ul id="pagination">
                <!-- the previous page -->
                <?php pp_the_pagination(); if (pp_has_previous_page()) : ?>
                <li class="previous"> <a href="<?php pp_the_previous_page_permalink(); ?>" class="prev">&laquo; Previous</a></li>
                <?php else : ?>
                <li class="previous-off">&laquo; Previous</li>
                <?php endif; pp_rewind_pagination(); ?>
                <!-- the page links -->
                <?php while(pp_has_pagination()) : pp_the_pagination(); ?>
                <?php if (pp_is_current_page()) : ?>
                <li class="active">
                    <?php pp_the_page_num(); ?>
                </li>
                <?php else : ?>
                <li><a href="<?php pp_the_page_permalink(); ?>">
                    <?php pp_the_page_num(); ?>
                    </a></li>
                <?php endif; ?>
                <?php endwhile; pp_rewind_pagination(); ?>
                <!-- the next page -->
                <?php pp_the_pagination(); if (pp_has_next_page()) : ?>
                <li class="next"> <a href="<?php pp_the_next_page_permalink(); ?>">Next &raquo;</a></li>
                <?php else : ?>
                <li class="next-off">Next &raquo;</span>
                    <?php endif; pp_rewind_pagination(); ?>
            </ul>
        </div>
        </div>
        </div>
        <?php endif; else: ?>
        <div class="pagination_container">
            <div class="alignleft">
                <?php next_posts_link(__('&larr; Older', 'framework')) ?>
            </div>
            <div class="alignright">
                <?php previous_posts_link(__('Newer &rarr;', 'framework')) ?>
            </div> 
        </div>
        <?php endif;?>
</div>
    <div class="sidebar">
    
        <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Sidebar') ) ?>
    </div>
    <div class="clear"></div>
</div>
<!-- End Page Content -->

</div>
<?php get_footer(); ?>