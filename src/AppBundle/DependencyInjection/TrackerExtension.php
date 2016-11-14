<?php
namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * Class AppExtension
 * @package AppBundle\DependencyInjection
 */
class TrackerExtension extends ConfigurableExtension
{

    /**
     * @inheritdoc
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $this->loadCommonConfigs($container);
        $this->loadActionConfigs($container);
    }

    /**
     * @inheritdoc
     */
    public function getAlias()
    {
        return 'tracker';
    }

    /**
     * @param ContainerBuilder $container
     */
    private function loadActionConfigs(ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config/action'));

        $loader->load('command_handlers.yml');
        $loader->load('repositories.yml');
    }

    /**
     * @param ContainerBuilder $container
     */
    private function loadCommonConfigs(ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.yml');
    }
}
