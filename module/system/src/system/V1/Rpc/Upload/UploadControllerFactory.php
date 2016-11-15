<?php
namespace system\V1\Rpc\Upload;

class UploadControllerFactory
{
    public function __invoke($controllers)
    {
        return new UploadController();
    }
}
