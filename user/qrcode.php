<?php
if (isset($_POST['pay'])) {
    $amount = $_POST['amount'];
    if ($amount <= 0) {
        echo "<script>alert('Please enter a valid amount!');</script>";
    } else {
        $upiID = "adityapawar8552@oksbi";  
        $name = "Electricity Board"; 
        $upiLink = "upi://pay?pa=$upiID&pn=$name&mc=&tid=&tr=&tn=Bill%20Payment&am=$amount&cu=INR";
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($upiLink);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPI QR Code Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
        }
        #popup {
            display: <?php echo isset($qrCodeUrl) ? 'block' : 'none'; ?>;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        #close-btn, #confirm-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            margin-top: 10px;
        }
        #close-btn {
            background: red;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Electricity Bill Payment</h2>
        <form method="post">
            <label>Enter Amount:</label>
            <input type="number" name="amount" placeholder="Enter amount" required>
            <button type="submit" name="pay">Pay</button>
        </form>
    </div>

    <!-- Pop-up Modal -->
    <?php if (isset($qrCodeUrl)): ?>
        <div id="popup">
            <h3>Scan to Pay</h3>
            <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code">
            <br>
            <button id="confirm-btn" onclick="confirmPayment()">Confirm Payment</button>
            <button id="close-btn" onclick="closePopup()">Close</button>
        </div>
    <?php endif; ?>

    <script>
        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }

        function confirmPayment() {
            alert("Payment Successful! Thank you.");
            closePopup();
        }
    </script>

</body>
</html>
