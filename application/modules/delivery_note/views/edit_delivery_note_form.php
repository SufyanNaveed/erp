<script src="<?php echo base_url() ?>my-assets/js/admin_js/delivery_note.js" type="text/javascript"></script>
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('delivery_note_edit') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open('delivery_note/delivery_note/bdtask_update_delivery_note', array('class' => 'form-vertical', 'id' => 'update_delivery_note')) ?>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-3 col-form-label"><?php echo display('customer_name').'/'.display('phone') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="customer_name" value="<?php echo $customer_name?>"  onkeyup="customer_autocomplete()" class="form-control customerSelection" placeholder='<?php echo display('customer_name') ?>' required id="customer_name" tabindex="1">

                                        <input type="hidden" class="customer_hidden_value" name="customer_id" value="<?php echo $customer_id;?>" id="autocomplete_customer_id"/>
                                    </div>
                                </div>
                            </div>
                             <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="payment_type" class="col-sm-3 col-form-label"><?php
                                        echo display('payment_type');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                        <select name="paytype" class="form-control" required="" onchange="bank_paymet(this.value)">
                                            <option value="">Select Payment Option</option>
                                            <option value="1" <?php if($paytype ==1){echo 'selected';}?>>Cash Payment</option>
                                            <option value="2"  <?php if($paytype ==2){echo 'selected';}?>>Bank Payment</option> 
                                        </select>
                                      

                                     
                                    </div>
                                 
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-3 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                        <input type="text" tabindex="2" class="form-control datepicker" name="delivery_note_date" value="<?php echo $date?>"  required />
                                    </div>
                                </div>
                            </div>
                             <div class="col-sm-6">
                                 <div class="form-group row">
                                <label for="delivery_note_no" class="col-sm-3 col-form-label"><?php
                                    echo display('delivery_note_no');
                                    ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                         <input class="form-control" type="text"  name="delivery_note_no" id="delivery_note_no" required value="<?php echo html_escape($delivery_note); ?>" readonly/>
                                    </div>
                            </div>
                        </div>
                        <div class="col-sm-6" id="bank_div">
                            <div class="form-group row">
                                <label for="bank" class="col-sm-3 col-form-label"><?php
                                    echo display('bank');
                                    ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <select name="bank_id" class="form-control bankpayment"  id="bank_id">
                                        <option value="">Select Location</option>
                                        <?php foreach($bank_list as $bank){?>
                                            <option value="<?php echo html_escape($bank['bank_id'])?>" <?php if($bank['bank_id'] == $bank_id){echo 'selected';}?>><?php echo html_escape($bank['bank_name']);?></option>
                                        <?php }?>
                                    </select>
                                  <input type="hidden" id="editpayment_type" value="<?php echo $paytype;?>" name="">
                                </div>
                             
                            </div>
                        </div>
                        <div class="col-sm-6" >
                            <div class="form-group row">
                                <label for="invoicetype" class="col-sm-3 col-form-label"><?php
                                    echo 'Invoice Type';
                                    ?> <?php echo $invoicetype; ?></label>
                                <div class="col-sm-6">
                                   <select name="invoicetype" class="form-control bankpayment"  id="invoicetype" required onchange="ChangeInvoice();" required>
                                        <option value="">Select Invoice Type</option>
                                      
                                            <option value="1" <?php if($invoicetype == 1){echo 'selected';}?>>Simple Invoice</option>
                                            <option value="2" <?php if($invoicetype == 2){echo 'selected';}?>>Tiles Invoice</option>
                                      
                                    </select>
                                 
                                </div>
                             
                            </div>
                        </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="normaldelivery_note">
                                <thead>
                                    <tr>
                                    <th class="text-center"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
                                      <!-- <th class="text-center"><?php echo display('item_description')?></th>
                                    <th class="text-center" ><?php echo display('serial_no')?></th> -->
                                    <th class="text-center"><?php echo 'Stock' ?></th>
                                    <th class="text-center cls1"><?php echo 'Meter Per Box' ?></th>
                                        <th class="text-center"><?php echo 'Packing Unit' ?></th>
                                        <th class="text-center cls1"><?php echo 'Cartons/Box' ?></th>
                                        <th class="text-center cls1"><?php echo 'Tiles' ?></th>
                                        <th class="text-center cls1"><?php echo 'Total CTN' ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?>  <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('rate') ?> <i class="text-danger">*</i></th>

                                        <?php if ($discount_type == 1) { ?>
                                            <th class="text-center"><?php echo display('discount_percentage') ?> %</th>
                                        <?php } elseif ($discount_type == 2) { ?>
                                            <th class="text-center"><?php echo display('discount') ?> </th>
                                        <?php } elseif ($discount_type == 3) { ?>
                                            <th class="text-center"><?php echo display('fixed_dis') ?> </th>
                                        <?php } ?>

                                        <th class="text-center"><?php echo display('total') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="adddelivery_noteItem">
                                  <?php foreach($delivery_note_all_data as $details){?>
                                    <tr>
                                        <td class="product_field">
                                            <input type="text" name="product_name" onkeypress="delivery_note_productList(<?php echo $details['sl']?>);" value="<?php echo $details['product_name']?>-(<?php echo $details['product_model']?>)" class="form-control productSelection" required placeholder='<?php echo display('product_name') ?>' id="product_name_<?php echo $details['sl']?>" tabindex="3">

                                            <input type="hidden" class="product_id_<?php echo $details['sl']?> autocomplete_hidden_value" name="product_id[]" value="<?php echo $details['product_id']?>" id="SchoolHiddenId"/>
                                        </td>
                                        <td style="display:none">
                                            <input type="text" name="desc[]" class="form-control text-right "  value="<?php echo $details['description']?>"/>
                                        </td>
                                        <td style="display:none">
                                         <select class="form-control delivery_note_fields" id="serial_no_<?php echo $details['sl']?>" name="serial_no[]" >

                                        <option value="<?php echo $details['serial_no']?>"><?php echo $details['serial_no']?></option>
                                            </select>
                                        </td>

                                       <td>
                                            <input type="text" name="available_quantity[]" class="form-control text-right available_quantity_<?php echo $details['sl']?>" value="<?php echo $details['stock_qty']?>" readonly="" />
                                        </td>
                                        <td class="text-right cls1">
                                                <input type="text" name="sales_unit[]" id="sales_unit_<?php echo $details['sl']?>" required="" min="0" class="form-control text-right sales_unit_<?php echo $details['sl']?>" onkeyup="" onchange="" placeholder="0.00" value="<?php echo $details['sales_unit']?>"  tabindex="6" readonly/>
                                                <input type="hidden" name="item_pcs[]" id="item_pcs_<?php echo $details['sl']?>" value="<?php echo $details['item_pcs']?>">
                                        </td>
                                        <td>
                                            <input type="text" name="unit[]" id="unit_<?php echo $details['sl']?>" class="form-control text-right " readonly="" value="<?php echo $details['unit']?>" />
                                        </td>
                                        <td class="cls1">
                                                <input type="text" name="Cartons[]" class="form-control text-right " id="Cartons_<?php echo $details['sl']?>"   onkeyup="CheckCartons2(1);" onchange="CheckCartons2(1);"  value="<?php echo $details['Cartons']?>"/>
                                        </td>
                                        <td class="cls1">
                                                <input type="text" name="pcs[]" class="form-control text-right " id="pcs_<?php echo $details['sl']?>"   onkeyup="CheckCartons2(1);" onchange="CheckCartons2(1);"  value="<?php echo $details['pcs']?>"/>
                                        </td>
                                        <td class="cls1">
                                                <input type="text" name="tot_ctn[]" class="form-control text-right " id="tot_ctn_<?php echo $details['sl']?>"   onkeyup="CheckCartons2(1);" onchange="CheckCartons2(1);" value="<?php echo $details['tot_ctn']?>"/>
                                            </td>
                                        <td>
                                            <input type="text" name="product_quantity[]" onkeyup="bdtask_delivery_note_quantity_calculate(<?php echo $details['sl']?>);" onchange="bdtask_delivery_note_quantity_calculate(<?php echo $details['sl']?>);" value="<?php echo $details['quantity']?>" class="total_qntt_<?php echo $details['sl']?> form-control text-right" id="total_qntt_<?php echo $details['sl']?>" min="0" placeholder="0.00" tabindex="4" required="required"/>
                                        </td>

                                        <td>
                                            <input type="text" name="product_rate[]" onkeyup="bdtask_delivery_note_quantity_calculate(<?php echo $details['sl']?>);" onchange="bdtask_delivery_note_quantity_calculate(<?php echo $details['sl']?>);" value="<?php echo $details['rate']?>" id="price_item_<?php echo $details['sl']?>" class="price_item<?php echo $details['sl']?> form-control text-right" min="0" tabindex="5" required="" placeholder="0.00"/>
                                        </td>
                                        <!-- Discount -->
                                        <td>
                                            <input type="text" name="discount[]" onkeyup="bdtask_delivery_note_quantity_calculate(<?php echo $details['sl']?>);"  onchange="(<?php echo $details['sl']?>);" id="discount_<?php echo $details['sl']?>" class="form-control text-right" placeholder="0.00" value="<?php echo $details['discount_per']?>" min="0" tabindex="6"/>

                                            <input type="hidden" value="<?php echo $discount_type ?>" name="discount_type" id="discount_type_<?php echo $details['sl']?>">
                                        </td>

                                        <td>
                                            <input class="total_price form-control text-right" type="text" name="total_price[]" id="total_price_<?php echo $details['sl']?>" value="<?php echo $details['total_price']?>" readonly="readonly" />

                                            <input type="hidden" name="delivery_note_details_id[]" id="delivery_note_details_id" value="<?php echo $details['delivery_note_details_id']?>"/>
                                        </td>
                                        <td>

                                            <!-- Tax calculate start-->
                                            <?php $x=0;
                                            foreach($taxes as $taxfldt){
                                                $taxval='tax'.$x;
                                                ?>
                                            <input id="total_tax<?php echo $x;?>_<?php echo $details['sl']?>" class="total_tax<?php echo $x;?>_<?php echo $details['sl']?>" value="<?php echo $details[$taxval]?>" type="hidden">
                                            <input id="all_tax<?php echo $x;?>_<?php echo $details['sl']?>" class="total_tax<?php echo $x;?>" type="hidden" name="tax[]">
                                             <?php $x++;} ?>
                                            <!-- Tax calculate end-->
                                            <!-- Discount calculate start-->
                                            <input type="hidden" id="total_discount_<?php echo $details['sl']?>" class="" value="<?php echo $details['discount']?>"/>

                                            <input type="hidden" id="all_discount_<?php echo $details['sl']?>" class="total_discount" value="<?php echo $details['discount']?>" name="discount_amount[]" />

                                            <button  class="btn btn-danger text-center" type="button" value="<?php echo display('delete') ?>" onclick="deleteRow_delivery_note(this)" tabindex="7"><i class="fa fa-close"></i></button>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
 <tfoot>
                                     <tr>
                                     <td colspan="9" rowspan="2" class="cls2">
                                <center><label sclass="text-center" for="details" class="  col-form-label"><?php echo display('delivery_note_details') ?></label></center>
                                <textarea name="inva_details" id="details" class="form-control" placeholder="<?php echo display('delivery_note_details') ?>"><?php echo $delivery_note_details;?></textarea>
                                </td>
                                    <td class="text-right" colspan="1"><b><?php echo display('delivery_note_discount') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" onkeyup="quantity_calculate(1);"  onchange="quantity_calculate(1);" id="delivery_note_discount" class="form-control text-right total_discount" name="delivery_note_discount" placeholder="0.00"  value="<?php echo $delivery_note_discount;?>"/>
                                        <input type="hidden" id="txfieldnum" value="<?php echo count($taxes);?>">
                                    </td>
                                      <td><a  id="add_delivery_note_item" class="btn btn-info" name="add-delivery_note-item"  onClick="addInputField_delivery_note('adddelivery_noteItem');"  tabindex="11"><i class="fa fa-plus"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="1"><b><?php echo display('total_discount') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" value="<?php echo $total_discount;?>" readonly="readonly" />
                                    </td>
                                </tr>
                                       <?php $x=0;
                                     foreach($taxes as $taxfldt){?>
                                    <tr class="hideableRow hiddenRow">
                                       
                                    <td class="text-right cls3" colspan="10" ><b><?php echo html_escape($taxfldt['tax_name']) ?></b></td>
                                <td class="text-right">
                                    <input id="total_tax_ammount<?php echo $x;?>" tabindex="-1" class="form-control text-right valid totalTax" name="total_tax<?php echo $x;?>" value="<?php $txval ='tax'.$x;
                                     echo html_escape($taxvalu[0][$txval])?>" readonly="readonly" aria-invalid="false" type="text">
                                </td>
                                </tr>
                            <?php $x++;}?>
                                 
                    <tr>
                                    <tr>
                                <td class="text-right cls3" colspan="10" ><b><?php echo display('total_tax') ?>:</b></td>
                                <td class="text-right">
                                    <input id="total_tax_amount" tabindex="-1" class="form-control text-right valid" name="total_tax" value="<?php echo $total_tax;?>" readonly="readonly" aria-invalid="false" type="text">
                                </td>
                                 <td><button type="button" class="toggle btn-warning">
                <i class="fa fa-angle-double-down"></i>
              </button></td>
                                </tr>
                               
                                 <tr>
                                 <td class="text-right cls3" colspan="10" ><b><?php echo display('shipping_cost') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="shipping_cost" class="form-control text-right" name="shipping_cost" onkeyup="quantity_calculate(1);"  onchange="quantity_calculate(1);"  placeholder="0.00"  value="<?php echo $shipping_cost?>"/>
                                    </td>
                                </tr>
                                <tr>
                                <td class="text-right cls3" colspan="10" ><b><?php echo display('grand_total') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" value="<?php echo $total_amount?>" readonly="readonly" />
                                    </td>
                                </tr>
                                 <tr>
                                    <td class="text-right cls3" colspan="10" ><b><?php echo display('previous'); ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="previous" class="form-control text-right" name="previous" value="<?php echo $prev_due?>" readonly="readonly" />
                                    </td>
                                </tr>
                                <tr>
                                <td class="text-right cls3" colspan="10" ><b><?php echo display('net_total'); ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="n_total" class="form-control text-right" name="n_total" value="<?php echo $net_total;?>" readonly="readonly" placeholder="" />
                                    </td>
                                </tr>
                                <tr>
                                   
                                    <td class="text-right cls3" colspan="10" ><b><?php echo display('paid_ammount') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="paidAmount" 
                                               onkeyup="delivery_note_paidamount();" class="form-control text-right" name="paid_amount" placeholder="0.00" tabindex="13"  value="<?php echo $paid_amount;?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    
                                
                                <td class="text-right cls3" colspan="10" >
                                          <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url(); ?>"/>
                                          <input type="hidden" name="delivery_note_id" id="delivery_note_id" value="<?php echo $delivery_note_id?>"/>
                                            <input type="hidden" name="delivery_note" id="delivery_note" value="<?php echo $delivery_note?>"/>
                                        <b><?php echo display('due') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="dueAmmount" class="form-control text-right" name="due_amount" value="<?php echo $due_amount?>" readonly="readonly"/>
                                    </td>
                                </tr>
                                 <tr>
                                    <td align="center" colspan="2">
                                        <input type="button" id="full_paid_tab" class="btn btn-warning" value="<?php echo display('full_paid') ?>" tabindex="14" onClick="delivery_notee_full_paid()"/>

                                        <input type="submit" id="add_delivery_note" class="btn btn-success" name="add-delivery_note" value="<?php echo display('save_changes') ?>" tabindex="15"/>
                                    </td>

                                    <td colspan="8"  class="text-right cls2"><b><?php echo display('change') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="change" class="form-control text-right" name="change" value="0" readonly="readonly"/>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>

                  <div class="modal fade" id="printconfirmodal" tabindex="-1" role="dialog" aria-labelledby="printconfirmodal" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel"><?php echo display('print') ?></h4>
          </div>
          <div class="modal-body">
            <?php echo form_open('delivery_note_print', array('class' => 'form-vertical', 'id' => '', 'name' => '')) ?>
            <div id="outputs" class="hide alert alert-danger"></div>
            <h3> <?php echo display('successfully_inserted') ?></h3>
            <h4><?php echo display('do_you_want_to_print') ?> ??</h4>
            <input type="hidden" name="delivery_note_id" id="inv_id">
          </div>
          <div class="modal-footer">
            <a href="<?php echo base_url('delivery_note_list')?>" class="btn btn-default"><?php echo display('no') ?></a>
            
            <button type="submit" class="btn btn-primary" id="yes"><?php echo display('yes') ?></button>
            <?php echo form_close() ?>
          </div>
        </div>
      </div>
    </div>

        </div>

        <script>
            window.onload = ChangeInvoice;
function CheckCartons2(ln)
{
    //alert(1);
    var item_pcs = Number(document.getElementById("item_pcs_"+ln).value);

    var pcs = Number(document.getElementById("pcs_"+ln).value) ;

    var Cartons = Number(document.getElementById("Cartons_"+ln).value) ;
    var unit_pack	= document.getElementById("sales_unit_"+ln).value;
            //alert(unit_pack);											
    var pcs_per_ctn = item_pcs*Cartons;
    var total_pcs = pcs + pcs_per_ctn;
    if(item_pcs>0)
    {
    var total_carton = total_pcs / item_pcs;
    }
    else
    {
    if((pcs=='' || pcs<=0) && Cartons>0)
    {
        var total_carton = Cartons;
    }
    else
    {
        var total_carton = 0;//pcs;
    }
    }
    //alert(total_carton+' cartons');

    document.getElementById("tot_ctn_"+ln).value = total_carton.toFixed(4);
    var tot_ctn		= Number(document.getElementById("tot_ctn_"+ln).value);
    var Qty 	=  unit_pack*tot_ctn;
    document.getElementById("total_qntt_"+ln).value = Qty.toFixed(4);
    var item = ln;
    var quantity = $("#total_qntt_" + item).val();
    var available_quantity = $(".available_quantity_" + item).val();
    var price_item = $("#price_item_" + item).val();
    var invoice_discount = $("#invoice_discount").val();
    var discount = $("#discount_" + item).val();
    var total_tax = $("#total_tax_" + item).val();
    var total_discount = $("#total_discount_" + item).val();
    var taxnumber = $("#txfieldnum").val();
    var dis_type = $("#discount_type").val();
    if (parseInt(quantity) > parseInt(available_quantity)) {
        var message = "You can Sale maximum " + available_quantity + " Items";
        toastr["error"](message);
        $("#total_qntt_" + item).val('');
        var quantity = 0;
        $("#total_price_" + item).val(0);
        for(var i=0;i<taxnumber;i++){
        $("#all_tax"+i+"_" + item).val(0);
        bdtask_delivery_note_quantity_calculate(item);
    }
    }

    if (quantity > 0 || discount > 0) {
        if (dis_type == 1) {
            var price = quantity * price_item;
            var dis = +(price * discount / 100);
            $("#all_discount_" + item).val(dis);
            //Total price calculate per product
            var temp = price - dis;
            var ttletax = 0;
            $("#total_price_" + item).val(temp);
            for(var i=0;i<taxnumber;i++){

                var tax = (temp) * $("#total_tax"+i+"_" + item).val();
                ttletax += Number(tax);
                $("#all_tax"+i+"_" + item).val(tax);
            }

          
        } else if (dis_type == 2) {
            var price = quantity * price_item;

            // Discount cal per product
            var dis = (discount * quantity);

            $("#all_discount_" + item).val(dis);

            //Total price calculate per product
            var temp = price - dis;
            $("#total_price_" + item).val(temp);

            var ttletax = 0;
            for(var i=0;i<taxnumber;i++){
                var tax = (temp) * $("#total_tax"+i+"_" + item).val();
                ttletax += Number(tax);
                $("#all_tax"+i+"_" + item).val(tax);
            }
        } else if (dis_type == 3) {
            var total_price = quantity * price_item;
            var dis =  discount;
            // Discount cal per product
            $("#all_discount_" + item).val(dis);
            //Total price calculate per product
            var price = total_price - dis;
            $("#total_price_" + item).val(price);

            var ttletax = 0;
            for(var i=0;i<taxnumber;i++){
                var tax = (price) * $("#total_tax"+i+"_" + item).val();
                ttletax += Number(tax);
                $("#all_tax"+i+"_" + item).val(tax);
            }
        }
    } else {
        var n = quantity * price_item;
        var c = quantity * price_item * total_tax;
        $("#total_price_" + item).val(n),
                $("#all_tax_" + item).val(c)
    }
    delivery_note_calculateSum();
    delivery_note_paidamount();
}
function ChangeInvoice()
{
    var sel = $("#invoicetype").val();
    if(sel==1)
    {
        $('.cls1').hide();
        $('.cls2').attr('colspan',5);
        $('.cls3').attr('colspan',6);
    }
    else
    {
        $('.cls1').show();
        $('.cls2').attr('colspan',9);
        $('.cls3').attr('colspan',10);
    }
}
</script>
   