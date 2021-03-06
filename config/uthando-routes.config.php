<?php

return [
    'router' => [
        'routes' => [
        	'admin' => [
        		'child_routes' => [
        			'dompdf' => [
        				'type'    => 'Segment',
        				'options' => [
        					'route'    => '/dompdf',
        					'defaults' => [
        						'__NAMESPACE__' => 'UthandoDomPdf\Controller',
        						'controller'    => 'Settings',
        						'action'        => 'index',
        					],
        				],
        				'may_terminate' => true,
        			],
        		],
        	],
        ],
    ],
];
