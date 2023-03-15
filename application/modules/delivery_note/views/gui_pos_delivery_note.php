<link href="<?php echo base_url('assets/css/gui_pos.css') ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>my-assets/js/admin_js/pos_delivery_note.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>my-assets/js/admin_js/guibarcode.js" type="text/javascript"></script>
<script src="assets/js/perfect-scrollbar.min.js" type="text/javascript"></script>
      <style type="text/css">
        li{
          cursor: pointer;
        }
        input{
          border-radius: 8px;
          height: 8px;
          border: 1px solid #0073ac;
        }
        .main-header .sidebar-toggle{

          padding: 13px !important;
          height: 60px;
          border-radius: 0px;
          width: 45px;
          display: flex;
          align-items: center;
          /*width: 50px;
          height: 60px;
          display: flex;
          align-items: center;*/
          /*display: none;*/
        }
        .sidebar-mini .pace-done .sidebar-collapse{
          width: 50px;
        }
        .content{
          /*margin-top: -60px;*/
        }
      </style>



<div class="pl-3 pr-3"> 
   <div class="top-bar" style="background: #eeeeee !important ">
    <ul class="nav nav-tabs" role="tablist">
        <li class="active">
        <a href="#home" role="tab" data-toggle="tab" class="home btn-primary" id="new_sale" style="color: white; border-radius: 8px;">
        New Sale </a>
        </li>
        <li class="onprocessg"><a href="#saleList" role="tab" data-toggle="tab" class="ongord btn-primary" style="color: white; border-radius: 8px;" id="todays_salelist">
        Todays sale                               </a>
        </li>
    </ul>
      <div class="tgbar d-flex">
        
<!--         <a href="" class="topbar-icon" id="keyshortcut" aria-hidden="true" data-toggle="modal" data-target="#cheetsheet"><i class="fa fa-keyboard-o"></i></a> -->
        </div>
