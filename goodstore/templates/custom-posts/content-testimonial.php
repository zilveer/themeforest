<?php global $jaw_data; ?>

<article id="testimonial-<?php the_ID(); ?>"  <?php post_class(array('element', 'col-lg-4','content-testimonial')); ?>   >
    <div class="box ">

        <div id="" class="<?php echo jaw_template_get_var('type'); ?> row" >
            <div class="author_block col-lg-4">
                <div class="author_info">
                    <div class="author_image">
                        <?php $img = json_decode(get_post_meta(get_the_ID(),'_testimontial_photo',true));
                            if (is_array($img)) {
                             
                                echo wp_get_attachment_image($img[0]->id, 'woo-size-square');
                            }
                         ?>
                    </div>
                    <div class="author_name"  itemprop="name">
                        <span class="">
                            <?php echo get_the_title(); ?>
                        </span>
                    </div>
                    <div class="author_position">
                        <span class="">
                            <?php 
                                echo get_post_meta(get_the_ID(),'_testimontial_possition',true);                           
                            ?>
                        </span>                        
                    </div>
                </div>
                <div class="author_desc">
                    <div class="author_arrow"><span class="icon-arrow-left2"></span></div>
                    <p><?php echo get_the_excerpt(); ?></p>
                </div>
                <div class="clear"></div>
            </div>
        </div><!-- End admin-info row -->

    </div>
</article>