<?php
$portfolio_mb = new MomizatMB_MetaBox(array
(
    'id' => 'mom_portfolio_meta',
    'title' => __('Portfolio Details', 'framework'),
    'template' => MOM_FW . '/metaboxes/momizat-class/portfolio-meta.php',
    'types' => array('portfolio')
));

$portfolio_st = new MomizatMB_MetaBox(array
(
    'id' => 'mom_portfolio_settings',
    'title' => __('Portfolio Settings', 'framework'),
    'template' => MOM_FW . '/metaboxes/momizat-class/portfolio-st.php',
    'types' => array('portfolio')
));