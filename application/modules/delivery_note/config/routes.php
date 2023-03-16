<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['add_delivery_note']         = "delivery_note/delivery_note/bdtask_delivery_note_form";
$route['pos_delivery_note']         = "delivery_note/delivery_note/bdtask_pos_delivery_note";
$route['gui_pos']             = "delivery_note/delivery_note/bdtask_gui_pos";
$route['delivery_note_list']        = "delivery_note/delivery_note/bdtask_delivery_note_list";
$route['delivery_note_details/(:num)'] = 'delivery_note/delivery_note/bdtask_delivery_note_details/$1';
$route['delivery_note_pad_print/(:num)'] = 'delivery_note/delivery_note/bdtask_delivery_note_pad_print/$1';
$route['pos_print/(:num)']    = 'delivery_note/delivery_note/bdtask_delivery_note_pos_print/$1';
$route['delivery_note_pos_print']    = 'delivery_note/delivery_note/bdtask_pos_print_direct';
$route['download_delivery_note/(:num)']  = 'delivery_note/delivery_note/bdtask_download_delivery_note/$1';
$route['delivery_note_edit/(:num)'] = 'delivery_note/delivery_note/bdtask_edit_delivery_note/$1';
$route['delivery_note_print'] = 'delivery_note/delivery_note/delivery_note_inserted_data_manual';
$route['delivery_note_delete/(:num)'] = 'delivery_note/delivery_note/bdtask_delete_delivery_note/$1';
