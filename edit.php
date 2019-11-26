<?php
      require_once("dbcontroller.php");
      $db_handle = new DBController();
      $conn=$db_handle->connectDB();
      $id=$_GET["order_id"];
      $query="SELECT * FROM tbl_orders WHERE order_id='$id'";
      $result=mysqli_query($conn,$query);
      $row = mysqli_fetch_array($result);
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
        <a href="#" class="list-group-item list-group-item-action bg-light">ADD NEW ORDER</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">VIEW ORDERS</a>
        <a href="#" class="list-group-item list-group-item-action active">EDIT ORDER DETAILS</a>
        
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
            Update Order
          </div>
          <div class="card-body">
            
           

       <div style="margin: auto;width: 60%;">
          <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          </div>
          <form id="fupForm" name="form1" method="POST" action="process.php">
            <div class="form-group">
              <label for="email">User:</label>
              <select name="user" class="form-control" id="username"> 
                        <?php
                            
                            $users=mysqli_query($conn,"Select user_name from tbl_users");
                            while($r=mysqli_fetch_row($users))
                            { 
                                  if($r[0]==$row["user_name"])
                                  {
                                    echo "<option value='$r[0]' selected=selected'> $r[0] </option>";
                                  }
                                  else
                                  {
                                    echo "<option value='$r[0]'> $r[0] </option>";
                                  }
                                  
                            }
                        ?>
              </select>
            </div>
            <div class="form-group">
              <label for="pwd">Product:</label>
              <select name="product" class="form-control" id="product">
                <?php

                      $product=mysqli_query($conn,"Select DISTINCT product_name from tbl_product");
                      while($r=mysqli_fetch_row($product))
                      { 
                                if($r[0]==$row["product_name"])
                                {
                                  echo "<option value='$r[0]' selected=selected'> $r[0] </option>";
                                }
                                else
                                {
                                  echo "<option value='$r[0]'> $r[0] </option>";
                                }
                                
                      }
                      
                      
                      
                  ?>
                
              </select>
            </div>
            <div class="form-group">
              <label for="pwd">Quantity:</label>
              <input type="text" class="form-control" id="quantity" placeholder="Quantity" name="quantity" value="<?php echo $row["quantity"]; ?>">
              <input type="hidden" name="actionResult" id="idfeild" value="<?php echo $id; ?>">

            </div>
  
            <input type="submit" name="save" class="btn btn-primary" value="Update" id="submit">
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
        var id=$("#idfeild").val();


        $.ajax({
            type: "POST",
            url: "update_order.php",
            dataType: "json",
            data: {user_name:user_name, product:product, quantity:quantity,id:id},
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
