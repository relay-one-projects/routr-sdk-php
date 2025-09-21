<?php

declare(strict_types=1);

namespace Routr\SDK\Transport;

interface TransportInterface
{
    /**
     * Perform an RPC call.
     *
     * @param  class-string $clientFqn Fully-qualified generated client class.
     * @param  string       $method    RPC method name (e.g., 'Create', 'Get', 'List', 'Delete', 'Update').
     * @param  mixed        $request   Protobuf request instance.
     * @return array{0: mixed, 1: object} [responseMessage, status].
     */
    public function call(string $clientFqn, string $method, mixed $request): array;
}
