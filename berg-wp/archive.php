<?php

if (YSettings::g('berg_archive_template', 1) == 1) {
	get_template_part('archive', 'content2');
} else {
	get_template_part('archive', 'content');
}

if (YSettings::g('berg_archive_footer', 1) == 1) {
	get_template_part('footer', 'content');
}

get_template_part('footer');

?>
</body>
</html>