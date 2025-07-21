
<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Player Verification Center</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/trial-registration') ?>">Trial Players</a></li>
                        <li class="breadcrumb-item active">Verification</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-1 text-white"><?= $total_players ?? 0 ?></h4>
                            <p class="mb-0">Total Players</p>
                        </div>
                        <div><i class="fas fa-users fa-2x opacity-75"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-1 text-white"><?= $verified_players ?? 0 ?></h4>
                            <p class="mb-0">Verified</p>
                        </div>
                        <div><i class="fas fa-check-circle fa-2x opacity-75"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-1 text-white"><?= $pending_verification ?? 0 ?></h4>
                            <p class="mb-0">Pending</p>
                        </div>
                        <div><i class="fas fa-clock fa-2x opacity-75"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-1 text-white">₹<span id="todayCollection">0</span></h4>
                            <p class="mb-0">Today's Collection</p>
                        </div>
                        <div><i class="fas fa-rupee-sign fa-2x opacity-75"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Player Verification Form -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-search me-2"></i>Find Player for Verification
                    </h5>
                </div>
                <div class="card-body">
                    <form id="verificationForm" class="mb-4">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                            <input type="text" class="form-control" id="mobile" placeholder="Enter mobile number" maxlength="10" required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search me-2"></i>Search
                            </button>
                        </div>
                        <small class="text-muted">Enter the player's registered mobile number</small>
                    </form>

                    <!-- Player Details Card -->
                    <div id="playerDetailsCard" style="display: none;">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0"><i class="fas fa-user me-2"></i>Player Found</h6>
                            </div>
                            <div class="card-body" id="playerDetails">
                                <!-- Player details will be populated here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Verifications -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list me-2"></i>Today's Verifications
                    </h5>
                </div>
                <div class="card-body">
                    <div id="todayVerifications">
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                            <p>Today's verified players will appear here</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Fee Collection Modal -->
<div class="modal fade" id="feeCollectionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-rupee-sign me-2"></i>Collect Ground Fee
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="feeCollectionForm">
                    <input type="hidden" id="playerId" name="player_id">
                    
                    <div id="feeDetails" class="mb-4">
                        <!-- Fee details will be populated here -->
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="feeCollected" name="fee_collected" required>
                        <label class="form-check-label fw-bold" for="feeCollected">
                            Fee has been collected in cash
                        </label>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="tShirtGiven" name="t_shirt_given">
                        <label class="form-check-label" for="tShirtGiven">
                            T-Shirt handed out to player
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
const verificationForm = document.getElementById('verificationForm');
const playerDetailsCard = document.getElementById('playerDetailsCard');

// Cricket type fees
const cricketTypeFees = {
    'bowler': 999,
    'batsman': 999,
    'wicket-keeper': 1199,
    'all-rounder': 1199
};

verificationForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const mobile = document.getElementById('mobile').value.trim();
    
    if (mobile.length !== 10) {
        alert('Please enter a valid 10-digit mobile number');
        return;
    }
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Searching...';
    submitBtn.disabled = true;
    
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
            displayPlayerDetails(data.player, data.total_fees);
            playerDetailsCard.style.display = 'block';
        } else {
            alert(data.message);
            playerDetailsCard.style.display = 'none';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while searching for the player');
    })
    .finally(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});

function displayPlayerDetails(player, totalFees) {
    const isVerified = player.is_verified == 1;
    const cricketType = player.cricket_type.replace('-', ' ');
    
    const detailsHtml = `
        <div class="row">
            <div class="col-md-6">
                <strong>Name:</strong><br>
                <span class="h6">${player.name}</span>
            </div>
            <div class="col-md-6">
                <strong>Mobile:</strong><br>
                <span>${player.mobile}</span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <strong>Cricket Type:</strong><br>
                <span class="badge bg-info">${cricketType.charAt(0).toUpperCase() + cricketType.slice(1)}</span>
            </div>
            <div class="col-md-6">
                <strong>City:</strong><br>
                <span>${player.city}</span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <strong>Total Fee:</strong> <span class="h5 text-success">₹${totalFees}</span>
            </div>
        </div>
        <hr>
        ${isVerified ? `
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Player Already Verified</strong><br>
                Verified on: ${new Date(player.verified_at).toLocaleDateString()}<br>
                ${player.t_shirt_given == 1 ? '<small><i class="fas fa-tshirt me-1"></i>T-Shirt already given</small>' : '<small class="text-warning"><i class="fas fa-exclamation-triangle me-1"></i>T-Shirt not given yet</small>'}
            </div>
            ${player.t_shirt_given != 1 ? `
                <button class="btn btn-warning" onclick="giveTShirt(${player.id})">
                    <i class="fas fa-tshirt me-2"></i>Give T-Shirt Now
                </button>
            ` : ''}
        ` : `
            <div class="d-grid">
                <button class="btn btn-success btn-lg" onclick="openFeeCollectionModal(${player.id}, ${totalFees}, '${player.name}', '${cricketType}')">
                    <i class="fas fa-rupee-sign me-2"></i>Collect Fee & Verify Player
                </button>
            </div>
        `}
    `;
    
    document.getElementById('playerDetails').innerHTML = detailsHtml;
}

