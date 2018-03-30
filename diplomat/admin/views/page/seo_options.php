<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" value="1" name="tmm_meta_saving" />
<table class="form-table seo-postbox">
	<tbody>
		<tr>
			<th>
				<label for="meta_title">
					<strong><?php esc_html_e('Meta title', 'diplomat'); ?></strong>
					<span><?php esc_html_e('SEO title of page. Title - 50-80 characters (usually - 75)', 'diplomat'); ?></span>
				</label>
			</th>
			<td>
				<input type="text" id="meta_title" name="meta_title" value="<?php echo esc_attr($meta_title); ?>">
			</td>
		</tr>
		<tr>
			<th>
				<label for="meta_keywords">
					<strong><?php esc_html_e('Meta keywords', 'diplomat'); ?></strong>
					<span><?php esc_html_e('Keywords - up to 250 characters', 'diplomat'); ?></span>
				</label>
			</th>
			<td>
				<textarea id="meta_keywords" name="meta_keywords"><?php echo esc_html($meta_keywords); ?></textarea>
			</td>
		</tr>
		<tr>
			<th>
				<label for="meta_description">
					<strong><?php esc_html_e('Meta description', 'diplomat'); ?></strong>
					<span><?php esc_html_e('Description - about 150-200 characters', 'diplomat'); ?></span>
				</label>
			</th>
			<td>
				<textarea id="meta_description" name="meta_description"><?php echo esc_html($meta_description); ?></textarea>
			</td>
		</tr>
	</tbody>
</table>