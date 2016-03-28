/**
 * @Project NUKEVIET 4.x
 * @Author PHANGIA.VN (contact@phangia.vn)
 * @Copyright (C) 2014 PHANGIA.VN. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 1 - 31 - 2010 5 : 12
 */

// Xu ly cat ---------------------------------------
function nv_chang_cat(catid, mod) {
	var nv_timer = nv_settimeout_disable('id_' + mod + '_' + catid, 5000);
	var new_vid = $('#id_' + mod + '_' + catid).val();
	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=change_cat&nocache=' + new Date().getTime(), 'catid=' + catid + '&mod=' + mod + '&new_vid=' + new_vid, function(res) {
		var r_split = res.split('_');
		if (r_split[0] != 'OK') {
			alert(nv_is_change_act_confirm[2]);
		}
		clearTimeout(nv_timer);
		var parentid = parseInt(r_split[1]);
		nv_show_list_cat(parentid);
	});
	return;
}

function nv_show_list_cat(parentid) {
	if (document.getElementById('module_show_list')) {
		$('#module_show_list').load(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list_cat&parentid=' + parentid + '&nocache=' + new Date().getTime());
	}
	return;
}

function nv_del_cat(catid) {
	if (confirm(nv_is_del_confirm[0])) {
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=del_cat&nocache=' + new Date().getTime(), 'catid=' + catid, function(res) {
			var r_split = res.split('_');
			if (r_split[0] == 'OK') {
				var parentid = parseInt(r_split[1]);
				nv_show_list_cat(parentid);
			} else if (r_split[0] == 'ERR' && r_split[1] == 'CAT') {
				alert(r_split[2]);
			} else if (r_split[0] == 'ERR' && r_split[1] == 'ROWS') {
				if (confirm(r_split[4])) {
					var catid = r_split[2];
					var delallcheckss = r_split[3];
					$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=del_cat&nocache=' + new Date().getTime(), 'catid=' + catid + '&delallcheckss=' + delallcheckss, function(res) {
						$("#cat-delete-area").html(res);
					});
				}
			} else {
				alert(nv_is_del_confirm[2]);
			}
		});
	}
	return false;
}

// Xu ly main ---------------------------------------

function nv_main_action(oForm, checkss, msgnocheck) {
	var fa = oForm['idcheck[]'];
	var listid = '';
	if (fa.length) {
		for (var i = 0; i < fa.length; i++) {
			if (fa[i].checked) {
				listid = listid + fa[i].value + ',';
			}
		}
	} else {
		if (fa.checked) {
			listid = listid + fa.value + ',';
		}
	}
	if (listid != '') {
		var action = document.getElementById('action').value;
		if (action == 'delete') {
			if (confirm(nv_is_del_confirm[0])) {
				$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=del_content&nocache=' + new Date().getTime(), 'listid=' + listid + '&checkss=' + checkss, function(res) {
					nv_del_content_result(res);
				});
			}
		} else if (action == 'publtime') {
			window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=publtime&listid=' + listid + '&checkss=' + checkss;
		} else if (action == 'exptime') {
			window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=exptime&listid=' + listid + '&checkss=' + checkss;
		}
	} else {
		alert(msgnocheck);
	}
}

function nv_del_content(id, checkss, base_adminurl) {
	if (confirm(nv_is_del_confirm[0])) {
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=del_content&nocache=' + new Date().getTime(), 'id=' + id + '&checkss=' + checkss, function(res) {
			nv_del_content_result(res);
		});
	}
	return false;
}

function nv_check_movecat(oForm, msgnocheck) {
	var fa = oForm['catidnews'];
	if (fa.value == 0) {
		alert(msgnocheck);
		return false;
	}
}

function nv_del_content_result(res) {
	var r_split = res.split('_');
	if (r_split[0] == 'OK') {
		window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main';
	} else if (r_split[0] == 'ERR') {
		alert(r_split[1]);
	} else {
		alert(nv_is_del_confirm[2]);
	}
	return false;
}


function get_alias(mod, id) {
	var title = strip_tags(document.getElementById('idtitle').value);
	if (title != '') {
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=alias&nocache=' + new Date().getTime(), 'title=' + encodeURIComponent(title) + '&mod=' + mod + '&id=' + id, function(res) {
			if (res != "") {
				document.getElementById('idalias').value = res;
			} else {
				document.getElementById('idalias').value = '';
			}
		});
	}
	return false;
}


function nv_getcatalog(obj) {
	var pid = $(obj).val();
	var url = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=getcatalog&pid=' + pid;
	$.get(url, function(data) {
		if( data == '' )
		{
			$('#cat').hide();
		}
		else
		{
			$('#cat #vcatid').html( data );
			$('#cat').show();
		}
	});
}

function nv_change_catid(obj, id) {
	var cid = $(obj).val();
	var typepriceold = $("#typepriceold").val();
	typeprice = $(obj).find('option:selected').attr("data-label");
	if (typeprice!=typepriceold)
	{
		$('#priceproduct').load(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=getprice&cid=' + cid + "&id=" + id);
		$("#typepriceold").val(typeprice);
	}
	$('#custom_form').load(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=custom_form&cid=' + cid + "&id=" + id);
	$.get( script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=getgroup&cid=' + cid, function( data ) {
		if( data != '' ){
			$('#list_group').show();
			$("#listgroupid").html( data );
		}
		else{
			$('#list_group').hide();
		}
	});
}
