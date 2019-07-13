<?php

namespace Jarvus\Trello;

class Board
{
    public $id;

    protected $options;
    protected $data;
    protected $cards;
    protected $labels;
    protected $customFields;

    public function __construct($boardId, array $options = [], array $boardData = null)
    {
        $this->id = $boardId;
        $this->options = $options;
        $this->data = $boardData;
    }

    public function __get($property)
    {
        switch ($property) {
            case 'cards':
                return $this->getCards();
            case 'labels':
                return $this->getLabels();
            case 'customFields':
                return $this->getCustomFields();
            default:
                return $this->getData()[$property];
        }
    }

    public function __isset($property)
    {
        switch ($property) {
            case 'cards':
            case 'labels':
            case 'customFields':
                return true;
            default:
                return isset($this->getData()[$property]);
        }
    }

    public function getData()
    {
        if (!$this->data) {
            $this->data = API::request("/boards/{$this->id}");
        }

        return $this->data;
    }

    protected function getCards()
    {
        if (!$this->cards) {
            $data = API::request("/boards/{$this->id}/cards", [
                'get' => $this->options['cards']
            ]);

            $this->cards = new CardBag($data, $this);
        }

        return $this->cards;
    }

    protected function getLabels()
    {
        $data = API::request("/boards/{$this->id}/labels", [
            'get' => $this->options['labels']
        ]);

        return new LabelBag($data, $this);
    }

    protected function getCustomFields()
    {
        if (!$this->customFields) {
            $data = API::request("/boards/{$this->id}/customFields", [
                'get' => $this->options['customFields']
            ]);

            $this->customFields = new CustomFieldBag($data, $this);
        }

        return $this->customFields;
    }
}