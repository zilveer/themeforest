<?php
// Set url
$url = air_sidebar::get_var('url');
// Get sidebars
$sidebars = air_sidebar::get_sidebars();
?>
<div id="air-main-inner" class="air-text">
	
	<div id="air-sidebar-widgets" class="air-module">
		<div id="air-sidebar-widgets-left">
		
			<div class="air-box first">
				<form method="post" action="options.php">
					<?php settings_fields('air-sidebar-settings'); ?>
					
					<div class="air-box-head">
						<h3>Create New Sidebar</h3>		
					</div>
					<div class="air-box-inner">
						<p>
							<label for="sidebar-name"><span>Name</span></label>
							<input name="air-sidebar[name]" type="text" class="large-text">
						</p>

						<p>
							<label for="sidebar-id"><span>ID (optional)</span></label>
							<input id ="sidebar-id" name="air-sidebar[id]" type="text" class="large-text">
						</p>

						<input type="hidden" name="air-sidebar[action]" value="new" />
						<input type="submit" id="air-sidebar-new" class="button-secondary" value="Add Sidebar">
					</div>
				</form>
			</div><!--/air-box-->
	
			<form action="options.php" method="post">
			
			<div class="air-box">	
				<div class="air-box-head">
					<h3>Common Sidebars</h3>		
				</div>
				<div class="air-box-inner">
					<p>
						<label for="sidebar-name"><strong>Home</strong> <small>(is_front_page)</small></label>
						<?php echo air_sidebar::dropdown('sidebar-front-page'); ?>
					</p>

					<p<?php if ( !Air::$vars['STATIC'] ) { echo ' style="display:none;"'; } ?>>
						<label for="sidebar-name"><strong>Blog</strong> <small>(is_home)</small></label>
						<?php echo air_sidebar::dropdown('sidebar-home'); ?>
					</p>

					<hr class="air-divider">
					
					<p>
						<label for="sidebar-name"><strong>404</strong> <small>(is_404)</small></label>
						<?php echo air_sidebar::dropdown('sidebar-404'); ?>
					</p>
					<p>
						<label for="sidebar-name"><strong>Archive</strong> <small>(is_archive)</small></label>
						<?php echo air_sidebar::dropdown('sidebar-archive'); ?>
					</p>
					<p>
						<label for="sidebar-name"><strong>Page</strong> <small>(is_page)</small></label>
						<?php echo air_sidebar::dropdown('sidebar-page'); ?>
					</p>
					<p>
						<label for="sidebar-name"><strong>Search</strong> <small>(is_search)</small></label>
						<?php echo air_sidebar::dropdown('sidebar-search'); ?>
					</p>
					<p>
						<label for="sidebar-name"><strong>Single</strong> <small>(is_single)</small></label>
						<?php echo air_sidebar::dropdown('sidebar-single'); ?>
					</p>
				</div>
			</div><!--/air-box-->
				
		</div><!--air-sidebar-widgets-left-->
		
		<div id="air-sidebar-widgets-right">
		<?php if($sidebars): ?>
			
			<?php settings_fields('air-sidebar-settings'); ?>
			<div>
				<table class="air-table" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th class="name">Name</th>
							<th class="id">ID</th>
							<th class="actions"></th>
						</tr>
					</thead>
					<tbody class="sortable">
						<?php $i=0; ?>
						<?php foreach ( $sidebars as $id=>$name ): ?>
						<tr>
							<td class="name">
								<input name="air-sidebar[sidebars][<?php echo $i; ?>][name]" type="text" value="<?php echo $name; ?>">
							</td>
							<td class="id">
								<input name="air-sidebar[sidebars][<?php echo $i; ?>][id]" type="text" value="<?php echo $id; ?>">
							</td>
							<td class="actions">
								<a href="#" class="air-link-delete"><img src="<?php echo $url; ?>/img/delete.png" alt="Delete" /></a>
							</td>
						</tr>
						<?php $i++; ?>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4">
								<p class="air-credit">Edit widget areas in <a href="widgets.php">Appearance > Widgets</a></p>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>

		<?php else: ?>

			<div class="empty-message">
				<p><?php _e('You have not created any custom sidebars.','air'); ?></p>
			</div>

		<?php endif; ?>
		
		</div><!--air-sidebar-widgets-right-->
		
		<div class="air-clear"></div>
	</div><!--/air-module-->

</div><!--/air-main-inner-->


<?php if($sidebars): ?>
<div id="air-footer">
	<p class="submit air-submit">
		<input type="hidden" name="air-sidebar[action]" value="update" />
		<input type="submit" id="air-sidebar-update" class="button-primary" value="Save Changes" />
	</p>
</div><!--/air-footer-->
</form>
<?php endif; ?>