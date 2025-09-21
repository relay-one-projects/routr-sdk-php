<?php

declare(strict_types=1);

namespace Routr\SDK\Resources;

use Fonoster\Routr\Connect\Credentials\V2beta1\CredentialsServiceClient;
use Fonoster\Routr\Connect\Credentials\V2beta1\CreateCredentialsRequest;
use Fonoster\Routr\Connect\Credentials\V2beta1\UpdateCredentialsRequest;
use Fonoster\Routr\Connect\Credentials\V2beta1\GetCredentialsRequest;
use Fonoster\Routr\Connect\Credentials\V2beta1\DeleteCredentialsRequest;
use Fonoster\Routr\Connect\Credentials\V2beta1\ListCredentialsRequest;
use Routr\SDK\Transport\TransportInterface;
use Routr\SDK\Util\Proto;

class Credentials
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
     * Create new credentials.
     *
     * @param  array<string,mixed> $data The credentials data.
     * @return array<string,mixed> The created credentials data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function create(array $data): array
    {
        $request = new CreateCredentialsRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(CredentialsServiceClient::class, 'Create', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Update existing credentials.
     *
     * @param  array<string,mixed> $data The credentials data to update.
     * @return array<string,mixed> The updated credentials data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function update(array $data): array
    {
        $request = new UpdateCredentialsRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(CredentialsServiceClient::class, 'Update', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Get credentials by reference.
     *
     * @param  string $ref The credentials reference.
     * @return array<string,mixed> The credentials data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function get(string $ref): array
    {
        $request = new GetCredentialsRequest();
        $request->setRef($ref);
        [$resp, $status] = $this->transport->call(CredentialsServiceClient::class, 'Get', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Delete credentials by reference.
     *
     * @param  string $ref The credentials reference.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function delete(string $ref): void
    {
        $request = new DeleteCredentialsRequest();
        $request->setRef($ref);
        [, $status] = $this->transport->call(CredentialsServiceClient::class, 'Delete', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
    }

    /**
     * List credentials with pagination.
     *
     * @param  array{page_size?:int,page_token?:string} $options Pagination options.
     * @return array{items: array<int,array<string,mixed>>, next_page_token?: string|null} The list of credentials.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function list(array $options = []): array
    {
        $request = new ListCredentialsRequest();
        if (isset($options['page_size'])) {
            $request->setPageSize((int)$options['page_size']);
        }
        if (isset($options['page_token'])) {
            $request->setPageToken((string)$options['page_token']);
        }
        [$resp, $status] = $this->transport->call(CredentialsServiceClient::class, 'List', $request);
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
}
