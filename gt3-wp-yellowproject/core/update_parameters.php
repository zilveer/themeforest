<?php
#delete_theme_option("theme_version");

$theme_temp_version = get_theme_option("theme_version");

if ((int)$theme_temp_version < 1) {
    update_theme_option("translate_related_projects", "Related Projects");
    update_theme_option("translate_related_posts", "Related Posts");
    update_theme_option("theme_version", 1);
}

?>