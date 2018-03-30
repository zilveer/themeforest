<?php
$mp3_file= get_post_meta($post->ID, MTHEME . '_meta_audio_mp3', true);
$m4a_file= get_post_meta($post->ID, MTHEME . '_meta_audio_m4a', true);
$oga_file= get_post_meta($post->ID, MTHEME . '_meta_audio_ogg', true);

if ($mp3_file) { $mp3_ext ="mp3"; if ($m4a_file || $oga_file){ $mp3_sep=",";} }
if ($m4a_file) { $m4a_ext ="m4a"; if ($oga_file){ $m4a_sep=",";} }
if ($oga_file) { $oga_ext ="oga";  }

$files_used=$mp3_ext.$mp3_sep.$m4a_ext.$m4a_sep.$oga_ext;

if ($files_used) {
?>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function(){
	jQuery("#jquery_jplayer_<?php the_ID(); ?>").jPlayer({
		ready: function () {
			jQuery(this).jPlayer("setMedia", {
				<?php if ($mp3_file) echo 'mp3: "'.$mp3_file.'",'; ?>
				<?php if ($m4a_file) echo 'm4a: "'.$m4a_file.'",'; ?>
				<?php if ($oga_file) echo 'oga: "'.$oga_file.'",'; ?>
				end: ""
			}).jPlayer("stop");
		},
		swfPath: "<?php echo get_stylesheet_directory_uri(); ?>/js/html5player/",
		supplied: "<?php echo $files_used; ?>",
		cssSelectorAncestor: "#jp_interface_<?php the_ID(); ?>"
	});
});
//]]>
</script>

		<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer"></div>

		<div class="jp-audio">
			<div class="jp-type-single">
				<div id="jp_interface_<?php the_ID(); ?>" class="jp-interface">
					<ul class="jp-controls">
						<li><a href="#" class="jp-play" tabindex="1">play</a></li>
						<li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
						<li><a href="#" class="jp-stop" tabindex="1">stop</a></li>
						<li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
						<li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
					</ul>
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"></div>
					</div>
					<div class="jp-current-time"></div>
					<div class="jp-duration"></div>
				</div>
			</div>
		</div>
<?php
}
?>