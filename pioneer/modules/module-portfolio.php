<?php 

/* Get post meta */
global $post;

$header = get_post_meta($post->ID,'epic_portfoliomodule_header',true);
$description = get_post_meta($post->ID,'epic_portfoliomodule_description',true);
$textalign = get_post_meta($post->ID,'epic_portfoliomodule_textalign',true);	
$epic_portfoliomodule_pagination = get_post_meta($post->ID,'epic_portfoliomodule_pagination',true);
$epic_portfoliomodule_type = get_post_meta($post->ID,'epic_portfoliomodule_type',true);
$epic_portfoliomodule_ajax = get_post_meta($post->ID,'epic_portfoliomodule_ajax',true);
$epic_portfoliomodule_perpage = get_post_meta($post->ID,'epic_portfoliomodule_perpage',true);
$epic_portfoliomodule_excerpt = get_post_meta($post->ID,'epic_portfoliomodule_excerpt',true);
$epic_portfoliomodule_excerpt_limit = get_post_meta($post->ID,'epic_portfoliomodule_excerpt_limit',true);
$epic_portfoliomodule_showcategories = get_post_meta($post->ID,'epic_portfoliomodule_showcategories',true);
$epic_portfoliomodule_slider = get_post_meta($post->ID,'epic_portfoliomodule_slider',true);
$epic_portfoliomodule_effect = get_post_meta($post->ID,'epic_portfoliomodule_effect',true);
$epic_portfoliomodule_filter = get_post_meta($post->ID,'epic_portfoliomodule_filter',true);
$epic_portfoliomodule_order = get_post_meta($post->ID,'epic_portfoliomodule_order',true);
$columns = get_post_meta($post->ID,'epic_portfoliomodule_columns',true);
?>

