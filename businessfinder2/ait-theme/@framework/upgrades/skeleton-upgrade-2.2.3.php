<?php


class AitSkeletonUpgrade223
{

	protected $errors = array();



	public function execute()
	{
		delete_option('_ait_skeleton_version');
		delete_option('_ait_theme_version');

		AitCache::clean();

		return $this->errors;
	}
}
