<?php

class BFIAdminOptionNote extends BFIAdminOptionModel implements iBFIAdminOption {
    
    public function display() {
        echo "<div class='c'></div><div class='m {$this->getClass()} option_{$this->getType()}'><span class='t nb'>{$this->getName()}</span><div class='n'>{$this->getDesc()}</div></div>";
        return;
        ?>
        <tr valign="top" class="note <?php echo $this->getClass() ?>">
            <th scope="row" style="padding-bottom: 15px;">
                <?php echo $this->getName() ?>
            </th>
            <td style="padding-bottom: 15px;"><?php echo $this->getDesc() ?></td>
        </tr>
        <?php
    }
    
    public function saveAsMeta($postID) { }
    public function saveAsOption() { }
    public function resetAsOption() { }
}
