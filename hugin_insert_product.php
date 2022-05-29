<?php

$response = array();

if( isset($_POST['PRODUCT_ID'])  && isset($_POST['PRODUCT_NAME']) && isset($_POST['PRICE'])  && isset($_POST['VAT_RATE'])  && isset($_POST['Status']) && isset($_POST['PaymentType'])) {

    $productID = $_POST['PRODUCT_ID'];
    $name = $_POST['PRODUCT_NAME'];
    $price = $_POST['PRICE'];
    $vatRate = $_POST['VAT_RATE'];
    $status = $_POST['Status'];
    $paymentType = $_POST['PaymentType'];

    


    //DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE değişkenleri alınır.
    require_once __DIR__ . '/db_config.php';
    
    // Bağlantı oluşturuluyor.
    $baglanti = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    
    // Bağlanti kontrolü yapılır.
    if (!$baglanti) {
        die("Hatalı bağlantı : " . mysqli_connect_error());
    }
    mysqli_set_charset($baglanti, "utf8");


    $sqlsorgu = "INSERT INTO Product 
    (ProductID, Name, Price, VatRate, Status, PaymentType) 
    value ($productID,'$name',$price,$vatRate,'$status','$paymentType')";
  
    
 
   if (mysqli_query($baglanti, $sqlsorgu)) {
	    $last_id = mysqli_insert_id($baglanti);
        $response["success"] = 1;
        $response["message"] = "successfully ";
        echo json_encode($response);
    } else {
        $response["success"] = 0;
        $response["message"] = "No product found";
        echo json_encode($response);
    }
    //bağlantı koparılır.
mysqli_close($baglanti);


}else {

    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

   echo json_encode($response);
		

}

	
?>




