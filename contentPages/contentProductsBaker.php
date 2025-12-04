<style>

/* ===== PRODUCTS PAGE (BAKER STYLE) ===== */

/* Page Wrapper */
.products-section {
    max-width: 1300px;
    margin: 50px auto;
    padding: 0 20px;
}

/* Title */
.products-title {
    text-align: center;
    font-size: 38px;
    font-weight: 700;
    margin-bottom: 40px;
    color: #4a3f35;
}

/* Product Grid */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 30px;
}

/* Product Card */
.product-card {
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: 0.3s;
    text-align: center;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.2);
}

/* Product Image */
.product-card img {
    width: 100%;
    height: 260px;         /* FIX HEIGHT TO MATCH ALL IMAGES */
    object-fit: cover;     /* Crop neatly */
}

/* Product Info */
.product-name {
    font-size: 20px;
    margin: 15px 0 5px;
    font-weight: bold;
}

.product-price {
    color: #8B4513;
    font-size: 18px;
    margin-bottom: 12px;
}

/* Button */
.product-btn {
    background-color: #6a4e39;
    color: white;
    padding: 10px 22px;
    border-radius: 30px;
    display: inline-block;
    margin-bottom: 15px;
    text-decoration: none;
    transition: 0.3s;
}

.product-btn:hover {
    background-color: #a06b45;
}

</style>


<div class="products-section">

    <h2 class="products-title">Our Products</h2>

    <div class="product-grid">

<?php
include("Processes/processConnectDB.php");
$query = "SELECT * FROM PRODUCT";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)):
?>

    <div class="product-card">
        <img src="images/productImages/<?php echo $row['ProductImage']; ?>" alt="bread">

        <div class="product-name"><?php echo $row['ProductName']; ?></div>
        <div class="product-price">$<?php echo number_format($row['UnitPrice'], 2); ?></div>

        <form action="Processes/processProductDetails.php" method="post">
           <input type="hidden" name="productNumber" value="<?php echo $row['ProductNumber']; ?>">
<button class="product-btn" type="submit" name="VIEWITEM">View Details</button>

        </form>

    </div>

<?php endwhile; ?>

</div> <!-- end product-grid -->
