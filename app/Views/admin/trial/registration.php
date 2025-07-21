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
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        border: 1px solid #d4af37;
        transition: all 0.3s ease;
        margin-bottom: 1rem;
    }

    .stat-card:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
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

    .icon-primary {
        background: linear-gradient(135deg, #d4af37 0%, #000000 100%);
    }

    .icon-success {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    }

    .icon-warning {
        background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
    }

    .icon-info {
        background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
    }

    .action-buttons {
        background: #000000;
        color: #d4af37;
        padding: 1.5rem;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
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
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        overflow: hidden;
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

    .badge-no-payment {
        background: #fed7d7;
        color: #c53030;
    }

    .badge-partial {
        background: #faf089;
        color: #975a16;
    }

    .badge-full {
        background: #c6f6d5;
        color: #2f855a;
    }

    .badge-verified {
        background: #bee3f8;
        color: #2b6cb0;
    }

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
        margin-top: 0.5rem;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #a0aec0;
    }

    .bulk-actions {
        background: #1a1a1a;
        padding: 1rem 1.5rem;
        border-top: 1px solid #e2e8f0;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        margin: 0;
    }

    .breadcrumb-modern {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 0.5rem 1rem;
    }

    .breadcrumb-modern a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
    }

    .breadcrumb-modern .active {
        color: white;
    }
</style>

