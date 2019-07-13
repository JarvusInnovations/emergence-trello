<?php

namespace Jarvus\Trello;

class RequestHandler extends \RequestHandler
{
    public static $powerUpKey;

    public static function handleRequest()
    {
        if (empty($_GET['key']) || $_GET['key'] != static::$powerUpKey) {
            $GLOBALS['Session']->requireAccountLevel('Staff');
        }

        // get board details
        if (!$boardId = static::shiftPath()) {
            return static::throwInvalidRequestError('boardId must be next path component');
        }

        $board = new Board($boardId, [
            'cards' => [
                'fields' => 'idShort,name,labels',
                'customFieldItems' => true
            ]
        ]);

        // handle board sub-request
        switch (static::shiftPath()) {
            case '':
            case null:
                return static::handleOverviewRequest($board);
            case 'label-totals':
                return static::handleLabelTotalsRequest($board);
            case 'field-totals':
                return static::handleFieldTotalsRequest($board);
            default:
                return static::throwNotFoundError();
        }
    }

    public static function handleOverviewRequest(Board $board)
    {
        return static::respond('overview', [
            'board' => $board
        ]);
    }

    public static function handleLabelTotalsRequest(Board $board)
    {
        return static::respond('embeds/label-totals', [
            'board' => $board
        ]);
    }

    public static function handleFieldTotalsRequest(Board $board)
    {
        return static::respond('embeds/field-totals', [
            'board' => $board
        ]);
    }
}