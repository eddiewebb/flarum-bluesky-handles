<?php

namespace Webbinaro\BlueskyHandles;

use Flarum\Api\AbstractSerializeController;
use Flarum\User\UserRepository;

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
    
    protected function data(Request $request, Document $document)
    {
        $slug = Arr::get($request->getQueryParams(), 'slug');
        $user = $this->users->findOrFailByUsername($slug);
        return $user;
    }
}