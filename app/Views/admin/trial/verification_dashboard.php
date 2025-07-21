
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

    <!-- Verification Form -->
    <div class="row">
        <div class="col-md-6">
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
