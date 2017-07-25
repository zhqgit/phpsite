$(function(){

    // 步骤
    // 1.显示出来一个基本的HTML(index.html)
    // 2.客户端JS文件交互控制页面向服务器php文件端发出请求($.get ==> data.php)
    // 3.服务器端data.php文件负责获取数据库数据，将获取到的数据传输给客户端的JS文件
    // 4.JS将获取到的数据显示在客户端

	var g_table = $("table.data");
	var init_data_url = "/code/newetabel/data.php?action=init_data_list";

	// 这是一个简单的GET请求功能以取代复杂$.ajax，请求成功时可调用回调函数。如果需要在出错时执行函数，请使用$.ajax
	$.get(init_data_url,function(data){
	    console.log(data);
		var row_items = $.parseJSON(data);
		for( var i = 0 , j = row_items.length ; i < j ; i++) {
			var data_dom = create_row(row_items[i]);
			g_table.append(data_dom);
		}
	});

    // $.ajax({
    //     type: "GET",
    //     url: init_data_url,
    //     dataType: "json",
    //     success: function(data) {
    //         if (data) {
    //             console.log('成功');
    //             console.log(data);
    //             var row_items = data;
    //             for( var i = 0 , j = row_items.length ; i < j ; i++) {
    //                 var data_dom = create_row(row_items[i]);
    //                 g_table.append(data_dom);
    //             }
    //         } else {
    //             console.log('失败');
    //             console.log(data);
    //         }
    //     },
    //     error: function(jqXHR){
    //         alert("发生错误：" + jqXHR.status);
    //     },
    // });


	function delHandler(){
		var data_id = $(this).attr("dataid");
		var meButton = $(this);
		$.post("/code/newetabel/data.php?action=del_row",{dataid:data_id},function(res){
				if("ok" == res)	{
					$(meButton).parent().parent().remove();
				} else {
					alert("删除失败...");	
				}
		});
	}


	function editHandler(){
		var data_id = $(this).attr("dataid");
		var meButton = $(this);

		//没有事件
		var meRow = $(this).parent().parent();

		var editRow = $("<tr></tr>");

		for(var i = 0 ; i < 8 ; i++){
			var editTd = $("<td><input type='text' class='txtField'/></td>");	
			var v = meRow.find('td:eq('+i+')').html();
			editTd.find('input').val(v);
			editRow.append(editTd);
		}

		var opt_td = $('<td></td>');
		var saveButton = $("<a href='javascript:;' class='optLink'>保存&nbsp;</a>");

		saveButton.click(function(){
				var currentRow = $(this).parent().parent();
				var input_fields = currentRow.find("input");
				var post_fields = {};
				for( var i = 0 , j = input_fields.length; i < j; i++){
						post_fields['col_' + i]	 = input_fields[i].value;
				}
				post_fields['id'] = data_id;
				$.post('/code/newetabel/data.php?action=edit_row',post_fields,function(res){
					if("ok" == res){
						var newUpdateRow = create_row(post_fields);		
						currentRow.replaceWith(newUpdateRow);
					} else {
						alert("数据更新失败...");	
					}
				});
		});

		var cancelButton = $("<a href='javascript:;' class='optLink'>取消&nbsp;</a>");

		cancelButton.click(function(){
				var currentRow = $(this).parent().parent();		
				meRow.find('a:eq(0)').click(delHandler);
				meRow.find('a:eq(1)').click(editHandler);
				currentRow.replaceWith(meRow);
		});

		opt_td.append(saveButton);
		opt_td.append(cancelButton);
		editRow.append(opt_td);
		meRow.replaceWith(editRow);
	}

	function create_row(data_item){
		var row_obj = $("<tr></tr>");
		for(var k in data_item){
			if("id" != k){
				var col_td = $("<td></td>")	
				col_td.html(data_item[k]);
				row_obj.append(col_td);
			}
		}

		var delButton = $('<a class="optLink" href="javascript:;">删除&nbsp;</a>');
		delButton.attr("dataid",data_item['id']);
		delButton.click(delHandler);

		var editButton = $('<a class="optLink" href="javascript:;">编辑&nbsp;</a>');
		editButton.attr("dataid",data_item['id']);
		editButton.click(editHandler);

		var opt_td = $('<td></td>');

		opt_td.append(delButton);
		opt_td.append(editButton);
		row_obj.append(opt_td);
		return row_obj;
	}

	$("#addBtn").click(function(){
		var addRow = $("<tr></tr>");	

		for(var i = 0 ; i < 8 ; i++){
			var col_td = $("<td><input type='text' class='txtField'/></td>");	
			addRow.append(col_td);
		}	


		var col_opt = $("<td></td>");

		var confirmBtn = $("<a href='javascript:;' class='optLink'>确认&nbsp;</a>");

		confirmBtn.click(function(){
			var currentRow = $(this).parent().parent();	
			var input_fields = currentRow.find("input");
			var post_fields = {};
			for(var i = 0 , j = input_fields.length; i< j ; i++){
					post_fields['col_' + i]	= input_fields[i].value;
			}
			$.post("/code/newetabel/data.php?action=add_row",post_fields,function(res){
				if( 0 < res){
					post_fields['id'] = res;
					var postAddRow = create_row(post_fields);
					currentRow.replaceWith(postAddRow);
				} else {
					alert("插入失败...");	
				}
			});	
		});

		var cancelBtn = $("<a href='javascript:;' class='optLink'>取消&nbsp;</a>");

		cancelBtn.click(function(){
				$(this).parent().parent().remove();
		});



		col_opt.append(confirmBtn);
		col_opt.append(cancelBtn);

		addRow.append(col_opt);
		g_table.append(addRow);
	});

});
