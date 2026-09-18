<?php
// Include database connection + header
include('../config/db_connect.php');
include('../includes/header.php');

// Fetch "About" section (only one row)
$about_sql = "SELECT * FROM about WHERE id = 1 LIMIT 1";
$about_result = $conn->query($about_sql);
$about = $about_result ? $about_result->fetch_assoc() : null;

// Fallbacks if no data yet
$profile_image = !empty($about['profile_image']) ? '../' . htmlspecialchars($about['profile_image']) : '../assets/default-profile.jpg';

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>

<!-- =========================================================
     PAGE
========================================================= -->

<div class="portfolio-page contact-page">

    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="hero-section contact-hero" id="home">

        <div class="hero-grid"></div>

        <div class="hero-glow hero-glow-one"></div>
        <div class="hero-glow hero-glow-two"></div>

        <div class="container hero-container">

            <div class="row align-items-center g-5">

                <div class="col-lg-8 mx-auto text-center">

                    <div class="hero-eyebrow" data-aos="fade-up">
                        <span class="eyebrow-dot"></span>
                        CONTACT • COLLABORATION • PROJECTS
                    </div>

                    <h1 class="hero-title contact-hero-title" data-aos="fade-up" data-aos-delay="100">
                        Get In <span class="accent">Touch</span>
                    </h1>

                    <p class="hero-description mx-auto" data-aos="fade-up" data-aos-delay="200">
                        Let's discuss your next project or collaboration opportunity
                    </p>

                </div>

            </div>

        </div>

        <a href="#contact" class="scroll-indicator">

            <span>Scroll to explore</span>

            <div class="scroll-line">
                <span></span>
            </div>

        </a>

    </section>


    <!-- =====================================================
         CONTACT SECTION
    ====================================================== -->

    <section class="contact-section" id="contact">

        <div class="container">

            <div class="contact-grid">

                <!-- ============ CONTACT INFO ============ -->
                <aside class="contact-info-card" data-aos="fade-right">

                    <div class="contact-info-profile">

                        <div class="contact-avatar">
                            <img
                                src="<?php echo $profile_image; ?>"
                                alt="Tuli Moses Kimatu"
                                onerror="this.src='../assets/default-profile.jpg';"
                            >
                            <span class="contact-avatar-ring"></span>
                        </div>

                        <h3>
                            Tuli Moses Kimatu
                        </h3>

                        <p>
                            Real Estate &amp; Web Systems Developer
                        </p>

                    </div>


                    <div class="contact-details-list">

                        <div class="contact-detail-item">

                            <div class="contact-detail-icon">
                                <i class="fas fa-location-dot"></i>
                            </div>

                            <div>
                                <span class="contact-detail-label">Location</span>
                                <strong class="contact-detail-value">Nairobi, Kenya</strong>
                            </div>

                        </div>

                        <div class="contact-detail-item">

                            <div class="contact-detail-icon">
                                <i class="fas fa-envelope"></i>
                            </div>

                            <div>
                                <span class="contact-detail-label">Email</span>
                                <strong class="contact-detail-value">kimatutulio@gmail.com</strong>
                            </div>

                        </div>

                        <div class="contact-detail-item">

                            <div class="contact-detail-icon">
                                <i class="fas fa-phone"></i>
                            </div>

                            <div>
                                <span class="contact-detail-label">Phone</span>
                                <strong class="contact-detail-value">+254 745 117 912</strong>
                            </div>

                        </div>

                        <div class="contact-detail-item">

                            <div class="contact-detail-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>

                            <div>
                                <span class="contact-detail-label">Education</span>
                                <strong class="contact-detail-value">JKUAT Real Estate</strong>
                            </div>

                        </div>

                    </div>


                    <div class="contact-socials">

                        <a
                            href="https://linkedin.com/in/kimatu-tuli"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="social-btn social-linkedin"
                            aria-label="LinkedIn"
                        >
                            <i class="fab fa-linkedin"></i>
                        </a>

                        <a
                            href="https://github.com/kimatu-tuli"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="social-btn social-github"
                            aria-label="GitHub"
                        >
                            <i class="fab fa-github"></i>
                        </a>

                        <a
                            href="https://twitter.com/kimatu-tuli"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="social-btn social-twitter"
                            aria-label="Twitter"
                        >
                            <i class="fab fa-twitter"></i>
                        </a>

                        <a
                            href="https://wa.me/254745117912"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="social-btn social-whatsapp"
                            aria-label="WhatsApp"
                        >
                            <i class="fab fa-whatsapp"></i>
                        </a>

                        <a
                            href="https://instagram.com/kimatu-tuli"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="social-btn social-instagram"
                            aria-label="Instagram"
                        >
                            <i class="fab fa-instagram"></i>
                        </a>

                        <a
                            href="https://facebook.com/kimatu-tuli"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="social-btn social-facebook"
                            aria-label="Facebook"
                        >
                            <i class="fab fa-facebook"></i>
                        </a>

                    </div>

                </aside>


                <!-- ============ CONTACT FORM ============ -->
                <div class="contact-form-card" data-aos="fade-left" data-aos-delay="150">

                    <div class="contact-form-header">

                        <span class="section-kicker">
                            SEND MESSAGE
                        </span>

                        <h2>
                            Let's Start a
                            <span>Conversation</span>
                        </h2>

                        <p>
                            I'll get back to you as soon as possible
                        </p>

                    </div>


                    <form
                        action="send_message.php"
                        method="POST"
                        class="needs-validation contact-form"
                        novalidate
                    >

                        <div class="form-row">

                            <div class="form-field" data-aos="fade-up" data-aos-delay="150">

                                <label for="name">
                                    Full Name *
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-input"
                                    placeholder="Your full name"
                                    required
                                >

                                <div class="invalid-feedback">
                                    Please provide your full name.
                                </div>

                            </div>

                            <div class="form-field" data-aos="fade-up" data-aos-delay="200">

                                <label for="email">
                                    Email Address *
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-input"
                                    placeholder="your.email@example.com"
                                    required
                                >

                                <div class="invalid-feedback">
                                    Please provide a valid email address.
                                </div>

                            </div>

                        </div>


                        <div class="form-field" data-aos="fade-up" data-aos-delay="250">

                            <label for="subject">
                                Subject *
                            </label>

                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                class="form-input"
                                placeholder="What is this regarding?"
                                required
                            >

                            <div class="invalid-feedback">
                                Please provide a subject for your message.
                            </div>

                        </div>


                        <div class="form-field" data-aos="fade-up" data-aos-delay="300">

                            <label for="message">
                                Message *
                            </label>

                            <textarea
                                id="message"
                                name="message"
                                class="form-input form-textarea"
                                rows="6"
                                placeholder="Tell me about your project or inquiry..."
                                required
                            ></textarea>

                            <div class="invalid-feedback">
                                Please provide a detailed message.
                            </div>

                        </div>


                        <div class="form-submit" data-aos="zoom-in" data-aos-delay="350">

                            <button
                                type="submit"
                                class="btn-primary-custom submit-btn"
                            >
                                <span>Send Message</span>
                                <i class="fas fa-paper-plane"></i>
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         QUICK CONTACT CARDS
    ====================================================== -->

    <section class="quick-section">

        <div class="container">

            <div class="section-heading text-center" data-aos="fade-up">

                <span class="section-kicker">
                    QUICK CONTACT
                </span>

                <h2>
                    Choose how you'd like to
                    <span>reach out.</span>
                </h2>

            </div>

            <div class="quick-grid">

                <div class="quick-card" data-aos="fade-up">

                    <div class="quick-icon quick-icon-blue">
                        <i class="fas fa-phone"></i>
                    </div>

                    <h4>Call Me</h4>

                    <p>Direct phone conversation</p>

                    <a
                        href="tel:+254745117912"
                        class="quick-btn quick-btn-blue"
                    >
                        <i class="fas fa-phone"></i>
                        <span>+254 745 117 912</span>
                    </a>

                </div>

                <div class="quick-card" data-aos="fade-up" data-aos-delay="100">

                    <div class="quick-icon quick-icon-green">
                        <i class="fab fa-whatsapp"></i>
                    </div>

                    <h4>WhatsApp</h4>

                    <p>Quick chat on WhatsApp</p>

                    <a
                        href="https://wa.me/254745117912"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="quick-btn quick-btn-green"
                    >
                        <i class="fab fa-whatsapp"></i>
                        <span>Start Chat</span>
                    </a>

                </div>

                <div class="quick-card" data-aos="fade-up" data-aos-delay="200">

                    <div class="quick-icon quick-icon-cyan">
                        <i class="fas fa-envelope"></i>
                    </div>

                    <h4>Email</h4>

                    <p>Send detailed message</p>

                    <a
                        href="mailto:kimatutulio@gmail.com"
                        class="quick-btn quick-btn-cyan"
                    >
                        <i class="fas fa-envelope"></i>
                        <span>Send Email</span>
                    </a>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CTA
    ====================================================== -->

    <section class="cta-section">

        <div class="cta-pattern"></div>

        <div class="container">

            <div class="cta-card" data-aos="zoom-in">

                <div class="cta-content">

                    <span class="section-kicker">
                        LET'S WORK TOGETHER
                    </span>

                    <h2>
                        Ready to
                        <span>Get Started?</span>
                    </h2>

                    <p>
                        Whether you need a website, real estate consultation, or GIS mapping services, I'm here to help.
                    </p>

                    <div class="cta-actions">

                        <a href="tel:+254745117912" class="btn-primary-custom light-button">
                            <span>Call Now</span>
                            <i class="fas fa-phone"></i>
                        </a>

                        <a
                            href="https://wa.me/254745117912"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="cta-phone"
                        >
                            <i class="fab fa-whatsapp"></i>
                            <span>WhatsApp</span>
                        </a>

                        <a href="mailto:kimatutulio@gmail.com" class="cta-phone">
                            <i class="fas fa-envelope"></i>
                            <span>Email Directly</span>
                        </a>

                    </div>

                </div>

                <div class="cta-decoration">

                    <div class="cta-circle circle-one"></div>
                    <div class="cta-circle circle-two"></div>

                    <div class="cta-code">
                        <span>&lt;</span>
                        <span>/</span>
                        <span>&gt;</span>
                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


