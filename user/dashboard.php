<?php
session_start();

// If user is not logged in → redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include '../includes/header.php';
?>

<style>
.dashboard-container {
    max-width: 1100px;
    margin: 40px auto;
    padding: 20px;
}

.dashboard-title {
    font-size: 32px;
    font-weight: 700;
    color: #222;
    text-align: center;
    margin-bottom: 30px;
}

/* Cards Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 25px;
    margin-top: 20px;
}

.dash-card {
    background: white;
    padding: 25px;
    border-radius: 14px;
    box-shadow: rgba(0, 0, 0, 0.08) 0 4px 12px;
    transition: 0.3s;
    cursor: pointer;
    border-left: 6px solid #6a5acd;
}

.dash-card:hover {
    transform: translateY(-5px);
    box-shadow: rgba(0, 0, 0, 0.15) 0 6px 18px;
}

.dash-card h3 {
    font-size: 20px;
    color: #6a5acd;
    margin-bottom: 8px;
}

.dash-card p {
    font-size: 14px;
    color: #444;
    line-height: 1.6;
}
</style>

<div class="dashboard-container">
    <h1 class="dashboard-title">Welcome, <?php echo $_SESSION['username']; ?> 👋</h1>

    <div class="dashboard-grid">
        
        <a href="report_lost.php" class="dash-card" style="text-decoration:none; color:inherit;">
            <h3>Report Lost Item</h3>
            <p>Submit details about something you lost so helpers can find it.</p>
        </a>

        <a href="report_found.php" class="dash-card" style="text-decoration:none; color:inherit;">
            <h3>Report Found Item</h3>
            <p>Found something? Let the owner claim it securely.</p>
        </a>

        <a href="my_reports.php" class="dash-card" style="text-decoration:none; color:inherit;">
            <h3>My Reports</h3>
            <p>View all items you reported as lost or found.</p>
        </a>

        <a href="profile.php" class="dash-card" style="text-decoration:none; color:inherit;">
            <h3>Edit Profile</h3>
            <p>Update your personal information and password.</p>
        </a>

        <a href="../logout.php" class="dash-card" style="text-decoration:none; color:inherit;">
            <h3>Logout</h3>
            <p>Securely sign out of your TrackBack account.</p>
        </a>

    </div>
</div>

<?php include '../includes/footer.php'; ?>

