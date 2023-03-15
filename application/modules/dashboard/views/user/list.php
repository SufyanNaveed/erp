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
                    <table class=" table-striped table table-hover" id="user_list_details">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('image') ?></th>
                                <th><?php echo display('username') ?></th>
                                <th><?php echo display('email') ?></th>
                                <th><?php echo display('status') ?></th>
                                <th><?php echo display('action') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($user)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($user as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><img src="<?php echo (!empty($value->logo)?base_url().$value->logo:base_url('assets/img/icons/default.jpg')) ; ?>" alt="Image" height="50" ></td>
                                <td><?php echo $value->fullname; ?></td>
                                <td><?php echo $value->email; ?></td>
                                <td><?php echo (($value->status==1)?display('active'):display('inactive')); ?></td>
                                <td>
                                    <?php if ($this->session->userdata('isAdmin') == 1) { ?>
                                    <a href="<?php echo base_url("add_user/$value->user_id") ?>" class="btn edit_btn" data-toggle="tooltip" data-placement="left" title="Update"><i class="fal fa-pencil" aria-hidden="true"></i></a>
                                    <a href="<?php echo base_url("dashboard/user/bdtask_deleteuser/$value->user_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn delete_btn" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fal fa-trash-alt" aria-hidden="true"></i></a>
                                    <?php } else if($this->session->userdata('id') == $value->user_id){ ?> 
                                     <a href="<?php echo base_url("add_user/$value->user_id") ?>" class="btn edit_btn" data-toggle="tooltip" data-placement="left" title="Update"><i class="fal fa-pencil" aria-hidden="true"></i></a>
                                    <?php } ?>
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
    $('#user_list_details').DataTable( {

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