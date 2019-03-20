<?php
/**
 * tinify plugin for Craft CMS 3.x
 *
 * A plugin to convert assets using tinyPng
 *
 * @link      https://www.alexkilian.com
 * @copyright Copyright (c) 2019 Alexandre Kilian
 */

namespace alexk\tinify\models;

use alexk\tinify\Tinify;

use Craft;
use craft\base\Model;

/**
 * Tinify Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Alexandre Kilian
 * @package   Tinify
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Some field model attribute
     *
     * @var string
     */
    public $tinifyApiKey = '';
    public $sourceDir = '@webroot/_tiny';
    public $publicDir = '@web/_tiny';
    public $type = 'local';

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['tinifyApiKey', 'string'],
            ['tinifyApiKey', 'default', 'value' => ''],
        ];
    }
}
