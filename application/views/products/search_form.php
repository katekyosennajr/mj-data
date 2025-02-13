<!-- Form Pencarian -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="<?= site_url('products') ?>" method="get" class="row g-3 align-items-center">
            <div class="col-md-8">
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
