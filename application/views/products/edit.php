<?php $this->load->view('templates/header'); ?>

<!-- Content Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Edit Produk</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('products') ?>">Produk</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Flash Messages -->
<?php $this->load->view('products/flash_messages'); ?>

<!-- Edit Form -->
<div class="card shadow-sm">
    <div class="card-body">
        <form action="<?= site_url('products/update/'.$product->id) ?>" method="post" class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?= htmlspecialchars($product->name) ?>" required>
            </div>
            
            <div class="col-md-6">
                <label for="price" class="form-label">Harga Produk</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" id="price" name="price" 
                           value="<?= $product->price ?>" required>
                </div>
            </div>
            
            <div class="col-md-6">
                <label for="stock" class="form-label">Jumlah Stok</label>
                <input type="number" class="form-control" id="stock" name="stock" 
                       value="<?= $product->stock ?>" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label d-block">&nbsp;</label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_sell" name="is_sell" 
                           value="1" <?= $product->is_sell ? 'checked' : '' ?>>
                    <label class="form-check-label" for="is_sell">Produk Dijual</label>
                </div>
            </div>
            
            <div class="col-12">
                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= site_url('products') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
