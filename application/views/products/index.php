<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Product List</h2>
        <a href="<?php echo site_url('products/create'); ?>" class="btn btn-primary mb-3">Add New Product</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                <tr>
                    <td><?php echo $product->id; ?></td>
                    <td><?php echo $product->name; ?></td>
                    <td><?php echo number_format($product->price, 2); ?></td>
                    <td><?php echo $product->stock; ?></td>
                    <td><?php echo $product->is_sell ? 'For Sale' : 'Not For Sale'; ?></td>
                    <td>
                        <a href="<?php echo site_url('products/edit/'.$product->id); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?php echo site_url('products/delete/'.$product->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
