<?php global $smof_data; 
$css_attachment = array(''=>'Default', 'scroll' => 'Scroll', 'fixed' => 'Fixed', 'local' => 'Local','initial' => 'Initial','inherit' => 'Inherit');
?>
<div id="cs-blog-loading" class="cs_loading" style="display: block;">
	<div id="followingBallsG">
	<div id="followingBallsG_1" class="followingBallsG">
	</div>
	<div id="followingBallsG_2" class="followingBallsG">
	</div>
	<div id="followingBallsG_3" class="followingBallsG">
	</div>
	<div id="followingBallsG_4" class="followingBallsG">
	</div>
	</div>
</div>
<div id="cs-blog-metabox" class='cs_metabox' style="display: none;">
	<div id="cs-tab-blog" class='categorydiv'>
	<ul class='category-tabs'>
	   <li class='cs-tab'><a href="#tabs-general"><i class="dashicons dashicons-admin-settings"></i> <?php echo esc_html_e('GENERAL','wp_nuvo');?></a></li>
	   <li class='cs-tab'><a href="#tabs-body"><i class="dashicons dashicons-welcome-write-blog"></i> <?php echo esc_html_e('BODY','wp_nuvo');?></a></li>
	   <li class='cs-tab'><a href="#tabs-header"><i class="dashicons dashicons-menu"></i> <?php echo esc_html_e('HEADER','wp_nuvo');?></a></li>
	   <li class='cs-tab'><a href="#tabs-page-title"><i class="dashicons dashicons-admin-home"></i> <?php echo esc_html_e('PAGE TITLE & BREADCRUMB','wp_nuvo');?></a></li>
	   <li class='cs-tab'><a href="#tabs-sidebar"><i class="dashicons dashicons-slides"></i> <?php echo esc_html_e('SIDEBAR','wp_nuvo');?></a></li>
	   <li class='cs-tab'><a href="#tabs-footer"><i class="dashicons dashicons-archive"></i> <?php echo esc_html_e('FOOTER','wp_nuvo');?></a></li>
 	</ul>
 	<div class='cs-tabs-panel'>
 		<div id="tabs-general">
 			<?php
 			$this->select('show_heading',
 					'Show Heading',
 					array('' => 'Default','1' => 'Show', '0' => 'Hide'),
 					'',
					''
 			);

 			$this->select('blog_layout',
							'Layout',
							array('boxed' => 'Boxed', 'full' => 'Full Width'),
							'full',
							''
			);
			?>
 		</div>
	 	<div id="tabs-body">
			<p class="cs_info"><i class="dashicons dashicons-format-image"></i><?php echo esc_html_e('Following options only work in boxed mode:','wp_nuvo');?></p>
			<?php

			$this->upload('bg_image', 'Background Image for Blog');
			$this->text('bg_color',
					'Background Color (HEX)',
					''
			);
			$this->select('bg_repeat',
					'Background Repeat',
					array(''=>'Default', 'repeat' => 'Repeat', 'repeat-x' => 'Repeat-X','repeat-y' => 'Repeat-Y', 'no-repeat' => 'No-Repeat'),
					'',
					''
			);
			$this->select('bg_attachment',
			    'Background Attachment',
			    $css_attachment,
			    '',
			    ''
			);
			$this->text('body_padding',
			    'Padding',
			    ''
			);
			$this->text('body_custom_class',
					'Custom Class',
					''
			);
			?>
		</div>
		<div id="tabs-header">
			<?php
			$args = array('posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'title', 'post_type' => 'header');
			$header_layout = get_posts($args);
			$custom_header = array();
			foreach ($header_layout as $header) {
				$custom_header["cs-header-".$header->ID] = $header->post_title;
			}
			$headers_default = array(
					'' => 'Theme Option',
					'v1' => 'Header Default'
			);
			$headers = array_merge($headers_default,$custom_header);
			$this->select('page_header',
					'Select Header',
					$headers,
					'',
					''
			);
			$this->select('header_setting',
					'Custom Header',
					array('' => 'Default', 'custom' => 'Custom'),
					'',
					''
			);
			?>
			<div id="header_setting">
			<p class="cs_info"><i class="dashicons dashicons-admin-post"></i><?php echo esc_html_e('Header Fixed Setting:','wp_nuvo');?></p>
			<?php
			$this->select('header_fixed_top',
					'Header Fixed',
					array('0' => 'No', '1' => 'Yes'),
					'no',
					''
			);
			?>
			<div id="header_fixed_color">
			<?php
			$this->text('header_fixed_menu_color',
					'Menu Fixed Color (HEX)',
					''
			);
			$this->text('header_fixed_menu_color_hover',
					'Menu Fixed Hover Color (HEX)',
					''
			);
			$this->select('header_border_bottom',
					'Header Border Bottom',
					array('1' => 'Yes', '0' => 'No'),
					'yes',
					''
			);
			?>
			</div>
			<p class="cs_info"><i class="dashicons dashicons-format-image"></i><?php echo esc_html_e('Background Setting:','wp_nuvo');?></p>
			<?php
			$this->upload('header_bg_image', 'Background Image');
			$this->text('header_bg_color',
					'Background Color (HEX)',
					'',
					''
			);
			$this->text('header_bg_opacity',
					'Background Opacity',
					'',
					'Set Background Opacity (0.0 to 1.0)'
			);
			$this->select('header_bg_repeat',
					'Background Repeat',
					array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-X','repeat-y' => 'Repeat-Y', 'no-repeat' => 'No-Repeat'),
					'',
					''
			);
			$this->select('header_bg_full',
					'100% Background Image',
					array('yes' => 'Yes', 'no' => 'No'),
					'',
					''
			);
			$this->select('header_bg_parallax',
					'Parallax Background Image',
					array('yes' => 'Yes', 'no' => 'No'),
					'',
					''
			);
			?>
			</div>
			<p class="cs_info"><i class="dashicons dashicons-lightbulb"></i><?php echo esc_html_e('Sticky Header','wp_nuvo'); ?></p>
			<?php
			$this->select('show_sticky_header',
 					'Sticky Header',
 					array('' => 'Default','show' => 'Show', 'hide' => 'Hide'),
 					'',
					''
 			);
			?>
			<p class="cs_info"><i class="dashicons dashicons-megaphone"></i><?php echo esc_html_e('Manage Locations','wp_nuvo'); ?></p>
			<?php
			$menus = array();
			$menus[''] = 'Default';
			$obj_menus = wp_get_nav_menus();
			foreach ($obj_menus as $obj_menu){
				$menus[$obj_menu->term_id] = $obj_menu->name;
			}
			$navs = get_registered_nav_menus();
			foreach ($navs as $key => $mav){
				$this->select($key,
						$mav,
						$menus,
						'',
						''
				);
			}
			?>
		</div>
		<div id="tabs-sidebar" class="clearfix">
			<ul id="cs-list-widget" class="droptrue">
				<?php
					global $wp_registered_sidebars;
					global $post;
					$use_slidebar = array();
					$cs_slidebars = json_decode(urldecode(get_post_meta($post->ID, 'cs_blog_slidebars', true)));
					if($cs_slidebars){
						foreach ($cs_slidebars as $cs_slidebar){
							foreach ($cs_slidebar as $id_slidebar){
								$use_slidebar[] = $id_slidebar;
							}
						}
					}
				?>
				<?php foreach ($wp_registered_sidebars as $widget_id): ?>
					<?php if(!in_array($widget_id['id'],$use_slidebar)): ?>
						<li id="<?php echo $widget_id['id']; ?>" class="cs-widget">
							<?php echo $widget_id['name']; ?>
							<input id="<?php echo $widget_id['id']; ?>" name="<?php echo $widget_id['id']; ?>" type="hidden" value="<?php echo $widget_id['id']; ?>" />
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<div id="cs-content" class="cs-content">
				<div class="cs-widget-content clearfix">
					<ul id="sortable-left-1" class="cs-widget-left droptrue">
					<?php if($cs_slidebars): ?>
						<?php foreach ($cs_slidebars->left1 as $slidebar):?>
						<li id="<?php echo $slidebar; ?>" class="cs-widget">
							<?php echo $wp_registered_sidebars[$slidebar]['name']; ?>
							<input id="<?php echo $slidebar; ?>" name="<?php echo $slidebar; ?>" type="hidden" value="<?php echo $slidebar; ?>" />
						</li>
						<?php endforeach; ?>
					<?php endif; ?>
					</ul>
					<ul id="sortable-left-2" class="cs-widget-left droptrue">
					<?php if($cs_slidebars): ?>
						<?php foreach ($cs_slidebars->left2 as $slidebar):?>
						<li id="<?php echo $slidebar; ?>" class="cs-widget">
							<?php echo $wp_registered_sidebars[$slidebar]['name']; ?>
							<input id="<?php echo $slidebar; ?>" name="<?php echo $slidebar; ?>" type="hidden" value="<?php echo $slidebar; ?>" />
						</li>
						<?php endforeach; ?>
					<?php endif; ?>
					</ul>
					<div class="cs-widget-center"><span>BLOG</span></div>
					<ul id="sortable-right-1" class="cs-widget-rigth droptrue">
					<?php if($cs_slidebars): ?>
						<?php foreach ($cs_slidebars->right1 as $slidebar):?>
						<li id="<?php echo $slidebar; ?>" class="cs-widget">
							<?php echo $wp_registered_sidebars[$slidebar]['name']; ?>
							<input id="<?php echo $slidebar; ?>" name="<?php echo $slidebar; ?>" type="hidden" value="<?php echo $slidebar; ?>" />
						</li>
						<?php endforeach; ?>
					<?php endif; ?>
					</ul>
					<ul id="sortable-right-2" class="cs-widget-rigth droptrue">
					<?php if($cs_slidebars): ?>
						<?php foreach ($cs_slidebars->right2 as $slidebar):?>
						<li id="<?php echo $slidebar; ?>" class="cs-widget">
							<?php echo $wp_registered_sidebars[$slidebar]['name']; ?>
							<input id="<?php echo $slidebar; ?>" name="<?php echo $slidebar; ?>" type="hidden" value="<?php echo $slidebar; ?>" />
						</li>
						<?php endforeach; ?>
					<?php endif; ?>
					</ul>
				</div>
				<?php $this->hidden('blog_slidebars'); ?>
			</div>
			<div class="cs_setting">
					<?php
					$this->text('slidebars_left1',
							'Left 1',
							''
					);
					$this->text('slidebars_left2',
							'Left 2',
							''
					);
					$this->text('slidebars_blog',
							'Blog',
							''
					);
					$this->text('slidebars_rigth1',
							'Rigth 1',
							''
					);
					$this->text('slidebars_rigth2',
							'Rigth 2',
							''
					);
					?>
			</div>
		</div>
		<div id="tabs-page-title">
			<?php
			$this->select(	'page_title',
					'Page Title Bar',
					array('defualt' => 'Default','custom' => 'Custom', 'hide' => 'Hide'),
					'',
					''
			);
			?>
			<div id="page_title">
			<?php
			$this->select(	'title_bar_align',
					'Title Align',
					array('left' => 'Left', 'center' => 'Center', 'right' => 'Right'),
					'center',
					''
			);
			cs_options(array(
    			'id'=>'title_bar_color',
    			'label'=>__('Title Color', 'wp_nuvo'),
    			'value'=>'',
    			'type'=>'color'
			));
			$this->text('page_title_custom_size',
					'Page Title Bar Custom Size',
					''
			);
			$this->text('page_title_custom_text',
					'Page Title Bar Custom Text',
					''
			);
			$this->text('page_title_custom_subheader_text',
					'Page Title Bar Custom Subheader Text',
					''
			);
			cs_options(array(
    			'id'=>'page_title_custom_subheader_text_color',
    			'label'=>__('Subheader Color', 'wp_nuvo'),
    			'value'=>'',
    			'type'=>'color'
			));
			$this->text('page_title_padding',
					'Padding',
					''
			);
			?>
			<p class="cs_info"><i class="dashicons dashicons-format-image"></i><?php echo esc_html_e('Background setting:','wp_nuvo');?></p>
			<?php
			$this->text('page_title_background_color',
					'Background Color (HEX)',
					''
			);
			$this->upload('page_title_bg', 'Background Image for Page Title');
			?>
			<div id="page_title_bg">
			<?php
			$this->select('page_title_bg_color',
					'Background Repeat',
					array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-X','repeat-y' => 'Repeat-Y', 'no-repeat' => 'No-Repeat'),
					'',
					''
			);
			$this->select('page_title_bg_full',
							'100% Background Image',
							array('yes' => 'Yes', 'no' => 'No'),
							'',
							''
			);
			$this->select('page_title_bg_parallax',
					'Parallax Background Image',
					array('yes' => 'Yes', 'no' => 'No'),
					'',
					''
			);
			?>
			</div>
			<?php
			$this->text('page_title_class',
					'Custom Class',
					''
			);
			?>
			</div>
			<p class="cs_info"><i class="dashicons dashicons-flag"></i><?php echo esc_html_e('Breadcrumb','wp_nuvo'); ?></p>
			<?php
			$this->select(	'breadcrumb',
					'Breadcrumbs',
					array('defualt' => 'Default','custom' => 'Custom', 'hide' => 'Hide'),
					'',
					''
			);
			?>
			<div id="custom_breadcrumb">
			<?php
			cs_options(array(
    			'id'=>'breadcrumb_text_align',
    			'label'=>__('Text Align', 'wp_nuvo'),
    			'type'=>'select',
	            'options'=>array('left'=>'Left','center'=>'Center','right'=>'right')
		    ));
			cs_options(array(
			     'id'=>'breadcrumb_color',
			     'label'=>__('Text Color', 'wp_nuvo'),
			     'value'=>'',
			     'type'=>'color'
			));
			cs_options(array(
    			'id'=>'breadcrumb_text',
    			'label'=>__('Custom Text', 'wp_nuvo'),
    			'value'=>'',
    			'type'=>'text'
			));
			?>
			</div>
		</div>
		<div id="tabs-footer">
			<?php
			$this->upload('footer_top_bg_image', 'Background Image');
			$this->text('footer_top_bg_color',
					'Background Color (HEX)',
					''
			);
			$this->select('footer_top_bg_repeat',
					'Background Repeat',
					array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-X','repeat-y' => 'Repeat-Y', 'no-repeat' => 'No-Repeat'),
					'',
					''
			);
			$this->select('footer_top_bg_pos',
					'Background Position',
					array('top left' => 'top left',
						  'top center' => 'top center',
						  'top right' => 'top right',
						  'center left' => 'center left',
						  'center center' => 'center center',
						  'center right' => 'center right',
						  'bottom left' => 'bottom left',
						  'bottom center' => 'bottom center',
						  'bottom right' => 'bottom right'
					),
					'',
					''
			);
			$this->select('footer_top_bg_full',
					'100% Background Image',
					array('yes' => 'Yes', 'no' => 'No'),
					'',
					''
			);
			$this->select('footer_top_bg_parallax',
					'Parallax Background Image',
					array('yes' => 'Yes', 'no' => 'No'),
					'',
					''
			);
			?>
		</div>
	</div>
	</div>
</div>