<!-- =========================================================
     AOS CSS
========================================================= -->

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
>


<!-- =========================================================
     STYLES
========================================================= -->

<style>

:root {
    --portfolio-bg: #07111f;
    --portfolio-bg-2: #0a1626;
    --portfolio-surface: #0d1a2b;
    --portfolio-surface-2: #101f33;

    --portfolio-white: #f7faff;
    --portfolio-text: #dce6f3;
    --portfolio-muted: #91a2b8;

    --portfolio-blue: #4f8cff;
    --portfolio-blue-light: #76a7ff;
    --portfolio-cyan: #35d6b0;

    --portfolio-border: rgba(255, 255, 255, 0.09);
    --portfolio-border-light: rgba(255, 255, 255, 0.15);

    --portfolio-shadow:
        0 30px 80px rgba(0, 0, 0, 0.28);

    --portfolio-radius: 24px;

    --whatsapp-green: #25d366;
}

.portfolio-page {
    background: var(--portfolio-bg);
    color: var(--portfolio-text);
    overflow: hidden;
    font-family:
        Inter,
        -apple-system,
        BlinkMacSystemFont,
        "Segoe UI",
        Roboto,
        Helvetica,
        Arial,
        sans-serif;
}

.portfolio-page *,
.portfolio-page *::before,
.portfolio-page *::after {
    box-sizing: border-box;
}

