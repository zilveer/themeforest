<?php
get_header();
get_template_part( 'templates/agent-loop/' . $pgl_options->option('agent_list_layout') );
get_footer();