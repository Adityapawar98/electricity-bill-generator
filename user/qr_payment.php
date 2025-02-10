<?php
if (isset($_POST['amount'])) {
    $amount = $_POST['amount'];
    if ($amount <= 0) {
        echo "Invalid amount!";
        exit;
    }

    $upiID = "adityapawar8552@oksbi";  // Replace with actual UPI ID
    $name = "Electricity Board"; 
    $upiLink = "upi://pay?pa=$upiID&pn=$name&mc=&tid=&tr=&tn=Bill%20Payment&am=$amount&cu=INR";
    $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($upiLink);
    
    echo "<img src='$qrCodeUrl' alt='QR Code'>";
}
?>
