<?php
/**
 * The template for displaying image attachments.
 *
 */
 
get_header();
    if (isset($bk_option)):
        $share_box = $bk_option['bk-sharebox-sw'];
        $fb_share = $bk_option['bk-fb-sw'];
        $tw_share = $bk_option['bk-tw-sw'];
        $gp_share = $bk_option['bk-gp-sw'];
        $pi_share = $bk_option['bk-pi-sw'];
        $tbl_share = $bk_option['bk-tbl-sw'];
        $li_share = $bk_option['bk-li-sw'];
        $su_share = $bk_option['bk-su-sw'];
        $authorbox_sw = $bk_option['bk-authorbox-sw'];
        $related_sw = $bk_option['bk-related-sw'];
        $rtl = $bk_option['bk-rtl-sw'];
        $single_feat = $bk_option['bk-single-feat'];
    endif;
    $bk_related_num = 3;
?>
    <?php if ($single_feat) {?>
    <div class="fullwidth-section">
    <?php $args = array('title' => '', 'category' => 'feat', 'style' => 'thumb', 'entries_display' => 6, 'speed' => 4000, 'autoplay' => 'off');
    the_widget( 'bk_carousel',$args ); 
    ?> 
    </div>
    <?php } ?>
    
    <div class="content has-sidebar">
<?php if (have_posts()) : while (have_posts()) : the_post();     
            if (get_the_title()): ?>
        	<h1 class="post-title post-title-single"><?php the_title(); ?></h1>
        <?php else: ?>
        	<h1 class="post-title post-title-single"><?php _e('Untitled','bkninja'); ?></h1>
        <?php endif; ?>
        
        <div class="post-meta post-meta-single">
        	
            <div class="post-meta post-meta-primary">                   
                    
                <?php $author_display_name = get_the_author_meta( 'display_name' );
                        $bk_author_id = $post->post_author;
                printf('<div class="author" itemprop="author" >%s</div>', '<a rel="author" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" title="'.sprintf(__('Posts by %s','bkninja'), $author_display_name).'">'.$author_display_name.'</a>') ?>
                                                         
                <time class="article-time" datetime="<?php the_time('c'); ?>">
                     <?php printf(__('| %s', 'bkninja'),get_the_time(__('j F, Y \a\t H:i', 'bkninja'))); ?>
                </time>					   
			</div>
            
        </div>
        <br/>
    <article <?php post_class('post-article'); ?> >        
        <section class="article-content">
                <div class="attachment">
                    <?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "large"); ?>

                    <a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo $att_image[0];?>" class="attachment-medium" alt="<?php the_title(); ?>" /></a>
                    
                    <?php else : ?>
                    
                    <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
                    
                    <?php endif; ?>
                </div><!-- .attachment -->
    
                <?php if ( ! empty( $post->post_excerpt ) ) : ?>
                <div class="entry-caption">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-caption -->
                <?php endif; ?>
        </section>
    </article>    
    <?php 
			$tags = get_the_tags();
            if ($tags): ?>
            <div class="tag-list">
                <span><?php _e('Tags', 'bkninja') ?></span>
                <?php
					foreach ($tags as $tag):
						echo '<a class="tag-btn" href="'. get_tag_link($tag->term_id) .'" title="'. esc_attr(sprintf(__("View all posts tagged %s",'bkninja'), $tag->name)) .'">'. $tag->name.'</a>';
					endforeach;
                ?>
            </div>
	<?php endif; ?>
    
    <?php if ($share_box) bk_share_box($fb_share,$tw_share,$gp_share,$pi_share,$tbl_share,$li_share,$su_share);?>

<?php if ($authorbox_sw) echo bk_author_details($bk_author_id); ?>

<?php if ($related_sw) echo (bk_related_posts($bk_related_num));?>

<?php comments_template(); ?>

<?php endwhile; endif; ?>

    </div> <!-- main-content -->
    
    <?php get_sidebar(); ?>        

<?php get_footer();?>