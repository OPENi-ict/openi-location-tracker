$(document).ready(function() {
  setInterval(function() {
    var $dataTableRoot = $('.dataTable[data-report="OpeniLocationTracker.trackByLocation"]');
    //alert($dataTableRoot);
    var dataTableInstance = $dataTableRoot.data('uiControlObject');
    dataTableInstance.resetAllFilters();
    dataTableInstance.reloadAjaxDataTable();
  }, 10 * 1000);
});