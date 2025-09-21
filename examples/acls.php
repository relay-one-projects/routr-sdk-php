<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Routr\SDK\Routr;

$sdk = Routr::create();

try {
    $acls = $sdk->acls();

    // Create
    $created = $acls->create([
        'name' => 'Example ACL',
        'allow' => ['192.168.1.0/24'],
        'deny' => []
    ]);
    echo 'Created ACL: ' . json_encode($created, JSON_UNESCAPED_SLASHES) . PHP_EOL;

    $ref = $created['ref'] ?? null;

    // Get
    if ($ref) {
        $fetched = $acls->get($ref);
        echo 'Fetched ACL: ' . json_encode($fetched, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Update
    if ($ref) {
        $updated = $acls->update([
            'ref' => $ref,
            'name' => 'Example ACL Updated',
            'allow' => ['192.168.1.0/24', '10.0.0.0/8'],
            'deny' => []
        ]);
        echo 'Updated ACL: ' . json_encode($updated, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // List with pagination (if supported)
    $page = $acls->list(['page_size' => 5]);
    echo 'ACL Page 1: ' . json_encode($page, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    if (!empty($page['next_page_token'])) {
        $page2 = $acls->list([
            'page_size' => 5,
            'page_token' => $page['next_page_token']
        ]);
        echo 'ACL Page 2: ' . json_encode($page2, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Delete
    if ($ref) {
        $acls->delete($ref);
        echo 'Deleted ACL with ref: ' . $ref . PHP_EOL;
    }
} catch (\Throwable $e) {
    fwrite(STDERR, 'Error: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}
