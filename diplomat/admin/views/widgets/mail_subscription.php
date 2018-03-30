<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php $unique_id = uniqid(); ?>

<div class="widget widget_subscription">

	<?php if (!empty($instance['title'])): ?>
		<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
	<?php endif; ?>
        
    <?php if (!empty($instance['description'])){ ?>
        <p><?php echo esc_html($instance['description']); ?></p>
    <?php } ?>

	<form method="post" class="subscription-form" enctype="multipart/form-data">

        <input type="hidden" name="subscription_form" value="subscription_form_<?php echo $unique_id ?>" />

		<fieldset>

			<?php if ($instance['zipcode']){ ?>
				<div class="row collapse">
					<div class="small-12">
						<input id="email_<?php echo $unique_id ?>" required type="email" name="subscriber_email" value="" placeholder="<?php echo esc_attr($instance['submit_button']); ?>" />
					</div>
				</div>
				<div class="row collapse">
					<div class="small-6 columns">
						<input id="zipcode_<?php echo $unique_id ?>" required type="text" name="zipcode" value="" placeholder="<?php esc_attr_e('Zip code', 'diplomat'); ?>" />
					</div>
					<div class="small-6 columns">
						<button href="#" class="button submit middle right"><?php esc_attr_e('Submit', 'diplomat'); ?></button>
					</div>
				</div>

			<?php } else { ?>

				<div class="row collapse">
					<div class="small-10 columns">
						<input id="email_<?php echo $unique_id ?>" required type="email" name="subscriber_email" value="" placeholder="<?php echo esc_attr($instance['submit_button']); ?>" />
					</div>
					<div class="small-2 columns">
						<button href="#" class="button submit mail-icon"></button>
					</div>
				</div>
			<?php } ?>

		</fieldset>

        <div class="subscription_form_responce" style="display: none;"><ul></ul></div>
        
    </form>    

</div><!--/ .widget-container-->