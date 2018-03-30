<?php
/**
 * template part for Footer Widgets. views/footer
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */

global $mk_options;

$footer_column = $mk_options['footer_columns'];
if(is_numeric($footer_column)):
	switch ( $footer_column ):
		case 1:
			$class = '';
			break;
		case 2:
			$class = 'mk-col-1-2';
			break;
		case 3:
			$class = 'mk-col-1-3';
			break;
		case 4:
			$class = 'mk-col-1-4';
			break;
		case 5:
			$class = 'mk-col-1-5';
			break;
		case 6:
			$class = 'mk-col-1-6';
			break;
	endswitch;
	for( $i=1; $i<=$footer_column; $i++ ):
	?>
		<div class="<?php echo esc_attr( $class ); ?>"><?php mk_sidebar_generator( 'get_footer_sidebar' )  ?></div>
	<?php endfor;
else :

switch($footer_column):
	case 'third_sub_third':
	?>
	<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	<div class="mk-col-2-3">
	    <div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	</div>
	<?php
	break;
	case 'sub_third_third':
	?>
	<div class="mk-col-2-3">
	    <div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	</div>
	<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	<?php
	break;
	case 'third_sub_fourth':
	?>
	<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	<div class="mk-col-2-3 last">
	    <div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	</div>
	<?php
	break;
	case 'sub_fourth_third':
	?>
	<div class="mk-col-2-3">
	    <div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	</div>
	<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	<?php
	break;
	case 'half_sub_half':
	?>
	<div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	<div class="mk-col-1-2">
	    <div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	</div>
	<?php
	break;
	case 'half_sub_third':
	?>
	<div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	<div class="mk-col-1-2">
	    <div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	</div>
	<?php
	break;
	case 'sub_half_half':
	?>
	<div class="mk-col-1-2">
	    <div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	</div>
	<div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	<?php
	break;
	case 'sub_third_half':
	?>
	<div class="mk-col-1-2">
	    <div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	    <div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	</div>
	<div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar' ); ?></div>
	<?php
	break;
endswitch;
endif;?>