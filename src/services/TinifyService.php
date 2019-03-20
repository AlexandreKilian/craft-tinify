<?php
/**
 * tinify plugin for Craft CMS 3.x
 *
 * A plugin to convert assets using tinyPng
 *
 * @link      https://www.alexkilian.com
 * @copyright Copyright (c) 2019 Alexandre Kilian
 */

namespace alexk\tinify\services;

use alexk\tinify\Tinify;

use Tinify as TinifyApi;

use Yii;
use Craft;
use craft\base\Component;
use craft\elements\Asset;
use craft\helpers\Assets as AssetsHelper;
use craft\helpers\UrlHelper;
/**
 * TinifyService Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Alexandre Kilian
 * @package   Tinify
 * @since     1.0.0
 */
class TinifyService extends Component
{

    public function __construct()
    {
        TinifyApi\setKey(Tinify::getInstance()->settings->tinifyApiKey);
    }

    /**
     *
     * @return mixed
     */
    public function tinifyAsset(Asset $asset, $resizeOptions = null)
    {

        $volumePath = $asset->getVolume()->settings['path'];
        $folderPath = $asset->getFolder()->path;
        $assetFilePath = Yii::getAlias($volumePath) . $folderPath . '/' . $asset->filename;
        $tinyPath = Yii::getAlias(Tinify::getInstance()->settings->sourceDir) . $folderPath . '/' . $asset->filename;

        $webPath = Yii::getAlias(Tinify::getInstance()->settings->publicDir)  . $folderPath  . '/' . $asset->filename;
        if(!is_dir(dirname($tinyPath))){
            mkdir(dirname($tinyPath), 0755, true);
        }
        if(!is_file($tinyPath)){
            $tiny = TinifyApi\fromFile($assetFilePath);
            if($resize){
                $tiny->resize($resizeOptions);
            }
            $tiny->toFile($tinyPath);
        }
        return $webPath;

    }
}
