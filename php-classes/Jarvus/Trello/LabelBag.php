<?php

namespace Jarvus\Trello;

class LabelBag extends AbstractBag
{
    public function __construct(array $labels = [], Board $board = null)
    {
        parent::__construct($labels, $board);
    }
}
