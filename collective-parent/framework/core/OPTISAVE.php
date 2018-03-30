<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

class TF_OPTISAVE extends TF_TFUSE {

    public $_the_class_name = 'OPTISAVE';

    public function __construct() {
        parent::__construct();
    }

    function post_text($option, &$post_options) {
        if (!$this->request->isset_POST($option['id']))
            return;
        $data = htmlentities($this->request->POST($option['id']), ENT_QUOTES, 'UTF-8');
        $post_options[$option['id']] = $data;
    }

    function admin_text($option, $values, &$framework_options) {
        if (!isset($values[$option['id']]))
            return;

        apply_filters('admin_text_value', $values[$option['id']], $option);
        $data = htmlentities($values[$option['id']], ENT_QUOTES, 'UTF-8');
        $framework_options[$option['id']] = $data;
    }

    function taxonomy_text($option, $term_id, &$taxonomy_options) {
        if (!$this->request->isset_POST($option['id']))
            return;
        $data = htmlentities($this->request->POST($option['id']), ENT_QUOTES, 'UTF-8');
        $taxonomy_options[$term_id][$option['id']] = $data;
    }

    /** textarray */

    function post_textarray($option, &$post_options) {
        if (!$this->request->isset_POST($option['id']))
            return;

        $post_options[$option['id']] = $this->request->POST($option['id']);
    }

    function admin_textarray($option, $values, &$framework_options) {
        $option['id'] = rtrim($option['id'], '[]'); // to be sure

        if (!isset($values[$option['id']]))
            return;

        $framework_options[$option['id']] = $values[$option['id']];
    }

    function taxonomy_textarray($option, $term_id, &$taxonomy_options) {
        if (!$this->request->isset_POST($option['id']))
            return;

        $taxonomy_options[$term_id][$option['id']] = $this->request->POST($option['id']);
    }

    /** textarray (end) */

    /** multi_input */

    function post_multiple_input($option, &$post_options){
        $data = $this->request->isset_POST($option['id']) ? $this->request->POST($option['id']) : false;
        $post_options[$option['id']] = (array)$data;
    }

    function admin_multiple_input($option, $values, &$framework_options){
        $data = isset($values[$option['id']]) ? $values[$option['id']] : false;
        $framework_options[$option['id']] = (array)$data;
    }

    function taxonomy_multiple_input($option, $term_id, &$taxonomy_options) {
        $data = $this->request->isset_POST($option['id']) ? $this->request->POST($option['id']) : false;
        $taxonomy_options[$term_id][$option['id']] = (array)$data;
    }

    /** multi_input (end) */

    /** multi_upload2 */

    function post_multi_upload2($option, &$post_options) {
        if (!$this->request->isset_POST($option['id']))
            return;

        $value = json_decode($this->request->POST($option['id']));
        if ($value === null)
            $value = array();

        foreach ($value as $key => $val)
            $value[$key] = (array)$val;

        $post_options[$option['id']] = $value;
    }

    function admin_multi_upload2($option, $values, &$framework_options) {
        if (!isset($values[$option['id']]))
            return;

        $value = json_decode($values[$option['id']]);
        if ($value === null)
            $value = array();

        foreach ($value as $key => $val)
            $value[$key] = (array)$val;

        $framework_options[$option['id']] = $value;
    }

    function taxonomy_multi_upload2($option, $term_id, &$taxonomy_options) {
        if (!$this->request->isset_POST($option['id']))
            return;

        $value = json_decode($this->request->POST($option['id']));
        if ($value === null)
            $value = array();

        foreach ($value as $key => $val)
            $value[$key] = (array)$val;

        $taxonomy_options[$term_id][$option['id']] = $value;
    }

    /** multi_upload2 (end) */

    function post_checkbox($option, &$post_options) {
        $data = $this->request->isset_POST($option['id']) ? $this->request->POST($option['id']) : 'false';
        $post_options[$option['id']] = $data;
    }

