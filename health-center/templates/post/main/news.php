<?php if(isset($post_data['media'])): ?>
	<div class="thumbnail">
		<?php if(has_post_format('image') && !$show_content): ?>
			<a href="<?php the_permalink() ?>" title="<?php the_title_attribute()?>">
		<?php endif ?>
				<?php echo $post_data['media']; ?>
		<?php if(has_post_format('image') && !$show_content): ?>
			</a>
		<?php endif ?>
	</div>
<?php endif; ?>

<?php if($show_content): ?>
	<div class="post-content-wrapper">
		<?php include locate_template('templates/post/header.php'); ?>

		<div class="post-actions-wrapper">
			<div class="post-date">
				<?php the_time(get_option('date_format')); ?>
			</div>
			<?php if ( ! post_password_required() ): ?>
				<?php if ( wpv_get_optionb( 'meta_comment_count' ) && comments_open() ): ?>
					<div class="comment-count">
						<?php
							$comment_icon = '<span class="icon">' . wpv_get_icon( 'bubble5' ) . '</span>';
							comments_popup_link(
								$comment_icon . __( '0 <span class="comment-word visuallyhidden">Comments</span>', 'health-center' ),
								$comment_icon . __( '1 <span class="comment-word visuallyhidden">Comment</span>', 'health-center' ),
								$comment_icon . __( '% <span class="comment-word visuallyhidden">Comments</span>', 'health-center' )
							);
						?>
					</div>
				<?php endif; ?>

				<?php edit_post_link( '<span class="icon">' . wpv_get_icon( 'pencil' ) . '</span><span class="visuallyhidden">'. __( 'Edit', 'health-center' ) .'</span>' ) ?>
			<?php endif ?>
		</div>

		<div class="post-content-outer">
			<?php echo $post_data['content']; ?>
		</div>

		<?php if(wpv_get_optionb('meta_posted_in')): ?>
			<div class="post-content-meta">
				<div>
					<?php _e('Posted in: ', 'health-center') ?> <?php the_category(', '); ?>
				</div>
				<?php the_tags('<div class="the-tags">'.__('Tags: ', 'health-center'), ', ', '</div>') ?>
			</div>
		<?php endif ?>
	</div>
<?php endif; ?>