<?php // index.php
define('STRATEGY', 'strategy'); // constant
$strategies = ["Smart", "Random"]; // supported strategies
$strategy = $_GET[STRATEGY];
$reason = true;
if(!in_array($strategy,$strategies)){
    $response = false;
    if(strlen($strategy) < 1){
        $reason = "No strategy entered";
    }else{
        $reason = "Strategy unknown";
    }
    $info = new GameError($response,$reason);
    echo json_encode($info);
    exit;
}
$id = uniqid();
$info = new GameID($reason,$id);


echo json_encode($info);
class GameError {
    public $response;
    public $reason;
    function __construct($response, $reason) {
        $this->response= $response;
        $this->reason = $reason;

    }
}
class GameID {
    public $response;
    public $id;
    function __construct($response, $id) {
        $this->response= $response;
        $this->id = $id;

    }
}



