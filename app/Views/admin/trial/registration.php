
<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Manage Trial Registrations</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Trial Registrations</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="<?= base_url('admin/trial-registration/verification') ?>" class="btn btn-primary">
                        <i class="fas fa-user-check me-2"></i>Verify Players
                    </a>
                </div>
                <div>
                    <a href="<?= site_url('admin/trial-registration/export-pdf') ?>" class="btn btn-success">
                        <i class="fas fa-file-pdf me-2"></i>Export to PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="playerForm" method="post" action="<?= site_url('admin/trial-registration/bulk-action') ?>">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th><input class="form-check-input" type="checkbox" id="selectAll" /></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>City</th>
                                        <th>Cricket Type</th>
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <th>Verification</th>
                                        <th>Registered On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($registrations)) : ?>
                                        <?php
                                        $currentPage = $pager->getCurrentPage() ?? 1;
                                        $perPage = $pager->getPerPage() ?? 10;
                                        $i = 1 + ($currentPage - 1) * $perPage;
                                        ?>
                                        <?php foreach ($registrations as $reg) : ?>
                                            <tr>
                                                <td><input type="checkbox" class="form-check-input" name="ids[]" value="<?= $reg['id'] ?>" /></td>
                                                <td><?= $i++ ?></td>
                                                <td><?= esc($reg['name']) ?></td>
                                                <td><?= esc($reg['mobile']) ?></td>
                                                <td><?= esc($reg['email']) ?></td>
                                                <td><?= esc($reg['city']) ?></td>
                                                <td>
                                                    <span class="badge bg-info"><?= ucfirst(esc($reg['cricket_type'])) ?></span>
                                                </td>
                                                <td>
                                                    <select name="payment_type[<?= $reg['id'] ?>]" class="form-select form-select-sm" onchange="updateSingle(<?= $reg['id'] ?>)">
                                                        <option value="partial" <?= ($reg['payment_type'] ?? 'partial') === 'partial' ? 'selected' : '' ?>>₹199 T-Shirt Only</option>
                                                        <option value="full" <?= ($reg['payment_type'] ?? 'partial') === 'full' ? 'selected' : '' ?>>Full Payment</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="payment_status[<?= $reg['id'] ?>]" class="form-select form-select-sm" onchange="updateSingle(<?= $reg['id'] ?>)">
                                                        <option value="pending" <?= ($reg['payment_status'] ?? 'pending') === 'pending' ? 'selected' : '' ?>>Pending</option>
                                                        <option value="partial" <?= ($reg['payment_status'] ?? 'pending') === 'partial' ? 'selected' : '' ?>>Partial Paid</option>
                                                        <option value="full" <?= ($reg['payment_status'] ?? 'pending') === 'full' ? 'selected' : '' ?>>Fully Paid</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <?php if (($reg['is_verified'] ?? 0) == 1): ?>
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check-circle"></i> Verified
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning">
                                                            <i class="fas fa-clock"></i> Pending
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= date('d M Y', strtotime($reg['created_at'] ?? '')) ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-primary" onclick="verifyPlayer('<?= $reg['mobile'] ?>')">
                                                            <i class="fas fa-user-check"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="deletePlayer(<?= $reg['id'] ?>)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="12" class="text-center">No registrations found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Bulk Actions -->
                        <div class="mt-3 d-flex gap-2 align-items-center">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-warning" onclick="bulkUpdatePayment()">
                                    <i class="fas fa-credit-card me-2"></i>Update Payment Status
                                </button>
                                <button type="button" class="btn btn-danger" onclick="bulkDelete()">
                                    <i class="fas fa-trash me-2"></i>Delete Selected
                                </button>
                            </div>
                            
                            <div class="d-flex gap-2 ms-auto">
                                <select id="bulkPaymentType" class="form-select">
                                    <option value="">Select Payment Type</option>
                                    <option value="partial">₹199 T-Shirt Only</option>
                                    <option value="full">Full Payment</option>
                                </select>
                                <select id="bulkPaymentStatus" class="form-select">
                                    <option value="">Select Payment Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="partial">Partial Paid</option>
                                    <option value="full">Fully Paid</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center mt-4">
                        <?= $pager->links() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Select All checkbox functionality
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('input[name="ids[]"]');
    checkboxes.forEach(cb => cb.checked = this.checked);
});

// Update single player payment status
function updateSingle(playerId) {
    const paymentType = document.querySelector(`select[name="payment_type[${playerId}]"]`).value;
    const paymentStatus = document.querySelector(`select[name="payment_status[${playerId}]"]`).value;
    
    const formData = new FormData();
    formData.append('player_id', playerId);
    formData.append('payment_type', paymentType);
    formData.append('payment_status', paymentStatus);
    
    fetch('<?= base_url('admin/trial-registration/update-single') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            notyf.success('Payment status updated successfully');
        } else {
            notyf.error(data.message || 'Failed to update payment status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        notyf.error('An error occurred while updating');
    });
}

// Bulk update payment status
function bulkUpdatePayment() {
    const checkedBoxes = document.querySelectorAll('input[name="ids[]"]:checked');
    const paymentType = document.getElementById('bulkPaymentType').value;
    const paymentStatus = document.getElementById('bulkPaymentStatus').value;
    
    if (checkedBoxes.length === 0) {
        notyf.error('Please select at least one player');
        return;
    }
    
    if (!paymentType && !paymentStatus) {
        notyf.error('Please select payment type or status to update');
        return;
    }
    
    const playerIds = Array.from(checkedBoxes).map(cb => cb.value);
    
    const formData = new FormData();
    formData.append('player_ids', JSON.stringify(playerIds));
    formData.append('payment_type', paymentType);
    formData.append('payment_status', paymentStatus);
    
    fetch('<?= base_url('admin/trial-registration/bulk-update') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            notyf.success(`Updated ${playerIds.length} players successfully`);
            location.reload();
        } else {
            notyf.error(data.message || 'Failed to update players');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        notyf.error('An error occurred during bulk update');
    });
}

// Bulk delete players
function bulkDelete() {
    const checkedBoxes = document.querySelectorAll('input[name="ids[]"]:checked');
    
    if (checkedBoxes.length === 0) {
        notyf.error('Please select at least one player to delete');
        return;
    }
    
    if (confirm(`Are you sure you want to delete ${checkedBoxes.length} selected players?`)) {
        const playerIds = Array.from(checkedBoxes).map(cb => cb.value);
        
        const formData = new FormData();
        formData.append('player_ids', JSON.stringify(playerIds));
        
        fetch('<?= base_url('admin/trial-registration/bulk-delete') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                notyf.success(`Deleted ${playerIds.length} players successfully`);
                location.reload();
            } else {
                notyf.error(data.message || 'Failed to delete players');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            notyf.error('An error occurred during deletion');
        });
    }
}

// Verify single player
function verifyPlayer(mobile) {
    window.open(`<?= base_url('admin/trial-registration/verification') ?>?mobile=${mobile}`, '_blank');
}

// Delete single player
function deletePlayer(playerId) {
    if (confirm('Are you sure you want to delete this player?')) {
        const formData = new FormData();
        formData.append('player_ids', JSON.stringify([playerId]));
        
        fetch('<?= base_url('admin/trial-registration/bulk-delete') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                notyf.success('Player deleted successfully');
                location.reload();
            } else {
                notyf.error(data.message || 'Failed to delete player');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            notyf.error('An error occurred during deletion');
        });
    }
}
</script>

<?= $this->endSection() ?>
