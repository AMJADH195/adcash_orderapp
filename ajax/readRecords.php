<?php


	require_once("../dbcontroller.php");
    $db_handle = new DBController();	
    $conn=$db_handle->connectDB();								
																	
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>No.</th>
							<th>User</th>
							<th>Product</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total</th>
							<th>Date</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>';

	$query = "SELECT * FROM tbl_orders";									

	if (!$result = mysqli_query($conn, $query)) {					
        exit(mysqli_error($conn));									
    }

    
    if(mysqli_num_rows($result) > 0){								
    	$number = 1;
    	while($row = mysqli_fetch_assoc($result)){					
    		$data .= '<tr>
				<td>'.$number.'</td>
				<td>'.$row['user_name'].'</td>
				<td>'.$row['product_name'].'</td>
				<td>'.$row['product_price'].'</td>
				<td>'.$row['quantity'].'</td>
				<td>'.$row['total_price'].'</td>
				<td>'.$row['date_of_order'].'</td>
				<td>
					<a href="http://52.206.66.194/adcash_orderapp/edit.php?order_id='.$row['order_id'].'"><button class="btn btn-warning">Update</button></a>
				</td>
				<td>
					<button onclick="DeleteOrder('.$row['order_id'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
    		$number++;
    	}
    }else{															
    	$data .= '<tr><td colspan="6">Records not found!</td></tr>';
    }

    $data .= '</table>';											

    echo $data;														
?>
