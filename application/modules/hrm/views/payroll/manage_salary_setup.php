
<div class="row">
  <!--  table area -->
  <div class="col-sm-12">
    
    <div class="panel panel-default thumbnail"> 

      <div class="panel-body">
        <table width="100%" class=" table table-striped table-hover"  id="manage_salary_setup_list">
          <thead>
            <tr>
              <th><?php echo display('sl') ?></th>
              <th><?php echo display('employee_name') ?></th>
              <th><?php echo display('salary_type') ?></th>
              <th><?php echo display('date') ?></th>
              <th><?php echo display('action') ?></th>

            </tr>
          </thead>
          <tbody>
            <?php if (!empty($emp_sl_setup)) { ?>
              <?php $sl = 1; ?>
              <?php foreach ($emp_sl_setup as $que) { ?>
                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                  <td><?php echo $sl; ?></td>
                  <td><?php echo html_escape($que->first_name).' '.html_escape($que->last_name); ?></td>
                  <td><?php if($que->sal_type==1){
                    echo 'Hourly';
                  }else{
                    echo 'Salary';
                  } ?></td>
                  <td><?php echo html_escape($que->create_date); ?></td>
                  <td class="center"> 
       <?php if($this->permission1->method('manage_salary_setup','update')->access()){ ?>                         
                  <a href="<?php echo base_url("edit_salary_setup/$que->employee_id") ?>" class="btn edit_btn"><i class="fal fa-pencil"></i></a> 
                <?php }?>
       <?php if($this->permission1->method('manage_salary_setup','delete')->access()){ ?>           
                  <a href="<?php echo base_url("hrm/payroll/delete_salsetup/$que->employee_id") ?>" class="btn delete_btn" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fal fa-trash-alt"></i></a>
                   <?php }?>
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
    $('#manage_salary_setup_list').DataTable( {

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
