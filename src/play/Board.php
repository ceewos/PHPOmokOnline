<?php
class Board
{
    var $size;
    var $board;

    function __construct($size = 15 )
    {
        $this -> size = $size;
        $array =  array(); // creating n*n array n = size
        for ($i = 0; $i < $size; $i++) {
            $array[$i] = array();
            for ($j = 0; $j < $size; $j++) {
                $array[$i][$j] = 0;
            }
        }
        $this-> board = $array;//setting array to board
    }

    function placeStone($player, $x, $y): void
    {
        $this->board[$x][$y] = $player;
    }
    function isEmpty($x, $y): bool
    {
        $n = $this -> size;
        if($x < $n and $x >= 0 and $y < $n and $y >= 0)
        {
            if($this->board[$x][$y] == 0){
                return true;
            }
        }
        return false;
    }

}

