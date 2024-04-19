
<!DOCTYPE html>
<html>
<head>
    <title>Hotel Order Form</title>
    <link rel="stylesheet" href="order.css">
	 <link rel="stylesheet" href="heah.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var addToCartButtons = document.getElementsByClassName('add-to-cart');
    
    function updateTotalPrice() {
        var total = 0;
        
        for (var i = 0; i < addToCartButtons.length; i++) {
            var button = addToCartButtons[i];
            var foodItem = button.parentNode;
            var priceElement = foodItem.querySelector('.food-price');
            var quantityElement = foodItem.querySelector('.food-quantity');
            
            var price = parseFloat(priceElement.innerText);
            var quantity = parseInt(quantityElement.value);
            
            if (!isNaN(price) && !isNaN(quantity)) {
                total += price * quantity;
            }
        }
        
        var totalPriceElement = document.getElementById('totalPrice');
        totalPriceElement.value = total.toFixed(2) + ' Birr';
    }
    
    for (var i = 0; i < addToCartButtons.length; i++) {
        var button = addToCartButtons[i];
        button.addEventListener('click', function(event) {
            var foodItem = event.target.parentNode;
            var foodName = foodItem.querySelector('.food-name').innerText;
            var price = foodItem.querySelector('.food-price').innerText;
            
            var foodItemsElement = document.getElementById('foodItems');
            var existingFoodItems = foodItemsElement.value;
            
            var quantityElement = foodItem.querySelector('.food-quantity');
            var quantity = parseInt(quantityElement.value);
            
            var newFoodItem = foodName + ' - ' + quantity + ' quantity\n';
            var updatedFoodItems = existingFoodItems + newFoodItem;
            
            foodItemsElement.value = updatedFoodItems;
            
            updateTotalPrice();
        });
    }
});
    </script>
</head>
<body>
<div id="divs">
 
      <div class ="div"><a href="#div1">Home</a></div>
      <div class ="div"><a href="spatial_order.html" target="_self">Special Order</a></div>
      <div class ="div"><a href="login.html" target="_self">Login</a></div>
      <div class ="div"><a href="signup.html" target="_self">sign up</a></div>
  </div>
