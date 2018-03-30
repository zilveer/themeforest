<?php

/**************************************************************************/




/* columns */
function cols($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('s'=>''), $atts)));
	$return_html='<div class="cols">'.do_shortcode($content).'</div>';
	return apply_filters('cols', $return_html);
} add_shortcode('cols', 'cols');

function col2($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('s'=>'','m'=>'','blackbg'=>'','greybg'=>''), $atts)));
	if($s=='0') $s='style="margin-right:0px;'; else $s='style="';
	if($m=='0') $m='margin-bottom:0px;'; else $m='';
	$blackbg2='';
	if($blackbg=='yes') { $blackbg='blackbg'; $blackbg2='yes'; } else $blackbg='';
	if($greybg=='yes') { $greybg='greybg'; $blackbg2='yes'; } else $greybg='';
	if($blackbg2=='yes') { $b1='<div class="p20">'; $b2='</div>'; } else { $b1=''; $b2=''; }
	$return_html='<div class="col2 '.$blackbg.' '.$greybg.'" '.$s.$m.'">'.$b1.do_shortcode($content).$b2.'</div>';
	return apply_filters('col2', $return_html);
} add_shortcode('col2', 'col2');

function col3($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('s'=>'','m'=>'','blackbg'=>'','greybg'=>''), $atts)));
	if($s=='0') $s='style="margin-right:0px;'; else $s='style="';
	if($m=='0') $m='margin-bottom:0px;'; else $m='';
	$blackbg2='';
	if($blackbg=='yes') { $blackbg='blackbg'; $blackbg2='yes'; } else $blackbg='';
	if($greybg=='yes') { $greybg='greybg'; $blackbg2='yes'; } else $greybg='';
	if($blackbg2=='yes') { $b1='<div class="p20">'; $b2='</div>'; } else { $b1=''; $b2=''; }
	$return_html =  '<div class="col3 '.$blackbg.' '.$greybg.'" '.$s.$m.'">'.$b1.do_shortcode($content).$b2.'</div>';
	return apply_filters('col3', $return_html);
} add_shortcode('col3', 'col3');

function col4($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('s'=>'','m'=>'','blackbg'=>'','greybg'=>''), $atts)));
	$blackbg2='';
	if($s=='0') $s='style="margin-right:0px;'; else $s='style="';
	if($m=='0') $m='margin-bottom:0px;'; else $m='';
	if($blackbg=='yes') { $blackbg='blackbg'; $blackbg2='yes'; } else $blackbg='';
	if($greybg=='yes') { $greybg='greybg'; $blackbg2='yes'; } else $greybg='';
	if($blackbg2=='yes') { $b1='<div class="p20">'; $b2='</div>'; } else { $b1=''; $b2=''; }
	$return_html =  '<div class="col4 '.$blackbg.' '.$greybg.'" '.$s.$m.'">'.$b1.do_shortcode($content).$b2.'</div>';
	return apply_filters('col4', $return_html);
} add_shortcode('col4', 'col4');

function col_end($atts, $content = null){
	$return_html =  '<div class="cl"></div>';
	return apply_filters('col_end', $return_html);
} add_shortcode('col_end', 'col_end');
/* #end columns */

/**************************************************************************/

/* boxes */
function box($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('type'=>'','title'=>''), $atts)));
	if($title!='') { $title='<h3>'.$title.'</h3>';
	$st='style="padding-top:10px;"';
	}
	$return_html = '<div class="box '.$type.'">'.$title.do_shortcode($content).'</div>';
	return apply_filters('box', $return_html);
} add_shortcode('box', 'box');
/* #end boxes */

/**************************************************************************/

/* buttons */
function bttn($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('link' => '#', 'target' => '_self', 'class' => '','a'=>'', 'round' => '', 'img' => '', 'w' => '', 'h' => '', 'alt'=>'no alt', 'pp'=>'no', 'sizer'=>''), $atts)));
	if($round=='no') $round = '';
	else $round='round';
	if($w=='') $w = '100';
	if($h=='') $h = '75';
	if($sizer=='big') $sizer='_big';
	if($sizer=='verybig') $sizer='_big very';
	if($pp=='yes') { $pp =' data-rel="pp"'; $cl=' pp';}
	if(($img!=''&&$link=='#')||($img!=''&&$link=='')) $link=$img;
	$fade='';$fade_d='';
	if($pp=='no') $pp='';
	if($img!='') {$fade='<div class="fade_c"><a class="icon i1" href="'.$link.'"><i class="icon-link"></i></a></div>'; $fade_d=' class="fade"';}
	if($img!='') $return_html = '<div class="frame" style="display:inline-block;margin:5px 0 5px 0;width:auto;"><div'.$fade_d.'><a href="'.$link.'" target="'.$target.'"'.$pp.' class="'.$class.'">'.$fade.'<img src="'.bfi_thumb($img, array('width' => $w, 'height'=>$h, 'crop' => true)).'"   class="'.$round.' '.$a.' " alt="'.$alt.'" style="width:'.$w.'px;height:'.$h.'px;"/></a></div></div>';
	else $return_html = '<a href="'.$link.'" target="'.$target.'" class="bttn'.$sizer.' '.$a.' '.$class.' '.$round.'"'.$pp.'>'.do_shortcode($content).'</a>';
	return apply_filters('bttn', $return_html);
} add_shortcode('bttn', 'bttn');
/* #end buttons */

/**************************************************************************/

/* icons */
function icon($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('icon'=>'1','align'=>'absmiddle', 'alt'=>'icon','color'=>'black'), $atts)));
	if($color=='white') $colo='white/'; else $colo='';
	$return_html = '<img src="'.WP_THEME_URL.'/img/icons/'.$colo.$icon.'.png" align="'.$align.'" alt="'.$alt.'" class="cb_icon"/>';
	return apply_filters('icon', $return_html);
} add_shortcode('icon', 'icon');
/* #end icons */

/**************************************************************************/

/* list */
function list1($atts, $content = null){
	$return_html = '<div class="list1">'.do_shortcode($content).'</div>';
	return apply_filters('list1', $return_html);
} add_shortcode('list1', 'list1');

function list2($atts, $content = null){
	$return_html = '<div class="list2">'.do_shortcode($content).'</div>';
	return apply_filters('list2', $return_html);
} add_shortcode('list2', 'list2');

function list3($atts, $content = null){
	$return_html = '<div class="list3">'.do_shortcode($content).'</div>';
	return apply_filters('list3', $return_html);
} add_shortcode('list3', 'list3');

function list4($atts, $content = null){
	$return_html = '<div class="list4">'.do_shortcode($content).'</div>';
	return apply_filters('list4', $return_html);
} add_shortcode('list4', 'list4');

function list5($atts, $content = null){
	$return_html = '<div class="list5">'.do_shortcode($content).'</div>';
	return apply_filters('list5', $return_html);
} add_shortcode('list5', 'list5');
/* #end list */

/**************************************************************************/
function portfolio($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('pcat'=> '','det'=>'no','plink'=>'','pajax'=>'','pshape'=>'','pitems'=>'','pcolumns'=>'','pcap'=>'','filter'=>'','filtera'=>'','view'=>''), $atts)));
	echo '<div class="portfolio_block_wrap">';

	$columns=$pcolumns;
	$cats=$pcat;
	if($plink=='yes') $plink='page';
	if($pajax=='yes') $plink='ajax';
	$per_page=$pitems;
	$col_v='col'.$columns;

	$fade='yes'; $roundy='round'; $fr='frame'; $frin='framein';

	if($pshape!=''&&$pshape!='default') $headis=' style="text-align:center;"'; else $headis='';

	$headi='<h2 class="in wn"'.$headis.'>'; $headi_end='</h2>';

	$pheight='550';
	if($pshape!=''&&$pshape!='default') $pheight="850";

	if($columns=='2') { $headi='<h3 class="in wn"'.$headis.'>'; $headi_end='</h3>'; }
	if($columns=='3') { $headi='<h4 class="in wn"'.$headis.'>'; $headi_end='</h4>'; }
	if($columns=='4') { $headi='<h4 class="in wn"'.$headis.'>'; $headi_end='</h4>'; }
	if(!isset($roundy))$roundy='';
	if(!$per_page) $per_page=10; $categories=get_categories('parent='.$cats);
	$bfi_w=980;
	if($columns!='1')$bfi_w=$bfi_w/$columns;
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
    
	jQuery.post( ajaxurl, { action: 'cbloader',typ:'port',cats:'<?php echo $cats; ?>',paged:paged,per_page:'<?php echo $per_page; ?>',col_v:'<?php echo $col_v; ?>',columns:'<?php echo $columns; ?>',pcap:'<?php echo $pcap; ?>',headi:'<?php echo $headi; ?>',headi_end:'<?php echo $headi_end; ?>',plink:'<?php echo $plink; ?>',pshape:'<?php echo $pshape; ?>',fr:'<?php echo $fr; ?>',frin:'<?php echo $frin; ?>',pheight:'<?php echo $pheight; ?>',roundy:'<?php echo $roundy; ?>',det:'<?php echo $det; ?>',bfi_w:'<?php echo $bfi_w; ?>',security:'<?php echo wp_create_nonce('cosmetico-settings'); ?>'}, function(data){
 

  jQuery('.load_wrap').append(data);
  var postbox_length=jQuery('.port_els .pitem').length;
  if(postbox_length==max_posts) { jQuery('.cb_load_more').fadeOut(); }

  jQuery('html, body').animate({
         scrollTop: jQuery(".load_wrap").offset().top - 50 
     }, 500);
  });
});

});
//LOADER END

