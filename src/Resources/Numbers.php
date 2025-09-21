<?php

declare(strict_types=1);

namespace Routr\SDK\Resources;

use Fonoster\Routr\Connect\Numbers\V2beta1\NumbersClient;
use Fonoster\Routr\Connect\Numbers\V2beta1\CreateNumberRequest;
use Fonoster\Routr\Connect\Numbers\V2beta1\UpdateNumberRequest;
use Fonoster\Routr\Connect\Numbers\V2beta1\GetNumberRequest;
use Fonoster\Routr\Connect\Numbers\V2beta1\DeleteNumberRequest;
use Fonoster\Routr\Connect\Numbers\V2beta1\ListNumberRequest;
use Fonoster\Routr\Connect\Numbers\V2beta1\FindByRequest;
use Routr\SDK\Transport\TransportInterface;
use Routr\SDK\Util\Proto;

class Numbers
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
     * Create a new number.
     *
     * @param  array<string,mixed> $data The number data.
     * @return array<string,mixed> The created number data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function create(array $data): array
    {
        $request = new CreateNumberRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(NumbersClient::class, 'Create', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Update an existing number.
     *
     * @param  array<string,mixed> $data The number data to update.
     * @return array<string,mixed> The updated number data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function update(array $data): array
    {
        $request = new UpdateNumberRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(NumbersClient::class, 'Update', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Get a number by reference.
     *
     * @param  string $ref The number reference.
     * @return array<string,mixed> The number data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function get(string $ref): array
    {
        $request = new GetNumberRequest();
        $request->setRef($ref);
        [$resp, $status] = $this->transport->call(NumbersClient::class, 'Get', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Delete a number by reference.
     *
     * @param  string $ref The number reference.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function delete(string $ref): void
    {
        $request = new DeleteNumberRequest();
        $request->setRef($ref);
        [, $status] = $this->transport->call(NumbersClient::class, 'Delete', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
    }

    /**
     * List numbers with pagination.
     *
     * @param  array{page_size?:int,page_token?:string} $options Pagination options.
     * @return array{items: array<int,array<string,mixed>>, next_page_token?: string|null} The list of numbers.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function list(array $options = []): array
    {
        $request = new ListNumberRequest();
        if (isset($options['page_size'])) {
            $request->setPageSize((int)$options['page_size']);
        }
        if (isset($options['page_token'])) {
            $request->setPageToken((string)$options['page_token']);
        }
        [$resp, $status] = $this->transport->call(NumbersClient::class, 'List', $request);
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
     * Find numbers by field and value.
     *
     * @param  string $field The field name to search by.
     * @param  string $value The field value to search for.
     * @return array{items: array<int,array<string,mixed>>} The list of matching numbers.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function findBy(string $field, string $value): array
    {
        $req = new FindByRequest();
        $req->setFieldName($field);
        $req->setFieldValue($value);
        [$resp, $status] = $this->transport->call(NumbersClient::class, 'FindBy', $req);
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
