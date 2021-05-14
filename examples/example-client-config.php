<?php

require_once 'vendor/autoload.php';

/**
 * "store_secret": "9332B5CF-5937-4C4F-AEC8-FAB5BE0D7871",
 * "store_key": "865f5bafbf83f5efd97ff1922462c022",
 * "store_public_key": "9332B5CF-5B31-46A5-8B19-E2B96330FB10",
 */
$baseUrl = 'https://linked.splintr.xyz';
$appUrl = 'https://react.splintr.xyz';
$splintrClient = new \Splintr\PhpSdk\Core\Client(
    [
        'baseUrl' => $baseUrl,
        'appUrl' => $appUrl,
        'storePublicKey' => '9332B5CF-5B31-46A5-8B19-E2B96330FB10',
        'storeKey' => '865f5bafbf83f5efd97ff1922462c022',
        'storeSecret' => '9332B5CF-5937-4C4F-AEC8-FAB5BE0D7871',
        'debugMode' => true,
    ]
);

return $splintrClient;
