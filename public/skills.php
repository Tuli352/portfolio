<?php
include('../config/db_connect.php');

// Fetch all skills grouped by category with specific ordering
$query = "SELECT * FROM skills 
          ORDER BY 
            CASE category
                WHEN 'Web Development & Programming' THEN 1
                WHEN 'Database & Server Management' THEN 2
                WHEN 'Artificial Intelligence & Automation' THEN 3
                WHEN 'Systems & ICT Support' THEN 4
                WHEN 'Technical Skills (Real Estate)' THEN 5
                WHEN 'Analytical Skills' THEN 6
                WHEN 'Soft Skills' THEN 7
                ELSE 8
            END, 
            id ASC";
$result = $conn->query($query);

$skills_by_category = [];
while ($row = $result->fetch_assoc()) {
    $skills_by_category[$row['category']][] = $row;
}

$total_skills = $result->num_rows;
$categories_count = count($skills_by_category);

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function getCategoryIcon($category) {
    $icons = [
        'Web Development & Programming' => '<i class="fas fa-code"></i>',
        'Database & Server Management' => '<i class="fas fa-database"></i>',
        'Artificial Intelligence & Automation' => '<i class="fas fa-robot"></i>',
        'Systems & ICT Support' => '<i class="fas fa-headset"></i>',
        'Technical Skills (Real Estate)' => '<i class="fas fa-building"></i>',
        'Analytical Skills' => '<i class="fas fa-chart-line"></i>',
        'Soft Skills' => '<i class="fas fa-people-arrows"></i>'
    ];
    
    return $icons[$category] ?? '<i class="fas fa-star"></i>';
}

function getLevelClass($level) {
    $classes = [
        'Expert' => 'expert',
        'Advanced' => 'advanced',
        'Intermediate' => 'intermediate',
        'Basic' => 'basic'
    ];
    
    return $classes[$level] ?? 'basic';
}

function getLevelPercentage($level) {
    $percentages = [
        'Expert' => 95,
        'Advanced' => 80,
        'Intermediate' => 65,
        'Basic' => 40
    ];
    
    return $percentages[$level] ?? 50;
}

include('../includes/header.php');
?>

<!-- =========================================================
     PAGE
========================================================= -->

