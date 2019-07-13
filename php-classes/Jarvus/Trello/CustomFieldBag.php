<?php

namespace Jarvus\Trello;

class CustomFieldBag extends AbstractBag
{
    public function __construct(array $customFields = [], Board $board = null)
    {
        parent::__construct($customFields, $board);
    }
}
