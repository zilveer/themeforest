<?php /* Template Name: Under Construction */ ?>

<?php get_header(); 
   $alc_options = get_option('alc_general_settings'); 
   $date = explode('/', $alc_options['alc_uc_ldate']);
?>
<script type="text/javascript">
    jQuery(document).ready(function(){ 			
        jQuery('div#clock').countdown("<?php echo $date[0]?>/<?php echo $date[1]?>/<?php echo $date[2]?>", function(event) {
            var $this = jQuery(this);
            switch(event.type) {
                case "seconds":
		case "minutes":
		case "hours":
		case "days":
		case "weeks":
		case "daysLeft":
		$this.find('span#'+event.type).html(event.value);
		break;
		case "finished":
		$this.hide();
		break;
            }
	});
    }); 
</script> 
<div class="uc-wrapper">
    <div class="row content_top">
        <div class="large-12 columns text-center uc-header">
            <img src="<?php echo $alc_options['alc_logo'] ?>" alt="<?php echo $alc_options['alc_logotext']?>" id="logo-image" />
            <h1 class="construction_title"><?php echo $alc_options['alc_uc_maincaption'] ?></h1>
	</div>
    </div>
    <div class="row main-content"> 
        <div class="large-12 columns construction">
            <div class="row">
                <div class="large-10 columns large-centered">
                    <h4 class="construction_description text-center">
                        <?php echo $alc_options['alc_uc_pr_head_text'] ?>
                    </h4>
                    <div class="nice primary progress">
                        <h4 class="text-center"><span class="icon-cogs icon30"><?php echo $alc_options['alc_uc_progress'] ?>%</span></h4>
						<span class="meter progress" style="width:<?php echo $alc_options['alc_uc_progress'] ?>%"></span>
                    </div>
				</div>
            </div>       
            <div id="clock">
                <div class="row">
                    <div class="small-2 small-offset-1 columns">
                        <p><span id="weeks"></span><?php _e('Weeks', 'Evolution')?></p>
                    </div>
                    <div class="small-2 columns">
                        <p><span id="daysLeft"></span><?php _e('Days', 'Evolution')?></p>
                    </div>                    			
                    <div class="small-2 columns">
                        <p><span id="hours"></span><?php _e('Hours', 'Evolution')?></p>
                    </div>
                    <div class="small-2 columns">
                        <p><span id="minutes"></span><?php _e('Minutes', 'Evolution')?></p>
                    </div>	
                    <div class="small-2 columns">
                        <p><span id="seconds"></span><?php _e('Seconds', 'Evolution')?></p>
                    </div>
                </div>
            </div>
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <?php the_content() ?>
            <?php endwhile; ?>	
		</div>
    </div>
</div>    
<?php get_footer(); ?>