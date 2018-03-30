<?php 
/**
 * format-audio.php
 *
 * The default template for post contents.
 */

?>

<div class="image-wrapper post-format-audio">

<?php 
	$audio = get_post_meta(get_the_ID() , 'audio' , true);
    $mp3 = get_post_meta(get_the_ID() , 'mp3' , true);
    $ogg = get_post_meta(get_the_ID() , 'ogg' , true);
    
    //if we have the embeded audio we dont need the mp3 and the image of the post
    if($audio != '')
    {
        echo '<div class="embed-audio-code">' . $audio .'</div><!-- end audio code -->';
    }
    elseif($mp3 != '' || $ogg != '') 
    {

		if ( has_post_thumbnail() && ! post_password_required() ) 
		{
			echo '<a href="';the_permalink();echo'">';
				the_post_thumbnail('blog-thumb',array(
					'class' => 'img-fit'
				)); 	
			echo "</a>";
		}
	?>
		<div class="audio-wrapper">
            <!-- wrap -->
            <div class="me-wrap">
                <audio class="mejs-player video-html5">
					<source src="<?php echo $ogg; ?>" type="audio/ogg">
					<source src="<?php echo $mp3; ?>" type="audio/mpeg">
                	<p><?php echo __('Your browser does not support the audio element.' , 'toranj'); ?></p>
                </audio> 
             </div><!-- end wrap -->
    	</div><!-- end audio wrapper -->

    <?php } ?>
</div>





