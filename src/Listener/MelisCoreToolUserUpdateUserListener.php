<?php 

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisCore\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

use MelisCore\Listener\MelisCoreGeneralListener;

class MelisCoreToolUserUpdateUserListener extends MelisCoreGeneralListener implements ListenerAggregateInterface
{
	
    public function attach(EventManagerInterface $events)
    {
        $sharedEvents      = $events->getSharedManager();
        
        $callBackHandler = $sharedEvents->attach(
        	'MelisCore',
        	'meliscore_tooluser_save_start', 
        	function($e){

        		$sm = $e->getTarget()->getServiceLocator();
        		$melisCoreDispatchService = $sm->get('MelisCoreDispatch');
        		$container = new Container('meliscore');
        		
        		$request = $sm->get('request');
	            $postUser = $request->getPost();
	            $userId = null;
	            if (!empty($postUser['usr_id']))
	            	$userId = $postUser['usr_id'];
	
	            if (empty($container['action-tool-user-setrights-tmp']))
	            	$container['action-tool-user-setrights-tmp'] = array();
	            $melisCoreRights = $sm->get('MelisCoreRights');
	            $melisCoreRights = $melisCoreRights->createXmlRightsValues($userId, $postUser);
	            $container['action-tool-user-setrights-tmp'] = array_merge($container['action-tool-user-setrights-tmp'], $melisCoreRights);
	            	 
	            	
	            list($success, $errors, $data) = $melisCoreDispatchService->dispatchPluginAction(
	            	$e, 
	            	'meliscore',
	            	'action-tool-user-tmp', 
	            	'MelisCore\Controller\ToolUser', 
	            	array('action' => 'updateUserInfo')
				);
	                
				if(!$success)
					return;
        	},
        100);
        
        $this->listeners[] = $callBackHandler;
    }
}