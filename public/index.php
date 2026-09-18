<?php
$seo_title = 'Kimatu Tuli | Real Estate & Web Systems Developer';
$seo_description = 'Kimatu Tuli is a JKUAT Bachelor of Real Estate graduate and Web Systems Developer in Kenya. Explore real estate, GIS and software projects.';

/**
 * Portfolio Home Page
 * index.php
 */

include('../config/db_connect.php');
include('../includes/header.php');

/* =========================================================
   HELPER FUNCTIONS
========================================================= */

function getCount($conn, $sql)
{
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        return (int) $row['count'];
    }

    return 0;
}

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/* =========================================================
   ABOUT DATA
========================================================= */

$about_sql = "SELECT * FROM about WHERE id = 1 LIMIT 1";
$about_result = $conn->query($about_sql);
$about = $about_result ? $about_result->fetch_assoc() : null;

$profile_image = !empty($about['profile_image'])
    ? '../' . e($about['profile_image'])
    : '../assets/default-profile.jpg';

/* =========================================================
   PROJECTS
========================================================= */

$projects_sql = "
    SELECT 
        p.*,
        GROUP_CONCAT(pi.image_path) AS image_paths,
        COUNT(pi.id) AS image_count
    FROM projects p
    LEFT JOIN project_images pi ON p.id = pi.project_id
    WHERE p.category NOT LIKE '%GIS%'
      AND p.category NOT LIKE '%Mapping%'
      AND p.title NOT LIKE '%GIS%'
      AND p.title NOT LIKE '%Mapping%'
    GROUP BY p.id
    ORDER BY p.created_at DESC
    LIMIT 3
";

$projects_result = $conn->query($projects_sql);

/* =========================================================
   STATISTICS
========================================================= */

$total_projects = getCount(
    $conn,
    "SELECT COUNT(*) AS count
     FROM projects
     WHERE category NOT LIKE '%GIS%'
       AND category NOT LIKE '%Mapping%'
       AND title NOT LIKE '%GIS%'
       AND title NOT LIKE '%Mapping%'"
);

$web_projects = getCount(
    $conn,
    "SELECT COUNT(*) AS count
     FROM projects
     WHERE category LIKE '%Web%'
       AND category NOT LIKE '%GIS%'"
);

$gis_projects = getCount(
    $conn,
    "SELECT COUNT(*) AS count
     FROM projects
     WHERE category LIKE '%GIS%'
        OR category LIKE '%Real Estate%'"
);
?>

<!-- =========================================================
     PAGE
========================================================= -->

