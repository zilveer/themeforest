<?php if ( !$is_compact ) echo VP_View::instance()->load( 'control/template_control_head', $head_info ); ?>
<a id="del_lang" href="javascript:void(0)" class="dummy_button button2">
	<?php echo crazyblog_set( $head_info, 'label' ); ?>
</a>
<?php if ( !$is_compact ) echo VP_View::instance()->load( 'control/template_control_foot' ); ?>
