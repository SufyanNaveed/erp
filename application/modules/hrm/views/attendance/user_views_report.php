
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                          <h4><?php echo display('datewise_report')?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
  
                <table width="100%" id="attendance_report_details" class=" table table-striped table-hover">
                    <caption><center><?php echo display('from').' -'.$from_date.'=>'.display('to').' -'.$to_date?></center></caption>
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('employee_name') ?></th>
                            <th><?php echo display('date') ?></th>
                             <th><?php echo display('sign_in') ?></th>
                            <th><?php echo display('sign_out') ?></th>
                             <th><?php echo display('stay') ?></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($query)) 

                        { ?>

                            <?php $sl = 1; ?>
                            <?php foreach ($query as $que) { 
                         ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo html_escape($que->first_name).' '.html_escape($que->last_name); ?></td>
                                    <td><?php echo html_escape($que->date); ?></td>
                                    <td><?php echo html_escape($que->sign_in); ?></td>
                                    <td><?php echo html_escape($que->sign_out); ?></td>
                                    <td><?php echo html_escape($que->staytime); ?></td>
                                    
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
 
        </div>
  
<script>
$(document).ready(function() {
    $('#attendance_report_details').DataTable( {

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