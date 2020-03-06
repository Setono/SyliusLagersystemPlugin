<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLagersystemPlugin\Controller;

use ApiTestCase\JsonApiTestCase as BaseJsonApiTestCase;

abstract class JsonApiTestCase extends BaseJsonApiTestCase
{
    /** @var array */
    protected static $acceptHeader = [
        'ACCEPT' => 'application/json',
    ];

    /** @var array */
    protected static $authorizedHeaderWithAccept = [
        'HTTP_Authorization' => 'Bearer AdminOauthSampleToken',
        'ACCEPT' => 'application/json',
    ];

    /** @var array */
    protected static $authorizedHeaderWithContentType = [
        'HTTP_Authorization' => 'Bearer AdminOauthSampleToken',
        'CONTENT_TYPE' => 'application/json',
    ];

    /** @var array */
    protected $defaultFixtureFiles = [];

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->dataFixturesPath = __DIR__ . '/../DataFixtures/ORM';
        $this->expectedResponsesPath = __DIR__ . '/../Responses/Expected';
    }

    protected function loadDefaultFixtureFiles(array $additionalFixtureFiles = []): array
    {
        return $this->loadFixturesFromFiles(
            $this->defaultFixtureFiles + $additionalFixtureFiles
        );
    }
}
