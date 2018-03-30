<?php
/**
 * @package sellya Sport
 * @subpackage sellya_sport
 */
get_header();

global $post;

$post_type = $post->post_type;
?>

<section id="midsection" class="container">
    <div class="row">
        <?php get_blogleftbar(); ?>
        <div class="span9" id="content">
            <div class="row-fluid">
                <div class="blog single-post">        
                    <?php while (have_posts()) : the_post(); ?>
                        <div <?php post_class('span12'); ?>>
                            <?php
                            if (is_single()) :

                                $cats = get_categories();
                                ?>

                                <h2 class="blog_title"><?php the_title(); ?></h2>
                            <?php else : ?>
                                <h2 class="entry-title">
                                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'sellya'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a>
                                </h2>

                            <?php endif; // is_single()  ?>
                            <div class="entry-meta span12">
                                <?php
                                $cats = get_the_category();
                                if (!empty($cats)):

                                    echo '<i class="icon-tag"></i>&nbsp;';

                                    foreach ($cats as $c => $cat):

                                        if ($c > 0)
                                            echo ', ';
                                        ?>
                                        <a href="<?php echo get_category_link($cat->term_id) ?>" rel="category tag"><?php echo $cat->name ?></a>
                                        <?php
                                    endforeach;
                                endif;

                                $arch_day = get_the_time('d');

                                $arch_mon = get_the_time('m');

                                $arch_year = get_the_time('Y');

                                $day_link = get_day_link($arch_year, $arch_mon, $arch_day);
                                ?>&nbsp;<i class="icon-calendar"></i>&nbsp;<a href="<?php echo $day_link ?>" rel="bookmark"><?php echo get_the_date(); ?></a>&nbsp;&nbsp;<span class="by-author"><i class="icon-user"></i>&nbsp;<a href="<?php echo get_the_author_meta('user_url') ?>" rel="author"><?php the_author(); ?></a></span>&nbsp;&nbsp;<span><?php comments_popup_link(__('<i class="icon-comments"></i> No comments', 'sellya'), __('<i class="icon-comment-alt"></i> 1 comment', 'sellya'), __('<i class="icon-comments-alt"></i> % comments', 'sellya'), '', __('<i class="icon-lock"></i> Comments off', 'sellya')) ?></span>.	

                            </div>

                        </div><!--.span12 -->
                        <?php 
                        if(has_post_thumbnail()):
                        ?>
                        <div class="image span12">
                            <a class="list-image" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sellya' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail('blog-post-img'); ?></a><br /><br />                        	
                        </div>
                        <?php
                        endif;
                        ?>
                        <div class="span12">
    <?php
    the_content();
    wp_link_pages(array('before' => '<div class="post_paginate">' . __('Pages:&nbsp;', 'sellya'), 'after' => '</div>', 'next_or_number' => 'number', 'nextpagelink' => '<span class="next">Next &raquo;</span>', 'previouspagelink' => '', 'link_before' => '<span>', 'link_after' => '</span>'));
    ?>

                        </div>
                        <div class="span12">
                            <div class="entry-meta span12 ">
    <?php
    $tags = get_the_tags(get_the_ID());
    if (!empty($tags)):
        ?>                                
                                    <div class="tag-section single_post_tags">
                                        <i class="icon-tags"></i>&nbsp;
                                    <?php
                                    $t = 0;

                                    foreach ($tags as $tag):

                                        if ($t > 0)
                                            echo ", ";
                                        ?>
                                            <a rel="tag" href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo ucfirst($tag->name); ?></a>


                                            <?php
                                            $t++;

                                        endforeach;
                                        ?>
                                        <br>
                                    </div>
                                    <?php endif; ?>
                            </div>  

                        </div><!--.span12 -->
                        <div class="clear"></div>

<?php endwhile; // end of the loop.  ?>
                </div><!--.blog -->			

                <div class="clear"></div>

<?php
if ($post_type == 'post'):
    // If a user has filled out their description, show a bio on their entries.
    if (get_the_author_meta('description')) :
        ?>
                        <div class="span12 span-first-child">
                        <?php
                        $related = array();

                        if (!empty($cats)):

                            foreach ($cats as $cat):

                                $args = array('category' => $cat->term_id, 'posts_per_page' => -1);

                                $p1 = get_posts($args);

                                foreach ($p1 as $p):

                                    if ($p->ID != $post->ID)
                                        $related[] = $p->ID;

                                endforeach;

                            endforeach;


                            $args = array("showposts" => 3, 'post__in' => $related);

                            $q = new WP_Query($args);

                            if ($q->have_posts()):

                                $i = 0;
                                /* Start the Loop */
                                while ($q->have_posts()) : $q->the_post();
                                    ?>

                                        <?php $eclass = $i % 3 == 0 ? ' span-first-child' : '' ?>

                                        <div class="span4<?php echo $eclass ?>">

                                            <div class="span12">
                                                <div class="image_related"  >
                                                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">

                    <?php the_post_thumbnail(array(211, 124)); ?>

                                                    </a>   
                                                </div>                         
                                                <div class="span12">

                                                    <h2 class="blog_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>                              
                                                </div> <!--.span5 -->                                   
                                            </div><!--.image -->						
                                        </div>	<!--.span -->

                    <?php
                    $i++;
                endwhile;

            endif;
            wp_reset_query();
        endif;
        ?>

                        </div>
                        <div class="span12 span-first-child author-info">
                            <div class="v-card gray">
                                <div class="v-image">
                            <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('sellya_author_bio_avatar_size', 80)); ?>
                                </div><!-- .author-avatar -->
                                <div class="v-details">
                                    <h5><?php printf(__('About %s', 'sellya'), get_the_author()); ?></h5>
        <?php the_author_meta('description'); ?>
                                </div><!-- .author-description	-->
                            </div><!-- .author-info -->
                        </div>
    <?php
    endif;
endif;
?>	
                <div class="nav-links span12 span-first-child">

                <?php previous_post_link('%link', _x('<i class="icon-circle-arrow-left"></i> %title', 'Previous post link', 'sellya')); ?>
                <?php next_post_link('%link', _x('%title <i class="icon-circle-arrow-right"></i>', 'Next post link', 'sellya')); ?>

                </div><!-- .nav-links -->

                <div class="clear"></div>

<?php comments_template(); ?>

            </div><!--.row-fluid -->
        </div><!--#content -->

    </div><!--.row -->
</section><!--.container -->
<?php get_footer(); ?>