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
    $scope.input = function() {
      var name = this.name;
      $('#name').text(name + 'の希望日を入力');
      var selecttag = '<select><option>-</option><option>o</option><option>x</option></select>'
      for (var i = 0;i < $scope.dates.length;i++) {
        $('.date-area').append('<p class="date">' + $scope.dates[i] + ':' + selecttag + '</p>')
      }
      $("body").append('<div id="modal-bg"></div>');

      modalResize();

      $("#modal-bg,#modal-input").fadeIn("normal");

      $("#cancel").click(function(){
        $("#modal-input,#modal-bg").fadeOut("normal",function(){
          $('.date').remove();
          $('#modal-bg').remove();
        });
      });

      $(window).resize(modalResize);
      function modalResize(){

        var w = $(window).width();
        var h = $(window).height();

        var cw = $("#modal-input").outerWidth();
        var ch = $("#modal-input").outerHeight();

        $("#modal-input").css({
          "left": ((w - cw)/2) + "px",
          "top": ((h - ch)/2) + "px"
        });
      }
    };
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
