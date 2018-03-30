<?php
/**
 * @package WordPress
 * @subpackage Chocolate
 */
 
$options = dt_get_theme_options();
$jwplayer_flag = dt_jwplayer_exists();
?>
<?php if( !is_page_template('home-video.php') || (is_page_template('home-video.php') && !$jwplayer_flag)): ?>
<div id="bottom">
	<?php if( is_page_template('home-video.php') && !$jwplayer_flag): ?>
		<div id="jplayer_controlls">
			<div class="jp-controls">
				<table>
					<tr>
						<td class="controls">
							<a href="javascript:;" class="jp-play" tabindex="1"></a>
							<a tabindex="1" class="jp-pause" href="javascript:;"></a>
							<a href="javascript:;" class="jp-stop" tabindex="1"></a>
						</td>
						<td class="track">
							<div class="jp-progress">
								<div class="jp-seek-bar">
									<div class="jp-play-bar"></div>
								</div>
							</div>
						</td>
						<td class="sound">
							<a title="mute" tabindex="1" class="jp-mute" href="javascript:;"></a>
							<a title="unmute" tabindex="1" class="jp-unmute" href="javascript:;" style="display: none;"></a>
							<div class="jp-volume-bar">
								<div class="jp-volume-bar-value"></div>
							</div>
							<a title="max volume" tabindex="1" class="jp-volume-max" href="javascript:;"> </a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	<?php elseif( !is_page_template('home-video.php') ): ?>
		<div> 
			<span>
			<?php
			if(isset($options['credits_text'])) {
				echo $options['credits_text'];
			}
			?>
			<?php if(!isset($options['show_credits']) || $options['show_credits']): ?>
				Created by Dream-Theme &mdash; <a target="_blank" href="http://dream-theme.com/">premium wordpress themes</a>.
			<?php endif; ?>
			</span>
			<ul>
				<?php if ( isset($options['facebook']) && $options['facebook'] ): ?>
					<li class="ico_facebook"><a href="<?php echo $options['facebook']; ?>" target="_blank"></a></li>      
				<?php endif; ?>
				<?php if ( isset($options['twitter']) && $options['twitter'] ): ?>
					<li class="ico_twitter"><a href="<?php echo $options['twitter']; ?>" target="_blank"></a></li>      
				<?php endif; ?>
				<?php if ( isset($options['vimeo']) && $options['vimeo'] ): ?>
					<li class="ico_vimeo"><a href="<?php echo $options['vimeo']; ?>" target="_blank"></a></li>      
				<?php endif; ?>
				<?php if ( isset($options['flickr']) && $options['flickr'] ): ?>
					<li class="ico_flickr"><a href="<?php echo $options['flickr']; ?>" target="_blank"></a></li>      
				<?php endif; ?>
				<?php if ( isset($options['tumblr']) && $options['tumblr'] ): ?>
					<li class="ico_tumblr"><a href="<?php echo $options['tumblr']; ?>" target="_blank"></a></li>      
				<?php endif; ?>
				<?php if ( isset($options['googleplus']) && $options['googleplus'] ): ?>
					<li class="ico_googleplus"><a href="<?php echo $options['googleplus']; ?>" target="_blank"></a></li>      
				<?php endif; ?>
				<?php if ( isset($options['youtube']) && $options['youtube'] ): ?>
					<li class="ico_youtube"><a href="<?php echo $options['youtube']; ?>" target="_blank"></a></li>      
				<?php endif; ?>
				<?php if ( isset($options['pinterest']) && $options['pinterest'] ): ?>
					<li class="ico_pinterest"><a href="<?php echo $options['pinterest']; ?>" target="_blank"></a></li>      
				<?php endif; ?>
			</ul>
			<?php if( !is_page_template('home-static.php') ): ?>
				<a href="#" class="go_up"><?php _e('Up', LANGUAGE_ZONE); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
<?php endif; ?>