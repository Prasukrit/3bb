<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Document</title>
   <?php include_once('Classes/connection_pdo.php');

$db = new DB();

$sql = "SELECT * FROM project";
$query = $db->query($sql);
$query = $db->execute();
$query = $db->fetch();
 ?>
 <link rel="stylesheet" href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
 <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
 <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

   <style>
      table.dataTable.select tbody tr,
      table.dataTable thead th:first-child {
        cursor: pointer;
      }
   </style>
</head>
<body>
   <h3><a href="http://www.gyrocode.com/articles/jquery-datatables-checkboxes/">jQuery DataTables – Row selection using checkboxes</a></h3>
<a href="http://www.gyrocode.com/articles/jquery-datatables-checkboxes/">See full article on Gyrocode.com</a>
<hr><br>
   <form id="frm-example" action="/path/to/your/script" method="POST">
    
<table id="example" class="display select" cellspacing="0" width="100%">
   <thead>
      <tr>
         <th><input name="select_all" value="1" type="checkbox"></th>
         <th>01</th>
         <th>02</th>
         <th>03</th>
         <th>04</th>
         <th>05</th>
         <th>06</th>
         <th>07</th>
         <th>08</th>
      </tr>
   </thead>
   <tbody>
      <?php
                    foreach ($query as $key=>   
      $result) {
                      
                    
                      $id = $result["id"];
                      $location_code = $result["location_code"];
                      $project_name = $result["project_name"];
                      $province = $result["province"];
                      $district =$result["district"];
                      $address = $result["address"];
                      $builder = $result["builder"];
                      $sub_district =  $result["sub_district"];
                      $location_lat_long = $result["location_lat_long"];
                      $location_name = $result["location_name"];
                      $node_nearby = $result["node_nearby"];
                      $remark =  $result["remark"];
                      $type = $result["type"];
                      $status = $result["status"] ;
                    
                      ?>
      <tr>
         <td></td>
         <td>
            <?php echo $location_code;?></td>
         <td>
            <?php echo $location_lat_long; ?></td>
         <td>
            <?php echo $project_name; ?></td>
         <td>
            <?php echo $province; ?></td>
         <td>
            <?php echo $district; ?></td>
         <td>
            <?php echo $sub_district; ?></td>
         <td>
            <?php echo $address; ?></td>
         <td>
            <?php echo $type;?></td>
      </tr>

      <?php } ?></tbody>
   <tfoot>
      <tr>
         <th></th>
         <th>01</th>
         <th>02</th>
         <th>03</th>
         <th>04</th>
         <th>05</th>
         <th>06</th>
         <th>07</th>
         <th>08</th>
      </tr>
   </tfoot>
</table>
<hr>

<p>Press <b>Submit</b> and check console for URL-encoded form data that would be submitted.</p>

<p><button>Submit</button></p>

<b>Data submitted to the server:</b><br>
<pre id="example-console">
</pre>
</form>
</body>
</html>



    


<script>
 //
// Updates "Select all" control in a data table
//
function updateDataTableSelectAllCtrl(table){
   var $table             = table.table().node();
   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

   // If none of the checkboxes are checked
   if($chkbox_checked.length === 0){
      chkbox_select_all.checked = false;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If all of the checkboxes are checked
   } else if ($chkbox_checked.length === $chkbox_all.length){
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If some of the checkboxes are checked
   } else {
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = true;
      }
   }
}

$(document).ready(function (){
   // Array holding selected row IDs
   var rows_selected = [];
   var table = $('#example').DataTable({
      //'ajax': 'https://api.myjson.com/bins/1us28',
      'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
         'width':'1%',
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox">';
         }
      }],
      'order': [1, 'asc'],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         }
      }
   });

   // Handle click on checkbox
   $('#example tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = table.row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs 
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#example').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
      if(this.checked){
         $('#example tbody input[type="checkbox"]:not(:checked)').trigger('click');
      } else {
         $('#example tbody input[type="checkbox"]:checked').trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   table.on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);
   });
    
   // Handle form submission event 
   $('#frm-example').on('submit', function(e){
      var form = this;

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
      });

      // FOR DEMONSTRATION ONLY     
      
      // Output form data to a console     
      $('#example-console').text($(form).serialize());
      console.log("Form submission", $(form).serialize());
       
      // Remove added elements
      $('input[name="id\[\]"]', form).remove();
       
      // Prevent actual form submission
      e.preventDefault();
   });
});
</script>
