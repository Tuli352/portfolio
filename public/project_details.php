<?php
include('../config/db_connect.php');
$id = intval($_GET['id']);

// Fetch project data with all images
$query = "SELECT p.*, 
                 GROUP_CONCAT(pi.image_path) as image_paths,
                 COUNT(pi.id) as image_count
          FROM projects p 
          LEFT JOIN project_images pi ON p.id = pi.project_id 
          WHERE p.id = $id 
          GROUP BY p.id 
          LIMIT 1";
$result = $conn->query($query);
$project = $result->fetch_assoc();

// If project doesn't exist, redirect
if (!$project) {
    header("Location: projects.php?error=not_found");
    exit();
}

$seo_title = e($project['title']) . ' | Kimatu Tuli Projects';
$seo_description = trim(substr(strip_tags($project['description']), 0, 155));
$seo_url = 'https://kimatutuli.page.gd/tuli_portfolio/public/project_details.php?id=' . $id;
$seo_type = 'article';

include('../includes/header.php');

// Process images
$images = [];
if (!empty($project['image_paths'])) {
    $image_paths = explode(',', $project['image_paths']);
    foreach ($image_paths as $path) {
        $images[] = trim($path);
    }
}

// If no additional images, use the main project image
if (empty($images) && !empty($project['image'])) {
    $images[] = $project['image'];
}

$has_multiple_images = count($images) > 1;

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>

<!-- =========================================================
     PAGE
========================================================= -->

