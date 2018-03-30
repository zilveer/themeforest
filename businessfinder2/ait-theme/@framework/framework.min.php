<?php

global$_aitPathsCache;$_aitPathsCache=array('parentUrl'=>get_template_directory_uri(),'parentDir'=>get_template_directory(),'childUrl'=>get_stylesheet_directory_uri(),'childDir'=>get_stylesheet_directory(),'design'=>array('css'=>1,'js'=>1,'img'=>1,'fonts'=>1),'uploads'=>wp_upload_dir());function
aitPaths(){static$_aitPaths;if(is_null($_aitPaths)){global$_aitPathsCache;$_aitPaths=new
stdClass;$_aitPaths->url=(object)array('root'=>home_url(),'theme'=>_aitSetPath("","url"),'ait'=>_aitSetPath("/ait-theme","url"),'css'=>_aitSetPath("/design/css","url"),'js'=>_aitSetPath("/design/js","url"),'img'=>_aitSetPath("/design/img","url"),'fonts'=>_aitSetPath("/design/fonts","url"),'cache'=>_aitSetCachePath('url'),'uploads'=>$_aitPathsCache['uploads']['baseurl'],'assets'=>_aitSetPath("/ait-theme/assets","url",true),'fw'=>_aitSetPath("/ait-theme/@framework","url",true),'admin'=>_aitSetPath("/ait-theme/@framework/admin","url",true),'vendor'=>_aitSetPath("/ait-theme/@framework/vendor","url",true),'libs'=>_aitSetPath("/ait-theme/@framework/libs","url",true));$_aitPaths->dir=(object)array('root'=>realpath(ABSPATH),'theme'=>_aitSetPath(""),'ait'=>_aitSetPath("/ait-theme"),'cptsMetaboxesConfig'=>_aitSetPath("/ait-theme/config/cpts-metaboxes"),'css'=>_aitSetPath("/design/css"),'js'=>_aitSetPath("/design/js"),'fonts'=>_aitSetPath("/design/fonts"),'cache'=>_aitSetCachePath('dir'),'uploads'=>$_aitPathsCache['uploads']['basedir'],'langs'=>_aitSetPath("/ait-theme/languages"),'assets'=>_aitSetPath("/ait-theme/assets","dir",true),'fw'=>_aitSetPath("/ait-theme/@framework","dir",true),'fwConfig'=>_aitSetPath("/ait-theme/@framework/config","dir",true),'admin'=>_aitSetPath("/ait-theme/@framework/admin","dir",true),'vendor'=>_aitSetPath("/ait-theme/@framework/vendor","dir",true),'libs'=>_aitSetPath("/ait-theme/@framework/libs","dir",true));return$_aitPaths;}else{return$_aitPaths;}}function
aitPath($dir,$path=''){global$_aitPathsCache;$baseDir='/ait-theme/';if(isset($_aitPathsCache['design'][$dir])){$baseDir='/design/';}if($dir=='theme'){$baseDir='';$dir='';}$suffix=$baseDir.$dir.$path;if(isset($_aitPathsCache["childDir$suffix"])){return$_aitPathsCache["childDir$suffix"];}elseif(isset($_aitPathsCache["parentDir$suffix"])){return$_aitPathsCache["parentDir$suffix"];}if(file_exists($_aitPathsCache['childDir'].$suffix)){$_aitPathsCache["childDir$suffix"]=$_aitPathsCache['childDir'].$suffix;return$_aitPathsCache["childDir$suffix"];}elseif(file_exists($_aitPathsCache['parentDir'].$suffix)){$_aitPathsCache["parentDir$suffix"]=$_aitPathsCache['parentDir'].$suffix;return$_aitPathsCache["parentDir$suffix"];}return
false;}function
aitUrl($dir,$path=''){global$_aitPathsCache;$baseDir='/ait-theme/';if(isset($_aitPathsCache['design'][$dir]))$baseDir='/design/';if($dir=='theme'){$baseDir='';$dir='';}$suffix=$baseDir.$dir.$path;if(isset($_aitPathsCache["childUrl$suffix"]))return$_aitPathsCache["childUrl$suffix"];elseif(isset($_aitPathsCache["parentUrl$suffix"]))return$_aitPathsCache["parentUrl$suffix"];if(file_exists($_aitPathsCache['childDir'].$suffix)){$_aitPathsCache["childUrl$suffix"]=$_aitPathsCache['childUrl'].$suffix;return$_aitPathsCache["childUrl$suffix"];}elseif(file_exists($_aitPathsCache['parentDir'].$suffix)){$_aitPathsCache["parentUrl$suffix"]=$_aitPathsCache['parentUrl'].$suffix;return$_aitPathsCache["parentUrl$suffix"];}return
false;}function
aitGetPaths($dir,$path='',$type=null,$returnChildAndParentPaths=false){global$_aitPathsCache;$return=array();$baseDir='ait-theme/';if(isset($_aitPathsCache['design'][$dir])){$baseDir='design/';}$suffix="/".$baseDir.$dir.$path;if(file_exists($_aitPathsCache['childDir'].$suffix)or$returnChildAndParentPaths){$return['path'][]=$_aitPathsCache['childDir'].$suffix;$return['url'][]=$_aitPathsCache['childUrl'].$suffix;}if(file_exists($_aitPathsCache['parentDir'].$suffix)or$returnChildAndParentPaths){$return['path'][]=$_aitPathsCache['parentDir'].$suffix;$return['url'][]=$_aitPathsCache['parentUrl'].$suffix;}if(isset($return[$type])){return
array_unique($return[$type]);}return
array_unique($return);}function
_aitSetPath($path,$type="dir",$templateDir=false){global$_aitPathsCache;if(file_exists($_aitPathsCache['childDir'].$path)and!$templateDir)return($type=='dir')?$_aitPathsCache['childDir'].$path:$_aitPathsCache['childUrl'].$path;else
return($type=='dir')?$_aitPathsCache['parentDir'].$path:$_aitPathsCache['parentUrl'].$path;}function
_aitSetCachePath($type){global$_aitPathsCache;$s='/cache/'.AIT_CURRENT_THEME;$dir=$_aitPathsCache['uploads']['basedir'].$s;$url=set_url_scheme($_aitPathsCache['uploads']['baseurl'].$s);if(!file_exists($dir)){wp_mkdir_p($dir);@copy(get_template_directory().'/.htaccess',"$dir/.htaccess");}return$type=='dir'?$dir:$url;}function
aitGetResizedImgTag($url,$args){$src=aitResizeImage($url,$args);$newArgs=wp_parse_args($args);$width=$height=$class=$alt='';if(isset($newArgs['width']))$width='width="'.$newArgs['width'].'"';if(isset($newArgs['height']))$height='height="'.$newArgs['height'].'"';if(isset($newArgs['class']))$class='class="'.$newArgs['class'].'"';if(isset($newArgs['alt']))$alt=$newArgs['alt'];$img='<img src="%s" %s %s %s alt="%s">';return
sprintf($img,$src,$class,$width,$height,$alt);}function
aitResizeImage($url,$args){if(!class_exists('WP_Thumb',false))require_once
aitPaths()->dir->libs."/wpthumb/ait-wpthumb.php";return
wpthumb($url,$args);}function
aitDataAttr($name,$params,$prefix='ait-'){$data=is_scalar($params)?$params:json_encode($params);return" data-{$prefix}{$name}='{$data}'";}function
aitIsStaticHomepage(){static$__aitIsStaticHomepage;if(is_null($__aitIsStaticHomepage)){$__aitIsStaticHomepage=(get_option('show_on_front')=='page'and
get_option('page_on_front')and
is_page(get_option('page_on_front')));return$__aitIsStaticHomepage;}else{return$__aitIsStaticHomepage;}}function
aitManager($manager){return
AitTheme::getManager($manager);}function
aitConfig(){return
AitTheme::getConfig();}function
aitOptions(){return
AitTheme::getOptions();}function
aitIsPluginActive($plugin){switch($plugin){case'shortcodes':return(defined('AIT_SHORTCODES_ENABLED')and
AIT_SHORTCODES_ENABLED);case'toolkit':return(defined('AIT_TOOLKIT_ENABLED')and
AIT_TOOLKIT_ENABLED);case'languages':return(defined('AIT_LANGUAGES_ENABLED')and
AIT_LANGUAGES_ENABLED);case'revslider':return(defined('REVSLIDER_TEXTDOMAIN')or
class_exists('RevSliderGlobals'));case'woocommerce':return
defined('WOOCOMMERCE_VERSION');case'jetpack':return
defined('JETPACK__VERSION');default:return
false;}}function
aitGetOption($path,$oid=''){static$__aitOption;if(is_null($__aitOption)or!isset($__aitOption[$path.$oid])){$r=AitUtils::arrayDotGet(AitTheme::getOptions()->getOptions($oid),$path);$__aitOption[$path.$oid]=is_scalar($r)?$r:json_decode(json_encode($r));return$__aitOption[$path.$oid];}else{return$__aitOption[$path.$oid];}}function
aitDropdownPosts($args=''){$defaults=array('selected'=>0,'echo'=>true,'name'=>'post_id','id'=>'','class'=>'','show_option_none'=>'','show_option_no_change'=>'','option_none_value'=>'','oid_prefix'=>'');$r=wp_parse_args($args,$defaults);$postsArgs=array_diff_key($r,$defaults);$posts=get_posts($postsArgs);$r=(object)$r;$output='';$optionTag="\t<option value='%s' %s>%s</option>";if(!empty($posts)){$output=sprintf("<select name='%s' id='%s' class='%s'>\n",esc_attr($r->name),esc_attr($r->id),esc_attr($r->class));if($r->show_option_no_change)$output.=sprintf($optionTag,-1,selected($r->selected,-1,false),$r->show_option_no_change);if($r->show_option_none)$output.=sprintf($optionTag,esc_attr($r->option_none_value),selected($r->selected,$r->option_none_value,false),$r->show_option_none);foreach($posts
as$post){$output.=sprintf($optionTag,$r->oid_prefix.$post->ID,selected($r->selected,$r->oid_prefix.$post->ID,false),esc_html($post->post_title));}$output.="</select>\n";}$output=apply_filters('ait-dropdown-posts',$output);if($r->echo)echo$output;return$output;}function
aitEnableDisableDevMode(){if(!defined('AIT_SERVER')){if(!defined('AIT_DEV')){define('AIT_DEV',false);}if(!defined('AIT_DISABLE_CACHE')){define('AIT_DISABLE_CACHE',false);}return;}$defaults=array('administrator'=>array('devMode'=>false,'devIp'=>''));$devOpts=get_option('_ait_'.AIT_CURRENT_THEME.'_theme_opts',$defaults);if(empty($devOpts))$devOpts=$defaults;$ip=(!empty($devOpts['administrator']['devIp'])and$devOpts['administrator']['devIp']==$_SERVER['REMOTE_ADDR']);if($devOpts['administrator']['devMode']or$ip){if(!defined('AIT_DEV')){define('AIT_DEV',true);}if(!defined('AIT_DISABLE_CACHE')){define('AIT_DISABLE_CACHE',true);}}else{if(!defined('AIT_DEV')){define('AIT_DEV',false);}if(!defined('AIT_DISABLE_CACHE')){define('AIT_DISABLE_CACHE',false);}}}function
aitRenderDeleteCachesThemeOptionControl(){?>

		<div class="ait-opt-label">
			<div class="ait-label-wrapper">
				<span class="ait-label"><?php _e('Delete caches','ait-admin')?></span>
			</div>
		</div>

		<div class="ait-opt">
			<div class="ait-opt-wrapper" style="background:none;">
				<p><button type="button" id="ait-delete-cache-theme-btn" class="ait-opt-btn"><img src="<?php echo
aitPaths()->url->admin.'/assets/img/preloader_img.gif'?>" style="display:none;vertical-align: middle;" width="20" height="20"> <?php _e('Empty theme cache','ait-admin')?></button></p>
				<p><button type="button" id="ait-delete-cache-image-btn" class="ait-opt-btn"><img src="<?php echo
aitPaths()->url->admin.'/assets/img/preloader_img.gif'?>" style="display:none;vertical-align: middle;" width="20" height="20"> <?php _e('Empty image (WPThumb) cache','ait-admin')?></button></p>
			</div>
		</div>
		<script>
			jQuery(function($){
				$('#ait-delete-cache-theme-btn').on('click', function(){
					var $img = $(this).find('img').show();
					var $ok = $('<span style="color:green;">Ok</span>').hide().insertBefore($img);
					$.post(ajaxurl, {'action': 'emptyThemeCacheDir', '_ajax_nonce': '<?php echo
AitUtils::nonce("delete-cache-theme")?>'}, function(response){
						$ok.show().fadeOut(3000, function(){
							$ok.remove();
						});
						$img.fadeOut();
					});
					return false;
				});

				$('#ait-delete-cache-image-btn').on('click', function(){
					var $img = $(this).find('img').show();
					var $ok = $('<span style="color:green;">Ok</span>').hide().insertBefore($img);
					$.post(ajaxurl, {'action': 'emptyWPThumbCacheDir', '_ajax_nonce': '<?php echo
AitUtils::nonce("delete-cache-image")?>'}, function(response){
						$ok.show().fadeOut(3000, function(){
							$ok.remove();
						});
						$img.fadeOut();
					});
					return false;
				});
			});
		</script>
	<?php
}function
aitExtractVideoIdFromVideoUrl($videoUrl){$videoId='';if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$videoUrl,$match)){if(isset($match[1])){$videoId=$match[1];}}elseif(preg_match("/https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/",$videoUrl,$match)){if(isset($match[3])){$videoId=$match[3];}}return$videoId;}if(!function_exists('d')){function
d(){foreach(func_get_args()as$arg){echo"<xmp style='outline:1px solid red;background:ivory;position:relative;z-index:999;clear:both;'>";var_dump($arg);echo"</xmp>";}}}if(!function_exists('dd')){function
dd(){foreach(func_get_args()as$arg){echo"<xmp style='outline:1px solid red;background:ivory;position:relative;z-index:999;clear:both;'>";var_dump($arg);echo"</xmp>";}die();}}if(!function_exists('p')){function
p(){foreach(func_get_args()as$arg){echo"<xmp style='outline:1px solid red;background:ivory;position:relative;z-index:999;clear:both;'>";print_r($arg);echo"</xmp>";}}}if(!function_exists('pd')){function
pd(){foreach(func_get_args()as$arg){echo"<xmp style='outline:1px solid red;background:ivory;position:relative;z-index:999;clear:both;'>";print_r($arg);echo"</xmp>";}die();}}if(!function_exists('array_replace_recursive')){function
array_replace_recursive(){$arrays=func_get_args();$original=array_shift($arrays);foreach($arrays
as$array){foreach($array
as$key=>$value){if(is_array($value)and
isset($original[$key])){$original[$key]=array_replace_recursive($original[$key],$array[$key]);}else{$original[$key]=$value;}}}return$original;}}add_action('themecheck_checks_loaded','ait_disable_checks');function
ait_disable_checks(){global$themechecks;$checks_to_disable=array('IncludeCheck','I18NCheck','AdminMenu','Bad_Checks','MalwareCheck','Theme_Support','CustomCheck','EditorStyleCheck','IframeCheck');foreach($themechecks
as$keyindex=>$check){if($check
instanceof
themecheck){$check_class=get_class($check);if(in_array($check_class,$checks_to_disable)){unset($themechecks[$keyindex]);}}}}class
AitAdminBar{static
function
register(){add_action("wp_ajax_toggleDevMode",array(__CLASS__,"ajaxToggleDevMode"));add_action("wp_ajax_emptyThemeCacheDir",array(__CLASS__,"ajaxEmptyThemeCacheDir"));add_action("wp_ajax_emptyWPThumbCacheDir",array(__CLASS__,"ajaxEmptyWPThumbCacheDir"));add_action('admin_bar_menu',array(__CLASS__,'generateThemeAdminMenu'),31);add_action('admin_bar_menu',array(__CLASS__,'generateDevMenu'),1999);add_action('admin_bar_menu',array(__CLASS__,'addPageBuilderLink'),100);add_action('admin_head',array(__CLASS__,'cssAndJs'));add_action('wp_head',array(__CLASS__,'cssAndJs'));}static
function
generateThemeAdminMenu($wp_admin_bar){$adminMenuItems=aitConfig()->getAdminConfig('pages');if(!current_user_can(apply_filters('ait-admin-bar-permission','manage_options')))return;if(!empty($adminMenuItems)){$wp_admin_bar->add_node(array('id'=>'ait-admin-menu','title'=>'<span class="ab-icon"></span><span class="ab-label">'.__('Theme Admin','ait-admin').'</span>','href'=>'#','meta'=>array('class'=>'ait-admin-menu')));$t=aitConfig()->getFullConfig('theme');foreach($adminMenuItems
as$i=>$item){if($item['slug']!='admin'){$wp_admin_bar->add_node(array('id'=>'ait-'.$item['slug'],'title'=>$item['menu-title'],'href'=>AitUtils::adminPageUrl(array('page'=>$item['slug'])),'parent'=>'ait-admin-menu'));if($item['slug']=='theme-options'){foreach($t
as$groupKey=>$groupData){$title=(!empty($groupData['@title']))?$groupData['@title']:$groupKey;$id=sanitize_key(sprintf("ait-%s-%s-panel",$item['slug'],$groupKey));$_translate='__';$wp_admin_bar->add_node(array('id'=>$id,'title'=>$_translate($title,'ait-admin'),'href'=>AitUtils::adminPageUrl(array('page'=>$item['slug'])).'#'.$id,'parent'=>'ait-'.$item['slug']));}}if(isset($item['sub'])){foreach($item['sub']as$j=>$subItem){$wp_admin_bar->add_node(array('id'=>'ait-'.$subItem['slug'],'title'=>$subItem['menu-title'],'href'=>AitUtils::adminPageUrl(array('page'=>$subItem['slug'])),'parent'=>'ait-admin-menu'));}}}}}}static
function
generateDevMenu($wp_admin_bar){if(!defined('AIT_SERVER')){return;}$title=__('Dev mode: ','ait-admin');if(AIT_DEV){$l='on';$s='state-on';}else{$l='off';$s='';}$title.=sprintf("<strong class='ait-dev-mode-state %s'>%s</strong>",$s,$l);$wp_admin_bar->add_node(array('id'=>'ait-dev-mode','title'=>$title,'parent'=>'top-secondary','href'=>'#','meta'=>array('class'=>'ait-dev-mode')));$wp_admin_bar->add_node(array('id'=>'ait-empty-theme-cache','title'=>__('Empty theme cache','ait-admin'),'parent'=>'ait-dev-mode','href'=>'#'));$wp_admin_bar->add_node(array('id'=>'ait-empty-wpthumb-cache','title'=>__('Empty image (WPThumb) cache','ait-admin'),'parent'=>'ait-dev-mode','href'=>'#'));}static
function
enhanceDefaultBar($wp_admin_bar){if(is_multisite()){$wp_admin_bar->add_menu(array('parent'=>'network-admin','id'=>'network-admin-p','title'=>__('Plugins','default'),'href'=>network_admin_url('plugins.php')));$wp_admin_bar->add_menu(array('parent'=>'network-admin','id'=>'network-admin-t','title'=>__('Themes','default'),'href'=>network_admin_url('themes.php')));$adminMenuItems=aitConfig()->getAdminConfig('pages');foreach((array)$wp_admin_bar->user->blogs
as$blog){switch_to_blog($blog->userblog_id);$menuId='blog-'.$blog->userblog_id;if(current_user_can('switch_themes')){$wp_admin_bar->add_menu(array('parent'=>$menuId,'id'=>$menuId.'-t','title'=>__('Themes','default'),'href'=>admin_url('themes.php')));}if(current_user_can('activate_plugins')){$wp_admin_bar->add_menu(array('parent'=>$menuId,'id'=>$menuId.'-p','title'=>__('Plugins','default'),'href'=>admin_url('plugins.php')));}foreach($adminMenuItems
as$i=>$item){if($item['slug']!='admin'){$wp_admin_bar->add_node(array('id'=>'ait-'.$item['slug']."-{$menuId}",'title'=>$item['menu-title'],'href'=>AitUtils::adminPageUrl(array('page'=>$item['slug'])),'parent'=>$menuId));}}restore_current_blog();}}}static
function
addPageBuilderLink($wp_admin_bar){global$typenow;global$pagenow;global$post;$oid=aitOptions()->getOid();$args=array('page'=>'pages-options','oid'=>$oid,'oidnonce'=>AitUtils::nonce('oidnonce'));if(isset($post)and$pagenow=='post.php'){$args['oid']='_page_'.$post->ID;$b=aitOptions()->getFrontpage();if($b->customFrontpage
and$b->blog==$post->ID){$args['oid']='_blog';}}if(!is_admin()or(is_admin()and$pagenow=='post.php'and$typenow=='page')){$wp_admin_bar->add_node(array('id'=>'page-builder','title'=>__('Page Builder','ait-admin'),'href'=>AitUtils::adminPageUrl($args)));}}static
function
cssAndJs(){if(is_user_logged_in()){$ajaxUrl=admin_url('admin-ajax.php');$t=aitOptions()->getOptionsByType('theme');$icon=isset($t['adminBranding']['adminMenuIcon'])?"url('{$t['adminBranding']['adminMenuIcon']}')":'url('.aitPaths()->url->fw.'/admin/assets/img/ait-admin-menu-icon16.png)';?>
			<style>
				#wp-admin-bar-ait-admin-menu > a > .ab-icon {background-image: <?php echo$icon?>;background-repeat: no-repeat;}
				#wpadminbar .ait-dev-mode-state{font-weight:bold;color:#fff;padding:2px 4px;border:1px solid transparent;}
				#wpadminbar .ait-dev-mode-state.state-on{color:lime;text-shadow:0 0 3px #a8ff2f;}
				#wpadminbar .ait-dev-mode.hover .ait-dev-mode-state{background:#464646;border-radius:2px;}
			</style>

			<script>
			jQuery(function($){
				$('#wp-admin-bar-ait-dev-mode > a').on('click', function(){
					var state = $(this).find('.ait-dev-mode-state');
					var v;
					if(state.hasClass('state-on')){
						state.removeClass('state-on');
						state.text('off');
						v = 0;
					}else{
						state.addClass('state-on');
						state.text('on');
						v = 1;
					}
					$.post('<?php echo$ajaxUrl?>', {'action': 'toggleDevMode', 'value': v});
					return false;
				});

				$('#wp-admin-bar-ait-empty-theme-cache > a').on('click', function(){
					$.post('<?php echo$ajaxUrl?>', {'action': 'emptyThemeCacheDir', '_ajax_nonce': '<?php echo
AitUtils::nonce("delete-cache-theme")?>'});
					return false;
				});

				$('#wp-admin-bar-ait-empty-wpthumb-cache > a').on('click', function(){
					$.post('<?php echo$ajaxUrl?>', {'action': 'emptyWPThumbCacheDir', '_ajax_nonce': '<?php echo
AitUtils::nonce("delete-cache-image")?>'});
					return false;
				});
			});
			</script>
			<?php
}}static
function
ajaxToggleDevMode(){$v=(int)$_POST['value'];$o=aitOptions()->getOptions();$o['theme']['administrator']['devMode']=$v;update_option(aitOptions()->getOptionKey('theme'),$o['theme']);@unlink(aitPaths()->url->root.'/wp-content/debug.log');exit;}static
function
ajaxEmptyThemeCacheDir(){AitUtils::checkAjaxNonce('delete-cache-theme');AitUtils::delete(aitPaths()->dir->cache,'*');wp_send_json_success();}static
function
ajaxEmptyWPThumbCacheDir(){AitUtils::checkAjaxNonce('delete-cache-image');$u=WP_Thumb::uploadDir();$path=$u['basedir'].'/cache/images';AitUtils::delete($path,"*");wp_send_json_success();}}class
AitAssetsManager{protected$builtinFrontendAssets=array();protected$assetsList=array();protected$ajaxActions=array();protected$params=array();protected$inlineStyleCallbacks=array();protected$lastEnqueuedCssHandler;protected$lastEnqueuedLessHandler;function
__construct($builtinFrontendAssets,$assetsFromFunctionsPhpFile){$this->builtinFrontendAssets=$builtinFrontendAssets;$this->assetsList[]=array('assets'=>$assetsFromFunctionsPhpFile,'params'=>array());}function
addAssets($assets,$params=array()){$this->assetsList[]=array('assets'=>$assets,'params'=>$params);}function
setAjaxActions($callbacks){$this->ajaxActions=$callbacks;}function
enqueueFrontendAssets(){$builtinAssets=apply_filters('ait-theme-builtin-assets',$this->builtinFrontendAssets);$this->enqueueCss($builtinAssets['css']);$this->enqueueJs($builtinAssets['js']);$this->initGlobalFrontendJsVariables();if(is_singular()and
comments_open()and
get_option('thread_comments')){wp_enqueue_script('comment-reply');}$this->addGoogleFontsCss();$assetsList=apply_filters('ait-theme-assets',$this->assetsList);foreach($assetsList
as$item){if(isset($item['assets']['css'])){$this->enqueueCss($item['assets']['css'],$item['params']);}if(isset($item['assets']['js'])){$this->enqueueJs($item['assets']['js'],$item['params']);}}$this->enqueueLessFiles();$this->addWpInlineStyles();if(file_exists(aitPaths()->dir->theme.'/custom.css')){wp_enqueue_style('ait-theme-custom-style',aitPaths()->url->theme.'/custom.css');}}function
enqueueLessFiles(){$results=$this->compileLessFiles();foreach($results
as$handler=>$result){$this->embedOrEnqueueCssGeneratedFromLess($handler,$result);}}function
compileLessFiles(){$lessCompiler=new
AitLessCompiler(aitPaths()->dir->cache,aitPaths()->url->cache);$lessFiles=apply_filters('ait-less-files',$this->getCoreLessFiles());$results=array();foreach($lessFiles
as$handler=>$args){if($args['inputFile']){$results[$handler]=$lessCompiler->compileFile($args['inputFile'],$args['params']);}}return$results;}function
getCoreLessFiles(){return
array('ait-theme-main-base-style'=>array('inputFile'=>aitPath('css','/base.less'),'params'=>array()),'ait-theme-main-style'=>array('inputFile'=>aitPath('css','/style.less'),'params'=>array()),'ait-theme-layout-style'=>array('inputFile'=>aitPath('css','/layout.less'),'params'=>array('oid'=>aitOptions()->getOid())),'ait-preloading-effects'=>array('inputFile'=>aitPath('css','/preloading.less'),'params'=>array()),'ait-typography-style'=>array('inputFile'=>aitPath('css','/typography.less'),'params'=>array('lang'=>AitLangs::getCurrentLocale())));}function
getInlineCss(){return
apply_filters('ait-inline-css',array(array('appendTo'=>'ait-theme-main-style','css'=>array($this,'getThemeMainInlineStylesContent'))));}function
getCustomCss(){if(apply_filters('ait-enable-less-in-custom-css-field',false)){$css=function(){$lessCompiler=new
AitLessCompiler(aitPaths()->dir->cache,aitPaths()->url->cache);return$lessCompiler->compileString(aitOptions()->get('theme')->customCss->css);};}else{$css=function(){return
aitOptions()->get('theme')->customCss->css;};}return
apply_filters('ait-custom-css',array(array('appendTo'=>'','css'=>$css)));}protected
function
embedOrEnqueueCssGeneratedFromLess($handler,$output){if($output['isEmpty'])return;if($output['error']){wp_add_inline_style($this->lastEnqueuedCssHandler,$output['embedCss']);if(AIT_DEV
and!empty($output['errorMsg'])){error_log($output['errorMsg']);}}else{$this->lastEnqueuedLessHandler=$handler;wp_enqueue_style($handler,$output['url'],array(),$output['version']);}}protected
function
addWpInlineStyles(){foreach($this->getInlineCss()as$inline){$css=call_user_func($inline['css']);if($inline['appendTo']){wp_add_inline_style($inline['appendTo'],$css);}else{wp_add_inline_style($this->lastEnqueuedLessHandler,$css);}}foreach($this->getCustomCss()as$inline){$output=call_user_func($inline['css']);$css=is_array($output)?$output['css']:$output;if((is_array($output)and$output['isEmpty'])or
empty($css))continue;if($inline['appendTo']){wp_add_inline_style($inline['appendTo'],$css);}else{wp_add_inline_style($this->lastEnqueuedLessHandler,$css);}}}function
enqueueAdminAssets(){foreach($this->assetsList
as$item){if(isset($item['assets']['admin-css'])){$this->enqueueCss($item['assets']['admin-css'],$item['params']);}if(isset($item['assets']['admin-js'])){$this->enqueueJs($item['assets']['admin-js'],$item['params']);}}}function
enqueueCss($styles,$params=array()){if(empty($styles)or!is_array($styles))return;$lastHandler='';foreach($styles
as$handler=>$css){$lastHandler=$handler;if($css===true){wp_enqueue_style($handler);}elseif(is_array($css)){if(AitUtils::isExtUrl($css['file'])or
AitUtils::isAbsUrl($css['file'])){$url=$css['file'];}else{if(isset($params['paths']->url->css))$url=$params['paths']->url->css.$css['file'];else$url=aitUrl('css',$css['file']);}wp_register_style($handler,$url,isset($css['deps'])?$css['deps']:array(),isset($css['ver'])?$css['ver']:false,isset($css['media'])?$css['media']:'all');if(!isset($css['enqueue'])or(isset($css['enqueue'])and$css['enqueue']))wp_enqueue_style($handler);}}$this->lastEnqueuedCssHandler=$lastHandler;}function
enqueueJs($scripts,$params=array()){if(empty($scripts)or!is_array($scripts))return;foreach($scripts
as$handler=>$js){if(is_bool($js)and$js===true){wp_enqueue_script($handler);}elseif(is_array($js)){$filename=$js['file'];if(isset($js['lang'])){$filename=str_replace('{lang}',AitLangs::getCurrentLanguageCode(),$filename);$filename=str_replace('{gmaps-lang}',AitLangs::getGmapsLang(),$filename);}if(isset($js['api-key'])){$t=aitOptions()->getOptionsByType('theme');$gmapsApiKey=empty($t['google']['mapsApiKey'])?"":$t['google']['mapsApiKey'];$filename=str_replace('{gmaps-api-key}',$gmapsApiKey,$filename);}if(AitUtils::isExtUrl($filename)or
AitUtils::isAbsUrl($filename)){$url=$filename;}else{if(isset($params['paths']->url->js))$url=$params['paths']->url->js.$filename;else$url=aitUrl('js',$filename);}wp_register_script($handler,$url,isset($js['deps'])?$js['deps']:array(),isset($js['ver'])?$js['ver']:false,isset($js['in-footer'])?$js['in-footer']:true);if(isset($js['enqueue-only-if'])and$js['enqueue-only-if']){$fn=create_function('',"return {$js['enqueue-only-if']};");if(call_user_func($fn)){wp_enqueue_script($handler);}}elseif(!isset($js['enqueue'])or(isset($js['enqueue'])and$js['enqueue']==true)){wp_enqueue_script($handler);}if(isset($js['localize'])){if(isset($js['localize']['object-var'])){$var=$js['localize']['object-var'];unset($js['localize']['object-var']);}else{$var=AitUtils::dash2class($handler);}wp_localize_script($handler,$var,$js['localize']);}}}}protected
function
initGlobalFrontendJsVariables(){$settings=array('home'=>array('url'=>home_url()),'ajax'=>array('url'=>admin_url('admin-ajax.php'),'actions'=>array()),'paths'=>array('theme'=>aitPaths()->url->theme,'css'=>aitPaths()->url->css,'js'=>aitPaths()->url->js,'img'=>aitPaths()->url->img),'l10n'=>array('datetimes'=>array('dateFormat'=>AitUtils::phpDate2jsDate(get_option('date_format')),'startOfWeek'=>get_option('start_of_week'))));$settings['ajax']['actions']=$this->ajaxActions;wp_localize_script('jquery-core','AitSettings',apply_filters('ait-global-js-settings',$settings));}function
addInlineStyleCallback($callback){$this->inlineStyleCallbacks[]=$callback;}function
getThemeMainInlineStylesContent(){$css='';$files=array();$oid=aitOptions()->getOid();$cacheKey='inline-styles-'.$oid;if($css=AitCache::load($cacheKey)){return$css;}else{foreach($this->inlineStyleCallbacks
as$cb){$r=call_user_func($cb);$css.=$r['css'];$files=array_merge($files,$r['files']);}$files=array_unique($files);$tag=$oid==''?'global':$oid;AitCache::save($cacheKey,$css,array('files'=>$files,'tags'=>array($tag)));}return$css;}protected
function
addGoogleFontsCss(){$asset=array();$themeOptions=aitOptions()->getOptionsByType('theme');if(!isset($themeOptions['typography']))return;foreach($themeOptions['typography']as$optionKey=>$optionValue){$value=AitLangs::getCurrentLocaleText($optionValue,'');if(!$value)continue;list($fontType,$fontFamily)=array_pad(explode('@',$value),2,null);if(!$fontFamily||$fontType!='google')continue;$font=AitGoogleFonts::getByFontFamily($fontFamily);if($font!==false){$urlArgs=array('family'=>$fontFamily.':'.implode(',',$font->variants),'subset'=>implode(',',$font->subsets));$fontUrl=add_query_arg($urlArgs,"//fonts.googleapis.com/css");$handler="google-font-".$optionKey;$asset['css'][$handler]['file']=esc_url_raw($fontUrl);$asset['css'][$handler]['ver']=null;$this->assetsList[]=array('assets'=>$asset,'params'=>array());}}}}class
AitCache{protected
static$cache;function
__construct(){throw
new
LogicException(__CLASS__.' is a static class. Can not be instantiate.');}static
function
init(){self::$cache=new
NCache(self::createCacheStorage(true),'ait-theme');}static
function
save($cacheKey,$data,$flags=array()){$f=array();if(isset($flags['files'])){$f[NCache::FILES]=$flags['files'];}if(isset($flags['tags'])){$f[NCache::TAGS]=$flags['tags'];}self::$cache->save(self::getFullCacheKey($cacheKey),$data,$f);}static
function
load($cacheKey){return
self::$cache->load(self::getFullCacheKey($cacheKey));}static
function
remove($cacheKey){self::$cache->remove(self::getFullCacheKey($cacheKey));}static
function
clean($flags=array()){if((isset($flags['less'])and$flags['less'])or
count($flags)==0){self::cleanLessCache();unset($flags['less']);}$f=array();if(empty($flags)){$f[NCache::ALL]=true;}if(isset($flags['tags'])){$f[NCache::TAGS]=$flags['tags'];}self::$cache->clean($f);}static
function
cleanLessCache(){AitUtils::delete(aitPaths()->dir->cache,'.ht-*.less-cache');}static
function
cleanImageCache(){$u=WP_Thumb::uploadDir();$path=$u['basedir'].'/cache/images';AitUtils::delete($path,"*");}static
function
createCacheStorage($withJournal=false,$disableForRobotLoader=false){$c=aitPaths()->dir->cache;if(defined('AIT_DISABLE_CACHE')and
AIT_DISABLE_CACHE==true
and!$disableForRobotLoader){return
new
NDevNullStorage;}if(is_writable($c)){if($withJournal)$storage=new
NFileStorage($c,new
NFileJournal($c));else$storage=new
NFileStorage($c);}else{$storage=new
NMemoryStorage;}return$storage;}protected
static
function
getFullCacheKey($cacheKey){global$wp_version;$cacheKey.=$wp_version.AIT_CURRENT_THEME.AIT_THEME_VERSION;return$cacheKey;}}class
AitConfig
extends
NObject{protected$storage=array();function
__construct(){add_action('pll_after_language_switch',array($this,'onAfterLanguageSwitch'));}protected
function
loadConfig(){$userId=get_current_user_id();if($value=AitCache::load("@raw-config-$userId")){$rawConfig=$value;}else{$rawConfig=$this->loadMainConfigs();AitCache::save("@raw-config-$userId",$rawConfig,array('files'=>array_values($this->getMainConfigFiles())));}return$rawConfig;}function
getRawConfig(){if(!isset($this->storage['raw-config']))$this->storage['raw-config']=$this->loadConfig();return$this->storage['raw-config'];}function
getDefaults($configType=''){if(!isset($this->storage['defaults'])){$r=$this->processConfig($this->getRawConfig());$this->storage['defaults']=$r['defaults'];}if(isset($this->storage['defaults'][$configType]))return$this->storage['defaults'][$configType];else{if(empty($configType))return$this->storage['defaults'];else
trigger_error("There is no config type '$configType' for ".__METHOD__." method");}}function
getFullConfig($configType=''){if(!isset($this->storage['full-config'])){$r=$this->processConfig($this->getRawConfig());$this->storage['full-config']=$r['full-config'];}if(isset($this->storage['full-config'][$configType]))return$this->storage['full-config'][$configType];else{if(empty($configType))return$this->storage['full-config'];else
trigger_error("There is no config type '$configType' for ".__METHOD__." method");}}function
getTranslatablesList($configType=''){if(!isset($this->storage['translatables-list'])){$r=$this->processConfig($this->getRawConfig());$this->storage['translatables-list']=$r['translatables-list'];}if(isset($this->storage['translatables-list'][$configType]))return$this->storage['translatables-list'][$configType];else{if(empty($configType))return$this->storage['translatables-list'];else
trigger_error("There is no config type '$configType' for ".__METHOD__." method");}}function
getAdminConfig($group=''){if(!isset($this->storage['admin-config'])){$defaults=require
aitPaths()->dir->fwConfig.'/admin.php';$configFile=aitPath('config','/admin.neon');$config=self::loadRawConfig($configFile,'/admin.neon',true);$this->storage['admin-config']=array_merge($defaults,$config);}if($group){if(isset($this->storage['admin-config'][$group]))return$this->storage['admin-config'][$group];else
return
false;}return$this->storage['admin-config'];}function
getDefaultAdminPage(){$adminPages=$this->getAdminConfig('pages');unset($adminPages[0]['sub']);return$adminPages[0];}function
getMainConfigFiles(){if(!isset($this->storage['main-config-files'])){$this->storage['main-config-files']=apply_filters('ait-main-config-files',array('theme'=>aitPath('config','/@theme.neon'),'layout'=>aitPath('config','/@layout.neon'),'elements'=>aitPath('config','/@elements.neon'),'theme-built-in'=>aitPaths()->dir->fwConfig.'/@theme.php','layout-built-in'=>aitPaths()->dir->fwConfig.'/@layout.php','elements-built-in'=>aitPaths()->dir->fwConfig.'/@elements.php'));}return$this->storage['main-config-files'];}function
processConfig($rawConfig=array(),$force=false,$cacheKey='',$files=array(),$extractDefaults=true){$f=array();$f['files']=array();if($files!==false)$f['files']=empty($files)?array_values($this->getMainConfigFiles()):$files;if($cacheKey){$cacheKey.=md5(implode('',$f['files']));}if(!$force){$userId=get_current_user_id();if($value=AitCache::load("@processed-config-$userId".$cacheKey)){return$value;}}$result=array('full-config'=>$this->createFullConfig($rawConfig),'defaults'=>$extractDefaults?$this->extractDefaultsFromConfig($rawConfig):array());$result['translatables-list']=$this->extractListOfTranslatableOptions($result['full-config']);if(!$force){$userId=get_current_user_id();AitCache::save("@processed-config-$userId".$cacheKey,$result,$f);}return$result;}function
extractDefaultsFromConfig($rawConfig,$withOnlyUsedElements=false){$defaults=array();$i=0;foreach($rawConfig
as$configName=>$groups){foreach($groups
as$groupKey=>$groupValues){if(!isset($groupValues['options'])){$groupValues['options']=array();}if($configName=='elements'and
isset($groupValues['used'])and!$groupValues['used']and$withOnlyUsedElements)continue;foreach($groupValues['options']as$optionKey=>$optionControlDefinition){if(!$this->isOptionsSection($optionControlDefinition)){if(isset($optionControlDefinition['type'])or(!isset($optionControlDefinition['type'])and
isset($optionControlDefinition['callback']))){$optionControlClass=AitOptionControl::resolveClass($optionControlDefinition);$defaultValue=call_user_func(array($optionControlClass,'prepareDefaultValue'),$optionControlDefinition);if($configName=='elements'){$defaults[$configName][$i][$groupKey][$optionKey]=$defaultValue;}else{$defaults[$configName][$groupKey][$optionKey]=$defaultValue;}}}}if(self::isMainConfigType($configName)and$configName=='elements'){if(!isset($defaults[$configName][$i][$groupKey])){$defaults[$configName][$i][$groupKey]=array();}$defaults[$configName][$i][$groupKey]['@columns-element-index']='';$defaults[$configName][$i][$groupKey]['@columns-element-column-index']='';$defaults[$configName][$i][$groupKey]['@element-user-description']='';}else{if(!isset($defaults[$configName][$groupKey])){$defaults[$configName][$groupKey]=array();}}if(self::isMainConfigType($configName)and$configName=='elements'){$i++;}}if(!isset($defaults[$configName])){$defaults[$configName]=array();}}if(empty($defaults)){$defaults[key($rawConfig)]=array();}return$defaults;}function
extractListOfTranslatableOptions($fullConfig){$translatables=array();foreach($fullConfig
as$configType=>$groups){$translatables[$configType]=array();foreach($groups
as$groupKey=>$groupValues){$groupId=$configType=='elements'?$groupValues['@element']:$groupKey;foreach($groupValues['@options']as$sections){foreach($sections
as$optionKey=>$option){if($optionKey=='@section')continue;$optionControlClass=AitOptionControl::resolveClass($option);if($optionControlClass=='AitTranslatableOptionControl'||is_subclass_of($optionControlClass,'AitTranslatableOptionControl')){$translatables[$configType][$groupId][$optionKey]=true;}elseif($optionControlClass=='AitCloneOptionControl'||is_subclass_of($optionControlClass,'AitCloneOptionControl')){foreach($option['items']as$k=>$clone){if(is_subclass_of(AitOptionControl::resolveClass($clone),'AitTranslatableOptionControl')){$translatables[$configType][$groupId][$optionKey][$k]=true;}}}}}}}return$translatables;}function
createFullConfig($rawConfig){$fullConfig=array();$j=$sectionIndex=0;$filterSections=create_function('$v','return is_numeric($v);');foreach($rawConfig
as$configType=>$groups){if($configType=='elements'){$fullConfig['elements']=$this->createElementsFullConfig($groups);}else{foreach($groups
as$groupKey=>$groupValues){$fullConfig[$configType][$groupKey]=$this->convertGroupForFullConfig($groupKey,$groupValues);if(!isset($groupValues['options'])){$fullConfig[$configType][$groupKey]['@options']=array();$groupValues['options']=array();}$hasSections=count(array_filter(array_keys($groupValues['options']),$filterSections))>0;if(!$hasSections
and!empty($groupValues['options'])){$fullConfig[$configType][$groupKey]["@options"][0]["@section"]=$this->getOptionsSection(true);}elseif(empty($groupValues['options'])){$fullConfig[$configType][$groupKey]["@options"]=array();}$currentSectionIsAdvanced=false;foreach($groupValues['options']as$optionKey=>$optionValue){if($this->isOptionsSection($optionValue)){$sectionIndex=$j;$fullConfig[$configType][$groupKey]["@options"][$sectionIndex]["@section"]=$this->getOptionsSection($optionValue);$currentSectionIsAdvanced=$fullConfig[$configType][$groupKey]["@options"][$sectionIndex]["@section"]->allAreAdvanced;}else{if(!isset($optionValue['type'])and!isset($optionValue['callback'])){trigger_error("Option '{$configType}.{$groupKey}.{$optionKey}' does not have 'type' parameter set.",E_USER_WARNING);}else{if($j==0)$fullConfig[$configType][$groupKey]["@options"][0]["@section"]=$this->getOptionsSection(true);if($currentSectionIsAdvanced
and
isset($optionValue['basic']))unset($optionValue['basic']);if(isset($groupValues['text-domain'])){$optionValue['text-domain']=$groupValues['text-domain'];}$fullConfig[$configType][$groupKey]["@options"][$sectionIndex][$optionKey]=$optionValue;}}$j++;}if(isset($fullConfig[$configType][$groupKey]['@options'][0])and
count($fullConfig[$configType][$groupKey]['@options'][0])==1){unset($fullConfig[$configType][$groupKey]);}$j=$sectionIndex=0;}if(!isset($fullConfig[$configType]))$fullConfig[$configType]=array();}}if(empty($fullConfig))$fullConfig[key($rawConfig)]=array();return$fullConfig;}function
createElementsFullConfig($elements){$return=array();$row=$cols=$j=$sectionIndex=0;$filterSections=create_function('$v','return is_numeric($v);');$i=0;foreach($elements
as$elKey=>$elValues){$return[$i]=$this->convertGroupForFullConfig($elKey,$elValues,true);$return[$i]['@element']=$elKey;$hasSections=count(array_filter(array_keys($elValues['options']),$filterSections))>0;if(!$hasSections
and!empty($elValues['options']))$return[$i]["@options"][0]["@section"]=$this->getOptionsSection(true);elseif(empty($elValues['options']))$return[$i]["@options"]=array();foreach($elValues['options']as$optionKey=>$optionValue){if($this->isOptionsSection($optionValue)){$sectionIndex=$j;$return[$i]["@options"][$sectionIndex]["@section"]=$this->getOptionsSection($optionValue);}else{if(!isset($optionValue['type'])and!isset($optionValue['callback'])){trigger_error("Option 'elements.{$elKey}.{$optionKey}' does not have 'type' parameter set.",E_USER_WARNING);}else{if($j==0){$return[$i]["@options"][0]["@section"]=$this->getOptionsSection(true);}$return[$i]["@options"][$sectionIndex][$optionKey]=$optionValue;}}$j++;}$hiddenSection=$sectionIndex+1;if(!isset($return[$i]["@options"][$hiddenSection])){$return[$i]["@options"][$hiddenSection]["@section"]=$this->getOptionsSection(true,true);$return[$i]["@options"][$hiddenSection]=array_merge($return[$i]["@options"][$hiddenSection],array('@columns-element-index'=>array('type'=>'hidden','basic'=>true),'@columns-element-column-index'=>array('type'=>'hidden','basic'=>true),'@element-user-description'=>array('type'=>'hidden','basic'=>true)));}$i++;$j=$sectionIndex=0;}return$return;}function
mergeIncludedConfigIfAny($options,$groupKey,$isElements=false){if(isset($options['@include'])){$includedConfig=$this->includeConfig($options['@include'],$groupKey,$isElements);unset($options['@include']);$includedConfig=array_reverse($includedConfig);foreach($includedConfig
as$c){$options=array_replace_recursive($c,$options);}}return$options;}function
includeConfig($includes,$group,$inElements=false){$includes=(array)$includes;$return=array();if($inElements){foreach($includes
as$include){$inc=$this->parseIncludeStatement($include);$file=aitPath('elements',"/@common/{$inc->file}");if($file===false){trigger_error("There is no cofig file '@common/{$inc->file}' for including in element '{$group}'",E_USER_WARNING);$return[$inc->file]=array();}else{$includedConfig=self::loadRawConfig($file);$this->storage['main-config-files']["@common/{$inc->file}"]=$file;$counter=0;foreach($includedConfig
as$k=>$v){if($this->isOptionsSection($v)){$counter++;NArrays::renameKey($includedConfig,$k,$k.$group.$inc->file);}}if($counter>0
and!isset($includedConfig[$k.$group.$inc->file])){$nn=new
NNeonEntity;$nn->value='section';$nn->attributes=array();$includedConfig[$counter.$group.$inc->file]=$nn;}if(empty($inc->options)){if(empty($inc->excludeOptions)){$return[$inc->file]=$includedConfig;}else{$x=array_diff_key($includedConfig,$inc->excludeOptions);$return[$inc->file]=$x;}}else{$return[$inc->file]=array_intersect_key($includedConfig,$inc->options);}}}}else{}return$return;}protected
function
parseIncludeStatement($statement){$return=new
stdClass;$return->file=$statement;$return->options=array();$return->excludeOptions=array();$statement=trim($statement,'\\/');if(AitUtils::contains($statement,'#')){$parts=explode('#',$statement);$return->file=$parts[0];if(isset($parts[1])and$parts[1]!=''){if(AitUtils::startsWith($parts[1],'exclude:')){$parts[1]=str_replace('exclude:','',$parts[1]);$options=explode(',',$parts[1]);$options=array_map('trim',$options);$return->excludeOptions=array_combine($options,$options);}else{$options=explode(',',$parts[1]);$options=array_map('trim',$options);$return->options=array_combine($options,$options);}}}return$return;}function
convertGroupForFullConfig($groupKey,$groupData,$isElement=false){$return=array();$hasReset=(!isset($groupData['reset'])or(isset($groupData['reset'])and$groupData['reset']!==false));$hasImport=(isset($groupData['import'])and$groupData['import']===true);$hasUsed=(!isset($groupData['used'])or(isset($groupData['used'])and$groupData['used']!==false));$hasDisabled=(isset($groupData['disabled'])and$groupData['disabled']===true);if($isElement
and
isset($groupData['package'])and
isset($groupData['package'][AIT_THEME_PACKAGE])and$groupData['package'][AIT_THEME_PACKAGE]==false){$hasDisabled=true;}$title=isset($groupData['title'])?$groupData['title']:false;if($title){if(is_string($title)){$_translate='__';$title=$_translate($title,'ait-admin');}elseif($title
instanceof
NNeonEntity){if($title->value=='_x'and!empty($title->attributes)){$text=$title->attributes[0];$context=$title->attributes[1];$_translate='_x';$title=$_translate($text,$context,'ait-admin');}}$return['@title']=$title;}$return['@reset']=$hasReset;$return['@import']=$hasImport;$return['@disabled']=$hasDisabled;$return['@configuration']=isset($groupData['configuration'])?$groupData['configuration']:array();if($isElement){$return['@used']=$hasUsed;}return$return;}function
isOptionsSection($value){if(is_string($value)and$value==='section'){return
true;}if($value
instanceof
NNeonEntity){return
true;}if(is_array($value)and(in_array('section',$value,true)or
isset($value['section']))){return
true;}return
false;}protected
function
getOptionsSection($value,$hidden=false){$return=new
stdClass;$return->title=false;$return->help=false;$return->id=false;$return->hidden=$hidden;$return->allAreAdvanced=false;$return->capabilities=false;if($value===true){return$return;}if($value==='section'){return$return;}$return->title=$this->_getSectionValue($value,'title');$return->help=$this->_getSectionValue($value,'help');$return->id=$this->_getSectionValue($value,'id');$return->allAreAdvanced=$this->_getSectionValue($value,'advanced',true);$return->capabilities=$this->_getSectionValue($value,'capabilities',true);return$return;}protected
function
_getSectionValue($section,$key,$isBool=false){$value='';$v=array();if($section
instanceof
NNeonEntity){$v=$section->attributes;}elseif(isset($section['section'])){$v=$section['section'];}elseif(in_array('section',$section,true)){$v=array();}if(isset($v[$key])){if($isBool){$value=(bool)$v[$key];}else{$value=$v[$key];}}return$value;}function
loadMainConfigs(){$f=$this->getMainConfigFiles();$config['theme']=$this->loadThemeConfig($f['theme'],$f['theme-built-in']);$config['layout']=$this->loadLayoutConfig($f['layout'],$f['layout-built-in']);$config['elements']=$this->loadElementsConfigs($f['elements'],$f['elements-built-in']);return$config;}function
loadThemeConfig($file,$builtInFile){$config=self::loadRawConfig($file);$config=apply_filters('ait-theme-config',$config);$config2=require$builtInFile;$config2=apply_filters('ait-theme-builtin-config',$config2);$return=array_replace_recursive($config,$config2);return$return;}function
loadElementsConfigs($file,$builtInFile){if($file===false)$localConfig=array();else$localConfig=self::loadRawConfig($file);$localConfig=apply_filters('ait-elements-config',$localConfig);$builtInConfig=require$builtInFile;$builtInConfig=apply_filters('ait-elements-builtin-config',$builtInConfig);$config=array_replace_recursive($builtInConfig,$localConfig);$el=$unsortable=$sortable=array();foreach($config
as$elId=>$params){if(!current_theme_supports("ait-element-{$elId}"))continue;if(!isset($params['disabled'])){$params['disabled']=false;}elseif(isset($params['disabled'])and$params['disabled']===true){continue;}$el=$params;$el['used']=false;$el['options']=array();$optFilename="/{$elId}/{$elId}.options.neon";$optFile=aitPath('elements',$optFilename);$optFile=apply_filters('ait-element-options-file',$optFile,$elId);$optFilename=apply_filters('ait-element-options-filename',$optFilename,$elId);$elOptions=self::loadRawConfig($optFile,$optFilename,true);if($elOptions){$el['options']=$this->mergeIncludedConfigIfAny($elOptions,$elId,true);}if($optFile){$this->storage['main-config-files']["{$elId}-options"]=$optFile;}else{$el['disabled']=true;}if((isset($el['configuration']['sortable'])and$el['configuration']['sortable']===false)){$el['used']=true;$unsortable[$elId]=$el;}else{$sortable[$elId]=$el;}}$donotchange=array('used'=>true,'configuration'=>array('cloneable'=>false,'sortable'=>true));$sortable['content']=array_replace_recursive($sortable['content'],$donotchange);$sortable['comments']=array_replace_recursive($sortable['comments'],$donotchange);$sortable=array_merge(array('sidebars-boundary-start'=>array('configuration'=>array('sortable'=>true,'no-base-style'=>true,'no-paths'=>true),'options'=>array('sidebars-boundary-start'=>array('type'=>'hidden')))),$sortable,array('sidebars-boundary-end'=>array('configuration'=>array('sortable'=>true,'no-base-style'=>true,'no-paths'=>true),'options'=>array('sidebars-boundary-end'=>array('type'=>'hidden')))));$allElements=array_merge($unsortable,$sortable);return
apply_filters('ait-load-elements-configs',$allElements);}function
loadLayoutConfig($file,$builtInFile){$config=self::loadRawConfig($file);$config=apply_filters('ait-layout-config',$config);$config2=require$builtInFile;$config2=apply_filters('ait-layout-builtin-config',$config2);$return=array_replace_recursive($config,$config2);return$return;}static
function
isMainConfigType($type){return
in_array($type,self::getMainConfigTypes());}static
function
getMainConfigTypes(){return
array('theme','layout','elements');}static
function
loadRawConfig($file,$filename='',$optional=false){if($file===false){if(!$optional){trigger_error("Config file '{$filename}' doesn't exist.",E_USER_WARNING);}return
array();}if(AitUtils::endsWith($file,'.php')){$config=include$file;}else{$content=@file_get_contents($file);if($content===false){trigger_error("Config file '{$filename}' is unreadable.",E_USER_WARNING);return
array();}$config=(array)NNeon::decode($content);}return$config;}private
function
deleteConfigCachedFiles($userId){AitCache::remove("@raw-config-$userId");AitCache::remove("@processed-config-$userId");}function
onAfterLanguageSwitch($arguments){$this->deleteConfigCachedFiles($arguments['user']);}}class
AitDefaultLanguage{public$id=0;public$locale;public$isRtl;public$name;public$slug;public$code;public$flagUrl;public$flag;public$isDefault=true;public$isCurrent=true;public$url;public$hasTranslation=false;public$htmlClass='';function
__construct(){$this->locale=get_locale();$this->isRtl=is_rtl();$this->name=__('Default language','ait-admin');if($this->locale=='zh_CN'){$this->slug=$this->code='cn';}elseif($this->locale=='zh_TW'){$this->slug=$this->code='tw';}elseif($this->locale=='pt_BR'){$this->slug=$this->code='br';}else{$this->slug=$this->code=substr($this->locale,0,2);}$this->url=get_home_url();$this->flagUrl="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAflJREFUeNpinDRzn5qN3uFDt16+YWBg+Pv339+KGN0rbVP+//2rW5tf0Hfy/2+mr99+yKpyOl3Ydt8njEWIn8f9zj639NC7j78eP//8739GVUUhNUNuhl8//ysKeZrJ/v7z10Zb2PTQTIY1XZO2Xmfad+f7XgkXxuUrVB6cjPVXef78JyMjA8PFuwyX7gAZj97+T2e9o3d4BWNp84K1NzubTjAB3fH0+fv6N3qP/ir9bW6ozNQCijB8/8zw/TuQ7r4/ndvN5mZgkpPXiis3Pv34+ZPh5t23//79Rwehof/9/NDEgMrOXHvJcrllgpoRN8PFOwy/fzP8+gUlgZI/f/5xcPj/69e/37//AUX+/mXRkN555gsOG2xt/5hZQMwF4r9///75++f3nz8nr75gSms82jfvQnT6zqvXPjC8e/srJQHo9P9fvwNtAHmG4f8zZ6dDc3bIyM2LTNlsbtfM9OPHH3FhtqUz3eXX9H+cOy9ZMB2o6t/Pn0DHMPz/b+2wXGTvPlPGFxdcD+mZyjP8+8MUE6sa7a/xo6Pykn1s4zdzIZ6///8zMGpKM2pKAB0jqy4UE7/msKat6Jw5mafrsxNtWZ6/fjvNLW29qv25pQd///n+5+/fxDDVbcc//P/zx/36m5Ub9zL8+7t66yEROcHK7q5bldMBAgwADcRBCuVLfoEAAAAASUVORK5CYII=";$this->flag=sprintf('<img src="%s" title="%s" alt="%s">',$this->flagUrl,esc_attr(apply_filters('pll_flag_title',$this->name,$this->slug,$this->locale)),esc_attr($this->name));if(aitIsPluginActive('languages')){$this->setFlagFromAitLanguagesPlugin();}}function
setFlagFromAitLanguagesPlugin(){if(file_exists(POLYLANG_DIR.($file='/assets/flags/'.$this->locale.'.png'))){$url=POLYLANG_URL.$file;}if(!PLL_ADMIN&&(file_exists(PLL_LOCAL_DIR.($file='/'.$this->locale.'.png'))||file_exists(PLL_LOCAL_DIR.($file='/'.$this->locale.'.jpg')))){$url=PLL_LOCAL_URL.$file;}$this->flagUrl=empty($url)?'':esc_url($url);$this->flag=apply_filters('pll_get_flag',empty($this->flagUrl)?'':sprintf('<img src="%s" title="%s" alt="%s" />',esc_url($this->flagUrl),esc_attr(apply_filters('pll_flag_title',$this->name,$this->slug,$this->locale)),esc_attr($this->name)));}}class
AitElement
extends
NObject{const
UNDEFINED_INDEX=1000;protected$internalId;protected$id;protected$title;protected$instanceNumber=0;protected$config;protected$configuration=array();protected$optionsDefaults=array();protected$options=array();protected$optionsControlsGroup;protected$oid='';protected$cpts=array();protected$template;protected$templateName;protected$style;protected$styleLessName;protected$assets=array('js'=>array(),'css'=>array(),'admin-js'=>array(),'admin-css'=>array());protected$paths;protected$generatedCss=array();protected$lessCompiler;protected$optionsObject;protected$isBetweenSidebars=false;protected$used=false;function
__construct($elementId,$fullConfig,$optionsDefaults){$this->id=$elementId;$this->config=$fullConfig;$this->optionsDefaults=$optionsDefaults;if(isset($fullConfig['@title']))$this->title=$fullConfig['@title'];else$this->title=$this->id;if(isset($fullConfig['@used'])){$this->used=$fullConfig['@used'];}$this->internalId="elm-".$this->id;$this->init();$this->configure();}function
init(){}protected
function
configure(){$c=(object)($this->configuration=array_replace_recursive($this->configuration,$this->config['@configuration']));if((isset($c->cpt)and!empty($c->cpt))){foreach($c->cpt
as$cpt){$this->cpts[$cpt]=false;}}else{$this->cpts=array();}if(!isset($c->template)or(isset($c->template)and$c->template=='default'))$this->templateName="{$this->id}.latte";if(isset($c->template)and$c->template!='default')$this->templateName=$c->template.".latte";if(!isset($c->style)or(isset($c->style)and$c->style=='default'))$this->styleLessName="style.less";if(isset($c->style)and$c->style!='default')$this->styleLessName=$c->style.".less";if(isset($c->assets))$this->assets=array_merge($this->assets,$c->assets);$base=$this->getBaseStyleUrl();if($base){$this->assets['css'][$this->getInternalId().'-base']=array('file'=>$base,'deps'=>array_keys($this->assets['css']));}}function
option($key){if(isset($this->options[$key])){return$this->options[$key];}return
false;}function
common($part){return
aitPath('elements',"/@common/{$part}.latte");}protected
function
addClassesFromSelectInputTypes(&$classes){foreach($this->config['@options']as$i=>$sections){unset($sections['@section']);foreach($sections
as$k=>$option){if($option['type']==='select'and
isset($option['add-element-class'])and$option['add-element-class']===true
and
isset($this->options[$k])and!is_array($this->options[$k])){$classes[]='elm-selected-'.$this->options[$k];}}}}function
getConfig($key=''){if(empty($key))return$this->config;if(isset($this->config[$key])){return$this->config[$key];}return
false;}function
getConfigOption($key){foreach($this->config['@options']as$i=>$sections){unset($sections['@section']);foreach($sections
as$k=>$option){if($k===$key){return$option;}}}return
null;}function
getOptionObjectFromConfig($optionKey){return$this->getConfigOption($optionKey);}function
getTitle(){return$this->title;}function
getId(){return$this->id;}function
getHtmlId(){return$this->internalId.'-'.$this->instanceNumber;}function
getHtmlClass(){return$this->internalId;}function
getHtmlClasses($asString=true){$classes=array();$classes[]='elm-main';$classes[]=$this->internalId.'-main';if($this->hasOption('@bg')){$bg=$this->option('@bg');if(isset($bg['color'])and!empty($bg['color'])){$classes[]='elm-has-bg';}}if($this->hasOption('customClass')){$classes[]=$this->option('customClass');}if($this->hasOption('contentSize')){$confOption=$this->getConfigOption('contentSize');if(isset($confOption['target'])&&!empty($confOption['target'])){if($confOption['target']==$this->option('layout')){$classes[]=$this->option('contentSize');}}else{$classes[]=$this->option('contentSize');}}$carouselEnabledOptions=$this->findOptionsContaining('EnableCarousel');foreach($carouselEnabledOptions
as$key=>$value){if($value==true){$layout=substr($key,0,strpos($key,'EnableCarousel'));$layoutOptions=$this->findOptionsContaining("[$layout]");if(count($layoutOptions)==1&&reset($layoutOptions)==true){$classes[]='carousel-enabled';}}}$this->addClassesFromSelectInputTypes($classes);$classes=array_unique($classes);return$asString?implode(' ',$classes):$classes;}function
getPaths(){if(isset($this->configuration['no-paths'])and$this->configuration['no-paths']){return'';}if(!$this->paths){$this->paths=new
stdClass;$this->paths->url=(object)array('root'=>aitUrl('elements',"/{$this->id}"),'css'=>aitUrl('elements',"/{$this->id}/design/css"),'js'=>aitUrl('elements',"/{$this->id}/design/js"),'img'=>aitUrl('elements',"/{$this->id}/design/img"));$this->paths->dir=(object)array('root'=>aitPath('elements',"/{$this->id}"),'css'=>aitPath('elements',"/{$this->id}/design/css"),'js'=>aitPath('elements',"/{$this->id}/design/js"),'img'=>aitPath('elements',"/{$this->id}/design/img"));}return$this->paths;}function
getOption(){if($this->optionsObject===null){$this->optionsObject=json_decode(json_encode($this->options));}return$this->optionsObject;}function
getOptions(){return$this->options;}function
getOptionsDefaults(){return$this->optionsDefaults;}function
setOptionsControlsGroup(AitOptionsControlsGroup$optionsControlsGroup){$this->optionsControlsGroup=$optionsControlsGroup;}function
getOptionsControlsGroup(){return$this->optionsControlsGroup;}function
getInternalId(){return$this->internalId;}function
getCacheKey(){return$this->getHtmlId().$this->oid;}function
getJsObjectName(){return
get_class($this).$this->instanceNumber;}function
getJsObject(){$o=array('defaults'=>$this->optionsDefaults,'current'=>$this->options,'paths'=>$this->getPaths());$var='var '.$this->getJsObjectName()." = ".json_encode($o).';';return$var;}function
getTemplate(){if(is_null($this->template)){if(isset($this->options['@template'])and$this->options['@template']!='default'){$base=basename($this->templateName,'.latte');$template=$base."-{$this->options['@template']}.latte";$f=aitPath('elements',"/{$this->id}/{$template}");if($f===false)$this->templateName=$template;}$this->template=aitPath('elements',"/{$this->id}/{$this->templateName}");}return$this->template;}function
getBaseStyleUrl(){if(isset($this->configuration['no-base-style'])and$this->configuration['no-base-style'])return'';return
aitUrl('elements',"/{$this->id}/design/css/base-style.css");}function
getStyleLessFile(){if(is_null($this->style)){$this->style=aitPath('elements',"/{$this->id}/design/css/{$this->styleLessName}");}return$this->style;}function
getStyleLessFileContent(){$file=$this->getStyleLessFile();$content=$file?@file_get_contents($file):'';return$content;}function
getInlineStyle(){return$this->generateCss();}function
getStyleTag(){return'';}function
getAssets(){return$this->assets;}function
getFrontendAssets(){return
array('css'=>$this->assets['css'],'js'=>$this->assets['js']);}function
getAdminAssets(){return
array('css'=>$this->assets['admin-css'],'js'=>$this->assets['admin-js']);}function
getCpts(){return$this->cpts;}function
isCloneable(){return(!isset($this->configuration['cloneable'])or(isset($this->configuration['cloneable'])and$this->configuration['cloneable']!==false));}function
isSortable(){return(!isset($this->configuration['sortable'])or(isset($this->configuration['sortable'])and$this->configuration['sortable']!==false));}function
setUsed($used){$this->used=$used;}function
isUsed(){return$this->used;}function
isDisplay(){return(($this->hasOption('@display')and$this->option('@display'))or!$this->hasOption('@display'));}function
isDisabled(){return!$this->isEnabled();}function
isEnabled(){$return=true;if($this->config['@disabled']===false){if($this->hasAllCptsEnabled()){$return=true;}else{$return=false;}}else{$return=false;}return$return;}function
isColumnable(){return(!isset($this->configuration['columnable'])or(isset($this->configuration['columnable'])and$this->configuration['columnable']==TRUE));}function
isBetweenSidebars(){return$this->isBetweenSidebars;}function
hasOption($key){return
isset($this->options[$key]);}function
findOptionsContaining($string){$options=array();foreach($this->options
as$key=>$value){if(AitUtils::contains($key,$string)){$options[$key]=$value;}}return$options;}function
hasAllCptsEnabled(){$hasAll=true;if($this->hasCpts()){foreach($this->cpts
as$cpt=>$enabled){if($enabled==false){$hasAll=false;break;}}}return$hasAll;}function
hasCpts(){return!empty($this->cpts);}function
setInstanceNumber($number){$this->instanceNumber=$number;}function
setOptions($options){$this->options=$options;}function
setOid($oid){$this->oid=$oid;}function
setCpt($cptId){$this->cpts[$cptId]=true;}function
setPath($type,$kind,$path){$this->getPaths();if($this->paths){$this->paths->{$type}->{$kind}=$path;}}function
setBetweenSidebars($value){$this->isBetweenSidebars=$value;}protected
function
generateCss(){if(!empty($this->generatedCss)){return$this->generatedCss;}else{$content=$this->getStyleLessFileContent();$css=array('files'=>array(),'css'=>'');if($content){$css['css']=$this->compileLess($content,$this->getStyleLessFile());$css['files']=array_keys($this->lessCompiler->allParsedFiles());}$this->generatedCss=$css;return$css;}}function
createLessCompiler(){return
AitLessCompiler::create(array_map('dirname',aitGetPaths('elements',"/{$this->id}/design/css/{$this->styleLessName}",'path',true)),array_map('dirname',aitGetPaths('elements',"/{$this->id}/design/css/{$this->styleLessName}",'url',true)));}protected
function
compileLess($content,$file){$this->lessCompiler=$this->createLessCompiler();$vars=array();$vars['el']=$this->htmlId;foreach($this->getOptionsControlsGroup()->getSections()as$section){foreach($section->getOptionsControls()as$optionObject){if($optionObject->isLessVar()){$lessVar=$optionObject->getLessVar();if($lessVar){$vars+=$optionObject->getLessVar();}}}}$this->lessCompiler->resetVariables();$vars=apply_filters("ait-element-{$this->id}-less-variables",$vars,$this);$this->lessCompiler->setVariables($vars);$this->lessCompiler->allParsedFiles=array();$this->lessCompiler->addParsedFile($file);try{$css=$this->lessCompiler->compile($content);}catch(Exception$e){$css=sprintf("\n/* Error during parsing LESS file '%s'.\nMessage:\n %s */\n",$file,$e->getMessage());}return$css;}}class
AitElementsManager
extends
NObject{protected$prototypes=array();protected$assetsManager;protected$optionsControlsGroupFactory;function
__construct($fullConfigs,$defaults,AitAssetsManager$assetsManager,AitOptionsControlsGroupFactory$optionsControlsGroupFactory){$this->assetsManager=$assetsManager;$this->optionsControlsGroupFactory=$optionsControlsGroupFactory;$this->createPrototypes($fullConfigs,$defaults);add_action('init',array($this,'onInit'),11);}function
getPrototypes(){return$this->prototypes;}function
getPrototype($element){if(isset($this->prototypes[$element])){return$this->prototypes[$element];}return
false;}protected
function
createPrototypes($fullConfigs,$defaults){foreach($fullConfigs
as$i=>$elementsFullConfig){$elementId=$elementsFullConfig['@element'];$element=$this->createPrototype($elementId,$elementsFullConfig,$defaults[$i][$elementId]);if($element){$this->prototypes[$elementId]=$element;}}}function
createPrototype($elementId,$fullConfig,$defaults){$className='AitElement';$class=AitUtils::id2class($elementId,'Element');$classfile=aitPath('elements',"/{$elementId}/{$class}.php");if($classfile!==false){$className=$class;}if(isset($fullConfig['@configuration']['class'])and!empty($fullConfig['@configuration']['class'])){$className=$fullConfig['@configuration']['class'];}if(class_exists($className)){return
new$className($elementId,$fullConfig,$defaults);}else{return
null;}}function
createElementsFromOptions($list,$oid='',$onFrontend=false){$elements=array();foreach($list
as$i=>$elementOptions){$elId=key($elementOptions);if(!current_theme_supports("ait-element-{$elId}"))continue;try{$elements[$i]=$this->createElement($elId,$i,$oid,$elementOptions[$elId]);if($onFrontend){if($elements[$i]->isEnabled()and$elements[$i]->isDisplay()){$this->assetsManager->addAssets($elements[$i]->getFrontendAssets(),array('paths'=>$elements[$i]->getPaths()));}$this->assetsManager->addInlineStyleCallback(array(&$elements[$i],'getInlineStyle'));}}catch(Exception$e){}}return$elements;}function
onInit(){if(aitIsPluginActive('toolkit')){foreach($this->prototypes
as$id=>$element){foreach($element->getCpts()as$cptId=>$enabled){if(aitManager('cpts')->has($cptId)){$this->prototypes[$id]->setCpt($cptId);}}}}}function
createElement($id,$instanceNumber,$oid,$options){if(isset($this->prototypes[$id])){$element=unserialize(serialize($this->prototypes[$id]));}else{throw
new
Exception('Could not create element with id: '.$id);}$element->setInstanceNumber($instanceNumber);$element->setOid($oid);$element->setOptions($options);$optionsControlsGroupDefinition=array();$optionsControlsGroupDefinition['@reset']=true;$optionsControlsGroupDefinition['@options']=$element->getConfig('@options');$values=$element->getOptions();$defaultValues=$element->getOptionsDefaults();$optionsControlsGroup=$this->optionsControlsGroupFactory->createOptionsControlsGroup('elements',$id,$optionsControlsGroupDefinition,$values,$defaultValues,$instanceNumber);$element->setOptionsControlsGroup($optionsControlsGroup);return$element;}function
isElementSidebarsBoundary($elementId){return$elementId=='sidebars-boundary-start'||$elementId=='sidebars-boundary-end';}}abstract
class
AitFrontendAjax
extends
NObject{function
sendJson($data){wp_send_json_success($data);}function
sendErrorJson($data){wp_send_json_error($data);}}class
AitGoogleFonts{protected
static$fontsList=array();protected
static
function
loadFontsFromJson(){if(empty(self::$fontsList)){$content=@file_get_contents(aitPaths()->dir->fwConfig.'/google-fonts.json');if(!$content){return
array();}self::$fontsList=json_decode($content);}return
self::$fontsList->items;}static
function
getAll(){return
self::loadFontsFromJson();}static
function
getByFontFamily($family){$fonts=self::loadFontsFromJson();foreach($fonts
as$font){if($font->family==$family){return$font;}}return
false;}}class
AitLangs{protected
static$defaultLang;protected
static
function
_defaultLang(){if(!self::$defaultLang){self::$defaultLang=new
AitDefaultLanguage();}return
self::$defaultLang;}static
function
isEnabled(){global$polylang;$filtered=apply_filters('ait-langs-enabled',aitIsPluginActive('languages'));if($filtered===true
and!aitIsPluginActive('languages')){return
false;}else{return$filtered;}}static
function
getDefaultLocale(){if(!self::isEnabled())return
get_locale();$locale='';if(function_exists('aitLangsGetDefaultLanguage')){$locale=aitLangsGetDefaultLanguage('locale');}elseif(function_exists('pll_default_language')){$locale=pll_default_language('locale');}if(!$locale){return
get_locale();}return$locale;}static
function
getCurrentLocale(){return
get_locale();}static
function
getCurrentLanguageCode(){$locale=get_locale();if($locale=='zh_CN'){return'cn';}elseif($locale=='zh_TW'){return'tw';}elseif($locale=='pt_BR'){return'br';}else{$lang=self::getCurrentLang();if($lang){return$lang->slug;}return
substr($locale,0,2);}}static
function
getLocalesList(){$langs=self::getLanguagesList();$locales=array();foreach($langs
as$lang){$locales[]=$lang->locale;}return$locales;}static
function
getDefaultLang(){if(!self::isEnabled())return
self::_defaultLang();$lang=false;if(function_exists('aitLangsGetDefaultLanguage')){$lang=aitLangsGetDefaultLanguage();}else{global$polylang;if(isset($polylang->options['default_lang'])&&($default_lang=$polylang->model->get_language($polylang->options['default_lang']))){$lang=$default_lang;}}if(!$lang){$lang=self::_defaultLang();}return$lang;}static
function
getCurrentLang(){if(!self::isEnabled())return
self::_defaultLang();$lang=null;if(function_exists('aitLangsGetCurrentLanguage')){$lang=aitLangsGetCurrentLanguage();}else{global$polylang;if(isset($polylang->curlang)and$polylang->curlang){$lang=$polylang->curlang;}else{self::getDefaultLang();}}return$lang?$lang:self::getDefaultLang();}static
function
isUsedNowDefaultLocale(){return(self::getCurrentLocale()==self::getDefaultLocale());}static
function
isThisDefaultLocale($locale){return(self::getDefaultLocale()==$locale);}static
function
getLanguagesList(){global$polylang;if(self::isEnabled()and$polylang
and($list=$polylang->model->get_languages_list())){return$list;}return
array(self::_defaultLang());}static
function
getSwitcherLanguages(){global$polylang;if(!self::isEnabled()or!$polylang)return
array();if(function_exists('aitLangsGetCurrentLanguage')){return
pll_the_languages(array('raw'=>true,'new_structure'=>true));}else{$langs=pll_the_languages(array('raw'=>true,'show_flags'=>true));$langsObj=array();if(!empty($langs)){foreach($langs
as$lang){$langsObj[]=(object)array('id'=>$lang['id'],'slug'=>$lang['slug'],'name'=>$lang['name'],'url'=>$lang['url'],'flag'=>$lang['flag'],'flagUrl'=>'','isCurrent'=>$lang['current_lang'],'hasTranslation'=>!$lang['no_translation'],'htmlClass'=>implode(' ',$lang['classes']));}}return$langsObj;}}static
function
isFilteredOut($lang){if(!self::isEnabled())return
false;$post=get_post();static$_blog;if(!$_blog){$blogPageId=get_option('page_for_posts');if($blogPageId){$_blog=get_post($blogPageId);}}$slug='';if($post
and$_blog
and$post->ID==$_blog->ID){$slug=self::_getLangForFiltering();}elseif($post
and$post->post_status!='auto-draft'){$slug=self::getPostLang($post->ID)->slug;}elseif($post
and$post->post_status=='auto-draft'){$slug=self::getDefaultLang()->slug;}else{$slug=self::_getLangForFiltering();}return($slug
and$lang->slug!=$slug);}protected
static
function
_getLangForFiltering(){if(function_exists('aitLangsGetLangForFiltering')){$slug=aitLangsGetLangForFiltering();}else{$slug=get_user_meta(get_current_user_id(),'pll_filter_content',true);}return$slug;}static
function
getFilteringLangCode(){return
aitIsPluginActive('languages')?self::_getLangForFiltering():'';}static
function
getCurrentLocaleText($localesAndTexts,$defaultText=''){$currentLocale=self::getCurrentLocale();if(is_array($localesAndTexts)and
isset($localesAndTexts[$currentLocale])){return$localesAndTexts[$currentLocale];}elseif(is_array($localesAndTexts)and
isset($localesAndTexts['en_US'])){return$localesAndTexts['en_US'];}elseif(is_object($localesAndTexts)and
isset($localesAndTexts->{$currentLocale})){return$localesAndTexts->{$currentLocale};}elseif(is_object($localesAndTexts)and
isset($localesAndTexts->{'en_US'})){return$localesAndTexts->{'en_US'};}elseif(is_string($localesAndTexts)and!empty($localesAndTexts)){return$localesAndTexts;}else{return$defaultText;}}static
function
getDefaultLocaleText($localesAndTexts,$defaultText=''){$defaultLocale=self::getDefaultLocale();if(is_array($localesAndTexts)and
isset($localesAndTexts[$defaultLocale])){return$localesAndTexts[$defaultLocale];}elseif(is_array($localesAndTexts)and
isset($localesAndTexts['en_US'])){return$localesAndTexts['en_US'];}elseif(is_object($localesAndTexts)and
isset($localesAndTexts->{$defaultLocale})){return$localesAndTexts->{$defaultLocale};}elseif(is_object($localesAndTexts)and
isset($localesAndTexts->{'en_US'})){return$localesAndTexts->{'en_US'};}elseif(is_string($localesAndTexts)and!empty($localesAndTexts)){return$localesAndTexts;}else{return$defaultText;}}static
function
getPostLang($postId){if(!self::isEnabled())return
self::_defaultLang();if(function_exists('PLL')){if($lang=PLL()->model->post->get_language($postId)){return$lang;}}else{global$polylang;if(isset($polylang)and($lang=$polylang->model->get_post_language($postId))){return$lang;}}return
self::_defaultLang();}static
function
checkIfPostAndGetLang(){global$post;if($post){return
self::getPostLang($post->ID);}return
false;}static
function
htmlClass($locale=''){$class=array();$class[]=self::isEnabled()?' ait-langs-enabled ':'';$class[]=$locale?'ait-lang-'.$locale:'';$class[]=($locale
and$locale==self::getDefaultLocale())?'ait-lang-default':'';$class=apply_filters('ait-langs-html-class',$class);return
implode(' ',$class);}static
function
getGmapsLang(){$map=array('bg_BG'=>'bg','cs_CZ'=>'cs','de_DE'=>'de','el'=>'el','en_US'=>'en','en_CA'=>'en-ca','es_ES'=>'es','es_CL'=>'es-cl','es_AR'=>'es-ar','es_CL'=>'es-cl','es_CO'=>'es-co','es_GT'=>'es-gt','es_MX'=>'es-mx','es_PE'=>'es-pe','es_PR'=>'es-pr','es_VE'=>'es-ve','fi'=>'fi','fr_FR'=>'fr','hi_IN'=>'hi','hr'=>'hr','hu_HU'=>'hu','id_ID'=>'id','it_IT'=>'it','nl_NL'=>'nl','pl_PL'=>'pl','pt_BR'=>'pt-br','pt_PT'=>'pt-pt','ru_RU'=>'ru','sk_SK'=>'sk','sq'=>'sq','sv_SE'=>'sv','tr_TR'=>'tr','uk'=>'uk','zh_CN'=>'zh-cn','zh_TW'=>'zh-tw');$currentLocale=self::getCurrentLocale();if(isset($map[$currentLocale])){return$map[$currentLocale];}return'en';}}class
AitLessCompiler{protected
static$less;protected$cacheDir;protected$cacheUrl;protected$lessVariables=array();function
__construct($cacheDir,$cacheUrl){$this->cacheDir=$cacheDir;$this->cacheUrl=$cacheUrl;}function
compileFile($inputFile,$params){$less=self::create();$inputFileBasename=basename($inputFile,'.less');$v="-".AIT_THEME_VERSION;$oid=isset($params['oid'])?$params['oid']:'';$lang=isset($params['lang'])?"-{$params['lang']}":'';$globalOptionsVariables=$this->getLessVariables();$variables=$this->getLessVariables($oid);if($globalOptionsVariables===$variables){$oid='';}$outputFile="/{$inputFileBasename}{$v}{$oid}{$lang}.css";$cacheFile=$this->cacheDir."/.ht-{$inputFileBasename}{$v}{$oid}{$lang}.less-cache";if(file_exists($cacheFile)){$cache=unserialize(file_get_contents('safe://'.$cacheFile));}else{$cache=$inputFile;}if($lang){$variables['current-lang']=$params['lang'];}$less->setVariables($variables);$result=array('inputFile'=>$inputFile,'error'=>false,'errorMsg'=>'','embedCss'=>'','url'=>'','version'=>'','isEmpty'=>false);try{$newCache=$less->cachedCompile($cache,AIT_DEV);if(empty($newCache['compiled'])){$result['isEmpty']=true;return$result;}if(!is_array($cache)or$newCache["updated"]>$cache["updated"]){@file_put_contents('safe://'.$cacheFile,serialize($newCache));$css='';if(AIT_DEV){$css="/*\n";foreach($variables
as$var=>$value){$css.="@{$var}: {$value}\n";}$css.="*/\n\n";}$written=@file_put_contents('safe://'.$this->cacheDir.$outputFile,$css.$newCache['compiled']);if($written===false){$result['error']=true;$result['embedCss']=$newCache['compiled'];}else{$result['url']=$this->cacheUrl.$outputFile;$result['version']=$newCache["updated"];}}else{$result['url']=$this->cacheUrl.$outputFile;$result['version']=is_array($cache)?$cache['updated']:$newCache["updated"];}return$result;}catch(Exception$e){$result['error']=true;$result['embedCss']="\n\n/*  ==== LESS ERROR ==== */\nError in file '{$inputFile}'\n\n\n\n\n\n\n".$e->getMessage()."\n\n\n\n\n\n\n";$result['errorMsg']=$e->getMessage();return$result;}}function
compileString($string){$less=self::create();$less->setVariables($this->getLessVariables());$cacheFile=$this->cacheDir.sprintf("/custom-%s.css",md5($string));$result=array('error'=>false,'isEmpty'=>false,'css'=>'');if(!is_file($cacheFile)){try{$css=$less->compile($string,'custom-css');if(empty($css)){$result['isEmpty']=true;return$result;}$result['css']=$css;@file_put_contents('safe://'.$cacheFile,$css);return$result;}catch(Exception$e){$result['error']=true;$result['css']="\n\n/*  ==== LESS ERROR ==== */\n\n\n\n\n\n\n".$e->getMessage()."\n\n\n\n\n\n\n";return$result;}}else{$result['css']=file_get_contents('safe://'.$cacheFile);return$result;}}static
function
create($importDir=array(),$importUrl=array()){$hash=md5(implode('',$importDir).implode('',$importUrl));if(!isset(self::$less[$hash])){$less=new
AitLess;$less->importDir=!$importDir?aitGetPaths('css','','path'):$importDir;$less->importUrl=!$importUrl?aitGetPaths('css','','url'):$importUrl;$less->registerFunction('design-url',array(__CLASS__,'lessFnDesignUrl'));$less->registerFunction('img-url',array(__CLASS__,'lessFnImgUrl'));$less->registerFunction('fonts-url',array(__CLASS__,'lessFnFontsUrl'));$less->registerFunction('assets-url',array(__CLASS__,'lessFnAssetsUrl'));$less->setPreserveComments(false);if(!AIT_DEV){$formatter=new
AitLessFormatterCompressed;$less->setPreserveComments(false);$less->setFormatter($formatter);}do_action('ait-create-less-compiler',$less);self::$less[$hash]=$less;}return
self::$less[$hash];}protected
function
preprocessStyle($content){preg_match_all('#(?<=/\\*ait\.local\.begin\\*/).*?(?=/\\*ait\.local\.end\\*/)\\s*#s',$content,$matches);preg_match_all('#/\\*ait\.local\.begin\\*/.*?/\\*ait\.local\.end\\*/\\s*#s',$content,$matches2);if(isset($matches[0])){$content=str_replace($matches2[0],'',$content);return
array('main'=>$content,'local'=>implode("\n",$matches[0]));}}function
getLessVariables($oid=''){if(!isset($this->lessVariables[$oid])){$this->lessVariables[$oid]=$this->extractLessVariables($oid);}return$this->lessVariables[$oid];}protected
function
extractLessVariables($oid=''){$fullConfig=aitConfig()->getFullConfig();if(isset($fullConfig['theme']['administrator'])or
isset($fullConfig['theme']['adminBranding'])or
isset($fullConfig['elements'])){unset($fullConfig['theme']['administrator'],$fullConfig['theme']['adminBranding'],$fullConfig['elements']);}if($oid){$options=aitOptions()->getLocalOptions($oid);}else{$options=aitOptions()->getGlobalOptions();}$defaultOptions=aitConfig()->getDefaults();$variables=$this->getDefaultLessVars();$optionsControlsGroupFactory=AitTheme::getFactory('options-controls-group');foreach($fullConfig
as$configType=>$optionControlsGroupNames){foreach($optionControlsGroupNames
as$optionControlsGroupName=>$optionControlsGroupDefinition){if(isset($options[$configType][$optionControlsGroupName])){$optionsValues=$options[$configType][$optionControlsGroupName];}else{$optionsValues=array();}$defaultValues=$defaultOptions[$configType][$optionControlsGroupName];$optionsControlsGroup=$optionsControlsGroupFactory->createOptionsControlsGroup($configType,$optionControlsGroupName,$optionControlsGroupDefinition,$optionsValues,$defaultValues);foreach($optionsControlsGroup->getSections()as$section){foreach($section->getOptionsControls()as$optionControl){if($optionControl->isLessVar()){$var=$optionControl->getLessVar();if(is_array($var)){$variables+=$optionControl->getLessVar();}}}}}}return$variables;}function
getDefaultLessVars(){$p=aitPaths();$defaultLang=AitLangs::getDefaultLocale();return
array('themeUrl'=>"'{$p->url->theme}'",'imgUrl'=>"'{$p->url->img}'",'fontsUrl'=>"'{$p->url->fonts}'",'designUrl'=>"'{$p->url->theme}/design'",'assetsUrl'=>"'{$p->url->assets}'",'theme-url'=>"'{$p->url->theme}'",'img-url'=>"'{$p->url->img}'",'fonts-url'=>"'{$p->url->fonts}'",'design-url'=>"'{$p->url->theme}/design'",'assets-url'=>"'{$p->url->assets}'",'default-lang'=>"'{$defaultLang}'");}static
function
lessFnDesignUrl($arg){list($type,$delim,$values)=$arg;$values[0]=trim($values[0],'\\/');$url=aitUrl('theme',"/design/$values[0]");$values[0]=$url?$url:(aitPaths()->url->theme.'/design/'.$values[0]);return
array($type,$delim,$values);}static
function
lessFnImgUrl($arg){list($type,$delim,$values)=$arg;$values[0]=ltrim($values[0],'\\/');$url=aitUrl('img',"/$values[0]");$values[0]=$url?$url:(aitPaths()->url->img."/$values[0]");return
array($type,$delim,$values);}static
function
lessFnFontsUrl($arg){list($type,$delim,$values)=$arg;$values[0]=trim($values[0],'\\/');if(AitUtils::contains($values[0],'?#')){$file=strstr($values[0],'?#',true);$hash=strstr($values[0],'?#');}elseif(AitUtils::contains($values[0],'?')){$file=strstr($values[0],'?',true);$hash=strstr($values[0],'?');}elseif(AitUtils::contains($values[0],'#')){$file=strstr($values[0],'#',true);$hash=strstr($values[0],'#');}else{$file=$values[0];$hash='';}$url=aitUrl('fonts',"/{$file}");$values[0]=$url?($url.$hash):(aitPaths()->url->fonts."/$values[0]");return
array($type,$delim,$values);}static
function
lessFnAssetsUrl($arg){list($type,$delim,$values)=$arg;$values[0]=trim($values[0],'\\/');$url=aitUrl('assets',"/$values[0]");$values[0]=$url?$url:(aitPaths()->url->assets."/$values[0]");return
array($type,$delim,$values);}}class
AitMetaBox{protected$internalId;protected$id;protected$params;protected$metaKey;protected$controls;protected$metaboxControlKey='';protected$metaboxControlSubKey='';protected$storage=array();function
__construct($id,$internalId,$params){if(is_numeric($internalId))wp_die('ID of metabox is not set or is numeric - must be alpha numeric string.');$this->id=$id;$this->internalId=$internalId;$defaultParams=array('id'=>'','title'=>__('Custom Meta Box','ait-admin'),'metaKey'=>'','template'=>'','renderCallback'=>'','saveCallback'=>'','config'=>'','js'=>'','css'=>'','types'=>array('page'),'context'=>'advanced','priority'=>'default','args'=>array());$this->params=(object)array_merge($defaultParams,$params);$this->metaKey=!empty($this->params->metaKey)?$this->params->metaKey:"_{$this->internalId}";if(in_array('user',$params['types'])){add_action('show_user_profile',array($this,'renderControlsContent'));add_action('edit_user_profile',array($this,'renderControlsContent'));add_action('profile_update',array($this,'saveUser'));}else{add_action('add_meta_boxes',array($this,'init'));add_action('save_post',array($this,'save'),10,3);}}function
init(){$config=$this->getRawConfig();if(empty($config)){return;}foreach($this->params->types
as$type){add_meta_box($this->internalId.'-metabox',$this->params->title,array($this,'render'),$type,$this->params->context,$this->params->priority,$this->params->args);}}function
render($post,$metabox){if(!empty($this->params->css)and
file_exists($this->params->css)){?>
		<style>
			<?php echo
file_get_contents($this->css);?>
		</style>
		<?php
}if(!empty($this->params->js)and
file_exists($this->params->js)){?>
		<script>
			<?php echo
file_get_contents($this->params->js);?>
		</script>
		<?php
}if(!empty($this->params->template)and
file_exists($this->params->template)){$this->renderTemplateContent($post,$metabox);}elseif(!empty($this->params->renderCallback)and
is_callable($this->params->renderCallback)){call_user_func_array($this->params->renderCallback,array($post,$metabox,$this));}else{$this->renderControlsContent();}$this->nonceField();}function
renderTemplateContent($post,$metabox){require$this->params->template;$this->params->config='';}function
renderControlsContent(){try{if(!file_exists($this->params->config)){$f=str_replace(array('.php','.neon'),'.[php|neon]',$this->params->config);throw
new
Exception("File {$f} doesn't exist.");}$enabledLang=($this->id=='user-metabox'?'__return_true':'__return_false');echo'<div data-ait-metabox='.$this->metaKey.'>';add_filter('ait-langs-enabled',$enabledLang);AitOptionsControlsRenderer::create(array('configType'=>($this->id=='user-metabox'?'user-metabox':'metabox'),'adminPageSlug'=>$this->internalId,'fullConfig'=>$this->getFullConfig(),'defaults'=>$this->getConfigDefaults(),'options'=>$this->getOptions()))->render();remove_filter('ait-langs-enabled',$enabledLang);echo"</div>";}catch(Exception$e){echo"<strong style='color:red;'>[error]</strong> {$e->getMessage()}";}}function
getId(){return$this->id;}function
getInternalId(){return$this->internalId;}function
getPostMetaKey(){return$this->metaKey;}function
getRawConfig(){if(!isset($this->storage['raw-config']))$this->storage['raw-config']=AitConfig::loadRawConfig($this->params->config);return$this->storage['raw-config'];}protected
function
processConfig(){$c=array();$c['metabox'][$this->metaKey]['options']=$this->getRawConfig();if(isset($this->params->textDomain)){$c['metabox'][$this->metaKey]['text-domain']=$this->params->textDomain;}return
aitConfig()->processConfig($c,false,$this->metaKey,array($this->params->config));}function
getFullConfig(){if(!isset($this->storage['full-config'])){$r=$this->processConfig();$this->storage['full-config']=$r['full-config']['metabox'];}return$this->storage['full-config'];}function
getTranslatablesList(){if(!isset($this->storage['translatables-list'])){$r=$this->processConfig();$this->storage['translatables-list']=isset($r['translatables-list']['metabox'])?$r['translatables-list']['metabox']:array();}return$this->storage['translatables-list'];}function
getConfigDefaults(){if(!isset($this->storage['defaults'])){$r=$this->processConfig();$this->storage['defaults']=$r['defaults']['metabox'];}return$this->storage['defaults'];}function
getOptions(){return
array($this->metaKey=>$this->getPostMeta());}function
getPostMeta($id=0){$metadataType=AitUtils::startsWith($this->metaKey,'_user')?'usermeta':'postmeta';if(!$id){if($metadataType==='usermeta'){global$user_id;$id=$user_id;}else{$id=get_post()->ID;}}if(!isset($this->storage["{$metadataType}{$id}"])){$meta='';if($metadataType==='usermeta'){$meta=get_user_meta($id,$this->metaKey,true);}else{$meta=get_post_meta($id,$this->metaKey,true);}if($meta!==''){$this->storage["{$metadataType}{$id}"]=$meta;}else{$this->storage["{$metadataType}{$id}"]=array();}}return$this->storage["{$metadataType}{$id}"];}function
nonceField(){wp_nonce_field($this->internalId,$this->metaKey.'_nonce');}function
verifyNonce(){$nonce=isset($_POST[$this->metaKey.'_nonce'])?$_POST[$this->metaKey.'_nonce']:null;return
wp_verify_nonce($nonce,$this->internalId);}function
save($postId,$post,$update){if(!is_object($post)){$post=get_post();}$data=isset($_POST[$this->metaKey])?$_POST[$this->metaKey]:null;if(!empty($this->params->saveCallback)and
is_callable($this->params->saveCallback)){call_user_func_array($this->params->saveCallback,array($postId,$post,$this,$data,$update));}else{$realPostId=isset($_POST['post_ID'])?$_POST['post_ID']:null;if(defined('DOING_AUTOSAVE')AND
DOING_AUTOSAVE){return$postId;}if(!$this->verifyNonce()){return$postId;}if($_POST['post_type']=='page'){if(!current_user_can('edit_page',$postId))return$postId;}else{if(!current_user_can('edit_post',$postId)){return$postId;}}if(is_null($data)){delete_post_meta($postId,$this->metaKey);}else{update_post_meta($postId,$this->metaKey,$data);}return$postId;}}function
saveUser(){global$user_id;if(Aitlangs::isEnabled()){foreach(Aitlangs::getLanguagesList()as$language){update_user_meta($user_id,'description_'.$language->slug,$_POST[$this->metaKey]['biography'][$language->description]);}}else{update_user_meta($user_id,'description',$_POST[$this->metaKey]['biography'][get_locale()]);}$data=isset($_POST[$this->metaKey])?$_POST[$this->metaKey]:null;if(is_null($data))delete_user_meta($user_id,$this->metaKey,$data);else
update_user_meta($user_id,$this->metaKey,$data);}function
control($key,$subKey=null){$this->metaboxControlKey=$key;$this->metaboxControlSubKey=$subKey;}function
getHtmlId(){return$this->metaKey.$this->metaboxControlKey.$this->metaboxControlSubKey;}function
id(){echo' id="'.$this->getHtmlId().'"';}function
getHtmlName(){$n="{$this->metaKey}[{$this->metaboxControlKey}]";if($this->metaboxControlSubKey)$n.="[$this->metaboxControlSubKey]";return$n;}function
name(){echo' name="'.$this->getHtmlName().'"';}function
getValue($default=''){$v=$this->getPostMeta();if(isset($v[$this->metaboxControlKey]))return$v[$this->metaboxControlKey];return$default;}function
value($default=''){echo' value="'.$this->getValue($default,$escape).'"';}function
label($text='Label'){echo'<label for="'.$this->getHtmlId().'">'.esc_html($text).'</label>';}}class
AitOptions{protected$config;protected$options;protected$elementsPrototypes;protected$storage=array();protected
static$frontpage;function
__construct(AitConfig$config){$this->config=$config;$this->options=$config->getDefaults();self::$frontpage=(object)array('customFrontpage'=>get_option('show_on_front')=='page','blog'=>get_option('page_for_posts'));if(is_admin()){$this->registerValidation();}if(current_user_can('delete_posts')){add_action('delete_post',array(&$this,'deleteLocalOptionsOnPageDelete'),10);}add_action('pll_before_add_language',array($this,'onBeforeAddLanguage'),10,1);add_action('split_shared_term',array($this,'updateTermIdsOnSplitSharedTerm'),10,4);}function
updateTermIdsOnSplitSharedTerm($oldTermId,$newTermId,$termTaxonomyId,$taxonomy){$config=$this->config->getFullConfig();$register=$this->getLocalOptionsRegister();foreach($register
as$type=>$oids){foreach($oids
as$oid){$localOptions=$this->getLocalOptions($oid);$elements=&$localOptions['elements'];foreach($elements
as$elIndex=>$element){$elId=key($element);foreach($element[$elId]as$optionKey=>$optionVal){if($elConfig=$this->findElementInConfig($elId,$config['elements'])){foreach($elConfig['@options']as$sectionIndex=>$options){foreach($options
as$k=>$v){if($k!=='@section'and($v['type']==='categories'or$v['type']==='categories-featured')and$optionKey===$k
and!empty($optionVal)and$v['taxonomy']===AitUtils::stripPrefix($taxonomy)and$optionVal==$oldTermId){$elements[$elIndex][$elId][$optionKey]=$newTermId;update_option($this->getOptionKey('elements',$oid),$elements);}}}}}}}}}protected
function
findElementInConfig($elementId,$elements){foreach($elements
as$element){if($elementId===$element['@element']){return$element;}}return
array();}function
setElementsPrototypes($prototypes){$this->elementsPrototypes=$prototypes;}function
registerValidation(){$keys=$this->getOptionsKeys(AitConfig::getMainConfigTypes(),$this->getRequestedOid('get'));foreach($keys
as$key){add_filter("sanitize_option_{$key}",array($this,'validateOptions'),10,2);}}function
validateOptions($input,$optKey){return$input;}function
getOptionKey($type,$oid=''){$theme=AIT_CURRENT_THEME;return"_ait_{$theme}_{$type}_opts{$oid}";}function
getOptionsKeys($types,$oid=''){$return=array();foreach($types
as$type){$return[]=$this->getOptionKey($type,$oid);}return$return;}function
getLocalOptionsRegisterKey(){return'_ait_'.AIT_CURRENT_THEME.'_local_opts_register';}function
get($configType,$oid=null){$k=$configType.$oid;if(!isset($this->storage[$k])){$r=$this->getOptionsByType($configType,$oid);$this->storage[$k]=json_decode(json_encode($r));return$this->storage[$k];}else{return$this->storage[$k];}}function
getOptionsByType($configType,$oid=null){if($oid===null){$oid=$this->getOid();}$o=$this->getOptions($oid);if(isset($o[$configType])){return$o[$configType];}else{$k=implode(', ',array_keys($o));trigger_error("There is no config type '$configType' (".__METHOD__." method). There are only: $k ");return
array();}}function
getOptions($oid=null){if($oid){if(isset($this->storage["local$oid"])){return$this->storage["local$oid"];}$this->storage["local$oid"]=$this->getLocalOptions($oid);return$this->storage["local$oid"];}else{if(isset($this->storage['global'])){return$this->storage['global'];}$this->storage['global']=$this->getGlobalOptions();return$this->storage['global'];}}function
getGlobalOptions(){$theme=get_option($this->getOptionKey('theme'),array());if(!isset($this->options['theme'])){$this->options['theme']=array();}if(!empty($theme)){$this->options['theme']=$this->mergeConfigDefaultsAndOptions($this->options['theme'],$theme);}$layout=get_option($this->getOptionKey('layout'),array());if(!isset($this->options['layout'])){$this->options['layout']=array();}if(!empty($layout)){$this->options['layout']=$this->mergeConfigDefaultsAndOptions($this->options['layout'],$layout);}$elements=get_option($this->getOptionKey('elements'),null);if(!isset($this->options['elements'])){$this->options['elements']=array();}$fullConfig=$this->config->getFullConfig('elements');if($elements===null){$this->options['elements']=$this->getDefaultsOnlyOfUsedElements($fullConfig);}else{$this->options['elements']=$this->mergeElementsConfigDefaultsAndOptions($this->options['elements'],$elements,$fullConfig);}return$this->options;}function
getDefaultsOnlyOfUsedElements($fullConfig=null){if(isset($this->storage["getDefaultsOnlyOfUsedElements"]))return$this->storage["getDefaultsOnlyOfUsedElements"];if(!$fullConfig)$fullConfig=$this->config->getFullConfig('elements');$defaultsOfUsedElements=$this->config->getDefaults('elements');foreach($defaultsOfUsedElements
as$i=>$el){$elId=key($el);if(isset($fullConfig[$i])and$fullConfig[$i]['@element']==$elId
and!$fullConfig[$i]['@used']){unset($defaultsOfUsedElements[$i]);}}$this->storage["getDefaultsOnlyOfUsedElements"]=$defaultsOfUsedElements;return$this->storage["getDefaultsOnlyOfUsedElements"];}function
getLocalOptions($oid=null){if($oid===null){$oid=$this->getOid();}$localOptions=$globalOptions=$this->getOptions();$register=$this->getLocalOptionsRegister();if(!(in_array($oid,$register['pages'])or
in_array($oid,$register['special'])))return$localOptions;$layout=get_option($this->getOptionKey('layout',$oid),array());if(!empty($layout)){$localOptions['layout']=array_replace_recursive($globalOptions['layout'],$layout);}$elements=get_option($this->getOptionKey('elements',$oid),null);if($elements===null){$localOptions['elements']=$globalOptions['elements'];}else{if(!$elements)$elements=array();$localOptions['elements']=$this->mergeGlobalAndLocalElements($globalOptions['elements'],$elements);}return$localOptions;}function
hasCustomLocalOptions($oid){$register=$this->getLocalOptionsRegister();if(AitUtils::startsWith($oid,'_page_')){return
in_array($oid,$register['pages']);}else{return
in_array($oid,$register['special']);}}function
getLocalOptionsRegister($special=array(),$pages=array()){return
get_option($this->getLocalOptionsRegisterKey(),array('special'=>$special,'pages'=>$pages));}protected
function
mergeGlobalAndLocalElements($globalElements,$localElements){$u=$m=$missingGlobalElements=array();foreach($globalElements
as$i=>$el){$m[key($el)]=1;}foreach($localElements
as$i=>$el){$k=key($el);if(!isset($m[$k]))$missingGlobalElements[$k]=1;}$localElements=$this->handleMissingUnsortableElements($localElements);foreach($localElements
as$i=>$localEl){$localElId=key($localEl);foreach($globalElements
as$j=>$globalEl){$globalElId=key($globalEl);if($localElId==$globalElId){foreach($globalElements[$j][$globalElId]as$optKey=>$optVal){if(!isset($localElements[$i][$localElId][$optKey])){$localElements[$i][$localElId][$optKey]=$optVal;}}}}}foreach($localElements
as$i=>$localEl){$localElId=key($localEl);if(isset($missingGlobalElements[$localElId])and
isset($this->elementsPrototypes[$localElId])){foreach($this->elementsPrototypes[$localElId]->optionsDefaults
as$dOptKey=>$dOptVal){if(!isset($localElements[$i][$localElId][$dOptKey])){$localElements[$i][$localElId][$dOptKey]=$dOptVal;}}}}return$localElements;}protected
function
handleMissingUnsortableElements($localElements){$prototypes=aitManager('elements')->getPrototypes();$defaultUnsortablesFromConfig=$foundLocalUnsortables=array();foreach($prototypes
as$proto){if(!$proto->isSortable()){$defaultUnsortablesFromConfig[$proto->getId()]=$proto->getOptionsDefaults();}}$lastLocalUnsortableId=0;foreach($localElements
as$id=>$localEl){$localElId=key($localEl);if(isset($defaultUnsortablesFromConfig[$localElId])){$foundLocalUnsortables[$localElId]=$localEl[$localElId];$lastLocalUnsortableId=$id;}}$missingUnsortables=array_diff(array_keys($defaultUnsortablesFromConfig),array_keys($foundLocalUnsortables));$missingUnsortablesToInsert=array();foreach($missingUnsortables
as$missingUnsortableElementId){$missingUnsortablesToInsert['e'.uniqid()][$missingUnsortableElementId]=$defaultUnsortablesFromConfig[$missingUnsortableElementId];}NArrays::insertAfter($localElements,$lastLocalUnsortableId,$missingUnsortablesToInsert);return$localElements;}function
addLocalOptions($oid){$layout=$elements=$local=array();$local['layout']=$local['elements']=array();$layout=get_option($this->getOptionKey('layout'),array());$elements=get_option($this->getOptionKey('elements'),array());$fullConfigLayout=$this->config->getFullConfig('layout');foreach($fullConfigLayout
as$groupKey=>$groupData){foreach($groupData['@options']as$sectionIndex=>$section){unset($section['@section']);foreach($section
as$optionKey=>$optionDefinition){if(isset($layout[$groupKey][$optionKey])&&isset($optionDefinition['basic'])&&$optionDefinition['basic']){$local['layout'][$groupKey][$optionKey]=$layout[$groupKey][$optionKey];}}}}if(empty($local['layout'])){$local['layout']=$layout;}$fullConfigElements=$this->config->getFullConfig('elements');$basicOpts=array();foreach($fullConfigElements
as$i=>$el){foreach($el['@options']as$section){unset($section['@section']);foreach($section
as$optionKey=>$optionDefinition){if(isset($optionDefinition['basic'])&&$optionDefinition['basic']){$basicOpts[$el['@element']][$optionKey]=true;}}}}$index=null;foreach($elements
as$i=>$els){foreach($els
as$el=>$options){if($el=='content')$index=$i;if(isset($basicOpts[$el])){$basicElementOptions=$basicOpts[$el];foreach($options
as$key=>$val){if(isset($basicElementOptions[$key])){$local['elements'][$i][$el][$key]=$val;}}}if(!isset($local['elements'][$i][$el])){$local['elements'][$i][$el]=$elements[$i][$el];}}}$configTypes=array('layout','elements');foreach($this->getOptionsKeys($configTypes,$oid)as$key){delete_option($key);}$global=$this->getOptions();foreach($configTypes
as$type){if(empty($local[$type])){$local[$type]=$global[$type];}add_option($this->getOptionKey($type,$oid),$local[$type],'','no');}$register=$this->getLocalOptionsRegister();if(AitUtils::startsWith($oid,'_page_')){$register['pages'][]=$oid;}else{$register['special'][]=$oid;}update_option($this->getLocalOptionsRegisterKey(),$register);}function
deleteLocalOptions($oid){$this->deleteLocalOptionFromRegister($oid);foreach($this->getOptionsKeys(array('layout','elements'),$oid)as$key){delete_option($key);}}function
deleteLocalOptionFromRegister($oid){$register=$this->getLocalOptionsRegister();if(AitUtils::startsWith($oid,'_page_')){$i=array_search($oid,$register['pages']);if($i!==false)unset($register['pages'][$i]);}else{$i=array_search($oid,$register['special']);if($i!==false)unset($register['special'][$i]);}update_option($this->getLocalOptionsRegisterKey(),$register);}function
updateLocalOptionsRegister($oid){$register=$this->getLocalOptionsRegister();if(AitUtils::startsWith($oid,'_page_')){$register['pages'][]=$oid;$register['pages']=array_unique($register['pages']);}else{$register['special'][]=$oid;$register['special']=array_unique($register['special']);}update_option($this->getLocalOptionsRegisterKey(),$register);}function
pageForLocalOptionsIsAvailable($oid){if(AitUtils::startsWith($oid,'_page_')){$pid=(int)substr($oid,6);$post=get_post($pid);return
isset($post)&&$post->post_status!='trash';}else{$specialPages=$this->getSpecialCustomPages();return
isset($specialPages[$oid]);}}function
getFirstFoundLocalOptionsId(){$localOptionsRegister=$this->getLocalOptionsRegister();$specialCustomPages=$this->getSpecialCustomPages();if(isset($localOptionsRegister['special'])){foreach($localOptionsRegister['special']as$specialPage){if(isset($specialCustomPages[$specialPage]))return$specialPage;}}if(isset($localOptionsRegister['pages'])){foreach($localOptionsRegister['pages']as$page){if($this->pageForLocalOptionsIsAvailable($page))return$page;}}return
NULL;}function
resetAllOptions(){$old=get_option($this->getOptionKey('theme'),array());$defaults=$this->config->defaults;if(isset($old['administrator'])){$defaults['theme']['administrator']=$old['administrator'];}foreach(AitConfig::getMainConfigTypes()as$type){$key=$this->getOptionKey($type);update_option($key,$defaults[$type]);}}function
resetThemeOptions(){$old=get_option($this->getOptionKey('theme'),array());$defaults=$this->config->getDefaults('theme');if(isset($old['administrator'])){$defaults['administrator']=$old['administrator'];}update_option($this->getOptionKey('theme'),$defaults);}function
resetDefaultLayoutOptions(){$defaults=$this->config->extractDefaultsFromConfig($this->config->getRawConfig(),true);update_option($this->getOptionKey('layout'),$defaults['layout']);update_option($this->getOptionKey('elements'),$defaults['elements']);}function
resetOptionsGroup($configType,$groupKey,$oid){$old=get_option($this->getOptionKey($configType,$oid),array());$defaults=$this->config->extractDefaultsFromConfig($this->config->getRawConfig(),true);if($configType=='theme'or$configType=='layout'){if($groupKey
and
isset($defaults[$configType][$groupKey])){$old[$groupKey]=$defaults[$configType][$groupKey];}elseif(!$groupKey
and
isset($defaults[$configType])){$old=$defaults[$configType];}update_option($this->getOptionKey($configType,$oid),$old);}elseif($configType=='elements'){$idx=array();foreach($old
as$i=>$el){$idx[key($el)]=$i;}foreach($defaults[$configType]as$i=>$el){foreach($el
as$key=>$el){if($groupKey==$key
and!empty($idx)and
isset($old[$idx[$key]][$key])){$old[$idx[$key]][$key]=array_intersect_key($el,$old[$idx[$key]][$key]);update_option($this->getOptionKey($configType,$oid),$old);}}}}}function
importGlobalOptions($configType,$groupKey,$oid){$globalOld=get_option($this->getOptionKey($configType),array());$localOld=get_option($this->getOptionKey($configType,$oid),array());if($configType=='layout'){}elseif($configType=='elements'){$idx=array();foreach($globalOld
as$i=>$el){$idx[key($el)]=$i;}foreach($localOld
as$i=>$el){foreach($el
as$key=>$el){if($groupKey==$key
and
isset($globalOld[$idx[$key]])){$localOld[$i][$key]=array_intersect_key($globalOld[$idx[$key]][$key],$el);update_option($this->getOptionKey($configType,$oid),$localOld);}}}}}protected
static$specialPages;function
getSpecialCustomPages(){$pages=array();if(!empty(self::$specialPages)){return
self::$specialPages;}else{$blogPage=false;if(self::$frontpage->customFrontpage
and
self::$frontpage->blog){$blogPage=get_page(self::$frontpage->blog)->post_title;}$pages=array('_blog'=>array('label'=>$blogPage?sprintf(__('%s (blog)','ait-admin'),$blogPage):esc_html__('Homepage (blog)','ait-admin'),'with-id'=>false,'if'=>'is_home()'),'_404'=>array('label'=>esc_html__('404 page','ait-admin'),'with-id'=>false,'if'=>'is_404()'),'_search'=>array('label'=>esc_html__('Search page','ait-admin'),'with-id'=>false,'if'=>'is_search()'),'_archive'=>array('label'=>esc_html__('Archive pages','ait-admin'),'sub-label'=>esc_html__('Category, Taxonomy, Tag, Author, Date','ait-admin'),'with-id'=>false,'if'=>'is_archive()'),'_attachment'=>array('label'=>esc_html__('Attachment pages','ait-admin'),'with-id'=>false,'if'=>"is_attachment()"),'_post'=>array('label'=>esc_html__('Single post','ait-admin'),'with-id'=>false,'if'=>"is_singular('post')"));if(aitIsPluginActive('toolkit')){$cpts=aitManager('cpts')->getAll();foreach($cpts
as$cpt){if($cpt
instanceof
AitPublicCpt){$pages["_{$cpt->getId()}"]=array('label'=>$cpt->getLabels()->singular_name,'with-id'=>false,'if'=>"is_singular('{$cpt->getInternalId()}')");}}}if(AitWoocommerce::enabled()){$pages['_wc_product']=array('label'=>esc_html__('Single - WooCommerce Product','ait-admin'),'with-id'=>false,'if'=>"AitWoocommerce::currentPageIs('product')");$shop=AitWoocommerce::getPage('shop');if($shop){$pages['_wc_shop']=array('label'=>sprintf(__('%s - WooCommerce Shop Page','ait-admin'),$shop->post_title),'with-id'=>false,'if'=>"AitWoocommerce::currentPageIs('woocommerce')");}}self::$specialPages=apply_filters('ait-special-custom-pages',$pages);return
self::$specialPages;}}function
getFrontpage(){return
self::$frontpage;}function
isNormalPageOptions($oid){return
AitUtils::startsWith($oid,"_page_");}function
getOid(){$key='';if(!did_action('template_redirect')){$key=$this->getRequestedOid('post');if(!$key){$key=$this->getRequestedOid('get');}return$key;}$pages=$this->getSpecialCustomPages();if(isset($pages['_wc_shop'])){$shop=$pages['_wc_shop'];$product=$pages['_wc_product'];unset($pages['_wc_shop']);unset($pages['_wc_product']);$splitIndex=array_search('_404',array_keys($pages))+1;$pages=array_merge(array_slice($pages,0,$splitIndex),array('_wc_product'=>$product),array('_wc_shop'=>$shop),array_slice($pages,$splitIndex));}$pages['_page']=array('with-id'=>true,'if'=>'is_page()');foreach($pages
as$oid=>$values){$if=create_function('',"return {$values['if']};");if($if()){$key=$oid;$id=get_queried_object_id();if($id
and$values['with-id']){$key="{$key}_{$id}";}break;}}return$key;}function
isQueryForSpecialPage($oidsToCheck=array()){$pages=$this->getSpecialCustomPages();$oid=$this->getOid();if(empty($oidsToCheck)and
isset($pages[$oid])){return
true;}else{return
in_array($oid,$oidsToCheck);}}function
getRequestedOid($requestMethod='post'){$oid='';if($requestMethod=='post'){$oid=isset($_POST['oid'])?$_POST['oid']:'';}elseif($requestMethod=='get'){$oid=isset($_GET['oid'])?$_GET['oid']:'';}return
sanitize_key($oid);}function
mergeConfigDefaultsAndOptions($defaultValues,$currentValues){if(is_array($defaultValues)and
is_array($currentValues)){foreach($currentValues
as$key=>$value){if((isset($defaultValues[$key])and
is_numeric($key))or(!isset($defaultValues[$key])and
is_numeric($key))){$defaultValues=$currentValues;}elseif(isset($defaultValues[$key])){$defaultValues[$key]=$this->mergeConfigDefaultsAndOptions($defaultValues[$key],$value);}}}else{$defaultValues=$currentValues;}return$defaultValues;}function
mergeElementsConfigDefaultsAndOptions($defaultValues,$currentValues,$fullConfig){if(is_array($defaultValues)and
is_array($currentValues)){foreach($defaultValues
as$key=>$value){foreach($currentValues
as$currentKey=>$currentValue){if(key($currentValue)==key($value)){$currentValues[$currentKey]=$this->mergeConfigDefaultsAndOptions($defaultValues[$key],$currentValues[$currentKey]);continue
2;}}if(isset($fullConfig[$key])and$fullConfig[$key]['@used']){$currentValues[]=$value;}}}else{$currentValues=$defaultValues;}return$currentValues;}function
deleteLocalOptionsOnPageDelete($postId){$oid='_page_'.$postId;if($this->hasCustomLocalOptions($oid)){$this->deleteLocalOptions($oid);}}function
onBeforeAddLanguage($args){$locale=$args['locale'];$defaultLocale=AitLangs::getDefaultLocale();$options=$this->getOptions();foreach($options
as$configType=>&$configOptions){$key=$this->getOptionKey($configType);$this->addOptionsTranslationsForLocale($configOptions,$defaultLocale,$locale);update_option($key,$configOptions);}$register=$this->getLocalOptionsRegister();foreach($register['special']as$oid){$options=$this->getOptions($oid);unset($options['theme']);foreach($options
as$configType=>&$configOptions){$key=$this->getOptionKey($configType,$oid);$this->addOptionsTranslationsForLocale($configOptions,$defaultLocale,$locale);update_option($key,$configOptions);}}foreach($register['pages']as$oid){$postId=(int)substr($oid,6);$defaultLocale=AitLangs::getPostLang($postId)->locale;if($this->hasCustomLocalOptions($oid)){$options=$this->getOptions($oid);unset($options['theme']);foreach($options
as$configType=>&$configOptions){$key=$this->getOptionKey($configType,$oid);$this->addOptionsTranslationsForLocale($configOptions,$defaultLocale,$locale);update_option($key,$configOptions);}}}}private
function
addOptionsTranslationsForLocale(&$options,$defaultLocale,$locale){foreach($options
as$key=>&$subOptions){if(is_array($subOptions)){foreach($subOptions
as$subKey=>&$subOption){if(is_array($subOption)){$this->addOptionsTranslationsForLocale($subOptions,$defaultLocale,$locale);}else
if($defaultLocale==$subKey){$defaultLocaleOptionTranslation=$subOption;$optionTranslations=&$subOptions;$optionTranslations[$locale]=$defaultLocaleOptionTranslation;break;}}}}}}class
AitSidebarsManager{protected$sidebars=array();protected$widgetAreas=array();protected$dynamicSidebars=array();protected$cacheWidgetOutput=0;function
__construct($areasFromThemeConfiguration=array(),$areasFromOptions=array(),$cacheWidgetOutput=0){$this->cacheWidgetOutput=$cacheWidgetOutput;$areas=$areasFromThemeConfiguration;if(isset($areasFromOptions['@widgetAreasAndSidebars'])and!empty($areasFromOptions['@widgetAreasAndSidebars'])){$areas=$areasFromOptions['@widgetAreasAndSidebars'];}$this->prepare($areas);}function
getDynamicSidebars(){return$this->dynamicSidebars;}function
getSidebars(){return$this->sidebars;}function
getWidgetAreas(){return$this->widgetAreas;}function
registerSidebars(){add_action('widgets_init',array($this,'initSidebars'),2);}function
registerWidgets(){remove_filter('widget_title','wptexturize');remove_filter('widget_title','convert_chars');remove_filter('widget_title','esc_html');if($this->cacheWidgetOutput!=0)add_filter('widget_display_callback',array($this,'cacheWidgetOutput'),10,3);add_filter('widget_title',array($this,'widgetTitle'),3,1999);add_action('widgets_init',array($this,'initWidgets'),4);}protected
function
prepare($areas){$defaults=array('description'=>'','before_widget'=>'<div id="%1$s" class="widget-container %2$s"><div class="widget">','after_widget'=>"</div></div></div>",'before_title'=>'<div class="widget-title">','after_title'=>'</div><div class="widget-content">');$defaults=apply_filters('ait-widget-areas-default-parmas',$defaults);$i=0;foreach($areas
as$group=>$area){foreach($area
as$i=>$params){$realId='__'.trim("{$group}-{$i}",'@');$p=array_diff_assoc($params,$defaults);if($group=='@sidebar'){$this->sidebars[$realId]=$p;}else{$this->widgetAreas[$group][$realId]=$p;}$params['name']=AitLangs::getCurrentLocaleText($params['name'],'[not translated sidebar name]');$s=array_merge(array('id'=>$realId),$defaults,$params);$this->dynamicSidebars[]=$s;}}}function
initSidebars(){foreach($this->dynamicSidebars
as$sidebar){register_sidebar($sidebar);}}function
initWidgets(){$config=AitConfig::loadRawConfig(aitPath('config','/widgets.neon'),'/widgets.neon');foreach($config
as$widget){$widgetClass=AitUtils::id2class($widget,'Widget');if(class_exists($widgetClass))register_widget($widgetClass);else
trigger_error("Widget class {$widgetClass} doesn't exist.",E_USER_WARNING);}}function
widgetTitle($title,$instance=array(),$idBase=''){if(isset($instance['ait-dropdown-wc-cart-widget'])and$instance['ait-dropdown-wc-cart-widget'])return'';$hasTitle=(trim(str_replace('&nbsp;','',$title))!=='');if($hasTitle){$title=esc_html(convert_chars(wptexturize($title)));if($idBase==='rss'){return$title;}else{return"<h3>{$title}</h3>";}}return'<!-- no widget title -->';}function
cacheWidgetOutput($instance,$widgetObject,$args){$timerStart=microtime(true);$key='widget-'.md5(serialize(array($instance,$args)));$cachedWidget=get_transient($key);$ttl=$this->cacheWidgetOutput;if(empty($cachedWidget)){ob_start();$widgetObject->widget($args,$instance);$cachedWidget=ob_get_clean();set_transient($key,$cachedWidget,$ttl);}printf("%s <!-- From widget cache in %s seconds -->",$cachedWidget,number_format(microtime(true)-$timerStart,5));return
false;}}final
class
AitTheme
extends
NObject{private
static$alreadyRan=false;protected
static$configuration=array('frontend-ajax'=>array(),'menus'=>array(),'theme-support'=>array('html5'=>array('search-form','comment-form','comment-list'),'wplatte'),'ait-theme-support'=>array(),'sidebars'=>array(),'page-post-metaboxes'=>array(),'builtin-assets'=>array(),'assets'=>array(),'plugins'=>array(),'editor-style'=>true,'widget-output-cache'=>0);protected
static$config;protected
static$options;protected
static$managers=array();protected
static$factories=array();protected
static$pagePostMetaboxes=array();function
__construct(){throw
new
LogicException(__CLASS__.' is a static class. Can not be instantiate.');}static
function
getConfiguration($key=''){if($key){return
self::$configuration[$key];}return
self::$configuration;}static
function
getConfig(){return
self::$config;}static
function
getOptions(){return
self::$options;}static
function
getManager($manager){if(isset(self::$managers[$manager])){return
self::$managers[$manager];}else{trigger_error(sprintf("Manager '{$manager}' does not exist. Available managers are: %s",array_keys(self::$managers)),E_USER_WARNING);}return
false;}static
function
getFactory($factory){if(isset(self::$factories[$factory]))return
self::$factories[$factory];else
trigger_error(sprintf("Factory '{$factory}' does not exist. Available factories are: %s",array_keys(self::$factories)),E_USER_WARNING);return
false;}static
function
run($configurationFilepath=''){if(self::$alreadyRan)return;self::loadTextdomain();if(!is_array($configurationFilepath)){$configuration=include$configurationFilepath;}else{$configuration=$configurationFilepath;}$configuration=apply_filters('ait-theme-configuration',$configuration);self::prepareConfiguration($configuration);do_action('ait-theme-run');self::addThemeSupport();self::createFactories();self::$config=new
AitConfig();self::$options=new
AitOptions(self::$config,self::getFactory('options-controls-group'));self::createManagers();self::$options->setElementsPrototypes(self::getManager('elements')->getPrototypes());AitUpgrader::run();if(is_admin())AitAdmin::run();add_action('after_setup_theme',array(__CLASS__,'onAfterSetupTheme'));self::$alreadyRan=true;}static
function
prepareConfiguration($configuration){$assets=array();if(!is_admin()){$assetsFilePath=aitPath('config','/builtin-assets.php');if($assetsFilePath===false){$assets=require
aitPaths()->dir->fwConfig.'/builtin-assets.php';}else{$assets=require$assetsFilePath;}self::$configuration['builtin-assets']=apply_filters('ait-builtin-assets',(array)$assets);}self::$configuration=array_replace_recursive(self::$configuration,$configuration);self::$configuration['ait-theme-support']['elements'][]='content';self::$configuration['ait-theme-support']['elements'][]='comments';self::$configuration['ait-theme-support']['elements'][]='sidebars-boundary-start';self::$configuration['ait-theme-support']['elements'][]='sidebars-boundary-end';self::preparePluginsConfigration();}static
function
onAfterSetupTheme(){if(self::$configuration['editor-style']===true){add_editor_style('design/css/editor-style.css');}elseif(is_string(self::$configuration['editor-style'])){add_editor_style(trim(self::$configuration['editor-style'],'/'));}if(is_user_logged_in())AitAdminBar::register();AitWoocommerce::init();AitWpOverrides::init();AitWpExtensions::register();self::getManager('sidebars')->registerSidebars();self::getManager('sidebars')->registerWidgets();self::registerMenus();$megamenu=aitOptions()->get('theme')->megamenu;if($megamenu->enabled
and
class_exists('AitMenu')and
current_theme_supports('ait-megamenu')){AitMenu::init();}self::overrideCptsMetaboxesConfigs();self::tgmpa();self::addPageOrPostMetaboxes();if(AitUtils::isAjax()){self::registerFrontendAjax();}add_action('init',array(__CLASS__,'onInit'));}static
function
onInit(){add_action('wp_enqueue_scripts',array(__CLASS__,'onEnqueueScriptsAndStyles'));add_action('admin_enqueue_scripts',array(__CLASS__,'onEnqueueAdminScriptsAndStyles'));add_action('wp',array(__CLASS__,'initWpLatte'),1999);}static
function
initWpLatte(){if(!is_admin()and!AitUtils::isAjax()){AitWpLatte::init();}}static
function
onEnqueueScriptsAndStyles(){self::getManager('assets')->enqueueFrontendAssets();}static
function
onEnqueueAdminScriptsAndStyles(){self::getManager('assets')->enqueueAdminAssets();}static
function
createFactories(){self::$factories['option-control']=new
AitOptionControlFactory();self::$factories['options-controls-group']=new
AitOptionsControlsGroupFactory(self::$factories['option-control']);}static
function
createManagers(){self::$managers['assets']=new
AitAssetsManager(self::$configuration['builtin-assets'],self::$configuration['assets']);if(aitIsPluginActive('toolkit')){self::$managers['cpts']=AitToolkit::getManager('cpts');}self::$managers['elements']=new
AitElementsManager(self::$config->getFullConfig('elements'),self::$config->getDefaults('elements'),self::$managers['assets'],self::$factories['options-controls-group']);self::$managers['sidebars']=new
AitSidebarsManager(self::$configuration['sidebars'],self::$options->getOptionsByType('theme'),self::$configuration['widget-output-cache']);}static
function
loadTextdomain(){$isAdmin=false;if(defined('PLL_ADMIN')and
PLL_ADMIN){$isAdmin=true;}elseif(is_admin()){$isAdmin=true;}$isFrontendAjax=false;if(defined('PLL_AJAX_ON_FRONT')and
PLL_AJAX_ON_FRONT){$isFrontendAjax=true;}elseif(AitUtils::isAjax()and!AitUtils::contains(wp_get_referer(),'/wp-admin/')){$isFrontendAjax=true;}if(!$isAdmin
or$isFrontendAjax){$maybeFilteredLocale=apply_filters('theme_locale',get_locale(),'ait');if(!$maybeFilteredLocale){global$locale;$maybeFilteredLocale=$locale;}load_textdomain('ait',aitPath('languages',"/{$maybeFilteredLocale}.mo"));}if($isAdmin
and!$isFrontendAjax){$maybeFilteredLocale=apply_filters('theme_locale',get_locale(),'ait-admin');if(!$maybeFilteredLocale){global$locale;$maybeFilteredLocale=$locale;}load_textdomain('ait-admin',aitPath('languages',"/admin-{$maybeFilteredLocale}.mo"));}}static
function
registerMenus(){if(!empty(self::$configuration['menus']))register_nav_menus(self::$configuration['menus']);}static
function
addThemeSupport(){foreach(self::$configuration['theme-support']as$name=>$args){if(!is_string($name)){add_theme_support($args);}else{add_theme_support($name,$args);}}foreach(self::$configuration['ait-theme-support']as$name=>$args){if(is_int($name)){$feature=$args;$feature=AitUtils::addPrefix($feature,'','ait-');add_theme_support($feature);}else{if(is_array($args)){if($name==='elements'or$name==='cpts'){$args=array_unique($args);}foreach($args
as$key=>$value){if($name==='cpts'){add_theme_support("ait-cpt-{$value}");}elseif($name==='elements'){add_theme_support("ait-element-{$value}");}else{$feature=AitUtils::addPrefix($name,'','ait-');add_theme_support($feature,$args);break;}}}}}}protected
static
function
preparePluginsConfigration(){$pluginList=require
aitPaths()->dir->fwConfig.'/plugins.php';self::$configuration['plugins']=apply_filters('ait-builtin-plugin-list',array_replace_recursive($pluginList,self::$configuration['plugins']));foreach(self::$configuration['plugins']as$slug=>$plugin){if($slug==='revslider'){$revsliderInstalled=file_exists(WP_PLUGIN_DIR."/revslider/");$aitFileDoesNotExist=!file_exists(WP_PLUGIN_DIR."/revslider/ait-revslider.php");if($revsliderInstalled
and$aitFileDoesNotExist)continue;}self::$configuration['plugins'][$slug]['slug']=$slug;if(isset($plugin['source'])and
AitUtils::startsWith($plugin['source'],'/plugins/')){self::$configuration['plugins'][$slug]['source']=aitPaths()->dir->ait.$plugin['source'];}add_theme_support($slug.'-plugin');}}protected
static
function
tgmpa(){require_once
aitPaths()->dir->libs.'/class-tgm-plugin-activation.php';if(is_admin()and!AitUtils::isAjax()){add_action('tgmpa_register',array(__CLASS__,'tgmpaRegisterPlugins'));}}static
function
tgmpaRegisterPlugins(){$config=array('id'=>'ait-tgmpa','parent_slug'=>'plugins.php','menu'=>'install-required-plugins','is_automatic'=>true,'strings'=>array('menu_title'=>__('Install Required Plugins','ait-admin')));if(!empty(self::$configuration['plugins'])){tgmpa(self::$configuration['plugins'],$config);}}static
function
addPageOrPostMetaboxes(){foreach(self::$configuration['page-post-metaboxes']as$id=>$params){self::addPageOrPostMetabox($id,$params);}}static
function
addPageOrPostMetabox($id,$params){$filterTypes=create_function('$type',"return (\$type == 'page' or \$type == 'post' or \$type == 'user') ? true : false;");if(isset($params['id']))unset($params['id']);if(isset($params['types'])){$params['types']=array_filter($params['types'],$filterTypes);}if(isset($params['config'])){if(!AitUtils::endsWith($params['config'],'metabox.neon')){$config=aitPath('config',"/metaboxes/{$params['config']}.metabox.neon");$params['config']=$config;}}if(in_array('user',$params['types'])){$defaults=array('metaKey'=>"_user_$id");}else{$defaults=array('metaKey'=>"_post_$id");}$internalId="ait-$id";self::$pagePostMetaboxes[$id]=new
AitMetaBox($id,$internalId,array_merge($defaults,$params));}static
function
registerFrontendAjax(){$ajaxActions=array();foreach(self::$configuration['frontend-ajax']as$classId){$class=AitUtils::id2class($classId,'Ajax');$instance=new$class();$methods=get_class_methods($class);$r=new
NClassReflection($class);foreach($methods
as$method){if($r->getMethod($method)->getAnnotation('WpAjax')===true){$ajaxActions["{$classId}:{$method}"]="{$classId}:{$method}";add_action("wp_ajax_{$classId}:{$method}",array($instance,$method));add_action("wp_ajax_nopriv_{$classId}:{$method}",array($instance,$method));}}}self::getManager('assets')->setAjaxActions($ajaxActions);}private
static
function
overrideCptsMetaboxesConfigs(){add_filter('ait-cpt-metabox-config-path',array(__CLASS__,'overrideCptMetaboxConfig'),10,2);}static
function
overrideCptMetaboxConfig($path,$filename){$paths=aitPaths();if(AitUtils::endsWith($filename,'.php')){$basename=basename($filename,'.php');if(file_exists("{$paths->dir->cptsMetaboxesConfig}/{$basename}.php")){$path="{$paths->dir->cptsMetaboxesConfig}/{$basename}.php";}elseif(file_exists("{$paths->dir->cptsMetaboxesConfig}/{$basename}.neon")){$path="{$paths->dir->cptsMetaboxesConfig}/{$basename}.neon";}}else{if(file_exists("{$paths->dir->cptsMetaboxesConfig}/{$filename}")){$path="{$paths->dir->cptsMetaboxesConfig}/{$filename}";}}return$path;}}class
AitUpgrader{protected
static$skeletonVersionOptionKey;protected
static$themeVersionOptionKey;protected
static$parentThemeVersionOptionKey;protected$errors=array();static
function
run(){add_action('admin_init',array(__CLASS__,'maybeDoUpgradeOnAdminInit'));add_action('ait-after-import',array(__CLASS__,'maybeDoUpgradeAfterImport'),10,2);add_action('ait-theme-activation',array(__CLASS__,'addVersionsOnThemeActivation'));}protected
static
function
setKeys(){$parentTheme=wp_get_theme()->parent();$pt=$parentTheme?$parentTheme->template:AIT_CURRENT_THEME;$oldSkeletonV=get_option("_ait_skeleton_version",'');if($oldSkeletonV!==''){add_option("_ait_".AIT_CURRENT_THEME."_skeleton_version",$oldSkeletonV);delete_option("_ait_skeleton_version");}$oldThemeV=get_option("_ait_theme_version",'');if($oldThemeV!==''){add_option("_ait_".AIT_CURRENT_THEME."_theme_version",$oldThemeV);delete_option("_ait_theme_version");}self::$skeletonVersionOptionKey="_ait_".AIT_CURRENT_THEME."_skeleton_version";self::$parentThemeVersionOptionKey="_ait_".$pt."_parent_theme_version";self::$themeVersionOptionKey="_ait_".AIT_CURRENT_THEME."_theme_version";}static
function
maybeDoUpgradeOnAdminInit(){if(AitUtils::isAjax()or
defined('IFRAME_REQUEST'))return;$upgrader=new
self;self::setKeys();$upgrader->maybeDoUpgrade();}static
function
addVersionsOnThemeActivation(){self::setKeys();if(get_option(self::$skeletonVersionOptionKey,'')===''){add_option(self::$skeletonVersionOptionKey,AIT_SKELETON_VERSION);}if(get_option(self::$themeVersionOptionKey,'')===''){add_option(self::$themeVersionOptionKey,AIT_THEME_VERSION);}if(get_option(self::$parentThemeVersionOptionKey,'')===''){$parentTheme=wp_get_theme()->parent();$v=$parentTheme?$parentTheme->version:AIT_THEME_VERSION;add_option(self::$parentThemeVersionOptionKey,$v);}}function
maybeDoUpgrade(){if(version_compare($this->getSkeletonVersion(),AIT_SKELETON_VERSION,'<')){$this->skeletonUpgrade();if($this->noErrors()){$this->updateSkeletonVersionToNewest();AitCache::clean();}}$parentTheme=wp_get_theme()->parent();$v=$parentTheme?$parentTheme->version:AIT_THEME_VERSION;if(!$this->parentThemeVersionOptionKeyExists()){$this->themeUpgrade();if($this->noErrors()){$this->updateParentThemeVersionToNewest();$this->updateThemeVersionToNewest();AitCache::clean();}}elseif(version_compare($this->getParentThemeVersion(),$v,'<')){$this->themeUpgrade();if($this->noErrors()){$this->updateParentThemeVersionToNewest();$this->updateThemeVersionToNewest();AitCache::clean();}}if(is_child_theme()and
version_compare($this->getThemeVersion(),AIT_THEME_VERSION,'<')){$this->themeUpgrade();if($this->noErrors()){$this->updateThemeVersionToNewest();AitCache::clean();}}}function
skeletonUpgrade(){if(version_compare(self::getSkeletonVersion(),'2.1.4','<')){$upgrade=new
AitSkeletonUpgrade21;$this->errors=$upgrade->execute();}if(version_compare(self::getSkeletonVersion(),'2.2.3','<')){$upgrade=new
AitSkeletonUpgrade223;$errors=$upgrade->execute();$this->errors=array_merge($this->errors,$errors);self::$skeletonVersionOptionKey="_ait_".AIT_CURRENT_THEME."_skeleton_version";self::$themeVersionOptionKey="_ait_".AIT_CURRENT_THEME."_theme_version";}if(version_compare(self::getSkeletonVersion(),'2.8.12','<')){$upgrade=new
AitSkeletonUpgrade2812;$this->errors=$upgrade->execute();}if(version_compare(self::getSkeletonVersion(),'2.9.8','<')){$upgrade=new
AitSkeletonUpgrade298;$this->errors=$upgrade->execute();}if(version_compare(self::getSkeletonVersion(),'2.9.9','<')){$upgrade=new
AitSkeletonUpgrade299;$this->errors=$upgrade->execute();}if(version_compare(self::getSkeletonVersion(),'2.9.13','<')){$upgrade=new
AitSkeletonUpgrade2913;$this->errors=$upgrade->execute();}do_action('ait-skeleton-upgrade',$this);$this->addAdminErrorNotices();}function
themeUpgrade(){do_action('ait-theme-upgrade',$this);$this->addAdminErrorNotices();}protected
function
noErrors(){return
empty($this->errors);}static
function
maybeDoUpgradeAfterImport($whatToImport,$sendResults){if($whatToImport==='demo-content'){$upgrade=new
AitSkeletonUpgrade298;if($upgrade->needsUpgrade()){$upgrade->execute();}$upgrade=new
AitSkeletonUpgrade299;if($upgrade->needsUpgrade()){$upgrade->execute();}$upgrade=new
AitSkeletonUpgrade2913;$upgrade->execute();}}function
addErrors($maybeErrors=array()){if(is_callable($maybeErrors)){$errors=$maybeErrors();}else{$errors=$maybeErrors;}$this->errors=array_merge($this->errors,$errors);}protected
function
addAdminErrorNotices(){if(!empty($this->errors)){add_action('admin_notices',array($this,'adminErrorNotices'));}}function
adminErrorNotices(){echo'<div class="error">';foreach($this->errors
as$error){echo"<p>";echo
esc_html($error);echo"</p>";}echo'</div>';}function
getSkeletonVersion(){return
get_option(self::$skeletonVersionOptionKey,AIT_SKELETON_VERSION);}function
getParentThemeVersion(){$parentTheme=wp_get_theme()->parent();if($parentTheme){if($this->parentThemeVersionOptionKeyExists()){return
get_option(self::$parentThemeVersionOptionKey);}else{return
defined('AIT_UPGRADER_PREVIOUS_THEME_VERSION')?AIT_UPGRADER_PREVIOUS_THEME_VERSION:'1.0';}}else{return$this->getThemeVersion();}}function
getThemeVersion(){return
get_option(self::$themeVersionOptionKey,AIT_THEME_VERSION);}function
updateSkeletonVersionToNewest(){update_option(self::$skeletonVersionOptionKey,AIT_SKELETON_VERSION);}function
updateParentThemeVersionToNewest(){$parentTheme=wp_get_theme()->parent();$v=$parentTheme?$parentTheme->version:AIT_THEME_VERSION;update_option(self::$parentThemeVersionOptionKey,$v);}function
updateThemeVersionToNewest(){update_option(self::$themeVersionOptionKey,AIT_THEME_VERSION);}function
parentThemeVersionOptionKeyExists(){return(get_option(self::$parentThemeVersionOptionKey,'')!=='');}}class
AitUtils{function
__construct(){throw
new
LogicException(__CLASS__.' is a static class. Can not be instantiate.');}static
function
isAjax(){return(defined('DOING_AJAX')and
DOING_AJAX===true);}static
function
isAitServer($server=''){if(!$server)return
defined('AIT_SERVER');else
return(defined('AIT_SERVER')and
AIT_SERVER==$server);}static
function
arrayDot($array,$prepend=''){$results=array();foreach($array
as$key=>$value){if(is_array($value)){$results=array_merge($results,self::arrayDot($value,$prepend.$key.'.'));}else{$results[$prepend.$key]=$value;}}return$results;}static
function
arrayDotGet($array,$key,$default=null){if(is_null($key))return$array;if(isset($array[$key]))return$array[$key];foreach(explode('.',$key)as$segment){if(!is_array($array)or!array_key_exists($segment,$array)){return$default;}$array=$array[$segment];}return$array;}static
function
arrayDotSet(&$array,$key,$value){if(is_null($key))return$array=$value;$keys=explode('.',$key);while(count($keys)>1){$key=array_shift($keys);if(!isset($array[$key])or!is_array($array[$key])){$array[$key]=array();}$array=&$array[$key];}$array[array_shift($keys)]=$value;return$array;}static
function
startsWith($haystack,$needle){return
NStrings::startsWith($haystack,$needle);}static
function
endsWith($haystack,$needle){return
NStrings::endsWith($haystack,$needle);}static
function
contains($haystack,$needle){return
NStrings::contains($haystack,$needle);}static
function
isAbsUrl($url){$url=trim($url);return(self::startsWith($url,'http')or
self::startsWith($url,'//'));}static
function
isExtUrl($url){$url=trim($url);$parts=parse_url($url);return((self::startsWith($url,'http')or
self::startsWith($url,'//'))and!(isset($parts['host'])and
self::contains(site_url(),$parts['host'])));}static
function
addPrefix($item,$type='',$prefix="ait-"){if(empty($item))return$item;if($type=='taxonomy'){if(is_array($item)){foreach($item
as$i=>$tax){if(self::isAitCustomTax($tax)){$item[$i]=$prefix.$tax;}}}else{if(self::isAitCustomTax($item)){$item=$prefix.$item;}}return$item;}if($type=='post'){if(self::isAitCpt($item)){$item=$prefix.$item;}return$item;}if(!self::startsWith($item,$prefix)){return$prefix.$item;}else{return$item;}}static
function
stripPrefix($item,$prefix="ait-"){$len=strlen($prefix);if(is_array($item)){foreach($item
as$i=>$string){if($len
and
self::startsWith($string,$prefix)){$item[$i]=substr($string,$len);}}return$item;}if($len
and
self::startsWith($item,$prefix)){return
substr($item,$len);}else{return$item;}}static
function
isCpt($type){$t=array('post'=>true,'page'=>true,'attachment'=>true,'revision'=>true,'nav_menu_item'=>true);return!isset($t[$type]);}static
function
isAitCpt($type){$aitCpts=get_post_types(array('ait-cpt'=>true));return
isset($aitCpts["ait-{$type}"]);}static
function
isCustomTax($tax){$t=array('category'=>true,'post_tag'=>true,'nav_menu'=>true,'link_category'=>true,'post_format'=>true);return!isset($t[$tax]);}static
function
isAitCustomTax($tax){$aitTaxs=get_taxonomies(array('ait-tax'=>true));return
isset($aitTaxs["ait-{$tax}"]);}static
function
webalize($s,$charlist=null,$lower=true){return
NStrings::webalize($s,$charlist,$lower);}static
function
trimHtmlContent($s,$limit){$length=0;$tags=array();for($i=0;$i<strlen($s)&&$length<$limit;$i++){switch($s[$i]){case'<':$start=$i+1;while($i<strlen($s)&&$s[$i]!='>'&&!ctype_space($s[$i])){$i++;}$tag=substr($s,$start,$i-$start);$in_quote='';while($i<strlen($s)&&($in_quote||$s[$i]!='>')){if(($s[$i]=='"'||$s[$i]=="'")&&!$in_quote){$in_quote=$s[$i];}elseif($in_quote==$s[$i]){$in_quote='';}$i++;}if($s[$start]=='/'){array_shift($tags);}elseif($s[$i-1]!='/'){array_unshift($tags,$tag);}break;case'&':$length++;while($i<strlen($s)&&$s[$i]!=';'){$i++;}break;default:$length++;while($i+1<strlen($s)&&ord($s[$i+1])>127&&ord($s[$i+1])<192){$i++;}}}$s=substr($s,0,$i);(strlen($s)>$limit)?$s.=" [...]":'';if($tags){$s.="</".implode("></",$tags).">";}return$s;}static
function
hex2rgb($hexColor){if($hexColor[0]=='#')$hexColor=substr($hexColor,1);if(strlen($hexColor)==6)list($r,$g,$b)=array($hexColor[0].$hexColor[1],$hexColor[2].$hexColor[3],$hexColor[4].$hexColor[5]);elseif(strlen($hexColor)==3)list($r,$g,$b)=array($hexColor[0].$hexColor[0],$hexColor[1].$hexColor[1],$hexColor[2].$hexColor[2]);else
return
array('r'=>'you','g'=>'entered wrong','b'=>"hex color: $hexColor");$r=hexdec($r);$g=hexdec($g);$b=hexdec($b);return
array('r'=>$r,'g'=>$g,'b'=>$b);}static
function
rgba2hex($string){$string=trim($string);if(self::startsWith($string,'rgba')){$values=array_map('trim',explode(',',substr($string,5,-1)));$a=array_pop($values);$out="#";foreach($values
as$c){$hex=base_convert($c,10,16);$out.=($c<16)?("0".$hex):$hex;}$return=(object)array('hex'=>$out,'opacity'=>$a*100,'a'=>$a);return$return;}else{return(object)array('hex'=>$string,'opacity'=>100,'a'=>1);}}static
function
id2class($id,$suffix,$prefix='Ait'){return$prefix.ucfirst(self::dash2camel($id)).ucfirst($suffix);}static
function
class2id($classname,$suffix,$prefix='Ait'){return
self::camel2dash(substr($classname,strlen($prefix),-strlen($suffix)));}static
function
dash2camel($s){$s=self::_2class($s);$s{0}=strtolower($s{0});return$s;}static
function
camel2dash($s){$s=preg_replace('#(.)(?=[A-Z])#','$1-',$s);$s=strtolower($s);return$s;}static
function
dash2class($s){return
self::_2class($s);}static
function
_2class($s){$s=ucwords(strtolower(str_replace(array('-','_'),' ',$s)));return
str_replace(' ','',$s);}static
function
delete($fromDir,$mask='*',$dirItself=true){if(is_dir($fromDir)){foreach(NFinder::find($mask)->from($fromDir)->childFirst()as$item){if($item->isDir()){@rmdir($item);}else{@unlink($item);}}if($dirItself){@rmdir($fromDir);}}elseif(is_file($fromDir)){@unlink($fromDir);}}static
function
mkdir($dir){if(file_exists($dir))return$dir;$d=wp_mkdir_p($dir);return$d?$dir:false;}static
function
nonce($action=-1,$raw=false){$prefix=!$raw?'ait-':'';return
wp_create_nonce("{$prefix}{$action}");}static
function
checkNonce($nonce,$action=-1,$raw=false){$prefix=!$raw?'ait-':'';return
wp_verify_nonce($nonce,"{$prefix}{$action}");}static
function
checkAjaxNonce($action=-1,$raw=false){$prefix=!$raw?'ait-':'';if(check_ajax_referer("{$prefix}{$action}",false,false))return
true;else
wp_send_json_error("Checking ajax nonce failed.");}static
function
adminRedirect($params=array()){$url=self::adminPageUrl($params);wp_redirect(esc_url_raw($url));exit;}static
function
adminPageUrl($params){if(isset($params['page']))$params['page']="ait-".$params['page'];return
add_query_arg($params,admin_url("admin.php"));}static
function
phpDate2jsDate($dateFormat){$chars=array('d'=>'dd','j'=>'d','l'=>'DD','D'=>'D','m'=>'mm','n'=>'m','F'=>'MM','M'=>'M','Y'=>'yy','y'=>'y');return
strtr((string)$dateFormat,$chars);}static
function
phpTime2jsTime($timeFormat){$chars=array('a'=>'tt','A'=>'TT','g'=>'h','G'=>'H','h'=>'hh','H'=>'HH','i'=>'mm','s'=>'ss');return
strtr((string)$timeFormat,$chars);}static
function
jsDate2phpDate($dateFormat){$chars=array('dd'=>'d','d'=>'j','DD'=>'l','D'=>'D','mm'=>'m','m'=>'n','MM'=>'F','M'=>'M','yy'=>'Y','y'=>'y');return
strtr((string)$dateFormat,$chars);}static
function
jsTime2phpTime($timeFormat){$chars=array('tt'=>'a','TT'=>'A','h'=>'g','H'=>'G','hh'=>'h','HH'=>'H','mm'=>'i','ss'=>'s');return
strtr((string)$timeFormat,$chars);}}class
AitWoocommerce{static
function
enabled(){return
aitIsPluginActive('woocommerce');}static
function
init(){if(is_admin()){add_action('ait-create-content-custom-tables',array(__CLASS__,'createTables'),10,1);add_filter('ait-backup-content-custom-tables',array(__CLASS__,'addWcTablesForBackup'));add_filter('ait-backup-wpoptions',array(__CLASS__,'addWcOptionsForBackup'),10,2);}if(!self::enabled())return;add_action('template_redirect',array(__CLASS__,'onTemplateRedirect'));add_filter('add_to_cart_fragments',array(__CLASS__,'addToCartFragments'));}static
function
addWcOptionsForBackup($options,$isDemoContent){$options[]='woocommerce_shop_page_id';$options[]='woocommerce_terms_page_id';$options[]='woocommerce_cart_page_id';$options[]='woocommerce_checkout_page_id';$options[]='woocommerce_pay_page_id';$options[]='woocommerce_thanks_page_id';$options[]='woocommerce_myaccount_page_id';$options[]='woocommerce_edit_address_page_id';$options[]='woocommerce_view_order_page_id';$options[]='woocommerce_change_password_page_id';$options[]='woocommerce_logout_page_id';$options[]='woocommerce_lost_password_page_id';if(!$isDemoContent
and
self::enabled()){include_once(WC()->plugin_path().'/includes/admin/class-wc-admin-settings.php');$settings=WC_Admin_Settings::get_settings_pages();foreach($settings
as$section){foreach($section->get_settings()as$value){if(isset($value['default'])and
isset($value['id'])){$options[]=$value['id'];}}if($section
instanceof
WC_Settings_Products){foreach($section->get_settings('inventory')as$value){if(isset($value['default'])and
isset($value['id'])){$options[]=$value['id'];}}}}}return
array_unique($options);}static
function
addWcTablesForBackup($tables){$tables[]="woocommerce_attribute_taxonomies";$tables[]="woocommerce_termmeta";$tables[]="woocommerce_downloadable_product_permissions";$tables[]="woocommerce_order_items";$tables[]="woocommerce_order_itemmeta";$tables[]="woocommerce_tax_rates";$tables[]="woocommerce_tax_rate_locations";return$tables;}static
function
onTemplateRedirect(){if(!is_admin()){if(self::currentPageIs('woocommerce')){add_filter('woocommerce_show_page_title','__return_false');}}}static
function
addToCartFragments($fragments){$fragments['span#ait-woocomerce-cart-items-count']='<span id="ait-woocomerce-cart-items-count" class="cart-count">'.self::cartGetItemsCount().'</span>';return$fragments;}static
function
getPageId($page){if(!self::enabled())return-1;return
woocommerce_get_page_id($page);}static
function
getPage($page){if(!self::enabled())return
NULL;return
get_page(self::getPageId($page));}static
function
currentPageIs($page){if(!self::enabled())return
FALSE;if($page=='woocommerce')return
is_woocommerce();elseif($page=='shop')return
is_shop();elseif($page=='product')return
is_product();elseif($page=='cart')return
is_cart();elseif($page=='checkout')return
is_checkout();return
FALSE;}static
function
cartIsEmpty(){if(!self::enabled())return
true;global$woocommerce;return($woocommerce->cart->get_cart_contents_count()!=0);}static
function
cartGetItemsCount(){if(!self::enabled())return
0;global$woocommerce;return$woocommerce->cart->get_cart_contents_count();}static
function
cartSubtotal(){if(!self::enabled())return
0;global$woocommerce;return$woocommerce->cart->get_cart_subtotal();}static
function
cartDisplay(){if(!self::enabled())return'';ob_start();the_widget('WC_Widget_Cart',array('ait-dropdown-wc-cart-widget'=>true),array('before_title'=>'','after_title'=>''));$out=ob_get_clean();return$out;}static
function
productCategoriesDisplay(){if(!self::enabled())return'';ob_start();the_widget('WC_Widget_Product_Categories',array('title'=>NULL,'orderby'=>'name'),array('before_title'=>'','after_title'=>''));$out=ob_get_clean();return$out;}static
function
cartUrl(){if(!self::enabled())return'#';global$woocommerce;return$woocommerce->cart->get_cart_url();}static
function
isRegistrationEnabled(){return
get_option('woocommerce_enable_myaccount_registration')=='yes';}static
function
accountUrl(){if(!self::enabled())return'#';return
get_permalink(woocommerce_get_page_id('myaccount'));}static
function
createTables($isDemoContent){if(!$isDemoContent)return;global$wpdb;if($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}woocommerce_attribute_taxonomies'")){return;}$wpdb->hide_errors();$collate='';if($wpdb->has_cap('collation')){if(!empty($wpdb->charset)){$collate.="DEFAULT CHARACTER SET $wpdb->charset";}if(!empty($wpdb->collate)){$collate.=" COLLATE $wpdb->collate";}}require_once(ABSPATH.'wp-admin/includes/upgrade.php');if($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}woocommerce_downloadable_product_permissions';")){if(!$wpdb->get_var("SHOW COLUMNS FROM `{$wpdb->prefix}woocommerce_downloadable_product_permissions` LIKE 'permission_id';")){$wpdb->query("ALTER TABLE {$wpdb->prefix}woocommerce_downloadable_product_permissions DROP PRIMARY KEY, ADD `permission_id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT;");}}$woocommerce_tables="
	CREATE TABLE {$wpdb->prefix}woocommerce_attribute_taxonomies (
	  attribute_id bigint(20) NOT NULL auto_increment,
	  attribute_name varchar(200) NOT NULL,
	  attribute_label longtext NULL,
	  attribute_type varchar(200) NOT NULL,
	  attribute_orderby varchar(200) NOT NULL,
	  PRIMARY KEY  (attribute_id),
	  KEY attribute_name (attribute_name)
	) $collate;
	CREATE TABLE {$wpdb->prefix}woocommerce_termmeta (
	  meta_id bigint(20) NOT NULL auto_increment,
	  woocommerce_term_id bigint(20) NOT NULL,
	  meta_key varchar(255) NULL,
	  meta_value longtext NULL,
	  PRIMARY KEY  (meta_id),
	  KEY woocommerce_term_id (woocommerce_term_id),
	  KEY meta_key (meta_key)
	) $collate;
	CREATE TABLE {$wpdb->prefix}woocommerce_downloadable_product_permissions (
	  permission_id bigint(20) NOT NULL auto_increment,
	  download_id varchar(32) NOT NULL,
	  product_id bigint(20) NOT NULL,
	  order_id bigint(20) NOT NULL DEFAULT 0,
	  order_key varchar(200) NOT NULL,
	  user_email varchar(200) NOT NULL,
	  user_id bigint(20) NULL,
	  downloads_remaining varchar(9) NULL,
	  access_granted datetime NOT NULL default '0000-00-00 00:00:00',
	  access_expires datetime NULL default null,
	  download_count bigint(20) NOT NULL DEFAULT 0,
	  PRIMARY KEY  (permission_id),
	  KEY download_order_key_product (product_id,order_id,order_key,download_id),
	  KEY download_order_product (download_id,order_id,product_id)
	) $collate;
	CREATE TABLE {$wpdb->prefix}woocommerce_order_items (
	  order_item_id bigint(20) NOT NULL auto_increment,
	  order_item_name longtext NOT NULL,
	  order_item_type varchar(200) NOT NULL DEFAULT '',
	  order_id bigint(20) NOT NULL,
	  PRIMARY KEY  (order_item_id),
	  KEY order_id (order_id)
	) $collate;
	CREATE TABLE {$wpdb->prefix}woocommerce_order_itemmeta (
	  meta_id bigint(20) NOT NULL auto_increment,
	  order_item_id bigint(20) NOT NULL,
	  meta_key varchar(255) NULL,
	  meta_value longtext NULL,
	  PRIMARY KEY  (meta_id),
	  KEY order_item_id (order_item_id),
	  KEY meta_key (meta_key)
	) $collate;
	CREATE TABLE {$wpdb->prefix}woocommerce_tax_rates (
	  tax_rate_id bigint(20) NOT NULL auto_increment,
	  tax_rate_country varchar(200) NOT NULL DEFAULT '',
	  tax_rate_state varchar(200) NOT NULL DEFAULT '',
	  tax_rate varchar(200) NOT NULL DEFAULT '',
	  tax_rate_name varchar(200) NOT NULL DEFAULT '',
	  tax_rate_priority bigint(20) NOT NULL,
	  tax_rate_compound int(1) NOT NULL DEFAULT 0,
	  tax_rate_shipping int(1) NOT NULL DEFAULT 1,
	  tax_rate_order bigint(20) NOT NULL,
	  tax_rate_class varchar(200) NOT NULL DEFAULT '',
	  PRIMARY KEY  (tax_rate_id),
	  KEY tax_rate_country (tax_rate_country),
	  KEY tax_rate_state (tax_rate_state),
	  KEY tax_rate_class (tax_rate_class),
	  KEY tax_rate_priority (tax_rate_priority)
	) $collate;
	CREATE TABLE {$wpdb->prefix}woocommerce_tax_rate_locations (
	  location_id bigint(20) NOT NULL auto_increment,
	  location_code varchar(255) NOT NULL,
	  tax_rate_id bigint(20) NOT NULL,
	  location_type varchar(40) NOT NULL,
	  PRIMARY KEY  (location_id),
	  KEY tax_rate_id (tax_rate_id),
	  KEY location_type (location_type),
	  KEY location_type_code (location_type,location_code)
	) $collate;
	";dbDelta($woocommerce_tables);}}class
AitWpExtensions{static
function
register(){$ext=self::loadConfig();if(!AitUtils::isAjax()){add_filter('wp_list_categories',array(__CLASS__,'removeCategoryRelAtt'));add_filter('the_category',array(__CLASS__,'removeCategoryRelAtt'));if($ext->wp->loginPageBranding){global$pagenow;if($pagenow=='wp-login.php'){add_action('login_head',array(__CLASS__,'loginPageBranding'));add_filter('login_headerurl',array(__CLASS__,'loginPageBranding'));add_filter('login_headertitle',array(__CLASS__,'loginPageBranding'));}}}add_filter('widget_text','do_shortcode');}static
function
loadConfig(){$extensionsFilePath=aitPath('config','/wp-extensions.php');if($extensionsFilePath===false){$ext=require
aitPaths()->dir->fwConfig.'/wp-extensions.php';}else{$ext=include$extensionsFilePath;}return$ext;}static
function
removeCategoryRelAtt($output){return
str_replace(' rel="category tag"','',$output);}static
function
loginPageBranding($input=''){$t=aitOptions()->getOptionsByType('theme');$branding=$t['adminBranding'];if(current_filter()=='login_head'){if(isset($branding["loginScreenCss"])and$branding["loginScreenCss"]){echo"<style>".$branding["loginScreenCss"]."</style>\n";}if(isset($branding["loginScreenLogo"])and$branding["loginScreenLogo"]){$css='.login h1 a {background-image: url("%s"); background-size: 274px 63px; width: 274px}';echo"<style>".sprintf($css,$branding["loginScreenLogo"])."</style>\n";}return;}if(current_filter()=='login_headerurl'and
isset($branding["loginScreenLogoLink"])and$branding["loginScreenLogoLink"]){return$branding["loginScreenLogoLink"];}if(current_filter()=='login_headertitle'and
isset($branding["loginScreenLogoTooltip"])and$branding["loginScreenLogoTooltip"]){return
AitLangs::getCurrentLocaleText($branding["loginScreenLogoTooltip"],$input);}return$input;}}class
AitWpLatte{protected
static$storage;static
function
init(){$minified=__DIR__.'/libs/wplatte/wplatte.min.php';if(!class_exists('WpLatte')and
file_exists($minified)){require$minified;}add_filter('wp_title',array(__CLASS__,'wpTitle'),10,2);add_filter('body_class',array(__CLASS__,'bodyHtmlClass'),10,2);add_action('wplatte-macros','AitWpLatteMacros::install',10,2);add_filter('wplatte-cache-constants',array(__CLASS__,'cacheConstants'));add_filter('wplatte-layout-params',array(__CLASS__,'layoutParams'));add_filter('wplatte-lang-domain',array(__CLASS__,'langDomain'));add_filter('wplatte-cpt-prefixes',array(__CLASS__,'addCptPrefixes'));add_filter('wplatte-post-meta',array(__CLASS__,'postMeta'),10,6);add_filter('wplatte-menu-args',array(__CLASS__,'menuArgs'),10,2);add_filter('wplatte-cpts',array(__CLASS__,'addAitCpts'));add_filter('wplatte-taxs',array(__CLASS__,'addAitTaxs'));add_filter('wplatte-custom-wpquery-args',array(__CLASS__,'addLangToCustomWpQuery'),10,2);WpLatte::init(array('config'=>array('cacheDir'=>aitPaths()->dir->cache,'langDomain'=>'ait'),'params'=>array('homeUrl'=>home_url('/'))));WpLatteWpEntity::extensionMethod('WpLatteWpEntity::hasSidebar',array(__CLASS__,'hasSidebar'));WpLatteWpEntity::extensionMethod('WpLatteWpEntity::sidebar',array(__CLASS__,'getSidebar'));WpLatteWpEntity::extensionMethod('WpLatteWpEntity::widgetAreas',array(__CLASS__,'getWidgetAreas'));WpLatteWpEntity::extensionMethod('WpLatteWpEntity::isWoocommerce',array(__CLASS__,'isWoocommerce'));}static
function
cacheConstants($constants){$constants[]='AIT_THEME_VERSION';return$constants;}static
function
layoutParams($params){$params['options']=self::getCustomOptions();$params['elements']=self::getCustomElementsOptions();$params['languages']=AitLangs::getSwitcherLanguages();$params['currentLang']=AitLangs::getCurrentLang();global$pagenow;$params['pagenow']=$pagenow;return$params;}static
function
wpTitle($title,$sep){global$paged,$page;if(is_feed())return$title;$title.=get_bloginfo('name');$site_description=get_bloginfo('description','display');if($site_description&&(is_home()||is_front_page()))$title="$title $sep $site_description";if($paged>=2||$page>=2)$title="$title $sep ".sprintf(__('Page %s','ait'),max($paged,$page));return$title;}static
function
bodyHtmlClass($classes,$class){$elements=self::getCustomElementsOptions();$es=$elements->sortable;$eu=$elements->unsortable;foreach($es
as$i){if($i->display
and!$i->disabled
and!in_array($i,array('sidebars-boundary-start','sidebars-boundary-end')))$classes[]="element-{$i->id}";}foreach($eu
as$i){if($i->display
and!$i->disabled)$classes[]="element-{$i->id}";}foreach(self::getCurrentSidebars()as$side=>$sidebar){if($sidebar['sidebar']!='none'and
is_active_sidebar($sidebar['sidebar'])){$classes[]="{$side}-sidebar";}}$options=self::getCustomOptions();if(isset($options->theme->general->layoutType))$classes[]=$options->theme->general->layoutType;if(isset($options->theme->general->progressivePageLoading)and$options->theme->general->progressivePageLoading)$classes[]='preloading-enabled';if(isset($options->theme->header->stickyMenu)and$options->theme->header->stickyMenu)$classes[]='sticky-menu-enabled';if(isset($options->theme->header->headerType))$classes[]=$options->theme->header->headerType;$classes=array_unique($classes);return$classes;}static
function
getCustomOptions(){if(isset(self::$storage['custom-options'])){return
self::$storage['custom-options'];}else{$oid=aitOptions()->getOid();$localOptions=aitOptions()->getOptions($oid);unset($localOptions['elements'],$localOptions['theme']['adminBranding'],$localOptions['theme']['administrator']);$localOptions=apply_filters('ait-templates-options',$localOptions);$localOptions=self::filterOptionsForCurrentLocale($localOptions);$options=json_decode(json_encode($localOptions));self::$storage['custom-options']=$options;return
self::$storage['custom-options'];}}static
function
getCustomElementsOptions(){if(isset(self::$storage['custom-elements-options'])){return
self::$storage['custom-elements-options'];}else{$oid=aitOptions()->getOid();$o=aitOptions()->getOptions($oid);$options=$o['elements'];$em=aitManager('elements');$options=self::filterOptionsForCurrentLocale($options,'elements');$elements=$em->createElementsFromOptions($options,$oid,true);$return=new
stdClass;$return->unsortable=array();$return->sortable=array();$isBetweenSidebars=false;foreach($elements
as$i=>$el){if(!$em->getPrototype($el->getId())and!$em->isElementSidebarsBoundary($el->getId()))continue;if($el->isDisabled())continue;if($em->isElementSidebarsBoundary($el->getId())and(!self::hasSidebar(__CLASS__,'left')&&!self::hasSidebar(__CLASS__,'right')))continue;if($el->getId()==='comments'and
aitOptions()->isQueryForSpecialPage(array('_404','_search','_archive','_wc_product','_wc_shop')))continue;if(!$el->sortable){$return->unsortable[$el->getId()]=$el;}elseif(isset($options[$i][$el->getId()]['@columns-element-index'])and$options[$i][$el->getId()]['@columns-element-index']!=''and
isset($return->sortable[$options[$i][$el->getId()]['@columns-element-index']])){$columnsElement=$return->sortable[$options[$i][$el->getId()]['@columns-element-index']];$columnsElement->addElementToColumn($el,$options[$i][$el->getId()]['@columns-element-column-index']);}else{if($em->isElementSidebarsBoundary($el->getId())and$el->getId()=='sidebars-boundary-start'){$isBetweenSidebars=true;}elseif($em->isElementSidebarsBoundary($el->getId())and$el->getId()=='sidebars-boundary-end'){$isBetweenSidebars=false;}$el->setBetweenSidebars($isBetweenSidebars);$return->sortable[$i]=$el;}}self::$storage['custom-elements-options']=$return;return
self::$storage['custom-elements-options'];}}protected
static
function
filterOptionsForCurrentLocale($options,$type=''){$translatablesList=aitConfig()->getTranslatablesList();$currentLocale=AitLangs::getCurrentLocale();$defaultLocale=AitLangs::getDefaultLocale();if($type!='elements'){foreach($options
as$configType=>$groups){foreach($groups
as$groupKey=>$groupValues){foreach($groupValues
as$optionKey=>$optionValue){if(isset($translatablesList[$configType][$groupKey][$optionKey])and$translatablesList[$configType][$groupKey][$optionKey]){if(is_array($optionValue)and
isset($optionValue[$currentLocale])){$options[$configType][$groupKey][$optionKey]=apply_filters('ait-filter-value-for-current-locale',$optionValue[$currentLocale]);}elseif(is_array($optionValue)and
is_int(key($optionValue))){foreach($optionValue
as$i=>$clones){foreach($clones
as$k=>$v){if(is_array($v)and
isset($v[$currentLocale])){$options[$configType][$groupKey][$optionKey][$i][$k]=apply_filters('ait-filter-value-for-current-locale',$v[$currentLocale]);}elseif(is_array($v)and!isset($v[$currentLocale])){if(is_string($v)){$options[$configType][$groupKey][$optionKey][$i][$k]=apply_filters('ait-filter-value-for-current-locale',$v);}else{$val='';if(isset($v[$defaultLocale])){$val=$v[$defaultLocale];}elseif(isset($v['en_US'])){$val=$v['en_US'];}$options[$configType][$groupKey][$optionKey][$i][$k]=apply_filters('ait-filter-value-for-current-locale',$val);}}}}}else{if(is_string($optionValue)){$options[$configType][$groupKey][$optionKey]=apply_filters('ait-filter-value-for-current-locale',$optionValue);}else{$val='';if(isset($optionValue[$defaultLocale])){$val=$optionValue[$defaultLocale];}elseif(isset($optionValue['en_US'])){$val=$optionValue['en_US'];}$options[$configType][$groupKey][$optionKey]=apply_filters('ait-filter-value-for-current-locale',$val);}}}}}}}else{foreach($options
as$i=>$element){foreach($element
as$elementId=>$groupValues){foreach($groupValues
as$optionKey=>$optionValue){if(isset($translatablesList['elements'][$elementId][$optionKey])and$translatablesList['elements'][$elementId][$optionKey]){if(is_array($optionValue)and
isset($optionValue[$currentLocale])){$options[$i][$elementId][$optionKey]=apply_filters('ait-filter-value-for-current-locale',$optionValue[$currentLocale]);}elseif(is_array($optionValue)and
is_numeric(key($optionValue))){foreach($optionValue
as$j=>$clones){foreach($clones
as$k=>$v){if(is_array($v)and
isset($v[$currentLocale])){$options[$i][$elementId][$optionKey][$j][$k]=apply_filters('ait-filter-value-for-current-locale',$v[$currentLocale]);}elseif(is_array($v)and!isset($v[$currentLocale])){if(is_string($v)){$options[$i][$elementId][$optionKey][$j][$k]=apply_filters('ait-filter-value-for-current-locale',$v);}else{$val='';if(isset($v[$defaultLocale])){$val=$v[$defaultLocale];}elseif(isset($v['en_US'])){$val=$v['en_US'];}$options[$i][$elementId][$optionKey][$j][$k]=apply_filters('ait-filter-value-for-current-locale',$val);}}}}}else{if(is_string($optionValue)){$options[$i][$elementId][$optionKey]=apply_filters('ait-filter-value-for-current-locale',$optionValue);}else{$val='';if(isset($optionValue[$defaultLocale])){$val=$optionValue[$defaultLocale];}elseif(isset($optionValue['en_US'])){$val=$optionValue['en_US'];}$options[$i][$elementId][$optionKey]=apply_filters('ait-filter-value-for-current-locale',$val);}}}}}}}return$options;}protected
static
function
getCurrentSidebars(){$opts=aitOptions()->getOptionsByType('layout');return
isset($opts['@sidebars'])?$opts['@sidebars']:array();}static
function
hasSidebar($wp,$side){$currentSidebars=self::getCurrentSidebars();$registeredSidebars=$GLOBALS['wp_registered_sidebars'];return(isset($currentSidebars[$side])and
isset($currentSidebars[$side]['sidebar'])and$currentSidebars[$side]['sidebar']!='none'and
isset($registeredSidebars[$currentSidebars[$side]['sidebar']]));}static
function
getSidebar($wp,$side){$currentSidebars=self::getCurrentSidebars();if(isset($currentSidebars[$side]))return$currentSidebars[$side]['sidebar'];else
return'';}static
function
getWidgetAreas($wp,$group){$return=array();$areas=aitManager('sidebars')->getWidgetAreas();if(isset($areas[$group])){return
array_keys($areas[$group]);}else{trigger_error("There isn't such widget areas group as '{$group}'");return
array();}}static
function
isWoocommerce($wp,$page=''){if(!$page)return
AitWoocommerce::currentPageIs('woocommerce');else
return
AitWoocommerce::currentPageIs($page);}static
function
addCptPrefixes($prefixes){return
array('post'=>'ait-','taxonomy'=>'ait-');}static
function
postMeta($postmeta,$metaboxId,$metaboxKey,$key,$isCpt,$type){if(aitIsPluginActive('toolkit')){$cptId=substr($type,4);$cpt=aitManager('cpts')->get($cptId);if($isCpt
and$cpt){$metaDefaults=$cpt->getMetabox($metaboxId)->getConfigDefaults();if($postmeta==''and
is_array($metaDefaults[$metaboxKey]))$postmeta=array();$postmeta=array_replace_recursive($metaDefaults[$metaboxKey],$postmeta);array_walk_recursive($postmeta,array(__CLASS__,'filterPostmetaValue'));}}return$postmeta;}static
function
filterPostmetaValue(&$item,$key){$item=apply_filters('ait-filter-value-for-current-locale',$item);}static
function
menuArgs($location,$args){$args['show_home']=true;$args['container_class']='nav-menu-container';if($args['theme_location'])$args['container_class'].=' nav-menu-'.$args['theme_location'];$args['menu_class']='nav-menu clear';$args['fallback_cb']=array(__CLASS__,'menuFallback');return$args;}static
function
menuFallback($args){$defaults=array('sort_column'=>'menu_order, post_title','menu_class'=>'menu');$args=wp_parse_args($args,$defaults);$menu='';unset($args['walker']);$list_args=$args;if(!empty($args['show_home'])){if($args['show_home']===true
or$args['show_home']==='1'or$args['show_home']===1)$text=__('Home','default');else$text=$args['show_home'];$class='';if(is_front_page()&&!is_paged())$class='class="current_page_item"';$menu.=sprintf('<li %s><a href="%s" title="%s">%s</a></li>',$class,home_url('/'),esc_attr($text),$text);if(get_option('show_on_front')=='page'){if(!empty($list_args['exclude'])){$list_args['exclude'].=',';}else{$list_args['exclude']='';}$list_args['exclude'].=get_option('page_on_front');}}$list_args['echo']=false;$list_args['title_li']='';$menu.=str_replace(array("\r","\n","\t"),'',wp_list_pages($list_args));if($menu)$menu='<ul class="'.esc_attr($args['menu_class']).'">'.$menu.'</ul>';$containerClass=esc_attr($args['container_class']);$menu='<div class="'.$containerClass.'">'.$menu."</div>\n";$menu=apply_filters('wp_page_menu',$menu,$args);echo$menu;}static
function
addAitCpts($cpts){return
get_post_types(array('ait-cpt'=>true));}static
function
addAitTaxs($taxs){return
get_taxonomies(array('ait-tax'=>true));}static
function
addLangToCustomWpQuery($query,$originalArgs){global$polylang;if(isset($polylang)and
isset($query['post_type'])){$translatableCpts=get_post_types(array('ait-translatable-cpt'=>true));if(isset($query['tax_query'])and
aitOptions()->isQueryForSpecialPage()){foreach($query['tax_query']as$i=>$taxquery){$newTermId=pll_get_term($taxquery['terms']);if($newTermId){$query['tax_query'][$i]['terms']=$newTermId;}}}if(in_array($query['post_type'],$translatableCpts)and
in_array($query['post_type'],$polylang->options["post_types"])){$query['lang']=AitLangs::getCurrentLanguageCode();}}return$query;}}class
AitWpLatteMacros
extends
NMacroSet{public
static$config;static
function
install(NLatteCompiler$compiler,$config=null){$me=new
self($compiler);self::$config=$config;$me->addMacro('imageUrl',array($me,'macroResizedImgUrl'));$me->addMacro('includeElement',array($me,'macroIncludeElement'));$me->addMacro('dataAttr',array($me,'macroDataAttr'));$me->addMacro('sidebar','dynamic_sidebar(%node.args);');$me->addMacro('googleAnalytics','echo '.__CLASS__.'::googleAnalytics(%node.args);');$me->addMacro('currency','echo '.__CLASS__.'::currency(%node.args)');$me->addMacro('videoEmbedUrl','echo '.__CLASS__.'::makeVideoEmbedUrl(%node.args);');$me->addMacro('videoThumbnailUrl','echo '.__CLASS__.'::makeVideoThumbnailUrl(%node.args);');}function
macroIncludeElement(NMacroNode$node,NPhpWriter$writer){$el=$writer->formatArgs();$params=array("'el' => $el","'element' => {$el}","'htmlId' => {$el}->getHtmlId()","'htmlClass' => {$el}->getHtmlClass()");$paramsStr=implode(', ',$params);$code=$writer->write('NCoreMacros::includeTemplate('.$el.'->getTemplate(), array('.$paramsStr.') + $template->getParameters(), $_l->templates[%var])',$this->getCompiler()->getTemplateId());if($node->modifiers){return$writer->write('echo %modify(%raw->__toString(TRUE))',$code);}else{return$code.'->render()';}}function
macroResizedImgUrl(NMacroNode$node,NPhpWriter$writer){$url=$node->tokenizer->fetchWord();$args=$writer->formatArray();if(!AitUtils::contains($args,'=>'))$args=substr($args,6,-1);return$writer->write("echo aitResizeImage($url, $args)");}function
macroDataAttr(NMacroNode$node,NPhpWriter$writer){$name=$node->tokenizer->fetchWord();$params=$writer->formatArray();return"echo aitDataAttr('$name', $params)";}static
function
googleAnalytics($uaCode=''){if($uaCode){return"
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', '{$uaCode}', 'auto');ga('send', 'pageview');
</script>";}return'';}static
function
currency($price=0,$currency='USD'){$dollar='&#36;';$krone='&#107;&#114;';$currencies=array('AUD'=>array('symbol'=>$dollar),'BRL'=>array('symbol'=>'&#82;'.$dollar),'CAD'=>array('symbol'=>$dollar),'CZK'=>array('symbol'=>'&#75;&#269;','position'=>'right'),'DKK'=>array('symbol'=>$krone),'EUR'=>array('symbol'=>'&#8364;','position'=>'right'),'HKD'=>array('symbol'=>$dollar),'HUF'=>array('symbol'=>'&#70;&#116;'),'ILS'=>array('symbol'=>'&#8362;'),'JPY'=>array('symbol'=>'&#165;'),'MYR'=>array('symbol'=>'&#82;&#77;'),'MXN'=>array('symbol'=>$dollar),'NOK'=>array('symbol'=>$krone),'NZD'=>array('symbol'=>$dollar),'PHP'=>array('symbol'=>'&#8369;'),'PLN'=>array('symbol'=>'&#122;&#322;'),'GBP'=>array('symbol'=>'&#163; '),'RUB'=>array('symbol'=>'&#1088;&#1091;&#1073;'),'SGD'=>array('symbol'=>$dollar),'SEK'=>array('symbol'=>$krone),'CHF'=>array('symbol'=>'&#67;&#72;&#70;'),'TWD'=>array('symbol'=>'&#78;&#84;'.$dollar),'THB'=>array('symbol'=>'&#3647;'),'TRY'=>array('symbol'=>'&#8378;'),'USD'=>array('symbol'=>$dollar));$priceLayout="<span class='price'>%s</span>";$currencyLayout="<span class='currency'>%s</span>";if(!isset($currencies[$currency])){trigger_error("Currency $currency is not supported");$return=sprintf($currencyLayout,$dollar).sprintf($priceLayout,$price);}$c=$currencies[$currency];if(isset($c['position'])and$c['position']=='right'){$return=sprintf($priceLayout,$price).sprintf($currencyLayout,$c['symbol']);}else{$return=sprintf($currencyLayout,$c['symbol']).sprintf($priceLayout,$price);}return
apply_filters('wplatte-currency',$return,$price,$currency);}static
function
makeVideoEmbedUrl($videoUrl){$url='#';$videoId=aitExtractVideoIdFromVideoUrl($videoUrl);if(AitUtils::contains($videoUrl,'youtube')){$url="https://www.youtube.com/embed/{$videoId}?wmode=opaque&amp;showinfo=0&amp;enablejsapi=1";}elseif(AitUtils::contains($videoUrl,'vimeo')){$url="https://player.vimeo.com/video/{$videoId}?title=0&amp;byline=0&amp;portrait=0";}return$url;}static
function
makeVideoThumbnailUrl($videoUrl){$url='#';$videoId=aitExtractVideoIdFromVideoUrl($videoUrl);if(AitUtils::contains($videoUrl,'youtube')){$url="https://img.youtube.com/vi/{$videoId}/1.jpg";}elseif(AitUtils::contains($videoUrl,'vimeo')){$clipData=@json_decode(@file_get_contents("http://vimeo.com/api/v2/video/{$videoId}.json"));if($clipData!==false){$url=$clipData[0]->thumbnail_small;}}return$url;}}class
AitWpOverrides
extends
NObject{protected
static$galleryInstance=0;static
function
init(){add_filter('post_gallery',array(__CLASS__,'postGallery'),10,2);add_filter('tiny_mce_before_init',array(__CLASS__,'tinymceUnhideKitchensink'));add_filter('posts_join',array(__CLASS__,'joinPostsMetadataToEnableSearchingInElements'));add_filter('posts_search',array(__CLASS__,'enableSearchingInElements'),10,2);add_filter('posts_request',array(__CLASS__,'showOnlyDistinctPostSearchResults'));add_filter('comment_form_fields',array(__CLASS__,'fixCommentFieldsInWp44'),99);}static
function
postGallery($emptyString,$attr){$post=get_post();self::$galleryInstance++;if(!empty($attr['ids'])){if(empty($attr['orderby']))$attr['orderby']='post__in';$attr['include']=$attr['ids'];}if(isset($attr['orderby'])){$attr['orderby']=sanitize_sql_orderby($attr['orderby']);if(!$attr['orderby'])unset($attr['orderby']);}extract(shortcode_atts(array('order'=>'ASC','orderby'=>'menu_order ID','id'=>$post?$post->ID:0,'itemtag'=>'dl','icontag'=>'dt','captiontag'=>'dd','columns'=>3,'size'=>'thumbnail','include'=>'','exclude'=>''),$attr,'gallery'));$id=intval($id);if('RAND'==$order)$orderby='none';if(!empty($include)){$_attachments=get_posts(array('include'=>$include,'post_status'=>'inherit','post_type'=>'attachment','post_mime_type'=>'image','order'=>$order,'orderby'=>$orderby));$attachments=array();foreach($_attachments
as$key=>$val){$attachments[$val->ID]=$_attachments[$key];}}elseif(!empty($exclude)){$attachments=get_children(array('post_parent'=>$id,'exclude'=>$exclude,'post_status'=>'inherit','post_type'=>'attachment','post_mime_type'=>'image','order'=>$order,'orderby'=>$orderby));}else{$attachments=get_children(array('post_parent'=>$id,'post_status'=>'inherit','post_type'=>'attachment','post_mime_type'=>'image','order'=>$order,'orderby'=>$orderby));}if(empty($attachments))return'';if(is_feed()){$output="\n";foreach($attachments
as$att_id=>$attachment)$output.=wp_get_attachment_link($att_id,$size,true)."\n";return$output;}$itemtag=tag_escape($itemtag);$captiontag=tag_escape($captiontag);$icontag=tag_escape($icontag);$valid_tags=wp_kses_allowed_html('post');if(!isset($valid_tags[$itemtag]))$itemtag='dl';if(!isset($valid_tags[$captiontag]))$captiontag='dd';if(!isset($valid_tags[$icontag]))$icontag='dt';$columns=intval($columns);$itemwidth=$columns>0?floor(100/$columns):100;$float=is_rtl()?'right':'left';$selector="gallery-".self::$galleryInstance;$gallery_style=$gallery_div='';if(apply_filters('use_default_gallery_style',true))$gallery_style="
			<div>
			<style type='text/css'>
				#{$selector} {
					margin: auto;
				}
				#{$selector} .gallery-item {
					float: {$float};
					margin-top: 10px;
					text-align: center;
					width: {$itemwidth}%;
				}
				#{$selector} img {
					border: 2px solid #cfcfcf;
				}
				#{$selector} .gallery-caption {
					margin-left: 0;
				}
				/* see gallery_shortcode() in wp-includes/media.php */
			</style></div>";$size_class=sanitize_html_class($size);$gallery_div="<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";$gallery_div.='<div class="gallery-inner-wrapper">';$output=apply_filters('gallery_style',$gallery_style."\n\t\t".$gallery_div);$i=0;foreach($attachments
as$id=>$attachment){if(!empty($attr['link'])&&'file'===$attr['link'])$image_output=wp_get_attachment_link($id,$size,false,false);elseif(!empty($attr['link'])&&'none'===$attr['link'])$image_output=wp_get_attachment_image($id,$size,false);else$image_output=wp_get_attachment_link($id,$size,true,false);$image_meta=wp_get_attachment_metadata($id);$orientation='';if(isset($image_meta['height'],$image_meta['width']))$orientation=($image_meta['height']>$image_meta['width'])?'portrait':'landscape';$output.="<{$itemtag} class='gallery-item'>";$output.="
				<{$icontag} class='gallery-icon {$orientation}'>
					$image_output
				</{$icontag}>";if($captiontag&&trim($attachment->post_excerpt)){$output.="
					<{$captiontag} class='wp-caption-text gallery-caption'>
					".wptexturize($attachment->post_excerpt)."
					</{$captiontag}>";}else{$output.="<{$captiontag}></{$captiontag}>";}$output.="</{$itemtag}>";if($columns>0&&++$i
%$columns==0)$output.='<br style="clear: both" />';}$output.="
				<br style='clear: both;' />
			</div></div>\n";return$output;}static
function
tinymceUnhideKitchensink($args){$args['wordpress_adv_hidden']=false;return$args;}static
function
enableSearchingInElements($where,$wp_query){if(!$wp_query->is_search()||basename($_SERVER["SCRIPT_NAME"])=="admin-ajax.php"){return$where;}$searchQuery=self::buildDefaultSearchSql($wp_query);$searchQuery.=self::buildPostElementsOptionsSearchSql($wp_query);if($searchQuery!=''){$where=preg_replace('#\(\(\(.*?\)\)\)#','(('.$searchQuery.'))',$where);}return$where;}static
function
joinPostsMetadataToEnableSearchingInElements($join){global$wpdb;if(is_search()){$theme=esc_sql(AIT_CURRENT_THEME);$join.=" LEFT JOIN {$wpdb->options} ON {$wpdb->options}.option_name LIKE CONCAT('_ait_{$theme}_elements_opts_page_', {$wpdb->posts}.ID)";}return$join;}static
function
showOnlyDistinctPostSearchResults($query){if(is_search()and
strstr($query,'DISTINCT')===false){$query=str_replace('SELECT','SELECT DISTINCT',$query);}return$query;}static
function
fixCommentFieldsInWp44($fields){if(isset($fields['comment'])){$commentField=$fields['comment'];unset($fields['comment']);$fields['comment']=$commentField;}return$fields;}private
static
function
buildDefaultSearchSql($wp_query){global$wpdb;$not_exact=empty($wp_query->query_vars['exact']);$search_sql_query='';$seperator='';$terms=self::getSearchTerms($wp_query);$search_sql_query.='(';foreach($terms
as$term){$search_sql_query.=$seperator;$esc_term=esc_sql($term);if($not_exact){$esc_term="%$esc_term%";}$like_title="($wpdb->posts.post_title LIKE '$esc_term')";$like_post="($wpdb->posts.post_content LIKE '$esc_term')";$search_sql_query.="($like_title OR $like_post)";$seperator=' AND ';}$search_sql_query.=')';return$search_sql_query;}private
static
function
buildPostElementsOptionsSearchSql($wp_query){$s=$wp_query->query_vars['s'];$search_terms=self::getSearchTerms($wp_query);$n=(isset($wp_query->query_vars['exact'])&&$wp_query->query_vars['exact'])?'':'%';$search='';if(!empty($search_terms)){$searchand='';foreach($search_terms
as$term){$term=addslashes_gpc($term);$search.="{$searchand}(option_value LIKE '{$n}{$term}{$n}')";$searchand=' AND ';}$sentence_term=esc_sql($s);if(count($search_terms)>1&&$search_terms[0]!=$sentence_term){$search="($search) OR (option_value LIKE '{$n}{$sentence_term}{$n}')";}if(!empty($search))$search=" OR ({$search}) ";}return$search;}private
static
function
getSearchTerms($wp_query){$s=isset($wp_query->query_vars['s'])?$wp_query->query_vars['s']:'';$sentence=isset($wp_query->query_vars['sentence'])?$wp_query->query_vars['sentence']:false;$search_terms=array();if(!empty($s)){$s=stripslashes($s);if($sentence){$search_terms=array($s);}else{preg_match_all('/".*?("|$)|((?<=[\\s",+])|^)[^\\s",+]+/',$s,$matches);$search_terms=array_map(create_function('$a','return trim($a, "\\"\'\\n\\r ");'),$matches[0]);}}return$search_terms;}}class
AitOptionControl
extends
NObject{protected$key;protected$value;protected$lessVar;public$id;protected$config;protected$isCloneable=false;protected$isLessVar=false;protected$idAttr='';protected$classAttr='';protected$htmlIdAndClassAttrs='';protected$nameAttr='';protected$index=0;protected$parentSection=null;protected$parentCloneOptionControl=null;protected$specialLabels=array();protected$textDomain='ait-admin';protected$capabilityEnable=false;protected$capabilityName="";public
static$useGroupKeyInNameAttr=true;public
static$useOnlySubkeyInNameAttr=false;protected
static$helpTexts=array();function
__construct(AitOptionsControlsSection$parentSection,$key='',$definition=array(),$value=''){$this->id=AitUtils::class2id(get_class($this),'OptionControl');$this->parentSection=$parentSection;$this->key=$key;if(!isset($definition['label']))$definition['label']='';if(!isset($definition['default']))$definition['default']='';$this->config=(object)$definition;$this->specialLabels=array('font'=>true,'checkbox'=>true,'radio'=>true,'on-off'=>true,'background'=>true,'clone'=>true);$this->init();if(isset($definition['text-domain'])){$this->textDomain=$definition['text-domain'];}if(isset($definition['cloneable'])){$this->isCloneable=$definition['cloneable'];}$this->setValue($value);if(isset($definition['capabilities'])){$this->capabilityEnable=$definition['capabilities'];}if($this->capabilityEnable){$this->setCapabilityName();}}static
function
resolveClass($optionControlDefinition){if(isset($optionControlDefinition['class'])and!empty($optionControlDefinition['class'])){$class=$optionControlDefinition['class'];}else{if(isset($optionControlDefinition['callback'])and!isset($optionControlDefinition['type'])){$class='AitOptionControl';}else{$class=AitUtils::id2class($optionControlDefinition['type'],'OptionControl');}}return$class;}function
getHtml(){$hidden='';if(isset($this->config->displayOnlyIf)){$fn=create_function('',"return {$this->config->displayOnlyIf};");$result=call_user_func($fn);if(!$result){$hidden=' style="display:none;" ';}}ob_start();if($this->capabilityEnable){if(current_user_can($this->getCapabilityName())){?>
				<div class="ait-opt-container ait-opt-<?php echo$this->id?>-main" <?php echo$hidden?>>
					<div class="ait-opt-wrap">

					<?php

if(isset($this->config->callback)){call_user_func($this->config->callback,$this);}else{$this->control();}?>

					</div>
				</div>
				<?php
}}else{?>
		<div class="ait-opt-container ait-opt-<?php echo$this->id?>-main" <?php echo$hidden?>>
			<div class="ait-opt-wrap">

			<?php

if(isset($this->config->callback)){call_user_func($this->config->callback,$this);}else{$this->control();}?>

			</div>
		</div>
		<?php
}return
ob_get_clean();}protected
function
init(){}protected
function
label($subKey=''){$labelText=$this->getLabelText();if($labelText){if(isset($this->specialLabels[$this->id])){?>
				<span class="ait-label"><?php echo$labelText?></span>
				<?php
}else{?>
				<label class="ait-label" for="<?php echo$this->getIdAttr($subKey)?>"><?php echo$labelText;?></label>
				<?php
}}}protected
function
getLabelText(){$labelText='';if(isset($this->config->label)and!empty($this->config->label)){$l=$this->config->label;$labelText='';$esc_html__='esc_html__';$esc_html_x='esc_html_x';if(is_string($l)){$labelText=$esc_html__($l,$this->textDomain);}elseif($l
instanceof
NNeonEntity){if($l->value=='_x'and!empty($l->attributes)){$text=$l->attributes[0];$context=$l->attributes[1];$labelText=$esc_html_x($text,$context,$this->textDomain);}}}return$labelText;}function
labelWrapper($subKey=''){?>
		<div class="ait-label-wrapper">
			<?php $this->lessVarHelp()?>
			<?php $this->label($subKey);?>
		</div>
		<?php
}protected
function
lessVarHelp(){$configName=$this->parentSection->getParentGroup()->getConfigName();$groupId=$this->parentSection->getParentGroup()->getId();if($this->isLessVar()and$groupId!='adminBranding'and
AitConfig::isMainConfigType($configName)and$this->id!='clone'):?>
		<span class="ait-label-icon">
			<span class="help">
				<?php
$vars=array_keys($this->getLessVar()?$this->getLessVar():array());foreach($vars
as$var){echo"<code>@$var</code><br>";}?>
			</span>
		</span>
		<?php endif;}protected
function
help(){$configName=$this->parentSection->getParentGroup()->getConfigName();$groupId=$this->parentSection->getParentGroup()->getId();if(!self::$helpTexts){$helpTextsFile=aitPath('config','/help-texts.php');if($helpTextsFile)self::$helpTexts=require$helpTextsFile;}if(isset($this->config->help)and!empty($this->config->help)):?>
			<div class="ait-help">
			<?php $_translate='_e';$_translate($this->config->help,$this->textDomain);?>
			</div>
			<?php

elseif(isset(self::$helpTexts[$configName][$groupId][$this->key])and
is_string(self::$helpTexts[$configName][$groupId][$this->key])):?>
			<div class="ait-help">
			<?php echo
self::$helpTexts[$configName][$groupId][$this->key];?>
			</div>
			<?php

elseif(isset(self::$helpTexts[$configName][$groupId][$this->key])and$this->isCloned()and
isset(self::$helpTexts[$configName][$groupId][$this->parentCloneOptionControl->getKey()]['items'][$this->key])):?>
			<div class="ait-help">
			<?php echo
self::$helpTexts[$configName][$groupId][$this->parentCloneOptionControl->getKey()]['items'][$this->key];?>
			</div>
			<?php

endif;}protected
function
control(){?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt">
			<div class="ait-opt-wrapper">
				<input type="text" id="<?php echo$this->getIdAttr();?>" name="<?php echo$this->getNameAttr();?>" value="<?php echo
esc_attr($this->getValue());?>">
			</div>
			<div class="ait-opt-help">
				<?php $this->help()?>
			</div>
		</div>
		<?php
}function
getIdAttr($subKey=''){$configName=$this->parentSection->getParentGroup()->getConfigName();$groupId=$this->parentSection->getParentGroup()->getId();if($this->isCloned()){$e="{$configName}-{$groupId}-{$this->parentCloneOptionControl->getKey()}-{%index%}-{$this->key}";}else{$e="{$configName}-{$groupId}-{$this->key}";}if($this->parentSection->getParentGroup()->getIndex()!==null){$e.="-__{$this->parentSection->getParentGroup()->getIndex()}__";}$id=sprintf("ait-opt-%s",$e);$id=empty($subKey)?$id:"{$id}-{$subKey}";if($this->isCloned()){$id=str_replace('-index-','-%index%-',sanitize_key(str_replace('@','internal-',$id)));}else{$id=sanitize_key(str_replace('@','internal-',$id));}return$id;}private
function
setCapabilityName(){$configName=$this->parentSection->getParentGroup()->getConfigName();$groupId=$this->parentSection->getParentGroup()->getId();$cloneKey="";if($this->isCloned()){$cloneKey=$this->parentCloneOptionControl->getKey();}$this->capabilityName=$groupId.$cloneKey.'_'.$this->key;}function
getCapabilityName(){return$this->capabilityName;}function
getNameAttr($subKey=''){$configName=$this->parentSection->getParentGroup()->getConfigName();$groupId=$this->parentSection->getParentGroup()->getId();if($this->isCloned()){$cloneKey=$this->parentCloneOptionControl->getKey();}if(AitConfig::isMainConfigType($configName)){if($this->isCloned()){$e="[$groupId][$cloneKey][%index%][$this->key]";}else{$e="[$groupId][$this->key]";}if($this->parentSection->getParentGroup()->getIndex()!==null){$e="[__{$this->parentSection->getParentGroup()->getIndex()}__]{$e}";}$name=aitOptions()->getOptionKey($configName,aitOptions()->getRequestedOid('get'));$name.=$subKey?"{$e}[{$subKey}]":$e;}else{if(self::$useGroupKeyInNameAttr){if($this->isCloned()){$e="{$groupId}[$cloneKey][%index%][$this->key]";}else{$e="{$groupId}[{$this->key}]";}}else{if($this->isCloned()){$e="{$cloneKey}[%index%][$this->key]";}else{$e=$this->key;}}if(self::$useOnlySubkeyInNameAttr
and!empty($subKey)){$name=$subKey;}else{$name=empty($subKey)?$e:"{$e}[{$subKey}]";}}return$name;}function
getValue($subKey=''){$value=$this->value;if(!empty($subKey)and
is_array($value)and
isset($value[$subKey])){$value=$value[$subKey];}return$value;}function
getKey(){return$this->key;}function
isCloneable(){return$this->isCloneable;}function
isLessVar(){$this->isLessVar=isset($this->config->less)?$this->config->less:$this->isLessVar;return$this->isLessVar;}function
isBasic(){return(isset($this->config->basic)and$this->config->basic);}function
setParentSection(AitOptionsControlsSection$optionsControlsSection){$this->parentSection=$optionsControlsSection;}function
getParentSection(){return$this->parentSection;}function
setTextDomain($textDomain){$this->textDomain=$textDomain;}function
setConfigDefaultValue($value){$this->config->default=$value;}static
function
prepareDefaultValue($controlDefinition){if(isset($controlDefinition['default'])){return$controlDefinition['default'];}else{return'';}}function
setValue($value){$this->value=$value;if($this->isLessVar()){$this->updateLessVar();}}function
isJsVar(){return
isset($this->config->jsVar)and$this->config->jsVar;}function
updateLessVar(){$prefixedKey=$this->key;$configName=$this->parentSection->getParentGroup()->getConfigName();$groupId=$this->parentSection->getParentGroup()->getId();if($configName!='elements'){$prefixedKey="{$groupId}-{$prefixedKey}";if($configName!=''){$prefixedKey="{$configName}-{$prefixedKey}";}}$prefixedKey=sanitize_html_class($prefixedKey);if($this->isCloned()){$prefixedKey.=sanitize_html_class("-{$this->parentCloneOptionControl->getKey()}");$prefixedKey.="-%index%";}$var=(object)array('name'=>'','value'=>'');$var->name=$prefixedKey;$this->lessVar=array($var->name=>$this->value);}function
getLessVar(){return$this->lessVar;}function
setParentCloneOptionControl($parentCloneOptionControl){$this->parentCloneOptionControl=$parentCloneOptionControl;$this->setValue($this->getValue());}function
getParentCloneOptionControl(){return$this->parentCloneOptionControl;}function
isCloned(){return
isset($this->parentCloneOptionControl);}}class
AitOptionControlFactory{function
createOptionControl(AitOptionsControlsSection$parentSection,$optionKey,$definition,$value){$class=AitOptionControl::resolveClass($definition);$optionControl=new$class($parentSection,$optionKey,$definition,$value);if($optionControl
instanceof
AitCloneOptionControl){if(isset($definition['items'])and!empty($definition['items'])){$cloneableOptionsControlsSectionTemplate=new
AitOptionsControlsSection($parentSection->getParentGroup());foreach($definition['items']as$templateOptionControlKey=>$templateOptionControlDefinition){$optionControlClass=AitOptionControl::resolveClass($templateOptionControlDefinition);$defaultValue=call_user_func(array($optionControlClass,'prepareDefaultValue'),$templateOptionControlDefinition);$templateOptionControl=$this->createOptionControl($cloneableOptionsControlsSectionTemplate,$templateOptionControlKey,$templateOptionControlDefinition,$defaultValue);if($templateOptionControl->isCloneable()){$templateOptionControl->setParentCloneOptionControl($optionControl);$cloneableOptionsControlsSectionTemplate->addOptionControl($templateOptionControl);}}$optionControl->setCloneableOptionsControlsSectionTemplate($cloneableOptionsControlsSectionTemplate);$clonedSectionOptionsControlsDefinitions=$definition['items'];if(!is_array($value)){$value=array();}foreach($value
as$i=>$clonedOptionsControlsSectionDefinition){foreach($clonedSectionOptionsControlsDefinitions
as$key=>$item){if(!isset($clonedOptionsControlsSectionDefinition[$key])){$clonedOptionsControlsSectionDefinition[$key]=isset($definition['default'][$i][$key])?$definition['default'][$i][$key]:'';}}$clonedOptionsControlsSection=new
AitOptionsControlsSection($parentSection->getParentGroup());foreach($clonedOptionsControlsSectionDefinition
as$key=>$clonedSectionOptionControlValue){if(isset($clonedSectionOptionsControlsDefinitions[$key])){$clonedOptionControl=$this->createOptionControl($clonedOptionsControlsSection,$key,$clonedSectionOptionsControlsDefinitions[$key],$clonedSectionOptionControlValue);if($clonedOptionControl->isCloneable()){$clonedOptionControl->setParentCloneOptionControl($optionControl);$clonedOptionsControlsSection->addOptionControl($clonedOptionControl);}}}$optionControl->addClonedOptionsControlsSection($clonedOptionsControlsSection);}$optionControl->updateLessVar($value);}}return$optionControl;}}class
AitOptionsControlsGroup{protected$id=null;protected$index=null;protected$reset=false;protected$import=false;protected$disabled=false;protected$configuration=null;protected$configName=null;protected$used=false;protected$advancedEnabled=false;protected$sections=array();function
setId($id){$this->id=$id;}function
getId(){return$this->id;}function
setIndex($index){$this->index=$index;}function
getIndex(){return$this->index;}function
setReset($reset){$this->reset=$reset;}function
getReset(){return$this->reset;}function
getImport(){return$this->import;}function
setImport($import){$this->import=$import;}function
getDisabled(){return$this->disabled;}function
setDisabled($disabled){$this->disabled=$disabled;}function
getConfiguration(){return$this->configuration;}function
setConfiguration($configuration){$this->configuration=$configuration;}function
setConfigName($configName){$this->configName=$configName;}function
getConfigName(){return$this->configName;}function
getUsed(){return$this->used;}function
setUsed($used){$this->used=$used;}function
setAdvancedEnabled($advancedEnabled){$this->advancedEnabled=$advancedEnabled;}function
areAdvancedEnabled(){return$this->advancedEnabled;}function
addSection(AitOptionsControlsSection$section){$this->sections[]=$section;}function
getSections(){return$this->sections;}}class
AitOptionsControlsGroupFactory{protected$optionsControlFactory;function
__construct(AitOptionControlFactory$optionsControlFactory){$this->optionsControlFactory=$optionsControlFactory;}function
createOptionsControlsGroup($configName,$groupId,$groupDefinition,$values,$defaultValues,$index=null){$group=new
AitOptionsControlsGroup();$group->setId($groupId);$group->setIndex($index);$group->setConfigName($configName);$group->setReset(isset($groupDefinition['@reset'])?$groupDefinition['@reset']:false);$group->setImport(isset($groupDefinition['@import'])?$groupDefinition['@import']:false);$group->setDisabled(isset($groupDefinition['@disabled'])?$groupDefinition['@disabled']:false);$group->setConfiguration(isset($groupDefinition['@configuration'])?$groupDefinition['@configuration']:false);$group->setUsed(isset($groupDefinition['@used'])?$groupDefinition['@used']:false);$group->setAdvancedEnabled(isset($values['@enabledAdvanced'])?$values['@enabledAdvanced']:0);foreach(array_values($groupDefinition['@options'])as$sectionDefinition){$section=new
AitOptionsControlsSection($group);foreach($sectionDefinition
as$optionControlKey=>$optionControlDefinition){if($optionControlKey=='@section'){$section->setTitle($optionControlDefinition->title);$section->setHelp($optionControlDefinition->help);$section->setId($optionControlDefinition->id);$section->setHidden($optionControlDefinition->hidden);$section->setAllAreAdvanced($optionControlDefinition->allAreAdvanced);if(!empty($optionControlDefinition->capabilities)){$section->setCapabilityEnabled($optionControlDefinition->capabilities);$section->setCapabilityName($group->getId()."_".$optionControlDefinition->id);}}else{if(isset($values[$optionControlKey])){$value=$values[$optionControlKey];}elseif(isset($defaultValues[$optionControlKey])){$value=$defaultValues[$optionControlKey];}else{$value=null;}$optionControl=$this->optionsControlFactory->createOptionControl($section,$optionControlKey,$optionControlDefinition,$value);$section->addOptionControl($optionControl);}}$group->addSection($section);}return$group;}}class
AitOptionsControlsSection{protected$title;protected$help;protected$id;protected$hidden;protected$allAreAdvanced;protected$configName;protected$advancedEnabled;protected$capabilityEnabled;protected$capabilityName;protected$parentGroup;protected$optionsControls=array();function
__construct(AitOptionsControlsGroup$parentGroup){$this->parentGroup=$parentGroup;}function
setAllAreAdvanced($allAreAdvanced){$this->allAreAdvanced=$allAreAdvanced;}function
areAllAdvanced(){return$this->allAreAdvanced;}function
setHelp($help){$this->help=$help;}function
getHelp(){return$this->help;}function
setHidden($hidden){$this->hidden=$hidden;}function
isHidden(){return$this->hidden;}function
setId($id){$this->id=$id;}function
getId(){return$this->id;}function
setTitle($title){$this->title=$title;}function
getTitle(){return$this->title;}function
setCapabilityEnabled($bool){$this->capabilityEnabled=(boolean)$bool;}function
isCapabilityEnabled(){return$this->capabilityEnabled;}function
setCapabilityName($name){$this->capabilityName=$name;}function
getCapabilityName(){return$this->capabilityName;}function
addOptionControl(AitOptionControl$optionControl){$this->optionsControls[$optionControl->getKey()]=$optionControl;}function
getOptionsControls(){return$this->optionsControls;}function
getOptionControl($key){return$this->optionsControls[$key];}function
setParentGroup($group){$this->parentGroup=$group;}function
getParentGroup(){return$this->parentGroup;}}class
AitTranslatableOptionControl
extends
AitOptionControl{function
getLocalisedValue($subKey='',$locale=''){$value=$this->getValue($subKey);if(!empty($locale)and
is_array($value)and
isset($value[$locale])){$value=$value[$locale];}elseif(!empty($locale)and
is_array($value)and!isset($value[$locale])and
isset($value[AitLangs::getDefaultLocale()])){$value=$value[AitLangs::getDefaultLocale()];}elseif(is_array($value)and
isset($value['en_US'])){$value=$value['en_US'];}if(is_array($value)and
empty($locale)and
isset($value[AitLangs::getDefaultLocale()])){$value=$value[AitLangs::getDefaultLocale()];}return$value;}static
function
prepareDefaultValue($controlDefinition){$defaultValue=array();foreach(AitLangs::getLocalesList()as$lc){if(isset($controlDefinition['default'])){$defaultValue[$lc]=$controlDefinition['default'];}else{$defaultValue[$lc]='';}}return$defaultValue;}protected
function
label($subKey=''){$labelText=$this->getLabelText();if($labelText){if(isset($this->specialLabels[$this->id])){?>
				<span class="ait-label"><?php echo$labelText?></span>
			<?php
}else{?>
				<label class="ait-label" for="<?php echo$this->getLocalisedIdAttr($subKey,AitLangs::getDefaultLocale())?>"><?php echo$labelText;?></label>
			<?php
}}}protected
function
getLocalisedIdAttr($subKey='',$locale=''){$idAttr=$this->getIdAttr($subKey);$idAttr.="-{$locale}";return$idAttr;}protected
function
getLocalisedNameAttr($subKey='',$locale=''){$configName=$this->parentSection->getParentGroup()->getConfigName();$nameAttr=$this->getNameAttr($subKey);if(AitConfig::isMainConfigType($configName)){$nameAttr.="[{$locale}]";}elseif($configName=='user-metabox'){$nameAttr.="[{$locale}]";}return$nameAttr;}}class
AitAddShortcodeTabOptionControl
extends
AitOptionControl{protected
function
init(){$this->specialLabels['add-shortcode-tab']=true;}protected
function
control(){?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
			<?php $this->help()?>
		</div>

		<?php
$id="ait-opt-{$this->id}-cloneable";?>

		<div class="ait-opt ait-opt-<?php echo$this->id?>" id="<?php echo$id?>">
			<div class="ait-opt-tabs-clone" id="<?php echo$id?>_template">
				<label for="<?php echo$this->getIdAttr('#index#-title')?>"><?php _e('Title for the tab','ait-admin');?></label>
				<a id="<?php echo$id?>_remove_current" href="#">&times;</a>
				<br>
				<p class="ait-opt-wrapper">
					<input type="text" class="full-width" id="<?php echo$this->getIdAttr('#index#-title')?>" name="tab[#index#][title]" value="<?php echo
esc_attr($this->getValue('title'))?>">
				</p>
				<label for="<?php echo$this->getIdAttr('#index#-content')?>"><?php _e('Content of the tab','ait-admin')?></label><br>
				<p class="ait-opt-wrapper">
					<textarea id="<?php echo$this->getIdAttr('#index#-content')?>" name="tab[#index#][content]"><?php echo
esc_textarea($this->value['content'])?></textarea>
				</p>
			</div>

			 <div id="<?php echo$id?>_noforms_template"><?php _e('No tabs','ait-admin')?></div>

			<p id="<?php echo$id?>_controls">
				<input type="button" class="button button-secondary" id="<?php echo$id?>_add" value="<?php _e('Add another tab','ait-admin')?>">
			</p>
		</div>

		<?php
$this->shortcodeBuilderJs();}protected
function
shortcodeBuilderJs(){?>
		<script>
		(function($){ $(function(){

			if(ait.admin.shortcodes){

				$('#<?php echo"ait-opt-{$this->id}-cloneable"?>').sheepIt({
					separator: '',
					allowRemoveCurrent: true,
					allowAdd: true,
					minFormsCount: 1,
					iniFormsCount: 1
				});


				var builder = ait.admin.shortcodes.Builder;

				// Custom build method
				builder.onBuild['tabs'] =  function(tag, rawFormData, defaultAttrs, type){

					var content = '<br>\n';
					var tabClones = rawFormData.tab;

					delete defaultAttrs.tab;
					delete rawFormData.tab;

					var attrs = _.defaults(rawFormData, defaultAttrs);

					// Remove default attributes from the shortcode.
					_.each(defaultAttrs, function(value, key){
						if(value == attrs[key])
							delete attrs[key];
					});

					// creates [tab title=""] shortcodes from form
					$.each(tabClones, function(i, val){
						content += wp.shortcode.string({
							tag: 'tab',
							attrs: {title: val.title},
							type: 'closed',
							content: val.content
						}) + '<br>\n';
					});

					// returs [tabs animation="1"] shortcode with content
					// of [tab] shorgcodes generated above
					return wp.shortcode.string({
						tag: tag,
						attrs: attrs,
						type: 'closed',
						content: content
					});
				};
			}

		});}(jQuery));
		</script>
		<?php
}}class
AitBackgroundOptionControl
extends
AitOptionControl{protected
function
init(){$this->isLessVar=true;}protected
function
control(){$d=(object)$this->config->default;?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">
			<?php if(isset($d->color)):?>
				<div class="ait-opt-bgcolorpicker">
					<div class="ait-opt-bg-item ait-opt-bg-color">
						<?php
$format=isset($d->opacity)?'rgba':'hex';$hex=AitUtils::rgba2hex($this->getValue('color'));$required=(isset($this->config->required)and$this->config->required)?'1':'0';?>
						<label for="<?php echo$this->getIdAttr('background-color');?>"><?php _e('Background Color','ait-admin')?></label>
						<div class="ait-colorpicker ait-control-wrapper">
							<span class="ait-colorpicker-preview"><i style="background-color: <?php echo
esc_attr($this->getValue('color'));?>"></i></span>
							<input type="text" class="ait-colorpicker-color" data-color-format="<?php echo$format?>" id="<?php echo$this->getIdAttr('background-color');?>" value="<?php echo$hex->hex?>">
							<input type="hidden" class="ait-colorpicker-storage" name="<?php echo$this->getNameAttr('color');?>" value="<?php echo
esc_attr($this->getValue('color'));?>">
							<input type="hidden" class="ait-colorpicker-required" value="<?php echo$required?>">
							<?php if($format!="hex"):?>
							<input type="text" class="ait-colorpicker-opacity" value="<?php echo$hex->opacity?>"><span class="ait-unit"> %</span>
							<?php elseif($format=="hex"):?>
							<span class="ait-unit ait-value">100</span> <span class="ait-unit"> %</span>
							<?php endif;?>
						</div>
					</div>
					<?php if($required=='1'):?>
						<div class="ait-opt-required"><span><?php _ex('Required','mark for form input','ait-admin')?></span></div>
					<?php endif;?>
				</div>
				<?php endif;?>

				<?php if(isset($d->image)):?>
				<div class="ait-opt-bg-item ait-opt-bg-image">
					<label for="<?php echo$this->getIdAttr('background-image');?>"><?php _e('Background Image','ait-admin')?></label>
					<div class="ait-imagepicker ait-control-wrapper">
						<input type="text" class="ait-image-value-fake"  id="<?php echo$this->getIdAttr('background-image')?>" value="<?php echo
esc_attr($this->getValue('image'))?>">
						<input type="hidden" class="ait-image-value" name="<?php echo$this->getNameAttr('image');?>" value="<?php echo
esc_attr($this->getValue('image'))?>">
                        <?php if($this->getParentSection()->getParentGroup()->getConfigName()!='shortcodes'):?>
						<input type="button" class="ait-image-select" <?php echo
aitDataAttr('select-image',array('title'=>sprintf(__('Select Background Image for: %s','ait-admin'),$this->config->label),'buttonTitle'=>__('Insert Image','ait-admin')))?> value="<?php _e('Select Image','ait-admin')?>" value="<?php _e('Select Image','ait-admin')?>" id="<?php echo$this->getIdAttr('background-image-button')?>">
                        <?php endif;?>
					</div>
				</div>
				<?php endif;?>


				<div class="ait-opt-tools ait-opt-bg-tools">
				<div class="ait-opt-tools-row">
				<?php if(isset($d->repeat)or
isset($d->position)or
isset($d->scroll)):?> <div class="ait-opt-tools-cell1"><?php endif;?>
				<?php if(isset($d->repeat)):?>
				<div class="ait-opt-bg-item ait-opt-bg-repeat">
					<label for="<?php echo$this->getIdAttr('background-repeat');?>"><?php _e('Repeat','ait-admin')?></label><!--
					--><div class="ait-control-wrapper">
						<select id="<?php echo$this->getIdAttr('background-repeat');?>" name="<?php echo$this->getNameAttr('repeat');?>">
							<?php
$repeats=array('repeat'=>__('repeat','ait-admin'),'no-repeat'=>__('no-repeat','ait-admin'),'repeat-x'=>__('repeat-x','ait-admin'),'repeat-y'=>__('repeat-y','ait-admin'));foreach($repeats
as$r=>$label):?>
							<option value="<?php echo$r?>" <?php selected($this->getValue('repeat'),$r)?>><?php echo$label?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<?php endif;?>

				<?php if(isset($d->position)):?>
				<div class="ait-opt-bg-item ait-opt-bg-position">
					<label for="<?php echo$this->getIdAttr('background-position');?>"><?php _e('Position','ait-admin')?></label><!--
					--><div class="ait-control-wrapper">
						<select id="<?php echo$this->getIdAttr('background-position');?>" name="<?php echo$this->getNameAttr('position');?>">
							<?php
$positions=array('top left'=>__('top left','ait-admin'),'top center'=>__('top center','ait-admin'),'top right'=>__('top right','ait-admin'),'center left'=>__('center left','ait-admin'),'center center'=>__('center center','ait-admin'),'center right'=>__('center right','ait-admin'),'bottom left'=>__('bottom left','ait-admin'),'bottom center'=>__('bottom center','ait-admin'),'bottom right'=>__('bottom right','ait-admin'));foreach($positions
as$pos=>$label):?>
							<option value="<?php echo$pos?>" <?php selected($this->getValue('position'),$pos)?>><?php echo$label?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<?php endif;?>

				<?php if(isset($d->scroll)):?>
				<div class="ait-opt-bg-item ait-opt-bg-scroll">
					<label for="<?php echo$this->getIdAttr('background-scroll');?>"><?php _e('Scroll','ait-admin')?></label><!--
					--><div class="ait-control-wrapper">
						<select id="<?php echo$this->getIdAttr('background-scroll');?>" name="<?php echo$this->getNameAttr('scroll');?>">
							<?php
$scrolls=array('fixed'=>__('fixed','ait-admin'),'scroll'=>__('scroll','ait-admin'));foreach($scrolls
as$scroll=>$label):?>
							<option value="<?php echo$scroll?>" <?php selected($this->getValue('scroll'),$scroll)?>><?php echo$label?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<?php endif;?>
				<?php if(isset($d->repeat)or
isset($d->position)or
isset($d->scroll)):?> </div><?php endif;?>

				<div class="ait-opt-tools-cell2">
					<div class="ait-opt-bg-item ait-opt-bg-wrap">
						<div class="ait-opt-bg-screen">
							<div class="ait-opt-bg-preview">&nbsp;</div>
						</div>
					</div>
				</div>

				</div>
				</div><!-- end of ait-opt-tools -->

			</div>

			<?php $this->help()?>
		</div>
		<?php
}static
function
prepareDefaultValue($optionControlDefinition){$d=array('color'=>'','opacity'=>1,'image'=>'','repeat'=>'','position'=>'','scroll'=>'');$d=array_merge($d,$optionControlDefinition['default']);$opacity=isset($d['opacity'])?floatval($d['opacity']):1;if($opacity>1)$opacity/=100;if(AitUtils::startsWith($d['color'],'#')and$opacity!=1){$r=0;$g=0;$b=0;extract(AitUtils::hex2rgb($d['color']));$rgba=sprintf("rgba(%s, %s, %s, %s)",$r,$g,$b,$opacity);$d['color']=$rgba;}if(!empty($d['image'])and!AitUtils::isExtUrl($d['image'])){if(AitUtils::contains($d['image'],'admin/assets/img')){$d['image']=aitPaths()->url->fw.$d['image'];}else{$fullUrl=aitUrl('theme',$d['image']);if($fullUrl!==false){$d['image']=$fullUrl;}}}return$d;}function
updateLessVar(){parent::updateLessVar();$lessVarBaseName=key($this->lessVar);$lessVar=array();if(isset($this->config->default['color']))$lessVar["{$lessVarBaseName}-color"]=$this->value['color'];if(isset($this->config->default['image'])){$lessVar["{$lessVarBaseName}-image"]=!empty($this->value['image'])?"url('".$this->value['image']."')":'none';}if(isset($this->config->default['repeat']))$lessVar["{$lessVarBaseName}-repeat"]=$this->value['repeat'];if(isset($this->config->default['position']))$lessVar["{$lessVarBaseName}-position"]=$this->value['position'];if(isset($this->config->default['scroll']))$lessVar["{$lessVarBaseName}-scroll"]=$this->value['scroll'];$this->lessVar=$lessVar;}}class
AitCategoriesFeaturedOptionControl
extends
AitOptionControl{protected
function
control(){$val=$this->getValue();$multi=(isset($this->config->multiple)and$this->config->multiple)?"multiple":'';if(isset($this->config->taxonomy)){$taxonomy=AitUtils::addPrefix($this->config->taxonomy,'taxonomy');}else{$taxonomy='category';}if($multi
and
is_array($val)and
empty($val)){$val=-1;}if(!($lang=AitLangs::checkIfPostAndGetLang())){$lang=AitLangs::getDefaultLang();}if(taxonomy_exists($taxonomy)){$output=array();$categories=get_terms($taxonomy,array('hide_empty'=>true));$allFeatured=0;foreach($categories
as$category){$result=array('category'=>$category,'counts'=>0);$posts_query=new
WP_Query(array('post_type'=>'ait-item','tax_query'=>array(array('taxonomy'=>$taxonomy,'field'=>'slug','terms'=>$category->slug))));foreach($posts_query->posts
as$post){$meta=(object)array_shift(get_post_meta($post->ID,'_ait-item_item-data'));if($meta->featured=='1'){$allFeatured=$allFeatured+1;$result['counts']=$result['counts']+1;}}array_push($output,$result);}$html='<select name="'.$this->getNameAttr().'" id="'.$this->getIdAttr().'" class="'.$this->id.' chosen">';$html.='<option value="0">'.__('All','ait-admin').'&nbsp;&nbsp;('.$allFeatured.')</option>';foreach($output
as$out){$selected='';if($out['category']->term_id==$val){$selected="selected";}$html.='<option value="'.$out['category']->term_id.'" '.$selected.'>'.$out['category']->name.'&nbsp;&nbsp;('.$out['counts'].')</option>';}$html.='</select>';$tax=get_taxonomy($taxonomy);if($this->config->label=='@native')$this->config->label=$tax->labels->singular_name;$cpt=get_post_type_object($tax->object_type[0]);if($multi){$html=str_replace("class=",$multi." class=",$html);$html=str_replace("' id=","[]' id=",$html);}$at=admin_url("edit-tags.php?taxonomy={$tax->name}&amp;post_type={$cpt->name}");$t="<a href='{$at}' target='_blank'>{$tax->label}</a>";$ap=admin_url("edit.php?post_type={$cpt->name}");$p="<a href='{$ap}' target='_blank'>{$cpt->labels->name}</a>";$none=sprintf(__("<strong>All available %s will be displayed.</strong><br><em>(Because there are no categories in %s or all categories are empty)</em>",'ait-admin'),$p,$t);?>

		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<?php if(!empty($html)):?>
			<?php $lang=AitLangs::checkIfPostAndGetLang();?>
			<div class="ait-opt-wrapper chosen-wrapper <?php echo
AitLangs::htmlClass($lang?$lang->locale:'')?>">
				<?php if(AitLangs::isEnabled()){if($lang){?>
						<div class="flag"> <?php

echo$lang->flag;?> </div> <?php
}else{?>
						<div class="flag"> <?php

echo
AitLangs::getDefaultLang()->flag;?> </div> <?php
}}?>
				<?php echo$html;?>
			</div>
			<?php else:?>
				<div class="ait-sys-message ait-sys-message-notice">
				<?php echo$none;?>
                <input id="<?php echo$this->getIdAttr()?>" type="hidden" disabled="disabled" /> <?php ?>
				</div>
			<?php endif;?>
		</div>
		<div class="ait-opt-help">
			<div class="ait-opt-<?php echo$this->id?>-add">
				<a href="<?php echo$at?>" target="_blank">+ <?php echo$tax->labels->add_new_item?></a>
			</div>
			<?php $this->help()?>
		</div>

		<?php
}else{echo"<strong style='color:red'>Taxonomy <code>{$taxonomy}</code> doesn't exist.</strong>";}}static
function
prepareDefaultValue($optionControlDefinition){return$optionControlDefinition['default']==''?0:$optionControlDefinition['default'];}}class
AitCategoriesOptionControl
extends
AitOptionControl{protected
function
control(){$val=$this->getValue();$multi=(isset($this->config->multiple)and$this->config->multiple)?"multiple":'';if(isset($this->config->taxonomy)){$taxonomy=AitUtils::addPrefix($this->config->taxonomy,'taxonomy');}else{$taxonomy='category';}if($multi
and
is_array($val)and
empty($val)){$val=-1;}add_filter('ait-langs-enabled','__return_true');if(!($lang=AitLangs::checkIfPostAndGetLang())){$lang=null;}remove_filter('ait-langs-enabled','__return_true');$multiSelected=array();$singleSelected='0';if($multi
and
is_array($val)){$multiSelected=$val;}else{$singleSelected=$val;}if(taxonomy_exists($taxonomy)){$defaultArgs=array('name'=>$this->getNameAttr(),'id'=>$this->getIdAttr(),'class'=>$this->id.' chosen','taxonomy'=>$taxonomy,'selected'=>$singleSelected,'@multi_selected'=>$multiSelected,'orderby'=>"NAME",'hierarchical'=>1,'show_option_all'=>$multi?false:esc_html__('All','ait-admin'),'show_option_none'=>false,'hide_if_empty'=>true,'hide_empty'=>true,'show_count'=>true,'lang'=>$lang?$lang->slug:null,'echo'=>false,'walker'=>new
AitCategoryDropdownWalker);if(!isset($this->config->args)){$args=$defaultArgs;}else{$args=$this->config->args;if(!is_array($args)){$args=array();}$args=array_merge($defaultArgs,$args);$args['echo']=false;}$html=wp_dropdown_categories($args);$tax=get_taxonomy($taxonomy);if($this->config->label=='@native')$this->config->label=$tax->labels->singular_name;$cpt=get_post_type_object($tax->object_type[0]);if($multi){$html=str_replace("class=",$multi." class=",$html);$html=str_replace("' id=","[]' id=",$html);}$html=str_replace('class=','data-placeholder="'.esc_html__('- select -','ait-admin').'" class=',$html);$at=admin_url("edit-tags.php?taxonomy={$tax->name}&amp;post_type={$cpt->name}");$t="<a href='{$at}' target='_blank'>{$tax->label}</a>";$ap=admin_url("edit.php?post_type={$cpt->name}");$p="<a href='{$ap}' target='_blank'>{$cpt->labels->name}</a>";$none=sprintf(__("<strong>All available %s will be displayed.</strong><br><em>(Because there are no categories in %s or all categories are empty)</em>",'ait-admin'),$p,$t);?>

		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">

			<?php if(!empty($html)):?>
			<div class="ait-opt-wrapper chosen-wrapper">
				<?php echo$html;?>
			</div>
			<?php else:?>
				<div class="ait-sys-message ait-sys-message-notice">
				<?php echo$none;?>
                <input id="<?php echo$this->getIdAttr()?>" type="hidden" disabled="disabled" /> <?php ?>
				</div>
			<?php endif;?>


		</div>

		<div class="ait-opt-help">
			<div class="ait-opt-<?php echo$this->id?>-add">
				<?php if(isset($this->config->addnew)){if($this->config->addnew!=false){?>
						<a href="<?php echo$at?>" target="_blank">+ <?php echo$tax->labels->add_new_item?></a>
					<?php }}else{if(current_user_can('manage_options')){?>
				<a href="<?php echo$at?>" target="_blank">+ <?php echo$tax->labels->add_new_item?></a>
				<?php }}?>
			</div>
			<?php $this->help()?>
		</div>

		<?php
}else{echo"<strong style='color:red'>Taxonomy <code>{$taxonomy}</code> doesn't exist.</strong>";}}static
function
prepareDefaultValue($optionControlDefinition){return$optionControlDefinition['default']==''?'0':$optionControlDefinition['default'];}}class
AitCheckboxOptionControl
extends
AitOptionControl{protected
function
control(){$values=$this->getValue();if(!isset($values['twoormore'])){?>
			<div class="ait-opt-label">
				<?php $this->labelWrapper()?>
			</div>

			<div class="ait-opt ait-opt-<?php echo$this->id?>">
				<div class="ait-opt-wrapper">

				<?php foreach((array)$this->config->default
as$input=>$label){$value=isset($values[$input])?$values[$input]:false;?>

					<label for="<?php echo$this->getIdAttr($input)?>">
						<input type="checkbox" id="<?php echo$this->getIdAttr($input)?>" name="<?php echo$this->getNameAttr($input);?>" <?php checked($value,$input);?>  value="<?php echo$input?>">
						 <?php $_translate='_e';$_translate($label,'ait-admin')?>
					</label>

				<?php }?>

				</div>
			</div>

			<div class="ait-opt-help">
				<?php $this->help()?>
			</div>
			<?php
}else{?> <p><strong style='color:red'><?php echo$values['twoormore']?> </strong></p> <?php
}}static
function
prepareDefaultValue($optionControlDefinition){if(is_array($optionControlDefinition['default'])and
count($optionControlDefinition['default'])>1){if(isset($optionControlDefinition['checked'])and
is_array($optionControlDefinition['checked'])){return@array_combine($optionControlDefinition['checked'],$optionControlDefinition['checked']);}else{return
array();}}else{return
array('twoormore'=>'checkbox input type can be used only with two or more options otherwise use on-off input type');}}}class
AitCloneOptionControl
extends
AitOptionControl{protected$isCloneable=false;protected$clonedOptionsControlsSections=array();protected$cloneableOptionsControlsSectionTemplate;protected
function
init(){$this->isLessVar=true;}static
function
prepareDefaultValue($optionControlDefinition){if(isset($optionControlDefinition['items'])and!empty($optionControlDefinition['items'])){$items=$optionControlDefinition['items'];}else{trigger_error("Clones can not be created because in the config there are no items specified under key 'items'");return
array();}$clonesDefaultValues=array();foreach($optionControlDefinition['default']as$defaultCloneDefinition){$clonesDefaultValue=array();foreach($defaultCloneDefinition
as$key=>$value){if(isset($items[$key])){$itemDefinition=$items[$key];if(isset($itemDefinition['type'])or(!isset($itemDefinition['type'])and
isset($itemDefinition['callback']))){$optionControlClass=AitOptionControl::resolveClass($itemDefinition);$itemDefinition['default']=$value;$defaultValue=call_user_func(array($optionControlClass,'prepareDefaultValue'),$itemDefinition);$clonesDefaultValue[$key]=$defaultValue;}else{trigger_error(sprintf("Clone item %s has no 'type' key defined.",print_r($itemDefinition,true)));}}}$clonesDefaultValues[]=$clonesDefaultValue;}return$clonesDefaultValues;}function
setCloneableOptionsControlsSectionTemplate(AitOptionsControlsSection$template){$this->cloneableOptionsControlsSectionTemplate=$template;}function
addClonedOptionsControlsSection(AitOptionsControlsSection$clonedOptionsControlsSection){$this->clonedOptionsControlsSections[]=$clonedOptionsControlsSection;}protected
function
control(){?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
			<?php $this->help()?>
		</div>

		<?php
$containerId=$this->getIdAttr();?>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div id="<?php echo$containerId?>" class="ait-clone-controls"
				 data-confirm-message="<?php _e('Are you sure?','ait-admin');?>"
				 data-min-forms="<?php echo$this->getMin();?>"
				 data-max-forms="<?php echo$this->getMax();?>"
				 data-allow-remove-all="<?php echo$this->getRemoveAll();?>"
				>

				<div id="<?php echo$containerId?>_noforms_template" class="ait-clone-noforms">
					<?php _e('No Items Defined','ait-admin')?>
					<input type="hidden" name="<?php echo$this->getNameAttr()?>" value="">
				</div>

				<?php
$clonedOptionsControlsSections=$this->getClonedOptionsControlsSections();foreach($clonedOptionsControlsSections
as$i=>$clonedOptionsControlsSection){$id="{$containerId}-{$i}-pregenerated";$class="ait-clone-item ait-pregenerated-clone-item";$firstTextInputValue=$this->getClonedOptionsControlsSectionLabel($clonedOptionsControlsSection);$sort=(isset($this->config->sort)and$this->config->sort===false)?'':'clone-sort';?>
					<div id="<?php echo$id?>" class="<?php echo$class?>">
						<div class="form-input-handler <?php echo$sort?>">
							<div class="form-input-title"><?php echo$firstTextInputValue?esc_html($firstTextInputValue):_x('Input','default title for cloned form item','ait-admin')?> </div>
							<a id="<?php echo$containerId?>_remove_current" href="#"
							   class="ait-clone-remove-current">&times;</a></div>
						<div class="form-input-content" style="display: none">
							<?php

foreach($clonedOptionsControlsSection->getOptionsControls()as$optionControl){echo$optionControl->getHtml();}?>
						</div>
					</div>
				<?php
}echo$this->getCloneableOptionsControlsSectionTemplateHtml();?>


			</div>

			<div id="<?php echo$containerId?>_controls" class="ait-clone-tools">
				<div id="<?php echo$containerId?>_add" class="ait-clone-add ait-clone-control-link">
					<a href="#"><?php _e('+ Add New Item','ait-admin')?></a>
				</div>
				<div id="<?php echo$containerId?>_toggle_all" class="ait-clone-toggle-all ait-clone-control-link">
					<a href="#"><?php _e('Open/Collapse All Items','ait-admin')?></a>
				</div>
				<div id="<?php echo$containerId?>_remove_last" class="ait-clone-remove-last ait-clone-control-link">
					<a href="#"><?php _e('Remove','ait-admin')?></a>
				</div>
				<div id="<?php echo$containerId?>_remove_all" class="ait-clone-remove-all ait-clone-control-link">
					<a href="#"><?php _e('Remove All Items','ait-admin')?></a>
				</div>
			</div>

		</div>
	<?php
}function
getMin(){return
isset($this->config->min)?$this->config->min:0;}function
getMax(){return(isset($this->config->max)and$this->config->max!='infinity')?$this->config->max:0;}function
getRemoveAll(){return(isset($this->config->removeAll)and$this->config->removeAll===false)?"false":"true";}function
setClonedOptionsControlsSections($clonedOptionsControlsSections){$this->clonedOptionsControlsSections=$clonedOptionsControlsSections;}function
getClonedOptionsControlsSections(){return$this->clonedOptionsControlsSections;}protected
function
getClonedOptionsControlsSectionLabel(AitOptionsControlsSection$clonedOptionsControlsSection){$label='';$lang=AitLangs::checkIfPostAndGetLang();$locale=$lang?$lang->locale:AitLangs::getDefaultLocale();foreach($clonedOptionsControlsSection->getOptionsControls()as$optionControl){if($optionControl
instanceof
AitTextOptionControl&&$optionControl->getLocalisedValue('',$locale)){$label=$optionControl->getLocalisedValue('',$locale);break;}else{if($optionControl
instanceof
AitStringOptionControl&&$optionControl->getValue()){$label=$optionControl->getValue();break;}}}return$label;}protected
function
getCloneableOptionsControlsSectionTemplateHtml(){$sort=(isset($this->config->sort)and$this->config->sort===false)?'':'clone-sort';$containerId=$this->getIdAttr();$templateHtml="<div id='{$containerId}_template' class='ait-clone-item'>";$templateHtml.='<div class="form-input-handler {$sort}"><div class="form-input-title">'._x('Input','default title for cloned form item','ait-admin').'</div> <a id="'.$containerId.'_remove_current" href="#" class="ait-clone-remove-current">&times;</a></div>
						<div class="form-input-content">';foreach($this->cloneableOptionsControlsSectionTemplate->getOptionsControls()as$optionControl){$templateHtml.=$optionControl->getHtml();}$templateHtml.="</div></div>";return$templateHtml;}function
updateLessVar(){parent::updateLessVar();$lessVarBaseName=key($this->lessVar);$lessVar=array();$clonedOptionsControlsSections=$this->getClonedOptionsControlsSections();foreach($clonedOptionsControlsSections
as$i=>$clonedOptionsControlsSection){foreach($clonedOptionsControlsSection->getOptionsControls()as$optionControl){if($optionControl->isLessVar()){$var=$optionControl->getLessVar();$cloneKey=$optionControl->getKey();$lessVar["{$lessVarBaseName}-{$cloneKey}-{$i}"]=reset($var);}}}$this->lessVar=$lessVar;}}class
AitCodeOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){?>

		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">
				<input type="text" id="<?php echo$this->getIdAttr()?>" name="<?php echo$this->getNameAttr()?>" value="<?php echo
esc_textarea($this->getValue())?>">
			</div>

			<?php $this->help()?>
		</div>

		<?php
}}class
AitColorOptionControl
extends
AitOptionControl{protected
function
init(){$this->isLessVar=true;$this->isCloneable=true;}protected
function
control(){$format=isset($this->config->opacity)?'rgba':'hex';$hex=AitUtils::rgba2hex($this->getValue());$required=(isset($this->config->required)and$this->config->required)?'1':'0';?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?> <?php if($format!="hex"):?>ait-opt-opacity<?php endif;?>">
			<div class="ait-opt-wrapper">
				<div class="ait-colorpicker ait-control-wrapper">
					<span class="ait-colorpicker-preview"><i style="background-color: <?php echo
esc_attr($this->getValue())?>"></i></span>
					<input type="text" class="ait-colorpicker-color" data-color-format="<?php echo$format?>" id="<?php echo$this->getIdAttr()?>" value="<?php echo$hex->hex?>">
					<input type="hidden" class="ait-colorpicker-required" value="<?php echo$required?>">
					<input type="hidden" class="ait-colorpicker-storage" name="<?php echo$this->getNameAttr()?>" value="<?php echo
esc_attr($this->getValue())?>">
					<?php if($format!="hex"):?>
					<input type="text" class="ait-colorpicker-opacity" value="<?php echo$hex->opacity?>"><span class="ait-unit"> %</span>
					<?php elseif($format=="hex"):?>
					<span class="ait-unit ait-value">100</span> <span class="ait-unit"> %</span>
					<?php endif;?>
				</div>
			</div>
		</div>

		<?php if($required=='1'):?>
			<div class="ait-opt-help">
				<div class="ait-opt-required">
					<span><?php _ex('Required','mark for form input','ait-admin')?></span>
					<?php $this->help()?>
				</div>
			</div>
		<?php else:?>
			<div class="ait-opt-help">
				<?php $this->help()?>
			</div>
		<?php endif;?>
		<?php
}static
function
prepareDefaultValue($optionControlDefinition){$opacity=isset($optionControlDefinition['opacity'])?floatval($optionControlDefinition['opacity']):1;if($opacity>1){$opacity/=100;}if(!isset($optionControlDefinition['default']))$optionControlDefinition['default']='';$default=$optionControlDefinition['default'];if(AitUtils::startsWith($default,'#')and$opacity!=1){$r=0;$g=0;$b=0;extract(AitUtils::hex2rgb($default));$default=sprintf("rgba(%s, %s, %s, %s)",$r,$g,$b,$opacity);}return$default;}}class
AitColumnsOptionControl
extends
AitOptionControl{protected
static$layouts=array('1'=>array('column-grid-2'=>array('column-span-2'=>array('column-span-2'=>'1/1'))),'2'=>array('column-grid-2'=>array('column-span-1,column-span-1'=>array('column-span-1'=>'1/2')),'column-grid-3'=>array('column-span-2,column-span-1'=>array('column-span-2'=>'2/3','column-span-1'=>'1/3')),'column-grid-4'=>array('column-span-3,column-span-1'=>array('column-span-3'=>'3/4','column-span-1'=>'1/4')),'column-grid-5'=>array('column-span-4,column-span-1'=>array('column-span-1'=>'1/5','column-span-4'=>'4/5'),'column-span-3,column-span-2'=>array('column-span-2'=>'2/5','column-span-3'=>'3/5'))),'3'=>array('column-grid-3'=>array('column-span-1,column-span-1,column-span-1'=>array('column-span-1'=>'1/3')),'column-grid-4'=>array('column-span-2,column-span-1,column-span-1'=>array('column-span-1'=>'1/4','column-span-2'=>'2/4')),'column-grid-5'=>array('column-span-3,column-span-1,column-span-1'=>array('column-span-1'=>'1/5','column-span-3'=>'3/5'),'column-span-2,column-span-2,column-span-1'=>array('column-span-1'=>'1/5','column-span-2'=>'2/5'))),'4'=>array('column-grid-4'=>array('column-span-1,column-span-1,column-span-1,column-span-1'=>array('column-span-1'=>'1/4')),'column-grid-5'=>array('column-span-2,column-span-1,column-span-1,column-span-1'=>array('column-span-1'=>'1/5','column-span-2'=>'2/5'))),'5'=>array('column-grid-5'=>array('column-span-1,column-span-1,column-span-1,column-span-1,column-span-1'=>array('column-span-1'=>'1/5'))),'6'=>array('column-grid-6'=>array('column-span-1,column-span-1,column-span-1,column-span-1,column-span-1,column-span-1'=>array('column-span-1'=>'1/6'))));protected$selectedLayout=array();protected
function
control(){?>
        <div class="ait-grid">
            <div class="ait-grid-row">
                <div class="ait-top-panel">
                    <div class="btn-groups">
                        <?php foreach(self::$layouts
as$columnsCount=>$gridsOptions):?>
                            <?php
$hasOnlyOneLayoutOption=false;$columnsCssClassesOption='';foreach($gridsOptions
as$columnsCssClassesOptions){foreach(array_keys($columnsCssClassesOptions)as$columnsCssClassesOption){if(!$hasOnlyOneLayoutOption){$hasOnlyOneLayoutOption=true;}else{$hasOnlyOneLayoutOption=false;break
2;}}}?>
                            <?php if($hasOnlyOneLayoutOption):?>
                                <div class="btn-group">
                                    <?php $columnsNames=array();$columnsCssClasses=explode(',',$columnsCssClassesOption);$gridOption=current($gridsOptions);foreach($columnsCssClasses
as$columnsCssClass){array_push($columnsNames,$gridOption[$columnsCssClassesOption][$columnsCssClass]);}?>
                                    <span class="btn change-columns" data-ait-grid-css-class="<?php echo
key($gridsOptions);?>" data-ait-columns-css-classes="<?php echo
key(current($gridsOptions))?>" data-ait-columns-names="<?php echo
implode(',',$columnsNames);?> ">
                                        <span class="btn-icon"><?php _e('1 Col','ait-admin')?></span>
                                    </span>
                                </div>
                            <?php else:?>
                                <div class="btn-group">
                                <span class="btn dropdown-toggle" data-toggle="dropdown">
                                        <span class="btn-icon"><?php echo$columnsCount;?></span>
                                        <span class="caret"></span>
                                    </span>
                                <ul class="dropdown-menu">
                                <?php

foreach($gridsOptions
as$gridCssClass=>$columnsCssClassesOptions):foreach(array_keys($columnsCssClassesOptions)as$columnsCssClassesOption):$columnsNames=array();$columnsCssClasses=explode(',',$columnsCssClassesOption);foreach($columnsCssClasses
as$columnsCssClass){array_push($columnsNames,$columnsCssClassesOptions[$columnsCssClassesOption][$columnsCssClass]);}?>
                                            <li><a class="change-columns" data-ait-grid-css-class="<?php echo$gridCssClass?>" data-ait-columns-css-classes="<?php echo$columnsCssClassesOption;?>" data-ait-columns-names="<?php echo
implode(',',$columnsNames);?>" href="#"><?php echo
implode(' ',$columnsNames)?></a></li>
                                            <?php

endforeach;endforeach;?>
                                    </ul>
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>

                </div>
                <div class="ait-table-content">
                <div class="ait-row-content column-grid <?php echo$this->getValue('grid-css-class');?>">
                <?php
$columnsCssClasses=array_map('trim',explode(',',$this->getValue('columns-css-classes')));foreach($columnsCssClasses
as$columnCssClass):?>
                    <div class="ait-column <?php echo$columnCssClass?>" data-ait-column-css-class="<?php echo$columnCssClass?>"><div class="ait-column-handle"><h4><?php echo$this->resolveColumnNameForColumnCssClass($columnCssClass);?></h4></div><div class="ait-column-content"></div></div>
                <?php

endforeach;?>
                </div>
                </div>
                <input type="hidden" id="<?php echo$this->getIdAttr('grid-css-class');?>" name="<?php echo$this->getNameAttr('grid-css-class');?>" value="<?php echo
esc_attr($this->getValue('grid-css-class'))?>" />
                <input type="hidden" id="<?php echo$this->getIdAttr('columns-css-classes');?>" name="<?php echo$this->getNameAttr('columns-css-classes');?>" value="<?php echo
esc_attr($this->getValue('columns-css-classes'))?>" />
            </div>
            <div class="ait-columns-editor hidden">
                <div class="ait-columns-editor-element-header">
                    <div class="ait-columns-editor-element-title"><h4></h4><span title="<?php _e('Edit element description','ait-admin');?>" class="ait-element-user-description"></span></div>
                    <a class="ait-columns-editor-remove" href="#">x</a>
                </div>
                <div class="ait-columns-editor-element-options"></div>
            </div>
		</div>
		<?php
}private
function
resolveColumnNameForColumnCssClass($columnCssClass){$columnName='';$columnsCssClasses=array_map('trim',explode(',',$this->getValue('columns-css-classes')));$columnsCssClassesOptions=self::$layouts[count($columnsCssClasses)][$this->getValue('grid-css-class')];foreach(array_keys($columnsCssClassesOptions)as$columnsCssClassesOption){foreach($columnsCssClasses
as$class){if(strpos($columnsCssClassesOption,$class)===false){continue
2;}}$columnName=$columnsCssClassesOptions[$columnsCssClassesOption][$columnCssClass];}return$columnName;}}class
AitCustomCssOptionControl
extends
AitOptionControl{protected
function
control(){?>
		<!--
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>
		-->

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">
				<textarea id="<?php echo$this->getIdAttr()?>" name="<?php echo$this->getNameAttr()?>" rows="20" cols="80"><?php echo
esc_textarea($this->getValue())?></textarea>
			</div>

			<?php $this->help()?>
		</div>
		<?php
}}class
AitDateOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){$langCode=AitLangs::getCurrentLanguageCode();if($langCode==='br'){$langCode='pt-BR';}elseif($langCode==='cn'){$langCode='zh-CN';}elseif($langCode==='tw'){$langCode='zh-TW';}$dataAttr=array('dateFormat'=>$this->hasCustomFormat()?$this->getFormat():AitUtils::phpDate2jsDate($this->getFormat()),'timeFormat'=>AitUtils::phpTime2jsTime(get_option('time_format')),'pickerType'=>isset($this->config->picker)?$this->config->picker:"date",'langCode'=>$langCode);?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">
				<div class="ait-datepicker">
					<input type="text" autocomplete="off" id="<?php echo$this->getIdAttr();?>" <?php echo
aitDataAttr('datepicker',$dataAttr)?> value="<?php echo
esc_attr($this->getValue());?>">
					<input type="hidden" id="<?php echo$this->getIdAttr();?>-standard-format" name="<?php echo$this->getNameAttr();?>" value="<?php echo
esc_attr($this->getValue());?>">
					<a href="#" class="datepicker-reset" style="position: absolute; top: 3px; right: 43px" onclick="javascript: event.preventDefault(); jQuery(this).parent().find('input[type=text], input[type=hidden]').attr('value', ''); return false;"><i class="fa fa-times"></i></a>
				</div>
			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}protected
function
hasCustomFormat(){return
false;}protected
function
getFormat(){if($this->hasCustomFormat())$format=$this->config->format;else$format=get_option('date_format');return$format;}static
function
prepareDefaultValue($optionControlDefinition){if(isset($optionControlDefinition['default'])){if($optionControlDefinition['default']=='none'){return'';}$dt=new
DateTime($optionControlDefinition['default']);}else{$dt=new
DateTime();}if(isset($optionControlDefinition['format'])and!empty($optionControlDefinition['format']))return$dt->format(AitUtils::jsDate2phpDate($optionControlDefinition['format']));else
return$dt->format(get_option('date_format'));}}class
AitEditorOptionControl
extends
AitTranslatableOptionControl{private$tinyMceSettings;private$ajaxEditorOptions=array();function
ajaxHtml($id,$name){do_action('before_ajax_editor');$settings=$this->tinyMceSettings;$settings['textarea_name']=$name;wp_editor($this->getValue(),$id,$settings);?>

		<script type="text/javascript">
			<?php if(isset($this->ajaxEditorOptions['tinyMce'])):$serializedTinyMceOptions=$this->serializeEditorOptionsToJs($id,$this->ajaxEditorOptions['tinyMce']);?>
				tinyMCEPreInit.mceInit = jQuery.extend( tinyMCEPreInit.mceInit, <?php echo$serializedTinyMceOptions?>);
			<?php endif?>

			<?php if(isset($this->ajaxEditorOptions['quickTags'])):$serializedQuickTagsOptions=$this->serializeEditorOptionsToJs($id,$this->ajaxEditorOptions['quickTags']);?>
				tinyMCEPreInit.qtInit = jQuery.extend( tinyMCEPreInit.qtInit, <?php echo$serializedQuickTagsOptions?>);
			<?php endif?>
		</script>

		<?php

exit;}protected
function
init(){add_filter('tiny_mce_before_init',array($this,'saveTinyMceOptions'),10,2);add_filter('quicktags_settings',array($this,'saveQuickTagsOptions'),10,2);if(!isset($this->config->settings)){$this->config->settings=array();}$defaults=array('media_buttons'=>true,'textarea_rows'=>10,'remove_linebreaks'=>false,'wpautop'=>false,'quicktags'=>true,'teeny'=>false);$this->tinyMceSettings=array_merge($defaults,$this->config->settings);}function
saveTinyMceOptions($tinyMceOptions,$editor_id){$this->ajaxEditorOptions['tinyMce']=$tinyMceOptions;return$tinyMceOptions;}function
saveQuickTagsOptions($quickTagsOptions,$editor_id){$this->ajaxEditorOptions['quickTags']=$quickTagsOptions;return$quickTagsOptions;}protected
function
control(){if(isset($this->config->shortcodes)and$this->config->shortcodes===false
and
has_filter('mce_buttons',array('AitShortcodesGenerator','addMceButtons'))){remove_filter('mce_buttons',array('AitShortcodesGenerator','addMceButtons'));}?>

		<?php if($this->config->label):?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
			<?php $this->help()?>
		</div>
	<?php endif;?>

		<?php $inPageBuilder=AitUtils::contains($this->getIdAttr(),'elements');?>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">

			<?php foreach(AitLangs::getLanguagesList()as$lang):?>

				<?php if(!AitLangs::isFilteredOut($lang)):?>

					<?php if($inPageBuilder):?>

						<div class="ait-opt-wrapper <?php echo
AitLangs::htmlClass($lang->locale)?>" style="<?php if($inPageBuilder)echo'display: none;'?>">
							<?php

if(AitLangs::isEnabled()){?>
								<div class="flag">
									<?php echo$lang->flag;?>
								</div> <?php
}?>
							<textarea id="<?php echo$this->getLocalisedIdAttr('',$lang->locale)?>" name="<?php echo$this->getLocalisedNameAttr('',$lang->locale)?>" class="wp-editor-area" data-locale="<?php echo$lang->locale?>"><?php echo
esc_textarea($this->getLocalisedValue('',$lang->locale))?></textarea>
						</div>

					<?php else:?>

						<div class="ait-opt-wrapper <?php echo
AitLangs::htmlClass($lang->locale)?>">
							<?php

if(AitLangs::isEnabled()){?>
								<div class="flag">
									<?php echo$lang->flag;?>
								</div> <?php
}$this->tinyMceSettings['textarea_name']=$this->getLocalisedNameAttr('',$lang->locale);wp_editor($this->getLocalisedValue('',$lang->locale),$this->getLocalisedIdAttr('',$lang->locale),$this->tinyMceSettings);?>
						</div>
					<?php endif?>
				<?php else:?>
					<input type="hidden" name="<?php echo$this->getLocalisedNameAttr('',$lang->locale)?>" value="<?php echo
esc_attr($this->getLocalisedValue('',$lang->locale))?>">
				<?php endif;?>

			<?php endforeach;?>
		</div>
	<?php
}private
function
serializeEditorOptionsToJs($editorId,$editorOptions){if(!empty($editorOptions)){$serialized='';foreach($editorOptions
as$k=>$v){if(is_bool($v)){$val=$v?'true':'false';$serialized.=$k.':'.$val.',';continue;}elseif(!empty($v)&&is_string($v)&&(('{'==$v{0}&&'}'==$v{strlen($v)-1})||('['==$v{0}&&']'==$v{strlen($v)-1})||preg_match('/^\(?function ?\(/',$v))){$serialized.=$k.':'.$v.',';continue;}$serialized.=$k.':"'.$v.'",';}$serialized='{'.trim($serialized,' ,').'}';$serialized="'$editorId':{$serialized},";$serialized='{'.trim($serialized,',').'}';}else{$serialized='{}';}return$serialized;}}class
AitFontAwesomeSelectOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){$val=$this->getValue();$path=isset($this->config->category)?"/awesome/icons-".$this->config->category.".json":"/awesome/icons.json";$icons=json_decode(file_get_contents(aitPath("fonts",$path)))->icons;?>

		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper chosen-wrapper fa-select">
				<select data-placeholder="<?php _e('Choose&hellip;','ait-admin')?>" class="chosen" name="<?php echo$this->getNameAttr();?>" id="<?php echo$this->getIdAttr();?>">
					<option value=""><?php _e("None","ait-admin")?></option>
				<?php

if(is_array($icons)&&!empty($icons)){foreach($icons
as$icon):$iconName="&#x".$icon->unicode." ".$icon->name;$iconClass="fa-".$icon->id;?>
							<option value="<?php echo
esc_attr($iconClass)?>" <?php selected($val,$iconClass)?>><?php echo($iconName)?></option>
							<?php

endforeach;}?>
				</select>
			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}static
function
prepareDefaultValue($optionControlDefinition){if(isset($optionControlDefinition['default']))return$optionControlDefinition['default'];else
return'';}}class
AitFontSelectOptionControl
extends
AitTranslatableOptionControl{protected
function
init(){$this->isCloneable=false;$this->isLessVar=true;}protected
function
control(){$fonts=AitGoogleFonts::getAll();?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">

			<?php foreach(AitLangs::getLanguagesList()as$lang):?>

				<?php
$fontType=$this->getLocalisedValue('',$lang->locale);$selectedFontType=$fontType;$parts=explode('@',$fontType);$fontType=$parts[0];?>

				<?php if(!AitLangs::isFilteredOut($lang)):?>

					<div class="ait-opt-wrapper chosen-wrapper <?php echo
AitLangs::htmlClass($lang->locale)?>">

					<?php if(AitLangs::isEnabled()):?> <div class="flag"><?php echo$lang->flag;?></div> <?php endif;?>


						<?php if(!isset($this->config->choices[$fontType])):?>

							<p><strong style='color:red'>Unknown value: <code><?php var_dump($fontType)?></code> of key <code><?php echo$this->key?></code></strong></p>

						<?php else:?>
							<select data-placeholder="<?php _e('Choose&hellip;','ait-admin')?>" class="chosen" name="<?php echo$this->getLocalisedNameAttr('',$lang->locale);?>">
							<?php foreach((array)$this->config->choices
as$type=>$params):?>
								<optgroup label="<?php echo($params['label'])?>">
									<?php if($type!='google'):?>

									<option <?php selected($fontType,$type)?> value="<?php echo"{$type}@{$params['font-family']}"?>"><?php echo
esc_html($params['label']);?></option>

									<?php else:?>

									<?php foreach($fonts
as$font):?>
										<option <?php selected($selectedFontType,"google@{$font->family}")?> value="<?php echo"google@{$font->family}"?>" ><?php echo
esc_html($font->family)?></option>
									<?php endforeach;?>
									<?php endif;?>
								</optgroup>

							<?php endforeach;?>

							</select>

						<?php endif;?>

					</div>

				<?php else:?>
					<input type="hidden" name="<?php echo$this->getLocalisedNameAttr('',$lang->locale)?>" value="<?php echo$this->getLocalisedValue('',$lang->locale)?>">
				<?php endif;?>

			<?php endforeach;?>

			<?php $this->help()?>
		</div>
		<?php
}function
updateLessVar(){parent::updateLessVar();$lessVarBaseName=key($this->lessVar);$lessVar=array();$typeOfFont=AitLangs::getCurrentLocaleText($this->value,'system');list($typeOfFont,$fontFamily)=array_pad(explode('@',$typeOfFont),2,null);if($fontFamily==""){$fontFamily=$this->config->choices[$typeOfFont]['font-family'];}$lessVar["{$lessVarBaseName}-type"]=$typeOfFont;if(is_string($typeOfFont)and
isset($this->config->choices[$typeOfFont])){$lessVar["{$lessVarBaseName}-family"]=$fontFamily;}else{$lessVar["{$lessVarBaseName}-family"]='THEME FONT CAN NOT BE FOUND, Arial, sans-serif';}$this->lessVar=$lessVar;}}class
AitFontOptionControl
extends
AitTranslatableOptionControl{protected
function
init(){$this->isCloneable=false;$this->isLessVar=true;}protected
function
control(){?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">

			<?php foreach(AitLangs::getLanguagesList()as$lang):?>

				<?php
$fontType=$this->getLocalisedValue('',$lang->locale);?>

				<?php if(!AitLangs::isFilteredOut($lang)):?>

					<div class="ait-opt-wrapper <?php echo
AitLangs::htmlClass($lang->locale)?>">
					<?php if(AitLangs::isEnabled()):?> <div class="flag"><?php echo$lang->flag;?></div> <?php endif;?>

						<?php if(!isset($this->config->choices[$fontType])):?>

							<p><strong style='color:red'>Unknown value: <code><?php var_dump($fontType)?></code> of key <code><?php echo$this->key?></code></strong></p>

						<?php else:?>

						<?php foreach((array)$this->config->choices
as$type=>$params):?>


							<label for="<?php echo$this->getLocalisedIdAttr($type,$lang->locale)?>">
								<input type="radio" id="<?php echo$this->getLocalisedIdAttr($type,$lang->locale);?>" name="<?php echo$this->getLocalisedNameAttr('',$lang->locale);?>" <?php checked($fontType,$type);?>  value="<?php echo
esc_attr($type)?>">
								<?php $_translate='_e';$_translate($params['label'],'ait-admin')?>
								&nbsp;
								<small>(<?php echo
esc_html($params['font-family'])?>)</small>
							</label>
							<br>

						<?php endforeach;endif;?>

					</div>

				<?php else:?>
					<input type="hidden" name="<?php echo$this->getLocalisedNameAttr('',$lang->locale)?>" value="<?php echo$this->getLocalisedValue('',$lang->locale)?>">
				<?php endif;?>

			<?php endforeach;?>

			<?php $this->help()?>
		</div>
		<?php
}function
updateLessVar(){parent::updateLessVar();$lessVarBaseName=key($this->lessVar);$lessVar=array();$typeOfFont=AitLangs::getCurrentLocaleText($this->value,'system');$lessVar["{$lessVarBaseName}-type"]=$typeOfFont;if(is_string($typeOfFont)and
isset($this->config->choices[$typeOfFont])){$lessVar["{$lessVarBaseName}-family"]=$this->config->choices[$typeOfFont]['font-family'];}else{$lessVar["{$lessVarBaseName}-family"]='THEME FONT CAN NOT BE FOUND, Arial, sans-serif';}$this->lessVar=$lessVar;}}class
AitHiddenOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}function
getHtml(){$generateUUID=false;if(isset($this->config->uuid)){$generateUUID=$this->config->uuid;}ob_start();?>
        <input type="hidden" name="<?php echo$this->getNameAttr()?>" value="<?php echo
esc_attr($this->getValue());?>" data-uuid="<?php echo$generateUUID;?>">
		<?php

return
ob_get_clean();}}class
AitImageRadioFullOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){$val=$this->getValue();?>

		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">

		<?php if(!isset($this->config->default[$val])):?>

				<p><strong style='color:red'>Unknown value: <code><?php var_dump($val)?></code> of key <code><?php echo$this->key?></code></strong></p>

		<?php else:?>

			<?php foreach((array)$this->config->default
as$input=>$label):?>
				<?php
$checked=checked($val,$input,false);$image=array('path'=>aitPath('img','/admin/'.$this->config->images[$input]),'url'=>aitUrl('img','/admin/'.$this->config->images[$input]));$image['class']=$image['path']?'image-present':'image-missing';?>

				<label for="<?php echo$this->getIdAttr($input)?>" class="<?php if($checked):?>selected-option <?php endif;echo($image['class'])?>">
					<input type="radio" id="<?php echo$this->getIdAttr($input);?>" name="<?php echo$this->getNameAttr();?>" <?php echo$checked?>  value="<?php echo
esc_attr($input)?>">
					<?php

if($image['path']){$_translate='__';echo'<img src="'.$image['url'].'" alt="'.$_translate($label,'ait-admin').'">';}?>
					<span class="input-title"><?php $_translate='_e';$_translate($label,'ait-admin')?></span>
				</label>

			<?php endforeach;?>
		<?php endif;?>

			</div>

			<?php $this->help()?>
		</div>
		<?php
}static
function
prepareDefaultValue($optionControlDefinition){if(isset($optionControlDefinition['checked'])and
is_string($optionControlDefinition['checked'])){return$optionControlDefinition['checked'];}else{return
array_shift(array_keys($optionControlDefinition['default']));}}}class
AitImageRadioOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){$val=$this->getValue();?>

		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">

		<?php if(!isset($this->config->default[$val])):?>

				<p><strong style='color:red'>Unknown value: <code><?php var_dump($val)?></code> of key <code><?php echo$this->key?></code></strong></p>

		<?php else:?>

			<?php foreach((array)$this->config->default
as$input=>$label):?>
				<?php
$checked=checked($val,$input,false);$image=array('path'=>aitPath('img','/admin/'.$this->config->images[$input]),'url'=>aitUrl('img','/admin/'.$this->config->images[$input]));$image['class']=$image['path']?'image-present':'image-missing';?>

				<label for="<?php echo$this->getIdAttr($input)?>" class="<?php if($checked):?>selected-option <?php endif;echo($image['class'])?>">
					<input type="radio" id="<?php echo$this->getIdAttr($input);?>" name="<?php echo$this->getNameAttr();?>" <?php echo$checked?>  value="<?php echo
esc_attr($input)?>">
					<?php

if($image['path']){$_translate='__';echo'<img src="'.$image['url'].'" alt="'.esc_attr($_translate($label,'ait-admin')).'">';}?>
					<span class="input-title"><?php $_translate='_e';$_translate($label,'ait-admin')?></span>
				</label>

			<?php endforeach;?>
		<?php endif;?>

			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}static
function
prepareDefaultValue($optionControlDefinition){if(isset($optionControlDefinition['checked'])and
is_string($optionControlDefinition['checked'])){return$optionControlDefinition['checked'];}else{return
array_shift(array_keys($optionControlDefinition['default']));}}}class
AitImageOptionControl
extends
AitOptionControl{protected
function
init(){$this->isLessVar=true;$this->isCloneable=true;}protected
function
control(){?>

		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">
				<input type="text" class="ait-image-value-fake" id="<?php echo$this->getIdAttr();?>" value="<?php echo
esc_attr($this->getValue());?>">
				<input type="hidden" class="ait-image-value" name="<?php echo$this->getNameAttr();?>" value="<?php echo
esc_attr($this->getValue());?>">
                <?php if($this->getParentSection()->getParentGroup()->getConfigName()!='shortcodes'):?>
				<input type="button" class="ait-image-select" <?php echo
aitDataAttr('select-image',array('title'=>sprintf(__('Select Image for: %s','ait-admin'),$this->config->label),'buttonTitle'=>__('Insert Image','ait-admin')))?> value="<?php _e('Select Image','ait-admin')?>" id="<?php echo$this->getIdAttr('button')?>">
			    <?php endif;?>
            </div>

			<?php $this->help()?>
		</div>

		<?php
}static
function
prepareDefaultValue($optionControlDefinition){if(empty($optionControlDefinition['default']))return'';$default=$optionControlDefinition['default'];if(!AitUtils::startsWith($default,'/')and!AitUtils::startsWith($default,'http')){$default="/{$default}";}if(!AitUtils::isExtUrl($default)){if(AitUtils::contains($default,'admin/assets/img')){$default=aitPaths()->url->fw.$default;}else{$fullUrl=aitUrl('theme',$default);if($fullUrl!==false){$default=$fullUrl;}}}return$default;}function
updateLessVar(){parent::updateLessVar();$lessVarBaseName=key($this->lessVar);$lessVar=$this->lessVar;$lessVarValue=$lessVar[$lessVarBaseName];if(empty($lessVarValue)){$lessVar[$lessVarBaseName]='~""';}else{$lessVar[$lessVarBaseName]="url('".$lessVarValue."')";}$this->lessVar=$lessVar;}}class
AitInfoOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){$options=(array)$this->config->default;if(isset($this->config->dataFunction)&&!empty($this->config->dataFunction)){if(is_callable($this->config->dataFunction)){$options=call_user_func($this->config->dataFunction);}}?>

		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">
				<?php echo$options;?>
			</div>
			<?php $this->help()?>
		</div>

		<?php
}}class
AitAdvancedOptionsEnablerOptionControl
extends
AitOptionControl{protected
function
init(){$this->key='@enabledAdvanced';$this->config=(object)array('label'=>__('Enable','ait-admin'),'default'=>'0','help'=>__('By enabling this you can override advanced options from Default Layout','ait-admin'));}protected
function
control(){$val=$this->getValue();if(is_null($val))$val=0;?>
            <div class="ait-opt-label">
                <?php $this->labelWrapper()?>
            </div>
			<div class="ait-opt ait-enable-advanced">
				<div class="ait-opt-wrapper">
				<select id="<?php echo$this->getIdAttr()?>" name="<?php echo$this->getNameAttr()?>" class="ait-toggle-advanced">
					<option value="1" <?php selected(1,$val)?>><?php _e('Yes','ait-admin')?></option>
					<option value="0" <?php selected(0,$val)?>><?php _e('No','ait-admin')?></option>
				</select>
				</div>
			</div>
			<div class="ait-opt-help">
				<div class="ait-opt-<?php echo$this->id?>-add">
				</div>
				<?php $this->help()?>
			</div>
		<?php
}}class
AitPageTemplatesOptionControl
extends
AitOptionControl{protected
function
control(){global$post;?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper chosen-wrapper">
				<?php

if(isset($post)and$post->post_type=='page'and
count(get_page_templates())!=0){$template=!empty($post->page_template)?$post->page_template:false;?>
					<select name="specific-post[template]" id="<?php echo$this->getIdAttr()?>" class="chosen">
						<option value='default'><?php _e('Default Template','ait-admin');?></option>
						<?php page_template_dropdown($template);?>
					</select>
					<?php
}else{_e('"Page templates" option is available only on local options for specific page.','ait-admin');}?>
			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}}class
AitPaymentsOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper chosen-wrapper">
				<?php

if(class_exists('AitPaypal')){$paypal=AitPaypal::getInstance();$payments_avalaible=$paypal->payments;if(count($payments_avalaible)>0){?>
						<select id="<?php echo$this->getIdAttr();?>" name="<?php echo$this->getNameAttr();?>" class="ait-opt-<?php echo$this->key?> chosen">
							<?php

foreach($payments_avalaible
as$index=>$payment){$name=$payment->name." (".$payment->price." ".$payment->currencyCode.")";?>
								<option <?php selected($this->getValue(),"payment-id-".$index);?> value='payment-id-<?php echo$index?>'><?php echo$name?></option>
								<?php
}?>
						</select>
						<?php
}else{_e('There are no payments defined, please add payments first','ait-admin');}}?>
			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}}class
AitPostCommentsOptionControl
extends
AitOptionControl{protected
function
control(){$specialPages=aitOptions()->getSpecialCustomPages();$oid=aitOptions()->getRequestedOid('get');$val=$this->getValue();if(!isset($specialPages[$oid])){?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-on-off">
			<div class="ait-opt-wrapper">
				<div class="ait-opt-switch">
					<select id="<?php echo$this->getIdAttr();?>" name="specific-post[comments]" class="ait-opt-on-off">
						<option <?php if($val=='open'){?> selected <?php }?>  value="open">On</option>
						<option <?php if($val=='closed'){?> selected <?php }?>  value="closed">Off</option>
					</select>
				</div>
			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}}function
getValue($subKey=''){global$post;if(!isset($post)){$val=get_option('default_comment_status');}else{$val=$post->comment_status;}return$val;}}class
AitPostContentOptionControl
extends
AitOptionControl{protected
function
control(){global$post;if(!isset($post))return;$postContent=$post->post_content;if(!isset($this->config->settings)){$this->config->settings=array();}$defaults=array('media_buttons'=>true,'textarea_rows'=>10,'remove_linebreaks'=>false,'wpautop'=>false,'quicktags'=>true,'teeny'=>false);$settings=array_merge($defaults,$this->config->settings);$settings['textarea_name']='specific-post[content]';if(isset($this->config->shortcodes)and$this->config->shortcodes===false
and
has_filter('mce_buttons',array('AitShortcodesGenerator','addMceButtons'))){remove_filter('mce_buttons',array('AitShortcodesGenerator','addMceButtons'));}?>

		<?php if($this->config->label):?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
			<?php $this->help()?>
		</div>
		<?php endif;?>

		<div class="ait-opt ait-opt-editor">
			<?php
$lang=AitLangs::getPostLang($post->ID);$inPageBuilder=AitUtils::contains($this->getIdAttr(),'elements');?>

			<?php if($inPageBuilder):?>
				<div class="ait-opt-wrapper <?php echo
AitLangs::htmlClass($lang->locale)?>" style="<?php if($inPageBuilder)echo'display: none;'?>">
					<?php

if(AitLangs::isEnabled()){?>
						<div class="flag">
							<?php echo$lang->flag;?>
						</div> <?php
}?>
					<textarea id="<?php echo$this->getIdAttr()?>" name="<?php echo$settings['textarea_name']?>" class="wp-editor-area" data-locale="<?php echo$lang->locale?>"><?php echo
esc_textarea($postContent);?></textarea>
			</div>
			<?php else:?>
				<div class="ait-opt-wrapper <?php echo
AitLangs::htmlClass($lang->locale)?>">
					<?php

if(AitLangs::isEnabled()){?>
						<div class="flag">
							<?php echo$lang->flag;?>
						</div> <?php
}wp_editor($postContent,$this->getIdAttr(),$settings);?>
				</div>
			<?php endif?>
		</div>
		<?php
}}class
AitPostTitleOptionControl
extends
AitOptionControl{protected
function
control(){global$post;if(!isset($post))return;$val=$post->post_title;?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-text">
			<div class="ait-opt-wrapper">
				<input type="text" id="<?php echo$this->getIdAttr()?>" name="specific-post[title]" value="<?php echo
esc_attr($val)?>">
			</div>

			<?php $this->help()?>
		</div>
		<?php
}}class
AitMapOptionControl
extends
AitOptionControl{protected
function
init(){$this->isLessVar=false;}protected
function
control(){$d=(object)$this->config->default;?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">

				<div class="ait-opt-tools ait-opt-maps-tools">
					<div class="ait-opt-tools-row">
						<div class="ait-opt-tools-cell1">

							<div class="ait-opt-maps-item ait-opt-maps-address">
								<label for="<?php echo$this->getIdAttr('map-address');?>"><?php _e('Address','ait-admin')?></label><!--
							 --><div class="ait-control-wrapper">
							 		<?php $data=$this->getValue();if(is_string($data)){$val=$data;}else{if(!isset($data['address'])){$val=AitLangs::getCurrentLocaleText($data);}else{$val=$data['address'];}}?>
									<input type="text" id="<?php echo$this->getIdAttr('map-address')?>" name="<?php echo$this->getNameAttr('address')?>" value="<?php echo$val?>">
									<input type="button" value="<?php _e('Find','ait-admin')?>">
								</div>
							</div>

							<div class="ait-opt-maps-item ait-opt-maps-latitude">
								<label for="<?php echo$this->getIdAttr('map-latitude');?>"><?php _e('Latitude','ait-admin')?></label><!--
							 --><div class="ait-control-wrapper">
									<?php $val=isset($data['latitude'])?floatval($data['latitude']):1?>
									<input type="text" id="<?php echo$this->getIdAttr('map-latitude')?>" name="<?php echo$this->getNameAttr('latitude')?>" value="<?php echo$val?>">
								</div>
							</div>

							<div class="ait-opt-maps-item ait-opt-maps-longitude">
								<label for="<?php echo$this->getIdAttr('map-longitude');?>"><?php _e('Longitude','ait-admin')?></label><!--
							 --><div class="ait-control-wrapper">
							 		<?php $val=isset($data['longitude'])?floatval($data['longitude']):1?>
									<input type="text" id="<?php echo$this->getIdAttr('map-longitude')?>" name="<?php echo$this->getNameAttr('longitude')?>" value="<?php echo$val?>">
								</div>
							</div>

							<?php $val=isset($data['streetview'])?(int)$data['streetview']:0?>
							<div class="ait-opt-maps-item ait-opt-maps-streetview ait-opt-on-off">
								<label for="<?php echo$this->getIdAttr('map-streetview');?>"><?php _e('Streetview','ait-admin')?></label><!--
							 	--><div class="ait-control-wrapper">
									<div class="ait-opt-switch">
										<select id="<?php echo$this->getIdAttr('map-streetview');?>" name="<?php echo$this->getNameAttr('streetview');?>" class="ait-opt-<?php echo$this->key?>">
											<option <?php selected($val,1);?>  value="1">On</option>
											<option <?php selected($val,0);?>  value="0">Off</option>
										</select>
									</div>
								</div>
							</div>

							<div class="ait-opt-maps-item ait-opt-maps-swheading">
								<div class="ait-control-wrapper">
									<?php $val=isset($data['swheading'])&&is_numeric($data['swheading'])?floatval($data['swheading']):0?>
									<input type="hidden" id="<?php echo$this->getIdAttr('map-swheading')?>" name="<?php echo$this->getNameAttr('swheading')?>" value="<?php echo$val?>">
								</div>
							</div>
							<div class="ait-opt-maps-item ait-opt-maps-swpitch">
								<div class="ait-control-wrapper">
									<?php $val=isset($data['swpitch'])&&is_numeric($data['swpitch'])?floatval($data['swpitch']):0?>
									<input type="hidden" id="<?php echo$this->getIdAttr('map-swpitch')?>" name="<?php echo$this->getNameAttr('swpitch')?>" value="<?php echo$val?>">
								</div>
							</div>
							<div class="ait-opt-maps-item ait-opt-maps-swzoom">
								<div class="ait-control-wrapper">
									<?php $val=isset($data['swzoom'])&&is_numeric($data['swzoom'])?floatval($data['swzoom']):0?>
									<input type="hidden" id="<?php echo$this->getIdAttr('map-swzoom')?>" name="<?php echo$this->getNameAttr('swzoom')?>" value="<?php echo$val?>">
								</div>
							</div>

							<div class="ait-opt-maps-item ait-opt-maps-message" style="display: none"><?php _e("Couldn't find location. Try different address",'ait-admin')?></div>

						</div>

						<div class="ait-opt-tools-cell2">
							<div class="ait-opt-maps-item ait-opt-maps-wrap">
								<div class="ait-opt-maps-screen">
									<div class="ait-opt-maps-preview">&nbsp;</div>
								</div>
							</div>
						</div>

					</div>
				</div><!-- end of ait-opt-tools -->

			</div>

			<?php $this->help()?>
		</div>
		<?php
}static
function
prepareDefaultValue($optionControlDefinition){$d=array('address'=>'','latitude'=>1,'longitude'=>1,'streetview'=>false,'swheading'=>90,'swpitch'=>5,'swzoom'=>1);$d=array_merge($d,$optionControlDefinition['default']);return$d;}}class
AitMultilineCodeOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
			<?php $this->help()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">
				<textarea id="<?php echo$this->getIdAttr()?>" name="<?php echo$this->getNameAttr()?>" rows="5"><?php echo
esc_textarea($this->getValue())?></textarea>
			</div>
		</div>
		<?php
}}class
AitMultilineStringOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
			<?php $this->help()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">
				<textarea id="<?php echo$this->getIdAttr()?>" name="<?php echo$this->getNameAttr()?>" rows="5"><?php echo$this->getValue()?></textarea>
			</div>
		</div>
		<?php
}}class
AitMultimarkerMapOptionControl
extends
AitOptionControl{protected
function
init(){$this->isLessVar=false;}protected
function
control(){$d=(object)$this->config->default;$related='';if(isset($this->config->related)){$related=$this->config->related;}?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">

				<div class="ait-opt-tools ait-opt-maps-tools">
					<div class="ait-opt-tools-row">
						<div class="ait-opt-tools-cell1">

							<div class="ait-opt-maps-item ait-opt-maps-address">
								<label for="<?php echo$this->getIdAttr('map-address');?>"><?php _e('Address','ait-admin')?></label><!--
							 --><div class="ait-control-wrapper">
									<input type="text" id="<?php echo$this->getIdAttr('map-address')?>" name="<?php echo$this->getNameAttr('address')?>" value="<?php echo$this->getValue('address')?>">
									<input type="button" value="<?php _e('Find','ait-admin')?>" id="find-address">
									<!--<input type="button" id="reset-markers" value="<?php _e('Clear map','ait-admin')?>">-->
								</div>
							</div>

							<div class="ait-opt-maps-item ait-opt-maps-related">
								<div class="ait-control-wrapper">
									<input type="hidden" id="<?php echo$this->getIdAttr('related')?>" name="<?php echo$this->getNameAttr('related')?>" value="<?php echo$related?>">
								</div>
							</div>

							<div class="ait-opt-maps-item ait-opt-maps-markers">
								<div class="ait-control-wrapper">
									<?php $val=is_array($this->getValue('markers'))?0:$this->getValue('markers');?>
									<input type="hidden" id="<?php echo$this->getIdAttr('map-markers')?>" name="<?php echo$this->getNameAttr('markers')?>" value="<?php echo
htmlspecialchars(($val))?>">
									<div id="info-window-data" style="display: none;">
										<h3></h3>
										<input id="info-window-remove" type="button" value="<?php _e('Remove','ait-admin')?>">
									</div>
								</div>
							</div>

						</div>




						<div class="ait-opt-tools-cell2">
							<div class="ait-opt-maps-item ait-opt-maps-wrap">
								<!-- <div class="ait-opt-maps-screen"> -->
									<div class="ait-opt-multimaps-preview" style="height: inherit;"></div>
								<!-- </div> -->
							</div>
						</div>

					</div>
				</div><!-- end of ait-opt-tools -->

			</div>

			<?php $this->help()?>
		</div>



		<?php
}static
function
prepareDefaultValue($optionControlDefinition){$d=array('address'=>'','swheading'=>90,'swpitch'=>5,'swzoom'=>1,'related'=>"");$d=array_merge($d,$optionControlDefinition['default']);return$d;}}class
AitNumberOptionControl
extends
AitOptionControl{protected$units=array('%','em','ex','ch','rem','vw','vh','vmin','vmax','cm','mm','in','pt','pc','px','deg','grad','rad','turn','s','ms','hz','khz','dpi','dpcm','dppx');protected
function
init(){$this->isLessVar=true;$this->isCloneable=true;}protected
function
control(){$value=$this->getValue();?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">
				<input <?php echo(isset($this->config->step)?'step='.$this->config->step:"");?> type="<?php echo(empty($value)or
is_numeric($value))?'number':'text'?>" id="<?php echo$this->getIdAttr();?>" name="<?php echo$this->getNameAttr();?>" value="<?php echo
esc_attr($this->getValue())?>">
				<?php if($this->unit!=''):?>
				<span class="ait-unit ait-number-unit"><?php echo
esc_html($this->unit)?></span>
				<?php endif;?>
			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}function
getUnit(){return
isset($this->config->unit)?$this->config->unit:'';}function
updateLessVar(){parent::updateLessVar();$lessVarBaseName=key($this->lessVar);$lessVar=$this->lessVar;$lessVarValue=$lessVar[$lessVarBaseName];if($lessVarValue!==0){$unit=in_array(strtolower($this->getUnit()),$this->units)?$this->getUnit():'';$lessVar[$lessVarBaseName]=$lessVarValue.$unit;}$this->lessVar=$lessVar;}}class
AitOnOffOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){$val=(int)$this->getValue();?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">
				<div class="ait-opt-switch">
					<select id="<?php echo$this->getIdAttr();?>" name="<?php echo$this->getNameAttr();?>" class="ait-opt-<?php echo$this->key?>">
						<option <?php selected($val,1);?>  value="1">On</option>
						<option <?php selected($val,0);?>  value="0">Off</option>
					</select>
				</div>
			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}static
function
prepareDefaultValue($optionControlDefinition){return
empty($optionControlDefinition['default'])?false:$optionControlDefinition['default'];}}class
AitPaymentOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){$val=(int)$this->getValue();?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<?php if($this->config->controller=="none"||class_exists($this->config->controller)){?>
		<div class="ait-opt ait-opt-<?php echo$this->id?> ait-opt-on-off">
			<div class="ait-opt-wrapper">
				<div class="ait-opt-switch">
					<select id="<?php echo$this->getIdAttr();?>" name="<?php echo$this->getNameAttr();?>" class="ait-opt-<?php echo$this->key?>">
						<option <?php selected($val,1);?>  value="1">On</option>
						<option <?php selected($val,0);?>  value="0">Off</option>
					</select>
				</div>
			</div>
		</div>
		<?php }else{_e("Not Installed",'ait-admin');}?>
		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}static
function
prepareDefaultValue($optionControlDefinition){return
empty($optionControlDefinition['default'])?false:$optionControlDefinition['default'];}}class
AitSelectOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){$val=$this->getValue();$multiAttr=$this->multi?"multiple":'';$k=$this->multi?' ':'';?>


		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper chosen-wrapper">
				<select data-placeholder="<?php _e('Choose&hellip;','ait-admin')?>" class="chosen" name="<?php echo$this->getNameAttr($k);?>" id="<?php echo$this->getIdAttr();?>" <?php echo$multiAttr?>>
				<?php

foreach((array)$this->config->default
as$input=>$label):if(is_numeric($input)and
is_numeric($label)){$input=$label;}if(is_array($val)){if($this->isMulti()){$value=in_array($input,$val)?$input:false;}else{$value='';}}else{$value=$val;}?>
						<option value="<?php echo
esc_attr($input)?>" <?php selected($value,$input)?>><?php $eschtmle='esc_html_e';$eschtmle($label,'ait-admin')?></option>
						<?php

endforeach;?>
				</select>
			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}function
isMulti(){return
isset($this->config->multiple)and$this->config->multiple===true;}static
function
prepareDefaultValue($optionControlDefinition){if(isset($optionControlDefinition['multiple'])and$optionControlDefinition['multiple']===true){if(is_array($optionControlDefinition['default'])and
count($optionControlDefinition['default'])>1){return(isset($optionControlDefinition['selected'])and
is_array($optionControlDefinition['selected']))?$optionControlDefinition['selected']:array();}else{return
array('twoormore'=>'"select" type with multiple attribute can be used only with two or more options otherwise use it as basic "select"');}}if(isset($optionControlDefinition['selected']))return$optionControlDefinition['selected'];else
return'';}}class
AitPostSelectOptionControl
extends
AitSelectOptionControl{protected$postType='post';function
__construct(AitOptionsControlsSection$parentSection,$key='',$definition=array(),$value=''){parent::__construct($parentSection,$key,$definition,$value);$this->postType=$this->config->postType;$this->prepareSelectValues();}function
prepareSelectValues(){$args=array('post_type'=>$this->postType);$posts=get_posts($args);$this->config->default=array();foreach($posts
as$post){$this->config->default[$post->ID]=$post->post_title;}}protected
function
control(){$args=array('post_type'=>$this->postType);$posts=get_posts($args);$val=array();foreach($posts
as$post){$val[$post->ID]=$post->post_title;}$this->setValue($val);$multiAttr=$this->isMulti()?"multiple":'';$k=$this->isMulti()?' ':'';?>


		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper chosen-wrapper">
				<select data-placeholder="<?php _e('Choose&hellip;','ait-admin')?>" class="chosen" name="<?php echo$this->getNameAttr($k);?>" id="<?php echo$this->getIdAttr();?>" <?php echo$multiAttr?>>
					<?php

foreach((array)$this->config->default
as$input=>$label):if(is_numeric($input)and
is_numeric($label)){$input=$label;}if(is_array($val)){if($this->isMulti()){$value=in_array($input,$val)?$input:false;}else{$value='';}}else{$value=$val;}?>
						<option value="<?php echo
esc_attr($input)?>" <?php selected($value,$input)?>><?php $eschtmle='esc_html_e';$eschtmle($label,'ait-admin')?></option>
					<?php

endforeach;?>
				</select>
			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
	<?php
}}class
AitPostsOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){$val=$this->getValue();if(isset($this->config->cpt)and$this->config->cpt){$cptName=AitUtils::addPrefix($this->config->cpt,'post');}else{$cptName='post';}if(post_type_exists($cptName)){$cpt=get_post_type_object($cptName);$args=array('post_type'=>$cptName,'selected'=>$val,'show_option_none'=>__('&mdash; Select &mdash;','default'),'option_none_value'=>'0','posts_per_page'=>-1,'post_status'=>array('publish','draft'));if(!$cpt->hierarchical){$args['hierarchical']=false;}if(isset($this->config->showCurrentUserPosts)){if($this->config->showCurrentUserPosts=true){global$current_user;if($current_user->ID!=1){$excluded=array();$posts=new
WP_Query(array('post_type'=>$cptName,'posts_per_page'=>-1,'author__not_in'=>array($current_user->ID)));foreach($posts->posts
as$post){array_push($excluded,$post->ID);}$args['exclude']=join(',',$excluded);}}}$argsFromConfig=(isset($this->config->args)and!empty($this->config->args))?$this->config->args:array();$args=array_merge($args,$argsFromConfig,array('echo'=>false,'name'=>$this->getNameAttr(),'id'=>$this->getIdAttr(),'class'=>$this->id.' chosen'));$dropdown='';$emptySelect=create_function('$output',sprintf("return empty(\$output) ? \"<select data-placeholder='%s' name='%s' id='%s' class='%s'></select>\" : \$output;",esc_attr(sprintf(__('No items. Add some items to "%s"','ait-admin'),$cpt->labels->menu_name)),$args['name'],$args['id'],$args['class']));add_filter('wp_dropdown_pages',$emptySelect);add_filter('ait-dropdown-posts',$emptySelect);if($cpt->hierarchical){$dropdown=wp_dropdown_pages($args);$dropdown=str_replace('<select',"<select class='{$args['class']}'",$dropdown);}else{$dropdown=aitDropdownPosts($args);}remove_filter('wp_dropdown_pages',$emptySelect);remove_filter('ait-dropdown-posts',$emptySelect);if($this->config->label=='@native')$this->config->label=$cpt->labels->singular_name;?>

		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper chosen-wrapper">
				<?php echo$dropdown?>
			</div>
		</div>
		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>

		<?php
}else{echo"<strong style='color:red'>Custom post type <code>{$cptName}</code> doesn't exist.</strong>";}}static
function
prepareDefaultValue($optionControlDefinition){return$optionControlDefinition['default']==''?0:$optionControlDefinition['default'];}}class
AitRadioOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){$val=$this->getValue();$defaultChecked=isset($this->config->checked)?$this->config->checked:'';?>

		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">

			<?php if(!isset($this->config->default[$val])):?>

				<p><strong style='color:red'>Unknown value: <code><?php var_dump($val)?></code> of key <code><?php echo$this->key?></code></strong></p>

				<?php foreach((array)$this->config->default
as$input=>$label):?>

					<label for="<?php echo$this->getIdAttr($input)?>">
						<input type="radio" id="<?php echo$this->getIdAttr($input);?>" name="<?php echo$this->getNameAttr();?>" <?php checked($defaultChecked,$input);?>  value="<?php echo
esc_attr($input)?>">
						<?php $_translate='_e';$_translate($label,'ait-admin')?>
					</label>

				<?php endforeach;?>

			<?php else:?>

			<?php foreach((array)$this->config->default
as$input=>$label):?>

				<label for="<?php echo$this->getIdAttr($input)?>">
					<input type="radio" id="<?php echo$this->getIdAttr($input);?>" name="<?php echo$this->getNameAttr();?>" <?php checked($val,$input);?>  value="<?php echo
esc_attr($input)?>">
					<?php $_translate='_e';$_translate($label,'ait-admin')?>
				</label>

			<?php endforeach;?>
			<?php endif;?>

			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}static
function
prepareDefaultValue($optionControlDefinition){if(isset($optionControlDefinition['checked'])and
is_string($optionControlDefinition['checked'])){return$optionControlDefinition['checked'];}else{return
array_shift(array_keys($optionControlDefinition['default']));}}}class
AitRangeOptionControl
extends
AitOptionControl{protected
function
init(){$this->isLessVar=true;$this->isCloneable=true;}protected
function
control(){?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">

				<input type="range" id="<?php echo$this->getIdAttr();?>" name="<?php echo$this->getNameAttr();?>"  min="<?php echo
esc_attr($this->getMin())?>" max="<?php echo
esc_attr($this->getMax())?>" step="<?php echo
esc_attr($this->getStep())?>" value="<?php echo
esc_attr($this->getValue())?>">
				<?php if($this->getUnit()!=''):?>
				<span class="ait-unit ait-number-unit"><?php echo
esc_html($this->getUnit())?></span>
				<?php endif;?>

			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}function
getUnit(){return
isset($this->config->unit)?$this->config->unit:'';}function
getMax(){return
isset($this->config->max)?$this->config->max:100;}function
getMin(){return
isset($this->config->min)?$this->config->min:0;}function
getStep(){return
isset($this->config->step)?$this->config->step:1;}}class
AitSelectDynamicOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){$val=$this->getValue();$multiAttr=$this->multi?"multiple":'';$k=$this->multi?' ':'';$options=(array)$this->config->default;if(isset($this->config->dataFunction)&&!empty($this->config->dataFunction)){if(is_callable($this->config->dataFunction)){$options=call_user_func($this->config->dataFunction);}}?>


		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper chosen-wrapper">
				<select data-placeholder="<?php _e('Choose&hellip;','ait-admin')?>" class="chosen" name="<?php echo$this->getNameAttr($k);?>" id="<?php echo$this->getIdAttr();?>" <?php echo$multiAttr?>>
				<?php

foreach($options
as$input=>$label):if(is_numeric($input)and
is_numeric($label)){$input=$label;}if(is_array($val)){if($this->isMulti()){$value=in_array($input,$val)?$input:false;}else{$value='';}}else{$value=$val;}?>
						<option value="<?php echo
esc_attr($input)?>" <?php selected($value,$input)?>><?php $eschtmle='esc_html_e';$eschtmle($label,'ait-admin')?></option>
						<?php

endforeach;?>
				</select>
			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}function
isMulti(){return
isset($this->config->multiple)and$this->config->multiple===true;}static
function
prepareDefaultValue($optionControlDefinition){if(isset($optionControlDefinition['multiple'])and$optionControlDefinition['multiple']===true){if(is_array($optionControlDefinition['default'])and
count($optionControlDefinition['default'])>1){return(isset($optionControlDefinition['selected'])and
is_array($optionControlDefinition['selected']))?$optionControlDefinition['selected']:array();}else{return
array('twoormore'=>'"select" type with multiple attribute can be used only with two or more options otherwise use it as basic "select"');}}if(isset($optionControlDefinition['selected']))return$optionControlDefinition['selected'];else
return'';}}class
AitSidebarOptionControl
extends
AitOptionControl{protected
function
control(){$val=$this->getValue();$sidebars=aitManager('sidebars')->getSidebars();?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper chosen-wrapper">
				<select data-placeholder="<?php _e('Choose&hellip;','ait-admin')?>" name="<?php echo$this->getNameAttr('sidebar');?>" id="<?php echo$this->getIdAttr('sidebar');?>" class="chosen">
					<option value="none" <?php selected($val['sidebar'],'none')?>><?php echo
esc_html(_x('None','sidebar','ait-admin'))?></option>
				<?php

foreach($sidebars
as$sidebarId=>$params):?>
						<option value="<?php echo
esc_attr($sidebarId)?>" <?php selected($val['sidebar'],$sidebarId)?>><?php echo
esc_html(AitLangs::getDefaultLocaleText($params['name'],'unknown sidebar'))?></option>
						<?php

endforeach;?>
				</select>
			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}}class
AitStringOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){?>

		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">
				<input type="text" id="<?php echo$this->getIdAttr()?>" name="<?php echo$this->getNameAttr()?>" value="<?php echo
esc_attr($this->getValue());?>">
			</div>
			<?php $this->help()?>
		</div>

		<?php
}}class
AitTextOptionControl
extends
AitTranslatableOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">

			<?php foreach(AitLangs::getLanguagesList()as$lang):?>

				<?php if(!AitLangs::isFilteredOut($lang)):?>

			<div class="ait-opt-wrapper <?php echo
AitLangs::htmlClass($lang->locale)?>">
				<?php if(AitLangs::isEnabled()):?>
					<div class="flag"><?php echo$lang->flag?></div>
				<?php endif;?>
				<input type="text" id="<?php echo$this->getLocalisedIdAttr('',$lang->locale)?>" name="<?php echo$this->getLocalisedNameAttr('',$lang->locale)?>" value="<?php echo
esc_attr($this->getLocalisedValue('',$lang->locale))?>">
			</div>

				<?php else:?>
					<input type="hidden" name="<?php echo$this->getLocalisedNameAttr('',$lang->locale)?>" value="<?php echo
esc_attr($this->getLocalisedValue('',$lang->locale))?>">
				<?php endif;?>


			<?php endforeach;?>

			<?php $this->help()?>
		</div>
		<?php
}}class
AitTextareaOptionControl
extends
AitTranslatableOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){$rows=$cols='';if($this->getRows())$rows=" rows='{$this->getRows()}' ";if($this->getCols())$cols=" cols='{$this->getCols()}' ";?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">

			<?php foreach(AitLangs::getLanguagesList()as$lang):?>

				<?php if(!AitLangs::isFilteredOut($lang)):?>

			<div class="ait-opt-wrapper <?php echo
AitLangs::htmlClass($lang->locale)?>">
				<?php if(AitLangs::isEnabled()):?><div class="flag"> <?php echo$lang->flag?></div><?php endif;?><textarea id="<?php echo$this->getLocalisedIdAttr('',$lang->locale)?>" name="<?php echo$this->getLocalisedNameAttr('',$lang->locale)?>" <?php echo$rows,$cols;?>><?php echo
esc_textarea($this->getLocalisedValue('',$lang->locale))?></textarea>
			</div>

				<?php else:?>
					<input type="hidden" name="<?php echo$this->getLocalisedNameAttr('',$lang->locale)?>" value="<?php echo
esc_attr($this->getLocalisedValue('',$lang->locale));?>">
				<?php endif;?>

			<?php endforeach;?>

			<?php $this->help()?>
		</div>
		<?php
}function
getRows(){return
isset($this->config->rows)?$this->config->rows:'';}function
getCols(){return
isset($this->config->cols)?$this->config->cols:'';}}class
AitUrlOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){?>
		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper">
				<input type="url" id="<?php echo$this->getIdAttr()?>" name="<?php echo$this->getNameAttr()?>" value="<?php echo
esc_attr($this->getValue())?>">
			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}}class
AitUserSelectOptionControl
extends
AitOptionControl{protected
function
init(){$this->isCloneable=true;}protected
function
control(){$val=$this->getValue();$multiAttr=$this->multi?"multiple":'';$k=$this->multi?' ':'';$roles=$this->config->roles?$this->config->roles:'';$enableAll=true;if(isset($this->config->enableAll)){$enableAll=$this->config->enableAll;}$users=array();if(in_array('0',$roles)){$users_query=new
WP_User_Query(array('role'=>''));$results=$users_query->get_results();if($results)$users=array_merge($users,$results);}else{foreach($roles
as$key=>$role){$users_query=new
WP_User_Query(array('role'=>$role));$results=$users_query->get_results();if($results)$users=array_merge($users,$results);}}?>

		<div class="ait-opt-label">
			<?php $this->labelWrapper()?>
		</div>

		<div class="ait-opt ait-opt-<?php echo$this->id?>">
			<div class="ait-opt-wrapper chosen-wrapper">
				<select data-placeholder="<?php _e('Choose&hellip;','ait-admin')?>" class="chosen" name="<?php echo$this->getNameAttr($k);?>" id="<?php echo$this->getIdAttr();?>" <?php echo$multiAttr?>>
				<?php

if(is_array($val)){if($this->isMulti()){$value=in_array('0',$val)?'0':false;}else{$value='';}}else{$value=$val;}?>
				 	<?php if($enableAll):?>
					<option value="0" <?php selected($value,'0')?>><?php esc_html_e('All','ait-admin')?></option>
				 	<?php endif?>
				<?php

foreach($users
as$key=>$user):if(is_array($val)){if($this->isMulti()){$value=in_array($user->ID,$val)?$user->ID:false;}else{$value='';}}else{$value=$val;}?>
						<option value="<?php echo
esc_attr($user->ID)?>" <?php selected($value,$user->ID)?>><?php echo$user->display_name?></option>
					<?php

endforeach;?>
				</select>
			</div>
		</div>

		<div class="ait-opt-help">
			<?php $this->help()?>
		</div>
		<?php
}function
isMulti(){return
isset($this->config->multiple)and$this->config->multiple===true;}static
function
prepareDefaultValue($optionControlDefinition){if(isset($optionControlDefinition['selected']))return$optionControlDefinition['selected'];else
return'';}}class
AitVariableOptionControl
extends
AitOptionControl{protected
function
init(){$this->isLessVar=true;}function
getHtml(){return'';}}class
AitMenu{static
function
init(){add_action('wp_nav_menu_objects',array(__CLASS__,'modify_nav_menu_items'),100,2);add_filter('wp_nav_menu_args',array(__CLASS__,'modify_arguments'),100);add_filter('wp_edit_nav_menu_walker',array(__CLASS__,'modify_backend_walker'),100);add_action('wp_update_nav_menu_item',array(__CLASS__,'update_menu'),100,3);}static
function
modify_nav_menu_items($sorted_menu_items,$args){foreach($sorted_menu_items
as&$menu_item){if($menu_item->title=='menu-item-ait-column'){foreach($sorted_menu_items
as&$potential_parent_menu_item){if($menu_item->menu_item_parent==$potential_parent_menu_item->ID){$potential_parent_menu_item->classes[]='menu-item-has-columns';continue;}}}}return$sorted_menu_items;}static
function
modify_arguments($arguments){$arguments['walker']=new
AitMenuFrontendWalker();$arguments['container_class']=$arguments['container_class'].=' megaWrapper';$arguments['menu_class']='ait-megamenu';return$arguments;}static
function
modify_backend_walker($name){return'AitMenuBackendWalker';}static
function
update_menu($menu_id,$menu_item_db){$menuItemOptions=array('column-label','column-min-width','column-url','column-in-new-row','icon','submenu-position');foreach($menuItemOptions
as$key){if(!isset($_POST['menu-item-'.$key][$menu_item_db])){$_POST['menu-item-'.$key][$menu_item_db]="";}$value=$_POST['menu-item-'.$key][$menu_item_db];update_post_meta($menu_item_db,'_menu-item-'.$key,$value);}}}class
AitMenuBackendWalker
extends
Walker_Nav_Menu_Edit{function
start_el(&$output,$item,$depth=0,$args=array(),$id=0){global$_wp_nav_menu_max_depth;if($item->title=='menu-item-ait-column'){$depth=1;}$_wp_nav_menu_max_depth=$depth>$_wp_nav_menu_max_depth?$depth:$_wp_nav_menu_max_depth;ob_start();$item_id=esc_attr($item->ID);$removed_args=array('action','customlink-tab','edit-menu-item','menu-item','page-tab','_wpnonce');$original_title='';if('taxonomy'==$item->type){$original_title=get_term_field('name',$item->object_id,$item->object,'raw');if(is_wp_error($original_title))$original_title=false;}elseif('post_type'==$item->type){$original_object=get_post($item->object_id);$original_title=get_the_title($original_object->ID);}$classes=array('menu-item menu-item-depth-'.$depth,'menu-item-'.esc_attr($item->object),'menu-item-edit-'.((isset($_GET['edit-menu-item'])&&$item_id==$_GET['edit-menu-item'])?'active':'inactive'));if($item->title=='menu-item-ait-column'){$isColumn=true;$classes[]='menu-item-column';}else{$isColumn=false;}$title=$item->title;if(!empty($item->_invalid)){$classes[]='menu-item-invalid';$title=sprintf(__('%s (Invalid)','ait-admin'),$item->title);}elseif(isset($item->post_status)&&'draft'==$item->post_status){$classes[]='pending';$title=sprintf(__('%s (Pending)','ait-admin'),$item->title);}$title=(!isset($item->label)||''==$item->label)?$title:$item->label;if($isColumn){$menuItemColumnLabelValue=trim(get_post_meta($item->ID,'_menu-item-column-label',true));$title=$menuItemColumnLabelValue?$menuItemColumnLabelValue:'&nbsp;';}$submenu_text='';if(0==$depth)$submenu_text='style="display: none;"';?>
	<li id="menu-item-<?php echo$item_id;?>" class="<?php echo
implode(' ',$classes);?>">
		<dl class="menu-item-bar">
			<dt class="<?php if($isColumn):?>menu-item-handle menu-item-column-handle<?php else:?>menu-item-handle<?php endif;?>">
				<span class="item-title"><span class="menu-item-title"><?php echo
esc_html($title);?></span> <?php if(!$isColumn):?><span class="is-submenu" <?php echo$submenu_text;?>><?php _e('sub item','ait-admin');?></span><?php endif;?></span>
					<span class="item-controls">
						<span class="item-type"><?php echo$isColumn?__('Column','ait-admin'):esc_html($item->type_label);?></span>
						<a class="item-edit" id="edit-<?php echo$item_id;?>" title="<?php esc_attr_e('Edit Menu Item','default');?>" href="<?php

echo(isset($_GET['edit-menu-item'])&&$item_id==$_GET['edit-menu-item'])?esc_url(admin_url('nav-menus.php')):esc_url(add_query_arg('edit-menu-item',$item_id,remove_query_arg($removed_args,admin_url('nav-menus.php#menu-item-settings-'.$item_id))));?>"><?php _e('Edit Menu Item','ait-admin');?></a>
					</span>
			</dt>
		</dl>

		<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo$item_id;?>">
			<?php if('custom'==$item->type):?>
				<p class="field-url description description-wide<?php if($isColumn)echo" hidden"?>">
					<label for="edit-menu-item-url-<?php echo$item_id;?>">
						<?php _e('URL','ait-admin');?><br />
						<input type="text" id="edit-menu-item-url-<?php echo$item_id;?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo$item_id;?>]" value="<?php echo
esc_attr($item->url);?>" />
					</label>
				</p>
			<?php endif;?>
			<?php

if($isColumn):?>
				<p class="field-column-label description description-wide">
					<label for="edit-menu-item-column-label-<?php echo$item_id;?>">
						<?php _e('Label (Optional)','ait-admin');?><br />
						<input type="text" id="edit-menu-item-column-label-<?php echo$item_id;?>" class="widefat edit-menu-item-column-label" name="menu-item-column-label[<?php echo$item_id;?>]" value="<?php echo
esc_attr($menuItemColumnLabelValue);?>" />
					</label>
				</p>
			<?php endif;?>
			<p class="description description-thin<?php if($isColumn)echo" hidden"?>">
				<label for="edit-menu-item-title-<?php echo$item_id;?>">
					<?php _e('Navigation Label','ait-admin');?><br />
					<input type="text" id="edit-menu-item-title-<?php echo$item_id;?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo$item_id;?>]" value="<?php echo
esc_attr($item->title);?>" />
				</label>
			</p>
			<p class="description description-thin<?php if($isColumn)echo" hidden"?>">
				<label for="edit-menu-item-attr-title-<?php echo$item_id;?>">
					<?php _e('Title Attribute','ait-admin');?><br />
					<input type="text" id="edit-menu-item-attr-title-<?php echo$item_id;?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo$item_id;?>]" value="<?php echo
esc_attr($item->post_excerpt);?>" />
				</label>
			</p>
			<p class="field-link-target description<?php if($isColumn)echo" hidden"?>">
				<label for="edit-menu-item-target-<?php echo$item_id;?>">
					<input type="checkbox" id="edit-menu-item-target-<?php echo$item_id;?>" value="_blank" name="menu-item-target[<?php echo$item_id;?>]"<?php checked($item->target,'_blank');?> />
					<?php _e('Open link in a new window/tab','ait-admin');?>
				</label>
			</p>
			<p class="field-css-classes description description-thin">
				<label for="edit-menu-item-classes-<?php echo$item_id;?>">
					<?php _e('CSS Classes (optional)','ait-admin');?><br />
					<input type="text" id="edit-menu-item-classes-<?php echo$item_id;?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo$item_id;?>]" value="<?php echo
esc_attr(implode(' ',$item->classes));?>" />
				</label>
			</p>
			<p class="field-xfn description description-thin<?php if($isColumn)echo" hidden"?>">
				<label for="edit-menu-item-xfn-<?php echo$item_id;?>">
					<?php _e('Link Relationship (XFN)','ait-admin');?><br />
					<input type="text" id="edit-menu-item-xfn-<?php echo$item_id;?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo$item_id;?>]" value="<?php echo
esc_attr($item->xfn);?>" />
				</label>
			</p>
			<p class="field-description description description-wide<?php if($isColumn)echo" hidden"?>">
				<label for="edit-menu-item-description-<?php echo$item_id;?>">
					<?php $isColumn?_e('Description','ait-admin'):_e('Description','ait-admin');?><br />
					<textarea id="edit-menu-item-description-<?php echo$item_id;?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo$item_id;?>]"><?php echo
esc_html($item->description);?></textarea>
					<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.','ait-admin');?></span>
				</label>
			</p>

			<p class="field-icon description description-wide">
				<label for="edit-menu-item-icon-<?php echo$item_id;?>">
					<?php _e('Icon (Optional)','ait-admin');?><br />
					<?php $menuItemIconValue=get_post_meta($item->ID,'_menu-item-icon',true);?>
					<input type="text" id="edit-menu-item-icon-<?php echo$item_id;?>" class="edit-menu-item-image edit-menu-item-icon ait-image-value" name="menu-item-icon[<?php echo$item_id;?>]" value="<?php echo
esc_attr($menuItemIconValue);?>" />
					<input type="button" class="edit-menu-item-image-media-button ait-image-select button button-secondary right" <?php echo
aitDataAttr('select-image',array('title'=>__('Select Image','ait-admin'),'buttonTitle'=>__('Insert Image','ait-admin')));?> value="<?php _e('Select Image','ait-admin')?>" id="edit-menu-item-icon-<?php echo$item_id;?>-media-button">
				</label>
			</p>

			<p class="field-submenu-position description description-wide<?php if($depth>0)echo' hidden'?>">
				<label for="edit-menu-item-submenu-<?php echo$item_id;?>">
					<?php _e('Submenu Position','ait-admin');?><br />
					<?php $menuItemSubmenuPositionValue=get_post_meta($item->ID,'_menu-item-submenu-position',true);?>
					<select id="edit-menu-item-icon-<?php echo$item_id;?>" class="edit-menu-item-submenu-position" name="menu-item-submenu-position[<?php echo$item_id;?>]">
						<option value=""<?php if(empty($menuItemSubmenuPositionValue))echo' selected="selected"';?>><?php _e('Theme Default','ait-admin');?></option>
						<option value="left"<?php if($menuItemSubmenuPositionValue=='left')echo' selected="selected"';?>><?php _e('Left','ait-admin');?></option>
						<option value="right"<?php if($menuItemSubmenuPositionValue=='right')echo' selected="selected"';?>><?php _e('Right','ait-admin');?></option>
						<option value="center"<?php if($menuItemSubmenuPositionValue=='center')echo' selected="selected"';?>><?php _e('Center','ait-admin');?></option>
						<option class="only-if-has-columns" value="content-left"<?php if($menuItemSubmenuPositionValue=='content-left')echo' selected="selected"';?>><?php _e('Content Left','ait-admin');?></option>
						<option class="only-if-has-columns" value="content-right"<?php if($menuItemSubmenuPositionValue=='content-right')echo' selected="selected"';?>><?php _e('Content Right','ait-admin');?></option>
						<option class="only-if-has-columns" value="content-full-width"<?php if($menuItemSubmenuPositionValue=='content-full-width')echo' selected="selected"';?>><?php _e('Full Content Width','ait-admin');?></option>
					</select>
				</label>
			</p>

			<?php if($isColumn):?>
				<p class="field-column-background-image description description-wide">
					<label for="edit-menu-item-column-url-<?php echo$item_id;?>">
						<?php _e('Url (Optional)','ait-admin');?><br />
						<?php $menuItemColumnUrlValue=get_post_meta($item->ID,'_menu-item-column-url',true);?>
						<input type="text" id="edit-menu-item-column-url-<?php echo$item_id;?>" class="widefat code edit-menu-item-column-url" name="menu-item-column-url[<?php echo$item_id;?>]" value="<?php echo
esc_attr($menuItemColumnUrlValue);?>" />
					</label>
				</p>
				<p class="field-column-min-width description description-thin">
					<label for="edit-menu-item-column-min-width-<?php echo$item_id;?>">
						<?php _e('Minimum Width in px (Optional)','ait-admin');?><br />
						<?php $menuItemColumnMinWidthValue=get_post_meta($item->ID,'_menu-item-column-min-width',true);?>
						<input type="number" id="edit-menu-item-column-min-width-<?php echo$item_id;?>" class="widefat code edit-menu-item-column-min-width" name="menu-item-column-min-width[<?php echo$item_id;?>]" value="<?php echo
esc_attr($menuItemColumnMinWidthValue);?>" />
					</label>
				</p>
				<p class="field-column-in-new-row description description-thin">
					<label for="edit-menu-item-column-in-new-row-<?php echo$item_id;?>">
						<?php $menuItemColumnInNewRowChecked=get_post_meta($item->ID,'_menu-item-column-in-new-row',true);?>
						<input type="checkbox" id="edit-menu-item-column-in-new-row-<?php echo$item_id;?>" class="widefat code edit-menu-item-column-in-new-row" name="menu-item-column-in-new-row[<?php echo$item_id;?>]" value="true"<?php if($menuItemColumnInNewRowChecked)echo" checked";?> />
						<?php _e('In New Row','ait-admin');?><br />
					</label>
				</p>
			<?php endif;?>

			<div class="menu-item-actions description-wide submitbox">
				<?php if('custom'!=$item->type&&$original_title!==false):?>
					<p class="link-to-original">
						<?php printf(__('Original: %s','ait-admin'),'<a href="'.esc_attr($item->url).'">'.esc_html($original_title).'</a>');?>
					</p>
				<?php endif;?>

				<?php ?>

				<div class="item-add-column-action <?php if($depth>0)echo'hidden'?>">
				<a class="item-add-column add-column" id="add-column-to-<?php echo$item_id;?>" href="#<?php echo$item_id;?>-column" data-menu-item="<?php echo"menu-item-".$item_id?>" data-menu-column-item-prototype="<?php echo"menu-item-".$item_id."-column";?>"><?php _e('Add Column','ait-admin');?></a> <span class="meta-sep hide-if-no-js"> | </span>
				</div>

				<?php ?>

				<a class="item-delete submitdelete deletion" id="delete-<?php echo$item_id;?>" href="<?php

echo
esc_url(wp_nonce_url(add_query_arg(array('action'=>'delete-menu-item','menu-item'=>$item_id),admin_url('nav-menus.php')),'delete-menu_item_'.$item_id));?>"><?php _e('Remove','ait-admin');?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo$item_id;?>" href="<?php echo
esc_url(add_query_arg(array('edit-menu-item'=>$item_id,'cancel'=>time()),admin_url('nav-menus.php')));?>#menu-item-settings-<?php echo$item_id;?>"><?php _e('Cancel','ait-admin');?></a>
			</div>

			<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo$item_id;?>]" value="<?php echo$item_id;?>" />
			<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo$item_id;?>]" value="<?php echo
esc_attr($item->object_id);?>" />
			<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo$item_id;?>]" value="<?php echo
esc_attr($item->object);?>" />
			<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo$item_id;?>]" value="<?php echo
esc_attr($item->menu_item_parent);?>" />
			<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo$item_id;?>]" value="<?php echo
esc_attr($item->menu_order);?>" />
			<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo$item_id;?>]" value="<?php echo
esc_attr($item->type);?>" />
		</div><!-- .menu-item-settings-->
		<ul class="menu-item-transport"></ul>

		<?php ?>

		<div class="hidden" style="display: none" id="menu-item-<?php echo$item_id?>-column">
			<input type="hidden" disabled="disabled" class="menu-item-data-db-id" name="menu-item[0][menu-item-data-db-id]" value="0" />
			<input type="hidden" disabled="disabled" class="menu-item-object" name="menu-item[0][menu-item-object]" value="" />
			<input type="hidden" disabled="disabled" class="menu-item-parent-id" name="menu-item[0][menu-item-parent-id]" value="<?php echo$item->ID;?>" />
			<input type="hidden" disabled="disabled" class="menu-item-type" name="menu-item[0][menu-item-type]" value="custom" />
			<input type="hidden" disabled="disabled" class="menu-item-title" name="menu-item[0][menu-item-title]" value="menu-item-ait-column" />
			<input type="hidden" disabled="disabled" class="menu-item-url" name="menu-item[0][menu-item-url]" value="#" />
			<input type="hidden" disabled="disabled" class="menu-item-classes" name="menu-item[0][menu-item-classes]" value="" />
		</div>

		<?php ?>

		<?php
$output.=ob_get_clean();}}class
AitMenuFrontendWalker
extends
Walker{var$tree_type=array('post_type','taxonomy','custom');var$db_fields=array('parent'=>'menu_item_parent','id'=>'db_id');private$columns=0;private$currentColumn=null;private$inRow=false;function
start_lvl(&$output,$depth=0,$args=array()){$indent=str_repeat("\t",$depth);if(isset($this->currentColumn)){$columnMinWidth=get_post_meta($this->currentColumn->ID,"_menu-item-column-min-width",true);$styleAttr=$minWidthCssClass="";if($columnMinWidth){$styleAttr=" style=\"min-width: {$columnMinWidth}px\"";$minWidthCssClass=" has-min-width-set";}$output.="\n$indent<ul class=\"sub-menu{$minWidthCssClass}\"{$styleAttr}>\n";}else{$output.="\n$indent<ul class=\"sub-menu\">\n";}}function
end_lvl(&$output,$depth=0,$args=array()){$indent=str_repeat("\t",$depth);$output.="$indent</ul>\n";if($depth===0){$this->columns=0;}}function
start_el(&$output,$item,$depth=0,$args=array(),$current_object_id=0){global$wp_query;$args=(object)$args;$item_output=$li_text_block_class=$column_class="";if($depth===0&&$this->inRow){$output.='</ul></li>';$this->inRow=false;}$itemIcon=get_post_meta($item->ID,"_menu-item-icon",true);if($itemIcon){$itemIcon='<img alt="icon" src="'.$itemIcon.'" />';}else{$itemIcon="";}if($depth===1&&$item->title=='menu-item-ait-column'){$this->columns++;$this->currentColumn=$item;$columnLabel=get_post_meta($item->ID,"_menu-item-column-label",true);$columnUrl=get_post_meta($item->ID,"_menu-item-column-url",true);$columnUrl=$this->replaceLangParam($columnUrl);$columnLabel=$itemIcon.$columnLabel;if($columnUrl){$columnLabel="<a href=\"$columnUrl\">{$columnLabel}</a>";}if(!empty($columnLabel)){$item_output.="<div class=\"menu-item-column-label\">{$columnLabel}";}if(!empty($item->description)){$item_output.='<span class="menu-item-description">'.$item->description.'</span>';}if(!empty($columnLabel)){$item_output.="</div>";}$column_class=" menu-item-column";if($this->columns==1){$column_class.=" menu-item-first-column";}}else{$this->currentColumn=null;$attributes=!empty($item->attr_title)?' title="'.esc_attr($item->attr_title).'"':'';$attributes.=!empty($item->target)?' target="'.esc_attr($item->target).'"':'';$attributes.=!empty($item->xfn)?' rel="'.esc_attr($item->xfn).'"':'';$attributes.=!empty($item->url)?' href="'.esc_attr($this->replaceLangParam($item->url)).'"':'';$item_output.=$args->before;$item_output.='<a'.$attributes.'>';$item_output.=$itemIcon;$item_output.=$args->link_before.apply_filters('the_title',$item->title,$item->ID).$args->link_after;if(!empty($item->description)){$item_output.='<span class="menu-item-description">'.$item->description.'</span>';}$item_output.='</a>';$item_output.=$args->after;}$indent=($depth)?str_repeat("\t",$depth):'';$classes=empty($item->classes)?array():(array)$item->classes;if($depth==0){$submenuPosition=get_post_meta($item->ID,"_menu-item-submenu-position",true);if($submenuPosition){$classes[]="sub-menu-{$submenuPosition}-position";}}$class_names=join(' ',apply_filters('nav_menu_css_class',array_filter($classes),$item));$class_names=' class="'.$li_text_block_class.esc_attr($class_names).$column_class.'"';if($depth===1&&$item->title=='menu-item-ait-column'){$columnInNewRow=get_post_meta($item->ID,"_menu-item-column-in-new-row",true)||$this->columns==1;if($columnInNewRow){$this->inRow=true;if($this->columns>1){$output.='</ul></li><li class="menu-item-ait-row"><ul>';}else{$output.='<li class="menu-item-ait-row"><ul class="menu-item-ait-columns-in-row">';}}}$output.=$indent.'<li id="menu-item-'.$item->ID.'"'.$class_names.'>';$output.=apply_filters('walker_nav_menu_start_el',$item_output,$item,$depth,$args);}function
end_el(&$output,$item,$depth=0,$args=array()){$output.="</li>\n";}protected
function
replaceLangParam($url){$langCode=AitLangs::getCurrentLang()->slug;return
str_replace('%lang%',$langCode,$url);}}class
AitMenuInlineFrontendWalker
extends
Walker_Nav_Menu{function
start_lvl(&$output,$depth=0,$args=array()){$indent=str_repeat("\t",$depth);$output.="\n$indent<ul class=\"sub-menu\"><!--\n";}function
end_lvl(&$output,$depth=0,$args=array()){$indent=str_repeat("\t",$depth);$output.="$indent--></ul>\n";}function
start_el(&$output,$item,$depth=0,$args=array(),$id=0){$indent=($depth)?str_repeat("\t",$depth):'';$class_names=$value='';$classes=empty($item->classes)?array():(array)$item->classes;$classes[]='menu-item-'.$item->ID;$class_names=join(' ',apply_filters('nav_menu_css_class',array_filter($classes),$item,$args));$class_names=$class_names?' class="'.esc_attr($class_names).'"':'';$id=apply_filters('nav_menu_item_id','menu-item-'.$item->ID,$item,$args);$id=$id?' id="'.esc_attr($id).'"':'';$output.=$indent.'--><li'.$id.$value.$class_names.'>';$atts=array();$atts['title']=!empty($item->attr_title)?$item->attr_title:'';$atts['target']=!empty($item->target)?$item->target:'';$atts['rel']=!empty($item->xfn)?$item->xfn:'';$atts['href']=!empty($item->url)?$item->url:'';$atts=apply_filters('nav_menu_link_attributes',$atts,$item,$args);$attributes='';foreach($atts
as$attr=>$value){if(!empty($value)){$value=('href'===$attr)?esc_url($value):esc_attr($value);$attributes.=' '.$attr.'="'.$value.'"';}}$item_output=$args->before;$item_output.='<a'.$attributes.'>';$item_output.=$args->link_before.apply_filters('the_title',$item->title,$item->ID).$args->link_after;$item_output.='</a>';$item_output.=$args->after;$output.=apply_filters('walker_nav_menu_start_el',$item_output,$item,$depth,$args);}function
end_el(&$output,$item,$depth=0,$args=array()){$output.="</li><!--\n";}}