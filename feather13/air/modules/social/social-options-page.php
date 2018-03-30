<?php

// Set option name
$option = 'air-social';

// Set url
$url = air_social::get_var('url');

// Get items
$items = air_social::get_items();

?>
<div id="air-main-inner" class="air-text">
	
	<div id="air-social" class="air-module">
		<div id="air-social-top">
			
			<div class="air-box first">
				<form method="post" action="options.php">
					<?php settings_fields($option.'-settings'); ?>
					
					<div class="air-box-head">
						<h3>Create New Item</h3>		
					</div>
					<div class="air-box-inner">
						<p>
							<label for="social-item-url"><span>URL</span></label>
							<input id="social-item-url" name="<?php echo $option; ?>[url]" type="text" class="large-text" value="http://">
						</p>
								
						<p>
							<label for="social-item-name"><span>Label</span></label>
							<input id="social-item-name" name="<?php echo $option; ?>[name]" type="text" class="large-text">
						</p>

						<p>
							<label for="social-item-icon"><span>Icon URL</span></label>
							<input id="social-item-icon" name="<?php echo $option; ?>[icon]" type="text" class="large-text">
						</p>

						<p>
							<label for="social-item-new-window">
								<input id="social-item-new-window" name="<?php echo $option; ?>[new-window]" type="checkbox">
								<span>Open link in new window</span>
							</label>
						</p>

						<input type="hidden" name="<?php echo $option; ?>[action]" value="new" />
						<input type="submit" id="air-social-submit" class="button-secondary" value="Add Item">
					</div>
				</form>
			</div><!--/air-box-->

			<div class="air-box second">
				<div class="air-box-head">
					<h3>Icons</h3>
				</div>
				<div class="air-box-inner">
					<div id="air-icons-tabs">
						<ul class="air-icon-tab">
							<li><a class="air-icon-tab-link" href="#air-default-icons">Default</a></li>
						</ul>
						
						<div id="air-default-icons">
							<?php echo air_social::get_icon_list('default'); ?>
							<p class="air-credit">Social Network Icon Pack by <a href="http://www.komodomedia.com" target="_blank">Komodo Media</a></p>
						</div>
					</div>
				</div>
			</div><!--/air-box-->
			<div class="air-clear"></div>
		</div><!--/air-social-top-->

	<?php if($items): ?>

	<form action="options.php" method="post">
	<?php settings_fields($option.'-settings'); ?>
		<div id="air-social-content">
			<div>
				<table class="air-table" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th class="icon">Icon</th>
							<th class="link">Link</th>
							<th class="title">Title</th>
							<th class="actions"></th>
						</tr>
					</thead>
					<tbody class="sortable">
						<?php foreach($items as $key=>$item): ?>
						<tr>
							<td class="icon">
								<img src="<?php echo $item['icon']; ?>" />
								<input name="<?php echo $option.'['.$key.']'; ?>[icon]" type="text" class="code" value="<?php echo $item['icon_input']; ?>">
							</td>
							<td class="link">
								<input name="<?php echo $option.'['.$key.']'; ?>[url]" type="text" class="code" value="<?php echo $item['url']; ?>"><br>
								<div class="new-window"><input name="<?php echo $option.'['.$key.']'; ?>[new-window]" type="checkbox" <?php checked($item['new-window'], 1); ?>> Open in new window</div>
							</td>
							<td class="title">
								<input name="<?php echo $option.'['.$key.']'; ?>[name]" type="text" class="code" value="<?php echo $item['name']; ?>">
							</td>
							<td class="actions">
								<a href="#" class="air-link-move"><img src="<?php echo $url; ?>/img/move.png" alt="Move" title="Drag to Move" /></a>
								<a href="#" class="air-link-delete"><img src="<?php echo $url; ?>/img/delete.png" alt="Delete" /></a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4">
								<p class="air-credit">Module inspired by <a href="http://shakenandstirredweb.com/plugins/social-bartender/" target="_blank">Sawyer Hollenshead</a></p>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>


	<?php else: ?>

		<div id="air-social-content">
			<div class="empty-message">
				<p><?php _e('You have not created any social links.','air'); ?></p>
			</div>
		</div>

	<?php endif; ?>

		<div class="air-clear"></div>
	</div><!--/air-module-->

</div><!--/air-main-inner-->


<?php if($items): ?>
<div id="air-footer">
	<p class="submit air-submit">
		<input type="hidden" name="<?php echo $option; ?>[action]" value="update" />
		<input type="submit" class="button-primary" value="Save Changes" />
	</p>
</div><!--/air-footer-->
</form>
<?php endif; ?>