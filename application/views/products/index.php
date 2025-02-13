<?php $this->load->view('templates/header'); ?>

<!-- Flash Messages -->
<?php $this->load->view('products/flash_messages'); ?>

<!-- Content Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Daftar Produk</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Produk</li>
            </ol>
        </nav>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
        <i class="fas fa-plus"></i> Tambah Produk
    </button>
</div>

<!-- Search Form -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="<?= site_url('products') ?>" method="get" class="row g-3 align-items-center">
            <div class="col-md-8 col-lg-6">
                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control" name="search" 
                           value="<?= $this->input->get('search') ?>" 
                           placeholder="Cari produk berdasarkan nama...">
                    <?php if($this->input->get('search')): ?>
                        <a href="<?= site_url('products') ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Products Table -->
<div class="card shadow-sm">
    <div class="card-body">
        <?php if(empty($products)): ?>
            <div class="text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" 
                     alt="No products" style="width: 120px; opacity: 0.5">
                <p class="text-muted mt-3">
                    <?= $this->input->get('search') ? 
                        'Tidak ada produk yang cocok dengan pencarian Anda.' : 
                        'Belum ada produk yang ditambahkan.' ?>
                </p>
                <?php if($this->input->get('search')): ?>
                    <a href="<?= site_url('products') ?>" class="btn btn-outline-primary mt-2">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Produk
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
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
                            <th class="text-end">Aksi</th>
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
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input toggle-status" 
                                           id="status_<?= $product->id ?>"
                                           data-product-id="<?= $product->id ?>"
                                           data-product-name="<?= htmlspecialchars($product->name) ?>"
                                           <?= $product->is_sell ? 'checked' : '' ?>>
                                    <label class="form-check-label status-label-<?= $product->id ?> <?= $product->is_sell ? 'text-primary' : 'text-secondary' ?>" 
                                           for="status_<?= $product->id ?>">
                                        <small><?= $product->is_sell ? 'Dijual' : 'Tidak Dijual' ?></small>
                                    </label>
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="<?= site_url('products/edit/'.$product->id) ?>" 
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

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= site_url('products/store') ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga Produk</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Jumlah Stok</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_sell" name="is_sell" value="1" checked>
                            <label class="form-check-label" for="is_sell">Produk Dijual</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
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

<?php $this->load->view('templates/footer'); ?>
