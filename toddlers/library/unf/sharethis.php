<?php global $unf_options; ?>
<?php if ( $unf_options['unf_sharethis'] == '1' ) { ?>
<div class="sharethisbox hidden-sm hidden-xs">
	<?php if (isset($unf_options['unf_sharelinks']['fb']) && $unf_options['unf_sharelinks']['fb'] == 1) {?>
	<!-- share on Facebook -->
	<a rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php echo urlencode(get_the_title($id)); ?>" title="<?php _e("Share this post on Facebook", 'toddlers'); ?>" target="_blank" class="icon icon icon-facebook"></a>
	<?php } ?>
	<?php if (isset($unf_options['unf_sharelinks']['tw']) && $unf_options['unf_sharelinks']['tw'] == 1) {?>
	<!-- tweet on Twitter -->
	<a rel="nofollow" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="<?php _e("Share this article with your Twitter ", 'toddlers'); ?>" target="_blank" class="icon icon icon-twitter"></a>
	<?php } ?>

	<?php if (isset($unf_options['unf_sharelinks']['rd'])&& $unf_options['unf_sharelinks']['rd'] == 1) {?>
	<!-- submit to Reddit -->
	<a rel="nofollow" href="http://reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title($id)); ?>" title="<?php _e("Share this post on Reddit", 'toddlers'); ?>" target="_blank" class="icon icon-reddit"></a>
	<?php } ?>

	<?php $pinimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'original' ); ?>
	<?php if ( has_post_thumbnail() ) { ?>

	<?php if (isset($unf_options['unf_sharelinks']['pn']) && $unf_options['unf_sharelinks']['pn'] == 1) {?>
	<!-- submit to pinterest -->
	<a rel="nofollow" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($pinimage[0]); ?>&description=<?php the_title(); ?>%20-%20<?php the_permalink(); ?>"  title="<?php _e("Pin this post on Pinterest", 'toddlers'); ?>" target="_blank" class="icon icon-pinterest"></a>
	<?php }

	} ?>

	<?php if (isset($unf_options['unf_sharelinks']['dl']) && $unf_options['unf_sharelinks']['dl'] == 1) {?>
	<!-- bookmark on Delicious -->
	<a rel="nofollow" href="http://delicious.com/post?url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title($id)); ?>" title="<?php _e("Bookmark this post at Delicious", 'toddlers'); ?>" target="_blank" class="icon icon-delicious"></a>
	<?php } ?>

	<?php if (isset($unf_options['unf_sharelinks']['dg']) && $unf_options['unf_sharelinks']['dg'] == 1) {?>
	<!-- submit to Digg -->
	<a rel="nofollow" href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink(); ?>" title="<?php _e("Submit this post to Digg", 'toddlers'); ?>" target="_blank" class="icon icon-digg"></a>
	<?php } ?>

	<?php if (isset($unf_options['unf_sharelinks']['su']) && $unf_options['unf_sharelinks']['su'] == 1) {?>
	<!-- submit to StumbleUpon -->
	<a rel="nofollow" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title($id)); ?>" title="<?php _e("Share this post at StumbleUpon", 'toddlers'); ?>" target="_blank"  class="icon icon-stumbleupon"></a>
	<?php } ?>

	<?php if (isset($unf_options['unf_sharelinks']['ff']) && $unf_options['unf_sharelinks']['ff'] == 1) {?>
	<!-- submit to FriendFeed -->
	<a rel="nofollow" href="http://friendfeed.com/share?url=<?php the_permalink();?>&amp;title=<?php the_title(); ?>" title="<?php _e("Share on FriendFeed", 'toddlers'); ?>" target="_blank" class="icon icon-friendfeed"></a>
	<?php } ?>

	<?php if (isset($unf_options['unf_sharelinks']['li']) && $unf_options['unf_sharelinks']['li'] == 1) {?>
	<!-- submit to LinkedIn -->
	<a rel="nofollow" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;title=<?php the_title(); ?>&amp;summary=YOUR SUMMARY&amp;source=" title="<?php _e("LinkedIn", 'toddlers'); ?>" target="_blank" class="icon icon-linkedin"></a>
	<?php } ?>

	<?php if (isset($unf_options['unf_sharelinks']['gb']) && $unf_options['unf_sharelinks']['gb'] == 1) {?>
	<!-- submit to Google Bookmarks -->
	<a rel="nofollow" href="http://www.google.com/bookmarks/mark?op=edit&bkmk=<?php the_permalink();?>&amp;title=<?php the_title(); ?>" title="<?php _e("Save To Google Bookmarks", 'toddlers'); ?>" target="_blank"  class="icon icon-google"></a>
	<?php } ?>

	<?php if (isset($unf_options['unf_sharelinks']['ms']) && $unf_options['unf_sharelinks']['ms'] == 1) {?>
	<!-- submit to MySpace -->
	<a rel="nofollow" href="http://www.myspace.com/Modules/PostTo/Pages/?l=3&amp;u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>&amp;c=YOUR COMMENT" title="<?php _e("MySpace", 'toddlers'); ?>" target="_blank"  class="icon icon-myspace"></a>
	<?php } ?>

	<?php if (isset($unf_options['unf_sharelinks']['wl']) && $unf_options['unf_sharelinks']['wl'] == 1) {?>
	<!-- submit to Windows Live -->
	<a rel="nofollow" href="https://favorites.live.com/quickadd.aspx?marklet=1&amp;mkt=en-us&amp;url=<?php the_permalink();?>&amp;title=<?php the_title(); ?>&amp;top=1" title="<?php _e("Windows Live", 'toddlers'); ?>" target="_blank"  class="icon icon-windows"></a>
	<?php } ?>

</div>
<?php } ?>
