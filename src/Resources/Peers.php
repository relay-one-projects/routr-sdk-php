<?php

declare(strict_types=1);

namespace Routr\SDK\Resources;

use Fonoster\Routr\Connect\Peers\V2beta1\PeersClient;
use Fonoster\Routr\Connect\Peers\V2beta1\CreatePeerRequest;
use Fonoster\Routr\Connect\Peers\V2beta1\UpdatePeerRequest;
use Fonoster\Routr\Connect\Peers\V2beta1\GetPeerRequest;
use Fonoster\Routr\Connect\Peers\V2beta1\DeletePeerRequest;
use Fonoster\Routr\Connect\Peers\V2beta1\ListPeersRequest;
use Fonoster\Routr\Connect\Peers\V2beta1\FindByRequest;
use Routr\SDK\Transport\TransportInterface;
use Routr\SDK\Util\Proto;

class Peers
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
     * Create a new peer.
     *
     * @param  array<string,mixed> $data The peer data.
     * @return array<string,mixed> The created peer data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function create(array $data): array
    {
        $request = new CreatePeerRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(PeersClient::class, 'Create', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Update an existing peer.
     *
     * @param  array<string,mixed> $data The peer data to update.
     * @return array<string,mixed> The updated peer data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function update(array $data): array
    {
        $request = new UpdatePeerRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(PeersClient::class, 'Update', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Get a peer by reference.
     *
     * @param  string $ref The peer reference.
     * @return array<string,mixed> The peer data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function get(string $ref): array
    {
        $request = new GetPeerRequest();
        $request->setRef($ref);
        [$resp, $status] = $this->transport->call(PeersClient::class, 'Get', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Delete a peer by reference.
     *
     * @param  string $ref The peer reference.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function delete(string $ref): void
    {
        $request = new DeletePeerRequest();
        $request->setRef($ref);
        [, $status] = $this->transport->call(PeersClient::class, 'Delete', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
    }

    /**
     * List peers with pagination.
     *
     * @param  array{page_size?:int,page_token?:string} $options Pagination options.
     * @return array{items: array<int,array<string,mixed>>, next_page_token?: string|null} The list of peers.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function list(array $options = []): array
    {
        $request = new ListPeersRequest();
        if (isset($options['page_size'])) {
            $request->setPageSize((int)$options['page_size']);
        }
        if (isset($options['page_token'])) {
            $request->setPageToken((string)$options['page_token']);
        }
        [$resp, $status] = $this->transport->call(PeersClient::class, 'List', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        $items = [];
        foreach ($resp->getItems() as $item) {
            $items[] = Proto::toArray($item);
        }
        $next = method_exists($resp, 'getNextPageToken') ? $resp->getNextPageToken() : null;
        return ['items' => $items, 'next_page_token' => $next !== '' ? $next : null];
    }

    /**
     * Find peers by field and value.
     *
     * @param  string $field The field name to search by.
     * @param  string $value The field value to search for.
     * @return array{items: array<int,array<string,mixed>>} The list of matching peers.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function findBy(string $field, string $value): array
    {
        $req = new FindByRequest();
        if (method_exists($req, 'setFieldName')) {
            $req->setFieldName($field);
        } else {
            $req->setFieldName($field); // peers uses camelCase
        }
        if (method_exists($req, 'setFieldValue')) {
            $req->setFieldValue($value);
        } else {
            $req->setFieldValue($value);
        }
        [$resp, $status] = $this->transport->call(PeersClient::class, 'FindBy', $req);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        $items = [];
        foreach ($resp->getItems() as $item) {
            $items[] = Proto::toArray($item);
        }
        return ['items' => $items];
    }
}