<div class="portfolio-page skills-page">

    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="hero-section skills-hero" id="home">

        <div class="hero-grid"></div>

        <div class="hero-glow hero-glow-one"></div>
        <div class="hero-glow hero-glow-two"></div>

        <div class="container hero-container">

            <div class="row align-items-center g-5">

                <div class="col-lg-8 mx-auto text-center">

                    <div class="hero-eyebrow" data-aos="fade-up">
                        <span class="eyebrow-dot"></span>
                        SKILLS • EXPERTISE • TOOLKIT
                    </div>

                    <h1 class="hero-title skills-hero-title" data-aos="fade-up" data-aos-delay="100">
                        <span class="typing-wrapper">
                            <span class="typed-text"></span>
                            <span class="typing-cursor"></span>
                        </span>
                    </h1>

                    <p class="hero-description mx-auto" data-aos="fade-up" data-aos-delay="200">
                        Bridging Real Estate Expertise with Cutting-Edge Technology Solutions
                    </p>

                    <div class="skills-summary" data-aos="fade-up" data-aos-delay="300">

                        <span class="summary-pill">
                            <i class="fas fa-code"></i>
                            <?php echo $total_skills; ?> Skills
                        </span>

                        <span class="summary-pill">
                            <i class="fas fa-layer-group"></i>
                            <?php echo $categories_count; ?> Categories
                        </span>

                        <span class="summary-pill">
                            <i class="fas fa-briefcase"></i>
                            Real Estate &amp; Tech
                        </span>

                    </div>

                    <div class="details-hero-actions" data-aos="fade-up" data-aos-delay="400">

                        <a href="contact.php" class="btn-primary-custom">
                            <span>Start Project</span>
                            <i class="fas fa-paper-plane"></i>
                        </a>

                        <a href="tel:+254745117912" class="btn-outline-custom">
                            <span>Call Me</span>
                            <i class="fas fa-phone"></i>
                        </a>

                    </div>

                </div>

            </div>

        </div>

        <a href="#filters" class="scroll-indicator">

            <span>Scroll to explore</span>

            <div class="scroll-line">
                <span></span>
            </div>

        </a>

    </section>


    <!-- =====================================================
         SKILLS — SINGLE PAPER SHEET
         (no level labels, no filters, no motion — a plain
         page of everything I know how to do)
    ====================================================== -->

    <section class="skills-list-section" id="skills">

        <div class="container">

            <?php if (!empty($skills_by_category)) { ?>

                <div class="paper-sheet single-paper">

                    <span class="paper-pin"></span>

                    <div class="paper-heading">
                        <h3>Skills &amp; Toolkit</h3>
                        <p><?php echo $total_skills; ?> skills across <?php echo $categories_count; ?> areas</p>
                    </div>

                    <?php foreach ($skills_by_category as $category => $skills) { ?>

                        <div class="paper-category">

                            <h4 class="paper-category-title">
                                <?php echo getCategoryIcon($category); ?>
                                <?php echo e($category ?: 'Other Skills'); ?>
                            </h4>

                            <ul class="paper-skill-list">

                                <?php foreach ($skills as $skill) { ?>

                                    <li class="paper-skill-item">
                                        <?php echo e($skill['skill_name']); ?>
                                        <?php if (!empty($skill['years_experience'])) { ?>
                                            <span class="paper-skill-years">
                                                <?php echo e($skill['years_experience']); ?>y
                                            </span>
                                        <?php } ?>
                                    </li>

                                <?php } ?>

                            </ul>

                        </div>

                    <?php } ?>

                </div>

            <?php } else { ?>

                <div class="empty-skills">

                    <div class="empty-icon">
                        <i class="fas fa-code"></i>
                    </div>

                    <h3>No skills added yet</h3>

                    <p>Please check back later for updates</p>

                </div>

            <?php } ?>

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
                        Ready to Bring Your
                        <span>Ideas to Life?</span>
                    </h2>

                    <p>
                        Let's collaborate on your next web development or real estate technology project.
                    </p>

                    <div class="cta-actions">

                        <a href="contact.php" class="btn-primary-custom light-button">
                            <span>Start a Project</span>
                            <i class="fas fa-handshake"></i>
                        </a>

                        <a href="tel:+254745117912" class="cta-phone">
                            <i class="fas fa-phone"></i>
                            <span>Call Me Now</span>
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

<!-- Handwriting / paper-note font, used only inside the skills paper cards -->
<link
    rel="preconnect"
    href="https://fonts.googleapis.com"
>
<link
    href="https://fonts.googleapis.com/css2?family=Kalam:wght@400;700&family=Patrick+Hand&display=swap"
    rel="stylesheet"
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

    /* Level colors (dark theme) */
    --level-expert: #ff5c7c;
    --level-advanced: #ffb63d;
    --level-intermediate: #4fb8ff;
    --level-basic: #35d6b0;

    /* Paper theme (used only inside skill cards) */
    --paper-bg: #f7f1e3;
    --paper-bg-2: #efe6d1;
    --paper-line: rgba(79, 108, 140, 0.12);
    --paper-edge: rgba(60, 45, 25, 0.14);
    --paper-ink: #2c2620;
    --paper-ink-muted: #6b6154;
    --paper-tape: rgba(255, 235, 160, 0.55);
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

