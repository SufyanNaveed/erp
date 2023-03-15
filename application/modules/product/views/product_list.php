<!-- Manage Product report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo display('manage_product') ?></span>
                           <span class="padding-lefttitle">
                                   
         <?php if($this->permission1->method('create_product','create')->access()){ ?>
                    <a href="<?php echo base_url('product_form') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_product') ?> </a>
                                 <?php }?>
         <?php if($this->permission1->method('add_product_csv','create')->access()){ ?>
                    <a href="<?php echo base_url('bulk_products') ?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-plus"> </i>  <?php echo display('add_product_csv') ?> </a>
                    <?php }?>
                           </span>

                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped " cellspacing="0" width="100%" id="productList"> 
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('product_name') ?></th>
                                        <th><?php echo 'Product Code' ?></th>
                                        <th><?php echo display('supplier_name') ?></th>
                                        <th><?php echo display('price') ?></th>
                                        <th><?php echo display('supplier_price') ?></th>
                                        <th><?php echo display('image') ?>s</th>
                                        <th><?php echo display('action') ?> 
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                            </table>
                          
                        </div>
                    </div>
                </div>
                <input type="hidden" id="total_product" value="<?php echo $total_product;?>" name="">
            </div>
        </div>
        <script>
            $(document).ready(function() { 
      "use strict";
   var csrf_test_name = $('#CSRF_TOKEN').val();
   var base_url = $('#base_url').val();
    var total_product = $("#total_product").val();
     $('#productList').DataTable({ 
             responsive: true,

             "aaSorting": [[ 1, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,2,3,4,5,6,7] },

            ],
           'processing': true,
           'serverSide': true,

          
           dom: 'Bfrtip',
        destroy: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Products here"
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
        ],
            
            'serverMethod': 'post',
            'ajax': {
               'url': base_url + 'product/product/CheckProductList',
               data:{
                csrf_test_name : csrf_test_name,
               }
            },
          'columns': [
             { data: 'sl' },
             { data: 'product_name' },
             { data: 'product_model'},
             { data: 'supplier_name' },
             { data: 'price' },
             { data: 'purchase_p' },
             { data: 'image'},
             { data: 'button'},
          ],

    });

});
        </script>