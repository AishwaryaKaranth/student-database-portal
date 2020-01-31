<!DOCTYPE html>
<html>
<head>
   
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
    
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
   <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        div{
            font:15px Verdana;
            width:450px;
        }
        ul {
            padding:0;
            margin:2px 5px; 
            list-style:none; 
            border:0; 
            float:left; 
            width:100%;
        }
        li {
            width:50%; 
            float:left; 
            display:inline-block; 
        }
        table, input {
            text-align:left;
            font:13px Verdana;
        }
        table, td, th 
        {
            margin:10px 0;
            padding:2px 10px;
        }
        td, th {
            border:solid 1px #CCC;
        }
        button {
            font:13px Verdana;
            padding:3px 5px;
        }
        table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
bottom: .5em;
}
    </style>
</head>
<body>
    <div ng-app="myApp" ng-controller="myController">
        <form method="post">
            <input type="submit" name="generate_pdf" class="btn btn success" value="Generate pdf">
        </form>
        
           Sort by: <select><option value="alphabetic_order" onclick="sortByAlphabeticOrder()">Alphabetic order</option>
            <option value="college" onclick="sortByCollege()">College</option>
            <option value="course" onclick="sortByCourse()">Course</option>
            <option value="instructor" onclick="sortByInstructor()">Instructor</option>
            <option value="year_of_graduation" onclick="sortByYear()">Year</option>

           </select>
       
        <ul>
            <li> Name</li>
           <li> <input type="text" ng-model="name" /></li>
        </ul>
        <ul>
            <li>college</li>
           <li> <input type="text" ng-model="college" /></li>
        </ul>
        <ul>
            <li>course</li>
           <li> <input type="text" ng-model="course" /></li>
        </ul>
        <ul>
            <li>year of graduation</li>
           <li> <input type="number" ng-model="year_of_graduation" /></li>
        </ul>
        <ul>
            <li>instructor</li>
           <li> <input type="text" ng-model="instructor" /></li>
        </ul>
        <ul>
            <li>fee paid</li>
           <li> <input type="number" ng-model="fee_paid" /></li>
        </ul>
        <ul>
            <li> </li>
            <input type="submit" ng-click="submit()">Submit Data/>

            <li><button ng-click="addRow()"> Add Row </button></li>
        </ul>

        <!--CREATE A TABLE-->
        <div id="content">
        <table   id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> 
          
               
        
        <div>      
                <button ng-click="removeRow()">Remove Row</button>
        </div>-->
       
    </table>
    <form action ="submit.php" method="post">  
                          <input type="submit" name="create_pdf" class="btn btn-danger" value="Create PDF" />  
                     </form>
</div>
    <div id="editor"></div>
    <a href="#" id="cmd">generate pdf</a>
        <div id="display" style="padding:10px 0;">{{display}}</div>
    </div>
    