<div class="portfolio-page project-details-page">

    <!-- =====================================================
         HERO — Full-width image with overlay
    ====================================================== -->

    <section class="hero-section details-hero" id="home">

        <?php if (!empty($images)): ?>

            <div class="hero-carousel">

                <?php foreach($images as $index => $image): ?>

                    <div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img
                            src="../<?php echo e($image); ?>"
                            class="hero-image"
                            alt="<?php echo e($project['title']); ?> - Image <?php echo $index + 1; ?>"
                            loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                        >
                    </div>

                <?php endforeach; ?>

            </div>

            <div class="hero-overlay">

                <div class="container">

                    <div class="row justify-content-center text-center">

                        <div class="col-lg-9">

                            <div class="hero-eyebrow hero-eyebrow-center" data-aos="fade-up">
                                <span class="eyebrow-dot"></span>
                                PROJECT DETAILS
                            </div>

                            <h1 class="hero-title details-hero-title" data-aos="fade-up" data-aos-delay="100">
                                <?php echo e($project['title']); ?>
                            </h1>

                            <div class="details-hero-meta" data-aos="fade-up" data-aos-delay="200">

                                <span class="details-category-pill">
                                    <?php echo e($project['category']); ?>
                                </span>

                                <span class="details-date">
                                    <i class="fas fa-calendar"></i>
                                    <?php echo date('F j, Y', strtotime($project['created_at'])); ?>
                                </span>

                            </div>

                            <div class="details-hero-actions" data-aos="fade-up" data-aos-delay="300">

                                <?php if (!empty($images) && count($images) > 0): ?>
                                    <a
                                        href="#projectGallery"
                                        class="btn-primary-custom hero-gallery-btn smooth-scroll"
                                    >
                                        <span>View Gallery</span>
                                        <i class="fas fa-images"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($project['link']) && $project['link'] != '#'): ?>
                                    <a
                                        href="<?php echo e($project['link']); ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="btn-outline-custom"
                                    >
                                        <span>Live Demo</span>
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Carousel controls -->
            <?php if ($has_multiple_images): ?>

                <button
                    type="button"
                    class="hero-carousel-control prev"
                    onclick="changeHeroSlide(-1)"
                    aria-label="Previous image"
                >
                    <i class="fas fa-chevron-left"></i>
                </button>

                <button
                    type="button"
                    class="hero-carousel-control next"
                    onclick="changeHeroSlide(1)"
                    aria-label="Next image"
                >
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- Image counter -->
                <div class="hero-image-counter">
                    <span class="counter-pill">
                        <span id="heroCurrentSlide">1</span> / <?php echo count($images); ?>
                    </span>
                </div>

                <!-- Thumbnails -->
                <div class="hero-thumbnails">

                    <div class="container">

                        <div class="row justify-content-center">

                            <div class="col-lg-10">

                                <div class="thumbnail-scroll">

                                    <?php foreach($images as $index => $image): ?>

                                        <div
                                            class="thumbnail-item <?php echo $index === 0 ? 'active' : ''; ?>"
                                            onclick="goToHeroSlide(<?php echo $index; ?>)"
                                        >
                                            <img
                                                src="../<?php echo e($image); ?>"
                                                class="thumbnail-img"
                                                alt="Thumbnail <?php echo $index + 1; ?>"
                                                loading="lazy"
                                            >
                                        </div>

                                    <?php endforeach; ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endif; ?>

        <?php else: ?>

            <!-- Fallback Hero without images -->
            <div class="hero-fallback">

                <div class="hero-grid"></div>

                <div class="hero-glow hero-glow-one"></div>
                <div class="hero-glow hero-glow-two"></div>

                <div class="container hero-container">

                    <div class="row justify-content-center text-center">

                        <div class="col-lg-8">

                            <div class="hero-eyebrow" data-aos="fade-up">
                                <span class="eyebrow-dot"></span>
                                PROJECT DETAILS
                            </div>

                            <h1 class="hero-title details-hero-title" data-aos="fade-up" data-aos-delay="100">
                                <?php echo e($project['title']); ?>
                            </h1>

                            <div class="details-hero-meta details-hero-meta-center" data-aos="fade-up" data-aos-delay="200">

                                <span class="details-category-pill">
                                    <?php echo e($project['category']); ?>
                                </span>

                                <span class="details-date">
                                    <i class="fas fa-calendar"></i>
                                    <?php echo date('F j, Y', strtotime($project['created_at'])); ?>
                                </span>

                            </div>

                            <?php if (!empty($project['link']) && $project['link'] != '#'): ?>

                                <div class="details-hero-actions" data-aos="fade-up" data-aos-delay="300">

                                    <a
                                        href="<?php echo e($project['link']); ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="btn-primary-custom"
                                    >
                                        <span>Live Demo</span>
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>

                                </div>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>

        <?php endif; ?>

    </section>


    <!-- =====================================================
         PROJECT DETAILS
    ====================================================== -->

    <section class="details-section">

        <div class="container">

            <!-- Breadcrumb -->
            <nav class="details-breadcrumb" aria-label="breadcrumb" data-aos="fade-up">

                <a href="index.php">Home</a>

                <span class="crumb-divider">/</span>

                <a href="projects.php">Projects</a>

                <span class="crumb-divider">/</span>

                <span class="crumb-current"><?php echo e($project['title']); ?></span>

            </nav>


            <div class="details-grid">

                <!-- MAIN COLUMN -->
                <div class="details-main">

                    <!-- Overview -->
                    <div class="details-card" data-aos="fade-up">

                        <div class="details-card-header">

                            <span class="details-card-icon">
                                <i class="fas fa-file-lines"></i>
                            </span>

                            <h2>
                                Project Overview
                            </h2>

                        </div>

                        <div class="details-card-body">

                            <div class="rich-text-content">
                                <?php echo htmlspecialchars_decode($project['description']); ?>
                            </div>

                        </div>

                    </div>


                    <!-- Technologies -->
                    <div class="details-card" data-aos="fade-up" data-aos-delay="100">

                        <div class="details-card-header">

                            <span class="details-card-icon">
                                <i class="fas fa-code"></i>
                            </span>

                            <h2>
                                Technologies &amp; Tools
                            </h2>

                        </div>

                        <div class="details-card-body">

                            <div class="tech-pills-grid">

                                <?php 
                                $techs = explode(',', $project['tech_used']);
                                foreach($techs as $tech): 
                                    $trimmed_tech = trim($tech);
                                    if (!empty($trimmed_tech)):
                                ?>

                                    <span class="tech-pill">
                                        <i class="fas fa-check"></i>
                                        <?php echo e($trimmed_tech); ?>
                                    </span>

                                <?php 
                                    endif;
                                endforeach; 
                                ?>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- SIDEBAR -->
                <aside class="details-sidebar" data-aos="fade-left" data-aos-delay="200">

                    <!-- Quick Actions -->
                    <div class="sidebar-card sidebar-card-primary">

                        <div class="sidebar-card-header sidebar-header-primary">

                            <span class="sidebar-card-icon">
                                <i class="fas fa-rocket"></i>
                            </span>

                            <h5>
                                Quick Actions
                            </h5>

                        </div>

                        <div class="sidebar-card-body">

                            <div class="sidebar-actions">

                                <?php if (!empty($images) && count($images) > 0): ?>
                                    <a
                                        href="#projectGallery"
                                        class="sidebar-action-btn sidebar-action-primary smooth-scroll"
                                    >
                                        <i class="fas fa-images"></i>
                                        <span>View Gallery</span>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($project['link']) && $project['link'] != '#'): ?>
                                    <a
                                        href="<?php echo e($project['link']); ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="sidebar-action-btn sidebar-action-outline"
                                    >
                                        <i class="fas fa-external-link-alt"></i>
                                        <span>Live Demo</span>
                                    </a>
                                <?php endif; ?>

                                <a
                                    href="projects.php"
                                    class="sidebar-action-btn sidebar-action-outline"
                                >
                                    <i class="fas fa-arrow-left"></i>
                                    <span>All Projects</span>
                                </a>

                                <a
                                    href="contact.php"
                                    class="sidebar-action-btn sidebar-action-soft"
                                >
                                    <i class="fas fa-envelope"></i>
                                    <span>Contact About Project</span>
                                </a>

                            </div>

                        </div>

                    </div>


                    <!-- Project metadata -->
                    <div class="sidebar-card">

                        <div class="sidebar-card-header">

                            <span class="sidebar-card-icon">
                                <i class="fas fa-info-circle"></i>
                            </span>

                            <h5>
                                Project Details
                            </h5>

                        </div>

                        <div class="sidebar-card-body">

                            <div class="details-meta-list">

                                <div class="details-meta-row">
                                    <span class="details-meta-label">Category:</span>
                                    <span class="details-meta-value"><?php echo e($project['category']); ?></span>
                                </div>

                                <div class="details-meta-row">
                                    <span class="details-meta-label">Created:</span>
                                    <span class="details-meta-value"><?php echo date('M j, Y', strtotime($project['created_at'])); ?></span>
                                </div>

                                <?php if (!empty($project['updated_at']) && $project['updated_at'] != $project['created_at']): ?>
                                    <div class="details-meta-row">
                                        <span class="details-meta-label">Last Updated:</span>
                                        <span class="details-meta-value"><?php echo date('M j, Y', strtotime($project['updated_at'])); ?></span>
                                    </div>
                                <?php endif; ?>

                                <div class="details-meta-row">
                                    <span class="details-meta-label">Total Images:</span>
                                    <span class="details-meta-value"><?php echo count($images); ?></span>
                                </div>

                            </div>

                        </div>

                    </div>

                </aside>

            </div>

        </div>

    </section>


    <!-- =====================================================
         GALLERY
    ====================================================== -->

    <?php if (!empty($images) && count($images) > 1): ?>

    <section id="projectGallery" class="gallery-section">

        <div class="container">

            <div class="section-heading text-center" data-aos="fade-up">

                <span class="section-kicker">
                    GALLERY
                </span>

                <h2>
                    Project
                    <span>Gallery</span>
                </h2>

                <p>
                    Explore all images from this project
                </p>

            </div>

        </div>

        <div class="gallery-grid">

            <?php foreach($images as $index => $image): ?>

                <div class="gallery-item" data-aos="zoom-in" data-aos-delay="<?php echo ($index % 6) * 80; ?>">

                    <img
                        src="../<?php echo e($image); ?>"
                        class="gallery-image"
                        alt="<?php echo e($project['title']); ?> - Image <?php echo $index + 1; ?>"
                        loading="lazy"
                        onclick="openLightbox(<?php echo $index; ?>)"
                    >

                    <div class="gallery-overlay">
                        <button
                            type="button"
                            class="gallery-expand"
                            onclick="openLightbox(<?php echo $index; ?>)"
                            aria-label="Expand image"
                        >
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </section>

    <?php endif; ?>


    <!-- =====================================================
         RELATED PROJECTS
    ====================================================== -->

    <section class="related-section">

        <div class="container">

            <div class="section-heading text-center" data-aos="fade-up">

                <span class="section-kicker">
                    MORE WORK
                </span>

                <h2>
                    Related
                    <span>Projects</span>
                </h2>

                <p>
                    Explore more projects in the same category
                </p>

            </div>

            <?php
            // Fetch related projects (same category)
            $related_query = "SELECT * FROM projects 
                             WHERE category = ? AND id != ? 
                             ORDER BY created_at DESC 
                             LIMIT 3";
            $stmt = $conn->prepare($related_query);
            $stmt->bind_param("si", $project['category'], $id);
            $stmt->execute();
            $related_result = $stmt->get_result();
            
            if ($related_result->num_rows > 0): ?>

                <div class="projects-grid projects-grid-related">

                    <?php while($related_project = $related_result->fetch_assoc()): ?>

                        <?php
                        $description_preview = strip_tags($related_project['description']);
                        if (strlen($description_preview) > 120) {
                            $description_preview = substr($description_preview, 0, 120) . '...';
                        }
                        ?>

                        <article class="project-card" data-aos="fade-up">

                            <div class="project-image-area">

                                <?php if (!empty($related_project['image'])): ?>
                                    <img
                                        src="../<?php echo e($related_project['image']); ?>"
                                        alt="<?php echo e($related_project['title']); ?>"
                                        class="project-image active"
                                        loading="lazy"
                                        onerror="this.style.display='none';"
                                    >
                                <?php else: ?>
                                    <div class="project-placeholder">
                                        <i class="fas fa-laptop-code"></i>
                                        <span><?php echo e($related_project['category']); ?></span>
                                    </div>
                                <?php endif; ?>

                                <div class="project-overlay"></div>

                                <div class="project-top-info">
                                    <span class="project-category">
                                        <?php echo e($related_project['category']); ?>
                                    </span>
                                </div>

                            </div>

                            <div class="project-content">

                                <div class="project-content-top">

                                    <span class="project-index">
                                        <i class="fas fa-folder-open"></i>
                                    </span>

                                    <span class="project-date">
                                        <?php echo date('M Y', strtotime($related_project['created_at'])); ?>
                                    </span>

                                </div>

                                <h3>
                                    <?php echo e($related_project['title']); ?>
                                </h3>

                                <p>
                                    <?php echo e($description_preview); ?>
                                </p>

                                <div class="project-actions">

                                    <a
                                        href="project_details.php?id=<?php echo $related_project['id']; ?>"
                                        class="project-details-btn"
                                    >
                                        <span>View Details</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>

                                </div>

                            </div>

                        </article>

                    <?php endwhile; ?>

                </div>

            <?php else: ?>

                <div class="empty-projects" data-aos="fade-up">

                    <div class="empty-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>

                    <h3>
                        No related projects found.
                    </h3>

                    <a href="projects.php" class="btn-primary-custom empty-cta">
                        <span>Browse All Projects</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>

                </div>

            <?php endif; ?>

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
     LIGHTBOX
