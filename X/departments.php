<?php
require_once '../securex/extra/auth.php';
$user = Auth::user();

require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('department');
$data->join('department_head','officers','ID');
$data->columns('ID,department_name,department_abbrev,department_type,department_head');
$data->fields('vote,department_name,department_abbrev,department_type,department_head');
$data->column_pattern('department_head', '{officers.officer_title_short} - {officers.first_name} {officers.last_name}');
$data->relation('department_type','department_type','department_type','department_type','');
$data->relation('vote','votes','VoteCode','VoteName');
$data->relation('department_head','officers','ID','officer_title_short')
    ->set_lang('add','Add New Department');



echo $data->render();

