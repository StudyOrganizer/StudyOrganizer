<?php
namespace ajax\V1\Rpc\Subjects;

class SubjectsControllerFactory
{
    public function __invoke($controllers)
    {
        return new SubjectsController();
    }
}