========================================================= -->

<div class="lightbox-modal" id="lightboxModal">
    <div class="lightbox-content">
        <button class="lightbox-close" onclick="closeLightbox()" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <button class="lightbox-control prev" onclick="changeLightboxSlide(-1)" aria-label="Previous">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="lightbox-control next" onclick="changeLightboxSlide(1)" aria-label="Next">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="lightbox-image-container">
            <img id="lightboxImage" src="" class="lightbox-image" alt="">
        </div>
        <div class="lightbox-caption">
            <span id="lightboxCaption"></span>
            <span class="lightbox-counter ms-2">
                <span id="lightboxCurrent">1</span> / <?php echo count($images); ?>
            </span>
        </div>
    </div>
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

.section-heading p {
    max-width: 570px;
    margin-top: 16px;
    color: var(--portfolio-muted);
    line-height: 1.75;
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

.details-hero {
    min-height: 90vh;
    padding: 0;
    overflow: hidden;
    display: block;
    background: #050d18;
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
    z-index: 1;
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

.hero-eyebrow-center {
    background: rgba(5,13,24,0.55);
    backdrop-filter: blur(10px);
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

.details-hero-title {
    font-size: clamp(2.2rem, 5vw, 4rem);
    line-height: 1.05;
    text-shadow: 0 4px 30px rgba(0,0,0,0.4);
}

.details-hero-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 14px;

    margin-top: 20px;
}

.details-hero-meta-center {
    justify-content: center;
}

.details-category-pill {
    display: inline-flex;
    align-items: center;

    padding: 8px 16px;

    border: 1px solid rgba(79,140,255,0.5);
    border-radius: 50px;

    background: rgba(79,140,255,0.22);

    color: #dbe6f3;

    font-size: 0.72rem;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;

    backdrop-filter: blur(8px);
}

.details-date {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    color: #b8c8db;

    font-size: 0.78rem;
    font-weight: 600;
}

.details-date i {
    color: var(--portfolio-blue-light);
}

.details-hero-actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;

    margin-top: 30px;
}


/* =========================================================
   HERO CAROUSEL / IMAGES
========================================================= */

.hero-carousel {
    position: absolute;
    inset: 0;
}

.hero-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

.hero-slide.active {
    opacity: 1;
}

.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.hero-overlay {
    position: absolute;
    inset: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 80px 20px;

    background:
        linear-gradient(
            to bottom,
            rgba(7,17,31,0.55) 0%,
            rgba(7,17,31,0.72) 50%,
            rgba(5,13,24,0.92) 100%
        );

    z-index: 2;

    text-align: center;
}


/* =========================================================
   HERO CONTROLS
========================================================= */

.hero-carousel-control {
    position: absolute;
    z-index: 5;

    top: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    width: 54px;
    height: 54px;

    padding: 0;

    transform: translateY(-50%);

    border: 1px solid var(--portfolio-border-light);
    border-radius: 50%;

    background: rgba(5,13,24,0.55);

    color: white;

    font-size: 1rem;

    cursor: pointer;

    backdrop-filter: blur(10px);

    opacity: 0.85;

    transition:
        transform 0.25s ease,
        background 0.25s ease,
        opacity 0.25s ease;
}

.hero-carousel-control.prev { left: 25px; }
.hero-carousel-control.next { right: 25px; }

.hero-carousel-control:hover {
    background: rgba(79,140,255,0.35);
    opacity: 1;
    transform: translateY(-50%) scale(1.06);
}

.hero-image-counter {
    position: absolute;
    z-index: 5;

    bottom: 130px;
    right: 30px;
}

.counter-pill {
    display: inline-flex;
    align-items: center;

    padding: 8px 15px;

    border: 1px solid var(--portfolio-border-light);
    border-radius: 50px;

    background: rgba(5,13,24,0.7);

    color: #dbe6f3;

    font-size: 0.78rem;
    font-weight: 700;

    backdrop-filter: blur(10px);
}


/* =========================================================
   HERO THUMBNAILS
========================================================= */

.hero-thumbnails {
    position: absolute;
    z-index: 5;

    bottom: 28px;
    left: 0;
    width: 100%;
}

.thumbnail-scroll {
    display: flex;
    gap: 10px;
    justify-content: center;

    padding: 10px 0;

    overflow-x: auto;

    scrollbar-width: none;
    -ms-overflow-style: none;
}

.thumbnail-scroll::-webkit-scrollbar {
    display: none;
}

.thumbnail-item {
    flex: 0 0 auto;

    width: 80px;
    height: 60px;

    overflow: hidden;

    border: 2px solid transparent;
    border-radius: 10px;

    cursor: pointer;

    opacity: 0.65;

    transition:
        opacity 0.25s ease,
        transform 0.25s ease,
        border-color 0.25s ease;
}

.thumbnail-item.active {
    border-color: var(--portfolio-blue);

    opacity: 1;

    transform: scale(1.06);

    box-shadow: 0 8px 22px rgba(79,140,255,0.35);
}

.thumbnail-item:hover {
    opacity: 1;
    transform: scale(1.03);
}

.thumbnail-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}


