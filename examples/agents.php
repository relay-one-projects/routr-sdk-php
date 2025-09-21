<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Routr\SDK\Routr;

$sdk = Routr::create();

try {
    $agents = $sdk->agents();


    dump($sdk->domains()->list());
    dd($agents->list());


    // Create
    $created = $agents->create([
        'name' => 'John Doe',
        'username' => 'jdoe',
        'privacy' => 'PRIVATE',
        'domain_ref' => '1e097881-5a82-43c6-98ec-cdf99166b201',
        'credentials_ref' => 'credentials-ref-here',
        'enabled' => true,
        'max_contacts' => 5,
        'expires' => 3600
    ]);
    echo 'Created Agent: ' . json_encode($created, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES) . PHP_EOL;

    $ref = $created['ref'] ?? null;

    // Get
    if ($ref) {
        $fetched = $agents->get($ref);
        echo 'Fetched Agent: ' . json_encode($fetched, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Update
    if ($ref) {
        $updated = $agents->update([
            'ref' => $ref,
            'name' => 'John Doe Updated',
            'enabled' => false
        ]);
        echo 'Updated Agent: ' . json_encode($updated, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // List with pagination
    $page = $agents->list(['page_size' => 5]);
    echo 'Agents Page 1: ' . json_encode($page, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES) . PHP_EOL;
    if (!empty($page['next_page_token'])) {
        $page2 = $agents->list([
            'page_size' => 5,
            'page_token' => $page['next_page_token']
        ]);
        echo 'Agents Page 2: ' . json_encode($page2, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Find by username
    $found = $agents->findBy('username', 'jdoe');
    echo 'Found Agents by username: ' . json_encode($found, JSON_UNESCAPED_SLASHES) . PHP_EOL;

    // Delete
    if ($ref) {
        $agents->delete($ref);
        echo 'Deleted Agent with ref: ' . $ref . PHP_EOL;
    }
} catch (\Throwable $e) {
    fwrite(STDERR, 'Error: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}
