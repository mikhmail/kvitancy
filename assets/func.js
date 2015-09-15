$(document).ready(function(){


// смена статуса
$('select[id^=status_]').change(function(){
var status = $('#'+this.id+' option:selected').val();
var id = this.name;
		$.ajax({
		  url: "ajx/change_status/"+status+"/"+id+"",
		  success: function(data) {
			
			 $("#status_"+id+"").fadeOut("slow");
			 $("#status_"+id+"").fadeIn();
		  }
		});
	delete status;
	delete id;
	});
	
// смена механика	
$('select[id^=meh_]').change(function(){

var status = $('#'+this.id+' option:selected').val();
var id = this.name;
		$.ajax({
		  url: "ajx/change_mechanic/"+status+"/"+id+"",
		  success: function(data) {
			
			 $("#meh_"+id+"").fadeOut("slow");
			 $("#meh_"+id+"").fadeIn();
		  }
		});
	delete status;
	delete id;
	});

// смена ответственный
    $('select[id^=resp_]').change(function(){

        var status = $('#'+this.id+' option:selected').val();
        var id = this.name;
        $.ajax({
            url: "ajx/change_resp/"+status+"/"+id+"",
            success: function(data) {

                $("#resp_"+id+"").fadeOut("slow");
                $("#resp_"+id+"").fadeIn();
            }
        });
        delete status;
        delete id;
    });

// добавить комментарий	
$('input[name=comment]').click(function(){
var comment = $('textarea[name='+this.id+']').val();
var arr = this.id.split('_');
var id = parseInt(arr[1]);
//alert(id);

$.post("ajx/add_comment", {id:id, comment:comment})
	.done(function(data) {
	
	$("#ul_"+id+"").append(data);
	$('textarea[name=comment_'+id+']').val('');
		});
	});
	

// удалить комментарий	
$('input[id^=dell_comment]').click(function(){
var id_comment = this.name;
//alert (id_comment);die;
$.post("ajx/delete_comment", {id_comment:id_comment})
	.done(function(data) {
	$("#li_"+id_comment+"").remove();
		});
	});


// фильтр аппаратов	
$('a[id^=aparat_]').click(function(){

    $('#myform').clear();
	var id_aparat = this.name;
	//alert (id_aparat);die;
		
		 $("select[name=id_aparat] option").each(function () {
            if ($(this).val() == id_aparat ) $(this).attr("selected", "selected");
        });
$("#myform").submit();
});	

// фильтр состояний	
$('a[id^=sost_]').click(function(){
    $('#myform').clear();
	var id_sost = this.name;
		 $("select[name=id_sost] option").each(function () {
            if ($(this).val() == id_sost ) $(this).attr("selected", "selected");
        });
    //$('#ajaxloader').show();
$("#myform").submit();
});

// просмотр моей заявки
$('a[id^=kvit_pokaz_my_]').click(function(){
    $('#myform').clear();
	var id_kvit = this.name;
		$('input[name=id_kvitancy]').val(id_kvit);
$("#myform").submit();
});

// просмотр заявки позвонить
$('a[id^=kvit_pokaz_call_]').click(function(){
    $('#myform').clear();
	var id_kvit = this.name;
		$('input[name=id_kvitancy]').val(id_kvit);
$("#myform").submit();
});	
	
// модальное окно новой квитанции
$('a#new-order-button').click( function(event){ // ловим клик по ссылки с id="go"
        event.preventDefault(); // выключаем стандартную роль элемента
        $('#overlay').fadeIn(400, // сначала плавно показываем темную подложку
            function(){ // после выполнения предъидущей анимации
                $('#modal_form') 
                    .css('display', 'block') // убираем у модального окна display: none;
                    .animate({opacity: 1, top: '50%'}, 200); // плавно прибавляем прозрачность одновременно со съезжанием вниз
        });
    });
    /* Закрытие модального окна, тут делаем то же самое но в обратном порядке */
    $('#modal_close, #overlay').click( function(){ // ловим клик по крестику или подложке
        $('#modal_form')
            .animate({opacity: 0, top: '45%'}, 200,  // плавно меняем прозрачность на 0 и одновременно двигаем окно вверх
                function(){ // после анимации
                    $(this).css('display', 'none'); // делаем ему display: none;
                    $('#overlay').fadeOut(400); // скрываем подложку
                }
            );
    });

// добавить NEW квитанцию	
$('input[name=new_kvit]').click(function(){

	$("form[name='new_kvit_form']").find("input,select,textarea").filter('[required="required"]').each(function () {

      if ( ! $(this).val() ) { alert ('Надо выбрать значение '+$(this).attr("title")+'.'); $(this).focus(); exit; }
	  
   });



// kvitancy

var id_aparat = 	$.trim($("#id_aparat option:selected").val());
var id_proizvod = 	$.trim($("#id_proizvod option:selected").val());
var model = 		$.trim($('input[name=model]').val());
var ser_nomer = 	$.trim($('input[name=ser_nomer]').val());
var neispravnost = 	$.trim($('textarea[name=neispravnost]').val());
var komplektnost = 	$.trim($('textarea[name=komplektnost]').val());
var vid = 			$.trim($('textarea[name=vid]').val());
var id_remonta = 	$.trim($("#id_remonta option:selected").val());
var id_sc = 		$.trim($("#id_sc option:selected").val());
var primechaniya = 	$.trim($('textarea[name=primechaniya]').val());

//client
var user_id=$.trim($('input[name=user_id]').val());

var fam = 	$.trim($('input[name=fam]').val());
var imya = 	$.trim($('input[name=imya]').val());
var otch = 	$.trim($('input[name=otch]').val());
var phone = $.trim($('input[name=phone]').val());
var email = $.trim($('input[name=email]').val());
var adres = $.trim($('input[name=adres]').val());

var where_id = $.trim($("#where_id option:selected").val());

	
$.post("ajx/add_kvitancy", {		user_id:user_id,
									id_aparat:id_aparat,
									id_proizvod:id_proizvod,
									model:model,
									ser_nomer:ser_nomer,
									neispravnost:neispravnost,
									komplektnost:komplektnost,
									vid:vid,
									id_remonta:id_remonta,
									id_sc:id_sc,
									primechaniya:primechaniya,
									fam:fam,
									imya:imya,
									otch:otch,
									phone:phone,
									email:email,
									adres:adres,
									where_id:where_id
									})

	
	
	.done(function(data) {
		var id_kvitancy = data;
					$('#modal_form')
						.animate({opacity: 0, top: '45%'}, 200,  // плавно меняем прозрачность на 0 и одновременно двигаем окно вверх
							function(){ // после анимации
								$(this).css('display', 'none'); // делаем ему display: none;
								$('#overlay').fadeOut(300); // скрываем подложку
							}
						);
			//window.open("/tickets/printing/"+id_kvitancy+"");
	        //window.location = "/tickets/printing/"+id_kvitancy+"";

        $('input[name=id_kvitancy]').val(id_kvitancy);
        $("#myform").submit();
	
		});	
});

// END of добавить NEW квитанцию


//добавить аппарат на лету

$("#add_aparat").click(function(){
		app = $("#add_aparat_name").val();
			
			$.post("ajx/add_aparat", {aparat_name:app})
			.done(function(data) {
		//alert (data);
		if (data.match(/^[-\+]?\d+/) === null) {
			alert('This device name already exists');
				$("#add_aparat_name").focus();
			} else {
			
			$("select#id_aparat").append('<option value="'+data+'" selected="selected">'+app+'</option>');
			$( "span[name='aparat_span']" ).hide();
			
		
			}
		});				
	});


//добавить бренд на лету

    $("#add_proizvod").click(function(){
		app = $("#add_proizvod_name").val();
			
			$.post("ajx/add_proizvod", {proizvod_name:app})
			.done(function(data) {
		//alert (data);
		if (data.match(/^[-\+]?\d+/) === null) {
			alert('This brand name already exists');
				$("#add_proizvod_name").focus();
			} else {
			
			$("select#id_proizvod").append('<option value="'+data+'" selected="selected">'+app+'</option>');
			$( "span[name='proizvod_span']" ).hide();
			
		
			}
		});				
	});	



// поиск пользователя при добавлении квинтации.
$( "#search_user" ).keyup(function() {


        var id_sc = $('#id_sc option:selected').val();

		var inputString = $("#search_user").val()
		if(inputString.length > 10) {
                        
				$('#user_box').hide();
					
                } else {
                        $.post("ajx/search_user", {queryString: ""+inputString+"", id_sc: id_sc}, function(data){
                                if (data.length > 2 && data !=  0) {
										
                                        $('#user_box').show();
                                        $('#user_list').html(data);
									
										}else if (inputString.length > 2 && data ==  0) {

                                        $('#user_box').hide();

                                        $('#user_list').html('Nothing found ...');

										}else{
                                    $('#user_list').html('Nothing found ...');
                                }
                        });
                }
});
// END of поиск пользователя при добавлении квинтации.	

// Подсветить все выбранные value
    $("form#myform").find("select").filter('[value != ""]').each(function () {

       $(this).attr("class","selected-values");

    });

// END of Подсветить все выбранные value

//	
//	
//ready	
});


