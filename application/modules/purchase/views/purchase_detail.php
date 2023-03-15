<style>
.flex-container {
    display: flex;
	flex-flow: row;
    justify-content: space-between;
    align-items: flex-start;
	width:100%
}

.flex-child {
    /* flex: 2; */
    border: 2px solid yellow;
	width: 15%;
}  
.flex-child2 {
    /* flex: 2; */
    border: 2px solid yellow;
	width: 85%;
	text-align: center;
}  

.flex-child:first-child {
    margin-right: 20px;
} 
</style>
	    <div class="row">
            <div class="col-sm-12">
                <?php if($this->permission1->method('add_purchase','create')->access()){ ?>
                  <a href="<?php echo base_url('add_purchase')?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_purchase')?> </a>
                  <?php }?>
                <?php if($this->permission1->method('manage_supplier','read')->access()){ ?>
                  <a href="<?php echo base_url('purchase_list')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('manage_purchase')?> </a>
              <?php }?>

               
            </div>
        </div>


		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <span><?php echo display('purchase_details') ?></span>
		                    <span class="print-button">
		                     <button  class="btn btn-info " onclick="printDiv('printableArea')"><span class="fa fa-print"></span></button></span>
		                </div>
		            </div>
		            <div class="panel-body" id="printableArea">
						
					<table class="header2" border="0" width="100%" cellpadding="0" cellspacing="0" style="padding-top:20px;">         
						<tr> 
							<td width="20%"><img src="<?php
                                    if (isset($setting->invoice_logo)) {
                                        echo base_url().$setting->invoice_logo;
                                    }
                                    ?>" alt="<?php
                                    if (isset($setting->invoice_logo)) {
                                        echo base_url().$setting->invoice_logo;
                                    }
                                    ?>" width="280" height="150" /></td> 
							<td width="80%" style="padding-left:40px;padding-top:20px;">  
							<?php foreach($company_info as $cominfo){?>   
								<table cellpadding="0" cellspacing="0" > 
									<tr> 
										<td  style="font-size:22px; text-align:center"><strong><?php echo $cominfo['company_name']?></strong></td> 
									</tr> 
									
									<tr> 
										<td style="font-size:13px;text-align:center"><b><?php echo $cominfo['address']?> &nbsp;<?php echo display('mobile') ?>:</b></abbr><?php echo $cominfo['mobile']?>  </td> 
									</tr> 
									<tr> 
										<td style="font-size:13px;text-align:center">Web: <?php echo $cominfo['website']?> </td> 
									</tr> 
								</table> 
								<?php }?>
								<table cellpadding="0" cellspacing="0" border="0" style="margin-top:20px;"> 
									<tr> 
										<td width="30px"></td> 
										<td width="450px" style="font-size:18px; text-align:center"><strong>Purchase Invoice</strong></td> 
										
									</tr> 
								</table> 
							</td> 
						</tr> 
					</table> 
					<hr>
					<table class="content" width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="margin-top:-75px;margin-right:35px;"> 
						<tr> 
							<td class="fieldset_long"> 
							<table border="0" cellpadding="0" cellspacing="0" class="openCell"> 
									<tr> 
										<td style="font-size:14px">
											 
											<address>
												<strong class="companyname" ><?php echo $supplier_name;?></strong><br>
												<abbr><b><?php echo 'Address'?>:</b> <?php echo $supplier_address ?> </abbr><br>
												<abbr><b><?php echo display('mobile') ?>:</b> <?php echo $supplier_phone ?> </abbr> <br>
												<abbr><b><?php echo display('email') ?>:</b><?php echo $supplier_email ?></abbr> 
											</address>
										</td> 
									</tr> 
									<tr> 
										<td style="font-size:11px"></td> 
									</tr> 
								</table> 
							</td> 
							<td style="width:20px"></td> 
							<td style="padding-top:12px">     
								<table border="0" cellpadding="0" cellspacing="0" class="openCell"> 
									<tr> 
										<td style="font-size:14px">
										<address>
												<strong class="companyname" >Purchase Invoice #: <?php echo $chalan_no;?></strong><br>
												Billing Date: <?php echo $final_date;?><br>
												<abbr><b></b></abbr> <br>
												<abbr><b></b></abbr> 
											 <br>
												<abbr><b></b></abbr> 
											<br>
											</address>
										</td> 
									</tr> 
									<tr> 
										<td style="font-size:14px"></td> 
									</tr> 
								</table> 
							</td> 
						</tr> 
					</table> 
					<table  class="table table-bordered table-striped table-hover" style="margin-top:-75px;">
								<thead>
									<tr>
										<th><?php echo display('sl') ?></th>
										<th><?php echo display('product_name') ?></th>
										
										
										<th class="text-center"><?php echo 'Packing' ?></th>
										<th class="text-center"><?php echo 'Cartons/Box' ?></th>
										<th class="text-center"><?php echo 'Tiles' ?></th>
										<th class="text-center"><?php echo 'Total Carton' ?></th>
										<th class="text-center"><?php echo display('quantity') ?></th>
										<th class="text-center"><?php echo display('rate') ?></th>
										<th class="text-center"><?php echo display('total_amount') ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($purchase_all_data) {
								?>
								<?php foreach($purchase_all_data as $details){?>
									<tr>
										<td><?php echo $details['sl']?></td>
										<td>
											
										<?php echo $details['product_name'].' -('.$details['product_model'].')'?>		
										</td>
										<td class="text-right"><?php echo $details['sales_unit']?> <?php echo $details['unit']?></td>
										<!-- <td class="text-right"><?php echo $details['item_pcs']?></td> -->
										<td class="text-right"><?php echo $details['Cartons']?></td>
										<td class="text-right"><?php echo $details['pcs']?></td>
										<td class="text-right"><?php echo $details['tot_ctn']?></td>
										<td class="text-right"><?php echo $details['quantity']?></td>
										<td class="text-right"><?php echo (($position==0)?$currency.' '.$details['rate']:$details['rate'].' '.$currency) ?></td>
										<td class="text-right"><?php echo (($position==0)?$currency.' '.$details['total_amount']:$details['total_amount'].' '.$currency) ?></td>
									</tr>
								
								<?php
							}}
								?>
								</tbody>
								<tfoot>
									<tr>
										<td class="text-right" colspan="8"><b><?php echo display('total') ?>:</b></td>
										<td  class="text-right"><b><?php echo (($position==0)?$currency.' '.$total:$total.' '.$currency) ?></b></td>
									</tr>
									 <?php if($discount > 0){?>
									<tr>
										<td class="text-right" colspan="8"><b><?php echo display('discounts') ?>:</b></td>
										<td  class="text-right"><b><?php echo (($position==0)?$currency.' '.$discount:$discount.' '.$currency) ?></b></td>
									</tr>
								<?php }?>
									<tr>
										<td class="text-right" colspan="8"><b><?php echo display('grand_total') ?>:</b></td>
										<td  class="text-right"><b><?php echo (($position==0)?$currency.' '.$sub_total_amount:$sub_total_amount.' '. $currency) ?></b></td>
									</tr>
									 <?php if($paid_amount > 0){?>
									<tr>
										<td class="text-right" colspan="8"><b><?php echo display('paid_amount') ?>:</b></td>
										<td  class="text-right"><b><?php echo (($position==0)?$currency.' '.$paid_amount:$paid_amount.' '.$currency) ?></b></td>
									</tr>
								<?php }?>
                              <?php if($due_amount > 0){?>
									<tr>
										<td class="text-right" colspan="8"><b><?php echo display('due_amount') ?>:</b></td>
										<td  class="text-right"><b><?php echo (($position==0)?$currency.' '.$due_amount:$due_amount.' '. $currency) ?></b></td>
									</tr>
								<?php }?>
								<tr style="display: none;"> 
        						<td colspan="9" style="text-align:center ;"><img src="<?php
									echo base_url().'assets/img/icons/notes.jpg';
                                    ?>" alt="" width="740" align="center" /></td>
								</tr> 
								</tfoot>
		                    </table>

					</div>
           					
                          <br>


		                <div class="table-responsive paddin5ps">
		                    		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	