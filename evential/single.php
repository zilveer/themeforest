<?php
/**
 * This Temaplate is display single post
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
				<div class="col-lg-8 col-lg-offset-2 text-center">
					<?php while(have_posts())
					{
						the_post();?>
					<h1 class="uppercase"><?php echo get_the_title(); ?></h1>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="about">
    <div class="container">
<?php
    global $tlazya_evential;
    switch($tlazya_evential['single_layout']) {
    case "3":
?>        
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 blog-all">
			<?php
				while ( have_posts() ) : the_post();
			?>
			<?php
				if ( has_post_format( 'audio' ))
				{
			?>
            <article class="audio">
				<div class="blog-post-date">
					<?php echo get_post_meta($post->ID, "audio", true); ?>
					<div class="post-date">
						<p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
					</div>
				</div>
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
				elseif ( has_post_format( 'video' ))
				{
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
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
				elseif ( has_post_format( 'image' ))
				{
			?>
			
			<article>
				<div class="blog-post-date">
					<a href="<?php echo get_permalink();?>">
						<?php
							if(has_post_thumbnail()) {
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
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
				else
				{
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
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
			?>
			<?php
				endwhile;
			?>
        </div>
        <!-- sidebar -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-right">
            <?php dynamic_sidebar( 'main-sidebar' ); ?>
        </div> 
		
        <?php break; case "2": ?>
		
        <!-- sidebar -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <?php dynamic_sidebar( 'main-sidebar' ); ?>
        </div> 
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 blog-all pull-right">
			<?php
				while ( have_posts() ) : the_post();
			?>
			<?php
				if ( has_post_format( 'audio' ))
				{
			?>
            <article class="audio">
				<div class="blog-post-date">
					<?php echo get_post_meta($post->ID, "audio", true); ?>
					<div class="post-date">
						<p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
					</div>
				</div>
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
				elseif ( has_post_format( 'video' ))
				{
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
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
				elseif ( has_post_format( 'image' ))
				{
			?>
			
			<article>
				<div class="blog-post-date">
					<a href="<?php echo get_permalink();?>">
						<?php
							if(has_post_thumbnail()) {
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
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
				else
				{
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
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
			?>
			<?php
				endwhile;
			?>
        </div>
		
<?php break; case "1": ?> 

        <!-- Blog Fullwidth -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog-all">
			<?php
				while ( have_posts() ) : the_post();
			?>
			<?php
				if ( has_post_format( 'audio' ))
				{
			?>
            <article class="audio">
				<div class="blog-post-date">
					<?php echo get_post_meta($post->ID, "audio", true); ?>
					<div class="post-date">
						<p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
					</div>
				</div>
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
				elseif ( has_post_format( 'video' ))
				{
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
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
				elseif ( has_post_format( 'image' ))
				{
			?>
			
			<article>
				<div class="blog-post-date">
					<a href="<?php echo get_permalink();?>">
						<?php
							if(has_post_thumbnail()) {
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
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
				else
				{
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
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
			?>
			<?php
				endwhile;
			?>
        </div>        
		
        <?php break; default: ?> 
		
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 blog-all">
			<?php
				while ( have_posts() ) : the_post();
			?>
			<?php
				if ( has_post_format( 'audio' ))
				{
			?>
            <article class="audio">
				<div class="blog-post-date">
					<?php echo get_post_meta($post->ID, "audio", true); ?>
					<div class="post-date">
						<p><?php echo get_the_date('j'); ?><span><?php echo get_the_time('M'); ?></span></p>
					</div>
				</div>
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
				elseif ( has_post_format( 'video' ))
				{
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
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
				elseif ( has_post_format( 'image' ))
				{
			?>
			
			<article>
				<div class="blog-post-date">
					<a href="<?php echo get_permalink();?>">
						<?php
							if(has_post_thumbnail()) {
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
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
				else
				{
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
				<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="entry-meta">
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author();?></a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> Comments</a></span>
					<span><a href="<?php echo get_permalink();?>"><i class="fa fa-list"></i> <?php the_category(' '); ?></a></span>
				</div>
				<p>
					<?php echo the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'reorder' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'reorder' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) ); ?>
				</p>
            </article>
			<div style="clear:both"></div>
			<section id="comments">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</section>
			<?php
				}
			?>
			<?php
				endwhile;
			?>
        </div>
        <!-- sidebar -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-right">
            <?php dynamic_sidebar( 'main-sidebar' ); ?>
        </div> 
		
        <?php } ?>  
    </div>
</section>

<?php
get_footer();
