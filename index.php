<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>
<?php

use Aries\MiniFrameworkStore\Models\Product;

$products = new Product();

$amounLocale = 'en_PH';
$pesoFormatter = new NumberFormatter($amounLocale, NumberFormatter::CURRENCY);

?>

<style>
  /* Premium dark gradient background */
  body {
    background: linear-gradient(135deg, #1f1c2c, #928dab);
    color: #f5f5f7;
    font-family: 'Montserrat', sans-serif;
  }
  .container {
    max-width: 1140px;
  }
  h1, h2 {
    font-family: 'Lora', serif;
    text-shadow: 0 1px 4px rgba(0,0,0,0.7);
  }
  .fade-in-section {
    padding: 40px 15px;
    background-color: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.6);
  }
  .card {
    background: rgba(255, 255, 255, 0.12);
    border: none;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.4);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.8);
  }
  .card-img-top {
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    max-height: 200px;
    object-fit: cover;
  }
  .card-title {
    font-weight: 700;
    font-size: 1.25rem;
  }
  .card-subtitle {
    font-weight: 600;
    font-size: 1.1rem;
    color: #00d97e !important; /* premium green */
    text-shadow: 0 0 3px #00d97e99;
  }
  .card-text {
    font-size: 0.95rem;
    color: #ddd;
  }
  .btn-primary {
    background: linear-gradient(45deg, #4caf50, #087f23);
    border: none;
    font-weight: 600;
    transition: background 0.3s ease;
  }
  .btn-primary:hover {
    background: linear-gradient(45deg, #087f23, #4caf50);
  }
  .btn-success {
    background: linear-gradient(45deg, #00b894, #00876c);
    border: none;
    font-weight: 600;
  }
  .btn-success:hover {
    background: linear-gradient(45deg, #00876c, #00b894);
  }
  .text-primary {
    color: #4caf50 !important;
  }
  .lead {
    color: #ccc;
  }
</style>

<div class="container my-5 fade-in-section">
    <div class="row align-items-center mb-4">
        <div class="col-md-12">
            <h1 class="text-center display-4 fw-bold mb-3">Welcome to the Ababan Store</h1>
            <p class="text-center lead">Everything you need is right here</p>
        </div>
    </div>
    <div class="row">
        <h2 class="mb-4 fw-semibold text-primary">Products</h2>
        <?php foreach($products->getAll() as $product): ?>
        <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex align-items-stretch">
            <div class="card w-100 animate-card">
                <img src="<?php echo $product['image_path'] ?>" class="card-img-top" alt="Product Image">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mb-2"><?php echo $product['name'] ?></h5>
                    <h6 class="card-subtitle mb-2"><?php echo $formattedAmount = $pesoFormatter->formatCurrency($product['price'], 'PHP') ?></h6>
                    <p class="card-text flex-grow-1"><?php echo $product['description'] ?></p>
                    <div class="mt-3 d-flex gap-2">
                        <a href="product.php?id=<?php echo $product['id'] ?>" class="btn btn-primary flex-fill">View Product</a>
                        <a href="#" class="btn btn-success add-to-cart flex-fill" data-productid="<?php echo $product['id'] ?>" data-quantity="1">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php template('footer.php'); ?>
