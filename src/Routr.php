<?php

declare(strict_types=1);

namespace Routr\SDK;

use Routr\SDK\Transport\GrpcTransport;
use Routr\SDK\Transport\TransportInterface;
use Routr\SDK\Resources\Domains;
use Routr\SDK\Resources\Acls;
use Routr\SDK\Resources\Agents;
use Routr\SDK\Resources\Credentials;
use Routr\SDK\Resources\Numbers;
use Routr\SDK\Resources\Peers;
use Routr\SDK\Resources\Trunks;

class Routr
{
    private TransportInterface $transport;

    /**
     * Constructor.
     *
     * @param TransportInterface $transport The transport interface for making gRPC calls.
     */
    private function __construct(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    /**
     * Get the domains resource.
     *
     * @return Domains The domains resource instance.
     */
    public function domains(): Domains
    {
        return new Domains($this->transport);
    }

    /**
     * Get the ACLs resource.
     *
     * @return Acls The ACLs resource instance.
     */
    public function acls(): Acls
    {
        return new Acls($this->transport);
    }

    /**
     * Get the agents resource.
     *
     * @return Agents The agents resource instance.
     */
    public function agents(): Agents
    {
        return new Agents($this->transport);
    }

    /**
     * Get the credentials resource.
     *
     * @return Credentials The credentials resource instance.
     */
    public function credentials(): Credentials
    {
        return new Credentials($this->transport);
    }

    /**
     * Get the numbers resource.
     *
     * @return Numbers The numbers resource instance.
     */
    public function numbers(): Numbers
    {
        return new Numbers($this->transport);
    }

    /**
     * Get the peers resource.
     *
     * @return Peers The peers resource instance.
     */
    public function peers(): Peers
    {
        return new Peers($this->transport);
    }

    /**
     * Get the trunks resource.
     *
     * @return Trunks The trunks resource instance.
     */
    public function trunks(): Trunks
    {
        return new Trunks($this->transport);
    }

    /**
     * Create a new Routr client instance.
     *
     * @param  string      $endpoint The Routr server endpoint (e.g., 'localhost:51908').
     * @param  boolean     $insecure Whether to use an insecure connection (true) or secure connection (false).
     * @param  string|null $cacert   Path to CA certificate file for secure connection (e.g., '/path/to/cacert.pem').
     * @return self The Routr client instance.
     */
    public static function create(
        string $endpoint = 'localhost:51908',
        bool $insecure = true,
        ?string $cacert = null
    ) {
        return new self(new GrpcTransport([
            'endpoint' => $endpoint,
            'insecure' => $insecure,
            'cacert' => $cacert
        ]));
    }
}