/* =========================================================
   FALLBACK HERO
========================================================= */

.hero-fallback {
    position: relative;

    display: flex;
    align-items: center;

    min-height: 60vh;

    padding: 90px 0;

    background:
        radial-gradient(circle at 75% 20%, rgba(79, 140, 255, 0.13), transparent 30%),
        radial-gradient(circle at 15% 75%, rgba(53, 214, 176, 0.07), transparent 30%),
        var(--portfolio-bg);
}


/* =========================================================
   BUTTONS
========================================================= */

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
    background: rgba(255,255,255,0.05);
    color: #e5edf8;
    backdrop-filter: blur(8px);
}

.btn-outline-custom:hover {
    transform: translateY(-3px);
    border-color: rgba(79,140,255,0.45);
    background: rgba(79,140,255,0.1);
    color: white;
}

.hero-gallery-btn {
    position: relative;
    overflow: hidden;
}

.hero-gallery-btn::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255,255,255,0.15);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.6s ease, height 0.6s ease;
}

.hero-gallery-btn:hover::after {
    width: 400px;
    height: 400px;
}


/* =========================================================
   DETAILS SECTION
========================================================= */

.details-section {
    padding: 60px 0 120px;
    background: #091523;
}

.details-breadcrumb {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;

    margin-bottom: 40px;

    color: #6d8197;

    font-size: 0.78rem;
    font-weight: 600;
}

.details-breadcrumb a {
    color: #aabbd0;

    transition: color 0.2s ease;
}

.details-breadcrumb a:hover {
    color: var(--portfolio-blue-light);
}

.crumb-divider {
    color: #3c5168;
}

