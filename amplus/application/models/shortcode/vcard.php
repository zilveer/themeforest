<?php

class BFIShortcodeVcardModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'vcard'; 
    
    public $width = '200';
    public $height = '200';
    public $is_link = true;
    public $last_name = '';
    public $first_name = '';
    public $prefix = '';
    public $suffix = '';
    public $full_name = '';
    public $job_title = '';
    public $org = '';
    public $photo_url = '';
    public $phone_home = '';
    public $phone_work = '';
    public $phone_mobile = '';
    public $work_street = '';
    public $work_city = '';
    public $work_region = '';
    public $work_zip = '';
    public $work_country = '';
    public $home_street = '';
    public $home_city = '';
    public $home_region = '';
    public $home_zip = '';
    public $home_country = '';
    public $email = '';
    public $url = '';
    public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $data = "BEGIN:VCARD\nVERSION:3.0\n";
        if ($this->last_name != "" || $this->first_name != "" || $this->prefix != "" || $this->suffix != "") {
            $data .= "N:$this->last_name;$this->first_name;;$this->prefix;;$this->suffix\n";
        } else if ($this->full_name != "") {
            $data .= "N:$this->full_name\n";
        }
        if ($this->full_name != "") {
            $data .= "FN:$this->full_name\n";
        }
        if ($this->job_title != "") {
            $data .= "TITLE:$this->job_title\n";
        }
        if ($this->org != "") {
            $data .= "ORG:$this->org\n";
        }
        if ($this->photo_url != "") {
            $data .= "PHOTO;VALUE=URL:$this->photo_url\n";
        }
        if ($this->phone_home != "") {
            $data .= "TEL;TYPE=HOME,VOICE:$this->phone_home\n";
        }
        if ($this->phone_work != "") {
            $data .= "TEL;TYPE=WORK,VOICE:$this->phone_work\n";
        }
        if ($this->phone_mobile != "") {
            $data .= "TEL;TYPE=CELL:$this->phone_mobile\n";
        }
        if ($this->home_street != "" || $this->home_city != "" || $this->home_region != "" || $this->home_zip != "" || $this->home_country != "") {
            $data .= "ADR;TYPE=HOME:;;$this->home_street;$this->home_city;$this->home_region;$this->home_zip;$this->home_country\n";
        }
        if ($this->work_street != "" || $this->work_city != "" || $this->work_region != "" || $this->work_zip != "" || $this->work_country != "") {
            $data .= "ADR;TYPE=HOME:;;$this->work_street;$this->work_city;$this->work_region;$this->work_zip;$this->work_country\n";
        }
        if ($this->email != "") {
            $data .= "EMAIL;TYPE=PREF,INTERNET:$this->email\n";
        }
        if ($this->url != "") {
            $data .= "URL:$this->url\n";
        }
        $data .= "END:VCARD";
        
        $data = urlencode($data);
        $img = "http://chart.apis.google.com/chart?cht=qr&chs={$this->width}x{$this->height}&chl=$data";
        $imgbig = "http://chart.apis.google.com/chart?cht=qr&chs=450x450&chl=$data&dummy=.jpg"; // dummy get variable for fancybox to detect an image
        
        if ($this->is_link) {
            return "<a href='$imgbig' class='fancybox qr $this->class' $unusedAttributeString><img src='$img' noshadow/></a>";
        } else {
            return "<img src='$img' $unusedAttributeString class='$this->class' noshadow/>";
        }
    }
}