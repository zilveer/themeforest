<?php
class cbtheme {

	
	
	
	
/* ================================================
 * PAGE HEADER
 * ================================================ */
	
	function page_header($show_title='yes',$type='default') {
	global $post;
	
	if ( in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	if(is_shop())$post->ID=woocommerce_get_page_id('shop');
	}
	
	$cb_type=esc_attr(get_post_meta($post->ID, '_cb5_post_type', 'true'));
	$cb_header_options=cb_get_header_options($post->ID);

	$cb_post_options=cb_get_post_options($post->ID);
	if(is_single($post->ID)&&$cb_post_options['title']=='') $cb_post_options['title']='yes';
	if($type!='shop'){
	if($cb_post_options['title']=='yes'){ if ($cb_header_options['header_type'] != 'slider_head' && $cb_header_options['header_type'] != 'map' && $cb_post_options['title'] == 'yes') { ?>
	<div class="wrapme <?php echo 'head_title';?>">
<?php if(($cb_post_options['title']=='yes'||$cb_post_options['title']=='')&&$cb_header_options['cb_type']!='home') {
echo '<h1 class="title">';
if($type=='cat') { $catid=get_query_var('cat'); echo '<a href="'.get_category_link($catid).'">'.single_cat_title().'</a>'; }
else if($type=='search') { _e('Search Results for','cb-modello'); echo ' ';  echo the_search_query(); }
else if($type=='tag') { $catid=get_query_var('cat'); echo '<a href="'.get_category_link($catid).'">'.single_cat_title().'</a>'; }
else if($type=='author') { printf(__('Author Archives: %s','cb-modello'),"<span class='vcard'><a href='".get_author_posts_url(get_the_author_meta('ID'))."' title='".esc_attr(get_the_author())."' rel='me'>".get_the_author()."</a></span>");  }
else if($type=='archive') { _e('Archives for:','cb-modello'); echo single_month_title(' '); }
else if($type=='shop') {


}
else echo '<a href="'.get_permalink().'">'.get_the_title().'</a>';
if($cb_header_options['show_bread']=='yes'&&$cb_post_options['show_bread']!='no'&&$cb_header_options['header_type']!='slider_head'){
	if($type!='shop') { if(function_exists('yoast_breadcrumb')){ yoast_breadcrumb('<span class="bread_wrap"><span class="wrapme"><span id="breadcrumbs">','</span><span class="cl"></span></span></span>'); } }
} 
echo '</h1>';
} ?>
<?php } }
else {
if($cb_header_options['header_type']!='slider_head') echo '<div class="wrapme head_title"><h1 class="title">';
if($cb_header_options['show_bread']=='yes'&&$cb_post_options['show_bread']!='no'){
    if($type!='shop') { if(function_exists('yoast_breadcrumb')){ yoast_breadcrumb('<span class="bread_wrap"><span class="wrapme"><span id="breadcrumbs">','</span><span class="cl"></span></span></span>'); } }
}
if($cb_header_options['header_type']!='slider_head') 	echo '</h1>';
}
	}
?>



<?php 
/*if($cb_header_options['headings_icons']!=''&&$cb_header_options['headings_icons'][0]['icon']!=''&&$cb_header_options['header_type'] != 'slider_head'){?>
<div class="below_header" ><div class="wrapme">
<div class="icons_con"><div class="icons">
<div class="icons_text" style="width:0px;"></div>
<?php
foreach($cb_header_options['headings_icons'] as $hico){
echo '<a href="'.$hico['link'].'" data-title="'.$hico['name'].'" class="transi_bg">'.str_replace('\"','"',$hico['icon']).'</a>';
}
?></div>
</div>

</div>
</div><?php }*/
 ?>


<?php if($cb_header_options['header_type']!='slider_head'){?></div><?php }?>




</div></div>




<!-- bg_head end -->
<?php $foot_op = cb_get_foot_options(); ?>

<div id="middle" class=" <?php if ($foot_op['fstyle'] != 'rounded') { echo 'nocor ';} if($cb_header_options['fullscreen']=='yes'&&$cb_header_options['cb_type']=='gallery') echo 'p0'; ?>">
<!-- <div class="container"> -->
	<div class="wrapon <?php if($cb_header_options['fullscreen']=='yes'&&$cb_type=='gallery') echo 'fullscreengallery'; ?>">
	
	  <?php

	$cb_sidebars=cb_get_sidebars($post->ID);
	if ($cb_sidebars['sidebar_position'] == 'left') { ?>
		<ul id="sidebar_l">
		<?php if($cb_sidebars['sidebar']!='') { dynamic_sidebar($cb_sidebars['sidebar']); }?>
		</ul>
		<!-- sidebar #end -->
	  <?php
		}
	}

/* ================================================
 * PAGE FOOTER
 * ================================================ */
	
	function page_footer() {
	wp_reset_query();
	global $post;
	$cb_sidebars=cb_get_sidebars($post->ID);
	if ($cb_sidebars['sidebar_position'] == 'right') { ?>
<div id="sidebar_r">
	<ul><?php if($cb_sidebars['sidebar']!='') { dynamic_sidebar($cb_sidebars['sidebar']); } ?></ul>
</div>
<!-- sidebar #end -->
<?php } ?>
<div class="cl"></div>
<!-- </div>-->
</div>
<!-- wrapper #end -->
</div>
<!-- middle #end -->
<?php
	} 
	
	
	

/* ================================================
 * SHOW CONTENT
 * ================================================ */

