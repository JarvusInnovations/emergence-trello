/* global TrelloPowerUp */
TrelloPowerUp.initialize({
    'board-buttons': t => [
        {
            // we can either provide a button that has a callback function
            // icon: {
            //   dark: 'https://jarv.us/img/glyph/j-logo.svg',
            //   light: 'https://jarv.us/img/glyph/j-logo.svg'
            // },
            text: 'Label Totals',
            condition: 'always',
            callback: t => t.board('id').then(board => t.popup({
                title: 'Field Totals by Label',
                url: `https://trello.jarv.us/trello/${board.id}/label-totals?key=${JARVUS_KEY}`,
                height: 400
            }))
        },
        {
            // we can either provide a button that has a callback function
            // icon: {
            //   dark: 'https://jarv.us/img/glyph/j-logo.svg',
            //   light: 'https://jarv.us/img/glyph/j-logo.svg'
            // },
            text: 'Board Totals',
            condition: 'always',
            callback: t => t.board('id').then(board => t.popup({
                title: 'Field Totals',
                url: `https://trello.jarv.us/trello/${board.id}/field-totals?key=${JARVUS_KEY}`,
                height: 200
            }))
        }
    ]
}, {
    appKey: TRELLO_APP_KEY,
    appName: 'Jarvus'
});
