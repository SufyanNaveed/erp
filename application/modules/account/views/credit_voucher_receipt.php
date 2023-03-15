
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-bd">
                    <div id="printableArea">
                        <div class="panel-body">
                            <div bgcolor='#e4e4e4' text='#ff6633' link='#666666' vlink='#666666' alink='#ff6633' class="phdiv" >
                                <table border="1" width="100%" style="border-spacing: 30px;">
                                    <tr>
                                        <td >

                                            <table border="0" width="100%" >
                                                
                                                <tr>
                                                    <td align="left">
                                                        
                                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="company-txt">
                                                            <?php echo $company_info[0]['company_name']?>
                                                        </span><br>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $company_info[0]['address']?> 
                                                        <?php echo $company_info[0]['mobile']?><br>
                                                       
                                                        
                                                    </td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <td colspan="2" align="center" style="border:1px solid black;border-left:1px solid black;border-right:1px solid black;"><b>Credit Voucher</b></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="border-bottom: 1px solid black;" ><?php echo  html_escape($account_info)?></span></td>
                                                    <td align="right">
                                                    <?php echo display('voucher_no'); ?> : <?php echo  html_escape($voucher_info[0]['VNo'])?>&nbsp;&nbsp;&nbsp;&nbsp;<br>
                                                        <nobr>
                                                    <date>
                                                        <?php echo  display('date')?>: <?php echo  html_escape($voucher_info[0]['VDate'])?>&nbsp;&nbsp;&nbsp;&nbsp; 
                                                    </date>
                                                </nobr></td>
                                    </tr>
                                    <tr>
                                    <td class="text-left" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo 'Description:'; ?>  <span style="border-bottom: 1px solid black;"><?php echo  html_escape($voucher_info[0]['Narration']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                    </tr>
                                    
                                    <tr>
                                    <td class="text-left"></td><td class="text-left"><?php echo 'Amount'; ?> : <span style="border-bottom: 1px solid black;"><?php echo  html_escape($voucher_info[0]['Credit']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                    </tr>
                                   
                                </table>

                               
                               
                                </td>
                                 <tr>
                                    
                                    <td style="border:1px solid white;border-left:1px solid black;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo "Prepared & Checked By: ";?> <br> <div style="margin-top: 1px;float: left; width: 30%; text-align: left; border-top: 1px solid grey;margin-left: 18px;"><?php echo  $this->session->userdata('fullname');?></div>

                                       </td>
                                   
                                </tr>
                                </tr>
                                <tr>
                                    <td>
                                    <div  class="psigpart">
                                        <?php echo display('signature') ?>
                                          
                                    </div>
                                    </td>
                                     
                                </tr>
                                </table>


                            </div>


                        </div>
                    </div>

                    <div class="panel-footer text-left">
                        <a  class="btn btn-danger" href="<?php echo base_url('supplier_payment'); ?>"><?php echo display('cancel') ?></a>
                        <a  class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></a>

                    </div>
                </div>
            </div>
        </div>

