<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Student extends \Application\Entity\Student implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'id', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'user', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'school', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'courses_member', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'dashboard_cards', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'author_card', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'courses_lead', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'lead');
        }

        return array('__isInitialized__', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'id', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'user', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'school', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'courses_member', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'dashboard_cards', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'author_card', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'courses_lead', '' . "\0" . 'Application\\Entity\\Student' . "\0" . 'lead');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Student $proxy) {
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
    public function getUser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUser', array());

        return parent::getUser();
    }

    /**
     * {@inheritDoc}
     */
    public function setUser($user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUser', array($user));

        return parent::setUser($user);
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
    public function getCourses()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCourses', array());

        return parent::getCourses();
    }

    /**
     * {@inheritDoc}
     */
    public function setCourses($courses)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCourses', array($courses));

        return parent::setCourses($courses);
    }

    /**
     * {@inheritDoc}
     */
    public function addCours(\Application\Entity\Cours $cours)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCours', array($cours));

        return parent::addCours($cours);
    }

    /**
     * {@inheritDoc}
     */
    public function addCourses($courses)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCourses', array($courses));

        return parent::addCourses($courses);
    }

    /**
     * {@inheritDoc}
     */
    public function addStudentUICard(\Application\Entity\StudentUIDashboardCard $dashboard_card)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addStudentUICard', array($dashboard_card));

        return parent::addStudentUICard($dashboard_card);
    }

    /**
     * {@inheritDoc}
     */
    public function addStudentUICards($dashboard_cards)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addStudentUICards', array($dashboard_cards));

        return parent::addStudentUICards($dashboard_cards);
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
    public function getAuthorCard()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAuthorCard', array());

        return parent::getAuthorCard();
    }

    /**
     * {@inheritDoc}
     */
    public function setAuthorCard($author_card)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAuthorCard', array($author_card));

        return parent::setAuthorCard($author_card);
    }

    /**
     * {@inheritDoc}
     */
    public function getCoursesMember()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCoursesMember', array());

        return parent::getCoursesMember();
    }

    /**
     * {@inheritDoc}
     */
    public function setCoursesMember($courses_member)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCoursesMember', array($courses_member));

        return parent::setCoursesMember($courses_member);
    }

    /**
     * {@inheritDoc}
     */
    public function getCoursesLead()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCoursesLead', array());

        return parent::getCoursesLead();
    }

    /**
     * {@inheritDoc}
     */
    public function setCoursesLead($courses_lead)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCoursesLead', array($courses_lead));

        return parent::setCoursesLead($courses_lead);
    }

    /**
     * {@inheritDoc}
     */
    public function getLead()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLead', array());

        return parent::getLead();
    }

    /**
     * {@inheritDoc}
     */
    public function setLead($lead)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLead', array($lead));

        return parent::setLead($lead);
    }

}
