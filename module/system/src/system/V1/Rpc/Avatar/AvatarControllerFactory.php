<?php

namespace system\V1\Rpc\Avatar;

class AvatarControllerFactory
{
    public function __invoke($controllers)
    {
        return new AvatarController();
    }
}
