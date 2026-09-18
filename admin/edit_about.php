<?php
include('../config/db_connect.php');
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $summary = $conn->real_escape_string($_POST['summary']);
    
    // Handle profile image upload
    if (!empty($_FILES['profile_image']['name'])) {
        $profile_image = 'uploads/' . basename($_FILES['profile_image']['name']);
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], "../" . $profile_image)) {
            $conn->query("UPDATE about SET summary='$summary', profile_image='$profile_image' WHERE id=1");
            $message = "About section updated successfully!";
            $message_type = "success";
        } else {
            $message = "Error uploading profile image.";
            $message_type = "error";
        }
    } 
    // Handle CV upload
    elseif (!empty($_FILES['cv_file']['name'])) {
        $cv_file = 'uploads/' . basename($_FILES['cv_file']['name']);
        if (move_uploaded_file($_FILES['cv_file']['tmp_name'], "../" . $cv_file)) {
            $conn->query("UPDATE about SET summary='$summary', cv_file='$cv_file' WHERE id=1");
            $message = "About section and CV updated successfully!";
            $message_type = "success";
        } else {
            $message = "Error uploading CV file.";
            $message_type = "error";
        }
    } 
    // Update only summary
    else {
        $conn->query("UPDATE about SET summary='$summary' WHERE id=1");
        $message = "About section updated successfully!";
        $message_type = "success";
    }
}

