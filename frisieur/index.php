<?php

   /**
    *
    * index.php file display latest
    * blog posts - it is default theme file
    * 
    * @author: Martanian <hello@martanian.com>
    *        
    */                    
    
    get_header();
    
    # if there is no posts
    if( !have_posts() ) {

?>
<section id="not-found">
                
    <h3><?php _e( 'Posts <span>not found</span>', 'martanian' ); ?></h3>
    <div class="header-line">
                                
        <div class="gray-line"></div>
        <div class="color-line"></div>
    
    </div>
    
    <p class="space"><?php _e( 'It looks like nothing was found here.', 'martanian' ); ?></p>
    <p><?php _e( 'Please try one of the links below or use this search form:', 'martanian' ); ?></p>
    
    <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                       
        <input type="text" placeholder="<?php _e( 'Type and hit enter...', 'martanian' ); ?>" value="<?php echo get_search_query(); ?>" name="s" id="search-form" />
     
    </form>

</section>
<?php

    # else if there are posts
    } else {

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
                    
                        <?php the_content( '' ); ?>
                                    
                    </div>
                    
                    <div class="actions">
                    
                        <a href="<?php the_permalink(); ?>" class="button button-brown"><i class="icon-file-alt"></i> Read more...</a>
                    
                    </div>
                
                </article>
                <?php 
            }
            
           /**
            *
            * end of blog posts
            * 
            */                                                                                              
        
        ?>
        
        <div id="blog-pagination">
                    
            <p class="left"><?php previous_posts_link( '&laquo; Newer posts' ); ?></p>
            <p class="right"><?php next_posts_link( 'Older posts &raquo;' ); ?></p>

            <div class="clear">
            </div>

        </div>
    
    </div>
    
    <?php get_sidebar(); ?>

    <div class="clear">
    </div>
    
</section>
<?php

    # end of posts
    }
    
    # getting footer
    get_footer();

?>