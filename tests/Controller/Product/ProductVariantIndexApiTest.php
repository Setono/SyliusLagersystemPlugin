<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLagersystemPlugin\Controller\Product;

use Symfony\Component\HttpFoundation\Response;

final class ProductVariantIndexApiTest extends JsonApiTestCase
{
    /**
     * @test
     */
    public function it_returns_an_unauthorized_exception_if_no_auth_headers_sent(): void
    {
        $this->loadDefaultFixtureFiles();
        $this->client->request('GET', $this->getProductVariantsIndexUrl('en_US'), [], [], self::$acceptHeader);
        $response = $this->client->getResponse();
        $this->assertResponseCode($response, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     */
    public function it_returns_an_exception_if_no_locale_provided(): void
    {
        $this->loadDefaultFixtureFiles();
        $this->client->request('GET', $this->getProductVariantsIndexUrl(), [], [], self::$authorizedHeaderWithAccept);
        $response = $this->client->getResponse();
        $this->assertResponseCode($response, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @test
     */
    public function index_returns_all_variants(): void
    {
        $this->loadDefaultFixtureFiles();
        $this->client->request('GET', $this->getProductVariantsIndexUrl('en_US'), [], [], self::$authorizedHeaderWithAccept);
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'product_variant/product_variant_index_response', Response::HTTP_OK);
    }
}