function openFeeCollectionModal(playerId, totalFees, playerName, cricketType) {
    document.getElementById('playerId').value = playerId;
    
    const feeDetailsHtml = `
        <div class="alert alert-info">
            <h6><i class="fas fa-user me-2"></i>${playerName}</h6>
            <p class="mb-2"><strong>Cricket Type:</strong> ${cricketType.charAt(0).toUpperCase() + cricketType.slice(1)}</p>
            <p class="mb-0"><strong>Total Fee to Collect:</strong> <span class="h5 text-success">₹${totalFees}</span></p>
        </div>
        <div class="alert alert-warning">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Ground Collection Process:</strong><br>
            1. Collect ₹${totalFees} in cash from the player<br>
            2. Check the "Fee collected" checkbox below<br>
            3. Give t-shirt to player if available<br>
            4. Complete verification
        </div>
    `;
    
    document.getElementById('feeDetails').innerHTML = feeDetailsHtml;
    
    const modal = new bootstrap.Modal(document.getElementById('feeCollectionModal'));
    modal.show();
}

function giveTShirt(playerId) {
    if (confirm('Confirm giving t-shirt to this player?')) {
        const formData = new FormData();
        formData.append('player_id', playerId);
        formData.append('t_shirt_given', '1');
        formData.append('payment_status', 'full');
        
        fetch('<?= base_url('admin/trial-registration/update-verification') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('T-Shirt marked as given successfully');
                document.getElementById('verificationForm').reset();
                playerDetailsCard.style.display = 'none';
                loadTodayVerifications();
            } else {
                alert(data.message || 'Failed to update t-shirt status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating');
        });
    }
}

function completeVerification() {
    const form = document.getElementById('feeCollectionForm');
    const feeCollected = document.getElementById('feeCollected').checked;
    
    if (!feeCollected) {
        alert('Please confirm that the fee has been collected');
        return;
    }
    
    const formData = new FormData(form);
    formData.append('payment_status', 'full');
    formData.append('is_verified', '1');
    
    fetch('<?= base_url('admin/trial-registration/update-verification') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Player verification completed successfully!');
            bootstrap.Modal.getInstance(document.getElementById('feeCollectionModal')).hide();
            document.getElementById('verificationForm').reset();
            playerDetailsCard.style.display = 'none';
            loadTodayVerifications();
            updateTodayCollection();
        } else {
            alert(data.message || 'Failed to complete verification');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while completing verification');
    });
}

function loadTodayVerifications() {
    // Load today's verifications
    fetch('<?= base_url('admin/trial-registration/today-verifications') ?>')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayTodayVerifications(data.verifications);
        }
    })
    .catch(error => {
        console.error('Error loading today\'s verifications:', error);
    });
}

function displayTodayVerifications(verifications) {
    const container = document.getElementById('todayVerifications');
    
    if (verifications.length === 0) {
        container.innerHTML = `
            <div class="text-center text-muted py-4">
                <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                <p>No verifications completed today</p>
            </div>
        `;
        return;
    }
    
    let html = '<div class="list-group">';
    verifications.forEach(verification => {
        const fees = cricketTypeFees[verification.cricket_type] || 999;
        html += `
            <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="mb-1">${verification.name}</h6>
                        <p class="mb-1 text-muted">${verification.mobile}</p>
                        <small>${verification.cricket_type.replace('-', ' ')}</small>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success">₹${fees}</span>
                        ${verification.t_shirt_given == 1 ? '<br><small class="text-success"><i class="fas fa-tshirt"></i> T-Shirt</small>' : ''}
                    </div>
                </div>
            </div>
        `;
    });
    html += '</div>';
    
    container.innerHTML = html;
}

function updateTodayCollection() {
    // Calculate today's collection
    fetch('<?= base_url('admin/trial-registration/today-collection') ?>')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('todayCollection').textContent = data.collection.toLocaleString();
        }
    })
    .catch(error => {
        console.error('Error updating collection:', error);
    });
}

// Load data on page load
document.addEventListener('DOMContentLoaded', function() {
    loadTodayVerifications();
    updateTodayCollection();
});

// Handle URL parameter for mobile number
const urlParams = new URLSearchParams(window.location.search);
const mobileParam = urlParams.get('mobile');
if (mobileParam) {
    document.getElementById('mobile').value = mobileParam;
    verificationForm.dispatchEvent(new Event('submit'));
}
</script>

<?= $this->endSection() ?>
