<?php
require_once 'includes/db.php';
$page_title = 'Home';

// Fetch featured products
$featured = $conn->query("SELECT * FROM products WHERE featured = 1 AND in_stock = 1 ORDER BY name ASC LIMIT 8");

// Fetch testimonials
$testimonials = $conn->query("SELECT * FROM testimonials WHERE approved = 1 ORDER BY id DESC LIMIT 6");

// Category counts
$cat_counts = [];
$cat_result = $conn->query("SELECT category, COUNT(*) as cnt FROM products WHERE in_stock = 1 GROUP BY category");
while ($row = $cat_result->fetch_assoc()) {
    $cat_counts[$row['category']] = $row['cnt'];
}
$total_products = array_sum($cat_counts);

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-slides">
        <div class="hero-slide" style="background-image: url('images/banner3.jpg');"></div>
        <div class="hero-slide" style="background-image: url('images/banner6.jpg');"></div>
        <div class="hero-slide" style="background-image: url('images/banner.jpg');"></div>
    </div>

    <div class="hero-content">
        <div class="hero-inner">
            <div class="hero-badge">🌱 Kenya's Premium Seedling Nursery</div>
            <h1 class="hero-title">
                Grow More.<br>
                <span>Farm Smarter.</span>
            </h1>
            <p class="hero-subtitle">Premium grafted fruit seedlings — avocados, mangoes, citrus, exotic fruits and more. Serving farmers across Kenya and internationally.</p>
            <div class="hero-btns">
                <a href="shop.php" class="btn-primary"><i class="fas fa-seedling"></i> Browse Seedlings</a>
                <a href="https://wa.me/254723693591?text=Hello%20Agrisherry,%20I%20need%20seedlings" class="btn-secondary" target="_blank"><i class="fab fa-whatsapp"></i> Order on WhatsApp</a>
            </div>
        </div>
    </div>

    <button class="hero-arrow prev"><i class="fas fa-chevron-left"></i></button>
    <button class="hero-arrow next"><i class="fas fa-chevron-right"></i></button>

    <div class="hero-dots">
        <button class="hero-dot"></button>
        <button class="hero-dot"></button>
        <button class="hero-dot"></button>
    </div>
</section>

