<?php
/**
 * The main template file
 *
 * @package Evential
 * @subpackage Evential
 * @since Evential 1.0
 */
get_header();
?>
<?php 
	global $tlazya_evential; 
	if (isset($tlazya_evential['inner_url']['url']) && $tlazya_evential['inner_url']['url'] != '' ) { 
?>
<section id="top" class="innder-page" style="background: url(<?php echo esc_url($tlazya_evential['inner_url']['url']); ?>) no-repeat 0% 0%;">
<?php 
	}
	else 
	{
?>
<section id="top" class="innder-page" style="background: url(<?php echo get_template_directory_uri(); ?>/img/register-bg.png) no-repeat 0% 0%;">
<?php
	}
?>
        <div class="container">
            <div class="countdown">
                <div class="row">
					<?php
					if (is_front_page()) {
					?>
                        <div class="col-lg-8 col-lg-offset-2 text-center">
                            <h1 class="uppercase"><?php printf(__('Welcome to ', 'evential')); ?><?php bloginfo('name'); ?></h1>
                        </div>
					<?php } else { ?>
                        <div class="col-lg-8 col-lg-offset-2 text-center">
                            <h1 class="uppercase">
								<?php 
									global $tlazya_evential; 
									if ( isset( $tlazya_evential['blog_title'])  && $tlazya_evential['blog_title'] != ''  ) {
								?>
								<?php
									global $tlazya_evential;
									echo esc_html($tlazya_evential['blog_title']);
								?>
								<?php 
									}
									else 
									{
								?>
								<?php bloginfo('name'); ?>'s Blog
								<?php
									}
								?>
                            </h1>
                        </div>
					<?php } ?>
                </div><!--/ .row-->
            </div><!--/ .countdown-->
        </div><!--/ .container-->
</section>
<section id="about">
	<div class="container">
<?php
global $tlazya_evential;
switch ($tlazya_evential['blog_layout']) {
    case "3":
        ?>
                    <!-- sidebar -->
                    <div class="col-md-8 blog-all">
                    <?php
                    $ppp = get_option('posts_per_page', FALSE);
                    $posts = array(
                        'post_type' => array('post'),
                        'posts_per_page' => $ppp,
                        'post_status' => array('publish'),
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'paged' => get_query_var('paged') ? get_query_var('paged') : '1'
                    );
                    query_posts($posts);
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            $tags = wp_get_post_tags(get_the_ID());
                            $tag = '';
                            foreach ($tags as $t) {
                                $tag .= $t->name . ', ';
                            }
                            ?>
                                <?php
                                if (has_post_format('audio')) {
                                    ?>
                                    <article class="audio">
                                        <div class="blog-post-date">
                                    <?php echo get_post_meta($post->ID, "audio", true); ?>
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>

                    <?php
                } elseif (has_post_format('video')) {
                    ?>
                                    <article>
                                        <div class="blog-post-date">
                                            <div class="video-holder">
                                                <a class="video-link" href="<?php echo get_post_meta($post->ID, "video", true); ?>">
												<?php echo get_the_post_thumbnail(get_the_ID()); ?>
                                                </a>
                                            </div>
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>
                    <?php
                } elseif (has_post_format('image')) {
                    ?>
                                    <article>
                                        <div class="blog-post-date">
                                            <a href="<?php echo get_permalink(); ?>">
                    <?php
                    if (has_post_thumbnail()) {
                        echo get_the_post_thumbnail(get_the_ID());
                    } else {
                        echo '<img src="http://placehold.it/1090x817" alt="Uncle"/>';
                    }
                    ?>
                                            </a>
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>
									<?php
										} else {
									?>
                                    <article class="stand">
                                        <div class="blog-post-date">
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>
                    <?php
                }
                ?>
                <?php
            }
            ?>
                                    <?php
                                } else {
                                    get_template_part('content', 'none');
                                }

                                wp_reset_query();
                                ?>
                    </div> 
                    <!-- sidebar -->
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-right">
                        <?php dynamic_sidebar('main-sidebar'); ?>
                    </div>        
					
					
                    <?php break; case "2": ?>
					
					
                    <!-- sidebar -->
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <?php dynamic_sidebar('main-sidebar'); ?>
                    </div>
                    <!-- sidebar -->
                    <div class="col-md-8 blog-all pull-right">
                        <?php
                        $ppp = get_option('posts_per_page', FALSE);
                        $posts = array(
                            'post_type' => array('post'),
                            'posts_per_page' => $ppp,
                            'post_status' => array('publish'),
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'paged' => get_query_var('paged') ? get_query_var('paged') : '1'
                        );
                        query_posts($posts);
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                                $tags = wp_get_post_tags(get_the_ID());
                                $tag = '';
                                foreach ($tags as $t) {
                                    $tag .= $t->name . ', ';
                                }
                                ?>
                                <?php
                                if (has_post_format('audio')) {
                                    ?>
                                    <article class="audio">
                                        <div class="blog-post-date">
                                    <?php echo get_post_meta($post->ID, "audio", true); ?>
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>
                    <?php
                } elseif (has_post_format('video')) {
                    ?>
                                    <article>
                                        <div class="blog-post-date">
                                            <div class="video-holder">
                                                <a class="video-link" href="<?php echo get_post_meta($post->ID, "video", true); ?>">
													<?php echo get_the_post_thumbnail(get_the_ID()); ?>
                                                </a>
                                            </div>
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>
									<?php
										} elseif (has_post_format('image')) {
									?>
                                    <article>
                                        <div class="blog-post-date">
                                            <a href="<?php echo get_permalink(); ?>">
												<?php
												if (has_post_thumbnail()) {
													echo get_the_post_thumbnail(get_the_ID());
												} else {
													echo '<img src="http://placehold.it/1090x817" alt="Uncle"/>';
												}
												?>
                                            </a>
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>
                                                <?php
                                            } else {
                                                ?>
                                    <article class="stand">
                                        <div class="blog-post-date">
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
            <?php
        } else {
            get_template_part('content', 'none');
        }

        wp_reset_query();
        ?>
                    </div>        
        <?php break; case "1": ?> 

                    <!-- Blog Fullwidth -->
        <div class="col-md-12 blog-all">
        <?php
        $ppp = get_option('posts_per_page', FALSE);
        $posts = array(
            'post_type' => array('post'),
            'posts_per_page' => $ppp,
            'post_status' => array('publish'),
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => get_query_var('paged') ? get_query_var('paged') : '1'
        );
        query_posts($posts);
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $tags = wp_get_post_tags(get_the_ID());
                $tag = '';
                foreach ($tags as $t) {
                    $tag .= $t->name . ', ';
                }
                ?>
                            <?php
                            if (has_post_format('audio')) {
                                ?>
                                    <article class="audio">
                                        <div class="blog-post-date">
                                    <?php echo get_post_meta($post->ID, "audio", true); ?>
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>

                                    <?php
                                } elseif (has_post_format('video')) {
                                    ?>

                                    <article>
                                        <div class="blog-post-date">
                                            <div class="video-holder">
                                                <a class="video-link" href="<?php echo get_post_meta($post->ID, "video", true); ?>">
                                            <?php echo get_the_post_thumbnail(get_the_ID()); ?>
                                                </a>
                                            </div>
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>
                                    <?php
                                } elseif (has_post_format('image')) {
                                    ?>

                                    <article>
                                        <div class="blog-post-date">
                                            <a href="<?php echo get_permalink(); ?>">
											<?php
											if (has_post_thumbnail()) {
												echo get_the_post_thumbnail(get_the_ID());
											} else {
												echo '<img src="http://placehold.it/1090x817" alt="Uncle"/>';
											}
											?>
                                            </a>
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>
                                    <?php
										} else {
                                    ?>
                                    <article class="stand">
										<div class="blog-post-date">
											<?php
											if(has_post_thumbnail()) {
											?>
												<a href="<?php echo get_permalink();?>"><?php echo get_the_post_thumbnail(get_the_ID()); ?></a>
											<?php
											}
											else 
											{ 
											?>
												<div class="empty-image"></div>
											<?php 
											} 
											?>
											<div class="post-date">
												<p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
											</div>
										</div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>
									<?php
										}
									?>
                                    <?php
										}
                                    ?>
            <?php
        } else {
            get_template_part('content', 'none');
        }

        wp_reset_query();
        ?>
                    </div>        

