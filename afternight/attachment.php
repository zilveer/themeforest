<?php get_header(); ?>
<section class="b_content clearfix" id="main">
    <?php

            global $post;
            while( have_posts () ){
                the_post();
                $meta = meta::get_meta( $post -> ID, 'settings' );
                $meta_enb = options::logic( 'blog_post' , 'meta' );  
                $post_id = $post -> ID
                ?>
                <div class="row" id="article-title">
                    <div class="twelve columns">
                        <div class="single-title-container ">
                            <?php if(options::logic( 'likes' , 'enb_likes' )){ ?>
                            <div class=" <?php if( options::logic( 'likes' , 'enb_likes' )) echo 'title-left'; else  echo 'hidden'; ?> <?php if( !( options::logic( 'likes' , 'enb_likes' ) &&  meta::logic( $post , 'settings' , 'love' ) ) ){ echo 'no-likes'; } ?>" >
                                <?php if( options::logic( 'likes' , 'enb_likes' ) ){ 
                                    like::content($post->ID,2,$return = false); 
                                } ?>  
                            </div>
                            <?php } ?>
                            <div class="the-title">
                                <div class="single-title-delimiter">
                                    <h2 class="single-title"><?php the_title(); ?></h2>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>                
            <?php } ?>
      <?php function show_attachments(){
            global $post;
            while( have_posts () ){
                the_post();
                $post_id = $post -> ID
                ?>
                <div class="featimg"   >
                    <div class="img">
                        <?php
                        $img_src = wp_get_attachment_image_src(  $post_id  , 'tmedium' );
                        echo '<img src="'.$img_src[0].'" alt="" />';


                        ?>
                    </div>
                </div>
            <?php
            }
        }
    $layout = new LBSidebarResizer( 'attachment' );
    $layout -> render_frontend( 'show_attachments' );
    ?>
</section>
<?php get_footer(); ?>