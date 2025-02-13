            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script untuk konfirmasi hapus -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delete confirmation
            const deleteModal = document.getElementById('deleteModal');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const productId = button.getAttribute('data-product-id');
                    const productName = button.getAttribute('data-product-name');
                    
                    document.getElementById('deleteProductName').textContent = productName;
                    document.getElementById('deleteProductBtn').href = '<?= site_url('products/delete/') ?>' + productId;
                });
            }

            // Auto close alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });

            // Toggle status switches
            const toggleSwitches = document.querySelectorAll('.toggle-status');
            toggleSwitches.forEach(function(toggle) {
                toggle.addEventListener('change', function() {
                    const productId = this.getAttribute('data-product-id');
                    const productName = this.getAttribute('data-product-name');
                    const label = document.querySelector('.status-label-' + productId);
                    const originalChecked = this.checked;
                    
                    // Disable switch while processing
                    this.disabled = true;
                    
                    fetch('<?= site_url('products/toggle_status/') ?>' + productId)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update label
                                label.textContent = data.new_status ? 'Dijual' : 'Tidak Dijual';
                                label.className = 'form-check-label status-label-' + productId + 
                                                (data.new_status ? ' text-success' : ' text-danger');
                                
                                // Show success message
                                const alert = document.createElement('div');
                                alert.className = 'alert alert-success alert-dismissible fade show mb-4';
                                alert.innerHTML = `
                                    ${data.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                `;
                                document.querySelector('.content-header').after(alert);
                                
                                // Auto close alert
                                setTimeout(() => {
                                    const bsAlert = new bootstrap.Alert(alert);
                                    bsAlert.close();
                                }, 5000);
                            } else {
                                // Revert switch if failed
                                this.checked = !originalChecked;
                                
                                // Show error message
                                const alert = document.createElement('div');
                                alert.className = 'alert alert-danger alert-dismissible fade show mb-4';
                                alert.innerHTML = `
                                    ${data.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                `;
                                document.querySelector('.content-header').after(alert);
                                
                                // Auto close alert
                                setTimeout(() => {
                                    const bsAlert = new bootstrap.Alert(alert);
                                    bsAlert.close();
                                }, 5000);
                            }
                        })
                        .catch(error => {
                            // Revert switch if error
                            this.checked = !originalChecked;
                            console.error('Error:', error);
                        })
                        .finally(() => {
                            // Re-enable switch
                            this.disabled = false;
                        });
                });
            });
        });
    </script>
</body>
</html>
