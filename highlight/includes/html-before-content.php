<?php
global $slider, $layout, $subtitle, $static_image, $intro, $slider_prefix;

if($slider!='none' && $slider!=''){
			include(TEMPLATEPATH . '/includes/'.$slider.'.php');
	 }else{?>

 <div id="page-title" class="center"> <p><?php echo($subtitle); ?> &nbsp;</p> </div>
    
  
<?php }


//set the layout variables

$layoutclass='layout-'.$layout;

$content_id='content';
if($layout=='full'){
	$content_id='full-width';
}elseif($layout=='none'){
	//for portfolio and other page templates when no additional stylings are needed for the div
	$content_id='pex-container';
}

?>
<div id="header-bottom"></div>
  </div>
 </div>
</div>
</div>

<?php if($intro){?>
<div id="intro" ><div class="center"><h2><?php echo $intro; ?></h2></div></div>
<div id="intro-shadow"></div>
<?php } ?>

<div class="content-gradient ">
  <div id="content-container" class="center <?php echo $layoutclass; ?>">
     <div id="<?php echo $content_id; ?>">