.portfolio-page a {
    text-decoration: none;
}

.portfolio-page img {
    max-width: 100%;
}

.section-kicker {
    display: inline-flex;
    align-items: center;
    gap: 10px;

    color: var(--portfolio-blue-light);

    font-size: 0.72rem;
    font-weight: 800;
    letter-spacing: 0.18em;
    text-transform: uppercase;
}

.section-heading {
    margin-bottom: 45px;
}

.section-heading.text-center p {
    margin-right: auto;
    margin-left: auto;
}

.section-heading h2 {
    margin: 12px 0 0;

    color: white;

    font-size: clamp(2.1rem, 4vw, 3.5rem);
    font-weight: 800;
    line-height: 1.08;
    letter-spacing: -0.045em;
}

.section-heading h2 span {
    color: var(--portfolio-blue-light);
}


/* =========================================================
   HERO
========================================================= */

.hero-section {
    position: relative;
    min-height: calc(100vh - 70px);

    display: flex;
    align-items: center;

    padding: 100px 0 110px;

    background:
        radial-gradient(circle at 75% 20%, rgba(79, 140, 255, 0.13), transparent 30%),
        radial-gradient(circle at 15% 75%, rgba(53, 214, 176, 0.07), transparent 30%),
        var(--portfolio-bg);
}

