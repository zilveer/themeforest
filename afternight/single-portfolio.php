<?php
get_header(); 

$post_layout = meta::get_meta( $post -> ID , 'layout' ); 
    
    $no_feat_class = '';
    if( !options::logic( 'blog_post' , 'enb_featured' ) || !has_post_thumbnail( $post -> ID ) ){
        $no_feat_class = ' no_feat ';
    }

    $post_id = $post -> ID;
                    
    /*---------------------*/
    $post_format = get_post_format( $post -> ID );
    if(!strlen($post_format)){ $post_format = 'standard';}

    $post_meta = meta::get_meta( $post -> ID, 'settings' );

    if(isset($post_meta['portfolio_display'])){
        $portfolio_display = $post_meta['portfolio_display'];
    }else{
        $portfolio_display = options::get_value(  'blog_post' , 'portfolio_display' );
    }
?>

<section id="main">
    
    <?php echo get_my_search_form(); ?>

    <div class="main-container">    
        <?php
            while( have_posts () ){ 
                the_post();
        ?>
        
        <?php
            } /*EOF while( have_posts () ) */
        ?>
        <?php
            $resizer = new LBPageResizer('portfolio');
            $resizer -> render_frontend();
        ?> 
    </div>
</section>    

<?php get_footer(); ?>
