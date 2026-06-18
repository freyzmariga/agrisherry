<?php
// Simple admin panel - protect with password
session_start();
require_once '../includes/db.php';

// Simple password protection - CHANGE THIS PASSWORD
define('ADMIN_PASS', 'agrisherry2024');

if (!isset($_SESSION['admin_logged_in'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
        if ($_POST['password'] === ADMIN_PASS) {
            $_SESSION['admin_logged_in'] = true;
        } else {
            $login_error = 'Incorrect password.';
        }
    }
    if (!isset($_SESSION['admin_logged_in'])) {
        ?><!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Login - Agrisherry</title>
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: system-ui, sans-serif; background: #1a5c2a; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
.login-box { background: white; padding: 40px; border-radius: 12px; width: 360px; box-shadow: 0 8px 40px rgba(0,0,0,0.2); text-align: center; }
.login-box img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 16px; }
h2 { color: #1a5c2a; margin-bottom: 8px; }
p { color: #666; font-size: 0.9rem; margin-bottom: 24px; }
input[type=password] { width: 100%; padding: 12px 16px; border: 1.5px solid #d4e8d7; border-radius: 8px; font-size: 0.95rem; outline: none; margin-bottom: 16px; }
input[type=password]:focus { border-color: #2d8644; }
button { width: 100%; background: #2d8644; color: white; border: none; padding: 12px; border-radius: 8px; font-size: 1rem; font-weight: 600; cursor: pointer; }
button:hover { background: #1a5c2a; }
.error { background: #ffebee; color: #c62828; padding: 10px; border-radius: 6px; font-size: 0.85rem; margin-bottom: 16px; }
</style></head><body>
<div class="login-box">
    <img src="../images/logo.jpeg" alt="Agrisherry">
    <h2>Admin Panel</h2>
    <p>Agrisherry Fruit Seedlings Kenya</p>
    <?php if (isset($login_error)): ?><div class="error"><?php echo htmlspecialchars($login_error); ?></div><?php endif; ?>
    <form method="POST">
        <input type="password" name="password" placeholder="Enter admin password" required autofocus>
        <button type="submit">Login</button>
    </form>
</div>
</body></html>
<?php exit; }
}

// Handle actions
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'mark_read' && isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        $conn->query("UPDATE enquiries SET status = 'read' WHERE id = $id");
    }
    if ($_POST['action'] === 'delete_enquiry' && isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        $conn->query("DELETE FROM enquiries WHERE id = $id");
    }
    if ($_POST['action'] === 'logout') {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}

// Fetch stats
$total_products = $conn->query("SELECT COUNT(*) as c FROM products WHERE in_stock = 1")->fetch_assoc()['c'];
$total_enquiries = $conn->query("SELECT COUNT(*) as c FROM enquiries")->fetch_assoc()['c'];
$new_enquiries = $conn->query("SELECT COUNT(*) as c FROM enquiries WHERE status = 'new'")->fetch_assoc()['c'];
$enquiries = $conn->query("SELECT * FROM enquiries ORDER BY created_at DESC LIMIT 50");
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Panel - Agrisherry</title>
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: system-ui, sans-serif; background: #f0f7f1; color: #1c2a1e; }
.admin-header { background: #1a5c2a; color: white; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; }
.admin-header h1 { font-size: 1.2rem; }
.admin-header .btns { display: flex; gap: 12px; }
.admin-header a { color: rgba(255,255,255,0.8); font-size: 0.85rem; text-decoration: none; }
.admin-header a:hover { color: white; }
.admin-body { max-width: 1100px; margin: 0 auto; padding: 32px 20px; }
.stats { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; margin-bottom: 32px; }
.stat { background: white; border-radius: 10px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); text-align: center; }
.stat .n { font-size: 2.2rem; font-weight: 700; color: #2d8644; }
.stat .l { font-size: 0.85rem; color: #666; margin-top: 4px; }
.stat.alert .n { color: #c0392b; }
.card { background: white; border-radius: 10px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
.card h2 { font-size: 1.1rem; margin-bottom: 20px; color: #1a5c2a; }
table { width: 100%; border-collapse: collapse; }
th { text-align: left; padding: 10px 14px; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: #666; border-bottom: 2px solid #e0eee2; }
td { padding: 12px 14px; border-bottom: 1px solid #f0f7f1; font-size: 0.88rem; vertical-align: top; }
tr:hover td { background: #f8fdf9; }
.badge-new { background: #ffebee; color: #c62828; padding: 3px 8px; border-radius: 10px; font-size: 0.75rem; font-weight: 600; }
.badge-read { background: #e8f5e9; color: #2e7d32; padding: 3px 8px; border-radius: 10px; font-size: 0.75rem; }
.btn-sm { padding: 6px 12px; border: none; border-radius: 6px; font-size: 0.78rem; cursor: pointer; font-weight: 600; }
.btn-green { background: #2d8644; color: white; }
.btn-green:hover { background: #1a5c2a; }
.btn-red { background: #ffebee; color: #c62828; }
.btn-red:hover { background: #c62828; color: white; }
.btn-logout { background: rgba(255,255,255,0.15); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 7px 16px; border-radius: 6px; cursor: pointer; font-size: 0.85rem; }
.btn-logout:hover { background: rgba(255,255,255,0.25); }
.msg-preview { max-width: 300px; color: #555; }
.timestamp { color: #999; font-size: 0.78rem; }
@media(max-width:768px) { .stats { grid-template-columns: 1fr 1fr; } table { font-size: 0.8rem; } }
</style>
</head><body>

<div class="admin-header">
    <div style="display:flex; align-items:center; gap:12px;">
        <img src="../images/logo.jpeg" alt="" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
        <h1>Agrisherry Admin</h1>
    </div>
    <div class="btns">
        <a href="../index.php" target="_blank">← View Website</a>
        <form method="POST" style="display:inline;">
            <input type="hidden" name="action" value="logout">
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</div>

<div class="admin-body">
    <div class="stats">
        <div class="stat">
            <div class="n"><?php echo $total_products; ?></div>
            <div class="l">Active Seedlings</div>
        </div>
        <div class="stat">
            <div class="n"><?php echo $total_enquiries; ?></div>
            <div class="l">Total Enquiries</div>
        </div>
        <div class="stat <?php echo $new_enquiries > 0 ? 'alert' : ''; ?>">
            <div class="n"><?php echo $new_enquiries; ?></div>
            <div class="l">New (Unread)</div>
        </div>
    </div>

    <div class="card">
        <h2>📩 Customer Enquiries</h2>
        <?php if ($enquiries->num_rows === 0): ?>
            <p style="color:#999; text-align:center; padding:20px;">No enquiries yet.</p>
        <?php else: ?>
        <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($e = $enquiries->fetch_assoc()): ?>
            <tr>
                <td>
                    <?php if ($e['status'] === 'new'): ?>
                    <span class="badge-new">NEW</span>
                    <?php else: ?>
                    <span class="badge-read">Read</span>
                    <?php endif; ?>
                </td>
                <td><strong><?php echo htmlspecialchars($e['name']); ?></strong></td>
                <td>
                    <?php if ($e['phone']): ?><a href="tel:<?php echo htmlspecialchars($e['phone']); ?>"><?php echo htmlspecialchars($e['phone']); ?></a><br><?php endif; ?>
                    <?php if ($e['email']): ?><a href="mailto:<?php echo htmlspecialchars($e['email']); ?>"><?php echo htmlspecialchars($e['email']); ?></a><?php endif; ?>
                </td>
                <td class="msg-preview"><?php echo nl2br(htmlspecialchars(substr($e['message'], 0, 120))); ?><?php echo strlen($e['message']) > 120 ? '...' : ''; ?></td>
                <td class="timestamp"><?php echo date('d M Y<br>H:i', strtotime($e['created_at'])); ?></td>
                <td style="display:flex; flex-direction:column; gap:6px;">
                    <?php if ($e['phone']): ?>
                    <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/','',$e['phone']); ?>?text=Hello%20<?php echo urlencode($e['name']); ?>,%20thank%20you%20for%20contacting%20Agrisherry!" target="_blank" class="btn-sm btn-green">📱 WhatsApp</a>
                    <?php endif; ?>
                    <?php if ($e['status'] === 'new'): ?>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="mark_read">
                        <input type="hidden" name="id" value="<?php echo $e['id']; ?>">
                        <button type="submit" class="btn-sm btn-green">✓ Mark Read</button>
                    </form>
                    <?php endif; ?>
                    <form method="POST" onsubmit="return confirm('Delete this enquiry?')">
                        <input type="hidden" name="action" value="delete_enquiry">
                        <input type="hidden" name="id" value="<?php echo $e['id']; ?>">
                        <button type="submit" class="btn-sm btn-red">🗑 Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
        </div>
        <?php endif; ?>
    </div>
</div>
</body></html>
