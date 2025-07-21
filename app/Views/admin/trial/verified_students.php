
<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<style>
/* Modern Minimalistic Design */
.admin-header {
    background: linear-gradient(135deg, #d4af37 0%, #000000 100%);
    color: white;
    padding: 2rem 0;
    margin-bottom: 2rem;
    border-radius: 12px;
}

.stat-card {
    background: #000000;
    color: #d4af37;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    border: 1px solid #d4af37;
    transition: all 0.3s ease;
    margin-bottom: 1rem;
}

.stat-card:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    color: #d4af37;
}

.stat-label {
    color: #d4af37;
    font-size: 0.875rem;
    font-weight: 500;
    margin-top: 0.25rem;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.icon-partial { background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%); }
.icon-full { background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); }

.action-buttons {
    background: #000000;
    color: #d4af37;
    padding: 1.5rem;
    border-radius: 16px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    margin-bottom: 1.5rem;
}

.btn-modern {
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 500;
    border: none;
    transition: all 0.3s ease;
}

.btn-modern-primary {
    background: linear-gradient(135deg, #d4af37 0%, #000000 100%);
    color: white;
}

.btn-modern-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    color: white;
}

.data-table {
    background: #000000;
    color: #d4af37;
    border-radius: 16px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.table-modern {
    margin: 0;
    border: none;
}

.table-modern thead th {
    background: #1a1a1a;
    border: none;
    padding: 1rem;
    font-weight: 600;
    color: #d4af37;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table-modern tbody td {
    padding: 1rem;
    border: none;
    border-bottom: 1px solid #d4af37;
    vertical-align: middle;
    color: #d4af37;
}

.table-modern tbody tr:hover {
    background-color: #1a1a1a;
}

.status-badge {
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-partial { background: #faf089; color: #975a16; }
.badge-full { background: #c6f6d5; color: #2f855a; }

.action-btn {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0 2px;
    transition: all 0.2s ease;
}

.action-btn:hover {
    transform: scale(1.05);
}

.payment-select {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.5rem;
    font-size: 0.75rem;
    background: white;
    color: black;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: white;
    margin: 0;
}

.breadcrumb-modern {
    background: rgba(255,255,255,0.1);
    border-radius: 20px;
    padding: 0.5rem 1rem;
}

.breadcrumb-modern a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}

.breadcrumb-modern .active {
    color: white;
}

.bulk-actions {
    background: #1a1a1a;
    padding: 1rem 1.5rem;
    border-top: 1px solid #e2e8f0;
}
</style>

<div class="container-fluid" style="background: #1a1a1a; min-height: 100vh; padding: 2rem 1rem;">
    <!-- Modern Header -->
    <div class="admin-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Verified Students Management</h1>
                    <p class="mb-0 opacity-75">Manage payment status for verified students</p>
                </div>
                <nav class="breadcrumb-modern">
                    <a href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
                    <span class="mx-2">/</span>
                    <a href="<?= base_url('admin/trial-registration') ?>">Trial Players</a>
                    <span class="mx-2">/</span>
                    <span class="active">Verified Students</span>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modern Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-6 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="stat-number"><?= count($partial_students ?? []) ?></h3>
                        <p class="stat-label">Partial Payment Students</p>
                    </div>
                    <div class="stat-icon icon-partial">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="stat-number"><?= count($full_students ?? []) ?></h3>
                        <p class="stat-label">Full Payment Students</p>
                    </div>
                    <div class="stat-icon icon-full">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-3">
                <button type="button" class="btn btn-modern btn-modern-primary" onclick="moveVerifiedStudents()">
                    <i class="fas fa-arrow-right me-2"></i>Move Verified Students from Trial Table
                </button>
                <a href="<?= base_url('admin/trial-registration') ?>" class="btn btn-modern btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Trial Registration
                </a>
            </div>
        </div>
    </div>

    <!-- Partial Payment Students -->
    <div class="data-table">
        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th colspan="8" style="background: #2d2d2d; text-align: center; font-size: 1.1rem;">
                            <i class="fas fa-clock me-2"></i>Partial Payment Students (₹199 Paid)
                        </th>
                    </tr>
                    <tr>
                        <th width="40"><input class="form-check-input" type="checkbox" id="selectAllPartial" /></th>
                        <th width="50">#</th>
                        <th>Student Details</th>
                        <th>Mobile</th>
                        <th>Cricket Type</th>
                        <th>Balance Due</th>
                        <th>Payment Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($partial_students)) : ?>
                        <?php $i = 1; ?>
                        <?php foreach ($partial_students as $student) : ?>
                            <tr>
                                <td><input type="checkbox" class="form-check-input student-checkbox-partial" value="<?= $student['id'] ?>" /></td>
                                <td><span class="text-muted"><?= $i++ ?></span></td>
                                <td>
                                    <div>
                                        <div class="fw-semibold"><?= esc($student['name']) ?></div>
                                        <small class="text-muted"><?= esc($student['email']) ?></small>
                                    </div>
                                </td>
                                <td><span class="fw-medium"><?= esc($student['mobile']) ?></span></td>
                                <td>
                                    <span class="status-badge badge-partial"><?= ucfirst(str_replace('-', ' ', esc($student['cricket_type']))) ?></span>
                                </td>
                                <td>
                                    <span class="fw-bold text-warning">₹<?= number_format($student['balance_amount'], 2) ?></span>
                                </td>
                                <td>
                                    <select class="payment-select payment-status-select"
                                        data-student-id="<?= $student['id'] ?>"
                                        data-current-status="<?= $student['payment_status'] ?>">
                                        <option value="partial" <?= $student['payment_status'] === 'partial' ? 'selected' : '' ?>>Partial Payment</option>
                                        <option value="full" <?= $student['payment_status'] === 'full' ? 'selected' : '' ?>>Full Payment</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button type="button" class="action-btn btn-success" onclick="markAsFullPayment(<?= $student['id'] ?>)" title="Mark as Full Payment">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button type="button" class="action-btn btn-info" onclick="viewStudentDetails(<?= $student['id'] ?>)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="fas fa-clock fa-3x mb-3 text-muted"></i>
                                <h5 class="text-muted">No partial payment students</h5>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Bulk Actions for Partial Payment -->
        <?php if (!empty($partial_students)) : ?>
        <div class="bulk-actions">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-success" onclick="bulkMarkAsFullPayment()" id="bulkFullPaymentBtn" disabled>
                        <i class="fas fa-check me-1"></i>Mark Selected as Full Payment
                    </button>
                </div>
                <small class="text-muted">Selected: <span id="selectedPartialCount">0</span> students</small>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Full Payment Students -->
    <div class="data-table">
        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th colspan="7" style="background: #2d2d2d; text-align: center; font-size: 1.1rem;">
                            <i class="fas fa-check-circle me-2"></i>Full Payment Students (Complete)
                        </th>
                    </tr>
                    <tr>
                        <th width="50">#</th>
                        <th>Student Details</th>
                        <th>Mobile</th>
                        <th>Cricket Type</th>
                        <th>Payment Status</th>
                        <th>Verified Date</th>
                        <th>T-Shirt Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($full_students)) : ?>
                        <?php $j = 1; ?>
                        <?php foreach ($full_students as $student) : ?>
                            <tr>
                                <td><span class="text-muted"><?= $j++ ?></span></td>
                                <td>
                                    <div>
                                        <div class="fw-semibold"><?= esc($student['name']) ?></div>
                                        <small class="text-muted"><?= esc($student['email']) ?></small>
                                    </div>
                                </td>
                                <td><span class="fw-medium"><?= esc($student['mobile']) ?></span></td>
                                <td>
                                    <span class="status-badge badge-full"><?= ucfirst(str_replace('-', ' ', esc($student['cricket_type']))) ?></span>
                                </td>
                                <td>
                                    <span class="status-badge badge-full">
                                        <i class="fas fa-check-circle me-1"></i>Full Payment
                                    </span>
                                </td>
                                <td>
                                    <small><?= date('d M Y', strtotime($student['verified_at'])) ?></small>
                                </td>
                                <td>
                                    <?php if ($student['t_shirt_given'] == 1): ?>
                                        <span class="badge bg-success">
                                            <i class="fas fa-tshirt me-1"></i>Given
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning">
                                            <i class="fas fa-exclamation-triangle me-1"></i>Pending
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="fas fa-check-circle fa-3x mb-3 text-muted"></i>
                                <h5 class="text-muted">No full payment students</h5>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    updateBulkButtons();
});

