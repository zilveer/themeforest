<?php global $unf_options;?>

<div class="row contactdetails contact_block">
	<?php if (!empty($unf_options['unf_contact_addressdetails'])) { ?>
	<div class="col-md-<?php if (!empty($unf_options['unf_contact_phonedetails'])) { echo '6';} else { echo '12';}?> addressdetails">
		<div class="addressdetailswrap">
		<p>
			<?php
				echo wp_kses( $unf_options['unf_contact_addressdetails'], array(
				    'strong' => array(),
				    'br' => array(),
				    'em' => array(),
				    'i' => array(),
				    'b' => array(),
				    'a' => array('href')
				));

			?>
		</p>
		</div>
	</div>
	<?php } ?>
	<?php if (!empty($unf_options['unf_contact_phonedetails'])) { ?>
	<div class="col-md-<?php if (!empty($unf_options['unf_contact_addressdetails'])) { echo '6';} else { echo '12';}?> phonedetails">
		<div class="phonedetailswrap">
			<p>
				<?php
					echo wp_kses( $unf_options['unf_contact_phonedetails'], array(
					    'strong' => array(),
					    'br' => array(),
					    'em' => array(),
					    'i' => array(),
					    'b' => array(),
					    'a' => array('href')
					));
				?>
			</p>
		</div>
	</div>
	<?php } ?>
</div>