<?php break; default: ?>   
   
                    <!-- Blog Fullwidth -->
                    <div class="col-md-12 blog-all">
        <?php
        $ppp = get_option('posts_per_page', FALSE);
        $posts = array(
            'post_type' => array('post'),
            'posts_per_page' => $ppp,
            'post_status' => array('publish'),
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => get_query_var('paged') ? get_query_var('paged') : '1'
        );
        query_posts($posts);
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $tags = wp_get_post_tags(get_the_ID());
                $tag = '';
                foreach ($tags as $t) {
                    $tag .= $t->name . ', ';
                }
                ?>
								<?php
									if (has_post_format('audio')) {
                                ?>
                                    <article class="audio">
                                        <div class="blog-post-date">
                                    <?php echo get_post_meta($post->ID, "audio", true); ?>
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>

                                    <?php
										} elseif (has_post_format('video')) {
                                    ?>

                                    <article>
                                        <div class="blog-post-date">
                                            <div class="video-holder">
                                                <a class="video-link" href="<?php echo get_post_meta($post->ID, "video", true); ?>">
                                            <?php echo get_the_post_thumbnail(get_the_ID()); ?>
                                                </a>
                                            </div>
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>
                                    <?php
                                } elseif (has_post_format('image')) {
                                    ?>

                                    <article>
                                        <div class="blog-post-date">
                                            <a href="<?php echo get_permalink(); ?>">
											<?php
											if (has_post_thumbnail()) {
												echo get_the_post_thumbnail(get_the_ID());
											} else {
												echo '<img src="http://placehold.it/1090x817" alt="Uncle"/>';
											}
											?>
                                            </a>
                                            <div class="post-date">
                                                <p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
                                            </div>
                                        </div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>
                                    <?php
										} else {
                                    ?>
                                    <article class="stand">
										<div class="blog-post-date">
											<?php
											if(has_post_thumbnail()) {
											?>
												<a href="<?php echo get_permalink();?>"><?php echo get_the_post_thumbnail(get_the_ID()); ?></a>
											<?php
											}
											else 
											{ 
											?>
												<div class="empty-image"></div>
											<?php 
											} 
											?>
											<div class="post-date">
												<p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
											</div>
										</div>
                                        <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                        <div class="entry-meta">
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> Comments</a></span>
                                            <span><a href="<?php echo get_permalink(); ?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
                                        </div>
                                        <p>
											<?php echo the_content(); ?>
                                        </p>
                                        <div class="button-holder">
                                            <a class="readmore le-btn" href="<?php echo get_permalink(); ?>">readmore</a>
                                        </div>
                                    </article>
                                    <div style="clear:both"></div>
                    <?php
                }
                ?>
                                        <?php
                                    }
                                    ?>
            <?php
        } else {
            get_template_part('content', 'none');
        }

        wp_reset_query();
        ?>
                    </div>        
		<?php } ?>
        </div>
    </section>

<?php
get_template_part('content-contact');
get_footer();
