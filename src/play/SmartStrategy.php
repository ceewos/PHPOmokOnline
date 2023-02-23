<?php
require_once 'MoveStrategy.php';
require_once 'Board.php';
class Smart extends MoveStrategy
{
    function __construct($board)
    {
        parent::__construct($board);
    }

    function pickPlace()
    {
        return $this->getNextMove();
    }

    function getNextMove($player = 2):array
    {
        $board = $this->board->board;
        $n = $this->board->size;
        $beginnerMove = array(); //beginner moves place 2 pieces in a row
        $okayMove = array(); //okay moves place 3 pieces in a row
        $goodMove = array(); //good moves place 4 pieces in a row
        $bestMove = array(); //best moves are moves that let you place 5 pieces in a row or stop player from placing 5 pieces RETURNED IMEDIATELY
        // Check if there are any "3 in a row" patterns and add a stone to complete the pattern
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($board[$i][$j] == 0) {
                    // Check horizontal
                    if ($j < $n - 2 && $board[$i][$j + 1] == $player) {
                        $beginnerMove[] = [$i,$j];
                    }
                    if ($j < $n - 2 && $board[$i][$j + 1] == $player && $board[$i][$j + 2] == $player) {
                        $okayMove[] = [$i,$j];
                    }
                    if ($j < $n - 3 && $board[$i][$j + 1] == $player && $board[$i][$j + 2] == $player && $board[$i][$j + 3] == $player) {
                        $goodMove[] = [$i,$j];
                    }
                    if ($j < $n - 4 && $board[$i][$j + 1] != 0 && $board[$i][$j + 2] == $board[$i][$j + 1] && $board[$i][$j + 3] == $board[$i][$j + 1] && $board[$i][$j + 4] == $board[$i][$j + 1]) {
                        $bestMove[] = [$i,$j];
                    }
                    //check vertical
                    if ($i < $n - 2 && $board[$i + 1][$j] == $player) {
                        $beginnerMove[] = [$i,$j];
                    }
                    if ($i < $n - 2 && $board[$i + 1][$j] == $player && $board[$i + 2][$j] == $player) {
                        $okayMove[] = [$i,$j];
                    }
                    if ($i < $n - 3 && $board[$i + 1][$j] == $player && $board[$i + 2][$j] == $player && $board[$i + 3][$j] == $player) {
                        $goodMove[] = [$i,$j];
                    }
                    if ($i < $n - 4 && $board[$i + 1][$j] != 0 && $board[$i + 2][$j] == $board[$i + 1][$j] && $board[$i + 3][$j] == $board[$i + 1][$j] && $board[$i + 4][$j] == $board[$i + 1][$j]) {
                        $bestMove[] = [$i,$j];
                    }
                    // Check diagonal left-right
                    if ($i < $n - 2 && $j < $n - 2 && $board[$i + 1][$j + 1] == $player) {
                        $beginnerMove[] = [$i,$j];
                    }
                    if ($i < $n - 2 && $j < $n - 2 && $board[$i + 1][$j + 1] == $player && $board[$i + 2][$j + 2] == $player) {
                        $okayMove[] = [$i,$j];
                    }
                    if ($i < $n - 3 && $j < $n - 3 && $board[$i + 1][$j + 1] == $player && $board[$i + 2][$j + 2] == $player && $board[$i + 3][$j + 3] == $player) {
                        $goodMove[] = [$i,$j];
                    }
                    if ($i < $n - 4 && $j < $n - 4 && $board[$i + 1][$j + 1] != 0 && $board[$i + 2][$j + 2] == $board[$i + 1][$j + 1] && $board[$i + 3][$j + 3] == $board[$i + 1][$j + 1] && $board[$i + 4][$j + 4] == $board[$i + 1][$j + 1]) {
                        $bestMove[] = [$i,$j];
                    }
                    // Check diagonal left-right
                    if ($i < $n - 2 && $j > 0 && $board[$i + 1][$j - 1] == $player) {
                        $beginnerMove[] = [$i,$j];
                    }
                    if ($i < $n - 2 && $j > 1 && $board[$i + 1][$j - 1] == $player && $board[$i + 2][$j - 2] == $player) {
                        $okayMove[] = [$i,$j];
                    }
                    if ($i < $n - 3 && $j > 2 && $board[$i + 1][$j - 1] == $player && $board[$i + 2][$j - 2] == $player && $board[$i + 3][$j - 3] == $player) {
                        $goodMove[] = [$i,$j];
                    }
                    if ($i < $n - 4 && $j > 3 && $board[$i + 1][$j - 1] != 0 && $board[$i + 2][$j - 2] == $board[$i + 1][$j - 1] && $board[$i + 3][$j - 3] == $board[$i + 1][$j - 1] && $board[$i + 4][$j - 4] == $board[$i + 1][$j - 1]) {
                        $bestMove[] = [$i,$j];
                    }
                }
            }
        }
        if (count($bestMove) > 0) {
            for($i = 0; $i < count($bestMove);$i++){
                if( $board[$bestMove[$i][0]][$bestMove[$i][1]] == $player){
                    return $bestMove[$i]; // if its a winning move for bot
                }
            }
            return $bestMove[0];//else stop user from his winning move

        //check if theres good values to return a random one  then check if theres okay values to return a random and so on
        }else if (count($goodMove) > 0) {
            $ranKey = array_rand($goodMove);
            return $goodMove[$ranKey];
        } else if (count($okayMove) > 0) {
            $ranKey = array_rand($okayMove);
            return $okayMove[$ranKey];
        } else if (count($beginnerMove) > 0) {
            $ranKey = array_rand($beginnerMove);
            return $beginnerMove[$ranKey];
        }

        // Robot hasn't placed first piece so place it now towards the middle
        $m = intdiv($n,2);
        if ($board[$m][$m] == 0) {
            return [$m, $m];//can be placed in the middle if user didnt
        }
        return [$m+1, $m+1];//else can be placed around the middle
    }
}
/*
$board = new Board();
$smart = new Smart($board);
$pickedSpot = $smart->pickPlace();
$board->placeStone(2,$pickedSpot[0],$pickedSpot[1]);
$pickedSpot = $smart->pickPlace();
$board->placeStone(2,$pickedSpot[0],$pickedSpot[1]);
$pickedSpot = $smart->pickPlace();
$board->placeStone(2,$pickedSpot[0],$pickedSpot[1]);
$pickedSpot = $smart->pickPlace();
$board->placeStone(2,$pickedSpot[0],$pickedSpot[1]);
$pickedSpot = $smart->pickPlace();
$board->placeStone(2,$pickedSpot[0],$pickedSpot[1]);
for($i = 0; $i < 15;$i++){
    for($j = 0; $j < 15 ;$j++){
        echo $board->board[$i][$j]," ";
    }
    echo nl2br(" \n");
}*/