.contact-hero {
    min-height: 70vh;
}

.hero-grid {
    position: absolute;
    inset: 0;

    opacity: 0.35;

    background-image:
        linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);

    background-size: 55px 55px;

    mask-image: linear-gradient(to bottom, black, transparent 90%);
}

.hero-glow {
    position: absolute;
    border-radius: 50%;
    filter: blur(2px);
    pointer-events: none;
}

.hero-glow-one {
    width: 260px; height: 260px;
    top: 10%; right: 8%;
    border: 1px solid rgba(79, 140, 255, 0.08);
    animation: slowFloat 8s ease-in-out infinite;
}

.hero-glow-two {
    width: 180px; height: 180px;
    bottom: 10%; left: 3%;
    border: 1px solid rgba(53, 214, 176, 0.07);
    animation: slowFloat 10s ease-in-out infinite reverse;
}

.hero-container {
    position: relative;
    z-index: 2;
}

.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    padding: 8px 13px;

    border: 1px solid var(--portfolio-border);
    border-radius: 50px;

    background: rgba(255,255,255,0.025);

    color: #b8c8db;

    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.14em;
}

.eyebrow-dot {
    width: 7px;
    height: 7px;

    border-radius: 50%;

    background: var(--portfolio-cyan);

    box-shadow:
        0 0 0 5px rgba(53,214,176,0.08),
        0 0 18px rgba(53,214,176,0.5);

    animation: dotPulse 2.2s ease-in-out infinite;
}

.hero-title {
    margin: 27px 0 14px;

    color: var(--portfolio-white);

    font-size: clamp(3rem, 6vw, 5.5rem);
    font-weight: 800;
    line-height: 0.98;
    letter-spacing: -0.055em;
}

.contact-hero-title {
    font-size: clamp(2.6rem, 6vw, 5rem);
    text-align: center;
}

.hero-title .accent {
    color: var(--portfolio-blue-light);
}

.hero-description {
    max-width: 680px;

    margin: 23px 0 0;

    color: var(--portfolio-muted);

    font-size: 1.05rem;
    line-height: 1.85;
}

.hero-description.mx-auto {
    margin-left: auto;
    margin-right: auto;
}


/* =========================================================
   SCROLL INDICATOR
========================================================= */

.scroll-indicator {
    position: absolute;

    bottom: 28px;
    left: 50%;

    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 9px;

    transform: translateX(-50%);

    color: #61748a;

    font-size: 0.6rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
}

.scroll-line {
    width: 1px;
    height: 35px;
    overflow: hidden;
    background: rgba(255,255,255,0.12);
}

.scroll-line span {
    display: block;
    width: 100%;
    height: 12px;
    background: var(--portfolio-blue);
    animation: scrollDown 1.7s ease-in-out infinite;
}


/* =========================================================
   CONTACT SECTION
========================================================= */

.contact-section {
    padding: 80px 0 120px;
    background: #091523;
}

.contact-grid {
    display: grid;
    grid-template-columns: minmax(0, 0.85fr) minmax(0, 1.15fr);
    gap: 24px;

    align-items: start;
}


/* =========================================================
   CONTACT INFO CARD
========================================================= */

.contact-info-card {
    padding: 32px;

    border: 1px solid var(--portfolio-border);
    border-radius: 22px;

    background: var(--portfolio-surface);

    transition:
        transform 0.3s ease,
        border-color 0.3s ease;
}

.contact-info-card:hover {
    transform: translateY(-4px);
    border-color: rgba(79,140,255,0.22);
}

.contact-info-profile {
    text-align: center;

    padding-bottom: 24px;
    margin-bottom: 24px;

    border-bottom: 1px solid var(--portfolio-border);
}