<div id="module-portfolio" class="module module-portfolio clearfix">
	
	<?php global $current_user, $wp_roles;
	get_currentuserinfo();
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false):?>
	
	
	
		
	<?php fee_handle('Portfolio');?>
	
	
		<div class="fee-options" id="portfolio_options">
			<form method="post">
			
			
			<?php add_module_input_title('epic_portfoliomodule_header');?>
			<?php add_module_textarea_description('epic_portfoliomodule_description');?>
			<?php add_module_text_style('epic_portfoliomodule_textalign');?>
			<script>
		jQuery('#categorylist-portfolio').sortable({
			connectWith: jQuery('#categorylist-portfolio-selected'),
			placeholder: "ui-state-highlight"
			//handle: 'span.draghandle'
			}).disableSelection();
		
		jQuery('#categorylist-portfolio-selected').sortable({
			connectWith: jQuery('#categorylist-portfolio'),
			greedy: true,
			//helper: 'clone',
			//forceHelperSize: true,
			//handle: 'span.draghandle',
			cursor: 'pointer',
			opacity: 0.6,
			placeholder: "ui-state-highlight",
			
			update : function (event, ui) {	
			
			    var featuredOrdering = jQuery('#categorylist-portfolio-selected').sortable('toArray');
    			var l = "term_".length;
    			var featuredOrderIds = new Array(featuredOrdering.length);
    			var ctr = 0;
    			// Loop over each value in the array and get the ID
    			jQuery.each(
     			 featuredOrdering,
      			function(intIndex, objValue) {
      			  //Get the ID of the reordered items 
       			 //- this is sent back to server to save
        			featuredOrderIds[ctr] = objValue.substring('',objValue.length);
        			ctr = ctr + 1;
      			}
    			);
    			//alert("newOrderIds : "+newOrderIds); //Remove after testing
    			//$("#info").load("save-item-ordering.jsp?"+newOrderIds);
    			
    			jQuery('#epic_portfoliomodule_categories').val(featuredOrderIds);
  			}  			
  			
  	
		}).disableSelection();
		</script>
		<h5>Select portfolio categories:</h5>
		<div class="formwrapper clearfix">
		<ul class="pagelist" id="categorylist-portfolio">
		<?php
		global $taxonomy;
		$categories = get_terms('portfoliocategory');
		$categories_selected =  get_post_meta($post->ID,'epic_portfoliomodule_categories',true);
				
		foreach ($categories as $category) {
				
				$term_name = $category -> name;
				$term_id = $category -> term_id; 
					$term_slug = $category -> slug; 
				$needle = strpos($categories_selected, $term_slug);
				if($needle === false){
					echo '<li id="'. $term_slug .'">'.$term_name.'</li>';
				}
		}	
				
	
		?>
		
		
		</ul>
		
		<ul class="pagelist-selected" id="categorylist-portfolio-selected">
		<?php
		
		
		foreach ($categories as $category ) {
				$term_name = $category -> name;
				$term_id = $category -> term_id; 
				$term_slug = $category -> slug;
				$needle = strpos($categories_selected, $term_slug);
				if($needle !== false){
       				echo '<li id="'.$term_slug.'">'.$term_name.'</li>';
				}
			}
		
		?>		
		</ul>
		</div>
		
		<hr/>
		
		<div class="halfcolumn">
			<h5>Portfolio type</h5>
			<p><input type="radio" name="epic_portfoliomodule_type" value="slider" <?php if($epic_portfoliomodule_type == 'slider' ){echo 'checked="checked"';}?>/>	<label> Slider</label>
			<input type="radio" name="epic_portfoliomodule_type" value="filtered" <?php if($epic_portfoliomodule_type == 'filtered' ){echo 'checked="checked"';}?>/><label> Filtered</label>
			<input type="radio" name="epic_portfoliomodule_type" value="paginated" <?php if($epic_portfoliomodule_type== 'paginated' || !$epic_portfoliomodule_type){echo 'checked="checked"';}?>/><label> Paginated</label>
			</p>
			</div>
		
		
		
		
			
			<div class="halfcolumn last">
			
			<h5>Ajax post loading</h5>
			<p>
			<input type="radio" name="epic_portfoliomodule_ajax" value="yes" <?php if($epic_portfoliomodule_ajax == 'yes' ){echo 'checked="checked"';}?>/>			<label>Yes</label>
			<input type="radio" name="epic_portfoliomodule_ajax" value="no" <?php if($epic_portfoliomodule_ajax == 'no' || !$epic_portfoliomodule_ajax){echo 'checked="checked"';}?>/>
			<label>No</label>
			</p>
			</div>
			
		<hr/>
			
			<div class="halfcolumn">
			
			<h5>Layout</h5>
			<p>
			<select name="epic_portfoliomodule_columns" id="epic_portfoliomodule_columns">
				
				<option value="2" <?php if($columns == 2){echo 'selected="selected"';}?>>2 columns</option>
				<option value="3" <?php if($columns == 3){echo 'selected="selected"';}?>>3 columns</option>
				<option value="4" <?php if($columns == 4){echo 'selected="selected"';}?>>4 columns</option>
			</select>
			</p>

			
		

			</div>
			
			<div class="halfcolumn last">
					<h5>Number of posts to display</h5>
			<p><input type="text" name="epic_portfoliomodule_perpage" id="epic_portfoliomodule_perpage" value="<?php if($epic_portfoliomodule_perpage){echo $epic_portfoliomodule_perpage;} else {echo '-1';}?>">
			<small>When using paginated portfolio, this value is the "per page" value. To output all posts, enter -1.</small>
			</p>
			</div>
			<hr/>		
			<div class="halfcolumn">
		
			<h5>Display categories</h5>
			<p>
			<input type="radio" name="epic_portfoliomodule_showcategories" value="yes" <?php if($epic_portfoliomodule_showcategories == 'yes' ){echo 'checked="checked"';}?>/>			<label>Yes</label>
			<input type="radio" name="epic_portfoliomodule_showcategories" value="no" <?php if($epic_portfoliomodule_showcategories == 'no' || !$epic_portfoliomodule_showcategories){echo 'checked="checked"';}?>/>
			<label>No</label>
			</p>
			</div>
			
			<div class="halfcolumn last">
			
			<h5>Post order</h5>
			<p>
			<input type="radio" name="epic_portfoliomodule_order" value="ASC" <?php if($epic_portfoliomodule_order == 'yes' ){echo 'checked="checked"';}?>/><label>Ascending</label>
			<input type="radio" name="epic_portfoliomodule_order" value="DESC" <?php if($epic_portfoliomodule_order== 'no' || !$epic_portfoliomodule_order){echo 'checked="checked"';}?>/>
			<label>Descending</label>
			</p>
			
			</div>
			
			
			<hr/>
					
			
			
		
			<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_portfoliomodule'); ?>	
			<input type="hidden" name="epic_portfoliomodule_categories" id="epic_portfoliomodule_categories" value="<?php echo get_post_meta($post->ID,'epic_portfoliomodule_categories',true);?>"/>
			<input type="hidden" name="action" value="saved" />
			<input type="submit" value="Save changes"/>
			<input type="reset" value="Cancel"/>
			<script>
		jQuery(function($) {
			jQuery( "#portfolio_options" ).dialog({
				autoOpen: false,
				title:"Portfolio module options",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 550,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});

			jQuery( "#portfolio_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#portfolio_options" ).dialog( "open" );
				return false;
			});
			});
		</script>



		</form>
		</div>
	</div>
	<?php endif;?>
	<!-- Loader -->

	<div class="module-content clearfix ">
	
	
