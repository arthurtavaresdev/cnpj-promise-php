<?php

namespace ArthurTavaresDev\CnpjPromise\Data;

use JsonException;

readonly class Company
{
    public function __construct(
        public string $cnpj,
        public string $legalName,
        public ?string $tradeName,
        public \DateTimeImmutable $incorporationDate,
        public string $mainCnae,
        public string $legalNature,
        public ?string $establishmentType,
        public float $revenue,
        public bool $isSimpleNational
    ) {

    }

    public function toArray()
    {
        $data = (array) $this;
        $data['incorporationDate'] = $this->incorporationDate->format('Y-m-d');

        return $data;
    }

    /**
     * @throws JsonException
     */
    public function __toString()
    {
        return (string) json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }
}