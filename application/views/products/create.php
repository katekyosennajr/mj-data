<!DOCTYPE html>
<html>
<head>
    <title>Add New Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Product</h2>
        
        <form action="<?php echo site_url('products/store'); ?>" method="post">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" class="form-control" step="0.01" required>
            </div>
            
            <div class="form-group">
                <label>Stock</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>
                    <input type="checkbox" name="is_sell" value="1" checked>
                    Available for Sale
                </label>
            </div>
            
            <button type="submit" class="btn btn-primary">Save Product</button>
            <a href="<?php echo site_url('products'); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
