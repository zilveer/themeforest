<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for show a contact info
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';
?>
<div class="contact-info <?php echo esc_attr( $animate . $vc_css ) ?>" <?php echo $animate_data ?>>
	<?php if ( isset ($title) && $title != '' ) : ?> <h3><?php echo strip_tags($title) ?></h3><?php endif; ?>
    <?php if ( isset ($subtitle) && $subtitle != '' ) : ?> <h2><?php echo strip_tags($subtitle) ?></h2><?php endif; ?>
	<div class="sidebar-nav">
		<ul>
            <?php yit_get_contact_info_item($address_icon, __('Location','yit') ,$address); ?>
            <?php yit_get_contact_info_item($phone_icon,__('Phone','yit'),$phone); ?>
            <?php yit_get_contact_info_item($mobile_icon, __('Mobile','yit'),$mobile); ?>
            <?php yit_get_contact_info_item($fax_icon,__('Fax','yit'),$fax); ?>
            <?php yit_get_contact_info_item($email_icon,__('Email','yit'),$email); ?>
            
		</ul>
	</div>
</div>