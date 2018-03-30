<?php
if($slider!='none' && $slider!=''){
			include(TEMPLATEPATH . '/includes/'.$slider.'.php');
	 }else{?>

  <div id="page-title">
<div id="page-title-shadow"></div>
<div class="center"><h6><?php echo($subtitle); ?></h6> </div>
<div id="page-title-shadow-bottom"></div>
</div>
  
<?php }

//set the layout variables

$layoutclass='';
if($layout=='left'){
	$layoutclass='sidebar-to-left';
}

$content_id='content';
if($layout=='full'){
	$content_id='full-width';
}

?>
</div>