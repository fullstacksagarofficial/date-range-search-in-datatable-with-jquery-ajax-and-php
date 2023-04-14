<!doctype html>
<html>
    <head>
        <title>Date range search in DataTable with jQuery AJAX and PHP</title>

        <!-- Datatable CSS -->
        <link href='DataTables/datatables.min.css' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" type="text/css" href="jquery-ui.min.css">

        <!-- jQuery Library -->
        <script src="jquery-3.4.1.min.js"></script>

        <script type="text/javascript" src="jquery-ui.min.js"></script>

        <!-- Datatable JS -->
        <script src="DataTables/datatables.min.js"></script>
        
    </head>
    <body >

        <div >
            <!-- Date Filter -->
            <table>
                <tr>
                    <td>
                        <input type='text' readonly id='search_fromdate' class="datepicker" placeholder='From date'>
                    </td>
                    <td>
                        <input type='text' readonly id='search_todate' class="datepicker" placeholder='To date'>
                    </td>
                    <td>
                        <input type='button' id="btn_search" value="Search">
                    </td>
                </tr>
            </table>
            
            <!-- Table -->
            <table id='empTable' class='display dataTable'>
                <thead>
                <tr>
                    <th>Employee name</th>
                    <th>Email</th>
                    <th>Date of Joining</th>
                    <th>Salary</th>
                    <th>City</th>
                </tr>
                </thead>
                
            </table>
        </div>
        
        <!-- Script -->
        <script>
        $(document).ready(function(){

            // Datapicker 
            $( ".datepicker" ).datepicker({
                "dateFormat": "yy-mm-dd",
                changeYear: true
            });

            // DataTable
            var dataTable = $('#empTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'searching': true, // Set false to remove default Search Control
                'ajax': {
                    'url':'ajaxfile.php',
                    'data': function(data){
                        // Read values
                        var from_date = $('#search_fromdate').val();
                        var to_date = $('#search_todate').val();

                        // Append to data
                        data.searchByFromdate = from_date;
                        data.searchByTodate = to_date;
                    }
                },
                'columns': [
                    { data: 'emp_name' },
                    { data: 'email' },
                    { data: 'date_of_joining' },
                    { data: 'salary' },
                    { data: 'city' },
                ]
            });

            // Search button
            $('#btn_search').click(function(){
                dataTable.draw();
            });
           
        });
        </script>
    </body>

</html>