</div>
<!-- Tab panes -->
<div class="tab-content" style="background-color: white !important; padding: 10px;">
    <div class="tab-pane fade active in" id="home">
    <div class="row">
    <div class="col-sm-12 col-md-6">

    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
             <div class="tab" role="tabpanel">
                          
                         <ul id="category_typss" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active" >
                               <a href="#Section1" style="font-size: 15px;" aria-controls="home" role="tab" data-toggle="tab">
                                  <div class=""  id="all" onclick="check_category('all')">
                                     All
                                  </div>
                               </a>
                            </li>
                            <?php if($categorylist){?>
                            <?php foreach($categorylist as $categories){?>
                            <li  role="presentation">
                               <a type="checkbox" style="font-size: 15px;" autocomplete="off" id="cat_<?php echo $categories['category_id']?>" value="<?php echo $categories['category_id']?>" onclick="check_category(<?php echo $categories['category_id']?>)" name="cat_id[]">
                                <?php echo $categories['category_name']?>
                               </a>
                            </li>
                            <?php }} ?>
                         </ul>
                                                  
                                    <input name="url" type="hidden" id="posurl" value="<?php echo base_url("delivery_note/delivery_note/getitemlist") ?>" />
     <input name="url" type="hidden" id="posurl_productname" value="<?php echo base_url("delivery_note/delivery_note/getitemlist_byname") ?>" />               
                                                
                                                </div><br>
    </div>
    <div class="col-xs-8 col-sm-9 col-md-8 col-lg-9 col-xl-10 " id="style-3">

    <div class="row search-bar">
    <div class="col-sm-6">
    <!-- Actual search box -->
    <div class="form-group has-feedback has-search">
    <span class="ti-search form-control-feedback d-flex align-items-center justify-content-center"></span>
    <input type="text" class="form-control" id="product_name" placeholder="Search Product">
    </div>
    </div>
    <div class="col-sm-6">
    <form class="navbar-search">
    <label class="sr-only screen-reader-text" for="search">Search :</label>
    <div class="input-group">
    <select name="productlist" class="form-control filter-select"  onchange="onselectimage(this.value)">
    <option value='' selected>Select Product</option>
     <?php if($product_list){?>
      <?php foreach($product_list as $products){?>
       <option value="<?php echo $products['product_id']?>"><?php echo $products['product_name']?></option>
      <?php }}?>
    </select>
    </div>
    </form>
    </div>
    </div>



   <div class="product-grid">
    <div class="row row-m-3" id="product_search">
        <?php $i=0;
                  if($itemlist){
                            foreach($itemlist as $item){
                                
                                ?>
        <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 col-p-3">
        <div class="product-panel overflow-hidden border-0 shadow-sm" id="image-active_<?php echo $item->product_id ?>">
            <div class="item-image position-relative overflow-hidden">
                <div class="" id="image-active_count_<?php echo $item->product_id ?>"><span id="active_pro_<?php echo $item->product_id ?>" class="active_qty"></span></div>
                <img src="<?php echo !empty($item->image)?$item->image:'assets/img/icons/default.jpg'; ?>" onclick="onselectimage('<?php echo $item->product_id ?>')" alt="" class="img-responsive">
            </div>
            <div class="panel-footer border-0 bg-white" onclick="onselectimage('<?php echo $item->product_id ?>')">
                <h3 class="item-details-title"><?php echo  $text=html_escape($item->product_name);?></h3>
            </div>
        </div>
        </div>

        <?php }}?>


        <?php $i=0;
                  if($itemlist){
                            foreach($itemlist as $item){
                                ?>

        <!-- <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 col-p-3">
        <div class="product-panel overflow-hidden border-0 shadow-sm" id="image-active_<?php echo $item->product_id ?>">
            <div class="item-image position-relative overflow-hidden">
                <div class="" id="image-active_count_<?php echo $item->product_id ?>"><span id="active_pro_<?php echo $item->product_id ?>" class="active_qty"></span></div>
                <img src="<?php echo !empty($item->image)?$item->image:'assets/img/icons/default.jpg'; ?>" onclick="onselectimage('<?php echo $item->product_id ?>')" alt="" class="img-responsive">
            </div>
            <div class="panel-footer border-0 bg-white" onclick="onselectimage('<?php echo $item->product_id ?>')">
                <h3 class="item-details-title"><?php echo  $text=html_escape($item->product_name);?></h3>
            </div>
        </div>
        </div> -->

        <?php }}?>

                <?php $i=0;
                  if($itemlist){
                            foreach($itemlist as $item){
                                ?>

       <!--  <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 col-p-3">
        <div class="product-panel overflow-hidden border-0 shadow-sm" id="image-active_<?php echo $item->product_id ?>">
            <div class="item-image position-relative overflow-hidden">
                <div class="" id="image-active_count_<?php echo $item->product_id ?>"><span id="active_pro_<?php echo $item->product_id ?>" class="active_qty"></span></div>
                <img src="<?php echo !empty($item->image)?$item->image:'assets/img/icons/default.jpg'; ?>" onclick="onselectimage('<?php echo $item->product_id ?>')" alt="" class="img-responsive">
            </div>
            <div class="panel-footer border-0 bg-white" onclick="onselectimage('<?php echo $item->product_id ?>')">
                <h3 class="item-details-title"><?php echo  $text=html_escape($item->product_name);?></h3>
            </div>
        </div>
        </div> -->

        <?php }}?>
                <?php $i=0;
                  if($itemlist){
                            foreach($itemlist as $item){
                                ?>

        <!-- <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 col-p-3">
        <div class="product-panel overflow-hidden border-0 shadow-sm" id="image-active_<?php echo $item->product_id ?>">
            <div class="item-image position-relative overflow-hidden">
                <div class="" id="image-active_count_<?php echo $item->product_id ?>"><span id="active_pro_<?php echo $item->product_id ?>" class="active_qty"></span></div>
                <img src="<?php echo !empty($item->image)?$item->image:'assets/img/icons/default.jpg'; ?>" onclick="onselectimage('<?php echo $item->product_id ?>')" alt="" class="img-responsive">
            </div>
            <div class="panel-footer border-0 bg-white" onclick="onselectimage('<?php echo $item->product_id ?>')">
                <h3 class="item-details-title"><?php echo  $text=html_escape($item->product_name);?></h3>
            </div>
        </div>
        </div> -->

        <?php }}?>


        </div>
    </div>               
</div>
</div>
</div>
<div class="col-sm-12 col-md-6">
      <form class="form-inline mb-3">
            <div class="form-group">
            <input type="text" id="add_item" class="form-control" placeholder="Barcode or QR-code scan here">
            </div>
            <div class="form-group">
            <label class="mr-3 ml-3">OR</label>                                 
            </div>
            <div class="form-group">
            <input type="text" class="form-control" id="add_item_m" placeholder="Manual Input barcode">
            </div>
      </form>
 <?php echo form_open_multipart('delivery_note/delivery_note/bdtask_manual_sales_insert', array('class' => 'form-vertical', 'id' => 'gui_sale_insert', 'name' => 'insert_pos_delivery_note')) ?>
