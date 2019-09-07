// Initialize the Firebase SDK
var config = {
    apiKey: "AIzaSyAQEkC0qf_rkfhx8R5FTetgU9gVfJbtHi8",
    authDomain: "planning-poker-5c900.firebaseapp.com",
    databaseURL: "https://planning-poker-5c900.firebaseio.com",
    projectId: "planning-poker-5c900",
    storageBucket: "planning-poker-5c900.appspot.com"
};
firebase.initializeApp(config);

var app = angular.module('myApp', ["firebase"]);
app.controller('myCtrl', function ($scope, $firebaseObject) {

    var ref = firebase.database().ref();
    var obj = $firebaseObject(ref.child('matchs').child(localStorage.getItem('code')));

    obj.$loaded().then(function () {
      
        obj.$watch(function () {
            var index = 0;
            angular.forEach(obj, function (player) {
                if ($scope.cards[index].open === undefined) {
                    $scope.cards[index] = player;
                }
                if ($scope.cards[index].open === true) {
                    $scope.cards[index].value = player.value;
                }
                index++;
            });
        });
    });

    obj.$loaded().then(function () {
        var index1 = 0;
        angular.forEach(obj, function (player) {
            if ($scope.cards[index1].open === undefined) {
                $scope.cards[index1] = player;
            }
            if ($scope.cards[index1].open === true) {
                $scope.cards[index1].value = player.value;
            }
            index1++;
        });
    });

    function init() {
        var array = new Array(10);
        $scope.cards = [];
        for (let index = 0; index < array.length; index++) {
            $scope.cards.push(index);
        }
    }

    function getCode() {
        var currentCode = parseInt(window.location.search.replace('?', ''));
        if (isNaN(currentCode)) {
            $.get("/api/matchcode", function (code) {
                $('#code').html(code);
                localStorage.setItem('code', code);
            });
        } else {
            $('#code').html(currentCode);
            localStorage.setItem('code', currentCode);
        }
    }
    init();
    getCode();


    $("#showFront").on("click", function () {
        for (let index = 0; index < $scope.cards.length; index++) {
            $scope.cards[index].open = true;
        }
        $scope.$apply();
        // $('.card-container.enabled').addClass('card-container-open');
    });

    $("#clear").on("click", function () {
        ref.child('matchs').child(localStorage.getItem('code')).remove();
        init();
        $scope.$apply();
    });

    $("#reset").on("click", function () {
        ref.child('matchs').child(localStorage.getItem('code')).remove();
        init();
        getCode();
    });

});