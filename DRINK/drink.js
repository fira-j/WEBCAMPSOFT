
 
const orderButton = document.getElementById('order-button');
  
  // Get the restaurants list element
  const restaurantsList = document.getElementById('restaurants-list');
  
  // Add hover event listener to the order button
  orderButton.addEventListener('mouseenter', function() {
    // Display the restaurants list
    restaurantsList.style.display = 'block';
  });
  
  // Hide the restaurants list when mouse leaves the button
  orderButton.addEventListener('mouseleave', function() {
    // Hide the restaurants list
    restaurantsList.style.display = 'none';
  });function toggleRestaurantList(button) {
    var restaurantsList = button.nextElementSibling;
    restaurantsList.style.display = restaurantsList.style.display === "none" ? "block" : "none";

    if (restaurantsList.style.display === "block") {
        var restaurantListItems = restaurantsList.querySelectorAll("li");
        var restaurantListHTML = "<ul>";
        restaurantListItems.forEach(function (item) {
            restaurantListHTML += "<li>" + item.innerText + "</li>";
        });
        restaurantListHTML += "</ul>";
        document.getElementById("restaurant-aside").innerHTML += restaurantListHTML;
    } else {
        document.getElementById("restaurant-aside").innerHTML = "";
    }
}
var productImage = document.getElementById('productImage');

    // Set the maximum dimensions for the box
    var maxWidth = 10; // Adjust the maximum width of your box
    var maxHeight = 100; // Adjust the maximum height of your box

    // Get the original dimensions of the image
    var originalWidth = productImage.naturalWidth;
    var originalHeight = productImage.naturalHeight;

    // Calculate the aspect ratio of the image
    var aspectRatio = originalWidth / originalHeight;

    // Calculate the new dimensions while maintaining the aspect ratio
    var newWidth = originalWidth;
    var newHeight = originalHeight;

    if (originalWidth > maxWidth) {
        newWidth = maxWidth;
        newHeight = newWidth / aspectRatio;
    }

    if (newHeight > maxHeight) {
        newHeight = maxHeight;
        newWidth = newHeight * aspectRatio;
    }

    // Set the new dimensions to the image element
    productImage.style.width = newWidth + 'px';
    productImage.style.height = newHeight + 'px';


  