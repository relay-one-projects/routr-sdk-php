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
namespace Fonoster\Routr\Connect\Trunks\V2beta1;

/**
 * The Trunks service definition
 */
class TrunksClient extends \Grpc\BaseStub
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
     * Create a new Trunk
     *
     * @param  \Fonoster\Routr\Connect\Trunks\V2beta1\CreateTrunkRequest $argument input argument
     * @param  array                                                     $metadata metadata
     * @param  array                                                     $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Create(
        \Fonoster\Routr\Connect\Trunks\V2beta1\CreateTrunkRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.trunks.v2beta1.Trunks/Create',
            $argument,
            ['\Fonoster\Routr\Connect\Trunks\V2beta1\Trunk', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Update an existing Trunk
     *
     * @param  \Fonoster\Routr\Connect\Trunks\V2beta1\UpdateTrunkRequest $argument input argument
     * @param  array                                                     $metadata metadata
     * @param  array                                                     $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Update(
        \Fonoster\Routr\Connect\Trunks\V2beta1\UpdateTrunkRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.trunks.v2beta1.Trunks/Update',
            $argument,
            ['\Fonoster\Routr\Connect\Trunks\V2beta1\Trunk', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Get a Trunk by reference
     *
     * @param  \Fonoster\Routr\Connect\Trunks\V2beta1\GetTrunkRequest $argument input argument
     * @param  array                                                  $metadata metadata
     * @param  array                                                  $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Get(
        \Fonoster\Routr\Connect\Trunks\V2beta1\GetTrunkRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.trunks.v2beta1.Trunks/Get',
            $argument,
            ['\Fonoster\Routr\Connect\Trunks\V2beta1\Trunk', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Delete a Trunk by reference
     *
     * @param  \Fonoster\Routr\Connect\Trunks\V2beta1\DeleteTrunkRequest $argument input argument
     * @param  array                                                     $metadata metadata
     * @param  array                                                     $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Delete(
        \Fonoster\Routr\Connect\Trunks\V2beta1\DeleteTrunkRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.trunks.v2beta1.Trunks/Delete',
            $argument,
            ['\Google\Protobuf\GPBEmpty', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * List all Trunks
     *
     * @param  \Fonoster\Routr\Connect\Trunks\V2beta1\ListTrunkRequest $argument input argument
     * @param  array                                                   $metadata metadata
     * @param  array                                                   $options  call options
     * @return \Grpc\UnaryCall
     */
    public function List(
        \Fonoster\Routr\Connect\Trunks\V2beta1\ListTrunkRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.trunks.v2beta1.Trunks/List',
            $argument,
            ['\Fonoster\Routr\Connect\Trunks\V2beta1\ListTrunksResponse', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Find Trunks by field name and value
     *
     * @param  \Fonoster\Routr\Connect\Trunks\V2beta1\FindByRequest $argument input argument
     * @param  array                                                $metadata metadata
     * @param  array                                                $options  call options
     * @return \Grpc\UnaryCall
     */
    public function FindBy(
        \Fonoster\Routr\Connect\Trunks\V2beta1\FindByRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.trunks.v2beta1.Trunks/FindBy',
            $argument,
            ['\Fonoster\Routr\Connect\Trunks\V2beta1\FindByResponse', 'decode'],
            $metadata,
            $options
        );
    }
}