// Fetch current about data
$about = $conn->query("SELECT * FROM about WHERE id=1")->fetch_assoc();
include('../includes/admin_header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit About Section - Admin Panel</title>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        .admin-container {
            background: #f8f9fa;
            min-height: 100vh;
            padding: 20px 0;
        }
        
        .admin-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border: none;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        
        .admin-card:hover {
            transform: translateY(-5px);
        }
        
        .admin-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 20px;
        }
        
        .form-section {
            padding: 25px;
            border-bottom: 1px solid #eee;
        }
        
        .form-section:last-child {
            border-bottom: none;
        }
        
        .preview-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 3px solid #667eea;
            border-radius: 50%;
            margin: 10px 0;
        }
        
        .file-preview {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin: 10px 0;
        }
        
        .file-info {
            background: #e9ecef;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }
        
        .btn-admin-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            transition: transform 0.2s ease;
        }
        
        .btn-admin-primary:hover {
            transform: translateY(-2px);
            color: white;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border: none;
            border-radius: 10px;
        }
        
        .alert-error {
            background: linear-gradient(135deg, #dc3545, #e83e8c);
            color: white;
            border: none;
            border-radius: 10px;
        }
        
        .upload-area {
            border: 2px dashed #667eea;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            background: rgba(102, 126, 234, 0.05);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .upload-area:hover {
            background: rgba(102, 126, 234, 0.1);
            border-color: #764ba2;
        }
        
        .upload-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 15px;
        }
        
        .feature-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="container">
            <!-- Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-0">Edit About Section</h1>
                            <p class="text-muted mb-0">Manage your portfolio's about page content</p>
                        </div>
                        <a href="dashboard.php" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <!-- Success/Error Messages -->
            <?php if ($message): ?>
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert <?php echo $message_type == 'success' ? 'alert-success' : 'alert-error'; ?>">
                            <i class="bi <?php echo $message_type == 'success' ? 'bi-check-circle' : 'bi-exclamation-circle'; ?> me-2"></i>
                            <?php echo $message; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <!-- Main Content Section -->
                    <div class="col-lg-8">
                        <!-- Summary Section -->
                        <div class="admin-card">
                            <div class="admin-header">
                                <h4 class="mb-0"><i class="bi bi-text-paragraph me-2"></i>About Summary</h4>
                            </div>
                            <div class="form-section">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Professional Summary <span class="text-danger">*</span></label>
                                    <textarea name="summary" class="form-control" rows="8" placeholder="Write about your professional journey, skills, and experience..." required><?= htmlspecialchars($about['summary']) ?></textarea>
                                    <div class="form-text">
                                        This text will be displayed in the main about section. Use line breaks for better formatting.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar - Media & Files -->
                    <div class="col-lg-4">
                        <!-- Profile Image -->
                        <div class="admin-card">
                            <div class="admin-header">
                                <h4 class="mb-0"><i class="bi bi-person-square me-2"></i>Profile Image</h4>
                            </div>
                            <div class="form-section text-center">
                                <!-- Current Image Preview -->
                                <?php if (!empty($about['profile_image'])): ?>
                                    <img src="../<?= $about['profile_image'] ?>" class="preview-image" alt="Current Profile">
                                    <div class="file-info">
                                        <small class="text-muted">Current Image</small>
                                    </div>
                                <?php endif; ?>

                                <!-- Upload Area -->
                                <div class="upload-area" onclick="document.getElementById('profile_image').click()">
                                    <div class="upload-icon">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                    </div>
                                    <h5>Upload New Image</h5>
                                    <p class="text-muted mb-2">Click to select a profile image</p>
                                    <small class="text-muted">Recommended: 400x400px, JPG/PNG</small>
                                </div>
                                <input type="file" name="profile_image" id="profile_image" class="d-none" accept="image/*" onchange="previewImage(this, 'profilePreview')">
                                
                                <!-- New Image Preview -->
                                <div id="profilePreview" class="mt-3" style="display: none;">
                                    <img id="profilePreviewImg" class="preview-image" alt="New Profile Preview">
                                </div>
                            </div>
                        </div>

                        <!-- CV/Resume File -->
                        <div class="admin-card">
                            <div class="admin-header">
                                <h4 class="mb-0"><i class="bi bi-file-earmark-pdf me-2"></i>CV/Resume</h4>
                            </div>
                            <div class="form-section text-center">
                                <!-- Current CV Info -->
                                <?php if (!empty($about['cv_file'])): ?>
                                    <div class="file-info">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>
                                        <strong>Current CV:</strong> <?= basename($about['cv_file']) ?>
                                        <br>
                                        <small class="text-muted">Upload new file to replace</small>
                                    </div>
                                <?php else: ?>
                                    <div class="file-info">
                                        <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                                        <span class="text-muted">No CV uploaded yet</span>
                                    </div>
                                <?php endif; ?>

                                <!-- CV Upload Area -->
                                <div class="upload-area" onclick="document.getElementById('cv_file').click()">
                                    <div class="upload-icon">
                                        <i class="bi bi-file-earmark-arrow-up"></i>
                                    </div>
                                    <h5>Upload CV/Resume</h5>
                                    <p class="text-muted mb-2">Click to select a PDF file</p>
                                    <small class="text-muted">PDF format recommended</small>
                                </div>
                                <input type="file" name="cv_file" id="cv_file" class="d-none" accept=".pdf,.doc,.docx" onchange="previewFileName(this, 'cvFileName')">
                                
                                <!-- New CV File Name Preview -->
                                <div id="cvFileName" class="mt-3" style="display: none;">
                                    <div class="file-info">
                                        <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                        <span id="cvFileNameText"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="admin-card">
                            <div class="form-section">
                                <button type="submit" class="btn btn-admin-primary w-100 py-3">
                                    <i class="bi bi-check-circle me-2"></i>Save All Changes
                                </button>
                                <div class="text-center mt-3">
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Changes will appear immediately on the about page
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Preview Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="admin-card">
                        <div class="admin-header">
                            <h4 class="mb-0"><i class="bi bi-eye me-2"></i>Live Preview</h4>
                        </div>
                        <div class="form-section">
                            <div class="alert alert-info">
                                <i class="bi bi-lightbulb me-2"></i>
                                <strong>Tip:</strong> Your changes will appear like this on the public about page.
                            </div>
                            
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center">
                                    <img src="../<?= !empty($about['profile_image']) ? $about['profile_image'] : 'assets/default-profile.jpg' ?>" 
                                         class="preview-image" 
                                         alt="Profile Preview">
                                </div>
                                <div class="col-md-9">
                                    <h4>About Summary Preview</h4>
                                    <div class="text-muted lead">
                                        <?= nl2br(htmlspecialchars($about['summary'] ?: 'Welcome to my portfolio!')) ?>
                                    </div>
                                    <?php if (!empty($about['cv_file'])): ?>
                                        <div class="mt-3">
                                            <a href="#" class="btn btn-outline-primary">
                                                <i class="bi bi-download me-2"></i>Download CV
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview image before upload
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const previewImg = document.getElementById(previewId + 'Img');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        // Preview file name for CV
        function previewFileName(input, previewId) {
            const preview = document.getElementById(previewId);
            const fileNameText = document.getElementById(previewId + 'Text');
            
            if (input.files && input.files[0]) {
                fileNameText.textContent = input.files[0].name;
                preview.style.display = 'block';
            }
        }
        
        // Drag and drop functionality
        document.addEventListener('DOMContentLoaded', function() {
            const uploadAreas = document.querySelectorAll('.upload-area');
            
            uploadAreas.forEach(area => {
                area.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.style.background = 'rgba(102, 126, 234, 0.15)';
                    this.style.borderColor = '#764ba2';
                });
                
                area.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.style.background = 'rgba(102, 126, 234, 0.05)';
                    this.style.borderColor = '#667eea';
                });
                
                area.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.style.background = 'rgba(102, 126, 234, 0.05)';
                    this.style.borderColor = '#667eea';
                    
                    const input = this.parentElement.querySelector('input[type="file"]');
                    if (input) {
                        input.files = e.dataTransfer.files;
                        
                        // Trigger the appropriate preview function
                        if (input.name === 'profile_image') {
                            previewImage(input, 'profilePreview');
                        } else if (input.name === 'cv_file') {
                            previewFileName(input, 'cvFileName');
                        }
                    }
                });
            });
        });
        
        // Auto-save indicator
        let isChanged = false;
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, textarea, select');
        
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                isChanged = true;
            });
        });
        
        window.addEventListener('beforeunload', function(e) {
            if (isChanged) {
                e.preventDefault();
                e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
            }
        });
        
        form.addEventListener('submit', function() {
            isChanged = false;
        });
    </script>
</body>
</html>

<?php include('../includes/admin_footer.php'); ?>