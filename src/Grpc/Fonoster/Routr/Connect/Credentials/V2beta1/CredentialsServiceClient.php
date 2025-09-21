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
namespace Fonoster\Routr\Connect\Credentials\V2beta1;

/**
 * The Credentials service definition
 */
class CredentialsServiceClient extends \Grpc\BaseStub
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
     * Creates a new set of Credentials
     *
     * @param  \Fonoster\Routr\Connect\Credentials\V2beta1\CreateCredentialsRequest $argument input argument
     * @param  array                                                                $metadata metadata
     * @param  array                                                                $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Create(
        \Fonoster\Routr\Connect\Credentials\V2beta1\CreateCredentialsRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.credentials.v2beta1.CredentialsService/Create',
            $argument,
            ['\Fonoster\Routr\Connect\Credentials\V2beta1\Credentials', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Updates an existing set of C redentials
     *
     * @param  \Fonoster\Routr\Connect\Credentials\V2beta1\UpdateCredentialsRequest $argument input argument
     * @param  array                                                                $metadata metadata
     * @param  array                                                                $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Update(
        \Fonoster\Routr\Connect\Credentials\V2beta1\UpdateCredentialsRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.credentials.v2beta1.CredentialsService/Update',
            $argument,
            ['\Fonoster\Routr\Connect\Credentials\V2beta1\Credentials', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Gets the details of a given set of Credentials
     *
     * @param  \Fonoster\Routr\Connect\Credentials\V2beta1\GetCredentialsRequest $argument input argument
     * @param  array                                                             $metadata metadata
     * @param  array                                                             $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Get(
        \Fonoster\Routr\Connect\Credentials\V2beta1\GetCredentialsRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.credentials.v2beta1.CredentialsService/Get',
            $argument,
            ['\Fonoster\Routr\Connect\Credentials\V2beta1\Credentials', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Deletes an existing set of Credentials
     *
     * @param  \Fonoster\Routr\Connect\Credentials\V2beta1\DeleteCredentialsRequest $argument input argument
     * @param  array                                                                $metadata metadata
     * @param  array                                                                $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Delete(
        \Fonoster\Routr\Connect\Credentials\V2beta1\DeleteCredentialsRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.credentials.v2beta1.CredentialsService/Delete',
            $argument,
            ['\Google\Protobuf\GPBEmpty', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Lists all Credentials
     *
     * @param  \Fonoster\Routr\Connect\Credentials\V2beta1\ListCredentialsRequest $argument input argument
     * @param  array                                                              $metadata metadata
     * @param  array                                                              $options  call options
     * @return \Grpc\UnaryCall
     */
    public function List(
        \Fonoster\Routr\Connect\Credentials\V2beta1\ListCredentialsRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.credentials.v2beta1.CredentialsService/List',
            $argument,
            ['\Fonoster\Routr\Connect\Credentials\V2beta1\ListCredentialsResponse', 'decode'],
            $metadata,
            $options
        );
    }
}
