<?php

namespace App\History;

class ColumnChange{
    public $column,$from,$to;
    /**
     * Undocumented function
     *
     * @param [type] $column
     * @param [type] $from
     * @param [type] $to
     */
    public function __construct($column,$from,$to)
    {
        $this->column = $column;
        $this->from = $from;
        $this->to = $to;
    }
}