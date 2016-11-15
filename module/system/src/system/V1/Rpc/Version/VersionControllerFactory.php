<?php

namespace system\V1\Rpc\Version;

class VersionControllerFactory
{
    public function __invoke()
    {
        return new VersionController();
    }
}
