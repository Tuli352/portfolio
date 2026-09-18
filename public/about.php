<?php
// Include database connection + header
include('../config/db_connect.php');
include('../includes/header.php');

// Fetch "About" section (only one row) - same as index.php
$about_sql = "SELECT * FROM about WHERE id = 1 LIMIT 1";
$about_result = $conn->query($about_sql);
$about = $about_result ? $about_result->fetch_assoc() : null;

// Fallbacks if no data yet - same as index.php
$profile_image = !empty($about['profile_image']) ? '../' . htmlspecialchars($about['profile_image']) : '../assets/default-profile.jpg';
$summary = !empty($about['summary']) ? nl2br(htmlspecialchars($about['summary'])) : "Welcome to my portfolio!";
$cv_file = !empty($about['cv_file']) ? '../' . htmlspecialchars($about['cv_file']) : null;

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>

<!-- =========================================================
     PAGE
========================================================= -->

<div class="portfolio-page about-page">

    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="hero-section about-hero" id="home">

        <div class="hero-grid"></div>

        <div class="flashlight-wrap flashlight-left">
            <div class="flashlight-beam"></div>
            <div class="flashlight-core"></div>
            <div class="flashlight-flare">
                <span class="ray ray-h"></span>
                <span class="ray ray-v"></span>
                <span class="ray ray-d1"></span>
                <span class="ray ray-d2"></span>
            </div>
        </div>

        <div class="flashlight-wrap flashlight-right">
            <div class="flashlight-beam"></div>
            <div class="flashlight-core"></div>
            <div class="flashlight-flare">
                <span class="ray ray-h"></span>
                <span class="ray ray-v"></span>
                <span class="ray ray-d1"></span>
                <span class="ray ray-d2"></span>
            </div>
        </div>

        <div class="hero-glow hero-glow-one"></div>
        <div class="hero-glow hero-glow-two"></div>

        <div class="container hero-container">

            <div class="row align-items-center g-5">

                <!-- HERO CONTENT -->
                <div class="col-lg-7">

                    <div class="hero-eyebrow" data-aos="fade-up">
                        <span class="eyebrow-dot"></span>
                        SOFTWARE • REAL ESTATE • TECHNOLOGY
                    </div>

                    <h1 class="hero-title" data-aos="fade-up" data-aos-delay="100">
                        About
                        <span class="typing-wrapper">
                            <span class="typed-text"></span>
                            <span class="typing-cursor"></span>
                        </span>
                    </h1>

                    <div class="hero-role" data-aos="fade-up" data-aos-delay="200">
                        <span>My Journey in Real Estate</span>
                        <span class="role-divider">&amp;</span>
                        <span>Technology</span>
                    </div>

                    <!-- HERO ACTIONS (desktop) -->
                    <div class="hero-actions" data-aos="fade-up" data-aos-delay="400">

                        <a href="contact.php" class="btn-primary-custom">
                            <span>Contact Me</span>
                            <i class="fas fa-paper-plane"></i>
                        </a>

                        <?php if ($cv_file): ?>
                        <a
                            href="<?php echo $cv_file; ?>"
                            class="btn-outline-custom"
                            download
                        >
                            <span>Download CV</span>
                            <i class="fas fa-download"></i>
                        </a>
                        <?php endif; ?>

                    </div>

                </div>

                <!-- HERO PROFILE -->
                <div class="col-lg-5">

                    <div class="hero-profile-wrap" data-aos="fade-left" data-aos-delay="300">

                        <div class="profile-orbit orbit-one"></div>
                        <div class="profile-orbit orbit-two"></div>

                        <div class="profile-card">

                            <div class="profile-card-top">

                                <div class="availability">
                                    <span class="availability-dot"></span>
                                    Portfolio
                                </div>

                                <div class="profile-number">
                                    01
                                </div>

                            </div>

                            <div class="profile-image-wrap">

                                <div class="profile-image-ring"></div>

                                <img
                                    src="<?php echo $profile_image; ?>"
                                    alt="Tuli Moses Kimatu"
                                    class="profile-image"
                                    onerror="this.src='../assets/default-profile.jpg';"
                                >

                            </div>

                            <div class="profile-card-content">

                                <span class="profile-label">
                                    SOFTWARE • REAL ESTATE
                                </span>

                                <h2>
                                    Tuli Moses<br>
                                    <span>Kimatu</span>
                                </h2>

                                <p>
                                    Building digital systems while developing
                                    expertise in the real estate industry.
                                </p>

                            </div>

                            <div class="profile-tags">

                                <span>
                                    <i class="fas fa-code"></i>
                                    Software
                                </span>

                                <span>
                                    <i class="fas fa-building"></i>
                                    Real Estate
                                </span>

                                <span>
                                    <i class="fas fa-map-marked-alt"></i>
                                    GIS
                                </span>

                                <span>
                                    <i class="fas fa-brain"></i>
                                    AI
                                </span>

                            </div>

                        </div>

                        <div class="floating-card floating-card-one">

                            <div class="floating-icon">
                                <i class="fas fa-location-dot"></i>
                            </div>

                            <div>
                                <small>Based in</small>
                                <strong>Nairobi, Kenya</strong>
                            </div>

                        </div>

                        <div class="floating-card floating-card-two">

                            <div class="floating-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>

                            <div>
                                <small>Education</small>
                                <strong>JKUAT Real Estate</strong>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- HERO ACTIONS (mobile) -->
            <div class="hero-actions-mobile d-lg-none" data-aos="fade-up" data-aos-delay="400">

                <a href="contact.php" class="btn-primary-custom">
                    <span>Contact Me</span>
                    <i class="fas fa-paper-plane"></i>
                </a>

                <?php if ($cv_file): ?>
                <a
                    href="<?php echo $cv_file; ?>"
                    class="btn-outline-custom"
                    download
                >
                    <span>Download CV</span>
                    <i class="fas fa-download"></i>
                </a>
                <?php endif; ?>

            </div>

        </div>

        <a href="#story" class="scroll-indicator">

            <span>Scroll to explore</span>

            <div class="scroll-line">
                <span></span>
            </div>

        </a>

    </section>


    <!-- =====================================================
         MAIN ABOUT / MY STORY
    ====================================================== -->

    <section class="about-section" id="story">

        <div class="container">

            <div class="about-grid">

                <!-- IMAGE -->
                <div class="about-visual" data-aos="fade-right">

                    <div class="about-image-frame">

                        <div class="image-corner image-corner-one"></div>
                        <div class="image-corner image-corner-two"></div>

                        <img
                            src="<?php echo $profile_image; ?>"
                            alt="Tuli Moses Kimatu"
                            class="about-image"
                            onerror="this.src='../assets/default-profile.jpg';"
                        >

                        <div class="experience-badge">

                            <span class="badge-icon">
                                <i class="fas fa-code"></i>
                            </span>

                            <div>
                                <strong>Tech +</strong>
                                <small>Real Estate</small>
                            </div>

                        </div>

                    </div>

                </div>


                <!-- CONTENT -->
                <div class="about-content" data-aos="fade-left">

                    <span class="section-kicker">
                        MY STORY
                    </span>

                    <h2>
                        Innovating at the Intersection of
                        <span>Real Estate &amp; Technology</span>
                    </h2>

                    <div class="about-text">
                        <?php echo $summary; ?>
                    </div>

                    <!-- CONTACT INFO -->
                    <div class="about-focus-grid">

                        <div class="focus-item">
                            <i class="fas fa-location-dot"></i>
                            <div>
                                <strong>Nairobi, Kenya</strong>
                                <span>Location</span>
                            </div>
                        </div>

                        <div class="focus-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong>kimatutulio@gmail.com</strong>
                                <span>Email</span>
                            </div>
                        </div>

                        <div class="focus-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <strong>+254 745 117 912</strong>
                                <span>Phone</span>
                            </div>
                        </div>

                        <div class="focus-item">
                            <i class="fas fa-graduation-cap"></i>
                            <div>
                                <strong>JKUAT Real Estate</strong>
                                <span>Education</span>
                            </div>
                        </div>

                    </div>

                    <!-- CHECKLIST -->
                    <div class="about-checklist">

                        <span><i class="fas fa-check"></i> Full-Stack Development</span>
                        <span><i class="fas fa-check"></i> Real Estate Systems</span>
                        <span><i class="fas fa-check"></i> GIS &amp; Spatial Analysis</span>
                        <span><i class="fas fa-check"></i> AI Integration</span>
                        <span><i class="fas fa-check"></i> Database Design</span>
                        <span><i class="fas fa-check"></i> API Development</span>

                    </div>

                    <div class="about-actions">

                        <a href="contact.php" class="btn-primary-custom">
                            <span>Contact Me</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>

                        <?php if ($cv_file): ?>
                        <a
                            href="<?php echo $cv_file; ?>"
                            class="text-link"
                            download
                        >
                            <i class="fas fa-download"></i>
                            Download CV
                        </a>
                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         EDUCATION & QUALIFICATIONS
    ====================================================== -->

    <section class="education-section">

        <div class="container">

            <div class="section-heading text-center" data-aos="fade-up">

                <span class="section-kicker">
                    EDUCATION
                </span>

                <h2>
                    Education &amp;
                    <span>Qualifications</span>
                </h2>

                <p>
                    My academic journey and professional certifications
                </p>

            </div>

            <div class="timeline">

                <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">

                    <div class="timeline-icon">
                        <i class="fas fa-university"></i>
                    </div>

                    <div class="timeline-content">

                        <span class="timeline-kicker">CURRENT</span>

                        <h4>
                            Bachelor of Real Estate
                        </h4>

                        <p class="timeline-place">
                            Jomo Kenyatta University of Agriculture and Technology (JKUAT)
                        </p>

                        <p class="timeline-meta">
                            Currently in 3rd Year | Expected Graduation: 2026
                        </p>

                        <div class="career-skills">

                            <span>Property Management</span>
                            <span>GIS for Real Estate</span>
                            <span>Urban Planning</span>
                            <span>Real Estate Finance</span>
                            <span>Valuation</span>

                        </div>

                    </div>

                </div>

                <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">

                    <div class="timeline-icon">
                        <i class="fas fa-certificate"></i>
                    </div>

                    <div class="timeline-content">

                        <span class="timeline-kicker">CERTIFICATION</span>

                        <h4>
                            Computer Packages Certification (Distinction)
                        </h4>

                        <p class="timeline-place">
                            West Ford International Training College
                        </p>

                        <p class="timeline-meta">
                            Completed with outstanding performance
                        </p>

                    </div>

                </div>

                <div class="timeline-item" data-aos="fade-up" data-aos-delay="300">

                    <div class="timeline-icon">
                        <i class="fas fa-school"></i>
                    </div>

                    <div class="timeline-content">

                        <span class="timeline-kicker">SECONDARY</span>

                        <h4>
                            Kenya Certificate of Secondary Education (KCSE)
                        </h4>

                        <p class="timeline-place">
                            St. Peter's Nkuene Boys High School
                        </p>

                        <p class="timeline-meta">
                            Mean Grade: B+
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         SKILLS
    ====================================================== -->

    <section class="skills-section">

        <div class="container">

            <div class="section-heading" data-aos="fade-up">

                <span class="section-kicker">
                    SKILLS
                </span>

                <h2>
                    Technical &amp; Professional
                    <span>Skills</span>
                </h2>

                <p>
                    A blend of technical expertise and real estate knowledge
                </p>

            </div>

            <div class="skills-grid skills-grid-about">

                <!-- Web Development Skills -->
                <div class="skill-card skill-card-lg" data-aos="fade-up">

                    <div class="skill-number">01</div>

                    <div class="skill-icon">
                        <i class="fas fa-code"></i>
                    </div>

                    <h3>
                        Web Development
                    </h3>

                    <div class="skill-meter-list">

                        <div class="skill-meter-item">
                            <div class="skill-meter-item-top">
                                <span>PHP &amp; MySQL</span>
                                <span>90%</span>
                            </div>
                            <div class="skill-meter">
                                <div class="skill-meter-bar" style="width: 90%;"></div>
                            </div>
                        </div>

                        <div class="skill-meter-item">
                            <div class="skill-meter-item-top">
                                <span>JavaScript &amp; React</span>
                                <span>85%</span>
                            </div>
                            <div class="skill-meter">
                                <div class="skill-meter-bar" style="width: 85%;"></div>
                            </div>
                        </div>

                        <div class="skill-meter-item">
                            <div class="skill-meter-item-top">
                                <span>HTML5 &amp; CSS3</span>
                                <span>95%</span>
                            </div>
                            <div class="skill-meter">
                                <div class="skill-meter-bar" style="width: 95%;"></div>
                            </div>
                        </div>

                    </div>

                    <div class="skill-line"></div>

                </div>


                <!-- Real Estate & GIS Skills -->
                <div class="skill-card skill-card-lg" data-aos="fade-up" data-aos-delay="100">

                    <div class="skill-number">02</div>

                    <div class="skill-icon">
                        <i class="fas fa-map-location-dot"></i>
                    </div>

                    <h3>
                        Real Estate &amp; GIS
                    </h3>

                    <div class="skill-meter-list">

                        <div class="skill-meter-item">
                            <div class="skill-meter-item-top">
                                <span>ArcGIS &amp; Spatial Analysis</span>
                                <span>80%</span>
                            </div>
                            <div class="skill-meter">
                                <div class="skill-meter-bar" style="width: 80%;"></div>
                            </div>
                        </div>

                        <div class="skill-meter-item">
                            <div class="skill-meter-item-top">
                                <span>Property Valuation</span>
                                <span>75%</span>
                            </div>
                            <div class="skill-meter">
                                <div class="skill-meter-bar" style="width: 75%;"></div>
                            </div>
                        </div>

                        <div class="skill-meter-item">
                            <div class="skill-meter-item-top">
                                <span>Urban Planning</span>
                                <span>70%</span>
                            </div>
                            <div class="skill-meter">
                                <div class="skill-meter-bar" style="width: 70%;"></div>
                            </div>
                        </div>

                    </div>

                    <div class="skill-line"></div>

                </div>


                <!-- Database & AI Skills -->
                <div class="skill-card skill-card-lg" data-aos="fade-up" data-aos-delay="200">

                    <div class="skill-number">03</div>

                    <div class="skill-icon">
                        <i class="fas fa-database"></i>
                    </div>

                    <h3>
                        Database &amp; AI
                    </h3>

                    <div class="skill-meter-list">

                        <div class="skill-meter-item">
                            <div class="skill-meter-item-top">
                                <span>MySQL &amp; Firebase</span>
                                <span>85%</span>
                            </div>
                            <div class="skill-meter">
                                <div class="skill-meter-bar" style="width: 85%;"></div>
                            </div>
                        </div>

                        <div class="skill-meter-item">
                            <div class="skill-meter-item-top">
                                <span>API Integration</span>
                                <span>80%</span>
                            </div>
                            <div class="skill-meter">
                                <div class="skill-meter-bar" style="width: 80%;"></div>
                            </div>
                        </div>

                        <div class="skill-meter-item">
                            <div class="skill-meter-item-top">
                                <span>AI &amp; Automation</span>
                                <span>70%</span>
                            </div>
                            <div class="skill-meter">
                                <div class="skill-meter-bar" style="width: 70%;"></div>
                            </div>
                        </div>

                    </div>

                    <div class="skill-line"></div>

                </div>


                <!-- Professional Skills -->
                <div class="skill-card skill-card-lg" data-aos="fade-up" data-aos-delay="300">

                    <div class="skill-number">04</div>

                    <div class="skill-icon">
                        <i class="fas fa-people-arrows"></i>
                    </div>

                    <h3>
                        Professional Skills
                    </h3>

                    <div class="skill-meter-list">

                        <div class="skill-meter-item">
                            <div class="skill-meter-item-top">
                                <span>Communication</span>
                                <span>90%</span>
                            </div>
                            <div class="skill-meter">
                                <div class="skill-meter-bar" style="width: 90%;"></div>
                            </div>
                        </div>

                        <div class="skill-meter-item">
                            <div class="skill-meter-item-top">
                                <span>Project Management</span>
                                <span>85%</span>
                            </div>
                            <div class="skill-meter">
                                <div class="skill-meter-bar" style="width: 85%;"></div>
                            </div>
                        </div>

                        <div class="skill-meter-item">
                            <div class="skill-meter-item-top">
                                <span>Problem Solving</span>
                                <span>88%</span>
                            </div>
                            <div class="skill-meter">
                                <div class="skill-meter-bar" style="width: 88%;"></div>
                            </div>
                        </div>

                    </div>

                    <div class="skill-line"></div>

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
                        Ready to bring your project
                        <span>to life?</span>
                    </h2>

                    <p>
                        Ready to bring your real estate or web development project to life?
                    </p>

                    <div class="cta-actions">

                        <a href="contact.php" class="btn-primary-custom light-button">
                            <span>Get In Touch</span>
                            <i class="fas fa-handshake"></i>
                        </a>

                        <a href="projects.php" class="cta-phone">
                            <i class="fas fa-rocket"></i>
                            <span>View My Work</span>
                        </a>

                        <?php if ($cv_file): ?>
                        <a href="<?php echo $cv_file; ?>" class="cta-phone" download>
                            <i class="fas fa-download"></i>
                            <span>Download CV</span>
                        </a>
                        <?php endif; ?>

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

