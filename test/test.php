<?php

require_once __DIR__ . '/../vendor/autoload.php';

$factory = new \Magium\Configuration\MagiumConfigurationFactory();
$auth0Factory = new \Magium\Auth0Factory\Auth0Factory($factory->getConfiguration());

$auth0 = $auth0Factory->factory();

$user = $auth0->getUser();
