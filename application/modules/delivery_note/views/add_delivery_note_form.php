<!-- Invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/delivery_note.js" type="text/javascript"></script>

<?php // echo "asdf"; die(); 
?>


<!--Add Invoice -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <span><?php echo display('new_delivery_note') ?></span>
                    <span class="padding-lefttitle">
                        <?php if ($this->permission1->method('manage_delivery_note', 'read')->access()) { ?>
                            <a href="<?php echo base_url('delivery_note_list') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('manage_delivery_note') ?> </a>
                        <?php } ?>
                        </span>
                </div>
            </div>

            <div class="panel-body">
                <?php echo form_open_multipart('delivery_note/delivery_note/bdtask_manual_delivery_note_insert', array('class' => 'form-vertical', 'id' => 'insert_sale', 'name' => 'insert_sale')) ?>
                <div class="row">

                    <div class="col-sm-6" id="payment_from_1">
                        <div class="form-group row">
                            <label for="customer_name" class="col-sm-3 col-form-label"><?php
                                                                                        echo display('customer_name') . '/' . display('phone');
                                                                                        ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" size="100" name="customer_name" class=" form-control" placeholder='<?php echo display('customer_name') . '/' . display('phone') ?>' id="customer_name" tabindex="1" onkeyup="customer_autocomplete()" value="<?php echo $customer_name ?>" />

                                <input id="autocomplete_customer_id" class="customer_hidden_value abc" type="hidden" name="customer_id" value="<?php echo $customer_id ?>">
                            </div>
                            <?php if ($this->permission1->method('add_customer', 'create')->access()) { ?>
                                <div class=" col-sm-3">
                                    <a href="#" class="btn btn-primary add_btn " aria-hidden="true" data-toggle="modal" data-target="#cust_info"><i class="ti-plus m-r-2"></i></a>
                                </div>
                            <?php } ?>
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

                                $date = date('Y-m-d');
                                ?>
                                <input class="datepicker form-control" type="text" size="50" name="delivery_note_date" id="date" required value="<?php echo html_escape($date); ?>" tabindex="4" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="delivery_note_no" class="col-sm-3 col-form-label"><?php
                                                                                            echo display('delivery_note_no');
                                                                                            ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="delivery_note_no" id="delivery_note_no" required value="<?php echo html_escape($delivery_note_no); ?>" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" id="bank_div">
                        <div class="form-group row">
                            <label for="bank" class="col-sm-3 col-form-label"><?php
                                                                                echo display('bank');
                                                                                ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select name="bank_id" class="form-control bankpayment" id="bank_id">
                                    <option value="">Select Location</option>
                                    <?php foreach ($bank_list as $bank) { ?>
                                        <option value="<?php echo html_escape($bank['bank_id']) ?>"><?php echo html_escape($bank['bank_name']); ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="invoicetype" class="col-sm-3 col-form-label"><?php
                                                                                        echo 'Invoice Type';
                                                                                        ?> </label>
                            <div class="col-sm-6">
                                <select name="invoicetype" class="form-control bankpayment" id="invoicetype" required onchange="ChangeInvoice();" required>
                                    <option value="">Select Invoice Type</option>

                                    <option value="1" selected>Simple Invoice</option>
                                    <option value="2">Tiles Invoice</option>

                                </select>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-hover" id="normaldelivery_note">
                    <thead style="background-color: #eeeeee;">
                        <tr>
                            <th class="text-center product_field"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
                            <!-- <th class="text-center"><?php echo display('item_description') ?></th>
                                         <th class="text-center"><?php echo display('serial_no') ?></th> -->
                            <th class="text-center"><?php echo display('available_qnty') ?></th>
                            <th class="text-center cls1"><?php echo 'Meter Per Box' ?></th>
                            <th class="text-center"><?php echo 'Packing Unit' ?></th>
                            <th class="text-center cls1"><?php echo 'Cartons/Box' ?></th>
                            <th class="text-center cls1"><?php echo 'Tiles' ?></th>
                            <th class="text-center cls1"><?php echo 'Total CTN' ?></th>
                            <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                            <th class="text-center"><?php echo display('rate') ?> <i class="text-danger">*</i></th>

                            <?php if ($discount_type == 1) { ?>
                                <th class="text-center delivery_note_fields"><?php echo display('discount_percentage') ?> %</th>
                            <?php } elseif ($discount_type == 2) { ?>
                                <th class="text-center delivery_note_fields"><?php echo display('discount') ?> </th>
                            <?php } elseif ($discount_type == 3) { ?>
                                <th class="text-center delivery_note_fields"><?php echo display('fixed_dis') ?> </th>
                            <?php } ?>

                            <th class="text-center delivery_note_fields"><?php echo display('total') ?>
                            </th>
                            <th class="text-center"><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody id="adddelivery_noteItem">
                        <tr>
                            <td class="product_field">
                                <input type="text" required name="product_name" onkeypress="delivery_note_productList(1)" id="product_name_1" class="form-control productSelection" placeholder="<?php echo display('product_name') ?>" tabindex="5">

                                <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId" />

                                <input type="hidden" class="baseUrl" value="<?php echo base_url(); ?>" />
                            </td>
                            <td style="display:none">
                                <input type="text" name="desc[]" class="form-control text-right " tabindex="6" />
                            </td>
                            <td class="delivery_note_fields" style="display:none">
                                <select class="form-control" id="serial_no_1" name="serial_no[]" tabindex="7">
                                    <option></option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="available_quantity[]" class="form-control text-right available_quantity_1" value="0" readonly="" />
                            </td>
                            <td class="text-right cls1">
                                <input type="text" name="sales_unit[]" id="sales_unit_1" required="" min="0" class="form-control text-right sales_unit_1" onkeyup="" onchange="" placeholder="0.00" value="" tabindex="6" readonly />
                                <input type="hidden" name="item_pcs[]" id="item_pcs_1" value="">
                            </td>

                            <td>
                                <input type="text" name="unit[]" class="form-control text-right " id="unit_1" readonly="" value="" />
                            </td>
                            <td class="cls1">
                                <input type="text" name="Cartons[]" class="form-control text-right " id="Cartons_1" value="" onkeyup="CheckCartons2(1);" onchange="CheckCartons2(1);" />
                            </td>
                            <td class="cls1">
                                <input type="text" name="pcs[]" class="form-control text-right " id="pcs_1" value="" onkeyup="CheckCartons2(1);" onchange="CheckCartons2(1);" />
                            </td>
                            <td class="cls1">
                                <input type="text" name="tot_ctn[]" class="form-control text-right " id="tot_ctn_1" value="" onkeyup="CheckCartons2(1);" onchange="CheckCartons2(1);" />
                            </td>


                            <td>
                                <input type="text" name="product_quantity[]" required="" onkeyup="bdtask_delivery_note_quantity_calculate(1);" onchange="bdtask_delivery_note_quantity_calculate(1);" class="total_qntt_1 form-control text-right" id="total_qntt_1" placeholder="0.00" min="0" tabindex="8" value="1" />
                            </td>
                            <td class="delivery_note_fields">
                                <input type="text" name="product_rate[]" id="price_item_1" class="price_item1 price_item form-control text-right" tabindex="9" required="" onkeyup="bdtask_delivery_note_quantity_calculate(1);" onchange="bdtask_delivery_note_quantity_calculate(1);" placeholder="0.00" min="0" />
                            </td>
                            <!-- Discount -->
                            <td>
                                <input type="text" name="discount[]" onkeyup="bdtask_delivery_note_quantity_calculate(1);" onchange="bdtask_delivery_note_quantity_calculate(1);" id="discount_1" class="form-control text-right" min="0" tabindex="10" placeholder="0.00" />
                                <input type="hidden" value="<?php echo $discount_type ?>" name="discount_type" id="discount_type_1">

                            </td>


                            <td class="delivery_note_fields">
                                <input class="total_price form-control text-right" type="text" name="total_price[]" id="total_price_1" value="0.00" readonly="readonly" />
                            </td>

                            <td>
                                <!-- Tax calculate start-->
                                <?php $x = 0;
                                foreach ($taxes as $taxfldt) { ?>
                                    <input id="total_tax<?php echo $x; ?>_1" class="total_tax<?php echo $x; ?>_1" type="hidden">
                                    <input id="all_tax<?php echo $x; ?>_1" class="total_tax<?php echo $x; ?>" type="hidden" name="tax[]">

                                    <!-- Tax calculate end-->

                                    <!-- Discount calculate start-->

                                <?php $x++;
                                } ?>
                                <!-- Tax calculate end-->

                                <!-- Discount calculate start-->
                                <input type="hidden" id="total_discount_1" class="" />
                                <input type="hidden" id="all_discount_1" class="total_discount dppr" name="discount_amount[]" />
                                <!-- Discount calculate end -->

                                <button class='btn delete_btn text-right' type='button' value='Delete' onclick='deleteRow_delivery_note(this)'><i class='fal fa-trash-alt'></i></button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9" rowspan="2" class="cls2">
                                <center><label for="details" class="  col-form-label text-center"><?php echo display('delivery_note_details') ?></label></center>
                                <textarea name="inva_details" id="details" class="form-control" placeholder="<?php echo display('delivery_note_details') ?>" tabindex="12"></textarea>
                            </td>
                            <td class="text-right" colspan="1"><b><?php echo 'Discount'; ?>:</b></td>
                            <td class="text-right">
                                <input type="text" onkeyup="bdtask_delivery_note_quantity_calculate(1);" onchange="bdtask_delivery_note_quantity_calculate(1);" id="delivery_note_discount" class="form-control text-right total_discount" name="delivery_note_discount" placeholder="0.00" tabindex="13" />
                                <input type="hidden" id="txfieldnum">
                            </td>
                            <td><a href="javascript:void(0)" id="add_delivery_note_item" class="btn action_btn" name="add-delivery_note-item" onClick="addInputField_delivery_note('adddelivery_noteItem');" tabindex="11"><i class="fa fa-plus"></i></a></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="1"><b><?php echo display('total_discount') ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" value="0.00" readonly="readonly" />
                            </td>
                        </tr>
                        <?php $x = 0;
                        foreach ($taxes as $taxfldt) { ?>
                            <tr class="hideableRow hiddenRow">

                                <td class="text-right cls3" colspan="10"><b><?php echo html_escape($taxfldt['tax_name']) ?></b></td>
                                <td class="text-right">
                                    <input id="total_tax_ammount<?php echo $x; ?>" tabindex="-1" class="form-control text-right valid totalTax" name="total_tax<?php echo $x; ?>" value="0.00" readonly="readonly" aria-invalid="false" type="text">
                                </td>
                            </tr>
                        <?php $x++;
                        } ?>

                        <tr>
                        <tr>
                            <td class="text-right cls3" colspan="10"><b><?php echo display('total_tax') ?>:</b></td>
                            <td class="text-right">
                                <input id="total_tax_amount" tabindex="-1" class="form-control text-right valid" name="total_tax" value="0.00" readonly="readonly" aria-invalid="false" type="text">
                            </td>
                            <td><button type="button" class="toggle btn-warning">
                                    <i class="fa fa-angle-double-down"></i>
                                </button></td>
                        </tr>

                        <tr>
                            <td class="text-right cls3" colspan="10"><b><?php echo display('shipping_cost') ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="shipping_cost" class="form-control text-right" name="shipping_cost" onkeyup="bdtask_delivery_note_quantity_calculate(1);" onchange="bdtask_delivery_note_quantity_calculate(1);" placeholder="0.00" tabindex="14" />
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right cls3" colspan="10"><b><?php echo display('grand_total') ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" value="0.00" readonly="readonly" />
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right cls3" colspan="10"><b><?php echo display('previous'); ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="previous" class="form-control text-right" name="previous" value="0.00" readonly="readonly" />
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right cls3" colspan="10"><b><?php echo display('net_total'); ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="n_total" class="form-control text-right" name="n_total" value="0" readonly="readonly" placeholder="" />
                            </td>
                        </tr>
                        <tr>

                            <td class="text-right cls3" colspan="10"><b><?php echo display('paid_ammount') ?>:</b></td>
                            <td class="text-right">
                                <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url(); ?>" />
                                <input type="text" id="paidAmount" onkeyup="delivery_note_paidamount();" class="form-control text-right" name="paid_amount" placeholder="0.00" tabindex="15" value="" />
                            </td>
                        </tr>
                        <tr>


                            <td class="text-right cls3" colspan="10"><b><?php echo display('due') ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="dueAmmount" class="form-control text-right" name="due_amount" value="0.00" readonly="readonly" />
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <input type="button" id="full_paid_tab" class="btn btn-warning" value="<?php echo display('full_paid') ?>" tabindex="16" onClick="delivery_notee_full_paid()" />

                                <input type="submit" id="add_delivery_note" class="btn btn-primary" name="add-delivery_note" value="<?php echo display('submit') ?>" tabindex="17" />
                            </td>
                            <td colspan="8" class="text-right cls2"><b><?php echo display('change'); ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="change" class="form-control text-right" name="change" value="0" readonly="readonly" placeholder="" />
                                <input type="hidden" name="is_normal" value="1">
                            </td>
                        </tr>
                    </tfoot>
                </table>
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
                        <a href="<?php echo base_url('delivery_note_list') ?>" class="btn btn-default"><?php echo display('no') ?></a>

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
<script>
    window.onload = ChangeInvoice;

    function CheckCartons2(ln) {
        //alert(1);
        var item_pcs = Number(document.getElementById("item_pcs_" + ln).value);

        var pcs = Number(document.getElementById("pcs_" + ln).value);

        var Cartons = Number(document.getElementById("Cartons_" + ln).value);
        var unit_pack = document.getElementById("sales_unit_" + ln).value;
        //alert(unit_pack);											
        var pcs_per_ctn = item_pcs * Cartons;
        var total_pcs = pcs + pcs_per_ctn;
        if (item_pcs > 0) {
            var total_carton = total_pcs / item_pcs;
        } else {
            if ((pcs == '' || pcs <= 0) && Cartons > 0) {
                var total_carton = Cartons;
            } else {
                var total_carton = 0; //pcs;
            }
        }
        //alert(total_carton+' cartons');

        document.getElementById("tot_ctn_" + ln).value = total_carton.toFixed(4);
        var tot_ctn = Number(document.getElementById("tot_ctn_" + ln).value);
        var Qty = unit_pack * tot_ctn;
        document.getElementById("total_qntt_" + ln).value = Qty.toFixed(4);
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
            for (var i = 0; i < taxnumber; i++) {
                $("#all_tax" + i + "_" + item).val(0);
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
                for (var i = 0; i < taxnumber; i++) {

                    var tax = (temp) * $("#total_tax" + i + "_" + item).val();
                    ttletax += Number(tax);
                    $("#all_tax" + i + "_" + item).val(tax);
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
                for (var i = 0; i < taxnumber; i++) {
                    var tax = (temp) * $("#total_tax" + i + "_" + item).val();
                    ttletax += Number(tax);
                    $("#all_tax" + i + "_" + item).val(tax);
                }
            } else if (dis_type == 3) {
                var total_price = quantity * price_item;
                var dis = discount;
                // Discount cal per product
                $("#all_discount_" + item).val(dis);
                //Total price calculate per product
                var price = total_price - dis;
                $("#total_price_" + item).val(price);

                var ttletax = 0;
                for (var i = 0; i < taxnumber; i++) {
                    var tax = (price) * $("#total_tax" + i + "_" + item).val();
                    ttletax += Number(tax);
                    $("#all_tax" + i + "_" + item).val(tax);
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

    function ChangeInvoice() {
        var sel = $("#invoicetype").val();
        if (sel == 1) {
            $('.cls1').hide();
            $('.cls2').attr('colspan', 5);
            $('.cls3').attr('colspan', 6);
        } else {
            $('.cls1').show();
            $('.cls2').attr('colspan', 9);
            $('.cls3').attr('colspan', 10);
        }
    }
</script>