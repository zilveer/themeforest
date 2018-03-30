
<div id="bra_portfolio_only">
<div id="brankic_shortcode_form_wrapper">
<form id="brankic_shortcode_form" name="brankic_shortcode_form" method="post" action="">
  <p>
    <label>Title above items</label>
      <input type="text" name="title" id="title" value="Recent Work" size="50"/>
  </p>
  
  <p>
    <label>Items to show (-1: all)</label>
      <input type="text" name="no" id="no" value="-1" size="5"/>
  </p>
  
  <p>
    <label>Category to show</label>
<?php
//include("portfolio_select.txt");
?>
  
      <select name="cat_id" id="cat_id">
<?php
if (file_exists("../../../../wp-blog-header.php")) require_once('../../../../wp-blog-header.php');
if (file_exists("../../../wp-blog-header.php")) require_once('../../../wp-blog-header.php');
if (file_exists("../../wp-blog-header.php")) require_once('../../wp-blog-header.php');
if (file_exists("../wp-blog-header.php")) require_once('../wp-blog-header.php');
if (file_exists("/wp-blog-header.php")) require_once('/wp-blog-header.php');
if (file_exists("wp-blog-header.php")) require_once('wp-blog-header.php');
	
	$terms = get_terms("portfolio_category");
	if ( !(empty($terms))) {
	 foreach ( $terms as $term ) {
	   $all_portfolio_terms[$term->term_id] = $term->name;                   
	 }
	  
		foreach ($all_portfolio_terms as $term_id => $term_name) 
		{ 
			$select .= '<option value="' .$term_id . '">' . $term_name . '</option>'; 
			
		} 
	}
	echo $select;

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	foreach ($options_categories as $cat_id => $cat_name)
	{
		echo "<option value='$cat_id'>$cat_name</option>";
	} 
?>
	</select>
  </p>
  
  <p>
    <label>Show filters</label>
      <select  name="show_filters" id="show_filters">
        <option value="yes">Yes</option>
        <option value="no">No</option>
      </select>
  </p>
  
  <p>
    <label>Columns</label>
      <select name="columns" id="columns">
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
      </select>
  </p>

  <p>
    <label>Shape</label>
      <select name="shape" id="shape">
        <option value="">None</option>
        <option value="hexagon">Hexagon</option>
        <option value="circle">Circle</option>
        <option value="triangle">Triangle</option>
      </select>
  </p>
  
  <p>
    <label>Hover active</label>
      <select  name="hover" id="hover">
        <option value="yes">Yes</option>
        <option value="no">No - click = single post</option>
        <option value="no_with_pop_up">No - click = pop-up larger image</option>
      </select>
  </p>
  
  <p>
    <label>Height</label>
      <input type="text" name="height" id="height" value="" size="5"/>
  </p>
  
    
  <p>
      <input type="submit" name="Insert" id="bra_insert_shortcode_button" value="Submit" />
  </p>
<script>
            document.getElementById( 'bra_insert_shortcode_button' ).onclick = function(){
				var title = document.getElementById( 'title' ).value;
				var cat_id = document.getElementById( 'cat_id' ).value;
				var no = document.getElementById( 'no' ).value;
				var show_filters = document.getElementById( 'show_filters' ).value;
				var columns = document.getElementById( 'columns' ).value;
				var shape = document.getElementById( 'shape' ).value;
				var hover = document.getElementById( 'hover' ).value;
				var height = document.getElementById( 'height' ).value;
				var shortcode = "[bra_portfolio title='" + title +"' cat_id='" + cat_id +"'  no='" + no + "' show_filters='" + show_filters + "' columns='" + columns + "' shape='" + shape + "' height='" + height + "' hover='" + hover + "']";

                window.parent.tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, shortcode );
                window.close();
            };
</script>
</form>
</div>
</div>
