<?php if ( !$is_compact ) echo VP_View::instance()->load( 'control/template_control_head', $head_info ); ?>

<div class="buttons"><a href="javascript:void(0)" class="button btn blue ph-btn-red"><?php echo crazyblog_set( $head_info, 'label' ); ?></a></div>

<?php if ( !$is_compact ) echo VP_View::instance()->load( 'control/template_control_foot' ); ?>

