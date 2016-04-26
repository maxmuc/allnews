<div ng-app="sampleApp" ng-controller="SampleCtrl">
    Email: <input ng-model="email" type="text">
    Password: <input ng-model="password" type="text">

    <br><br>

    <button ng-click="createUser()">Create User</button>

    <br><br>

    <button ng-click="removeUser()">Remove User</button>

    <p ng-if="message">Message: <strong>{{ message }}</strong></p>
    <p ng-if="error">Error: <strong>{{ error }}</strong></p>
</div>