<div class="d-flex align-items-center mb-5">
<div class="input-group mr-3">
<input type="text" class="form-control customerSelection" id="customer_name" value="<?php echo $customer_name;?>" tabindex="3"  onkeyup="customer_autocomplete()"  name="customer_name">
<input id="autocomplete_customer_id" class="customer_hidden_value" type="hidden" name="customer_id" value="<?php echo $customer_id?>">
<span class="input-group-btn">
<button class="client-add-btn btn pos_add_btn " type="button" aria-hidden="true" data-toggle="modal" data-target="#cust_info" id="customermodal-link" tabindex="4"><i class="ti-plus"></i></button>
</span>
</div><!-- /input-group -->

<div class="d-flex align-items-center">
<label class="mr-2 mb-0"><?php echo display('delivery_note_no');?> - <i class="text-danger"></i></label>
<div class="delivery_note-no" id="gui_delivery_note_no">
<?php echo html_escape($delivery_note_no); ?>

</div>
 <input class="form-control" type="hidden"  name="delivery_note_no" id="delivery_note_no" required value="<?php echo html_escape($delivery_note_no); ?>" readonly/>
</div>
</div>


<input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">

<div class="table-responsive guiproductdata">
<table class="table table-stripped table-hover table-sm nowrap gui-products-table" id="adddelivery_note">
<thead style="background-color: #eeeeee;">
   <tr>
      <th class="text-center gui_productname"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
      <th class="text-center delivery_note_fields"><?php echo display('serial') ?></th>
      <th class="text-center"><?php echo display('available_qnty') ?></th>
      <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
      <th class="text-center"><?php echo display('rate') ?> <i class="text-danger">*</i></th>
         <?php if ($discount_type == 1) { ?>
          <th class="text-center"><?php echo display('disc') ?></th>
      <?php } elseif ($discount_type == 2) { ?>
          <th class="text-center"><?php echo display('discount') ?> </th>
      <?php } elseif ($discount_type == 3) { ?>
          <th class="text-center"><?php echo display('fixed_dis') ?> </th>
      <?php } ?>
      <th class="text-center"><?php echo display('total') ?></th>
      <th class="text-center"><?php echo display('action') ?></th>
   </tr>
</thead>
<tbody id="adddelivery_noteItem">

</tbody>
</table>
</div>
<div class="footer">
<div class="form-group row guifooterpanel">
<div class="col-sm-12">
<label for="date" class="col-sm-6 col-lg-6 col-xl-7 col-form-label"><?php echo display('delivery_note_discount') ?>:</label>
<div class="col-sm-6 col-lg-5 col-xl-4">
<input
type="text"
onkeyup="quantity_calculate(1);"  onchange="quantity_calculate(1);" id="delivery_note_discount"
class="form-control total_discount gui-foot text-right"
name="delivery_note_discount" placeholder="0.00"/>
<input type="hidden" id="txfieldnum" value="<?php echo $taxnumber?>" />
<input type="hidden" name="paytype" value="1" />
</div>
</div>
</div>
<div class="form-group row guifooterpanel">
<div class="col-sm-12">
<label for="date" class="col-sm-6 col-lg-6 col-xl-7 col-form-label"><?php echo display('total_discount') ?>:</label>
<div class="col-sm-6 col-lg-5 col-xl-4"><input type="text" id="total_discount_ammount" class="form-control gui-foot text-right" name="total_discount" value="0.00" readonly="readonly" /></div>
</div>
</div>
<div class="form-group row hiddenRow guifooterpanel" id="taxdetails">
    <?php $x=0;
    foreach($taxes as $taxfldt){?>
<div class="col-sm-12">
<label for="date" class="ol-sm-6 col-lg-6 col-xl-7 col-form-label"><?php echo html_escape($taxfldt['tax_name']) ?>:</label>
<div class="col-sm-6 col-lg-5 col-xl-4">
 <input id="total_tax_ammount<?php echo $x;?>" tabindex="-1" class="form-control gui-foot text-right valid totalTax" name="total_tax<?php echo $x;?>" value="0.00" readonly="readonly" aria-invalid="false" type="text">
</div>
</div>
<?php $x++;}?>
</div>
<div class="form-group row guifooterpanel">
<div class="col-sm-12">
<label for="date" class="col-sm-6 col-lg-6 col-xl-7 col-form-label"><?php echo display('total_tax') ?>:</label>
<div class="col-sm-6 col-lg-5 col-xl-4"><input id="total_tax_amount" tabindex="-1" class="form-control gui-foot text-right valid" name="total_tax" value="0.00" readonly="readonly" aria-invalid="false" type="text" /></div>
<a class="col-sm-1 btn btn-primary btn-sm taxbutton" data-toggle="collapse" data-target="#taxdetails" aria-expanded="false" aria-controls="taxdetails"><i class="fa fa-angle-double-up"></i></a>
</div>
</div>
<div class="form-group row guifooterpanel">
<div class="col-sm-12">
<!-- <label for="date" class="col-sm-6 col-lg-6 col-xl-7 col-form-label"><?php echo display('shipping_cost') ?>:</label>
<div class="col-sm-6 col-lg-5 col-xl-4">
<input
type="text"
id="shipping_cost"
class="form-control gui-foot text-right"
name="shipping_cost" onkeyup="quantity_calculate(1);"  onchange="quantity_calculate(1);" placeholder="0.00"/>
</div> -->
</div>
</div>
<div class="form-group row guifooterpanel">
<div class="col-sm-12">
<label for="date" class="col-sm-6 col-lg-6 col-xl-7 col-form-label"><?php echo display('grand_total') ?>:</label>
<div class="col-sm-6 col-lg-5 col-xl-4"><input type="text" id="grandTotal" class="form-control gui-foot text-right" name="grand_total_price" value="0.00" readonly="readonly" />
   <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url(); ?>" id="baseurl"/>
