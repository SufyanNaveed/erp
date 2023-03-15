<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div id="printableArea" onload="printDiv('printableArea')">
                        <div class="panel-body">
                            <div class="row print_header" style="border-bottom: 2px white solid !important;">
                                <table class="header2" border="0" width="100%" cellpadding="0" cellspacing="0" style="margin-top:-50px;">         
                                    <tr> 
                                        <td width="20%" ><img src="<?php
                                                if (isset($setting->invoice_logo)) {
                                                    echo base_url().$setting->invoice_logo;
                                                }
                                                ?>" alt="<?php
                                                if (isset($setting->invoice_logo)) {
                                                    echo base_url().$setting->invoice_logo;
                                                }
                                                ?>" width="280" style="padding-top:5px;" /></td> 
                                                <td width="20%" ></td>
                                        <td width="60%" style="padding-top:20px;text-align:right">  
                                        <?php foreach($company_info as $cominfo){?>   
                                            <table cellpadding="0" cellspacing="0" style="text-align: right;width:96%"> 
                                                <tr> 
                                                    <td  style="font-size:22px; text-align:right"><strong><?php echo $cominfo['company_name']?></strong></td> 
                                                </tr> 
                                                
                                                <tr> 
                                                    <td style="font-size:13px;text-align:right"><b><?php echo $cominfo['address']?> </td> 
                                                </tr>
                                                    <td><b>&nbsp;<?php echo 'Mobile: ';?></b></abbr><?php echo $cominfo['mobile']?>  </td> 
                                                </tr> 
                                                </tr>
                                                    <td><b>&nbsp;<?php echo 'Email: ';?></b></abbr><?php echo $cominfo['email']?>  </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="font-size:13px;text-align:right"><b>Web:</b> <?php echo $cominfo['website']?> </td> 
                                                </tr> 
                                                <!-- <tr> 
                                                    <td style="font-size:22px;text-align:right"><strong>Sales Invoice</strong> </td> 
                                                </tr>  -->
                                            </table> 
                                            <?php }?>
                                            
                                        </td> 
                                    </tr> 
                                </table> 
                               
                                <div class="table-responsive" style="margin-top:25px !important;margin-right:35px;">
                                <table class="table" border="0">
                                <thead>
                                        <tr>
                                            <td style="text-align:left;background:white">&nbsp;</td>
                                            <td style="text-align:right;background:white">Delivery Note #: <?php echo $delivery_note_id;?></td>
                                        </tr>
                                        <tr style="margin-bottom:1px solid white;">
                                            <td style="text-align:left;background:white"><?php echo 'Customer Name:'; ?><?php echo $customer_name;?></td>
                                            <td style="text-align:right;background:white">Sales Invoice #: <?php echo $invoice_no;?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left;background:white"><?php echo 'Mob:'; ?><?php echo $customer_mobile;?></td>
                                            <td style="text-align:right;background:white">Date: <?php echo date("d-M-Y",strtotime($final_date));?></td>
                                        </tr>
                                        
                                </thead>
                                 <tbody>
                                    <tr>
                                        <td></td>
                                    </tr>
                                 </tbody>
                                </table> 
                            </div> 
                            
                            <div class="table-responsive" style="margin-top:-45px !important;margin-right:35px;">
                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="border: 1px solid black;"><?php echo 'Sr.'; ?></th>
                                            <th class="text-center" style="border: 1px solid black;"><?php  echo 'Description'; ?></th>
                                            <th class="text-right" style="border: 1px solid black;"><?php echo 'Box.';?></th>
                                            <th class="text-right" style="border: 1px solid black;"><?php echo 'Qty.';?></th>
                                            <th class="text-right" style="border: 1px solid black;"><?php echo 'Meter.';?></th>
                                            <?php if($is_discount > 0){ ?>
                                            <?php if ($discount_type == 1) { ?>
                                                <!-- <th class="text-right" style="border: 1px solid black;"><?php echo display('discount_percentage') ?> %</th> -->
                                            <?php } elseif ($discount_type == 2) { ?>
                                                <!-- <th class="text-right" style="border: 1px solid black;"><?php echo display('discount') ?> </th> -->
                                            <?php } elseif ($discount_type == 3) { ?>
                                                <!-- <th class="text-right" style="border: 1px solid black;"><?php echo display('fixed_dis') ?> </th> -->
                                            <?php } ?>
                                        <?php }else{ ?>
                                        <!-- <th class="text-right" style="border: 1px solid black;"><?php echo ''; ?> </th> -->
                                        <?php }?>
                                            <th class="text-right" style="border: 1px solid black;"><?php echo 'Price'; ?></th>
                                            <th class="text-right" style="border: 1px solid black;"><?php echo 'Net Rate'; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i = 0;
                                        foreach($invoice_all_data as $details){
                                            $i++;
                                            ?>
                                        <tr>
                                            <td class="text-center" style="border: 1px solid black;"><?php echo $details['sl']?></td>
                                            <td class="text-center" style="border: 1px solid black;"><div><?php echo $details['product_name']?> - (<?php echo $details['product_model']?>)</div></td>
                                              <!-- <td class="text-center" style="border: 1px solid black;"><div><?php echo $details['unit']?></div></td> -->
                                            <!-- <td align="center" style="border: 1px solid black;"><?php echo $details['description']?></td>
                                            <td align="center" style="border: 1px solid black;"><?php echo $details['serial_no']?></td> -->
                                            <td align="right" style="border: 1px solid black;"><?php echo $details['Cartons']?></td>
                                            <td align="right" style="border: 1px solid black;"><?php echo $details['quantity']?></td>
                                            <td align="right" style="border: 1px solid black;"><?php echo $details['sales_unit']?></td>

                                            <?php if ($discount_type == 1) { ?>
                                                <!-- <td align="right" style="border: 1px solid black;"><?php echo $details['discount_per'];?></td> -->
                                            <?php } else { ?>
                                                <!-- <td align="right" style="border: 1px solid black;"></td> -->
                                            <?php } ?>

                                            <td align="right" style="border: 1px solid black;"><?php echo $details['rate'] ?></td>
                                            <td align="right" style="border: 1px solid black;"><?php echo $details['total_price'] ; ?></td>
                                        </tr>
                                        <?php }?>
                                        
                                        <?php

                                        if($i == 1)
                                        {
                                            $k = 1;
                                        }
                                        else
                                        {
                                            $k = 5;
                                        }
                                        for($j=1; $j<=$k; $j++)
                                        {
                                        ?>
                                        <tr>
                                        <td style="border: 1px solid black;" height="5px" ><br><br></td>
                                        <td style="border: 1px solid black;" height="5px" ></td>
                                        <td style="border: 1px solid black;" height="5px" ></td>
                                        <td style="border: 1px solid black;" height="5px" ></td>
                                        <td style="border: 1px solid black;" height="5px" ></td>
                                        <td style="border: 1px solid black;" height="5px" ></td>
                                        <td style="border: 1px solid black;" height="5px" ></td>
                                      
                                        </tr>

                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <td class="text-left" colspan="4" style="border: 1px solid black;"><b><?php echo display('grand_total') ?>:</b></td>
                                            <td align="right" style="border: 1px solid black;"><b><?php echo number_format($subTotal_quantity,2)?></b></td>
                                            <td style="border: 1px solid black;"></td>
                                            <!-- 
                                            <td style="border: 1px solid black;"></td> -->
                                            <td align="right" style="border: 1px solid black;"><b><?php echo $subTotal_ammount; ?></b></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                               <div class="row">
                                <div class="col-xs-8 invoicefooter-content">
                                    <p></p>
                                    <p><strong><?php echo $invoice_details?></strong></p> 
                                </div>
                                <div class="col-xs-4 inline-block">

                                    <table class="table">
                                        <?php
                                        if ($invoice_all_data[0]['total_discount'] != 0) {
                                            ?>
                                            <tr>
                                                <th class="border-bottom-top"><?php echo display('total_discount') ?> : </th>
                                                <td class="text-right border-bottom-top"><?php echo html_escape($total_discount) ?> </td>
                                            </tr>
                                            <?php
                                        }
                                        if ($invoice_all_data[0]['total_tax'] != 0) {
                                            ?>
                                            <tr>
                                                <th class="text-left border-bottom-top"><?php echo display('tax') ?> : </th>
                                                <td  class="text-right border-bottom-top"><?php echo html_escape($total_tax) ?> </td>
                                            </tr>
                                        <?php } ?>
                                         <?php if ($invoice_all_data[0]['shipping_cost'] != 0) {
                                            ?>
                                            <tr>
                                                <th class="text-left border-bottom-top"><?php echo 'Shipping Cost' ?> : </th>
                                                <td class="text-right border-bottom-top"><?php echo html_escape($shipping_cost) ?> </td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <th class="text-left grand_total"><?php echo display('previous'); ?> :</th>
                                            <td class="text-right grand_total"><?php echo html_escape($previous) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-left grand_total"><?php echo display('grand_total') ?> :</th>
                                            <td class="text-right grand_total"><?php echo html_escape((($position == 0) ? $currency.' '.$total_amount : $total_amount.' '. $currency)) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-left grand_total border-bottom-top"><?php echo display('paid_ammount') ?> : </th>
                                            <td class="text-right grand_total border-bottom-top"><?php echo html_escape((($position == 0) ? $currency.' '.$paid_amount : $paid_amount.' '. $currency)) ?></td>
                                        </tr>                
                                        <?php
                                        if ($invoice_all_data[0]['due_amount'] != 0) {
                                            ?>
                                            <tr>
                                                <th class="text-left grand_total"><?php echo display('due') ?> : </th>
                                                <td  class="text-right grand_total"><?php echo html_escape((($position == 0) ? $currency.' '.$due_amount : $due_amount.' '. $currency)) ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        
                                    </table>

                                   

                                </div>
                            </div>
                            <div class="row margin-top50">
                                
                               <div class="col-sm-12"></div>
                                     <div class="col-sm-12 text-center"> 
                                     <img src="<?php
									echo base_url().'assets/img/icons/notes.jpg';
                                    ?>" alt="" width="740" align="center" />
                                     </div>
                            </div>
                            <div class="row margin-top50">
                                <div class="col-sm-4">
                                 <div class="inv-footer-left">
                                        <?php echo display('received_by') ?>
                                    </div>
                                </div>
                               <div class="col-sm-4"></div>
                                     <div class="col-sm-4"> <div class="inv-footer-right">
                                        <?php echo display('authorised_by') ?>
                                    </div></div>
                            </div>
                           
                        </div>
                    </div>

                    <div class="panel-footer text-left">
                       
                        <button  class="btn btn-info" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></button>

                    </div>
                </div>
            </div>
        </div>