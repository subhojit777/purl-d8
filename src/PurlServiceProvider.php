<?php

namespace Drupal\purl;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Drupal\purl\Routing\PurlRouteProvider;
use Drupal\purl\Utility\PurlAwareUnroutedUrlAssembler;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class PurlServiceProvider.
 */
class PurlServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    $urlGeneratorDefinition = $container->getDefinition('url_generator');
    $urlGeneratorDefinition->replaceArgument(0, new Reference('purl.url_generator'));

    $assemblerDefinition = $container->getDefinition('unrouted_url_assembler');
    $assemblerDefinition->setClass(PurlAwareUnroutedUrlAssembler::class);
    $assemblerDefinition->addArgument(new Reference('purl.context_helper'));
    $assemblerDefinition->addArgument(new Reference('purl.matched_modifiers'));

    $routerDefinition = $container->getDefinition('router.route_provider');
    $routerDefinition->setClass(PurlRouteProvider::class);
    $routerDefinition->addArgument(new Reference('database'));
    $routerDefinition->addArgument(new Reference('state'));
    $routerDefinition->addArgument(new Reference('path.current'));
    $routerDefinition->addArgument(new Reference('cache.data'));
    $routerDefinition->addArgument(new Reference('path_processor_manager'));
    $routerDefinition->addArgument(new Reference('cache_tags.invalidator'));
    $routerDefinition->addArgument('table');
    $routerDefinition->addArgument(NULL);
    $routerDefinition->addArgument(new Reference('purl.context_helper'));
    $routerDefinition->addArgument(new Reference('purl.matched_modifiers'));
  }

}
