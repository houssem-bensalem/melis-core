<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisCore\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use MelisCore\Service\MelisCoreRightsService;

class MelisCoreRightsServiceFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $sl)
	{
		$melisCoreRightsService = new MelisCoreRightsService();
		$melisCoreRightsService->setServiceLocator($sl);
		
		return $melisCoreRightsService;
	}

}