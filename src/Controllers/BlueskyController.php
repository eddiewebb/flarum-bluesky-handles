<?php

namespace Webbinaro\BlueskyHandles\Controllers;

use Flarum\User\UserRepository;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;

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

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $slug = Arr::get($request->getQueryParams(), 'slug');
        $user = $this->users->findOrFailByUsername($slug);
        $answers = $user->getAttribute('masqueradeAnswers');
        foreach ($answers as $answer) {
            //there is probably a better way to jhandle this.
            if(str_starts_with($answer->content,"did:")) {
                return new HtmlResponse($answer->content);
            }
        }
        return new HtmlResponse('No identity provided',404);
    }
}