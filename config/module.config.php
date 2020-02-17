<?php
/**
 * module.config.php - Article Number Config
 *
 * Main Config File for Article Number Plugin
 *
 * @category Config
 * @package Article\Number
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace OnePlace\Article\Number\Autoincrement;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    # Articlerequest Module - Routes
    'router' => [
        'routes' => [
            'article-number-autoincrement-setup' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/article/number/setup[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\InstallController::class,
                        'action'     => 'checkdb',
                    ],
                ],
            ],
        ],
    ],

    # View Settings
    'view_manager' => [
        'template_path_stack' => [
            'article-number-autoincrement' => __DIR__ . '/../view',
        ],
    ],
];
