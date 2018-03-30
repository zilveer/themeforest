<?php

class PeThemeBrowser {
	
	protected $mobileDetect;

	function isMobile() {
		if (!isset($this->mobileDetect)) {
			$this->mobileDetect = new Mobile_Detect();
		}
		return $this->mobileDetect->isMobile();
	}

}

?>