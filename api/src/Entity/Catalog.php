<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\OpenApi\Model\Operation;

#[ORM\Entity]
#[ApiResource(
    operations: [
        new GetCollection(
            openapi: new Operation(
                summary: 'Lista articoli',
                description: 'Restituisce l’elenco completo degli articoli del catalogo'
            )
        ),
        new Get(
            openapi: new Operation(
                summary: 'Singolo articolo',
                description: 'Restituisce i dettagli di un singolo articolo'
            )
        ),
        new Post(
            openapi: new Operation(
                summary: 'Crea articolo',
                description: 'Crea un nuovo articolo nel catalogo'
            )
        ),
        new Put(
            openapi: new Operation(
                summary: 'Aggiorna articolo',
                description: 'Aggiorna un articolo esistente'
            )
        ),
        new Delete(
            openapi: new Operation(
                summary: 'Elimina articolo',
                description: 'Rimuove un articolo dal catalogo'
            )
        )
    ]
)]
class Catalog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    public string $name;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Assert\NotBlank]
    public string $price;
}