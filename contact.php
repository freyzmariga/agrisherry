<?php
require_once 'includes/db.php';
$page_title = 'Contact Us';

$success = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $phone   = trim($_POST['phone']   ?? '');
    $message = trim($_POST['message'] ?? '');
    $subject = trim($_POST['subject'] ?? '');

    if ($name && $message) {
        $stmt = $conn->prepare("INSERT INTO enquiries (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $full_msg = ($subject ? "[$subject] " : '') . $message;
        $stmt->bind_param('ssss', $name, $email, $phone, $full_msg);
        if ($stmt->execute()) {
            $success = "Thank you, $name! Your message has been received. We'll get back to you shortly on WhatsApp or phone.";
        } else {
            $error = 'Sorry, there was an error. Please try again or contact us directly on WhatsApp.';
        }
    } else {
        $error = 'Please fill in your name and message.';
    }
}

include 'includes/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1>Contact Us</h1>
        <p>We'd love to hear from you — call, WhatsApp, or send us a message</p>
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span>Contact</span>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="contact-grid">

            <!-- Contact Info -->
            <div class="contact-info">
                <h3>Get In Touch</h3>
                <p style="color: var(--text-light); margin-bottom: 28px; font-size: 0.95rem;">
                    Whether you're a smallholder looking for a few seedlings or a large farm needing bulk orders — we're here to help. Reach out on WhatsApp for the fastest response.
                </p>
                <div class="contact-info-items">
                    <div class="contact-info-item fade-in">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="contact-item-text">
                            <h5>Farm Location</h5>
                            <p>Along Nairobi–Nyeri Highway,<br>Near River Sagana (Kwa Samaki), Kenya</p>
                        </div>
                    </div>
                    <div class="contact-info-item fade-in">
                        <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                        <div class="contact-item-text">
                            <h5>WhatsApp (Fastest)</h5>
                            <a href="https://wa.me/254723693591" target="_blank">+254 723 693591</a>
                        </div>
                    </div>
                    <div class="contact-info-item fade-in">
                        <div class="contact-icon"><i class="fas fa-phone"></i></div>
                        <div class="contact-item-text">
                            <h5>Phone / Call</h5>
                            <a href="tel:+254723693591">0723-693591</a><br>
                            <a href="tel:+254723693591">+254 723 693591</a>
                        </div>
                    </div>
                    <div class="contact-info-item fade-in">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div class="contact-item-text">
                            <h5>Email</h5>
                            <a href="mailto:agrisherryfruitseedlings@gmail.com">agrisherryfruitseedlings@gmail.com</a>
                        </div>
                    </div>
                    <div class="contact-info-item fade-in">
                        <div class="contact-icon"><i class="fab fa-facebook-f"></i></div>
                        <div class="contact-item-text">
                            <h5>Facebook</h5>
                            <a href="https://www.facebook.com/profile.php?id=100049991118279" target="_blank">Agrisherry Fruit Seedlings</a>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 36px; background: var(--green-pale); border-radius: var(--radius); padding: 24px;">
                    <h4 style="margin-bottom: 12px; color: var(--green-dark);">🚚 Delivery Available</h4>
                    <p style="font-size: 0.88rem; color: var(--text-mid);">We deliver to all 47 counties in Kenya and internationally. Contact us to arrange delivery to your area.</p>
                    <a href="https://wa.me/254723693591?text=Hello%20Agrisherry,%20I%20want%20to%20inquire%20about%20delivery%20to%20my%20area" class="btn-primary" style="margin-top: 14px; display: inline-flex; font-size: 0.85rem;" target="_blank">
                        <i class="fab fa-whatsapp"></i> Ask About Delivery
                    </a>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form fade-in">
                <h3>Send Us a Message</h3>

                <?php if ($success): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>
                <?php if ($error): ?>
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="POST" id="contactForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Your Name *</label>
                            <input type="text" id="name" name="name" placeholder="e.g. James Mwangi" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone / WhatsApp</label>
                            <input type="tel" id="phone" name="phone" placeholder="+254 7XX XXX XXX" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="your@email.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select id="subject" name="subject">
                            <option value="">Select a topic...</option>
                            <option value="Seedling Enquiry">Seedling Enquiry</option>
                            <option value="Bulk Order">Bulk Order</option>
                            <option value="Delivery">Delivery / Shipping</option>
                            <option value="Planting Advice">Planting Advice</option>
                            <option value="Price Enquiry">Price Enquiry</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" placeholder="Tell us what seedlings you need, your location, and quantity..." required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>

                <div style="text-align:center; margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--border);">
                    <p style="font-size: 0.85rem; color: var(--text-light);">Or reach us instantly on WhatsApp:</p>
                    <a href="https://wa.me/254723693591?text=Hello%20Agrisherry!" class="btn-primary" style="margin-top:10px; display:inline-flex; background: #25d366;" target="_blank">
                        <i class="fab fa-whatsapp"></i> Open WhatsApp Chat
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map embed placeholder -->
<div style="background: var(--off-white); padding: 40px 0;">
    <div class="container" style="text-align:center;">
        <h3 style="font-family: var(--font-display); color: var(--green-dark); margin-bottom: 8px;">📍 Find Us on the Map</h3>
        <p style="color: var(--text-light); margin-bottom: 20px; font-size: 0.9rem;">Along Nairobi–Nyeri Highway, near River Sagana (Kwa Samaki)</p>
        <div style="border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); max-width: 800px; margin: 0 auto;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.1!2d37.2!3d-0.67!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sSagana%2C%20Kenya!5e0!3m2!1sen!2ske!4v1"
                width="100%" height="380" style="border:0; display:block;"
                allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
