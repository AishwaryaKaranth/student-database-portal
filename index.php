<!DOCTYPE html>
<html>
<head>
   
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
    
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
   <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        div{
            font:15px Verdana;
            
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
            text-align:center;
            font:13px Verdana;
        }
        table, td, th 
        {
            margin:10px 0;
            padding:2px 60px;
        }
        td, th {
            border:solid 3px #CCC;
            border-color: ;
        }
        button {
            font:13px Verdana;
            padding:3px 5px;
        }
        
        #bg{
           /* background:linear-gradient(#11998e,#38ef7d);*/
            width:100%;
           height:50%;
            
        }
        #sign{
            width:50%;
            position:relative;
            left:30%;
            padding-top:30px;
            background: linear-gradient(#a8ff78, #78ffd6);
       }
       #header{
        text-align: center;
       }
       
        
        h1{
            position: relative;
        }
        span{
            /*background: linear-gradient(#8e9eab, #eef2f3);*/

        }
        

}
    </style>
</head>
<body>
    <div ng-app="myApp" ng-controller="myController">
        <div id="header">
            <h1>TEQUED LABS</h1>
        </div>
        <h3>Student Information Portal</h3>
        
        <div id="sign">
        <div class="input-group input-group-sm mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
        </div>
        <input type="text" ng-model="name" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
        </div>
        

        <div class="input-group input-group-sm mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">College</span>
        </div>
        <input type="text" ng-model="college" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
        </div>

        <div class="input-group input-group-sm mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">Course</span>
        </div>
        <input type="text" ng-model="course" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
        </div>
        
        <div class="input-group input-group-sm mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">Year of graduation</span>
        </div>
        <input type="text" ng-model="year_of_graduation" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
        </div>
            
       <div class="input-group input-group-sm mb-3">
       <div class="input-group-prepend">
       <span class="input-group-text" id="inputGroup-sizing-sm">Instructor</span>
       </div>
       <input type="text" ng-model="instructor" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
       </div>

        <div class="input-group input-group-sm mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">Fee Paid</span>
        </div>
        <input type="text" ng-model="fee_paid" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
        </div>
        </div>
     <!--       <li>college</li>
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
        <ul>-->
            
            <input type="submit" ng-click="submit()">

          <!--  <li><button ng-click="addRow()"> Add Row </button></li>-->
        </ul>

        <!--CREATE A TABLE-->
        
        <table   id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> 
          
               
        
       
       
    </table>
    

    <button type="button" id="pdfDownloader" class="btn btn-primary">Download</button>
</body>
</html>
<!--The Controller-->
<script>
   
    var app = angular.module('myApp', []);
    app.controller('myController', function ($scope,$http) {

        // JSON ARRAY TO POPULATE TABLE.
        $scope.mArray =
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
                var m = [];
                m.name = $scope.name;
                m.college = $scope.college;
                m.course=$scope.course;
                m.year_of_graduation=$scope.year_of_graduation;
                m.instructor=$scope.instructor;
                m.fee_paid=$scope.fee_paid;
                $scope.mArray.push(m);

                // CLEAR TEXTBOX.
                $scope.name = null;
                $scope.college = null;
                $scope.course=null;
                $scope.year_of_graduation=null;
                $scope.instructor=null;
                $scope.fee_paid=null;
            }
        };

        .
        $scope.removeRow = function () {
            var arrM = [];
            angular.forEach($scope.mArray, function (value) {
                if (!value.Remove) {
                    arrM.push(value);
                }
            });
            $scope.mArray = arrM;
            //$scope.display=arrM;
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
           
        }
    });
    $(document).ready(function(){
 
    $("#pdfDownloader").click(function(){
    
        html2canvas(document.getElementById("content"), {
            onrendered: function(canvas) {

                var imgData = canvas.toDataURL('image/png');
                console.log('Report Image URL: '+imgData);
                var doc = new jsPDF('p', 'mm', [297, 210]); //210mm wide and 297mm high
                
                doc.addImage(imgData, 'PNG', 10, 10);
                doc.save('sample.pdf');
            }
        });

    });
    
    
})

 
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
    <table id='content' border='1'>
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
    <!--<script>
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
    </script>-->
