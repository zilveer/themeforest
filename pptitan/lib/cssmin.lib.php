<?php
 
    class CSSMin {
        private $original_css;
        private $compressed_css;
        private $files;
 
        /* Constructor for CSSMin class */
        public function __construct() {
            $this->original_css = "";
            $this->compressed_css = "";
            $this->files = array();
        }
 
        /* Add file as string (path and filename) */
        public function addFile($file = null) {
            if ($file != null && $file != "" && 
                substr(strrchr($file, '.'), 1) == "css" && is_file($file)) {
                $this->files[] = $file;
                return true;
            }
            else {
                return false;
            }
        }
 
        /* Add multiple files array */
        public function addFiles($files = null) {
            if ($files != null && is_array($files)) {
                $ok = true;
                foreach ($files as $file) {
                    $ok = $this->addFile($file);
                }
                return $ok;
            }
            else {
                return false;
            }
        }
 
        /* Print original css files concatenated */
        public function printOriginalCSS($header = false) {
            if ($header) {
                header('Content-type: text/css');
            }
            return $this->original_css;
        }
 
        /* Print compressed css files concatenated */
        public function printCompressedCSS($header = false) {
            if ($header) {
                header('Content-type: text/css');
            }
            return $this->compressed_css;
        }
 
        /* Sets original css loop thru all added files */
        public function setOriginalCSS() {
            foreach ($this->files as $file) {
                $fh = fopen($file, 'r');
                $this->original_css .= fread($fh, filesize($file));
                fclose($fh);
            }
        }
 
        /* Make simple compression with regexp. */
        public function compressCSS() {
            $patterns = array();
            $replacements = array();
 
            /* remove multiline comments */
            $patterns[] = '/\/\*.*?\*\//s';
            $replacements[] = '';
 
            /* remove tabs, spaces, newlines, etc. */
            $patterns[] = '/\r\n|\r|\n|\t|\s\s+/';
            $replacements[] = '';
 
            /* remove whitespace on both sides of colons :*/
            $patterns[] = '/\s?\:\s?/';
            $replacements[] = ':';
 
            /* remove whitespace on both sides of curly brackets {} */
            $patterns[] = '/\s?\{\s?/';
            $replacements[] = '{';
            $patterns[] = '/\s?\}\s?/';
            $replacements[] = '}';
 
            /* remove whitespace on both sides of commas , */
            $patterns[] = '/\s?\,\s?/';
            $replacements[] = ',';
 
            /* compress */
            $this->compressed_css = preg_replace($patterns, $replacements, $this->original_css);
        }
    }
?>