.skills-hero {
    min-height: 85vh;
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

.skills-hero-title {
    font-size: clamp(2.1rem, 4.6vw, 3.9rem);
    text-align: center;
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

.hero-description {
    max-width: 720px;

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
   HERO SUMMARY PILLS
========================================================= */

.skills-summary {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;

    margin-top: 26px;
}

.summary-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    padding: 9px 15px;

    border: 1px solid var(--portfolio-border-light);
    border-radius: 50px;

    background: rgba(255,255,255,0.03);

    color: #cddcec;

    font-size: 0.72rem;
    font-weight: 700;

    backdrop-filter: blur(8px);
}

.summary-pill i {
    color: var(--portfolio-blue-light);
    font-size: 0.7rem;
}


/* =========================================================
   HERO ACTIONS
========================================================= */

.details-hero-actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;

    margin-top: 30px;
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
   FILTER SECTION
========================================================= */

.filter-section {
    padding: 80px 0 60px;
    background: #091523;

    border-top: 1px solid var(--portfolio-border);
}

.filter-wrap {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;

    padding: 8px;

    border: 1px solid var(--portfolio-border);
    border-radius: 50px;

    background: var(--portfolio-surface);

    max-width: max-content;
    margin: 0 auto;

    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.filter-input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.filter-btn {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    padding: 11px 20px;

    border-radius: 50px;

    color: #94a6ba;

    font-size: 0.8rem;
    font-weight: 700;

    cursor: pointer;

    transition:
        background 0.25s ease,
        color 0.25s ease,
        transform 0.25s ease,
        box-shadow 0.25s ease;
}

.filter-btn i {
    font-size: 0.78rem;
}

.filter-btn:hover {
    color: white;
    transform: translateY(-2px);
}

.filter-input:checked + .filter-btn {
    color: white;
    transform: translateY(-2px);
}

/* Default state */
.filter-input:checked + #filterAll,
.filter-input:checked + label[for="filterAll"] {
    background:
        linear-gradient(
            135deg,
            var(--portfolio-blue),
            #6a7dff
        );

    box-shadow: 0 10px 25px rgba(79,140,255,0.35);
}

.filter-input:checked + .filter-btn:not([class*="filter-btn-"]) {
    background:
        linear-gradient(
            135deg,
            var(--portfolio-blue),
            #6a7dff
        );

    box-shadow: 0 10px 25px rgba(79,140,255,0.35);
}

.filter-input:checked + .filter-btn-expert {
    background:
        linear-gradient(
            135deg,
            var(--level-expert),
            #ff8197
        );

    box-shadow: 0 10px 25px rgba(255,92,124,0.35);
}

.filter-input:checked + .filter-btn-advanced {
    background:
        linear-gradient(
            135deg,
            var(--level-advanced),
            #ffca6a
        );

    color: #1a1000;

    box-shadow: 0 10px 25px rgba(255,182,61,0.3);
}

.filter-input:checked + .filter-btn-intermediate {
    background:
        linear-gradient(
            135deg,
            var(--level-intermediate),
            #7fd0ff
        );

    color: #051828;

    box-shadow: 0 10px 25px rgba(79,184,255,0.3);
}

.filter-input:checked + .filter-btn-basic {
    background:
        linear-gradient(
            135deg,
            var(--level-basic),
            #6be3c7
        );

    color: #04231c;

    box-shadow: 0 10px 25px rgba(53,214,176,0.3);
}


/* =========================================================
   SKILLS LIST SECTION
========================================================= */

.skills-list-section {
    padding: 60px 0 120px;
    background: #091523;
}

/* =========================================================
   SINGLE PAPER SHEET
   One plain sheet listing every skill by category.
   No levels, no badges, no meters, no motion — just text.
========================================================= */

.paper-sheet.single-paper {
    position: relative;

    max-width: 900px;
    margin: 0 auto;

    padding: 46px 50px 40px;

    border: none;
    border-radius: 3px;

    background:
        repeating-linear-gradient(
            var(--paper-bg) 0px,
            var(--paper-bg) 27px,
            var(--paper-line) 28px
        );
    background-color: var(--paper-bg);

    box-shadow:
        0 2px 0 var(--paper-bg-2),
        0 18px 40px rgba(0,0,0,0.35),
        6px 6px 0 rgba(0,0,0,0.12);
}

/* torn top-left corner fold */
.paper-sheet.single-paper::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 30px; height: 30px;
    background: var(--portfolio-bg);
    clip-path: polygon(0 0, 100% 0, 0 100%);
}

.paper-sheet.single-paper::after {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 30px; height: 30px;
    background: linear-gradient(135deg, rgba(0,0,0,0.16), transparent 70%);
    clip-path: polygon(0 100%, 100% 100%, 0 0);
}

/* washi-tape pin holding the sheet down */
.paper-pin {
    position: absolute;
    top: -12px;
    left: 50%;
    width: 70px;
    height: 26px;
    transform: translateX(-50%) rotate(-2deg);
    background: var(--paper-tape);
    border: 1px solid rgba(0,0,0,0.05);
    box-shadow: 0 4px 10px rgba(0,0,0,0.18);
    opacity: 0.9;
}

.paper-heading {
    text-align: center;

    padding-bottom: 22px;
    margin-bottom: 26px;

    border-bottom: 1.5px dashed var(--paper-edge);
}

.paper-heading h3 {
    margin: 0 0 6px;

    color: var(--paper-ink);

    font-family: 'Kalam', 'Patrick Hand', cursive;
    font-size: 1.7rem;
    font-weight: 700;
}

.paper-heading p {
    margin: 0;

    color: var(--paper-ink-muted);

    font-size: 0.78rem;
    font-weight: 650;
    text-transform: uppercase;
    letter-spacing: 0.06em;
}

.paper-category {
    margin-bottom: 26px;
}

.paper-category:last-child {
    margin-bottom: 0;
}

.paper-category-title {
    display: flex;
    align-items: center;
    gap: 10px;

    margin: 0 0 10px;

    color: var(--paper-ink);

    font-family: 'Kalam', 'Patrick Hand', cursive;
    font-size: 1.1rem;
    font-weight: 700;
}

.paper-category-title i {
    font-size: 0.9rem;
    color: var(--paper-ink-muted);
}

.paper-skill-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px 10px;

    margin: 0;
    padding: 0;

    list-style: none;
}

.paper-skill-item {
    display: inline-flex;
    align-items: baseline;
    gap: 6px;

    padding: 6px 14px;

    border: 1.5px solid var(--paper-edge);
    border-radius: 20px;

    color: var(--paper-ink);

    font-family: 'Patrick Hand', cursive;
    font-size: 0.95rem;
}

.paper-skill-years {
    color: var(--paper-ink-muted);
    font-family: Inter, sans-serif;
    font-size: 0.65rem;
    font-weight: 650;
}


/* =========================================================
   EMPTY
========================================================= */

.empty-skills {
    padding: 80px 20px;

    text-align: center;

    border: 1px dashed var(--portfolio-border);
    border-radius: 20px;

    background: rgba(255,255,255,0.01);
}

.empty-icon {
    color: #3c5168;
    font-size: 2.4rem;
}

.empty-skills h3 {
    margin: 18px 0 7px;

    color: white;
    font-size: 1.05rem;
    font-weight: 750;
}

.empty-skills p {
    margin: 0;
    color: var(--portfolio-muted);
}


/* =========================================================
   LEGEND
========================================================= */

.legend-section {
    padding: 100px 0;
    background: var(--portfolio-bg);
}

.legend-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;

    max-width: 900px;
    margin: 0 auto;
}

