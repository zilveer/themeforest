<?php
if(!class_exists('MET_Progress_Group')) {
	class MET_Progress_Group extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Progress Group',
				'size' => 'span6'
			);

			//create the widget
			parent::__construct('MET_Progress_Group', $block_options);

			//add ajax functions
			add_action('wp_ajax_aq_block_prog_add_new', array($this, 'add_tab'));

		}

		function form($instance) {

			$defaults = array(
				'tabs' => array(
					1 => array(
						'title' 	=> 'My Progress',
						'percent' 	=> '50',
						'type'		=> 'info'
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
						$this->prog($tab, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="prog" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
		<?php
		}

		function prog($tab = array(), $count = 0) {

			$types = array('info'=>'Info','success'=>'Success','warning'=>'Warning','danger'=>'Error');

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
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title">
							Title<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]" value="<?php echo $tab['title'] ?>" />
						</label>
					</p>
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content">
							Percent<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-percent" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][percent]" value="<?php echo $tab['percent'] ?>" />
						</label>
					</p>
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-type">
							Type<br/>
							<select id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-type" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][type]">
								<?php foreach($types as $typeVAL => $typeTITLE): ?>
									<option <?php echo (($typeVAL == $tab['type']) ? 'selected=""' : '') ?> value="<?php echo $typeVAL ?>"><?php echo $typeTITLE ?></option>
								<?php endforeach; ?>
							</select>
						</label>
					</p>
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>

			</li>
		<?php
		}

		function block($instance) {
			extract($instance);

			$output = '';
			$output .= '<div id="met_block_progress_'. rand(1, 100) .'" class="progress-bars">';

			$i = 1;
			foreach( $tabs as $tab ){
				$output .= '
				<div class="progress progress-' . $tab['type'] . '">
					<div class="bar" style="width: ' . $tab['percent'] . '%">' . $tab['title'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				</div>';
				$i++;
			}

			$output .= '</div>';

			echo $output;

		}

		/* AJAX add tab */
		function add_tab() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');

			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';

			//default key/value for the tab
			$tab = array(
				'title' 		=> 'New Progress',
				'percent' 		=> '50',
				'type'			=> 'info'
			);

			if($count) {
				$this->prog($tab, $count);
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