function show_cat(cat){
jQuery(".pitem").hide();
var columns = <?php echo $columns;?>;
jQuery('.port_els .pitem').css("margin-right","");
  if(!cat) {
	   var counter = 1;
	     jQuery(".pitem").each(function(){ 
	        if(counter%columns==0)
	            jQuery(this).css("margin-right","0");
	        counter++;
	    });
  jQuery('.port_els .pitem:hidden').fadeIn('slow'); 
  }
  else { 
      var counter = 1;
		jQuery('.cat-'+cat).each(function(){ 
      if(counter%columns==0)
          jQuery(this).css("margin-right","0");
      counter++;
  	});
  jQuery('.port_els .pitem').not('.cat-'+cat).hide(); 
  jQuery('.cat-'+cat+':hidden').fadeIn('slow'); 
   
   
   }


 }
<?php if($plink=='ajax') { ?>
function load_image(src,pid){
jQuery("#load_h").slideDown('slow');
jQuery("#load_image_c").slideDown('slow');
jQuery('#load_image_c').empty();
jQuery('html, body').animate({scrollTop:jQuery('#scroll_to').offset().top - 137}, 'slow');
var getpi=jQuery('.port_'+pid).html();
jQuery('#load_image_c').append('<div id="im" style="display:none;"><img id="img_load" src="'+src+'"></div><div class="port_item_in">'+getpi+'</div><div class="cl"></div>');
jQuery('#img_load').load(function() {
jQuery("#load_h").fadeOut('slow');
jQuery("#close_item").fadeIn('slow');

jQuery(this).removeAttr('height').removeAttr('width');
    cloned = jQuery(this).clone().css({visibility:'hidden'});
    jQuery('body').append(cloned);
    o_width = cloned.get(0).width; 
    o_height = cloned.get(0).height; 
    cloned.remove();
	//if (o_height>jQuery(window).height() )jQuery(this).attr({height:jQuery(window).height()});
	if (o_width>790)jQuery(this).attr({width:790});
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


<div id="scroll_to"></div>
<?php if($plink=='ajax'){ ?>
<div id="load_image">
	<img src="<?php echo WP_THEME_URL.'/img/icons/close.png';?>"
		id="close_item" alt="<?php _e('close item','cb-cosmetico');?>"
		title="<?php _e('close item','cb-cosmetico');?>" />
	<div id="load_image_c">
		<div id="load_h"></div>
	</div>
	<div id="load_n"></div>
</div>
<?php } ?>

<?php if($filtera!='') $filtera='style="text-align:'.$filtera.';"'; else $filtera='';
if($filter=='yes'){?>
<div class="frame round bnone port_sorter">
	<div class="wrapper_p">
		<div class="framein round" id="port_par">
			<div <?php echo $filtera;?>>
				<a onclick="show_cat()" class="port_sho"><?php _e('All','cb-cosmetico'); ?>
				</a>
				<?php

				foreach ($categories as $category) {
					echo '<a class="port_sho" onclick="show_cat('.$category->cat_ID.')" data-id="'.$category->cat_ID.'">'.$category->name.'</a> ';
				} ?>
			</div>
		</div>
	</div>
</div>
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
<?php global $post;
/*$catcount = get_the_category();
 $max_posts=$catcount[0]->category_count;*/
$output=''; $ccat='';
$c_cat=get_the_category();

foreach($c_cat as $c_cat_item) {
	$output .= ' cat-'.$c_cat_item->term_id ;
	$ccat .= $c_cat_item->term_id;

}
?>

	<div class="pitem <?php echo $col_v;?> <?php echo $output; ?>" data-id="<?php echo $ccat; ?>" style="<?php if($columns!=1&&$cc%$columns==0&&$cc!=0) echo 'margin-right: 0;'; ?>">

	<?php /*if($pcap!='yes'){ echo $headi.'<a href="'.get_permalink().'">'.get_the_title().'</a>'.$headi_end; ?><?php } ?> */

	$isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
	$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID );

	if($isrc=='') {$isrc=wp_get_attachment_image_src(array_shift(array_keys($imgs)),'full'); }
	$bfi_var='';
	if($pshape==''||$pshape=='rectangle'||$pshape=='default') $bfi_var=bfi_thumb($isrc[0], array('width' => $bfi_w,'height' => $bfi_w*1.2, 'crop' => true));
	else $bfi_var=bfi_thumb($isrc[0], array('width' => $bfi_w, 'height'=>$pheight, 'crop' => true));
	$pshapediv='';
	$pshapecon='';
	if($pcap=='yes') $nocap=''; else $nocap=' nocap';
	if($pcap=='yes') $pcapy=''; else $pcapy='';
	$see_more=__('see more','cb-cosmetico');
	if($plink=='ajax') $picons='<div class="see_more_wrap"><div class="see_wrap2"><a data-cur-id="'.$post->ID.'" onclick="load_image(\''.$isrc[0].'\',\''.$post->ID.'\');return false;" href="'.$isrc[0].'"><img src="'.WP_THEME_URL.'/img/icons/arr_rw.png" class="fade-s fade_arr_r" alt="'.$see_more.'"/><h1><span class="fade_see">'.$see_more.'</span></h1></a></div></div><div class="cl"></div>';
	else $picons='<div class="see_more_wrap"><div class="see_wrap2"><a href="'.$isrc[0].'" data-rel="pp[ppgall]"><img src="'.WP_THEME_URL.'/img/icons/arr_rw.png" class="fade-s fade_arr_r" alt="'.$see_more.'"/><h1><span class="fade_see">'.$see_more.'</span></h1></a></div></div><div class="cl"></div>';
	if($plink=='yes') $picons='<div class="see_more_wrap"><div class="see_wrap2"><a href="'.get_permalink().'"><img src="'.WP_THEME_URL.'/img/icons/arr_rw.png" class="fade-s fade_arr_r" alt="'.$see_more.'"/><h1><span class="fade_see">'.$see_more.'</span></h1></a></div></div><div class="cl"></div>';


	if($pshape!=''&&$pshape!='default'&&$pshape!='rectangle') {
		$pshapediv=$picons.'<div class="pshape-'.$pshape.'"></div>'; $fadec1=''; $fadec2='<div class="fade_c">'.$pcapy.'</div>';
		$pshapecon='portfolio-shape'.$nocap;
	} else {
		$pshapediv=''; $fadec1='<div class="fade_c">'.$pcapy.$picons.'</div>'; $fadec2=''; $pshapecon='';
	}



	if($isrc) { ?>
		<div
			class="<?php echo $fr; ?> <?php echo $roundy; ?> fade <?php echo $pshapecon; ?>">
			<div class="<?php echo $frin; ?> <?php echo $roundy; ?>">
			<?php echo $fadec1; ?>
			<?php echo $pshapediv.$fadec2; ?>
				<a <?php if($plink=='ajax') { ?>
					data-cur-id="<?php echo $post->ID; ?>"
					onclick="load_image('<?php echo $isrc[0]; ?>','<?php echo $post->ID; ?>');return false;"
					<?php } ?>
					href="<?php if($plink=='page') echo get_permalink(); else echo $isrc[0];?>"
					<?php  if($plink=='image') echo 'data-rel="pp"'; ?>><img
					src="<?php echo $bfi_var; ?>"
					class="<?php echo $roundy; ?> fade fade-si" alt="portfolio item" />
				</a>
				<div class="cl"></div>
			</div>

			<?php if($det=='yes'){
				$pcatso='';
				echo '<div class="portfolio_det">';
				$categoriesy=wp_get_post_categories($post->ID);
				foreach($categoriesy as $cate) {
					$category = get_category( $cate );
					$pcatso .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'cb-cosmetico' ), $category->name ) ) . '">'.$category->cat_name.'</a>, ';
				}
				$pcatso=substr($pcatso,0,-2);
				echo $headi.'<a href="'.get_permalink().'">'.get_the_title().'</a>'.$headi_end;
				echo '<span class="port_author">by: <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link">'.get_the_author().'</a></span>';
				echo '<span class="port_date">'.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'</span> / <span class="port_cats">'.$pcatso.'</span>';
				echo '</div>';
			}
			?>

		</div>

		<?php } else { ?>

		<div class="<?php echo $fr; ?> <?php echo $roundy; ?>">
			<div class="<?php echo $frin; ?> round">
				<a href="<?php echo get_permalink(); ?>"><img
					src="<?php echo bfi_thumb(WP_THEME_URL.'/img/test_bg.jpg', array('width' => 980, 'height'=>950, 'crop' => true)); ?>"
					class="<?php echo $roundy; ?> fade" alt="no image" /> </a>
				<div class="cl"></div>
			</div>

			<?php if($det=='yes'){
				$pcatso='';
				echo '<div class="portfolio_det">';
				$categoriesy=wp_get_post_categories($post->ID);
				foreach($categoriesy as $cate) {
					$category = get_category( $cate );
					$pcatso .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'cb-cosmetico' ), $category->name ) ) . '">'.$category->cat_name.'</a>, ';
				}
				$pcatso=substr($pcatso,0,-2);
				echo $headi.'<a href="'.get_permalink().'">'.get_the_title().'</a>'.$headi_end;
				echo '<span class="port_author">by: <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link">'.get_the_author().'</a></span>';
				echo '<span class="port_date">'.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'</span> / <span class="port_cats">'.$pcatso.'</span>';
				echo '</div>';
			}
			?>

		</div>

		<?php } ?>

		<div class="port_item port_<?php echo $post->ID;?>">
		<?php echo '<h2 class="title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>'; ?>
		<?php echo get_the_content(); ?>
		<?php
		$port_url=get_post_meta($post->ID,'cb5_port_url','true');
		$port_client=get_post_meta($post->ID,'cb5_port_client','true');
		$port_key=get_post_meta($post->ID,'cb5_port_key','true');
		echo '<ul>';
		if($port_url!='') echo '<li><b>'.__('Project URL').'</b>: <a href="'.$port_url.'" target="_blank">'.$port_url.'</a></li>';
		if($port_client!='') echo '<li><b>'.__('Project Client').'</b>: '.$port_client.'</li>';
		if($port_key!='') echo '<li><b>'.__('Keywords').'</b>: <i>'.$port_key.'</i></li>';
		echo '</ul>';
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
	<?php $cc++; endwhile;
	endif;
	wp_reset_query();
	?>
	<div class="cl"></div>
