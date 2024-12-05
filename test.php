<?php
// Initialize any required variables
$sizes = array("ALL", "XS", "S", "M", "L", "XL", "XXL");
$colors = array("ALL", "Black", "White", "Blue", "Red", "Green", "Yellow");
$brands = array("ALL", "Nike", "Adidas", "Zara", "H&M", "Uniqlo");
$itemTypes = array("ALL", "Shirts", "Pants", "Dresses", "Shoes", "Accessories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lookbook - Your Digital Closet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: black;
        }

        .logo {
            max-width: 150px;
        }

        .nav {
            float: right;
            margin-top: -40px;
        }

        .nav a {
            margin-left: 20px;
            text-decoration: none;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
            text-align: center;
        }

        .search-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin: 20px auto;
            max-width: 400px;
        }

        .form-group {
            margin: 15px 0;
            text-align: left;
        }

        .form-group label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
        }

        select {
            width: 200px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            border-top: 1px solid #eee;
            position: fixed;
            bottom: 0;
            width: 100%;
            background: white;
        }

        .footer-logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1>Search Your Closet</h1>
    <p>Find exactly what you're looking for with filters by color, size, brand, item type, and more!</p>

    <h3>Try it out!</h3>

    <div class="search-form">
        <form method="POST" action="">
            <div class="form-group">
                <label for="size">Size:</label>
                <select name="size" id="size">
                    <?php foreach($sizes as $size): ?>
                        <option value="<?php echo $size; ?>"><?php echo $size; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="color">Color:</label>
                <select name="color" id="color">
                    <?php foreach($colors as $color): ?>
                        <option value="<?php echo $color; ?>"><?php echo $color; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="brand">Brand:</label>
                <select name="brand" id="brand">
                    <?php foreach($brands as $brand): ?>
                        <option value="<?php echo $brand; ?>"><?php echo $brand; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="item_type">Item Type:</label>
                <select name="item_type" id="item_type">
                    <?php foreach($itemTypes as $type): ?>
                        <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>

    <p>Feel free to explore our interactive digital wardrobe, where you can add, edit, or delete clothing items to suit your needs!</p>
</div>

<div class="footer">
    <img src="path_to_logo.png" alt="Lookbook" class="footer-logo">
    <p>Your Closet, Organized Digitally.™</p>
    <p>&copy; 2024 Lookbook. All rights reserved.</p>
</div>
</body>
</html>