<?php
    class Move{
        var $x;
        var $y;
        var $tie;
        var $won;
        function __construct($x, $y, $tie, $won)
        {
            $this->x = $x;
            $this->y = $y;
            $this->tie = $tie;
            $won->won = $won;
        }
    }

