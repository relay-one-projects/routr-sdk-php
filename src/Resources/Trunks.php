<?php

declare(strict_types=1);

namespace Routr\SDK\Resources;

use Fonoster\Routr\Connect\Trunks\V2beta1\TrunksClient;
use Fonoster\Routr\Connect\Trunks\V2beta1\CreateTrunkRequest;
use Fonoster\Routr\Connect\Trunks\V2beta1\UpdateTrunkRequest;
use Fonoster\Routr\Connect\Trunks\V2beta1\GetTrunkRequest;
use Fonoster\Routr\Connect\Trunks\V2beta1\DeleteTrunkRequest;
use Fonoster\Routr\Connect\Trunks\V2beta1\ListTrunkRequest;
use Fonoster\Routr\Connect\Trunks\V2beta1\FindByRequest;
use Routr\SDK\Transport\TransportInterface;
use Routr\SDK\Util\Proto;

class Trunks
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
     * Create a new trunk.
     *
     * @param  array<string,mixed> $data The trunk data.
     * @return array<string,mixed> The created trunk data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function create(array $data): array
    {
        $request = new CreateTrunkRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(TrunksClient::class, 'Create', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Update an existing trunk.
     *
     * @param  array<string,mixed> $data The trunk data to update.
     * @return array<string,mixed> The updated trunk data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function update(array $data): array
    {
        $request = new UpdateTrunkRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(TrunksClient::class, 'Update', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Get a trunk by reference.
     *
     * @param  string $ref The trunk reference.
     * @return array<string,mixed> The trunk data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function get(string $ref): array
    {
        $request = new GetTrunkRequest();
        $request->setRef($ref);
        [$resp, $status] = $this->transport->call(TrunksClient::class, 'Get', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Delete a trunk by reference.
     *
     * @param  string $ref The trunk reference.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function delete(string $ref): void
    {
        $request = new DeleteTrunkRequest();
        $request->setRef($ref);
        [, $status] = $this->transport->call(TrunksClient::class, 'Delete', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
    }

    /**
     * List trunks with pagination.
     *
     * @param  array{page_size?:int,page_token?:string} $options Pagination options.
     * @return array{items: array<int,array<string,mixed>>, next_page_token?: string|null} The list of trunks.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function list(array $options = []): array
    {
        $request = new ListTrunkRequest();
        if (isset($options['page_size'])) {
            $request->setPageSize((int)$options['page_size']);
        }
        if (isset($options['page_token'])) {
            $request->setPageToken((string)$options['page_token']);
        }
        [$resp, $status] = $this->transport->call(TrunksClient::class, 'List', $request);
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
     * Find trunks by field and value.
     *
     * @param  string $field The field name to search by.
     * @param  string $value The field value to search for.
     * @return array{items: array<int,array<string,mixed>>} The list of matching trunks.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function findBy(string $field, string $value): array
    {
        $req = new FindByRequest();
        $req->setFieldName($field);
        $req->setFieldValue($value);
        [$resp, $status] = $this->transport->call(TrunksClient::class, 'FindBy', $req);
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
