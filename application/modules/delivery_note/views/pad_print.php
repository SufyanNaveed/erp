 <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div id="printableArea">
                        <div class="panel-body">
                              <div class="row" style="height:<?php echo (!empty($print_setting->header)?$print_setting->header:200).'px'?>">
                                
                                
                                 
                              
                            </div> 
                               <address >  

                                        <b class="text-right"><?php echo display('customer_name').' : '.$customer_name?> </b><b class="pad-print-customername"><?php echo display('delivery_note_no').':'. $delivery_note_no?> </b>
                                        <b class="padprint-date"><?php echo display('date').': '. $final_date?> </b>
                                    </address>

                                             <table width="100%" class="table-striped">
                                                <thead>
                                    <tr class="pthead" >
                                        <td><?php echo display('sl'); ?></td>
                                        <td><?php echo display('product_name'); ?></td>
                                         <th  align="center"><?php if($is_unit !=0){ echo display('unit');
                                              }?></th>
                                        <td><?php  if($is_desc !=0){ echo display('item_description');} ?></td>
                                        <td><?php if($is_serial !=0){ echo display('serial_no');} ?></td>
                                        <td align="right"><?php echo display('quantity'); ?></td>
                                        <td align="right"><?php if($is_discount > 0){ echo display('discount');
                                    }else{
                                            echo '';
                                        } ?></td>
                                        <td align="right"><?php echo display('rate'); ?></td>
                                        <td align="right"><?php echo display('ammount'); ?></td>
                                    </tr>
                                </thead>
                               <tbody>
                                    <?php 
                                    $sl =1;
                                    $s_total = 0;
                                    foreach($delivery_note_all_data as $delivery_note_data){?>
                                    <tr>
                                        <td align="left"><nobr><?php echo $sl;?></nobr></td>
                                    <td align="left"><nobr><?php echo html_escape($delivery_note_data['product_name']).'('.html_escape($delivery_note_data['product_model']).')';?></nobr></td>
                                  <td align="left"><nobr><?php echo html_escape($delivery_note_data['unit']);?></nobr></td>
                                    <td align="left"><nobr><?php echo html_escape($delivery_note_data['description']);?></nobr></td>
                                    <td align="left"><nobr><?php echo html_escape($delivery_note_data['serial_no']);?></nobr></td>
                                    <td align="right"><nobr><?php echo html_escape($delivery_note_data['quantity']);?></nobr></td>
                                    <td align="right">
                                    <nobr>
                                        <?php 
                                        if(!empty($delivery_note_data['discount_per'])){
                                            $curicon = $currency;
                                        }else{
                                            $curicon = '';
                                        }
                                    if($position == 0){
                                       echo  $curicon.' '.html_escape($delivery_note_data['discount_per']);
                                    }else{
                                    echo html_escape($delivery_note_data['discount_per']).' '.$curicon;
                                    }
                                         ?>
                                    </nobr>
                                    </td>
                                    <td align="right">
                                    <nobr>
                                        <?php 
                                         if($position == 0){
                                       echo  $currency.' '.html_escape($delivery_note_data['rate']);
                                    }else{
                                    echo html_escape($delivery_note_data['rate']).' '.$currency;
                                    }
                                         ?>
                                    </nobr>
                                    </td>
                                    <td align="right">
                                    <nobr>
                                        <?php 
                                       if($position == 0){
                                       echo  $currency.' '.html_escape($delivery_note_data['total_price']);
                                    }else{
                                    echo html_escape($delivery_note_data['total_price']).' '.$currency;
                                    }
                                    $s_total += $delivery_note_data['total_price'];
                                         ?>
                                    </nobr>
                                    </td>
                                    </tr>
                                    <?php $sl++; }?>
                                </tbody>
                          <tfoot>
                                    <tr>
                                        <td colspan="9" class="minpos-bordertop"><nobr></nobr></td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" class="minpos-bordertop"><nobr></nobr></td>
                                    </tr>
                                     <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="right" colspan="7"><b><?php echo display('total') ?></b></td>
                                    <td align="right">
                                    <b>
                                        <?php if($position == 0){
                                       echo  $currency.' '.html_escape(number_format($s_total, 2, '.', ','));
                                    }else{
                                    echo html_escape(number_format($s_total, 2, '.', ',')).' '.$currency;
                                    } ?>
                                    </b>
                                    </td>
                                    </tr>
                                    <?php if($total_tax > 0){?>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="right" colspan="7"><b><?php echo display('tax') ?></b></td>
                                    <td align="right">
                                    <b>
                                        <?php echo html_escape((($position == 0) ? $currency.' '.$total_tax : $total_tax.' '. $currency)) ?>
                                    </b>
                                    </td>
                                    </tr>
                                    <?php }?>
                                     <?php if($delivery_note_discount > 0){?>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="right" colspan="7"><b><?php echo display('delivery_note_discount'); ?></b></td>
                                    <td align="right"><b>
                                        <?php echo html_escape((($position == 0) ? $currency.' '.$delivery_note_discount  : $delivery_note_discount.' '. $currency)) ?>
                                    </b></td>
                                    </tr>
                                    <?php }?>
                                    <?php if($total_discount > 0){?>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="right" colspan="7"><b><?php echo display('total_discount') ?></b></td>
                                    <td align="right">
                                    <b>
                                        <?php echo html_escape((($position == 0) ? $currency.' '.$total_discount : $total_discount.' '.$currency)) ?>
                                    </b></td>
                                    </tr>
                                      <?php }?>
                                       <?php if($shipping_cost > 0){?>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="right" colspan="7"><b><?php echo display('shipping_cost') ?></b></td>
                                    <td align="right"><b>
                                        
                                            <?php echo html_escape((($position == 0) ? $currency.' '.$shipping_cost : $shipping_cost.' '. $currency)) ?>
                                        </b></td>
                                    </tr>
                                    <?php }?>
                                       <?php if($previous > 0){?>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="right" colspan="7"><b><?php echo display('previous') ?></b></td>
                                    <td align="right"><b>
                                        
                                            <?php echo html_escape((($position == 0) ? $currency.' '.$previous : $previous.' '.$currency)) ?>
                                        </b></td>
                                    </tr>
                                    <?php }?>
                                    <tr>
                                        <td colspan="8" class="minpos-bordertop"><nobr></nobr></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td colspan="6"><span align="right"><b><?php echo display('in_word').' : ' ?></b><?php echo $am_inword?></span> <?php echo display('taka_only')?></td><td align="right"><strong><?php echo display('grand_total')?></strong></td>
                                    <td align="right"><nobr>
                                        <strong>
                                            <?php echo html_escape((($position == 0) ? $currency.' '.$total_amount :$total_amount.' '. $currency))
                                             ?>
                                        </strong></nobr></td>
                                    </tr>

                                    <tr>
                                        <td colspan="9" class="minpos-bordertop"><nobr></nobr></td>
                                    </tr>
                                     <?php if($paid_amount > 0){?>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="right" colspan="7"><b>
                                        <?php echo display('paid_ammount') ?>
                                    </b></td>
                                    <td align="right"><b>
                                        <?php echo html_escape((($position == 0) ? $currency.' '.$paid_amount : $paid_amount.' '. $currency)) ?>
                                    </b></td>
                                    </tr>
                                     <?php }?>
                                    <?php if($due_amount > 0){?>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="right" colspan="7"><b><?php echo display('due') ?></b></td>
                                    <td align="right"><b>
                                        <?php echo html_escape((($position == 0) ? $currency.' '.$due_amount : $due_amount.' '.$currency)) ?>
                                    </b></td>
                                    </tr>
                                <?php }?>
                                    <tr>
                                        <td colspan="8" class="minpos-bordertop"><nobr></nobr></td>
                                    </tr>
                                </tfoot>
                                </table>
                               <table class="table">
                                
                                <tr>
                                    <td><?php echo $delivery_note_details?></td><td></td><td></td><td></td>
                                </tr>
                                <tr>
                                    
                                    <td> <b><?php echo display('sold_by')?> </b>: <?php echo $users_name;?><br>
                                        Powered By: IvyLab Technologies ( <a href="javascript:void(0)"><?php echo $company_info[0]['website']?></a> )
                                 
                                       </td>
                                       <td class="text-right" colspan="2"> <div class="sig_div">
                                        <?php echo display('signature') ?>
                                         
                                    </div></td>
                                   
                                </tr>
                               
                                </table>
                                  <div class="row" style="height:<?php echo (!empty($print_setting->footer)?$print_setting->footer:100).'px'?>"></div> 
                                </div>

                        
                        </div>
                    </div>
                        <div class="panel-footer text-left">
                        <a  class="btn btn-danger" href="<?php echo base_url('add_delivery_note'); ?>"><?php echo display('cancel') ?></a>
                        <a  class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></a>
                   
                    </div>


  </div>  

</div> <!-- /.content-wrapper -->
