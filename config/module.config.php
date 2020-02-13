<?php
/**
 * module.config.php - Autoincrement Config
 *
 * Main Config File for Article Autoincrement Plugin
 *
 * @category Config
 * @package Article\Number\Autoincrement
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
    # Autoincrement Module - Routes
    'router' => [
        'routes' => [
            'article-number-autoincrement-setup' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/article/number/autoincrement/setup',
                    'defaults' => [
                        'controller' => Controller\InstallController::class,
                        'action'     => 'checkdb',
                    ],
                ],
            ],
        ],
    ], # Routes

    # View Settings
    'view_manager' => [
        'template_path_stack' => [
            'article-number-autoincrement' => __DIR__ . '/../view',
        ],
    ],
];