<div class="portfolio-page">

    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="hero-section" id="home">

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
                        Hello, I'm
                        <span class="typing-wrapper">
                            <span class="typed-text"></span>
                            <span class="typing-cursor"></span>
                        </span>
                    </h1>

                    <div class="hero-role" data-aos="fade-up" data-aos-delay="200">
                        <span>Real Estate &amp; Web Systems Developer</span>
                        <span class="role-divider">|</span>
                        <span>GIS Mapping</span>
                        <span class="role-divider">|</span>
                        <span>AI Integration Specialist</span>
                    </div>

                    <!-- HERO ACTIONS (desktop) -->
                    <div class="hero-actions" data-aos="fade-up" data-aos-delay="400">

                        <a href="contact.php" class="btn-primary-custom">
                            <span>Start a Project</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>

                        <a href="#projects" class="btn-outline-custom">
                            <span>Explore My Work</span>
                            <i class="fas fa-arrow-down"></i>
                        </a>

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
                                <i class="fas fa-terminal"></i>
                            </div>

                            <div>
                                <small>Building</small>
                                <strong>Digital Systems</strong>
                            </div>

                        </div>

                        <div class="floating-card floating-card-two">

                            <div class="floating-icon">
                                <i class="fas fa-location-dot"></i>
                            </div>

                            <div>
                                <small>Working with</small>
                                <strong>Spatial Data</strong>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- HERO ACTIONS (mobile, below card) -->
            <div class="hero-actions-mobile d-lg-none" data-aos="fade-up" data-aos-delay="400">

                <a href="contact.php" class="btn-primary-custom">
                    <span>Start a Project</span>
                    <i class="fas fa-arrow-right"></i>
                </a>

                <a href="#projects" class="btn-outline-custom">
                    <span>Explore My Work</span>
                    <i class="fas fa-arrow-down"></i>
                </a>

            </div>

        </div>

        <a href="#stats" class="scroll-indicator">

            <span>Scroll to explore</span>

            <div class="scroll-line">
                <span></span>
            </div>

        </a>

    </section>


    <!-- =====================================================
         STATISTICS
    ====================================================== -->

    <section class="stats-section" id="stats">

        <div class="container">

            <div class="stats-grid">

                <div class="stat-card" data-aos="fade-up">

                    <div class="stat-number">
                        <span class="counter" data-target="<?php echo $total_projects; ?>">0</span>
                        <span class="stat-plus">+</span>
                    </div>

                    <div class="stat-label">
                        Technology Projects
                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>

                </div>

                <div class="stat-card" data-aos="fade-up" data-aos-delay="100">

                    <div class="stat-number">
                        <span class="counter" data-target="<?php echo $web_projects; ?>">0</span>
                        <span class="stat-plus">+</span>
                    </div>

                    <div class="stat-label">
                        Web Applications
                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-globe"></i>
                    </div>

                </div>

                <div class="stat-card" data-aos="fade-up" data-aos-delay="200">

                    <div class="stat-number">
                        <span class="counter" data-target="<?php echo $gis_projects; ?>">0</span>
                        <span class="stat-plus">+</span>
                    </div>

                    <div class="stat-label">
                        GIS &amp; Real Estate
                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-map"></i>
                    </div>

                </div>

                <div class="stat-card" data-aos="fade-up" data-aos-delay="300">

                    <div class="stat-number">
                        <span class="counter" data-target="3">0</span>
                        <span class="stat-plus">+</span>
                    </div>

                    <div class="stat-label">
                        Live Systems
                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-server"></i>
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         TWO CAREERS
    ====================================================== -->

    <section class="careers-section">

        <div class="container">

            <div class="section-heading text-center" data-aos="fade-up">

                <span class="section-kicker">
                    TWO PROFESSIONAL PATHS
                </span>

                <h2>
                    Technology meets the
                    <span>built environment.</span>
                </h2>

                <p>
                    My work sits across two distinct fields, with each
                    strengthening the other.
                </p>

            </div>

            <div class="career-grid">

                <!-- SOFTWARE -->
                <article class="career-card software-card" data-aos="fade-up">

                    <div class="career-top">

                        <div class="career-icon">
                            <i class="fas fa-code"></i>
                        </div>

                        <span class="career-number">
                            01
                        </span>

                    </div>

                    <span class="career-kicker">
                        CAREER ONE
                    </span>

                    <h3>
                        Software<br>
                        <span>Development</span>
                    </h3>

                    <p>
                        Designing and developing web applications, business
                        systems and digital platforms with a focus on
                        functionality, scalability and user experience.
                    </p>

                    <div class="career-skills">

                        <span>Full-Stack Development</span>
                        <span>PHP / MySQL</span>
                        <span>System Architecture</span>
                        <span>AI Integration</span>
                        <span>Automation</span>

                    </div>

                    <div class="career-arrow">
                        <i class="fas fa-arrow-up-right-from-square"></i>
                    </div>

                </article>


                <!-- REAL ESTATE -->
                <article class="career-card real-estate-card" data-aos="fade-up" data-aos-delay="150">

                    <div class="career-top">

                        <div class="career-icon">
                            <i class="fas fa-building"></i>
                        </div>

                        <span class="career-number">
                            02
                        </span>

                    </div>

                    <span class="career-kicker">
                        CAREER TWO
                    </span>

                    <h3>
                        Real Estate<br>
                        <span>Specialist</span>
                    </h3>

                    <p>
                        Developing expertise in property markets, valuation,
                        investment analysis, development, property systems
                        and spatial approaches to real estate.
                    </p>

                    <div class="career-skills">

                        <span>Property Valuation</span>
                        <span>Real Estate Analysis</span>
                        <span>Property Development</span>
                        <span>GIS &amp; Mapping</span>
                        <span>Investment Analysis</span>

                    </div>

                    <div class="career-arrow">
                        <i class="fas fa-arrow-up-right-from-square"></i>
                    </div>

                </article>

            </div>

        </div>

    </section>


    <!-- =====================================================
         ABOUT
    ====================================================== -->

    <section class="about-section" id="about">

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
                        ABOUT ME
                    </span>

                    <h2>
                        Building systems.
                        <br>
                        Understanding <span>property.</span>
                    </h2>

                    <div class="about-text">
                        <?php echo !empty($about['summary']) ? nl2br(e($about['summary'])) : "Welcome to my portfolio website! I'm a passionate software developer and real estate specialist with a focus on web systems, GIS, AI integration and technology-driven solutions."; ?>
                    </div>

                    <div class="about-focus-grid">

                        <div class="focus-item">
                            <i class="fas fa-code"></i>
                            <div>
                                <strong>Software</strong>
                                <span>Development</span>
                            </div>
                        </div>

                        <div class="focus-item">
                            <i class="fas fa-building"></i>
                            <div>
                                <strong>Real Estate</strong>
                                <span>Analysis</span>
                            </div>
                        </div>

                        <div class="focus-item">
                            <i class="fas fa-map-marked-alt"></i>
                            <div>
                                <strong>GIS</strong>
                                <span>Spatial Intelligence</span>
                            </div>
                        </div>

                        <div class="focus-item">
                            <i class="fas fa-robot"></i>
                            <div>
                                <strong>AI</strong>
                                <span>Integration</span>
                            </div>
                        </div>

                    </div>

                    <div class="about-actions">

                        <a href="about.php" class="btn-primary-custom">
                            <span>More About Me</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>

                        <a
                            href="../assets/TULI_MOSES_CV.pdf"
                            class="text-link"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <i class="fas fa-file-arrow-down"></i>
                            Download CV
                        </a>

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
                    WHAT I WORK WITH
                </span>

                <h2>
                    Skills across
                    <span>two disciplines.</span>
                </h2>

            </div>

            <div class="skills-grid">

                <div class="skill-card" data-aos="fade-up">

                    <div class="skill-number">01</div>

                    <div class="skill-icon">
                        <i class="fas fa-building"></i>
                    </div>

                    <h3>
                        Real Estate
                    </h3>

                    <p>
                        Property analysis, valuation, development,
                        investment planning and property management systems.
                    </p>

                    <div class="skill-line"></div>

                </div>

                <div class="skill-card" data-aos="fade-up" data-aos-delay="100">

                    <div class="skill-number">02</div>

                    <div class="skill-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>

                    <h3>
                        Software Development
                    </h3>

                    <p>
                        Full-stack web development, backend systems,
                        databases, APIs and business applications.
                    </p>

                    <div class="skill-line"></div>

                </div>

                <div class="skill-card" data-aos="fade-up" data-aos-delay="200">

                    <div class="skill-number">03</div>

                    <div class="skill-icon">
                        <i class="fas fa-map-location-dot"></i>
                    </div>

                    <h3>
                        GIS &amp; Spatial Data
                    </h3>

                    <p>
                        Mapping, spatial analysis, site analysis and
                        location-based approaches to real estate.
                    </p>

                    <div class="skill-line"></div>

                </div>

                <div class="skill-card" data-aos="fade-up" data-aos-delay="300">

                    <div class="skill-number">04</div>

                    <div class="skill-icon">
                        <i class="fas fa-brain"></i>
                    </div>

                    <h3>
                        AI Integration
                    </h3>

                    <p>
                        Integrating AI into applications, workflows,
                        analytics and intelligent digital systems.
                    </p>

                    <div class="skill-line"></div>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         PROJECTS
    ====================================================== -->

    <section class="projects-section" id="projects">

        <div class="container">

            <div class="projects-heading" data-aos="fade-up">

                <div>

                    <span class="section-kicker">
                        SELECTED WORK
                    </span>

                    <h2>
                        Featured <span>projects.</span>
                    </h2>

                </div>

                <a href="projects.php" class="view-all-link">
                    View all projects
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>


            <div class="projects-grid">

                <?php if ($projects_result && $projects_result->num_rows > 0): ?>

                    <?php
                    $project_index = 0;

                    while ($project = $projects_result->fetch_assoc()):

                        $project_index++;

                        $description = !empty($project['description'])
                            ? strip_tags($project['description'])
                            : 'A technology project combining practical problem solving, design and development.';

                        if (function_exists('mb_substr')) {
                            $description_preview = mb_substr($description, 0, 155);
                        } else {
                            $description_preview = substr($description, 0, 155);
                        }

                        if (strlen($description) > 155) {
                            $description_preview .= '...';
                        }

                        $images = [];

                        if (!empty($project['image_paths'])) {
                            $images = array_filter(
                                explode(',', $project['image_paths'])
                            );
                        }

                        $category = !empty($project['category'])
                            ? $project['category']
                            : 'Technology Project';

                        $project_url = !empty($project['project_url'])
                            ? $project['project_url']
                            : '#';

                        $technologies = [];

                        if (!empty($project['technologies'])) {
                            $technologies = array_filter(
                                array_map(
                                    'trim',
                                    explode(',', $project['technologies'])
                                )
                            );
                        }
                    ?>

                        <article
                            class="project-card"
                            data-aos="fade-up"
                            data-aos-delay="<?php echo ($project_index - 1) * 100; ?>"
                        >

                            <!-- IMAGE -->
                            <div class="project-image-area">

                                <?php if (!empty($images)): ?>

                                    <div
                                        class="project-carousel"
                                        data-carousel="<?php echo $project_index; ?>"
                                    >

                                        <?php foreach ($images as $image_index => $image): ?>

                                            <img
                                                src="../<?php echo e($image); ?>"
                                                alt="<?php echo e($project['title']); ?>"
                                                class="project-image <?php echo $image_index === 0 ? 'active' : ''; ?>"
                                                data-slide="<?php echo $image_index; ?>"
                                                loading="lazy"
                                                onerror="this.style.display='none';"
                                            >

                                        <?php endforeach; ?>

                                    </div>

                                    <?php if (count($images) > 1): ?>

                                        <button
                                            type="button"
                                            class="carousel-control carousel-prev"
                                            data-carousel-prev="<?php echo $project_index; ?>"
                                            aria-label="Previous project image"
                                        >
                                            <i class="fas fa-chevron-left"></i>
                                        </button>

                                        <button
                                            type="button"
                                            class="carousel-control carousel-next"
                                            data-carousel-next="<?php echo $project_index; ?>"
                                            aria-label="Next project image"
                                        >
                                            <i class="fas fa-chevron-right"></i>
                                        </button>

                                        <div class="carousel-dots">

                                            <?php foreach ($images as $image_index => $image): ?>

                                                <button
                                                    type="button"
                                                    class="carousel-dot <?php echo $image_index === 0 ? 'active' : ''; ?>"
                                                    data-carousel-dot="<?php echo $project_index; ?>"
                                                    data-slide="<?php echo $image_index; ?>"
                                                    aria-label="View image <?php echo $image_index + 1; ?>"
                                                ></button>

                                            <?php endforeach; ?>

                                        </div>

                                    <?php endif; ?>

                                <?php else: ?>

                                    <div class="project-placeholder">

                                        <i class="fas fa-laptop-code"></i>

                                        <span>
                                            <?php echo e($category); ?>
                                        </span>

                                    </div>

                                <?php endif; ?>


                                <div class="project-overlay"></div>

                                <div class="project-top-info">

                                    <span class="project-category">
                                        <?php echo e($category); ?>
                                    </span>

                                    <?php if (count($images) > 1): ?>

                                        <span class="image-count">
                                            <i class="fas fa-images"></i>
                                            <?php echo count($images); ?>
                                        </span>

                                    <?php endif; ?>

                                </div>

                            </div>


                            <!-- CONTENT -->
                            <div class="project-content">

                                <div class="project-content-top">

                                    <span class="project-index">
                                        0<?php echo $project_index; ?>
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


                                <?php if (!empty($technologies)): ?>

                                    <div class="project-tech">

                                        <?php
                                        $technology_count = 0;

                                        foreach ($technologies as $technology):

                                            if ($technology_count >= 4) {
                                                break;
                                            }

                                            $technology_count++;
                                        ?>

                                            <span>
                                                <?php echo e($technology); ?>
                                            </span>

                                        <?php endforeach; ?>

                                    </div>

                                <?php endif; ?>


                                <a
                                    href="<?php echo e($project_url); ?>"
                                    class="project-link"
                                    <?php if ($project_url !== '#'): ?>
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    <?php endif; ?>
                                >

                                    <span>
                                        View Project
                                    </span>

                                    <span class="project-link-icon">
                                        <i class="fas fa-arrow-up-right-from-square"></i>
                                    </span>

                                </a>

                            </div>

                        </article>

                    <?php endwhile; ?>

                <?php else: ?>

                    <div class="empty-projects">

                        <div class="empty-icon">
                            <i class="fas fa-folder-open"></i>
                        </div>

                        <h3>
                            Projects coming soon
                        </h3>

                        <p>
                            I'm currently preparing projects to showcase here.
                        </p>

                    </div>

                <?php endif; ?>

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
                        LET'S BUILD SOMETHING
                    </span>

                    <h2>
                        Have an idea that
                        <span>needs a system?</span>
                    </h2>

                    <p>
                        Whether it is a software application, business system,
                        real estate solution or data-driven project,
                        let's turn the idea into something useful.
                    </p>

                    <div class="cta-actions">

                        <a href="contact.php" class="btn-primary-custom light-button">
                            <span>Let's Work Together</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>

                        <a href="tel:+254745117912" class="cta-phone">
                            <i class="fas fa-phone"></i>
                            <span>+254 745 117 912</span>
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
     AOS
