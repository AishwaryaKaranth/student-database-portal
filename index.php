<!DOCTYPE html>
<html>
<head>
   
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
    
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
    </style>
</head>
<body>
    <div ng-app="myApp" ng-controller="myController">
        <form action="sortdata.php" method="POST">
           Sort by: <select><option value="alphabetic_order">Alphabetic order</option>
            <option value="college">College</option>
            <option value="course">Course</option>
           </select>
        </form>
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
           <li> <input type="text" ng-model="grad" /></li>
        </ul>
        <ul>
            <li>instructor</li>
           <li> <input type="text" ng-model="instructor" /></li>
        </ul>
        <ul>
            <li>fee paid</li>
           <li> <input type="text" ng-model="fee" /></li>
        </ul>
        <ul>
            <li> </li>
            <input type="submit" ng-click="submit()">Submit Data/>

            <li><button ng-click="addRow()"> Add Row </button></li>
        </ul>

        <!--CREATE A TABLE-->
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> 
            <tr>
                <th>Code</th>
                    <th> Name</th>
                        <th>college</th>
                        <th>course</th>
                        <th>Year of graduation</th>
                        <th>instructor</th>
                        <th>fee paid</th>
            </tr>

            <tr ng-repeat="movies in movieArray">
                <td><label>{{$index + 1}}</label></td>
                <td><label>{{movies.name}}</label></td>
                <td><label>{{movies.college}}</label></td>
                <td><label>{{movies.course}}</label></td>
                <td><label>{{movies.grad}}</label></td>
                <td><label>{{movies.instructor}}</label></td>
                <td><label>{{movies.fee}}</label></td>
                <td><input type="checkbox" ng-model="movies.Remove"/></td>
            </tr>
        </table>

        <!--<div>
            <input type="submit" ng-click="submit()">Submit Data/>  
                <button ng-click="removeRow()">Remove Row</button>
        </div>-->

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
        [
           // { 'name': '', 'director': '' },
            //{ 'name': 'My Left Foot', 'director': 'Jim Sheridan' },
            //{ 'name': 'Forest Gump', 'director': 'Robert Zemeckis' }
        ];
       $scope.submit = function () {
         $http.post(
                        "submit.php",
                        {'name':$scope.name,'college':$scope.college,'course':$scope.course,'grad':$scope.grad,'instructor':$scope.instructor,'fee':$scope.fee}
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
                movie.grad=$scope.grad;
                movie.instructor=$scope.instructor;
                movie.fee=$scope.fee;
                $scope.movieArray.push(movie);

                // CLEAR TEXTBOX.
                $scope.name = null;
                $scope.college = null;
                $scope.course=null;
                $scope.grad=null;
                $scope.instructor=null;
                $scope.fee=null;
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
          /*  var arrMovie = [];
            angular.forEach($scope.movieArray, function (value) {
                arrMovie.push('Name:' + value.name + ', College:' + value.college);ADD 3 lines later*/
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
                        {'name':$scope.name,'college':$scope.college,'course':$scope.course,'grad':$scope.grad,'instructor':$scope.instructor,'fee':$scope.fee}
                        ).success(function(d){
                            alert(d);
                        });
           // });
           // $scope.display = arrMovie;
            //$.post("submit.php",{'arrMovie[]':arrMovie});
            
        }
    });
</script>




