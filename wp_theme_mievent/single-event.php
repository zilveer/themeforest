<?php
/**
 * The Template for displaying all event posts
 *
 * @package MiEvent
 * @subpackage MiEvent
 * @since MiEvent 1.0
 */

$event_id=$event_slider=0;
if ( have_posts() ) {
	while ( have_posts() ) {

		the_post();

		$post_pre='event_';
		$menu=$heading=$category=$out='';
		$outContent=$menuContent='';
		$menuOrder=$scheduleMenuOrder=$downloadMenuOrder=0;
		$schedule_display=$download_display=false;
		$img_gal_active=$video_active='hide';
		$contentArray = array();

		$event_id= get_the_ID();		

		if(!empty($event_id))
		{		
			$event_slider= intval(MthemeCore::getPostMeta($event_id, 'event_slider'));
			if(MthemeCore::getPostMeta($event_id, $post_pre.'about_display')=='true')
			{
				if(MthemeCore::getPostMeta($event_id, $post_pre.'about_menu_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'about_head','about');
					$menuContent='<li><a data-scroll href="#about">'.$heading.'</a></li>';
				}
				
				$outContent='<div id="about">';
				$outContent.=do_shortcode('[event_intro event_id="'.$event_id.'"]');
				$outContent.='</div>';
				$menuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'about_order','1');
				$contentArray[0]= array($menuOrder,$menuContent,$outContent);
			}
			
			if(MthemeCore::getPostMeta($event_id, $post_pre.'features_display')=='true')
			{
				$menuContent=$outContent='';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'features_menu_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'features_head','features');
					$menuContent='<li><a data-scroll href="#features">'.$heading.'</a></li>';
				}
				if(MthemeCore::getPostMeta($event_id, $post_pre.'img_gal_active')=='true')
				{
					$img_gal_active='show';
				}
				if(MthemeCore::getPostMeta($event_id, $post_pre.'video_active')=='true')
				{
					$video_active='show';
				}
				
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'gal_cat');
				
				$outContent='<div id="features">';
				$outContent.=do_shortcode('[event_features event_id="'.$event_id.'" gallery="'.$img_gal_active.'" video="'.$video_active.'" category="'.$category.'"]');
				$outContent.='</div>';
				$menuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'features_order','2');
				$contentArray[1]= array($menuOrder,$menuContent,$outContent);
				
			}
			if(MthemeCore::getPostMeta($event_id, $post_pre.'schedule_display')=='true')
			{
				$scheduleMenuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'schedule_order','3');
				$schedule_display=true;
			}
			if(MthemeCore::getPostMeta($event_id, $post_pre.'download_display')=='true')
			{
				$menuContent=$outContent='';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'download_menu_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'download_head','downloads');
					$menuContent='<li><a data-scroll href="#download">'.$heading.'</a></li>';
				}		
				$downloadMenuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'download_order','4');
				
				if($schedule_display && $downloadMenuOrder == $scheduleMenuOrder+1)
				{
					$outContent='<div id="download">';
					$outContent.=do_shortcode('[event_brochure event_id="'.$event_id.'"]');
					$outContent.='</div>';
				}
				else
				{
					$outContent='<div id="download">';
					$outContent.=do_shortcode('[event_brochure padding="section-padding" event_id="'.$event_id.'"]');
					$outContent.='</div>';
				}
				$contentArray[3]= array($downloadMenuOrder,$menuContent,$outContent);
				$download_display=true;
			}
			if($schedule_display=='true')
			{	
				$menuContent=$outContent='';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'schedule_menu_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'schedule_head','schedules');
					$menuContent='<li><a data-scroll href="#schedule">'.$heading.'</a></li>';
				}
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'schedule_cat',"");
						
				if($download_display && $downloadMenuOrder == $scheduleMenuOrder+1)
				{
					$outContent='<div id="schedule">';
					$outContent.=do_shortcode('[event_schedules category="'.$category.'"]');
					$outContent.='</div>';
				}
				else
				{
					$outContent='<div id="schedule">';
					$outContent.=do_shortcode('[event_schedules padding="section-padding" category="'.$category.'"]');
					$outContent.='</div>';
				}
				
				$contentArray[2]= array($scheduleMenuOrder,$menuContent,$outContent);		
			}
			if(MthemeCore::getPostMeta($event_id, $post_pre.'speaker_display')=='true')
			{
				$menuContent=$outContent='';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'speaker_menu_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'speaker_head','speakers');
					$menuContent='<li><a data-scroll href="#speaker">'.$heading.'</a></li>';
				}
				
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'speaker_cat',"");
						
				$outContent='<div id="speaker">';
				$outContent.=do_shortcode('[event_speakers category="'.$category.'"]');
				$outContent.='</div>';
				$menuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'speaker_order','5');		
				$contentArray[4]= array($menuOrder,$menuContent,$outContent);
			}
			if(MthemeCore::getPostMeta($event_id, $post_pre.'package_display')=='true')
			{
				$menuContent=$outContent='';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'package_menu_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'package_head','pricing');
					$menuContent='<li><a data-scroll href="#package">'.$heading.'</a></li>';
				}
				
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'package_cat',"");
						
				$outContent='<div id="package">';
				$outContent.=do_shortcode('[event_packages category="'.$category.'"]');
				$outContent.='</div>';
				$menuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'package_order','6');
				$contentArray[5]= array($menuOrder,$menuContent,$outContent);
			}
			if(MthemeCore::getPostMeta($event_id, $post_pre.'contact_form_display')=='true')
			{
				$menuContent=$outContent='';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'contact_form_menu_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'contact_form_head','register');
					$menuContent='<li><a data-scroll href="#contact_form">'.$heading.'</a></li>';
				}
				
				$outContent='<div id="contact_form">';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'contact_type')=='natural')
				{
					$outContent.=do_shortcode('[event_registration_form]');
				}else{
					$contact_contact7_post=MthemeCore::getPostMeta($event_id, $post_pre.'contact_contact7_post');
					$post=null;
					if(!empty($contact_contact7_post))$post=get_post($contact_contact7_post);
					if($post){			
						$title=get_the_title($post->ID);		
						$outContent.=do_shortcode('[event_wpcf7_contact_form id="'.$contact_contact7_post.'" title="'.$title.'"]');
					}else $outContent.=do_shortcode('[event_registration_form]');
				}
				$outContent.='</div>';
				$menuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'contact_form_order','7');
				$contentArray[6]= array($menuOrder,$menuContent,$outContent);
			}
			if(MthemeCore::getPostMeta($event_id, $post_pre.'sponsor_display')=='true')
			{
				$menuContent=$outContent='';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'sponsor_menu_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'sponsor_head','sponsors');
					$menuContent='<li><a data-scroll href="#sponsor">'.$heading.'</a></li>';
				}
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'sponsor_cat',"");
						
				$outContent='<div id="sponsor">';
				$outContent.=do_shortcode('[event_sponsors category="'.$category.'"]');
				$outContent.='</div>';
				$menuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'sponsor_order','8');
				$contentArray[7]= array($menuOrder,$menuContent,$outContent);
			}
			if(MthemeCore::getPostMeta($event_id, $post_pre.'notify_display')=='true')
			{
				$menuContent=$outContent='';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'notify_menu_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'notify_head','subscribe');
					$menuContent='<li><a data-scroll href="#notify">'.$heading.'</a></li>';
				}
				
				$outContent='<div id="notify">';
				$outContent.=do_shortcode('[event_notify_form]');
				$outContent.='</div>';
				$menuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'notify_order','9');
				$contentArray[8]= array($menuOrder,$menuContent,$outContent);
			}
			if(MthemeCore::getPostMeta($event_id, $post_pre.'contact_display')=='true')
			{
				$menuContent=$outContent='';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'contact_menu_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'contact_head','contact');
					$menuContent='<li><a data-scroll href="#contact">'.$heading.'</a></li>';
				}
				
				$outContent='<div id="contact">';
				$outContent.=do_shortcode('[footer_contact]');
				$outContent.='</div>';
				$menuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'contact_order','15');
				$contentArray[9]= array($menuOrder,$menuContent,$outContent);
			}			
			if(MthemeCore::getPostMeta($event_id, $post_pre.'blog_display')=='true')
			{
				$menuContent=$outContent='';
				/*$temp_link=MthemeCore::getPostMeta($event_id,$post_pre.'blog_link',SITE_URL);*/
				$heading=MthemeCore::getPostMeta($event_id,$post_pre.'blog_head','blog');
				$menuContent='<li><a data-scroll href="#blog">'.$heading.'</a></li>';				
				$menuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'blog_order','10');
				
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'blog_cat',"");
				$title=MthemeCore::getPostMeta($event_id, $post_pre.'blog_section_head',"");
				$description=MthemeCore::getPostMeta($event_id, $post_pre.'blog_section_description',"");
				$bg=MthemeCore::getPostMeta($event_id, $post_pre.'blog_section_bg',"");
				
				$outContent='<div id="blog">';
				$outContent.=do_shortcode('[mtheme_blog category="'.$category.'" title="'.$title.'" description="'.$description.'" background="'.$bg.'"]');
				$outContent.='</div>';
				$contentArray[10]= array($menuOrder,$menuContent,$outContent);
			}
			if(MthemeCore::getPostMeta($event_id, $post_pre.'ext_link_1_display','false')=='true')
			{
				$menuContent=$outContent='';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'ext_link_1_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'ext_link_1_head','link 1');
					$menuContent='<li><a data-scroll href="#ext_link_1">'.$heading.'</a></li>';
				}		
				$menuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'ext_link_1_order','11');
				$extLinkEntity=MthemeCore::getPostMeta($event_id,$post_pre.'more_1_entity');
				
				$outContent='<div id="ext_link_1">';
				switch($extLinkEntity){
				case "1": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_1_schedule_cat',"");
				$outContent.=do_shortcode('[event_schedules padding="section-padding" category="'.$category.'"]');break;
				case "2": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_1_speaker_cat',"");
				$outContent.=do_shortcode('[event_speakers category="'.$category.'"]');break;
				case "3": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_1_package_cat',"");
				$outContent.=do_shortcode('[event_packages category="'.$category.'"]');break;
				case "4": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_1_sponsor_cat',"");
				$outContent.=do_shortcode('[event_sponsors category="'.$category.'"]');break;
				}
				$outContent.='</div>';
				
				
				$contentArray[11]= array($menuOrder,$menuContent,$outContent);
			}
			if(MthemeCore::getPostMeta($event_id, $post_pre.'ext_link_2_display','false')=='true')
			{
				$menuContent=$outContent='';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'ext_link_2_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'ext_link_2_head','link 2');
					$menuContent='<li><a data-scroll href="#ext_link_2">'.$heading.'</a></li>';
				}		
				$menuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'ext_link_2_order','12');
				$extLinkEntity=MthemeCore::getPostMeta($event_id,$post_pre.'more_2_entity');
				
				$outContent='<div id="ext_link_2">';
				switch($extLinkEntity){
				case "1": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_2_schedule_cat',"");
				$outContent.=do_shortcode('[event_schedules padding="section-padding" category="'.$category.'"]');break;
				case "2": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_2_speaker_cat',"");
				$outContent.=do_shortcode('[event_speakers category="'.$category.'"]');break;
				case "3": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_2_package_cat',"");
				$outContent.=do_shortcode('[event_packages category="'.$category.'"]');break;
				case "4": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_2_sponsor_cat',"");
				$outContent.=do_shortcode('[event_sponsors category="'.$category.'"]');break;
				}
				$outContent.='</div>';
				
				$contentArray[12]= array($menuOrder,$menuContent,$outContent);
			}
			if(MthemeCore::getPostMeta($event_id, $post_pre.'ext_link_3_display','false')=='true')
			{
				$menuContent=$outContent='';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'ext_link_3_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'ext_link_3_head','link 3');
					$menuContent='<li><a data-scroll href="#ext_link_3">'.$heading.'</a></li>';
				}		
				$menuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'ext_link_3_order','13');
				$extLinkEntity=MthemeCore::getPostMeta($event_id,$post_pre.'more_3_entity');
				
				$outContent='<div id="ext_link_3">';
				switch($extLinkEntity){
				case "1": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_3_schedule_cat',"");
				$outContent.=do_shortcode('[event_schedules padding="section-padding" category="'.$category.'"]');break;
				case "2": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_3_speaker_cat',"");
				$outContent.=do_shortcode('[event_speakers category="'.$category.'"]');break;
				case "3": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_3_package_cat',"");
				$outContent.=do_shortcode('[event_packages category="'.$category.'"]');break;
				case "4": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_3_sponsor_cat',"");
				$outContent.=do_shortcode('[event_sponsors category="'.$category.'"]');break;
				}
				$outContent.='</div>';
				
				$contentArray[13]= array($menuOrder,$menuContent,$outContent);
			}
			if(MthemeCore::getPostMeta($event_id, $post_pre.'ext_link_4_display','false')=='true')
			{
				$menuContent=$outContent='';
				if(MthemeCore::getPostMeta($event_id, $post_pre.'ext_link_4_active')=='true')
				{
					$heading=MthemeCore::getPostMeta($event_id,$post_pre.'ext_link_4_head','link 4');
					$menuContent='<li><a data-scroll href="#ext_link_4">'.$heading.'</a></li>';
				}		
				$menuOrder=MthemeCore::getPostMeta($event_id,$post_pre.'ext_link_4_order','14');
				$extLinkEntity=MthemeCore::getPostMeta($event_id,$post_pre.'more_4_entity');
				
				$outContent='<div id="ext_link_4">';
				switch($extLinkEntity){
				case "1": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_4_schedule_cat',"");
				$outContent.=do_shortcode('[event_schedules padding="section-padding" category="'.$category.'"]');break;
				case "2": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_4_speaker_cat',"");
				$outContent.=do_shortcode('[event_speakers category="'.$category.'"]');break;
				case "3": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_4_package_cat',"");
				$outContent.=do_shortcode('[event_packages category="'.$category.'"]');break;
				case "4": 
				$category=MthemeCore::getPostMeta($event_id, $post_pre.'more_4_sponsor_cat',"");
				$outContent.=do_shortcode('[event_sponsors category="'.$category.'"]');break;
				}
				$outContent.='</div>';
				
				$contentArray[14]= array($menuOrder,$menuContent,$outContent);
			}
		}

		$menuContainer1=$menuContainer2=$menuContainer3=$menuContainer4=$menuContainer5=$menuContainer6=$menuContainer7=$menuContainer8=$menuContainer9=$menuContainer10=$menuContainer11=$menuContainer12=$menuContainer13=$menuContainer14=$menuContainer15='';
		$outContainer1=$outContainer2=$outContainer3=$outContainer4=$outContainer5=$outContainer6=$outContainer7=$outContainer8=$outContainer9=$outContainer10=$outContainer11=$outContainer12=$outContainer13=$outContainer14=$outContainer15='';

		foreach($contentArray as $item) {
			
			switch($item[0]) {
				
				case '1':
					$menuContainer1.=$item[1];
					$outContainer1.=$item[2];
				break;
				case '2':
					$menuContainer2.=$item[1];
					$outContainer2.=$item[2];
				break;
				case '3':
					$menuContainer3.=$item[1];
					$outContainer3.=$item[2];
				break;
				case '4':
					$menuContainer4.=$item[1];
					$outContainer4.=$item[2];
				break;					
				case '5':
					$menuContainer5.=$item[1];
					$outContainer5.=$item[2];
				break;
				case '6':
					$menuContainer6.=$item[1];
					$outContainer6.=$item[2];
				break;					
				case '7':
					$menuContainer7.=$item[1];
					$outContainer7.=$item[2];
				break;
				case '8':
					$menuContainer8.=$item[1];
					$outContainer8.=$item[2];
				break;
				case '9':
					$menuContainer9.=$item[1];
					$outContainer9.=$item[2];
				break;
				case '10':
					$menuContainer10.=$item[1];
					$outContainer10.=$item[2];
				break;
				case '11':
					$menuContainer11.=$item[1];
					$outContainer11.=$item[2];
				break;
				case '12':
					$menuContainer12.=$item[1];
					$outContainer12.=$item[2];
				break;
				case '13':
					$menuContainer13.=$item[1];
					$outContainer13.=$item[2];
				break;
				case '14':
					$menuContainer14.=$item[1];
					$outContainer14.=$item[2];
				break;
				case '15':
					$menuContainer15.=$item[1];
					$outContainer15.=$item[2];
				break;
			}
		}
		$menu=$menuContainer1.$menuContainer2.$menuContainer3.$menuContainer4.$menuContainer5.$menuContainer6.$menuContainer7.$menuContainer8.$menuContainer9.$menuContainer10.$menuContainer11.$menuContainer12.$menuContainer13.$menuContainer14.$menuContainer15;

		$out=$outContainer1.$outContainer2.$outContainer3.$outContainer4.$outContainer5.$outContainer6.$outContainer7.$outContainer8.$outContainer9.$outContainer10.$outContainer11.$outContainer12.$outContainer13.$outContainer14.$outContainer15;
		
		$events['external_link']=mtheme_filter(MthemeCore::getPostMeta($event_id, $post_pre.'external_link'));
		foreach($events['external_link'] as $ID => $event) {
			if(isset($event['el_link_title']) && !empty($event['el_link_title']))
			{	
				if(isset($event['el_link_url']) && empty($event['el_link_url']))
					$event['el_link_url']="#";
				$menu.='<li><a href="'.$event['el_link_url'].'">'.$event['el_link_title'].'</a></li>';
			}
		}

		if(!empty($event_slider) && $menu!=''){
			$menu.='<li class="hidden"><a href="#home_slider">Home</a></li>';
		}
	}
}
?>
<?php
get_header();
$logo_position=MthemeCore::getPostMeta($event_id, $post_pre."logo_position",'header');
if(!empty($event_id))
{
	if($menu!=''){
?>
	<!--HEADER-->
	<div class="header header-hide">
		<div class="container">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" 
						data-target="#example-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?php if($logo_position=='header' || $logo_position=='both'){ ?>
					<a class="navbar-brand" href="<?php echo SITE_URL; ?>"><img src="<?php echo MthemeCore::getOption("site_logo",""); ?>" alt="<?php echo MthemeCore::getOption('logo_text','logo');?>"/></a>
					<?php } ?>
			   </div>
			   <div class="collapse navbar-collapse" id="example-navbar-collapse">
				  <ul class="nav navbar-nav">
					<?php echo mtheme_html($menu); ?>
				  </ul>
			   </div>
			</nav>
		</div>
	</div>
<!--/HEADER-->
<?php }elseif($logo_position=='header' || $logo_position=='both'){ ?>
	<!--HEADER-->
	<div class="header header-hide">
		<div class="container">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">				
					<a class="navbar-brand" href="<?php echo SITE_URL; ?>"><img src="<?php echo MthemeCore::getOption("site_logo",""); ?>" alt="<?php echo MthemeCore::getOption('logo_text','logo');?>"/></a>				
			   </div>
			</nav>
		</div>
	</div>
<!--/HEADER-->
<?php }
	if(!empty($event_slider))
	{	
		echo '<div id="home_slider">';
		echo do_shortcode('[hero_background logo_position="'.$logo_position.'" slider_id="'.$event_slider.'"]');
		echo '</div>';
	}
	
	echo mtheme_html($out);
}

get_footer();