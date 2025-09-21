<?php

declare(strict_types=1);

namespace Routr\SDK\Resources;

use Fonoster\Routr\Connect\Agents\V2beta1\AgentsClient;
use Fonoster\Routr\Connect\Agents\V2beta1\CreateAgentRequest;
use Fonoster\Routr\Connect\Agents\V2beta1\UpdateAgentRequest;
use Fonoster\Routr\Connect\Agents\V2beta1\GetAgentRequest;
use Fonoster\Routr\Connect\Agents\V2beta1\DeleteAgentRequest;
use Fonoster\Routr\Connect\Agents\V2beta1\ListAgentsRequest;
use Fonoster\Routr\Connect\Agents\V2beta1\FindByRequest;
use Routr\SDK\Transport\TransportInterface;
use Routr\SDK\Util\Proto;

class Agents
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
     * Create a new agent.
     *
     * @param  array<string,mixed> $data The agent data.
     * @return array<string,mixed> The created agent data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function create(array $data): array
    {
        $request = new CreateAgentRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(AgentsClient::class, 'Create', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Update an existing agent.
     *
     * @param  array<string,mixed> $data The agent data to update.
     * @return array<string,mixed> The updated agent data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function update(array $data): array
    {
        $request = new UpdateAgentRequest();
        $request->mergeFromJsonString(json_encode($data, JSON_THROW_ON_ERROR), true);
        [$resp, $status] = $this->transport->call(AgentsClient::class, 'Update', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Get an agent by reference.
     *
     * @param  string $ref The agent reference.
     * @return array<string,mixed> The agent data.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function get(string $ref): array
    {
        $request = new GetAgentRequest();
        $request->setRef($ref);
        [$resp, $status] = $this->transport->call(AgentsClient::class, 'Get', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
        return Proto::toArray($resp);
    }

    /**
     * Delete an agent by reference.
     *
     * @param  string $ref The agent reference.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function delete(string $ref): void
    {
        $request = new DeleteAgentRequest();
        $request->setRef($ref);
        [, $status] = $this->transport->call(AgentsClient::class, 'Delete', $request);
        $code = (int)($status->code ?? -1);
        if ($code !== 0) {
            throw new \RuntimeException('gRPC request failed: ' . $status->details, $code);
        }
    }

    /**
     * List agents with pagination.
     *
     * @param  array{page_size?:int,page_token?:string} $options Pagination options.
     * @return array{items: array<int,array<string,mixed>>, next_page_token?: string|null} The list of agents.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function list(array $options = []): array
    {
        $request = new ListAgentsRequest();
        if (isset($options['page_size'])) {
            $request->setPageSize((int)$options['page_size']);
        }
        if (isset($options['page_token'])) {
            $request->setPageToken((string)$options['page_token']);
        }
        [$resp, $status] = $this->transport->call(AgentsClient::class, 'List', $request);
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
     * Find agents by field and value.
     *
     * @param  string $field The field name to search by.
     * @param  string $value The field value to search for.
     * @return array{items: array<int,array<string,mixed>>} The list of matching agents.
     * @throws \RuntimeException When the gRPC request fails.
     */
    public function findBy(string $field, string $value): array
    {
        $req = new FindByRequest();
        $req->setFieldName($field);
        $req->setFieldValue($value);
        [$resp, $status] = $this->transport->call(AgentsClient::class, 'FindBy', $req);
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