<?php 
if(!empty($header) || !empty($description)){
echo '<div class="intro clearfix intro_'.$textalign.'">';
if(!empty($header))		{ echo '<span class="module-title">'.$header.'</span>';}
if(!empty($description)){ echo '<span class="module-description">'.$description.'</span>';} 
echo '</div>';
}
?>
<div class="portfolio-wrapper"><div id="portfolio-loader" class="clearfix"></div>	
<?php

$taxonomy = 'portfoliocategory';
$allterms = get_terms( $taxonomy, '');
$selectedterms = get_post_meta($post->ID,'epic_portfoliomodule_categories',true);
//$terms = str_replace("term_", '', $terms); // Remove the featured_ prefix
$terms = rtrim($selectedterms, ",");

//if(!empty($description)){ echo do_shortcode(wpautop($description).'<div class="clearfix"></div>');}


/* Filter */

$columns = get_post_meta($post->ID,'epic_portfoliomodule_columns',true);
$grid = '';
	if($columns == 1){ $grid = 'columns_1'; $imagesize = 'Thumbnail-280'; };
	if($columns == 2){ $grid = 'columns_2'; $imagesize = 'Thumbnail-430'; };
	if($columns == 3){ $grid = 'columns_3'; $imagesize = 'Thumbnail-280'; };
	if($columns == 4){ $grid = 'columns_4'; $imagesize = 'Thumbnail-280';};


/* Portfolio filter */
if($epic_portfoliomodule_type == 'filtered' && $terms){
			
				$count = count($allterms);
 				
 				if ( $count > 0 ){
     
     			echo '<div id="filter"><ul class="portfoliofilter">'."\n";
    			echo "\t".'<li><a href="#" class="showall">'.__('Show all','epic').'</a>'."\n";
     			
     			foreach ( $allterms as $term ) {
     			
     			$needle = strpos($terms, $term ->slug);
				if($needle !== false){
     				echo "\t".'<li><a href="#" class="'.$term->slug.'">'. $term->name . '</a></li>'."\n";
        			}
        		}
     			echo '</ul></div>'."\n";
     			}


}

if($epic_portfoliomodule_type == 'slider'){
echo '<a href="#" id="next-portfolio" class="module-slide-next"></a>';
echo '<a href="#" id="prev-portfolio" class="module-slide-prev"></a>';
}


?>

		<div class="blocked  <?php echo $grid;?>">	
	
	

		<?php
		


		
if(!empty($selectedterms)){
						
			if ( get_query_var('paged') ) { $paged = get_query_var('paged');} 
			elseif ( get_query_var('page') ) {$paged = get_query_var('page');}
			else { $paged = 1;}
			$query_string = '';
			query_posts( $query_string . "&paged=$paged&posts_per_page=$epic_portfoliomodule_perpage&posttype=portfolio&taxonomy=$taxonomy&portfoliocategory=$terms&order=$epic_portfoliomodule_order" );


/* The loop */

$pos ='';
$post_term_list = '';

// Create filter nav
$i = 0;
?>
<?php

if(have_posts()):

echo '<ul class="portfolio-items">';

while (have_posts()): the_post();

$i++;

$video = get_post_meta($post->ID,'epic_lightbox_video',true);
// Get post format for icon selection

$post_terms = get_the_terms($post->ID, $taxonomy); 

$count = count($post_terms);
 if ( $count > 0 ){
       foreach ( $post_terms as $term ) {
       	$post_term_list.= $term->slug.' ';
       }
    
 }

?>
<li class="box" data-id="id-<?php echo ($i + 1);?>" data-type="<?php echo $post_term_list;?>">
	
		
	
	
	
	

	<a href="<?php echo epic_image_src($post->ID, '');?>" data-rel="prettyPhoto[gall]" class="p-enlarge" title="<?php echo get_the_excerpt();?>"></a>
			<?php echo epic_image($post->ID, $imagesize, 'permalink');
		?>					
	
	
	<div class="post-info">
	

	<p class="caption"><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></p>
	<?php
	if($epic_portfoliomodule_excerpt == 'yes'){
		echo epic_excerptlimit($epic_portfoliomodule_excerpt_limit);
	}
	

	echo '<a href="'.get_permalink($post->ID).'"  title="'.get_the_title().'"></a>';
	
	if($epic_portfoliomodule_showcategories == 'yes'){
		echo '<div class="portfolio-meta">'.get_the_term_list($post->ID, $taxonomy,'',', ','').'</div>';
	}
	?>
			<a href="<?php echo get_permalink();?>" class="p-link"  title="" >View project</a>
			</div>
			

</li><?php

$post_term_list = ''; // Reset the term list for each item


endwhile; 
echo '</ul>';


endif;

if( $epic_portfoliomodule_type == 'paginated'){
echo epic_pagination();
}
wp_reset_query();

/* End loop */
}else{
echo '<div class="message_box message_box_yellow"><p>No portfolios have been added. Please fill out the required fields.</p></div>';
}
?>	
<?php if ($epic_portfoliomodule_type == 'slider'):?>