.about-hero {
    min-height: calc(100vh - 70px);
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

.flashlight-wrap {
    position: absolute;
    z-index: 1;

    top: -6%;

    width: 100px;
    height: 100px;

    pointer-events: none;

    opacity: 0;

    animation: flashlightIn 0.9s ease-out 0.15s forwards;
}

.flashlight-left { left: -6%; }
.flashlight-right { right: -6%; left: auto; }

.flashlight-right .flashlight-beam {
    transform-origin: 100% 0%;
    transform: scale(0.85) scaleX(-1);
}

.flashlight-beam {
    position: absolute;
    top: 50%;
    left: 50%;

    width: 1400px;
    height: 1400px;

    background: conic-gradient(
        from 25deg at 0% 0%,
        rgba(180, 210, 255, 0) 0deg,
        rgba(200, 222, 255, 0.16) 6deg,
        rgba(220, 235, 255, 0.30) 14deg,
        rgba(200, 222, 255, 0.14) 22deg,
        rgba(180, 210, 255, 0) 30deg,
        rgba(180, 210, 255, 0) 360deg
    );

    filter: blur(6px);

    transform-origin: 0% 0%;
    transform: scale(0.85);

    animation: beamFlicker 4s ease-in-out 1.1s infinite;
}

.flashlight-core {
    position: absolute;
    top: 50%;
    left: 50%;

    width: 46px;
    height: 46px;

    margin: -23px 0 0 -23px;

    border-radius: 50%;

    background: radial-gradient(
        circle,
        #ffffff 0%,
        #eaf3ff 22%,
        rgba(150, 195, 255, 0.75) 45%,
        rgba(120, 170, 255, 0.25) 68%,
        rgba(120, 170, 255, 0) 100%
    );

    box-shadow:
        0 0 20px 6px rgba(255,255,255,0.9),
        0 0 60px 20px rgba(140,185,255,0.55),
        0 0 120px 50px rgba(100,150,255,0.25);

    animation: coreFlicker 4s ease-in-out 1.1s infinite;
}

.flashlight-flare {
    position: absolute;
    top: 50%;
    left: 50%;

    width: 1px;
    height: 1px;
}

.flashlight-flare .ray {
    position: absolute;
    top: 50%;
    left: 50%;

    background: linear-gradient(
        to right,
        rgba(255,255,255,0.95),
        rgba(255,255,255,0.25) 35%,
        rgba(255,255,255,0)
    );
}

.ray-h { width: 220px; height: 2px; margin-top: -1px; }

.ray-v {
    width: 2px; height: 220px; margin-left: -1px;
    background: linear-gradient(
        to bottom,
        rgba(255,255,255,0.95),
        rgba(255,255,255,0.25) 35%,
        rgba(255,255,255,0)
    );
}

.ray-d1 {
    width: 170px; height: 1.5px; margin-top: -0.75px;
    transform: rotate(45deg); transform-origin: 0% 50%;
}

.ray-d2 {
    width: 170px; height: 1.5px; margin-top: -0.75px;
    transform: rotate(-45deg); transform-origin: 0% 50%;
}

@keyframes flashlightIn {
    0% { opacity: 0; transform: scale(0.4); }
    100% { opacity: 1; transform: scale(1); }
}

@keyframes coreFlicker {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.88; transform: scale(0.96); }
}

