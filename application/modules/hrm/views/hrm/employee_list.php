
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="employees_list_details" class="table  table-striped table-hover ">
                                <thead>
                                    <tr>
                        <th class="text-center"><?php echo display('sl') ?></th>
                        <th class="text-center"><?php echo display('name') ?></th>
                        <th class="text-center"><?php echo display('designation') ?></th>
                        <th class="text-center"><?php echo display('phone') ?></th>
                        <th class="text-center"><?php echo display('email') ?></th>
                        <th class="text-center"><?php echo display('picture') ?></th>
                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($employee_list) {
                                        ?>
                                       
                                        <?php
                                        $sl = 1;
                                         foreach($employee_list as $employees){?>
                                        <tr>
                                <td class="text-center"><?php echo $sl;?></td>
                                <td class="text-center"><?php echo html_escape($employees['first_name']).' '.html_escape($employees['last_name']);?></td>
                                <td class="text-center"><?php echo html_escape($employees['designation']);?></td>
                                <td class="text-center"><?php echo html_escape($employees['phone']);?></td>
                                <td class="text-center"><?php echo html_escape($employees['email']);?></td>
                                 <td class="text-center"><img src="<?php echo (!empty($employees['image'])?base_url().$employees['image']:base_url('assets/img/icons/default.jpg')) ; ?>" height="60px" width="80px"></td>
                                            <td>
                                    <center>
                                        <?php echo form_open() ?>
        <?php if($this->permission1->method('manage_employee','update')->access()){ ?>                          
                                        <a href="<?php echo base_url() . 'employee_form/'.$employees['id']; ?>" class="btn edit_btn" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fal fa-pencil" aria-hidden="true"></i></a>
                                    <?php }?>
    <?php if($this->permission1->method('manage_employee','delete')->access()){ ?>                                
                                        <a href="<?php echo base_url('hrm/hrm/bdtask_delete_employee/'.$employees['id']) ?>" class="btn delete_btn" onclick="return confirm('<?php echo display('are_you_sure') ?>')" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fal fa-trash-alt" aria-hidden="true"></i></a>
                                         <?php }?>
                                   <a href="<?php echo base_url('employee_profile/'.$employees['id']);?>" class="btn details_btn"><i class="fal fa-user"></i></a>
                                            <?php echo form_close() ?>
                                    </center>
                                    </td>
                                    </tr>
                                   
                                    <?php
                                    $sl++;
                                }}
                                ?>
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<script>
$(document).ready(function() {
    $('#employees_list_details').DataTable( {

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