<div id="container">
    <form>
      <label for="bankSelect">Select Bank:</label>
      <select id="bankSelect" onchange="showBankForm(this.value)">
        <option value="">Select a bank</option>
        <option value="cbe">CBE</option>
        <option value="buna">Buna</option>
        <option value="nib">Nib</option>
        <option value="theneral">Theneral</option>
      </select>
    
      <div id="bankFormContainer" style="display: none;">
        <label for="bankName">Bank Name:</label>
        <input type="text" id="bankName" readonly>
    
        <label for="accountNumber">Account Number:</label>
        <input type="text" id="accountNumber" readonly>
      </div>
    </form>
  </div>
  
  <script>
    function showBankForm(bank) {
      var bankFormContainer = document.getElementById("bankFormContainer");
      var bankNameInput = document.getElementById("bankName");
      var accountNumberInput = document.getElementById("accountNumber");
  
      if (bank !== "") {
        bankFormContainer.style.display = "block";
  
        switch (bank) {
          case "cbe":
            bankNameInput.value = "CBE";
            accountNumberInput.value = "1234567890"; // Replace with the actual CBE account number
            break;
          case "buna":
            bankNameInput.value = "Buna";
            accountNumberInput.value = "0987654321"; // Replace with the actual Buna account number
            break;
          case "nib":
            bankNameInput.value = "Nib";
            accountNumberInput.value = "9876543210"; // Replace with the actual Nib account number
            break;
          case "theneral":
            bankNameInput.value = "Theneral";
            accountNumberInput.value = "0123456789"; // Replace with the actual Theneral account number
            break;
          default:
            bankNameInput.value = "";
            accountNumberInput.value = "";
            break;
        }
      } else {
        bankFormContainer.style.display = "none";
        bankNameInput.value = "";
        accountNumberInput.value = "";
      }
    }
  </script>
    <main>
	 <h1> vecttory hotel menu</h1>
        <section id="catalog_1" class="food-category">
            <h3>Breakfast</h3>
            
            <ul>
                <li>
                    <input type="number" class="food-quantity" min="1" value="0">
                    <img src="./IMG_20240403_141420_023.jpg" alt="Appetizer 1">
                    <div class="food-info">
                        <span class="food-name">DORO</span>
                        <span class="food-price">100 Birr</span>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>
                </li>
                <li>
                    <input type="number" class="food-quantity" min="1" value="0">
                    <img src="./IMG_20240403_141420_080.jpg" alt="Appetizer 2">
                    <div class="food-info">
                        <span class="food-name">NOODLE</span>
                        <span class="food-price">500 Birr</span>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>
                </li>
				                <li>
                    <input type="number" class="food-quantity" min="1" value="0">
                    <img src="./IMG_20240403_141420_023.jpg" alt="Appetizer 1">
                    <div class="food-info">
                        <span class="food-name">DORO</span>
                        <span class="food-price">100 Birr</span>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>
                </li>
                <li>
                    <input type="number" class="food-quantity" min="1" value="0">
                    <img src="./IMG_20240403_141420_080.jpg" alt="Appetizer 2">
                    <div class="food-info">
                        <span class="food-name">NOODLE</span>
                        <span class="food-price">500 Birr</span>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>
                </li>
				                <li>
                    <input type="number" class="food-quantity" min="1" value="0">
                    <img src="./IMG_20240403_141420_023.jpg" alt="Appetizer 1">
                    <div class="food-info">
                        <span class="food-name">DORO</span>
                        <span class="food-price">100 Birr</span>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>
                </li>
                <li>
                    <input type="number" class="food-quantity" min="1" value="0">
                    <img src="./IMG_20240403_141420_080.jpg" alt="Appetizer 2">
                    <div class="food-info">
                        <span class="food-name">NOODLE</span>
                        <span class="food-price">500 Birr</span>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>
                </li>
            </ul>
        </section>
        
        <section id="catalog_2" class="food-category">
            <h3>Lunch</h3>
            
                       
            <ul>
                <li>
                    <input type="number" class="food-quantity" min="1" value="0">
                    <img src="./IMG_20240403_141420_023.jpg" alt="Appetizer 1">
                    <div class="food-info">
                        <span class="food-name">DORO</span>
                        <span class="food-price">100 Birr</span>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>
                </li>
                <li>
                    <input type="number" class="food-quantity" min="1" value="0">
                    <img src="./IMG_20240403_141420_080.jpg" alt="Appetizer 2">
                    <div class="food-info">
                        <span class="food-name">NOODLE</span>
                        <span class="food-price">500 Birr</span>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>
                </li>
				                <li>
                    <input type="number" class="food-quantity" min="1" value="0">
                    <img src="./IMG_20240403_141420_023.jpg" alt="Appetizer 1">
                    <div class="food-info">
                        <span class="food-name">DORO</span>
                        <span class="food-price">100 Birr</span>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>
                </li>
                <li>
                    <input type="number" class="food-quantity" min="1" value="0">
                    <img src="./IMG_20240403_141420_080.jpg" alt="Appetizer 2">
                    <div class="food-info">
                        <span class="food-name">NOODLE</span>
                        <span class="food-price">500 Birr</span>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>
                </li>
				                <li>
                    <input type="number" class="food-quantity" min="1" value="0">
                    <img src="./IMG_20240403_141420_023.jpg" alt="Appetizer 1">
                    <div class="food-info">
                        <span class="food-name">DORO</span>
                        <span class="food-price">100 Birr</span>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>
                </li>
                <li>
                    <input type="number" class="food-quantity" min="1" value="0">
                    <img src="./IMG_20240403_141420_080.jpg" alt="Appetizer 2">
                    <div class="food-info">
                        <span class="food-name">NOODLE</span>
                        <span class="food-price">500 Birr</span>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>
                </li>
            </ul>
        </section>
        
      
        
        <section id="order-form">
            <h2>Order Form</h2>
            
       <form method="POST" action="order.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="phoneNumber">Phone Number:</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" required>
                
                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>
                
                <label for="foodItems">Food Items:</label>
                <textarea id="foodItems" name="foodItems" required></textarea>
                
                <label for="totalPrice">Total Price:</label>
                <input type="text" id="totalPrice" name="totalPrice" readonly>
                
				<label for="Hotel">from vectory :</label>
                <input type="text" id="totalPrice" name="hotel" value="vectory" readonly>
				
                <label for="photo">Upload Photo:</label>
                <input type="file" id="photo" name="photo" accept="image/*">
                
                <input type="submit" value="Place Order">
            </form>
        </section>
    </main>

</body>
</html>