<div class="container-fluid" style="background: #1a1a1a; min-height: 100vh; padding: 2rem 1rem;">
    <!-- Modern Header -->
    <div class="admin-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Trial Player Management</h1>
                    <p class="mb-0 opacity-75">Manage and track trial registrations</p>
                </div>
                <nav class="breadcrumb-modern">
                    <a href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
                    <span class="mx-2">/</span>
                    <span class="active">Trial Players</span>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modern Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="stat-number"><?= count($registrations ?? []) ?></h3>
                        <p class="stat-label">Total Players</p>
                    </div>
                    <div class="stat-icon icon-primary">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="stat-number" id="verifiedCount">0</h3>
                        <p class="stat-label">Verified Players</p>
                    </div>
                    <div class="stat-icon icon-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="stat-number" id="pendingCount">0</h3>
                        <p class="stat-label">Pending Verification</p>
                    </div>
                    <div class="stat-icon icon-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="stat-number">₹<span id="totalCollection">0</span></h3>
                        <p class="stat-label">Ground Collection</p>
                    </div>
                    <div class="stat-icon icon-info">
                        <i class="fas fa-rupee-sign"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-3">
                <a href="<?= base_url('admin/trial-registration/verification') ?>" class="btn btn-modern btn-modern-primary">
                    <i class="fas fa-user-check me-2"></i>Player Verification
                </a>
                <button type="button" class="btn btn-modern btn-outline-success" onclick="showCollectionReport()">
                    <i class="fas fa-chart-bar me-2"></i>Collection Report
                </button>
            </div>
            <div>
                <a href="<?= site_url('admin/trial-registration/export-pdf') ?>" class="btn btn-modern btn-outline-secondary">
                    <i class="fas fa-file-pdf me-2"></i>Export PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Players Table -->
    <div class="data-table">
        <div class="table-responsive">
            <table class="table table-modern" id="playersTable">
                <thead>
                    <tr>
                        <th width="40"><input class="form-check-input" type="checkbox" id="selectAll" /></th>
                        <th width="50">#</th>
                        <th>Player Details</th>
                        <th>Mobile</th>
                        <th>Cricket Type</th>
                        <th>City</th>
                        <th>Status</th>
                        <th width="150">Actions</th>
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
                                <td><input type="checkbox" class="form-check-input player-checkbox" value="<?= $reg['id'] ?>" /></td>
                                <td><span class="text-muted"><?= $i++ ?></span></td>
                                <td>
                                    <div>
                                        <div class="fw-semibold"><?= esc($reg['name']) ?></div>
                                        <small class="text-muted"><?= esc($reg['email']) ?></small>
                                    </div>
                                </td>
                                <td><span class="fw-medium"><?= esc($reg['mobile']) ?></span></td>
                                <td>
                                    <span class="status-badge badge-verified"><?= ucfirst(str_replace('-', ' ', esc($reg['cricket_type']))) ?></span>
                                </td>
                                <td><span class="text-muted"><?= esc($reg['city']) ?></span></td>
                                <td>
                                    <?php
                                    $isVerified = ($reg['is_verified'] ?? 0) == 1;
                                    $paymentStatus = $reg['payment_status'] ?? 'no_payment';
                                    $fees = getCricketTypeFees($reg['cricket_type']);
                                    ?>

                                    <div class="d-flex flex-column gap-1">
                                        <!-- Payment Status Badge -->
                                        <?php if ($paymentStatus === 'no_payment'): ?>
                                            <span class="status-badge badge-no-payment">
                                                <i class="fas fa-times-circle me-1"></i>No Payment
                                            </span>
                                        <?php elseif ($paymentStatus === 'partial'): ?>
                                            <span class="status-badge badge-partial">
                                                <i class="fas fa-clock me-1"></i>Partial ₹199
                                            </span>
                                            <small class="text-info">Balance: ₹<?= $fees - 199 ?></small>
                                        <?php elseif ($paymentStatus === 'full'): ?>
                                            <span class="status-badge badge-full">
                                                <i class="fas fa-check-circle me-1"></i>Full Payment
                                            </span>
                                        <?php endif; ?>

                                        <!-- Verification Status -->
                                        <?php if ($isVerified): ?>
                                            <small class="text-success">
                                                <i class="fas fa-user-check me-1"></i>Verified
                                                <?php if (($reg['t_shirt_given'] ?? 0) == 1): ?>
                                                    <i class="fas fa-tshirt ms-2"></i>T-Shirt Given
                                                <?php endif; ?>
                                            </small>
                                        <?php else: ?>
                                            <small class="text-muted">
                                                <i class="fas fa-user-clock me-1"></i>Not Verified
                                            </small>
                                        <?php endif; ?>

                                        <!-- Payment Status Dropdown -->
                                        <select class="payment-select payment-status-select"
                                            data-player-id="<?= $reg['id'] ?>"
                                            data-current-status="<?= $paymentStatus ?>">
                                            <option value="no_payment" <?= $paymentStatus === 'no_payment' ? 'selected' : '' ?>>No Payment</option>
                                            <option value="partial" <?= $paymentStatus === 'partial' ? 'selected' : '' ?>>Partial ₹199</option>
                                            <option value="full" <?= $paymentStatus === 'full' ? 'selected' : '' ?>>Full Payment</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <?php if (!$isVerified): ?>
                                            <button type="button" class="action-btn btn-primary" onclick="verifyPlayer('<?= $reg['mobile'] ?>')" title="Verify Player">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        <?php else: ?>
                                            <button type="button" class="action-btn btn-success" disabled title="Already Verified">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        <?php endif; ?>
                                        <button type="button" class="action-btn btn-info" onclick="viewPlayerDetails(<?= $reg['id'] ?>)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="action-btn btn-danger" onclick="deletePlayer(<?= $reg['id'] ?>)" title="Delete Player">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8" class="empty-state">
                                <i class="fas fa-users fa-3x mb-3 text-muted"></i>
                                <h5 class="text-muted">No players registered yet</h5>
                                <p class="text-muted">Players will appear here once they complete registration</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Bulk Actions -->
        <div class="bulk-actions">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-danger" onclick="bulkDelete()" id="bulkDeleteBtn" disabled>
                        <i class="fas fa-trash me-1"></i>Delete Selected
                    </button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="bulkMarkPending()" id="bulkPendingBtn" disabled>
                        <i class="fas fa-undo me-1"></i>Mark as Pending
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="bulkStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                            <i class="fas fa-edit"></i> Bulk Status Update
                        </button>
                        <ul class="dropdown-menu" style="background: var(--secondary-black); border: 1px solid var(--border-color);">
                            <li><a class="dropdown-item text-light" href="#" onclick="bulkUpdatePaymentStatus('no_payment')">
                                    <i class="fas fa-times-circle text-danger"></i> No Payment
                                </a></li>
                            <li><a class="dropdown-item text-light" href="#" onclick="bulkUpdatePaymentStatus('partial')">
                                    <i class="fas fa-clock text-warning"></i> Partial Payment (₹199)
                                </a></li>
                            <li><a class="dropdown-item text-light" href="#" onclick="bulkUpdatePaymentStatus('full')">
                                    <i class="fas fa-check-circle text-success"></i> Full Payment
                                </a></li>
                            <li>
                                <hr class="dropdown-divider" style="border-color: var(--border-color);">
                            </li>
                            <li><a class="dropdown-item text-light" href="#" onclick="bulkUpdateVerification('verified')">
                                    <i class="fas fa-user-check text-success"></i> Mark as Verified
                                </a></li>
                            <li><a class="dropdown-item text-light" href="#" onclick="bulkUpdateVerification('unverified')">
                                    <i class="fas fa-user-times text-danger"></i> Mark as Unverified
                                </a></li>
                        </ul>
                    </div>
                </div>
                <small class="text-muted">Selected: <span id="selectedCount">0</span> players</small>
            </div>
        </div>

        <!-- Pagination -->
        <?php if (!empty($registrations)): ?>
            <div class="d-flex justify-content-center p-3 border-top">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Collection Report Modal -->
