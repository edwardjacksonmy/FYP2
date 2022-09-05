<?php

@include 'config.php';

if(isset($_POST['add_quotation'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_quantity = $_POST['product_quantity'];
   $product_shipping = $_POST['product_shipping'];
   $product_description = $_POST['product_description'];
   $product_image = $_POST['product_image'];
   

   $select_quotation = mysqli_query($conn, "SELECT * FROM `quotation` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_quotation) > 0){
      $message[] = 'Item already added to quotation';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `quotation`(name, price, quantity, shipping, description, image) VALUES('$product_name', '$product_price', '$product_quantity', '$product_shipping', '$product_description', '$product_image')");
      $message[] = 'Item added to quotation succesfully';
   }

}




?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Customer item request</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="container">

<section class="products">

   <h1 class="heading">customer item request list</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `customer`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
			<h3><?php echo $fetch_product['description']; ?></h3>
            <div class="price">RM<?php echo $fetch_product['price']; ?></div>
			<h3>Expected shipping fee: RM<?php echo $fetch_product['shipping']; ?></h3>
			<h3>Requested quantity: <?php echo $fetch_product['quantity']; ?></h3>
			<h3>Description: <?php echo $fetch_product['description']; ?></h3>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
			<input type="hidden" name="product_quantity" value="<?php echo $fetch_product['quantity']; ?>">
			<input type="hidden" name="product_shipping" value="<?php echo $fetch_product['shipping']; ?>">
			<input type="hidden" name="product_description" value="<?php echo $fetch_product['description']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
			<input type="submit" class="btn" value="add quotation" name="add_quotation">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>