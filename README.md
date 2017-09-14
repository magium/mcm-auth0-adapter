# Auth0 Factory for the Magium Configuration Manager

This library provides an interface for the auth0/auth0-php library so you can use it with the [Magium Configuration Manager](https://magiumlib.com/components/configuration).  Often applications will have some kind of static configuration mechanism, such as XML files, JSON files, YAML files, or PHP files.  There's nothing necessarily wrong with that, but what it does is merge your deployment and configuration concerns.  The Magium Configuration Manager (MCM) breaks that dependency so you can manage configuration separately from your deployment.

## Setup

```
composer require magium/mcm-auth0-factory
```

Once it is installed you need to initialize the Magium Configuration Manager (MCM) for your project using the `magium-configuration` commnand.  You can find it in `vendor/bin/magium-configuration` or, if that doesn't work you can run `php vendor/magium/configuration-manager/bin/magium-configuration`.  For the purpose of this documentation we will simple call it `magium-configuration`.

## Configuration

First, list all the configuration keys so you can see what they are.

```
$ magium-configuration magium:configuration:list-keys
Valid configuration keys
authentication/auth0/enabled

authentication/auth0/domain

authentication/auth0/client_id

authentication/auth0/client_secret

authentication/auth0/redirect_uri

authentication/auth0/audience

authentication/auth0/persist_id_token (default: 1)

authentication/auth0/persist_access_token (default: 1)

authentication/auth0/persist_refresh_token (default: 1)
```

Then you need to set the settings:

```
$ magium-configuration set authentication/auth0/domain test-domain
Set authentication/auth0/domain to test-domain (context: default)
Don't forget to rebuild your configuration cache with magium:configuration:build

... and so on
```

Then you need to build the configuration:

```
$ magium-configuration build
Building context: default
Building context: production
Building context: development
```

## Usage

Next up, in your application code run something like this:

```
$factory = new \Magium\Configuration\MagiumConfigurationFactory();
$auth0Factory = new \Magium\Auth0Factory\Auth0Factory($factory->getConfiguration());

$auth0 = $auth0Factory->factory();

$user = $auth0->getUser();


```

You can try this in the [test/test.php](sample test script).
