<?php
namespace ajax\V1\Rest\Messages;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\ServiceManager\ServiceManager;

class MessagesResource extends AbstractResourceListener
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
        //get token
        $token = $this->getToken();

        if(!$this->getMessagesService()->isAuthMethodValid($token)) {
            return new ApiProblem(401, 'Unauthorized');
        } else {
            $this->getMessagesService()->createMessage($data, $token, $this);
            return new ApiProblem(201, 'Created');
        }
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
        //get token
        $token = $this->getToken();
        $entity = $this->getMessagesService()->getMessage($id);

        if(!$this->getMessagesService()->isAuthMethodValid($token)) {
            return new ApiProblem(401, 'Unauthorized');
        } elseif($entity == null) {
            return new ApiProblem(404, 'Message not found ;(');
        } else {
            $messages = $this->createMessageEntityResponse($entity);
            return $messages;
        }
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        //get token
        $token = $this->getToken();
        $em = $this->getMessagesService()->getEntityManager();
        $user = $this->getMessagesService()->getUserWithAuthMethod($token, $em);

        if(!$this->getMessagesService()->isAuthMethodValid($token)) {
            return new ApiProblem(401, 'Unauthorized');
        } else {
            $collection_array = $this->createPaginator($user);
            $collection = new MessagesCollection(new \Zend\Paginator\Adapter\ArrayAdapter($collection_array));
            return $collection;
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
    
    public function getMessagesService()
    {
        return $this->getServiceManager()->get('Messages\V1\MessagesService');
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

    /**
     * @return array
     */
    public function createPaginator($user)
    {
        $collection_array = array();
        $messages = $this->getMessagesService()->getMessages($user);

        for ($i = 0; sizeof($messages) > $i; $i++) {
            $hashtags = array();
            for ($d = 0; $messages[$i]->getHashtags()->count() > $d; $d++) {
                $hashtags[$d] = trim($messages[$i]->getHashtags()->get($d)->getName());
            }

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
        return $collection_array;
    }

    /**
     * @param $entity
     * @return MessagesEntity
     */
    public function createMessageEntityResponse($entity)
    {
        $hashtags = array();
        for ($i = 0; $entity->getHashtags()->count() > $i; $i++) {
            $hashtags[$i] = trim($entity->getHashtags()->get($i)->getName());
        }
        $messages = new MessagesEntity();
        $messages->setID($entity->getID());
        $messages->setContent($entity->getContent());
        $messages->setRemimberDate($entity->getRemimberDate());
        $messages->setUpdated($entity->getUpdated());
        $messages->setVisible($entity->getVisible());
        $messages->setFirstname(utf8_encode($entity->getAuthor()->getUser()->getFirstname()));
        $messages->setHashtags($hashtags);
        $messages->setEmail(md5(utf8_encode($entity->getAuthor()->getUser()->getEmail())));
        $messages->setLastname(utf8_encode($entity->getAuthor()->getUser()->getLastname()));
        $messages->setUsername($entity->getAuthor()->getUser()->getUsername());
        $messages->setAuthor_id($entity->getAuthor()->getUser()->getID());
        return $messages;
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