========================================================= -->

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
>


<!-- =========================================================
     CUSTOM CSS
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


/* =========================================================
   BASE
========================================================= */

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
        radial-gradient(
            circle at 75% 20%,
            rgba(79, 140, 255, 0.13),
            transparent 30%
        ),
        radial-gradient(
            circle at 15% 75%,
            rgba(53, 214, 176, 0.07),
            transparent 30%
        ),
        var(--portfolio-bg);
}

.hero-grid {
    position: absolute;
    inset: 0;

    opacity: 0.35;

    background-image:
        linear-gradient(
            rgba(255,255,255,0.025) 1px,
            transparent 1px
        ),
        linear-gradient(
            90deg,
            rgba(255,255,255,0.025) 1px,
            transparent 1px
        );

    background-size: 55px 55px;

    mask-image: linear-gradient(
        to bottom,
        black,
        transparent 90%
    );
}

/* =========================================================
   FLASHLIGHT (top-left entrance light beam)
========================================================= */

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

.flashlight-left {
    left: -6%;
}

.flashlight-right {
    right: -6%;
    left: auto;
}

.flashlight-right .flashlight-beam {
    transform-origin: 100% 0%;
    transform: scale(0.85) scaleX(-1);
}

/* Cone of light shining down-right from the source point */
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

