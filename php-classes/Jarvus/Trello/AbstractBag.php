<?php

namespace Jarvus\Trello;

use ArrayIterator;
use BadMethodCallException;

abstract class AbstractBag implements \ArrayAccess, \IteratorAggregate
{
    public $data;

    protected $board;
    protected $idMap;

    public function __construct(array $data = [], Board $board = null)
    {
        $this->data = $data;
        $this->board = $board;

        $this->idMap = [];
        foreach ($this->data as &$datum) {
            $this->idMap[$datum['id']] = &$datum;
        }
    }

    public function idSorter($a, $b)
    {
        return strnatcasecmp($this->idMap[$a]['name'], $this->idMap[$b]['name']);
    }

    // IteratorAggregate interface
    public function getIterator()
    {
        return new ArrayIterator($this->idMap);
    }

    // ArrayAccess interface
    public function offsetExists($id)
    {
        return isset($this->idMap[$id]);
    }

    public function offsetGet($id)
    {
        return isset($this->idMap[$id]) ? $this->idMap[$id] : null;
    }

    public function offsetSet($id, $value)
    {
        throw new BadMethodCallException('bag does not support array set');
    }

    public function offsetUnset($offset)
    {
        throw new BadMethodCallException('bag does not support array unset');
    }
}