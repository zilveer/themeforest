<?php
//printr($header_data); 

$header_info = crazyblog_set( $header_data, 'head_info' ); //printr($header_info);
?>

<?php if ( !$is_compact ) echo VP_View::instance()->load( 'control/template_control_head', $head_info ); ?>

<div class="vp-section">

	<h3><?php echo crazyblog_set( $header_info, 'label' ); ?></h3>

	<?php VP_Util_Text::print_if_exists( crazyblog_set( $header_info, 'description' ), '<span class="description vp-js-tipsy" original-title="%s"></span>' ); ?>



    <div class="vp-controls">

		<?php $alchemy->_setup(); ?>

	</div>



</div>



<?php
if ( !$is_compact )
	echo VP_View::instance()->load( 'control/template_control_foot' );?>