/* Bright glowing point where the light originates */
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

/* Star-burst flare rays */
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

.ray-h {
    width: 220px;
    height: 2px;

    margin-top: -1px;
}

.ray-v {
    width: 2px;
    height: 220px;

    margin-left: -1px;

    background: linear-gradient(
        to bottom,
        rgba(255,255,255,0.95),
        rgba(255,255,255,0.25) 35%,
        rgba(255,255,255,0)
    );
}

.ray-d1 {
    width: 170px;
    height: 1.5px;

    margin-top: -0.75px;

    transform: rotate(45deg);
    transform-origin: 0% 50%;
}

.ray-d2 {
    width: 170px;
    height: 1.5px;

    margin-top: -0.75px;

    transform: rotate(-45deg);
    transform-origin: 0% 50%;
}

@keyframes flashlightIn {

    0% {
        opacity: 0;
        transform: scale(0.4);
    }

    100% {
        opacity: 1;
        transform: scale(1);
    }

}

@keyframes coreFlicker {

    0%,
    100% {
        opacity: 1;
        transform: scale(1);
    }

    50% {
        opacity: 0.88;
        transform: scale(0.96);
    }

}

@keyframes beamFlicker {

    0%,
    100% {
        opacity: 1;
    }

    50% {
        opacity: 0.82;
    }

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

}

@media (max-width: 767px) {

    .flashlight-beam {
        width: 900px;
        height: 900px;
    }

    .flashlight-core {
        width: 34px;
        height: 34px;

        margin: -17px 0 0 -17px;
    }

    .ray-h,
    .ray-d1,
    .ray-d2 {
        width: 130px;
    }

    .ray-v {
        height: 130px;
    }

}

.hero-glow {
    position: absolute;
    border-radius: 50%;
    filter: blur(2px);
    pointer-events: none;
}

.hero-glow-one {
    width: 260px;
    height: 260px;

    top: 10%;
    right: 8%;

    border: 1px solid rgba(79, 140, 255, 0.08);

    animation: slowFloat 8s ease-in-out infinite;
}

