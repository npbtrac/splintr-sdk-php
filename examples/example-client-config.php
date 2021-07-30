<?php

require_once 'vendor/autoload.php';

/**
 * "store_secret": "9332B5CF-5937-4C4F-AEC8-FAB5BE0D7871",
 * "store_key": "865f5bafbf83f5efd97ff1922462c022",
 * "store_public_key": "9332B5CF-5B31-46A5-8B19-E2B96330FB10",
 */

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$dotenv->required(['SPLINTR_API_BASE_URL', 'SPLINTR_STORE_PUBLIC_KEY', 'SPLINTR_STORE_KEY', 'SPLINTR_STORE_SECRET']);
$dotenv->ifPresent('SPLINTR_DEBUG_MODE')->isBoolean();

$baseUrl = getenv('SPLINTR_API_BASE_URL', null);
$debugMode = !!getenv('SPLINTR_DEBUG_MODE', true);

$splintrClient = new \Splintr\PhpSdk\Core\Client(
    [
        'baseUrl' => $baseUrl,
        'storePublicKey' => getenv('SPLINTR_STORE_PUBLIC_KEY', null),
        'storeKey' => getenv('SPLINTR_STORE_KEY', null),
        'storeSecret' => getenv('SPLINTR_STORE_SECRET', null),
        'debugMode' => $debugMode,
    ]
);

return $splintrClient;
