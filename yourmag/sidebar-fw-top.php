
<?php if (get_option('op_sidebar_style')!== 'Default') { ?>
<?php $sidebar_style = '_' . get_option("op_sidebar_style"); ?> 
<?php } ?>

<div class="sidebar_fw_top<?php echo $sidebar_style ?> mosaicflow" data-item-selector=".right-widget" data-min-item-width="240">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('top-fw-sidebar') ) : ?>
<?php endif; ?> 	
</div>

<script type="text/javascript">

(function($){ 
$(window).load(function(){ 
$(".sidebar_fw_top").css({ visibility: "visible" });
$(".sidebar_fw_top_Kesha").css({ visibility: "visible" });
})
})(jQuery);

</script>
