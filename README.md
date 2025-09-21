# Routr  VoIP Proxy PHP SDK

## Overview

The Routr PHP SDK provides a robust, type-safe interface for managing SIP resources on the Routr SIP Proxy server via
gRPC. It supports full CRUD operations for Access Control Lists (ACLs), Agents, Credentials, Domains, Numbers, Peers,
and Trunks, making it ideal for automating VoIP configurations, integrating with telephony platforms, or building
real-time communication tools. Designed for PHP 8.1+, the SDK handles protocol buffer serialization, gRPC communication,
and error handling seamlessly.

The SDK relies on [Buf](https://buf.build/home) for generating the gRPC client code from Protocol Buffer definitions,
ensuring consistent and reliable schema-driven development.

## Features

- **Complete CRUD Operations**: Create, read, update, and delete all Routr resources.
- **Pagination and Search**: Efficient listing and field-based searching.
- **Type Safety**: Leverages PHP 8.1+ strict typing and enums.
- **gRPC Transport**: Secure, high-performance communication with Routr Connect.
- **Buf Integration**: Uses Buf CLI for worry-free gRPC client code generation.
- **Error Handling**: Detailed exceptions for validation and network issues.
- **Extensible**: Supports custom transports and integrations.
- **Tested**: Includes comprehensive PHPUnit test suite.

**Note**: RoadRunner transport is planned for future releases. Current support focuses on gRPC.

## Prerequisites

- PHP >= 8.1
- gRPC PHP extension (`ext-grpc`)
- Composer
- Routr Connect server (default: `localhost:51908`)
- [Buf CLI](https://buf.build/home) for generating gRPC client code
- Protocol Buffers compiler (`protoc`)

Install prerequisites:

```bash
# Install gRPC extension (Ubuntu/Debian)
sudo apt-get install php-grpc

# Or via PECL
pecl install grpc
docker-php-ext-enable grpc  # For Docker

# Install Buf CLI
curl -sSL https://github.com/bufbuild/buf/releases/latest/download/buf-Linux-x86_64 -o /usr/local/bin/buf
chmod +x /usr/local/bin/buf

# Install protoc (if not included with Buf)
sudo apt-get install protobuf-compiler
```

## Installation

Install via Composer:

```bash
composer require routr/sdk-php
```

For development:

```bash
composer require --dev phpunit/phpunit symfony/var-dumper
```

### Generating gRPC Client with Buf

The SDK uses Protocol Buffers for gRPC communication. To regenerate PHP client classes from `.proto` files, use the Buf
CLI as configured in `buf.gen.yaml`:

```bash
# Install Buf dependencies
buf mod update

# Generate PHP client code
buf generate
```

This uses the Buf CLI to generate PHP classes in `src/Grpc` based on the `.proto` files in the `proto/` directory. The
`buf.gen.yaml` specifies plugins for PHP and gRPC code generation, ensuring consistency and eliminating manual compiler
management. See [Buf Documentation](https://buf.build/docs/installation) for more details.

## Quick Start

### Initialize the SDK

```php
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Routr\SDK\Routr;
use Routr\SDK\Transport\GrpcTransport;

// Default initialization
$sdk = Routr::create();  // localhost:51908, insecure

// Custom configuration
$sdk = Routr::create(
    endpoint: 'routr.example.com:443',
    insecure: false,
    cacert: '/path/to/ca.crt'
);
```

**Authentication**: Use environment variables (`ROUTR_USERNAME`, `ROUTR_PASSWORD`) or extend `GrpcTransport` for custom
headers (e.g., tokens).

### Example: Managing ACLs

```php
try {
    $acls = $sdk->acls();

    // Create
    $acl = $acls->create([
        'name' => 'Office ACL',
        'allow' => ['192.168.1.0/24'],
        'deny' => ['10.0.0.0/8']
    ]);
    echo "Created ACL: {$acl['ref']}\n";

    // Get
    $fetched = $acls->get($acl['ref']);
    var_dump($fetched);

    // Update
    $updated = $acls->update([
        'ref' => $acl['ref'],
        'name' => 'Updated Office ACL',
        'allow' => ['192.168.1.0/24', '172.16.0.0/12']
    ]);

    // List
    $page = $acls->list(['page_size' => 10]);
    echo "Found " . count($page['items']) . " ACLs\n";

    // Delete
    $acls->delete($acl['ref']);
    echo "Deleted ACL\n";

} catch (\Throwable $e) {
    echo "Error: {$e->getMessage()}\n";
}
```

## Configuration

`GrpcTransport` options:

| Key        | Type   | Default           | Description                    |
|------------|--------|-------------------|--------------------------------|
| `endpoint` | string | `localhost:51908` | gRPC server host:port          |
| `insecure` | bool   | `false`           | Disable TLS (development only) |
| `cacert`   | string | `null`            | Path to CA certificate         |

Example with TLS:

```php
$sdk = Routr::create(
    endpoint: 'routr.example.com:443',
    insecure: false,
    cacert: '/path/to/ca.crt'
);
```

## Resource Management

Each resource class supports `create()`, `update()`, `get()`, `delete()`, `list()`, and (where applicable) `findBy()`.
Data is passed as arrays matching the protobuf schema defined in `proto/` files.

### ACLs (Access Control Lists)

Control IP access for SIP traffic.

```php
$acls = $sdk->acls();

// Create
$acl = $acls->create([
    'name' => 'Public ACL',
    'allow' => ['203.0.113.0/24'],
    'deny' => ['198.51.100.0/24']
]);

// Update
$acls->update([
    'ref' => $acl['ref'],
    'name' => 'Public ACL Updated',
    'allow' => ['203.0.113.0/24', '192.0.2.0/24']
]);

// Get
$aclData = $acls->get($acl['ref']);

// List
$list = $acls->list(['page_size' => 20]);

// Delete
$acls->delete($acl['ref']);
```

### Agents

Manage SIP user agents linked to domains and credentials.

```php
$agents = $sdk->agents();

// Create
$agent = $agents->create([
    'name' => 'Alice Smith',
    'username' => 'alice',
    'privacy' => 'PRIVATE',  // PRIVATE or NONE
    'domain_ref' => 'domain-uuid',
    'credentials_ref' => 'creds-uuid',
    'enabled' => true,
    'max_contacts' => 10,
    'expires' => 3600
]);

// Update
$agents->update([
    'ref' => $agent['ref'],
    'name' => 'Alice Smith Updated',
    'enabled' => false
]);

// Get
$agentData = $agents->get($agent['ref']);

// List
$list = $agents->list(['page_size' => 20]);

// Find by username
$found = $agents->findBy('username', 'alice');

// Delete
$agents->delete($agent['ref']);
```

### Credentials

Store authentication credentials.

```php
$creds = $sdk->credentials();

// Create
$cred = $creds->create([
    'name' => 'API User',
    'username' => 'apiuser',
    'password' => 'strongpass123'
]);

// Update
$creds->update([
    'ref' => $cred['ref'],
    'name' => 'API User Updated',
    'password' => 'newpass456'
]);

// Get
$credData = $creds->get($cred['ref']);

// List
$list = $creds->list(['page_size' => 20]);

// Delete
$creds->delete($cred['ref']);
```

### Domains

Manage SIP domains with egress policies.

```php
$domains = $sdk->domains();

// Create
$domain = $domains->create([
    'name' => 'Example Domain',
    'domain_uri' => 'sip:example.com',
    'access_control_list_ref' => 'acl-uuid',
    'egress_policies' => [
        [
            'rule' => '.*',
            'number_ref' => 'number-uuid'
        ]
    ]
]);

// Update
$domains->update([
    'ref' => $domain['ref'],
    'name' => 'Example Domain Updated'
]);

// Get
$domainData = $domains->get($domain['ref']);

// List
$list = $domains->list(['page_size' => 20]);

// Find by URI
$found = $domains->findBy('domain_uri', 'sip:example.com');

// Delete
$domains->delete($domain['ref']);
```

### Numbers

Manage phone numbers with trunk and AOR links.

```php
$numbers = $sdk->numbers();

// Create
$number = $numbers->create([
    'name' => 'Main Line',
    'tel_url' => 'tel:+15551234567',
    'aor_link' => 'sip:1001@example.com',
    'trunk_ref' => 'trunk-uuid',
    'city' => 'New York',
    'country' => 'USA',
    'country_iso_code' => 'US',
    'session_affinity_header' => 'X-Custom-ID',
    'extra_headers' => [
        ['name' => 'X-Custom', 'value' => 'value123']
    ]
]);

// Update
$numbers->update([
    'ref' => $number['ref'],
    'name' => 'Main Line Ext 100'
]);

// Get
$numberData = $numbers->get($number['ref']);

// List
$list = $numbers->list(['page_size' => 20]);

// Find by tel_url
$found = $numbers->findBy('tel_url', 'tel:+15551234567');

// Delete
$numbers->delete($number['ref']);
```

### Peers

Configure external SIP endpoints.

```php
$peers = $sdk->peers();

// Create
$peer = $peers->create([
    'name' => 'Gateway Peer',
    'username' => 'gateway',
    'aor' => 'sip:gateway@example.com',
    'contact_addr' => '203.0.113.1:5060',
    'balancing_algorithm' => 'LEAST_SESSIONS',  // UNSPECIFIED, ROUND_ROBIN, LEAST_SESSIONS
    'with_session_affinity' => true,
    'access_control_list_ref' => 'acl-uuid',
    'credentials_ref' => 'creds-uuid',
    'enabled' => true,
    'max_contacts' => 5,
    'expires' => 3600
]);

// Update
$peers->update([
    'ref' => $peer['ref'],
    'enabled' => false
]);

// Get
$peerData = $peers->get($peer['ref']);

// List
$list = $peers->list(['page_size' => 20]);

// Find by username
$found = $peers->findBy('username', 'gateway');

// Delete
$peers->delete($peer['ref']);
```

### Trunks

Manage SIP trunk connections.

```php
$trunks = $sdk->trunks();

// Create
$trunk = $trunks->create([
    'name' => 'Provider Trunk',
    'inbound_uri' => 'sip:provider.com',
    'access_control_list_ref' => 'acl-uuid',
    'inbound_credentials_ref' => 'creds-uuid',
    'outbound_credentials_ref' => 'creds-uuid',
    'uris' => [
        [
            'host' => 'provider.com',
            'port' => 5060,
            'transport' => 'udp',
            'user' => 'trunkuser',
            'weight' => 1,
            'priority' => 1
        ]
    ]
]);

// Update
$trunks->update([
    'ref' => $trunk['ref'],
    'name' => 'Provider Trunk Updated'
]);

// Get
$trunkData = $trunks->get($trunk['ref']);

// List
$list = $trunks->list(['page_size' => 20]);

// Find by inbound_uri
$found = $trunks->findBy('inbound_uri', 'sip:provider.com');

// Delete
$trunks->delete($trunk['ref']);
```

## Pagination and Searching

### Pagination

All `list()` methods support pagination:

```php
$allItems = [];
$token = null;
do {
    $page = $acls->list(['page_size' => 100, 'page_token' => $token]);
    $allItems = array_merge($allItems, $page['items']);
    $token = $page['next_page_token'];
} while ($token);
```

### Searching

`findBy()` is available for Agents, Domains, Numbers, Peers, and Trunks:

```php
$foundAgents = $agents->findBy('username', 'alice');  // Returns ['items' => [...]]
```

## Error Handling

Methods throw `\RuntimeException` for gRPC errors or `\JsonException` for serialization issues.

```php
try {
    $acls->create(['name' => 'Invalid']);  // Missing required fields
} catch (\RuntimeException $e) {
    switch ($e->getCode()) {
        case 3:  // INVALID_ARGUMENT
            echo "Validation error: {$e->getMessage()}\n";
            break;
        case 5:  // NOT_FOUND
            echo "Resource not found\n";
            break;
        default:
            echo "Error: {$e->getMessage()}\n";
    }
} catch (\Throwable $e) {
    echo "Unexpected error: {$e->getMessage()}\n";
}
```

Common gRPC codes:

- 3: INVALID_ARGUMENT
- 5: NOT_FOUND
- 13: INTERNAL

## Advanced Usage

### Complete SIP Setup

Create a full setup (ACL → Credentials → Domain → Agent):

```php
try {
    // Step 1: Create ACL
    $acl = $acls->create(['name' => 'Office', 'allow' => ['192.168.1.0/24']]);

    // Step 2: Create Credentials
    $cred = $creds->create(['name' => 'Office User', 'username' => 'user1', 'password' => 'pass123']);

    // Step 3: Create Domain
    $domain = $domains->create([
        'name' => 'Office Domain',
        'domain_uri' => 'sip:office.local',
        'access_control_list_ref' => $acl['ref']
    ]);

    // Step 4: Create Agent
    $agent = $agents->create([
        'name' => 'Office Agent',
        'username' => 'agent1',
        'privacy' => 'PRIVATE',
        'domain_ref' => $domain['ref'],
        'credentials_ref' => $cred['ref'],
        'enabled' => true
    ]);

} catch (\Throwable $e) {
    echo "Setup failed: {$e->getMessage()}\n";
}
```

### Dependency Management

Check for dependencies before deletion:

```php
try {
    $acls->delete($acl['ref']);
} catch (\RuntimeException $e) {
    if (strpos($e->getMessage(), 'dependencies') !== false) {
        $agents->delete($agent['ref']);
        $domains->delete($domain['ref']);
        $acls->delete($acl['ref']);
    }
}
```

### Framework Integration

In Laravel:

```php
// AppServiceProvider.php
public function register()
{
    $this->app->singleton(Routr::class, fn () => Routr::create(
        endpoint: config('routr.endpoint'),
        insecure: config('routr.insecure', true)
    ));
}
```

## Testing and Development

Run tests:

```bash
composer test  # Run PHPUnit
composer test-coverage  # Generate coverage report
```

Code quality:

```bash
composer cs-check  # PHPCS
composer cs-fix    # Auto-fix
composer stan      # PHPStan level 8
```

Docker setup:

```bash
docker-compose up --build
docker-compose exec routr-sdk-php composer test
```

### Regenerating Protobuf with Buf

If you modify `.proto` files or need to regenerate the gRPC client:

```bash
# Ensure Buf is installed
buf --version

# Update dependencies
buf mod update

# Generate PHP and gRPC code
buf generate
```

Buf ensures consistent code generation and manages plugin versions (e.g., `protocolbuffers/php` and `grpc/php`). The
configuration in `buf.gen.yaml` specifies output to `src/Grpc`. For advanced usage,
explore [Buf Schema Registry](https://buf.build/docs/bsr/introduction) for schema management across teams.

## Troubleshooting

- **Connection Issues**: Verify Routr endpoint/port and firewall settings.
- **gRPC Errors**: Ensure `ext-grpc` is installed; use `insecure => true` for testing.
- **Buf Errors**: Check Buf CLI installation and `buf.yaml` configuration.
- **Protobuf Issues**: Run `buf generate` to regenerate classes.
- **Auth Failures**: Verify `ROUTR_USERNAME`/`ROUTR_PASSWORD` or server config.

Enable debug logs:

```bash
export GRPC_VERBOSITY=DEBUG
export GRPC_TRACE=all
```

## Contributing

1. Fork [fonoster/routr](https://github.com/fonoster/routr).
2. Install: `composer install`.
3. Add tests in `tests/`.
4. Run `composer test` and `composer stan`.
5. Submit PR with clear description.

## License

MIT License. See [LICENSE](LICENSE).

## Support

- Docs: [routr.io/docs](https://routr.io/docs)
- Buf Docs: [buf.build/docs](https://buf.build/docs)
- Issues: [GitHub Issues](https://github.com/fonoster/routr/issues)
- Community: [Fonoster Discord](https://discord.gg/fonoster)

Explore `examples/` for more usage scenarios. Build powerful VoIP solutions with Routr and Buf!
