<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLagersystemPlugin\Controller;

use ApiTestCase\JsonApiTestCase as BaseJsonApiTestCase;

abstract class JsonApiTestCase extends BaseJsonApiTestCase
{
    protected static $acceptHeader = [
        'ACCEPT' => 'application/json',
    ];

    protected static $authorizedHeaderWithAccept = [
        'HTTP_Authorization' => 'Bearer AdminOauthSampleToken',
        'ACCEPT' => 'application/json',
    ];

    protected static $authorizedHeaderWithContentType = [
        'HTTP_Authorization' => 'Bearer AdminOauthSampleToken',
        'CONTENT_TYPE' => 'application/json',
    ];

    protected $defaultFixtureFiles = [];

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->dataFixturesPath = __DIR__ . '/../DataFixtures/ORM';
        $this->expectedResponsesPath = __DIR__ . '/../Responses/Expected';
    }

    protected function get($id)
    {
        if (property_exists(static::class, 'container')) {
            return static::$container->get($id);
        }

        return parent::get($id);
    }

    protected function loadDefaultFixtureFiles(array $additionalFixtureFiles = []): array
    {
        return $this->loadFixturesFromFiles(
            $this->defaultFixtureFiles + $additionalFixtureFiles
        );
    }
}
