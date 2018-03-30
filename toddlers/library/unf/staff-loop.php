<?php global $unf_options;

if( have_rows('staff') ): ?>
	<div class="staff-list <?php if(get_field('list_style') == "Large_Images")
{ ?>large_images<?php }
if(get_field('list_style') == "Small_Images")
{ ?>small_images<?php }
if(get_field('list_style') == "two_Columns")
{ ?>two_columns<?php }
if(get_field('list_style') == "three_Columns")
{ ?>three_columns<?php }?>">
	<?php while( have_rows('staff') ): the_row();
	// vars
	$staff_name = get_sub_field('name');
	$staff_role = get_sub_field('role');
	$staff_intro = get_sub_field('introduction');
	$staff_photo = get_sub_field('photo');
	$staff_email = get_sub_field('email');
	$staff_email = sanitize_email($staff_email);
	?>
	<div class="staff-member clearfix">


		<div class="staffclear clearfix">
			<?php
			if( !empty($staff_photo) ):
			$size = 'thumbnail';
			$thumb = $staff_photo['sizes'][ $size ];?>
			<div class="staff_img">
			<img src="<?php echo esc_url($thumb) ?>" alt="<?php echo esc_attr($staff_name); ?>" class="img-thumbnail" />
			</div>
			<?php endif; ?>


			<div class="staff_text">
				<div class="valign">
				<h2><?php echo $staff_name; ?>
					<?php if( !empty($staff_email) && is_email($staff_email) ):?>
						<span class="staff_email">
							<a href="mailto:<?php echo antispambot($staff_email,1); ?>" class="btn-info btn-xs">
								<?php echo antispambot($staff_email); ?>
							</a>
						</span>
					<?php endif; ?>
				</h3>
				<?php if( !empty($staff_role) ):?>
					<span class="staff_role"><?php echo wp_kses_post($staff_role); ?></span>
				<?php endif; ?>
				<?php if( !empty($staff_intro) ):?>
					<p class="staff_intro"><?php echo wp_kses_post($staff_intro); ?></p>
				<?php endif; ?>
				</div>
			</div>
		</div>

	</div>
	<?php endwhile;?>
	</div>
<?php endif;?>