.hero-glow-two {
    width: 180px;
    height: 180px;

    bottom: 10%;
    left: 3%;

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

.typed-text {
    display: inline;
}

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

.hero-description {
    max-width: 680px;

    margin: 23px 0 0;

    color: var(--portfolio-muted);

    font-size: 1.05rem;
    line-height: 1.85;
}

.hero-description strong {
    color: #dce9fa;
    font-weight: 700;
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

    box-shadow:
        0 10px 35px rgba(79,140,255,0.18);
}

.btn-primary-custom:hover {
    transform: translateY(-3px);

    background: #5c96ff;
    color: white;

    box-shadow:
        0 18px 40px rgba(79,140,255,0.25);
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

.hero-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 28px;

    margin-top: 42px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 11px;
}

.meta-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 37px;
    height: 37px;

    border: 1px solid var(--portfolio-border);

    border-radius: 10px;

    background: rgba(255,255,255,0.035);

    color: var(--portfolio-blue-light);

    font-size: 0.82rem;
}

.meta-item small {
    display: block;

    margin-bottom: 2px;

    color: #687b91;

    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

.meta-item strong {
    display: block;

    color: #d9e4f1;

    font-size: 0.78rem;
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
        linear-gradient(
            145deg,
            rgba(255,255,255,0.07),
            rgba(255,255,255,0.018)
        );

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

    background:
        linear-gradient(
            145deg,
            #172940,
            #08111e
        );
}

.profile-image-wrap::after {
    content: "";

    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            to top,
            rgba(7,17,31,0.65),
            transparent 45%
        );

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

.floating-card-one {
    top: 19%;
    left: -42px;
}

.floating-card-two {
    right: -38px;
    bottom: 17%;

    animation-delay: -2s;
}

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
   SCROLL
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
    display: grid;
    grid-template-columns: repeat(4, 1fr);
}

.stat-card {
    position: relative;

    min-height: 125px;

    padding: 23px 28px;

    border-right: 1px solid var(--portfolio-border);
}

.stat-card:last-child {
    border-right: 0;
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
   CAREERS
========================================================= */

.careers-section {
    padding: 120px 0;

    background:
        radial-gradient(
            circle at 20% 20%,
            rgba(79,140,255,0.04),
            transparent 30%
        ),
        var(--portfolio-bg);
}

.section-heading {
    margin-bottom: 55px;
}

.section-heading.text-center p {
    margin-right: auto;
    margin-left: auto;
}

.section-heading h2,
.projects-heading h2 {
    margin: 12px 0 0;

    color: white;

    font-size: clamp(2.1rem, 4vw, 3.5rem);
    font-weight: 800;
    line-height: 1.08;
    letter-spacing: -0.045em;
}

.section-heading h2 span,
.projects-heading h2 span {
    color: var(--portfolio-blue-light);
}

.section-heading p {
    max-width: 570px;

    margin-top: 16px;

    color: var(--portfolio-muted);

    line-height: 1.75;
}

.career-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.career-card {
    position: relative;

    min-height: 440px;

    padding: 34px;

    overflow: hidden;

    border: 1px solid var(--portfolio-border);
    border-radius: var(--portfolio-radius);

    background: var(--portfolio-surface);

    transition:
        transform 0.35s ease,
        border-color 0.35s ease,
        background 0.35s ease;
}

.career-card:hover {
    transform: translateY(-7px);

    border-color: rgba(79,140,255,0.25);

    background: var(--portfolio-surface-2);
}

.career-card::before {
    content: "";

    position: absolute;

    width: 250px;
    height: 250px;

    top: -130px;
    right: -100px;

    border-radius: 50%;

    background: rgba(79,140,255,0.07);

    filter: blur(15px);
}

.real-estate-card::before {
    background: rgba(53,214,176,0.06);
}

.career-top {
    position: relative;
    z-index: 2;

    display: flex;
    align-items: center;
    justify-content: space-between;
}

.career-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 53px;
    height: 53px;

    border: 1px solid rgba(79,140,255,0.2);
    border-radius: 15px;

    background: rgba(79,140,255,0.08);

    color: var(--portfolio-blue-light);
}

.real-estate-card .career-icon {
    border-color: rgba(53,214,176,0.18);
    background: rgba(53,214,176,0.07);
    color: var(--portfolio-cyan);
}

.career-number {
    color: #53677e;

    font-size: 0.7rem;
    font-weight: 800;
    letter-spacing: 0.1em;
}

.career-kicker {
    display: block;

    margin-top: 58px;

    color: #6f8399;

    font-size: 0.65rem;
    font-weight: 750;
    letter-spacing: 0.15em;
}

.career-card h3 {
    position: relative;
    z-index: 2;

    margin: 8px 0 15px;

    color: white;

    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1.02;
    letter-spacing: -0.045em;
}

.career-card h3 span {
    color: var(--portfolio-blue-light);
}

.real-estate-card h3 span {
    color: var(--portfolio-cyan);
}

.career-card p {
    position: relative;
    z-index: 2;

    max-width: 560px;

    color: var(--portfolio-muted);

    font-size: 0.88rem;
    line-height: 1.8;
}

.career-skills {
    position: relative;
    z-index: 2;

    display: flex;
    flex-wrap: wrap;
    gap: 7px;

    margin-top: 25px;
}

.career-skills span {
    padding: 7px 10px;

    border: 1px solid var(--portfolio-border);
    border-radius: 7px;

    color: #9aacbf;

    font-size: 0.63rem;
}

.career-arrow {
    position: absolute;

    right: 28px;
    bottom: 28px;

    color: #53687e;

    transition:
        color 0.25s ease,
        transform 0.25s ease;
}

