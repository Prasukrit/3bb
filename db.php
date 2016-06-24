<?php
/*
 * Example PHP implementation used for the index.html example
 */
 
// DataTables PHP library
include ("php/DataTables.php");
// Alias Editor classes so they are easy to use
use DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;

Editor::inst($db, 'project')
 ->fields(
 	Field::inst('id'),
  	Field::inst('project_name')->validator('Validate::notEmpty'),
  	Field::inst('location_code')->validator('Validate::notEmpty'),
  	Field::inst('province')->validator('Validate::notEmpty'),
  	Field::inst('district')->validator('Validate::notEmpty'),
  	Field::inst('sub_district'),
  	Field::inst('address'),
  	Field::inst('builder'),
  	Field::inst('location_name'),
  	Field::inst('location_lat_long'),
  	Field::inst('node_nearby'),
  	Field::inst('remark'),
  	Field::inst('type')->validator('Validate::notEmpty'),
  	Field::inst('status')
 )


 ->process($_POST)
 ->json();
?>