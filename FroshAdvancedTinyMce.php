<?php

namespace FroshAdvancedTinyMce;

use Doctrine\ORM\Tools\SchemaTool;
use FroshAdvancedTinyMce\Models\TinyMce\Template;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FroshAdvancedTinyMce extends Plugin
{
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('frosh_advanced_tiny_mce.plugin_dir', $this->getPath());
        $container->setParameter('frosh_advanced_tiny_mce.plugin_name', $this->getName());

        parent::build($container);
    }

    /**
     * @param InstallContext $context
     */
    public function install(InstallContext $context)
    {
        $schemaTool = new SchemaTool($this->container->get('models'));
        $schemaTool->updateSchema(
            $this->getClassesMetaData(),
            true // make sure to use the save mode
        );
    }

    /**
     * @param UninstallContext $context
     */
    public function uninstall(UninstallContext $context)
    {
        if (!$context->keepUserData()) {
            $schemaTool = new SchemaTool($this->container->get('models'));
            $schemaTool->dropSchema(
                $this->getClassesMetaData()
            );
        }
    }

    private function getClassesMetaData()
    {
        return [
            $this->container->get('models')->getClassMetadata(Template::class),
        ];
    }
}