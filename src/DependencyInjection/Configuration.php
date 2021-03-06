<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\DependencyInjection;

use function method_exists;
use Setono\SyliusLagersystemPlugin\View;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('setono_sylius_lagersystem');
        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $rootNode = $treeBuilder->root('setono_sylius_lagersystem');
        }

        $this->buildViewClassesNode($rootNode);

        return $treeBuilder;
    }

    private function buildViewClassesNode(ArrayNodeDefinition $rootNode): void
    {
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('view_classes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('page')->defaultValue(View\PageView::class)->end()
                        ->scalarNode('page_links')->defaultValue(View\PageLinksView::class)->end()
                        ->scalarNode('image')->defaultValue(View\Image\ImageView::class)->end()
                        ->scalarNode('customer')->defaultValue(View\Customer\CustomerView::class)->end()
                        ->scalarNode('address')->defaultValue(View\AddressView::class)->end()
                        ->scalarNode('shipping_method')->defaultValue(View\ShippingMethodView::class)->end()
                        ->scalarNode('shipment')->defaultValue(View\ShipmentView::class)->end()
                        ->scalarNode('payment_method')->defaultValue(View\PaymentMethodView::class)->end()
                        ->scalarNode('payment')->defaultValue(View\PaymentView::class)->end()
                        ->scalarNode('adjustment')->defaultValue(View\Order\AdjustmentView::class)->end()
                        ->scalarNode('order')->defaultValue(View\Order\OrderView::class)->end()
                        ->scalarNode('order_item')->defaultValue(View\Order\ItemView::class)->end()
                        ->scalarNode('order_item_unit')->defaultValue(View\Order\ItemUnitView::class)->end()
                        ->scalarNode('product_variant')->defaultValue(View\Product\ProductVariantView::class)->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
