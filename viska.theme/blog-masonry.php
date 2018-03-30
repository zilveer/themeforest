<?php
/*
Template Name: Blog Masonry
*/
?>
<?php
$customize = get_options();
if($customize == ''){
    global $options_extra;
    $customize = $options_extra;
}
$is_customize_mode =  (has_action( 'customize_controls_init' )) ? true : false;
?>

<?php 
get_header(); 
$page_id = get_the_ID(); 

if ( apply_filters('awe_is_blog_header', $page_id) )
{
    get_template_part('section','introduction-blog');
}
?>
<!-- Main -->
    <div id="main">
        <!-- Content Blog -->
            <div id="content-blog">
                <div class="container">
                    <div class="row">
                        <div class="blog-grid blog-item">
                        <?php 
                            
                        	$post_per_page =(get_option('posts_per_page '))?get_option('posts_per_page '):5;
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            query_posts('post_type=post&posts_per_page='.$post_per_page.'&showposts='.$post_per_page.'&paged='.$paged );
                            if(have_posts()) :
                            	while(have_posts()) : the_post();
                            	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),false,false );
                        ?>
                            <div class="col col-xs-6 col-md-4">
                                <div class="inner">
                                <?php
                                	
                                	switch (get_post_format()) {
                                	 	case 'image': ?>
                                            <?php if(has_post_thumbnail()) : ?>
                                    	 	<div class="head head-image">
                                                <img src="<?php echo $thumb[0]; ?>" alt="<?php the_title(); ?>">
                                                <a class="link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </div>
                                            <?php endif; ?>
                                            <div class="blog-title">
                                                <span class="fa fa-picture-o"></span>
                                    	 	<?php
                                	 		break;
                                	 	case 'gallery': 
                                            $gallery = get_post_meta($post->ID,'gallery',true);
                                            if(isset($gallery) && is_array($gallery)):
                                            ?>
                                    	 	<div class="head head-gallery">
                                                <div class="owl-item-masonry">
                                                <?php 
                                                
                                                    foreach ($gallery as $value) {
                                                        echo '<div class="item"><img src="'.$value.'" alt="post-gallery"></div>';
                                                    }
                                                ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div class="blog-title">
                                                <span class="fa fa-picture-o"></span>
                                	 	    <?php
                                	 		break;
                                	 	case 'video': ?>
                                    	 	
                                            <?php if(has_post_thumbnail()) : ?>
                                                <div class="head head-video">
                                                    <img src="<?php echo $thumb[0]; ?>" alt="<?php the_title(); ?>">
                                                    <a class="link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="blog-title">
                                                <span class="fa fa-file-video-o"></span>
                                    	 	<?php
                                    	    break;
                                    	case 'audio': ?>
                                            <?php if(has_post_thumbnail()) : ?>
                                    	 	    <div class="head head-audio">
                                                    <img src="<?php echo $thumb[0]; ?>" alt="<?php the_title(); ?>">
                                                    <a class="link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </div>
                                            <?php endif; ?>
                                             <div class="blog-title">
                                                <span class="fa fa-music"></span>
                                    	 	<?php
                                	 		break;
                                	 	case 'quote': ?>
                                    	 	<div class="blog-quote">
                                                <blockquote>
                                                <?php $quote = get_post_meta($post->ID,'quote',true);
                                                if(isset($quote['text'])){
                                                    echo stripslashes($quote['text']);
                                                }
                                                ?>
                                                </blockquote>
                                                <span><?php if(isset($quote['source'])) echo stripcslashes($quote['source']); ?></span>
                                            </div>
                                            <div class="blog-title">
                                                <span class="fa fa-quote-right"></span>
                                    	 	<?php
                                	 		break;
                                	 	case 'link': ?>
                                    	 	<div class="blog-link">
                                                <a href="<?php the_permalink(); ?>">
                                                    <span class="fa fa-link"></span>
                                                    <?php
        								            $link=get_post_meta(get_the_ID(),'link',true);
        								            ?>
        								            <?php if(isset($link['anchor']) && !empty($link['anchor'])):?>
                                                    <p>
                                                        <?php echo $link['anchor'];?>
                                                    </p>
                                                    <?php endif;?>
                                                </a>
                                            </div>
                                             <div class="blog-title">
                                                <span class="fa fa-link"></span>
                                    	 	<?php
                                	 		break;
                                	 	
                                	 	default: ?>
                                            <?php if(has_post_thumbnail()) : ?>
                                	 		    <div class="head head-image">
                                                    <img src="<?php echo $thumb[0]; ?>" alt="<?php the_title(); ?>">
                                                    <a class="link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="blog-title">
                                                <span class="fa fa-photo"></span>
                                            <?php
                                	 		break;
                            		};
                                ?>
								        <h2 title="<?php the_title(); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								        <ul>
								            <li>
								                <?php echo get_the_date(); ?>
								            </li>
								            <li>
								            <?php $author = get_the_author();
								            __('by',LANGUAGE); echo ' '.$author;
								            ?>
								            </li>
								            <li>
								                <?php comments_number( _e('No comment',LANGUAGE), __('1 comment',LANGUAGE), __('% comments',LANGUAGE) ); ?>
								            </li>
								        </ul>
								    </div>
								    <div class="blog-descript">
								        <?php do_action('awe_post_content'); ?>
								    </div>

                                </div>
                            </div>
                        <?php endwhile; endif; ?>
                            
                        </div>
                        <input type="hidden" value="<?php echo $page_id; ?>" class="js_page_id">
                        <div id="loadmore"><a id="load" href="#">Load more</a></div>
                    </div>
                </div>
            </div>
        <!-- End Content Blog -->
    </div>
    <!-- ENd Main -->
<?php get_footer(); ?>