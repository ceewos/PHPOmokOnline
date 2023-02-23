<?php // index.php
define('SIZE',15 );
$strategies = array('Smart' => 'SmartStrategy', 'Random'=> 'RandomStrategy');
$info = new GameInfo( SIZE, array_keys($strategies));
echo json_encode($info);
class GameInfo {
    public $size;
    public $strategies;
    function __construct($size, $strategies) {
        $this->size= $size;
        $this->strategies = $strategies;

    }
}

