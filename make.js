$(function(){


    //addタン押したら階層追加
    var i=0;
    $('#add').click(function(){
        i++;
        $('.date:last').after('<br/><br/>ㅤㅤㅤ広報日時 <input class="date" name="date'+ i +'" type="text">');
    });

    var name = [];
    var id = [];
    // Ajax通信を開始する
    $.ajax({
        url: 'api/get_users.php',
        type: 'post', // getかpostを指定(デフォルトは前者)
        dataType: 'json', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる

        success: function(response) {
            for(var i=0; i < response.length; i++){
                name[i] = response[i]['name'];
                id[i] = response[i]['id'];
            }
            for(var i=0; i<name.length; i++){
                $('.select').append('<option class="participants">'+name[i]+'</option>');
            }
        }
    });
});
function check() {
    if (document.getElementById('eventname').value == "" || document.getElementById('closedate').value == "") {
        alert("必要な情報を全て入力してください");
        return false;
    } else {
        var api = 'http://localhost/GitHub/yocho/api/registration.php';
        var ps = [];
        var ss = $('.participants');
        for (var i = 0;i < ss.length;i++) {
          if (ss[i].selected) {
            ps.push(ss[i].text);
          }
        }
        var ds = [];
        var ses = $('.date');
        for (var i = 0;i < ses.length;i++) {
          ds.push(ses[i].value);
        }
        data = {
          event_name: $('#eventname')[0].value,
          participants: ps.join(','),
          dates: ds.join(','),
          deadline: $('#closedate')[0].value
        };
        $.ajax({
          url: api,
          method: 'POST',
          data: data
        })
        .success(function (message, status, headers, config) {
            alert(message);
        })
        .error(function (data, status, headers, config) {
            console.log('error!!')
        });
        return true;
    }
}
// function check(){
//     var eventname1 = document.forms.form.eventname.value;
//     console.log('event='+eventname1);
//     var closedate1 = document.forms.form.closedate.value;
//     console.log('close='+closedate1);
//     alert('必要な情報を全て入力してください');
//     return false;
// }