</div>
<div class="cl"></div>
	<?php
	if($view=='yes'){
		echo '<a data-paged="2" data-posts='.$max_posts.' class="cb_load_more view_all" data-nonce="'.wp_create_nonce('load_posts').'" href="javascript:;"><i class="icon-refresh"></i> '.__('load more','cb-cosmetico').'</a>'; }

		?>

<div class="load_wrap"></div>

</div>




		<?php
} add_shortcode('portfolio', 'portfolio');











/**************************************************************************/
/* tabs */
function tabs($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('ver' => 'no'), $atts)));
	global $framedtabsheading;
	$framedtabsheading = '';
	esc_attr(extract(shortcode_atts(array('name' => ''), $atts)));
	$get_tabs = do_shortcode($content);
	$k = 0;
	$out='';
	if($ver=='yes') $out .= '<div class="tabs round ui-tabs-vertical ui-helper-clearfix"><ul>';
	else
	$out .= '<div class="tabs round"><ul>';
	while(isset($framedtabsheading[$k])){
		$out .= $framedtabsheading[$k];
		$k++;
	}
	$out .= '</ul>'.$get_tabs.'</div>';
	return apply_filters('tabs', $out);
} add_shortcode('tabs', 'tabs');

function tab($atts, $content = null) {
	global $framedtabsheading;
	esc_attr(extract(shortcode_atts(array('name' => '','icon'=>''), $atts)));
	$icon= html_entity_decode($icon);
	$k = 0;
	while(isset($framedtabsheading[$k])) { $k++;}
	$framedtabsheading[] = '<li><a href="#tabs-'.($k+1).'"><span>'.$icon.$name.'</span></a></li>';
	$out = '<div id="tabs-'.($k+1).'" class="tabcontent">'.do_shortcode($content).'</div>';
	return apply_filters('tab', $out);
} add_shortcode('tab', 'tab');
/* #end tabs */

/**************************************************************************/

/* youtube */
function yt($atts, $content = null) {
	esc_attr(extract(shortcode_atts(array('link' => '', 'alt'=>'', 'w' => '500', 'h' => '300', 'pp' => '', 'info' => '0', 'controls' => '1'), $atts)));
	$video='';
	if (preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link, $match)) { $video = $match[1];
	}
	if($pp!='yes') { $out = '<iframe class="margin cb5_media" width="'.$w.'" height="'.$h.'" src="http://www.youtube.com/embed/'. $video.'?wmode=transparent&amp;controls='.$controls.'&amp;showinfo='.$info.'" title="'.$alt.'"></iframe>';
	}
	else { $out = '<a href="'.$link.'" data-rel="pp" class="margin pp vido"><img src="http://i1.ytimg.com/vi/'.$video.'/0.jpg"/></a>';
	}
	return apply_filters('yt', $out);
} add_shortcode('yt', 'yt');

/* vimeo */
function vimeo($atts, $content = null) {
	esc_attr(extract(shortcode_atts(array('link' => '', 'alt'=>'', 'w' => '500', 'h' => '300', 'pp' => ''), $atts)));
	$video = substr($link,17,8);
	if($pp!='yes') { $out = '<iframe class="margin cb5_media" width="'.$w.'" height="'.$h.'" src="http://player.vimeo.com/video/'.$video.'?title=0&amp;byline=0&amp;portrait=0" title="'.$alt.'"></iframe>';
	}
	else {
		if (!function_exists('curl_init')) die('CURL is not installed!');
		$cu = curl_init();
		curl_setopt($cu, CURLOPT_URL, "http://vimeo.com/api/v2/video/".$video.".php");
		curl_setopt($cu, CURLOPT_HEADER, 0);
		curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cu, CURLOPT_TIMEOUT, 10);
		$opt = unserialize(curl_exec($cu));
		$vimg = $opt[0]['thumbnail_large'];
		curl_close($cu);
		$out = '<a href="'.$link.'" data-rel="pp" class="margin pp vido"><img src="'.$vimg.'"/></a>';
	}
	return apply_filters('vimeo', $out);
} add_shortcode('vimeo', 'vimeo');
/* #end video */

/**************************************************************************/

/* cb-gallery */
function gall($atts, $content = null) {
	esc_attr(extract(shortcode_atts(array('post_id'=>'','gcap'=>'no','post_number'=>'5','style'=>'margin:10px;float:left;','h'=>'155','w'=>'125','round'=>'yes','order'=>'DESC'), $atts)));
	if(is_numeric($post_id)&&$post_id!='') { $out = '<div class="gall_single">';
	$args = array(
		'post_type'   => 'attachment',
		'numberposts' => $post_number,
		'post_parent' => $post_id,
		'order' => $order
	);
	$rand=substr(rand(),0,4);
	$attachments = get_posts($args);
	if($round=='yes') $round='class="round"';
	if ($attachments) {
		foreach ($attachments as $attachment) {
			$a_t='';
			if($gcap=='yes') $a_t='<div class="cap">'.$att->post_title.'</div>'; else $a_t='';
			$isrc=wp_get_attachment_image_src($attachment->ID,'full');
			$isrc_full=wp_get_attachment_image_src($attachment->ID,'full');
			$out.='<div style="'.$style.';float:left;"><div class="frame"><div class="frame_in"><div class="fade_c">'.$a_t.'<a class="icon i2" href="'.$isrc_full[0].'" data-rel="pp" ><i class="icon-search"></i></a></div><a class="fade" href="'.$isrc_full[0].'" data-rel="pp[pp_gall'.$post_id.$rand.']"><img src="'.bfi_thumb($isrc[0], array('width' => $w, 'height'=>$h, 'crop' => true)).'" '.$round.' style="width:'.$w.'px;height:'.$h.'px;" alt="gallery"/></a></div></div></div>';
		}
	}
	$out.='</div><div class="cl"><br/><br/></div>';
	}
	else $out = 'cb-gall shortcode err...';
	return apply_filters('gall', $out);
} add_shortcode('gall', 'gall');
/* #end gall */

/**************************************************************************/

/* cb-clients */
function clients($atts, $content = null) {
	esc_attr(extract(shortcode_atts(array('link'=>'yes','style'=>'','h'=>'100','order'=>'DESC'), $atts)));
	if($content!='') {
		$out='<li><div class="clients-container"><div class="clients-slide-wrap"><div class="clients-slide widget">';

		foreach(preg_split("/,/", $content) as $line){
			$line_explode=explode('{}',$line); if(!isset($line_explode[0]))$line_explode[0]=''; if(!isset($line_explode[1]))$line_explode[1]=''; $l_img=$line_explode[0]; $l_link=$line_explode[1]; if($l_link=='') $l_title='#';
			$out.='<a href="'.$l_link.'" style="padding-right:55px;"><img alt="" src="'.bfi_thumb($l_img, array('height'=>$h, 'crop' => false)).'" height="'.$h.'" /></a>';
		}

		$out.='<div class="cl"></div>
</div></div>
<div class="clients-slide-controls">
    <a href="#" class="prev" title="previous"><img src="http://cb-theme.com/demo/cosmetico/wp-content/themes/cb-cosmetico/img/icons/arr_l.png" alt="previous" class="transi"/></a>
    <a href="#" class="next" title="next"><img src="http://cb-theme.com/demo/cosmetico/wp-content/themes/cb-cosmetico/img/icons/arr_r.png" alt="next" class="transi"/></a>
</div></div>
</li>';

	} else $out = 'cb-clients shortcode err...';

	return apply_filters('clients', $out);
} add_shortcode('clients', 'clients');
/* #end clients */

/**************************************************************************/

