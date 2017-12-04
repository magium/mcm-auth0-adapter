<?php

namespace Magium\Auth0Factory;

use Auth0\SDK\Auth0;
use Magium\Configuration\Config\Repository\ConfigInterface;

class Auth0Factory
{

    const CONFIG_DOMAIN = 'authentication/auth0/domain';
    const CONFIG_CLIENT_ID = 'authentication/auth0/client_id';
    const CONFIG_CLIENT_SECRET = 'authentication/auth0/client_secret';
    const CONFIG_REDIRECT_URI = 'authentication/auth0/redirect_uri';
    const CONFIG_AUDIENCE = 'authentication/auth0/audience';
    const CONFIG_PERSIST_ID_TOKEN = 'authentication/auth0/persist_id_token';
    const CONFIG_PERSIST_ACCESS_TOKEN = 'authentication/auth0/persist_access_token';
    const CONFIG_PERSIST_REFRESH_TOKEN = 'authentication/auth0/persist_refresh_token';
    const CONFIG_SCOPE = 'authentication/auth0/scope';

    private $config;
    private static $self;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
        self::$self = $this;
    }

    public function factory()
    {
        $auth0 = new Auth0([
            'domain' => $this->config->getValue(self::CONFIG_DOMAIN),
            'client_id' => $this->config->getValue(self::CONFIG_CLIENT_ID),
            'client_secret' => $this->config->getValue(self::CONFIG_CLIENT_SECRET),
            'redirect_uri' => $this->config->getValue(self::CONFIG_REDIRECT_URI),
            'audience' => $this->config->getValue(self::CONFIG_AUDIENCE),
            'persist_id_token' => $this->config->getValueFlag(self::CONFIG_PERSIST_ID_TOKEN),
            'persist_access_token' => $this->config->getValueFlag(self::CONFIG_PERSIST_ACCESS_TOKEN),
            'persist_refresh_token' => $this->config->getValueFlag(self::CONFIG_PERSIST_REFRESH_TOKEN),
            'scope' => $this->config->getValueFlag(self::CONFIG_SCOPE),
        ]);
        return $auth0;
    }

    public static function staticFactory(ConfigInterface $config)
    {
        if (!self::$self instanceof self) {
            self::$self = new self($config);
        }
        return self::$self->factory();
    }


}
