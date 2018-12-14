$(document).ready(function(){
    var base_url = document.getElementById ("myBase").name;

// смена статуса
$('select[id^=status_]').change(function(){
var status = $('#'+this.id+' option:selected').val();
var id = this.name;
		$.ajax({
		  url: ""+base_url+"ajx/change_status/"+status+"/"+id+"",
		  success: function(data) {
             obj = eval("(function(){return " + data + ";})()");
             if (data == 1){

                alert('При закрытии квитанции, надо выбрать механика!');
                 $("#status_"+id+" option[selected]").removeAttr("selected");
                 $("#status_"+id+" option")
                 .removeAttr('selected')
                    .filter('[value=2]')
                         .attr('selected', true);

                 $("#meh_"+id+"").focus();

             }else{

                 $("#status_"+id+"").fadeOut("slow");
                 $("#status_"+id+"").fadeIn();

                  $("span#background_"+id+"").html(obj.name_sost);
                  $("span#background_"+id+"").css('background-color',obj.background);

             }

              //console.log(data);
              //alert(data);
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
		  url: ""+base_url+"ajx/change_mechanic/"+status+"/"+id+"",
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
            url: ""+base_url+"ajx/change_resp/"+status+"/"+id+"",
            success: function(data) {

                $("#resp_"+id+"").fadeOut("slow");
                $("#resp_"+id+"").fadeIn();
            }
        });
        delete status;
        delete id;
    });
// end смена ответственный

// смена ответственный в запчастях
    $('select[id^=parts_resp_]').change(function(){

        var status = $('#'+this.id+' option:selected').val();
        var id = this.name;
        //alert(status);exit;
        $.ajax({
            url: ""+base_url+"ajx/change_resp_parts/"+status+"/"+id+"",
            success: function(data) {

                $("#parts_resp_"+id+"").fadeOut("slow");
                $("#parts_resp_"+id+"").fadeIn();
            }
        });
        delete status;
        delete id;
    });
// end of смена ответственный в запчастях


// смена мастерской где техника
    $('select[id^=id_where_]').change(function(){

        var workroom = $('#'+this.id+' option:selected').val();
        var id = this.name;
        $.ajax({
            url: ""+base_url+"ajx/change_workroom/"+workroom+"/"+id+"",
            success: function(data) {

                $("#id_where_"+id+"").fadeOut("slow");
                $("#id_where_"+id+"").fadeIn();
            }
        });
        delete workroom;
        delete id;
    });



// добавить запчасть
    $('button[id^=parts_add_]').click(function(){

        var arr = this.id.split('_');
        var id_kvitancy = parseInt(arr[2]);
        //alert(id_kvitancy);exit;

        var id_aparat_p = $(' input[name=select_parts_'+id_kvitancy+'] ').attr('id');
        var name = $.trim($(' input[name=select_parts_'+id_kvitancy+'] ').attr('title'));
        var id_aparat = $.trim($(' input[name=select_parts_'+id_kvitancy+'] ').attr('alt'));
        var text = $.trim($(' input[name=store_text_'+id_kvitancy+'] ').attr('value'));

        var id_sost = $('select[name=store_id_sost_'+id_kvitancy+'] option:selected').val();
        var cost = $.trim($(' input[name=store_cost_'+id_kvitancy+'] ').attr('value'));
        var price = $.trim($(' input[name=store_price_'+id_kvitancy+'] ').attr('value'));
        var count = $.trim($(' input[name=store_count_'+id_kvitancy+'] ').attr('value'));


        $(this).parent().parent().find("input,select,textarea").each(function () {
            if ( ! $(this).val() ) { alert ('Надо выбрать значение "'+$(this).attr("placeholder")+'".'); $(this).focus(); exit; }
        });

        if(count < 1) { alert ('Количество не может быть меньше 1'); $(' input[name=store_count_'+id_kvitancy+'] ').focus();exit; }

        if(!id_aparat_p && name){
            $.post(""+base_url+"ajx/add_aparat_p", {aparat_p:name, id_aparat:id_aparat})
                        .done(function(data) {
                            if(data == 0) {
                        alert('Название запчасти уже есть в базе, выберите из списка.');
                        $(' input[name=select_parts_'+id_kvitancy+'] ').focus();
                    }else{

                            $.post(""+base_url+"ajx/add_store", {
                                text:text,
                                name:name,
                                id_aparat:id_aparat,
                                id_aparat_p:data,
                                id_sost:id_sost,
                                cost:cost,
                                price:price,
                                id_kvitancy:id_kvitancy,
                                count:count
                            })
                                .done(function(data) {
                                    $(this).parent().parent().find("input,select,textarea").each(function () {
                                        $(this).attr('value', '');
                                    });
                                    for (var i = 1; i <= count; i++) {
                                        $("#table_store_"+id_kvitancy+"").append(data);
                                    }
                            });
                    }
                });

    }else{
            if(id_aparat_p){
                $.post(""+base_url+"ajx/add_store", {
                    text:text,
                    name:name,
                    id_aparat:id_aparat,
                    id_aparat_p:id_aparat_p,
                    id_sost:id_sost,
                    cost:cost,
                    price:price,
                    id_kvitancy:id_kvitancy,
                    count:count
                })
                    .done(function(data) {
                        $("div[name='parts']").find("input,select,textarea").each(function () {
                            $(this).attr('value', '');
                        });
                        for (var i = 1; i <= count; i++) {
                            $("#table_store_"+id_kvitancy+"").append(data);
                        }
                });
          }
      }
	/*
    if (confirm('Добавить в кассу запись?\n-'+cost+', Закупка запчасти для '+id_kvitancy+'')) {
        $.post(""+base_url+"ajx/add_cash", {
                plus:'-'+cost,
                id_kvitancy:id_kvitancy,
                name:'Закупка ['+name+'] '+text
            })
                .done(function(data) {
                    //alert (data);
                    if (data == 0) {
                        alert('Произошла ошибка во время запроса. Попробуйте еще раз.');

                    } else {
                        alert('Добавлено!');
                    }
                });
    }
	*/
// end of добавить запчасть
});


// поиск aparat_p при добавлении запчасти.
    $('input[name^=select_parts_]').keyup(function() {

        $(this).attr('id', '');
        $(this).attr('title', '');

        var id_aparat = $('#id_sc option:selected').val();
        var arr = this.name.split('_');
        var id_kvitancy = parseInt(arr[2]);
        var inputString = $(this).val();
        $(this).attr('title', $(this).val());

        var next = $(this).next();
        //alert(id_kvitancy);exit;

        if(inputString.length > 10) {
            $(next).hide();
        } else {
            $.post(""+base_url+"ajx/look_aparat_p", {queryString: ""+inputString+"", id_kvitancy: id_kvitancy}, function(data){
                if (data.length > 2 && data !=  0) {

                    //$('#parts_box').show();
                    //alert($(this).next.name);exit;
                    $(next).show();
                    $(next).html(data);
                    //$('#parts_list').html(data);

                }else if (inputString.length > 2 && data ==  0) {

                    $(next).hide();

                    //$('#parts_list').html('Nothing found ...');

                }else{
                    //$('#parts_list').html('Nothing found ...');
                }
            });
        }
    });
// END of поиск aparat_p при добавлении запчасти

// удалить установленную запчасть
    $('button[id^=part_dell_]').click(function(){
        var id_part = this.name;

        if (confirm('Хотите удалить запчасть? \nЗапчасть не будет удалена и будет возвращена на склад.')) {
            $.post(""+base_url+"ajx/update_part", {id_part:id_part})
                .done(function(data) {
                    $("#part_tr_"+id_part+"").remove();

                });
         }
    });



// добавить выполенную работу
    $('button[id^=work_add_]').click(function(){
        var arr = this.id.split('_');
        var id_kvitancy = parseInt(arr[2]);

        var name = $.trim($('#work_name_'+id_kvitancy+'').val());
        var cost = $.trim($('#work_cost_'+id_kvitancy+'').val());
        var user_id = $.trim($("#work_resp_"+id_kvitancy+" option:selected").val());

        $(this).parent().parent().parent().parent().find("input,select,textarea").each(function () {
            if ( ! $(this).val() ) { alert ('Надо выбрать значение "'+$(this).attr("placeholder")+'".'); $(this).focus(); exit; }
        });

        if(cost < 0) { alert ('Стоимость не может быть меньше 0'); $('#work_cost_'+id_kvitancy+'').focus();exit; }

        $.post(""+base_url+"ajx/add_work", {id_kvitancy:id_kvitancy, name:name, cost:cost, user_id:user_id})
            .done(function(data) {

                $('#table_work_'+id_kvitancy+'').find("input,select,textarea").each(function () {
                    $(this).attr('value', '');
                });

                $("#table_work_"+id_kvitancy+"").append(data);

            });
    });

// удалить выполенную работу
    $('button[id^=work_dell_]').click(function(){
        var id_work = this.name;
    if (confirm('Хотите выполенную работу? \nВосстановить будет невозможно.'))
    {
        $.post(""+base_url+"ajx/delete_work", {id_work:id_work})
            .done(function(data) {
                $("#work_tr_"+id_work+"").remove();

            });
    }
    });



// добавить комментарий	
$('input[name=comment]').click(function(){
var comment = $('textarea[name='+this.id+']').val();
var arr = this.id.split('_');
var id = parseInt(arr[1]);
//alert(id);

$.post(""+base_url+"ajx/add_comment", {id:id, comment:comment})
	.done(function(data) {
	
	$("#ul_"+id+"").prepend(data);
	$('textarea[name=comment_'+id+']').val('');
		});
	});
	

// удалить комментарий	
$('input[id^=dell_comment]').click(function(){
var id_comment = this.name;
//alert (id_comment);die;
$.post(""+base_url+"ajx/delete_comment", {id_comment:id_comment})
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

var id_aparat = 	$.trim($("#id_apparat option:selected").val());
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

	
$.post(""+base_url+"ajx/add_kvitancy", {		user_id:user_id,
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
        $.post(""+base_url+"ajx/add_aparat", {aparat_name:app})
            .done(function(data) {
                //alert (data);
                if (data.match(/^[-\+]?\d+/) === null) {
                    alert('This device name already exists');
                    $("#add_aparat_name").focus();
                } else {

                    $("select#id_apparat").append('<option value="'+data+'" selected="selected">'+app+'</option>');
                    $("div#id_apparat_chzn").find('span').html(app);
                    $( "span[name='aparat_span']" ).hide();
                    $(document).find('i').removeClass( "icon-minus" ).addClass( "icon-plus" );


                }
            });
    });

/*
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
*/

    //добавить аппарат_p на лету
    $("#add_aparat_p").click(function(){

        var name =  $.trim($("#aparat_p_name").val());
        var id_aparat = $.trim($("#store_add_id_aparat option:selected").val());

        //alert(id_aparat);exit;
        if(!id_aparat) {
            alert('Надо выбрать аппарат');
            $("select#store_add_id_aparat").focus();
            exit;
        }else{
        $.post(""+base_url+"ajx/add_aparat_p", {aparat_p:name, id_aparat:id_aparat})
            .done(function(data) {
                if(data == 0) {
                    alert('Такое название уже есть в базе, выберите из списка.');
                    $("select#store_add_id_aparat_p").focus();
                }else{
                    $("select#store_add_id_aparat_p").append('<option value="'+data+'" selected="selected">'+name+'</option>');
                    $( "span[name='aparat_p_span']" ).hide();
                    $(document).find('i').removeClass( "icon-minus" ).addClass( "icon-plus" );

                }
            });
        }
    });

//добавить аппарат_p на лету2
    $('[id^=add_aparat_p_button_]').click(function(){

        var id_kvitancy = this.name;

        var name =  $.trim($("#add_aparat_p_name_zap_"+id_kvitancy+"").val());
        var id_aparat = $.trim($("#id_aparat_zap_"+id_kvitancy+" option:selected").val());

        //alert(id_aparat);exit;
        if(!id_aparat) {
            alert('Надо выбрать аппарат');
            $("select#store_add_id_aparat").focus();
            exit;
        }else{
            $.post(""+base_url+"ajx/add_aparat_p", {aparat_p:name, id_aparat:id_aparat})
                .done(function(data) {
                    console.log(data);
                    if(data == 0) {
                        alert('Такое название уже есть в базе, выберите из списка.');
                        $("select#add_id_aparat_p_zap").focus();
                    }else{
                        $("select#id_aparat_p_zap_"+id_kvitancy+"").append('<option value="'+data+'" selected="selected">'+name+'</option>');
                        $( "span[name='aparat_p_span']" ).hide();
                        $(document).find('i').removeClass( "icon-minus" ).addClass( "icon-plus" );

                    }
                });
        }
    });


//добавить запчасть на лету
    $('[id^=zap_add_]').click(function(){

        var id_kvitancy = this.name;

        var name =  $.trim($("#zap_name_"+id_kvitancy+"").val());
        var id_aparat = $.trim($("#id_aparat_zap_"+id_kvitancy+" option:selected").val());
        var id_proizvod = $.trim($("#id_proizvod_zap_"+id_kvitancy+" option:selected").val());
        var id_aparat_p = $.trim($("#id_aparat_p_zap_"+id_kvitancy+" option:selected").val());

        if(!id_aparat_p) {
            alert('Надо выбрать запчасть');
            $("select#id_aparat_p_zap_"+id_kvitancy+"").focus();
            exit;
        }else if(!name){
            alert('Введите название');
            $("#zap_name_"+id_kvitancy+"").focus();
            exit;
        } else{
            $.post(""+base_url+"ajx/add_parts", {id_kvitancy:id_kvitancy, name:name, id_aparat:id_aparat, id_aparat_p:id_aparat_p, id_proizvod:id_proizvod})
                .done(function(data) {
                    if(data == 0) {
                        alert('Запчасть НЕ добавлена, попробуйте еще раз.');
                        $("#zap_name_"+id_kvitancy+"").focus();
                    }else{

                        $('fieldset[id^=parts_]').find("input,textarea").each(function () {
                            $(this).attr('value', '');
                        });
                        alert('Запчасть добавлена!');


                    }
                });
        }
    });


//добавить бренд на лету
    $("#add_proizvod").click(function(){
        app = $("#add_proizvod_name").val();

        $.post(""+base_url+"ajx/add_proizvod", {proizvod_name:app})
            .done(function(data) {
                //alert (data);
                if (data.match(/^[-\+]?\d+/) === null) {
                    alert('This brand name already exists');
                    $("#add_proizvod_name").focus();
                } else {

                    $("select#id_proizvod").append('<option value="'+data+'" selected="selected">'+app+'</option>');
                    $("div#id_proizvod_chzn").find('span').html(app);
                    $( "span[name='proizvod_span']" ).hide();
                    $(document).find('i').removeClass( "icon-minus" ).addClass( "icon-plus" );



                }
            });
    });

/*
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

*/






// поиск пользователя при добавлении квинтации.
$( "#search_user" ).keyup(function() {


        var id_sc = $('#id_sc option:selected').val();

		var inputString = $("#search_user").val()
		if(inputString.length > 10) {
                        
				$('#user_box').hide();
					
                } else {
                        $.post(""+base_url+"ajx/search_user", {queryString: ""+inputString+"", id_sc: id_sc}, function(data){
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
/*
    $("form#myform").find("select").filter('[value != ""]').each(function () {

       $(this).attr("class","selected-values");

    });
*/
// END of Подсветить все выбранные value

// вывод под каталога аппарата
    $("#store_add_id_aparat").change(function(){
        $("#store_add_id_aparat_p").load(""+base_url+"ajx/show_aparat_p", { id_aparat: $("#store_add_id_aparat option:selected").val() });
    });
//end add_id_aparat


// вывод online store
    $("div#store_select select").change(function(){
        //alert(base_url);exit;
        $("#store_modal").load(""+base_url+"ajx/show_store", { id_aparat_p:this.value, id_kvitancy:this.title  });
        //alert($("#store_add_id_aparat option:selected").val());
        //alert(this.value);

    });
//end online store



// вывод под каталога аппарата в самой квитанции
    $("[id^=kvitancy_store_id_aparat_]").change(function(){
        var id_kvitancy = this.title;
        //alert (id_kvitancy);exit;
        $("#kvitancy_store_id_aparat_p_"+id_kvitancy+"").load(""+base_url+"ajx/show_aparat_p", { id_aparat: $("#kvitancy_store_id_aparat_"+id_kvitancy+" option:selected").val() });
    });
//end вывод под каталога аппарата в самой квитанции


// вывод online store в самое квитанции
    $("[id^=kvitancy_store_id_aparat_p_]").change(function(){
        var id_kvitancy = this.title;
        var id_aparat_p = $(this).find('option:selected').val();
        //alert (id_aparat_p);exit;
        $("#store_modal_"+id_kvitancy+"").load(""+base_url+"ajx/show_store", { id_aparat_p:id_aparat_p, id_kvitancy:id_kvitancy  });
    });
//end online store в самое квитанции

//chzn select
    $(function() {
        $(".chzn-select").chosen();
        });
//end chzn select

// setup store
    $('a[id^=setup_]').click(function(){
        var parts=new Array();
        parts = this.id.split('_');
        var id = parts[1];

        var id_kvitancy = prompt('Введите номер квитанции?', '');
        if (id_kvitancy) {

            $.post(""+base_url+"ajx/update_ajax_store", {
                id:id,
                id_kvitancy:id_kvitancy
                })
                .done(function(data) {
                    if (data == 1) {
                        $("#store_tr_"+id+"").remove();
                    }else if(data == 0){
                        //alert('Квитанция №'+id_kvitancy+' не найдена!');
                        var text = prompt('Квитанция №'+id_kvitancy+' не найдена! \n Введите под что списать?', '');
                            if(text){
                                $.post(""+base_url+"ajx/setup_ajax_store", {
                                    id:id,
                                    text:text
                                    })
                                    .done(function(data) {
                                        if (data == 1) {
                                            $("#store_tr_"+id+"").remove();
                                        }else{
                                            alert('Запчасть не списана, перезагрузите стараницу и попробуйте еще раз.');
                                        }
                                    });
                            }
                    }
                    else{
                        alert('Запчасть не списана, перезагрузите стараницу и попробуйте еще раз.');
                    }
                });

        }else{
            alert('Надо ввести информацию!');
        }

    });
//end setup store

// save price - Сумма, полученная от клиента за ремонт   tickets view
$('input[id^=save_price_]').click(function(){
        var parts=new Array();
        parts = this.id.split('_');
        var id = parts[2];
        var price = $("#price_"+id+"").val();
        var cash_type = $("#cash_type_"+id+" option:selected").val();
        if(cash_type.length == 0 || price == 0.00) {
            alert('Надо ввести значение и выбрать тип.');exit;
        }

            if(price) {
                $.post(""+base_url+"ajx/save_price", {
                    id:id,
                    price:price
                })
                .done(function(data) {
                    //alert (data);
                    if (data == 0) {
                        alert('Произошла ошибка во время запроса. Попробуйте еще раз.');
                        $("#price_"+id+"").focus();
                    } else {
                        //alert('Добавлено!');
                    }
                });
    if (cash_type == 2){
        if (confirm('Добавить в кассу запись?\n+'+price+', Получено от клиента, '+id+'\nЗапись будет добавлена "Наличные"')) {
        $.post(""+base_url+"ajx/add_cash", {
                price:price,
                id_kvitancy:id,
                name:'Получено от клиента',
                type:cash_type
            })
                .done(function(data) {
                    //alert (data);
                    if (data == 0) {
                        alert('Произошла ошибка во время запроса. Попробуйте еще раз.');

                    } else {
                        alert('Добавлено!');
                    }
                });
        }
     }else{
             if (confirm('Добавить в кассу запись?\n+'+price+', Получено от клиента, '+id+'\nЗапись будет добавлена "Безналичные"')) {
            $.post(""+base_url+"ajx/add_cash", {
                price:price,
                id_kvitancy:id,
                name:'Получено от клиента',
                type:cash_type
            })
                .done(function(data) {
                    //alert (data);
                    if (data == 0) {
                        alert('Произошла ошибка во время запроса. Попробуйте еще раз.');

                    } else {
                        alert('Добавлено!');
                    }
                });
        }
    }
  }


    
});
// end of save price


// add parts 2 store - добавить запчасть на склад из запчастей.
    $('[id^=add_2_store_from_parts_]').click(function(){


        var id = this.name;

        $("[id='parts_add_2_store_"+id+"']").find("input,select,textarea").each(function () {

            if ( ! $(this).val() ) { alert ('Надо выбрать значение '+$(this).attr("name")+'.'); $(this).focus(); exit; }

        });

        //alert(id);exit;
        var name = $("#name_parts_"+id+"").val();
        var serial = $("#serial_parts_"+id+"").val();
        var vid = $("#vid_parts_"+id+"").val();
        var id_sost = $("#id_sost_parts_"+id+"").val();
        var cost = $("#cost_parts_"+id+"").val();


        if(id && cost && name && id_sost) {
            $.post(""+base_url+"ajx/add_parts2store", {
                id:id,
                name:name,
                serial:serial,
                vid:vid,
                id_sost:id_sost,
                cost:cost
            })
                .done(function(data) {
                    //alert (data);
                    if (data == 0) {
                        alert('Произошла ошибка во время запроса. Попробуйте еще раз.');
                        $("#parts_"+id+"").focus();
                    } else {
                        alert('Добавлено!');
                        $("[id^='parts_add_2_store_']").find("input,select,textarea").each(function () {
                            $(this).attr('value', '');
                            location.reload();
                        });
                    }
                });
        }
    });
// end of parts 2 store


// add cash in cash view
    $('button[id=plus_add]').click(function(){



        var id_kvitancy = $("#id_kvitancy").val();

        var plus = $("#plus").val();
        var name = $("#name").val();
        var type = $("#type").val();


       // alert (plus_select);exit;
        if(plus && name && type ) {
            $.post(""+base_url+"ajx/add_cash", {
                price:plus,
                id_kvitancy:id_kvitancy,
                name:name,
                type:type
            })
                .done(function(data) {
                    //alert (data);
                    if (data == 0) {
                        alert('Произошла ошибка во время запроса. Попробуйте еще раз.');

                    } else {
                        alert('Добавлено!');
                        location.reload();
                    }
                });
        }else{
            alert('Надо ввести значения!');
        }

    });
// end of add cash

//	
//	
//ready	
});


/*
Дальше отдельные функции
*/
var base_url = document.getElementById ("myBase").name;

jQuery.fn.clear = function()
{
    var $form = $(this);

    $form.find('input:text, input:password, input:file, textarea').val('');
    $form.find('select option:selected').removeAttr('selected');
    $form.find('input:checkbox, input:radio').removeAttr('checked');

    return this;
};

function fill_apparat_p(thisValue) {

    var parts=new Array();
    var response = thisValue;

    parts = response.split('__');
   // $('input[name=select_parts_'+parts[2]+']').removeAttr('value');
    $('input[name=select_parts_'+parts[2]+']').val(parts[1]);
    $('input[name=select_parts_'+parts[2]+']').attr('title', parts[1]);
    $('input[name=select_parts_'+parts[2]+']').attr('id', parts[0]);

    setTimeout("$('#parts_box_"+parts[2]+"').hide();", 200);
}

function fill_user(thisValue) {

			$('#user_id').val('');

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
	$(obj).find('i').removeClass( "icon-plus" ).addClass( "icon-minus" );
		} else {
	$(objName).animate({height: 'hide'}, 200);
        $(obj).find('i').removeClass( "icon-minus" ).addClass( "icon-plus" );
		}
}

function anichange_kvitancy (obj) {
    var objName = $(obj).next();
    var objPrev = $(obj).prev();
    var tr = $(obj).parent().parent();
    //console.log(tr);exit
    if ( $(objName).css('display') == 'none' ) {

             $(objName).animate({height: 'show'}, 400);
             $(obj).css('font-weight','bold');


        $(tr).siblings().each(function() {
            $(tr).css('opacity','1');
            $(this).css('opacity','0.5');
        });


    } else {

        $(objName).animate({height: 'hide'}, 200);
        $(obj).css('font-weight','normal');
        $(tr).siblings().each(function() {
            $(this).css('opacity','1');
        });


    }
}


function anichange_kvitancy_new (id_kvitancy) {

    //var table = $(obj).parent().parent().parent().parent();
    var table = $('table#anichange_'+id_kvitancy+'');
    var objName = table.next();
    var obj = table;
    var tr = $(obj).parent().parent();
    //console.log(objName);exit;

        if ( $(objName).css('display') == 'none' ) {

             $(objName).animate({height: 'show'}, 400);
             $(obj).css('font-weight','bold');

        $(table).css('background-color','#f9f9f9');
            
        $(tr).siblings().each(function() {
            $(tr).css('opacity','1');
            $(this).css('opacity','0.5');
        });


    } else {

        $(objName).animate({height: 'hide'}, 200);
        $(obj).css('font-weight','normal');
        $(tr).siblings().each(function() {
            $(this).css('opacity','1');
        });

        $(table).css('background-color','#fff');


    }

}


function anichange_kvitancy_stat (obj) {
    var objName = $('div#'+obj+'');
    var objPrev = $(obj).prev();
    var tr = $(obj).parent().parent();
    //console.log(tr);exit
    if ( $(objName).css('display') == 'none' ) {

             $(objName).animate({height: 'show'}, 400);
             $(obj).css('font-weight','bold');


        $(tr).siblings().each(function() {
            $(tr).css('opacity','1');
            $(this).css('opacity','0.5');
        });


    } else {

        $(objName).animate({height: 'hide'}, 200);
        $(obj).css('font-weight','normal');
        $(tr).siblings().each(function() {
            $(this).css('opacity','1');
        });


    }
}


function look_apparat(inputString) {
                if(inputString.length > 10) {
                        $('#apparat_box').hide();
                } else {
                        $.post(""+base_url+"ajx/look_apparat", {queryString: ""+inputString+""}, function(data){
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
                        $.post(""+base_url+"ajx/look_proizvod", {queryString: ""+inputString+""}, function(data){
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

function fill_store(store_id, id_kvitancy) {

    if (confirm('Хотите списать эту запчасть? \nНа квитанцию '+id_kvitancy+'?')) {
    $.post(""+base_url+"ajx/get_store_by_id", {
        id:store_id
    })
        .done(function(data) {
            //console.log(data);
                $("#table_store_"+id_kvitancy+"").append(data);


            $.post(""+base_url+"ajx/update_ajax_store", {
                id:store_id,
                id_kvitancy:id_kvitancy
                })
                    .done(function(data) {
                        if (data == 1) {
                            $("#online_store_tr_"+store_id+"").remove();
                        }else{
                            alert('Запчасть не списана, перезагрузите стараницу и попробуйте еще раз.');
                        }
                    });

        });
    }
}