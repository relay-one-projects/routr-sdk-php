<?php

declare(strict_types=1);

namespace Routr\SDK\Tests\Unit;

use Fonoster\Routr\Connect\Acl\V2beta1\ACLServiceClient;
use Fonoster\Routr\Connect\Acl\V2beta1\AccessControlList;
use Fonoster\Routr\Connect\Acl\V2beta1\ListACLsResponse;
use PHPUnit\Framework\TestCase;
use Routr\SDK\Resources\Acls;
use Routr\SDK\Util\Proto;
use RuntimeException;

class AclsTest extends TestCase
{
    /**
     * Test that create method calls transport and returns array.
     */
    public function testCreateCallsTransportAndReturnsArray(): void
    {
        $fake = new FakeTransport();
        $resp = new AccessControlList();
        $resp->mergeFromJsonString(json_encode(['ref' => 'acl-1', 'name' => 'Test ACL'], JSON_THROW_ON_ERROR), true);
        $fake->queue($resp, 0);

        $sut = new Acls($fake);
        $result = $sut->create(['name' => 'Test ACL']);

        $this->assertSame(ACLServiceClient::class, $fake->calls[0]['client']);
        $this->assertSame('Create', $fake->calls[0]['method']);
        $this->assertIsArray($result);
        $this->assertSame('acl-1', $result['ref'] ?? null);
    }

    /**
     * Test that update method calls transport.
     */
    public function testUpdateCallsTransport(): void
    {
        $fake = new FakeTransport();
        $resp = Proto::fromArray(AccessControlList::class, ['ref' => 'acl-1', 'name' => 'New Name']);
        $fake->queue($resp, 0);

        $sut = new Acls($fake);
        $out = $sut->update(['ref' => 'acl-1', 'name' => 'New Name']);

        $this->assertSame('Update', $fake->calls[0]['method']);
        $this->assertSame('New Name', $out['name'] ?? null);
    }

    /**
     * Test that get method calls transport.
     */
    public function testGetCallsTransport(): void
    {
        $fake = new FakeTransport();
        $resp = Proto::fromArray(AccessControlList::class, ['ref' => 'acl-9', 'name' => 'N']);
        $fake->queue($resp, 0);

        $sut = new Acls($fake);
        $out = $sut->get('acl-9');

        $this->assertSame('Get', $fake->calls[0]['method']);
        $this->assertSame('acl-9', $out['ref'] ?? null);
    }

    /**
     * Test that delete method calls transport.
     */
    public function testDeleteCallsTransport(): void
    {
        $fake = new FakeTransport();
        $fake->queue(null, 0);

        $sut = new Acls($fake);
        $sut->delete('acl-1');

        $this->assertSame('Delete', $fake->calls[0]['method']);
        $this->assertTrue(true); // no exception
    }

    /**
     * Test that list method returns items and next token.
     */
    public function testListReturnsItemsAndNextToken(): void
    {
        $fake = new FakeTransport();
        $acl1 = Proto::fromArray(AccessControlList::class, ['ref' => 'a1', 'name' => 'A1']);
        $acl2 = Proto::fromArray(AccessControlList::class, ['ref' => 'a2', 'name' => 'A2']);
        $list = new ListACLsResponse();
        $list->setItems([$acl1, $acl2]);
        $list->setNextPageToken('token-2');
        $fake->queue($list, 0);

        $sut = new Acls($fake);
        $out = $sut->list(['page_size' => 2]);

        $this->assertSame('List', $fake->calls[0]['method']);
        $this->assertIsArray($out['items']);
        $this->assertCount(2, $out['items']);
        $this->assertSame('token-2', $out['next_page_token']);
    }

    /**
     * Test that create method throws exception on gRPC error.
     */
    public function testCreateThrowsOnGrpcError(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('gRPC request failed');

        $fake = new FakeTransport();
        $fake->queue(null, 7, 'permission denied');
        $sut = new Acls($fake);
        $sut->create(['name' => 'X']);
    }
}
