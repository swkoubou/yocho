$(function(){
    function check(){
        alert('必要な情報を全て入力してください');
        return false;
    }
    
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
                $('.select').append('<option>'+name[i]+'</option>');
            }
        }
    });
});



