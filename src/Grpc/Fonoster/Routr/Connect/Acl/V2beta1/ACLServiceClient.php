<?php

// GENERATED CODE -- DO NOT EDIT!

// Original file comments:
//
// Copyright (C) 2024 by Fonoster Inc (https://fonoster.com)
// http://github.com/fonoster/routr
//
// This file is part of Routr
//
// Licensed under the MIT License (the "License")
// you may not use this file except in compliance with
// the License. You may obtain a copy of the License at
//
//    https://opensource.org/licenses/MIT
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
namespace Fonoster\Routr\Connect\Acl\V2beta1;

/**
 * AccessControlList(ACL) service definition
 */
class ACLServiceClient extends \Grpc\BaseStub
{
    /**
     * @param string        $hostname hostname
     * @param array         $opts     channel options
     * @param \Grpc\Channel $channel  (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null)
    {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Create a new ACL
     *
     * @param  \Fonoster\Routr\Connect\Acl\V2beta1\CreateACLRequest $argument input argument
     * @param  array                                                $metadata metadata
     * @param  array                                                $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Create(
        \Fonoster\Routr\Connect\Acl\V2beta1\CreateACLRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.acl.v2beta1.ACLService/Create',
            $argument,
            ['\Fonoster\Routr\Connect\Acl\V2beta1\AccessControlList', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Update an existing ACL
     *
     * @param  \Fonoster\Routr\Connect\Acl\V2beta1\UpdateACLRequest $argument input argument
     * @param  array                                                $metadata metadata
     * @param  array                                                $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Update(
        \Fonoster\Routr\Connect\Acl\V2beta1\UpdateACLRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.acl.v2beta1.ACLService/Update',
            $argument,
            ['\Fonoster\Routr\Connect\Acl\V2beta1\AccessControlList', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Get an existing ACL
     *
     * @param  \Fonoster\Routr\Connect\Acl\V2beta1\GetACLRequest $argument input argument
     * @param  array                                             $metadata metadata
     * @param  array                                             $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Get(
        \Fonoster\Routr\Connect\Acl\V2beta1\GetACLRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.acl.v2beta1.ACLService/Get',
            $argument,
            ['\Fonoster\Routr\Connect\Acl\V2beta1\AccessControlList', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Delete an existing ACL
     *
     * @param  \Fonoster\Routr\Connect\Acl\V2beta1\DeleteACLRequest $argument input argument
     * @param  array                                                $metadata metadata
     * @param  array                                                $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Delete(
        \Fonoster\Routr\Connect\Acl\V2beta1\DeleteACLRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.acl.v2beta1.ACLService/Delete',
            $argument,
            ['\Google\Protobuf\GPBEmpty', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Get a list of ACLs
     *
     * @param  \Fonoster\Routr\Connect\Acl\V2beta1\ListACLsRequest $argument input argument
     * @param  array                                               $metadata metadata
     * @param  array                                               $options  call options
     * @return \Grpc\UnaryCall
     */
    public function List(
        \Fonoster\Routr\Connect\Acl\V2beta1\ListACLsRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.acl.v2beta1.ACLService/List',
            $argument,
            ['\Fonoster\Routr\Connect\Acl\V2beta1\ListACLsResponse', 'decode'],
            $metadata,
            $options
        );
    }
}
