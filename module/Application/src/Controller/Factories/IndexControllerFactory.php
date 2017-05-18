<?php 
namespace Application\Controller\Factories;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
/**
 * This is the factory for PostController. Its purpose is to instantiate the
 * controller.
 */
class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $authenticationService = $container->get('doctrine.authenticationservice.orm_default');
        return new $requestedName($entityManager, $authenticationService);
   }
}
