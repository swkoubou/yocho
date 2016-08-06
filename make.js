$(function(){
    //ボタン押したら階層追加
    var i=0;
    $('#add').click(function(){
        i++;
        $('.date:last').after('<br/><br/>ㅤ開催日時<input class="date" name="date'+ i +'" type="text">');
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

//年月日をいい感じに取り出す
var datearray = JSON.parse('<?php echo  $date; ?>');
var correctdate = [];
var length = 0;
for(var i=0; i<datearray.length; i++){
    var isdate = new Date(datearray[i]);
    if(isdate != 'Invalid Date'){
        correctdate[length] = isdate.getFullYear() + '年' + isdate.getMonth() + '月' + isdate.getDate() + '日';
        length++;
    }
}