</div>
</div>
</div>

<div class="form-group row guifooterpanel">
<div class="col-sm-12">
<label for="date" class="col-sm-6 col-lg-6 col-xl-7 col-form-label"><?php echo display('previous'); ?>:</label>
<div class="col-sm-6 col-lg-5 col-xl-4"><input type="text" id="previous" class="form-control gui-foot text-right" name="previous" value="0.00" readonly="readonly" /></div>
</div>
</div>
<div class="form-group row guifooterpanel">
<div class="col-sm-12">
<label for="change" class="col-sm-6 col-lg-6 col-xl-7 col-form-label"><?php echo display('change'); ?>:</label>
<div class="col-sm-6 col-lg-5 col-xl-4"><input type="text" id="change" class="form-control gui-foot text-right" name="change" value="0.00" readonly="readonly" /></div>
</div>
</div>
</div>

<div class="fixedclasspos">
<div class="bottomarea">
<div class="row">
<div class="col-lg-8 col-xl-8">
<div class="calculation d-lg-flex">
<div class="cal-box d-lg-flex align-items-lg-center mr-4">
<label class="cal-label mr-2 mb-0"><?php echo display('net_total'); ?>:</label><span class="amount" id="net_total_text">0.00</span> 
<input type="hidden" id="n_total" class="form-control text-right guifooterfixedinput" name="n_total" value="0" readonly="readonly" placeholder=""  />   
</div>
<div class="cal-box d-lg-flex align-items-lg-center mr-4">
<div class="form-inline d-inline-flex align-items-center">
<label class="cal-label mr-2 mb-0"><?php echo display('paid_ammount') ?>:</label>
<input type="text" class="form-control" id="paidAmount"  onkeyup="delivery_note_paidamount()" name="paid_amount" onkeypress="delivery_note_paidamount()" placeholder="0.00">
</div>
</div>
<div class="cal-box d-lg-flex align-items-lg-center mr-4">
<label class="cal-label mr-2 mb-0"><?php echo display('due') ?>:</label><span class="amount" id="due_text">0.00</span>
<input type="hidden" id="dueAmmount" class="form-control text-right guifooterfixedinput" name="due_amount" value="0.00" readonly="readonly"/>
</div>
</div>
</div>
<div class="col-lg-4 col-xl-4 text-xl-right">
<div class="action-btns d-flex justify-content-end">
<input type="button" id="full_paid_tab" class="btn btn-warning btn-lg mr-2" value="Full Paid" tabindex="14" onClick="full_paid()"/>
<input type="submit" id="add_delivery_note" class="btn long_purple_button" name="add_delivery_note" value="Save Sale">
<a href="#" class="btn btn-primary" data-toggle="modal" id="calculator_modal" data-target="#calculator"><i class="fa fa-calculator" aria-hidden="true"></i> </a> 
</div>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
<div class="tab-pane fade" id="saleList">
<div class="panel panel-default">
<div class="panel-body">
<div class="table-responsive padding10" id="invoic_list">
          <table id="gui_productinfo" class="table table-stripped  table-hover  ">
                                <thead style="background-color: #eeeeee;">
                                    <tr>
                                      <th><?php echo display('sl') ?></th>
                                      <th><?php echo display('delivery_note_no') ?></th>
                                      <th><?php echo display('delivery_note_id') ?></th>
                                      <th><?php echo display('customer_name') ?></th>
                                      <th><?php echo display('date') ?></th>
                                      <th><?php echo display('total_amount') ?></th>
                                      <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="gui_tbody">
                                    <?php
                                    $total = '0.00';
                                    $sl = 1;
                                    if ($todays_delivery_note) {
                                        foreach($todays_delivery_note as $delivery_notes_list){
                                        ?>
                                  
                                        <tr>
                                            <td><?php echo $sl ; ?></td>
                                            <td>
                                                <a href="<?php echo base_url() . 'delivery_note_details/'.$delivery_notes_list['delivery_note_id']; ?>">
                                                 
                                                    <?php echo html_escape($delivery_notes_list['delivery_note']); ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url() . 'delivery_note_details/'.$delivery_notes_list['delivery_note_id']; ?>">
                                                  <?php echo $delivery_notes_list['delivery_note_id']?>  
                                                </a>
                                            </td>
                                            <td>
                                               <?php echo html_escape($delivery_notes_list['customer_name'])?>           
                                            </td>

                                            <td><?php echo $delivery_notes_list['date']?></td>
                                            <td class="text-right"><?php 
                                            if($position == 0){
                                              echo $currency.$delivery_notes_list['total_amount'];  
                                            }else{
                                            echo $delivery_notes_list['total_amount'].$currency; 
                                            }
                                            $total += $delivery_notes_list['total_amount']; ?></td>
                                            <td>
                                    <center>
                                        <?php echo form_open() ?>

                                        <a href="<?php echo base_url() . 'delivery_note_details/'.$delivery_notes_list['delivery_note_id']; ?>" class="btn payment_btn" data-toggle="tooltip" data-placement="left" title="<?php echo display('delivery_note') ?>"><i class="fal fa-window-restore" aria-hidden="true"></i></a>
                                    <a href="<?php echo base_url() . 'delivery_note_pad_print/'.$delivery_notes_list['delivery_note_id']; ?>" class="btn action_btn" data-toggle="tooltip" data-placement="left" title="<?php echo 'Pad Print' ?>"><i class="fal fa-fax" aria-hidden="true"></i></a>

                                        <a href="<?php echo base_url() . 'pos_print/'.$delivery_notes_list['delivery_note_id']; ?>" class="btn details_btn" data-toggle="tooltip" data-placement="left" title="<?php echo display('pos_delivery_note') ?>"><i class="fal fa-fax" aria-hidden="true"></i></a>
                                        <?php if($this->permission1->method('manage_delivery_note','update')->access()){ ?>

                                        <a href="<?php echo base_url() . 'delivery_note_edit/'.$delivery_notes_list['delivery_note_id']; ?>" class="btn edit_btn" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fal fa-pencil" aria-hidden="true"></i></a>
                                    <?php }?>
                              
                                        <?php echo form_close() ?>
                                    </center>
                                    </td>
                                    </tr>
                                 
                                    <?php
                                $sl++;}
                                }
                                ?>
                                </tbody>
                               
                            </table>

