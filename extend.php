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

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),
    new Extend\Locales(__DIR__.'/locale'),
    (new Extend\Routes('api'))
        ->get('/bluesky/{slug}', 'bluesky.did', Routes\BlueskyController::class),
];