.crumb-current {
    color: #e5edf8;
    font-weight: 700;
}

.details-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.55fr) minmax(0, 1fr);
    gap: 30px;

    align-items: start;
}

.details-main {
    display: flex;
    flex-direction: column;
    gap: 30px;
}


/* =========================================================
   DETAILS CARD
========================================================= */

.details-card {
    overflow: hidden;

    border: 1px solid var(--portfolio-border);
    border-radius: 22px;

    background: var(--portfolio-surface);
}

.details-card-header {
    display: flex;
    align-items: center;
    gap: 15px;

    padding: 26px 30px;

    border-bottom: 1px solid var(--portfolio-border);

    background: rgba(255,255,255,0.015);
}

.details-card-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    width: 44px;
    height: 44px;

    border-radius: 12px;

    background: rgba(79,140,255,0.1);

    color: var(--portfolio-blue-light);

    font-size: 0.9rem;
}

.details-card-header h2 {
    margin: 0;

    color: white;

    font-size: 1.4rem;
    font-weight: 800;
    letter-spacing: -0.02em;
}

.details-card-body {
    padding: 30px;
}


/* =========================================================
   RICH TEXT
========================================================= */

.rich-text-content {
    color: #c4d2e2;

    font-size: 0.95rem;
    line-height: 1.8;
}

.rich-text-content h1,
.rich-text-content h2,
.rich-text-content h3,
.rich-text-content h4 {
    margin-top: 2rem;
    margin-bottom: 1rem;

    color: white;

    font-weight: 800;

    letter-spacing: -0.02em;
}

.rich-text-content h1 {
    font-size: 1.75rem;
    border-bottom: 2px solid rgba(79,140,255,0.35);
    padding-bottom: 0.5rem;
}

.rich-text-content h2 {
    font-size: 1.4rem;
    border-bottom: 1px solid rgba(79,140,255,0.25);
    padding-bottom: 0.4rem;
    margin-top: 2.2rem;
}

.rich-text-content h3 {
    font-size: 1.15rem;
    color: var(--portfolio-blue-light);
}

.rich-text-content h4 {
    font-size: 1rem;
    color: #aabbd0;
}

.rich-text-content p {
    margin-bottom: 1.4rem;
    line-height: 1.8;
}

.rich-text-content ul,
.rich-text-content ol {
    padding-left: 1.6rem;
    margin-bottom: 1.5rem;
}

.rich-text-content li {
    margin-bottom: 0.6rem;
    line-height: 1.7;
}

.rich-text-content ul li::marker {
    color: var(--portfolio-blue);
}

.rich-text-content ol li::marker {
    color: var(--portfolio-blue);
    font-weight: 700;
}

.rich-text-content strong {
    color: white;
    font-weight: 700;
}

.rich-text-content em {
    color: #aabbd0;
    font-style: italic;
}

.rich-text-content a {
    color: var(--portfolio-blue-light);

    border-bottom: 1px solid rgba(118,167,255,0.4);

    transition: all 0.2s ease;
}

.rich-text-content a:hover {
    color: white;
    border-bottom-color: white;
}

.rich-text-content blockquote {
    margin: 1.8rem 0;
    padding: 1.2rem 1.4rem;

    border-left: 3px solid var(--portfolio-blue);
    border-radius: 0 10px 10px 0;

    background: rgba(79,140,255,0.06);

    color: #b8c8db;
    font-style: italic;
}

.rich-text-content code {
    padding: 0.15rem 0.4rem;

    border-radius: 5px;

    background: rgba(79,140,255,0.12);

    color: var(--portfolio-blue-light);

    font-family: 'Courier New', monospace;
    font-size: 0.85em;
}

.rich-text-content pre {
    margin: 1.6rem 0;
    padding: 1.4rem;

    overflow-x: auto;

    border: 1px solid var(--portfolio-border);
    border-radius: 12px;

    background: #050d18;

    color: #dbe6f3;

    font-family: 'Courier New', monospace;
    line-height: 1.6;
}

.rich-text-content img {
    max-width: 100%;
    height: auto;

    margin: 1.6rem 0;

    border-radius: 12px;

    box-shadow: 0 20px 40px rgba(0,0,0,0.35);
}

.rich-text-content table {
    width: 100%;

    margin: 1.6rem 0;

    border-collapse: collapse;

    overflow: hidden;

    border-radius: 12px;

    background: var(--portfolio-surface-2);
}

.rich-text-content th,
.rich-text-content td {
    padding: 0.9rem 1rem;

    border-bottom: 1px solid var(--portfolio-border);

    text-align: left;
}

.rich-text-content th {
    background: rgba(79,140,255,0.12);
    color: white;
    font-weight: 700;
}


/* =========================================================
   TECH PILLS
========================================================= */

.tech-pills-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tech-pill {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    padding: 10px 15px;

    border: 1px solid var(--portfolio-border);
    border-radius: 10px;

    background: rgba(255,255,255,0.02);

    color: #dbe6f2;

    font-size: 0.78rem;
    font-weight: 650;

    transition:
        transform 0.2s ease,
        border-color 0.2s ease,
        background 0.2s ease;
}

.tech-pill i {
    color: var(--portfolio-cyan);
    font-size: 0.7rem;
}

.tech-pill:hover {
    transform: translateY(-2px);

    border-color: rgba(79,140,255,0.35);

    background: rgba(79,140,255,0.06);
}


/* =========================================================
   SIDEBAR
========================================================= */

.details-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;

    position: sticky;
    top: 90px;
}