@keyframes beamFlicker {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.82; }
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

    max-width: 850px;

    color: var(--portfolio-white);

    font-size: clamp(3rem, 6vw, 5.5rem);
    font-weight: 800;
    line-height: 0.98;
    letter-spacing: -0.055em;
}

.typing-wrapper {
    display: block;
    min-height: 1em;
    color: var(--portfolio-blue-light);
}

.typed-text { display: inline; }

.typing-cursor {
    display: inline-block;
    width: 3px;
    height: 0.8em;
    margin-left: 5px;
    vertical-align: -0.05em;
    background: var(--portfolio-blue);
    animation: blink 0.9s step-end infinite;
}

.hero-role {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;

    color: #e7eef8;

    font-size: 0.98rem;
    font-weight: 600;
    line-height: 1.7;
}

.role-divider {
    color: var(--portfolio-blue);
    opacity: 0.6;
}

.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 13px;
    margin-top: 34px;
}

.hero-actions-mobile {
    display: none;
    flex-wrap: wrap;
    gap: 13px;
    margin-top: 30px;
    width: 100%;
}

.btn-primary-custom,
.btn-outline-custom {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 13px;

    min-height: 52px;

    padding: 0 22px;

    border-radius: 12px;

    font-size: 0.88rem;
    font-weight: 750;

    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        background 0.25s ease,
        border-color 0.25s ease;
}

