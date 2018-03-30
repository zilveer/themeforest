<?php global $options_data; ?>
<div class="sharebox">
	<?php _e('Share this:', 'richer'); ?>
	<br />
	<div class="social-icons clearfix">
		<ul>
			<?php if($options_data['check_sharingboxfacebook_folio'] != 0) { ?>	
			<li class="social-facebook">
				<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" title="<?php _e( 'Facebook', 'richer') ?>" target="_blank"><i class="fa fa-facebook"></i></a>
			</li>
			<?php } ?>
			<?php if($options_data['check_sharingboxtwitter_folio'] != 0) { ?>	
			<li class="social-twitter">
				<a href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" title="<?php _e( 'Twitter', 'richer') ?>" target="_blank"><i class="fa fa-twitter"></i></a>
			</li>
			<?php } ?>
			<?php if($options_data['check_sharingboxlinkedin_folio'] != 0) { ?>	
			<li class="social-linkedin">
				<a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;title=<?php the_title();?>" title="<?php _e( 'LinkedIn', 'richer') ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
			</li>
			<?php } ?>
			<?php if($options_data['check_sharingboxreddit_folio'] != 0) { ?>	
			<li class="social-reddit">
				<a href="http://www.reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" title="<?php _e( 'Reddit', 'richer') ?>" target="_blank"><i class="fa fa-reddit"></i></a>
			</li>
			<?php } ?>
			<?php if($options_data['check_sharingboxdigg_folio'] != 0) { ?>	
			<li class="social-digg">
				<a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;bodytext=&amp;tags=&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" target="_blank" title="<?php _e( 'Digg', 'richer') ?>"><i class=" fa fa-digg"></i></a>
			</li>
			<?php } ?>
			<?php if($options_data['check_sharingboxdelicious_folio'] != 0) { ?>	
			<li class="social-delicious">
				<a href="http://www.delicious.com/post?v=2&amp;url=<?php the_permalink() ?>&amp;notes=&amp;tags=&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" title="<?php _e( 'Delicious', 'richer') ?>" target="_blank"><i class=" fa fa-delicious"></i></a>
			</li>
			<?php } ?>
			<?php if($options_data['check_sharingboxgoogle_folio'] != 0) { ?>	
			<li class="social-googleplus">
				<a href="http://plus.google.com/share?url=<?php the_permalink() ?>&amp;title=<?php echo str_replace(' ', '+', the_title('', '', false)); ?>" title="<?php _e( 'Google+', 'richer') ?>" target="_blank"><i class="fa fa-google-plus-square"></i></a>
			</li>
			<?php } ?>
			<?php if($options_data['check_sharingboxemail_folio'] != 0) { ?>	
			<li class="social-email">
				<a href="mailto:?subject=<?php the_title();?>&amp;body=<?php the_permalink() ?>" title="<?php _e( 'E-Mail', 'richer') ?>" target="_blank"><i class="fa fa-envelope"></i></a>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>