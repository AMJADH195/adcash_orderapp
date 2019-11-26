<?php
      require_once("dbcontroller.php");
      $db_handle = new DBController();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Order App</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
<script type="text/javascript">
  function filterRecords(value)
{
    var filter=value;
    $.post("ajax/searchRecords.php", {                            
            filter: filter                                                  
        },
        function (data, status) {
            $(".records_content").html(data);  
        }
    );
}


</script>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Order App</div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action  ">ADD NEW ORDER</a>
        <a href="#" class="list-group-item list-group-item-action active">VIEW ORDERS</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

      
      </nav>

      <!-- Content Section -->
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <h3>Orders:</h3>

            <!-- search div -->
            <div class="card"> 
              <div class="card-header">
                <select name="filter" class="form-control" id="filteraction" onmousedown="this.value='';" onchange="filterRecords(this.value);"> 
                  <option>ALL TIME</option>
                  <option>LAST 7 DAYS</option>
                  <option>TODAY</option>
                </select>
                <input type="text" name="search" id="search_text" class="form-control" placeholder="search with product name or user name">
              </div>

            </div>

            <div class="records_content"></div>


    </div>
</div>
<!-- /Content Section -->

<!-- Bootstrap Modals -->

<!--  -->
<!-- // Modal -->

    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom JS file -->
<script type="text/javascript" src="js/script.js"></script>


<!-- <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-75591362-1', 'auto');
    ga('send', 'pageview');

</script> -->

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
