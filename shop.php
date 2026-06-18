<?php
require_once 'includes/db.php';
$page_title = 'Seedlings Shop';

// Filters
$selected_category = isset($_GET['category']) ? trim($_GET['category']) : '';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
$view = isset($_GET['view']) ? $_GET['view'] : 'cards';

// Allowed sort options
$sort_options = [
    'name'        => 'Name A–Z',
    'price_asc'   => 'Price: Low to High',
    'price_desc'  => 'Price: High to Low',
    'category'    => 'By Category',
];
$sort_sql = [
    'name'        => 'name ASC',
    'price_asc'   => 'price ASC',
    'price_desc'  => 'price DESC',
    'category'    => 'category ASC, name ASC',
];
$order = $sort_sql[$sort] ?? 'name ASC';

// Build query
$where = ['in_stock = 1'];
$params = [];
$types = '';

if ($selected_category !== '') {
    $where[] = 'category = ?';
    $params[] = $selected_category;
    $types .= 's';
}
if ($search !== '') {
    $where[] = '(name LIKE ? OR category LIKE ? OR description LIKE ?)';
    $like = '%' . $search . '%';
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $types .= 'sss';
}
$sql = "SELECT * FROM products WHERE " . implode(' AND ', $where) . " ORDER BY $order";
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);

// Category list with counts
$cat_result = $conn->query("SELECT category, COUNT(*) as cnt FROM products WHERE in_stock = 1 GROUP BY category ORDER BY category ASC");
$categories = [];
while ($row = $cat_result->fetch_assoc()) {
    $categories[$row['category']] = $row['cnt'];
}
$total_all = array_sum($categories);

include 'includes/header.php';

