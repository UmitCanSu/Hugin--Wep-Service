<?php

$response = array();

if( isset($_POST['PaymentType']) && isset($_POST['PRODUCT_ID'])) {

    
    $paymentType = $_POST['PaymentType'];
    $productID = $_POST['PRODUCT_ID'];

    //DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE değişkenleri alınır.
    require_once __DIR__ . '/db_config.php';
    
    // Bağlantı oluşturuluyor.
    $baglanti = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    
    // Bağlanti kontrolü yapılır.
    if (!$baglanti) {
        die("Hatalı bağlantı : " . mysqli_connect_error());
    }
    mysqli_set_charset($baglanti, "utf8");


    $sqlsorgu = "Update Product set PaymentType = $paymentType where ProductID = $productID";
 
    if (mysqli_query($baglanti, $sqlsorgu)) {
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