function slider($atts, $content = null) {
	esc_attr(extract(shortcode_atts(array('post_id'=>'','post_number'=>'5','style'=>'','h'=>'700','w'=>'980','pp'=>'no','order'=>'DESC','mb'=>''), $atts)));

	wp_enqueue_style('any', WP_THEME_URL.'/inc/js/anything_slider/css/anythingslider.css', false, '1.0', 'screen');
	wp_enqueue_script('anyeasing',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.easing.1.2.js', array('jquery'), '1.0', true);
	wp_enqueue_script('any',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('anyfx',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.fx.min.js', array('jquery'), '1.0', true);
	if($mb!='') { $mb1=' aq_mb'; $mb2=' style="margin-bottom:'.$mb.'px!important;"'; }
	else { $mb1=''; $mb2=''; }
	if(is_numeric($post_id)&&$post_id!='') {
		$args = array(
		'post_type'   => 'attachment',
		'numberposts' => $post_number,
		'post_parent' => $post_id,
		'order' => $order
		);
		$attachments = get_posts($args);
		$h2=$h+10;
		$id=substr(rand(),0,3);
		$out='<script type="text/javascript">
jQuery(function(){
"use strict";
jQuery(\'#slider'.$post_id.$id.'\').anythingSlider({
resizeContents       : true,	
hashTags            : false,
animationTime       : 200,
delay:8000,
autoPlay:true
});
});
</script>
<div class="any-slider-container '.$mb1.'" '.$mb2.'><div style="'.$style.'"><ul id="slider'.$post_id.$id.'" style="width:'.$w.'px;height:'.$h2.'px;" class="slider any-slider">';
		if ($attachments) {
			$u=0;
			foreach ($attachments as $attachment) {
				$u++;
				$isrc=wp_get_attachment_image_src($attachment->ID,'full');
				$isrc_full=wp_get_attachment_image_src($attachment->ID,'full');
				if($pp=='yes') { $ppr = '<a href="'.$isrc_full[0].'" data-rel="pp['.$post_id.$id.']">';$ppe = '</a>'; }
				$out.='<li class="panel'.$u.'"><div class="textSlide">'.$ppr.'<img src="'.bfi_thumb($isrc_full[0], array('width' => $w, 'height'=>$h, 'crop' => true)).'" class="round" width="'.$w.'" height="'.$h.'" alt="slide"/>'.$ppe.'</div></li>';
			}
		}
		$out.='</ul></div><div class="cl"></div>';
	}
	else if($content!='') {
		$h2=$h+10;
		$id=substr(rand(),0,4);
		$out='<script type="text/javascript">
jQuery(function(){
"use strict";
jQuery(\'#slider'.$id.'\').anythingSlider({
resizeContents      : false,	
hashTags            : false,
animationTime       : 200,
delay:8000,
autoPlay:true
});
});
</script>
<div class="any-slider-container '.$mb1.'" '.$mb2.'><div style="'.$style.'"><ul id="slider'.$id.'" class="any-slider">';
		$u=0;
		$uc=0; $ppr='';$ppe='';
		foreach(preg_split("/,/", $content) as $line){
			$uc++;}
			foreach(preg_split("/,/", $content) as $line){
				$video='';
				$line = str_replace('<p>','',$line);
				$line = str_replace('</p>','',$line);
				$line = str_replace('&#215;','x',$line);
				if($pp=='yes') { $ppr = '<a href="'.$line.'" data-rel="pp['.$post_id.$id.']" class="fade">';$ppe = '</a>'; }
				if (preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $line, $match)) { $video = $match[1];}
				if($video!='') {
					wp_enqueue_script('videojs',WP_THEME_URL.'/inc/js/video-js/video.min.js', array('jquery'), '1.0', true);
					$out.= '<li class="panel'.$u.'"><div class="textSlide"><iframe class="margin" width="'.$w.'" height="'.$h.'" src="http://www.youtube.com/embed/'. $video.'?wmode=transparent"></iframe></div></li>'; }
					else {
						$out.='<li class="panel'.$u.'"><div class="textSlide">'.$ppr.'<div class="fade_c"></div><img src="'.bfi_thumb($line, array('width' => $w, 'height'=>$h, 'crop' => true)).'" class="round" width="'.$w.'" height="'.$h.'" alt="slide"/>'.$ppe.'</div></li>'; }$u++; }
						$out.='</ul></div><div class="cl"></div></div>';

	}
	else $out = 'cb-slider shortcode err...';

	return apply_filters('slider', $out);
} add_shortcode('slider', 'slider');
/* #end slider */

/**************************************************************************/

function testimonials($atts, $content = null) {
	esc_attr(extract(shortcode_atts(array('w'=>'600'), $atts)));
	$id=substr(rand(),0,3);
	$id2=substr(rand(),0,3);
	wp_enqueue_style('any', WP_THEME_URL.'/inc/js/anything_slider/css/anythingslider.css', false, '1.0', 'screen');
	wp_enqueue_script('anyeasing',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.easing.1.2.js', array('jquery'), '1.0', true);
	wp_enqueue_script('any',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('anyfx',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.fx.min.js', array('jquery'), '1.0', true);

	$out='<div class="testimonials"><script type="text/javascript">
jQuery(function(){
"use strict";
jQuery(\'#testimonials'.$id.$id2.'\').anythingSlider({
resizeContents       : false,	
hashTags            : false,
animationTime       : 300,
delay:6000,
autoPlay:true	
});
});
</script>
<ul id="testimonials'.$id.$id2.'" style="width:auto;height:auto;list-style:none;overflow-y:auto;overflow-x:hidden;" class="slider">';
	if($content!='') {

		$out.=do_shortcode($content);

		$out.='</ul><div class="cl"></div></div>';

	}
	else $out = 'cb-testimonials shortcode err...';

	return apply_filters('testimonials', $out);
} add_shortcode('testimonials', 'testimonials');

function testimonial($atts, $content = null) {
	esc_attr(extract(shortcode_atts(array('author'=>'','company'=>'','link'=>''), $atts)));
	$out='';
	if($author!='') $det='<span class="author">'.$author.'</span>';
	if($link=='') $link='#';
	if($author!=''&&$company!='') $det.=', ';
	if($company!='') $det.='<span class="company"><a href="'.$link.'">'.$company.'</a></span>';
	$id=substr(rand(),0,3);
	$out.='<li class="panel'.$id.'"><div class="textSlide"><div class="testimonial_content">'.$content.'</div>'.$det.'</div></li>';

	return apply_filters('testimonial', $out);
} add_shortcode('testimonial', 'testimonial');


/* #end testimonials */

/**************************************************************************/

/* dividers */
function divider1($atts, $content = null){
	$out =  '<div class="divider1"></div>';
	return apply_filters('divider1', $out);
} add_shortcode('divider1', 'divider1');

function divider2($atts, $content = null){
	$out =  '<div class="divider2"></div>';
	return apply_filters('divider2', $out);
} add_shortcode('divider2', 'divider2');

function divider3($atts, $content = null){
	$out =  '<div class="divider3"></div>';
	return apply_filters('divider3', $out);
} add_shortcode('divider3', 'divider3');

function divider4($atts, $content = null){
	$out =  '<div class="divider4"></div>';
	return apply_filters('divider4', $out);
} add_shortcode('divider4', 'divider4');

function divider1_white($atts, $content = null){
	$out =  '<div class="divider1_white"></div>';
	return apply_filters('divider1_white', $out);
} add_shortcode('divider1_white', 'divider1_white');

function divider2_white($atts, $content = null){
	$out =  '<div class="divider2_white"></div>';
	return apply_filters('divider2_white', $out);
} add_shortcode('divider2_white', 'divider2_white');

function divider3_white($atts, $content = null){
	$out =  '<div class="divider3_white"></div>';
	return apply_filters('divider3_white', $out);
} add_shortcode('divider3_white', 'divider3_white');

function divider4_white($atts, $content = null){
	$out =  '<div class="divider4_white"></div>';
	return apply_filters('divider4_white', $out);
} add_shortcode('divider4_white', 'divider4_white');

function divider5($atts, $content = null){
	$out =  '<div class="divider5"></div><div class="divider5cl"></div>';
	return apply_filters('divider5', $out);
} add_shortcode('divider5', 'divider5');
/* #end dividers */

/**************************************************************************/

/* opa bg */
function w_50($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('a' => 'none'), $atts)));
	if($a=='left') $a='style="float:left;"';
	if($a=='right') $a='style="float:right;"';
	if($a=='center') $a='style="margin:0 auto;"';
	$out =  '<div class="w_50" '.$a.'>'.do_shortcode($content).'</div><div class="cl"></div>';
	return apply_filters('w_50', $out);
} add_shortcode('w_50', 'w_50');
function b_50($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('a' => 'none'), $atts)));
	if($a=='left') $a='style="float:left;"';
	if($a=='right') $a='style="float:right;"';
	if($a=='center') $a='style="margin:0 auto;"';
	$out = '<div class="b_50" '.$a.'>'.do_shortcode($content).'</div><div class="cl"></div>';
	return apply_filters('b_50', $out);
} add_shortcode('b_50', 'b_50');
/* #end opa bg */
function callout($atts, $content = null){
	extract(shortcode_atts(array('color' => 'blue','icon'=>''), $atts));
	$icon= html_entity_decode($icon);
	$out =  '<div class="callout '.$color.'">'.$icon.do_shortcode($content).'</div>';
	return $out;
} add_shortcode('callout', 'callout');

/**************************************************************************/

/* frame */
function frame($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('class' => ''), $atts)));
	$out='<div class="frame '.$class.'"><div class="framein">'.do_shortcode($content).'</div></div>';
	return apply_filters('frame', $out);
} add_shortcode('frame', 'frame');
/* #end frame */
/**************************************************************************/
/* frame */
function clear_space($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('hg' => '40'), $atts)));
	$out='<div class="cl"></div><div style="height:'.$hg.'px;"></div><div class="cl"></div>';
	return apply_filters('clear_space', $out);
} add_shortcode('clear_space', 'clear_space');
/* #end frame */
/**************************************************************************/
function team($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('title'=>'Team Member','web'=>'','tw'=>'','fb'=>'','in'=>'','e'=>'',
'image'=>''), $atts)));
	if(is_email($e)) $e=antispambot($e);
	if($image!='') $image=bfi_thumb($image, array('width' => 600, 'height'=>650, 'crop' => true));
	$out='<div class="frame"><div class="frame_in fade team">
<div class="team_image single_image"><div class="fade_c team1"><div class="mail-icon">';
	if($e!='') $out.='<a class="e" href="mailto:'.$e.'" target="_blank"><i class="icon-envelope"></i></a>';
	$out.='</div></div><img class="round" src="'.$image.'" alt="'.$title.'"/></div>
<div class="team_inside"><div class="fade_c team2">';
	$out.='<div class="team_icons">';
	if($tw!='') $out.='<a class="tw" href="'.$tw.'" target="_blank"><i class="icon-twitter"></i></a>';
	if($fb!='') $out.='<a class="fb" href="'.$fb.'" target="_blank"><i class="icon-facebook"></i></a>';
	if($in!='') $out.='<a class="in" href="'.$in.'" target="_blank"><i class="icon-linkedin"></i></a>';
	if($web!='') $out.='<a class="web" href="'.$web.'" target="_blank"><i class="icon-external-link"></i></a>';
	$out.='<div class="cl"></div></div>';
	$out.='</div><h2>'.do_shortcode($content).'</h2>';
	if($title!='') $out.='<span class="team_position">'.$title.'</span>';

	$out.='<div class="cl"></div></div></div></div>';
	return apply_filters('team', $out);
} add_shortcode('team', 'team');

/**************************************************************************/

