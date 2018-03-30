<?php


class AitPortfolioElement extends AitElement
{
	public static function recursiveCategory($categories, $prefix, $separator)
	{
		$result = "";
		foreach($categories as $category){
			$title = str_replace("&amp;", "&", $category->name);
			$result .= '<li><a href="#" data-ait-portfolio-filter="'.$prefix.$category->slug.'" data-ait-portfolio-title="'.$title.'">'.$separator.$title.'</a></li>';

			$children = get_categories(array('taxonomy' => 'ait-portfolios', 'hide_empty' => 1, 'parent' => $category->term_id));
			if(!empty($children)){
				$result .= self::recursiveCategory($children, $prefix, $separator."&nbsp;&nbsp;");
			}
		}
		return $result;
	}
}