	function show_content($show_title='no',$type='') {
	global $post;
	$cb_sidebars=cb_get_sidebars($post->ID);
	?>
	
	<div id="content" class="<?php if($cb_sidebars['side']=='yes') { ?>side<?php } if($type=='search') echo ' searching';?>">
	
	<?php 
	$style='post';
	if(is_single()) $style='post';
	if(is_page()) $style='page';
	if(is_category()||is_search()||is_archive()||is_tag()) $style='cat';
	$searchc='2';
	if(get_option('cb5_searchc')!='') $searchc=get_option('cb5_searchc');

	if(have_posts()) :
	while(have_posts()){ the_post();
		$cb_blocks_options=cb_get_blocks_options($post->ID);// $show_title=$cb_blocks_options['title'];
		if($type=='search') 
		$this->build_blocks(array('cb_type'=>$cb_blocks_options['cb_type'],
				'title'=>$show_title,'show_dtitle'=>$cb_blocks_options['dtitle'],'show_about'=>$cb_blocks_options['show_about'],
				'sf'=>$cb_blocks_options['display_featured'],'show_cat_list'=>$cb_blocks_options['show_cat_list'],'style'=>'blog',
		'columns'=>$searchc,'con_lg'=>'200','read_more'=>'yes'));
			else
		$this->build_blocks(array('cb_type'=>$cb_blocks_options['cb_type'],
				'title'=>$show_title,'show_dtitle'=>$cb_blocks_options['dtitle'],'show_about'=>$cb_blocks_options['show_about'],
				'sf'=>$cb_blocks_options['display_featured'],'show_cat_list'=>$cb_blocks_options['show_cat_list'],'style'=>$style,'hide_col'=>'yes'));
		
	} else :
			get_template_part('404');
	endif; 

	echo '<div class="cl"></div>';
	
	if($style=='cat'){ $this->block_navi();
	wp_reset_query();
	}
	
	echo '</div>'; //content end
	
	}
	
/* ================================================
 * BUILD BLOCKS
 * ================================================ */
	public function build_blocks($o=array('cb_type'=>'default','style'=>'page','side'=>'no','style'=>'','columns'=>'s','con_lg'=>'','title'=>'',
		'hide_content'=>'','sf'=>'yes','mr'=>'','details'=>'no','show_cat_list'=>'no','pshape'=>'','read_more'=>'no','aligp'=>''
		,'list'=>'','hide_col'=>'','comments'=>'','gallery_blog'=>'','coutput'=>'','global_side'=>'','echo'=>'','full'=>''
		)){
		extract($o);
		if(!isset($cb_type)) $cb_type='default'; if($cb_type=='') $cb_type='default';

		if(!isset($con_lg)) $con_lg='';
		if(!isset($style)) $style='';
		if(!isset($columns)) $columns='';
		if(!isset($title)) $title='';
		if(!isset($cap)) $cap='';
		if(!isset($hide_content)) $hide_content='';
		if(!isset($sf)) $sf='';
		if(!isset($mr)) $mr='';
		if(!isset($details)) $details='';
		if(!isset($side)) $side='';
		if(!isset($global_side)) $global_side='';
		if(!isset($show_cat_list)) $show_cat_list='';
		if(!isset($pshape)) $pshape='';
		if(!isset($read_more)) $read_more='no';
		if(!isset($aligp)) $aligp='';
		if(!isset($list)) $list='';
		if(!isset($hide_col)) $hide_col='';
		if(!isset($about)) $about='';
		if(!isset($sf)) $sf='';
		if(!isset($link)) $link='';
		if(!isset($ajax)) $ajax='';
		if(!isset($comments)) $comments='';
		if(!isset($gallery_blog)) $gallery_blog='';
		if(!isset($show_dtitle)) $show_dtitle='';
		if(!isset($show_about)) $show_about='';
		if(!isset($coutput)) $coutput='';
		if(!isset($echo)) $echo='';
        if(!isset($full)) $full='';
		
		if(!isset($fade)) $fade='';
		if(!isset($fade_ani)) $fade_ani='';
		
		$aligp_parent='';
		if($aligp!='') $aligp_old=$aligp; else $aligp_old='';
		if($aligp!='') $aligp=$aligp.' ddd grid_alignp';
		$style_end='end';
		
		if(is_single()) {
			$columns='1';
			$list='';
			$title='yes';
			$comments='yes';
			$details='yes';
			$hide_col='no';
			$about='yes';
		}
		
		$link_to='';
		 if($link=='yes'&&$ajax!='yes') $link_to='page';
		 if($link=='yes'&&$ajax=='yes') $link_to='ajax';
		 if($link!='yes'&&$ajax!='yes') $link_to='pp';
		 if($link!='yes'&&$ajax=='yes') $link_to='ajax';
		 $itemprop='';
			
			
		switch($style){
			case 'page':
			$hide_content='no';
			$details='no';
			$itemprop=' itemscope itemtype ="http://schema.org/Article"';
			break;
			case 'post':
			$hide_content='no';
			$itemprop=' itemscope itemtype ="http://schema.org/Article"';
			break;
			case 'blog':
			$aligp_parent=$aligp;
			$itemprop=' itemscope itemtype ="http://schema.org/Blog"';
			break;
			case 'portfolio':
			$hide_content='yes';
			$show_dtitle='no';
			$itemprop=' itemscope itemtype ="http://schema.org/CreativeWork"';
			break;
			case 'cat':
			$hide_content='no';
			$details='yes';
			$con_lg='300';
			$columns='1';
			$title='yes';
			$itemprop=' itemscope itemtype ="http://schema.org/Blog"';
			break;
		}
		
		$is_mr=''; if($mr=='0') $is_mr='mr0 '; else $is_mr='';
		$h=700; $w=960; $vh=500; if($side=='yes')$vh=380;
	
		if($columns==2) { $w=500; $h=400; $vh=350; if($global_side=='yes')$vh=300; }
		if($columns==3) { $w=450; $h=320; $vh=250; if($global_side=='yes')$vh=200; }
		if($columns==4) { $w=250; $h=200; $vh=190; if($global_side=='yes')$vh=150; }
        if($full=='yes'){ $h=700; $w=960; $vh=500; if($global_side=='yes')$vh=380;}

		if($cb_type=='portfolio_project'&&$style=='post'){ $w=$w*1.2; $h=$w; }
		else if($style=='portfolio') { $w=$w*1.2; $h=$w*0.9; }
		
		if($aligp_parent!='') {
			$style="grid";
			$style_end="grid_end";
			$w=$w*1.96;
			$h=$h*2.;
			if($aligp_old=='only_image') {}
			if($aligp_old=='left_image_text') { $w=$w*2; }
			if($aligp_old=='top_image_text') { $h=$h*2; }
			if($aligp_old=='right_image_text') { $w=$w*2; }
			if($aligp_old=='bottom_image_text') { $h=$h*2; }
			if($aligp_old=='only_text') {}
			if($aligp_old=='only_image_wide') { $w=$w*2; }
			if($aligp_old=='only_image_tall') { $h=$h*2; }
			
		}
		
		
		if($pshape=='diamond') { $h=$w; $coutput.=' diamond-sha'; }
		
		
		$is_hide_col='';
		if($hide_col=='yes') $is_hide_col=''; else $is_hide_col='col'.$columns;
		$stick_p='';
		$stick_p=is_sticky();
		if($stick_p) $stick_p=' is_sticky';
		echo '<div '.$itemprop.' class="'.$is_hide_col.$stick_p.' content_wrap '.$coutput.' '.$is_mr.' cb_'.$cb_type.' '.$style.' '.$aligp_parent.'">';

		
		if($ajax=='yes') { //ajax hidden content

				$this->set_content_block('ajax');
				$this->block_title($columns);
				$this->block_details($columns);
				$this->block_port_details($columns);
				$this->block_content('270');
				$this->read_more('bttn roundy','view project');
				$this->set_content_block($style_end);
			
		}
		if($columns=='1'&&$list=='list_style') $h=$w;
		
		
		if($cap=='cap') $title='no';

		if($columns=='1'&&$list!='list_style') {
			
			if($cb_type=='portfolio_project'){
			
				echo '<div class="porty_left">';
			}
			switch($cb_type){
				case 'audio':
					if($sf=='yes'&&is_single()) $this->block_featured_image($w,$h,'round',$link_to,$gallery_blog,$cap,$fade,'','',$pshape=$pshape,'',$fade_ani,'',$style,$echo);
					$this->block_media('audio');
					break;
				case 'video':
					if($sf=='yes'&&is_single()) $this->block_featured_image($w,$h,'round',$link_to,$gallery_blog,$cap,$fade,'','',$pshape=$pshape,'',$fade_ani,'',$style,$echo);
					$this->block_media('video',$w,$vh);
					break;
				case 'slider':
					$this->block_slider('default',$w,$h);
					break;
				case 'gallery':
					if($style!='post'&&$style!='page') $this->block_slider('gallery',$w,$h+100);
					else $this->block_gallery($w,$h,$columns);
					break;
				default:
					if($sf=='yes') $this->block_featured_image($w,$h,'round',$link_to,$gallery_blog,$cap,$fade,'','',$pshape=$pshape,'',$fade_ani,'',$style,$echo);
					break;
			}
			if($cb_type=='portfolio_project'){
				
				echo '</div><div class="porty_right"><div class="content_start dets"><div class="port_left">';
				if($show_dtitle!='no') {$this->block_avatar();
				$this->block_author('by');}
					
				if($title!='no') $this->block_title('4');
				if($show_dtitle!='no') {if($details=='yes') $this->block_details($columns);}

				echo '</div><div class="port_right">';
				$this->block_port_details($columns);
				echo '</div><div class="cl"></div></div>';
			}
			
			$this->set_content_block();
			
			if($cb_type!='portfolio_project'){
					
				if($show_dtitle!='no') {$this->block_avatar();
				$this->block_author('by');}
					
				if($title!='no') $this->block_title('4');
				if($show_dtitle!='no') {if($details=='yes') $this->block_details($columns);}
			}
			
			if($aligp_parent!='') $this->read_more('hidden');
			if($hide_content!='yes') $this->block_content($con_lg);
			if($read_more=='yes') $this->read_more('bttn_big roundy');
			$this->set_content_block($style_end);
			if($cb_type=='portfolio_project')echo '<div class="cl"></div></div>';
			

		} //end 1 columns no list layout
		
		else {
			switch($cb_type){
				case 'audio':
					$this->block_media('audio');
					$this->set_content_block($style);
					if($title!='no') $this->block_title($columns);
					if($details=='yes') $this->block_details($columns);
						if($aligp_parent!='') $this->read_more('hidden');
					if($hide_content!='yes') $this->block_content($con_lg);
					$this->set_content_block($style_end);
					if($read_more=='yes') $this->read_more();
					break;
				case 'video':
					$this->block_media('video',$w,$vh);
					$this->set_content_block($style);
					if($title!='no') $this->block_title($columns);
					if($details=='yes') $this->block_details($columns);
						if($aligp_parent!='') $this->read_more('hidden');
					if($hide_content!='yes') $this->block_content($con_lg);
					if($read_more=='yes') $this->read_more();
					$this->set_content_block($style_end);
					break;
				case 'slider':
					$this->block_slider('default',$w,$h);
					$this->set_content_block($style);
					if($title!='no') $this->block_title($columns);
					if($details=='yes') $this->block_details($columns);
						if($aligp_parent!='') $this->read_more('hidden');
					if($hide_content!='yes') $this->block_content($con_lg);
					if($read_more=='yes') $this->read_more();
					$this->set_content_block($style_end);
					break;
				case 'gallery':
					if($style!='post'&&$style!='page') $this->block_slider('gallery',$w,$h+100);
					$this->set_content_block($style);
					if($style=='post'||$style=='page') {
						$this->block_content();
						$this->block_gallery($w,$h,$columns);
					}
					$this->set_content_block($style_end);
					break;
				
				case 'portfolio_project':
						if($sf=='yes') $this->block_featured_image($w,$h,'round',$link_to,$gallery_blog,$cap,$fade,'','',$pshape=$pshape,'',$fade_ani,'',$style,$echo);
						$this->set_content_block($style);
						if($title!='no') $this->block_title($columns);
						if($aligp_parent!='') $this->read_more('hidden');
						if($style=='post') {
							$this->block_content();
						}
						if($read_more=='yes') $this->read_more();
						$this->set_content_block($style_end);
						break;
				default:
					if($sf=='yes') $this->block_featured_image($w,$h,'round',$link_to,$gallery_blog,$cap,$fade,'','',$pshape=$pshape,'',$fade_ani,'',$style,$echo);
					$this->set_content_block($style);
			
					if($list=='list_style') {
						if($details=='yes') $this->block_details($columns);
						if($title!='no') $this->block_title($columns);
					} else {
						if($title!='no') $this->block_title($columns);
						if($details=='yes') $this->block_details($columns);
					}
					if($aligp_parent!='') $this->read_more('hidden');
			
					if($hide_content!='yes') $this->block_content($con_lg);
					if($read_more=='yes'&&$aligp_parent=='') $this->read_more();
					$this->set_content_block($style_end);
					break;
			}

		} //else end 1 columns no list layout
		
		
		if($about=='yes') if($show_about!='no') {$this->about_author_block();}
		if($comments=='yes') $this->comments_block();
		
		
		echo '<div class="cl"></div></div>';
	}

/* ================================================
 * BLOCKS
 */

/* ================================================
 * BLOG LIST
 * ================================================ */
	public function blog($o=array('ord'=>'DESC','read_more'=>'yes','navi'=>'yes')){
		global $post;
		if(isset($o['style']))$style=$o['style'];
		
		if(isset($o['show_cat_list']))$show_cat_list=$o['show_cat_list']; 
		if(isset($o['cats']))$cats=$o['cats']; 
		if(isset($o['columns']))$columns=$o['columns']; 
		if(isset($o['per_page']))$per_page=$o['per_page']; 
		if(isset($o['filter']))$filter=$o['filter']; else $filter='';
		if(isset($o['filtera']))$filtera=$o['filtera']; else $filtera='';
		if(isset($o['link']))$link=$o['link']; else $link='';
		if(isset($o['ajax']))$ajax=$o['ajax']; else $ajax='';
		if(isset($o['cap']))$cap=$o['cap']; else $cap='';
		if(isset($o['post_details']))$post_details=$o['post_details'];
		if(isset($o['con_lg']))$con_lg=$o['con_lg']; else $con_lg='';
		if(isset($o['title']))$title=$o['title']; else $title='yes';
		if(isset($o['sf']))$sf=$o['sf']; else $sf='';
		if(isset($o['navi']))$navi=$o['navi']; else $navi='';
		if(isset($o['navi_mode']))$navi_mode=$o['navi_mode']; else $navi_mode='';
		if(isset($o['hide_content']))$hide_content=$o['hide_content'];
		if(isset($o['read_more']))$read_more=$o['read_more'];
		if(isset($o['ord']))$ord=$o['ord'];
		if(isset($o['pshape']))$pshape=$o['pshape']; else $pshape='';
		if(isset($o['alig']))$alig=$o['alig']; else $alig='';
		if(isset($o['full']))$full=$o['full']; else $full='';
		if(isset($o['list']))$list=$o['list']; else $list='';
		if(isset($o['navi_style']))$navi_style=$o['navi_style']; else $navi_style='';
		if(isset($o['navi_bg']))$navi_bg=$o['navi_bg']; else $navi_bg='';
		if(isset($o['grid_no']))$grid_no=$o['grid_no']; else $grid_no='';
		if(isset($o['full_port']))$full_port=$o['full_port']; else $full_port='';

		if(isset($o['fade']))$fade=$o['fade']; else $fade='';
		if(isset($o['fade_ani']))$fade_ani=$o['fade_ani']; else $fade_ani='';
		
		if($list=='yes') $list='list_style';
		
		if($cap=='none') $title='no';
		
		$cb_rand=rand();
		$gallery_blog='gally'.$cb_rand;
	
		if($show_cat_list=='yes') $this->cat_list();
		$cb_sidebar_global=cb_get_sidebars($post->ID);
		$sf_aj='';
		if($sf=='') $sf_aj='yes';
		
		if($navi=='yes'&&$navi_mode=='ajax') {?>
		<script type="text/javascript">
			// AJAX LOADER
			jQuery(document).ready(function(){
			var page = 1; 
			var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
			jQuery('.cb_load_more').live('click', function(){

				var paged = jQuery(this).attr('data-paged');
				var btn = jQuery(this);
				var max_posts = jQuery(this).attr('data-posts');
				jQuery(this).attr('data-paged',parseInt(paged)+1);
			
				jQuery.post( ajaxurl, { action: 'cbloader',paged:paged,
					cats:'<?php echo $cats; ?>',
					per_page:'<?php echo $per_page; ?>',
					ord:'<?php echo $ord; ?>',
					gallery_blog:'<?php echo $gallery_blog; ?>',
					hide_content:'<?php echo $hide_content; ?>',
					style:'<?php echo $style; ?>',
					cap:'<?php echo $cap; ?>',
					link:'<?php echo $link; ?>',
					title:'<?php echo $title; ?>',
					fade:'<?php echo $fade; ?>',
					fade_ani:'<?php echo $fade_ani; ?>',
					post_details:'<?php echo $post_details; ?>',
					columns:'<?php echo $columns; ?>',
					con_lg:'<?php echo $con_lg; ?>',
					alig:'<?php echo $alig; ?>',
					list:'<?php echo $list; ?>',
					pshape:'<?php echo $pshape; ?>',
					read_more:'<?php echo $read_more; ?>',
					sf:'<?php echo $sf_aj; ?>',
					gallery_blog:'<?php echo $gallery_blog; ?>',
					fade:'<?php echo $fade; ?>',
					fade_ani:'<?php echo $fade_ani; ?>',
					ajax:'<?php echo $ajax; ?>',
					side:'<?php echo $side; ?>',
					global_side:'<?php echo $global_side; ?>',
					coutput:'<?php echo $coutput; ?>',
					full_port:'<?php echo $full_port; ?>',
					security:'<?php echo wp_create_nonce('cb-secur'); ?>'}, function(data){

			jQuery('.cb_rand-<?php echo $cb_rand;?> .load_wrap').append(data);
			var postbox_length=jQuery('.cb_rand-<?php echo $cb_rand;?> .content_wrap').length;
			var ih=jQuery('.cb_rand-<?php echo $cb_rand;?> .content_wrap').first().height();
			var igg=jQuery('.cb_rand-<?php echo $cb_rand; ?>').height();
			
			Echo.init({
				offset: 3500,
				throttle: 150
				});

			

			  var widd=jQuery(document).width();
			  <?php if($style!='portfolio') { ?> 
				<?php 
				$gutter=0;
				if($columns=='4') $gutter='28';
				if($columns=='3') $gutter='28';
				if($columns=='2') $gutter='38';
				if($columns=='1') $gutter='0';
				if($alig=='yes') $gutter='0';
				if($cb_sidebar_global['side']=='yes') {
					if($columns=='4') $gutter='20';
					if($columns=='3') $gutter='20';
					if($columns=='2') $gutter='24';
				}
				?>
				jQuery('.cb_rand-<?php echo $cb_rand; ?>').masonry('destroy');
		 	    jQuery('.cb_rand-<?php echo $cb_rand; ?>').imagesLoaded( function() {
				jQuery('.cb_rand-<?php echo $cb_rand; ?>').masonry({
			      itemSelector: '.content_wrap',gutter:<?php echo $gutter;?>
				});  
				<?php if($alig=='yes') { ?>
				var gridh=jQuery('.cb_rand-<?php echo $cb_rand; ?>').height();
				jQuery('.cb_rand-<?php echo $cb_rand; ?>').parent().next('.grid_spacer').height(gridh);
				<?php } ?> 
				});		
			    
				<?php } ?>

				 jQuery('.cb_rand-<?php echo $cb_rand; ?>').imagesLoaded( function() {
	 		    jQuery('.fullbgspacer').each(function(){
	 		     	var ph=jQuery(this).parent().height();
	 		      	jQuery(this).css('height',ph);
	 		    });
				});	
				jQuery(".load_wrap").offset().top
				  jQuery('html, body').animate({
				         scrollTop: igg + 150 
				     }, 400);
				if(postbox_length==max_posts) { btn.fadeOut('slow'); }

			  });
			});
			
			});
			// AJAX LOADER END JS
		</script>
	
		<?php 
		} // AJAX LOADER END
		
		
		
		
		
		
		?>

		<script type="text/javascript">
		
		function show_cat(cat,ob){
			jQuery(".cb_rand-<?php echo $cb_rand;?> .content_wrap.portfolio").hide();
			  var widd=jQuery(document).width();
				<?php 
				$gutter=0;
				if($columns=='4') $gutter='28';
				if($columns=='3') $gutter='28';
				if($columns=='2') $gutter='38';
				if($columns=='1') $gutter='0';
				if($alig=='yes') $gutter='0';
				if($cb_sidebar_global['side']=='yes') {
					if($columns=='4') $gutter='20';
					if($columns=='3') $gutter='20';
					if($columns=='2') $gutter='24';
				}
				?>
				 <?php if($style!='portfolio') { ?>  jQuery('.cb_rand-<?php echo $cb_rand; ?>').imagesLoaded( function() {
				jQuery('.cb_rand-<?php echo $cb_rand; ?>').masonry('destroy');
				jQuery('.cb_rand-<?php echo $cb_rand; ?>').masonry({
			      itemSelector: '.content_wrap',gutter:<?php echo $gutter;?>
				});  
				<?php if($alig=='yes') { ?>
				var gridh=jQuery('.cb_rand-<?php echo $cb_rand; ?>').height();
				jQuery('.cb_rand-<?php echo $cb_rand; ?>').parent().next('.grid_spacer').height(gridh);
				<?php } ?> 
				});		<?php } ?>
			    

			
			jQuery('.port_sho').removeClass('bold');
			jQuery('.port_sho').removeClass('black');
			jQuery(ob).addClass('bold');
			jQuery(ob).addClass('black');
		var columns = <?php echo $columns;?>;
		jQuery('.cb_rand-<?php echo $cb_rand;?> .content_wrap.portfolio').css("margin-right","");
		  if(!cat) {
			   var counter = 1;
			     jQuery(".cb_rand-<?php echo $cb_rand;?> .content_wrap.portfolio").each(function(){ 
			        if(counter%columns==0)
			            jQuery(this).css("margin-right","0");
			        counter++;
			    });
		  jQuery('.cb_rand-<?php echo $cb_rand;?> .content_wrap.portfolio:hidden').fadeIn('slow'); 
		  }
		  else { 
		      var counter = 1;
				jQuery('.cat-'+cat).each(function(){ 
		      if(counter%columns==0)
		          jQuery(this).css("margin-right","0");
		      counter++;
		  	});
		  jQuery('.cb_rand-<?php echo $cb_rand;?> .content_wrap.portfolio').not('.cat-'+cat).hide(); 
		  jQuery('.cat-'+cat+':hidden').fadeIn('slow'); 
		   
		   
		   }

		
		 }
		
		<?php 
		if($ajax=='yes') {  ?>

        function load_image(src,pid){
		jQuery(".load_image").show();
		jQuery(".load_h").slideDown('slow');
		jQuery(".load_image_c").slideDown('slow');
		jQuery('.load_image_c').empty();
		jQuery('html, body').animate({scrollTop:jQuery('.scroll_to').offset().top - 137}, 'slow');
		var getpi=jQuery('.ajax_start_'+pid).html();
		jQuery('.load_image_c').append('<div id="im" style="display:none;"><img class="img_load" src="'+src+'"></div><div class="port_item_in">'+getpi+'</div><div class="cl"></div>');
		jQuery('.img_load').load(function() {
		jQuery(".load_h").fadeOut('slow');
		jQuery('.close_item').fadeIn('slow');
		jQuery(this).removeAttr('height').removeAttr('width');
		    cloned = jQuery(this).clone().css({visibility:'hidden'});
		    jQuery('body').append(cloned);
		    o_width = cloned.get(0).width; 
		    o_height = cloned.get(0).height; 
		    cloned.remove();
			if (o_width>630)jQuery(this).attr({width:630});
			jQuery("#im").slideToggle();	 
		    }); 
		 }
		
		
		jQuery(document).ready(function() {  
		 jQuery('.close_item').click(function (){
			 jQuery(this).hide();
		 jQuery(".load_image_c").slideUp('slow');
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
							a_href =  jQuery(this).find('div.frame a').attr('href');
							
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
		
		
		<?php 
		
		
		
		
		
		
		
		
		

		if($ajax=='yes'){ ?>
				<div class="scroll_to"></div>
					<div class="load_image">
					<a class="close_item" title="<?php _e('close item','cb-modello');?>"><i class="fa fa-times-circle-o"
					></i></a>
							<div class="load_image_c">
							<div class="load_h"></div>
							</div>
							<div class="load_n"></div>
					</div>			
		
		<?php


        }
		
		$ajax_style='';$full_port_class='';
		if($ajax=='yes') $ajax_style='ajax_hover';
				
		if($alig=='yes'&&$full=='yes') echo '<div class="grid_fullw">';
		if($alig=='yes'&&$full!='yes') echo '<div class="grid">';
		if($full_port=='yes') $full_port_class='fully_gall';
		
		if($filter=='yes') $this->portfolio_filter_block($cats,$per_page,$filtera); 
		
		echo '<div class="cb_posts cb_rand-'.$cb_rand.' '.$full_port_class.' '.$list.' '.$ajax_style.'">';
		
		
		$aligp='';
		
		query_posts('cat='.$cats.'&posts_per_page=9999');
		$post_count='0';
		if(have_posts()) :
		while(have_posts()){ the_post();
		$post_count++;
		}
		endif;
		wp_reset_query();
		
		
		
		query_posts('cat='.$cats.'&posts_per_page='.$per_page.'&order='.$ord.'&paged='.get_query_var('paged'));
		
		$count_posts=1; $roc=0; $grid_counter='1';

		$cb_blocks_options=cb_get_blocks_options($post->ID);
		if(have_posts()) :
		while(have_posts()){ the_post();

			$coutput=''; $ccat='';
			$c_cat=get_the_category();
			
			foreach($c_cat as $c_cat_item) {
				$coutput .= ' cat-'.$c_cat_item->term_id ;
				$ccat .= $c_cat_item->term_id;
			
			}
		$thisCat = get_category(get_query_var('cat'),false);
		$max_posts=$post_count;
		$cb_blocks_options=cb_get_blocks_options($post->ID);
		$cb_sidebars=cb_get_sidebars($post->ID);
		if($alig!=''&&$alig!='no') $aligp=$cb_blocks_options['posts_style']; else $aligp='';
		if($sf=='') $sf=$cb_blocks_options['display_featured'];
		if($count_posts%$columns=='0') $mr='0'; else $mr='';

		if($alig=='yes'&&$grid_no!=''&&$grid_counter=='1') echo '<div class="grid_flow grid_items1">';

		$this->build_blocks(array('cb_type'=>$cb_blocks_options['cb_type'],'read_more'=>$read_more,
							'sf'=>$sf,'gallery_blog'=>$gallery_blog,
							'hide_content'=>$hide_content,'style'=>$style,'fade'=>$fade,'fade_ani'=>$fade_ani,
							'cap'=>$cap,'link'=>$link,'ajax'=>$ajax,
							'side'=>$cb_sidebars['side'],'global_side'=>$cb_sidebar_global['side'],'title'=>$title,'details'=>$post_details,'columns'=>$columns,
							'con_lg'=>$con_lg,'mr'=>$mr,'pshape'=>$pshape,'aligp'=>$aligp,'list'=>$list,'coutput'=>$coutput,'full'=>$full_port));
		$count_posts++;

		if($alig=='yes'&&$grid_no==$grid_counter&&$grid_no!='') echo '</div><div class="grid_flow grid_items'.$grid_counter.'">';
		
		$grid_counter++;
		
		if($alig=='yes'&&$grid_counter==$per_page+1&&$grid_no!='') echo '</div>';
		} else :
		$roc=1;
		get_template_part('404');
		endif;

		echo '<div class="cl"></div>';
		echo '<div class="load_wrap"></div></div>';
		
		if($alig=='yes'&&$full=='yes') echo '</div>';
		if($alig=='yes'&&$full!='yes') echo '</div>';
		if($alig=='yes') echo '<div class="grid_spacer"></div>';
		$gutter=0;
		if($columns=='4') $gutter='28';
		if($columns=='3') $gutter='28';
		if($columns=='2') $gutter='38';
		if($cb_sidebar_global['side']=='yes') {
			if($columns=='4') $gutter='20';
			if($columns=='3') $gutter='20';
			if($columns=='2') $gutter='24';
		}
		if($columns=='1') $gutter='0';
		if($alig=='yes') $gutter='0';
			if($roc=='0') { ?>
			<script type="text/javascript">
			jQuery(function(){
			   var widd=jQuery(document).width();
			   <?php if($style!='portfolio') { ?> 
			   
					var t_w=jQuery('.cb_rand-<?php echo $cb_rand; ?>').width();
					var mod_t=t_w%4;
					if(mod_t!=0) jQuery('.cb_rand-<?php echo $cb_rand; ?>').width(t_w+1);
					t_w=jQuery('.cb_rand-<?php echo $cb_rand; ?>').width();
					mod_t=t_w%4;
					if(mod_t!=0) jQuery('.cb_rand-<?php echo $cb_rand; ?>').width(t_w+1);
					t_w=jQuery('.cb_rand-<?php echo $cb_rand; ?>').width();
					mod_t=t_w%4;
					if(mod_t!=0) jQuery('.cb_rand-<?php echo $cb_rand; ?>').width(t_w+1);
					
					jQuery('.cb_rand-<?php echo $cb_rand; ?>').imagesLoaded( function() {
						jQuery('.cb_rand-<?php echo $cb_rand; ?>').masonry({
					      itemSelector: '.content_wrap',gutter:<?php echo $gutter;?>
						});  
						<?php if($alig=='yes') { ?>
						var gridh=jQuery('.cb_rand-<?php echo $cb_rand; ?>').height();
						<?php if($alig=='yes'&&$grid_no!='') { $final_v=$per_page/$grid_no;?>
						gridh=gridh/<?php echo $final_v;?>; <?php } ?>
						jQuery('.cb_rand-<?php echo $cb_rand; ?>').parent().next('.grid_spacer').height(gridh);
						<?php } ?> 
						});		
					jQuery('.cb_rand-<?php echo $cb_rand; ?>').imagesLoaded( function() {
							jQuery('.cb_rand-<?php echo $cb_rand; ?>').masonry({
					      itemSelector: '.content_wrap',gutter:<?php echo $gutter;?>
						});  
						<?php if($alig=='yes') { ?>
						var gridh=jQuery('.cb_rand-<?php echo $cb_rand; ?>').height();
						<?php if($alig=='yes'&&$grid_no!='') { $final_v=$per_page/$grid_no;?>
						gridh=gridh/<?php echo $final_v;?>; <?php } ?>
						jQuery('.cb_rand-<?php echo $cb_rand; ?>').parent().next('.grid_spacer').height(gridh);
						<?php } ?> 
						});		
			    
				 <?php  } ?>

				<?php if($full_port=='yes'){ 
$g_grid='960';
if(get_option('cb5_grid')=='1170') $g_grid='1170';
$wid=esc_attr(get_option('cb5_wid'));
$windw='window';
if($wid=='fixed')$windw="'#bg'";?>
				var windw=jQuery(<?php echo $windw;?>).width();
				var grid_left=windw-<?php echo $g_grid;?>; grid_left=grid_left/2; grid_left=-Math.abs(grid_left);
				jQuery('.cb_rand-<?php echo $cb_rand; ?>').css('margin-left',grid_left);
				jQuery('.cb_rand-<?php echo $cb_rand; ?>').width(windw);
				<?php } ?>

			  });
			</script>
			<?php } 

			if($navi=='yes'&&$navi_mode!='ajax') $this->block_navi($navi_style,$navi_bg);
			if($navi=='yes'&&$navi_mode=='ajax') {
				echo '<a data-paged="2" class="cb_load_more bttn_big view_all" data-posts='.$max_posts.'
				data-nonce="'.wp_create_nonce('load_posts').'" href="javascript:;">
				'.__('Load','cb-modello').' <i class="fa fa-refresh"></i> '.__('more','cb-modello').'</a>';


			}
			wp_reset_query();
			if($alig=='yes'&&$full=='yes'&&$grid_no!='') { ?>
				<div class="text_block" style="margin-top: 50px;">
					<div class="aligncenter">
					<span class="divider_heading white" style="margin-top:61px!important;"></span>
					<p>
					<i class="grid_left fa fa-arrows-h builder-icon animate flip_top ani_color_after_blue fullbg-blue fullbg-after_white i80" style="font-size: 40px; color: rgb(255, 255, 255); position: relative; z-index: 3; display: none;" data-tip="" data-wh="i80" data-ani1="flip_top" data-ani2="blue" data-ani3="blue" data-ani4="white"></i>
					</p></div>
				</div><?php
			}
					
		}

/* ================================================
 * CONTENT
 * ================================================ */
	public function block_content($con_lg=''){
		global $post;
		echo '<div class="content_block">';
		if(!isset($con_lg)||$con_lg=='') the_content();
		else echo strip_cn(get_the_content(),$con_lg);
		echo '</div><div class="cl"></div>';
	}

/* ================================================
 * CONTENT START
 * ================================================ */
	public function set_content_block($style=''){
		global $post;
		$post_opt=cb_get_post_options($post->ID);
		if($style!='end'&&$style!='grid_end'&&$style!='ajax'&&$style!='grid') echo '<div class="content_start">';
		if($style=='ajax') echo '<div class="ajax_start_'.$post->ID.' ajax_start">';
		$opa_bg='';$text_opa='';
		$opa_bg=hex2rgb($post_opt['grid_bg']);
		$text_opa=hex2rgb($post_opt['grid_text']);
		$opa_bg='rgba('.$opa_bg.',0.8)';
		$text_opa='rgba('.$text_opa.',0.4)';
		$rand=rand();
		if(($style=='grid'&&$post_opt['grid_text']!='')||($style=='grid'&&$post_opt['grid_bg']!='')) {
			echo '<div><style type="text/css" media="screen" scoped>
			#post-'.$rand.'-grid-post{background:'.$opa_bg.';color:'.$post_opt['grid_text'].';}
			#post-'.$rand.'-grid-post .more{background:'.$post_opt['grid_text'].'!important;}
			#post-'.$rand.'-grid-post h5,#post-'.$rand.'-grid-post h5 a,#post-'.$rand.'-grid-post .details,#post-'.$rand.'-grid-post .details li,#post-'.$rand.'-grid-post .details li a,#post-'.$rand.'-grid-post .details li i
			{color:'.$post_opt['grid_text'].'!important;}
			.grid_alignp #post-'.$rand.'-grid-post .title_hidden_divider {
			 border-top: 2px solid '.$text_opa.';
			}</style>';
		}
		if($style=='grid') echo '<div class="content_start grid" id="post-'.$rand.'-grid-post" style=""><div class="con_grid_out"><div class="con_grid_in">';
		if($style=='grid_end') echo '</div></div></div>';
		if(($style=='grid_end'&&$post_opt['grid_text']!='')||($style=='grid_end'&&$post_opt['grid_bg']!='')) echo '</div>';
		if($style=='end') echo '</div>';
	}
	
/* ================================================
 * READ MORE BUTTON
 * ================================================ */
	public function read_more($class='bttn roundy',$text=''){
		global $post;
		$class_old=$class;
		$class.='more ';
		if($class_old=='hidden') $class='bttn_big hidden roundy black no_transi';
		if($class_old=='hidden') echo '<div class="hidden_out">';
		echo '<a class="'.$class.'" href="'.get_permalink($post->ID).'">';
		if($text=='')_e('read more','cb-modello'); else _e($text,'cb-modello');
		echo '</a>';
		if($class_old=='hidden') echo '</div>';
	}

/* ================================================
 * BUTTON
 * ================================================ */
	public function block_bttn($content='',$target='_self',$align='left',$size='',$link='',$icon='',$color='',$styler=''){
		global $post;
		if($styler=='') $styler='square';
		if($size=='big') $size='_big';
		else if($size=='verybig') $size='_big very'; 
		else $size=' '.$size;
		echo '<a class="bttn'.$size.' '.$color.' '.$styler.'  align'.$align.'" href="'.$link.'" target="'.$target.'">';
		echo html_entity_decode($icon).$content;
		echo '</a>';
	}
	
/* ================================================
 * MEDIA
 * ================================================ */
	public function block_media($type,$w='960',$h='700',$alt='',$link='',$controls='',$info='',$play='',$full='',$vid_audio='',$v_f=''){
		global $post;

		$cb5_audio = get_post_meta($post->ID, '_cb5_audio', true);
		$cb5_video = get_post_meta($post->ID, '_cb5_video', true);
		
		$soundcloudid=$cb5_audio['soundcloudid'];
		if(($type=='audio'&&$soundcloudid!='')||($type=='soundcloud'&&$link!='')){
			if($link!='')$soundcloudid=$link;
			echo '<div class="frame"><iframe class="cb_media soundcloud" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/'.$soundcloudid.'"></iframe></div>';
		} else { $aurl=$cb5_audio['url'];
		if(($type=='video')||($type=='youtube'&&$link!='')||($type=='vimeo'&&$link!='')) $aurl=$cb5_video['url'];
		wp_enqueue_style('videojs', WP_THEME_URL.'/inc/assets/js/video-js/video-js.css', false, '1.0', 'screen');
		wp_enqueue_script('videojs',WP_THEME_URL.'/inc/assets/js/video-js/video.min.js', array('jquery'), '1.0', true);
		if($link!='')$aurl=$link;
		$pos = strpos($aurl,'vimeo.com');
		if(!isset($ss)) $ss=''; $video='';
		$is_full='';
		$vim_play='';$yt_play='';$vid_play='';
		$vid_rand='vid_id_'.rand();
		if($play=='play') {
			$vim_play='&amp;autoplay=1&amp;loop=1&amp;api=1&amp;player_id='.$vid_rand;
			$yt_play='&amp;autoplay=1&amp;enablejsapi=1';
			$video_play='autoplay loop';
		}
		$tt='';
		if($full=='full') $is_full=' full_video';
		if(preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $aurl, $match)) { $video=$match[1]; }
		if($video!='') { $tt='yt'; echo '<div class="frame cb_media '.$is_full.'"><iframe id="'.$vid_rand.'" style="height:'.$h.'px;width:'.$w.'px;" class="cb_media round" src="http://www.youtube.com/embed/'. $video.'?wmode=transparent&amp;controls=1&amp;showinfo=0'.$yt_play.'" title="'.get_the_title().'"></iframe></div>'; }
		if($pos===false) { } else {
			$video=substr($aurl,17,8);
			$tt='vim';
			echo '<div class="frame cb_media '.$is_full.'"><iframe id="'.$vid_rand.'" style="height:'.$h.'px;width:'.$w.'px;" class="cb_media" src="http://player.vimeo.com/video/'.$video.'?title=0&amp;byline=0&amp;portrait=0'.$vim_play.'"></iframe></div>';
		}
		if($video==''&&$pos===false&&$aurl!='') {
		$tt='vid';
			echo '<div class="frame cb_media '.$is_full.'"><video id="'.$vid_rand.'" style="height:'.$h.'px;width:'.$w.'px;" id="media-'.$post->ID.'" class="round video-js vjs-default-skin cb_media" controls preload="none" '.$video_play.' > <source src="'.$aurl.'" type="video/mp4" /></video></div>';
		}

		if($vid_audio=='0'&&$tt=='vim'){
		wp_enqueue_script('fr',WP_THEME_URL.'/inc/assets/js/froogaloop.min.js',array('jquery'),'1.0',true);
		 echo '
 		<script>
		function ready(player_id) {
		var player = $f(player_id);
 		player.api(\'setVolume\', 0);
		}
			window.addEventListener(\'load\', function() {
            //Attach the ready event to the iframe
            $f(document.getElementById(\''.$vid_rand.'\')).addEvent(\'ready\', ready);
        });
		</script>';
		} 
		
		if($vid_audio=='0'&&$tt=='vid'){ ?>
		<script>
		jQuery(window).bind("load",function(){
		document.getElementById('<?php echo $vid_rand; ?>').muted = true;
		});
		</script>
		<?php }
		if($vid_audio=='0'&&$tt=='yt'){ ?>
		<script>     
		jQuery(window).bind("load",function(){
		var player =  document.getElementById('player');
		player.mute();
		});
		</script>
		<?php
		}
		if($v_f=='yes') {
		?>
		<script>
		jQuery(window).bind("load",function(){
		<?php
			    $g_grid='960';
			    if(esc_attr(get_option('cb5_grid'))=='1170') $g_grid='1170';
			    ?>
			    var windw=jQuery(window).width();
			    var leftmi=1920-windw; if(leftmi>50){leftmi=leftmi/2; leftmi=-Math.abs(leftmi);
			        jQuery('<style type="text/css"> #<?php echo $vid_rand;?>{ width:1920px!important;margin-left:'+leftmi+'px!important;} </style>').appendTo('head');
			    }
			    });
		</script>
		<?php
		}
		}
	}

/* ================================================
 * TITLE / HEADING
 * ================================================ */
	public function block_title($columns=1,$link_to='',$size='',$text='',$align='',$icon='',$hide='no',$divider='',$divider_color='',$margin_b='',$trans='',$weight=''){
		global $post;
		$c1='';$c2='';$div='';
		if(!isset($weight)) $weight='';
		if($align=='left') {$c1=' class="wn';$c2=' wn';} else {$c1=' class="';$c2=' ';}
		if($margin_b!='') $margin_b=' margin-bottom:'.$margin_b.'px!important;';
		if($trans!='') $trans='text-transform:'.$trans.'!important;';
		if($weight!='') $weight='font-weight:'.$weight.'!important;';
		if($divider=='') $c1.=' nodiv';
		$size1=$size; $size1.=' style="text-align:'.$align.';'.$margin_b.$trans.$weight.'"'.$c1.' title_heading"';
		if($divider!=''&&$divider_color!='') $div='<span class="divider_heading '.$divider_color.'"></span>';
		
		if($size=='l'){$size1='h1 itemprop="name" style="text-align:'.$align.';'.$margin_b.$trans.$weight.'"'.$c1.' h_large title_heading"';$size='h1';}
		if($size=='l2'){$size1='h1 itemprop="name" style="text-align:'.$align.';'.$margin_b.$trans.$weight.'"'.$c1.' h_ultra_large title_heading"';$size='h1';}
		if($size=='2h1'){$size1='h1 itemprop="name" style="text-align:'.$align.';'.$margin_b.$trans.$weight.'"'.$c1.' titles title_heading"';$size='h1';}
		if($size=='2h2'){$size1='h2 itemprop="name" style="text-align:'.$align.';'.$margin_b.$trans.$weight.'"'.$c1.' titles title_heading"';$size='h2';}
		if($size=='2h3'){$size1='h3 itemprop="name" style="text-align:'.$align.';'.$margin_b.$trans.$weight.'"'.$c1.' titles title_heading"';$size='h3';}
		if($size=='2h4'){$size1='h4 itemprop="name" style="text-align:'.$align.';'.$margin_b.$trans.$weight.'"'.$c1.' titles title_heading"';$size='h4';}
		if($size=='2h5'){$size1='h5 itemprop="name" style="text-align:'.$align.';'.$margin_b.$trans.$weight.'"'.$c1.' titles title_heading"';$size='h5';}
		if($size=='2h6'){$size1='h6 itemprop="name" style="text-align:'.$align.';'.$margin_b.$trans.$weight.'"'.$c1.' titles title_heading"';$size='h6';}
		if($size=='2l'){$size1='h1 itemprop="name" style="text-align:'.$align.';'.$margin_b.$trans.$weight.'" class="titles h_large'.$c2.' title_heading"';$size='h1';}
		if($size=='2l2'){$size1='h1 itemprop="name" style="text-align:'.$align.';'.$margin_b.$trans.$weight.'" class="titles h_ultra_large'.$c2.' title_heading"';$size='h1';}
		if($size!=''&&$text!='') echo '<'.$size1.'>'.$div.'<span class="heading_span">'.$icon.$text.'</span></'.$size.'>';
		else if($hide!='yes'){
		
		switch($columns){
			case 1:
			$heading='<h1 class="title_inside" itemprop="name">'; $heading_end='</h1>';
			break;
			case 2:
			$heading='<h4 class="title_inside" itemprop="name">'; $heading_end='</h4>';
			break;
			case 3:
			$heading='<h5 class="title_inside" itemprop="name">'; $heading_end='</h5>';
			break;
			case 4:
			$heading='<h5 class="title_inside" itemprop="name">'; $heading_end='</h5>';
			break;
			default:
			$heading='<h1 class="title_inside" itemprop="name">'; $heading_end='</h1>';
			break;
		}
		$title=$heading.'<a href="'.get_permalink().'" itemprop="url">'.$div.get_the_title().'</a>'.$heading_end;
		echo $title;
		} else {
		echo '';
		}
		echo '<div class="title_hidden_divider"></div>';
	}
	
	
/* ================================================
 * SLIDER
 * ================================================ */
	public function block_slider($type='default',$w='960',$h='700',$content=''){
		global $post;
		wp_enqueue_script('anyeasing',WP_THEME_URL.'/inc/assets/js/anything_slider/js/jquery.easing.1.2.js', array('jquery'), '1.0', true);
		wp_enqueue_script('any',WP_THEME_URL.'/inc/assets/js/anything_slider/js/jquery.anythingslider.min.js', array('jquery'), '1.0', true);
		
		$p_id=$post->ID; $slid_id=substr(rand(),0,3); 

		$cb5_slider = get_post_meta($post->ID, '_cb5_slider', true);
		if(!isset($cb5_slider['beh']))$cb5_slider['beh']='';
		if(!isset($cb5_slider['per_page']))$cb5_slider['per_page']='';
		if(!isset($cb5_slider['cat']))$cb5_slider['cat']='';
		$beh=$cb5_slider['beh'];
		$per_page=$cb5_slider['per_page'];
		$cat=$cb5_slider['category'];
		
		$s_auto='true';
		$s_delay='6000';
		$s_ani_time='300';
		$s_easing='swing';
		
		if($type=='gallery'){
		$s_auto='true';
		$s_delay='5000';
		$s_ani_time='400';
		$s_easing='swing';
		}
		echo '<script type="text/javascript"> 
			jQuery(function(){
			 jQuery(\'#slider'.$slid_id.$p_id.'\').anythingSlider({
				resizeContents      : false,	
				hashTags            : false,
				autoPlay            : '.$s_auto.',     
				pauseOnHover        : true,    
				resumeOnVideoEnd    : true,
				delay               : '.$s_delay.',     
				animationTime       : '.$s_ani_time.',    
				easing              : \''.$s_easing.'\'
			  });
			});
		</script><div class="any-slider-container"><div class="frame"><div><ul id="slider'.$slid_id.$p_id.'" class="slider">';
		$rando=rand();
	
		if($content!=''&&is_array($content)) {
			foreach ($content as $img) {
				echo '<li><div class="textSlide"><a href="'.$img['image'].'" data-rel="pp[post-'.$rando.']">
					<img src="'.bfi_thumb($img['image'], array('width' => $w,'height'=>$h, 'crop' => true)).'" class="round fade-s" alt="slide image"/>
					</a><div class="cl"></div></div></li>';
			}
		} else {
		if($beh!='cat') { $imgs=get_children('post_type=attachment&order=asc&orderby=menu_order&post_mime_type=image&post_parent='.$p_id);
		$slide_count='0';
			foreach ($imgs as $att_id => $att) {
			if(($type=='gallery'&&$slide_count<3)||$type!='gallery'){
				$gall_img=wp_get_attachment_image_src($att_id,'full');
				$ah='';
				if($type='gallery') $ah='<a href="'.get_permalink().'">'; else $ah='<a href="'.$gall_img[0].'" data-rel="pp[post-'.$p_id.']">';
				echo '<li><div class="textSlide">'.$ah.'
				<img src="'.bfi_thumb($gall_img[0], array('width' => $w,'height'=>$h, 'crop' => true)).'" class="round fade-s" alt="slide image"/>
				</a><div class="cl"></div></div></li>'; 
			$slide_count++;
			}}
			} //images from attached end
		else if($per_page!=''&&$cat!=''){
			$slide_q = new WP_Query('cat='.$cat.'&posts_per_page='.$per_page);

			while ($slide_q->have_posts()) : $slide_q->the_post();
			$isrc_slide=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
			
			if($isrc_slide) echo '<li><div class="textSlide"><a href="'.$isrc_slide[0].'" data-rel="pp[post-'.$post->ID.']"><img src="'.bfi_thumb($isrc_slide[0], array('width' => $w,'height'=>$h, 'crop' => true)).'" alt="slide image"/></a><div class="cl"></div></div></li>';
			
			//else echo '<li>'.apply_filters('the_content', get_the_content()).'</li>';
			endwhile;
		}//images from post cat end
		}
		echo '</ul></div></div></div>';
	}
	
	


/* ================================================
 * FEATURED IMAGE
 * ================================================ */
	
	public function block_featured_image($w='960',$h='',$roundy='round',$link_to='data-rel="pp"',$gallery='',$cap='',$fade='fade',$image='',$url='',$pshape='',$cap_content='',$fade_ani='',$noframe='no',$style='',$echo_single='',$crop='',$scale='yes'){
		$bfi_data_blank='';
		if($w>0&&$w!=''){$bfi_data=array('width'=>$w, 'crop' => true);$bfi_data_blank=array('width'=>$w,'opacity'=>'0', 'crop' => true);}
		if($h>0&&$h!=''&&$w>0&&$w!=''){$bfi_data=array('width'=>$w, 'height'=>$h, 'crop' => true);$bfi_data_blank=array('width'=>$w, 'height'=>$h,'opacity'=>'0', 'crop' => true);}
		global $post;

		$cb_image_options=cb_get_image_options($post->ID);
		$global_fade=$cb_image_options['global_fade'];
		$global_fade_ani=$cb_image_options['global_fade_effect'];
		$echo=$cb_image_options['echo'];

		$isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
		if($w>'600')$isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID );
		$i_url=$isrc[0];
		if($url!='') $isrc[0]=$url;
		$link_to_old=$link_to;
		$gallery_main=$gallery.'_main';$gallery_head=$gallery.'_head';
		$link_to_head=''; $link_to_main='';

		$link_to_pp='href="'.$isrc[0].'" data-rel="pp"';
		if($gallery!='')$link_to_pp='href="'.$isrc[0].'" data-rel="pp['.$gallery.']"';
		$imgsrc_port=$isrc[0];
		$is_port='';
		if($link_to=='ajax') {$is_port='yes'; $link_to='data-cur-id="'.$post->ID.'" data-largesrc="'.$isrc[0].'" ';$link_to_head=$link_to;$link_to_main=$link_to;}
		if($link_to=='page') {$link_to='href="'.get_permalink().'"';$link_to_head=$link_to;$link_to_main=$link_to;}
		if($link_to=='pp'&&$gallery!='') {$gallery='['.$gallery.']';$link_to='href="'.$isrc[0].'" data-rel="pp'.$gallery.'"';}
		
		if($link_to_old=='pp')$link_to_head='href="'.$isrc[0].'" data-rel="pp['.$gallery_head.']"';
		if($link_to_old=='pp')$link_to_main='href="'.$isrc[0].'" data-rel="pp['.$gallery_main.']"';
		if($style=='blog'){$link_to_main='href="'.get_permalink().'"';$link_to_head='href="'.get_permalink().'"';}
		if($style=='grid'){$link_to_head='href="'.get_permalink().'"';}
		
		if($cap=='cap') $gallery='';
		
		$frame='frame'; 
		if($noframe=='yes')$frame='';
		$i1='<a href="'.get_permalink($post->ID).'" class="icon1"><i class="fa fa-link"></i></a>';
		$i2='<a '.$link_to_pp.' class="icon2"><i class="fa fa-search"></i></a>';
		if($style!='blog'&&$style!='portfolio'&&$style!='cat'&&$style!='ajax') {
			$i1='';
		}
		if($cap=='title'&&$style=='portfolio') $cap_content='';
		if($link_to_old=='pp'&&$style=='portfolio')$i1='';
		$cap_nos=''; if($i1=='')$cap_nos='icon_mleft';
		if($cap_content=='') { $cap_content=get_the_title($post->ID);
		$cap_content='<h3><a '.$link_to_head.'>'.$cap_content.'</a></h3>';
		} else $cap_content='<h3><a '.$link_to_head.'>'.$cap_content.'</a></h3>';
		if($cap=='title') {$cap_content=''; $cap_nos.=' nocap';}
		if($cap=='none'&&$style=='portfolio') {$cap_content=''; $cap_nos.=' nocap';}
		
		$cap_content='<div class="cap_in '.$cap_nos.'"><div class="cap_inner">
						'.$cap_content.'
							'.$i1.'
							'.$i2.'
							</div></div>';$cap='cap';
		if($image!='') $isrc[0]=$image;
		
		
		
		if($fade=='') $fade=$global_fade_ani;
		if($fade_ani=='') $fade_ani=$global_fade;
		
		$zoomed='';$zoomed_class='';
		$blur_image='';
		if($fade=='e5_zoom_only'||$fade=='e6_zoom_opacity'||$fade=='e7_zoom_blur'||$fade=='e8_zoom_bright'||$fade=='e9_zoom_short'
		||$fade=='e10_zoom_out_opacity'||$fade=='e11_zoom_out_blur'||$fade=='e12_zoom_out_blur_bright'){
		$zoomed_class=$fade;
		if($fade=='9_zoom_short'||$fade=='e10_zoom_out_opacity'||$fade=='e11_zoom_out_blur'||$fade=='e12_zoom_out_blur_bright') 
			$zoomed_class.=' zoom_short';
		$zoom_src='src="'.bfi_thumb($isrc[0], $bfi_data).'"';
		
		if($echo=='yes') $zoom_src='src="'.bfi_thumb(WP_THEME_URL.'/img/blank.jpg',$bfi_data_blank).'" '.$blank_style.' data-echo="'.bfi_thumb($isrc[0], $bfi_data).'"';
		$zoomed='<img '.$zoom_src.' class="'.$zoomed_class.' zoomed_image" alt="zoomed image"/>'; 
		} 
		
		if($fade=='e2_blur'||$fade=='e4_bright'||$fade=='e8_zoom_bright'||$fade=='e3_opacity_blur'||
		$fade=='e7_zoom_blur'||$fade=='11_zoom_out_blur'||$fade=='e12_zoom_out_blur_bright'){
		$blur_src='src="'.bfi_thumb($isrc[0], $bfi_data).'"';
		if($echo=='yes') $blur_src='src="'.bfi_thumb(WP_THEME_URL.'/img/blank.jpg',$bfi_data_blank).'" data-echo="'.bfi_thumb($isrc[0], $bfi_data).'"';
		$blur_image='<img '.$blur_src.' class="blur_image" alt="blur image"/>';
		}
		$imgsrc='src="'.bfi_thumb($isrc[0], $bfi_data).'"';
		if($echo_single=='no') $echo='no';
		if($echo=='yes') $imgsrc='src="'.bfi_thumb(WP_THEME_URL.'/img/blank.jpg',$bfi_data_blank).'" data-echo="'.bfi_thumb($isrc[0], $bfi_data).'"';
		//$fade=$global_fade;
        if($scale=='no') $imgsrc='src="'.$isrc[0].'"';
		$not_roundy='';
		if($pshape=='hexagon'||$pshape=='circle') $not_roundy='not_round';
			if($isrc) { ?>
			<div class="featured_image <?php echo $frame; if($pshape!='rectangle'&&$pshape!='') echo ' shap'; ?> <?php echo $fade.' '.$fade_ani.' '.$roundy; ?>">
				<div class="contain <?php echo $roundy; ?>">
					<a <?php echo $link_to_main;?> class="main_link <?php if($link_to_old=='ajax')echo 'ajaxy';?>">
					<?php if($link_to_old=='ajax')echo '<div class="ajaxy_inner"></div>';?>
						<?php if($pshape!='rectangle'&&$pshape!='') echo '<div class="pshape-'.$pshape.'"></div>'; ?>
						<?php echo $zoomed; ?><img <?php echo $imgsrc; ?> itemprop="image" class="main_featured_image <?php echo $roundy; ?> <?php echo $not_roundy; ?>" alt="featured image"/>
					<?php echo $blur_image; ?>
					<?php if($is_port=='yes'){?><img src="<?php echo $imgsrc_port; ?>" class="port_hide" alt="portfolio image"/><?php }?>
					</a>
						<?php if($cap=='cap'&&$cap_content!='') echo '<div class="caption">'.$cap_content.'</div>'; ?>
						<div class="cap_shad"></div><div class="opa"></div>
					<div class="cl"></div>
				</div>
			</div>
			<?php } //else echo $this->block_title();
		} //featured image end


/* ================================================
 * USER AVATAR
 * ================================================ */
		public function block_avatar(){
			echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link">'
			.get_avatar(get_the_author_meta('ID'),64).'</a>';
		}
		
/* ================================================
 * POST AUTHOR
 * ================================================ */
		public function block_author($pre=''){
		if($pre!='') $pre=$pre.' ';
			echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link" itemprop="author">'.$pre.get_the_author().'</a>';
		}
		

/* ================================================
 * WP CATEGORIES LIST
 * ================================================ */
	public function block_cat_list(){
		echo '<ul class="blog_cat_list">'; wp_list_categories('orderby=name&use_desc_for_title=0&title_li='); echo '</ul>';
	}

	
/* ================================================
 * PORTFOLIO FILTER
* ================================================ */
	public function portfolio_filter_block($cats,$per_page,$align=''){
	?>
	
		<div class="bnone port_sorter <?php echo 'align'.$align; ?>">
			<div class="wrapme">
				<div class="framein round" id="port_par">
					<div>
						<a onclick="show_cat('',this)" class="port_sho"><?php _e('All','cb-modello'); ?>
						</a>
						<?php
						if(!$per_page) $per_page=10; $categories=get_categories('parent='.$cats);
						foreach ($categories as $category) {
							echo '<a class="port_sho" onclick="show_cat('.$category->cat_ID.',this)" data-id="'.$category->cat_ID.'">'.$category->name.'</a> ';
						} ?>
					</div>
				</div>
			</div>
		</div>
		<div class="cl" style="height: 80px;"></div>
		
	<?php
	}
	
	
	
/* ================================================
 * PAGE NAVIGATION
 * ================================================ */
	public function block_navi($style='',$bg=''){
		global $post; 
		global $wp_query;
		if(function_exists('wp_pagenavi')) { 

		if($style=='rounded'&&$bg!='') { echo '<div class="navi_full_wrap"><div class="cl"></div><div class="navi_full"><div class="r_wo_i_d '.$bg.'"></div>';
		echo '<div class="fullbg-'.$bg.' fullb"><div class="wrapme">'; 
		wp_pagenavi(); 
		echo '</div></div>';
		echo '<div class="rb_wo_i '.$bg.'"></div></div></div>';
		}
		
		else if($style=='normal'&&$bg!=''&&$bg!='white') { echo '<div class="navi_full_wrap normal"><div class="cl"></div><div class="navi_full">';
		echo '<div class="fullbg-'.$bg.' fullb"><div class="wrapme">'; 
		wp_pagenavi(); 
		echo '</div></div>';
		echo '</div></div>';
		} else 
		wp_pagenavi(); 
		
		
		}
		
		else if ($wp_query->max_num_pages > 1) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link(__('&larr; Older posts','cb-modello')); ?></div>
					<div class="nav-next"><?php previous_posts_link(__('Newer posts &rarr;','cb-modello')); ?></div>
				</div>
		<?php endif;
	}
	
/* ================================================
 * POST DETAILS
 * ================================================ */
	public function block_details($columns=1){
    echo '<ul class="details">';
    $more='no';$date='yes';$comments='yes';$cats='yes';$tas='no';
    if($columns==3||$columns==4) { $more='no';$date='yes';$comments='yes';$cats='no';$tas='no';}
	if($more=='yes') { ?><li class="more"><i class="icon-file-alt"></i> <a href="<?php echo get_permalink(); ?>" class="more"><?php _e('read more','cb-modello'); ?></a></li><?php } ?>
	<?php if($date=='yes') { ?><li class="date" itemprop="dateCreated"><i class="fa fa-clock-o"></i> <?php the_time('M'); ?> <?php the_time('j'); ?>, <?php the_time('Y'); ?></li><?php } ?>
	<?php if($comments=='yes') { ?><li class="comments"><i class="fa fa-comments-o"></i> <?php comments_number('0', '1', '%'); ?></li><?php } ?>
	<?php 
	$categories = get_the_category(); $separator = ' '; $output = ''; $tags=''; $posttags=get_the_tags(); 
	if ($posttags&&$columns=='1') { foreach($posttags as $tag) { if($tag->name!='') $tags .=$tag->name; } }
	$cat_right='';
	if($tags=='') $cat_right=' style="border-right:0px!important;"';
	if($cats=='yes'){ if($categories) {
	echo '<li class="cat"'.$cat_right.'>'; foreach($categories as $category) {
	$output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'cb-modello' ), $category->name ) ) . '">'.$category->cat_name.'</a>, '.$separator;
	} 
	echo '<i class="fa fa-folder-open"></i> '.substr(trim($output, $separator),0,-1).'</li>';
	}}
	if($tas=='yes'){ $tags=''; $posttags=get_the_tags(); if ($posttags) { foreach($posttags as $tag) { if($tag->name!='') $tags .='<a href="'.get_tag_link($tag->term_id).'" >'.$tag->name . '</a> '; } } $author=get_the_author();
	if($tags!='') { ?><li class="tags"><i class="fa fa-tags"></i> <?php echo $tags; $tags=''; ?></li><?php } } ?>
	</ul><div class="cl"></div>
	<?php 
	}

/* ================================================
 * PORTFOLIO DETAILS
 * ================================================ */
	public function block_port_details($columns=1){
	global $post;
	$po=cb_get_portfolio_options($post->ID);
	echo '<ul class="port_details">';
	if($po['url']!='') echo '<li>URL: <a href="'.$po['url'].'" target="_blank">'.$po['url'].'</a></li>';
	if($po['client']!='') echo '<li>Client: '.$po['client'].'</li>';
	if($po['keywords']!='') echo '<li>Keywords: '.$po['keywords'].'</li>';
	echo '</ul>';
		
	}
		
		
/* ================================================
 * HOVER EFFECTS
 * ================================================ */
	public function block_hover($type='normal'){
		global $post;
		
	}


/* ================================================
 * ABOUT AUTHOR 
 * ================================================ */
	public function about_author_block(){
		global $post;
		
			if(get_the_author_meta('description')!=''){echo '<div class="about_author">
			<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link">'
			.get_avatar(get_the_author_meta('ID'),64).'</a>
			<span class="about_title">'.__('About the author','cb-modello').'</span>
			<div class="bio_info">'.get_the_author_meta('description').'</div>
			</div>';}
	
	}

/* ================================================
 * COMMENTS
 * ================================================ */
	public function comments_block(){
		global $post;
		if ( ! post_password_required() ) { comments_template(); } 
		
	}
	
	
/* ================================================
 * GALLERY
 * ================================================ */
    public function block_gallery($w='960',$h='700',$columns='3',$caps='yes',$g_content='',$g_grid='no',$fade,$fade_ani,$full_w){
        global $post;
        $columns_parent=$columns;

        switch($columns) {
            case '4':
                $w='250'; $h='160';
                break;
            case '3':
                $w='350'; $h='270';
                break;
            case '2':
                $w='480'; $h='350';
                break;
            case '1':
                $w='960'; $h='700';
                break;
        }

        if($g_grid=='yes') $h='';
        if($caps=='yes') $caps='cap';

        $fullscreen=''; $bnw='';$grid='';
        $isfullscreen=''; $isround='round';
        if($fullscreen=='yes') {
            $isfullscreen=' m0';
            $isround='';
        }
        $g_rand=rand();
?>
                        <?php if($full_w=='yes'){
                        
$g_gridy='960';
if(get_option('cb5_grid')=='1170') $g_gridy='1170';
$wid=esc_attr(get_option('cb5_wid'));
$windw='window';
if($wid=='fixed')$windw="'#bg'";?>
				
        <script type="text/javascript">
        jQuery(function(){
        	var windw=jQuery(<?php echo $windw;?>).width();
                        var grid_left=windw-<?php echo $g_gridy?>; grid_left=grid_left/2; grid_left=-Math.abs(grid_left);
                        jQuery('.gall_g_<?php echo $g_rand;?>').css('margin-left',grid_left);
                        jQuery('.gall_g_<?php echo $g_rand;?>').width(windw);
                    });</script>
                        <?php }
    if($bnw=='yes') {$adi_st='grayscale';
        ?>
        <script type="text/javascript">
            jQuery(function(){
                jQuery('.gallery_image').adipoli({
                    'startEffect' : '<?php echo $adi_st;?>',
                    'hoverEffect' : 'normal'
                });
            });</script><?php }
    $gallery_blog='single_gallery_'.rand();
    $count=1;
    $grid_state='';$full_gg='';
    if($full_w=='yes'){ $full_gg='full_gally';
    $w=$w*2;$h=$h*2;}
    if($g_grid=='yes') $grid_state='grid_gallery';
    echo '<div class="gallery_block '.$full_gg.' gall_g_'.$g_rand.' '.$grid_state.'">';
    if($g_content!=''&&is_array($g_content)) {
        foreach($g_content as $g_img) {
            //$g_img['title'];
            if($count%$columns=='0') $mr='mr0'; else $mr='';
            echo '<div class="col'.$columns.' '.$mr.' gallery_element" itemscope itemtype ="http://schema.org/ImageGallery">';

            $gallery_single_image=$g_img['image'];
            $this->block_featured_image($w,$h,'round','pp',$gallery_blog,$caps,$fade,$gallery_single_image,$g_img['image'],$pshape='',$g_img['title'],$fade_ani,'',$style='gallery');

            echo '</div>';
            $count++;
        }
    }
    else {
        $imgs=get_children('order=asc&orderby=menu_order&post_type=attachment&post_mime_type=image&post_parent='.$post->ID );
        foreach ($imgs as $att_id => $att) {
            $gall_img=wp_get_attachment_image_src($att_id,'large');
            echo '<div class="col'.$columns.' '.$mr.' gallery_element'.$isfullscreen.'">';

            $gallery_single_image=$gall_img[0];
            $this->block_featured_image($w,$h,'round','pp',$gallery_blog,$caps,$fade,$gallery_single_image,$gall_img[0],$pshape='','',$fade_ani,'',$style='gallery');

            echo '</div>';
            $count++;
        }
    }
    echo '<div class="cl"></div></div>';

    if($g_grid=='yes') {
		$gutter=0;
		if($columns=='4') $gutter='28';
		if($columns=='3') $gutter='28';
		if($columns=='2') $gutter='38';
		if($columns=='1') $gutter='0';
		if($full_w=='yes') $gutter='0';
		 ?>
        <script type="text/javascript">
            jQuery(function(){
                var widd=jQuery(document).width();
                  jQuery('.gallery_block').imagesLoaded( function() {
                    jQuery('.gallery_block').masonry({
                        itemSelector: '.gallery_element',gutter:<?php echo $gutter; ?>
                    }); 
                    });
            });
        </script>
    <?php }
    }

    /* ================================================
 * GALLERY
 * ================================================ */
    public function block_patallax($tabs,$block_id,$instance){
        global $post;
        if(is_array($tabs)){

            ?>
            <ul id="<?php echo $block_id;?>-scene" class="scene">
                <?php
            foreach ($tabs as $tab) {
                ?>
                <li class="layer" data-depth="<?php echo $tab['depth'];?>" style="opacity: <?php echo $tab['opacity'];?>;"><img src="<?php echo $tab['image'];?>" alt="parallax img"/></li>
                <?php

            }
                ?>

            </ul><?php 
            wp_enqueue_script('parallax',WP_THEME_URL.'/inc/assets/js/jquery.parallax.min.js',array('jquery'),'1.0',true);
            ?>
            <script>

                jQuery(document).ready(function(){
                jQuery('#<?php echo $block_id;?>-scene').parallax({
                    calibrateX: <?php echo $instance['calibrateX'];?>,
                    calibrateY: <?php echo $instance['calibrateY'];?>,
                    invertX: <?php echo $instance['invertX'];?>,
                    invertY: <?php echo $instance['invertY'];?>,
                    limitX: <?php echo $instance['limitX'];?>,
                    limitY: <?php echo $instance['limitY'];?>,
                    scalarX: <?php echo $instance['scalarX'];?>,
                    scalarY: <?php echo $instance['scalarY'];?>,
                    frictionX: <?php echo $instance['frictionX'];?>,
                    frictionY: <?php echo $instance['frictionY'];?>
                });
                <?php if($instance['fullww']=='yes'){
$g_grid='960';
if(get_option('cb5_grid')=='1170') $g_grid='1170';?>

                var windw=jQuery(window).width();
                jQuery('#<?php echo $block_id;?>-scene').width(1920);
                var leftmip=1920-windw; var lim=windw-<?php echo $g_grid;?>;lim=lim/2; leftmip=leftmip/2;
                leftmip=leftmip+lim;
                if(leftmip>0){ leftmip=-Math.abs(leftmip);
                jQuery('#<?php echo $block_id;?>-scene').css('margin-left',leftmip);
                }
                <?php } ?>
                });

            </script>
        <?php
        }
    }
	
} /* class end */
?>