</tbody>

</table>

</div>

</div>
</div>

</div>


</div>
</div>




<div id="detailsmodal" class="modal fade" role="dialog">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
<a href="#" class="close" data-dismiss="modal">&times;</a>
<strong><center> <?php echo display('product_details')?></center></strong>
</div>
<div class="modal-body">

<div class="row">
<div class="col-sm-12 col-md-12">
<div class="panel panel-bd">

<div class="panel-body"> 
<span id="modalimg"></span><br>  
<h4><?php echo display('product_name')?> :<span id="modal_productname"></span></h4>
<h4><?php echo display('product_model')?> :<span id="modal_productmodel"></span></h4>
<h4><?php echo display('price')?> :<span id="modal_productprice"></span></h4>
<h4><?php echo display('unit')?> :<span id="modal_productunit"></span></h4>
<h4><?php echo display('stock')?> :<span id="modal_productstock"></span></h4>



</div>  
</div>
</div>
</div>

</div>

</div>
<div class="modal-footer">

</div>

</div>

</div>


<div class="modal fade" id="printconfirmodal" tabindex="-1" role="dialog" aria-labelledby="printconfirmodal" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<a href="" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
<h4 class="modal-title" id="myModalLabel"><?php echo display('print')?></h4>
</div>
<div class="modal-body">
<?php echo form_open('delivery_note_pos_print', array('class' => 'form-vertical', 'id' => '', 'name' => '')) ?>
<div id="outputs" class="hide alert alert-danger"></div>
<h3> <?php echo display('successfully_inserted')?> </h3>
<h4><?php echo display('do_you_want_to_print') ?> ??</h4>
<input type="hidden" name="delivery_note_id" id="inv_id">
<input type="hidden" name="url" value="<?php echo base_url('gui_pos');?>">
</div>
<div class="modal-footer">
<button type="button" onclick="cancelprint()" class="btn btn-default" data-dismiss="modal"><?php echo display('no') ?></button>
<button type="submit" class="btn btn-primary" id="yes"><?php echo display('yes') ?></button>
<?php echo form_close() ?>
</div>
</div>
</div>
</div>

