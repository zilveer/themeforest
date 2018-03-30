<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

/**
 * Description of GET_EMBED
 *
 */
class TF_GET_EMBED {

    public $type;
    public $after;
    public $before;
    public $id;

    function __construct() {
        $this->flash_markup = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="opaque" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="opaque"></embed></object>';
        $this->quicktime_markup = '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="false"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="false" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>';
        $this->iframe_markup = '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>';
        $this->inline_markup = '<div class="pp_inline clearfix">{content}</div>';
    }

    function id($id = '') {
        if ($id == '') {
            global $post;
            $this->id = $post->ID;
        } else {
            $this->id = $id;
        }
        return $this;
    }

    function width($width = '') {
        $this->width = $width;
        return $this;
    }

    function height($height = '') {
        $this->height = $height;
        return $this;
    }

    function source($source = '', $link = '') {
        if ($source != '') {
            if (empty($link))
                $this->link = tfuse_page_options($source, $source, $this->id);
            else
                $this->link = $link;

            if ($this->link != '') {

                $this->type = '';

                if (stripos($this->link, "iframe") !== false) {
                    $this->type = "iframe";
                } else if (preg_match('/vimeo\.com/i', $this->link)) {
                    $this->type = "vimeo";
                } else if (stripos($this->link, ".mov") !== false) {
                    $this->type = "quicktime";
                } else if (stripos($this->link, ".swf") !== false) {
                    $this->type = "flash";
                } else if (preg_match('/youtube\.com\/watch/i', $this->link)) {
                    $this->type = "youtube";
                } else if (substr($this->link, 0, 1) == "#") {
                    $this->type = "inline";
                } else if (stripos($this->link, 'object') != FALSE && stripos($this->link, 'param') != FALSE) {
                    $this->type = "object";
                }
            }
        }
        return $this;
    }

    function youtube() {
        if (preg_match('/youtube\.com\/(v\/|watch\?v=)([\w\-]+)/', $this->link, $match)) {
            $youtube_id = $match[2];
        }

        $movie = 'http://www.youtube.com/v/' . $youtube_id;

        $search = array("{width}", "{height}", "{path}");
        $replace = array($this->width, $this->height, $movie);

        $this->output = str_replace($search, $replace, $this->flash_markup);
        return $this;
    }

    function vimeo() {
        $movie = 'http://vimeo.com/moogaloop.swf?clip_id=' . str_replace('http://vimeo.com/', '', $this->link);

        $search = array("{width}", "{height}", "{path}");
        $replace = array($this->width, $this->height, $movie);

        $this->output = str_replace($search, $replace, $this->flash_markup);
        return $this;
    }

    function quicktime() {
        $this->height += 15;

        $search = array("{width}", "{height}", "{path}");
        $replace = array($this->width, $this->height, $this->link);

        $this->output = str_replace($search, $replace, $this->quicktime_markup);
        return $this;
    }

    function flash() {
        $flash_vars = substr($this->link, strpos($this->link, "flashvars") + 10, strlen($this->link));

        $filename = substr($this->link, 0, strpos($this->link, "?"));

        $search = array("{width}", "{height}", "{path}");
        $replace = array($this->width, $this->height, "$filename?$flash_vars");

        $this->output = str_replace($search, $replace, $this->flash_markup);
        return $this;
    }

    function iframe() {
        $frame_url = '';
        if (preg_match('/src="([^"]+)"/Uis', $this->link, $match))
            $frame_url = &$match[1];

        $search = array("{width}", "{height}", "{path}");
        $replace = array($this->width, $this->height, $frame_url);

        $this->output = str_replace($search, $replace, $this->iframe_markup);
        return $this;
    }

    function object() {
        $this->output = preg_replace('/(?<=width=)(["\'])?([0-9]+?)+?[^"\']*(["\'])?(?![^\s>])/s', '${1}' . $this->width . '${3}', $this->link);
        $this->output = preg_replace('/(?<=height=)(["\'])?([0-9]+?)+?[^"\']*(["\'])?(?![^\s>])/s', '${1}' . $this->height . '${3}', $this->output);
        return $this;
    }

    function before($before = '') {
        $this->before = $before;
        return $this;
    }

    function after($after = '') {
        $this->after = $after;
        return $this;
    }

    function get() {
        if (!isset($this->id))
            $this->id();
        if ($this->type == '')
            $this->output = '';
        else {
            $this->{$this->type}();
            $this->output = $this->before . $this->output . $this->after;
        }
        return $this->output;
    }

    function __get($name) {
        if (in_array($name, get_class_methods($this)))
            return $this->$name();
        else {
            echo __('Warning. Property is required' , 'tfuse') . ': ' . $name;
        }
    }

    function __toString() {
        return (string) $this->output;
    }

}