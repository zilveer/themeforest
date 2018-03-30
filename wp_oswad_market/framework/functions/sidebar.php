<?php 
/*
	Get html of sidebar(area).
	Input :
		- string $id_sidebar : id of area.
		- string $ul_class : class name for ul root in sidebar.
		- string $id_area : id attribute in html of sidebar.
		- string $custom_class : custom class of sidebar.
	Output :
		The html of sidebar.
*/
if(!function_exists('ew_get_sidebar')){
	function ew_get_sidebar($id_sidebar,$ul_class = 'xoxo',$id_area = '',$custom_class = ''){
		ob_start();
		?>
		<div <?php if($id_area) echo 'id="'.$id_area.'"';?> class="widget-area<?php if(!$custom_class) echo ' '.$custom_class;?>" role="complementary">
			<ul class="<?php echo $ul_class;?>" id="<?php echo friendlyURL($id_sidebar);?>">
				<?php dynamic_sidebar( $id_sidebar );?>
			</ul>
		</div>			
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}

if(!function_exists('ew_get_sidebar_div')){
	function ew_get_sidebar_div($id_sidebar,$ul_class = 'xoxo',$id_area = '',$custom_class = ''){
		ob_start();
		?>
		<div <?php if($id_area) echo 'id="'.$id_area.'"';?> class="widget-area<?php if(!$custom_class) echo ' '.$custom_class;?>" role="complementary">
			<ul class="<?php echo $ul_class;?>" id="<?php echo friendlyURL($id_sidebar);?>">
				<?php dynamic_sidebar( $id_sidebar );?>
			</ul>
		</div>			
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}
?>