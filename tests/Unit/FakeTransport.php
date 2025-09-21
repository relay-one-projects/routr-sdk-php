<?php

declare(strict_types=1);

namespace Routr\SDK\Tests\Unit;

use Routr\SDK\Transport\TransportInterface;

/**
 * A simple fake transport to be used in unit tests.
 */
class FakeTransport implements TransportInterface
{
    /**
     * Queue of responses to return.
     *
     * @var array<int, array{resp:mixed,status:object}>
     */
    private array $queue = [];

    /**
     * Record of all calls made.
     *
     * @var array<int, array{client:string,method:string,request:object}>
     */
    public array $calls = [];

    /**
     * Queue a response/status pair to be returned on next call.
     *
     * @param mixed   $response The response to return.
     * @param integer $code gRPC-like status code (0 = OK).
     * @param string  $details  Optional error details.
     */
    public function queue(mixed $response, int $code = 0, string $details = ''): void
    {
        $status = (object)['code' => $code, 'details' => $details];
        $this->queue[] = ['resp' => $response, 'status' => $status];
    }

    /**
     * Perform an RPC call.
     *
     * @param  class-string $clientFqn Fully-qualified generated client class.
     * @param  string       $method    RPC method name.
     * @param  mixed        $request   Protobuf request instance.
     * @return array{0: mixed, 1: object} [responseMessage, status].
     */
    public function call(string $clientFqn, string $method, mixed $request): array
    {
        $this->calls[] = ['client' => $clientFqn, 'method' => $method, 'request' => $request];
        if (count($this->queue) > 0) {
            $next = array_shift($this->queue);
            return [$next['resp'], $next['status']];
        }
        // Default OK status with null response
        return [null, (object)['code' => 0, 'details' => '']];
    }
}
