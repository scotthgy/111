<div class="cart-page">
  <div class="cart-wrapper">
    
    <div class="cart-header-section">
      <h1 class="cart-main-title">Your Shopping Cart</h1>
      <p class="cart-description">Review your items before checkout</p>
    </div>

    <div class="cart-grid">
      
      <div class="items-container">
        <div class="cart-items-list"></div>
      </div>

      <div class="summary-sidebar">
        <h2 class="summary-header">Order Summary</h2>
        
        <div class="total-display-box">
          <div class="total-text">Total</div>
          <div class="total-amount-big" id="cartTotal">$0.00</div>
        </div>

        <div class="checkout-form-box">
          <form action="Processes/processCheckout.php" method="post" id="checkoutForm">
            
            <div class="input-group">
              <label class="input-label" for="firstName">
                <i class="fas fa-user"></i> First Name
              </label>
              <input type="text" id="firstName" name="firstName" class="input-field" placeholder="First name" required>
            </div>

            <div class="input-group">
              <label class="input-label" for="lastName">
                <i class="fas fa-user"></i> Last Name
              </label>
              <input type="text" id="lastName" name="lastName" class="input-field" placeholder="Last name" required>
            </div>

            <div class="input-group">
              <label class="input-label" for="customerEmail">
                <i class="fas fa-envelope"></i> Email
              </label>
              <input type="email" id="customerEmail" name="customerEmail" class="input-field" placeholder="your@email.com" required>
            </div>

            <div class="input-group">
              <label class="input-label" for="contactPhone">
                <i class="fas fa-phone"></i> Phone
              </label>
              <input type="tel" id="contactPhone" name="contactPhone" class="input-field" placeholder="(123) 456-7890" required>
            </div>

            <div class="input-group">
              <label class="input-label" for="creditCardNumber">
                <i class="fas fa-credit-card"></i> Card Number
              </label>
              <input type="text" id="creditCardNumber" name="creditCardNumber" class="input-field" placeholder="1234 5678 9012 3456" required>
            </div>

            <div class="card-fields-row">
              <div class="input-group">
                <label class="input-label" for="expiration">Expiry</label>
                <input type="text" id="expiration" name="expiration" class="input-field" placeholder="MM/YY" required>
              </div>
              <div class="input-group">
                <label class="input-label" for="securityCode">CVV</label>
                <input type="text" id="securityCode" name="securityCode" class="input-field" placeholder="123" required>
              </div>
            </div>

            <button type="submit" name="CHECKOUT" class="complete-order-btn">
              <i class="fas fa-lock"></i> Checkout
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
window.addEventListener("load", function(){
  const cartItemsList = document.querySelector(".cart-items-list");
  const cartTotal = document.getElementById("cartTotal");
  const serverFileGetArrayOrderItems = "Processes/sendArrayOrderItems.php";
  const serverFileGetGrandTotal = "Processes/sendGrandTotal.php";

  if(typeof ajaxGetDataFromServer !== 'undefined') {
    ajaxGetDataFromServer(serverFileGetArrayOrderItems, function(orderItems){
      displayCartItems(orderItems);
    });
  }

  function displayCartItems(orderItems) {
    if(orderItems && orderItems.length > 0){
      orderItems.forEach(function(item, index){
        const cartItemHTML = `
          <div class="cart-item-box" id="cartItem${index}">
            <div class="item-content">
              <img src="images/productImages/${item.image}" alt="${item.productName}" class="item-product-image">
              
              <div class="item-info-section">
                <h3 class="item-product-name">${item.productName}</h3>
                <p class="item-unit-price">$${parseFloat(item.unitPrice).toFixed(2)} each</p>
                <p class="item-detail-row"><i class="fas fa-calendar-alt"></i> Pick-up: ${item.pickUpDate}</p>
                <p class="item-detail-row"><i class="fas fa-clock"></i> Time: ${item.pickUpTime}</p>
              </div>
            </div>
            
            <div class="item-controls">
              <div class="quantity-section">
                <label class="quantity-label">Quantity:</label>
                <input type="number" class="quantity-input-field" value="${item.quantityOrdered}" min="1" 
                  data-product-number="${item.productNumber}" 
                  data-unit-price="${item.unitPrice}"
                  data-index="${index}">
              </div>
              
              <div class="item-right-section">
                <div class="subtotal-display">$<span id="subtotal${index}">${parseFloat(item.totalAmount).toFixed(2)}</span></div>
                <button class="remove-item-btn" data-product-number="${item.productNumber}">
                  <i class="fas fa-trash-alt"></i> Remove
                </button>
              </div>
            </div>
          </div>
        `;
        cartItemsList.insertAdjacentHTML('beforeend', cartItemHTML);
      });

      document.querySelectorAll('.quantity-input-field').forEach(function(input){
        input.addEventListener('change', function(){
          const productNumber = this.getAttribute('data-product-number');
          const unitPrice = parseFloat(this.getAttribute('data-unit-price'));
          const newQuantity = parseInt(this.value);
          const index = this.getAttribute('data-index');
          const originalQty = parseInt(this.defaultValue);
          const difference = newQuantity - originalQty;
          const newAmount = unitPrice * newQuantity;
          
          document.getElementById(`subtotal${index}`).textContent = newAmount.toFixed(2);
          
          if(typeof ajaxChangeQuantityAndGrandTotal !== 'undefined') {
            ajaxChangeQuantityAndGrandTotal(productNumber, newQuantity, difference, unitPrice, newAmount);
          }
          
          setTimeout(function(){ updateGrandTotal(); }, 500);
        });
      });

      document.querySelectorAll('.remove-item-btn').forEach(function(button){
        button.addEventListener('click', function(){
          const productNumber = this.getAttribute('data-product-number');
          const cartItem = this.closest('.cart-item-box');
          
          if(typeof ajaxRemoveThisCartItem !== 'undefined') {
            ajaxRemoveThisCartItem(productNumber);
          }
          
          cartItem.remove();
          
          setTimeout(function(){
            updateGrandTotal();
            if(document.querySelectorAll('.cart-item-box').length === 0){
              showEmptyCart();
            }
          }, 500);
        });
      });

      updateGrandTotal();
    } else {
      showEmptyCart();
    }
  }

  function updateGrandTotal(){
    if(typeof ajaxGetDataFromServer !== 'undefined') {
      ajaxGetDataFromServer(serverFileGetGrandTotal, function(total){
        cartTotal.textContent = (typeof formatAUD !== 'undefined') ? formatAUD(total) : '$' + parseFloat(total).toFixed(2);
      });
    }
  }

  function showEmptyCart(){
    document.querySelector('.cart-grid').innerHTML = `
      <div class="empty-state">
        <div class="empty-icon"><i class="fas fa-shopping-basket"></i></div>
        <h2>Your Cart is Empty</h2>
        <p>Looks like you haven't added any delicious sourdough yet!</p>
        <a href="products.php" class="shop-now-link">
          <i class="fas fa-bread-slice"></i> Browse Our Breads
        </a>
      </div>
    `;
  }
});
</script>