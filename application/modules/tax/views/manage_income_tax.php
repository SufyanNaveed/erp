

 <div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                <table width="100%" class=" table table-striped table-hover" id="manage_income_tax_list">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('start_amount') ?></th>
                            <th><?php echo display('end_amount') ?></th>
                             <th><?php echo display('rate') ?></th>
                            
                           <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($taxs)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($taxs as $que) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo html_escape($que->start_amount); ?></td>
                                    <td><?php echo html_escape($que->end_amount); ?></td>
                                    <td><?php echo html_escape($que->rate); ?> %</td>
                                    
                                    <td class="center">
                                
                                        <a href="<?php echo base_url("edit_income_tax/$que->tax_setup_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                       
                                    
                                   
                                        <a href="<?php echo base_url("tax/tax/delete_income_tax/$que->tax_setup_id") ?>" class="btn delete_btn" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fal fa-trash-alt"></i></a> 
                                        
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#manage_income_tax_list').DataTable( {

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
