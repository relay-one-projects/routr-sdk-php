<?php

declare(strict_types=1);

namespace Routr\SDK\Resources;

use Fonoster\Routr\Connect\Domains\V2beta1\DomainsClient;
use Fonoster\Routr\Connect\Domains\V2beta1\ListDomainRequest;
use Fonoster\Routr\Connect\Domains\V2beta1\CreateDomainRequest;
use Fonoster\Routr\Connect\Domains\V2beta1\UpdateDomainRequest;
use Fonoster\Routr\Connect\Domains\V2beta1\GetDomainRequest;
use Fonoster\Routr\Connect\Domains\V2beta1\DeleteDomainRequest;
use Routr\SDK\Transport\TransportInterface;
use Routr\SDK\Util\Proto;

class Domains
{
    /**
     * Constructor.
     *
     * @param TransportInterface $transport The transport interface for making gRPC calls.
     */
    public function __construct(private TransportInterface $transport)
    {
    }

    /**
     * Create a new domain.
     *
     * @param  array<string,mixed> $data The domain data.
     * @return array<string,mixed> The created domain data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function create(array $data): array
    {
        $request = new CreateDomainRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(DomainsClient::class, 'Create', $request);
        $statusCode = is_object($status) && property_exists($status, 'code') ? (int)$status->code : -1;
        if ($statusCode !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $statusCode);
        }
        return Proto::toArray($resp);
    }

    /**
     * Update an existing domain.
     *
     * @param  array<string,mixed> $data The domain data to update.
     * @return array<string,mixed> The updated domain data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function update(array $data): array
    {
        $request = new UpdateDomainRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(DomainsClient::class, 'Update', $request);
        $statusCode = is_object($status) && property_exists($status, 'code') ? (int)$status->code : -1;
        if ($statusCode !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $statusCode);
        }
        return Proto::toArray($resp);
    }

    /**
     * Get a domain by reference.
     *
     * @param  string $ref The domain reference.
     * @return array<string,mixed> The domain data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function get(string $ref): array
    {
        $request = new GetDomainRequest();
        $request->setRef($ref);
        [$resp, $status] = $this->transport->call(DomainsClient::class, 'Get', $request);
        $statusCode = is_object($status) && property_exists($status, 'code') ? (int)$status->code : -1;
        if ($statusCode !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $statusCode);
        }
        return Proto::toArray($resp);
    }

    /**
     * Delete a domain by reference.
     *
     * @param  string $ref The domain reference.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function delete(string $ref): void
    {
        $request = new DeleteDomainRequest();
        $request->setRef($ref);
        [, $status] = $this->transport->call(DomainsClient::class, 'Delete', $request);
        $statusCode = is_object($status) && property_exists($status, 'code') ? (int)$status->code : -1;
        if ($statusCode !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $statusCode);
        }
    }

    /**
     * List domains with pagination.
     *
     * @param  array{page_size?:int,page_token?:string} $options Pagination options.
     * @return array{items: array<int,array<string,mixed>>, next_page_token?: string|null} The list of domains.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function list(array $options = []): array
    {
        $request = new ListDomainRequest();
        if (isset($options['page_size'])) {
            $request->setPageSize((int)$options['page_size']);
        }
        if (isset($options['page_token'])) {
            $request->setPageToken((string)$options['page_token']);
        }

        [$resp, $status] = $this->transport->call(DomainsClient::class, 'List', $request);
        $statusCode = is_object($status) && property_exists($status, 'code') ? (int)$status->code : -1;
        if ($statusCode !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $statusCode);
        }

        $items = [];
        foreach ($resp->getItems() as $domain) {
            $items[] = Proto::toArray($domain);
        }

        $next = method_exists($resp, 'getNextPageToken') ? $resp->getNextPageToken() : null;
        return [
            'items' => $items,
            'next_page_token' => $next !== '' ? $next : null,
        ];
    }
}
