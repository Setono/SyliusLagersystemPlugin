<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLagersystemPlugin\Controller\Product;

use Symfony\Component\HttpFoundation\Response;
use Tests\Setono\SyliusLagersystemPlugin\Application\Entity\ProductVariant;

final class ProductVariantShowApiTest extends JsonApiTestCase
{
    /**
     * @test
     */
    public function it_returns_an_unauthorized_exception_if_no_auth_headers_sent(): void
    {
        $entities = $this->loadDefaultFixtureFiles();
        /** @var ProductVariant $variant */
        $variant = $entities['mug_variant_red'];
        $this->client->request('GET', $this->getProductVariantShowUrl($variant, 'en_US'), [], [], self::$acceptHeader);
        $response = $this->client->getResponse();
        $this->assertResponseCode($response, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     */
    public function it_returns_an_exception_if_no_locale_provided(): void
    {
        $entities = $this->loadDefaultFixtureFiles();
        /** @var ProductVariant $variant */
        $variant = $entities['mug_variant_red'];
        $this->client->request('GET', $this->getProductVariantShowUrl($variant), [], [], self::$authorizedHeaderWithAccept);
        $response = $this->client->getResponse();
        $this->assertResponseCode($response, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @test
     */
    public function it_returns_an_exception_if_variant_does_not_exists(): void
    {
        $this->loadDefaultFixtureFiles();
        $this->client->request('GET', $this->getProductVariantShowUrl('fake', 'en_US'), [], [], self::$authorizedHeaderWithAccept);
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'product_variant/product_variant_show_404_response', Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     */
    public function index_returns_all_variants(): void
    {
        $entities = $this->loadDefaultFixtureFiles();
        /** @var ProductVariant $variant */
        $variant = $entities['mug_variant_red'];
        $this->client->request('GET', $this->getProductVariantShowUrl($variant, 'en_US'), [], [], self::$authorizedHeaderWithAccept);
        $response = $this->client->getResponse();
        $this->assertResponse($response, 'product_variant/product_variant_show_response', Response::HTTP_OK);
    }
}
