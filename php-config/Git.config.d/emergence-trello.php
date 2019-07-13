<?php

Git::$repositories['emergence-trello'] = [
    'remote' => 'https://github.com/JarvusInnovations/emergence-trello.git',
    'originBranch' => 'master',
    'workingBranch' => 'master',
    'trees' => [
        'html-templates/designs/trello-embed.tpl',
        'html-templates/trello',
        'php-classes/Jarvus/Trello',
        'php-config/Jarvus/Trello',
        'php-config/Git.config.d/emergence-trello.php',
        'site-root/js/trello',
        'site-root/trello.php'
    ]
];
