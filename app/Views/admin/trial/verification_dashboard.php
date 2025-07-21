
<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<style>
/* Custom variables for golden and black theme */
:root {
    --primary-black: #1a1a1a;
    --secondary-black: #2d2d2d;
    --accent-gold: #FFD700;
    --text-light: #ffffff;
    --text-muted: #cccccc;
    --border-color: #404040;
    --success-green: #28a745;
    --warning-orange: #ffc107;
    --danger-red: #dc3545;
    --info-blue: #17a2b8;
}

/* Main container styling */
.verification-container {
    background: var(--primary-black);
    min-height: 100vh;
    padding: 2rem 1rem;
    color: var(--text-light);
}

/* Modern Header */
.verification-header {
    background: linear-gradient(135deg, var(--secondary-black) 0%, var(--primary-black) 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid var(--border-color);
}

.page-title {
    color: var(--accent-gold);
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.page-subtitle {
    color: var(--text-muted);
    font-size: 1.1rem;
    margin: 0.5rem 0 0 0;
}

.breadcrumb-modern {
    color: var(--text-muted);
    font-size: 0.95rem;
}

.breadcrumb-modern a {
    color: var(--accent-gold);
    text-decoration: none;
    transition: all 0.3s ease;
}

.breadcrumb-modern a:hover {
    color: #ffed4a;
}

/* Stats Cards */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: linear-gradient(135deg, var(--secondary-black) 0%, #3a3a3a 100%);
    border-radius: 16px;
    padding: 2rem;
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--accent-gold);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.stat-card:hover::before {
    transform: scaleX(1);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.15);
}

.stat-number {
    color: var(--accent-gold);
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    line-height: 1;
}

.stat-label {
    color: var(--text-muted);
    font-size: 0.95rem;
    margin: 0.5rem 0 0 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    background: rgba(255, 215, 0, 0.1);
    color: var(--accent-gold);
}

/* Modern Cards */
.modern-card {
    background: var(--secondary-black);
    border-radius: 16px;
    border: 1px solid var(--border-color);
    overflow: hidden;
    transition: all 0.3s ease;
}

.modern-card:hover {
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.1);
}

