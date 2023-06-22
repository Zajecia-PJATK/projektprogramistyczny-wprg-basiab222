function getMenuProducts() {
    const selectedCategory = document.getElementById('category').value;

    $.ajax({
        url: 'get_products.php',
        type: 'POST',
        data: { category: selectedCategory },
        success: function(response) {
            document.getElementById('productList').innerHTML = response;
        }
    });
}

function getProductPrice(selectElement) {
    const selectedProduct = document.getElementById('products').value;

    $.ajax({
        url: 'get_price.php',
        type: 'POST',
        data: { product: selectedProduct },
        success: function(response) {
            document.getElementById('productPrice').innerHTML = response;
            calculateTotal();
        }
    });
}

function calculateTotal() {
    const quantity = inputElement.value;
    const row = inputElement.parentNode.parentNode;
    const price = row.getElementsByClassName('productPrice')[1].innerHTML;
    const totalElement = row.getElementsByClassName('totalPrice')[1];
    const total = quantity * price;
    totalElement.innerHTML = total;
}

function addRow() {
    var table = document.getElementById('orderTable');
    var newRow = table.rows[1].cloneNode(true);
    table.appendChild(newRow);
}