.legend-card {
    padding: 22px;

    text-align: center;

    border: 1px solid var(--portfolio-border);
    border-radius: 16px;

    background: var(--portfolio-surface);

    transition:
        transform 0.3s ease,
        border-color 0.3s ease;
}

.legend-card:hover {
    transform: translateY(-5px);
    border-color: rgba(79,140,255,0.22);
}

.legend-card h6 {
    margin: 0 0 5px;

    color: white;
    font-size: 0.88rem;
    font-weight: 800;
}

.legend-card small {
    color: #75889e;
    font-size: 0.68rem;
    font-weight: 650;
}

.legend-color {
    display: block;

    width: 44px;
    height: 8px;

    margin: 0 auto 14px;

    border-radius: 4px;
}

.legend-color-expert {
    background:
        linear-gradient(
            90deg,
            var(--level-expert),
            #ff8aa1
        );
}

.legend-color-advanced {
    background:
        linear-gradient(
            90deg,
            var(--level-advanced),
            #ffce6d
        );
}

.legend-color-intermediate {
    background:
        linear-gradient(
            90deg,
            var(--level-intermediate),
            #86d6ff
        );
}

.legend-color-basic {
    background:
        linear-gradient(
            90deg,
            var(--level-basic),
            #6be3c7
        );
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

@keyframes scrollDown {
    0% { transform: translateY(-15px); }
    50% { transform: translateY(15px); }
    100% { transform: translateY(35px); }
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 991px) {
    .hero-section {
        min-height: auto;
        padding: 90px 0 100px;
    }

    .skills-hero-title {
        font-size: clamp(2rem, 6vw, 3rem);
    }

    .skills-grid {
        grid-template-columns: 1fr;
    }

    .legend-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .cta-decoration { opacity: 0.5; }
}

@media (max-width: 767px) {
    .hero-section { padding: 70px 0 85px; }

    .hero-eyebrow { font-size: 0.6rem; }

    .skills-hero-title {
        font-size: clamp(1.7rem, 7vw, 2.4rem);
    }

    .hero-description { font-size: 0.9rem; }

    .scroll-indicator { display: none; }

    .skills-summary { gap: 8px; }

    .summary-pill {
        padding: 7px 12px;
        font-size: 0.66rem;
    }

    .details-hero-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .details-hero-actions .btn-primary-custom,
    .details-hero-actions .btn-outline-custom {
        width: 100%;
    }

    .filter-wrap {
        flex-direction: column;
        width: 100%;
        border-radius: 20px;
    }

    .filter-btn {
        width: 100%;
        justify-content: center;
    }

    .filter-section,
    .skills-list-section,
    .legend-section {
        padding-left: 0;
        padding-right: 0;
    }

    .skill-category-card.paper-sheet {
        padding: 24px 20px 20px;
    }

    .paper-tilt-left,
    .paper-tilt-right {
        transform: none;
    }

    .paper-sheet .skill-row {
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
    }

    .paper-sheet .skill-progress {
        width: 100%;
        align-items: flex-start;
    }

    .paper-sheet .skill-meter {
        width: 100%;
    }

    .legend-grid {
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .legend-card {
        padding: 16px;
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
    .skills-hero-title {
        font-size: 1.5rem;
    }

    .legend-grid {
        grid-template-columns: 1fr;
    }

    .paper-sheet .skill-category-icon {
        width: 44px;
        height: 44px;
    }

    .paper-sheet .skill-category-info h4 {
        font-size: 1.05rem;
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
                'Real Estate & Web Systems Developer',
                'GIS Mapping Specialist',
                'AI Integration Specialist',
                'Full-Stack Developer',
                'Real Estate Technology Expert'
            ],
            typeSpeed: 55,
            backSpeed: 30,
            backDelay: 2000,
            startDelay: 250,
            loop: true,
            showCursor: false,
            smartBackspace: true
        });
    }


    /* =====================================================
       SKILL FILTERING
    ====================================================== */

    const skillFilters = document.querySelectorAll('input[name="skillFilter"]');
    const skillItems = document.querySelectorAll('.skill-item');

    skillFilters.forEach(function (filter) {

        filter.addEventListener('change', function () {

            const filterValue = this.id.replace('filter', '').toLowerCase();

            skillItems.forEach(function (item) {

                if (filterValue === 'all') {
                    item.classList.remove('hidden');
                } else {
                    const itemLevel = item.getAttribute('data-level');
                    if (itemLevel === filterValue) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                }

            });

            // fade in visible items
            const visibleItems = document.querySelectorAll('.skill-item:not(.hidden)');

            visibleItems.forEach(function (item, index) {
                item.style.animation = 'none';
                setTimeout(function () {
                    item.style.animation =
                        'fadeIn 0.5s ease ' + (index * 0.05) + 's both';
                }, 10);
            });

        });

    });


    /* =====================================================
       ANIMATE PROGRESS BARS ON VIEW
    ====================================================== */

    const progressBars = document.querySelectorAll('.skill-meter-bar');

    if (progressBars.length && 'IntersectionObserver' in window) {

        progressBars.forEach(function (bar) {
            bar.dataset.width = bar.style.width;
            bar.style.width = '0%';
        });

        const observer = new IntersectionObserver(
            function (entries, obs) {

                entries.forEach(function (entry) {

                    if (entry.isIntersecting) {

                        const bar = entry.target;

                        setTimeout(function () {
                            bar.style.width = bar.dataset.width;
                        }, 200);

                        obs.unobserve(bar);

                    }

                });

            },
            { threshold: 0.2 }
        );

        progressBars.forEach(function (bar) {
            observer.observe(bar);
        });

    }


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

    const callButtons = document.querySelectorAll('a[href^="tel:"]');

    callButtons.forEach(function (btn) {

        btn.addEventListener('click', function (e) {

            if (!confirm('Would you like to call Tuli Moses at +254 745 117 912?')) {
                e.preventDefault();
            }

        });

    });

});

</script>


<?php include('../includes/footer.php'); ?>