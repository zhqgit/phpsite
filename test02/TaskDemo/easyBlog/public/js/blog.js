/**
 * Created by ZHQ on 2017/7/23.
 */
$(document).ready(function(){
    $("#save").click(function(){
        $.ajax({
            type: "POST",
            url: "./add.php",
            data: {
                title: $("#title").val(),
                content: $("#content").val()
            },
            dataType: "json",
            success: function(data){
                if (data.success) {
                    // $("#createResult").html(data.msg);
                    $("#alert").trigger("click");
                    window.location.href = "http://test02.com/TaskDemo/easyBlog/show.html";
                    // $(window).attr('location','http://test02.com/TaskDemo/easyBlog/show.html');
                } else {
                    $("#createResult").html("出现错误：" + data.msg);
                }
            },
            error: function(jqXHR){
                alert("发生错误：" + jqXHR.status);
            },
        });
    });
});