<?php
/**
 * tinify plugin for Craft CMS 3.x
 *
 * A plugin to convert assets using tinyPng
 *
 * @link      https://www.alexkilian.com
 * @copyright Copyright (c) 2019 Alexandre Kilian
 */

namespace alexk\tinify\twigextensions;

use alexk\tinify\Tinify;

use Craft;
use craft\elements\Asset;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    Alexandre Kilian
 * @package   Tinify
 * @since     1.0.0
 */
class TinifyTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Tinify';
    }

    /**
     * Returns an array of Twig filters, used in Twig templates via:
     *
     *      {{ 'something' | someFilter }}
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('someFilter', [$this, 'someInternalFunction']),
        ];
    }

    /**
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% set this = someFunction('something') %}
     *
    * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('tinify', [$this, 'tinify']),
        ];
    }

    /**
     * Our function called via Twig; it can do anything you want
     *
     * @param null $text
     *
     * @return string
     */
    public function tinify($url, $resizeOptions = null)
    {

        return Tinify::getInstance()->tinify->tinifyAsset($url, $resizeOptions);

    }
}
