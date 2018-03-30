<?php

header('Content-type: text/css');

echo '/* Theme customizer */' . "\n\n";

echo get_option(THB_CUSTOMIZATIONS);

echo  "\n\n" . '/* Custom CSS */' . "\n\n";

thb_custom_css();