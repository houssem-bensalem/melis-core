<?php
/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisCore\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\Json\Json;
class MelisCoreFlashMessengerService implements ServiceLocatorAwareInterface, MelisCoreFlashMessengerServiceInterface
{
    
    const INFO = 'glyphicon glyphicon-info-sign';
    const WARNING = 'glyphicon glyphicon-warning-sign';
    /**
     * 
     * @var $serviceLocator ServiceLocatorInterface
     */
    public $serviceLocator;
    
    /**
     * 
     * @var $fmContainer Container
     */
    protected $fmContainer;
    

    public function setServiceLocator(ServiceLocatorInterface $sl)
    {
        $this->serviceLocator = $sl;
        return $this;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
    
    /*
     * Adds a new message in the Flash Messenger MVC helper, this will be displayed
     * in the Flash Messenger View in Melis CMS headers
     * @param String $text
     * @param String $img
     */
    public function addToFlashMessenger($title, $message, $img = 'glyphicon glyphicon-info-sign', $logDate = null)
    {
        $this->fmContainer = new Container('fms');
        
        $container = new Container('meliscore');
        $locale = $container['melis-login-lang-locale'];
        
        // create date time
        if(is_null($logDate)){
            $time = date('h:i A');
            $date = date('M d y');
        }else{
            $time = date('h:i A', strtotime($logDate));
            $date = date('M d y',  strtotime($logDate));
        }
        
        $translator = $this->getServiceLocator()->get('translator');
        $tool       = $this->getServiceLocator()->get('MelisCoreTool');

        $title      = $tool->escapeHtml($title);
        $message    = $tool->escapeHtml($message);
        
        $curFlashMessages = $this->fmContainer->flashMessages;
        $newFlashMessage = array(
            'title' => $translator->translate($title),
            'message'=> $translator->translate($message),
            'image'  => $img,
            'time' => $time,
            'date' => $date,
            'date_trans' => $this->dateMod($date, $locale),
        );
        
        if(!empty($curFlashMessages))
        {
            array_push($curFlashMessages, $newFlashMessage);
        }
        else 
        {
            $curFlashMessages[0] = $newFlashMessage;
        }
        
        $this->fmContainer->flashMessages = $curFlashMessages;
    }
    
    /**
     * Returns all the messages stored in Melis Flash Messenger
     * @return Json
     */
    public function getFlashMessengerMessages() 
    {
        $this->fmContainer = new Container('fms');
        $flashMessages = $this->fmContainer->flashMessages;
        
        if(!empty($flashMessages))
        {
            $flashMessages = array_reverse($flashMessages);
        }
        
        return Json::encode($flashMessages);
    }
    
    /**
     * Clears all the flash messages
     */
    public function clearFlashMessage()
    {
        $this->fmContainer = new Container('fms');
        $this->fmContainer->getManager()->getStorage()->clear('fms');
    }
    
    public function dateMod($date, $locale)
    {
    
        $translator = $this->serviceLocator->get('translator');
    
        $data = $date;
        $today = date('M d y');
        $yesterday = date('M d y', strtotime('yesterday'));
        
        switch($date){
            // date today
            case $today:
                $data = $translator->translate('tr_meliscore_date_today');
                break;
            case $yesterday:
                $data = $translator->translate('tr_meliscore_date_yesterday');
                break;
            default:
                $data = ($locale == 'fr_FR')? date('d M y', strtotime($date)) : date('M d y', strtotime($date));
        }
    
        return $data;
    }

}