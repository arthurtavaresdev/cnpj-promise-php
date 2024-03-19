# CEP Promise PHP

Uma biblioteca independente para PHP 8.2+ que realiza consultas de CNPJ em vários serviços utilizando Promessas/A+.

##  Features

- Executa solicitações de forma simultânea, sempre retornando a resposta mais ágil;
- Garante alta disponibilidade ao empregar múltiplos provedores de serviços distintos;
- Desenvolvido com a utilização da implementação de promessas para PHP do pacote guzzle/promises;

## Instalação

Instale o pacote via composer:

```
composer require arthurtavaresdev/cnpj-promise-php
```

## Uso
### Retornando Objeto
Busca utilizando valores inteiros e resposta em forma de objeto.

```php
use ArthurTavaresDev\CnpjPromise\CnpjPromise;

require 'vendor/autoload.php';

$cnpj = '27865757000102';
$company = CnpjPromise::fetch($cnpj);

/*
ArthurTavaresDev\CnpjPromise\Data\Company Object
(  
  +cnpj: "27865757000102"
  +legalName: "GLOBO COMUNICACAO E PARTICIPACOES S/A"
  +tradeName: "TV/REDE/CANAIS/G2C+GLOBO GLOBO.COM GLOBOPLAY"
  +incorporationDate: Carbon\CarbonImmutable,
  +mainCnae: "2054"
  +legalNature: "2054"
  +establishmentType: "DEMAIS"
  +revenue: 6983568523.86
  +isSimpleNational: false
)
*/
```

## Retornando Array
Busca utilizando valores inteiros e resposta em forma de array.

```php
use ArthurTavaresDev\CnpjPromise\CnpjPromise;

require 'vendor/autoload.php';

$cnpj = '27865757000102';
$company = CnpjPromise::fetch($cnpj)->toArray();

/*
array:9 [
  "cnpj" => "27865757000102"
  "legalName" => "GLOBO COMUNICACAO E PARTICIPACOES S/A"
  "tradeName" => "TV/REDE/CANAIS/G2C+GLOBO GLOBO.COM GLOBOPLAY"
  "incorporationDate" => "1986-01-31"
  "mainCnae" => "2054"
  "legalNature" => "2054"
  "establishmentType" => "DEMAIS"
  "revenue" => 6983568523.86
  "isSimpleNational" => false
]
*/
```

## Voltando a Promise
Busca utilizando valores inteiros e resposta em forma de promessa.

```php
use ArthurTavaresDev\CnpjPromise\CnpjPromise;

require 'vendor/autoload.php';

$cnpjPromisse = new CnpjPromise();
$cnpjPromisse->promises('27865757000102');
```