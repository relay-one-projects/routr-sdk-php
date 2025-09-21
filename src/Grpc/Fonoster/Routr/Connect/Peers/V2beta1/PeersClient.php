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
namespace Fonoster\Routr\Connect\Peers\V2beta1;

/**
 * The Peer service definition
 */
class PeersClient extends \Grpc\BaseStub
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
     * Creates a new Peer
     *
     * @param  \Fonoster\Routr\Connect\Peers\V2beta1\CreatePeerRequest $argument input argument
     * @param  array                                                   $metadata metadata
     * @param  array                                                   $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Create(
        \Fonoster\Routr\Connect\Peers\V2beta1\CreatePeerRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.peers.v2beta1.Peers/Create',
            $argument,
            ['\Fonoster\Routr\Connect\Peers\V2beta1\Peer', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Updates an existing Peer
     *
     * @param  \Fonoster\Routr\Connect\Peers\V2beta1\UpdatePeerRequest $argument input argument
     * @param  array                                                   $metadata metadata
     * @param  array                                                   $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Update(
        \Fonoster\Routr\Connect\Peers\V2beta1\UpdatePeerRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.peers.v2beta1.Peers/Update',
            $argument,
            ['\Fonoster\Routr\Connect\Peers\V2beta1\Peer', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Gets an existing Peer
     *
     * @param  \Fonoster\Routr\Connect\Peers\V2beta1\GetPeerRequest $argument input argument
     * @param  array                                                $metadata metadata
     * @param  array                                                $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Get(
        \Fonoster\Routr\Connect\Peers\V2beta1\GetPeerRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.peers.v2beta1.Peers/Get',
            $argument,
            ['\Fonoster\Routr\Connect\Peers\V2beta1\Peer', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Deletes an existing Peer
     *
     * @param  \Fonoster\Routr\Connect\Peers\V2beta1\DeletePeerRequest $argument input argument
     * @param  array                                                   $metadata metadata
     * @param  array                                                   $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Delete(
        \Fonoster\Routr\Connect\Peers\V2beta1\DeletePeerRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.peers.v2beta1.Peers/Delete',
            $argument,
            ['\Google\Protobuf\GPBEmpty', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Lists all Peers
     *
     * @param  \Fonoster\Routr\Connect\Peers\V2beta1\ListPeersRequest $argument input argument
     * @param  array                                                  $metadata metadata
     * @param  array                                                  $options  call options
     * @return \Grpc\UnaryCall
     */
    public function List(
        \Fonoster\Routr\Connect\Peers\V2beta1\ListPeersRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.peers.v2beta1.Peers/List',
            $argument,
            ['\Fonoster\Routr\Connect\Peers\V2beta1\ListPeersResponse', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Find Agents by field name and value
     *
     * @param  \Fonoster\Routr\Connect\Peers\V2beta1\FindByRequest $argument input argument
     * @param  array                                               $metadata metadata
     * @param  array                                               $options  call options
     * @return \Grpc\UnaryCall
     */
    public function FindBy(
        \Fonoster\Routr\Connect\Peers\V2beta1\FindByRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.peers.v2beta1.Peers/FindBy',
            $argument,
            ['\Fonoster\Routr\Connect\Peers\V2beta1\FindByResponse', 'decode'],
            $metadata,
            $options
        );
    }
}
