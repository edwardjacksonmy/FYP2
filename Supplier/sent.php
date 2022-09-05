<?php

@include 'config.php';



if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `sent` WHERE id = '$remove_id'");
   header('location:sent.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `sent`");
   header('location:sent.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quotation list (Post out)</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="shopping-cart">

   <h1 class="heading">Quotation sent</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price(RM)</th>
         <th>quantity</th>
		 <th>shipping(RM)</th>
		 <th>item description</th>
         <th>total price</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         
         $select_sent = mysqli_query($conn, "SELECT * FROM `sent`");
         $grand_total = 0;
         if(mysqli_num_rows($select_sent) > 0){
            while($fetch_sent = mysqli_fetch_assoc($select_sent)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $fetch_sent['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_sent['name']; ?></td>
			<td><?php echo $fetch_sent['price']; ?></td>
			<td><?php echo $fetch_sent['quantity']; ?></td>
			<td><?php echo $fetch_sent['shipping']; ?></td>
			<td><?php echo $fetch_sent['description']; ?></td>
            
			
            <td>RM<?php echo $sub_total = number_format($fetch_sent['price'] * $fetch_sent['quantity'] + $fetch_sent['shipping']); ?></td>
            <td><a href="sent.php?remove=<?php echo $fetch_sent['id']; ?>" onclick="return confirm('remove item from quotation sent list?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
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
            <td><a href="sent.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>

</section>

</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>