.sidebar-card {
    overflow: hidden;

    border: 1px solid var(--portfolio-border);
    border-radius: 20px;

    background: var(--portfolio-surface);
}

.sidebar-card-header {
    display: flex;
    align-items: center;
    gap: 12px;

    padding: 20px 22px;

    border-bottom: 1px solid var(--portfolio-border);

    background: rgba(255,255,255,0.015);
}

.sidebar-header-primary {
    background:
        linear-gradient(
            135deg,
            rgba(79,140,255,0.12),
            rgba(79,140,255,0.04)
        );

    border-bottom-color: rgba(79,140,255,0.15);
}

.sidebar-card-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    width: 38px;
    height: 38px;

    border-radius: 10px;

    background: rgba(79,140,255,0.12);

    color: var(--portfolio-blue-light);

    font-size: 0.82rem;
}

.sidebar-card-header h5 {
    margin: 0;

    color: white;

    font-size: 0.95rem;
    font-weight: 800;
    letter-spacing: -0.01em;
}

.sidebar-card-body {
    padding: 22px;
}


/* =========================================================
   SIDEBAR ACTIONS
========================================================= */

.sidebar-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.sidebar-action-btn {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 12px;

    min-height: 48px;

    padding: 0 16px;

    border: 1px solid var(--portfolio-border-light);
    border-radius: 12px;

    background: rgba(255,255,255,0.025);

    color: #dbe6f2;

    font-size: 0.82rem;
    font-weight: 700;

    transition:
        transform 0.25s ease,
        background 0.25s ease,
        border-color 0.25s ease,
        color 0.25s ease,
        box-shadow 0.25s ease;
}

.sidebar-action-btn i {
    font-size: 0.82rem;
}

.sidebar-action-primary {
    border-color: var(--portfolio-blue);

    background:
        linear-gradient(
            135deg,
            var(--portfolio-blue),
            #6a7dff
        );

    color: white;

    box-shadow:
        0 12px 26px rgba(79,140,255,0.28),
        inset 0 1px 0 rgba(255,255,255,0.15);
}

.sidebar-action-primary:hover {
    transform: translateY(-3px);

    background:
        linear-gradient(
            135deg,
            #5c96ff,
            #7a8bff
        );

    color: white;

    box-shadow:
        0 18px 40px rgba(79,140,255,0.38);
}

.sidebar-action-outline:hover {
    transform: translateY(-3px);

    border-color: rgba(79,140,255,0.45);

    background: rgba(79,140,255,0.08);

    color: white;
}

.sidebar-action-soft {
    background: rgba(255,255,255,0.015);
    color: #b3c3d6;
}

.sidebar-action-soft:hover {
    transform: translateY(-3px);
    background: rgba(255,255,255,0.04);
    color: white;
    border-color: rgba(255,255,255,0.2);
}


/* =========================================================
   META LIST
========================================================= */

.details-meta-list {
    display: flex;
    flex-direction: column;
}

.details-meta-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;

    padding: 12px 0;

    border-bottom: 1px dashed var(--portfolio-border);
}

.details-meta-row:last-child {
    border-bottom: 0;
}

.details-meta-label {
    color: #75889e;
    font-size: 0.72rem;
    font-weight: 650;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.details-meta-value {
    color: #dbe6f2;
    font-size: 0.82rem;
    font-weight: 700;
    text-align: right;
}


/* =========================================================
   GALLERY
========================================================= */

.gallery-section {
    padding: 100px 0 0;
    background: var(--portfolio-bg);

    scroll-margin-top: 90px;
}

#projectGallery:target {
    animation: highlightSection 1.6s ease;
}

@keyframes highlightSection {
    0% { background-color: transparent; }
    50% { background-color: rgba(79,140,255,0.06); }
    100% { background-color: transparent; }
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 0;
}

.gallery-item {
    position: relative;
    overflow: hidden;
    aspect-ratio: 4 / 3;

    background: #050d18;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;

    cursor: zoom-in;

    transition: transform 0.6s ease;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.06);
}

.gallery-overlay {
    position: absolute;
    inset: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background: rgba(5,13,24,0.6);

    opacity: 0;

    transition: opacity 0.3s ease;

    pointer-events: none;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
    pointer-events: auto;
}

.gallery-expand {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    width: 54px;
    height: 54px;

    border: 1px solid rgba(255,255,255,0.35);
    border-radius: 50%;

    background: rgba(79,140,255,0.85);

    color: white;

    font-size: 0.95rem;

    cursor: pointer;

    transition:
        transform 0.25s ease,
        background 0.25s ease;
}

.gallery-expand:hover {
    transform: scale(1.08);
    background: var(--portfolio-blue);
}


/* =========================================================
   LIGHTBOX
========================================================= */

.lightbox-modal {
    position: fixed;
    inset: 0;

    display: none;
    align-items: center;
    justify-content: center;

    padding: 30px;

    background: rgba(3,8,15,0.94);

    z-index: 9999;

    backdrop-filter: blur(6px);
}

.lightbox-modal.active {
    display: flex;
}

.lightbox-content {
    position: relative;

    max-width: 92%;
    max-height: 92%;
}

.lightbox-image {
    max-width: 100%;
    max-height: 82vh;

    object-fit: contain;

    border-radius: 8px;
}

.lightbox-close {
    position: absolute;
    top: -55px;
    right: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    width: 42px;
    height: 42px;

    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50%;

    background: rgba(5,13,24,0.7);

    color: white;

    font-size: 1rem;

    cursor: pointer;

    transition:
        transform 0.2s ease,
        background 0.2s ease;
}

