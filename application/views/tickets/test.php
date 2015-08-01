<?php

echo form_open('tickets', array('class' => 'form-inline reset-margin', 'id' => 'myform'));

echo form_label('№квит:', 'id_kvitancy');
echo form_input('id_kvitancy', $id_kvitancy_selected);

echo form_label('Поиск:', 'search_string');
echo form_input('search_string', $search_string_selected);

echo form_label('Дата: ');
$options_date = array('date_priemka' => 'Приемка', 'date_vydachi' => 'Выдачи', 'date_okonchan' => 'Окон.ремонта');
echo form_dropdown('date', $options_date, $date_selected, 'class="btn dropdown-toggle"');

echo form_label('C: ');
echo form_date('start_date', $start_date);

echo form_label('По: ');
echo form_date('end_date', $end_date);

echo form_label('Приемка: ');
$options_id_sc = array('' => "Выбрать");

    foreach ($sc as $array) {
        $options_id_sc[$array['id_sc']] = $array['name_sc'];
    }
echo form_dropdown('id_sc', $options_id_sc, $id_sc_selected, 'class="selectpicker"');

echo form_label('Механик: ');
$options_id_meh = array('' => "-механик-");

    foreach ($meh as $array) {
        $options_id_meh[$array['id']] = $array['user_name'];
    }
echo form_dropdown('id_mechanic', $options_id_meh, $id_mechanic_selected, 'class="span2"');


echo form_label('Бренд: ');
$options_proizvoditel = array('' => "Выбрать");

    foreach ($proizvoditel as $array) {
        $options_proizvoditel[$array['id_proizvod']] = $array['name_proizvod'];
    }
echo form_dropdown('id_proizvod', $options_proizvoditel, $id_proizvod_selected, 'class="span2"');


echo form_label('Аппарат: ');
$options_ap = array('' => "Выбрать");

    foreach ($ap as $array) {
        $options_ap[$array['id_aparat']] = $array['aparat_name'];
    }
echo form_dropdown('id_aparat', $options_ap, $id_aparat_selected, 'class="span2"');


echo form_label('Состояние: ');
    $options_sost = array('' => "Все [что в ремонте]");
        foreach ($sost as $array) {
            $options_sost[$array['id_sost']] = $array['name_sost'];
        }
echo form_dropdown('id_sost', $options_sost, $id_sost_selected, 'class="span2"');


echo form_label('Сортировать как: ');
$options_order_type = array('Asc' => 'С начала', 'Desc' => 'С конца');
echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span2"');


echo form_label('Вид ремонта: ');
$options_id_remonta = array('' => "Выбрать");
    foreach ($remont as $array) {
        $options_id_remonta[$array['id_remonta']] = $array['name_remonta'];
    }
echo form_dropdown('id_remonta', $options_id_remonta, $id_remonta_selected, 'class="span2"');

echo form_submit(array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Поиск'));

echo form_close();
?>