/* global TrelloPowerUp */
TrelloPowerUp.initialize({
    'board-buttons': t => [
        {
            icon: window.ICON_COINS,
            text: 'Labels',
            condition: 'always',
            callback: t => t.board('id').then(board => t.popup({
                title: 'Field Totals by Label',
                url: `https://trello.jarv.us/trello/${board.id}/label-totals?key=${window.JARVUS_KEY}`,
                height: 400
            }))
        },
        {
            icon: window.ICON_COINS,
            text: 'Board',
            condition: 'always',
            callback: t => t.board('id').then(board => t.popup({
                title: 'Field Totals',
                url: `https://trello.jarv.us/trello/${board.id}/field-totals?key=${window.JARVUS_KEY}`,
                height: 200
            }))
        }
    ]
}, {
    appKey: window.TRELLO_APP_KEY,
    appName: 'Jarvus'
});
