<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\DependencyInjection;

use function Safe\sprintf;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class SetonoSyliusLagersystemExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $config);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        foreach ($config['view_classes'] as $view => $class) {
            $container->setParameter(sprintf('setono_sylius_lagersystem.view.%s.class', $view), $class);
        }

        $loader->load('services.xml');
    }
}
