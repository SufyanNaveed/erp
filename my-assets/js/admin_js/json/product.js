  var count = 2;
    var limits = 500;
   
    "use strict";
    //Add purchase input field
    function addpruduct(e) {
         var supplier = $("#supplier_list").val();
        var t = '<td><select name="supplier_id[]" class="form-control" required=""><option value=""> select Supplier</option>'+supplier+'</select> </td><td class=""><input type="text"  class="form-control text-right" name="supplier_price[]" placeholder="0.00"  required  min="0"/></td><td> <a  id="add_purchase_item" class="btn edit_btn " name="add-invoice-item" onClick="addpruduct('+"proudt_item"+')"><i class="fal fa-plus" aria-hidden="true"></i></a> <a class="btn delete_btn"  value="" onclick="deleteRow(this)" ><i class="fal fa-trash-alt" aria-hidden="true"></i></a></td>';
        count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#proudt_item").append("<tr>" + t + "</tr>")
        $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });
    }
        "use strict";
      function deleteRow(e) {
        var t = $("#product_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
       
    }

          window.onload = function () {
        var text_input = document.getElementById('product_id');
        text_input.focus();
        text_input.select();
    }