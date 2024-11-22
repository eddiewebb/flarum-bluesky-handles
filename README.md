# BlueSky Custom Handles

![License](https://img.shields.io/badge/license-GPL-1.0-or-later-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/webbinaro/flarum-bluesky-handles.svg)](https://packagist.org/packages/webbinaro/flarum-bluesky-handles) [![Total Downloads](https://img.shields.io/packagist/dt/webbinaro/flarum-bluesky-handles.svg)](https://packagist.org/packages/webbinaro/flarum-bluesky-handles)

A [Flarum](http://flarum.org) extension. Enables your Flarum users to set their Bluesky handles to use a sub-domain of your site.  I.e. @username.example.com vs the default bluesky domain. 

## Installation

Install with composer:

```sh
composer require webbinaro/flarum-bluesky-handles:"*"
```

## Updating

```sh
composer update webbinaro/flarum-bluesky-handles:"*"
php flarum migrate
php flarum cache:clear
```

## Requires FOF/Masquerade

This extension depends on a custom bio field provided by FOF/Masquerade. Setting details below.

1. Create a new field, type `Advanced`
2. Set name as `Bluesky DID` or similar
3. Set validation rule as `regex:/^did:[a-z]+:[a-zA-Z0-9._:%-]*[a-zA-Z0-9._-]$/`
4. Set icon to `fas-brands fa-bluesky`

![Example Masquerade Settings](/assets/masqfieldsetup.png)

### User entry

Users can find their DID on their Bluesky Profile > Settings > Handle > Custom Handle

Users can enter it on Flarum > Profile > Edit Profile

![Example user entry](/assets/userentry.png)

## Links

- [Packagist](https://packagist.org/packages/webbinaro/flarum-bluesky-handles)
- [GitHub](https://github.com/webbinaro/flarum-bluesky-handles)
- [Discuss](https://discuss.flarum.org/d/PUT_DISCUSS_SLUG_HERE)
