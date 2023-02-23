<?php
require_once 'Board.php';
abstract class MoveStrategy {
    protected $board;
    function __construct(Board $board = null) {
        $this->board = $board;
    }
    abstract function pickPlace();
    function toJson(): array
    {
        return array('name' => get_class($this));
    }
    static function fromJson(): static
    {
        $strategy = new static();
        return $strategy;
    }
}