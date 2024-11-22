<?php

namespace Webbinaro\BlueskyHandles\Controllers;

use Flarum\Api\AbstractSerializeController;
use Flarum\Api\Controller\AbstractShowController;
use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\User\UserRepository;
use Flarum\Api\Serializer\UserSerializer;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BlueskyController implements RequestHandlerInterface
{    
    /**
    * @var UserRepository
    */
   protected $users;

   function __construct(UserRepository $users)
   {
       $this->users = $users;
   }
    //Todo: our own
    public $serializer = BasicUserSerializer::class;
    
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $slug = Arr::get($request->getQueryParams(), 'slug');
        $user = $this->users->findOrFailByUsername($slug);
        foreach ($user->included as $included) {
            if($included->type === 'masquerade-answer'
            && str_starts_with($included->attributes->content,"did:")) {
                return $included->attributes->content;
            }
        }
        return 404;
        //raw user 
        //{"data":{"type":"users","id":"1","attributes":{"username":"eddie","displayName":"eddie","avatarUrl":"http:\/\/localhost:8080\/assets\/avatars\/1565UsnUuI1oYHY4.png","slug":"eddie","followed":null,"followerCount":0,"followingCount":2,"fofTermsPoliciesState":{"1":{"accepted_at":"2020-07-02T17:46:24+00:00","has_update":false,"must_accept":false,"is_accepted":1},"2":{"accepted_at":"2020-07-02T17:46:25+00:00","has_update":false,"must_accept":false,"is_accepted":1}},"fofTermsPoliciesHasUpdate":false,"fofTermsPoliciesMustAccept":false,"joinTime":"2020-06-28T00:03:49+00:00"},"relationships":{"bioFields":{"data":[{"type":"masquerade-answer","id":"3"},{"type":"masquerade-answer","id":"4"},{"type":"masquerade-answer","id":"13"},{"type":"masquerade-answer","id":"29"},{"type":"masquerade-answer","id":"30"}]},"masqueradeAnswers":{"data":[{"type":"masquerade-answer","id":"3"},{"type":"masquerade-answer","id":"4"},{"type":"masquerade-answer","id":"13"},{"type":"masquerade-answer","id":"29"},{"type":"masquerade-answer","id":"30"},{"type":"masquerade-answer","id":"51"}]}}},"included":[{"type":"masquerade-answer","id":"3","attributes":{"user_id":1,"content":"Peru, NY","field":{"name":"Town","description":"Where from?","required":false,"validation":"string|min:4","prefix":"","icon":"fas fa-home","sort":1,"on_bio":true,"type":null,"deleted_at":null},"fieldId":2}},{"type":"masquerade-answer","id":"4","attributes":{"user_id":1,"content":"BMW G650 GS","field":{"name":"Riding","description":"What is your current motorcycle(s)?","required":true,"validation":"string|min:5","prefix":"","icon":"fas fa-motorcycle","sort":0,"on_bio":true,"type":null,"deleted_at":null},"fieldId":1}},{"type":"masquerade-answer","id":"13","attributes":{"user_id":1,"content":"https:\/\/a.rever.co\/users\/733167","field":{"name":"Rever profile link","description":"If you use Rever, you can add a link to your profile here","required":false,"validation":"url","prefix":"","icon":"fas fa-route","sort":2,"on_bio":true,"type":"url","deleted_at":null},"fieldId":3}},{"type":"masquerade-answer","id":"29","attributes":{"user_id":1,"content":"BMW MOA","field":{"name":"Other Memberships","description":"","required":false,"validation":"string|min:3","prefix":"","icon":"fa-crowd","sort":4,"on_bio":true,"type":null,"deleted_at":null},"fieldId":5}},{"type":"masquerade-answer","id":"30","attributes":{"user_id":1,"content":"0","field":{"name":"AMA Member","description":"","required":false,"validation":"boolean","prefix":"","icon":"fa-badge","sort":3,"on_bio":true,"type":"boolean","deleted_at":null},"fieldId":4}},{"type":"masquerade-answer","id":"51","attributes":{"user_id":1,"content":"did:plc:b6c7jq7o7dsfyt4y5s2mlzsl","fieldId":6}}]}
    }
}