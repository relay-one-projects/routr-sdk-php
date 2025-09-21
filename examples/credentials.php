<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Routr\SDK\Routr;
use Routr\SDK\Transport\GrpcTransport;

$sdk = Routr::create();

try {
    $credentials = $sdk->credentials();

    // Create
    $created = $credentials->create([
        'name' => 'User Credentials',
        'username' => 'user123',
        'password' => 'secure_password'
    ]);
    echo 'Created Credentials: ' . json_encode($created, JSON_UNESCAPED_SLASHES) . PHP_EOL;

    $ref = $created['ref'] ?? null;

    dd($ref);

    // Get
    if ($ref) {
        $fetched = $credentials->get($ref);
        echo 'Fetched Credentials: ' . json_encode($fetched, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Update
    if ($ref) {
        $updated = $credentials->update([
            'ref' => $ref,
            'name' => 'User Credentials Updated'
        ]);
        echo 'Updated Credentials: ' . json_encode($updated, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // List with pagination
    $page = $credentials->list(['page_size' => 5]);
    echo 'Credentials Page 1: ' . json_encode($page, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    if (!empty($page['next_page_token'])) {
        $page2 = $credentials->list([
            'page_size' => 5,
            'page_token' => $page['next_page_token']
        ]);
        echo 'Credentials Page 2: ' . json_encode($page2, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Delete
    if ($ref) {
        $credentials->delete($ref);
        echo 'Deleted Credentials with ref: ' . $ref . PHP_EOL;
    }
} catch (\Throwable $e) {
    fwrite(STDERR, 'Error: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}
