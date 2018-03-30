<?php

interface iBFIAdminOption {
    public function display();
    public function saveAsMeta($postID);
    public function saveAsOption();
    public function resetAsOption();
}

?>