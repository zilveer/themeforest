<?php 

global $current_user, $wp_roles, $post; 

$selected_effect = get_post_meta($post->ID,'epic_cycle_effect',true);
$selected_interval = get_post_meta($post->ID,'epic_cycle_interval',true);
if(!$selected_interval){$selected_interval = 0;}
$epic_cycle_nav = get_post_meta($post->ID,'epic_cycle_nav',true);

?>

<div id="module-slideshow" class="module module-slideshow thumbnail_popup"  data-interval="<?php echo $selected_interval;?>" data-transition="<?php echo $selected_effect;?>" data-slidenav="<?php echo $epic_cycle_nav;?>">

	<?php 
	get_currentuserinfo();
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false ){	
	?>

	
	<?php fee_handle('Slideshow');?>	
	
	<div class="fee-options" id="slideshow_options">


	<form method="post">
	
<?php
	
  
$myterms = get_terms('slideshow');
$epic_getterms = array();
  	
  	echo '<p><label>Select slideshow</label>';
    echo '<select name="epic_post_slideshowcat">';
    echo '<option value="">Select slideshow</option>';
		
	$setSlideshowCat = get_post_meta($post->ID,'epic_post_slideshowcat',true);
		foreach ($myterms as $term_list ) {
				  $epic_getterms[$term_list->term_id] = $term_list->name;
				  echo '<option ';
				  if($term_list->name == $setSlideshowCat){echo 'selected="selected" ';}
				  echo 'value="'.$term_list->name.'">'.$term_list->name.'</option>';
		}
echo '</select></p>';
?>

			
			<label>Slideshow autoplay inverval</label>
			<?php $intervals = array(
					'9999' => 'No autoplay',
					'1000' => '1 second',
					'2000' => '2 seconds',
					'3000' => '3 seconds',
					'4000' => '4 seconds',
					'5000' => '5 seconds',
					'6000' => '6 seconds',
					'7000' => '7 seconds',
					'8000' => '8 seconds',
					'9000' => '9 seconds',
					'10000' => '10 seconds',
					'11000' => '11 seconds',
					'12000' => '12 seconds',
					'13000' => '13 seconds',
					'14000' => '14 seconds',
					'15000' => '15 seconds',
					'16000' => '16 seconds',
					'17000' => '17 seconds',
					'18000' => '18 seconds',
					'19000' => '19 seconds',
					'20000' => '20 seconds'
						
			);?>
			<p><select name="epic_cycle_interval">
			<?php
				
				
			
				foreach ( $intervals as $interval => $intervalname){
				
				echo '<option value="'.$interval.'"';
				
				if($interval == $selected_interval){ echo 'selected="selected"';}
				if($selected_interval == '' && $interval == 5000){ echo 'selected="selected"';}
				
				
				echo '>'.$intervalname.'</option>';
			
			}?>
			</select></p>
			
	
		
			


</p>

			<?php wp_nonce_field('fee_save_nonce_slidermodule','fee_nonce_field_slidermodule');?>	
			<input type="hidden" name="action" value="saved"/>
			<input type="submit" value="Save changes"/>
			<input type="reset" value="Cancel"/>
			</form>
			<div class="clearfix"></div>
			<script>
			jQuery(function() {
			jQuery( "#slideshow_options" ).dialog({
				autoOpen: false,
				title:"Slideshow settings",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 580,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});

			jQuery( "#slideshow_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#slideshow_options" ).dialog( "open" );
				return false;
			});
			});
			
			
			
			</script>
		</div>	
	</div>
	<?php }
	
/* Slideshow meta */	
$category = get_post_meta($post->ID,'epic_post_slideshowcat',true);
$size = 'Thumbnail-slideshowfullwidth';
?>	

<div class="module-content">

<?php 
/* Check if slideshow has been selected */
if(!empty($category)){

$args = array( 'showposts' => '-1', 'post_type' => 'slide', 'taxonomy'=> 'slideshow', 'term' => $category);


/************************************
Flex responsive slideshow 
************************************/
query_posts($args);

if(have_posts()): 
$c = 0;
while (have_posts()): the_post();
$c++;
endwhile;
$divwidth = round(100 / $c);

endif;

echo '<div class="flexslider"><ul class="slides">';
// The query
query_posts($args);

if(have_posts()): 
while (have_posts()): the_post();
$infodisplay = get_post_meta($post->ID,'epic_slideinfo',true);
$slideurl = get_post_meta($post->ID,'epic_customurl',true);

echo '<li>';

if(!empty($slideurl)){
echo '<a href="'.$slideurl.'">';
echo epic_image($post->ID,'Thumbnail-slideshowfullwidth','');
echo '</a>';
}
else{
echo epic_image($post->ID,'Thumbnail-slideshowfullwidth','');
}

if($infodisplay != true){
echo '<div class="flex-caption"><h3>'.get_the_title().'</h3>';
if($post->post_excerpt){
echo '<p>'.get_the_excerpt().'</p>';
}
echo '</div>';
}
//echo '<span class="slide_overlay_top"></span>';
echo '<span class="slide_overlay_left"></span>';
echo '<span class="slide_overlay_right"></span>';
echo '</li>';

endwhile;
endif;
echo '</ul>';
wp_reset_query();

?>

<ul class="flex-nav clearfix">
<?php
query_posts($args);
if(have_posts()): 
while (have_posts()): the_post();
?>
<li style="width:<?php echo $divwidth;?>%">
<?php //echo epic_image($post->ID,'Thumbnail-slideshowfullwidth','');?>
<a href="#" ></a></li>

<?php
endwhile;
endif;
wp_reset_query();
?>
</ul>
</div>

<?php


} else { echo '<div class="message_box message_box_yellow"><p>No slideshow  has been selected. Please fill out the required fields.</p></div>';}
?>

	

<script>
  jQuery(function () {
   jQuery('.flexslider').flexslider({
   directionNav: true,
   manualControls: "ul.flex-nav li",
   slideshowSpeed: <?php echo $selected_interval;?>
   });
  });
</script>
		
	</div>
</div>


