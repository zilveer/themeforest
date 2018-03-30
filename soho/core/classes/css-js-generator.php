<?php
class cssJsGenerator
{
    public function __construct($filename, $filetype, $output)
    {
        $wp_upload_dir = wp_upload_dir();
        $this->filename = $filename;
        $this->uploadsdirectorypath = $wp_upload_dir['basedir'];
        $this->fullfilepath = $this->uploadsdirectorypath . "/" . $filename;
        $this->fullfileurl = $wp_upload_dir['baseurl'] . "/" . $this->filename;
        $this->filetype = $filetype;
        $this->output = $output;

        $this->checkFilenameWritable();
        if (gt3_get_theme_option($this->filename . "_request_recompile_file") == "yes" || gt3_get_theme_option($this->filename . "_request_recompile_file") == false) {
            $this->putDataIntoFile();
        }
    }

    public function requestFileRecompile()
    {
        gt3_update_theme_option($this->filename . "_request_recompile_file", "yes");
    }

    public function checkDirectoryWritable()
    {
        if (!is_writable($this->uploadsdirectorypath)) {
            globalJsMessage::getInstance()->add("Please set CHMOD 777 for " . $this->uploadsdirectorypath . " and click on Reset Settings or Save Settings in the Theme settings page.");
            return false;
        }
        return true;
    }

    public function putDataIntoFile()
    {
        if ($this->checkFilenameWritable()) {
            $handle = fopen($this->fullfilepath, 'w');
            fwrite($handle, str_replace(array("  ", "\n"), "", $this->output));
            gt3_update_theme_option($this->filename . "_request_recompile_file", "no");
        }
        return false;
    }

    public function checkFilenameWritable()
    {
        if (is_readable($this->fullfilepath)) {
            if (is_writable($this->fullfilepath)) {
                return true;
            } else {
                globalJsMessage::getInstance()->add("Please set CHMOD 777 for " . $this->fullfilepath . " and click on Reset Settings or Save Settings in the Theme settings page.");
                return false;
            }
        } else {
            if ($this->checkDirectoryWritable()) {
                $fp = fopen($this->fullfilepath, 'w');
                chmod($this->fullfilepath, 0777);
                $this->putDataIntoFile();
                return true;
            } else {
                return false;
            }
        }
    }
}

?>