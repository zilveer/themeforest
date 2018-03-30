
</div>

<div class="clear"></div>


<?php if (get_option('op_footer_sidebar') == 'on') { ?>

<div id="footer_box"> 

 <?php if (get_option('op_social') == 'on') { ?>
    <div id="soc_book">
    <?php if (get_option('op_twitter') == 'on') { ?>
	
	<a href="<?php echo get_option('op_twitter_id') ?>">
	<img src="<?php echo get_template_directory_uri() . '/images/twitter_hover.png'; ?>" alt="Twitter " title="Twitter " />
	</a>
	<?php } ?>

    <?php if (get_option('op_facebook') == 'on') { ?>
    <a href="<?php echo get_option('op_facebook_id') ?>">
	<img class="xyz tip" src="<?php echo get_template_directory_uri() . '/images/facebook_hover.png'; ?>" alt="Facebook " title="Facebook " />
	</a>
    <?php } ?>

    <?php if (get_option('op_linkedin') == 'on') { ?>
    <a href="<?php echo get_option('op_linkedin_id') ?>">
	<img class="xyz tip" src="<?php echo get_template_directory_uri() . '/images/linkedin_hover.png'; ?>" alt="Linkedin " title="Linkedin " />
	</a>
    <?php } ?>

	<?php if (get_option('op_vimeo') == 'on') { ?>
    <a href="<?php echo get_option('op_vimeo_id') ?>">
	<img class="xyz tip" src="<?php echo get_template_directory_uri() . '/images/vimeo_hover.png'; ?>" alt="Vimeo " title="Vimeo " />
	</a>
    <?php } ?>
	
	<?php if (get_option('op_flickr') == 'on') { ?>
    <a href="<?php echo get_option('op_flickr_id') ?>">
	<img class="xyz tip" src="<?php echo get_template_directory_uri() . '/images/flickr_hover.png'; ?>" alt="Flickr " title="Flickr " />
	</a>
    <?php } ?>
	
    <?php if (get_option('op_youtube') == 'on') { ?>
    <a href="<?php echo get_option('op_youtube_id') ?>">
	<img class="xyz tip" src="<?php echo get_template_directory_uri() . '/images/youtube_hover.png'; ?>" alt="Youtube " title="Youtube " />
	</a>
    <?php } ?>
	
	<?php if (get_option('op_skype') == 'on') { ?>
    <a href="<?php echo get_option('op_skype_id') ?>">
	<img class="xyz tip" src="<?php echo get_template_directory_uri() . '/images/skype_hover.png'; ?>" alt="Skype " title="Skype " />
	</a>
    <?php } ?>
    </div>  
    <?php } ?>

	<div class="inner">	
	 <?php get_sidebar('footer-menu'); ?>
    <?php get_sidebar('footer'); ?>
    </div>
   
</div>

<?php } else { ?>
<br />
<?php } ?>

<div id="footer_bottom"> 

    <div id="credit">     
	 &copy; <?php $footer_copy = get_option("op_footer_copy"); ?>
	  <?php echo stripslashes($footer_copy); ?> 2014 -
	  <a href="<?php echo home_url() ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>.
	  &nbsp;  Designed <a href="http://themeforest.net/user/RoyalwpThemes/portfolio?ref=RoyalwpThemes" target="blank"> by RoyalwpThemes</a>
    </div>	


</div>

<?php if (get_option('op_menu_disable') == 'false') { ?>

<?php wp_enqueue_script('ddsmoothmenu', BASE_URL . 'js/ddsmoothmenu.js', false, '', true); ?>
<script type="text/javascript">
jQuery(document).ready(function($){
ddsmoothmenu.init({
mainmenuid: "mainMenu", 
orientation: 'h',
classname: 'ddsmoothmenu', 
contentsource: "markup"
});

$("<select />").appendTo("#mainMenu");

$("<option />", {
   "selected": "selected",
   "value"   : "",
   "text"    : "Go to..."
}).appendTo("#mainMenu select");

$("#mainMenu a").each(function() {
 var el = $(this);
 $("<option />", {
     "value"   : el.attr("href"),
     "text"    : el.text()
 }).appendTo("#mainMenu select");
});

$("#mainMenu select").change(function() {
  window.location = $(this).find("option:selected").val();
});
});
</script>

<?php } ?>

<script type="text/javascript">
jQuery(document).ready(function($){

	var $ele = $('#oz-scroll');
    $(window).scroll(function() {
        $(this).scrollTop() >= 200 ? $ele.show(10).animate({ right : '15px' }, 10) : $ele.animate({ right : '-80px' }, 10);
    });
    $ele.click(function(e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 600);
    });

});
</script>  

<a id="oz-scroll" class="style1" href="#"></a>

</div>

<?php echo get_option("op_ga_code"); ?>

<?php wp_footer(); ?>
</body>
</html>


