<?php
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['userEmail'])) {
    header("Location: login.html");
    exit();
}

$userEmail = $_SESSION['userEmail'];
$username = $_SESSION['username'];
$lastname = $_SESSION['lastname'];
$usernumber = $_SESSION['usernumber'];
$streetaddress = $_SESSION['streetaddress'];
$postalcode = $_SESSION['postalcode'];
$city = $_SESSION['city'];
$province = $_SESSION['province'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: auto;
            text-align: left;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f8f8f8;
        }

        .container h1 {
            text-align: center;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            padding: 10px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .item h2 {
            font-size: 1em;
            margin: 0;
        }

        .item .price, .item .quantity {
            font-size: 0.9em;
            color: #555;
        }

        .item .quantity {
            margin-left: 20px;
        }

        .notification {
            margin-top: 20px;
            padding: 10px;
            background: #e0ffe0;
            border: 1px solid #b2d8b2;
            border-radius: 5px;
            color: #2d7a2d;
        }

        .form-field {
            margin: 10px 0;
        }

        .form-field label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-field input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .home-button {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: royalblue;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
            text-decoration: none;
        }

        .home-button i {
            margin-right: 8px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-8x8dKRYuHGA7B0Xh7XK9CTq+yXJSUJYFzflS/3Rm6vK59T1kKZlY6olWfdvC9uMk4TPzJZOYB5XlYQYqYp4xjw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <form action="login.php" method="post">
            <div class="cartItems"></div>

            <div class="form-field">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="username" value="<?php echo htmlspecialchars($username); ?>">
            </div>
            <div class="form-field">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>">
            </div>
            <div class="form-field">
                <label for="email">Email:</label>
                <input type="email" id="email" name="userEmail" value="<?php echo htmlspecialchars($userEmail); ?>">
            </div>
            <div class="form-field">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="usernumber" value="<?php echo htmlspecialchars($usernumber); ?>">
            </div>
            <div class="form-field">
                <label for="address">Street Address:</label>
                <input type="text" id="address" name="streetaddress" value="<?php echo htmlspecialchars($streetaddress); ?>">
            </div>
            <div class="form-field">
                <label for="postalCode">Postal Code:</label>
                <input type="text" id="postalCode" name="postalcode" value="<?php echo htmlspecialchars($postalcode); ?>">
            </div>
            <div class="form-field">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($city); ?>">
            </div>
            <div class="form-field">
                <label for="province">Province:</label>
                <input type="text" id="province" name="province" value="<?php echo htmlspecialchars($province); ?>">
            </div>
            <a href="index.html" class="home-button">
                <i class="fas fa-home"></i> Home
            </a>
        </form>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
              
                const cartItemsContainer = document.querySelector('.cartItems');
                const cartData = JSON.parse(localStorage.getItem('cartData'));

                if (cartData && cartData.length > 0) {
                    cartData.forEach(item => {
                        const cartItem = document.createElement('div');
                        cartItem.classList.add('item');
                        cartItem.innerHTML = `
                            <div>
                                <h2>${item.name}</h2>
                                <div class="price">${item.price}</div>
                            </div>
                            <div class="quantity">Quantity: ${item.quantity}</div>
                        `;
                        cartItemsContainer.appendChild(cartItem);
                    });
                } else {
                    cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
                }
            });
        </script>
    </div>
</body>
</html>
