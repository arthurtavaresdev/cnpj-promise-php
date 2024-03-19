<?php

namespace ArthurTavaresDev\CnpjPromise\Clients;

use ArthurTavaresDev\CnpjPromise\Contracts\BaseClient;
use ArthurTavaresDev\CnpjPromise\Data\Company;
use Carbon\CarbonImmutable;

class MinhaReceita extends BaseClient
{
    public function identifier(): string
    {
        return 'minha-receita';
    }

    protected function baseUrl(): string
    {
        return 'https://minhareceita.org';
    }

    protected function getCompany($data) : Company
    {
        return new Company(
            cnpj: $data->cnpj,
            legalName: $data->razao_social,
            tradeName: $data->nome_fantasia ?? $data->razao_social,
            incorporationDate: CarbonImmutable::parse($data->data_inicio_atividade),
            mainCnae: $data->cnae_fiscal,
            legalNature: $data->codigo_natureza_juridica,
            establishmentType: $data->descricao_porte ?? 'DEMAIS',
            revenue: $data->capital_social ?? 0,
            isSimpleNational: $data->opcao_pelo_simples ?? false
        );
    }
}