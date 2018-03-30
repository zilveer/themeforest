<?php
/** 
 * Deprecated Functions
 * @package VAN Framework
 */
	
function van_portfolios_filter($inverse=0,$exclude='',$include_slug='',$echo=true){
	$ex_arr=explode(',',$exclude);
	if($include_slug<>''){
	   $include_slug_array=explode(',',$include_slug);
	   $include='';
	   for($i=0;$i<count($include_slug_array);$i++){
		 $terms = get_term_by('slug', $include_slug_array[$i], 'portfolios'); 
		 $include .= $terms->term_id.',';
	   }
	   $include = trim($include, ',');
	}else{
	   $include='';
	}
	
	$terms = get_terms("portfolios",array('hide_empty'=>true,'parent'=>0,'include'=>$include,'exclude'=>$ex_arr));
	$count = count($terms);
	if($inverse==0){
	  $class='';
	}else{
	  $class=' inverse';
	}
	$return_html='';
	if($count > 0){
     $return_html.='<nav id="filter" data-option-key="filter" class="tax'.$class.van_css_animate(' wpb_animate_when_almost_visible wpb_bottom-to-top').'">
		  <ul>
			<li class="filter_current"><a href="#fliter" data-filter="*">'.__('All','SimpleKey').'</a></li>';
	 foreach($terms as $term) {
		$return_html .= '<li><a href="javascript:void(0)" data-filter=".'.$term->slug.'">'.$term->name.'</a></li>';
	 }
	 $return_html.='</ul></nav>';
	}
	if($echo)
		{
			echo $return_html;
		}
		else
		{
			return $return_html;
	}
}
?>