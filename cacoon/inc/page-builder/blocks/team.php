<?php
if(!class_exists('MET_Team_Group')) {
	class MET_Team_Group extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Team Group',
				'size' => 'span12'
			);

			//create the widget
			parent::__construct('MET_Team_Group', $block_options);

			//add ajax functions
			add_action('wp_ajax_aq_block_team_add_new', array($this, 'add_tab'));

		}

		function form($instance) {

			$defaults = array(
				'tabs' => array(
					1 => array(
						'title' 				=> 'Team Member #1',
						'avatar' 				=> '',
						'position_title'		=> '',
						'desc'					=> '',
						'social_icon_1'			=> '',
						'social_icon_link_1'	=> '',
						'social_icon_2'			=> '',
						'social_icon_link_2'	=> '',
						'social_icon_3'			=> '',
						'social_icon_link_3'	=> '',
						'social_icon_4'			=> '',
						'social_icon_link_4'	=> '',
						'social_icon_5'			=> '',
						'social_icon_link_5'	=> '',
						'member_skill_title_1'		=> '',
						'member_skill_percent_1'	=> '',
						'member_skill_title_2'		=> '',
						'member_skill_percent_2'	=> '',
						'member_skill_title_3'		=> '',
						'member_skill_percent_3'	=> '',
						'member_skill_title_4'		=> '',
						'member_skill_percent_4'	=> '',
					)
				)
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
					$count = 1;
					foreach($tabs as $tab) {
						$this->team($tab, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="team" class="aq-sortable-add-new button">Add New Member</a>
				<p></p>
			</div>
		<?php
		}

		function team($tab = array(), $count = 0) {

			?>
			<li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">

				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $tab['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>

				<div class="sortable-body">
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title">
							Team Member Name<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]" value="<?php echo $tab['title'] ?>" />
						</label>
					</div>
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-position_title">
							Position<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-position_title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][position_title]" value="<?php echo $tab['position_title'] ?>" />
						</label>
					</div>
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-desc">
							Description<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-desc" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][desc]" value="<?php echo $tab['desc'] ?>" />
						</label>
					</div>
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-avatar">
							Team Member Photo<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-avatar" class="input-full input-upload" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][avatar]" value="<?php echo $tab['avatar'] ?>">
							<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
						</label>
						<?php if($tab['avatar']) { ?>
							<div class="screenshot">
								<img src="<?php echo $tab['avatar'] ?>" />
							</div>
							<div style="clear: both"></div>
						<?php } ?>
					</div>

					<?php for($mc = 1; $mc <= 4; $mc++): ?>
						<div class="tab-desc description half">
							<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-member_skill_title_<?php echo $mc ?>">
								<input placeholder="Member Skill Title (<?php echo $mc ?>)" type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-member_skill_title_<?php echo $mc ?>" class="input-full icon_chose_input" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][member_skill_title_<?php echo $mc ?>]" value="<?php echo $tab['member_skill_title_'.$mc] ?>" />
							</label>
						</div>
						<div class="tab-desc description half last">
							<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-member_skill_percent_<?php echo $mc ?>">
								<input placeholder="Member Skill Percent (<?php echo $mc ?>)" type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-member_skill_percent_<?php echo $mc ?>" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][member_skill_percent_<?php echo $mc ?>]" value="<?php echo $tab['member_skill_percent_'.$mc] ?>" />
							</label>
						</div>
					<?php endfor; ?>

					<?php for($mc = 1; $mc <= 5; $mc++): ?>
					<div class="tab-desc description half">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-social_icon_<?php echo $mc ?>">
							<input placeholder="Social Icon (<?php echo $mc ?>)" type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-social_icon_<?php echo $mc ?>" class="input-full icon_chose_input" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][social_icon_<?php echo $mc ?>]" value="<?php echo $tab['social_icon_'.$mc] ?>" />
						</label>
					</div>
					<div class="tab-desc description half last">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-social_icon_link_<?php echo $mc ?>">
							<input placeholder="Social Icon Link (<?php echo $mc ?>)" type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-social_icon_link_<?php echo $mc ?>" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][social_icon_link_<?php echo $mc ?>]" value="<?php echo $tab['social_icon_link_'.$mc] ?>" />
						</label>
					</div>
					<?php endfor; ?>

					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>

			</li>
		<?php
		}

		function block($instance) {
			extract($instance);
?>
			<div class="row-fluid">
				<?php foreach( $tabs as $tab ): ?>
				<div class="span4">
					<div class="met_team_member">
						<div class="met_team_member_preview">
							<img src="<?php echo ((empty($tab['avatar'])) ? 'http://placehold.it/275x244' : $tab['avatar']) ?>" alt="<?php echo esc_attr($tab['title']) ?>" />
							<div class="met_team_member_overlay">
								<?php echo ((!empty($tab['member_skill_title_1'])) ? '<div class="met_team_member_skill"><div style="width: '.$tab['member_skill_percent_1'].'%"><span class="met_bgcolor_trans met_color2">'.$tab['member_skill_title_1'].'</span></div></div>' : '') ?>
								<?php echo ((!empty($tab['member_skill_title_2'])) ? '<div class="met_team_member_skill"><div style="width: '.$tab['member_skill_percent_2'].'%"><span class="met_bgcolor_trans met_color2">'.$tab['member_skill_title_2'].'</span></div></div>' : '') ?>
								<?php echo ((!empty($tab['member_skill_title_3'])) ? '<div class="met_team_member_skill"><div style="width: '.$tab['member_skill_percent_3'].'%"><span class="met_bgcolor_trans met_color2">'.$tab['member_skill_title_3'].'</span></div></div>' : '') ?>
								<?php echo ((!empty($tab['member_skill_title_4'])) ? '<div class="met_team_member_skill"><div style="width: '.$tab['member_skill_percent_4'].'%"><span class="met_bgcolor_trans met_color2">'.$tab['member_skill_title_4'].'</span></div></div>' : '') ?>
							</div>
						</div>
						<div class="met_team_member_details met_bgcolor3 met_color2">
							<h2 class="met_title_stack"><?php echo $tab['position_title'] ?></h2>
							<h3 class="met_title_stack met_bold_one"><?php echo $tab['title'] ?></h3>
							<p><?php echo $tab['desc'] ?></p>
						</div>
						<div class="met_team_member_socials met_bgcolor clearfix">
							<?php echo ((!empty($tab['social_icon_1'])) ? '<a href="'.$tab['social_icon_link_1'].'" class="met_color2" title="" target="_blank"><i class="'.$tab['social_icon_1'].'"></i></a>' : '') ?>
							<?php echo ((!empty($tab['social_icon_2'])) ? '<a href="'.$tab['social_icon_link_2'].'" class="met_color2" title="" target="_blank"><i class="'.$tab['social_icon_2'].'"></i></a>' : '') ?>
							<?php echo ((!empty($tab['social_icon_3'])) ? '<a href="'.$tab['social_icon_link_3'].'" class="met_color2" title="" target="_blank"><i class="'.$tab['social_icon_3'].'"></i></a>' : '') ?>
							<?php echo ((!empty($tab['social_icon_4'])) ? '<a href="'.$tab['social_icon_link_4'].'" class="met_color2" title="" target="_blank"><i class="'.$tab['social_icon_4'].'"></i></a>' : '') ?>
							<?php echo ((!empty($tab['social_icon_5'])) ? '<a href="'.$tab['social_icon_link_5'].'" class="met_color2" title="" target="_blank"><i class="'.$tab['social_icon_5'].'"></i></a>' : '') ?>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
<?php

		}

		/* AJAX add tab */
		function add_tab() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');

			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';

			//default key/value for the tab
			$tab = array(
				'title' 				=> 'Team Member #'.$count,
				'avatar' 				=> '',
				'position_title'		=> '',
				'desc'					=> '',
				'social_icon_1'			=> '',
				'social_icon_link_1'	=> '',
				'social_icon_2'			=> '',
				'social_icon_link_2'	=> '',
				'social_icon_3'			=> '',
				'social_icon_link_3'	=> '',
				'social_icon_4'			=> '',
				'social_icon_link_4'	=> '',
				'social_icon_5'			=> '',
				'social_icon_link_5'	=> '',
				'member_skill_title_1'		=> '',
				'member_skill_percent_1'	=> '',
				'member_skill_title_2'		=> '',
				'member_skill_percent_2'	=> '',
				'member_skill_title_3'		=> '',
				'member_skill_percent_3'	=> '',
				'member_skill_title_4'		=> '',
				'member_skill_percent_4'	=> '',
			);

			if($count) {
				$this->team($tab, $count);
			} else {
				die(-1);
			}

			die();
		}

		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