/* google maps */
function gmap($atts) {
	esc_attr(extract(shortcode_atts(array('w' => 400, 'h' => 350,'gray'=>'no', 'lat' => 0, 'lng' => 0, 'zoom' => 12,'type' => 'm1','address' => '','title' => '','info' => '','show_info' => false,'icon' => '','css'=>''), $atts)));
	$rnd = substr(rand(),0,5);$out='';
	if($title!='') $out='<h3>'.html_entity_decode($title).'</h3>';
	if($type=='m1') $typ = ',mapTypeId: google.maps.MapTypeId.ROADMAP';
	if($type=='m2') $typ = ',mapTypeId: google.maps.MapTypeId.SATELLITE';
	if($type=='m3') $typ = ',mapTypeId: google.maps.MapTypeId.HYBRID';
	if($type=='m4') $typ = ',mapTypeId: google.maps.MapTypeId.TERRAIN';
	$info_cont = '';
	if ($info!='')  {
		$info_cont = 'var contentString_'.$rnd.' = \'<div class="map_info">'.$info.'</div>\';
var infowindow_'.$rnd.' = new google.maps.InfoWindow({
    content: contentString_'.$rnd.'
});';

		if ($show_info){
			$info_cont .= 'infowindow_'.$rnd.'.open(map_'.$rnd.',marker_map_'.$rnd.');
';}
			$info_cont .= 'google.maps.event.addListener(marker_map_'.$rnd.', \'click\', function() {
  if (infowindow_'.$rnd.'.getMap())
  infowindow_'.$rnd.'.close();
  else
  infowindow_'.$rnd.'.open(map_'.$rnd.',marker_map_'.$rnd.');
});';
	}
	if($gray=='yes') {
		$grr="var mapType = new google.maps.StyledMapType(stylez, { name:'Grayscale' });
map_".$rnd.".mapTypes.set('tehgrayz', mapType);
map_".$rnd.".setMapTypeId('tehgrayz');";
	}
	else $grr='';
	$out.= '<script type="text/javascript">
jQuery(document).ready(function(){ 
	"use strict";
var map_'.$rnd.';
var stylez = [{featureType: "all",elementType: "all",stylers: [{ saturation: -100 }]}];
var zoom_map_'.$rnd.'='.$zoom.';
var place_map_'.$rnd.' = new google.maps.LatLng('.$lat.', '.$lng.');
var icon_'.$rnd.' = "'.$icon.'";
      function initialize_map() {
        var myOptions_'.$rnd.' = {
          zoom: zoom_map_'.$rnd.',
          center: place_map_'.$rnd.''.$typ.'
        };
        map_'.$rnd.' = new google.maps.Map(document.getElementById(\''.$rnd.'\'),myOptions_'.$rnd.');
	'.$grr.'
	var marker_map_'.$rnd.' = new google.maps.Marker({
        map: map_'.$rnd.',
        position: place_map_'.$rnd.',
		icon: icon_'.$rnd.'		
        });
		'.$info_cont.'
	}
google.maps.event.addDomListener(window, \'load\', initialize_map);
});
</script>';
	$out.='<div id="'.$rnd .'" style="width:'.$w.'px;height:'.$h.'px;border:1px solid #ccc;overflow:hidden;'.$css.'" class="cb5_media"></div>';
	return $out;
} add_shortcode('gmap', 'gmap');
/* #end google maps */


/**************************************************************************/

/* recent posts */
function recent_posts($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('tit' => 'Recent Posts', 'magni' => 'yes', 'no' => '4','cols'=>'4', 'rcat' => '', 'textyy' => '','lg'=>'', 'frame' => '', 'st' => '', 'st2'=>'', 'im'=>'yes', 'ord'=>'', 'stit'=>'yes', 'plink2'=>'pp', 'date'=>'yes', 'post_details'=>'yes', 'titty'=>'yes', 'alig'=>'no', 'fullw'=>'no','aligh'=>'','slidy'=>'','view'=>''), $atts)));


	$rtml='';
	if($alig=='yes'&&$fullw=='yes') $aligc='grid_fullw'; else $aligc='';

	if($aligh!='') $aligh=' style="height:'.$aligh.'px;"'; else $aligh='';
	$radd=$aligh;
	$rtml.='<div class="cb5_recent_posts widget '.$aligc.'" style="'.$st.'">';

	$pd=$post_details;
	require(get_template_directory().'/inc/cb-general-options.php');

	$columns=$cols;
	$s_beh='no';

	global $post;
	$sidebar=get_post_meta($post->ID, 'cb5_sidebar', $single = true);
	require(get_template_directory().'/inc/cb-little-head.php');

	$fr='frame'; $frin='framein';

	$col_v='col'.$columns;
	$coll=$columns;
	$slidy_arrs=''; $slidy_yes='';
	if($slidy=='yes') {
		$slidy_arrs='<a class="slidy_right transi"><img src="'.WP_THEME_URL.'/img/icons/slidy_right.png" alt="click me"></a><a class="slidy_left transi"><img src="'.WP_THEME_URL.'/img/icons/slidy_left.png" alt="click me"></a>';
		$slidy_yes='slidy_blog_container';
	}

	if(strlen($tit)>3) { echo '<h1 class="tit wn">'.$tit.$slidy_arrs.'</h1>'; }

	$blogid=rand();

	if($slidy!='yes') { echo '<div class="cl"></div><div class="'.$aligc.'"><div class="blog_id_'.$blogid.'_hidden hidden_blog_loader"></div><div class=" '.$slidy_yes.' blog-masonry blog_id_'.$blogid.' hidden_blog">'; }
	else {
		echo '<div class="cl"></div><div class="'.$aligc.'"><div class=" '.$slidy_yes.' blog-masonry blog_id_'.$blogid.'">';
	}

	if($slidy=='yes') echo '<div class="slidy_blog_elements">';

	if($view=='yes'&&$slidy!='yes') echo '<a href="'.get_category_link($rcat).'" class="view_all transi" target="_blank">view all</a>';

	//$hgf_old=$hgf;
	$cc=1;
	query_posts('cat='.$rcat.'&posts_per_page='.$no.'&order='.$ord.'&paged='.get_query_var('paged'));
	if(have_posts()) :
	while(have_posts()) : the_post() ?>
	<?php require(get_template_directory().'/inc/cb-post-options.php'); $post_details=$pd; $con_lg=$lg;
	if(!isset($aligbc)) $aligbc=''; if(!isset($aligtc)) $aligtc='';
	$aligtcn=''; $aligtc_h='';
	if($aligbc!=''||$aligtc!='') { $alig_style='style="'; if($aligbc!='') $aligbc='background:'.$aligbc.'!important;';if($aligtc!='') $aligtcn='color:'.$aligtc.'!important;'; $alig_style.=$aligtcn.$aligbc.'"'; $aligtc_h='style="color:'.$aligtc.'!important;"'; } else { $alig_style=''; }
	if(!isset($aligtc_h)) $aligtc_h=''; if(!isset($aligtcn)) $aligtcn='';
	?>

