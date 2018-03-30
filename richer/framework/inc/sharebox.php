<?php global $options_data; ?>
<div class="row sharebox">
	<div class="span3 text-right">
		<?php _e('You can share this story by using your social accounts:', 'richer'); ?>
	</div>

	<div class="span9 clearfix">
		<div class="social-icons clearfix">
			<ul>
				<?php if($options_data['check_sharingboxfacebook'] == true) { ?>	
				<li class="social-facebook">
					<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" title="<?php _e( 'Facebook', 'richer') ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				</li>
				<?php } ?>
				<?php if($options_data['check_sharingboxtwitter'] == true) { ?>	
				<li class="social-twitter">
					<a href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" title="<?php _e( 'Twitter', 'richer') ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				</li>
				<?php } ?>
				<?php if($options_data['check_sharingboxlinkedin'] == true) { ?>	
				<li class="social-linkedin">
					<a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;title=<?php the_title();?>" title="<?php _e( 'LinkedIn', 'richer') ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				</li>
				<?php } ?>
				<?php if($options_data['check_sharingboxreddit'] == true) { ?>	
				<li class="social-reddit">
					<a href="http://www.reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" title="<?php _e( 'Reddit', 'richer') ?>" target="_blank"><i class="fa fa-reddit"></i></a>
				</li>
				<?php } ?>
				<?php if($options_data['check_sharingboxdigg'] == true) { ?>	
				<li class="social-digg">
					<a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;bodytext=&amp;tags=&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" target="_blank" title="<?php _e( 'Digg', 'richer') ?>"><i class=" fa fa-digg"></i></a>
				</li>
				<?php } ?>
				<?php if($options_data['check_sharingboxdelicious'] == true) { ?>	
				<li class="social-delicious">
					<a href="http://www.delicious.com/post?v=2&amp;url=<?php the_permalink() ?>&amp;notes=&amp;tags=&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" title="<?php _e( 'Delicious', 'richer') ?>" target="_blank"><i class=" fa fa-delicious"></i></a>
				</li>
				<?php } ?>
				<?php if($options_data['check_sharingboxgoogle'] == true) { ?>	
				<li class="social-googleplus">
					<a href="http://plus.google.com/share?url=<?php the_permalink() ?>&amp;title=<?php echo str_replace(' ', '+', the_title('', '', false)); ?>" title="<?php _e( 'Google+', 'richer') ?>" target="_blank"><i class="fa fa-google-plus-square"></i></a>
				</li>
				<?php } ?>
				<?php if($options_data['check_sharingboxemail'] == true) { ?>	
				<li class="social-email">
					<a href="mailto:?subject=<?php the_title();?>&amp;body=<?php the_permalink() ?>" title="<?php _e( 'E-Mail', 'richer') ?>" target="_blank"><i class="fa fa-envelope"></i></a>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>