    function admin_checkbox($option, $values, &$framework_options) {
        $data = isset($values[$option['id']]) ? $values[$option['id']] : 'false';
        $framework_options[$option['id']] = $data;
    }

    function taxonomy_checkbox($option, $term_id, &$taxonomy_options) {
        $data = $this->request->isset_POST($option['id']) ? $this->request->POST($option['id']) : 'false';
        $taxonomy_options[$term_id][$option['id']] = $data;
    }

    function post_multi($option, &$post_options) {
        $val = str_replace(' ', '', $this->request->POST($option['id']));
        $post_options[$option['id']] = $val;
    }

    function admin_multi($option, $values, &$framework_options) {
        $val = str_replace(' ', '', $values[$option['id']]);
        $framework_options[$option['id']] = $val;
    }

    function taxonomy_multi($option, $term_id, &$taxonomy_options) {
        $val = str_replace(' ', '', $this->request->POST($option['id']));
        $taxonomy_options[$term_id][$option['id']] = $val;
    }

    function admin_boxes($option, $values, &$framework_options) {
        $framework_options[$option['id']]['count'] = $option['count'];

        for ($k = 1; $k <= $option['count']; $k++) {
            $id_page = $option['id'] . $k . '_page';
            $id_post = $option['id'] . $k . '_post';
            $id_box = $option['id'] . $k;

            if (isset($values[$id_box]))
                $framework_options[$option['id']][$id_box] = $values[$id_box];
            if (isset($values[$id_page]) && $values[$id_page] != '')
                $framework_options[$option['id']][$id_page] = str_replace(' ', '', $values[$id_page]);
            if (isset($values[$id_post]) && $values[$id_post] != '')
                $framework_options[$option['id']][$id_post] = str_replace(' ', '', $values[$id_post]);
        }
    }

    function admin_div_table($option, $values, &$framework_options){
        $data = isset($values[$option['id']]) ? (array)json_decode($values[$option['id']]) : false;

        if(!empty($data)){
            $i=0;
            foreach($data as $key=>$val){
                $val=(array)$val;
                foreach($val as $k=>$v)
                    $temp[$k][$key]=$v;
                $i++;
            }
            $framework_options[$option['id']] = (array)$temp;
        }
    }

    function admin_table($option, $values, &$framework_options){
        $data = isset($values[$option['id']]) ? (array)json_decode($values[$option['id']]) : false;

        if(!empty($data)){
            $i=0;
            foreach($data as $key=>$val){
                $val=(array)$val;
                foreach($val as $k=>$v)
                    $temp[$k][$key]=$v;
                $i++;
            }
            $framework_options[$option['id']] = (array)$temp;
        }
    }

    function post_div_table($option, &$post_options){
        $data = $this->request->isset_POST($option['id']) ? (array)json_decode($this->request->POST($option['id'])) : false;

        if(!empty($data)){
            $i=0;
            foreach($data as $key=>$val){
                $val=(array)$val;
                foreach($val as $k=>$v)
                    $temp[$k][$key]=$v;
                $i++;
            }
            $post_options[$option['id']] = (array)$temp;
        }
    }

    function post_table($option, &$post_options){
        $data = $this->request->isset_POST($option['id']) ? (array)json_decode($this->request->POST($option['id'])) : false;

        if(!empty($data)){

            foreach($data as $key=>$val){
                $val=(array)$val;
                foreach($val as $k=>$v)
                    $temp[$k][$key]=$v;
                
            }
            $post_options[$option['id']] = (array)$temp;
        }
    }

    function admin_typography($option, $values, &$framework_options) {
        $option['id'] = rtrim($option['id'], '[]'); // to be sure

        if (!isset($values[$option['id']]))
            return;

        $framework_options[$option['id']] = array(
            'size'      => $values[$option['id']][0],
            'unit'      => $values[$option['id']][1],
            'face'      => $values[$option['id']][2],
            'style'     => $values[$option['id']][3],
            'color'     => $values[$option['id']][4],
        );
    }


    public function has_method($method) {
        if (method_exists($this, $method))
            return true;
        else
            return false;
    }

}