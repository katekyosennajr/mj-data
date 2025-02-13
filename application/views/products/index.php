<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .table th { 
            background-color: #f8f9fa;
        }
        .status-badge {
            width: 100px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Daftar Produk</h2>
            <a href="<?php echo site_url('products/create'); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>

        <!-- Include Form Pencarian -->
        <?php $this->load->view('products/search_form'); ?>

        <!-- Tabel Produk -->
        <div class="card shadow-sm">
            <div class="card-body">
                <?php if(empty($products)): ?>
                    <div class="text-center py-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" 
                             alt="No products" style="width: 100px; opacity: 0.5">
                        <p class="text-muted mt-3">
                            <?= $this->input->get('search') ? 
                                'Tidak ada produk yang cocok dengan pencarian Anda.' : 
                                'Belum ada produk yang ditambahkan.' ?>
                        </p>
                    </div>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>
                                    <a href="<?= site_url('products?' . http_build_query(array_merge($_GET, [
                                        'sort_by' => 'name',
                                        'sort_order' => ($sort_by === 'name' && $sort_order === 'asc') ? 'desc' : 'asc'
                                    ]))) ?>" class="text-dark text-decoration-none">
                                        Nama Produk
                                        <?php if($sort_by === 'name'): ?>
                                            <i class="fas fa-sort-<?= $sort_order === 'asc' ? 'up' : 'down' ?>"></i>
                                        <?php else: ?>
                                            <i class="fas fa-sort text-muted"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th>
                                    <a href="<?= site_url('products?' . http_build_query(array_merge($_GET, [
                                        'sort_by' => 'price',
                                        'sort_order' => ($sort_by === 'price' && $sort_order === 'asc') ? 'desc' : 'asc'
                                    ]))) ?>" class="text-dark text-decoration-none">
                                        Harga
                                        <?php if($sort_by === 'price'): ?>
                                            <i class="fas fa-sort-<?= $sort_order === 'asc' ? 'up' : 'down' ?>"></i>
                                        <?php else: ?>
                                            <i class="fas fa-sort text-muted"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th>
                                    <a href="<?= site_url('products?' . http_build_query(array_merge($_GET, [
                                        'sort_by' => 'stock',
                                        'sort_order' => ($sort_by === 'stock' && $sort_order === 'asc') ? 'desc' : 'asc'
                                    ]))) ?>" class="text-dark text-decoration-none">
                                        Stok
                                        <?php if($sort_by === 'stock'): ?>
                                            <i class="fas fa-sort-<?= $sort_order === 'asc' ? 'up' : 'down' ?>"></i>
                                        <?php else: ?>
                                            <i class="fas fa-sort text-muted"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($products as $product): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($product->name) ?></td>
                                <td>Rp <?= number_format($product->price, 0, ',', '.') ?></td>
                                <td><?= $product->stock ?></td>
                                <td>
                                    <span class="badge <?= $product->is_sell ? 'bg-success' : 'bg-danger' ?> status-badge">
                                        <?= $product->is_sell ? 'For Sale' : 'Not For Sale' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo site_url('products/edit/'.$product->id); ?>" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal"
                                                data-product-id="<?= $product->id ?>"
                                                data-product-name="<?= htmlspecialchars($product->name) ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus produk "<span id="deleteProductName"></span>"?</p>
                    <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="#" id="deleteProductBtn" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script untuk modal konfirmasi hapus -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteModal = document.getElementById('deleteModal');
            const deleteProductName = document.getElementById('deleteProductName');
            const deleteProductBtn = document.getElementById('deleteProductBtn');

            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const productId = button.getAttribute('data-product-id');
                const productName = button.getAttribute('data-product-name');
                
                deleteProductName.textContent = productName;
                deleteProductBtn.href = '<?= site_url('products/delete/') ?>' + productId;
            });
        });
    </script>
</body>
</html>
