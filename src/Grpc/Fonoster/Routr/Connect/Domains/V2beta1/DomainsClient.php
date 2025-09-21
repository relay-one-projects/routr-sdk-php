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
namespace Fonoster\Routr\Connect\Domains\V2beta1;

/**
 * The Domains service definition
 */
class DomainsClient extends \Grpc\BaseStub
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
     * Create a new Domain
     *
     * @param  \Fonoster\Routr\Connect\Domains\V2beta1\CreateDomainRequest $argument input argument
     * @param  array                                                       $metadata metadata
     * @param  array                                                       $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Create(
        \Fonoster\Routr\Connect\Domains\V2beta1\CreateDomainRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.domains.v2beta1.Domains/Create',
            $argument,
            ['\Fonoster\Routr\Connect\Domains\V2beta1\Domain', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Update an existing Domain
     *
     * @param  \Fonoster\Routr\Connect\Domains\V2beta1\UpdateDomainRequest $argument input argument
     * @param  array                                                       $metadata metadata
     * @param  array                                                       $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Update(
        \Fonoster\Routr\Connect\Domains\V2beta1\UpdateDomainRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.domains.v2beta1.Domains/Update',
            $argument,
            ['\Fonoster\Routr\Connect\Domains\V2beta1\Domain', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Get an existing Domain
     *
     * @param  \Fonoster\Routr\Connect\Domains\V2beta1\GetDomainRequest $argument input argument
     * @param  array                                                    $metadata metadata
     * @param  array                                                    $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Get(
        \Fonoster\Routr\Connect\Domains\V2beta1\GetDomainRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.domains.v2beta1.Domains/Get',
            $argument,
            ['\Fonoster\Routr\Connect\Domains\V2beta1\Domain', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Delete an existing Domain
     *
     * @param  \Fonoster\Routr\Connect\Domains\V2beta1\DeleteDomainRequest $argument input argument
     * @param  array                                                       $metadata metadata
     * @param  array                                                       $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Delete(
        \Fonoster\Routr\Connect\Domains\V2beta1\DeleteDomainRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.domains.v2beta1.Domains/Delete',
            $argument,
            ['\Google\Protobuf\GPBEmpty', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * List all Domains
     *
     * @param  \Fonoster\Routr\Connect\Domains\V2beta1\ListDomainRequest $argument input argument
     * @param  array                                                     $metadata metadata
     * @param  array                                                     $options  call options
     * @return \Grpc\UnaryCall
     */
    public function List(
        \Fonoster\Routr\Connect\Domains\V2beta1\ListDomainRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.domains.v2beta1.Domains/List',
            $argument,
            ['\Fonoster\Routr\Connect\Domains\V2beta1\ListDomainsResponse', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Find a Domain by field name and value
     *
     * @param  \Fonoster\Routr\Connect\Domains\V2beta1\FindByRequest $argument input argument
     * @param  array                                                 $metadata metadata
     * @param  array                                                 $options  call options
     * @return \Grpc\UnaryCall
     */
    public function FindBy(
        \Fonoster\Routr\Connect\Domains\V2beta1\FindByRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.domains.v2beta1.Domains/FindBy',
            $argument,
            ['\Fonoster\Routr\Connect\Domains\V2beta1\FindByResponse', 'decode'],
            $metadata,
            $options
        );
    }
}
