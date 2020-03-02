<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLagersystemPlugin\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Setono\SyliusLagersystemPlugin\DependencyInjection\SetonoSyliusLagersystemExtension;
use Setono\SyliusLagersystemPlugin\View;

final class SetonoSyliusLagersystemExtensionTest extends AbstractExtensionTestCase
{
    /**
     * @test
     */
    public function it_defines_view_classes_parameters(): void
    {
        $this->load([]);

        $nameToClass = [
            'page' => View\PageView::class,
            'page_links' => View\PageLinksView::class,
            'order' => View\Order\OrderView::class,
        ];

        foreach ($nameToClass as $name => $class) {
            $this->assertContainerBuilderHasParameter(
                sprintf('setono_sylius_lagersystem.view.%s.class', $name),
                $class
            );
        }
    }

    protected function getContainerExtensions(): array
    {
        return [new SetonoSyliusLagersystemExtension()];
    }
}
