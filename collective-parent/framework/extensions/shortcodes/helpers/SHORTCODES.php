<?php

function tf_add_shortcode($type, $function, $atts) {
    global $TFUSE;
    $TFUSE->ext->shortcodes->add_shortcode($type, $function, $atts);
}

function tf_shortcode_alias($alias, $alias_to, $values = array()) {
    global $TFUSE;
    $TFUSE->ext->shortcodes->add_alias($alias, $alias_to, $values);
}

function tf_alias_do() {
    global $TFUSE;
    $aliases = $TFUSE->ext->shortcodes->get_aliases();
    $shortcodes = $TFUSE->ext->shortcodes->get_shortcodes();
    $alias = func_get_arg(2);
    $alias_to = $aliases[$alias]['alias_to'];
    $func_args = func_get_args();
    $func_args[0] = shortcode_atts($aliases[$alias]['values'], $func_args[0]);
    if (isset($aliases[$alias]['values']['content']))
        $func_args[1] = $aliases[$alias]['values']['content'];
    $func = $shortcodes[$alias_to]['function'];
    if (is_array($func)) {
        $ret = $func[0]->$func[1]($func_args[0], $func_args[1], $func_args[2]);
    }
    else
        $ret = $func($func_args[0], $func_args[1], $func_args[2]);
    return $ret;
}
