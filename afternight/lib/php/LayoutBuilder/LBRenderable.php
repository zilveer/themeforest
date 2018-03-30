<?php
class LBRenderable{
    const MAX_COLS = 12;
    static $words = array( 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve'
    );
    public $columns;
    public $cols_used = 0;
    public $children = array();
    function __construct( $columns  ){
        $this -> columns = $columns;
    }
    function maybe_start_row(){
        if( 0 == $this -> cols_used ){
            echo '<div class="row">' . PHP_EOL;
            return true;
        }else{
            return false;
        }
    }
    function maybe_end_row(){
        if( self::MAX_COLS == $this -> cols_used ){
            echo '</div>' . PHP_EOL;
            $this -> cols_used = 0;
            return true;
        }else{
            return false;
        }
    }
    function render(){
        $column_class = self::$words[ $this -> columns ];
        echo <<<endhtml
            <div class="$column_class columns">
endhtml;
        echo PHP_EOL;
        foreach( $this -> children as $child ){
            $cols_requested = $child -> columns;
            if( $this -> cols_used + $cols_requested <= self::MAX_COLS ){
                $this -> maybe_start_row();
                $child -> render();
                $this -> cols_used += $cols_requested;
                $this -> maybe_end_row();
            }
        }
        echo '</div>' . PHP_EOL;
    }
}