<div id="post-<?php echo $post->ID; ?>"
	class="postbox <?php echo $col_v; if($columns=='1') echo ' post-cat'; if($slidy=='yes') echo ' slidy-blog '; if($stit!='yes'&&$textyy!='yes') echo ' nobg';?> <?php if($aligp!=''&&$alig!='no') echo 'grid_alignp '.$aligp;?>"
	<?php echo $alig_style;?>>
	<div
		class="<?php if (has_post_format('quote')) echo 'post_quote';  if (has_post_format('link')) echo 'post_link';  if (has_post_format('gallery')) echo 'post_gallery';  if($date=='yes'&&$lg!='0') echo ' ddd';?> blog_inside_post">

		<?php //if($aligp=='only_image_tall'&&$alig!='no') $hgf=$hgf_old*2; else $hgf=$hgf_old;

		$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID);
		$isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$murl='';$video='';$video='';$sl_space=''; // reset values in the loop
		$post_type=get_post_meta($post->ID, 'cb5_cb_type', $single = true);
		$s_beh=get_post_meta($post->ID, 'cb5_s_beh', $single = true);

		/* -------------------------------------------------------------------------------- */
		/* -------------------------------------------------------------------------------- */

		//audio & video
		$mcc='';


		?>


		<?php if($fullw=='yes'&&$aligp!='top_image_text'&&$alig!='no'){?>
		<div class="frame hidden_block">
			<img
				src="<?php echo bfi_thumb(WP_THEME_URL.'/img/cb_bg.jpg', array('width' => 980, 'height'=>980, 'crop' => true)); ?>"
				class="<?php echo $roundy; ?> fade-s" alt="featured image" />
		</div>
		<?php } ?>

		<?php if($aligp=='bottom_image_text'&&$alig!='no'){?>
		<div class="recent_inside">
		<?php if($columns==2&&$side!='yes') { ?>
			<style>
ul.post_details2 li.cat {
	display: block !important;
}
</style>
<?php } ?>

<?php if($date=='yes') $datee=' <span class="date_title" '.$aligtc_h.'> / '.get_the_time('M').' '.get_the_time('j').' '.get_the_time('Y').'</span>'; else $datee='';?>
<?php if($titty=='yes') echo $headi.'<a href="'.get_permalink().'" '.$aligtc_h.'>'.get_the_title().'</a>'.$datee.$headi_end; ?>



<?php if($textyy=='yes'){?>
			<p>
			<?php
			$con=get_the_content();
			echo strip_cn($con,$con_lg);
			?>
			</p>
			<?php }?>



			<?php if($post_details=='yes') { ?>

			<ul class="post_details<?php echo $columns; ?>" style="<?php if($post_type=='default'&&$isrc=='') echo 'margin-top:7px;';?><?php if($col_v=='col2') echo 'margin-top:14px;';?>">
			<?php if($columns!='1') { ?>
				<li class="post_item"><i class="icon-file-alt"></i> <a
					href="<?php echo get_permalink(); ?>" class="more"><?php _e('read more','cb-cosmetico'); ?>
				</a></li>
				<?php } ?>
				<?php if($isrc==''&&$imgs=='') { ?>
				<li class="datep"><?php the_time('M'); ?> <?php the_time('j'); ?>, <?php the_time('Y'); ?>
				</li>
				<?php } ?>
				<?php if($show_comments=='yes') { ?>
				<li class="comments post_item"><i class="icon-comments"></i> <?php comments_number('<span class="date_sm">comments:</span> 0', '<span class="date_sm">comments:</span> 1', '<span class="date_sm">comments:</span> %'); ?>
				</li>
				<?php }
				$categories = get_the_category(); $separator = ' '; $output = '';
				?>
				<?php
				if($columns=='1') $cl_post_item='class="post_item"';
				$tags=''; $posttags=get_the_tags(); if ($posttags&&$columns=='1') { foreach($posttags as $tag) { if($tag->name!='') $tags .=$tag->name; } }
				if($tags=='') $cat_right=' style="border-right:0px!important;"';
				if($categories){
					if(!isset($cat_right))$cat_right='';
					echo '<li class="cat"'.$cat_right.'>'; foreach($categories as $category) {
						if(!isset($cl_post_item)) $cl_post_item='';
						$output .= '<a '.$cl_post_item.' href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'cb-cosmetico' ), $category->name ) ) . '">'.$category->cat_name.'</a>, '.$separator;
					}
					echo '<i class="icon-folder-open"></i> Posted in: '.substr(trim($output, $separator),0,-1).'</li>';
				}

				$tags=''; $posttags=get_the_tags(); if ($posttags) { foreach($posttags as $tag) { if($tag->name!='') $tags .='<a href="'.get_tag_link($tag->term_id).'" '.$cl_post_item.'>'.$tag->name . '</a> '; } } $author=get_the_author();
				if($tags!='') { ?>
				<li class="tags" style="border: 0px !important;"><i
					class="icon-tags"></i> <?php _e('Tags: ','cb-cosmetico'); echo $tags; $tags=''; ?>
				</li>
				<?php } ?>


			</ul>
			<div class="cl"></div>

			<?php } ?>
		</div>
		<?php } ?>



		<?php
		if($post_type=='audio'||$post_type=='video'){
			wp_enqueue_script('videojs',WP_THEME_URL.'/inc/js/video-js/video.min.js', array('jquery'), '1.0', true);
			$pos=false;
			$aurl=get_post_meta($post->ID, 'cb5_aurl', $single = true);
			$vurl=get_post_meta($post->ID, 'cb5_vurl', $single = true);

			if($post_type=='audio') $murl=$aurl; else $murl=$vurl;
			$pos = strpos($murl,'vimeo.com');
			if(!isset($ss)) $ss='';
			if(preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $murl, $match)) { $video=$match[1]; }
			if($video!='') { echo '<div class="'.$fr.' '.$roundy.' in cb5_media"><div class="'.$frin.'">'.$mcc.'<iframe class="cb5_media" width="'.$w.'" height="'.$h.'" src="http://www.youtube.com/embed/'. $video.'?wmode=transparent&amp;controls=1&amp;showinfo=0" title="'.get_the_title().'"></iframe></div></div>'; }

			if($pos===false) { } else {
				$video=substr($murl,17,8);
				echo '<div class="'.$fr.' '.$roundy.' in cb5_media"><div class="'.$frin.'">'.$mcc.'<iframe class="cb5_media" width="'.$w.'" height="'.$h.'" src="http://player.vimeo.com/video/'.$video.'?title=0&amp;byline=0&amp;portrait=0"></iframe></div></div>';
			}

			if($video==''&&$pos===false&&$murl!='') {

				if($post_type=='audio') $h2='42'; else $h2=$h;
				if($post_type=='audio') $aa='2'; else $aa='';
				echo '<div class="'.$fr.' '.$roundy.' in cb5_media'.$aa.'"><div class="'.$frin.'">'.$mcc.'<video id="media-'.$post->ID.'" class="video-js vjs-default-skin cb5_media'.$aa.'" controls preload="none" width="'.$w.'" height="'.$h2.'" poster="" data-setup=> <source src="'.$murl.'" type="video/mp4" /> </video></div></div>';
			}

		} //audio & video end

		/* -------------------------------------------------------------------------------- */
		/* -------------------------------------------------------------------------------- */

		//slider
		if($post_type=='slider'&&$s_beh!='cat') {
			wp_enqueue_style('any', WP_THEME_URL.'/inc/js/anything_slider/css/anythingslider.css', false, '1.0', 'screen');
			wp_enqueue_script('anyeasing',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.easing.1.2.js', array('jquery'), '1.0', true);
			wp_enqueue_script('any',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.min.js', array('jquery'), '1.0', true);
			wp_enqueue_script('anyfx',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.fx.min.js', array('jquery'), '1.0', true);


			$sl_space='<div class="cl"></div>';

			$pid=$post->ID; $slid_id=substr(rand(),0,3);

			if($s_beh!='cat') $rc='true'; else $rc='false';

			echo '<script type="text/javascript">
		jQuery(function(){
		 jQuery(\'#slider'.$slid_id.$pid.'\').anythingSlider({
			resizeContents       : '.$rc.',	
			hashTags            : false,
			autoPlay            : '.$s_auto.',     
			pauseOnHover        : true,    
			resumeOnVideoEnd    : true,
			delay               : '.$s_delay.',     
			animationTime       : '.$s_ani_time.',    
			easing              : \''.$s_easing.'\'
		  });
		});
	</script><div class="'.$fr.' '.$roundy.' in"><div class="'.$frin.'">'.$mcc.'<ul id="slider'.$slid_id.$pid.'" style="'.$slider_res.'list-style:none;overflow-y:auto;overflow-x:hidden;" class="slider">';

			if($s_beh!='cat'){

				$imgs=get_children('post_type=attachment&order=asc&orderby=menu_order&post_mime_type=image&post_parent='.$post->ID);

				foreach ($imgs as $att_id => $att) {
					$gall_img=wp_get_attachment_image_src($att_id,'full');
					echo '<li><a href="'.$gall_img[0].'" data-rel="pp[post-'.$post->ID.']"><img src="'.bfi_thumb($gall_img[0], array('width' => 980, 'height'=>980, 'crop' => true)).'" class="'.$roundy.' fade-s" alt="slide image"/><div class="cl"></div></a></li>';
				}

			} echo '</ul></div></div>';

		} // slider end

		/* -------------------------------------------------------------------------------- */
		/* -------------------------------------------------------------------------------- */

		$bfiww=bfi_thumb($isrc[0], array('width' => 980, 'crop' => true));
		if($slidy=='yes') $bfiww=bfi_thumb($isrc[0], array('width' => 170,'height'=>120, 'crop' => true));

		if(($post_type!='slider'&&$post_type!='video'&&$post_type!='audio')||$post_type=='slider'&&$s_beh=='cat') {

			if($isrc) { ?>
		<div class="blog_item <?php echo $fr; ?> fade in">
			<div class="<?php echo $frin; ?>">
				<div class="fade_c">
					<div class="see_more_wrap">
						<div class="see_wrap2">
							<a
								href="<?php if($plink2=='page') echo get_permalink(); else echo $isrc[0];?>"
								<?php if($plink2=='image') echo'data-rel="pp"';?>><img
								src="<?php echo WP_THEME_URL; ?>/img/icons/arr_rw.png"
								class="fade-s fade_arr_r"
								alt="<?php _e('see more','cb-cosmetico');?>" />
								<h1>
									<span class="fade_see"><?php _e('see more','cb-cosmetico'); ?>
									</span>
								</h1> </a>
						</div>
					</div>
					<div class="cl"></div>
				</div>
				<a
					href="<?php if($plink2=='page') echo get_permalink(); else echo $isrc[0];?>"
					<?php if($plink2=='image') echo'data-rel="pp"';?>><img
					src="<?php echo $bfiww; ?>" class="fade-s fade-si"
					alt="featured image" /> </a>
				<div class="cl"></div>
			</div>
		</div>
		<?php }

		} // else end
		//echo $div_left;
		?>



		<?php if($fullw=='yes'&&$aligp=='top_image_text'&&$alig!='no'){?>
		<div class="relative">
			<div class="frame hidden_block">
				<img
					src="<?php echo bfi_thumb(WP_THEME_URL.'/img/cb_bg.jpg', array('width' => 980, 'height'=>980, 'crop' => true)); ?>"
					class="<?php echo $roundy; ?> fade-s" alt="featured image" />
			</div>
			<?php } ?>


			<?php if($aligp!='bottom_image_text'||$alig!='yes'){?>
			<div class="recent_inside">
			<?php if($columns==2&&$side!='yes') { ?>
				<style>
ul.post_details2 li.cat {
	display: block !important;
}
</style>
<?php } ?>
<?php if($date=='yes') $datee=' <h3 class="date_title" '.$aligtc_h.'><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link">'.get_avatar(get_the_author_meta('ID'),32).get_the_author().'</a> <i class="icon-time"></i> '.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'</h3>'; else $datee='';?>
<?php if($titty=='yes') echo $headi.'<a href="'.get_permalink().'" '.$aligtc_h.'>'.get_the_title().'</a>'.$headi_end; ?>
<?php echo $datee; ?>
<?php if($post_details=='yes') { ?>
				<ul class="post_details<?php echo $columns; ?>" style="<?php if($post_type=='default'&&$isrc=='') echo 'margin-top:7px;';?><?php if($col_v=='col2') echo 'margin-top:14px;';?>">
				<?php if($columns!='1') { ?>
					<li class="post_item"><i class="icon-file-alt"></i> <a
						href="<?php echo get_permalink(); ?>" class="more"><?php _e('read more','cb-cosmetico'); ?>
					</a></li>
					<?php } ?>
					<?php if($isrc==''&&$imgs=='') { ?>
					<li class="datep"><?php the_time('M'); ?> <?php the_time('j'); ?>,
					<?php the_time('Y'); ?></li>
					<?php } ?>
					<?php if($show_comments=='yes') { ?>
					<li class="comments post_item"><i class="icon-comments"></i> <?php comments_number('<span class="date_sm">comments:</span> 0', '<span class="date_sm">comments:</span> 1', '<span class="date_sm">comments:</span> %'); ?>
					</li>
					<?php }
					$categories = get_the_category(); $separator = ' '; $output = '';
					if($columns=='1') $cl_post_item='class="post_item"';
					$tags=''; $posttags=get_the_tags(); if ($posttags&&$columns=='1') { foreach($posttags as $tag) { if($tag->name!='') $tags .=$tag->name; } }
					if($tags=='') $cat_right=' style="border-right:0px!important;"';
					if($categories){
						if(!isset($cat_right))$cat_right='';
						echo '<li class="cat"'.$cat_right.'>'; foreach($categories as $category) {
							if(!isset($cl_post_item)) $cl_post_item='';
							$output .= '<a '.$cl_post_item.' href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'cb-cosmetico' ), $category->name ) ) . '">'.$category->cat_name.'</a>, '.$separator;
						} echo '<i class="icon-folder-open"></i> Posted in: '.substr(trim($output, $separator),0,-1).'</li>';
					}
					$tags=''; $posttags=get_the_tags(); if ($posttags) { foreach($posttags as $tag) { if($tag->name!='') $tags .='<a href="'.get_tag_link($tag->term_id).'" '.$cl_post_item.'>'.$tag->name . '</a> '; } } $author=get_the_author();
					if($tags!='') { ?>
					<li class="tags" style="border: 0px !important;"><i
						class="icon-tags"></i> <?php _e('Tags: ','cb-cosmetico'); echo $tags; $tags=''; ?>
					</li>
					<?php } ?>
				</ul>
				<div class="cl"></div>
				<?php } ?>
				<?php if($textyy=='yes'){?>
				<p>
				<?php
				$con=get_the_content();
				echo strip_cn($con,$con_lg);
				?>
				</p>
				<?php }?>
				<?php if($fullw=='yes'&&$aligp=='top_image_text'&&$alig!='no'){?>
			</div>
			<?php } ?>
			<?php if($slidy!='yes'){?>
			<a href="<?php echo get_permalink(); ?>" class="bttn_big"><?php _e('read more','cb-cosmetico');?>
			</a>
			<?php } ?>
		</div>
		<?php } ?>
		<?php if($slidy!='yes') { ?>
		<?php echo $div_close; ?>
		<div class="cl"></div>
		<?php echo $sl_space; ?>
		<?php } ?>
	</div>
	<!--/blog post inside end-->
</div>
<!--/blog post end-->

		<?php if($slidy!='yes') { ?>
<div class="cl"></div>
		<?php } ?>

		<?php $cc++;
		endwhile; endif; wp_reset_query();
		if($slidy=='yes') echo '</div>';
		$masend='';
		$massdnm='
      columnWidth: function( containerWidth ) {
              return containerWidth /'.$coll.';
            }';

		$rtml.='<div class="cl"></div>

</div></div></div><div class="cl grid_spacer"></div>';

		if($slidy!='yes') {
			$rtml.='<script type="text/javascript">
"use strict";
  jQuery(function(){
   var widd=jQuery(document).width();
   if(widd>768) {
jQuery(\'.blog-masonry.blog_id_'.$blogid.'\').imagesLoaded( function(){
   jQuery(\'.blog-masonry.hidden_blog\').show();
   jQuery(\'.hidden_blog_loader\').hide();

   jQuery(\'.blog-masonry.blog_id_'.$blogid.'\').masonry({
      itemSelector: \'.postbox\', 
      '.$massdnm.'
    });

   var gridh=jQuery(\'.grid_fullw .blog-masonry.blog_id_'.$blogid.'\').height();
   jQuery(\'.grid_fullw .blog-masonry.blog_id_'.$blogid.'\').parent().next(\'.grid_spacer\').height(gridh);

    });
	}
else {
   jQuery(\'.hidden_blog_loader\').hide();
   jQuery(\'.blog-masonry.hidden_blog\').show();
}
  });
</script>';
		}

		return apply_filters('recent_posts', $rtml);
} add_shortcode('recent_posts', 'recent_posts');
/* #end recent posts */




/* -------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------- */
function skill($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('name'=>'','ani'=>'','color'=>'blue','stripes'=>'','vstyle'=>'circle','icon'=>''), $atts)));
	$icon= html_entity_decode($icon);
	$colo='0155d1';
	if($vstyle=='circle'){
		if($color=='blue') $colo='0155d1';
		if($color=='dark_blue') $colo='0d1e32';
		if($color=='black') $colo='222';
		if($color=='magenta') $colo='ac50a7';
		if($color=='yellow') $colo='ffbb00';
		if($color=='grey') $colo='b3b3b3';
		if($color=='red') $colo='D12D2D';
		if($color=='orange') $colo='fd9530';
		if($color=='green') $colo='8fbd2d';
		$return_html='<div class="skill-circle"><div class="skill-icon-wrap"><div class="skill-icon">'.$icon.'</div></div><input class="knob" data-fgColor="#'.$colo.'" data-bgColor="#cbd0d6" data-thickness=".1" data-readOnly=true  data-displayInput=false  data-angleOffset=-90 value="0" data-width="223" data-height="223" rel="'.$content.'"><div class="skill_circle"><h3 class="transi">'.$content.'% '.$name.'</h3></div></div><div class="cl"></div>';
	}else{
		$idd=rand();
		$return_html='
<script type="text/javascript">
jQuery(function(){
"use strict"; 
progress('.do_shortcode($content).', jQuery("#pgbar-'.$idd.'"));
});
</script>';
		$class='class="';
		if($ani=='yes') $ani='ani ';
		if($stripes=='yes') $stripes=''; else $stripes=' nostripes';
		$class.=$ani.' '.$color.' '.$stripes.'"';
		$return_html.='<span class="skill">'.$name.'</span><div class="progressBar" id="pgbar-'.$idd.'"><div '.$class.'></div></div>';

	}
	return apply_filters('skill', $return_html);
} add_shortcode('skill', 'skill');

/* -------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------
 function skill($atts, $content = null){
 esc_attr(extract(shortcode_atts(array('name'=>'','ani'=>'','color'=>'blue','stripes'=>''), $atts)));
 $idd=rand();
 $return_html='
 <script type="text/javascript">
 jQuery(function(){
 "use strict";
 progress('.do_shortcode($content).', jQuery("#pgbar-'.$idd.'"));
 });
 </script>';
 $class='class="';
 if($ani=='yes') $ani='ani ';
 if($stripes=='yes') $stripes=''; else $stripes=' nostripes';
 $class.=$ani.' '.$color.' '.$stripes.'"';
 $return_html.='<span class="skill">'.$name.'</span><div class="progressBar" id="pgbar-'.$idd.'"><div '.$class.'></div></div>';
 return apply_filters('skill', $return_html);
 } add_shortcode('skill', 'skill');

 /* -------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------- */
function text($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('title'=>'','mb'=>''), $atts)));
	$idd=rand();
	if($title!='') $title='<h1 class="wn tit title_heading">'.$title.'</h1>';
	if($mb!='') $return_html='<div class="aq_mb" style="margin-bottom:'.$mb.'px!important;">'.wpautop($title.do_shortcode($content)).'</div>';
	else $return_html=wpautop($title.do_shortcode($content));
	return apply_filters('text', $return_html);
} add_shortcode('text', 'text');

