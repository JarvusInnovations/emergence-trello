<?php

namespace Jarvus\Trello;

class ListBag extends AbstractBag
{
    public function __construct(array $lists = [], Board $board = null)
    {
        parent::__construct($lists, $board);
    }
}
