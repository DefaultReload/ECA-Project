<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Products";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ID, name, Price, Stock, Details, Img FROM Shop";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* [Your existing CSS styles here] */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header {
            background-color: #f8f8f8;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }

        #testimonials {
            text-align: center;
            padding: 50px 20px;
        }

        #testimonials h2 {
            font-size: 2em;
            margin-bottom: 30px;
        }

        .testimonial {
            display: inline-block;
            width: 30%;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin: 0 10px;
            box-sizing: border-box;
            background: #fff;
        }

        .testimonial img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .testimonial h3 {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .testimonial p {
            font-size: 1em;
            line-height: 1.5;
        }

        /* Footer section */
        footer {
            background: #333;
            color: #fff;
            padding: 20px;
            text-align: left;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .footer-left {
            flex: 1;
            min-width: 200px;
        }

        .footer-right {
            flex: 1;
            min-width: 200px;
        }

        .footer-right form {
            display: flex;
            margin-top: 10px;
        }

        .footer-right input {
            padding: 5px;
            margin-right: 10px;
            flex: 1;
        }

        .footer-right button {
            padding: 5px 10px;
            background: orange;
            border: none;
            cursor: pointer;
        }

        .footer-bottom {
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #444;
        }

        .social-media a {
            display: inline-block;
            margin: 0 5px;
        }

        .social-media img {
            width: 20px;
            height: 20px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .testimonial {
                width: 80%;
                margin: 20px auto;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-right form {
                flex-direction: column;
            }

            .footer-right input {
                margin: 0 0 10px 0;
            }
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .footer-logo {
            width: 10%;
            max-width: 100px;
            margin-bottom: 20px;
        }

        .footer p {
            margin: 10px 0;
        }

        @media (max-width: 768px) {
            .footer-logo {
                width: 15%;
                max-width: 80px;
            }
        }

        @media (max-width: 480px) {
            .footer-logo {
                width: 20%;
                max-width: 60px;
            }
        }

        body {
            margin: 0;
            font-family: Poppins;
        }
        .container {
            width: 900px;
            margin: auto;
            max-width: 90vw;
            text-align: center;
            padding-top: 10px;
            transition: transform .5s;
        }
        svg {
            width: 30px;
        }
        .title {
            font-size: xx-large;
        }
        .listProduct .item img {
            width: 90%;
            filter: drop-shadow(0 50px 20px #0009);
        }
        .listProduct {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .listProduct .item {
            background-color: #EEEEE6;
            padding: 20px;
            border-radius: 20px;
        }
        .listProduct .item h2 {
            font-weight: 500;
            font-size: large;
        }
        .listProduct .item .price {
            letter-spacing: 7px;
            font-size: small;
        }
        .listProduct .item button {
            background-color: #353432;
            color: #eee;
            border: none;
            padding: 5px 10px;
            margin-top: 10px;
            border-radius: 20px;
        }

        /* cart */
        .cartTab {
            width: 400px;
            background-color: #353432;
            color: #eee;
            position: fixed;
            top: 0;
            right: -400px;
            bottom: 0;
            display: grid;
            grid-template-rows: 70px 1fr 70px;
            transition: .5s;
        }
        body.showCart .cartTab {
            right: 0;
        }
        body.showCart .container {
            transform: translateX(-250px);
        }
        .cartTab h1 {
            padding: 20px;
            margin: 0;
            font-weight: 300;
        }
        .cartTab .btn {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }
        .cartTab button {
            background-color: #E8BC0E;
            border: none;
            font-family: Poppins;
            font-weight: 500;
            cursor: pointer;
        }
        .cartTab .close {
            background-color: #eee;
        }
        .listCart .item img {
            width: 100%;
        }
        .listCart .item {
            display: grid;
            grid-template-columns: 70px 150px 50px 1fr;
            gap: 10px;
            text-align: center;
            align-items: center;
        }
        .listCart .quantity span {
            display: inline-block;
            width: 25px;
            height: 25px;
            background-color: #eee;
            border-radius: 50%;
            color: #555;
            cursor: pointer;
        }
        .listCart .quantity span:nth-child(2) {
            background-color: transparent;
            color: #eee;
            cursor: auto;
        }
        .listCart .item:nth-child(even) {
            background-color: #eee1;
        }
        .listCart {
            overflow: auto;
        }
        .listCart::-webkit-scrollbar {
            width: 0;
        }
        @media only screen and (max-width: 992px) {
            .listProduct {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media only screen and (max-width: 768px) {
            .listProduct {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="shop.html">Shop</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="container">
        <header>
            <div class="title">PRODUCT LIST</div>
            <div class="icon-cart">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0 4h12"></path>
                </svg>
            </div>
        </header>
        <br>
        <div class="listProduct">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="item">';
                    echo '<a href="product_detail.php?id=' . $row["ID"] . '"><img src="' . $row["Img"] . '" alt="Product Image"></a>';
                    echo '<h2>' . $row["name"] . '</h2>';
                    echo '<div class="price">R' . $row["Price"] . '</div>';
                    echo '<button>Add to Cart</button>';
                    echo '</div>';
                }
            } else {
                echo "No products found";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <div class="cartTab">
        <h1>Your Cart</h1>
        <div class="listCart">
            <!-- Cart items will be dynamically inserted here -->
        </div>
        <div class="btn">
            <button class="close">Close</button>
            <button class="checkout">Checkout</button>
        </div>
    </div>
    <br>
    <footer>
        <div class="footer-content">
            <div class="footer-left">
                <img src="logo.png" alt="FiberBolt-Tech Logo" class="footer-logo">
                <p>Help</p>
                <p>Careers</p>
                <p>Terms of Service</p>
                <p>Privacy Policy</p>
                <p>Do Not Sell My Information</p>
            </div>
            <div class="footer-right">
                <form>
                    <input type="email" placeholder="Your email address">
                    <button type="submit">Submit</button>
                </form>
                <div class="social-media">
                    <a href="#"><img src="x.png" alt="X"></a>
                    <a href="#"><img src="linkedin.png" alt="LinkedIn"></a>
                    <a href="#"><img src="instagram.jpg" alt="Instagram"></a>
                    <a href="#"><img src="facebook.jpg" alt="Facebook"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 FiberBolt-Tech. All Rights Reserved</p>
        </div>
    </footer>

    <script>
        // JavaScript to handle cart functionality
        const cart = document.querySelector('.cartTab');
        const cartIcon = document.querySelector('.icon-cart');
        const closeCartButton = document.querySelector('.cartTab .close');
        const addToCartButtons = document.querySelectorAll('.listProduct .item button');
        const listCart = document.querySelector('.listCart');
        const checkoutButton = document.querySelector('.checkout');
        const body = document.body;

        cartIcon.addEventListener('click', () => {
            body.classList.toggle('showCart');
        });

        closeCartButton.addEventListener('click', () => {
            body.classList.remove('showCart');
        });

        addToCartButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const item = e.target.closest('.item');
                const itemName = item.querySelector('h2').textContent;
                const itemPrice = item.querySelector('.price').textContent;
                const itemImgSrc = item.querySelector('img').src;

                const cartItem = document.createElement('div');
                cartItem.classList.add('item');
                cartItem.innerHTML = `
                    <img src="${itemImgSrc}" alt="${itemName}">
                    <h2>${itemName}</h2>
                    <div class="price">${itemPrice}</div>
                    <div class="quantity">
                        <span>-</span>
                        <span>1</span>
                        <span>+</span>
                    </div>
                `;
                listCart.appendChild(cartItem);
            });
        });

        listCart.addEventListener('click', (e) => {
            if (e.target.matches('.quantity span')) {
                const span = e.target;
                const quantity = span.parentElement.querySelector('span:nth-child(2)');
                let quantityValue = parseInt(quantity.textContent);

                if (span.textContent === '+') {
                    quantityValue += 1;
                } else if (span.textContent === '-' && quantityValue > 1) {
                    quantityValue -= 1;
                }

                quantity.textContent = quantityValue;
            }
        });

        checkoutButton.addEventListener('click', () => {
            const cartItems = listCart.querySelectorAll('.item');
            const cartData = [];

            cartItems.forEach(item => {
                const itemName = item.querySelector('h2').textContent;
                const itemPrice = item.querySelector('.price').textContent;
                const itemQuantity = item.querySelector('.quantity span:nth-child(2)').textContent;
                cartData.push({ name: itemName, price: itemPrice, quantity: itemQuantity });
            });

            localStorage.setItem('cartData', JSON.stringify(cartData));
            window.location.href = 'Login.html';
        });
    </script>
</body>
</html>