.btn-primary-custom {
    border: 1px solid var(--portfolio-blue);
    background: var(--portfolio-blue);
    color: white;
    box-shadow: 0 10px 35px rgba(79,140,255,0.18);
}

.btn-primary-custom:hover {
    transform: translateY(-3px);
    background: #5c96ff;
    color: white;
    box-shadow: 0 18px 40px rgba(79,140,255,0.25);
}

.btn-outline-custom {
    border: 1px solid var(--portfolio-border-light);
    background: rgba(255,255,255,0.025);
    color: #e5edf8;
}

.btn-outline-custom:hover {
    transform: translateY(-3px);
    border-color: rgba(79,140,255,0.45);
    background: rgba(79,140,255,0.07);
    color: white;
}


/* =========================================================
   PROFILE CARD
========================================================= */

.hero-profile-wrap {
    position: relative;
    width: min(100%, 420px);
    margin: 0 auto;
}

.profile-card {
    position: relative;
    z-index: 3;

    overflow: hidden;

    padding: 20px;

    border: 1px solid var(--portfolio-border-light);
    border-radius: 30px;

    background:
        linear-gradient(145deg, rgba(255,255,255,0.07), rgba(255,255,255,0.018));

    box-shadow: var(--portfolio-shadow);

    backdrop-filter: blur(20px);

    animation: cardFloat 7s ease-in-out infinite;
}

