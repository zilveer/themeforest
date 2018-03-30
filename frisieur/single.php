<?php

   /**
    *
    * single.php file display single post
    * 
    * @author: Martanian <hello@martanian.com>
    *        
    */                    
    
    get_header();

?>
<section id="blog">

    <div id="content" class="waitForLoad fadeInRight">

        <?php
        
           /**
            *
            * blog posts
            * 
            */
            
            while( have_posts() ) {
            
                # initialize post
                the_post();
                
                # get post class
                $post_classes = implode( ' ', get_post_class() );
                
                ?>
                <article id="post-<?php the_ID(); ?>" class="blog-post <?php echo $post_classes; ?>">
                    
                    <?php 
                        
                        $images = martanian_get_post_images( get_the_ID() );
                        if( $images != false ) {
                        
                            echo '<div class="blog-post-images">';
                            for( $i = 0; $i < count( $images ); $i++ ) {
                            
                                echo '<img src="'. $images[$i] .'" class="blog-post-image" alt="'. __( 'Blog post featured image', 'martanian' ) .'" />';
                            }
                            
                            if( count( $images ) > 1 ) {
                            
                                echo '<div class="image-change image-change-right"><i class="icon-angle-right"></i></div>';
                                echo '<div class="image-change image-change-left"><i class="icon-angle-left"></i></div>';
                            }
                            
                            echo '</div>';
                        }
                    
                    ?>

                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="desc">

                        <span class="element"><i class="icon-comment"></i> <a href="#"><?php comments_popup_link( __( 'No comments jet', 'martanian' ), __( '1 comment', 'martanian' ), '% '. __( 'comments', 'martanian' ) ); ?></a></span>
                        <span class="divider">&middot;</span>
                        <span class="element"><i class="icon-user"></i> <?php the_author_posts_link(); ?></span>
                        <span class="divider">&middot;</span>
                        <span class="element"><i class="icon-reorder"></i> <?php the_category( ', ' ); ?></span>
                    
                    </div>
                    
                    <div class="header-line">
                            
                        <div class="gray-line"></div>
                        <div class="color-line"></div>
                    
                    </div>
                    
                    <div class="blog-post-content blog-post-little-content">
                    
                        <?php the_content(); ?>
                        
                        <?php 
                        
                            $args = array(
                            		'before' => '<div class="next-page-links"><span class="single-link">',
                            		'after' => '</div>',
                            		'link_before' => '',
                            		'link_after' => '',
                            		'next_or_number' => 'number',
                            		'separator' => ' ',
                            		'nextpagelink' => __( 'Next page', 'martanian' ),
                            		'previouspagelink' => __( 'Previous page', 'martanian' ),
                            		'pagelink' => '<span class="single-link">%</span>',
                            		'echo' => 1
                          	);
                            
                            wp_link_pages( $args );
                        
                        ?>
                                    
                    </div>
                    
                    <div class="blog-post-tags">
                        
                        <?php
                        
                            $tags = get_the_tags();
                            if( $tags != null && $tags != false ) {
                            
                                echo '<span class="blog-post-tags-title">Tags:</span>';
                                foreach( $tags as $tag ) {
                                
                                    echo '<a class="tag" href="'. home_url() .'/'. get_option( 'tag_base' ) .'/'. $tag -> slug .'/">'. $tag -> name .'</a>';
                                }
                            }
                        
                        ?>
                    
                    </div>
                    
                    <?php comments_template(); ?>
                
                </article>
                <?php 
            }
            
           /**
            *
            * end of blog posts
            * 
            */                                                                                              
        
        ?>
    
    </div>
    
    <?php get_sidebar(); ?>
    
    <div class="clear">
    </div>
    
</section>
<?php get_footer(); ?>