.career-card:hover .career-arrow {
    color: var(--portfolio-blue-light);

    transform: translate(3px, -3px);
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
    top: -9px;
    left: -9px;

    border-top: 2px solid;
    border-left: 2px solid;

    border-radius: 12px 0 0 0;
}

.image-corner-two {
    right: -9px;
    bottom: -9px;

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
}

.focus-item span {
    display: block;

    margin-top: 2px;

    color: #6d8197;

    font-size: 0.6rem;
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
   SKILLS
========================================================= */

.skills-section {
    padding: 120px 0;

    background: var(--portfolio-bg);
}

.skills-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
}

.skill-card {
    position: relative;

    min-height: 320px;

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
    margin: 23px 0 10px;

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

    background: linear-gradient(
        90deg,
        var(--portfolio-blue),
        transparent
    );

    opacity: 0.35;
}


/* =========================================================
   PROJECTS
========================================================= */

.projects-section {
    padding: 120px 0;

    background: #091523;
}

.projects-heading {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    margin-bottom: 45px;
}

.view-all-link {
    display: inline-flex;
    align-items: center;
    gap: 10px;

    padding-bottom: 6px;

    border-bottom: 1px solid rgba(255,255,255,0.14);

    color: #aabbd0;

    font-size: 0.74rem;
    font-weight: 700;

    transition:
        color 0.2s ease,
        border-color 0.2s ease;
}

.view-all-link:hover {
    border-color: var(--portfolio-blue);

    color: white;
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.project-card {
    overflow: hidden;

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

    transition:
        opacity 0.45s ease,
        transform 0.6s ease;
}

.project-image.active {
    opacity: 1;
}

.project-card:hover .project-image.active {
    transform: scale(1.035);
}

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

.carousel-control {
    position: absolute;
    z-index: 4;

    top: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    width: 31px;
    height: 31px;

    padding: 0;

    transform: translateY(-50%);

    border: 1px solid rgba(255,255,255,0.14);
    border-radius: 50%;

    background: rgba(5,13,24,0.62);

    color: white;

    font-size: 0.62rem;

    backdrop-filter: blur(8px);

    opacity: 0;

    transition: opacity 0.2s ease;
}

.project-image-area:hover .carousel-control {
    opacity: 1;
}

.carousel-prev {
    left: 13px;
}

.carousel-next {
    right: 13px;
}

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
}

.carousel-dot.active {
    width: 15px;

    border-radius: 5px;

    background: white;
}

.project-content {
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

.project-link {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-top: 22px;
    padding-top: 16px;

    border-top: 1px solid var(--portfolio-border);

    color: #c8d7e7;

    font-size: 0.7rem;
    font-weight: 750;
}

.project-link-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 29px;
    height: 29px;

    border: 1px solid var(--portfolio-border);
    border-radius: 8px;

    color: var(--portfolio-blue-light);

    transition:
        background 0.2s ease,
        transform 0.2s ease;
}

.project-link:hover {
    color: white;
}

.project-link:hover .project-link-icon {
    background: rgba(79,140,255,0.1);

    transform: translate(2px, -2px);
}

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
        linear-gradient(
            135deg,
            #0c1b2e,
            #091625
        );
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

    top: 0;
    right: 0;
    bottom: 0;

    width: 38%;
}

.cta-circle {
    position: absolute;

    border: 1px solid rgba(79,140,255,0.15);

    border-radius: 50%;
}

.circle-one {
    width: 300px;
    height: 300px;

    top: 30px;
    right: -80px;
}

.circle-two {
    width: 190px;
    height: 190px;

    top: 85px;
    right: -25px;

    border-color: rgba(53,214,176,0.12);
}

.cta-code {
    position: absolute;

    top: 50%;
    right: 80px;

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
    0%,
    49% {
        opacity: 1;
    }

    50%,
    100% {
        opacity: 0;
    }
}

@keyframes dotPulse {
    0%,
    100% {
        transform: scale(1);
        opacity: 1;
    }

    50% {
        transform: scale(1.25);
        opacity: 0.65;
    }
}

@keyframes slowFloat {
    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-15px);
    }
}

@keyframes cardFloat {
    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-7px);
    }
}

@keyframes floatingCard {
    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-8px);
    }
}

@keyframes scrollDown {
    0% {
        transform: translateY(-15px);
    }

    50% {
        transform: translateY(15px);
    }

    100% {
        transform: translateY(35px);
    }
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1199px) {

    .hero-title {
        font-size: 4.5rem;
    }

    .about-grid {
        gap: 55px;
    }

    .skills-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .projects-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .project-card:last-child {
        grid-column: 1 / -1;
        max-width: calc(50% - 9px);
        margin: 0 auto;
    }

}


