# AGRISHERRY FRUIT SEEDLINGS - PHP/MySQL Website
## Setup Instructions

### Requirements
- PHP 7.4+
- MySQL 5.7+ / MariaDB 10+
- Apache or Nginx with mod_rewrite (XAMPP/WAMP/Laragon work perfectly)

---

### Step 1: Set Up the Database

1. Open **phpMyAdmin** or your MySQL client
2. Run the file: `database_setup.sql`
   - This creates the database, tables, and seeds all products + testimonials automatically

---

### Step 2: Configure Database Connection

Open `includes/db.php` and update:
```php
define('DB_HOST', 'localhost');     // Usually localhost
define('DB_USER', 'root');          // Your MySQL username
define('DB_PASS', '');              // Your MySQL password
define('DB_NAME', 'agrisherry_db'); // Keep this as-is
```

---

### Step 3: Deploy Files

Place the entire `agrisherry/` folder in your web server root:
- **XAMPP**: `C:/xampp/htdocs/agrisherry/`
- **WAMP**:  `C:/wamp64/www/agrisherry/`
- **Linux**: `/var/www/html/agrisherry/`

Then visit: `http://localhost/agrisherry/`

---

### Step 4: Admin Panel

Visit: `http://localhost/agrisherry/admin/`

Default admin password: `agrisherry2024`

**IMPORTANT**: Change the password in `admin/index.php`:
```php
define('ADMIN_PASS', 'your-new-secure-password');
```

---

### File Structure
```
agrisherry/
├── index.php           → Homepage with hero, about, featured products
├── shop.php            → Full seedlings shop with search & filter
├── contact.php         → Contact form + location map
├── database_setup.sql  → Run this to set up MySQL database
│
├── css/
│   └── style.css       → All styles (responsive, modern)
│
├── js/
│   └── main.js         → Slider, filters, animations
│
├── images/             → All website images
│   └── logo.jpeg       → Agrisherry logo (replace with hi-res if needed)
│
├── includes/
│   ├── db.php          → Database connection config
│   ├── header.php      → Navbar + head section
│   └── footer.php      → Footer + floating WhatsApp button
│
└── admin/
    └── index.php       → Admin panel (view & manage enquiries)
```

---

### Features
- ✅ Full responsive design (mobile, tablet, desktop)
- ✅ Hero image slider with 3 slides
- ✅ MySQL product database with 65+ seedlings
- ✅ Shop page with live search, category filter, price range slider
- ✅ Full price list table with WhatsApp "Buy Now" buttons
- ✅ Contact form that saves to database
- ✅ Admin panel to view enquiries & reply via WhatsApp
- ✅ Animated stats counter
- ✅ Floating WhatsApp button on all pages
- ✅ Google Fonts, Font Awesome icons
- ✅ Smooth scroll, fade-in animations
- ✅ SEO meta tags

---

### Customization
- **Add products**: Insert rows into the `products` table in MySQL
- **Add testimonials**: Insert into the `testimonials` table
- **Change phone**: Search & replace `254723693591` in all files
- **Change email**: Search & replace `agrisherryfruitseedlings@gmail.com`
- **Hero images**: Replace `images/banner.jpg`, `banner3.jpg`, `banner6.jpg`

---

### For Live Hosting
Upload to any PHP/MySQL hosting (Hostinger, SiteGround, cPanel hosting, etc.)
The website works on any standard PHP web hosting plan.

Contact: +254 723 693591
