 <!-- date between search -->
        <div class="row">
             <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body"> 
                        <div class="col-sm-10">
                        <?php echo form_open('', array('class' => 'form-inline', 'method' => 'get')) ?>
                        <?php
                      
                        $today = date('Y-m-d');
                        ?>
                        <div class="form-group">
                            <label class="" for="from_date"><?php echo display('start_date') ?></label>
                            <input type="text" name="from_date" class="form-control datepicker" id="from_date" value="" placeholder="<?php echo display('start_date') ?>" >
                        </div> 

                        <div class="form-group">
                            <label class="" for="to_date"><?php echo display('end_date') ?></label>
                            <input type="text" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo display('end_date') ?>" value="">
                        </div>  

                        <button type="button" id="btn-filter" class="btn btn-primary"><?php echo display('find') ?></button>

                        <?php echo form_close() ?>
                    </div>
                  
          
                </div>
            </div>
            </div>
        </div>
        <div class="row"> 
        </div>
        <!-- Manage Delivery Note report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo display('manage_delivery_note') ?></span>
                            <span class="padding-lefttitle"> 
                <?php if($this->permission1->method('new_delivery_note','create')->access()){ ?>
                    <a href="<?php echo base_url('add_delivery_note') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('new_delivery_note') ?> </a>
                <?php }?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive" >
                            <table class="table dataTable table-striped table-hover " cellspacing="0" width="100%" id="DlvryList"> 
                                <thead>
                                    <tr>
                                    <th><?php echo display('sl') ?></th>
                                    <th><?php echo display('delivery_note_no') ?></th>
                                    <th><?php echo display('sale_by') ?></th>
                                    <th><?php echo display('customer_name') ?></th>
                                    <th><?php echo display('date') ?></th>
                                    <th><?php echo display('total_amount') ?></th>
                                    <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
             
                                </tbody>
                                <tfoot>
                    <th colspan="5" class="text-right"><?php echo display('total') ?>:</th>
                
                  <th></th>  
                  <th></th> 
                                </tfoot>
                            </table>
                            
                        </div>
                       

                    </div>
                </div>
                <input type="hidden" id="total_delivery_note" value="<?php echo $total_delivery_note;?>" name="">
                
            </div>
        </div>
 
<script type="text/javascript">
    $(document).ready(function() {
    $('#asdf').DataTable( {

        dom: 'Bfrtip',
        destroy: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Delivery Notes here"
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