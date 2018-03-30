<?php
/* cosmetico portfolio listing page template */
require(get_template_directory().'/inc/cb-general-options.php');
require(get_template_directory().'/inc/cb-page-options.php');

require(get_template_directory().'/inc/cb-little-head.php');

if($pshape!=''&&$pshape!='default') $headis=' style="text-align:center;"'; else $headis='';

$headi='<h2 class="in wn"'.$headis.'>'; $headi_end='</h2>';

$pwidth=980;
$pwidth=$pwidth/$columns; $pwidth=$pwidth*1.5;
$pheight=700;
if($pshape!=''&&$pshape!='default') $pheight=700;
$pheight=$pwidth;

if($columns=='2') { $headi='<h3 class="in"'.$headis.'>'; $headi_end='</h3>'; }
if($columns=='3') { $headi='<h4 class="in"'.$headis.'>'; $headi_end='</h4>'; }
if($columns=='4') { $headi='<h4 class="in"'.$headis.'>'; $headi_end='</h4>'; }
if(!isset($roundy))$roundy='';
?>
<script type="text/javascript">
//LOADER
jQuery(document).ready(function(){
var page = 1; 
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
jQuery('.cb_load_more').live('click', function(){ 

	var paged = jQuery(this).attr('data-paged');
	var max_posts = jQuery(this).attr('data-posts');
	jQuery(this).attr('data-paged',parseInt(paged)+1);

	jQuery.post( ajaxurl, { action: 'cbloader',paged:paged,cats:'<?php echo $cats; ?>',per_page:'<?php echo $per_page; ?>',col_v:'<?php echo $col_v; ?>',columns:'<?php echo $columns; ?>',pcap:'<?php echo $pcap; ?>',headi:'<?php echo $headi; ?>',headi_end:'<?php echo $headi_end; ?>',plink:'<?php echo $plink; ?>',pshape:'<?php echo $pshape; ?>',fr:'<?php echo $fr; ?>',frin:'<?php echo $frin; ?>',pheight:'<?php echo $pheight; ?>',roundy:'<?php echo $roundy; ?>',det:'<?php echo $pcap; ?>',bfi_w:'<?php echo $pwidth; ?>',security:'<?php echo wp_create_nonce('cosmetico-settings'); ?>'}, function(data){
 

  jQuery('.load_wrap').append(data);
  var postbox_length=jQuery('.pitem').length;
  if(postbox_length==max_posts) { jQuery('.cb_load_more').fadeOut(); }
  jQuery('html, body').animate({
         scrollTop: jQuery(".load_wrap").offset().top - 50 
     }, 100);
  });
});

});
//LOADER END
</script>

<?php

?>
<script type="text/javascript">
function show_cat(cat){
     jQuery(".pitem").hide();
var columns = <?php echo $columns;?>;
jQuery('#portfolio .pitem').css("margin-right","");
  if(!cat) {
	   var counter = 1;
	     jQuery(".pitem").each(function(){ 
	        if(counter%columns==0)
	            jQuery(this).css("margin-right","0");
	        counter++;
	    });
  jQuery('#portfolio .pitem:hidden').fadeIn('slow'); 
  }
  else { 
      var counter = 1;
		jQuery('.cat-'+cat).each(function(){ 
      if(counter%columns==0)
          jQuery(this).css("margin-right","0");
      counter++;
  	});
  jQuery('#portfolio .pitem').not('.cat-'+cat).hide(); 
  jQuery('.cat-'+cat+':hidden').fadeIn('slow'); 
   
   
   }


 }

