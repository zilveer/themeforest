<?php 
get_header();
the_post(); 
?>
 <div class="page_bg">
    <div class="container">
            <h2><?php $top_title = get_post_meta($post->ID, 'top_title', true); if($top_title != '') echo $top_title; else the_title();?></h2>
            <p class="singlemeta">
                <?php _e('Posted on', 'fffolio');?> 
                <?php the_time("d M Y");?> 
                <?php _e('in', 'fffolio');?> <?php the_category(', ') ?> | 
                <?php comments_popup_link(esc_html__('0 comments','fffolio'), esc_html__('1 comment','fffolio'), '% '.esc_html__('comments','fffolio')); ?>
            </p>
            <div class="single">
                  <?php the_content();?>
                  <?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','fffolio').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                  <div class="tags">
                     <?php the_tags(esc_attr('Tags: ', 'fffolio') . '<div class="button1">', '</div> <div class="button1">', '</div><br />'); ?> 
                  </div>
                  <?php 
                  edit_post_link(); 
                  comments_template('', true);?>
             </div>
    </div>
</div>
<?php get_footer();?>