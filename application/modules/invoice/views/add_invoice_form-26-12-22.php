<!-- Invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>
       
<?php // echo "asdf"; die(); ?>


        <!--Add Invoice -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo display('new_invoice') ?></span>
                           <span class="padding-lefttitle">            
       <?php if($this->permission1->method('manage_invoice','read')->access()){ ?>
                    <a href="<?php echo base_url('invoice_list') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('manage_invoice') ?> </a>
                    <?php }?>
         <?php if($this->permission1->method('pos_invoice','create')->access()){ ?>
                    <a href="<?php echo base_url('gui_pos') ?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('pos_invoice') ?> </a>
                <?php }?></span>
                        </div>
                    </div>
                 
                    <div class="panel-body">
                        <?php echo form_open_multipart('invoice/invoice/bdtask_manual_sales_insert',array('class' => 'form-vertical', 'id' => 'insert_sale','name' => 'insert_sale'))?>
                        <div class="row">

                            <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="customer_name" class="col-sm-3 col-form-label"><?php
                                        echo display('customer_name').'/'.display('phone');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                        <input type="text" size="100"  name="customer_name" class=" form-control" placeholder='<?php echo display('customer_name').'/'.display('phone') ?>' id="customer_name" tabindex="1" onkeyup="customer_autocomplete()" value="<?php echo $customer_name?>"/>

                                        <input id="autocomplete_customer_id" class="customer_hidden_value abc" type="hidden" name="customer_id" value="<?php echo $customer_id?>">
                                    </div>
                                     <?php if($this->permission1->method('add_customer','create')->access()){ ?>
                                    <div  class=" col-sm-3">
                                         <a href="#" class="btn btn-primary add_btn " aria-hidden="true" data-toggle="modal" data-target="#cust_info"><i class="ti-plus m-r-2"></i></a>
                                    </div>
                                <?php } ?>
                                 <input type="hidden"  name="delivery_id" value="<?php echo $delivery_note_id;?>" id="delivery_id"/>
                                </div>
                            </div>

                          
                               <div class="col-sm-6" id="payment_from">
                                <div class="form-group row">
                                    <label for="payment_type" class="col-sm-3 col-form-label"><?php
                                        echo display('payment_type');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                        <select name="paytype" class="form-control" required="" onchange="bank_paymet(this.value)" tabindex="3">
                                            <option value="1"><?php echo display('cash_payment') ?></option>
                                            <option value="2"><?php echo display('bank_payment') ?></option> 
                                        </select>
                                      

                                     
                                    </div>
                                 
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-3 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                        <?php
                                           if($date=='')
                                           {
                                             $date = date('Y-m-d');
                                           }
                                                   
                                        ?>
                                        <input class="datepicker form-control" type="text" size="50" name="invoice_date" id="date" required value="<?php echo html_escape($date); ?>" tabindex="4" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                 <div class="form-group row">
                                <label for="invoice_no" class="col-sm-3 col-form-label"><?php
                                    echo display('invoice_no');
                                    ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                         <input class="form-control" type="text"  name="invoice_no" id="invoice_no" required value="<?php echo html_escape($invoice_no); ?>" readonly/>
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
                                            <option value="<?php echo html_escape($bank['bank_id'])?>"><?php echo html_escape($bank['bank_name']);?></option>
                                        <?php }?>
                                    </select>
                                 
                                </div>
                             
                            </div>
                        </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover" id="normalinvoice">
                                <thead style="background-color: #eeeeee;">
                                    <tr>
                                        <th class="text-center product_field"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('item_description')?></th>
                                         <th class="text-center"><?php echo display('serial_no')?></th>
                                        <th class="text-center"><?php echo display('available_qnty') ?></th>
                                        <th class="text-center"><?php echo display('unit') ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('rate') ?> <i class="text-danger">*</i></th>

                                        <?php if ($discount_type == 1) { ?>
                                            <th class="text-center invoice_fields"><?php echo display('discount_percentage') ?> %</th>
                                        <?php } elseif ($discount_type == 2) { ?>
                                            <th class="text-center invoice_fields"><?php echo display('discount') ?> </th>
                                        <?php } elseif ($discount_type == 3) { ?>
                                            <th class="text-center invoice_fields"><?php echo display('fixed_dis') ?> </th>
                                        <?php } ?>

                                        <th class="text-center invoice_fields"><?php echo display('total') ?> 
                                        </th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                     <?php foreach($delivery_note_all_data as $details){?>
                                    <tr>
                                        <td class="product_field">
                                             <input type="text" name="product_name" onkeypress="invoice_productList(<?php echo $details['sl']?>);" value="<?php echo $details['product_name']?>-(<?php echo $details['product_model']?>)" class="form-control productSelection" required placeholder='<?php echo display('product_name') ?>' id="product_name_<?php echo $details['sl']?>" tabindex="3">

                                            <input type="hidden" class="product_id_<?php echo $details['sl']?> autocomplete_hidden_value" name="product_id[]" value="<?php echo $details['product_id']?>" id="SchoolHiddenId"/>

                                            <input type="hidden" class="baseUrl" value="<?php echo base_url(); ?>" />
                                        </td>
                                          <td>
                                            <input type="text" name="desc[]" class="form-control text-right "  value="<?php echo $details['description']?>"/>
                                        </td>
                                        <td  class="invoice_fields">
                                            <select class="form-control invoice_fields" id="serial_no_<?php echo $details['sl']?>" name="serial_no[]" >
                                                <option value="<?php echo $details['serial_no']?>"><?php echo $details['serial_no']?></option>
                                            </select>
                                        </td>
                                        <td>
                                           <input type="text" name="available_quantity[]" class="form-control text-right available_quantity_<?php echo $details['sl']?>" value="<?php echo $details['stock_qty']?>" readonly="" />
                                        </td>
                                        <td>
                                             <input type="text" name="unit[]" class="form-control text-right " readonly="" value="<?php echo $details['unit']?>" />
                                        </td>
                                        <td>
                                            <input type="text" name="product_quantity[]" onkeyup="bdtask_invoice_quantity_calculate(<?php echo $details['sl']?>);" onchange="bdtask_invoice_quantity_calculate(<?php echo $details['sl']?>);" value="<?php echo $details['quantity']?>" class="total_qntt_<?php echo $details['sl']?> form-control text-right" id="total_qntt_<?php echo $details['sl']?>" min="0" placeholder="0.00" tabindex="4" required="required"/>
                                        </td>
                                        <td class="invoice_fields">
                                              <input type="text" name="product_rate[]" onkeyup="bdtask_invoice_quantity_calculate(<?php echo $details['sl']?>);" onchange="bdtask_invoice_quantity_calculate(<?php echo $details['sl']?>);" value="<?php echo $details['rate']?>" id="price_item_<?php echo $details['sl']?>" class="price_item<?php echo $details['sl']?> form-control text-right" min="0" tabindex="5" required="" placeholder="0.00"/>
                                        </td>
                                        <!-- Discount -->
                                        <td>
                                             <input type="text" name="discount[]" onkeyup="bdtask_invoice_quantity_calculate(<?php echo $details['sl']?>);"  onchange="(<?php echo $details['sl']?>);" id="discount_<?php echo $details['sl']?>" class="form-control text-right" placeholder="0.00" value="<?php echo $details['discount_per']?>" min="0" tabindex="6"/>

                                            <input type="hidden" value="<?php echo $discount_type ?>" name="discount_type" id="discount_type_<?php echo $details['sl']?>">

                                        </td>


                                        <td class="invoice_fields">
                                            <input class="total_price form-control text-right" type="text" name="total_price[]" id="total_price_<?php echo $details['sl']?>" value="<?php echo $details['total_price']?>" readonly="readonly" />
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
                                            <!-- Discount calculate end -->

                                         <button  class='btn delete_btn text-right' type='button' value='Delete' onclick='deleteRow_invoice(this)'><i class='fal fa-trash-alt'></i></button>
                                        </td>
                                    </tr>
                                     <?php }?>
                                </tbody>
                                <tfoot>
                                     <tr>
                                        <td colspan="7" rowspan="2">
                                <center><label  for="details" class="  col-form-label text-center"><?php echo display('invoice_details') ?></label></center>
                                <textarea name="inva_details" id="details" class="form-control" placeholder="<?php echo display('invoice_details') ?>" tabindex="12"></textarea>
                                </td>
                                    <td class="text-right" colspan="1"><b><?php echo display('invoice_discount') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" onkeyup="bdtask_invoice_quantity_calculate(1);"  onchange="bdtask_invoice_quantity_calculate(1);" id="invoice_discount" class="form-control text-right total_discount" name="invoice_discount" placeholder="0.00"   tabindex="13"/>
                                        <input type="hidden" id="txfieldnum">
                                    </td>
                                    <td><a href="javascript:void(0)"  id="add_invoice_item" class="btn action_btn" name="add-invoice-item"  onClick="addInputField_invoice('addinvoiceItem');"  tabindex="11"><i class="fa fa-plus"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="1"><b><?php echo display('total_discount') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" value="0.00" readonly="readonly" />
                                    </td>
                                </tr>
                                    <?php $x=0;
                                     foreach($taxes as $taxfldt){?>
                                    <tr class="hideableRow hiddenRow">
                                       
                                <td class="text-right" colspan="8"><b><?php echo html_escape($taxfldt['tax_name']) ?></b></td>
                                <td class="text-right">
                                    <input id="total_tax_ammount<?php echo $x;?>" tabindex="-1" class="form-control text-right valid totalTax" name="total_tax<?php echo $x;?>" value="0.00" readonly="readonly" aria-invalid="false" type="text">
                                </td>
                                </tr>
                            <?php $x++;}?>
                                 
                    <tr>
                                    <tr>
                                <td class="text-right" colspan="8"><b><?php echo display('total_tax') ?>:</b></td>
                                <td class="text-right">
                                    <input id="total_tax_amount" tabindex="-1" class="form-control text-right valid" name="total_tax" value="0.00" readonly="readonly" aria-invalid="false" type="text">
                                </td>
                                 <td><button type="button" class="toggle btn-warning">
                <i class="fa fa-angle-double-down"></i>
              </button></td>
                                </tr>
                               
                                 <tr>
                                    <td class="text-right" colspan="8"><b><?php echo display('shipping_cost') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="shipping_cost" class="form-control text-right" name="shipping_cost" onkeyup="bdtask_invoice_quantity_calculate(1);"  onchange="bdtask_invoice_quantity_calculate(1);"  placeholder="0.00" tabindex="14" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8"  class="text-right"><b><?php echo display('grand_total') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" value="0.00" readonly="readonly" />
                                    </td>
                                </tr>
                                 <tr>
                                    <td colspan="8"  class="text-right"><b><?php echo display('previous'); ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="previous" class="form-control text-right" name="previous" value="0.00" readonly="readonly" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8"  class="text-right"><b><?php echo display('net_total'); ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="n_total" class="form-control text-right" name="n_total" value="0" readonly="readonly" placeholder="" />
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td class="text-right" colspan="8"><b><?php echo display('paid_ammount') ?>:</b></td>
                                    <td class="text-right">
                                         <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url(); ?>"/>
                                        <input type="text" id="paidAmount" 
                                               onkeyup="invoice_paidamount();" class="form-control text-right" name="paid_amount" placeholder="0.00" tabindex="15" value=""/>
                                    </td>
                                </tr>
                                <tr>
                                   

                                    <td class="text-right" colspan="8"><b><?php echo display('due') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="dueAmmount" class="form-control text-right" name="due_amount" value="0.00" readonly="readonly"/>
                                    </td>
                                </tr>
                                <tr>
                                     <td align="center">
                                        <input type="button" id="full_paid_tab" class="btn btn-warning" value="<?php echo display('full_paid') ?>" tabindex="16" onClick="invoicee_full_paid()"/>

                                        <input type="submit" id="add_invoice" class="btn btn-primary" name="add-invoice" value="<?php echo display('submit') ?>" tabindex="17"/>
                                    </td>
                                    <td colspan="7"  class="text-right"><b><?php echo display('change'); ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="change" class="form-control text-right" name="change" value="0" readonly="readonly" placeholder="" />
                                        <input type="hidden" name="is_normal" value="1">
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                               <?php echo form_close()?>
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
            <?php echo form_open('invoice_print', array('class' => 'form-vertical', 'id' => '', 'name' => '')) ?>
            <div id="outputs" class="hide alert alert-danger"></div>
            <h3> <?php echo display('successfully_inserted') ?></h3>
            <h4><?php echo display('do_you_want_to_print') ?> ??</h4>
            <input type="hidden" name="invoice_id" id="inv_id">
          </div>
          <div class="modal-footer">
            <a href="<?php echo base_url('invoice_list')?>" class="btn btn-default"><?php echo display('no') ?></a>
            
            <button type="submit" class="btn btn-primary" id="yes"><?php echo display('yes') ?></button>
            <?php echo form_close() ?>
          </div>
        </div>
      </div>
    </div>

            </div>
     
         
        </div>
        <script>
              function printRawHtml(view) {
              printJS({
                printable: view,
                type: 'raw-html',
                
              });

             }
        </script>
   


