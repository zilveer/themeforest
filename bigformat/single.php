<?php get_header(); ?>

<?php
/* #Get Fullscreen Background Variables
======================================================*/
$postspage_id = get_option('page_for_posts'); // Get ID of Blog Page
$pageimage = get_post_meta($postspage_id,'_thumbnail_id',false); // Get thumbnail ID of Blog Page Featured Image
$pageimage = wp_get_attachment_image_src($pageimage[0], 'portfoliolarge', false); // Get thumbnail URL of Blog Page Featured Image
ag_fullscreen_bg($pageimage[0]); // Display Fullscreen Background
?>

<div class="contentarea">

<!-- Page Title
  ================================================== -->
<div class="container namecontainer">
        <div class="pagename">
            <h2><span><a href="<?php echo get_permalink($postspage_id); ?>"><?php echo get_the_title($postspage_id); ?></a></span></h2>
        </div>
</div>
<!-- End Page Title -->

<div class="clear"></div>

<!-- Page Content
  ================================================== -->
<div class="container clearfix"><div class="clear"></div><!-- For Stupid ie7-->
	<div class="smallpage">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
            <div class="contentwrap pagebg">
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
                        <div class="clear"></div>
                                
                        <ul class="smalldetails"><!-- Author and Comments -->
                            <li><?php _e('By ', 'framework'); the_author_link(); ?></li>
                            <li><?php if ( comments_open() ) : ?><a href=" <?php comments_link(); ?> "><?php comments_number( __('No Comments', 'framework'), __('One Comment', 'framework'), __('% Comments', 'framework') ); ?></a><?php endif; ?></li>
                            <div class="clear"></div>
                        </ul>        
                        <div class="clear"></div>
                                
                        <div class="featuredimage"><!-- Featured Blog Image -->
                            <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) :  /* if the post has a WP 2.9+ Thumbnail */?>
                            <a rel="prettyPhoto" title="<?php the_title(); ?>" href="<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false); echo $src[0]; ?>">
                                <?php the_post_thumbnail('blog', array('class' => 'scale-with-grid')); /* post thumbnail settings configured in functions.php */ ?>
                            </a>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Post Content -->
                        <?php the_content(__('Read more...', 'framework')); ?>
                        <p class="tags"><?php the_tags('Tags | ', ', ', '<br />'); ?></p>
                        <?php edit_post_link( __('Edit Post', 'framework'), '<p>[', ']</p>' ); ?>
                        
                        <!-- Social Sharing Icons -->
                        <?php show_social_icons(get_permalink(),get_the_title()); ?>
                            
                       <div class="clear"></div>
                       
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
     
     <?php 
	 /* #Display Comments
	 ======================================================*/
	 comments_template('', true); 
	 ?>
     
    	<div class="divider full sidetop"></div>
	</div>  <!-- End Smallpage -->
      
        <?php endwhile; else :?>
        
        <!-- Else nothing found -->
        <div class="smallpage pagebg">
            <div class="contentwrap">
                <h2> <?php _e('Error 404 - Not found.', 'framework'); ?></h2>
                <p><?php _e("Sorry, but you are looking for something that isn't here.", 'framework'); ?></p>
            </div>
        </div>
        <div class="divider full sidetop"></div>
        
        <?php endif; ?>
        
<!-- Sidebar -->
    <div class="sidebar">
        <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Sidebar') ) ?>
    </div>
    
<!-- End Sidebar -->
    
    <div class="clear"></div>
    
</div>
<!-- End container -->

</div>
<!-- End contentarea -->
<?php get_footer(); ?>