// Select All functionality for partial payment students
document.getElementById('selectAllPartial').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.student-checkbox-partial');
    checkboxes.forEach(cb => cb.checked = this.checked);
    updateBulkButtons();
});

// Individual checkbox change
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('student-checkbox-partial')) {
        updateBulkButtons();
    }

    // Handle payment status change
    if (e.target.classList.contains('payment-status-select')) {
        const studentId = e.target.dataset.studentId;
        const newStatus = e.target.value;
        const currentStatus = e.target.dataset.currentStatus;

        if (newStatus !== currentStatus) {
            updateStudentPaymentStatus(studentId, newStatus, e.target);
        }
    }
});

function updateBulkButtons() {
    const checkedBoxes = document.querySelectorAll('.student-checkbox-partial:checked');
    const count = checkedBoxes.length;

    document.getElementById('selectedPartialCount').textContent = count;
    
    const bulkBtn = document.getElementById('bulkFullPaymentBtn');
    if (bulkBtn) {
        bulkBtn.disabled = count === 0;
    }
}

function updateStudentPaymentStatus(studentId, newStatus, selectElement) {
    const formData = new FormData();
    formData.append('student_id', studentId);
    formData.append('payment_status', newStatus);

    // Disable select while updating
    selectElement.disabled = true;

    fetch('<?= base_url('admin/trial-registration/update-student-payment-status') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            selectElement.dataset.currentStatus = newStatus;
            alert('Payment status updated successfully');
            location.reload();
        } else {
            alert(data.message || 'Failed to update payment status');
            selectElement.value = selectElement.dataset.currentStatus;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating payment status');
        selectElement.value = selectElement.dataset.currentStatus;
    })
    .finally(() => {
        selectElement.disabled = false;
    });
}

