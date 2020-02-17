<?php
/**
 * Module.php - Module Class
 *
 * Module Class File for Article Number Plugin
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

use Application\Controller\CoreEntityController;
use Laminas\Mvc\MvcEvent;
use Laminas\EventManager\EventInterface as Event;
use Laminas\ModuleManager\ModuleManager;
use Laminas\Db\Adapter\AdapterInterface;
use OnePlace\Article\Number\Autoincrement\Controller\NumberController;

class Module {
    /**
     * Module Version
     *
     * @since 1.0.0
     */
    const VERSION = '1.0.1';

    /**
     * Load module config file
     *
     * @since 1.0.0
     * @return array
     */
    public function getConfig() : array {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(Event $e)
    {
        // This method is called once the MVC bootstrapping is complete
        $application = $e->getApplication();
        $container    = $application->getServiceManager();
        $oDbAdapter = $container->get(AdapterInterface::class);
        $tableGateway = $container->get(\OnePlace\Article\Model\ArticleTable::class);

        # Register Filter Plugin Hook
        CoreEntityController::addHook('article-add-before-save',(object)['sFunction'=>'generateArticleNumber','oItem'=>new NumberController($oDbAdapter,$tableGateway,$container)]);
    }

    /**
     * Load Controllers
     */
    public function getControllerConfig() : array {
        return [
            'factories' => [
                # Plugin Example Controller
                Controller\NumberController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    $tableGateway = $container->get(\OnePlace\Article\Model\ArticleTable::class);

                    return new Controller\NumberController(
                        $oDbAdapter,
                        $tableGateway,
                        $container
                    );
                },
                # Plugin Install Controller
                Controller\InstallController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    $tableGateway = $container->get(\OnePlace\Article\Model\ArticleTable::class);

                    return new Controller\InstallController(
                        $oDbAdapter,
                        $tableGateway,
                        $container
                    );
                },
            ],
        ];
    }
}
