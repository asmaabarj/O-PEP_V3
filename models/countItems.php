<?php
class CountItems
{
    private $totalItems;

    public function __construct($totalItems)
    {
        $this->totalItems = $totalItems;
    }

    public function getTotalItems()
    {
        return $this->totalItems;
    }
}