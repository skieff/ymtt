<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class FormBuilderCompilerPass implements CompilerPassInterface{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('app.utils.form_builder')) {
            return;
        }

        $definition = $container->findDefinition('app.utils.form_builder');

        foreach ($container->findTaggedServiceIds('app.goal_template') as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    'registerTemplateBuilder',
                    array($attributes['alias'], new Reference($id))
                );
            }
        }
    }
}