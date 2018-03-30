<div id="thumb-tray" class="load-item">
    <div id="thumb-back"></div>
    <div id="thumb-forward"></div>
    <a id="prevslide" class="load-item"><img src="<?php echo get_template_directory_uri(); ?>/images/arrow_back.png" alt=""/></a>
    <a id="nextslide" class="load-item"><img src="<?php echo get_template_directory_uri(); ?>/images/arrow_forward.png" alt=""/></a>
</div>

<?php
    $pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
    if(!empty($pp_portfolio_enable_slideshow_title))
    {
?>
    <!--Slide captions displayed here--> 
    <div id="slidecaption"></div>
<?php
    }
?>

<br class="clear"/>
</div>

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