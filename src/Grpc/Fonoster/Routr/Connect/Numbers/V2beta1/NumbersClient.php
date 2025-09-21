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
namespace Fonoster\Routr\Connect\Numbers\V2beta1;

/**
 * The Numbers service definition
 */
class NumbersClient extends \Grpc\BaseStub
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
     * Create a new Number
     *
     * @param  \Fonoster\Routr\Connect\Numbers\V2beta1\CreateNumberRequest $argument input argument
     * @param  array                                                       $metadata metadata
     * @param  array                                                       $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Create(
        \Fonoster\Routr\Connect\Numbers\V2beta1\CreateNumberRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.numbers.v2beta1.Numbers/Create',
            $argument,
            ['\Fonoster\Routr\Connect\Numbers\V2beta1\Number', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Update an existing Number
     *
     * @param  \Fonoster\Routr\Connect\Numbers\V2beta1\UpdateNumberRequest $argument input argument
     * @param  array                                                       $metadata metadata
     * @param  array                                                       $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Update(
        \Fonoster\Routr\Connect\Numbers\V2beta1\UpdateNumberRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.numbers.v2beta1.Numbers/Update',
            $argument,
            ['\Fonoster\Routr\Connect\Numbers\V2beta1\Number', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Get an existing Number
     *
     * @param  \Fonoster\Routr\Connect\Numbers\V2beta1\GetNumberRequest $argument input argument
     * @param  array                                                    $metadata metadata
     * @param  array                                                    $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Get(
        \Fonoster\Routr\Connect\Numbers\V2beta1\GetNumberRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.numbers.v2beta1.Numbers/Get',
            $argument,
            ['\Fonoster\Routr\Connect\Numbers\V2beta1\Number', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Delete an existing Number
     *
     * @param  \Fonoster\Routr\Connect\Numbers\V2beta1\DeleteNumberRequest $argument input argument
     * @param  array                                                       $metadata metadata
     * @param  array                                                       $options  call options
     * @return \Grpc\UnaryCall
     */
    public function Delete(
        \Fonoster\Routr\Connect\Numbers\V2beta1\DeleteNumberRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.numbers.v2beta1.Numbers/Delete',
            $argument,
            ['\Google\Protobuf\GPBEmpty', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * List Numbers
     *
     * @param  \Fonoster\Routr\Connect\Numbers\V2beta1\ListNumberRequest $argument input argument
     * @param  array                                                     $metadata metadata
     * @param  array                                                     $options  call options
     * @return \Grpc\UnaryCall
     */
    public function List(
        \Fonoster\Routr\Connect\Numbers\V2beta1\ListNumberRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.numbers.v2beta1.Numbers/List',
            $argument,
            ['\Fonoster\Routr\Connect\Numbers\V2beta1\ListNumbersResponse', 'decode'],
            $metadata,
            $options
        );
    }

    /**
     * Find Numbers by field name and value
     *
     * @param  \Fonoster\Routr\Connect\Numbers\V2beta1\FindByRequest $argument input argument
     * @param  array                                                 $metadata metadata
     * @param  array                                                 $options  call options
     * @return \Grpc\UnaryCall
     */
    public function FindBy(
        \Fonoster\Routr\Connect\Numbers\V2beta1\FindByRequest $argument,
        $metadata = [],
        $options = []
    ) {
        return $this->_simpleRequest(
            '/fonoster.routr.connect.numbers.v2beta1.Numbers/FindBy',
            $argument,
            ['\Fonoster\Routr\Connect\Numbers\V2beta1\FindByResponse', 'decode'],
            $metadata,
            $options
        );
    }
}
