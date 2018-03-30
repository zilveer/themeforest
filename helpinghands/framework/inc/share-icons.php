<?php
/**
 * Theme Share Icons
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
global $sd_data;

$share_icons = $sd_data['sd_campaign_share_icons'];
?>

<div class="sd-share-icons clearfix">
	<h5>
		<?php _e('SHARING IS CARING', 'framework'); ?>
	</h5>
	<ul>
		<?php if ( $share_icons[1] == '1' ) : ?>
			<li>
				<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php echo urlencode( the_title_attribute() ); ?>" title="<?php _e( 'Facebook', 'framework' ) ?>" target="_blank" >		<i class="fa fa-facebook"></i>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( $share_icons[2] == '1' ) : ?>
			<li>
				<a href="http://twitter.com/home?status=<?php echo urlencode( the_title_attribute() ); ?>: <?php the_permalink(); ?>" title="<?php _e( 'Twitter', 'framework' ) ?>" target="_blank">
					<i class="fa fa-twitter"></i>
				</a>
			</li>
		<?php endif; ?>
		
		<?php if ( $share_icons[3] == '1' ) : ?>
		<li>
			<a href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="_blank">
				<i class="fa fa-google-plus"></i>
			</a>
		</li>
		<?php endif; ?>
		
		<?php if ( $share_icons[4] == '1' ) : ?>
			<li> 
				<a href="http://www.delicious.com/post?v=2&amp;url=<?php the_permalink() ?>&amp;notes=&amp;tags=&amp;title=<?php echo urlencode( the_title_attribute() ); ?>" title="<?php _e( 'Delicious', 'framework' ) ?>" target="_blank">
					<i class="fa fa-delicious"></i>
				</a>
			</li>
		<?php endif; ?>
		
		<?php if ( $share_icons[5] == '1' ) : ?>
			<li>
				<a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode( the_title_attribute() ); ?>" title="StumbleUpon" target="_blank">
					<i class="fa fa-stumbleupon"></i>
				</a>
			</li>
		<?php endif; ?>
		
		<?php if ( $share_icons[6] == '1' ) : ?>
			<li> <a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;bodytext=&amp;tags=&amp;title=<?php echo urlencode( the_title_attribute() ); ?>" target="_blank" title="<?php _e( 'Digg', 'framework' ) ?>">
					<i class="fa fa-digg"></i>
				</a>
			</li>
		<?php endif; ?>
		
		<?php if ( $share_icons[7] == '1' ) : ?>
			<li>
				<a href="http://www.reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode( the_title_attribute() ); ?>" title="<?php _e( 'Reddit', 'framework' ) ?>" target="_blank">
					<i class="fa fa-reddit"></i>
				</a>
			</li>
		<?php endif; ?>
		
		<?php if ( $share_icons[8] == '1' ) : ?>
			<li>
				<a href="mailto:?subject=<?php echo urlencode( the_title_attribute() ); ?>&amp;body=<?php the_permalink() ?>" title="<?php _e( 'E-Mail', 'framework' ) ?>" target="_blank">
					<i class="fa fa-envelope-o"></i>
				</a>
			</li>
		<?php endif; ?>
	</ul>
</div>