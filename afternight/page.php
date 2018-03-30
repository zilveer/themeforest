<?php
get_header(); 

    $no_feat_class = '';
    if( !options::logic( 'blog_post' , 'enb_featured' ) || !has_post_thumbnail( $post -> ID ) ){
        $no_feat_class = ' no_feat ';
    }

    $post_id = $post -> ID;
                    
      
    /*---------------------*/
    $post_format = get_post_format( $post -> ID );
    if(!strlen($post_format)){ $post_format = 'standard';}
?>

<section id="main">
    
    <?php echo get_my_search_form(); ?>

    <div class="main-container">    
        <?php
            while( have_posts () ){ 
                the_post();
                $meta = meta::get_meta( $post -> ID, 'settings' );
                $meta_enb = options::logic( 'blog_post' , 'meta' );             
            } /*EOF while( have_posts () ) */
        ?>
        <?php
            $resizer = new LBPageResizer('page');
            $resizer -> render_frontend();
        ?>
    </div>
</section>    
 
<?php get_footer(); ?>
