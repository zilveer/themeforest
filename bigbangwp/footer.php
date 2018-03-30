<?php
$layout = of_get_option(BRANKIC_VAR_PREFIX."boxed_stretched", of_get_default(BRANKIC_VAR_PREFIX."boxed_stretched"));
if (isset($_GET["layout"])) 
{
    if (htmlspecialchars(strip_tags($_GET["layout"])) == "stretched") $layout = "stretched" ;
    if (htmlspecialchars(strip_tags($_GET["layout"])) == "boxed") $layout = "boxed" ; 
}

if ($layout == "stretched")
{
$page_template = get_page_template();
$path = pathinfo($page_template);
$page_template = $path['filename'];

if ($page_template != "page-contact-2")
{
?>
</div><!-- END CONTENT-WRAPPER --> 
<?php
}
?>
</div><!-- END WRAPPER --> 
<?php
}
?> 
    
    
    <!-- START FOOTER -->
    
    <div id="footer">
    
        <div id="footer-content">
<?php
$all_sidebars = wp_get_sidebars_widgets();
if (!isset($all_sidebars["Footer_1st_box"])) { $all_sidebars["Footer_1st_box"] = null ;};
if (!isset($all_sidebars["Footer_2nd_box"])) { $all_sidebars["Footer_2nd_box"] = null ;};
if (!isset($all_sidebars["Footer_3rd_box"])) { $all_sidebars["Footer_3rd_box"] = null ;};
if (!isset($all_sidebars["Footer_4th_box"])) { $all_sidebars["Footer_4th_box"] = null ;};

if (count($all_sidebars["Footer_1st_box"]) > 0 || count($all_sidebars["Footer_2nd_box"]) > 0 || count($all_sidebars["Footer_3rd_box"]) > 0 || count($all_sidebars["Footer_4th_box"]) > 0)
{
?>                    
                <div id="footer-top" class="clear">
                    
                <div class="one-fourth">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer_1st_box") ) : endif; ?>
                </div><!--END one-fourth-->
                
                <div class="one-fourth">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer_2nd_box") ) : endif; ?>
                </div><!--END one-fourth-->
                
                <div class="one-fourth">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer_3rd_box") ) : endif;  ?>
                </div><!--END one-fourth-->
                
                <div class="one-fourth last">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer_4th_box") ) : endif;  ?>
                </div><!--END one-fourth last-->
                    
                </div><!--END FOOTER-TOP-->
<?php
}
?>         
            
                <div id="footer-bottom" class="clear">
                            
                    <div class="one-half">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer_left") ) : endif;  ?>
                    </div><!--END ONE-HALF-->    
                            
                    <div class="one-half text-align-right last">            
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer_right") ) : endif;  ?>
                    </div><!--END ONE-HALF LAST-->
                    
                </div><!--END FOOTER-BOTTOM-->    
            
        </div><!--END FOOTER-CONTENT-->        
    
    </div><!--END FOOTER-->
    
    <!-- END FOOTER -->    
<?php
if ($layout == "boxed")
{
?>
</div><!-- END CONTENT-WRAPPER --> 

</div><!-- END WRAPPER --> 
<?php
}
?> 

