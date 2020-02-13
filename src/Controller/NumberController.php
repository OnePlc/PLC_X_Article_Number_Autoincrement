<?php
/**
 * NumberController.php - Main Controller
 *
 * Main Controller Article Number Plugin
 *
 * @category Controller
 * @package Article\Number
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace OnePlace\Article\Number\Controller;

use Application\Controller\CoreEntityController;
use Application\Model\CoreEntityModel;
use OnePlace\Article\Model\ArticleTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class NumberController extends CoreEntityController {
    /**
     * Worktime Table Object
     *
     * @since 1.0.0
     */
    protected $oTableGateway;

    /**
     * WorktimeController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param WorktimeTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,ArticleTable $oTableGateway,$oServiceManager) {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'article-single';
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);

        if($oTableGateway) {
            # Attach TableGateway to Entity Models
            if(!isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }

    public function generateArticleNumber($oArticle,$aRawFormData) {
        /**
         * Execute your hook code here
         *
         * optional: return an array to attach data to View
         * otherwise return true
         */

        $sArtNrPrefix = CoreEntityController::$aGlobalSettings['article-number-prefix'];
        $iCurrentNumber = CoreEntityController::$aGlobalSettings['article-number-current']+1;
        CoreEntityController::$aGlobalSettings['article-number-current'] = $iCurrentNumber;
        CoreEntityController::$aCoreTables['settings']->update(['settings_value'=>$iCurrentNumber],['settings_key'=>'article-number-current']);

        $oArticle->custom_art_nr = $sArtNrPrefix.$iCurrentNumber;

        return $oArticle;
    }
}
