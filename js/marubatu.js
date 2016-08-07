$(function () {
  var marubatu = {
    data: [],
    update: function () {
      var marubatuapi = Config.apiRoot + 'marubatu.php';
      $.ajax({
        url: marubatuapi,
        method: 'GET',
        dataType: 'json'
      });
    }
  };
});
