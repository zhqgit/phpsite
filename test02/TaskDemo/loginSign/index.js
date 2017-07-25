/**
 * Created by ZHQ on 2017/7/23.
 */
function getLength(str) {
    //\x00-xff在ASCALL码里面表示都是单字节的
    return str.replace(/[^\x00-xff]/g, "xx").length;
}

function findStr(str, n) {
    var tmp = 0;
    for (var i = 0; i < str.length; i++) {
        if (str.charAt(i) == n) {
            tmp++;
        }
    }
    return tmp;
}

// 验证用户名是否存在的函数
function userName() {
    console.log("触发...");
    var request = new XMLHttpRequest();
    request.open("GET", "ajaxUsername.php?username=" + document.getElementById("username").value);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            if (request.status === 200) {
                // responseText属性包含了从服务器返回的文字信息。这些信息其实就是所请求的页面
//                    document.getElementById("searchResult").innerHTML = request.responseText;
//                 console.log(request.responseText);
                if(request.responseText == 'false'){
                    document.getElementsByTagName('h6')[0].innerHTML = '用户名已存在！';
                }else{
                    document.getElementsByTagName('h6')[0].innerHTML = 'OK！';
                }
            } else {
                alert("发生错误：" + request.status);
            }
        }
    }
}


window.onload = function () {
    var aInput = document.getElementsByTagName('input');
    var allP = document.getElementsByTagName('h6');

    var oName = aInput[0],
        pwd = aInput[1],
        conPwd = aInput[2],
        email = aInput[3],
        phone = aInput[4];


    var name_msg = allP[0],
        pwd_msg = allP[1],
        conPwd_msg = allP[2],
        email_msg = allP[3],
        phone_msg = allP[4];

    var name_length = 0;

    /*
     ***************
     *名称的验证
     ***************
     */

    oName.onfocus = function () {
        name_msg.innerHTML = '5-25个字符，一个汉字为两个字符，建议使用中文会员名。';
    };

    oName.onkeyup = function () {
        name_length = getLength(this.value);
        name_msg.innerHTML = name_length + '个字符';
    };

    oName.onblur = function () {
        //[^A]表示任何不在方括号内的字符
        var re = /[^\w\u4e00-\u9fa5]/g;

        //含有非法字符
        if (re.test(this.value)) {
            name_msg.innerHTML = '含有非法字符！';
        }
        //输入为空
        else if (this.value == '') {
            name_msg.innerHTML = '不能为空！';
        }
        //长度超过25个字符
        else if (name_length > 25) {
            name_msg.innerHTML = '用户名不能超过25个字符！';
        }
        //长度少于6个字符
        else if (name_length < 6) {
            name_msg.innerHTML = '用户名不能少于6个字符！';
        }
        //OK
        else {
            // 错！将数据传入函数只能得到结果，哪里能改变数据呢
            // userName(name_msg.innerHTML);
            userName();
        }
    };


    /*
     ***************
     *密码的验证
     ***************
     */

    pwd.onfocus = function () {
        pwd_msg.innerHTML = '6-16个字符，请使用字母加数字或符号的组合密码，不能单独使用字母、数字或符号！';
    };

    pwd.onkeyup = function () {
        if (this.value.length > 5) {
            conPwd.removeAttribute('disabled');
            conPwd_msg.innerHTML = '请再输入一次密码！';
        } else {
            conPwd.setAttribute('disabled', '');
            conPwd_msg.innerHTML = '';

        }
    };

    pwd.onblur = function () {
        var m = findStr(pwd.value, pwd.value[0]);
        console.log(m);
        var re_n = /[^\d]/g;

        //如果匹配的存在非字母就会返回真
        var re_c = /[^a-zA-Z]/g
        //不能为空
        if (this.value == '') {
            pwd_msg.innerHTML = '<i class="err"></i>密码不能为空！';
        }
        //不能使用相同字符
        else if (m == this.value.length) {
            pwd_msg.innerHTML = '<i class="err"></i>不能使用相同字符！';
        }
        //长度应为6-16个字符
        else if (this.value.length < 6) {
            pwd_msg.innerHTML = '<i class="err"></i>密码长度不能少于6个字符！';
        }

        else if (this.value.length > 16) {
            pwd_msg.innerHTML = '<i class="err"></i>密码长度不能多于16个字符！';
        }
        //不能全为数字
        else if (!re_n.test(this.value)) {
            pwd_msg.innerHTML = '<i class="err"></i>密码不能全为数字！';
        }


        //不能全为字母
        else if (!re_c.test(this.value)) {
            pwd_msg.innerHTML = '<i class="err"></i>密码不能全为字母！';
        }
        //OK
        else {
            pwd_msg.innerHTML = '<i class="success"></i>OK！';
        }
    };

    /*
     ***************
     *确认密码
     ***************
     */
    conPwd.onblur = function () {
        if (this.value != pwd.value) {
            conPwd_msg.innerHTML = '两次输入的密码不一致！';
        } else {
            conPwd_msg.innerHTML = 'OK！';
        }
    }


    /*
     ***************
     *邮箱的验证
     ***************
     */

    email.onfocus = function () {
        email_msg.innerHTML = '请输入正确的邮箱格式！如xxx@qq.com或xxx@163.com';
    };

    email.onblur = function () {
        //邮箱正则
        var re_email = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;

        if (re_email.test(this.value)) {
            email_msg.innerHTML = 'OK!';
        } else {
            email_msg.innerHTML = '邮箱格式错误！';
        }
    };

    /*
     ***************
     *手机的验证
     ***************
     */

    phone.onfocus = function () {
        phone_msg.innerHTML = '请输入11位手机号码！';
    };

    phone.onblur = function () {
        //邮箱正则
        var re_phone = /[0-9]{11}/;

        if (re_phone.test(this.value)) {
            phone_msg.innerHTML = 'OK!';
        } else {
            phone_msg.innerHTML = '手机格式错误！';
        }
    };
};