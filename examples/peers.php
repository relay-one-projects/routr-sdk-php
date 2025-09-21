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
    $peers = $sdk->peers();

    // Create
    $created = $peers->create([
        'name' => 'Conference Server',
        'username' => 'conference',
        'aor' => 'sip:conference@company.local',
        'contact_addr' => '10.0.0.1:5060',
        'access_control_list_ref' => 'acl-ref-here',
        'credentials_ref' => 'credentials-ref-here',
        'balancing_algorithm' => 'LEAST_SESSIONS',
        'with_session_affinity' => true,
        'enabled' => true
    ]);
    echo 'Created Peer: ' . json_encode($created, JSON_UNESCAPED_SLASHES) . PHP_EOL;

    $ref = $created['ref'] ?? null;

    // Get
    if ($ref) {
        $fetched = $peers->get($ref);
        echo 'Fetched Peer: ' . json_encode($fetched, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Update
    if ($ref) {
        $updated = $peers->update([
            'ref' => $ref,
            'enabled' => false
        ]);
        echo 'Updated Peer: ' . json_encode($updated, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // List with pagination
    $page = $peers->list(['page_size' => 5]);
    echo 'Peers Page 1: ' . json_encode($page, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    if (!empty($page['next_page_token'])) {
        $page2 = $peers->list([
            'page_size' => 5,
            'page_token' => $page['next_page_token']
        ]);
        echo 'Peers Page 2: ' . json_encode($page2, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Delete
    if ($ref) {
        $peers->delete($ref);
        echo 'Deleted Peer with ref: ' . $ref . PHP_EOL;
    }
} catch (\Throwable $e) {
    fwrite(STDERR, 'Error: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}
