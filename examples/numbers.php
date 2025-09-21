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
    $numbers = $sdk->numbers();

    // Create
    $created = $numbers->create([
        'name' => '(555) 123-4567',
        'tel_url' => 'tel:+15551234567',
        'aor_link' => 'sip:1001@company.local',
        'trunk_ref' => 'trunk-ref-here',
        'city' => 'New York',
        'country' => 'United States',
        'country_iso_code' => 'US'
    ]);
    echo 'Created Number: ' . json_encode($created, JSON_UNESCAPED_SLASHES) . PHP_EOL;

    $ref = $created['ref'] ?? null;

    // Get
    if ($ref) {
        $fetched = $numbers->get($ref);
        echo 'Fetched Number: ' . json_encode($fetched, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Update
    if ($ref) {
        $updated = $numbers->update([
            'ref' => $ref,
            'name' => '(555) 123-4567 ext. 200'
        ]);
        echo 'Updated Number: ' . json_encode($updated, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // List with pagination
    $page = $numbers->list(['page_size' => 5]);
    echo 'Numbers Page 1: ' . json_encode($page, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    if (!empty($page['next_page_token'])) {
        $page2 = $numbers->list([
            'page_size' => 5,
            'page_token' => $page['next_page_token']
        ]);
        echo 'Numbers Page 2: ' . json_encode($page2, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Delete
    if ($ref) {
        $numbers->delete($ref);
        echo 'Deleted Number with ref: ' . $ref . PHP_EOL;
    }
} catch (\Throwable $e) {
    fwrite(STDERR, 'Error: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}
