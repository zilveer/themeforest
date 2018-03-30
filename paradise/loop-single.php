				<!-- Start Post -->
				<div class="post">
					<!-- Start Post Title -->
					<div class="post_title_wrap">
						<!-- Start Post Date -->
						<div class="post_date">
							<span class="day"><?php echo get_the_date('d'); ?></span>
							<span class="month"><?php echo get_the_date('M'); ?></span>
						</div>
						<div class="post_title">
							<!-- Posted When, Where &amp; Comments -->
							<div class="posted">
								<div class="alignright"><a href="<?php echo get_comments_link(); ?>" title="<?php comments_number(); ?>"><?php comments_number(); ?> &raquo;</a></div>
								<?php _e('Posted By:', TEMPLATENAME); ?>&nbsp;<?php printf('<a href="%1$s" title="%2$s">%3$s</a>', get_author_posts_url(get_the_author_meta('ID')), sprintf(esc_attr__('View all posts by %s', TEMPLATENAME), get_the_author()), get_the_author()); ?>&nbsp;<?php _e('on', TEMPLATENAME); ?>&nbsp;<?php echo get_the_time('M d, Y'); ?>&nbsp;<?php _e('in', TEMPLATENAME); ?>&nbsp;<?php if (count(get_the_category())): ?><?php echo get_the_category_list(', '); ?><?php endif; ?>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<!-- End Post Title -->
					<?php if(has_post_thumbnail()): ?>
					<!-- Post Thumbnail -->
					<div class="post_thumb"><?php the_post_thumbnail('blog', array('title' => false, 'class' => 'pic')); ?></div>
					<!-- End Post Thumbnail -->
					<?php endif; ?>
					<!-- Post Content -->
					<?php the_content(); ?>
					<!-- End Post Content -->
				</div>
				<!-- End Post -->
				<?php if (get_option('show_about_autor', true)): ?>
				<!-- Start Author Box -->
				<div class="author_box">
					<div class="vcard">
						<?php echo get_avatar(get_the_author_ID(), 80) ?>
					</div>
					<div class="author_content">
						<h3><a href="<?php the_author_url(); ?> "><?php the_author(); ?></a></h3>
						<?php the_author_description(); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="hr"></div>
				<!-- End Author Box -->
				<?php endif; ?>
				<?php comments_template(); ?>
