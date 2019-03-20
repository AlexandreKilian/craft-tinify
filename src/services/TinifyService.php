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
    public function tinifyAsset($url)
    {

        $tinyPath = Yii::getAlias(Tinify::getInstance()->settings->sourceDir) . $url;
        $webPath = Yii::getAlias(Tinify::getInstance()->settings->publicDir) . $url;
        if(!is_dir(dirname($tinyPath))){
            mkdir(dirname($tinyPath), 0755, true);
        }
        if(!is_file($tinyPath)){
            if(Tinify::getInstance()->settings->type === 'local'){
                $tiny = TinifyApi\fromFile(Yii::getAlias('@webroot')  . $url)->toFile($tinyPath);
            } else {
                $tiny = TinifyApi\fromUrl($url)->toFile($tinyPath);
            }
        }
        return $webPath;

    }
}
