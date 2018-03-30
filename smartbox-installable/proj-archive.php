<?php
	
	$o = get_option(DESIGNARE_SHORTNAME."_projects_archive_style");

	if($o == 'style1') get_template_part('proj-archive-s1', 'proj-archive');
	else get_template_part('proj-archive-s2', 'proj-archive');
	
?>

