<?php
namespace system\V1\Rest\Documents;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\ServiceManager\ServiceManager;

class DocumentsResource extends AbstractResourceListener
{
    protected $serviceManager;

    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        $token = $this->getToken();
        $em = $this->getDocumentsService()->getEntityManager();
        $user = $this->getDocumentsService()->getUserWithAuthMethod($token, $em);

        if(!$this->getDocumentsService()->isAuthMethodValid($token)) {
            return new ApiProblem(501, 'Currently it is not supported to return public documents');
        } else {

        }
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }

    /**
     * Gets the value of serviceManager.
     *
     * @return mixed
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Sets the value of serviceManager.
     *
     * @param mixed $serviceManager the service manager
     *
     * @return self
     */
    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    public function getDocumentsService()
    {
        return $this->getServiceManager()->get('Documents\V1\DocumentsService');
    }

    /**
     * @return array
     */
    public function createPaginator($user)
    {
        $collection_array = array();
        $documents = $this->getDocumentsService()->getDocuments($user);

        for ($i = 0; sizeof($messages) > $i; $i++) {

            $collection_array[$i] = array(
                "id" => $messages[$i]->getID(),
                "author_id" => $messages[$i]->getAuthor()->getUser()->getID(),
                "avatar" => $messages[$i]->getAuthor()->getUser()->getAvatar(),
                "username" => $messages[$i]->getAuthor()->getUser()->getUsername(),
                "firstname" => utf8_encode($messages[$i]->getAuthor()->getUser()->getFirstName()),
                "lastname" => utf8_encode($messages[$i]->getAuthor()->getUser()->getLastname()),
                "content" => utf8_encode($messages[$i]->getContent()),
                "hashtags" => $hashtags,
                "visible" => $messages[$i]->getVisible(),
                "updated" => $messages[$i]->getUpdated(),
                "remimberDate" => $messages[$i]->getRemimberDate(),
            );
        }
    }

        /**
     * @return null
     */
    public function getToken()
    {
        if ($this->getEvent()->getRequest()->getHeaders()->get("authorization")) {
            $token = $this->getEvent()->getRequest()->getHeaders()->get("authorization")->getFieldValue();
            return $token;
        } else {
            $token = null;
            return $token;
        }
    }
}
