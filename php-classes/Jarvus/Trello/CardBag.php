<?php

namespace Jarvus\Trello;

class CardBag extends AbstractBag
{
    public function __construct(array $cards = [], Board $board = null)
    {
        parent::__construct($cards, $board);
    }

    public function sumNumberFields()
    {
        $totalsByField = [];

        foreach ($this->data as $card) {
            foreach ($card['customFieldItems'] as $customFieldItem) {
                if (!isset($customFieldItem['value']['number'])) {
                    # skip non-numeric custom fields
                    continue;
                }

                $totalsByField[$customFieldItem['idCustomField']] += $customFieldItem['value']['number'];
            }
        }

        return $totalsByField;
    }

    public function sumNumberFieldsByLabel()
    {
        $numbersByLabel = [];

        foreach ($this->data as $card) {
            foreach ($card['customFieldItems'] as $customFieldItem) {
                if (!isset($customFieldItem['value']['number'])) {
                    # skip non-numeric custom fields
                    continue;
                }

                foreach ($card['labels'] as $label) {
                    $numbersByLabel[$label['id']][$customFieldItem['idCustomField']] += $customFieldItem['value']['number'];
                }
            }
        }

        if ($this->board) {
            uksort($numbersByLabel, [$this->board->labels, 'idSorter']);
        }

        return $numbersByLabel;
    }
}