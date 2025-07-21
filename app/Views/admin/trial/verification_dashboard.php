
<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Trial Player Verification</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Player Verification</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Total Players</h5>
                            <h3 class="mb-0"><?= $total_players ?></h3>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-users fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Verified</h5>
                            <h3 class="mb-0"><?= $verified_players ?></h3>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Pending</h5>
                            <h3 class="mb-0"><?= $pending_verification ?></h3>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-clock fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">₹199 Players</h5>
                            <h3 class="mb-0"><?= $partial_payment ?></h3>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-tshirt fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="playerTypeTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-players" 
                                    type="button" role="tab" aria-controls="all-players" aria-selected="true">
                                <i class="fas fa-users me-2"></i>All Players
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tshirt-tab" data-bs-toggle="tab" data-bs-target="#tshirt-players" 
                                    type="button" role="tab" aria-controls="tshirt-players" aria-selected="false">
                                <i class="fas fa-tshirt me-2"></i>₹199 T-Shirt Only
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="full-tab" data-bs-toggle="tab" data-bs-target="#full-players" 
                                    type="button" role="tab" aria-controls="full-players" aria-selected="false">
                                <i class="fas fa-credit-card me-2"></i>Full Payment
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="playerTypeTabsContent">
                        <div class="tab-pane fade show active" id="all-players" role="tabpanel" aria-labelledby="all-tab">
                            <div id="allPlayersList"></div>
                        </div>
                        <div class="tab-pane fade" id="tshirt-players" role="tabpanel" aria-labelledby="tshirt-tab">
                            <div class="alert alert-warning">
                                <h6><i class="fas fa-info-circle me-2"></i>₹199 T-Shirt Only Players</h6>
                                <p class="mb-0">These players need to pay balance amount on the ground to participate.</p>
                            </div>
                            <div id="tshirtPlayersList"></div>
                        </div>
                        <div class="tab-pane fade" id="full-players" role="tabpanel" aria-labelledby="full-tab">
                            <div class="alert alert-success">
                                <h6><i class="fas fa-check-circle me-2"></i>Full Payment Players</h6>
                                <p class="mb-0">These players get free t-shirts and can participate directly.</p>
                            </div>
                            <div id="fullPlayersList"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Verification Form -->
    <div class="row">
        <div class="col-md-6"></div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-search me-2"></i>Player Verification
                    </h5>
                </div>
                <div class="card-body">
                    <form id="verificationForm">
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input type="tel" class="form-control" id="mobile" name="mobile" 
                                   placeholder="Enter 10-digit mobile number" pattern="[0-9]{10}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Verify Player
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card" id="playerDetailsCard" style="display: none;">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user me-2"></i>Player Details
                    </h5>
                </div>
                <div class="card-body" id="playerDetails">
                    <!-- Player details will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Collection Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Collect Balance Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="paymentDetails"></div>
                <form id="paymentCollectionForm">
                    <input type="hidden" id="playerId" name="player_id">
                    <div class="mb-3">
                        <label class="form-label">Payment Status</label>
                        <select class="form-select" name="payment_status" required>
                            <option value="partial">Balance Collected</option>
                            <option value="full">Full Payment Completed</option>
                        </select>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="t_shirt_given" id="tShirtGiven">
                        <label class="form-check-label" for="tShirtGiven">
                            T-shirt handed out
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="completeVerification()">
                    <i class="fas fa-check me-2"></i>Complete Verification
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const verificationForm = document.getElementById('verificationForm');
    const playerDetailsCard = document.getElementById('playerDetailsCard');
    const playerDetails = document.getElementById('playerDetails');
    
    // Load player lists by type
    loadPlayersByType('all');
    
    // Tab change event
    document.querySelectorAll('#playerTypeTabs button').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(event) {
            const target = event.target.getAttribute('data-bs-target');
            let type = 'all';
            if (target === '#tshirt-players') type = 'partial';
            if (target === '#full-players') type = 'full';
            loadPlayersByType(type);
        });
    });

    verificationForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const mobile = document.getElementById('mobile').value;
        
        fetch('<?= base_url('admin/trial-registration/verify') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'mobile=' + encodeURIComponent(mobile)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayPlayerDetails(data.player, data.balance_amount, data.total_fees);
                playerDetailsCard.style.display = 'block';
            } else {
                notyf.error(data.message);
                playerDetailsCard.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            notyf.error('An error occurred while verifying player');
        });
    });
});

function loadPlayersByType(type) {
    let endpoint = '<?= base_url('admin/trial-registration/get-players') ?>';
    if (type !== 'all') {
        endpoint += '?payment_type=' + type;
    }
    
    fetch(endpoint)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayPlayersList(data.players, type);
            } else {
                console.error('Failed to load players:', data.message);
            }
        })
        .catch(error => {
            console.error('Error loading players:', error);
        });
}

