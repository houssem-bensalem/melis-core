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
use MelisCore\Service\MelisCoreFlashMessengerService;

class MelisCoreFlashmessengerServiceFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $sl)
	{
		$melisCoreFlashMessenger = new MelisCoreFlashMessengerService();
		$melisCoreFlashMessenger->setServiceLocator($sl);
		
		return $melisCoreFlashMessenger;
	}

}