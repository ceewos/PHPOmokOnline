<?php
require_once 'MoveStrategy.php';
require_once 'Board.php';
class Random extends MoveStrategy{
    function __construct($board)
    {
        parent::__construct($board);
    }
    function pickPlace()
    {
        $n = $this->board->size;
        $availableSpots = $this->freeSpace($n);
        $randomKey = array_rand($availableSpots); // picks a key in range of the array of available spots
        return $availableSpots[$randomKey]; // returns a random available spot

    }
    function freeSpace($n): array // makes an array of all the available spots
    {
        $availableSpots = array();
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($this->board->isEmpty($i, $j)) {
                    $availableSpots[] = array($i,$j) ;
                }
            }
        }
        return $availableSpots;
    }
}
