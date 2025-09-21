<?php

declare(strict_types=1);

namespace Routr\SDK\Resources;

use Fonoster\Routr\Connect\Acl\V2beta1\ACLServiceClient;
use Fonoster\Routr\Connect\Acl\V2beta1\CreateACLRequest;
use Fonoster\Routr\Connect\Acl\V2beta1\UpdateACLRequest;
use Fonoster\Routr\Connect\Acl\V2beta1\GetACLRequest;
use Fonoster\Routr\Connect\Acl\V2beta1\DeleteACLRequest;
use Fonoster\Routr\Connect\Acl\V2beta1\ListACLsRequest;
use Routr\SDK\Transport\TransportInterface;
use Routr\SDK\Util\Proto;
use RuntimeException;

class Acls
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
     * Create a new ACL.
     *
     * @param array<string,mixed> $data The ACL data.
     *
     * @return array<string,mixed> The created ACL data.
     * @throws RuntimeException When the gRPC request fails.
     */
    public function create(array $data): array
    {
        $request = new CreateACLRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(ACLServiceClient::class, 'Create', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Update an existing ACL.
     *
     * @param array<string,mixed> $data The ACL data to update.
     *
     * @return array<string,mixed> The updated ACL data.
     * @throws RuntimeException When the gRPC request fails.
     */
    public function update(array $data): array
    {
        $request = new UpdateACLRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(ACLServiceClient::class, 'Update', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Get an ACL by reference.
     *
     * @param string $ref The ACL reference.
     *
     * @return array<string,mixed> The ACL data.
     * @throws RuntimeException When the gRPC request fails.
     */
    public function get(string $ref): array
    {
        $request = new GetACLRequest();
        $request->setRef($ref);
        [$resp, $status] = $this->transport->call(ACLServiceClient::class, 'Get', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Delete an ACL by reference.
     *
     * @param string $ref The ACL reference.
     *
     * @throws RuntimeException When the gRPC request fails.
     */
    public function delete(string $ref): void
    {
        $request = new DeleteACLRequest();
        $request->setRef($ref);
        [, $status] = $this->transport->call(ACLServiceClient::class, 'Delete', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
    }

    /**
     * List ACLs with pagination.
     *
     * @param array{page_size?:int,page_token?:string} $options Pagination options.
     *
     * @return array{items: array<int,array<string,mixed>>, next_page_token?: string|null} The list of ACLs.
     * @throws RuntimeException When the gRPC request fails.
     */
    public function list(array $options = []): array
    {
        $request = new ListACLsRequest();
        if (isset($options['page_size'])) {
            $request->setPageSize((int)$options['page_size']);
        }
        if (isset($options['page_token'])) {
            $request->setPageToken((string)$options['page_token']);
        }
        [$resp, $status] = $this->transport->call(ACLServiceClient::class, 'List', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        $items = [];
        foreach ($resp->getItems() as $item) {
            $items[] = Proto::toArray($item);
        }
        $next = method_exists($resp, 'getNextPageToken') ? $resp->getNextPageToken() : null;
        return ['items' => $items, 'next_page_token' => $next !== '' ? $next : null];
    }
}
