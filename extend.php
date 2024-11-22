<?php

/*
 * This file is part of webbinaro/flarum-bluesky-handles.
 *
 * Copyright (c) 2024 Eddie Webbinaro.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Webbinaro\BlueskyHandles;

use Flarum\Extend;
use Webbinaro\BlueskyHandles\Controllers\BlueskyController;

return [
    (new Extend\Routes('api'))
        ->get('/bluesky/{slug}', 'bluesky.did', BlueskyController::class),

        (new Extend\ApiController(BlueskyController::class))
        ->addInclude('bioFields.field')
        ->addInclude('masqueradeAnswers'),
];