.profile-card::before {
    content: "";

    position: absolute;

    width: 220px;
    height: 220px;

    top: -100px;
    right: -100px;

    border-radius: 50%;

    background: rgba(79,140,255,0.12);

    filter: blur(30px);
}

.profile-card-top {
    position: relative;
    z-index: 2;

    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-bottom: 18px;
}

.availability {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    color: #a9b9ca;

    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
}

.availability-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--portfolio-cyan);
}

.profile-number {
    color: #60738b;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.1em;
}

.profile-image-wrap {
    position: relative;

    display: flex;
    justify-content: center;

    min-height: 315px;

    overflow: hidden;

    border-radius: 22px;

    background: linear-gradient(145deg, #172940, #08111e);
}

.profile-image-wrap::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(7,17,31,0.65), transparent 45%);
    pointer-events: none;
}

.profile-image {
    position: relative;
    z-index: 1;

    width: 100%;
    height: 315px;

    object-fit: cover;
    object-position: center top;

    filter: saturate(0.9);

    transition: transform 0.6s ease;
}

.profile-card:hover .profile-image {
    transform: scale(1.035);
}

.profile-image-ring {
    position: absolute;
    z-index: 2;

    width: 260px;
    height: 260px;

    top: 30px;

    border: 1px solid rgba(79,140,255,0.25);
    border-radius: 50%;

    pointer-events: none;
}

.profile-card-content {
    position: relative;
    z-index: 2;

    padding: 23px 4px 17px;
}

.profile-label {
    color: var(--portfolio-blue-light);

    font-size: 0.63rem;
    font-weight: 800;
    letter-spacing: 0.16em;
}

.profile-card-content h2 {
    margin: 7px 0 8px;

    color: white;

    font-size: 2rem;
    line-height: 1.08;
    letter-spacing: -0.035em;
}

.profile-card-content h2 span {
    color: var(--portfolio-blue-light);
}

.profile-card-content p {
    max-width: 310px;
    margin: 0;
    color: var(--portfolio-muted);
    font-size: 0.82rem;
    line-height: 1.65;
}

.profile-tags {
    position: relative;
    z-index: 2;

    display: flex;
    flex-wrap: wrap;
    gap: 7px;

    padding-top: 5px;
}

.profile-tags span {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    padding: 7px 9px;

    border: 1px solid var(--portfolio-border);
    border-radius: 8px;

    background: rgba(255,255,255,0.025);

    color: #aebed0;

    font-size: 0.64rem;
    font-weight: 650;
}

