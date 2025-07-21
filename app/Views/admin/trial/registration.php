<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Trial Player Management</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Trial Players</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-1 text-white"><?= count($registrations ?? []) ?></h4>
                            <p class="mb-0">Total Players</p>
                        </div>
                        <div>
                            <i class="fas fa-users fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-1 text-white" id="verifiedCount">0</h4>
                            <p class="mb-0">Verified Players</p>
                        </div>
                        <div>
                            <i class="fas fa-check-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-1 text-white" id="pendingCount">0</h4>
                            <p class="mb-0">Pending Verification</p>
                        </div>
                        <div>
                            <i class="fas fa-clock fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-1 text-white">₹<span id="totalCollection">0</span></h4>
                            <p class="mb-0">Ground Collection</p>
                        </div>
                        <div>
                            <i class="fas fa-rupee-sign fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2">
                    <a href="<?= base_url('admin/trial-registration/verification') ?>" class="btn btn-primary">
                        <i class="fas fa-user-check me-2"></i>Player Verification
                    </a>
                    <button type="button" class="btn btn-success" onclick="showCollectionReport()">
                        <i class="fas fa-chart-bar me-2"></i>Collection Report
                    </button>
                </div>
                <div>
                    <a href="<?= site_url('admin/trial-registration/export-pdf') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-file-pdf me-2"></i>Export PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Players Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Registered Players</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-bordered" id="playersTable">
                            <thead class="table-dark">
                                <tr>
                                    <th width="40"><input class="form-check-input" type="checkbox" id="selectAll" /></th>
                                    <th width="50">#</th>
                                    <th>Name</th>
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
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <div class="fw-bold"><?= esc($reg['name']) ?></div>
                                                <small class="text-muted"><?= esc($reg['email']) ?></small>
                                            </td>
                                            <td><?= esc($reg['mobile']) ?></td>
                                            <td>
                                                <span class="badge bg-info"><?= ucfirst(str_replace('-', ' ', esc($reg['cricket_type']))) ?></span>
                                            </td>
                                            <td><?= esc($reg['city']) ?></td>
                                            <td>
                                                <?php
                                                $isVerified = ($reg['is_verified'] ?? 0) == 1;
                                                $fees = getCricketTypeFees($reg['cricket_type']);
                                                ?>
                                                <?php if ($isVerified): ?>
                                                    <div class="d-flex flex-column">
                                                        <span class="badge bg-success mb-1">
                                                            <i class="fas fa-check-circle"></i> Verified
                                                        </span>
                                                        <?php if (($reg['t_shirt_given'] ?? 0) == 1): ?>
                                                            <small class="text-success"><i class="fas fa-tshirt"></i> T-Shirt Given</small>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="d-flex flex-column">
                                                        <span class="badge bg-warning mb-1">
                                                            <i class="fas fa-clock"></i> Pending
                                                        </span>
                                                        <small class="text-info">Fee: ₹<?= $fees ?></small>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <?php if (!$isVerified): ?>
                                                        <button type="button" class="btn btn-sm btn-primary" onclick="verifyPlayer('<?= $reg['mobile'] ?>')" title="Verify Player">
                                                            <i class="fas fa-user-check"></i>
                                                        </button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-sm btn-success" disabled title="Already Verified">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <button type="button" class="btn btn-sm btn-info" onclick="viewPlayerDetails(<?= $reg['id'] ?>)" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="deletePlayer(<?= $reg['id'] ?>)" title="Delete Player">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-users fa-3x mb-3"></i>
                                                <p>No players registered yet</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Bulk Actions -->
                    <div class="mt-3 d-flex gap-2 align-items-center">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-danger" onclick="bulkDelete()" id="bulkDeleteBtn" disabled>
                                <i class="fas fa-trash me-2"></i>Delete Selected
                            </button>
                            <button type="button" class="btn btn-warning" onclick="bulkMarkPending()" id="bulkPendingBtn" disabled>
                                <i class="fas fa-undo me-2"></i>Mark as Pending
                            </button>
                        </div>
                        <div class="ms-auto">
                            <span class="text-muted">Selected: <span id="selectedCount">0</span> players</span>
                        </div>
                    </div>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center mt-4">
                        <?= $pager->links() ?>
                    </div>
                </div>
            </div>
        </div>
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
