<?php

class PeThemeViewLayoutModulePricingTable extends PeThemeViewLayoutModuleColumns {

	public $labels;
	public $low;
	public $high;
	public $cc = array("two-col","two-col","three-col","four-col","five-col","five-col");


	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Pricing Table",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return 
			array(
				  "labels" =>				
				  array(
						"label"=>__("Show Labels",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description"=>__('If set to "YES", the first table will be used to show property labels.','Pixelentity Theme/Plugin'),
						"options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
						"default"=>"no"
						),
				  "starter" => 
				  array(
						"label"=>__("Starter",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __('Which table should be highlighted as "Starter" pack, "1" = highlight first table.','Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("None",'Pixelentity Theme/Plugin') => 0,
							  "1" => 1,
							  "2" => 2,
							  "3" => 3,
							  "4" => 4,
							  "5" => 5,
							  ),
						"default"=> 0
						),
				  "popular" => 
				  array(
						"label"=>__("Popular",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __('Which table should be highlighted as "Popular" pack, "1" = highlight first table.','Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("None",'Pixelentity Theme/Plugin') => 0,
							  "1" => 1,
							  "2" => 2,
							  "3" => 3,
							  "4" => 4,
							  "5" => 5,
							  ),
						
						"default"=> 0
						)
				  );
	}


	public function name() {
		return __("Pricing Table",'Pixelentity Theme/Plugin');
	}

	public function create() {
		return "PricingColumn";
	}

	public function force() {
		return "PricingColumn";
	}

	public function allowed() {
		return "pricingcolumn";
	}

	public function blockClass() {
		return "pe-container ";
	}

	public function rowClass($cols) {
		$rc = parent::rowClass($cols);

		$cols = $cols > count($this->cc) ? count($this->cc) : $cols; 
		$cc = $this->cc[$cols-1];
		return "$rc pricing-table $cc";
	}

	public function colClass($cl,$idx,$cols) {

		$idx += ($this->labels ? 0 : 1);

		if ($this->labels && $idx === 0) {
			$cl="row-titles";
		} else if ($idx === $this->high) {
			$cl="high";
		} else if ($idx === $this->low) {
			$cl="low";
		}

		return "col $cl";
	}

	public function template() {
		$data = (object) $this->conf->data;
		$this->labels = (empty($data->labels) || $data->labels === "yes");
		$this->low = empty($data->starter) ? false : absint($data->starter);
		$this->high = empty($data->popular) ? false : absint($data->popular);
		parent::template();
	}

	public function tooltip() {
		return __("Use this block to add a pricing table module to your layout. A pricing table consists of a column based table of pricing information relating to your products or services. A pricing table may also display an optional column of row titles on the left side.",'Pixelentity Theme/Plugin');
	}


}

?>
