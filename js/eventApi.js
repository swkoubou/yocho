$(function () {
  var EventApi = {
    'data': [],
    'init': function () {
      return $.ajax({
        'url': 'http://localhost/GitHub/yocho/api/registration.php',
        'method': 'GET',
        'dataType': 'json'
      }).then(function (data) {
        EventApi.data = data;
      });
    }
  };
  EventApi.init().done(function () {
    console.log(EventApi.data);
  });
});
