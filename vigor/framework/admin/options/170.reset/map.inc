<?php

$resetPage = new EdgeAdminPage("21", "Reset", "fa fa-retweet");
$edgtFramework->edgtOptions->addAdminPage("Reset",$resetPage);

//Reset

$panel1 = new EdgePanel("Reset to Defaults","reset_panel");
$resetPage->addChild("panel1",$panel1);

	$reset_to_defaults = new EdgeField("yesno","reset_to_defaults","no","Reset to Defaults","This option will reset all Edge Options values to defaults");
	$panel1->addChild("reset_to_defaults",$reset_to_defaults);