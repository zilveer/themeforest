<?php
/**
 * Template Name: Blog Left
 *
 * @package LeCorpo
 * @subpackage LeCorpo
 * @since LeCorpo 1.0
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
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <?php 
						while (have_posts()) {
                        the_post();
                    ?>
                        <h1 class="uppercase"><?php echo get_the_title(); ?></h1>
					<?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="about">
    <div class="container">
        <!-- sidebar -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <?php dynamic_sidebar( 'main-sidebar' ); ?>
        </div>
        <!-- blog post -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 blog-all blog-right pull-right">
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
								<?php echo substr(get_the_content(), 0, 200); ?>
                            </p>
                            <div class="button-holder">
                                <a class="button button-big button-dark" data-scroll href="<?php echo get_permalink();?>">readmore</a>
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
                            <p> <?php echo substr(get_the_content(), 0, 200); ?> </p>
                            <div class="button-holder">
                                <a class="button button-big button-dark" data-scroll href="<?php echo get_permalink();?>">readmore</a>
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
                            <p> <?php echo substr(get_the_content(), 0, 200); ?> </p>
                            <div class="button-holder">
                                <a class="button button-big button-dark" data-scroll href="<?php echo get_permalink();?>">readmore</a>
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
                            <p> <?php echo substr(get_the_content(), 0, 200); ?> </p>
                            <div class="button-holder">
                                <a class="button button-big button-dark" data-scroll href="<?php echo get_permalink();?>">readmore</a>
                            </div>
                        </article>
                        <div style="clear:both"></div>
				<?php
				}
				?>
				<?php
				}
				?>
                <div class="pagination">
				<?php
				if (function_exists("pagination")) {
					pagination($wp_query->max_num_pages);
				}
				?>
                </div>
                <?php
				} else {
					get_template_part('content', 'none');
				}

				wp_reset_query();
				?>
        </div>         
        <div class="own_navigation">
            <div class="alignleft"><?php posts_nav_link('', '', '&laquo; Previous Entries'); ?></div>
            <div class="alignright"><?php posts_nav_link('', 'Next Entries &raquo;', ''); ?></div>
        </div>       
    </div>
</section>

<?php
get_footer();
            