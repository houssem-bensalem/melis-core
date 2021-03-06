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
use MelisCore\Service\MelisCoreEmailSendingService;

class MelisCoreEmailSendingServiceFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $sl)
	{
		$melisCoreEmailSendingService = new MelisCoreEmailSendingService();
		$melisCoreEmailSendingService->setServiceLocator($sl);
		
		return $melisCoreEmailSendingService;
	}

}