@media (max-width: 991px) {

    .hero-section {
        min-height: auto;

        padding: 90px 0 100px;
    }

    .hero-title {
        font-size: clamp(3rem, 9vw, 4.6rem);
    }

    .hero-profile-wrap {
        margin-top: 20px;
    }

    .floating-card-one {
        left: -10px;
    }

    .floating-card-two {
        right: -10px;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .stat-card:nth-child(2) {
        border-right: 0;
    }

    .stat-card:nth-child(-n+2) {
        border-bottom: 1px solid var(--portfolio-border);
    }

    .career-grid {
        grid-template-columns: 1fr;
    }

    .career-card {
        min-height: 390px;
    }

    .about-grid {
        grid-template-columns: 1fr;
    }

    .about-visual {
        display: flex;
        justify-content: center;
    }

    .about-image-frame {
        width: min(100%, 480px);
    }

    .about-content {
        max-width: 750px;
    }

    .cta-decoration {
        opacity: 0.5;
    }

    /* Mobile button reordering */
    .hero-actions {
        display: none;
    }

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

}


@media (max-width: 767px) {

    .hero-section {
        padding: 70px 0 85px;
    }

    .hero-eyebrow {
        font-size: 0.6rem;
    }

    .hero-title {
        margin-top: 21px;

        font-size: clamp(2.7rem, 14vw, 4rem);
    }

    .hero-role {
        font-size: 0.8rem;
    }

    .hero-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-primary-custom,
    .btn-outline-custom {
        width: 100%;
    }

    .hero-actions-mobile {
        margin-top: 25px;
    }

    .hero-meta {
        gap: 17px;
    }

    .meta-item strong {
        font-size: 0.68rem;
    }

    .hero-profile-wrap {
        width: calc(100% - 20px);
    }

    .profile-image-wrap,
    .profile-image {
        height: 300px;
        min-height: 300px;
    }

    .floating-card {
        transform: scale(0.85);
    }

    .floating-card-one {
        left: -20px;
    }

    .floating-card-two {
        right: -20px;
    }

    .scroll-indicator {
        display: none;
    }

    .stats-grid {
        grid-template-columns: 1fr 1fr;
    }

    .stat-card {
        min-height: 105px;

        padding: 18px;
    }

    .stat-number {
        font-size: 1.7rem;
    }

    .stat-icon {
        top: 19px;
        right: 18px;
    }

    .careers-section,
    .about-section,
    .skills-section,
    .projects-section {
        padding: 85px 0;
    }

    .section-heading {
        margin-bottom: 38px;
    }

    .career-card {
        padding: 26px;
    }

    .career-card h3 {
        font-size: 2.2rem;
    }

    .about-image {
        height: 420px;
    }

    .experience-badge {
        right: -5px;
        bottom: 25px;
    }

    .about-focus-grid {
        grid-template-columns: 1fr 1fr;
    }

    .skills-grid {
        grid-template-columns: 1fr;
    }

    .skill-card {
        min-height: 270px;
    }

    .projects-heading {
        align-items: flex-start;
        flex-direction: column;
        gap: 22px;
    }

    .projects-grid {
        grid-template-columns: 1fr;
    }

    .project-card:last-child {
        grid-column: auto;

        max-width: none;
    }

    .cta-card {
        min-height: auto;

        padding: 40px 27px;
    }

    .cta-decoration {
        display: none;
    }

    .cta-actions {
        align-items: stretch;
        flex-direction: column;
        gap: 18px;
    }

    .cta-phone {
        justify-content: center;
    }

}


@media (max-width: 480px) {

    .hero-title {
        font-size: 2.65rem;
    }

    .hero-meta {
        display: grid;
        grid-template-columns: 1fr;
    }

    .profile-card {
        padding: 14px;

        border-radius: 22px;
    }

    .profile-image-wrap,
    .profile-image {
        height: 275px;
        min-height: 275px;
    }

    .profile-card-content h2 {
        font-size: 1.65rem;
    }

    .profile-tags span {
        font-size: 0.57rem;
    }

    .floating-card {
        display: none;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .stat-card,
    .stat-card:nth-child(2) {
        border-right: 0;
        border-bottom: 1px solid var(--portfolio-border);
    }

    .stat-card:last-child {
        border-bottom: 0;
    }

    .career-card {
        min-height: auto;
    }

    .career-kicker {
        margin-top: 40px;
    }

    .career-card h3 {
        font-size: 2rem;
    }

    .about-focus-grid {
        grid-template-columns: 1fr;
    }

    .about-image {
        height: 360px;
    }

    .experience-badge {
        right: 10px;
    }

    .project-image-area {
        height: 220px;
    }

}


/* =========================================================
   REDUCED MOTION
========================================================= */

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

    if (
        typedElement &&
        typeof Typed !== 'undefined'
    ) {

        new Typed('.typed-text', {

            strings: [
                'Tuli Moses Kimatu',
                'a SOFTWARE DEVELOPER',
                'REAL ESTATE SPECIALIST'
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

            const progress = Math.min(
                elapsed / duration,
                1
            );

            const easedProgress =
                1 - Math.pow(1 - progress, 3);

            counter.textContent = Math.floor(
                easedProgress * target
            );

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
            {
                threshold: 0.45
            }
        );

        counters.forEach(function (counter) {
            counterObserver.observe(counter);
        });

    } else {

        counters.forEach(animateCounter);

    }


    /* =====================================================
       PROJECT CAROUSELS
    ====================================================== */

    const carousels = {};

    document
        .querySelectorAll('.project-carousel')
        .forEach(function (carousel) {

            const id = carousel.getAttribute(
                'data-carousel'
            );

            const slides = carousel.querySelectorAll(
                '.project-image'
            );

            const dots = document.querySelectorAll(
                '[data-carousel-dot="' + id + '"]'
            );

            if (!slides.length) {
                return;
            }

            carousels[id] = {
                index: 0,
                slides: slides,
                dots: dots,
                timer: null
            };


            function showSlide(index) {

                const data = carousels[id];

                if (!data) {
                    return;
                }

                if (index >= data.slides.length) {
                    index = 0;
                }

                if (index < 0) {
                    index = data.slides.length - 1;
                }

                data.index = index;

                data.slides.forEach(function (slide, i) {

                    slide.classList.toggle(
                        'active',
                        i === index
                    );

                });

                data.dots.forEach(function (dot, i) {

                    dot.classList.toggle(
                        'active',
                        i === index
                    );

                });

            }


            function nextSlide() {
                showSlide(carousels[id].index + 1);
            }


            function startAutoPlay() {

                if (slides.length <= 1) {
                    return;
                }

                if (
                    window.matchMedia(
                        '(prefers-reduced-motion: reduce)'
                    ).matches
                ) {
                    return;
                }

                carousels[id].timer = setInterval(
                    nextSlide,
                    5000
                );

            }


            function stopAutoPlay() {

                if (carousels[id].timer) {

                    clearInterval(
                        carousels[id].timer
                    );

                    carousels[id].timer = null;

                }

            }


            carousel.addEventListener(
                'mouseenter',
                stopAutoPlay
            );

            carousel.addEventListener(
                'mouseleave',
                startAutoPlay
            );

            startAutoPlay();

        });


    /* =====================================================
       CAROUSEL BUTTONS
    ====================================================== */

    document.querySelectorAll(
        '[data-carousel-next]'
    ).forEach(function (button) {

        button.addEventListener(
            'click',
            function (event) {

                event.preventDefault();
                event.stopPropagation();

                const id = button.getAttribute(
                    'data-carousel-next'
                );

                const data = carousels[id];

                if (!data) {
                    return;
                }

                data.index++;

                if (data.index >= data.slides.length) {
                    data.index = 0;
                }

                data.slides.forEach(function (slide, i) {

                    slide.classList.toggle(
                        'active',
                        i === data.index
                    );

                });

                data.dots.forEach(function (dot, i) {

                    dot.classList.toggle(
                        'active',
                        i === data.index
                    );

                });

            }
        );

    });


    document.querySelectorAll(
        '[data-carousel-prev]'
    ).forEach(function (button) {

        button.addEventListener(
            'click',
            function (event) {

                event.preventDefault();
                event.stopPropagation();

                const id = button.getAttribute(
                    'data-carousel-prev'
                );

                const data = carousels[id];

                if (!data) {
                    return;
                }

                data.index--;

                if (data.index < 0) {
                    data.index =
                        data.slides.length - 1;
                }

                data.slides.forEach(function (slide, i) {

                    slide.classList.toggle(
                        'active',
                        i === data.index
                    );

                });

                data.dots.forEach(function (dot, i) {

                    dot.classList.toggle(
                        'active',
                        i === data.index
                    );

                });

            }
        );

    });


    /* =====================================================
       CAROUSEL DOTS
    ====================================================== */

    document.querySelectorAll(
        '[data-carousel-dot]'
    ).forEach(function (dot) {

        dot.addEventListener(
            'click',
            function (event) {

                event.preventDefault();
                event.stopPropagation();

                const id = dot.getAttribute(
                    'data-carousel-dot'
                );

                const slide = parseInt(
                    dot.getAttribute('data-slide'),
                    10
                );

                const data = carousels[id];

                if (!data || isNaN(slide)) {
                    return;
                }

                data.index = slide;

                data.slides.forEach(function (image, i) {

                    image.classList.toggle(
                        'active',
                        i === slide
                    );

                });

                data.dots.forEach(function (item, i) {

                    item.classList.toggle(
                        'active',
                        i === slide
                    );

                });

            }
        );

    });


    /* =====================================================
       SMOOTH SCROLL
    ====================================================== */

    document.querySelectorAll(
        'a[href^="#"]'
    ).forEach(function (anchor) {

        anchor.addEventListener(
            'click',
            function (event) {

                const targetId =
                    this.getAttribute('href');

                if (
                    !targetId ||
                    targetId === '#'
                ) {
                    return;
                }

                const target =
                    document.querySelector(targetId);

                if (!target) {
                    return;
                }

                event.preventDefault();

                target.scrollIntoView({
                    behavior:
                        window.matchMedia(
                            '(prefers-reduced-motion: reduce)'
                        ).matches
                            ? 'auto'
                            : 'smooth',
                    block: 'start'
                });

            }
        );

    });


    /* =====================================================
       TOUCH SWIPE FOR PROJECT IMAGES
    ====================================================== */

    document.querySelectorAll(
        '.project-carousel'
    ).forEach(function (carousel) {

        let startX = 0;

        carousel.addEventListener(
            'touchstart',
            function (event) {

                startX =
                    event.touches[0].clientX;

            },
            {
                passive: true
            }
        );

        carousel.addEventListener(
            'touchend',
            function (event) {

                const endX =
                    event.changedTouches[0].clientX;

                const difference =
                    startX - endX;

                if (Math.abs(difference) < 45) {
                    return;
                }

                const id =
                    carousel.getAttribute(
                        'data-carousel'
                    );

                const data = carousels[id];

                if (!data) {
                    return;
                }

                if (difference > 0) {
                    data.index++;
                } else {
                    data.index--;
                }

                if (data.index >= data.slides.length) {
                    data.index = 0;
                }

                if (data.index < 0) {
                    data.index =
                        data.slides.length - 1;
                }

                data.slides.forEach(
                    function (slide, i) {

                        slide.classList.toggle(
                            'active',
                            i === data.index
                        );

                    }
                );

                data.dots.forEach(
                    function (dot, i) {

                        dot.classList.toggle(
                            'active',
                            i === data.index
                        );

                    }
                );

            },
            {
                passive: true
            }
        );

    });

});

</script>


<?php
include('../includes/footer.php');
?>