/*
Дальше отдельные функции
*/


jQuery.fn.clear = function()
{
    var $form = $(this);

    $form.find('input:text, input:password, input:file, textarea').val('');
    $form.find('select option:selected').removeAttr('selected');
    $form.find('input:checkbox, input:radio').removeAttr('checked');

    return this;
};


function fill_user(thisValue) {
			
			var parts=new Array();
			var response = thisValue;
			
			parts = response.split('-');
			$('#user_id').val(parts[0]);
			$('#fam').val(parts[1]);
			$('#imya').val(parts[2]);
			$('#otch').val(parts[3]);
			$('#mail').val(parts[4]);
			$('#adres').val(parts[5]);
			$('#phone').val(parts[6]);
			
			$("#search_user").val('');
			setTimeout("$('#user_box').hide();", 200);
 }		

function anichange (obj) {
var objName = $(obj).next();
	var objPrev = $(obj).prev();
	if ( $(objName).css('display') == 'none' ) {
	$(objName).animate({height: 'show'}, 400);
	$(objPrev).css({'background-position':"-11px 0"});
		} else {
	$(objName).animate({height: 'hide'}, 200);
	$(objPrev).css({'background-position':"0 0"});
		}
}

function look_apparat(inputString) {
                if(inputString.length > 10) {
                        $('#apparat_box').hide();
                } else {
                        $.post("ajx/look_apparat", {queryString: ""+inputString+""}, function(data){
                                if(data.length > 2) {
                                        $('#apparat_box').show();
                                        $('#apparat_list').html(data);
                                }
                        });
                }
        } // lookup

		
function fill_apparat(thisValue) {
			
			var parts=new Array();
			var response = thisValue;
			
			parts = response.split('-');
			$("select#id_aparat").append('<option value="'+parts[0]+'" selected="selected">'+parts[1]+'</option>');
			$("select#id_aparat").attr("class","control-group success");
			
			setTimeout("$('#apparat_box').hide();", 200);
 }
 
 
 function look_proizvod(inputString) {
                if(inputString.length > 10) {
                        $('#proizvod_box').hide();
                } else {
                        $.post("ajx/look_proizvod", {queryString: ""+inputString+""}, function(data){
                                if(data.length > 2) {
                                        $('#proizvod_box').show();
                                        $('#proizvod_list').html(data);
                                }
                        });
                }
        } // lookup

		
function fill_proizvod(thisValue) {
			
			var parts=new Array();
			var response = thisValue;
			
			parts = response.split('-');
			$("select#id_proizvod").append('<option value="'+parts[0]+'" selected="selected">'+parts[1]+'</option>');
			$("select#id_proizvod").attr("class","status");
			
			
			setTimeout("$('#proizvod_box').hide();", 200);
 }