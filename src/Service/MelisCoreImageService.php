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
class MelisCoreImageService implements ServiceLocatorAwareInterface, MelisCoreImageServiceInterface 
{
    
    public $serviceLocator;
    
    public function setServiceLocator(ServiceLocatorInterface $sl)
    {
        $this->serviceLocator = $sl;
        return $this;
    }
    
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
    
    /**
     * Creates a 50x50 image thumbnail
     * @param String $savePath
     * @param String $newImageName
     * @param String $srcImageFile
     * 
     * @return String
     */
    public function createThumbnail($savePath, $newImageName, $srcImageFile)
    {
        $getImageFile = $this->resizeImage($savePath, $srcImageFile, 'tmb_'.$newImageName, 50, 50);
        
        return $getImageFile;
    }
    
    /**
     * Resizes an image
     * @param String $savePath
     * @param String $image
     * @param String $newImageName
     * @param int $width
     * @param int $height
     */
    protected function resizeImage($savePath, $image, $newImageName, $width, $height) 
    {
        
        $fileImage = $image;
        //echo $fileImage;
        $outputImg = null;

        $thumb = imagecreatetruecolor($width, $height);
        list($w, $h) = getimagesize($fileImage);

        switch(exif_imagetype($fileImage)) {
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($fileImage);
            break;
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($fileImage);
            break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($fileImage);
            break;
        }
        
        imagecopyresampled($thumb, $image, 0, 0, 0, 0, $width, $height, $w, $h);

        $outputImg = imagejpeg($thumb, $savePath.$newImageName, 100);
        imagedestroy($thumb);
    
    }
}