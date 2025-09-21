<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Routr\SDK\Routr;
use Routr\SDK\Transport\GrpcTransport;

$sdk = new Routr(new GrpcTransport([
    'endpoint' => 'localhost:51908',
    'insecure' => true,
]));

try {
    $trunks = $sdk->trunks();

    // Create
    $created = $trunks->create([
        'name' => 'SIP Provider Trunk',
        'inbound_uri' => 'sip:provider.example.com',
        'access_control_list_ref' => 'acl-ref-here',
        'inbound_credentials_ref' => 'credentials-ref-here',
        'outbound_credentials_ref' => 'credentials-ref-here',
        'uris' => [[
            'host' => 'provider.example.com',
            'port' => 5060,
            'transport' => 'udp',
            'user' => 'account123',
            'weight' => 1,
            'priority' => 1
        ]]
    ]);
    echo 'Created Trunk: ' . json_encode($created, JSON_UNESCAPED_SLASHES) . PHP_EOL;

    $ref = $created['ref'] ?? null;

    // Get
    if ($ref) {
        $fetched = $trunks->get($ref);
        echo 'Fetched Trunk: ' . json_encode($fetched, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Update
    if ($ref) {
        $updated = $trunks->update([
            'ref' => $ref,
            'name' => 'SIP Provider Trunk Updated'
        ]);
        echo 'Updated Trunk: ' . json_encode($updated, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // List with pagination
    $page = $trunks->list(['page_size' => 5]);
    echo 'Trunks Page 1: ' . json_encode($page, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    if (!empty($page['next_page_token'])) {
        $page2 = $trunks->list([
            'page_size' => 5,
            'page_token' => $page['next_page_token']
        ]);
        echo 'Trunks Page 2: ' . json_encode($page2, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Delete
    if ($ref) {
        $trunks->delete($ref);
        echo 'Deleted Trunk with ref: ' . $ref . PHP_EOL;
    }
} catch (\Throwable $e) {
    fwrite(STDERR, 'Error: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}