function markAsFullPayment(studentId) {
    if (confirm('Mark this student as full payment?')) {
        updateStudentPaymentStatus(studentId, 'full', null);
    }
}

function bulkMarkAsFullPayment() {
    const checkedBoxes = document.querySelectorAll('.student-checkbox-partial:checked');

    if (checkedBoxes.length === 0) {
        alert('Please select at least one student');
        return;
    }

    if (confirm(`Mark ${checkedBoxes.length} selected students as full payment?`)) {
        const studentIds = Array.from(checkedBoxes).map(cb => cb.value);

        const formData = new FormData();
        formData.append('student_ids', JSON.stringify(studentIds));
        formData.append('payment_status', 'full');

        fetch('<?= base_url('admin/trial-registration/bulk-update-student-payment-status') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Updated ${studentIds.length} students successfully`);
                location.reload();
            } else {
                alert(data.message || 'Failed to update students');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred during update');
        });
    }
}

function moveVerifiedStudents() {
    if (confirm('Move all verified students (with partial/full payment) from trial table to verified students table?')) {
        fetch('<?= base_url('admin/trial-registration/move-verified-students') ?>', {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Moved ${data.moved} students successfully`);
                location.reload();
            } else {
                alert(data.message || 'Failed to move students');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred during move operation');
        });
    }
}

function viewStudentDetails(studentId) {
    // Implementation for viewing student details
    alert('Student details view will be implemented');
}
</script>

<?= $this->endSection() ?>
