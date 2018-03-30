<?php
#
# additional elements before sidebar
#
global $before_sidebar;
echo $before_sidebar;

#
# call sidebars
#
$createSidebars = new RT_Create_Sidebars();
$createSidebars -> rt_get_sidebar();
?>