<?php if($plink=='ajax') { ?>
function load_image(src,pid){
jQuery("#load_image").show();
jQuery("#load_h").slideDown('slow');
jQuery("#load_image_c").slideDown('slow');
jQuery('#load_image_c').empty();
jQuery('html, body').animate({scrollTop:jQuery('#scroll_to').offset().top - 137}, 'slow');
var getpi=jQuery('.port_'+pid).html();
jQuery('#load_image_c').append('<div id="im" style="display:none;"><img id="img_load" src="'+src+'"></div><div class="port_item_in">'+getpi+'</div><div class="cl"></div>');
jQuery('#img_load').load(function() {
jQuery("#load_h").fadeOut('slow');
jQuery('#close_item').fadeIn('slow');
jQuery(this).removeAttr('height').removeAttr('width');
    cloned = jQuery(this).clone().css({visibility:'hidden'});
    jQuery('body').append(cloned);
    o_width = cloned.get(0).width; 
    o_height = cloned.get(0).height; 
    cloned.remove();
	//if (o_height>jQuery(window).height() )jQuery(this).attr({height:jQuery(window).height()});
	if (o_width>790)jQuery(this).attr({width:670});
	jQuery("#im").slideToggle();	 
    }); 
 }


jQuery(document).ready(function() {  
 jQuery('#close_item').click(function (){
 jQuery("#load_image_c").slideUp('slow');
 });
	jQuery(document).on('click', '.cb-next-porfolio', function(e) { 
		var me = jQuery(this).attr('data-me-id');
		var action = jQuery(this).attr('data-action');
		var previous = false;
		var next = false;
 
		var first_href; 
		var first_pid;
 
		var next_pid;
		var next_href;
		 
		var previous_pid;
		var previous_href;

		var a_href;
		var pid;
			jQuery(".pitem").each(function(){

				if (jQuery(this).is(":visible")){

					pid = jQuery(this).find('div.frame a').attr('data-cur-id');
					a_href = jQuery(this).find('.i2').attr('href');
					
					if(!first_href)first_href = a_href;
					if(!first_pid) first_pid= pid;
				  
				    if (next){
					   next_href = a_href;
					   next_pid=pid;
					   next=false;
				    }
					
					if (pid==me){
						next=true;
						previous=true;
					}
					if (!previous){
						previous_href = a_href ;
						previous_pid=pid;
						previous=false;
					}
				}
			});
		if(action=="next"){
			if (next_href)
			load_image(next_href,next_pid);
			else
			load_image(first_href,first_pid);
		}
		else{
			if(previous_href)
			load_image(previous_href,previous_pid);
			else
			load_image(a_href,pid);
		}
		});

});
<?php } ?>
</script>
<?php $isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID );

if($isrc&&$sf!='no') { ?>
<div class="<?php echo $fr; ?> frame_main <?php echo $roundy; ?> in">
	<div class="<?php echo $frin; ?> <?php echo $roundy; ?>">
		<a
			href="<?php if($plink=='page') echo get_permalink(); else echo $isrc[0];?>"
			<?php if($plink=='image') echo'data-rel="pp"';?> class="fade"><div
				class="fade_c"></div> <img
			src="<?php echo bfi_thumb($isrc[0], array('width' => 980, 'height'=>250, 'crop' => true)); ?>"
			class="<?php echo $roundy; ?> fade" alt="featured image" /> </a>
		<div class="cl"></div>

		<div class="cl"></div>

		<?php if($si!='no'){ foreach ($imgs as $att_id => $att) {
			$gall_img=wp_get_attachment_image_src($att_id);
			$gall_img_large=wp_get_attachment_image_src($att_id,'full');
			if($gall_img_large[0]!=$isrc[0]) echo '<a href="'.$gall_img_large[0].'" data-rel="pp[post-'.$post->ID.']" style="float:left;margin-top:1px;margin-left:0px;margin-right:2px;" class="fade"><div class="fade_c"></div><img src="'.bfi_thumb($gall_img[0], array('width' => 95, 'height'=>75, 'crop' => true)).'" class="'.$roundy.' fade" alt="thumb"/></a>';
		} } ?>

		<div class="cl"></div>
	</div>
</div>

		<?php echo $div_left; } ?>


<div id="scroll_to"></div>
<div id="load_image">
	<img src="<?php echo WP_THEME_URL.'/img/icons/close.png';?>"
		id="close_item" alt="<?php _e('close item','cb-cosmetico');?>"
		title="<?php _e('close item','cb-cosmetico');?>" />
	<div id="load_image_c">
		<div id="load_h"></div>
	</div>
	<div id="load_n"></div>
</div>


		<?php if($pfilter=='yes'||$pfilter==''){?>
<div class="frame bnone port_sorter">
	<div class="wrapper_p">
		<div class="framein round" id="port_par">
			<div>
				<a onclick="show_cat()" class="port_sho"><?php _e('All','cb-cosmetico'); ?>
				</a>
				<?php
				if(!$per_page) $per_page=10; $categories=get_categories('parent='.$cats);
				foreach ($categories as $category) {
					echo '<a class="port_sho" onclick="show_cat('.$category->cat_ID.')" data-id="'.$category->cat_ID.'">'.$category->name.'</a> ';
				} ?>
			</div>
		</div>
	</div>
</div>
<div class="cl" style="height: 52px;"></div>
				<?php } ?>
<div class="cl"></div>
<div class="port_els">
<?php
$cc=1;

query_posts('cat='.$cats.'&posts_per_page='.$per_page.'&paged='.get_query_var('paged'));
$thisCat = get_category(get_query_var('cat'),false);
if($thisCat) $max_posts=$thisCat->category_count; else $max_posts='';
if(have_posts()) :
while(have_posts()) : the_post() ?>
<?php