.card-header {
    background: linear-gradient(135deg, var(--accent-gold) 0%, #ffed4a 100%);
    color: var(--primary-black);
    padding: 1.5rem;
    border: none;
    font-weight: 600;
}

.card-body {
    background: var(--secondary-black);
    padding: 2rem;
    color: var(--text-light);
}

/* Form Elements */
.form-control {
    background: var(--primary-black);
    border: 2px solid var(--border-color);
    color: var(--text-light);
    border-radius: 12px;
    padding: 0.8rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    background: var(--primary-black);
    border-color: var(--accent-gold);
    color: var(--text-light);
    box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
}

.form-control::placeholder {
    color: var(--text-muted);
}

.input-group-text {
    background: var(--accent-gold);
    color: var(--primary-black);
    border: 2px solid var(--accent-gold);
    border-radius: 12px 0 0 12px;
    font-weight: 600;
}

/* Modern Buttons */
.btn-modern {
    border-radius: 12px;
    padding: 0.8rem 2rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: none;
    position: relative;
    overflow: hidden;
}

.btn-primary {
    background: linear-gradient(135deg, var(--accent-gold) 0%, #ffed4a 100%);
    color: var(--primary-black);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #ffed4a 0%, var(--accent-gold) 100%);
    color: var(--primary-black);
    transform: translateY(-2px);
}

.btn-success {
    background: linear-gradient(135deg, var(--success-green) 0%, #34ce57 100%);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(135deg, #34ce57 0%, var(--success-green) 100%);
    color: white;
    transform: translateY(-2px);
}

.btn-warning {
    background: linear-gradient(135deg, var(--warning-orange) 0%, #ffd43b 100%);
    color: var(--primary-black);
}

.btn-warning:hover {
    background: linear-gradient(135deg, #ffd43b 0%, var(--warning-orange) 100%);
    color: var(--primary-black);
    transform: translateY(-2px);
}

/* Player Details Card */
.player-details-card {
    border: 2px solid var(--accent-gold);
    border-radius: 16px;
    background: var(--secondary-black);
}

.player-details-header {
    background: linear-gradient(135deg, var(--accent-gold) 0%, #ffed4a 100%);
    color: var(--primary-black);
    padding: 1rem 1.5rem;
    border-radius: 14px 14px 0 0;
    font-weight: 600;
}

/* Badges */
.badge {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.bg-info {
    background: linear-gradient(135deg, var(--info-blue) 0%, #20c997 100%) !important;
}

.bg-success {
    background: linear-gradient(135deg, var(--success-green) 0%, #34ce57 100%) !important;
}

/* Alerts */
.alert {
    border-radius: 12px;
    border: none;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.alert-success {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(52, 206, 87, 0.1) 100%);
    border: 1px solid var(--success-green);
    color: #34ce57;
}

.alert-info {
    background: linear-gradient(135deg, rgba(23, 162, 184, 0.1) 0%, rgba(32, 201, 151, 0.1) 100%);
    border: 1px solid var(--info-blue);
    color: #20c997;
}

.alert-warning {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 212, 59, 0.1) 100%);
    border: 1px solid var(--warning-orange);
    color: #ffd43b;
}

/* List Group */
.list-group-item {
    background: var(--primary-black);
    border: 1px solid var(--border-color);
    color: var(--text-light);
    margin-bottom: 0.5rem;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background: var(--secondary-black);
    border-color: var(--accent-gold);
    transform: translateX(5px);
}

/* Modal */
.modal-content {
    background: var(--secondary-black);
    border: 2px solid var(--accent-gold);
    border-radius: 16px;
    color: var(--text-light);
}

.modal-header {
    background: linear-gradient(135deg, var(--success-green) 0%, #34ce57 100%);
    color: white;
    border-radius: 14px 14px 0 0;
    border-bottom: none;
}

.modal-footer {
    background: var(--primary-black);
    border-top: 1px solid var(--border-color);
    border-radius: 0 0 14px 14px;
}

.btn-close {
    filter: invert(1);
}

/* Form Check */
.form-check-input:checked {
    background-color: var(--accent-gold);
    border-color: var(--accent-gold);
}

.form-check-label {
    color: var(--text-light);
}

/* Text Colors */
.text-success { color: #34ce57 !important; }
.text-warning { color: #ffd43b !important; }
.text-muted { color: var(--text-muted) !important; }

/* Responsive */
@media (max-width: 768px) {
    .verification-container {
        padding: 1rem 0.5rem;
    }
    
    .verification-header {
        padding: 1.5rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .stat-card {
        padding: 1.5rem;
    }
}
</style>

<div class="verification-container">
    <!-- Modern Header -->
    <div class="verification-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h1 class="page-title">Player Verification Center</h1>
                <p class="page-subtitle">Streamline player verification and fee collection</p>
            </div>
            <nav class="breadcrumb-modern">
                <a href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="<?= base_url('admin/trial-registration') ?>">Trial Players</a>
                <span class="mx-2">/</span>
                <span class="active">Verification</span>
            </nav>
        </div>
    </div>

    <!-- Modern Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="stat-number"><?= $total_players ?? 0 ?></h3>
                    <p class="stat-label">Total Players</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="stat-number"><?= $verified_players ?? 0 ?></h3>
                    <p class="stat-label">Verified Players</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="stat-number"><?= $pending_verification ?? 0 ?></h3>
                    <p class="stat-label">Pending Verification</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="stat-number">₹<span id="todayCollection">0</span></h3>
                    <p class="stat-label">Today's Collection</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-rupee-sign"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Player Verification Form -->
        <div class="col-lg-6">
            <div class="modern-card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-search me-2"></i>Find Player for Verification
                    </h5>
                </div>
                <div class="card-body">
                    <form id="verificationForm" class="mb-4">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                            <input type="text" class="form-control" id="mobile" placeholder="Enter mobile number" maxlength="10" required>
                            <button class="btn btn-primary btn-modern" type="submit">
                                <i class="fas fa-search me-2"></i>Search
                            </button>
                        </div>
                        <small class="text-muted mt-2 d-block">Enter the player's registered mobile number</small>
                    </form>

                    <!-- Player Details Card -->
                    <div id="playerDetailsCard" style="display: none;">
                        <div class="player-details-card">
                            <div class="player-details-header">
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
            <div class="modern-card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>Today's Verifications
                    </h5>
                </div>
                <div class="card-body">
                    <div id="todayVerifications">
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-clipboard-list fa-3x mb-3 opacity-50"></i>
                            <p class="mb-0">Today's verified players will appear here</p>
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
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-rupee-sign me-2"></i>Collect Ground Fee
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
                <button type="button" class="btn btn-success btn-modern" onclick="completeVerification()">
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
        <div class="row g-3">
            <div class="col-md-6">
                <strong class="text-muted">Name:</strong><br>
                <span class="h6 text-light">${player.name}</span>
            </div>
            <div class="col-md-6">
                <strong class="text-muted">Mobile:</strong><br>
                <span class="text-light">${player.mobile}</span>
            </div>
        </div>
        <hr class="my-3" style="border-color: var(--border-color);">
        <div class="row g-3">
            <div class="col-md-6">
                <strong class="text-muted">Cricket Type:</strong><br>
                <span class="badge bg-info">${cricketType.charAt(0).toUpperCase() + cricketType.slice(1)}</span>
            </div>
            <div class="col-md-6">
                <strong class="text-muted">City:</strong><br>
                <span class="text-light">${player.city}</span>
            </div>
        </div>
        <hr class="my-3" style="border-color: var(--border-color);">
        <div class="row">
            <div class="col-12">
                <strong class="text-muted">Total Fee:</strong> <span class="h5 text-success">₹${totalFees}</span>
            </div>
        </div>
        <hr class="my-3" style="border-color: var(--border-color);">
        ${isVerified ? `
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Player Already Verified</strong><br>
                <small>Verified on: ${new Date(player.verified_at).toLocaleDateString()}<br>
                ${player.t_shirt_given == 1 ? '<i class="fas fa-tshirt me-1"></i>T-Shirt already given' : '<i class="fas fa-exclamation-triangle me-1"></i>T-Shirt not given yet'}</small>
            </div>
            ${player.t_shirt_given != 1 ? `
                <button class="btn btn-warning btn-modern" onclick="giveTShirt(${player.id})">
                    <i class="fas fa-tshirt me-2"></i>Give T-Shirt Now
                </button>
            ` : ''}
        ` : `
            <div class="d-grid">
                <button class="btn btn-success btn-modern btn-lg" onclick="openFeeCollectionModal(${player.id}, ${totalFees}, '${player.name}', '${cricketType}')">
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
            <h6 class="mb-2"><i class="fas fa-user me-2"></i>${playerName}</h6>
            <p class="mb-2"><strong>Cricket Type:</strong> ${cricketType.charAt(0).toUpperCase() + cricketType.slice(1)}</p>
            <p class="mb-0"><strong>Total Fee to Collect:</strong> <span class="h5">₹${totalFees}</span></p>
        </div>
        <div class="alert alert-warning">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Ground Collection Process:</strong><br>
            <small>1. Collect ₹${totalFees} in cash from the player<br>
            2. Check the "Fee collected" checkbox below<br>
            3. Give t-shirt to player if available<br>
            4. Complete verification</small>
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
            <div class="text-center text-muted py-5">
                <i class="fas fa-clipboard-list fa-3x mb-3 opacity-50"></i>
                <p class="mb-0">No verifications completed today</p>
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
                        <h6 class="mb-1 text-light">${verification.name}</h6>
                        <p class="mb-1 text-muted">${verification.mobile}</p>
                        <small class="text-muted">${verification.cricket_type.replace('-', ' ')}</small>
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
