<?php
return array(
    'controllers' => array(
        'factories' => array(
            'system\\V1\\Rpc\\Version\\Controller' => 'system\\V1\\Rpc\\Version\\VersionControllerFactory',
            'system\\V1\\Rpc\\Avatar\\Controller' => 'system\\V1\\Rpc\\Avatar\\AvatarControllerFactory',
            'system\\V1\\Rpc\\Login\\Controller' => 'system\\V1\\Rpc\\Login\\LoginControllerFactory',
            'system\\V1\\Rpc\\Upload\\Controller' => 'system\\V1\\Rpc\\Upload\\UploadControllerFactory',
            'system\\V1\\Rpc\\Userdetails\\Controller' => 'system\\V1\\Rpc\\Userdetails\\UserdetailsControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'system.rpc.version' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/version',
                    'defaults' => array(
                        'controller' => 'system\\V1\\Rpc\\Version\\Controller',
                        'action' => 'version',
                    ),
                ),
            ),
            'system.rpc.avatar' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/avatar/[:hash]/[:option]',
                    'defaults' => array(
                        'controller' => 'system\\V1\\Rpc\\Avatar\\Controller',
                        'action' => 'avatar',
                    ),
                ),
            ),
            'system.rpc.login' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/auth',
                    'defaults' => array(
                        'controller' => 'system\\V1\\Rpc\\Login\\Controller',
                        'action' => 'login',
                    ),
                ),
            ),
            'system.rpc.upload' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/upload',
                    'defaults' => array(
                        'controller' => 'system\\V1\\Rpc\\Upload\\Controller',
                        'action' => 'upload',
                    ),
                ),
            ),
            'system.rpc.userdetails' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/user/details',
                    'defaults' => array(
                        'controller' => 'system\\V1\\Rpc\\Userdetails\\Controller',
                        'action' => 'userdetails',
                    ),
                ),
            ),
            'system.rest.documents' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/documents[/:documents_id]',
                    'defaults' => array(
                        'controller' => 'system\\V1\\Rest\\Documents\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'system.rpc.version',
            1 => 'system.rpc.avatar',
            4 => 'system.rpc.login',
            5 => 'system.rpc.upload',
            6 => 'system.rpc.userdetails',
            9 => 'system.rest.documents',
        ),
    ),
    'zf-rpc' => array(
        'system\\V1\\Rpc\\Version\\Controller' => array(
            'service_name' => 'version',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'system.rpc.version',
        ),
        'system\\V1\\Rpc\\Avatar\\Controller' => array(
            'service_name' => 'Avatar',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'system.rpc.avatar',
        ),
        'system\\V1\\Rpc\\Login\\Controller' => array(
            'service_name' => 'login',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'system.rpc.login',
        ),
        'system\\V1\\Rpc\\Upload\\Controller' => array(
            'service_name' => 'upload',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'system.rpc.upload',
        ),
        'system\\V1\\Rpc\\Userdetails\\Controller' => array(
            'service_name' => 'userdetails',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'system.rpc.userdetails',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'system\\V1\\Rpc\\Version\\Controller' => 'Json',
            'system\\V1\\Rpc\\Avatar\\Controller' => 'Json',
            'system\\V1\\Rpc\\Login\\Controller' => 'Json',
            'system\\V1\\Rpc\\Upload\\Controller' => 'Json',
            'system\\V1\\Rpc\\Userdetails\\Controller' => 'Json',
            'system\\V1\\Rest\\Documents\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'system\\V1\\Rpc\\Version\\Controller' => array(
                0 => 'application/vnd.system.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'system\\V1\\Rpc\\Avatar\\Controller' => array(
                0 => 'image/*',
                1 => 'application/*',
                2 => 'text/*',
                3 => 'android/*',
            ),
            'system\\V1\\Rpc\\Login\\Controller' => array(
                0 => 'application/vnd.system.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'system\\V1\\Rpc\\Upload\\Controller' => array(
                0 => 'application/vnd.system.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'system\\V1\\Rpc\\Userdetails\\Controller' => array(
                0 => 'application/vnd.system.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'system\\V1\\Rest\\Documents\\Controller' => array(
                0 => 'application/vnd.system.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'system\\V1\\Rpc\\Version\\Controller' => array(
                0 => 'application/vnd.system.v1+json',
                1 => 'application/json',
            ),
            'system\\V1\\Rpc\\Avatar\\Controller' => array(
                0 => 'image/*',
                1 => 'application/*',
                2 => 'text/*',
                3 => 'android/*',
            ),
            'system\\V1\\Rpc\\Login\\Controller' => array(
                0 => 'application/vnd.system.v1+json',
                1 => 'application/json',
            ),
            'system\\V1\\Rpc\\Upload\\Controller' => array(
                0 => 'application/vnd.system.v1+json',
                1 => 'application/json',
            ),
            'system\\V1\\Rpc\\Userdetails\\Controller' => array(
                0 => 'application/vnd.system.v1+json',
                1 => 'application/json',
            ),
            'system\\V1\\Rest\\Documents\\Controller' => array(
                0 => 'application/vnd.system.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'system\\V1\\Rpc\\Version\\Controller' => array(
            'input_filter' => 'system\\V1\\Rpc\\Version\\Validator',
        ),
        'system\\V1\\Rpc\\Upload\\Controller' => array(
            'input_filter' => 'system\\V1\\Rpc\\Upload\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'system\\V1\\Rpc\\Version\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'version',
                'description' => 'return version of SO (e.g. for matching features with apps)',
            ),
        ),
        'system\\V1\\Rpc\\Document_upload\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\File\\MimeType',
                        'options' => array(
                            'mimeType' => 'application/pdf',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'file',
                'type' => 'Zend\\InputFilter\\FileInput',
                'description' => 'file',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'name',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'allow_empty' => true,
                'name' => 'homework_id',
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'test_id',
                'allow_empty' => true,
            ),
            4 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'desc',
                'allow_empty' => true,
            ),
        ),
        'system\\V1\\Rpc\\Document_only_file_upload\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\File\\MimeType',
                        'options' => array(
                            'mimeType' => 'application/pdf',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'file',
            ),
        ),
        'system\\V1\\Rpc\\Upload\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\File\\RenameUpload',
                        'options' => array(
                            'randomize' => true,
                            'target' => '/tmp/data',
                        ),
                    ),
                ),
                'type' => 'Zend\\InputFilter\\FileInput',
                'name' => 'file',
                'description' => '',
                'error_message' => 'invalid file supplied',
            ),
            1 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '3',
                            'max' => '40',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'name',
                'allow_empty' => true,
                'continue_if_empty' => true,
                'description' => 'optional filename',
                'error_message' => 'wrong name supplied',
            ),
            2 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '2000',
                            'min' => '5',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'description',
                'description' => 'optional description',
                'allow_empty' => true,
                'continue_if_empty' => true,
                'error_message' => 'wrong description supplied',
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'typ',
                'continue_if_empty' => false,
                'allow_empty' => false,
            ),
            4 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'document_author',
                'continue_if_empty' => true,
                'allow_empty' => true,
            ),
            5 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'document_title',
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            6 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'document_copyright',
                'continue_if_empty' => true,
                'allow_empty' => true,
            ),
        ),
    ),
    'zf-rest' => array(
        'system\\V1\\Rest\\Documents\\Controller' => array(
            'listener' => 'system\\V1\\Rest\\Documents\\DocumentsResource',
            'route_name' => 'system.rest.documents',
            'route_identifier_name' => 'documents_id',
            'collection_name' => 'documents',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'system\\V1\\Rest\\Documents\\DocumentsEntity',
            'collection_class' => 'system\\V1\\Rest\\Documents\\DocumentsCollection',
            'service_name' => 'documents',
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'system\\V1\\Rest\\Documents\\DocumentsEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'system.rest.documents',
                'route_identifier_name' => 'documents_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'system\\V1\\Rest\\Documents\\DocumentsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'system.rest.documents',
                'route_identifier_name' => 'documents_id',
                'is_collection' => true,
            ),
        ),
    ),
);
