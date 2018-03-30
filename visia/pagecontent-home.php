<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $replace = array("page_"=>"",".php"=>""); ?>

<?php if ($content->customLoop(
							   "page",-1,null,
							   array(
									 "post_type" => "page",
									 "post_parent" => get_the_ID(),
									 "orderby" => "menu_order",
									 "order" => "ASC"
									 ),false)): 
?>
<?php while ($content->looping() ) : ?>
<?php $template = strtr($content->pageTemplate(),$replace); ?>
<?php if ($template === "home") continue; ?>
<?php get_template_part("pagecontent",$template); ?>
<?php endwhile; ?>
<?php $content->resetLoop(); ?>
<?php endif; ?>