<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Food Ordering System</title>
    <style>
        /* Add your custom styles here */
        body {
            padding-bottom: 60px; /* Add padding to the bottom for the floating button */
        }

        .menu-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .menu-item img {
            max-width: 100px;
            margin-right: 10px;
        }

        .item-details {
            flex: 1;
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
        // Sample menu data (you can replace this with your actual data)
        const menuData = [
            { id: 1, name: 'Banana', price: 10, description: 'Description for Banana', image: 'https://via.placeholder.com/150' },
            { id: 2, name: 'Fried Rice', price: 15, description: 'What the hell is Fried Rice, but i like it so much', image: 'https://via.placeholder.com/150' },
            { id: 3, name: 'White Padi', price: 15, description: 'What the hell is Fried Rice, but i like it so much', image: 'https://via.placeholder.com/150' },
            { id: 4, name: 'Blue Chicken', price: 15, description: 'What the hell is Fried Rice, but i like it so much', image: 'https://via.placeholder.com/150' },
            { id: 5, name: 'Cassava', price: 15, description: 'What the hell is Fried Rice, but i like it so much', image: 'https://via.placeholder.com/150' },
            // Add more items as needed
        ];

        // Function to render menu items
        function renderMenu() {
            const menuList = document.getElementById('menu-list');

            menuData.forEach(item => {
                const menuItem = document.createElement('div');
                menuItem.classList.add('menu-item');
                menuItem.innerHTML = `
                    <img src="${item.image}" alt="${item.name}" class="img-fluid">
                    <div class="item-details">
                        <h4>${item.name}</h4>
                        <p>${item.description}</p>
                        <p>$${item.price.toFixed(2)}</p>
                    </div>
                    <button class="btn btn-success ml-auto" onclick="addToCart(${item.id})">Add to Cart</button>
                `;
                menuList.appendChild(menuItem);
            });
        }

        // Function to add item to cart
        function addToCart(itemId) {
            // Check if the cart exists in local storage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Check if the item is already in the cart
            const existingItem = cart.find(item => item.id === itemId);

            if (existingItem) {
                existingItem.quantity++;
            } else {
                // If not, add it to the cart with quantity 1
                const item = { id: itemId, quantity: 1 };
                cart.push(item);
            }

            // Save the updated cart to local storage
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        // Function to render cart items
        function renderCart() {
            const cartList = document.getElementById('cart-list');
            cartList.innerHTML = '';

            // Retrieve the cart from local storage
            const cart = JSON.parse(localStorage.getItem('cart')) || [];

            cart.forEach(item => {
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item');
                listItem.textContent = `Item ${item.id} - Quantity: ${item.quantity}`;
                cartList.appendChild(listItem);
            });
        }

        // Event listener for show cart button
        document.getElementById('show-cart-btn').addEventListener('click', function () {
            renderCart();
            $('#cartModal').modal('show'); // Show the cart modal
        });

        // Initial rendering of the menu
        renderMenu();
    </script>

</body>

</html>
