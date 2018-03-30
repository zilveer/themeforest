<!DOCTYPE html>
<?php
//preview settings
$demomode = false;
$prevID = 0;
if((current_user_can('administrator') && !empty($_GET['preview'])) || ($demomode && !empty($_GET['preview'])))
{	
	$isPrev = (int)$_GET['preview'];
	$select_query = "SELECT s.*
						FROM {$wpdb->prefix}settings s
						WHERE s.ID='".$isPrev."'";
	$query = $wpdb->get_results($select_query);
	if(sizeof($query)==1)
		$prevID = $isPrev;
}

$tmpurl = get_template_directory_uri();

if(opt('contentFont','')!='')
	wp_enqueue_style('contentFont', opt('contentFontFull',''), false, null, 'all');
if(opt('headerFont','')!='')
	wp_enqueue_style('headerFont', opt('headerFontFull',''), false, null, 'all');

if(opt('theme_style', 'light')=='light')
	wp_enqueue_style('ThemeStyle', $tmpurl."/style_light.php?preview=$prevID", false, null, 'all');
else
	wp_enqueue_style('ThemeStyle', $tmpurl."/style_dark.php?preview=$prevID", false, null, 'all');
	
?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php if(isset($_GET['_escaped_fragment_']) && !empty($_GET['_escaped_fragment_'])){
			echo file_get_contents(site_url().'/'.$_GET['_escaped_fragment_'].addionalCharacter($_GET['_escaped_fragment_']).'info=title');
		}else{
			wp_title( '|', true, 'right' );
		} ?>
</title>
<meta name="fragment" content="!">
<meta name="description" content="<?php if(isset($_GET['_escaped_fragment_']) && !empty($_GET['_escaped_fragment_'])){
	echo file_get_contents(site_url().'/'.$_GET['_escaped_fragment_'].addionalCharacter($_GET['_escaped_fragment_']).'info=description');
	}else{ ?><?php bloginfo('description'); ?>
<?php } ?>" />
<?php wp_head(); ?>
<?php
$favicon = trim(opt('favicon',''));
if(!empty($favicon)){
if(strpos($favicon,'http')===false)
	$favicon = $tmpurl.'/'.$favicon;
?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $favicon; ?>">
<?php } ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php 
$analyticsCode = opt('analyticsCode','');

if(!empty($analyticsCode))
{
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo trim($analyticsCode); ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php } ?>
<script type='text/javascript'>
var bgTime = <?php eopt('bgAniTime','5000');?>; // bg Image/Video animation display duration
var bgPaused = <?php eopt('bgPaused','true');?>; // bg Image/Video animation paused
var menuTime = <?php eopt('menuDelay','5000');?>; // menu delay
var autoPlay = <?php eopt('autoPlay','true');?>; // Background audio autoplay
var loop = <?php eopt('loop','true');?>; // Background audio loop or next song
var twtTime = 3000; // Twitter display duration
var prettyTheme = '<?php eopt('theme_style','light'); ?>_square'; //Pretty Photo Plug-in Teheme
var normalFade = <?php eopt('bgNormalFade','true');?>; // Normal fade animation
var frontPage = '<?php eopt('frontPageURL','');?>'; // Front Page URL
var btnSoundURL = '<?php eopt('btnSoundURL','');?>'; // Button Hover Sound
var menuPositionFixed = <?php eopt('menuPositionFixed','false');?>;
var defaultTitle = '<?php wp_title( '|', true, 'right' ); ?>';
var defaultURL = '<?php echo home_url(); ?>';
//v1.2
var videoPaused = <?php eopt('videoPaused','false');?>;
var menuAlwaysOpen = <?php eopt('menuAlwaysOpen','false');?>;
var bgStretch = <?php eopt('bgStretch','true');?>;

<?php if(isset($_GET['_escaped_fragment_']) && !empty($_GET['_escaped_fragment_'])){ ?>
	$(window).load(function(){
		pageLoaded();
	});
<?php }?>
</script>

