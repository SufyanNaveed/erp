
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
          
            <div class="panel-body">
 
                <div class="">
                    <table class=" table table-striped table-hover" id="voucher_list_details">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('voucher_no') ?></th>
                                 <th><?php echo display('date') ?></th>
                                <th><?php echo display('remark') ?></th>
                                <th><?php echo display('debit') ?></th>
                                <th><?php echo display('credit') ?></th>
                                <th><?php echo display('action') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($aprrove)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($aprrove as $approve) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo html_escape($approve->VNo); ?></td>
                                <td><?php echo html_escape($approve->VDate); ?></td>
                                <td><?php echo html_escape($approve->Narration); ?></td>
                                <td><?php
                                 echo ($approve->Vtype=='CV'?0:$approve->Debit); ?></td>
                                <td><?php echo ($approve->Vtype=='DV'?0:$approve->Credit); ?></td>
                                <td>

                                <a href="<?php echo base_url("account/account/isactive/$approve->VNo/active") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="right" title="Inactive"><?php echo display('approved')?></a>
                                <?php if($this->permission1->method('aprove_v','update')->access()){ ?>
                                <a href="<?php echo base_url("edit_voucher/$approve->VNo") ?>" class="btn edit_btn" title="Update"><i class="fal fa-pencil"></i></a>
                            <?php }?>
                            <?php if($this->permission1->method('aprove_v','delete')->access()){ ?>
                                <a href="<?php echo base_url("account/account/voucher_delete/$approve->VNo") ?>" class="btn delete_btn" onclick="return confirm('Are You Sure?')" title="delete"><i class="fal fa-trash-alt"></i></a>
                            <?php }?>
                                
                                </td>
                            </tr>
                            <?php } ?> 
                        </tbody>
                    </table>
                 
                </div>
            </div> 
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#voucher_list_details').DataTable( {

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