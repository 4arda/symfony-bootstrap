symfony-bootstrap
====

# Dependencies

 - StofDoctrineExtensionsBundle
 - FOS\RestBundle\FOSRestBundle
 - FOS\UserBundle\FOSUserBundle
 - FOS\OAuthServerBundle\FOSOAuthServerBundle
 - Nelmio\CorsBundle\NelmioCorsBundle
 - JavierEguiluz\Bundle\EasyAdminBundle\EasyAdminBundle
 - Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle
 - Knp\Bundle\MenuBundle\KnpMenuBundle

# Quickstart

- clone the depository
- composer install (give your database information in the wizzard)
- create an user with 'fos:user:create' commande
- promote your user with 'fos:user:promote' commande to the role ROLE_ADMIN to have admin access
- use server:start commande to run symfony build-in server
- browse the application en http://localhost:8000

# API

Url /api

Documentation available at /api/doc
Bundle ApiBundle

## Authentication

OAuth2 server with FOSOAuthServerBundle.

## Exceptions

If you want to throws specific business exception yu can use in your controller action

```
	throw $this->createException('no_access');
```

the 'no_access' exception is defined in ApiBundle/Resources/config/exceptions.yml

```
    exceptions:
        no_access:
            http_code: 401
            error_code: 401
            message: "You don't have access to this resource"
```

http_code: the Http status code
error_code: your business error code (interger mandatory)
message: A text message associated to the error

# Public website

Url /
Bundle PublicBundle

## Menu

The menu builder is in PublicBundle/Menu/Builder.php

# Admin

Url /admin

Auto generated with EasyAdminBundle

All configuration is /app/config/easyadmin.yml

# Logged user website

Url /app
Bundle AppBundle


## Menu

The menu builder is in AppBundle/Menu/Builder.php

# Tests

Codeception is integrated but you need to configure you test database in tests/api.suite.yml

To run web tests you need to have a running selenium server and firefox on your conputer.
You can also use phantomjs or phpwebdriver if you change tests/web.suite.yml.

# Api

You need to start your test with a $I->login('username', 'password').
The oauth client is automaticaly created during the login if you did'nt provide one.
Previously you need to create an user with commande line 'fos:user:create'.