.contact-avatar {
    position: relative;

    display: inline-block;

    margin-bottom: 16px;
}

.contact-avatar img {
    display: block;

    width: 110px;
    height: 110px;

    object-fit: cover;

    border: 3px solid var(--portfolio-surface);
    border-radius: 50%;

    box-shadow: 0 0 0 3px rgba(79,140,255,0.35);
}

.contact-avatar-ring {
    position: absolute;
    inset: -8px;

    border: 1px solid rgba(79,140,255,0.22);
    border-radius: 50%;

    pointer-events: none;

    animation: avatarPulse 3s ease-in-out infinite;
}

@keyframes avatarPulse {
    0%, 100% {
        transform: scale(1);
        opacity: 0.6;
    }
    50% {
        transform: scale(1.06);
        opacity: 1;
    }
}

.contact-info-profile h3 {
    margin: 0 0 6px;

    color: white;

    font-size: 1.25rem;
    font-weight: 800;
    letter-spacing: -0.02em;
}

.contact-info-profile p {
    margin: 0;

    color: var(--portfolio-blue-light);

    font-size: 0.78rem;
    font-weight: 650;
}


/* =========================================================
   CONTACT DETAILS
========================================================= */

.contact-details-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.contact-detail-item {
    display: flex;
    align-items: center;
    gap: 14px;

    padding: 12px 14px;

    border: 1px solid transparent;
    border-radius: 14px;

    background: rgba(255,255,255,0.02);

    transition:
        background 0.25s ease,
        border-color 0.25s ease,
        transform 0.25s ease;
}

.contact-detail-item:hover {
    background: rgba(255,255,255,0.04);
    border-color: rgba(79,140,255,0.3);
    transform: translateX(4px);
}

.contact-detail-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    flex: 0 0 auto;

    width: 42px;
    height: 42px;

    border-radius: 12px;

    background: rgba(79,140,255,0.1);

    color: var(--portfolio-blue-light);

    font-size: 0.9rem;
}

.contact-detail-label {
    display: block;

    color: #75889e;

    font-size: 0.6rem;
    font-weight: 750;
    letter-spacing: 0.12em;
    text-transform: uppercase;
}

.contact-detail-value {
    display: block;

    margin-top: 2px;

    color: #e5edf8;

    font-size: 0.8rem;
    font-weight: 650;

    word-break: break-word;
}


/* =========================================================
   SOCIALS
========================================================= */

.contact-socials {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 8px;

    margin-top: 22px;
    padding-top: 22px;

    border-top: 1px solid var(--portfolio-border);
}

.social-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    width: 40px;
    height: 40px;

    border: 1px solid var(--portfolio-border-light);
    border-radius: 11px;

    background: rgba(255,255,255,0.02);

    color: #b3c3d6;

    font-size: 0.9rem;

    transition:
        transform 0.25s ease,
        background 0.25s ease,
        border-color 0.25s ease,
        color 0.25s ease;
}

.social-btn:hover {
    transform: translateY(-3px);
    color: white;
    border-color: rgba(79,140,255,0.35);
    background: rgba(79,140,255,0.1);
}

.social-btn.social-linkedin:hover {
    background: rgba(0, 119, 181, 0.2);
    border-color: rgba(0, 119, 181, 0.5);
    color: #4ea8ff;
}

.social-btn.social-github:hover {
    background: rgba(255,255,255,0.08);
    border-color: rgba(255,255,255,0.3);
    color: white;
}

.social-btn.social-twitter:hover {
    background: rgba(29, 161, 242, 0.18);
    border-color: rgba(29, 161, 242, 0.5);
    color: #4db8ff;
}

.social-btn.social-whatsapp:hover {
    background: rgba(37, 211, 102, 0.18);
    border-color: rgba(37, 211, 102, 0.5);
    color: var(--whatsapp-green);
}

.social-btn.social-instagram:hover {
    background:
        linear-gradient(
            45deg,
            rgba(240, 148, 51, 0.2),
            rgba(188, 24, 136, 0.2)
        );
    border-color: rgba(220, 39, 67, 0.5);
    color: #ff6f9c;
}

