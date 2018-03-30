<?php
global $zorka_data;
$count_social_link = 0;
$social_link_fields = array(
	'social-email-link' => array('fa fa-envelope-o', esc_html__('Email','zorka'),1),
	'social-linkedin-link' => array('fa fa-linkedin', esc_html__('Linked In','zorka'),2),
	'social-face-link' => array('fa fa-facebook', esc_html__('Facebook','zorka'),2),
	'social-twitter-link' => array('fa fa-twitter ', esc_html__('Twitter','zorka'),2),
	'social-dribbble-link' => array('fa fa-dribbble', esc_html__('Dribbble','zorka'),2),
	'social-google-link' => array('fa fa-google-plus', esc_html__('Google Plus','zorka'),2),
	'social-vimeo-link' => array('fa fa-vimeo-square', esc_html__('Vimeo','zorka'),2),
	'social-pinteres-link' => array('fa fa-pinterest', esc_html__('Pinterest','zorka'),2),
	'social-youtube-link' => array('fa fa-youtube', esc_html__('Youtube','zorka'),2),
	'social-instagram-link' => array('fa fa-instagram', esc_html__('Instagram','zorka'),2),
);
foreach ( $social_link_fields as $key => $value ) {
	if ( isset( $zorka_data[$key] ) && ! empty( $zorka_data[$key] ) ) {
		$count_social_link ++;
	}
}
?>
<?php if ($count_social_link > 0):?>
	<ul class="social-link">
		<?php foreach ( $social_link_fields as $key => $value ): ?>
			<?php if ( isset( $zorka_data[$key] ) && ! empty( $zorka_data[$key] ) ):?>
                <?php if ($value[2] == 1) : ?>
                    <li><a href="mailto:<?php echo esc_attr($zorka_data[$key]) ?>" target="_top" data-toggle="tooltip" title="<?php echo esc_attr($value[1]) ?>"><i class="<?php echo esc_attr($value[0]) ?>"></i></a></li>
                 <?php else: ?>
                    <li><a target="_blank" href="<?php echo esc_url($zorka_data[$key]) ?>" data-toggle="tooltip" title="<?php echo esc_attr($value[1]) ?>"><i class="<?php echo esc_attr($value[0]) ?>"></i></a></li>
                <?php endif; ?>
			<?php endif;?>
		<?php endforeach;?>
	</ul>
<?php endif;?>