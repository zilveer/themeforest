<?php 
get_header(); 

get_template_part( 'templates/agent-single/' . $pgl_options->option('agent_single_layout') );

get_footer();