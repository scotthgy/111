<!-- Hero Banner -->
<div class="hero-banner">
  <div class="hero-content">
    <h1>Fresh Artisan Sourdough</h1>
    <p>Handcrafted Daily with Love & Organic Ingredients</p>
    <a href="products.php" class="hero-btn">Shop Our Breads</a>
  </div>
</div>

<!-- Features Section -->
<section class="py-5" style="background: #FAFAFA;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title">Why Choose Us</h2>
      <p class="section-subtitle">What makes our bread special</p>
    </div>
    <div class="row g-4">
      <div class="col-md-3 col-sm-6">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-leaf"></i>
          </div>
          <h4>100% Organic</h4>
          <p>Only the finest organic flour and natural ingredients</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-clock"></i>
          </div>
          <h4>Slow Fermented</h4>
          <p>14-17 hours of natural fermentation for perfect taste</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-hand-paper"></i>
          </div>
          <h4>Handcrafted</h4>
          <p>Every loaf is hand-kneaded and shaped with care</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-sun"></i>
          </div>
          <h4>Solar Powered</h4>
          <p>Baked using 100% renewable solar energy</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Featured Products -->
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title">Our Signature Breads</h2>
      <p class="section-subtitle">Taste the difference of real sourdough</p>
    </div>
    <div class="row g-4">
      <?php
        include("Processes/processConnectDB.php");
        
        $sql = "SELECT ProductNumber, ProductName, UnitPrice, ProductImage, ProductDescription"
             . " FROM PRODUCT"
             . " WHERE ProductNumber <> 5 LIMIT 4";
        
        $resultSet = mysqli_query($conn, $sql);
        
        while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)) {
          echo '<div class="col-md-3 col-sm-6">';
          echo '  <div class="product-card">';
          echo '    <img src="images/productImages/' . $record['ProductImage'] . '" alt="' . $record['ProductName'] . '">';
          echo '    <div class="product-card-body">';
          echo '      <h3 class="product-name">' . $record['ProductName'] . '</h3>';
          echo '      <p class="product-price">$' . number_format($record['UnitPrice'], 2) . '</p>';
          echo '      <form action="Processes/processProductDetails.php" method="post">';
          echo '        <input type="hidden" name="ProductNumber" value="' . $record['ProductNumber'] . '">';
          echo '        <button type="submit" name="VIEWITEM" class="product-btn">View Details</button>';
          echo '      </form>';
          echo '    </div>';
          echo '  </div>';
          echo '</div>';
        }
      ?>
    </div>
    <div class="text-center mt-5">
      <a href="products.php" class="hero-btn">View All Products</a>
    </div>
  </div>
</section>

<!-- About Section -->
<section class="about-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="images/aboutUs/aboutLuca.jpg" alt="About Luca's Loaves" class="img-fluid about-img">
      </div>
      <div class="col-md-6">
        <div class="about-content">
          <h2>Our Story</h2>
          <p>Founded by Luca, a former lifeguard who discovered his true passion in the art of bread making, Luca's Loaves brings you authentic artisan sourdough crafted with dedication and care.</p>
          <p>We believe in real food made the traditional way. No shortcuts, no artificial additives - just pure, honest bread that nourishes both body and soul.</p>
          <ul class="about-list">
            <li>No commercial yeast - only natural fermentation</li>
            <li>Hand kneaded and shaped in-house daily</li>
            <li>Prepared over 14-17 hours for perfect digestion</li>
            <li>100% organic flour and filtered water</li>
            <li>Solar-powered ovens for sustainability</li>
          </ul>
          <a href="aboutUs.php" class="hero-btn mt-3">Learn More About Us</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Bread Making Class -->
<section class="class-section">
  <div class="container">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="class-card">
          <h3>Learn to Make Sourdough</h3>
          <p>Join our hands-on bread making class and discover the ancient art of sourdough baking. Perfect for beginners and bread enthusiasts!</p>
          <p><strong>First Saturday of every month • 9am - 5pm • Lunch included • $350 + GST</strong></p>
          <a href="breadMakingClass.php" class="class-btn">Reserve Your Spot</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials -->
<section class="py-5" style="background: #FAFAFA;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title">What Our Customers Say</h2>
      <p class="section-subtitle">Real feedback from real bread lovers</p>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="testimonial-card">
          <div class="testimonial-stars">
            ★★★★★
          </div>
          <p class="testimonial-text">"This is hands down the best sourdough I've ever had! The crust is perfectly crispy and the inside is so soft. I'm never going back to store-bought bread."</p>
          <p class="testimonial-author">- Sarah Mitchell</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="testimonial-card">
          <div class="testimonial-stars">
            ★★★★★
          </div>
          <p class="testimonial-text">"As someone with digestive issues, I've struggled with regular bread. Luca's sourdough is so easy on my stomach. The slow fermentation really makes a difference!"</p>
          <p class="testimonial-author">- James Rodriguez</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="testimonial-card">
          <div class="testimonial-stars">
            ★★★★★
          </div>
          <p class="testimonial-text">"The bread making class was incredible! Luca is such a patient teacher. I now make my own sourdough at home and my family loves it."</p>
          <p class="testimonial-author">- Emma Chen</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Opening Hours Banner -->
<section class="py-5" style="background: linear-gradient(135deg, #3E2723 0%, #5D4037 100%); color: white;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-start">
        <h3 style="font-size: 2rem; font-weight: 700; margin-bottom: 15px;">Visit Our Bakery</h3>
        <p style="font-size: 1.2rem; margin-bottom: 0;">123 Pitt Street, Sydney NSW 2000</p>
        <p style="font-size: 1.2rem;">📞 9000 1234</p>
      </div>
      <div class="col-md-6 text-center text-md-end">
        <h4 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 15px;">Opening Hours</h4>
        <p style="font-size: 1.2rem; margin-bottom: 5px;">Monday - Sunday</p>
        <p style="font-size: 1.5rem; font-weight: 700; color: #D4A574;">7:00 AM - 4:00 PM</p>
      </div>
    </div>
  </div>
</section>