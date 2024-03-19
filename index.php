<?php

include_once 'vendor/autoload.php';

use ArthurTavaresDev\CnpjPromise\CnpjPromise;

$cnpj = '27865757000102';
$company = CnpjPromise::fetch($cnpj);

dd($company->toArray());