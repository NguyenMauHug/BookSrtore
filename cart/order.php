<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Order Form</title>
    <!-- <link rel="shortcut icon" type="image/x-icon" href="./images/Logo.png" /> -->
    <link rel="stylesheet" href="/Book_Store/css/order.css" />
    <script src="https://code.jquery.com/jquery-git.js"></script>
</head>

<body>
    <div id="overview">
        <img class="img" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/316787958_1087088998645049_3615156381373463481_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=aee45a&_nc_ohc=K1weE2Qrh1cAX_x4vq4&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AdSHTeKQNZt7da950pPyuP5c2iKoOtV10GG6reQ3fZXDgg&oe=63B3FA3A" />
    </div>
    <div id="form">
        <form method="post" action="http://mercury.swin.edu.au/it000000/cos10005/regtest.php" onsubmit="return validateTel()">
            <h1>Book order form</h1>
            <label>Dish: </label>
            <input type="text" name="dish" id="dish" placeholder="Type your Book you want" required />
            <br />
            <br />
            <label>Delivery order: </label>
            <br />
            <label id="deli">Delivery</label>
            <input type="radio" name="order" value="delivery" required />
            <label>Pick Up</label>
            <input type="radio" name="order" value="pickup" required />
            <br />
            <br />

            <label>Delivery Address:</label>
            <input type="text" name="Delivery Address" id="daddress" placeholder="Delivey Address" required />
            <br />
            <label>Billing Address:</label>
            <input type="text" name="Billing Address" id="baddress" placeholder="Billing Address" required />
            <br />
            <input id="duplicate" type="checkbox" name="duplicate" value="Duplicate" onclick="copy(event)" />Same as delivery address
            <p id="dalert">
                <b><i>Please enter your delivery address first</i></b>
            </p>

            <label>Contact number:</label>
            <input type="tel" name="Contact number" placeholder="your contact number" id="tel" required />
            <br />
            <br />

            <p>Payment Method:</p>
            <input id="paypickup" type="radio" name="rbRating" value="Pick Up" checked />Pay on pickup
            <input id="online" type="radio" name="rbRating" value="online" />Online

            <div id="hidden2" class="textinput">
                <input id="visa" type="radio" name="cardtype" value="visa" data-maxLength="16" />Visa
                <input id="mastercard" type="radio" name="cardtype" value="mastercard" data-maxLength="16" />MasterCard
                <input id="americanexpress" type="radio" name="cardtype" value="americanexpress" data-maxLength="15" />American Express
            </div>

            <div class="cardInput">
                <label for="input">Credit Card Number:</label>
                <input id="input" type="text" name="cardnum" />
            </div>
            <br />
            <button type="submit" value="Submit">Submit</button>
            <button type="reset" value="Reset">Reset</button>
        </form>
    </div>
</body>
<script type="text/javascript" src="./js/script.js"></script>

</html>