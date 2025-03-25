<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Enum\TipoOperazione;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;


class OperationControllerTest extends ApiTestCase {

    private string $epOperation = '/api/operation';

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testOperationAdd(): void
    {
        ApiTestCase::createClient();
        $response = static::createClient()->request('POST', $this->epOperation, [
            'json' => [
                'p1' => '5p 17s 8d',
                'p2' => '3p 4s 10d',
                'op' => TipoOperazione::SOMMA,
            ],
        ]);

        $this->assertResponseStatusCodeSame(200);
        $this->assertSame('9p 2s 6d', json_decode($response->getContent(), true));
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testOperationSubtract(): void
    {
        ApiTestCase::createClient();
        $response = static::createClient()->request('POST', $this->epOperation, [
            'json' => [
                'p1' => '5p 17s 8d',
                'p2' => '3p 4s 10d',
                'op' => TipoOperazione::SOTTRAZIONE,
            ],
        ]);

        $this->assertResponseStatusCodeSame(200);
        $this->assertSame('2p 12s 10d', json_decode($response->getContent(), true));
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testOperationMultiply(): void
    {
        ApiTestCase::createClient();
        $response = static::createClient()->request('POST', $this->epOperation, [
            'json' => [
                'p1' => '5p 17s 8d',
                'p2' => '2',
                'op' => TipoOperazione::MOLTIPLICAZIONE,
            ],
        ]);

        $this->assertResponseStatusCodeSame(200);
        $this->assertSame('11p 15s 4d', json_decode($response->getContent(), true));
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testOperationDivide(): void
    {
        ApiTestCase::createClient();
        $response = static::createClient()->request('POST', $this->epOperation, [
            'json' => [
                'p1' => '18p 16s 1d',
                'p2' => '15',
                'op' => TipoOperazione::DIVISIONE,
            ],
        ]);

        $this->assertResponseStatusCodeSame(200);
        $this->assertSame('1p 5s (1s 1d)', json_decode($response->getContent(), true));
    }
}