angular.module('browsePage', [])
.controller('pageCtrl', function ($scope, $http) {
  var registrationapi = Config.apiRoot + 'registration.php';
  $http({
    url: registrationapi,
    method: 'GET'
  })
  .success(function (data, status, headers, config) {
    var datum = getEventData(data);
    $scope.event_id = datum.event_id;
    $scope.event_name = datum.event_name;
    $scope.dates = datum.dates;
    $scope.participants = datum.participants;
    $scope.input = function() {
      var id = this.event_id;
      var name = this.name;
      var dates = this.dates;
      $('#name').text(name + 'の希望日を入力');
      for (var i = 0;i < $scope.dates.length;i++) {
        var selecttag = '<select>' +
          '<option value="-"' + isSelected('-', name, i) + '>-</option>' +
          '<option value="o"' + isSelected('o', name, i) + '>o</option>' +
          '<option value="x"' + isSelected('x', name, i) + '>x</option>' +
          '</select>';
        $('.date-area').append('<p class="date">' + $scope.dates[i] + ':' + selecttag + '</p>')
      }
      $("body").append('<div id="modal-bg"></div>');
      $(".button-area").append('<button class="btn btn-success" id="submit">送信</bunnton>');
      $(".button-area").append('<button class="btn btn-danger" id="cancel">キャンセル</bunnton>');
      modalResize();

      $("#modal-bg,#modal-input").fadeIn("normal");
      $("#submit").click(function () {
        var d = createBody(id, name, dates);
        send($scope, d);
        $("#modal-input,#modal-bg").fadeOut("normal",function(){
          $('.date').remove();
          $("#submit").remove();
          $("#cancel").remove();
          $('#modal-bg').remove();
        });
      });

      $("#cancel").click(function(){
        $("#modal-input,#modal-bg").fadeOut("normal",function(){
          $('.date').remove();
          $("#submit").remove();
          $("#cancel").remove();
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
    updateMarubatu($scope);
  })
  .error(function (data, status, headers, config) {
    console.log('error!!');
  });
});

function getEventData(data) {
 var href = window.location.href;
  // var href = 'http://localhost/GitHub/yocho/event/3bqCH96t1Y.php';
  var res = {};
  for (var i = 0;i < data.length;i++) {
    if (data[i]['url'] === href) {
      res = data[i];
      break;
    }
  }
  return res;
}

function updateMarubatu(scope) {
  var marubatuapi = Config.apiRoot + 'marubatu.php';
  $.ajax({
    url: marubatuapi,
    method: 'GET',
    dataType: 'json'
  })
  .success(function (data, status, headers, config) {
    res = getMarubatuData(data, scope.event_id)
    for (var i = 0;i < res.length;i++) {
      var selector = $('.' + res[i].participant + '-status');
      for (var j = 0;j < selector.length;j++) {
        selector[j].textContent = res[i].status[j];
      }
    }
  })
  .error(function (data, status, headers, config) {
    console.log('error!!');
  });
}

function getMarubatuData(data, id) {
  var res = [];
  for (var i = 0;i < data.length;i++) {
    if (data[i]['event_id'] === id) {
      res.push(data[i]);
    }
  }
  res = object_array_sort(res, 'participant', 'desc');
  return res;
}

function object_array_sort(data,key,order){
  //デフォは降順(DESC)
  var num_a = -1;
  var num_b = 1;

  if(order === 'asc'){//指定があれば昇順(ASC)
    num_a = 1;
    num_b = -1;
  }

  data = data.sort(function(a, b){
    var x = a[key];
    var y = b[key];
    if (x > y) return num_a;
    if (x < y) return num_b;
    return 0;
  });

  return data; // ソート後の配列を返す
}

function isSelected(order, name, index) {
  var selector = $('.' + name + '-status')[index];
  return (selector.textContent === order? 'selected' : '');
}

function createBody(id, name, dates) {
  var selector = $('.' + name + '-status');
  var status = [];
  var selector = $('.date').children('select');
  for (var i = 0;i < selector.length;i++) {
    status.push(selector[i].value);
  }
  var data = {
    'event_id': id,
    'participant': name,
    'dates': dates.join(','),
    'status': status.join(',')
  };
  return data;
}

function send(scope, data) {
  var marubatuapi = Config.apiRoot + '/marubatu.php';
  $.ajax({
    url: marubatuapi,
    method: 'POST',
    data: data
  })
  .success(function (res, status, headers, config) {
    console.log(res);
    updateMarubatu(scope);
  })
  .error(function (res, status, headers, config) {
    console.log('error!!');
  });
}
