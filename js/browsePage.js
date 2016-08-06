angular.module('browsePage', [])
.controller('pageCtrl', function ($scope, $http) {
  var url = Config.apiRoot + 'registration.php';
  $http({
    url: url,
    method: 'GET'
  })
  .success(function (data, status, headers, config) {
    var datum = getEventData(data);
    $scope.event_name = datum.event_name;
    datum.dates.push('2016/9/1');
    $scope.dates = datum.dates;
    $scope.participants = datum.participants;
  })
  .error(function (data, status, headers, config) {
    console.log('error!!');
  });
});

function getEventData(data) {
  // var href = window.location.href;
  var href = 'http://localhost/GitHub/yocho/event/xhialx6Ljc.php';
  var res = {};
  for (var i = 0;i < data.length;i++) {
    if (data[i]['url'] === href) {
      res = data[i];
      break;
    }
  }
  return res;
}