$output=''; $ccat='';
$c_cat=get_the_category();

foreach($c_cat as $c_cat_item) {
	$output .= ' cat-'.$c_cat_item->term_id ;
	$ccat .= $c_cat_item->term_id;

}
?>

	<div class="pitem <?php echo $col_v;?> <?php echo $output; ?>" data-id="<?php echo $ccat; ?>" style="<?php if($columns!=1&&$cc%$columns==0&&$cc!=0) echo 'margin-right: 0;'; ?>">


	<?php   $isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
	$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID );

	if($isrc=='') {$isrc=wp_get_attachment_image_src(array_shift(array_keys($imgs)),'full'); }

	$pshapediv='';
	$pshapecon='';
	if($pcap=='yes') $nocap=''; else $nocap=' nocap';
	if($pcap=='yes') $pcapy=''; else $pcapy='';
	$see_more=__('see more','cb-cosmetico');
	if($plink=='ajax') $picons='<div class="see_more_wrap"><div class="see_wrap2"><a data-cur-id="'.$post->ID.'" onclick="load_image(\''.$isrc[0].'\',\''.$post->ID.'\');return false;" href="'.$isrc[0].'"><img src="'.WP_THEME_URL.'/img/icons/arr_rw.png" class="fade-s fade_arr_r" alt="'.$see_more.'"/><h1><span class="fade_see">'.$see_more.'</span></h1></a></div></div><div class="cl"></div>';
	else $picons='<div class="see_more_wrap"><div class="see_wrap2"><a href="'.$isrc[0].'" data-rel="pp[ppgall]"><img src="'.WP_THEME_URL.'/img/icons/arr_rw.png" class="fade-s fade_arr_r" alt="'.$see_more.'"/><h1><span class="fade_see">'.$see_more.'</span></h1></a></div></div><div class="cl"></div>';
	if($plink=='page') $picons='<div class="see_more_wrap"><div class="see_wrap2"><a href="'.get_permalink().'"><img src="'.WP_THEME_URL.'/img/icons/arr_rw.png" class="fade-s fade_arr_r" alt="'.$see_more.'"/><h1><span class="fade_see">'.$see_more.'</span></h1></a></div></div><div class="cl"></div>';


	if($pshape!=''&&$pshape!='default'&&$pshape!='rectangle') {
		$pshapediv=$picons.'<div class="pshape-'.$pshape.'"></div>'; $fadec1=''; $fadec2='<div class="fade_c">'.$pcapy.'</div>';
		$pshapecon='portfolio-shape'.$nocap;
	} else {
		$pshapediv=''; $fadec1='<div class="fade_c">'.$pcapy.$picons.'</div>'; $fadec2=''; $pshapecon='';
	}



	if($isrc) { ?>
		<div
			class="<?php echo $fr; ?> fade  <?php if($pcap!='yes') echo 'nocap'; echo ' ';  echo $pshapecon; ?>">
			<div class="<?php echo $frin; ?> <?php echo $roundy; ?>">
			<?php echo $fadec1; ?>
			<?php echo $pshapediv.$fadec2; ?>
				<a <?php if($plink=='ajax') { ?>
					data-cur-id="<?php echo $post->ID; ?>"
					onclick="load_image('<?php echo $isrc[0]; ?>','<?php echo $post->ID; ?>');return false;"
					<?php } ?>
					href="<?php if($plink=='page') echo get_permalink(); else echo $isrc[0];?>"
					<?php  if($plink=='image') echo 'data-rel="pp"'; ?>><img
					src="<?php echo bfi_thumb($isrc[0], array('width' => $pwidth, 'height'=>$pheight, 'crop' => true)); ?>"
					class="<?php echo $roundy; ?> fade fade-si" alt="portfolio item" />
				</a>
				<div class="cl"></div>
			</div>


			<?php if($pcap!='yes'){ echo $headi.'<a href="'.get_permalink().'">'.get_the_title().'</a>'.$headi_end; ?>
			<?php } ?>

			<?php if($pcap=='yes'){
				$pcatso='';
				echo '<div class="portfolio_det">';
				$categoriesy=wp_get_post_categories($post->ID);
				foreach($categoriesy as $cate) {
					$category = get_category( $cate );
					$pcatso .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'cb-cosmetico' ), $category->name ) ) . '">'.$category->cat_name.'</a>, ';
				}
				$pcatso=substr($pcatso,0,-2);
				echo $headi.'<a href="'.get_permalink().'">'.get_the_title().'</a>'.$headi_end;
				echo '<span class="port_author">by: <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link skin-text">'.get_the_author().'</a></span>';
				echo '<span class="port_date">'.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'</span> / <span class="port_cats skin-text">'.$pcatso.'</span>';
				echo '</div>';
			}
			?>

		</div>

		<?php } else { ?>

		<div class="<?php echo $fr; ?> ">
			<div class="<?php echo $frin; ?> round">
				<a href="<?php echo get_permalink(); ?>"><img
					src="<?php echo bfi_thumb(WP_THEME_URL.'/img/test_bg.jpg', array('width' => 980, 'height'=>550, 'crop' => true)); ?>"
					class="<?php echo $roundy; ?> fade" alt="no image" /> </a>
				<div class="cl"></div>
			</div>

			<?php if($pcap=='yes'){
				$pcatso='';
				echo '<div class="portfolio_det">';
				$categoriesy=wp_get_post_categories($post->ID);
				foreach($categoriesy as $cate) {
					$category = get_category( $cate );
					$pcatso .= '<a href="'.get_category_link($category->term_id ).'" class="skin-text" title="' . esc_attr( sprintf( __( "View all posts in %s",'cb-cosmetico' ), $category->name ) ) . '">'.$category->cat_name.'</a>, ';
				}
				$pcatso=substr($pcatso,0,-2);
				echo $headi.'<a href="'.get_permalink().'">'.get_the_title().'</a>'.$headi_end;
				echo '<span class="port_author skin-text">by: <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link skin-text">'.get_the_author().'</a></span>';
				echo '<span class="port_date skin-text">'.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'</span> / <span class="port_cats skin-text">'.$pcatso.'</span>';
				echo '</div>';
			}
			?>

		</div>
		<?php } ?>



		<div class="port_item port_<?php echo $post->ID;?>">
		<?php echo '<h2 class="title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>'; ?>
		<?php
		$port_url=get_post_meta($post->ID,'cb5_port_url','true');
		$port_client=get_post_meta($post->ID,'cb5_port_client','true');
		$port_author=get_post_meta($post->ID,'cb5_port_author','true');
		$port_key=get_post_meta($post->ID,'cb5_port_key','true');
		if($port_author!='')echo '<h3 class="author">by: '.$port_author.'</h3>';
		echo '<ul>';
		if($port_client!='') echo '<li><h3>'.__('Project Client').':</h3>'.$port_client.'</li>';
		if($port_key!='') echo '<li><h3>'.__('Keywords').':</h3><i>'.$port_key.'</i></li>';
		echo '</ul>';
		echo '<h3>Project Details:</h3>';
		echo get_the_content();
		if($port_url!='') echo '<div class="view_project"><a href="'.$port_url.'" target="_blank" class="bttn_big very alt"><i class="icon-external-link"></i>'.__('view project','cb-cosmetico').'</a></div>';
		echo '<div class="port_arrows"><a class="cb-next-porfolio prev-arrow" data-me-id="'.$post->ID.'" data-action="prev">&laquo; '.__('previous item','cb-cosmetico').'</a><a class="cb-next-porfolio next-arrow" data-me-id="'.$post->ID.'" data-action="next">'.__('next item','cb-cosmetico').' &raquo;</a></div>';
		?>

		</div>

		<div class="c_item c_item_<?php echo $post->ID;?>"
			style="display: none;">
			<a href="#" class="prev_item">&laquo; <?php _e('prev item','cb-cosmetico');?>
			</a> <a href="#" class="next_item"><?php _e('next item','cb-cosmetico');?>
				&raquo;</a>
		</div>




		<div class="cl"></div>

	</div>
	<!--/portfolio post end-->

	<?php //if($columns!=1&&$cc%$columns==0&&$cc!=0) echo '<div class="cl"></div>'; ?>

	<?php $cc++; endwhile; else : ?>

	<?php get_template_part('cb-404'); ?>

	<?php endif; ?>
	<div class="cl"></div>
</div>
<div class="cl"></div>

<div class="load_wrap"></div>

	<?php

	if($pajax=='yes') echo '<a data-paged="2" class="cb_load_more view_all" data-posts='.$max_posts.' data-nonce="'.wp_create_nonce('load_posts').'" href="javascript:;"><i class="icon-refresh"></i> '.__('Load more','cb-cosmetico').'</a>';
	else {
		if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
		else if ($wp_query->max_num_pages > 1) : ?>
<div id="nav-below" class="navigation">
	<div class="nav-previous">
	<?php next_posts_link(__('&larr; Older posts','cb-cosmetico')); ?>
	</div>
	<div class="nav-next">
	<?php previous_posts_link(__('Newer posts &rarr;','cb-cosmetico')); ?>
	</div>
</div>
	<?php endif;
	}

	?>
<!--/ portfolio end-->