$emoji_map = [
    'Avocados' => '🥑', 'Mangoes' => '🥭', 'Citrus' => '🍊',
    'Berries' => '🍓', 'Bananas' => '🍌', 'Passion & Specialty' => '💛',
    'Exotic' => '🌴', 'Nuts' => '🌰', 'Guavas' => '🍈',
    'Apples & Temperate' => '🍎', 'Pawpaw' => '🌿',
];
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1>🌱 Fruit Seedlings Shop</h1>
        <p>Premium grafted seedlings — <?php echo $total_all; ?>+ varieties available</p>
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span>Shop</span>
            <?php if ($selected_category): ?>
            <span>/</span>
            <span><?php echo htmlspecialchars($selected_category); ?></span>
            <?php endif; ?>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="shop-layout">

            <!-- Sidebar -->
            <aside class="shop-sidebar">
                <div class="sidebar-section">
                    <div class="sidebar-title">Categories</div>
                    <div class="sidebar-cats">
                        <a href="shop.php" class="sidebar-cat <?php echo $selected_category === '' ? 'active' : ''; ?>">
                            All Seedlings <span class="count"><?php echo $total_all; ?></span>
                        </a>
                        <?php foreach ($categories as $cat => $cnt): ?>
                        <a href="shop.php?category=<?php echo urlencode($cat); ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>"
                           class="sidebar-cat <?php echo $selected_category === $cat ? 'active' : ''; ?>">
                            <?php echo ($emoji_map[$cat] ?? '🌱') . ' ' . htmlspecialchars($cat); ?>
                            <span class="count"><?php echo $cnt; ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="sidebar-section">
                    <div class="sidebar-title">Max Price (Ksh)</div>
                    <div class="price-range">
                        <input type="range" id="priceRange" min="100" max="2500" step="50" value="2500">
                        <div class="price-range-labels">
                            <span>Ksh 100</span>
                            <span id="priceDisplay">Ksh 2,500</span>
                        </div>
                    </div>
                </div>

                <div class="sidebar-section">
                    <div class="sidebar-title">Quick Order</div>
                    <a href="https://wa.me/254723693591?text=Hello%20Agrisherry,%20I%20need%20seedlings.%20Please%20assist." class="btn-primary" style="width:100%; justify-content:center; font-size:0.85rem;" target="_blank">
                        <i class="fab fa-whatsapp"></i> Chat & Order
                    </a>
                    <a href="tel:+254723693591" class="btn-primary" style="width:100%; justify-content:center; margin-top:10px; font-size:0.85rem; background: var(--green-dark);">
                        <i class="fas fa-phone"></i> Call 0723-693591
                    </a>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="shop-main">
                <!-- Toolbar -->
                <div class="shop-toolbar">
                    <div class="shop-results">
                        <span id="shopResultCount"><?php echo count($products); ?> seedling<?php echo count($products) !== 1 ? 's' : ''; ?></span>
                        <?php if ($selected_category): ?> in <strong><?php echo htmlspecialchars($selected_category); ?></strong><?php endif; ?>
                        <?php if ($search): ?> matching "<strong><?php echo htmlspecialchars($search); ?></strong>"<?php endif; ?>
                    </div>
                    <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                        <div class="shop-search">
                            <input type="text" id="shopSearch" placeholder="🔍 Search seedlings..." value="<?php echo htmlspecialchars($search); ?>">
                        </div>
                        <form method="GET" style="display:flex; gap:8px; align-items:center;">
                            <?php if ($selected_category): ?><input type="hidden" name="category" value="<?php echo htmlspecialchars($selected_category); ?>"><?php endif; ?>
                            <div class="shop-sort">
                                <select name="sort" onchange="this.form.submit()">
                                    <?php foreach ($sort_options as $val => $label): ?>
                                    <option value="<?php echo $val; ?>" <?php echo $sort === $val ? 'selected' : ''; ?>><?php echo $label; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if (empty($products)): ?>
                <div style="text-align:center; padding: 60px 20px; color: var(--text-light);">
                    <div style="font-size:4rem; margin-bottom:16px;">🌿</div>
                    <h3 style="margin-bottom:12px; color: var(--text-dark);">No seedlings found</h3>
                    <p>Try a different search or <a href="shop.php" style="color: var(--green-mid); font-weight:600;">browse all varieties</a>.</p>
                </div>
                <?php else: ?>

                <!-- Products Grid -->
                <div class="products-grid" id="productsGrid">
                    <?php foreach ($products as $product):
                        $emoji = $emoji_map[$product['category']] ?? '🌱';
                        $wa_msg = urlencode("Hello Agrisherry, I am interested in " . $product['whatsapp_text'] . ". Please assist.");
                    ?>
                    <div class="product-card" data-name="<?php echo htmlspecialchars($product['name']); ?>" data-category="<?php echo htmlspecialchars($product['category']); ?>" data-price="<?php echo $product['price']; ?>">
                        <div class="product-img">
                            <?php if (!empty($product['image']) && file_exists($product['image'])): ?>
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <?php else: ?>
                                <?php echo $emoji; ?>
                            <?php endif; ?>
                            <?php if ($product['featured']): ?>
                            <span class="product-badge">⭐ Popular</span>
                            <?php endif; ?>
                        </div>
                        <div class="product-body">
                            <div class="product-category"><?php echo htmlspecialchars($product['category']); ?></div>
                            <h3 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h3>
                            <?php if (!empty($product['description'])): ?>
                            <p class="product-desc"><?php echo htmlspecialchars($product['description']); ?></p>
                            <?php endif; ?>
                            <div class="product-footer">
                                <div class="product-price">Ksh <?php echo number_format($product['price']); ?> <span>/seedling</span></div>
                                <a href="https://wa.me/254723693591?text=<?php echo $wa_msg; ?>" class="btn-order" target="_blank">
                                    <i class="fab fa-whatsapp"></i> Order
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Price List Table (also shown) -->
                <div style="margin-top: 56px;">
                    <h2 class="section-title" style="text-align:center; margin-bottom:32px;" id="list">
                        📋 Full Price List
                        <?php if ($selected_category): ?><span style="font-size:1.2rem; color: var(--green-mid);"> — <?php echo htmlspecialchars($selected_category); ?></span><?php endif; ?>
                    </h2>
                    <div style="overflow-x:auto;">
                        <table class="price-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Seedling Name</th>
                                    <th>Category</th>
                                    <th>Price (Ksh)</th>
                                    <th>Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $i => $product):
                                    $wa_msg = urlencode("Hello Agrisherry, I am interested in " . $product['whatsapp_text'] . ". Please assist.");
                                ?>
                                <tr class="price-row" data-name="<?php echo htmlspecialchars($product['name']); ?>" data-price="<?php echo $product['price']; ?>">
                                    <td><?php echo $i + 1; ?></td>
                                    <td><strong><?php echo htmlspecialchars($product['name']); ?></strong></td>
                                    <td><?php echo ($emoji_map[$product['category']] ?? '🌱') . ' ' . htmlspecialchars($product['category']); ?></td>
                                    <td class="price-ksh">Ksh <?php echo number_format($product['price']); ?></td>
                                    <td>
                                        <a href="https://wa.me/254723693591?text=<?php echo $wa_msg; ?>" class="btn-wa" target="_blank">
                                            <i class="fab fa-whatsapp"></i> Buy Now
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
            </main>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-banner">
    <div class="container">
        <h2>Can't Find What You're Looking For?</h2>
        <p>We may have more varieties in stock. WhatsApp or call us directly!</p>
        <div class="cta-btns">
            <a href="https://wa.me/254723693591?text=Hello%20Agrisherry,%20I%20am%20looking%20for%20a%20specific%20seedling" class="btn-gold" target="_blank">
                <i class="fab fa-whatsapp"></i> Ask on WhatsApp
            </a>
            <a href="tel:+254723693591" class="btn-white-outline">
                <i class="fas fa-phone"></i> Call 0723-693591
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
