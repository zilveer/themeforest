<?php


class AitCommentsElement extends AitElement
{
	public function isEnabled()
	{
		if($this->config['@disabled'] === false){
			return true;
		}else{
			return false;
		}
	}
}