</head>
<body <?php body_class(); ?>>
<div id="body-wrapper">
	<!-- BEGIN: Main Elements -->
	<div id="bgImage"><div id="bgImageWrapper"></div></div>
	<div id="bgPattern"></div>
	<div id="videoExpander"></div>
	<div id="bgText"><h3></h3><div class="subText"></div></div>
	<div id="content">
		<?php
		if(isset($_GET['_escaped_fragment_']) && !empty($_GET['_escaped_fragment_'])){
			echo '<div id="contentBox" style="display: block; opacity: 1; margin-top: 20px;">';
			echo file_get_contents(site_url().'/'.$_GET['_escaped_fragment_'].addionalCharacter($_GET['_escaped_fragment_']).'info=page');
			echo '</div>';
		}else{
		?>
		<div id="contentBox"></div>
		<div id="contentLoading">
			<div id="CtLoading">
				<?php echo __('Loading', 'ThisWay'); ?><br/>
				<img src="<?php echo get_template_directory_uri(); ?>/images/loading1.gif" width="80" height="10" alt="" />
			</div>
		</div>
		<?php }?>
	</div>
	<!-- END: Main Elements -->
	<!-- BEGIN: Vertical Side Bar -->
	<ul id="bgImages">
		<?php
			$result = $wpdb->get_results("SELECT IMAGEID, TYPE, CONTENT, THUMB, CAPTION, DESCRIPTION, WIDTH, HEIGHT FROM {$wpdb->prefix}backgrounds ORDER BY SLIDERORDER");
			foreach($result as $row)
			{
				echo "<li>\n";
				$thumb = $row->THUMB;
				if(function_exists('wpthumb'))
					$thumb = wpthumb($row->THUMB,'width=120&height=80&resize=true&crop=1&crop_from_position=center,center');
				echo '<img class="thumb" src="'.$thumb.'" alt="'.$row->CAPTION.'" />'."\n";
								
				if($row->TYPE=='image')
					echo '<img class="source" src="'.$row->CONTENT.'" alt="'.htmlentities(stripslashes($row->CAPTION),ENT_QUOTES, "UTF-8").'" />';
				elseif($row->TYPE=='vimeo')
					echo '<iframe src="http://player.vimeo.com/video/'.$row->CONTENT.'?api=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;color=7d7d7d" width="'.$row->WIDTH.'" height="'.$row->HEIGHT.'" videotype="vimeo" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
				elseif($row->TYPE=='youtube'){
					echo '<iframe width="'.$row->WIDTH.'" height="'.$row->HEIGHT.'" src="http://www.youtube.com/embed/'.$row->CONTENT.'?wmode=transparent&rel=0" frameborder="0" videotype="youtube" videoid="'.$row->CONTENT.'" allowfullscreen></iframe>';
				}elseif($row->TYPE=='iframe')
					echo stripslashes($row->CONTENT);
				
				if(!empty($row->CAPTION))
					echo '<h3>'.stripslashes($row->CAPTION).'</h3>'."\n";
					
				if(!empty($row->DESCRIPTION))
					echo '<p>'.stripslashes($row->DESCRIPTION).'</p>'."\n";
				
				echo "</li>\n";
			}
		?>
	</ul>
	
	<!-- BEGIN: Main Menu -->
	<div id="menu-container">
		<!-- BEGIN: Logo -->
		<div id="logo">
			<?php 
			$logoURL = opt('logo_url','');
			if(strpos($logoURL,'http')===false)
				$logoURL = $tmpurl.'/'.$logoURL;
			?>
			<img src="<?php echo $logoURL; ?>" title="<?php bloginfo('name'); ?>" border="0"/>
		</div>
		<!-- END: Logo -->
		
		<div id="mainmenu">
			<?php 
			if ( has_nav_menu( 'primary' ) )
				wp_nav_menu( array('container_class' => 'menu-header', 'theme_location' => 'primary', 'walker' => new My_Walker(), 'show_home' => true ) ); 
			?>
		</div>
		
		
		<div id="menuOpener"><?php eopt('menuOpenText','MENU') ?></div>
		<div id="menuCloser"><?php eopt('menuCloseText','CLOSE') ?></div>
		
	</div>
	<!-- END: Main Menu -->
	
	<!-- BEGIN: Twitter -->
	<div id="twt">
		<a class="twButton" href="javascript:void(0);"></a>
		<div class="twContent">
			<h3>TWITTER</h3>
			<ul>
			<?php
				$twtRefresh = 30;
				$twt_name = opt('twt_name','');
				$twt_number = opt('twt_number','5');
				if(get_option('twTime')=='')
				{
					$content = getTweets($twt_name, $twt_number);
					update_option('twContent', $content);
					update_option('twTime', time());
				}else{
					$time = get_option('twTime');
					if(($time+(60*$twtRefresh))>time())
					{
						$content = get_option('twContent');
					}
					else
					{
						$content = getTweets($twt_name, $twt_number);
						update_option('twContent', $content);
						update_option('twTime', time());
					}
				}
				echo $content;
			?>
			</ul>
		</div>
	</div>
	<!-- END: Twitter -->
	
	<!-- BEGIN: Audio Controller; Please don't remove this element	-->
	<div id="audioControls">
		<a class="btn prev" href="javascript:void(0);"></a>
		<a class="btn play" href="javascript:void(0);"></a>
		<a class="btn pause" href="javascript:void(0);"></a>
		<a class="btn next" href="javascript:void(0);"></a>
	</div>
	<!-- END: Audio Controller -->
	
	<!-- BEGIN: Footer -->
	<div id="footer">
		
		<div id="footertext"><?php echo stripslashes(opt('copyrighttext','')); ?></div>
		
		<!-- BEGIN: Background Controller Buttons -->
		<div id="bgControl">
			<a class="prev" href="javascript:void(0);" onclick="prevBg()"></a>
			<a class="play" href="javascript:void(0);" onclick="playBg()"></a>
			<a class="pause" href="javascript:void(0);" onclick="pauseBg()"></a>
			<a class="next" href="javascript:void(0);" onclick="nextBg()"></a>
		</div>
		<!-- END: Background Controller Buttons -->
		
		<!-- BEGIN: Share Buttons -->
		<?php if(isset($_GET['_escaped_fragment_']) && !empty($_GET['_escaped_fragment_'])){
			$url = home_url().'/#!'.$_GET['_escaped_fragment_'];
		}else{
			$url = home_url();
		} ?>
		<div id="share">
			<ul>
				<li><a class="tip fb" target="_blank" rel="http://www.facebook.com/sharer.php?u=%%url%%" href="http://www.facebook.com/sharer.php?u=<?php echo $url;?>" tip-text="Facebook"></a></li>
				<li><a class="tip tw" target="_blank" rel="http://twitter.com/home?status=Check out this Awesome Site - %%url%%" href="http://twitter.com/home?status=Check out this Awesome Site - <?php echo $url;?>" tip-text="Twitter"></a></li>
				<li><a class="tip in" target="_blank" rel="http://www.linkedin.com/shareArticle?mini=true&url=%%url%%&title=&summary=&source=" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url;?>&title=&summary=&source=" tip-text="LinkedIn"></a></li>
				<li><a class="tip deli" target="_blank" rel="http://del.icio.us/post?url=%%url%%" href="http://del.icio.us/post?url=<?php echo $url;?>" tip-text="delicious"></a></li>
				<li><a class="tip st" target="_blank" rel="http://www.stumbleupon.com/submit?url=%%url%%" href="http://www.stumbleupon.com/submit?url=<?php echo $url;?>" tip-text="StumbleUpon"></a></li>
				<li><a class="tip rss" target="_blank" href="<?php echo $url;?>?feed=rss" tip-text="RSS"></a></li>
			</ul>		
		</div>
		<!-- END: Share Buttons -->
	</div>
	<!-- END: Footer -->
	
	<!-- BEGIN: Audio List 	-->
	<ul id="audioList">
		<?php 
		$audioList = get_option("audioList");
		if(!empty($audioList))
		{
			$audioList = explode(';',$audioList);
			foreach($audioList as $audioItem)
			{
				echo "<li>$audioItem</li>\n";
			}
		}
		?>
	</ul>
	<!-- END: Audio List -->
</div>

<!-- BEGIN: First Loading -->
<div id="bodyLoading">
	<div id="loading">
		<?php echo __('Loading', 'ThisWay'); ?><br/>
		<img src="<?php echo get_template_directory_uri(); ?>/images/loading1.gif" width="80" height="10" alt="" />
	</div>
</div>
<!-- END: First Loading -->
</div>
<?php wp_footer();?>
</body>
</html>
