<?php get_header(); ?>

<?php
/* #Get Fullscreen Background
======================================================*/
$postspage_id = get_option('page_for_posts'); // Get ID of Blog Page
$pageimage = get_post_meta($postspage_id,'_thumbnail_id',false); // Get thumbnail ID of Blog Page Featured Image
$pageimage = wp_get_attachment_image_src($pageimage[0], 'portfoliolarge', false); // Get thumbnail URL of Blog Page Featured Image
ag_fullscreen_bg($pageimage[0]); // Display Fullscreen Background
?>

<div class="contentarea">

<!-- Page Title
  ================================================== -->
<div class="namecontainer container">
        <div class="pagename">
            <h2><span><?php _e("Search Results for:", 'framework'); ?> <?php the_search_query(); ?></span></h2>
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
        
            /* #Declare Variables for Posts Per Page, Leave Out Divider for Last Post
            ==========================================================================*/
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
            $postsppage = get_option('posts_per_page'); 
			$actualpostsppage = sizeof($posts); ?>
            
            <div class="contentwrap pagebg">
                <div class="blogpost"><div class="clear"></div> <!-- for stupid ie7 -->
                 
                    <div class="categories"><?php the_category(' '); ?></div> <!-- Categories -->
                    
                    <div class="blogdate"><!-- Date Circle -->
                        <h3><?php the_time('d'); ?></h3>
                        <p><?php the_time('M'); ?></p>
                       <div class="clear"></div>
                    </div>
                              
                    <h3 class="blogtitle"><!-- Blog Title -->
                        <a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">
                            <?php the_title(); ?>
                        </a> 
                    </h3>
                            
                    <ul class="smalldetails"><!-- Author and Comments -->
                        <li><?php _e('By ', 'framework'); the_author_link(); ?></li>
                        <li><?php if ( comments_open() ) : ?><a href=" <?php comments_link(); ?> "><?php comments_number( __('No Comments', 'framework'), __('One Comment', 'framework'), __('% Comments', 'framework') ); ?></a><?php endif; ?></li>
                        <div class="clear"></div>
                    </ul>        
                            
                    <div class="featuredimage"><!-- Featured Blog Image -->
                        <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) :  /* if the post has a WP 2.9+ Thumbnail */?>
                        <a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('blog', array('class' => 'scale-with-grid')); /* post thumbnail settings configured in functions.php */ ?>
                        </a>
                        <?php endif; ?>
                    </div>
                        
                    <?php the_content(__('Read more...', 'framework')); ?>
                        
                    <?php edit_post_link( __('Edit Post', 'framework'), '<div class="edit-post"><p>[', ']</p></div>' ); ?>
                        
                   <div class="clear"></div>
                   
                </div>
                <div class="clear"></div>
            </div>
            
           <?php 
           /* #Leave Out Divider for Last Post
           ======================================================*/
           if($counter == $postsppage || $counter == $actualpostsppage ) { echo '<div class="divider full sidetop"></div>'; } else { echo '<div class="divider full"></div>';} ?>
    
           <div class="clear"></div>
            
           <?php $counter++; endwhile; else :?>
            
        <!-- Else nothing found -->
        <div class="smallpage pagebg">
            <div class="contentwrap">
                <h2><?php _e('Nothing Found.', 'framework'); ?></h2>
                <p><?php _e("Sorry, but we can't seem to find anything by those terms.", 'framework'); ?></p>
            </div>
        </div>
        
        <!--BEGIN .navigation .page-navigation -->
        <?php endif; ?>
        
        <?php 
        /* #If has Proper Pagination Plugin
        ======================================================*/
        if ( function_exists('pp_has_pagination') ) : 
            if (pp_has_pagination()) : // If there's pagination ?>
            	<div class="divider full"></div><!-- Top Divider for Pagination -->
                        <div class="pagination_container pagebg">
                            <ul id="pagination">
                                <!-- the previous page -->
                                <?php pp_the_pagination(); 
                                if (pp_has_previous_page()) : ?>
                                    <li class="previous"><a href="<?php pp_the_previous_page_permalink(); ?>" class="prev">&laquo; Previous</a></li>
                                <?php else : ?>
                                    <li class="previous-off">&laquo; Previous</li>
                                <?php endif; pp_rewind_pagination(); ?>
                                
                                <!-- the page links -->
                                <?php while(pp_has_pagination()) : pp_the_pagination(); ?>
                                    <?php if (pp_is_current_page()) : ?>
                                        <li class="active"><?php pp_the_page_num(); ?></li>
                                    <?php else : ?>
                                        <li><a href="<?php pp_the_page_permalink(); ?>"><?php pp_the_page_num(); ?></a></li>
                                    <?php endif; ?>
                                <?php endwhile; pp_rewind_pagination(); ?>
                                
                                <!-- the next page -->
                                <?php pp_the_pagination(); if (pp_has_next_page()) : ?>
                                    <li class="next"> <a href="<?php pp_the_next_page_permalink(); ?>">Next &raquo;</a></li>
                                <?php else : ?>
                                     <li class="next-off">Next &raquo;</span>
                                <?php endif; pp_rewind_pagination(); ?>
                                <div class="clear"></div>
                            </ul>
                        </div>
                
         <div class="divider full sidetop"></div>
         
        <?php endif; else: 
         
        /* #Regular Previous/Next Links
        ======================================================*/
        if ( has_previous_posts() || has_next_posts() ) : 
        ?>
        <div class="divider full"></div><!-- Top Divider for Pagination -->
        <div class="pagination_container pagebg">
            <div class="alignleft">
                <?php next_posts_link(__('&larr; Older', 'framework')) ?>
            </div>
            <div class="alignright">
                <?php previous_posts_link(__('Newer &rarr;', 'framework')) ?>
            </div> 
            <div class="clear"></div>
        </div>
         <div class="divider full sidetop"></div>
       
        <?php endif;
        // End if has Previous/Next Links
        
     endif;
     // End Else  ?>
               
    </div>
<!-- End Page Content -->

<!-- Sidebar -->
    <div class="sidebar">
        <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Sidebar') ) ?>
    </div>
<!-- End Sidebar -->

    <div class="clear"></div>
</div>
<!-- End Container -->

</div>
<!-- End contentarea -->
<?php get_footer(); ?>