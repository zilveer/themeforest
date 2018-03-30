<div id="post-body">
	<div id="post-body-content" style="width: auto;">
<br/>
<?php if(!empty($layouts)): ?>
		<table class="wp-list-table widefat plugins" style="width: auto; min-width: 50%;">
			<thead>
				<tr>
					<th id="field-name" class="manage-column column-name"><?php _e('Title', 'framework') ?></th>
					<th id="field-header" class="manage-column column-header"><?php _e('Header', 'framework') ?></th>
					<th id="field-footer" class="manage-column column-footer"><?php _e('Footer', 'framework') ?></th>
					<th id="field-controls" class="manage-column column-controls" style="text-align:right;">&nbsp;</th>
				</tr>
			</thead>
			<tbody id="the-list">
				<?php foreach ($layouts as $key => $values): ?>
					<tr calss="active">
						<td class="column-name">
							<a href="<?php echo $this->self_url('edit-layout'); ?>&alias=<?php echo $values['alias']; ?>"><strong><?php echo stripslashes($values['title']); ?></strong></a>
						</td>
						<td class="column-header">
							<?php echo !empty($values['header'])? $values['header'] : ''; ?>
						</td>
						<td class="column-footer">
							<?php echo !empty($values['footer'])? $values['footer'] : ''; ?>
						</td>
						<td class="column-controls" style="text-align:right;">
							<a href="<?php echo $this->self_url('edit-layout'); ?>&alias=<?php echo $values['alias']; ?>"><?php _e('Edit', 'framework') ?></a> | 
							<a style="color: #BC0B0B;" href="<?php echo $this->self_url(); ?>&navigation=layouts-list&action=delete-layout&alias=<?php echo $values['alias']; ?>"><?php _e('Delete', 'framework') ?></a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<br>

		<form action="<?php echo $this->self_url(); ?>&action=update-contexts" method="post">

			<?php

			// ==========================================
			// Layout Contexts
			// ==========================================

			// Defaults
			$default_contexts = array(
				'default' => array( 'name' => __('Default', 'framework'), 'description' => __('The default layout used when a layout is not assigned.', 'framework') ),
				'home'    => array( 'name' => __('Home Page', 'framework'), 'description' => __('The home page layout.', 'framework') ),
				'page'    => array( 'name' => __('Page', 'framework'), 'description' => __('Page layout.', 'framework') ),
				'post'    => array( 'name' => __('Single Post', 'framework'), 'description' => __('Single Post layout.', 'framework') ),
				'blog'    => array( 'name' => __('Blog', 'framework'), 'description' => __('The blog post list layout.', 'framework') ),
				// 'category' => array( 'name' => __('Category', 'framework'), 'description' => __('Optional', 'framework') ),
				// 'author'   => array( 'name' => __('Author', 'framework'), 'description' => __('Optional', 'framework') ),
				// 'tag'      => array( 'name' => __('Tag', 'framework'), 'description' => __('Optional', 'framework') ),
				// 'date'     => array( 'name' => __('Date', 'framework'), 'description' => __('Optional', 'framework') ),
				'search'  => array( 'name' => __('Search', 'framework'), 'description' => __('Search results layout.', 'framework') ),
				'error'   => array( 'name' => __('Error', 'framework'), 'description' => __('404 error page layout.', 'framework') ),
			);

			$default_context_list = array_keys($default_contexts); // get keys for comparison with other lists

			// More contexts can be registered using the "register_context()" function 
			// For reference see the function notes in 'template-functions/template-engine.php'

			// These are some contexts that might be in the theme or reason just needs to be restricted to prevent naming conflicts
			$ignore_context_list = array(
				'static_block' );

			// The list we get from the saved global array created by "register_context()"
			$custom_context_list = $GLOBALS['master_context_list'];


			// Output selects for default contexts
			// ---------------------------------------

			if ( !empty($default_contexts) ) {
				
				echo '<div class="hr"></div> <br> <h3>'. __('Defaults', 'framework') .'</h3>';
				echo '<p>' . __('Layouts for the default areas of your site.', 'framework') . '</p>';
				echo '<table class="form-table">';

				foreach ($default_contexts as $context => $details) {
					
					// Skip anything that might be a duplicate of a default
					if (!in_array($context, $ignore_context_list) && $context) {

						?>
						<tr class="">
							<th scope="row" valign="top">
								<span><?php echo $details['name'] ?></span>
								<p class="description"></p>
							</th>
							<td>
								<select class="input-select" name="options[<?php echo $context ?>]">
									<option value=""></option>
									<?php foreach ($layouts as $key => $values): 
										$selected = '';
										if ( !empty($contexts) && $values['alias'] == $contexts[$context])
											$selected = 'selected="selected"';
										?>
										<option value="<?php echo $values['alias']; ?>" <?php echo $selected ?>><?php echo stripslashes($values['title']); ?></option>
									<?php endforeach; ?>
								</select>
								<p class="description"><?php echo $details['description'] ?></p>
							</td>
						</tr>
						<?php
					}
				}
				echo '</table>';
			}


			// Manually registered context/layouts
			// ---------------------------------------

			// get an array of manually registered contexts after subtracting all defaults and ignored context values
			$manual_context_list = array_flip(array_diff((array)array_flip((array) $custom_context_list['manual']), $default_context_list, $ignore_context_list));

			if ( !empty($manual_context_list) ) {

				echo '<br> <div class="hr"></div> <br> <h3>'. __('Registered Templates', 'framework') .'</h3>';
				echo '<p>' . __('Additional layout assignments can be registered manually using the <code>register_context()</code> function. When registered they will appear in this area. ', 'framework') . '</p>';
				echo '<table class="form-table">';

				foreach ($manual_context_list as $context => $name) {
					
					// Skip anything that might be a duplicate of a default
					if (!in_array($context, $default_context_list) && !in_array($context, $ignore_context_list) && $context) {

						?>
						<tr class="">
							<th scope="row" valign="top">
								<span><?php echo $name ?></span>
								<p class="description"></p>
							</th>
							<td>
								<select class="input-select" name="options[<?php echo $context ?>]">
									<option value=""></option>
									<?php foreach ($layouts as $key => $values): 
										$selected = '';
										if ( !empty($contexts) && $values['alias'] == $contexts[$context])
											$selected = 'selected="selected"';
										?>
										<option value="<?php echo $values['alias']; ?>" <?php echo $selected ?>><?php echo $values['title']; ?></option>
									<?php endforeach; ?>
								</select>
								<p class="description"></p>
							</td>
						</tr>
						<?php
					}
				}
				echo '</table>';

			}


			// Auto registered context/layouts (these might be from plugins, found by searching the WP post type object)
			// ---------------------------------------

			// get an array of manually registered contexts after subtracting all defaults and ignored context values
			$auto_context_list = isset($custom_context_list['auto'])? array_flip(array_diff((array) array_flip((array) $custom_context_list['auto']), $default_context_list, $ignore_context_list)) : array();

			if ( !empty($auto_context_list) ) {

				echo '<br> <div class="hr"></div> <br> <h3>'. __('Custom Post Types (auto generated)', 'framework') .'</h3>';
				// echo '<p>' . __('The following layouts were generated from the WP Custom Post Type object. They may not apply as some post types do not have public facing template files or may use overload methods for inserting content or shortcodes instead. Setting the values below can allow a custom post type to have the theme specific layout applied but not always.', 'framework') . '</p>';
				// echo '<p class="warning"><em>' . __('These settings may not apply depending on the method of inserting content used by the plugin author.', 'framework') . '</em></p>';
				echo '<table class="form-table">';

				foreach ($auto_context_list as $context => $name) {
					
					// Skip anything that might be a duplicate of a default
					if (!in_array($context, $default_context_list) && !in_array($context, $ignore_context_list) && $context) {

						?>
						<tr class="">
							<th scope="row" valign="top">
								<span><?php echo $name ?></span>
								<p class="description"></p>
							</th>
							<td>
								<select class="input-select" name="options[<?php echo $context ?>]">
									<option value=""></option>
									<?php foreach ($layouts as $key => $values): 
										$selected = '';
										if ( !empty($contexts) && $values['alias'] == $contexts[$context])
											$selected = 'selected="selected"';
										?>
										<option value="<?php echo $values['alias']; ?>" <?php echo $selected ?>><?php echo $values['title']; ?></option>
									<?php endforeach; ?>
								</select>
								<p class="description"></p>
							</td>
						</tr>
						<?php
					}
				}
				echo '</table>';
			} ?>

			<br>
			<p>
				<input class="button-primary" type="submit" value="Save Settings">
			</p>
			<br>

			<?php

			echo '<div class="hr"></div>';
			echo '<p>' . __('To manually register a template file you can use the <code>register_context()</code> function. To do this add an entry to your <code>functions.php</code> file.', THEME_NAME) . '</p>';
			echo '<p>' . __('Below is an example usage of how you might register a custom layout for a "news" category file. After you create a category with the slug "news" and add a file to the theme folder named <code>category-news.php</code> you would copy the following to your <code>functions.php</code> file.', THEME_NAME) . '</p>';
			echo '<pre class="code" style="background: #F3F3F3; color: #333; padding: 10px; font-size: 11px; border: 1px solid #EAEAEA; }">'.
				 '// Register custom template file for layout settings'. PHP_EOL .
				 '// -------------------------------------------------'. PHP_EOL .
				 ' '. PHP_EOL .
				 '$news_template = locate_template(\'category-news.php\'); // returns full path of file in theme folder'. PHP_EOL .
				 'register_context( \'News Category\', \'category_news\', $news_template); // $name, $context, $template_file</pre>';
			// echo '<br><p>' . __('<strong>Note:</strong> For more detailed documentation of this function, see the notes in the theme file "framework/theme-functions/template-engine.php"', THEME_NAME) . '</p>';

			?>

		</form>

<?php else: ?>
<h3>You have not created any layouts yet.</h3>
<?php endif; ?>

	</div> <!-- / #post-body-content -->
</div> <!-- / #post-body -->