<div class="modal fade" id="cheetsheet" tabindex="-1" role="dialog" aria-labelledby="cheetsheet" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
<a href="" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
<h4 class="modal-title">Keyboard Shortcut</h4>
</div>
<div class="modal-body">
<table class="table table-bordered">
  
  <thead>
    <tr>
      <th>Event</th>
      <th>key</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-center">Submit Invoice</td>
      <td class="text-center">ctrl+s</td>
    </tr>
    <tr>
      <td class="text-center">Add New Customer</td>
      <td class="text-center">shif+c</td>
    </tr>
     <tr>
      <td class="text-center">Full Paid</td>
      <td class="text-center">shif+f</td>
    </tr>
    <tr>
      <td class="text-center">Today's Sale List</td>
      <td class="text-center">shif+l</td>
    </tr>
     <tr>
      <td class="text-center">New Sale</td>
      <td class="text-center">shif+n</td>
    </tr>
     <tr>
      <td class="text-center">Open Calculator</td>
      <td class="text-center">alt+c</td>
    </tr>
    <tr>
      <td class="text-center">Search Old Customer</td>
      <td class="text-center">alt+n</td>
    </tr>
    <tr>
      <td class="text-center">Invoice Discount</td>
      <td class="text-center">ctrl+d</td>
    </tr>
     <tr>
      <td class="text-center">Shipping Cost</td>
      <td class="text-center">alt+s</td>
    </tr>
     <tr>
      <td class="text-center">Paid Amount</td>
      <td class="text-center">alt+p</td>
    </tr>
  </tbody>
</table>
</div>

</div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#gui_productinfo').DataTable( {

        dom: 'Bfrtip',
        destroy: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Orders here"
        },
        buttons: [
            {
              extend:    'copyHtml5',
              text:      '<i class="fal fa-copy"> <span class="btn-span">Copy</span></i>',
              titleAttr: 'Copy'
            },
            {
              extend:    'excelHtml5',
              text:      '<i class="fal fa-file-csv"> <span class="btn-span">Excel</span></i>',
              titleAttr: 'Excel'
            },
            {
              extend:    'csvHtml5',
              text:      '<i class="fal fa-file-excel"> <span class="btn-span">CSV</span></i>',
              titleAttr: 'CSV'
            },
            {
              extend:    'pdfHtml5',
              text:      '<i class="fal fa-file-pdf"> <span class="btn-span">PDF</span></i>',
              titleAttr: 'PDF'
            },
            {
              extend: 'print',
              text: '<i class="fal fa-print"> <span class="btn-span">Print</span></i>',
            }
        ]
    } );
} );
</script>
<script src="<?php echo base_url() ?>assets/js/perfect-scrollbar.min.js" ></script>


 <script>
                                                $('.product-grid').each(function () {
                                                    const ps = new PerfectScrollbar($(this)[0]);
                                                });
        
        </script>
