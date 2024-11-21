<?php

namespace Webbinaro\BlueskyHandles\Api\Serializer;

use Flarum\Api\Serializer\AbstractSerializer;
use Webbinaro\BlueskyHandles\BlueskyDid;
use InvalidArgumentException;

class BlueskyDidSerializer extends AbstractSerializer
{
    /**
     * {@inheritdoc}
     */
    protected $type = 'bluesky-dids';

    /**
     * {@inheritdoc}
     *
     * @param BlueskyDid $model
     * @throws InvalidArgumentException
     */
    protected function getDefaultAttributes($model)
    {
        if (! ($model instanceof BlueskyDid)) {
            throw new InvalidArgumentException(
                get_class($this).' can only serialize instances of '.BlueskyDid::class
            );
        }

        // See https://docs.flarum.org/extend/api.html#serializers for more information.

        return [
            // ...
        ];
    }
}