.social-btn.social-facebook:hover {
    background: rgba(24, 119, 242, 0.18);
    border-color: rgba(24, 119, 242, 0.5);
    color: #4da0ff;
}


/* =========================================================
   CONTACT FORM
========================================================= */

.contact-form-card {
    padding: 40px;

    border: 1px solid var(--portfolio-border);
    border-radius: 22px;

    background: var(--portfolio-surface);
}

.contact-form-header {
    text-align: center;

    margin-bottom: 34px;
}

.contact-form-header h2 {
    margin: 12px 0 8px;

    color: white;

    font-size: clamp(1.6rem, 3vw, 2.2rem);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.035em;
}

.contact-form-header h2 span {
    color: var(--portfolio-blue-light);
}

.contact-form-header p {
    margin: 0;

    color: var(--portfolio-muted);

    font-size: 0.85rem;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.form-field {
    display: flex;
    flex-direction: column;
}

.form-field label {
    margin-bottom: 8px;

    color: #cddcec;

    font-size: 0.72rem;
    font-weight: 750;
    letter-spacing: 0.06em;
    text-transform: uppercase;
}

.form-input {
    display: block;

    width: 100%;

    padding: 14px 16px;

    border: 1px solid var(--portfolio-border-light);
    border-radius: 12px;

    background: rgba(255,255,255,0.02);

    color: #e5edf8;

    font-size: 0.88rem;
    font-family: inherit;

    outline: none;

    transition:
        border-color 0.2s ease,
        background 0.2s ease,
        box-shadow 0.2s ease;
}

.form-input::placeholder {
    color: #5f738a;
}

.form-input:focus {
    border-color: var(--portfolio-blue);
    background: rgba(79,140,255,0.05);
    box-shadow: 0 0 0 4px rgba(79,140,255,0.12);
}

.form-textarea {
    resize: vertical;
    min-height: 140px;
    line-height: 1.7;
}

.invalid-feedback {
    display: none;

    margin-top: 6px;

    color: #ff7a95;

    font-size: 0.7rem;
    font-weight: 600;
}

.was-validated .form-input:invalid,
.form-input.is-invalid {
    border-color: rgba(255, 92, 124, 0.6);
    background: rgba(255, 92, 124, 0.06);
}

.was-validated .form-input:invalid ~ .invalid-feedback,
.form-input.is-invalid ~ .invalid-feedback {
    display: block;
}

.was-validated .form-input:valid,
.form-input.is-valid {
    border-color: rgba(53, 214, 176, 0.5);
}


/* =========================================================
   FORM SUBMIT
========================================================= */

.form-submit {
    margin-top: 10px;
}

.btn-primary-custom {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 13px;

    min-height: 54px;

    padding: 0 26px;

    border: 1px solid var(--portfolio-blue);
    border-radius: 12px;

    background:
        linear-gradient(
            135deg,
            var(--portfolio-blue),
            #6a7dff
        );

    color: white;

    font-size: 0.9rem;
    font-weight: 800;
    letter-spacing: 0.02em;

    cursor: pointer;

    box-shadow:
        0 14px 32px rgba(79,140,255,0.28),
        inset 0 1px 0 rgba(255,255,255,0.15);

    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        background 0.25s ease;
}

.btn-primary-custom:hover {
    transform: translateY(-3px);

    background:
        linear-gradient(
            135deg,
            #5c96ff,
            #7a8bff
        );

    color: white;

    box-shadow:
        0 20px 45px rgba(79,140,255,0.4),
        inset 0 1px 0 rgba(255,255,255,0.2);
}

.submit-btn {
    width: 100%;

    position: relative;
    overflow: hidden;
}

.submit-btn::after {
    content: '';
    position: absolute;

    top: 50%;
    left: 50%;

    width: 0;
    height: 0;

    border-radius: 50%;

    background: rgba(255,255,255,0.2);

    transform: translate(-50%, -50%);

    transition: width 0.6s ease, height 0.6s ease;
}

.submit-btn:hover::after {
    width: 400px;
    height: 400px;
}


/* =========================================================
   QUICK CONTACT SECTION
========================================================= */

.quick-section {
    padding: 100px 0;
    background: var(--portfolio-bg);
}

.quick-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.quick-card {
    display: flex;
    flex-direction: column;
    align-items: center;

    padding: 34px 24px;

    text-align: center;

    border: 1px solid var(--portfolio-border);
    border-radius: 22px;

    background: var(--portfolio-surface);

    transition:
        transform 0.3s ease,
        border-color 0.3s ease;
}

.quick-card:hover {
    transform: translateY(-7px);
    border-color: rgba(79,140,255,0.22);
}

.quick-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 64px;
    height: 64px;

    margin-bottom: 20px;

    border-radius: 18px;

    font-size: 1.5rem;
}

