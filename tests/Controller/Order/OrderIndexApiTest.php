<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLagersystemPlugin\Controller\Order;

use Symfony\Component\HttpFoundation\Response;

final class OrderIndexApiTest extends JsonApiTestCase
{
    /**
     * @test
     */
    public function it_returns_an_unauthorized_exception_if_no_auth_headers_sent(): void
    {
        $this->loadDefaultFixtureFiles();
        $this->client->request('GET', $this->getOrdersIndexUrl(), [], [], self::$acceptHeader);
        $response = $this->client->getResponse();
        $this->assertResponseCode($response, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     */
    public function index_returns_only_open_orders_in_lagersystem_terms(): void
    {
        $this->loadDefaultFixtureFiles();
        $this->client->request('GET', $this->getOrdersIndexUrl(), [], [], self::$authorizedHeaderWithAccept);
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'order/order_index_response', Response::HTTP_OK);
    }
}
