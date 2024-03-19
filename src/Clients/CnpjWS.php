<?php

namespace ArthurTavaresDev\CnpjPromise\Clients;

use ArthurTavaresDev\CnpjPromise\Contracts\BaseClient;
use ArthurTavaresDev\CnpjPromise\Data\Company;
use Carbon\CarbonImmutable;

class CnpjWS extends BaseClient
{
    public function identifier(): string
    {
        return 'cnpj-ws';
    }

    protected function baseUrl(): string
    {
        return 'https://publica.cnpj.ws/cnpj/';
    }
    protected function getCompany(object $data) : Company
    {
        return new Company(
            cnpj: $data->estabelecimento->cnpj,
            legalName: $data->razao_social,
            tradeName: $data->estabelecimento->nome_fantasia ?? $data->razao_social,
            incorporationDate: CarbonImmutable::parse($data->estabelecimento->data_inicio_atividade),
            mainCnae: $data->natureza_juridica->id,
            legalNature: $data->natureza_juridica->id,
            establishmentType: match ($data->porte->id) {
                // https://www.cnpj.ws/docs/modelos-dados/portes
                "01" => null,
                "02" => 'EI',  // 'EI' ≥ 'Empresário Individual',
                "03" => 'EPP', // 'EPP' ≥ 'Empresa de Pequeno Porte',
                default => 'DEMAIS'
            },
            revenue: $data->capital_social,
            isSimpleNational: $data->simples?->simples === 'Sim'
        );
    }

}