function displayPlayersList(players, type) {
    let targetDiv = 'allPlayersList';
    if (type === 'partial') targetDiv = 'tshirtPlayersList';
    if (type === 'full') targetDiv = 'fullPlayersList';
    
    const container = document.getElementById(targetDiv);
    
    if (players.length === 0) {
        container.innerHTML = '<div class="alert alert-info">No players found in this category.</div>';
        return;
    }
    
    let html = '<div class="table-responsive"><table class="table table-sm">';
    html += '<thead><tr><th>Name</th><th>Mobile</th><th>Cricket Type</th><th>City</th><th>Status</th><th>Action</th></tr></thead><tbody>';
    
    players.forEach(player => {
        const statusBadge = player.is_verified ? 
            '<span class="badge bg-success">Verified</span>' : 
            '<span class="badge bg-warning">Pending</span>';
        
        const actionButton = type === 'partial' ? 
            `<button class="btn btn-sm btn-warning" onclick="quickVerify('${player.mobile}')">Collect Payment</button>` :
            `<button class="btn btn-sm btn-success" onclick="quickVerify('${player.mobile}')">Give T-Shirt</button>`;
        
        html += `
            <tr>
                <td>${player.name}</td>
                <td>${player.mobile}</td>
                <td>${player.cricket_type}</td>
                <td>${player.city}</td>
                <td>${statusBadge}</td>
                <td>${actionButton}</td>
            </tr>
        `;
    });
    
    html += '</tbody></table></div>';
    container.innerHTML = html;
}

function quickVerify(mobile) {
    document.getElementById('mobile').value = mobile;
    document.getElementById('verificationForm').dispatchEvent(new Event('submit'));
}

function displayPlayerDetails(player, balanceAmount, totalFees) {
    const isPartialPayment = balanceAmount > 0;
    const paymentTypeLabel = isPartialPayment ? 'T-Shirt Only (₹199)' : 'Full Payment';
    const statusBadge = player.is_verified ? 
        '<span class="badge bg-success">Verified</span>' : 
        '<span class="badge bg-warning">Pending</span>';
    
    document.getElementById('playerDetails').innerHTML = `
        <div class="row">
            <div class="col-12 mb-3">
                <h6><strong>Name:</strong> ${player.name}</h6>
                <p><strong>Mobile:</strong> ${player.mobile}</p>
                <p><strong>Cricket Type:</strong> ${player.cricket_type.charAt(0).toUpperCase() + player.cricket_type.slice(1)}</p>
                <p><strong>City:</strong> ${player.city}</p>
                <p><strong>Payment Type:</strong> ${paymentTypeLabel}</p>
                <p><strong>Status:</strong> ${statusBadge}</p>
            </div>
            
            ${isPartialPayment ? `
                <div class="col-12">
                    <div class="alert alert-warning">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Balance Payment Required</h6>
                        <p class="mb-2"><strong>Total Fee:</strong> ₹${totalFees}</p>
                        <p class="mb-2"><strong>Paid:</strong> ₹199</p>
                        <p class="mb-0"><strong>Balance:</strong> ₹${balanceAmount}</p>
                    </div>
                    <button type="button" class="btn btn-warning" onclick="openPaymentModal(${player.id}, ${balanceAmount})">
                        <i class="fas fa-money-bill me-2"></i>Collect Balance Payment
                    </button>
                </div>
            ` : `
                <div class="col-12">
                    <div class="alert alert-success">
                        <h6><i class="fas fa-check-circle me-2"></i>Full Payment Completed</h6>
                        <p class="mb-0">Player is eligible for free t-shirt</p>
                    </div>
                    <button type="button" class="btn btn-success" onclick="giveTShirt(${player.id})">
                        <i class="fas fa-tshirt me-2"></i>Hand Out T-Shirt
                    </button>
                </div>
            `}
        </div>
    `;
}

function openPaymentModal(playerId, balanceAmount) {
    document.getElementById('playerId').value = playerId;
    document.getElementById('paymentDetails').innerHTML = `
        <div class="alert alert-info">
            <h6>Balance Payment Collection</h6>
            <p class="mb-0">Amount to collect: <strong>₹${balanceAmount}</strong></p>
        </div>
    `;
    
    const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
    modal.show();
}

function giveTShirt(playerId) {
    if (confirm('Confirm handing out free t-shirt to this player?')) {
        updateVerification(playerId, 'full', true);
    }
}

function completeVerification() {
    const form = document.getElementById('paymentCollectionForm');
    const formData = new FormData(form);
    
    fetch('<?= base_url('admin/trial-registration/update-verification') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            notyf.success(data.message);
            bootstrap.Modal.getInstance(document.getElementById('paymentModal')).hide();
            // Reload verification form
            document.getElementById('verificationForm').reset();
            document.getElementById('playerDetailsCard').style.display = 'none';
        } else {
            notyf.error(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        notyf.error('An error occurred while updating verification');
    });
}

function updateVerification(playerId, paymentStatus, tShirtGiven) {
    const formData = new FormData();
    formData.append('player_id', playerId);
    formData.append('payment_status', paymentStatus);
    if (tShirtGiven) formData.append('t_shirt_given', '1');
    
    fetch('<?= base_url('admin/trial-registration/update-verification') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            notyf.success(data.message);
            // Reload verification form
            document.getElementById('verificationForm').reset();
            document.getElementById('playerDetailsCard').style.display = 'none';
        } else {
            notyf.error(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        notyf.error('An error occurred while updating verification');
    });
}
</script>

<?= $this->endSection() ?>