</body>
</html>
<!--The Controller-->
<script>
   
    var app = angular.module('myApp', []);
    app.controller('myController', function ($scope,$http) {

        // JSON ARRAY TO POPULATE TABLE.
        $scope.movieArray =
        [     ];
       $scope.submit = function () {
         $http.post(
                        "submit.php",
                        {'name':$scope.name,'college':$scope.college,'course':$scope.course,'year_of_graduation':$scope.year_of_graduation,'instructor':$scope.instructor,'fee_paid':$scope.fee_paid}
                        ).success(function(d){
                            alert(d);
                        });
                    }

        // GET VALUES FROM INPUT BOXES AND ADD A NEW ROW TO THE TABLE.
        $scope.addRow = function () {
            if ($scope.name != undefined && $scope.college != undefined) {
                var movie = [];
                movie.name = $scope.name;
                movie.college = $scope.college;
                movie.course=$scope.course;
                movie.year_of_graduation=$scope.year_of_graduation;
                movie.instructor=$scope.instructor;
                movie.fee_paid=$scope.fee_paid;
                $scope.movieArray.push(movie);

                // CLEAR TEXTBOX.
                $scope.name = null;
                $scope.college = null;
                $scope.course=null;
                $scope.year_of_graduation=null;
                $scope.instructor=null;
                $scope.fee_paid=null;
            }
        };

        // REMOVE SELECTED ROW(s) FROM TABLE.
        $scope.removeRow = function () {
            var arrMovie = [];
            angular.forEach($scope.movieArray, function (value) {
                if (!value.Remove) {
                    arrMovie.push(value);
                }
            });
            $scope.movieArray = arrMovie;
            //$scope.display=arrMovie;
        };

        // FINALLY SUBMIT THE DATA.
        $scope.submit = function () {
        
                /*var data="test934";
                $.post("php/submit.php",/*{'arrMovie[]':arrMovie}*//*data,
                    function(){
                        alert('successful');
                    });,"json"*/
                    /*var data={
                        str:"test934";
                    };
                    $.post("php/submit.php",{string: 'str'});*/
                    $http.post(
                        "submit.php",
                        {'name':$scope.name,'college':$scope.college,'course':$scope.course,'year_of_graduation':$scope.year_of_graduation,'instructor':$scope.instructor,'fee_paid':$scope.fee_paid}
                        ).success(function(d){
                            alert(d);
                        });
           // });
           // $scope.display = arrMovie;
            //$.post("submit.php",{'arrMovie[]':arrMovie});
            
        }
    });
 
    $(document).ready(function () {
$('#selectedColumn').DataTable({
  "aaSorting": [],
  columnDefs: [{
  orderable: false,
  targets: 3
  }]
});
  $('.dataTables_length').addClass('bs-select');
});
</script>

<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="studentdb";
    $connect=mysqli_connect($servername,$username,$password,$dbname);
    if(!$connect){
        die("connection failed: ".mysqli_connect_error());

    }
    else{
        echo "connected";
    }
    if(isset($_GET['order'])){
        $order=$_GET['order'];
    }
    else{
        $order='name';
    }
    if(isset($_GET['sort'])){
        $sort=$_GET['sort'];
    }
    else{
        $sort='ASC';
    }
    $resultSet=$connect->query("SELECT * FROM data ORDER BY $order $sort");
   if($resultSet->num_rows>0){
        $sort=='DESC' ? $sort='ASC':$sort='DESC';

    echo "
    <table border='1'>
    <tr>
    <th><a href='?order=name && sort=$sort'>Name</a></th>
    <th><a href='?order=college && sort=$sort'>College</a></th>
    <th><a href='?order=course && sort=$sort'>Course</a></th>
    <th><a href='?order=year_of_graduation && sort=$sort'>Year of Graduation</a></th>
    <th><a href='?order=instructor && sort=$sort'>Instructor</a></th>
    <th><a href='?order=fee_paid && sort=$sort'>Fee paid</a></th>
";
while($rows=$resultSet->fetch_assoc()){
    $name=$rows['name'];
    $college=$rows['college'];
    $course=$rows['Course'];
    $year_of_graduation=$rows['year_of_graduation'];
    $instructor=$rows['instructor'];
    $fee_paid=$rows['fee_paid'];
    

   
   echo "
   <tr>
   <td>$name</td>
   <td>$college</td>
   <td>$course</td>
   <td>$year_of_graduation</td>
   <td>$instructor</td>
   <td>$fee_paid</td>
   </tr>
   ";


}
echo" </table>";
}
else{
    echo "No records returned";
}


?>
    <script>
         $(document).ready(function(){
        var doc=new jsPDF();
        var specialElementHandlers={
            '#editor':function(element,renderer){
                return true;
            }
        };
        $('#cmd').click(function(){
            doc.fromHTML($('content').get(0),15,15,{'width':170,'elementHandlers':specialElementHandlers
        });
            setTimeout(function(){
    doc.save('test');
    },2000);
    });
    });
    </script>