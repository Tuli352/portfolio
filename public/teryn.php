<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teryn Waithera | Quantity Surveying Portfolio (ERROR DISPLAY MODE)</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fefcf8;
            color: #2c2b28;
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ===== TOP ERROR PANEL - PROMINENT AT THE VERY TOP ===== */
        .top-error-panel {
            background: linear-gradient(135deg, #fff0f0 0%, #ffe0e0 100%);
            border-bottom: 4px solid #d32f2f;
            padding: 20px 24px;
            width: 100%;
            position: relative;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(211, 47, 47, 0.15);
        }

        .error-header {
            max-width: 1400px;
            margin: 0 auto;
        }

        .error-header h3 {
            color: #b91c1c;
            font-size: 1.5rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .error-header h3 i {
            font-size: 1.8rem;
            background: #d32f2f;
            color: white;
            padding: 8px;
            border-radius: 50%;
        }

        .error-badge {
            display: inline-block;
            background: #d32f2f;
            color: white;
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 12px;
        }

        .errors-list-container {
            background: white;
            border-radius: 16px;
            padding: 8px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .error-items {
            list-style: none;
            padding: 0;
        }

        .error-items li {
            padding: 14px 20px;
            border-left: 4px solid #d32f2f;
            background: #fffbfb;
            margin: 8px 12px;
            border-radius: 12px;
            font-size: 0.95rem;
            color: #5a2a2a;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            transition: all 0.2s;
        }

        .error-items li i.error-icon {
            color: #d32f2f;
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .error-items li strong {
            color: #b91c1c;
            font-weight: 700;
        }

        .error-count {
            background: #d32f2f;
            color: white;
            border-radius: 30px;
            padding: 4px 12px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-block;
            margin-left: 10px;
        }

        .no-errors {
            padding: 20px;
            text-align: center;
            color: #2e7d32;
            background: #e8f5e9;
            border-radius: 12px;
            margin: 12px;
        }

        .warning-note {
            margin-top: 12px;
            font-size: 0.8rem;
            color: #b85c1a;
            background: #fff4e6;
            padding: 8px 16px;
            border-radius: 10px;
            display: inline-block;
        }

        /* ===== REST OF PAGE STYLES (same as original but clean) ===== */
        header {
            background: #1e2a2f;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }
        .logo {
            font-size: 1.6rem;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            color: #e5c28e;
        }
        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }
        .nav-links a {
            text-decoration: none;
            color: #f0ede8;
            font-weight: 500;
            transition: color 0.2s;
        }
        .nav-links a:hover { color: #e5c28e; }
        .hamburger {
            display: none;
            font-size: 1.6rem;
            color: #f0ede8;
            cursor: pointer;
        }
        .hero {
            background: linear-gradient(rgba(30,42,47,0.85), rgba(30,42,47,0.85)), url('https://placehold.co/1600x900/2c3e3f/e5c28e?text=Construction+Background') center/cover;
            min-height: 75vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
        .hero-content h1 {
            font-size: 3.8rem;
            font-family: 'Playfair Display', serif;
            margin-bottom: 1rem;
        }
        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .btn {
            display: inline-block;
            background: #e5c28e;
            color: #1e2a2f;
            padding: 12px 28px;
            border-radius: 40px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }
        .btn:hover { background: #d4b069; transform: translateY(-2px); }
        section { padding: 80px 0; }
        h2 {
            font-size: 2.2rem;
            margin-bottom: 40px;
            text-align: center;
            font-family: 'Playfair Display', serif;
            color: #2c3e2f;
        }
        h2:after {
            content: '';
            display: block;
            width: 70px;
            height: 3px;
            background: #e5c28e;
            margin: 12px auto 0;
        }
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
        }
        .about-text p { margin-bottom: 20px; line-height: 1.6; }
        .about-details ul {
            list-style: none;
            background: #f4f1ea;
            padding: 28px;
            border-radius: 24px;
        }
        .about-details li {
            margin: 18px 0;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .about-details i { width: 28px; color: #e5c28e; }
        .skills-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 28px;
            justify-content: center;
        }
        .skill-card {
            background: white;
            padding: 28px 20px;
            border-radius: 32px;
            text-align: center;
            flex: 1 1 180px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }
        .skill-card i { font-size: 2.2rem; color: #e5c28e; margin-bottom: 16px; }
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        .project-card {
            background: white;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .project-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
        .cv-section {
            background: #f1efe8;
            text-align: center;
            border-radius: 40px;
            margin: 20px auto;
            width: 90%;
            max-width: 1000px;
        }
        .contact-info {
            background: #fff9f0;
            max-width: 700px;
            margin: 0 auto;
            padding: 32px;
            border-radius: 48px;
            text-align: center;
        }
        .contact-info p { margin: 20px 0; }
        .contact-info a {
            color: #1e2a2f;
            text-decoration: none;
            border-bottom: 1px solid #e5c28e;
        }
        footer {
            background: #1e2a2f;
            color: #cccbc6;
            text-align: center;
            padding: 28px 0;
        }
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background: #1e2a2f;
                padding: 1.5rem;
            }
            .nav-links.active { display: flex; }
            .hamburger { display: block; }
            .about-grid { grid-template-columns: 1fr; }
            .hero-content h1 { font-size: 2.4rem; }
        }
    </style>
</head>
<body>

<!-- ========== TOP ERROR PANEL - SHOWS ALL ERRORS PROMINENTLY ========== -->
<div class="top-error-panel" id="topErrorPanel">
    <div class="error-header">
        <h3>
            <i class="fas fa-exclamation-triangle"></i> 
            ERROR DETECTION DASHBOARD 
            <span class="error-badge">LIVE SCAN</span>
            <span id="errorCountBadge" class="error-count">0 errors</span>
        </h3>
        <div class="errors-list-container">
            <ul class="error-items" id="dynamicErrorList">
                <li><i class="fas fa-spinner fa-pulse error-icon"></i> Scanning for all errors across the page...</li>
            </ul>
            <div class="warning-note">
                <i class="fas fa-info-circle"></i> All critical issues, broken links, missing files, typos, and functional errors are listed above.
            </div>
        </div>
    </div>
</div>

<!-- ===== NAVIGATION ===== -->
<header>
    <nav class="navbar">
        <div class="logo">Teryn Waithera</div>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <div class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
</header>

<!-- ===== HERO SECTION ===== -->
<section id="home" class="hero">
    <div class="hero-content">
        <h1>Teryn Waithera</h1>
        <p>Quantity Surveying Student | Cost Estimator | BIM Enthusiast</p>
        <a href="#projects" class="btn">View My Work</a>
    </div>
</section>

<!-- ===== ABOUT SECTION ===== -->
<section id="about" class="about">
    <div class="container">
        <h2>About Me</h2>
        <div class="about-grid">
            <div class="about-text">
                <p>I'm a final-year Quantity Surveying student at Jomo Kenyatta University of Agriculture and Technology, passionate about cost management, BIM, and sustainable construction. With hands-on experience in preparing Bills of Quantities, interim valuations, and variation orders, I’m driven to deliver accurate, efficient solutions in the built environment.</p>
                <p>Beyond the technical side, I volunteer at Faraja Cancer Support Trust, where I use my crocheting skills to bring comfort to children undergoing treatment. I'm also an active member of the Young Quantity Surveyors Forum Kenya, helping organise professional development events.</p>
            </div>
            <div class="about-details">
                <ul>
                    <li><i class="fas fa-graduation-cap"></i> <strong>Education:</strong> BSc Quantity Surveying (JKUAT)</li>
                    <li><i class="fas fa-briefcase"></i> <strong>Experience:</strong> Laxmanbhai Construction, ICOMOSO, Top Choice Surveillance</li>
                    <li><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> Nairobi, Kenya</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ===== SKILLS SECTION ===== -->
<section class="skills">
    <div class="container">
        <h2>Technical Skills</h2>
        <div class="skills-grid">
            <div class="skill-card"><i class="fas fa-calculator"></i><h3>Cost Estimation</h3><p>BOQ preparation, rate analysis</p></div>
            <div class="skill-card"><i class="fas fa-ruler-combined"></i><h3>Takeoffs</h3><p>Planswift, manual quantity takeoffs</p></div>
            <div class="skill-card"><i class="fas fa-drafting-compass"></i><h3>BIM & Design</h3><p>ArchiCAD 27, AutoCAD basics</p></div>
            <div class="skill-card"><i class="fas fa-chart-line"></i><h3>Project Controls</h3><p>Interim payment certificates, variation orders</p></div>
            <div class="skill-card"><i class="fas fa-file-alt"></i><h3>Documentation</h3><p>MS Office, record management</p></div>
        </div>
    </div>
</section>

<!-- ===== PROJECTS SECTION ===== -->
<section id="projects" class="projects">
    <div class="container">
        <h2>Featured Projects</h2>
        <div class="projects-grid">
            <div class="project-card">
                <img src="https://placehold.co/600x400/e0e0e0/800020?text=21-Storey+Office+Block" alt="Krystal Investments Project">
                <h3>Krystal Investments – 21-Storey Office Block</h3>
                <p>Assisted in BOQ preparation, interim payment certificates, and variation orders for a high‑rise in Westlands, Nairobi.</p>
            </div>
            <div class="project-card">
                <img src="https://placehold.co/600x400/e0e0e0/800020?text=Residential+Takeoff" alt="Residential Takeoff">
                <h3>Residential Takeoff Practice</h3>
                <p>Measured quantities using Planswift for a residential development – foundations, superstructure, finishes.</p>
            </div>
            <div class="project-card">
                <!-- INTENTIONAL BROKEN IMAGE for error demonstration -->
                <img src="broken-image-missing-file.jpg" alt="Cost Analysis Report Image - BROKEN">
                <h3>Cost Analysis & Reporting</h3>
                <p>Prepared cost reports and tracked daily work output during my internship at Laxmanbhai Construction.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== CV DOWNLOAD SECTION - MISSING FILE ERROR ===== -->
<section class="cv-section">
    <div class="container">
        <h2>My CV</h2>
        <p>For a detailed overview of my experience and qualifications, download my CV below.</p>
        <!-- ERROR 1: cv.pdf does NOT exist - 404 broken download -->
        <a href="cv.pdf" class="btn" download>Download CV (PDF) <i class="fas fa-download"></i></a>
        <p style="font-size:0.8rem; margin-top:10px;"><i class="fas fa-exclamation-circle"></i> (File missing: cv.pdf not found)</p>
    </div>
</section>

<!-- ===== CONTACT SECTION - LINKEDIN BROKEN + PHONE FORMAT ISSUE ===== -->
<section id="contact" class="contact">
    <div class="container">
        <h2>Let’s Connect</h2>
        <div class="contact-info">
            <p><i class="fas fa-envelope"></i> <a href="mailto:mbuthiateryn@gmail.com">mbuthiateryn@gmail.com</a></p>
            <p><i class="fas fa-phone-alt"></i> 0711646290</p>
            <!-- ERROR 2: LinkedIn href="#" is dead link -->
            <p><i class="fab fa-linkedin"></i> <a href="#">https://www.linkedin.com/in/teryn-mbuthia-27ba47244/</a></p>
        </div>
    </div>
</section>

<!-- ===== FOOTER - TYPO ERROR ===== -->
<footer>
    <div class="container">
        <!-- ERROR 3: Name misspelled: "Waihera" instead of "Waithera" -->
        <p>&copy; 2025 Teryn Waihera. Built with <i class="fas fa-heart"></i> for the built environment.</p>
    </div>
</footer>

<script>
    // Comprehensive error detection - shows ALL errors at the top
    function displayAllErrors() {
        const errorListContainer = document.getElementById('dynamicErrorList');
        const errorCountSpan = document.getElementById('errorCountBadge');
        if (!errorListContainer) return;
        
        let errors = [];
        
        // 1. CV download link points to missing file (cv.pdf)
        const cvLink = document.querySelector('.cv-section a[download]');
        if (cvLink && cvLink.getAttribute('href') === 'cv.pdf') {
            errors.push({
                type: '🔗 BROKEN DOWNLOAD',
                message: 'CV file "cv.pdf" does not exist on server. Download link returns 404 error. Visitors cannot access your resume.'
            });
        }
        
        // 2. LinkedIn link: href="#" but visible text shows actual URL - completely non-functional
        const linkedinAnchor = Array.from(document.querySelectorAll('.contact-info a')).find(a => a.href === '#' || a.getAttribute('href') === '#');
        if (linkedinAnchor && linkedinAnchor.closest('p')?.innerHTML.includes('linkedin')) {
            errors.push({
                type: '🔗 DEAD LINK',
                message: 'LinkedIn profile link points to "#" (placeholder). Actual LinkedIn URL is displayed as text but not clickable. Expected: https://www.linkedin.com/in/teryn-mbuthia-27ba47244/'
            });
        }
        
        // 3. Footer typo: "Waihera" instead of "Waithera"
        const footerText = document.querySelector('footer p')?.innerText || '';
        if (footerText.includes('Teryn Waihera')) {
            errors.push({
                type: '✍️ SPELLING ERROR',
                message: 'Footer contains name misspelling: "Teryn Waihera" — correct spelling is "Teryn Waithera". Inconsistent personal branding.'
            });
        }
        
        // 4. Phone number missing international code (+254) for Kenya
        const phonePara = Array.from(document.querySelectorAll('.contact-info p')).find(p => p.innerText.includes('0711646290'));
        if (phonePara) {
            errors.push({
                type: '📞 FORMATTING ISSUE',
                message: 'Phone number "0711646290" missing country code (+254). Should be +254711646290 for international accessibility.'
            });
        }
        
        // 5. Broken images detection (including the intentional broken one)
        const allImages = document.querySelectorAll('img');
        let brokenImageSources = [];
        allImages.forEach(img => {
            // check if image is broken by naturalWidth = 0 or if src is placeholder that might fail but we mark obvious broken ones
            if (img.complete && img.naturalWidth === 0) {
                brokenImageSources.push(img.alt || img.src.split('/').pop());
            }
            // also specifically detect broken-image-missing-file.jpg
            if (img.src.includes('broken-image-missing-file.jpg')) {
                if (!brokenImageSources.includes(img.alt || 'Cost Analysis Image')) {
                    brokenImageSources.push(img.alt || 'Cost Analysis Report Image');
                }
            }
        });
        
        // Also after load for dynamic detection
        if (brokenImageSources.length > 0) {
            errors.push({
                type: '🖼️ BROKEN IMAGES',
                message: `${brokenImageSources.length} image(s) failed to load: ${brokenImageSources.join(', ')}. Ensure all image files exist.`
            });
        }
        
        // 6. Check if any section IDs missing for navigation? All present but just to be safe.
        const sectionsNeeded = ['home', 'about', 'projects', 'contact'];
        sectionsNeeded.forEach(sectionId => {
            if (!document.getElementById(sectionId)) {
                errors.push({
                    type: '🧩 MISSING SECTION',
                    message: `Section with id "${sectionId}" does not exist but navigation expects it.`
                });
            }
        });
        
        // 7. Check mailto link is correct but also if any missing subject? not critical, but note
        const mailLink = document.querySelector('a[href^="mailto"]');
        if (mailLink && mailLink.getAttribute('href') === 'mailto:mbuthiateryn@gmail.com') {
            // it's fine, but maybe improvement: but not error, we can add optional suggestion
            // But we add as info recommendation for professionalism
            errors.push({
                type: '📧 EMAIL SUGGESTION',
                message: 'Email mailto link works, but consider adding subject parameter for better user experience (e.g., ?subject=Portfolio Inquiry).'
            });
        }
        
        // 8. Check if any empty alt attributes (all good here) but we verify images have alt text
        const imagesNoAlt = Array.from(document.querySelectorAll('img')).filter(img => !img.alt || img.alt.trim() === '');
        if (imagesNoAlt.length > 0) {
            errors.push({
                type: '♿ ACCESSIBILITY',
                message: `${imagesNoAlt.length} image(s) missing alt text. Screen readers cannot describe them.`
            });
        }
        
        // 9. CV section missing actual file and also download attribute but file missing - already covered but re-emphasize
        // 10. Check for any placeholder external links that might be incomplete
        const anyHashLink = Array.from(document.querySelectorAll('a')).filter(a => a.getAttribute('href') === '#' && a.innerText.includes('linkedin'));
        if (anyHashLink.length) {
            // already covered but ensure it's present
            if (!errors.some(e => e.message.includes('LinkedIn'))) {
                errors.push({
                    type: '🔗 BROKEN SOCIAL LINK',
                    message: 'LinkedIn anchor tag uses href="#", making profile inaccessible.'
                });
            }
        }
        
        // 11. Check if there is any console error simulation: also note that placeholder images from placehold.co are fine, but broken image is explicit.
        // 12. Additional check: the project card with broken image is already counted.
        
        // 13. Check if any internal anchor links lead to missing ID (extra)
        const internalAnchors = document.querySelectorAll('a[href^="#"]:not([href="#"])');
        internalAnchors.forEach(anchor => {
            const targetId = anchor.getAttribute('href').substring(1);
            if (targetId && !document.getElementById(targetId)) {
                errors.push({
                    type: '⚠️ DEAD ANCHOR',
                    message: `Anchor link points to "#${targetId}" but no element with that ID exists.`
                });
            }
        });
        
        // 14. Footer year dynamic? not error but year 2025 is correct. No error.
        
        // 15. Check missing favicon? not major but we can add as recommendation.
        if (!document.querySelector('link[rel="icon"]')) {
            errors.push({
                type: '🖼️ MISSING FAVICON',
                message: 'No favicon defined. Browser tab shows default icon, reduce professionalism.'
            });
        }
        
        // Clear and render all errors
        errorListContainer.innerHTML = '';
        
        if (errors.length === 0) {
            errorListContainer.innerHTML = '<li style="background:#e8f5e9; border-left-color:#2e7d32;"><i class="fas fa-check-circle" style="color:#2e7d32;"></i> ✅ No critical errors found! All systems operational.</li>';
            errorCountSpan.textContent = `0 errors`;
            errorCountSpan.style.background = "#2e7d32";
        } else {
            errors.forEach((err, idx) => {
                const li = document.createElement('li');
                li.innerHTML = `<i class="fas fa-exclamation-circle error-icon"></i> <strong>[${err.type}]</strong> ${err.message}`;
                errorListContainer.appendChild(li);
            });
            errorCountSpan.textContent = `${errors.length} error${errors.length !== 1 ? 's' : ''}`;
            errorCountSpan.style.background = "#d32f2f";
        }
        
        // Additional dynamic broken image check after full load
        setTimeout(() => {
            const stillBroken = [];
            document.querySelectorAll('img').forEach(img => {
                if (img.naturalWidth === 0 && img.naturalHeight === 0) {
                    const altText = img.alt || 'unnamed image';
                    if (!stillBroken.includes(altText)) stillBroken.push(altText);
                }
            });
            if (stillBroken.length > 0 && !errors.some(e => e.message.includes(stillBroken[0]))) {
                const newLi = document.createElement('li');
                newLi.innerHTML = `<i class="fas fa-exclamation-circle error-icon"></i> <strong>[🖼️ BROKEN IMAGES]</strong> ${stillBroken.length} broken image(s): ${stillBroken.join(', ')}. Verify image paths.`;
                errorListContainer.appendChild(newLi);
                const currentCount = parseInt(errorCountSpan.textContent) || 0;
                errorCountSpan.textContent = `${currentCount + stillBroken.length} errors`;
            }
        }, 300);
    }
    
    // Mobile menu toggle
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.querySelector('.nav-links');
    if (hamburger) {
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }
    
    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
    
    // Run error detection on DOM ready and also after load for images
    document.addEventListener('DOMContentLoaded', () => {
        displayAllErrors();
    });
    
    window.addEventListener('load', () => {
        displayAllErrors(); // refresh after images fully load
    });
</script>
</body>
</html>