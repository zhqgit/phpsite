/**
 * Created by ZHQ on 2017/7/29.
 */
window.onload = function() {

    // 获取导航父节点
    var nav = document.getElementById('nav');
    var navChildrens = nav.getElementsByTagName('a');

    // 获取导航节点文本
    var navText = [];
    for (var i = 0; i < navChildrens.length; i++) {
        navText[i] = navChildrens[i].innerText;
    }

    // 获取内容面板的父节点
    var navContainer = document.getElementById('nav-container');

    // 获取所有的内容面板节点
    var navContainerAll = navContainer.children;

    console.log(navContainer.children);
    console.log(navChildrens);
    console.log(navText);



    function ff(obj){
        var tb = document.getElementById('select-course');

        // 获得tbody，并且插入一行
        console.log(tb.childNodes[1]);

        var tr = document.createElement('tr');

        for(var i=0;i<9;i++){
            var td = document.createElement('td');
            var text = document.createTextNode('');
            td.appendChild(text);
            tr.appendChild(td);
        }

        // <button type="submit" class="btn btn-info">选课</button>
        console.log(tr.children);
        console.log(tr.children[7]);
        // console.log(tr.childNodes[7].innerHTML('<p>hhah</p>'));
        tr.children[0].innerText = obj.courseid;
        tr.children[1].innerText = obj.coursename;
        tr.children[2].innerText = obj.time;
        tr.children[3].innerText = obj.teachername;
        tr.children[4].innerText = obj.teachtime;
        tr.children[5].innerText = obj.credit;
        tr.children[6].innerText = obj.location;
        tr.children[7].innerText = obj.number;
        tr.children[8].innerHTML= '<button type="submit" class="btn btn-info">选课</button>';
        console.log(tr);

        tb.childNodes[1].appendChild(tr);
    }

    // ff();








    // 委托导航父节点触发点击事件
    nav.onclick = function(e) {
        console.log(e.target.innerText);

        for (var i = 0; i < navContainerAll.length; i++) {
            navContainerAll[i].style.display = 'none';
        }

        // 找到值的数序下标
        function hh(str, arr) {
            var num = arr.indexOf(str);
            return num;
        }

        // 思路，将所有的导航节点文本值放在一个数组
        // 每次点击时获取响应的文本值，获取文本值在数组的下标

        // 将所有内容面板节点放在同一个数组内，顺序和导航节点文本值数组一致
        // 将获取到的导航节点文本值数组下标赋给内容面板节点数组
        console.log(hh(e.target.innerText, navText));
        navContainerAll[hh(e.target.innerText, navText)].style.display = 'block';
    };

    document.getElementById("change-btn").onclick = function() {
        var request = new XMLHttpRequest();
        request.open("POST", "change_password");
        // 如果在 html页面使用这些代码，那么URL地址就要使用下面这样的
        // request.open("POST", "__URL__/change_password");
        var data = "userid=" + document.getElementById("userid").value + "&opwd=" + document.getElementById("original-pwd").value + "&npwd=" + document.getElementById("new-pwd").value;
        // post提交数据时，在open函数和send函数之间要有一个setRequestHeader
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(data);
        request.onreadystatechange = function() {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    // responseText属性包含了从服务器返回的文字信息。这些信息其实就是所请求的页面
                    var reData = JSON.parse(request.responseText);
                    alert(reData.info);
                    console.log(request.responseText);
                    console.log(typeof request.responseText);
                    console.log(typeof reData);
                    document.getElementById("searchResult").innerHTML = reData.info;
                } else {
                    alert("发生错误：" + request.status);
                }
            }
        }
    }

    document.getElementById("drop-course").onclick = function(e) {
        console.log(e);
        console.log(e.target);
        console.log(e.target.parentNode.parentNode.firstChild);

        var targetRow = e.target.parentNode.parentNode;

        console.log(e.target.parentNode.parentNode.firstChild.nextSibling.innerText);
        var dropCourseId = e.target.parentNode.parentNode.firstChild.nextSibling.innerText
        console.log("点击了");
        var request = new XMLHttpRequest();
        request.open("POST", "drop_course");
        // request.open("POST", "__URL__/drop_course");
        var data = "courseid=" + dropCourseId;
        // post提交数据时，在open函数和send函数之间要有一个setRequestHeader
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(data);
        request.onreadystatechange = function() {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    // responseText属性包含了从服务器返回的文字信息。这些信息其实就是所请求的页面
                    var reData = JSON.parse(request.responseText);
                    alert(reData.info);
                    console.log(reData.data);
                    console.log(reData.data[0]);
                    if(reData.data[0]){
                        ff(reData.data[0]);
                    }
                    console.log(request.responseText);
                    console.log(typeof request.responseText);
                    console.log(typeof reData);
                    // window.location.reload();
                    targetRow.style.display = 'none';
                } else {
                    alert("发生错误：" + request.status);
                }
            }
        };
    };

    document.getElementById("select-course").onclick = function(e) {
        console.log(e);
        console.log(e.target);
        console.log(e.target.parentNode.parentNode.firstChild);

        var targetRow = e.target.parentNode.parentNode;

        console.log(e.target.parentNode.parentNode.firstChild.nextSibling.innerText);
        var selectCourseId = e.target.parentNode.parentNode.firstChild.nextSibling.innerText;
        console.log("点击了");
        var request = new XMLHttpRequest();
        request.open("POST", "select_course");
        // request.open("POST", "__URL__/select_course");
        var data = "courseid=" + selectCourseId;
        // post提交数据时，在open函数和send函数之间要有一个setRequestHeader
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(data);
        request.onreadystatechange = function() {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    // responseText属性包含了从服务器返回的文字信息。这些信息其实就是所请求的页面
                    var reData = JSON.parse(request.responseText);
                    alert(reData.info);
                    // window.location.reload();
                    console.log(request.responseText);
                    console.log(typeof request.responseText);
                    console.log(typeof reData);
                    targetRow.style.display = 'none';
                } else {
                    alert("发生错误：" + request.status);
                }
            }
        }
    }
}
