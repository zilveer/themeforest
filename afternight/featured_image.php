<?php
global $portfolio_display;
$zoom = false; 

if( options::logic( 'blog_post' , 'enb_featured' ) ){
    if ( has_post_thumbnail( $post -> ID ) && get_post_format( $post -> ID ) != 'video' ) {
        $src        = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
        $src_       = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
        $caption    = image::caption( $post -> ID );
        $zoom       = true;
    }
}
    
if( options::logic( 'blog_post' , 'enb_featured' ) && ( has_post_thumbnail( $post -> ID ) )  ){
    if (get_post_type() == 'page' || ( (get_post_type() == 'post' || get_post_type() == 'event' || get_post_type() == 'portfolio') && (meta::logic( $post , 'settings' , 'featured' ) || !sizeof(meta::get_meta( $post -> ID , 'settings' )) ) )) {
?>

    <div class="featimg">
        <?php if(get_post_format( $post -> ID ) != 'video' && get_post_format( $post -> ID ) != 'gallery') echo '<div class="featbg">'; ?>
                <?php $caption = get_post(get_post_thumbnail_id($post -> ID))->post_excerpt; ?>

                <?php if ( ( has_post_thumbnail( $post -> ID ) || get_post_format($post->ID)=="gallery" ) && get_post_format( $post -> ID ) != 'video' ) {
                        $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
                        if( options::logic( 'blog_post' , 'use_cropp_on_single' ) && (!isset($portfolio_display) || (isset($portfolio_display) && $portfolio_display != 'portrait') ) ){
                            $featimg_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'single_crop' );    
                        }else{
                            $featimg_src = $src;
                        }
                        

                        $size = 'tlist_tlarge'; 

                        if( get_post_format($post->ID)=="gallery" ){
                            /* for gallery posts we will show a slidedhow if there are more than 1 images  */
                            ob_start();
                            ob_clean();
                            post::get_post_img_slideshow( $post -> ID, $size );
                            $single_slideshow = ob_get_clean();
                        }

                        if(isset($single_slideshow) && strlen($single_slideshow)){
                            echo $single_slideshow;
                        }else{ /*we show featured image only when */
                ?>          
                        

                                <?php
                                    echo '<img src="' . $featimg_src[0] . '" alt="' . $caption . '" />';
                                ?>

                                <?php if($zoom && options::logic( 'blog_post' , 'enb_lightbox' )){ ?>
                                    <div class="zoom-image">
                                        <a href="<?php echo $src_[0]; ?>" data-rel="prettyPhoto-<?php echo $post -> ID; ?>" title="<?php echo  $post -> post_title;  ?>">&nbsp;</a>
                                    </div>
                                <?php } ?>    

                                <div class="format">&nbsp;</div>
                                <?php if (options::logic('styling', 'stripes')) { ?>
                                    <div class="stripes">&nbsp;</div>
                                <?php } ?>
                            
                               
                        
                <?php
                        } /*EOF if exists single slideshow*/
                    }else if(get_post_format( $post -> ID ) == 'video'){

                        render_featured_video($post);
                        
                    }
            ?> 
        <?php
            if(isset($caption) && strlen($caption) && (get_post_format( $post -> ID ) != 'gallery' && get_post_format( $post -> ID ) != 'video' ) ){
                echo '<div class="post-caption">'.$caption.'</div>';
            }
        ?>       
        <?php if(get_post_format( $post -> ID ) != 'video' && get_post_format( $post -> ID ) != 'gallery') echo '</div>'; ?>
    </div>

<?php
    }
}else if(get_post_format( $post -> ID ) == 'video'){
    /*this is the case when featurem image does not exist or is disable but there still is featured video*/

    render_featured_video($post);
}

?>