<script type='text/javascript'>
jQuery(document).ready(function($){
<?php
if (is_single())
{
?>
    $(".post-content img").each(function(){
		var img_class =($(this).attr("class"));	
		//alert(img_class);
		if (img_class != undefined) {
			if (img_class.indexOf("wp-image") > -1) {
				$(this).parent("a").attr("data-rel", "prettyPhoto[]");
			}
		}
	})
<?php
}
//$page_object = get_queried_object();
$page_id     = get_queried_object_id();

$bg_image_global = of_get_option(BRANKIC_VAR_PREFIX."background_image", of_get_default(BRANKIC_VAR_PREFIX."background_image"));
$tile_background_global = of_get_option(BRANKIC_VAR_PREFIX."tile_background", of_get_default(BRANKIC_VAR_PREFIX."tile_background"));
$bg_image_local = get_post_meta($page_id, BRANKIC_VAR_PREFIX."background_image", true);

if ($bg_image_local != "")
{ 
    $bg_image = $bg_image_local;
    $image_id = MultiPostThumbnails::get_post_thumbnail_id( 'page', $bg_image, $page_id );
    $page_bg_image = wp_get_attachment_image_src( $image_id, "page_" . $bg_image );
    $bg_image = $page_bg_image[0];
    $tile_background = get_post_meta($page_id, BRANKIC_VAR_PREFIX."tile_background", true);
}
else
{
    $bg_image = $bg_image_global;
    $tile_background = $tile_background_global;
}

if ($bg_image != "" && $tile_background == "yes")
{
?>
    $("body").css("background", "url(<?php echo $bg_image; ?>) repeat");
<?php
}
if ($bg_image != "" && $tile_background != "yes") 
{
?> 
    $.backstretch("<?php echo $bg_image; ?>");
<?php
}
 
?>
<?php
if (get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."add_class_title", true) != "no")
{
?>
    $(".one :header, #inner-content :header").addClass("title");
    $(".team-member-info :header, .no_title").removeClass("title");   
<?php
} 
?>
<?php 
if (is_single()) {
?>
/*--------------------------------------------------
         COMMENT FORM CODE
---------------------------------------------------*/
    $(".comment-list li").addClass("comment");
    $("#comment-form").addClass("form");
    $("#comment-form #submit").addClass("submit");
    $("#reply-title").addClass("title");
    $("#reply-title").after("<p><?php _e('Make sure you fill in all mandatory fields.', BRANKIC_THEME_SHORT); ?></p>")
<?php
}  
?>
})
<?php echo of_get_option(BRANKIC_VAR_PREFIX."extra_javascript", of_get_default(BRANKIC_VAR_PREFIX."extra_javascript")); ?> 
<?php 
if (of_get_option(BRANKIC_VAR_PREFIX."short_pages_fix", of_get_default(BRANKIC_VAR_PREFIX."short_pages_fix")) == "yes") {
?>
// short pages
jQuery(window).load(function() { 

	var wrapper_height = jQuery("#wrapper").outerHeight();
	var footer_height = jQuery("#footer").outerHeight();
	var window_height = jQuery(window).height();
	var content_height = wrapper_height + footer_height
	
	if (jQuery("#footer").parents("#wrapper").length == 1) {
		content_height = wrapper_height;
	}
	
	if (window_height > content_height) {
		// if streched layout we don't need this line. if footer in wrapper = boxed
		if (jQuery("#footer").parents("#wrapper").length == 1) {
			jQuery("#wrapper, .content-wrapper").css("height", "100%");
		}
		
		if (jQuery(".portfolio-grid #thumbs li").length <= 4) {
			jQuery("#footer").css({"position": "absolute", "bottom": "0px"});
		}
		
	}

	if (jQuery("#wpadminbar").length > 0){
		wp_admin_height = parseInt(jQuery("#wpadminbar").height()) + "px";
		
	}
	
	jQuery(window).resize(function() {

		var wrapper_height = jQuery("#wrapper").outerHeight();
		var footer_height = jQuery("#footer").outerHeight();
		var window_height = jQuery(window).height();
		var content_height = wrapper_height + footer_height
		
		if (jQuery("#footer").parents("#wrapper").length == 1) {
			content_height = wrapper_height;
		}
		
		if (window_height > content_height) {
			// if streched layout we don't need this line. if footer in wrapper = boxed
			if (jQuery("#footer").parents("#wrapper").length == 1) {
				jQuery("#wrapper, .content-wrapper").css("height", "100%");
			} 
						
			if (jQuery(".portfolio-grid #thumbs li").length <= 4) {
				jQuery("#footer").css({"position": "absolute", "bottom": "0px"});
			}
			
		} else {
			jQuery("#wrapper, .content-wrapper").css("height", "auto");
			jQuery("#footer").css({"position": "relative", "bottom": "auto"});
		}
	
		if (jQuery("#wpadminbar").length > 0){
			wp_admin_height = parseInt(jQuery("#wpadminbar").height()) + "px";
			
		}


	});

 })
<?php
}
?>
</script>
<?php
if (of_get_option(BRANKIC_VAR_PREFIX."show_panel", of_get_default(BRANKIC_VAR_PREFIX."show_panel")) == "yes")
{
?>
<!-- Theme Option --> 
<script type="text/javascript" src="<?php echo BRANKIC_ROOT."/javascript/theme-option.js" ; ?>"></script>

<div id="panel" style="margin-left:-210px;">
        
    <div id="panel-admin">
        <strong>Background pattern</strong> <br />    
        <select id="background">
          <option value="">--</option>
          <option value="">Blank</option>
          <option value="bg-1.png">Pattern 1</option>
          <option value="bg-4.png">Pattern 2</option>
          <option value="bg-6.png">Pattern 3</option>
          <option value="bg-2.png">Pattern 4</option>
          <option value="bg-5.png">Pattern 5</option>
          <option value="bg-7.png">Pattern 6</option>
          <option value="bg-3.png">Pattern 7</option>
          <option value="bg-8.png">Pattern 8</option>
          <option value="bg-9.png">Pattern 9</option>
          <option value="bg-10.png">Pattern 10</option>
          <option value="bg1.jpg">Backstreach photography</option>
        </select>
        
        <strong>Colors</strong> <br />
        <select id="colors">
          <option value="">--</option>
          <option value="color-blue.css">Blue</option>
          <option value="color-navyblue.css">Navyblue</option>
          <option value="color-orange.css">Orange</option>
          <option value="color-yellow.css">Yellow</option>
          <option value="color-green.css">Green</option>
          <option value="color-tealgreen.css">Tealgreen</option>
          <option value="color-red.css">Red</option>
          <option value="color-pink.css">Pink</option>
          <option value="color-purple.css">Purple</option>
          <option value="color-magenta.css">Magenta</option>
          <option value="color-cream.css">Cream</option>
        </select>
        
        <strong>Layout style</strong> <br />
        <select id="layout">
          <option value="">--</option>
          <option value="streched">Stretched</option>
          <option value="boxed">Boxed</option>
        </select>
<br /><br /><br />

    </div><!--PANEL-ADMIN-->    
    
    <a class="open" href="#"></a>

</div><!--PANEL-->
<?php
}
?>

<?php if (of_get_option(BRANKIC_VAR_PREFIX."extra_css") != "")
{
?> 
<style type="text/css">
<!--
<?php echo of_get_option(BRANKIC_VAR_PREFIX."extra_css"); ?>
-->
</style>
<?php
}
?>
<?php wp_footer(); ?>
</body>
</html>