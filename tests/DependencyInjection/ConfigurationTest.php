<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLagersystemPlugin\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use PHPUnit\Framework\TestCase;
use Setono\SyliusLagersystemPlugin\DependencyInjection\Configuration;
use Setono\SyliusLagersystemPlugin\View;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    /**
     * @test
     */
    public function it_has_view_classes(): void
    {
        $this->assertProcessedConfigurationEquals([], [
            'view_classes' => [
                'page' => View\PageView::class,
                'page_links' => View\PageLinksView::class,
                'address' => View\AddressView::class,
                'shipping_method' => View\ShippingMethodView::class,
                'shipment' => View\ShipmentView::class,
                'payment_method' => View\PaymentMethodView::class,
                'payment' => View\PaymentView::class,
                'order' => View\Order\OrderView::class,
            ],
        ], 'view_classes');
    }

    protected function getConfiguration(): ConfigurationInterface
    {
        return new Configuration();
    }
}
