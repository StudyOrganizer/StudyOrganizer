<?php
return array(
    'controllers' => array(
        'factories' => array(
            'ajax\\V1\\Rpc\\Subjects\\Controller' => 'ajax\\V1\\Rpc\\Subjects\\SubjectsControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'ajax.rest.messages' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/ajax/messages[/:messages_id]',
                    'defaults' => array(
                        'controller' => 'ajax\\V1\\Rest\\Messages\\Controller',
                    ),
                ),
            ),
            'ajax.rpc.subjects' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/ajax/subjects/list',
                    'defaults' => array(
                        'controller' => 'ajax\\V1\\Rpc\\Subjects\\Controller',
                        'action' => 'subjects',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            5 => 'ajax.rest.messages',
            0 => 'ajax.rpc.subjects',
        ),
    ),
    'zf-rpc' => array(
        'ajax\\V1\\Rpc\\Subjects\\Controller' => array(
            'service_name' => 'subjects',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'ajax.rpc.subjects',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'ajax\\V1\\Rest\\Messages\\Controller' => 'HalJson',
            'ajax\\V1\\Rpc\\Subjects\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'ajax\\V1\\Rest\\Messages\\Controller' => array(
                0 => 'application/vnd.ajax.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'ajax\\V1\\Rpc\\Subjects\\Controller' => array(
                0 => 'application/vnd.ajax.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'ajax\\V1\\Rest\\Messages\\Controller' => array(
                0 => 'application/vnd.ajax.v1+json',
                1 => 'application/json',
            ),
            'ajax\\V1\\Rpc\\Subjects\\Controller' => array(
                0 => 'application/vnd.ajax.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'ajax\\V1\\Rest\\Messages\\Controller' => array(
            'input_filter' => 'ajax\\V1\\Rest\\Messages\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'ajax\\V1\\Rpc\\Validate_username\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'username',
                'description' => 'username is required for validation',
            ),
        ),
        'ajax\\V1\\Rpc\\Username\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'username',
                'description' => 'need for validate',
            ),
        ),
        'ajax\\V1\\Rpc\\Email\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(
                            'message' => 'please supply valid email adress',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'email',
                'description' => 'need email to validate',
            ),
        ),
        'ajax\\V1\\Rpc\\Document_list\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'folder',
            ),
        ),
        'ajax\\V1\\Rest\\Messages\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '350',
                            'message' => 'wrong length',
                            'min' => '1',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'content',
                'description' => 'content',
                'error_message' => 'please provide valide content for message',
            ),
        ),
        'ajax\\V1\\Rpc\\Subjects\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'date',
            ),
        ),
    ),
    'zf-rest' => array(
        'ajax\\V1\\Rest\\Messages\\Controller' => array(
            'listener' => 'ajax\\V1\\Rest\\Messages\\MessagesResource',
            'route_name' => 'ajax.rest.messages',
            'route_identifier_name' => 'messages_id',
            'collection_name' => 'messages',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'ajax\\V1\\Rest\\Messages\\MessagesEntity',
            'collection_class' => 'ajax\\V1\\Rest\\Messages\\MessagesCollection',
            'service_name' => 'messages',
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'ajax\\V1\\Rest\\Messages\\MessagesEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'ajax.rest.messages',
                'route_identifier_name' => 'messages_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'ajax\\V1\\Rest\\Messages\\MessagesCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'ajax.rest.messages',
                'route_identifier_name' => 'messages_id',
                'is_collection' => true,
            ),
        ),
    ),
);