.profile-tags i {
    color: var(--portfolio-blue-light);
    font-size: 0.58rem;
}

.floating-card {
    position: absolute;
    z-index: 5;

    display: flex;
    align-items: center;
    gap: 9px;

    padding: 10px 12px;

    border: 1px solid var(--portfolio-border-light);
    border-radius: 13px;

    background: rgba(10,23,39,0.86);

    box-shadow: 0 20px 40px rgba(0,0,0,0.2);

    backdrop-filter: blur(15px);

    animation: floatingCard 5s ease-in-out infinite;
}

.floating-card-one { top: 19%; left: -42px; }
.floating-card-two { right: -38px; bottom: 17%; animation-delay: -2s; }

.floating-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 30px;
    height: 30px;

    border-radius: 9px;

    background: rgba(79,140,255,0.12);

    color: var(--portfolio-blue-light);

    font-size: 0.72rem;
}

.floating-card small {
    display: block;
    color: #70849b;
    font-size: 0.55rem;
}

.floating-card strong {
    display: block;
    margin-top: 1px;
    color: #dfe9f4;
    font-size: 0.65rem;
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
   SECTION HEADINGS
========================================================= */

.section-heading {
    margin-bottom: 55px;
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

.section-heading p {
    max-width: 570px;
    margin-top: 16px;
    color: var(--portfolio-muted);
    line-height: 1.75;
}


/* =========================================================
   ABOUT
========================================================= */

.about-section {
    padding: 120px 0;
    background: #091523;
}

.about-grid {
    display: grid;
    grid-template-columns: 0.9fr 1.1fr;
    align-items: center;
    gap: 90px;
}

.about-image-frame {
    position: relative;

    max-width: 460px;

    padding: 12px;

    border: 1px solid var(--portfolio-border-light);
    border-radius: 28px;

    background: rgba(255,255,255,0.025);
}

.about-image {
    display: block;

    width: 100%;
    height: 510px;

    object-fit: cover;
    object-position: center top;

    border-radius: 19px;

    filter: saturate(0.9);
}

.image-corner {
    position: absolute;
    z-index: 2;

    width: 55px;
    height: 55px;

    border-color: var(--portfolio-blue);
}

.image-corner-one {
    top: -9px; left: -9px;
    border-top: 2px solid;
    border-left: 2px solid;
    border-radius: 12px 0 0 0;
}

.image-corner-two {
    right: -9px; bottom: -9px;
    border-right: 2px solid;
    border-bottom: 2px solid;
    border-radius: 0 0 12px 0;
}

.experience-badge {
    position: absolute;

    right: -32px;
    bottom: 35px;

    display: flex;
    align-items: center;
    gap: 10px;

    padding: 13px 15px;

    border: 1px solid var(--portfolio-border-light);
    border-radius: 13px;

    background: rgba(9,21,35,0.93);

    box-shadow: 0 20px 40px rgba(0,0,0,0.25);

    backdrop-filter: blur(12px);
}

.badge-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 35px;
    height: 35px;

    border-radius: 9px;

    background: rgba(79,140,255,0.1);

    color: var(--portfolio-blue-light);

    font-size: 0.75rem;
}

.experience-badge strong {
    display: block;
    color: white;
    font-size: 0.78rem;
}

.experience-badge small {
    display: block;
    color: #73869c;
    font-size: 0.6rem;
}

.about-content h2 {
    margin: 13px 0 22px;

    color: white;

    font-size: clamp(2.2rem, 4vw, 3.6rem);
    font-weight: 800;
    line-height: 1.05;
    letter-spacing: -0.05em;
}

.about-content h2 span {
    color: var(--portfolio-blue-light);
}

.about-text {
    max-width: 670px;
    color: var(--portfolio-muted);
    font-size: 0.92rem;
    line-height: 1.9;
}

.about-focus-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;

    margin-top: 30px;
}

.focus-item {
    display: flex;
    align-items: center;
    gap: 11px;

    padding: 13px;

    border: 1px solid var(--portfolio-border);
    border-radius: 12px;

    background: rgba(255,255,255,0.018);
}

.focus-item > i {
    color: var(--portfolio-blue-light);
    font-size: 0.85rem;
}

.focus-item strong {
    display: block;
    color: #dbe6f2;
    font-size: 0.72rem;
    word-break: break-word;
}

.focus-item span {
    display: block;
    margin-top: 2px;
    color: #6d8197;
    font-size: 0.6rem;
}

.about-checklist {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;

    margin-top: 22px;
}

.about-checklist span {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    padding: 8px 11px;

    border: 1px solid var(--portfolio-border);
    border-radius: 8px;

    background: rgba(255,255,255,0.018);

    color: #b3c3d6;

    font-size: 0.7rem;
    font-weight: 600;
}

.about-checklist i {
    color: var(--portfolio-cyan);
    font-size: 0.65rem;
}

.about-actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 25px;

    margin-top: 31px;
}

.text-link {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    color: #9eb0c4;

    font-size: 0.78rem;
    font-weight: 700;

    transition: color 0.2s ease;
}

.text-link:hover {
    color: white;
}


/* =========================================================
   EDUCATION TIMELINE
========================================================= */

.education-section {
    padding: 120px 0;
    background: var(--portfolio-bg);
}