<script type="text/javascript">
/**
 * We use the initCallback callback
 * to assign functionality to the controls
 */
function mycarousel_initCallback(carousel) {
	/*
	jQuery('.jcarousel-control a').bind('click', function() {
        carousel.scroll(jQuery.jcarousel.intval(jQuery(this).find('span').text()));
        return false;
    });
	*/

    jQuery('#next-portfolio').bind('click', function() {
        carousel.next();
        return false;
    });

    jQuery('#prev-portfolio').bind('click', function() {
        carousel.prev();
        return false;
    });
};

jQuery(document).ready(function() {

	var itemCount = jQuery(".portfolio-items ul li").length;
	if(itemCount > <?php echo $columns;?>){
		itemCount = <?php echo $columns;?>;
	}

    jQuery(".portfolio-items").jcarousel({
        scroll: 1,
        initCallback: mycarousel_initCallback,
        // This tells jCarousel NOT to autobuild prev/next buttons
        buttonNextHTML: null,
        buttonPrevHTML: null,
        easing : 'easeOutQuad',
        animation: 500,
        visible : <?php echo $columns;?>,
        //wrap: 'circular',
        width: 'auto'
        });
});

</script>	
<?php endif;?>	

<?php 


if ($epic_portfoliomodule_ajax == 'yes'):?>
<script>
/* Ajax post loading
============================================================*/
jQuery(document).ready(function($) {

	
	
    var $mainContent = jQuery("#portfolio-loader"),
        siteUrl = "http://" + top.location.host.toString(),
        url = ''; 
	
	 
	
     jQuery(document).delegate(".portfolio-items li a, #postnav a", "click", function() {
        
        url = jQuery(this).attr('href'); 
        url = url + " article"; 
        
        jQuery('body,html').scrollTo( '#module-portfolio', 500, {easing:'easeInSine', offset: -200 } ); 
        
        if(jQuery("#portfolio-loader").is(':hidden')){
        	jQuery(this).parent().append('<div class="ajax-preloader"></div>');
        }
        else if(jQuery("#portfolio-loader").is(':visible')){
			jQuery('#module-portfolio .portfolio-wrapper').append('<div class="ajax-preloader-top"></div>');
		}
		 		
		jQuery("#portfolio-loader").animate({'opacity':'0'},500, function(){
			     
				loadPost(url);
        });
        return false;

	});
		
	/* / delegate click */

function loadPost(url){ 
		
		$mainContent.load(url, function() {
		
		
			jQuery('a#close_post').click(function(){
				jQuery('#portfolio-loader').slideUp(500);
			return false;
			});
		
		
        /* Init flex slider */
	    jQuery('.flexslider').flexslider({
   				controlNav: false
   			});
   					
   		// Show content		
  	  jQuery('#portfolio-loader:hidden').slideDown(500);
  	  jQuery("#portfolio-loader:visible").animate({'opacity':'1'},500);
  	  jQuery('.ajax-preloader, .ajax-preloader-top').fadeOut();
      });
	} 

});/* ! End document.ready */
/* ! End ajax */

</script>
<?php endif;?>	
</div>
		</div>
	</div>
</div>
