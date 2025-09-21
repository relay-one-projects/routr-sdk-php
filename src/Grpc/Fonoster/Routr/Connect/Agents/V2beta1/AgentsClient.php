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
namespace Fonoster\Routr\Connect\Agents\V2beta1;

/**
 * The Agents service definition
 */
class AgentsClient extends \Grpc\BaseStub
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
     * Creates a new Agent
     *
     * @param  \Fonoster\Routr\Connect\Agents\V2beta1\CreateAgentRequest $argument input argument
     * @param  array                                                     $metadata metadata
     * @param  array                                                     $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Create(
        \Fonoster\Routr\Connect\Agents\V2beta1\CreateAgentRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.agents.v2beta1.Agents/Create',
            $argument,
            ['\Fonoster\Routr\Connect\Agents\V2beta1\Agent', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Updates an existing Agent
     *
     * @param  \Fonoster\Routr\Connect\Agents\V2beta1\UpdateAgentRequest $argument input argument
     * @param  array                                                     $metadata metadata
     * @param  array                                                     $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Update(
        \Fonoster\Routr\Connect\Agents\V2beta1\UpdateAgentRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.agents.v2beta1.Agents/Update',
            $argument,
            ['\Fonoster\Routr\Connect\Agents\V2beta1\Agent', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Gets an existing Agent
     *
     * @param  \Fonoster\Routr\Connect\Agents\V2beta1\GetAgentRequest $argument input argument
     * @param  array                                                  $metadata metadata
     * @param  array                                                  $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Get(
        \Fonoster\Routr\Connect\Agents\V2beta1\GetAgentRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.agents.v2beta1.Agents/Get',
            $argument,
            ['\Fonoster\Routr\Connect\Agents\V2beta1\Agent', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Deletes an existing Agent
     *
     * @param  \Fonoster\Routr\Connect\Agents\V2beta1\DeleteAgentRequest $argument input argument
     * @param  array                                                     $metadata metadata
     * @param  array                                                     $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Delete(
        \Fonoster\Routr\Connect\Agents\V2beta1\DeleteAgentRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.agents.v2beta1.Agents/Delete',
            $argument,
            ['\Google\Protobuf\GPBEmpty', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Lists all Agents
     *
     * @param  \Fonoster\Routr\Connect\Agents\V2beta1\ListAgentsRequest $argument input argument
     * @param  array                                                    $metadata metadata
     * @param  array                                                    $options  call options
     * @return \Grpc\UnaryCall
     */
    public function List(
        \Fonoster\Routr\Connect\Agents\V2beta1\ListAgentsRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.agents.v2beta1.Agents/List',
            $argument,
            ['\Fonoster\Routr\Connect\Agents\V2beta1\ListAgentsResponse', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Find Agents by field name and value
     *
     * @param  \Fonoster\Routr\Connect\Agents\V2beta1\FindByRequest $argument input argument
     * @param  array                                                $metadata metadata
     * @param  array                                                $options  call options
     * @return \Grpc\UnaryCall
     */
    public function FindBy(
        \Fonoster\Routr\Connect\Agents\V2beta1\FindByRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.agents.v2beta1.Agents/FindBy',
            $argument,
            ['\Fonoster\Routr\Connect\Agents\V2beta1\FindByResponse', 'decode'],
            $metadata,
            $options
        );
    }
}
