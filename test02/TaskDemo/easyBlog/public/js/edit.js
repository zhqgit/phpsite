/**
 * Created by ZHQ on 2017/7/24.
 */
$('body').on('click','.edit',function(e){
    var filename = $(".filename").text();

    $.ajax({
        type: "GET",
        url: "http://test02.com/TaskDemo/easyBlog/edit.php?entry="+filename,
        dataType: "json",
        success: function (data) {
            console.log(data.msg);
            $('#myModal').modal('hide');
            window.location.reload();
        },
        error: function (jqXHR) {
            alert("发生错误：" + jqXHR.status);
        }
    });
});