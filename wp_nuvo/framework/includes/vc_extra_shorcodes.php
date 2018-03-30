<?php
foreach (glob("".get_template_directory()."/framework/includes/vc_extra_shortcodes/*.php") as $filename)
{
	include $filename;
}