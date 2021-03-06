<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Cours extends \Application\Entity\Cours implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'id', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'name', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'desc', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'school', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'members', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'groups', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'subjects', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'subject_related_holders', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'principals', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'leads', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'notifications', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'dashboard_cards', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'homeworks', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'voc_stack', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'tests');
        }

        return array('__isInitialized__', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'id', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'name', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'desc', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'school', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'members', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'groups', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'subjects', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'subject_related_holders', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'principals', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'leads', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'notifications', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'dashboard_cards', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'homeworks', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'voc_stack', '' . "\0" . 'Application\\Entity\\Cours' . "\0" . 'tests');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Cours $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', array($id));

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', array());

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', array($name));

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getDesc()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDesc', array());

        return parent::getDesc();
    }

    /**
     * {@inheritDoc}
     */
    public function setDesc($desc)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDesc', array($desc));

        return parent::setDesc($desc);
    }

    /**
     * {@inheritDoc}
     */
    public function getSchool()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSchool', array());

        return parent::getSchool();
    }

    /**
     * {@inheritDoc}
     */
    public function setSchool($school)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSchool', array($school));

        return parent::setSchool($school);
    }

    /**
     * {@inheritDoc}
     */
    public function getMembers()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMembers', array());

        return parent::getMembers();
    }

    /**
     * {@inheritDoc}
     */
    public function setMembers($members)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMembers', array($members));

        return parent::setMembers($members);
    }

    /**
     * {@inheritDoc}
     */
    public function getGroups()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroups', array());

        return parent::getGroups();
    }

    /**
     * {@inheritDoc}
     */
    public function setGroups($groups)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGroups', array($groups));

        return parent::setGroups($groups);
    }

    /**
     * {@inheritDoc}
     */
    public function addGroup(\Application\Entity\CoursGroup $group)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addGroup', array($group));

        return parent::addGroup($group);
    }

    /**
     * {@inheritDoc}
     */
    public function addGroups($groups)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addGroups', array($groups));

        return parent::addGroups($groups);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrincipals()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrincipals', array());

        return parent::getPrincipals();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrincipals($principals)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrincipals', array($principals));

        return parent::setPrincipals($principals);
    }

    /**
     * {@inheritDoc}
     */
    public function getLeads()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLeads', array());

        return parent::getLeads();
    }

    /**
     * {@inheritDoc}
     */
    public function setLeads($leads)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLeads', array($leads));

        return parent::setLeads($leads);
    }

    /**
     * {@inheritDoc}
     */
    public function getNotifications()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNotifications', array());

        return parent::getNotifications();
    }

    /**
     * {@inheritDoc}
     */
    public function setNotifications($notifications)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNotifications', array($notifications));

        return parent::setNotifications($notifications);
    }

    /**
     * {@inheritDoc}
     */
    public function getDashboardCards()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDashboardCards', array());

        return parent::getDashboardCards();
    }

    /**
     * {@inheritDoc}
     */
    public function setDashboardCards($dashboard_cards)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDashboardCards', array($dashboard_cards));

        return parent::setDashboardCards($dashboard_cards);
    }

    /**
     * {@inheritDoc}
     */
    public function addDashboardCard(\Application\Entity\StudentUIDashboardCard $card)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addDashboardCard', array($card));

        return parent::addDashboardCard($card);
    }

    /**
     * {@inheritDoc}
     */
    public function addDashboardCards($cards)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addDashboardCards', array($cards));

        return parent::addDashboardCards($cards);
    }

    /**
     * {@inheritDoc}
     */
    public function getSubjects()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSubjects', array());

        return parent::getSubjects();
    }

    /**
     * {@inheritDoc}
     */
    public function setSubjects($subjects)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSubjects', array($subjects));

        return parent::setSubjects($subjects);
    }

    /**
     * {@inheritDoc}
     */
    public function addSubject(\Application\Entity\Subject $subject)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSubject', array($subject));

        return parent::addSubject($subject);
    }

    /**
     * {@inheritDoc}
     */
    public function getHomeworks()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHomeworks', array());

        return parent::getHomeworks();
    }

    /**
     * {@inheritDoc}
     */
    public function setHomeworks($homeworks)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHomeworks', array($homeworks));

        return parent::setHomeworks($homeworks);
    }

    /**
     * {@inheritDoc}
     */
    public function getSubjectRelatedHolders()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSubjectRelatedHolders', array());

        return parent::getSubjectRelatedHolders();
    }

    /**
     * {@inheritDoc}
     */
    public function setSubjectRelatedHolders($subject_releated_holders)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSubjectRelatedHolders', array($subject_releated_holders));

        return parent::setSubjectRelatedHolders($subject_releated_holders);
    }

    /**
     * {@inheritDoc}
     */
    public function getTests()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTests', array());

        return parent::getTests();
    }

    /**
     * {@inheritDoc}
     */
    public function setTests($tests)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTests', array($tests));

        return parent::setTests($tests);
    }

}
