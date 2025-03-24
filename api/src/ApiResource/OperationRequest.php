<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\OpenApi\Model\Operation;
use App\Enum\TipoOperazione;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\OperationController;
use ApiPlatform\Metadata\Post;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/operation',
            controller: OperationController::class,
            openapi: new Operation(
                summary: 'Esegui un\'operazione su valori monetari',
                description: 'Rest custom per eseguire operazioni aritmetiche con la moneta Brittanica (pence, shilling e pound)'
            ),
            input: OperationRequest::class,
            output: 'App\ApiResource\OperationResponse',
        )
    ]
)]
class OperationRequest
{
    #[Assert\NotBlank]
    #[SerializedName('p1')]
    public ?string $p1 = null;

    #[Assert\NotBlank]
    #[SerializedName('p2')]
    public ?string $p2 = null;

    #[Assert\NotBlank]
    #[SerializedName('op')]
    public TipoOperazione $op;

    public function getP1(): ?string
    {
        return $this->p1;
    }

    public function getP2(): ?string
    {
        return $this->p2;
    }

    public function getOp(): TipoOperazione
    {
        return $this->op;
    }
}