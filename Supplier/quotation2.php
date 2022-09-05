<?php

@include 'config.php';


if(isset($_POST['post_quotation'])){

   $quotation_name = $_POST['quotation_name'];
   $quotation_price = $_POST['quotation_price'];
   $quotation_quantity = $_POST['quotation_quantity'];
   $quotation_shipping = $_POST['quotation_shipping'];
   $quotation_description = $_POST['quotation_description'];
   $quotation_image = $_POST['quotation_image'];
   

   $select_quotation = mysqli_query($conn, "SELECT * FROM `sent` WHERE name = '$quotation_name'");

   if(mysqli_num_rows($select_quotation) > 0){
      $message[] = 'Item already sent out';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `sent`(name, price, quantity, shipping, description, image) VALUES('$quotation_name', '$quotation_price', '$quotation_quantity', '$quotation_shipping', '$quotation_description', '$quotation_image')");
      $message[] = 'Item sent out succesfully';
   }

};


if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `quotation` WHERE id = '$remove_id'");
   header('location:quotation.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `quotation`");
   header('location:quotation.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quotation panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">


<section class="shopping-cart">

   <h1 class="heading">edit quotation(confirmation)</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
		 <th>shipping</th>
		 <th>description</th>
         <th>total price</th>
         <th>action</th>
      </thead>
	  
		
      <tbody>

         <?php 
         
         $select_quotation = mysqli_query($conn, "SELECT * FROM `quotation`");
         $grand_total = 0;
         if(mysqli_num_rows($select_quotation) > 0){
            while($fetch_quotation = mysqli_fetch_assoc($select_quotation)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $fetch_quotation['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_quotation['name']; ?></td>
			<td>RM<?php echo number_format($fetch_quotation['price']); ?></td>
			<td><?php echo number_format($fetch_quotation['quantity']); ?></td>
			<td>RM<?php echo number_format($fetch_quotation['shipping']); ?></td>
			<td><?php echo $fetch_quotation['description']; ?></td>
            <td>RM<?php echo $sub_total = number_format($fetch_quotation['price'] * $fetch_quotation['quantity'] + $fetch_quotation['shipping']); ?></td>
            
			
			
			
			<td>
			<form action="" method="post">
			<input type="hidden" name="quotation_name" value="<?php echo $fetch_quotation['name']; ?>">
            <input type="hidden" name="quotation_price" value="<?php echo $fetch_quotation['price']; ?>">
			<input type="hidden" name="quotation_quantity" value="<?php echo $fetch_quotation['quantity']; ?>">
			<input type="hidden" name="quotation_shipping" value="<?php echo $fetch_quotation['shipping']; ?>">
			<input type="hidden" name="quotation_description" value="<?php echo $fetch_quotation['description']; ?>">
            <input type="hidden" name="quotation_image" value="<?php echo $fetch_quotation['image']; ?>">
			<input type="submit" class="btn" value="post quotation" name="post_quotation">
			</form>
			
			<a href="quotation.php?remove=<?php echo $fetch_quotation['id']; ?>" onclick="return confirm('remove item from quotation?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a>
			</td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="quotation.php" class="option-btn" style="margin-top: 0;">back to quotation draft</a></td>
            <td colspan="5">grand total</td>
            <td>RM<?php echo $grand_total; ?></td>
            <td><a href="quotation.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>



</section>

</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>