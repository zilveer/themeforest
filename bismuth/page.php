<?php
get_header();
the_post(); 
$fullwidth = get_post_meta($post->ID, '_page_fullwidth', true);
?>
 <div class="bg" style="text-align: left">
    <div class="container">
        <div class="sixteen columns">
            <div class="headline">
                    <h2>
                        <span class="lines">
                            <?php $top_title = get_post_meta($post->ID, 'top_title', true); 
                            if($top_title != '') 
                                echo $top_title; 
                            else the_title();?>
                        </span>
                    </h2>
                     <p class="singlemeta">
                        <?php _e('Posted on', 'LB');?> 
                        <?php the_time("d M Y");?> 
                        <?php comments_popup_link(esc_html__('0 comments','LB'), esc_html__('1 comment','LB'), '% '.esc_html__('comments','LB')); ?>
                    </p>
            </div>
        </div>
        <!-- start sixteen columns -->
        <div class="<?php if($fullwidth == 2) echo 'eleven'; else echo 'sixteen';?> columns">
            <div class="single">
                  <?php the_content();?>
                  <?php 
                  edit_post_link(); 
                  comments_template('', true);?>
             </div>
        </div>

        <!-- start sidebar -->
        <div class="five columns sidebar">
            <?php 
            if($fullwidth == 2) 
                dynamic_sidebar("Right sidebar");
            ?>
        </div>
        <!-- end sidebar -->
    </div>
</div>
<?php get_footer();?>