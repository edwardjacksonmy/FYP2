<?php

@include 'config.php';




if(isset($_POST['update_price_btn'])){
   $update_value = $_POST['update_price'];
   $update_id = $_POST['update_price_id'];
   $update_price_query = mysqli_query($conn, "UPDATE `quotation` SET price = '$update_value' WHERE id = '$update_id'");
   if($update_price_query){
      header('location:quotation.php');
   };
};

if(isset($_POST['update_quantity_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `quotation` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:quotation.php');
   };
};

if(isset($_POST['update_shipping_btn'])){
   $update_value = $_POST['update_shipping'];
   $update_id = $_POST['update_shipping_id'];
   $update_shipping_query = mysqli_query($conn, "UPDATE `quotation` SET shipping = '$update_value' WHERE id = '$update_id'");
   if($update_shipping_query){
      header('location:quotation.php');
   };
};

if(isset($_POST['update_description_btn'])){
   $update_value = $_POST['update_description'];
   $update_id = $_POST['update_description_id'];
   $update_description_query = mysqli_query($conn, "UPDATE `quotation` SET description = '$update_value' WHERE id = '$update_id'");
   if($update_description_query){
      header('location:quotation.php');
   };
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

   <h1 class="heading">edit quotation(draft)</h1>

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
			
			
			<td>
               <form action="" method="post">
                  <input type="hidden" name="update_price_id"  value="<?php echo $fetch_quotation['id']; ?>" >
                  RM <input type="number" name="update_price" min="0"  value="<?php echo $fetch_quotation['price']; ?>" >
                  <input type="submit" value="update" name="update_price_btn">
               </form>   
            </td>
			
			<td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_quotation['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_quotation['quantity']; ?>" >
                  <input type="submit" value="update" name="update_quantity_btn">
               </form>   
            </td>
			
			<td>
               <form action="" method="post">
                  <input type="hidden" name="update_shipping_id"  value="<?php echo $fetch_quotation['id']; ?>" >
                  RM <input type="number" name="update_shipping" min="0"  value="<?php echo $fetch_quotation['shipping']; ?>" >
                  <input type="submit" value="update" name="update_shipping_btn">
               </form>   
            </td>
			
			<td>
               <form action="" method="post">
                  <input type="hidden" name="update_description_id"  value="<?php echo $fetch_quotation['id']; ?>" >
                  <input type="text" name="update_description"  value="<?php echo $fetch_quotation['description']; ?>" >
                  <input type="submit" value="update" name="update_description_btn">
               </form>   
            </td>
			
			
            <td>RM<?php echo $sub_total = number_format($fetch_quotation['price'] * $fetch_quotation['quantity'] + $fetch_quotation['shipping']); ?></td>
            <td>
			<a href="quotation.php?remove=<?php echo $fetch_quotation['id']; ?>" onclick="return confirm('remove item from quotation?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a>
			</td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="item.php" class="option-btn" style="margin-top: 0;">back to item request</a></td>
            <td colspan="5">grand total</td>
            <td>RM<?php echo $grand_total; ?></td>
            <td><a href="quotation.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
   </div>

</section>

</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>