<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\OpeniLocationTracker;

use Piwik\DataTable;
use Piwik\DataTable\Row;

/**
 * API for plugin OpeniLocationTracker
 *
 * @method static \Piwik\Plugins\OpeniLocationTracker\API getInstance()
 */
class API extends \Piwik\Plugin\API
{

    /**
     * Another example method that returns a data table.
     * @param int    $idSite
     * @param string $period
     * @param string $date
     * @param bool|string $segment
     * @return DataTable
     */
    public function trackByLocation($idSite, $period, $date, $segment = false)
    {
        $data = \Piwik\Plugins\Live\API::getInstance()->getLastVisitsDetails(
          $idSite,
          $period,
          $date,
          $segment,
          $numLastVisitorsToFetch = 100,
          $minTimestamp = false,
          $flat = false,
          $doNotFetchActions = true
        );
        $data->applyQueuedFilters();

        $result = $data->getEmptyClone($keepFilters = false);

        foreach ($data->getRows() as $visitRow) {
            $locationName = $visitRow->getColumn('country');
            $locationRow = $result->getRowFromLabel($locationName);

          if ($locationRow === false) {
            $result->addRowFromSimpleArray(array(
              'label' => $locationName,
              'nb_visits' => 1
            ));
          } else {
            $counter = $locationRow->getColumn('nb_visits');
            $locationRow->setColumn('nb_visits', $counter + 1);
          }
        }

        return $result;
    }
}
