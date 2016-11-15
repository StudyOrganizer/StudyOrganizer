<?php
namespace system\V1\Rpc\Userdetails;

class UserdetailsControllerFactory
{
    public function __invoke($controllers)
    {
        return new UserdetailsController();
    }
}
