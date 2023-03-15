<script src="<?php echo base_url()?>my-assets/js/admin_js/purchase.js" type="text/javascript"></script>

  <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('edit_purchase') ?></h4>
                        </div>
                    </div>

                    <div class="panel-body">
                    <?php echo form_open_multipart('purchase/purchase/bdtask_update_purchase',array('class' => 'form-vertical', 'id' => 'purchase_update'))?>
                        

                        <div class="row">
                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-4 col-form-label"><?php echo display('supplier') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <select name="supplier_id" id="supplier_id" class="form-control " required=""> 
                                          <option value="">Select Supplier</option>
                                           <?php foreach($supplier_list as $suppliers){?>
                                    <option value="<?php echo  $suppliers['supplier_id']?>" <?php if($suppliers['supplier_id'] == $supplier_id){echo 'selected';}?>><?php echo  $suppliers['supplier_name']?></option>
                                    <?php }?>
                                           
                                        </select>
                                    </div>

                                 
                                </div> 
                            </div>

                             <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('purchase_date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <?php $date = date('Y-m-d'); ?>
                                        <input type="text" tabindex="2" class="form-control datepicker" name="purchase_date"value="<?php echo $purchase_date?>" id="date" required />
                                          <input type="hidden" name="purchase_id" value="<?php echo $purchase_id?>">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="invoice_no" class="col-sm-4 col-form-label"><?php echo display('invoice_no') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="number" tabindex="3" class="form-control" name="chalan_no" placeholder="<?php echo display('invoice_no') ?>" id="invoice_no" required  value="<?php echo $chalan_no;?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="adress" class="col-sm-4 col-form-label"><?php echo display('details') ?>
                                    </label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" tabindex="4" id="adress" name="purchase_details" placeholder=" <?php echo display('details') ?>" rows="1"><?php echo $purchase_details;?></textarea>
                                    </div>
                                </div> 
                            </div>
                        </div>
                                     <div class="row">
                              <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="payment_type" class="col-sm-4 col-form-label"><?php
                                        echo display('payment_type');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                        <select name="paytype" class="form-control" required="" onchange="bank_paymet(this.value)">
                                            <option value="">Select Payment Option</option>
                                            <option value="1" <?php if($paytype ==1){echo 'selected';}?>><?php echo display('cash_payment') ?></option>
                                            <option value="2" <?php if($paytype ==2){echo 'selected';}?>><?php echo display('bank_payment') ?></option>
                                           
                                        </select>
                                      

                                     
                                    </div>
                                 
                                </div>
                            </div>
                            <div class="col-sm-6" id="bank_div">
                                <div class="form-group row">
                                    <label for="bank" class="col-sm-4 col-form-label"><?php
                                        echo display('bank');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                        <select name="bank_id" class="form-control bankpayment"  id="bank_id">
                                                <option value="">Select Location</option>
                                                <?php foreach($bank_list as $bank){?>
                                                    <option value="<?php echo $bank['bank_id']?>" <?php if($bank['bank_id'] == $bank_id){echo 'selected';}?>><?php echo $bank['bank_name'];?></option>
                                                <?php }?>
                                            </select>
                                            <input type="hidden" id="editpayment_type" value="<?php echo $paytype;?>" name="">
                                    
                                    </div>
                                
                                </div>
                            </div>
                            <div class="col-sm-6" >
                                <div class="form-group row">
                                    <label for="invoicetype" class="col-sm-4 col-form-label"><?php
                                        echo 'Invoice Type';
                                        ?> </label>
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
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center" width="20%"><?php echo display('item_information') ?><i class="text-danger">*</i></th> 
                                            <th class="text-center"><?php echo display('stock_ctn') ?></th>
                                            <th class="text-center cls1"><?php echo 'Meter Per Box' ?></th>
                                            <th class="text-center"><?php echo 'Packing Unit' ?></th>
                                            <th class="text-center cls1"><?php echo 'Cartons/Box' ?></th>
                                            <th class="text-center cls1"><?php echo 'Tiles' ?></th>
                                            <th class="text-center cls1"><?php echo 'Total CTN' ?></th>
                                            <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                                            <th class="text-center"><?php echo display('rate') ?><i class="text-danger">*</i></th>

                                           

                                            <th class="text-center"><?php echo display('total') ?></th>
                                            <th class="text-center"><?php echo display('action') ?></th>
                                        </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <?php foreach($purchase_info as $purchases){?>
                                    <tr>
                                            <td class="span3 supplier">
                                                <?php
                                              // print_r($purchases);
                                                ?>
                                                <input type="text" name="product_name" required class="form-control product_name productSelection" onkeypress="product_pur_or_list(<?php echo $purchases['sl']?>);" placeholder="<?php echo display('product_name') ?>" id="product_name_<?php echo $purchases['sl']?>" tabindex="5" value="<?php echo $purchases['product_name']?>"  >
                                                <input type="hidden" class="autocomplete_hidden_value product_id_<?php echo $purchases['sl']?>" name="product_id[]" id="SchoolHiddenId" value="<?php echo $purchases['product_id']?>"/>
                                                <input type="hidden" class="sl" value="<?php echo $purchases['sl']?>">
                                            </td>
                                            <td class="wt">
                                                <input type="text" id="available_quantity_<?php echo $purchases['sl']?>" class="form-control text-right stock_ctn_<?php echo $purchases['sl']?>" placeholder="0.00" readonly/>
                                            </td>
                                            <td class="text-right cls1">
                                                <input type="text" name="sales_unit[]" id="sales_unit_<?php echo $purchases['sl']?>" required="" min="0" class="form-control text-right sales_unit_<?php echo $purchases['sl']?>" onkeyup="" onchange="" placeholder="0.00" value="<?php echo $purchases['sales_unit']?>"  tabindex="6" readonly/>
                                                <input type="hidden" name="item_pcs[]" id="item_pcs_<?php echo $purchases['sl']?>" value="<?php echo $purchases['item_pcs']?>">
                                            </td>
                                            <td>
                                                <input type="text" name="unit[]" class="form-control text-right " id="unit_<?php echo $purchases['sl']?>" readonly="" value="<?php echo $purchases['unit']?>" />
                                            </td>
                                            <td class="text-right cls1">
                                                <input type="text" name="Cartons[]" class="form-control text-right " id="Cartons_<?php echo $purchases['sl']?>"   onkeyup="CheckCartons2(1);" onchange="CheckCartons2(1);"  value="<?php echo $purchases['Cartons']?>"/>
                                            </td>
                                            <td class="text-right cls1">
                                                <input type="text" name="pcs[]" class="form-control text-right " id="pcs_<?php echo $purchases['sl']?>"   onkeyup="CheckCartons2(1);" onchange="CheckCartons2(1);"  value="<?php echo $purchases['pcs']?>"/>
                                            </td>
                                            <td class="text-right cls1">
                                                <input type="text" name="tot_ctn[]" class="form-control text-right " id="tot_ctn_<?php echo $purchases['sl']?>"   onkeyup="CheckCartons2(1);" onchange="CheckCartons2(1);" value="<?php echo $purchases['tot_ctn']?>"/>
                                            </td>
                                            <td class="text-right">
                                                <input type="text" name="product_quantity[]" id="cartoon_<?php echo $purchases['sl']?>" class="form-control text-right store_cal_<?php echo $purchases['sl']?>" onkeyup="calculate_store(<?php echo $purchases['sl']?>);" onchange="calculate_store(<?php echo $purchases['sl']?>);" placeholder="0.00" value="<?php echo $purchases['quantity']?>" min="0" tabindex="6"/>
                                            </td>
                                            <td class="test">
                                                <input type="text" name="product_rate[]" onkeyup="calculate_store(<?php echo $purchases['sl']?>);" onchange="calculate_store(<?php echo $purchases['sl']?>);" id="product_rate_<?php echo $purchases['sl']?>" class="form-control product_rate_<?php echo $purchases['sl']?> text-right" placeholder="0.00" value="<?php echo $purchases['rate']?>" min="0" tabindex="7"/>
                                            </td>
                                            <td class="text-right">
                                                <input class="form-control total_price text-right" type="text" name="total_price[]" id="total_price_<?php echo $purchases['sl']?>" value="<?php echo $purchases['total_amount']?>" readonly="readonly" />
                                            </td>
                                            <td>

                                               

                                                <button  class="btn btn-danger text-right red" type="button" value="<?php echo display('delete')?>" onclick="deleteRow(this)" tabindex="8"><i class="fal fa-trash-alt"></i></button>
                                            </td>
                                    </tr>
                                <?php }?>
                                </tbody>
                                <tfoot>
                                      <tfoot>
                                    <tr>
                                        
                                        <td class="text-right cls4" colspan="9"><b><?php echo display('total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="Total" class="text-right form-control" name="total" value="<?php echo $total;?>" readonly="readonly" />
                                        </td>
                                        <td> <button type="button" id="add_invoice_item" class="btn btn-info" name="add-invoice-item"  onClick="addPurchaseOrderField1('addPurchaseItem')"  tabindex="9"><i class="fa fa-plus"></i></button>

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/></td>
                                    </tr>
                                        <tr>
                                       
                                        <td class="text-right cls2" colspan="9"><b><?php echo display('discounts') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="discount" class="text-right form-control discount" onkeyup="calculate_store(1)" name="discount" placeholder="0.00" value="<?php echo $total_discount;?>" />
                                        </td>
                                        <td> 

                                           </td>
                                    </tr>

                                        <tr>
                                        
                                        <td class="text-right cls2" colspan="9"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" class="text-right form-control" name="grand_total_price" value="<?php echo $grand_total;?>" readonly="readonly" />
                                        </td>
                                        <td> </td>
                                    </tr>
                                         <tr>
                                        
                                        <td class="text-right cls2" colspan="9"><b><?php echo display('paid_amount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="paidAmount" class="text-right form-control" onKeyup="invoice_paidamount()" name="paid_amount" value="<?php echo $paid_amount;?>" />
                                        </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="text-right cls3">
                                             <input style="display: none;" type="button" id="full_paid_tab" class="btn btn-warning" value="<?php echo display('full_paid') ?>" tabindex="16" onClick="full_paid()"/>
                                        </td>
                                        <td class="text-right" colspan="2"><b><?php echo display('due_amount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="dueAmmount" class="text-right form-control" name="due_amount" value="<?php echo $due_amount;?>" readonly="readonly" />
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                                </tfoot>
                            </table>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 ">
                                <input style="float: right !important;" type="submit" id="add_purchase" class="btn btn-primary btn-large" name="add-purchase" value="<?php echo display('submit') ?>" />
                               
                            </div>
                        </div>
                    <?php echo form_close()?>
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
            document.getElementById("cartoon_"+ln).value = Qty.toFixed(4);
            var gr_tot = 0;
                    var dis = 0;
                    var item_ctn_qty    = $("#cartoon_"+ln).val();
                    var vendor_rate = $("#product_rate_"+ln).val();

                    var total_price     = item_ctn_qty * vendor_rate;
                    $("#total_price_"+ln).val(total_price.toFixed(2));

                
                    //Total Price
                    $(".total_price").each(function() {
                        isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
                    });
                    $(".discount").each(function() {
                        isNaN(this.value) || 0 == this.value.length || (dis += parseFloat(this.value))
                    });

                    $("#Total").val(gr_tot.toFixed(2,2));
                    var grandtotal = gr_tot - dis;
                    $("#grandTotal").val(grandtotal.toFixed(2,2));
                    invoice_paidamount();
            //	alert("d");
        }
function ChangeInvoice() {
        var sel = $("#invoicetype").val();
        if (sel == 1) {
            $('.cls1').hide();
            $('.cls2').attr('colspan', 5);
            $('.cls3').attr('colspan', 3);
            $('.cls4').attr('colspan', 5);
        } else {
            $('.cls1').show();
            $('.cls2').attr('colspan', 9);
            $('.cls3').attr('colspan', 7);
            $('.cls4').attr('colspan', 9);
        }
    }
</script>