.timeline {
    position: relative;

    max-width: 850px;

    margin: 0 auto;

    padding-left: 40px;
}

.timeline::before {
    content: "";

    position: absolute;

    top: 0;
    bottom: 0;
    left: 18px;

    width: 1px;

    background: linear-gradient(
        to bottom,
        rgba(79,140,255,0.5),
        rgba(79,140,255,0.05)
    );
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-icon {
    position: absolute;

    top: 0;
    left: -40px;

    display: flex;
    align-items: center;
    justify-content: center;

    width: 38px;
    height: 38px;

    border: 1px solid rgba(79,140,255,0.25);
    border-radius: 11px;

    background: var(--portfolio-surface);

    color: var(--portfolio-blue-light);

    font-size: 0.82rem;
}

.timeline-content {
    padding: 26px;

    border: 1px solid var(--portfolio-border);
    border-radius: 18px;

    background: var(--portfolio-surface);

    transition: transform 0.3s ease, border-color 0.3s ease;
}

.timeline-content:hover {
    transform: translateY(-4px);
    border-color: rgba(79,140,255,0.22);
}

.timeline-kicker {
    display: inline-block;

    padding: 4px 9px;

    border-radius: 6px;

    background: rgba(79,140,255,0.08);

    color: var(--portfolio-blue-light);

    font-size: 0.57rem;
    font-weight: 800;
    letter-spacing: 0.14em;
}

.timeline-content h4 {
    margin: 13px 0 6px;

    color: white;

    font-size: 1.15rem;
    font-weight: 750;
    letter-spacing: -0.02em;
}

.timeline-place {
    margin: 0 0 5px;
    color: var(--portfolio-blue-light);
    font-size: 0.78rem;
    font-weight: 650;
}

.timeline-meta {
    margin: 0 0 15px;
    color: var(--portfolio-muted);
    font-size: 0.72rem;
}

.career-skills {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;

    margin-top: 14px;
}

.career-skills span {
    padding: 6px 9px;

    border: 1px solid var(--portfolio-border);
    border-radius: 7px;

    color: #9aacbf;

    font-size: 0.6rem;
}


/* =========================================================
   SKILLS
========================================================= */

.skills-section {
    padding: 120px 0;
    background: #091523;
}

.skills-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
}

.skill-card {
    position: relative;

    min-height: 340px;

    padding: 28px;

    overflow: hidden;

    border: 1px solid var(--portfolio-border);
    border-radius: 20px;

    background: var(--portfolio-surface);

    transition:
        transform 0.3s ease,
        border-color 0.3s ease;
}

.skill-card:hover {
    transform: translateY(-6px);
    border-color: rgba(79,140,255,0.22);
}

.skill-card-lg {
    min-height: 420px;
}

.skill-number {
    position: absolute;

    top: 22px;
    right: 23px;

    color: #354a61;

    font-size: 0.67rem;
    font-weight: 800;
}

.skill-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 48px;
    height: 48px;

    margin-top: 30px;

    border-radius: 13px;

    background: rgba(79,140,255,0.08);

    color: var(--portfolio-blue-light);
}

.skill-card h3 {
    margin: 23px 0 20px;

    color: white;

    font-size: 1.15rem;
    font-weight: 750;
}

.skill-card p {
    color: var(--portfolio-muted);
    font-size: 0.78rem;
    line-height: 1.75;
}

.skill-line {
    position: absolute;

    right: 28px;
    bottom: 25px;
    left: 28px;

    height: 1px;

    background: linear-gradient(90deg, var(--portfolio-blue), transparent);

    opacity: 0.35;
}

.skill-meter-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.skill-meter-item-top {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-bottom: 6px;

    color: #b3c3d6;

    font-size: 0.7rem;
    font-weight: 600;
}

.skill-meter-item-top span:last-child {
    color: var(--portfolio-blue-light);
    font-weight: 700;
}

.skill-meter {
    height: 5px;

    border-radius: 3px;

    background: rgba(255,255,255,0.06);

    overflow: hidden;
}

.skill-meter-bar {
    height: 100%;

    border-radius: 3px;

    background: linear-gradient(
        90deg,
        var(--portfolio-blue),
        var(--portfolio-cyan)
    );

    transition: width 1.2s ease-in-out;
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
}

.light-button:hover {
    background: #eaf2ff;
    color: #07111f;
}

.cta-phone {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    color: #9db0c4;

    font-size: 0.76rem;
    font-weight: 700;
}

.cta-phone i {
    color: var(--portfolio-blue-light);
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

@keyframes cardFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-7px); }
}

