<?php
if ($_GET['table'] != "") {
    $table = $_GET['table'];
}else{
    $table = "Take Away";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Food Ordering System</title>
    <style>
        body {
            padding-bottom: 60px; /* Add padding to the bottom for the floating button */
        }
        .menu-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            position: relative;
        }
        .menu-item img {
            max-width: 100px;
            margin-right: 10px;
        }
        .item-details {
            flex: 1;
        }
        .add-to-cart-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
        }
        #show-cart-btn {
            position: fixed;
            bottom: 15px;
            right: 15px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="container mt-4">

        <h2>Menu</h2>

        <div id="menu-list">
            <!-- Menu items will be dynamically added here -->
        </div>

        <!-- Cart Modal -->
        <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul id="cart-list" class="list-group">
                            <!-- Cart items will be dynamically added here -->
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating "Show Cart" Button -->
        <button id="show-cart-btn" class="btn btn-primary">Show Cart</button>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const menuData = [
            { id: 1, title: 'Item 1', price: 10, description: 'Description for Item 1', image: 'https://via.placeholder.com/150' },
            { id: 2, title: 'Item 2', price: 15, description: 'Description for Item 2', image: 'https://via.placeholder.com/150' },
            // Add more items as needed
        ];

        function renderMenu() {
            const menuList = document.getElementById('menu-list');

            menuData.forEach(item => {
                const menuItem = document.createElement('div');
                menuItem.classList.add('menu-item');
                menuItem.innerHTML = `
                    <img src="${item.image}" alt="${item.title}" class="img-fluid">
                    <div class="item-details">
                        <h4>${item.title}</h4>
                        <p>${item.description}</p>
                        <p>$${item.price.toFixed(2)}</p>
                    </div>
                    <button class="btn btn-success add-to-cart-btn" onclick="addToCart(${item.id})">+</button>
                `;
                menuList.appendChild(menuItem);
            });
        }

        function addToCart(itemId) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            const existingItem = cart.find(item => item.id === itemId);

            if (existingItem) {
                existingItem.quantity++;
            } else {
                const item = { id: itemId, quantity: 1 };
                cart.push(item);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
        }

        function renderCart() {
            const cartList = document.getElementById('cart-list');
            cartList.innerHTML = '';

            const cart = JSON.parse(localStorage.getItem('cart')) || [];

            cart.forEach(item => {
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item');
                listItem.textContent = `Item ${item.id} - Quantity: ${item.quantity}`;
                cartList.appendChild(listItem);
            });
        }

        document.getElementById('show-cart-btn').addEventListener('click', function () {
            renderCart();
            $('#cartModal').modal('show');
        });

        renderMenu();
    </script>

</body>

</html>