/* -------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------- */
function carousel($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('w'=>'','w2'=>'500','infinite'=>'true','duration'=>'1000','h'=>'400'), $atts)));
	$idd=rand();
	$h2=$h-70;
	$h3=$h+50;
	$h4=$h-40;
	$h5=$h4-50;

	wp_enqueue_script('touchslider',WP_THEME_URL.'/inc/js/jquery.touchslider.js',array('jquery'),'1.0',true);

	$return_html='
<script type="text/javascript">
jQuery(function(){
jQuery(\'.caro-'.$idd.' span\').hide();
jQuery(\'.caro-'.$idd.'\').carouFredSel({
		circular:true,infinite:'.$infinite.',
		width: \'100%\',height: '.$h.',
		items: 3,
		auto : {timeoutDuration : 6000},prev: \'#prev\',next: \'#next\',
		scroll: {
			items: 1,duration: '.$duration.',easing: \'quadratic\',
			onBefore: function( data ) {
				data.items.old.find( \'img\' ).stop().fadeTo( 500, 0.3 );
				data.items.old.removeClass( \'frame\' );
				data.items.old.find( \'span\' ).stop().slideUp( \'slow\' );
				data.items.old.stop().animate({ height: '.$h2.' });
			},onAfter: function( data ) {openItem( data.items.visible.eq( 1 ),'.$h4.' ); }
		},onCreate: function( data ) { openItem( data.items.eq( 1 ),'.$h4.' );}
	});
});
</script>';

	$return_html.='<div class="caro_cn">

<style type="text/css" media="screen" scoped>
.caro_bottom {height:'.$h.'px;}
.caro_cn {width: 100%;height:'.$h.'px;overflow: hidden;position: absolute;left: 0;}
.caro div {width:'.$w2.'px;height:'.$h2.'px;}
</style>

<div class="caro caro-'.$idd.'">';
	foreach(preg_split("/,/", $content) as $line){
		$line_explode=explode('{}',$line); $l_img=$line_explode[0]; $l_title=$line_explode[1]; if($l_title=='') $l_title='Image';
		$return_html.='<div><a href="'.$l_img.'" data-rel="pp"><img alt="" src="'.bfi_thumb($l_img, array('width' => $w2*2, 'height'=>$h5*2, 'crop' => true)).'" width="'.$w2.'" height="'.$h5.'" class="round" /></a><h3><span>'.$l_title.'</span></h3></div>';
	}

	$return_html.='</div><a id="prev" href="#" class="transi" title="prev"></a><a id="next" href="#" class="transi" title="next"></a></div><div class="caro_bottom"></div>';

	return apply_filters('carousel', $return_html);
} add_shortcode('carousel', 'carousel');



function gall_post($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('cols'=>'','gcap'=>'no','slidy'=>'no'), $atts)));
	require(get_template_directory().'/inc/cb-general-options.php');
	global $post;
	$return_html='';
	$columns='';
	$sidebar=get_post_meta($post->ID, 'cb5_sidebar', $single = true);
	require(get_template_directory().'/inc/cb-little-head.php');

	if($side=='yes') {
		$col_v='col'.$cols.'s';
		$coll=$cols;
	} else {
		$col_v='col'.$cols;
		$coll=$cols;
	}
	$pp='data-rel="pp[pp_gall'.$post->ID.']"';
	$count='1';

	$bfi_g=array('width' => '980', 'height'=>'760', 'crop' => true);

	if($slidy=='yes') {
		$slidy_arrs='<div class="port_arrs"><a class="slidy_right transi"><img src="'.WP_THEME_URL.'/img/icons/slidy_right.png"></a><a class="slidy_left transi"><img src="'.WP_THEME_URL.'/img/icons/slidy_left.png"></a></div>';
		$return_html.=$slidy_arrs.'<div class="slidy_blog_container"><div class="slidy_blog_elements">';
		$slidygall=' slidy-blog ';
		$slidygall2='slidy_blog_elements';
		$bfi_g=array('width' => '170', 'height'=>'90', 'crop' => true);
	} else { $slidygall=''; $slidygall2=''; $slidy_arrs='';}

	$return_html.='<div class="gall_post"><div class="gall_post_inside '.$slidygall2.'">';
	foreach(preg_split("/,/", $content) as $line){
		if($count%$cols=='0')  $stl='style="margin-right:0px;"'; else $stl='';
		$line_explode=explode('{}',$line); $l_img=$line_explode[0]; $l_title=$line_explode[1]; if($l_title=='') $l_title='Image';
		$a_t='';
		if($gcap=='yes') $a_t='<div class="cap">'.$l_title.'</div>'; else $a_t='';
		$return_html.='<div class="fade '.$col_v.' single_image '.$slidygall.'" '.$stl.'><div class="frame"><div class="frame_in">
<div class="fade_c">
<div class="see_more_wrap"><div class="see_wrap2"><a href="'.$l_img.'" data-rel="pp"><img src="'.WP_THEME_URL.'/img/icons/arr_rw.png" class="fade-s fade_arr_r" alt="'.__('see more','cb-cosmetico').'"/><h1><span class="fade_see">'.__('see more','cb-cosmetico').'</span></h1></a></div></div><div class="cl"></div>
</div>
<a href="'.$l_img.'" '.$pp.'><img src="'.bfi_thumb($l_img, $bfi_g).'" class="round fade-si" alt="gallery"/>
</a></div></div></div>';
		$count++;
	}

	$return_html.='<div class="cl"></div></div></div>';
	if($slidy=='yes') $return_html.='</div></div>';
	return apply_filters('gall_post', $return_html);
} add_shortcode('gall_post', 'gall_post');