.quick-icon-blue {
    background: rgba(79,140,255,0.12);
    color: var(--portfolio-blue-light);
}

.quick-icon-green {
    background: rgba(37, 211, 102, 0.12);
    color: var(--whatsapp-green);
}

.quick-icon-cyan {
    background: rgba(53, 214, 176, 0.12);
    color: var(--portfolio-cyan);
}

.quick-card h4 {
    margin: 0 0 8px;

    color: white;

    font-size: 1.1rem;
    font-weight: 800;
    letter-spacing: -0.015em;
}

.quick-card p {
    margin: 0 0 22px;

    color: var(--portfolio-muted);

    font-size: 0.8rem;
}

.quick-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;

    min-height: 48px;

    padding: 0 20px;

    border: 1px solid var(--portfolio-border-light);
    border-radius: 12px;

    background: rgba(255,255,255,0.025);

    color: #e5edf8;

    font-size: 0.82rem;
    font-weight: 750;

    transition:
        transform 0.25s ease,
        background 0.25s ease,
        border-color 0.25s ease,
        color 0.25s ease;
}

.quick-btn:hover {
    transform: translateY(-3px);
    color: white;
}

.quick-btn-blue:hover {
    border-color: rgba(79,140,255,0.5);
    background: rgba(79,140,255,0.12);
}

.quick-btn-green:hover {
    border-color: rgba(37, 211, 102, 0.5);
    background: rgba(37, 211, 102, 0.12);
    color: var(--whatsapp-green);
}

.quick-btn-cyan:hover {
    border-color: rgba(53, 214, 176, 0.5);
    background: rgba(53, 214, 176, 0.12);
    color: var(--portfolio-cyan);
}


/* =========================================================
   CTA
========================================================= */

.cta-section {
    padding: 90px 0 110px;
    background: #050d18;
}

.cta-card {
    position: relative;

    min-height: 360px;

    overflow: hidden;

    padding: 65px;

    border: 1px solid rgba(79,140,255,0.2);
    border-radius: 28px;

    background:
        radial-gradient(
            circle at 80% 50%,
            rgba(79,140,255,0.13),
            transparent 35%
        ),
        linear-gradient(135deg, #0c1b2e, #091625);
}

.cta-pattern {
    position: absolute;
    inset: 0;
    pointer-events: none;
    opacity: 0.2;
}

.cta-content {
    position: relative;
    z-index: 3;
    max-width: 700px;
}

.cta-content h2 {
    margin: 13px 0 17px;

    color: white;

    font-size: clamp(2.2rem, 4vw, 3.7rem);
    font-weight: 800;
    line-height: 1.04;
    letter-spacing: -0.05em;
}

.cta-content h2 span {
    color: var(--portfolio-blue-light);
}

.cta-content p {
    max-width: 600px;
    margin: 0;
    color: #8ea2b8;
    font-size: 0.88rem;
    line-height: 1.8;
}

.cta-actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 25px;

    margin-top: 29px;
}

.light-button {
    background: white;
    border-color: white;
    color: #07111f;
    box-shadow: none;

    background-image: none;
}

.light-button:hover {
    background: #eaf2ff;
    color: #07111f;
    background-image: none;
}

.cta-phone {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    color: #9db0c4;

    font-size: 0.76rem;
    font-weight: 700;

    transition: color 0.2s ease;
}

.cta-phone i {
    color: var(--portfolio-blue-light);
}

.cta-phone:hover {
    color: white;
}

.cta-decoration {
    position: absolute;
    z-index: 1;

    top: 0; right: 0; bottom: 0;

    width: 38%;
}

