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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Order App </div>
      <div class="list-group list-group-flush">
        <a href="£" class="list-group-item list-group-item-action active">ADD NEW ORDER</a>
        <a href="view_orders.php" class="list-group-item list-group-item-action bg-light">VIEW ORDERS</a>
        
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

      <div class="container-fluid">
       
        <div class="card">
          <div class="card-header">
            Add New Order
          </div>
          <div class="card-body">
            
           

       <div style="margin: auto;width: 60%;">
          
          <form id="fupForm" name="form1" method="POST" action="process.php">
            <div class="form-group">
              <label for="username">User:</label>
              <select name="user" class="form-control" id="username" > 
                        <option value=""> SELECT USER </option> 
                        <?php
                            $conn=$db_handle->connectDB();
                            $users=mysqli_query($conn,"Select user_name from tbl_users");
                            while($r=mysqli_fetch_row($users))
                            { 
                                  echo "<option value='$r[0]'> $r[0] </option>";
                            }
                        ?>
              </select>
            </div>
            <div class="form-group">
              <label for="pwd">Product:</label>
              <select name="product" class="form-control" id="product" >
                <option value="">SELECT PRODUCT</option>
                <?php

                      $product=mysqli_query($conn,"Select DISTINCT product_name from tbl_product");
                      while($r=mysqli_fetch_row($product))
                      { 
                                echo "<option value='$r[0]'> $r[0] </option>";
                      }
                      
                      
                      
                  ?>
                
              </select>
            </div>
            <div class="form-group">
              <label for="pwd">Quantity:</label>
              <input type="text" class="form-control" id="quantity" placeholder="Quantity" name="quantity" >
            </div>
  
            <input type="submit" name="save" class="btn btn-primary" value="Add" id="submit" >
          </form>
      </div>
            
          </div>
        </div>

    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
  <!-- script for post data using ajax-->
  <script type="text/javascript">
  $(document).ready(function() {


      $('#submit').click(function(e){
        e.preventDefault();


        var user_name = $("#username").val();
        var product= $("#product").val();
        var quantity = $("#quantity").val();

        if (user_name!="" && product!="" && quantity!="")
         {

        $.ajax({
            type: "POST",
            url: "process.php",
            dataType: "json",
            data: {user_name:user_name, product:product, quantity:quantity},
            success : function(data){
                if (data.code == "200"){
                    alert("Success: " +data.msg);
                    location.href = "view_orders.php";
                } else {
                    $(".display-error").html("<ul>"+data.msg+"</ul>");
                    $(".display-error").css("display","block");
                }
            }
        });
        }
        else
        {
          alert("All input feilds must contain values")
        }


      });
  });
</script>


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

  

</body>

</html>