/* -------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------- */


function woo($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('hot'=>'yes','best'=>'yes','new'=>'new','ajax'=>'yes','per'=>'12','cols'=>'4','a'=>''), $atts)));
	global $woocommerce_loop;


	if($ajax=='yes'){
		ob_start();
		 ?>
<script type="text/javascript">
//LOADER
jQuery(document).ready(function(){
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
jQuery('.load_button').live('click', function(){ 
  var $button = jQuery(this);
  var cur_page = $button.attr('data-cur-page');
  var next_page = parseInt(cur_page)+1;
  var max_pages = parseInt($button.attr('data-max-pages'));
  var id = $button.attr('id');
    
	jQuery.post( ajaxurl, { action: 'cbprodloader',typ:id,next_page:next_page,per:<?php echo $per; ?>,cols:<?php echo $cols; ?>,security:'<?php echo wp_create_nonce('cosmetico-settings'); ?>'}, function(data){

  jQuery('#ul_'+id).append(data);
    
  $button.attr('data-cur-page',next_page.toString());
  
  jQuery('html, body').animate({
         scrollTop: jQuery('#bcon_'+id).offset().top- jQuery('#ul_'+id+' li').outerHeight()
     }, 500);
	 
	 if(max_pages==next_page) { 
  $button.fadeOut(); 
  jQuery('#bcon_'+id).addClass('no_more');
  }
  });
});

});
//LOADER END
</script>
		<?php
		$woo=ob_get_contents();
 ob_end_clean();
	}
	$args = array('post_type'=>'product','post_status'=>'publish','ignore_sticky_posts'=>1,'posts_per_page'=>$per,
'meta_query'=>array(
	'relation' => 'OR',
	array('key' => '_visibility','value' => array('catalog', 'visible'),'compare' => 'IN'),
	array('key' => '_sale_price','value' => 0,'compare' => '>','type' => 'NUMERIC'),
	array( // Variable products type
			'key'           => '_min_variation_sale_price',
			'value'         => 0,
			'compare'       => '>',
			'type'          => 'numeric'
	)
	));
	ob_start();
	$products = new WP_Query( $args );
	//echo '<pre>';print_r($products);echo '</pre>';
	$woocommerce_loop['columns'] = $cols;
	
	if ( $products->have_posts() ) : ?>
<ul class="products" id="ul_hot_products">
<?php while ( $products->have_posts() ) : $products->the_post(); ?>
<?php woocommerce_get_template_part( 'content', 'product' ); ?>
<?php endwhile; ?>
</ul>

<?php if ($products->found_posts>$per && $ajax=='yes') echo'<div class="woo_load_container" id="bcon_hot_products"><button class="load_button load_more_products" id="hot_products" data-max-pages="'.$products->max_num_pages.'" data-cur-page="1">'.__('Load more hot products','cb-cosmetico').'</button></div>'; ?>
<?php endif;
wp_reset_query();
$woo_sale=ob_get_contents();
 ob_end_clean();

$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' => $per,
		'orderby' => 'date',
		'order' => 'desc',
		'meta_query' => array(
array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
				)
				)
				);
				ob_start();
				$products = new WP_Query( $args );
				//echo '<pre>';print_r($products);echo '</pre>';
				$woocommerce_loop['columns'] = $cols;
				if ( $products->have_posts() ) : ?>
<ul class="products" id="ul_new_products">
<?php while ( $products->have_posts() ) : $products->the_post(); ?>
<?php woocommerce_get_template_part( 'content', 'product' ); ?>
<?php endwhile; ?>
</ul>

<?php if ($products->found_posts>$per && $ajax=='yes') echo'	 <div class="woo_load_container" id="bcon_new_products"><button class="load_button load_more_products" id="new_products" data-max-pages="'.$products->max_num_pages.'" data-cur-page="1">'.__('Load more new products','cb-cosmetico').'</button></div>'; ?>
<?php endif;
wp_reset_query();
$woo_new=ob_get_contents();
 ob_end_clean();

$args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page' => $per,
        'meta_key' 		 => 'total_sales',
    	'orderby' 		 => 'meta_value',
        'meta_query' => array(
array(
                'key' => '_visibility',
                'value' => array( 'catalog', 'visible' ),
                'compare' => 'IN'
                )
                )
                );
                ob_start();
                $products = new WP_Query( $args );
                //echo '<pre>';print_r($products);echo '</pre>';
                $woocommerce_loop['columns'] = $cols;
                if ( $products->have_posts() ) : ?>
<ul class="products" id="ul_best_sellers">
<?php while ( $products->have_posts() ) : $products->the_post(); ?>
<?php woocommerce_get_template_part( 'content', 'product' ); ?>
<?php endwhile; ?>
</ul>

<?php if ($products->found_posts>$per && $ajax=='yes') echo'<div class="woo_load_container" id="bcon_best_sellers"><button class="load_button load_more_products" id="best_sellers" data-max-pages="'.$products->max_num_pages.'" data-cur-page="1">'.__('Load more best sellers','cb-cosmetico').'</button></div>'; ?>
<?php endif;
wp_reset_query();
$woo_best=ob_get_contents();
 ob_end_clean();
$iar='';
if($a=='left') $iar='nocenter';

$woo_best_f=''; $woo_best_f2='';
$woo_new_f=''; $woo_new_f2='';
$woo_hot_f=''; $woo_hot_f2='';
if($new=='yes') { $woo_new_f='<li><a href="#tabs-2"><span>'.__('New Products','cb-cosmetico').'</span></a></li>'; $woo_new_f2='<div id="tabs-2" class="tabcontent">'.$woo_new.'<div class="cl"></div></div>'; }
if($best=='yes') { $woo_best_f='<li><a href="#tabs-3"><span>'.__('Best Sellers','cb-cosmetico').'</span></a></li>'; $woo_best_f2='<div id="tabs-3" class="tabcontent">'.$woo_best.'<div class="cl"></div></div>'; }
if($hot=='yes') { $woo_hot_f='<li><a href="#tabs-1"><span>'.__('Hot Products','cb-cosmetico').'</span></a></li>'; $woo_hot_f2='<div id="tabs-1" class="tabcontent">'.$woo_sale.'<div class="cl"></div></div>'; }
$woo.='<div class="tabs round cb5_woo cb5_block '.$iar.'"><ul>'.$woo_hot_f.$woo_new_f.$woo_best_f.'</ul>'.$woo_hot_f2.$woo_new_f2.$woo_best_f2.'</div><div class="cl"></div>';


return apply_filters('woo', $woo);
} add_shortcode('woo', 'woo');

?>
