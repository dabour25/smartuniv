<!DOCTYPE html>
<html>
	<head>
		<title>First Front End API</title>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container-fluid" ng-app="myApp" ng-controller="myCtrl">
			<h3 style="text-align:center;">This Page Created By HTML-CSS-Bootstrap-JQuary-Angular</h3>
			<div class="row">
				<div class="col-md-6">
					<h4>Get All Users Data</h4>
					<label>Select Role</label>
					<select type="text" ng-model="role" name="role" class="form-control">
						<option value="">All</option>
						<option value="admin">Admin</option>
						<option value="doctor">Doctor</option>
						<option value="assistant">Assistant</option>
						<option value="student">Student</option>
					</select>
					<table class="table table-dark">
						<thead>
						  <tr>
							<th>Email</th>
							<th>Name</th>
							<th>Role</th>
						  </tr>
						</thead>
						<tbody>
						  <tr ng-repeat="x in users.users | filter:role">
							<td>{{ x.email }}</td>
							<td>{{ x.f_name}} {{ x.m_name}}</td>
							<td>{{ x.role }}</td>
						  </tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<script>
		var app = angular.module('myApp', []);
		app.controller('myCtrl', function($scope, $http) {
			$http({
				method : "GET",
				  url : "/getusersapi"
			  }).then(function mySuccess(response) {
				$scope.users=response.data;
			  }, function myError(response) {
				console.log(response.statusText);
			  });
		});
		</script>

	</body>
</html>