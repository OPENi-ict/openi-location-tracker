<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\OpeniLocationTracker;

/**
 */
class OpeniLocationTracker extends \Piwik\Plugin
{
  public function getListHooksRegistered()
  {
    return array(
      'AssetManager.getJavaScriptFiles' => 'getJavaScriptFiles',
    );
  }
  public function getJavaScriptFiles(&$files)
  {
    $files[] = 'plugins/OpeniLocationTracker/javascripts/plugin.js';
  }

  public static $availableDimensionsForAggregation = array(
    'country'             => 'Country',
    'region'              => 'Region',
    'city'                => 'City'
    );
}
