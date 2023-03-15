<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
 
                <div class="">
                    <table id="currency_list_details" class=" table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('currency_name') ?></th>
                                <th><?php echo display('currency_icon') ?></th>
                                <th><?php echo display('action') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                             if($currency_list){ ?>
                            <?php $sl = 1; ?>
                            <?php foreach($currency_list as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                               
                                <td><?php echo $value->currency_name; ?></td>
                                <td><?php echo $value->icon; ?></td>
                               
                                <td>
                                    <a href="<?php echo base_url("currency_form/$value->id") ?>" class="btn edit_btn" data-toggle="tooltip" data-placement="left" title="Update"><i class="fal fa-pencil" aria-hidden="true"></i></a>

                                    <a href="<?php echo base_url("dashboard/setting/bdtask_deletecurrency/$value->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn delete_btn" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fal fa-trash-alt" aria-hidden="true"></i></a>
                                   
                                </td>
                            </tr>
                            <?php }} ?> 
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>

 <script>
$(document).ready(function() {
    $('#currency_list_details').DataTable( {

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