# BlueSky Custom Handles

[![Latest Stable Version](https://img.shields.io/packagist/v/webbinaro/flarum-bluesky-handles.svg)](https://packagist.org/packages/webbinaro/flarum-bluesky-handles) [![Total Downloads](https://img.shields.io/packagist/dt/webbinaro/flarum-bluesky-handles.svg)](https://packagist.org/packages/webbinaro/flarum-bluesky-handles)

A [Flarum](http://flarum.org) extension. Enables your Flarum users to set their Bluesky handles to use a sub-domain of your site.  I.e. @username.example.com vs the default bluesky domain. 

![Bluesky user settings with verified custom domain](https://github.com/eddiewebb/flarum-bluesky-handles/blob/main/assets/blueskysettings.png)

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

![Example Masquerade Settings](https://github.com/eddiewebb/flarum-bluesky-handles/blob/main/assets/masqfieldsetup.png)

### User entry

Users can find their DID on their Bluesky Profile > Settings > Handle > Custom Handle

Users can enter it on Flarum > Profile > Edit Profile

![Example user entry](https://github.com/eddiewebb/flarum-bluesky-handles/blob/main/assets/userentry.png)

## Wildcard Domain Support - Handle requirements

Bluesky will try to resolve subdomains matching requested user handles.

I.e.  @eddie.adkadv.com will attempt to resolve https://eddie.adkadv.com

This means you will need to configure your webserver (nginx, apache) to convert these into requests on a specific API endpoint `/api/bluesky/<subdomain>`

1. Add wildcard to your DNS Settings as a new A and AAAA record
2. Update your webserver to route all subdomains to documented API.
3. Update your SSL Certificates to handle wildcard domains.


### Nginx Example

You can add a new server block to nginx to listen to wildcard domains, excluding known ones.

```
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    # listen for any subdomains EXCEPT gear.
    server_name ~^(?<slug>(?!other-suddomain-to-exclude)\w+)\.example\.com$;

    if ( $request_uri ~ ^/.well-known/atproto-did ) {
        # send atproto did verification requests to custom endpoint
        return $scheme://example.com/api/bluesky/$slug;
    }
    # send all other requests to subpath of user profile
    return $scheme://example.com/u/$slug$request_uri;
    
    

    # Requires SSL, so make sure you have a wildcard enabled cert
    # This DNS validation
    ssl_certificate /etc/letsencrypt/live/example.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/example.com/privkey.pem;
}

```

## Links

- [Packagist](https://packagist.org/packages/webbinaro/flarum-bluesky-handles)
- [GitHub](https://github.com/eddiewebb/flarum-bluesky-handles)
- [Discuss](https://discuss.flarum.org/d/36418-custom-bluesky-handles-for-domain-users)
