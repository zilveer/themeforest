<?php
/**
* Template Name: FullWidth Page
*/
get_header(vibe_get_header());

if ( have_posts() ) : while ( have_posts() ) : the_post();

    $v_add_content = get_post_meta( $post->ID, '_add_content', true );
 
?>
<section id="content">
    <div class="<?php echo $v_add_content;?> content">
        <?php
            the_content();
            $page_comments = vibe_get_option('page_comments');
            if(!empty($page_comments))
                comments_template();
         ?>
    </div>
           
</section>
<?php
endwhile;
endif; 
?>
<?php
get_footer( vibe_get_footer() );