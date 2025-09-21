<?php

declare(strict_types=1);

namespace Routr\SDK\Transport;

use Grpc\ChannelCredentials;

class GrpcTransport implements TransportInterface
{
    /**
     * The gRPC endpoint.
     *
     * @var string
     */
    private string $endpoint;

    /**
     * The gRPC options.
     *
     * @var array<string, mixed>
     */
    private array $options;

    /**
     * Constructor.
     *
     * @param  array<string, mixed> $config Configuration array with endpoint, insecure, and cacert options.
     * @throws \RuntimeException When the gRPC extension is not available.
     */
    public function __construct(array $config)
    {
        $this->endpoint = (string)($config['endpoint'] ?? 'localhost:51904');
        $this->options = [];

        $cc = ChannelCredentials::class;
        if (!class_exists($cc)) {
            throw new \RuntimeException('gRPC extension not available: Grpc\\ChannelCredentials class missing');
        }

        $credentials = !empty($config['insecure'])
            ? $cc::createInsecure()
            : (isset($config['cacert'])
                ? $cc::createSsl(file_get_contents((string)$config['cacert']) ?: null)
                : $cc::createSsl());

        $this->options['credentials'] = $credentials;
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
        $client = new $clientFqn($this->endpoint, $this->options);
        $callable = [$client, $method];
        $res = $callable($request);
        return $res->wait();
    }
}