@keyframes floatingCard {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

@keyframes scrollDown {
    0% { transform: translateY(-15px); }
    50% { transform: translateY(15px); }
    100% { transform: translateY(35px); }
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1199px) {
    .hero-title { font-size: 4.5rem; }
    .about-grid { gap: 55px; }
    .skills-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 991px) {
    .hero-section {
        min-height: auto;
        padding: 90px 0 100px;
    }

    .hero-title { font-size: clamp(3rem, 9vw, 4.6rem); }

    .hero-profile-wrap { margin-top: 20px; }
    .floating-card-one { left: -10px; }
    .floating-card-two { right: -10px; }

    .about-grid { grid-template-columns: 1fr; }

    .about-visual {
        display: flex;
        justify-content: center;
    }

    .about-image-frame { width: min(100%, 480px); }
    .about-content { max-width: 750px; }

    .cta-decoration { opacity: 0.5; }

    .hero-actions { display: none; }

    .hero-actions-mobile {
        display: flex !important;
        flex-direction: column;
        align-items: stretch;
        margin-top: 30px;
        padding-top: 10px;
        border-top: 1px solid var(--portfolio-border);
        width: 100%;
    }

    .hero-actions-mobile .btn-primary-custom,
    .hero-actions-mobile .btn-outline-custom {
        width: 100%;
        justify-content: center;
    }

    .timeline { padding-left: 34px; }
    .timeline::before { left: 15px; }
    .timeline-icon { left: -34px; width: 32px; height: 32px; }
}

@media (max-width: 767px) {
    .hero-section { padding: 70px 0 85px; }
    .hero-eyebrow { font-size: 0.6rem; }
    .hero-title { margin-top: 21px; font-size: clamp(2.7rem, 14vw, 4rem); }
    .hero-role { font-size: 0.8rem; }

    .hero-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-primary-custom,
    .btn-outline-custom { width: 100%; }

    .hero-actions-mobile { margin-top: 25px; }

    .hero-profile-wrap { width: calc(100% - 20px); }

    .profile-image-wrap,
    .profile-image { height: 300px; min-height: 300px; }

    .floating-card { transform: scale(0.85); }
    .floating-card-one { left: -20px; }
    .floating-card-two { right: -20px; }

    .scroll-indicator { display: none; }

    .about-section,
    .education-section,
    .skills-section { padding: 85px 0; }

    .section-heading { margin-bottom: 38px; }

    .about-image { height: 420px; }
    .experience-badge { right: -5px; bottom: 25px; }

    .about-focus-grid { grid-template-columns: 1fr 1fr; }

    .skills-grid { grid-template-columns: 1fr; }

    .skill-card { min-height: auto; }
    .skill-card-lg { min-height: auto; padding-bottom: 55px; }

    .cta-card { min-height: auto; padding: 40px 27px; }

    .cta-decoration { display: none; }

    .cta-actions {
        align-items: stretch;
        flex-direction: column;
        gap: 18px;
    }

    .cta-phone { justify-content: center; }

    .timeline { padding-left: 28px; }
    .timeline::before { left: 12px; }
    .timeline-icon { left: -28px; width: 28px; height: 28px; font-size: 0.7rem; }
    .timeline-content { padding: 20px; }
}

@media (max-width: 480px) {
    .hero-title { font-size: 2.65rem; }

    .profile-card { padding: 14px; border-radius: 22px; }
    .profile-image-wrap,
    .profile-image { height: 275px; min-height: 275px; }
    .profile-card-content h2 { font-size: 1.65rem; }
    .profile-tags span { font-size: 0.57rem; }

    .floating-card { display: none; }

    .about-focus-grid { grid-template-columns: 1fr; }
    .about-image { height: 360px; }
    .experience-badge { right: 10px; }
}

@media (prefers-reduced-motion: reduce) {
    .flashlight-wrap {
        animation: none;
        opacity: 1;
        transform: scale(1);
    }

    .flashlight-core,
    .flashlight-beam {
        animation: none;
    }

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js"></script>

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
       TYPING ANIMATION
    ====================================================== */

    const typedElement = document.querySelector('.typed-text');

    if (typedElement && typeof Typed !== 'undefined') {

        new Typed('.typed-text', {
            strings: [
                'Tuli Moses Kimatu',
                'a Developer',
                'a Real Estate Expert',
                'an Innovator'
            ],
            typeSpeed: 65,
            backSpeed: 35,
            backDelay: 1500,
            startDelay: 250,
            loop: true,
            showCursor: false,
            smartBackspace: true
        });

    }


    /* =====================================================
       ANIMATE SKILL BARS ON VIEW
    ====================================================== */

    const skillBars = document.querySelectorAll('.skill-meter-bar');

    if (skillBars.length && 'IntersectionObserver' in window) {

        skillBars.forEach(function (bar) {
            bar.dataset.width = bar.style.width;
            bar.style.width = '0%';
        });

        const skillObserver = new IntersectionObserver(
            function (entries, observer) {

                entries.forEach(function (entry) {

                    if (entry.isIntersecting) {

                        const bar = entry.target;

                        setTimeout(function () {
                            bar.style.width = bar.dataset.width;
                        }, 200);

                        observer.unobserve(bar);

                    }

                });

            },
            { threshold: 0.3 }
        );

        skillBars.forEach(function (bar) {
            skillObserver.observe(bar);
        });

    }


    /* =====================================================
       SMOOTH SCROLL
    ====================================================== */

    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {

        anchor.addEventListener('click', function (event) {

            const targetId = this.getAttribute('href');

            if (!targetId || targetId === '#') {
                return;
            }

            const target = document.querySelector(targetId);

            if (!target) {
                return;
            }

            event.preventDefault();

            target.scrollIntoView({
                behavior: window.matchMedia(
                    '(prefers-reduced-motion: reduce)'
                ).matches ? 'auto' : 'smooth',
                block: 'start'
            });

        });

    });

});

</script>


<?php include('../includes/footer.php'); ?>