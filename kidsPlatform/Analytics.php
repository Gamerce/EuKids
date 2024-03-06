<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header("location:php_pages/login.php");
	}elseif ($_SESSION['usertype'] == 'user') {
		header("location:php_pages/login.php");
	}

?>

 <!DOCTYPE html>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<html>
<head>
<style>
body {
  font-family: Verdana;
}
.parent {
  text-align: center;
}
.child {
  display: inline-block;


  vertical-align: middle;


  height: 40vh;
  width: 30vw;"
}
.child2 {
  display: inline-block;


  vertical-align: middle;


  height: 35vh;
  width: 35vw;"
}
.child3 {
  display: inline-block;


  vertical-align: middle;


  height: 25vh;
  width: 25vw;"
}
</style>
<link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="topnav">
    <a class="active" href="Analytics.php">Analytics</a>
    <a href="UserList.php">Users</a>
    <a href="Content.php">Content</a>
    <a href="#about">Settings</a>
    <a href="ApiTutorial.php">API</a>

    <div class="logout" style="float:right;">
		<a class=" color--yellow" href="php_pages/logout.php">Logout</a>
		</div>

  </div>

  <div class="container">
    <div class="cards">

      <div class="card">
        <div class="card-title">
          Unique Players
        </div>
        <div class="card-icon color--yellow"></div>
        <div class="card-amount">32</div></div>

      <div class="card">
        <div class="card-title">
          Avg session length
        </div>
        <div class="card-icon color--purple">

        </div>
        <div class="card-amount">6.2 min</div>
        <div class="card-analytics">
        </div>

      </div>
      <div class="card">
        <div class="card-title">
          Avg sessions per user
        </div>
        <div class="card-icon color--red">
          <!-- <i class="fas fa-heart"></i> -->
        </div>
        <div class="card-amount">2.3</div>
        <div class="card-analytics">
          <!-- <span class="analytics-percentage color--red">
            2.3
          </span> -->
        </div>
      </div>

      <div class="card">
        <div class="card-title">
          Conversion to Subscription
        </div>
        <div class="card-amount">1.54%</div>
        <div class="card-analytics">
          <span class="color--green">
            13 current subscribers
          </span>
        </div>
      </div>




    </div>
  </div>




  <div class="container">
    <div class="cards" style="margin-top:-100px;">

  <div class="card"><div class="card-title" >
      Retnetion D1 D7 D30
    </div><div class="card-icon color--yellow"></div><div class="card-amount" >10% 3% 1%</div></div>

    <div class="card"><div class="card-title">
        Avg time Reading
      </div><div class="card-icon color--yellow"></div><div class="card-amount">6m</div></div>

      <div class="card"><div class="card-title">
          Avg time Watching
        </div><div class="card-icon color--yellow"></div><div class="card-amount">10m</div></div>

        <div class="card"><div class="card-title">
            Avg time Playing
          </div><div class="card-icon color--yellow"></div><div class="card-amount">32m</div></div>
  </div>
</div>

<div class="container">
  <div class="cards" style="margin-top:-200px;">

<div class="card"><div class="card-title" >
    Best Content
  </div><div class="card-icon color--yellow"></div><div class="card-amount" >BEK</div></div>

  <div class="card"><div class="card-title">
      Worst Content
    </div><div class="card-icon color--yellow"></div><div class="card-amount">Rasmus Klump</div></div>

    <div class="card"><div class="card-title">
        Return rate
      </div><div class="card-icon color--yellow"></div><div class="card-amount">0.3%</div></div>

      <div class="card"><div class="card-title">
          Avg subscription time
        </div><div class="card-icon color--yellow"></div><div class="card-amount">3.8 days</div></div>
</div>
</div>

<div class='parent' style="margin-top:-200px;">
  <div class='child2'>  <canvas class='child' id="myChart"></canvas></div>
    <div class='child3' style="margin-top:-150px;">  <canvas class='child' id="myChart5"></canvas></div>
        <div class='child3'style="margin-top:-150px;">  <canvas class='child' id="myChart6"></canvas></div>
</div>
<br><br><br><br><br><br><br>
<div class='parent'>



  <div class='child'style="margin-top:-150px;">  <canvas class='child' id="myChart2"></canvas></div>
  <div class='child'style="margin-top:-150px;">  <canvas class='child' id="myChart3"></canvas></div>
  <div class='child'style="margin-top:-150px;">  <canvas class='child' id="myChart4"></canvas></div>


</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');
  const ctx2 = document.getElementById('myChart2');
    const ctx3 = document.getElementById('myChart3');
        const ctx4 = document.getElementById('myChart4');
        const ctx5 = document.getElementById('myChart5');
        const ctx6 = document.getElementById('myChart6');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['1. Start App', '2. Started Trial', '3. Used content', '4. Subscribed'],
      datasets: [{
        label: 'Funnel Content',
        data: [100, 65, 20, 5, 2, 1, 1, 1]
      }]
    },
    options: {

    }
  });

  new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: ['1. Start App', '2. Watched Movie', '3. Watched Movie Again'],
      datasets: [{
        label: 'Funnel Movies',
        backgroundColor: "rgba(255,99,132,0.2)",
    borderColor: "rgba(255,99,132,1)",
        data: [20, 15, 10, 5, 2, 1, 1, 1],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  new Chart(ctx3, {
    type: 'bar',
    data: {
      labels: ['1. Start App', '2. Played Game', '3. Played Game Again'],
      datasets: [{
        label: 'Funnel Games',
        backgroundColor: "rgba(99,255,132,0.2)",
    borderColor: "rgba(99,255,132,1)",
        data: [20, 15, 10, 5, 2, 1, 1, 1],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  new Chart(ctx4, {
    type: 'bar',
    data: {
      labels: ['1. Start App', '2. Listend Book', '3. Listend Book Again'],
      datasets: [{
        label: 'Funnel Books',
        backgroundColor: "rgba(132,100,99,0.2)",
    borderColor: "rgba(132,100,99,1)",
        data: [20, 15, 10, 5, 2, 1, 1, 1],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  new Chart(ctx5, {
    type: 'doughnut',
    data: {
      labels: ['BEK', 'Rasmus Klump', 'Bille&Trille'],
      datasets: [{


        data: [300, 50, 100],

      }]
    },
    options: {

    }
  });
  new Chart(ctx6, {
    type: 'doughnut',
    data: {
      labels: ['Game: Bek', 'Movie: RS1', 'Book: RS2', 'Book: RS2', 'Book: RS3', 'Book: RS4'],
      datasets: [{


        data: [300, 50, 100,300, 50, 100,300, 50, 100],

      }]
    },
    options: {

    }
  });
</script>

</body>






<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