.lightbox-close:hover {
    transform: scale(1.08);
    background: rgba(79,140,255,0.6);
}

.lightbox-control {
    position: absolute;
    top: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    width: 50px;
    height: 50px;

    transform: translateY(-50%);

    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50%;

    background: rgba(5,13,24,0.7);

    color: white;

    font-size: 0.95rem;

    cursor: pointer;

    transition:
        transform 0.2s ease,
        background 0.2s ease;
}

.lightbox-control.prev { left: -70px; }
.lightbox-control.next { right: -70px; }

.lightbox-control:hover {
    background: rgba(79,140,255,0.6);
    transform: translateY(-50%) scale(1.06);
}

.lightbox-caption {
    position: absolute;
    bottom: -50px;
    left: 0;
    width: 100%;

    text-align: center;

    color: #dbe6f3;

    font-size: 0.88rem;
    font-weight: 600;
}

.lightbox-counter {
    color: #8ea2b8;
    font-weight: 700;
}


/* =========================================================
   RELATED PROJECTS
========================================================= */

.related-section {
    padding: 100px 0 120px;
    background: #091523;
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.projects-grid-related {
    grid-template-columns: repeat(3, 1fr);
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

    height: 220px;

    overflow: hidden;

    background: #07111f;
}

.project-image {
    width: 100%;
    height: 100%;

    object-fit: cover;

    transition: transform 0.6s ease;
}

.project-card:hover .project-image {
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

    background:
        linear-gradient(
            to top,
            rgba(5,13,24,0.85),
            transparent 55%
        );
}

.project-top-info {
    position: absolute;
    top: 16px;
    right: 16px;
    left: 16px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    z-index: 2;
}

.project-category {
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
    font-size: 0.62rem;
    font-weight: 800;
}

.project-date {
    color: #5f738a;
    font-size: 0.6rem;
}

.project-content h3 {
    margin: 0 0 9px;

    color: white;

    font-size: 1.08rem;
    font-weight: 750;
    line-height: 1.3;
}

.project-content p {
    min-height: 60px;

    margin: 0;

    color: var(--portfolio-muted);

    font-size: 0.75rem;
    line-height: 1.7;
}

.project-actions {
    display: flex;
    align-items: stretch;

    margin-top: auto;
    padding-top: 18px;

    border-top: 1px solid var(--portfolio-border);
}

.project-details-btn {
    flex: 1 1 auto;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;

    min-height: 44px;

    padding: 0 18px;

    border: 1px solid var(--portfolio-blue);
    border-radius: 11px;

    background:
        linear-gradient(
            135deg,
            var(--portfolio-blue),
            #6a7dff
        );

    color: white;

    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 0.02em;

    box-shadow:
        0 10px 24px rgba(79,140,255,0.25),
        inset 0 1px 0 rgba(255,255,255,0.15);

    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        background 0.25s ease;
}

.project-details-btn i {
    font-size: 0.72rem;
    transition: transform 0.25s ease;
}

.project-details-btn:hover {
    transform: translateY(-3px);

    background:
        linear-gradient(
            135deg,
            #5c96ff,
            #7a8bff
        );

    color: white;

    box-shadow:
        0 16px 36px rgba(79,140,255,0.38);
}

.project-details-btn:hover i {
    transform: translateX(4px);
}


/* =========================================================
   EMPTY
========================================================= */

.empty-projects {
    padding: 70px 20px;

    text-align: center;

    border: 1px dashed var(--portfolio-border);
    border-radius: 20px;

    background: rgba(255,255,255,0.01);
}

.empty-icon {
    color: #3c5168;
    font-size: 2.2rem;
    margin-bottom: 8px;
}

.empty-projects h3 {
    margin: 10px 0 22px;

    color: white;
    font-size: 1.05rem;
    font-weight: 750;
}

.empty-cta {
    display: inline-flex;
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


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1199px) {
    .projects-grid,
    .projects-grid-related {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 991px) {
    .details-hero {
        min-height: 75vh;
    }

    .details-hero-title {
        font-size: clamp(1.9rem, 5vw, 3rem);
    }

    .details-grid {
        grid-template-columns: 1fr;
    }

    .details-sidebar {
        position: static;
        top: auto;
    }

    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .cta-decoration { opacity: 0.5; }
}

@media (max-width: 767px) {
    .details-hero {
        min-height: 65vh;
    }

    .hero-carousel-control {
        width: 44px;
        height: 44px;
        font-size: 0.85rem;
    }

    .hero-carousel-control.prev { left: 12px; }
    .hero-carousel-control.next { right: 12px; }

    .hero-image-counter {
        bottom: 105px;
        right: 12px;
    }

    .thumbnail-item {
        width: 62px;
        height: 46px;
    }

    .details-hero-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .details-hero-actions .btn-primary-custom,
    .details-hero-actions .btn-outline-custom {
        width: 100%;
    }

    .details-card-header,
    .details-card-body {
        padding: 20px;
    }

    .details-card-header h2 {
        font-size: 1.15rem;
    }

    .rich-text-content {
        font-size: 0.9rem;
    }

    .gallery-grid {
        grid-template-columns: 1fr;
    }

    .projects-grid,
    .projects-grid-related {
        grid-template-columns: 1fr;
    }

    .lightbox-control.prev { left: 8px; }
    .lightbox-control.next { right: 8px; }

    .lightbox-close { right: 0; top: -50px; }

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
    .details-hero {
        min-height: 60vh;
    }

    .details-hero-title {
        font-size: 1.65rem;
    }

    .details-hero-meta {
        gap: 10px;
    }

    .details-category-pill {
        font-size: 0.62rem;
        padding: 6px 12px;
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

});


/* =========================================================
   HERO CAROUSEL
========================================================= */

let heroCurrentSlide = 0;
const heroTotalSlides = <?php echo count($images); ?>;
let heroAutoSlideInterval;

function changeHeroSlide(direction) {
    if (heroTotalSlides <= 1) return;

    const slides = document.querySelectorAll('.hero-slide');
    const thumbnails = document.querySelectorAll('.thumbnail-item');

    if (slides[heroCurrentSlide]) slides[heroCurrentSlide].classList.remove('active');
    if (thumbnails[heroCurrentSlide]) thumbnails[heroCurrentSlide].classList.remove('active');

    heroCurrentSlide = (heroCurrentSlide + direction + heroTotalSlides) % heroTotalSlides;

    if (slides[heroCurrentSlide]) slides[heroCurrentSlide].classList.add('active');
    if (thumbnails[heroCurrentSlide]) thumbnails[heroCurrentSlide].classList.add('active');

    const counter = document.getElementById('heroCurrentSlide');
    if (counter) counter.textContent = heroCurrentSlide + 1;
}

function goToHeroSlide(index) {
    if (heroTotalSlides <= 1) return;

    const slides = document.querySelectorAll('.hero-slide');
    const thumbnails = document.querySelectorAll('.thumbnail-item');

    if (slides[heroCurrentSlide]) slides[heroCurrentSlide].classList.remove('active');
    if (thumbnails[heroCurrentSlide]) thumbnails[heroCurrentSlide].classList.remove('active');

    heroCurrentSlide = index;

    if (slides[heroCurrentSlide]) slides[heroCurrentSlide].classList.add('active');
    if (thumbnails[heroCurrentSlide]) thumbnails[heroCurrentSlide].classList.add('active');

    const counter = document.getElementById('heroCurrentSlide');
    if (counter) counter.textContent = heroCurrentSlide + 1;
}

function startHeroAutoSlide() {
    if (heroTotalSlides > 1) {
        heroAutoSlideInterval = setInterval(function () { changeHeroSlide(1); }, 5000);
    }
}

function stopHeroAutoSlide() {
    clearInterval(heroAutoSlideInterval);
}


/* =========================================================
   LIGHTBOX
========================================================= */

let lightboxCurrentSlide = 0;

function openLightbox(index) {
    lightboxCurrentSlide = index;
    updateLightbox();
    document.getElementById('lightboxModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightboxModal').classList.remove('active');
    document.body.style.overflow = 'auto';
}

function changeLightboxSlide(direction) {
    lightboxCurrentSlide = (lightboxCurrentSlide + direction + heroTotalSlides) % heroTotalSlides;
    updateLightbox();
}

function updateLightbox() {
    const image = document.getElementById('lightboxImage');
    const caption = document.getElementById('lightboxCaption');
    const current = document.getElementById('lightboxCurrent');

    const images = <?php echo json_encode($images); ?>;

    if (images && images[lightboxCurrentSlide]) {
        image.src = '../' + images[lightboxCurrentSlide];

        caption.innerHTML = `
            <?php echo htmlspecialchars($project['title']); ?> - Image ${lightboxCurrentSlide + 1}
            <a href="#projectGallery" class="text-white ms-3 smooth-scroll" style="font-size: 0.9rem; opacity: 0.8;" onclick="closeLightbox()">
                <i class="fas fa-arrow-left me-1"></i>Back to Gallery
            </a>
        `;

        current.textContent = lightboxCurrentSlide + 1;
    }
}


/* =========================================================
   SMOOTH SCROLL
========================================================= */

function smoothScrollTo(target) {
    const element = document.querySelector(target);
    if (element) {
        const offset = 80;
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
}


/* =========================================================
   EVENTS
========================================================= */

document.addEventListener('DOMContentLoaded', function () {

    if (heroTotalSlides > 1) {
        startHeroAutoSlide();

        const heroSection = document.querySelector('.details-hero');
        if (heroSection) {
            heroSection.addEventListener('mouseenter', stopHeroAutoSlide);
            heroSection.addEventListener('mouseleave', startHeroAutoSlide);
        }
    }

    document.querySelectorAll('a[href="#projectGallery"]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            smoothScrollTo('#projectGallery');
        });
    });

    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const target = this.getAttribute('href');
            if (target !== '#' && target.indexOf('#projectGallery') === -1) {
                const el = document.querySelector(target);
                if (el) {
                    e.preventDefault();
                    smoothScrollTo(target);
                }
            }
        });
    });

    document.addEventListener('keydown', function (e) {
        if (heroTotalSlides > 1) {
            if (e.key === 'ArrowLeft') changeHeroSlide(-1);
            else if (e.key === 'ArrowRight') changeHeroSlide(1);
        }

        const lightbox = document.getElementById('lightboxModal');
        if (lightbox && lightbox.classList.contains('active')) {
            if (e.key === 'ArrowLeft') changeLightboxSlide(-1);
            else if (e.key === 'ArrowRight') changeLightboxSlide(1);
            else if (e.key === 'Escape') closeLightbox();
        }
    });

    const lb = document.getElementById('lightboxModal');
    if (lb) {
        lb.addEventListener('click', function (e) {
            if (e.target === this) closeLightbox();
        });
    }
});


/* =========================================================
   HASH SCROLL ON LOAD
========================================================= */

if (window.location.hash === '#projectGallery') {
    setTimeout(function () {
        smoothScrollTo('#projectGallery');
    }, 100);
}

</script>


<?php include('../includes/footer.php'); ?>