<!-- Stats Bar -->
<section class="stats-bar">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number" data-count="<?php echo $total_products; ?>" data-suffix="+">0</div>
                <div class="stat-label">Seedling Varieties</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-count="47" data-suffix="+">0</div>
                <div class="stat-label">Counties Served</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-count="5000" data-suffix="+">0</div>
                <div class="stat-label">Happy Farmers</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-count="10" data-suffix="+">0</div>
                <div class="stat-label">Years Experience</div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="section" id="about">
    <div class="container">
        <div class="about-grid">
            <div class="about-img-wrap fade-in">
                <img src="images/about6.jpg" alt="Agrisherry Farm - Quality Fruit Seedlings">
                <div class="about-badge">
                    <span class="big">100%</span>
                    <span class="small">Grafted & Certified</span>
                </div>
            </div>
            <div class="about-content fade-in">
                <span class="label">About Agrisherry</span>
                <h2>Transforming Agriculture Through Quality Seedlings</h2>
                <p>At Agrisherry & Agritracy Fruit Seedlings Kenya, we are dedicated to empowering farmers of all scales — from smallholder to large-scale — to build profitable, sustainable fruit farms.</p>
                <p>Located along the Nairobi–Nyeri Highway near River Sagana (Kwa Samaki), our farm produces premium grafted seedlings that are healthy, true-to-type, and ready for transplanting.</p>
                <div class="about-features">
                    <div class="about-feature">
                        <i class="fas fa-certificate"></i>
                        <div>
                            <h5>Certified Grafting</h5>
                            <p>All seedlings are properly grafted from proven parent stock</p>
                        </div>
                    </div>
                    <div class="about-feature">
                        <i class="fas fa-truck"></i>
                        <div>
                            <h5>Nationwide Delivery</h5>
                            <p>We deliver to all 47 counties and internationally</p>
                        </div>
                    </div>
                    <div class="about-feature">
                        <i class="fas fa-comments"></i>
                        <div>
                            <h5>Expert Guidance</h5>
                            <p>Free planting & care advice with every purchase</p>
                        </div>
                    </div>
                    <div class="about-feature">
                        <i class="fas fa-leaf"></i>
                        <div>
                            <h5>Wide Variety</h5>
                            <p><?php echo $total_products; ?>+ varieties including rare exotic fruits</p>
                        </div>
                    </div>
                </div>
                <a href="https://wa.me/254723693591?text=Hello%20Agrisherry,%20I%20want%20to%20learn%20more" class="btn-primary" target="_blank">
                    <i class="fab fa-whatsapp"></i> Talk to Us
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Shop by Category -->
<section class="section section-alt">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-eyebrow">Browse by Category</span>
            <h2 class="section-title">Find the Right <span>Seedling</span></h2>
            <div class="divider"></div>
        </div>
        <div class="categories-grid fade-in">
            <?php
            $categories = [
                ['name' => 'Avocados',          'icon' => '🥑'],
                ['name' => 'Mangoes',            'icon' => '🥭'],
                ['name' => 'Citrus',             'icon' => '🍊'],
                ['name' => 'Berries',            'icon' => '🍓'],
                ['name' => 'Bananas',            'icon' => '🍌'],
                ['name' => 'Passion & Specialty','icon' => '💛'],
                ['name' => 'Exotic',             'icon' => '🌴'],
                ['name' => 'Nuts',               'icon' => '🌰'],
                ['name' => 'Guavas',             'icon' => '🍈'],
                ['name' => 'Apples & Temperate', 'icon' => '🍎'],
                ['name' => 'Pawpaw',             'icon' => '🌿'],
            ];
            foreach ($categories as $cat):
                $count = $cat_counts[$cat['name']] ?? 0;
            ?>
            <a href="shop.php?category=<?php echo urlencode($cat['name']); ?>" class="category-card fade-in">
                <div class="category-icon"><?php echo $cat['icon']; ?></div>
                <div class="category-name"><?php echo htmlspecialchars($cat['name']); ?></div>
                <?php if ($count > 0): ?>
                <div class="category-count"><?php echo $count; ?> varieties</div>
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="section" id="featured">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-eyebrow">Top Picks</span>
            <h2 class="section-title">Featured <span>Seedlings</span></h2>
            <p class="section-desc">Our most popular, high-demand fruit seedlings. All grafted, all quality-guaranteed.</p>
            <div class="divider"></div>
        </div>
        <div class="products-grid">
            <?php
            $emoji_map = [
                'Avocados' => '🥑', 'Mangoes' => '🥭', 'Citrus' => '🍊',
                'Berries' => '🍓', 'Bananas' => '🍌', 'Passion & Specialty' => '💛',
                'Exotic' => '🌴', 'Nuts' => '🌰', 'Guavas' => '🍈',
                'Apples & Temperate' => '🍎', 'Pawpaw' => '🌿',
            ];
            while ($product = $featured->fetch_assoc()):
                $emoji = $emoji_map[$product['category']] ?? '🌱';
                $wa_msg = urlencode("Hello Agrisherry, I am interested in " . $product['whatsapp_text'] . ". Please assist.");
            ?>
            <div class="product-card fade-in" data-name="<?php echo htmlspecialchars($product['name']); ?>" data-category="<?php echo htmlspecialchars($product['category']); ?>" data-price="<?php echo $product['price']; ?>">
                <div class="product-img">
                    <?php if (!empty($product['image']) && file_exists($product['image'])): ?>
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <?php else: ?>
                        <?php echo $emoji; ?>
                    <?php endif; ?>
                    <span class="product-badge">⭐ Featured</span>
                </div>
                <div class="product-body">
                    <div class="product-category"><?php echo htmlspecialchars($product['category']); ?></div>
                    <h3 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p class="product-desc"><?php echo htmlspecialchars($product['description']); ?></p>
                    <div class="product-footer">
                        <div class="product-price">Ksh <?php echo number_format($product['price']); ?> <span>/seedling</span></div>
                        <a href="https://wa.me/254723693591?text=<?php echo $wa_msg; ?>" class="btn-order" target="_blank">
                            <i class="fab fa-whatsapp"></i> Order
                        </a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div style="text-align:center; margin-top:40px;" class="fade-in">
            <a href="shop.php" class="btn-primary"><i class="fas fa-store"></i> View All Seedlings</a>
        </div>
    </div>
</section>