.cta-circle {
    position: absolute;

    border: 1px solid rgba(79,140,255,0.15);
    border-radius: 50%;
}

.circle-one {
    width: 300px; height: 300px;
    top: 30px; right: -80px;
}

.circle-two {
    width: 190px; height: 190px;
    top: 85px; right: -25px;
    border-color: rgba(53,214,176,0.12);
}

.cta-code {
    position: absolute;
    top: 50%; right: 80px;

    display: flex;
    align-items: center;
    gap: 9px;

    transform: translateY(-50%);

    color: rgba(118,167,255,0.3);

    font-family: monospace;
    font-size: 4rem;
    font-weight: 300;
}


/* =========================================================
   ANIMATIONS
========================================================= */

@keyframes blink {
    0%, 49% { opacity: 1; }
    50%, 100% { opacity: 0; }
}

@keyframes dotPulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.25); opacity: 0.65; }
}

@keyframes slowFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
}

@keyframes scrollDown {
    0% { transform: translateY(-15px); }
    50% { transform: translateY(15px); }
    100% { transform: translateY(35px); }
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 991px) {
    .hero-section {
        min-height: auto;
        padding: 90px 0 100px;
    }

    .contact-hero-title {
        font-size: clamp(2.2rem, 8vw, 3.6rem);
    }

    .contact-grid {
        grid-template-columns: 1fr;
    }

    .quick-grid {
        grid-template-columns: 1fr;
    }

    .cta-decoration { opacity: 0.5; }
}

@media (max-width: 767px) {
    .hero-section { padding: 70px 0 85px; }

    .hero-eyebrow { font-size: 0.6rem; }

    .contact-hero-title {
        font-size: clamp(2rem, 10vw, 3rem);
    }

    .hero-description { font-size: 0.9rem; }

    .scroll-indicator { display: none; }

    .contact-section,
    .quick-section {
        padding: 70px 0 85px;
    }

    .contact-info-card,
    .contact-form-card {
        padding: 24px;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .contact-avatar img {
        width: 96px;
        height: 96px;
    }

    .quick-icon {
        width: 56px;
        height: 56px;
        font-size: 1.3rem;
    }

    .cta-card {
        min-height: auto;
        padding: 40px 27px;
    }

    .cta-decoration { display: none; }

    .cta-actions {
        align-items: stretch;
        flex-direction: column;
        gap: 18px;
    }

    .cta-phone { justify-content: center; }
}

@media (max-width: 480px) {
    .contact-hero-title {
        font-size: 1.85rem;
    }

    .contact-info-profile h3 {
        font-size: 1.1rem;
    }

    .form-input {
        padding: 12px 14px;
        font-size: 0.84rem;
    }
}

@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        scroll-behavior: auto !important;
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

</style>


<!-- =========================================================
     SCRIPTS
========================================================= -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       AOS
    ====================================================== */

    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 700,
            easing: 'ease-out-cubic',
            once: true,
            offset: 70,
            disable: window.matchMedia(
                '(prefers-reduced-motion: reduce)'
            ).matches
        });
    }


    /* =====================================================
       FORM VALIDATION
    ====================================================== */

    const forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms).forEach(function (form) {

        form.addEventListener('submit', function (event) {

            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');

        }, false);

    });


    /* =====================================================
       SMOOTH SCROLL
    ====================================================== */

    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {

        anchor.addEventListener('click', function (event) {

            const targetId = this.getAttribute('href');

            if (!targetId || targetId === '#') return;

            const target = document.querySelector(targetId);
            if (!target) return;

            event.preventDefault();

            target.scrollIntoView({
                behavior: window.matchMedia(
                    '(prefers-reduced-motion: reduce)'
                ).matches ? 'auto' : 'smooth',
                block: 'start'
            });

        });

    });


    /* =====================================================
       PHONE CALL CONFIRMATION
    ====================================================== */

    document.querySelectorAll('a[href^="tel:"]').forEach(function (btn) {

        btn.addEventListener('click', function (e) {

            if (!confirm('Would you like to call Tuli Moses at +254 745 117 912?')) {
                e.preventDefault();
            }

        });

    });

});

</script>


<?php include('../includes/footer.php'); ?>