<?php
include('../config/db_connect.php');
$seo_title = 'Projects | Kimatu Tuli Portfolio';
$seo_description = 'Explore Kimatu Tuli\'s real estate, GIS, web development and digital systems projects.';
include('../includes/header.php');

// Get all projects with their images
$result = $conn->query("
    SELECT p.*, 
           GROUP_CONCAT(pi.image_path) as image_paths,
           COUNT(pi.id) as image_count
    FROM projects p 
    LEFT JOIN project_images pi ON p.id = pi.project_id 
    GROUP BY p.id 
    ORDER BY p.created_at DESC
");

// Categorize projects
$tech_projects = [];
$gis_projects = [];

while($project = $result->fetch_assoc()) {
    if (strpos(strtolower($project['category']), 'gis') !== false || 
        strpos(strtolower($project['category']), 'mapping') !== false ||
        strpos(strtolower($project['title']), 'gis') !== false ||
        strpos(strtolower($project['title']), 'mapping') !== false) {
        $gis_projects[] = $project;
    } else {
        $tech_projects[] = $project;
    }
}

// Count projects for stats
$total_projects = count($tech_projects) + count($gis_projects);
$tech_count = count($tech_projects);
$gis_count = count($gis_projects);

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>

<!-- =========================================================
     PAGE
========================================================= -->

<div class="portfolio-page projects-page">

    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="hero-section projects-hero" id="home">

        <div class="hero-grid"></div>

        <div class="hero-glow hero-glow-one"></div>
        <div class="hero-glow hero-glow-two"></div>

        <div class="container hero-container">

            <div class="row align-items-center g-5">

                <div class="col-lg-8 mx-auto text-center">

                    <div class="hero-eyebrow" data-aos="fade-up">
                        <span class="eyebrow-dot"></span>
                        SELECTED WORK • PORTFOLIO
                    </div>

                    <h1 class="hero-title projects-hero-title" data-aos="fade-up" data-aos-delay="100">
                        <span class="typing-wrapper">
                            <span class="typed-text"></span>
                            <span class="typing-cursor"></span>
                        </span>
                    </h1>

                </div>

            </div>

        </div>

        <a href="#portfolio" class="scroll-indicator">

            <span>Scroll to explore</span>

            <div class="scroll-line">
                <span></span>
            </div>

        </a>

    </section>


    <!-- =====================================================
         STATS
    ====================================================== -->

    <section class="stats-section">

        <div class="container">

            <div class="stats-grid">

                <div class="stat-card" data-aos="fade-up">

                    <div class="stat-number">
                        <span class="counter" data-target="<?php echo $total_projects; ?>">0</span>
                    </div>

                    <div class="stat-label">
                        Total Projects
                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         PROJECTS
    ====================================================== -->

    <section class="projects-section" id="portfolio">

        <div class="container">

            <div class="section-heading text-center" data-aos="fade-up">

                <span class="section-kicker">
                    CATEGORIES
                </span>

                <h2>
                    Project
                    <span>Portfolio</span>
                </h2>

            </div>


            <!-- TABS -->
            <div class="projects-tabs-wrap" data-aos="fade-up" data-aos-delay="100">

                <div class="project-tabs" role="tablist">

                    <button
                        class="project-tab active"
                        id="tech-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#tech-projects"
                        type="button"
                        role="tab"
                    >
                        <i class="fas fa-laptop-code"></i>
                        <span>Tech Projects</span>
                        <span class="tab-badge"><?php echo $tech_count; ?></span>
                    </button>

                    <button
                        class="project-tab"
                        id="gis-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#gis-projects"
                        type="button"
                        role="tab"
                    >
                        <i class="fas fa-map-location-dot"></i>
                        <span>GIS &amp; Mapping</span>
                        <span class="tab-badge"><?php echo $gis_count; ?></span>
                    </button>

                </div>

            </div>


            <!-- TAB CONTENT -->
            <div class="tab-content" id="projectsTabContent">

                <!-- ============ TECH PROJECTS ============ -->
                <div class="tab-pane fade show active" id="tech-projects" role="tabpanel" aria-labelledby="tech-tab">

                    <div class="projects-grid">

                        <?php 
                        $project_counter = 0;
                        foreach($tech_projects as $project) { 
                            $project_counter++;
                            
                            $images = [];
                            if (!empty($project['image_paths'])) {
                                $image_paths = explode(',', $project['image_paths']);
                                foreach ($image_paths as $path) {
                                    $images[] = trim($path);
                                }
                            }
                            
                            if (empty($images) && !empty($project['image'])) {
                                $images[] = $project['image'];
                            }
                            
                            $has_multiple_images = count($images) > 1;
                            
                            $description_preview = strip_tags($project['description']);
                            if (strlen($description_preview) > 120) {
                                $description_preview = substr($description_preview, 0, 120) . '...';
                            }

                            $project_url = (!empty($project['link']) && $project['link'] != '#') ? $project['link'] : null;
                        ?>

                            <article
                                class="project-card"
                                data-aos="fade-up"
                                data-aos-delay="<?php echo ($project_counter % 6) * 100; ?>"
                            >

                                <div class="project-image-area">

                                    <?php if (!empty($images)): ?>

                                        <div
                                            class="project-carousel <?php echo $has_multiple_images ? 'multi-image' : 'single-image'; ?>"
                                            data-carousel-tech="<?php echo $project_counter; ?>"
                                        >

                                            <?php foreach($images as $index => $image): ?>

                                                <img
                                                    src="../<?php echo e($image); ?>"
                                                    alt="<?php echo e($project['title']); ?>"
                                                    class="project-image <?php echo $index === 0 ? 'active' : ''; ?>"
                                                    data-slide="<?php echo $index; ?>"
                                                    loading="lazy"
                                                    onerror="this.style.display='none';"
                                                >

                                            <?php endforeach; ?>

                                        </div>

                                        <?php if ($has_multiple_images): ?>

                                            <button
                                                type="button"
                                                class="carousel-control carousel-prev"
                                                data-carousel-prev="tech-<?php echo $project_counter; ?>"
                                                aria-label="Previous project image"
                                            >
                                                <i class="fas fa-chevron-left"></i>
                                            </button>

                                            <button
                                                type="button"
                                                class="carousel-control carousel-next"
                                                data-carousel-next="tech-<?php echo $project_counter; ?>"
                                                aria-label="Next project image"
                                            >
                                                <i class="fas fa-chevron-right"></i>
                                            </button>

                                            <div class="carousel-dots">

                                                <?php foreach($images as $index => $image): ?>

                                                    <button
                                                        type="button"
                                                        class="carousel-dot <?php echo $index === 0 ? 'active' : ''; ?>"
                                                        data-carousel-dot="tech-<?php echo $project_counter; ?>"
                                                        data-slide="<?php echo $index; ?>"
                                                        aria-label="View image <?php echo $index + 1; ?>"
                                                    ></button>

                                                <?php endforeach; ?>

                                            </div>

                                        <?php endif; ?>

                                    <?php else: ?>

                                        <div class="project-placeholder">
                                            <i class="fas fa-laptop-code"></i>
                                            <span><?php echo e($project['category']); ?></span>
                                        </div>

                                    <?php endif; ?>

                                    <div class="project-overlay"></div>

                                    <div class="project-top-info">

                                        <span class="project-category">
                                            <?php echo e($project['category']); ?>
                                        </span>

                                        <?php if ($has_multiple_images): ?>
                                            <span class="image-count">
                                                <i class="fas fa-images"></i>
                                                <?php echo count($images); ?>
                                            </span>
                                        <?php endif; ?>

                                    </div>

                                </div>

                                <div class="project-content">

                                    <div class="project-content-top">

                                        <span class="project-index">
                                            0<?php echo $project_counter; ?>
                                        </span>

                                        <?php if (!empty($project['created_at'])): ?>
                                            <span class="project-date">
                                                <?php echo date('M Y', strtotime($project['created_at'])); ?>
                                            </span>
                                        <?php endif; ?>

                                    </div>

                                    <h3>
                                        <?php echo e($project['title']); ?>
                                    </h3>

                                    <p>
                                        <?php echo e($description_preview); ?>
                                    </p>


                                    <?php 
                                    $techs = explode(',', $project['tech_used']);
                                    $techs = array_filter(array_map('trim', $techs));
                                    if (!empty($techs)): 
                                    ?>

                                        <div class="project-tech">

                                            <?php 
                                            $tech_counter = 0;
                                            foreach($techs as $tech):
                                                if ($tech_counter >= 4) break;
                                                $tech_counter++;
                                            ?>
                                                <span><?php echo e($tech); ?></span>
                                            <?php endforeach; ?>

                                            <?php if (count($techs) > 4): ?>
                                                <span>+<?php echo count($techs) - 4; ?></span>
                                            <?php endif; ?>

                                        </div>

                                    <?php endif; ?>


                                    <div class="project-actions">

                                        <a
                                            href="project_details.php?id=<?php echo $project['id']; ?>"
                                            class="project-details-btn"
                                        >
                                            <span>View Details</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>

                                        <?php if ($project_url): ?>
                                            <a
                                                href="<?php echo e($project_url); ?>"
                                                class="project-live-btn"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                aria-label="View live project"
                                            >
                                                <i class="fas fa-external-link-alt"></i>
                                                <span>Live</span>
                                            </a>
                                        <?php endif; ?>

                                    </div>

                                </div>

                            </article>

                        <?php } 

                        if (empty($tech_projects)): ?>

                            <div class="empty-projects">

                                <div class="empty-icon">
                                    <i class="fas fa-laptop-code"></i>
                                </div>

                                <h3>
                                    No Tech Projects Yet
                                </h3>

                                <p>
                                    Check back later for updates
                                </p>

                            </div>

                        <?php endif; ?>

                    </div>

                </div>


                <!-- ============ GIS PROJECTS ============ -->
                <div class="tab-pane fade" id="gis-projects" role="tabpanel" aria-labelledby="gis-tab">

                    <div class="projects-grid">

                        <?php 
                        $project_counter = 0;
                        foreach($gis_projects as $project) { 
                            $project_counter++;
                            
                            $images = [];
                            if (!empty($project['image_paths'])) {
                                $image_paths = explode(',', $project['image_paths']);
                                foreach ($image_paths as $path) {
                                    $images[] = trim($path);
                                }
                            }
                            
                            if (empty($images) && !empty($project['image'])) {
                                $images[] = $project['image'];
                            }
                            
                            $has_multiple_images = count($images) > 1;
                            
                            $description_preview = strip_tags($project['description']);
                            if (strlen($description_preview) > 120) {
                                $description_preview = substr($description_preview, 0, 120) . '...';
                            }

                            $project_url = (!empty($project['link']) && $project['link'] != '#') ? $project['link'] : null;
                        ?>

                            <article
                                class="project-card"
                                data-aos="fade-up"
                                data-aos-delay="<?php echo ($project_counter % 6) * 100; ?>"
                            >

                                <div class="project-image-area">

                                    <?php if (!empty($images)): ?>

                                        <div
                                            class="project-carousel <?php echo $has_multiple_images ? 'multi-image' : 'single-image'; ?>"
                                            data-carousel-gis="<?php echo $project_counter; ?>"
                                        >

                                            <?php foreach($images as $index => $image): ?>

                                                <img
                                                    src="../<?php echo e($image); ?>"
                                                    alt="<?php echo e($project['title']); ?>"
                                                    class="project-image <?php echo $index === 0 ? 'active' : ''; ?>"
                                                    data-slide="<?php echo $index; ?>"
                                                    loading="lazy"
                                                    onerror="this.style.display='none';"
                                                >

                                            <?php endforeach; ?>

                                        </div>

                                        <?php if ($has_multiple_images): ?>

                                            <button
                                                type="button"
                                                class="carousel-control carousel-prev"
                                                data-carousel-prev="gis-<?php echo $project_counter; ?>"
                                                aria-label="Previous project image"
                                            >
                                                <i class="fas fa-chevron-left"></i>
                                            </button>

                                            <button
                                                type="button"
                                                class="carousel-control carousel-next"
                                                data-carousel-next="gis-<?php echo $project_counter; ?>"
                                                aria-label="Next project image"
                                            >
                                                <i class="fas fa-chevron-right"></i>
                                            </button>

                                            <div class="carousel-dots">

                                                <?php foreach($images as $index => $image): ?>

                                                    <button
                                                        type="button"
                                                        class="carousel-dot <?php echo $index === 0 ? 'active' : ''; ?>"
                                                        data-carousel-dot="gis-<?php echo $project_counter; ?>"
                                                        data-slide="<?php echo $index; ?>"
                                                        aria-label="View image <?php echo $index + 1; ?>"
                                                    ></button>

                                                <?php endforeach; ?>

                                            </div>

                                        <?php endif; ?>

                                    <?php else: ?>

                                        <div class="project-placeholder">
                                            <i class="fas fa-map-location-dot"></i>
                                            <span><?php echo e($project['category']); ?></span>
                                        </div>

                                    <?php endif; ?>

                                    <div class="project-overlay"></div>

                                    <div class="project-top-info">

                                        <span class="project-category">
                                            <?php echo e($project['category']); ?>
                                        </span>

                                        <?php if ($has_multiple_images): ?>
                                            <span class="image-count">
                                                <i class="fas fa-images"></i>
                                                <?php echo count($images); ?>
                                            </span>
                                        <?php endif; ?>

                                    </div>

                                </div>

                                <div class="project-content">

                                    <div class="project-content-top">

                                        <span class="project-index">
                                            0<?php echo $project_counter; ?>
                                        </span>

                                        <?php if (!empty($project['created_at'])): ?>
                                            <span class="project-date">
                                                <?php echo date('M Y', strtotime($project['created_at'])); ?>
                                            </span>
                                        <?php endif; ?>

                                    </div>

                                    <h3>
                                        <?php echo e($project['title']); ?>
                                    </h3>

                                    <p>
                                        <?php echo e($description_preview); ?>
                                    </p>


                                    <?php 
                                    $techs = explode(',', $project['tech_used']);
                                    $techs = array_filter(array_map('trim', $techs));
                                    if (!empty($techs)): 
                                    ?>

                                        <div class="project-tech">

                                            <?php 
                                            $tech_counter = 0;
                                            foreach($techs as $tech):
                                                if ($tech_counter >= 4) break;
                                                $tech_counter++;
                                            ?>
                                                <span><?php echo e($tech); ?></span>
                                            <?php endforeach; ?>

                                            <?php if (count($techs) > 4): ?>
                                                <span>+<?php echo count($techs) - 4; ?></span>
                                            <?php endif; ?>

                                        </div>

                                    <?php endif; ?>


                                    <div class="project-actions">

                                        <a
                                            href="project_details.php?id=<?php echo $project['id']; ?>"
                                            class="project-details-btn"
                                        >
                                            <span>View Details</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>

                                        <?php if ($project_url): ?>
                                            <a
                                                href="<?php echo e($project_url); ?>"
                                                class="project-live-btn"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                aria-label="View live project"
                                            >
                                                <i class="fas fa-external-link-alt"></i>
                                                <span>Live</span>
                                            </a>
                                        <?php endif; ?>

                                    </div>

                                </div>

                            </article>

                        <?php } 

                        if (empty($gis_projects)): ?>

                            <div class="empty-projects">

                                <div class="empty-icon">
                                    <i class="fas fa-map-location-dot"></i>
                                </div>

                                <h3>
                                    No GIS Projects Yet
                                </h3>

                                <p>
                                    Check back later for updates
                                </p>

                            </div>

                        <?php endif; ?>

                    </div>

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
                        Have a Project
                        <span>in Mind?</span>
                    </h2>

                    <p>
                        Let's collaborate to bring your ideas to life with cutting-edge technology solutions
                    </p>

                    <div class="cta-actions">

                        <a href="contact.php" class="btn-primary-custom light-button">
                            <span>Start a Project</span>
                            <i class="fas fa-paper-plane"></i>
                        </a>

                        <a href="about.php" class="cta-phone">
                            <i class="fas fa-user"></i>
                            <span>Learn About Me</span>
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

.projects-hero {
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

.projects-hero-title {
    font-size: clamp(2.5rem, 6vw, 5rem);
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
   STATS
========================================================= */

.stats-section {
    position: relative;

    padding: 25px 0;

    border-top: 1px solid var(--portfolio-border);
    border-bottom: 1px solid var(--portfolio-border);

    background: #050d18;
}

.stats-grid {
    display: flex;
    justify-content: center;
}

.stat-card {
    position: relative;

    min-height: 125px;

    padding: 23px 28px;

    text-align: center;
}

.stat-number {
    color: white;

    font-size: 2.15rem;
    font-weight: 800;
    letter-spacing: -0.04em;
}

.stat-plus {
    color: var(--portfolio-blue);
}

.stat-label {
    margin-top: 3px;

    color: #75889e;

    font-size: 0.68rem;
    font-weight: 650;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

.stat-icon {
    position: absolute;

    top: 24px;
    right: 25px;

    color: rgba(79,140,255,0.25);

    font-size: 1.1rem;
}


/* =========================================================
   SECTION HEADINGS
========================================================= */

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
   PROJECTS SECTION
========================================================= */

.projects-section {
    padding: 90px 0 120px;
    background: #091523;
}


/* =========================================================
   TABS
========================================================= */

.projects-tabs-wrap {
    display: flex;
    justify-content: center;

    margin-bottom: 45px;
}

.project-tabs {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    padding: 6px;

    border: 1px solid var(--portfolio-border);
    border-radius: 50px;

    background: var(--portfolio-surface);

    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.project-tab {
    display: inline-flex;
    align-items: center;
    gap: 10px;

    padding: 12px 22px;

    border: 0;
    border-radius: 50px;

    background: transparent;

    color: #94a6ba;

    font-size: 0.82rem;
    font-weight: 700;

    cursor: pointer;

    transition:
        background 0.25s ease,
        color 0.25s ease,
        transform 0.25s ease;
}

.project-tab i {
    font-size: 0.82rem;
}

.project-tab:hover {
    color: white;
    transform: translateY(-2px);
}

.project-tab.active {
    background: linear-gradient(
        135deg,
        var(--portfolio-blue),
        #6a7dff
    );

    color: white;

    box-shadow: 0 10px 25px rgba(79,140,255,0.35);
}

.tab-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-width: 22px;
    height: 22px;

    padding: 0 7px;

    border-radius: 50px;

    background: rgba(255,255,255,0.15);

    color: white;

    font-size: 0.65rem;
    font-weight: 800;
}

.project-tab:not(.active) .tab-badge {
    background: rgba(79,140,255,0.15);
    color: var(--portfolio-blue-light);
}


/* =========================================================
   PROJECTS GRID
========================================================= */

.projects-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.project-card {
    overflow: hidden;

    display: flex;
    flex-direction: column;

    border: 1px solid var(--portfolio-border);
    border-radius: 20px;

    background: var(--portfolio-surface);

    transition:
        transform 0.35s ease,
        border-color 0.35s ease;
}

.project-card:hover {
    transform: translateY(-7px);
    border-color: rgba(79,140,255,0.23);
}

.project-image-area {
    position: relative;

    height: 250px;

    overflow: hidden;

    background: #07111f;
}

.project-carousel {
    position: absolute;
    inset: 0;
}

.project-image {
    position: absolute;
    inset: 0;

    width: 100%;
    height: 100%;

    object-fit: cover;

    opacity: 0;

    transition: opacity 0.45s ease;
}

.project-image.active {
    opacity: 1;
}

/* Image movement on hover removed — active image stays static */

.project-placeholder {
    position: absolute;
    inset: 0;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 13px;

    color: #5f748c;
}

.project-placeholder i {
    font-size: 2rem;
    color: #314963;
}

.project-placeholder span {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.project-overlay {
    position: absolute;
    inset: 0;

    z-index: 1;

    background:
        linear-gradient(
            to top,
            rgba(5,13,24,0.82),
            transparent 60%
        );

    transition: background 0.35s ease;
}

.project-card:hover .project-overlay {
    background:
        linear-gradient(
            to top,
            rgba(5,13,24,0.9),
            rgba(79, 140, 255, 0.08) 60%
        );
}

.project-top-info {
    position: absolute;
    z-index: 3;

    top: 16px;
    right: 16px;
    left: 16px;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.project-category,
.image-count {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    padding: 7px 9px;

    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 7px;

    background: rgba(5,13,24,0.65);

    color: #d7e2ef;

    font-size: 0.58rem;
    font-weight: 750;

    backdrop-filter: blur(8px);
}

.image-count {
    color: #aabbd0;
}


/* =========================================================
   CAROUSEL CONTROLS — always visible manual arrows
========================================================= */

.carousel-control {
    position: absolute;
    z-index: 4;

    top: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    width: 34px;
    height: 34px;

    padding: 0;

    transform: translateY(-50%);

    border: 1px solid rgba(255,255,255,0.22);
    border-radius: 50%;

    background: rgba(5,13,24,0.72);

    color: white;

    font-size: 0.68rem;

    backdrop-filter: blur(8px);

    cursor: pointer;

    opacity: 0.85;

    transition:
        opacity 0.2s ease,
        background 0.2s ease,
        transform 0.2s ease,
        border-color 0.2s ease;
}

.carousel-control:hover {
    opacity: 1;
    background: var(--portfolio-blue);
    border-color: var(--portfolio-blue);
    transform: translateY(-50%) scale(1.08);
}

.carousel-prev { left: 12px; }
.carousel-next { right: 12px; }

.carousel-dots {
    position: absolute;
    z-index: 4;

    bottom: 12px;
    left: 50%;

    display: flex;
    gap: 5px;

    transform: translateX(-50%);
}

.carousel-dot {
    width: 5px;
    height: 5px;

    padding: 0;

    border: 0;
    border-radius: 50%;

    background: rgba(255,255,255,0.4);

    cursor: pointer;

    transition:
        width 0.25s ease,
        background 0.25s ease;
}

.carousel-dot.active {
    width: 15px;

    border-radius: 5px;

    background: white;
}


/* =========================================================
   PROJECT CONTENT
========================================================= */

.project-content {
    flex: 1;

    display: flex;
    flex-direction: column;

    padding: 22px;
}

.project-content-top {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 12px;
}

.project-index {
    color: var(--portfolio-blue-light);

    font-size: 0.6rem;
    font-weight: 800;
}

.project-date {
    color: #5f738a;

    font-size: 0.6rem;
}

.project-content h3 {
    margin: 0 0 9px;

    color: white;

    font-size: 1.18rem;
    font-weight: 750;
    line-height: 1.3;
}

.project-content p {
    min-height: 68px;

    margin: 0;

    color: var(--portfolio-muted);

    font-size: 0.76rem;
    line-height: 1.7;
}

.project-tech {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;

    margin-top: 16px;
}

.project-tech span {
    padding: 5px 7px;

    border-radius: 5px;

    background: rgba(79,140,255,0.07);

    color: #8ea6c1;

    font-size: 0.57rem;
    font-weight: 650;
}


/* =========================================================
   PROJECT ACTIONS
========================================================= */

.project-actions {
    display: flex;
    align-items: stretch;
    gap: 10px;

    margin-top: auto;
    padding-top: 20px;

    border-top: 1px solid var(--portfolio-border);
}

.project-details-btn {
    flex: 1 1 auto;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;

    min-height: 48px;

    padding: 0 22px;

    border: 1px solid var(--portfolio-blue);
    border-radius: 12px;

    background: linear-gradient(
        135deg,
        var(--portfolio-blue),
        #6a7dff
    );

    color: white;

    font-size: 0.82rem;
    font-weight: 800;
    letter-spacing: 0.02em;

    box-shadow:
        0 12px 28px rgba(79,140,255,0.28),
        inset 0 1px 0 rgba(255,255,255,0.15);

    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        background 0.25s ease;
}

.project-details-btn i {
    font-size: 0.78rem;

    transition: transform 0.25s ease;
}

.project-details-btn:hover {
    transform: translateY(-3px);

    background: linear-gradient(
        135deg,
        #5c96ff,
        #7a8bff
    );

    color: white;

    box-shadow:
        0 18px 40px rgba(79,140,255,0.38),
        inset 0 1px 0 rgba(255,255,255,0.2);
}

.project-details-btn:hover i {
    transform: translateX(4px);
}

.project-live-btn {
    flex: 0 0 auto;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    min-height: 48px;

    padding: 0 14px;

    border: 1px solid var(--portfolio-border-light);
    border-radius: 12px;

    background: rgba(255,255,255,0.025);

    color: #b3c3d6;

    font-size: 0.72rem;
    font-weight: 700;

    transition:
        transform 0.25s ease,
        border-color 0.25s ease,
        background 0.25s ease,
        color 0.25s ease;
}

.project-live-btn i {
    font-size: 0.7rem;
}

.project-live-btn:hover {
    transform: translateY(-3px);

    border-color: rgba(79,140,255,0.45);

    background: rgba(79,140,255,0.07);

    color: white;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty-projects {
    grid-column: 1 / -1;

    padding: 80px 20px;

    text-align: center;

    border: 1px dashed var(--portfolio-border);
    border-radius: 20px;
}

.empty-icon {
    color: #3c5168;

    font-size: 2.2rem;
}

.empty-projects h3 {
    margin: 18px 0 7px;

    color: white;
}

.empty-projects p {
    margin: 0;

    color: var(--portfolio-muted);
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

.btn-primary-custom {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 13px;

    min-height: 52px;

    padding: 0 22px;

    border: 1px solid var(--portfolio-blue);
    border-radius: 12px;

    background: var(--portfolio-blue);
    color: white;

    font-size: 0.88rem;
    font-weight: 750;

    box-shadow: 0 10px 35px rgba(79,140,255,0.18);

    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        background 0.25s ease;
}

.btn-primary-custom:hover {
    transform: translateY(-3px);
    background: #5c96ff;
    color: white;
    box-shadow: 0 18px 40px rgba(79,140,255,0.25);
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


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1199px) {
    .projects-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 991px) {
    .hero-section {
        min-height: auto;
        padding: 90px 0 100px;
    }

    .hero-title { font-size: clamp(3rem, 9vw, 4.6rem); }
    .projects-hero-title { font-size: clamp(2.5rem, 9vw, 4rem); }

    .cta-decoration { opacity: 0.5; }
}

@media (max-width: 767px) {
    .hero-section { padding: 70px 0 85px; }
    .hero-eyebrow { font-size: 0.6rem; }
    .hero-title { margin-top: 21px; font-size: clamp(2.2rem, 11vw, 3.5rem); }
    .projects-hero-title { font-size: clamp(2.2rem, 12vw, 3.5rem); }

    .scroll-indicator { display: none; }

    .stat-card {
        min-height: 105px;
        padding: 18px;
    }

    .stat-number { font-size: 1.7rem; }
    .stat-icon { top: 19px; right: 18px; }

    .projects-section { padding: 70px 0 85px; }

    .section-heading { margin-bottom: 32px; }

    .project-tabs-wrap {
        margin-bottom: 30px;
    }

    .project-tabs {
        flex-direction: column;
        width: 100%;
        border-radius: 20px;
    }

    .project-tab {
        width: 100%;
        justify-content: center;
        padding: 12px 18px;
    }

    .projects-grid {
        grid-template-columns: 1fr;
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
    .hero-title { font-size: 2.2rem; }
    .projects-hero-title { font-size: 2.1rem; }

    .project-image-area {
        height: 220px;
    }

    .project-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .project-live-btn {
        width: 100%;
    }

    .carousel-control {
        width: 30px;
        height: 30px;
        font-size: 0.6rem;
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
                'My Projects',
                'Web Systems',
                'GIS Solutions',
                'Real Estate Tech',
                'Innovative Solutions'
            ],
            typeSpeed: 50,
            backSpeed: 30,
            backDelay: 2000,
            startDelay: 250,
            loop: true,
            showCursor: false,
            smartBackspace: true
        });
    }


    /* =====================================================
       COUNTERS
    ====================================================== */

    const counters = document.querySelectorAll('.counter');

    const animateCounter = function (counter) {

        const target = parseInt(
            counter.getAttribute('data-target'),
            10
        ) || 0;

        const duration = 1300;
        const startTime = performance.now();

        function updateCounter(currentTime) {

            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = 1 - Math.pow(1 - progress, 3);

            counter.textContent = Math.floor(easedProgress * target);

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }

        }

        requestAnimationFrame(updateCounter);
    };


    if ('IntersectionObserver' in window) {

        const counterObserver = new IntersectionObserver(
            function (entries, observer) {

                entries.forEach(function (entry) {

                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }

                });

            },
            { threshold: 0.45 }
        );

        counters.forEach(function (counter) {
            counterObserver.observe(counter);
        });

    } else {
        counters.forEach(animateCounter);
    }


    /* =====================================================
       PROJECT CAROUSELS  —  MANUAL ONLY (NO AUTO-PLAY)
    ====================================================== */

    const carousels = {};

    document
        .querySelectorAll('.project-carousel')
        .forEach(function (carousel) {

            let id = carousel.getAttribute('data-carousel-tech');
            if (!id) {
                id = carousel.getAttribute('data-carousel-gis');
                if (id) id = 'gis-' + id;
            } else {
                id = 'tech-' + id;
            }

            if (!id) return;

            const slides = carousel.querySelectorAll('.project-image');

            const dots = document.querySelectorAll(
                '[data-carousel-dot="' + id + '"]'
            );

            if (!slides.length) return;

            carousels[id] = {
                index: 0,
                slides: slides,
                dots: dots,
                root: carousel
            };

            // NOTE: No auto-play timer is created.
            // Navigation is fully manual via arrows and dots.
        });


    /* =====================================================
       CAROUSEL — APPLY SLIDE
    ====================================================== */

    function applySlide(id, index) {

        const data = carousels[id];
        if (!data) return;

        if (index >= data.slides.length) index = 0;
        if (index < 0) index = data.slides.length - 1;

        data.index = index;

        data.slides.forEach(function (slide, i) {
            slide.classList.toggle('active', i === index);
        });

        data.dots.forEach(function (dot, i) {
            dot.classList.toggle('active', i === index);
        });
    }


    /* =====================================================
       CAROUSEL — NEXT / PREV BUTTONS (MANUAL)
    ====================================================== */

    document.querySelectorAll('[data-carousel-next]')
        .forEach(function (button) {

            button.addEventListener('click', function (event) {

                event.preventDefault();
                event.stopPropagation();

                const id = button.getAttribute('data-carousel-next');
                const data = carousels[id];

                if (!data) return;

                applySlide(id, data.index + 1);
            });
        });


    document.querySelectorAll('[data-carousel-prev]')
        .forEach(function (button) {

            button.addEventListener('click', function (event) {

                event.preventDefault();
                event.stopPropagation();

                const id = button.getAttribute('data-carousel-prev');
                const data = carousels[id];

                if (!data) return;

                applySlide(id, data.index - 1);
            });
        });


    /* =====================================================
       CAROUSEL — DOTS (MANUAL)
    ====================================================== */

    document.querySelectorAll('[data-carousel-dot]')
        .forEach(function (dot) {

            dot.addEventListener('click', function (event) {

                event.preventDefault();
                event.stopPropagation();

                const id = dot.getAttribute('data-carousel-dot');
                const slide = parseInt(
                    dot.getAttribute('data-slide'),
                    10
                );

                if (isNaN(slide)) return;

                applySlide(id, slide);
            });
        });


    /* =====================================================
       TOUCH SWIPE FOR PROJECT IMAGES (MANUAL)
    ====================================================== */

    document.querySelectorAll('.project-carousel')
        .forEach(function (carousel) {

            let startX = 0;

            carousel.addEventListener('touchstart', function (event) {
                startX = event.touches[0].clientX;
            }, { passive: true });

            carousel.addEventListener('touchend', function (event) {

                const endX = event.changedTouches[0].clientX;
                const difference = startX - endX;

                if (Math.abs(difference) < 45) return;

                let id = carousel.getAttribute('data-carousel-tech');
                if (!id) {
                    const g = carousel.getAttribute('data-carousel-gis');
                    if (g) id = 'gis-' + g;
                } else {
                    id = 'tech-' + id;
                }

                const data = carousels[id];
                if (!data) return;

                if (difference > 0) {
                    applySlide(id, data.index + 1);
                } else {
                    applySlide(id, data.index - 1);
                }

            }, { passive: true });
        });


    /* =====================================================
       RE-INIT AOS + CAROUSEL WHEN TAB SWITCHES
    ====================================================== */

    document.querySelectorAll('.project-tab')
        .forEach(function (tab) {

            tab.addEventListener('shown.bs.tab', function () {

                if (typeof AOS !== 'undefined') {
                    AOS.refreshHard();
                }

                Object.keys(carousels).forEach(function (id) {
                    const data = carousels[id];
                    if (!data) return;
                    data.slides.forEach(function (slide, i) {
                        slide.classList.toggle('active', i === data.index);
                    });
                });

            });

            tab.addEventListener('click', function () {

                setTimeout(function () {

                    if (typeof AOS !== 'undefined') {
                        AOS.refresh();
                    }

                }, 350);

            });

        });


    /* =====================================================
       SMOOTH SCROLL
    ====================================================== */

    document.querySelectorAll('a[href^="#"]')
        .forEach(function (anchor) {

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

});

</script>


<?php include('../includes/footer.php'); ?>