<!-- Delivery Section -->
<section class="section section-alt" id="delivery">
    <div class="container">
        <div class="delivery-grid">
            <div class="delivery-content fade-in">
                <span class="label">Nationwide & International</span>
                <h2>We Deliver to Your Farm</h2>
                <p>Based near River Sagana on the Nairobi-Nyeri Highway, we can arrange delivery of healthy seedlings anywhere in Kenya and internationally. Our seedlings are carefully packaged to survive transit.</p>

                <div class="delivery-steps">
                    <div class="delivery-step">
                        <div class="step-num">1</div>
                        <div class="step-info">
                            <h5>Browse & Select</h5>
                            <p>Choose from our <?php echo $total_products; ?>+ seedling varieties in the shop</p>
                        </div>
                    </div>
                    <div class="delivery-step">
                        <div class="step-num">2</div>
                        <div class="step-info">
                            <h5>WhatsApp or Call Us</h5>
                            <p>Contact us on +254 723 693591 with your order and location</p>
                        </div>
                    </div>
                    <div class="delivery-step">
                        <div class="step-num">3</div>
                        <div class="step-info">
                            <h5>Confirm & Pay</h5>
                            <p>We confirm availability, delivery cost, and M-Pesa payment details</p>
                        </div>
                    </div>
                    <div class="delivery-step">
                        <div class="step-num">4</div>
                        <div class="step-info">
                            <h5>Receive Your Seedlings</h5>
                            <p>Carefully packaged seedlings delivered to your county or farm</p>
                        </div>
                    </div>
                </div>

                <div class="delivery-locations">
                    <div class="loc-chip"><i class="fas fa-map-marker-alt"></i> Nairobi</div>
                    <div class="loc-chip"><i class="fas fa-map-marker-alt"></i> Nyeri</div>
                    <div class="loc-chip"><i class="fas fa-map-marker-alt"></i> Meru</div>
                    <div class="loc-chip"><i class="fas fa-map-marker-alt"></i> Nakuru</div>
                    <div class="loc-chip"><i class="fas fa-map-marker-alt"></i> Kisumu</div>
                    <div class="loc-chip"><i class="fas fa-map-marker-alt"></i> All 47 Counties</div>
                </div>
            </div>
            <div class="delivery-map-img fade-in">
                <img src="images/busia.jpg" alt="Delivery locations across Kenya">
                <div style="background: var(--green-pale); padding: 20px; text-align: center;">
                    <p style="color: var(--text-mid); font-size: 0.9rem;">
                        <i class="fas fa-map-marker-alt" style="color: var(--red-brand);"></i>
                        <strong> Along Nairobi–Nyeri Highway</strong><br>
                        Near River Sagana (Kwa Samaki), Kenya
                    </p>
                    <a href="https://wa.me/254723693591?text=Hello,%20I%20want%20to%20inquire%20about%20delivery%20to%20my%20area" class="btn-primary" style="margin-top:14px; display:inline-flex;" target="_blank">
                        <i class="fas fa-truck"></i> Check Delivery to My Area
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<?php if ($testimonials->num_rows > 0): ?>
<section class="section" id="testimonials">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-eyebrow">Customer Reviews</span>
            <h2 class="section-title">What Our <span>Farmers Say</span></h2>
            <p class="section-desc">Hundreds of farmers trust Agrisherry for quality seedlings and expert support.</p>
            <div class="divider"></div>
        </div>
        <div class="testimonials-grid">
            <?php while ($t = $testimonials->fetch_assoc()): ?>
            <div class="testimonial-card fade-in">
                <div class="testimonial-stars">
                    <?php for ($i = 0; $i < $t['rating']; $i++) echo '★'; ?>
                </div>
                <p class="testimonial-text">"<?php echo htmlspecialchars($t['message']); ?>"</p>
                <div class="testimonial-author">
                    <div class="author-avatar">🌱</div>
                    <div>
                        <div class="author-name"><?php echo htmlspecialchars($t['name']); ?></div>
                        <div class="author-location"><i class="fas fa-map-marker-alt" style="font-size:0.7rem;"></i> <?php echo htmlspecialchars($t['location']); ?></div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Banner -->
<section class="cta-banner">
    <div class="container">
        <h2>Ready to Start or Expand Your Fruit Farm?</h2>
        <p>Get premium grafted seedlings with expert planting advice. Call or WhatsApp us today!</p>
        <div class="cta-btns">
            <a href="https://wa.me/254723693591?text=Hello%20Agrisherry,%20I%20want%20to%20order%20seedlings" class="btn-gold" target="_blank">
                <i class="fab fa-whatsapp"></i> Order on WhatsApp
            </a>
            <a href="shop.php" class="btn-white-outline">
                <i class="fas fa-seedling"></i> View All Seedlings
            </a>
            <a href="tel:+254723693591" class="btn-white-outline">
                <i class="fas fa-phone"></i> Call 0723-693591
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