<div class="modal fade" id="collectionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ground Collection Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="collectionReport">
                    <!-- Collection report will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Player Details Modal -->
<div class="modal fade" id="playerDetailsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Player Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="playerDetailsContent">
                    <!-- Player details will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Get cricket type fees
    function getCricketTypeFees(cricketType) {
        const fees = {
            'bowler': 999,
            'batsman': 999,
            'wicket-keeper': 1199,
            'all-rounder': 1199
        };
        return fees[cricketType] || 999;
    }

    // Update stats on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateStats();
        updateBulkButtons();
    });

    // Select All checkbox functionality
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.player-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateBulkButtons();
    });

    // Individual checkbox change
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('player-checkbox')) {
            updateBulkButtons();
        }

        // Handle payment status change
        if (e.target.classList.contains('payment-status-select')) {
            const playerId = e.target.dataset.playerId;
            const newStatus = e.target.value;
            const currentStatus = e.target.dataset.currentStatus;

            if (newStatus !== currentStatus) {
                updatePaymentStatus(playerId, newStatus, e.target);
            }
        }
    });

    function updateStats() {
        const rows = document.querySelectorAll('#playersTable tbody tr');
        let verified = 0;
        let pending = 0;
        let totalCollection = 0;

        rows.forEach(row => {
            const statusCell = row.cells[6];
            if (statusCell && statusCell.innerHTML.includes('Verified')) {
                verified++;
                // Add collection amount based on cricket type
                const cricketTypeCell = row.cells[4];
                if (cricketTypeCell) {
                    const cricketType = cricketTypeCell.textContent.toLowerCase().trim();
                    totalCollection += getCricketTypeFees(cricketType);
                }
            } else if (statusCell && statusCell.innerHTML.includes('Pending')) {
                pending++;
            }
        });

        document.getElementById('verifiedCount').textContent = verified;
        document.getElementById('pendingCount').textContent = pending;
        document.getElementById('totalCollection').textContent = totalCollection.toLocaleString();
    }

    function updateBulkButtons() {
        const checkedBoxes = document.querySelectorAll('.player-checkbox:checked');
        const count = checkedBoxes.length;

        document.getElementById('selectedCount').textContent = count;
        document.getElementById('bulkDeleteBtn').disabled = count === 0;
        document.getElementById('bulkPendingBtn').disabled = count === 0;
        document.getElementById('bulkStatusDropdown').disabled = count === 0;
    }

    // Verify single player
    function verifyPlayer(mobile) {
        window.open(`<?= base_url('admin/trial-registration/verification') ?>?mobile=${mobile}`, '_blank');
    }

    // View player details
    function viewPlayerDetails(playerId) {
        // Implementation for viewing player details
        const modal = new bootstrap.Modal(document.getElementById('playerDetailsModal'));
        modal.show();
    }

    // Show collection report
    function showCollectionReport() {
        const modal = new bootstrap.Modal(document.getElementById('collectionModal'));

        // Generate collection report
        const report = generateCollectionReport();
        document.getElementById('collectionReport').innerHTML = report;

        modal.show();
    }

    function generateCollectionReport() {
        const rows = document.querySelectorAll('#playersTable tbody tr');
        let totalCollected = 0;
        let verifiedPlayers = [];

        rows.forEach(row => {
            const statusCell = row.cells[6];
            if (statusCell && statusCell.innerHTML.includes('Verified')) {
                const name = row.cells[2].querySelector('.fw-bold').textContent;
                const mobile = row.cells[3].textContent;
                const cricketType = row.cells[4].textContent.trim();
                const fees = getCricketTypeFees(cricketType.toLowerCase());

                verifiedPlayers.push({
                    name: name,
                    mobile: mobile,
                    cricketType: cricketType,
                    fees: fees
                });
                totalCollected += fees;
            }
        });

        let html = `
        <div class="alert alert-success">
            <h6><i class="fas fa-rupee-sign"></i> Total Ground Collection: ₹${totalCollected.toLocaleString()}</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Player Name</th>
                        <th>Mobile</th>
                        <th>Cricket Type</th>
                        <th>Fees Collected</th>
                    </tr>
                </thead>
                <tbody>
    `;

        verifiedPlayers.forEach(player => {
            html += `
            <tr>
                <td>${player.name}</td>
                <td>${player.mobile}</td>
                <td>${player.cricketType}</td>
                <td>₹${player.fees}</td>
            </tr>
        `;
        });

        html += `
                </tbody>
            </table>
        </div>
    `;

        return html;
    }

    // Bulk delete players
    function bulkDelete() {
        const checkedBoxes = document.querySelectorAll('.player-checkbox:checked');

        if (checkedBoxes.length === 0) {
            alert('Please select at least one player to delete');
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
                        alert(`Deleted ${playerIds.length} players successfully`);
                        location.reload();
                    } else {
                        alert(data.message || 'Failed to delete players');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred during deletion');
                });
        }
    }

    // Mark as pending
    function bulkMarkPending() {
        const checkedBoxes = document.querySelectorAll('.player-checkbox:checked');

        if (checkedBoxes.length === 0) {
            alert('Please select at least one player');
            return;
        }

        if (confirm(`Mark ${checkedBoxes.length} selected players as pending verification?`)) {
            const playerIds = Array.from(checkedBoxes).map(cb => cb.value);

            const formData = new FormData();
            formData.append('player_ids', JSON.stringify(playerIds));
            formData.append('action', 'mark_pending');

            fetch('<?= base_url('admin/trial-registration/bulk-update-status') ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Updated ${playerIds.length} players successfully`);
                        location.reload();
                    } else {
                        alert(data.message || 'Failed to update players');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred during update');
                });
        }
    }

    function bulkUpdatePaymentStatus(paymentStatus) {
        const checkedBoxes = document.querySelectorAll('.player-checkbox:checked');

        if (checkedBoxes.length === 0) {
            alert('Please select at least one player');
            return;
        }

        if (confirm(`Update payment status to ${paymentStatus} for ${checkedBoxes.length} selected players?`)) {
            const playerIds = Array.from(checkedBoxes).map(cb => cb.value);

            const formData = new FormData();
            formData.append('player_ids', JSON.stringify(playerIds));
            formData.append('payment_status', paymentStatus);

            fetch('<?= base_url('admin/trial-registration/bulk-update-payment-status') ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Updated ${playerIds.length} players successfully`);
                        location.reload();
                    } else {
                        alert(data.message || 'Failed to update players');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred during update');
                });
        }
    }

    function bulkUpdateVerification(verificationStatus) {
        const checkedBoxes = document.querySelectorAll('.player-checkbox:checked');

        if (checkedBoxes.length === 0) {
            alert('Please select at least one player');
            return;
        }

        const isVerified = verificationStatus === 'verified' ? 1 : 0;
        const message = verificationStatus === 'verified' ? 'Mark as Verified' : 'Mark as Unverified';

        if (confirm(`${message} for ${checkedBoxes.length} selected players?`)) {
            const playerIds = Array.from(checkedBoxes).map(cb => cb.value);

            const formData = new FormData();
            formData.append('player_ids', JSON.stringify(playerIds));
            formData.append('is_verified', isVerified);

            fetch('<?= base_url('admin/trial-registration/bulk-update-verification') ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Updated ${playerIds.length} players successfully`);
                        location.reload();
                    } else {
                        alert(data.message || 'Failed to update players');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred during update');
                });
        }
    }

    // Delete single player
    function updatePaymentStatus(playerId, newStatus, selectElement) {
        const formData = new FormData();
        formData.append('player_id', playerId);
        formData.append('payment_status', newStatus);
        formData.append('payment_type', newStatus === 'no_payment' ? 'none' : newStatus);

        // Disable select while updating
        selectElement.disabled = true;

        fetch('<?= base_url('admin/trial-registration/update-payment-status') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update current status
                    selectElement.dataset.currentStatus = newStatus;
                    // Reload page to reflect changes
                    location.reload();
                } else {
                    alert(data.message || 'Failed to update payment status');
                    // Revert select to previous value
                    selectElement.value = selectElement.dataset.currentStatus;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating payment status');
                // Revert select to previous value
                selectElement.value = selectElement.dataset.currentStatus;
            })
            .finally(() => {
                selectElement.disabled = false;
            });
    }

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
                        alert('Player deleted successfully');
                        location.reload();
                    } else {
                        alert(data.message || 'Failed to delete player');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred during deletion');
                });
        }
    }

    <?php
    function getCricketTypeFees($cricketType)
    {
        $fees = [
            'bowler' => 999,
            'batsman' => 999,
            'wicket-keeper' => 1199,
            'all-rounder' => 1199
        ];
        return $fees[$cricketType] ?? 999;
    }
    ?>
</script>

<?= $this->endSection() ?>
