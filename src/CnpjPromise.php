<?php

namespace ArthurTavaresDev\CnpjPromise;
use ArthurTavaresDev\CnpjPromise\Clients\CnpjWS;
use ArthurTavaresDev\CnpjPromise\Clients\MinhaReceita;
use ArthurTavaresDev\CnpjPromise\Contracts\BaseClient;
use ArthurTavaresDev\CnpjPromise\Data\Company;
use GuzzleHttp\Promise;

class CnpjPromise
{
    protected array $clients = [
        MinhaReceita::class,
        CnpjWS::class,
    ];

    public static function fetch(string $cnpj): Company
    {
        return (new static())->run($cnpj);
    }

    public function run(string $cnpj): Company
    {
        return $this->promises($cnpj)->wait();
    }

    public function promises($cnpj): Promise\PromiseInterface
    {
        $promises = array_map(
            static function ($client) use ($cnpj) {
                /** @var BaseClient $client */
                $client = new $client();
                return $client->fetch($cnpj);
            },
            $this->clients
        );

        return Promise\Utils::any($promises);
    }
}