<div id="kenburns_overlay"></div>
<canvas id="kenburns">
    <p>Your browser doesn't support canvas!</p>
</canvas>

<?php
$pp_homepage_music_mp3 = get_option('pp_homepage_music_mp3');

if(!empty($pp_homepage_music_mp3))
{
?>
<div class="page_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$pp_homepage_music_mp3.'"]'); ?>
</div>
<?php
}
?>