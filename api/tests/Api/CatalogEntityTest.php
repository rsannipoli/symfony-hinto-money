<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;


class CatalogEntityTest extends ApiTestCase {

    private string $epCatalog = '/api/catalogs';

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testCatalogItemCreate(): void
    {
        ApiTestCase::createClient();
        $response = static::createClient()->request('POST', $this->epCatalog, [
            'json' => [
                'name' => 'Medaglietta Hinto',
                'price' => '23.50',
            ],
        ]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains([
            'name' => 'Medaglietta Hinto',
            'price' => '23.50',
        ]);
    }

    /**
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function testCatalogListGetAll(): void
    {
        $response = static::createClient()->request('GET', $this->epCatalog);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }


    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testCatalogListGetOne(): void
    {
        $client = static::createClient();

        // Crea articolo
        $response = $client->request('POST', $this->epCatalog, [
            'json' => [
                'name' => 'Maglia Hinto',
                'price' => '28',
            ],
        ]);

        $iri = $response->toArray()['@id'];

        static::createClient()->request('GET', $iri);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }

    /**
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function testCatalogItemUpdate(): void
    {
        $client = static::createClient();

        // Crea articolo
        $response = $client->request('POST', $this->epCatalog, [
            'json' => [
                'name' => 'Maglia Hinto',
                'price' => '28',
            ],
        ]);

        $iri = $response->toArray()['@id'];

        // Aggiorna
        $client->request('PUT', $iri, [
            'json' => [
                'name' => 'Maglia Hinto',
                'price' => '30'
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['price' => '30.00']);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testCatalogItemDelete(): void
    {
        $client = static::createClient();

        // Crea articolo
        $response = $client->request('POST', $this->epCatalog, [
            'json' => [
                'name' => 'Maglia Hinto',
                'price' => '28',
            ],
        ]);

        $iri = $response->toArray()['@id'];

        $client->request('DELETE', $iri, []);

        $this->assertResponseStatusCodeSame(204);
    }
}