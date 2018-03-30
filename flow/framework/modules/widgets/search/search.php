<?php

/**
 * Widget that adds search icon that triggers opening of search form
 *
 * Class Elated_Search_Opener
 */
class FlowSearch extends FlowWidget {
	/**
	 * Set basic widget options and call parent class construct
	 */
	public function __construct() {
		parent::__construct(
			'eltd_search', // Base ID
			'Elated Search' // Name
		);

		$this->setParams();
	}

	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$this->params = array(
		);
	}

	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget($args, $instance) {

		print $args['before_widget'];
		?>
		<div class="eltd-search-holder clearfix">
			<div class="eltd-search-holder-inner">
				<a class="eltd-search-opener" href="#">
					<i class="eltd-icon-font-awesome fa fa-search"></i>
				</a>
				<div class="eltd-search-form-holder">
					<form method="get" id="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
						<input type="text" value="" placeholder="<?php esc_html_e('Search', 'flow'); ?>" name="s"/>
					</form>
				</div>
			</div>
		</div>
		<?php
		print $args['after_widget'];

	}

}