<?php

namespace Webbinaro\BlueskyHandles;

use Flarum\Api\AbstractSerializeController;
use Flarum\Api\Controller\AbstractShowController;
use Flarum\User\UserRepository;
use Flarum\Api\Serializer\UserSerializer;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use Illuminate\Support\Arr;

class BlueskyController extends AbstractShowController
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
    public $serializer = UserSerializer::class;
    
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $slug = Arr::get($request->getQueryParams(), 'slug');
        $user = $this->users->findOrFailByUsername($slug);
        return $user;
    }
}