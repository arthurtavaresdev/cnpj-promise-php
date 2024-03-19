<?php

namespace ArthurTavaresDev\CnpjPromise\Contracts;

use ArthurTavaresDev\CnpjPromise\Data\Company;
use Closure;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;

abstract class BaseClient
{
    abstract protected function baseUrl(): string;
    abstract protected function getCompany(object $data) : Company;
    abstract public function identifier(): string;
    protected function client(): PendingRequest
    {
        return (new PendingRequest)->baseUrl($this->baseUrl());
    }

    public function fetch(string $cnpj): PromiseInterface
    {
        return $this->client()
            ->throw()
            ->async()
            ->get($cnpj)
            ->then($this->analyzeAndParseResponse(...))
            ->then($this->getCompany(...));
    }

    protected function analyzeAndParseResponse($response)
    {
        return $response?->object();
    }
}