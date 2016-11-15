<?php

namespace system\V1\Rpc\Avatar;

use Zend\Mvc\Controller\AbstractActionController;

class AvatarController extends AbstractActionController
{
    public function avatarAction()
    {
        $response = $this->getResponse();
        $file = $this->params()->fromRoute('hash');
        $size = $this->params()->fromRoute('option');

        if (file_exists(getcwd().'/user_data/avatars/'.$file.'.png') || file_exists(getcwd().'/user_data/avatars/'.$file.'.svg') || file_exists(getcwd().'/user_data/avatars/'.$file.'.jpg')) {
            if (file_exists(getcwd().'/user_data/avatars/'.$file.'.png')) {
                $imageContent = new \Imagick(getcwd().'/user_data/avatars/'.$file.'.png');
            } else if (file_exists(getcwd().'/user_data/avatars/'.$file.'.svg')) {
                $imageContent = new \Imagick(getcwd().'/user_data/avatars/'.$file.'.svg');
            } else {
                $imageContent = new \Imagick(getcwd().'/user_data/avatars/'.$file.'.jpg');
            }

            if (isset($size)) {
                if ($size < 500) {
                    $imageContent->resizeImage($size, $size, \imagick::FILTER_LANCZOS, 1);
                } else {
                    $imageContent->resizeImage(500, 500, \imagick::FILTER_LANCZOS, 1);
                }
            } else {
                $imageContent->resizeImage(128, 128, \imagick::FILTER_LANCZOS, 1);
            }

            $imageContent->setImageFormat('jpeg');
            $imageContent->setBackgroundColor(new \ImagickPixel('transparent'));

            $response->setContent($imageContent);
            $response
            ->getHeaders()
            ->addHeaderLine('Accept-Ranges', "bytes")
            ->addHeaderLine('Access-Control-Allow-Origin', "*")
            ->addHeaderLine('Cache-Control', "max-age=300")
            ->addHeaderLine('Content-Length', $imageContent->getImageLength())
            ->addHeaderLine('Content-type', "image/jpeg");


            return $response;
        }

        $imageContent = new \Imagick(getcwd().'/user_data/avatars/default.svg');

        if (isset($size)) {
            if ($size < 500) {
                $imageContent->resizeImage($size, $size, \imagick::FILTER_LANCZOS, 1);
            } else {
                $imageContent->resizeImage(500, 500, \imagick::FILTER_LANCZOS, 1);
            }
        } else {
            $imageContent->resizeImage(128, 128, \imagick::FILTER_LANCZOS, 1);
        }

        $imageContent->setImageFormat('jpeg');
        $imageContent->setBackgroundColor(new \ImagickPixel('transparent'));

        $response->setContent($imageContent);
        $response
        ->getHeaders()
        ->addHeaderLine('Accept-Ranges', "bytes")
        ->addHeaderLine('Access-Control-Allow-Origin', "*")
        ->addHeaderLine('Cache-Control', "max-age=300")
        ->addHeaderLine('Content-Length', $imageContent->getImageLength())
        ->addHeaderLine('Content-type', "image/jpeg");

        return $response;
    }
}
