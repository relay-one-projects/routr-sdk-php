<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Routr\SDK\Routr;
use Routr\SDK\Transport\GrpcTransport;

$sdk = Routr::create();

try {
    $domains = $sdk->domains();
    dd($domains->get('1e097881-5a82-43c6-98ec-cdf99166b201'));

    // Create
    $created = $domains->create([
        'name' => 'Company Domain',
        'domain_uri' => 'company.local',
//        'access_control_list_ref' => 'acl-ref-here',
//        'egress_policies' => [[
//            'rule' => '.*',
//            'number_ref' => 'number-ref-here'
//        ]]
    ]);
    echo 'Created Domain: ' . json_encode($created, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES) . PHP_EOL;

    $ref = $created['ref'] ?? null;

    dd('here');

    // Get
    if ($ref) {
        $fetched = $domains->get($ref);
        echo 'Fetched Domain: ' . json_encode($fetched, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Update
    if ($ref) {
        $updated = $domains->update([
            'ref' => $ref,
            'name' => 'Company Domain Updated'
        ]);
        echo 'Updated Domain: ' . json_encode($updated, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // List with pagination
    $page = $domains->list(['page_size' => 5]);
    echo 'Domains Page 1: ' . json_encode($page, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    if (!empty($page['next_page_token'])) {
        $page2 = $domains->list([
            'page_size' => 5,
            'page_token' => $page['next_page_token']
        ]);
        echo 'Domains Page 2: ' . json_encode($page2, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    }

    // Delete
    if ($ref) {
        $domains->delete($ref);
        echo 'Deleted Domain with ref: ' . $ref . PHP_EOL;
    }
} catch (\Throwable $e) {
    fwrite(STDERR, 'Error: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}
