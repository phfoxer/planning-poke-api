<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Planning poker</title>
  <!-- Fonts -->
  <link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="/css/app.css" rel="stylesheet" type="text/css">
</head>

<body ng-app="myApp" ng-controller="myCtrl">
  <div class="content-data row">
    <div class="col-sm-3">
      <a class="btn btn-block btn-sm btn-default">Planning Poker</a>
    </div>
    <div class="col-sm-3">
      <a class="btn btn-sm text-light">Código: <span id="code"></span></a>
    </div>
    <div class="col-sm-6">
      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
        <button class="btn btn-info btn-sm" id="showFront">VIRAR CARTAS</button>
        <button class="btn btn-info btn-sm" id="clear">LIMPAR</button>
        <button class="btn btn-info btn-sm" id="reset">NOVO CÓDIGO</button>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="cards-container row">
      <div ng-repeat="card in cards" id="card{{$index}}" value="{{card.value}}" index="{{$index}}" ng-class="{'card-container-open':(card.open),'disabled': !(card.value), 'enabled': (card.value)}" class="card-container col-xs">
        <div class="card">
          <div class="front">
            <div class="username">{{card.name}}</div>
          </div>
          <div class="back">
            <div class="username">{{card.name}}</div>
            <div class="data">{{card.value}}</div>
          </div>
        </div>
      </div>


    </div>
  </div>
  <div class="row nocontent">
    <div class="col-md-2" ng-repeat="x in cards">
      <div class="card-draw back" sent="0" index="{{x}}" id="card{{x}}"></div>
      <div class="card-draw hidecard" index="{{x}}" id="card{{x}}data">
        <div class="name"></div>
        <div class="value"></div>
      </div>
    </div>

  </div>

  </div>
  <script src="/js/jquery.js" crossorigin="anonymous"></script>
  <script src="/js/angularjs.js"></script>
  <script src="https://www.gstatic.com/firebasejs/3.6.6/firebase.js"></script>
  <script src="https://cdn.firebase.com/libs/angularfire/2.3.0/angularfire.min.js"></script>
  <script src="/js/script.js?v=<?php echo time(); ?>"></script>

</body>

</html>