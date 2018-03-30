<?php
//VAR SETUP
$light = get_theme_mod('themolitor_customizer_theme_skin', FALSE); 
?>

<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
		<?php if($light){?>
		<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/light/search.png" id="searchsubmit" alt="GO!" />
		<?php } else { ?>
		<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/search.png" id="searchsubmit" alt="GO!" />
		<?php } ?>
		<input type="text" value="<?php _e('Search Site','themolitor');?>" onfocus="this.value=''; this.onfocus=null;" name="s" id="s" />
</form>
