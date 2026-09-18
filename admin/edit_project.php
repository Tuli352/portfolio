<?php
include('../config/db_connect.php');
session_start();

// 🔒 Restrict access
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Get project ID from URL
$id = intval($_GET['id'] ?? 0);

// Fetch project data with images
$project = $conn->query("SELECT * FROM projects WHERE id = $id")->fetch_assoc();
$images_result = $conn->query("SELECT * FROM project_images WHERE project_id = $id ORDER BY id");

// If project doesn't exist, redirect
if (!$project) {
    header("Location: manage_projects.php?error=not_found");
    exit();
}

// 💾 Update Project
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_project'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description'] ?? '');
    $category = $conn->real_escape_string($_POST['category']);
    $tech_used = $conn->real_escape_string($_POST['tech_used']);
    $link = $conn->real_escape_string($_POST['link']);

    // Debug: Check what's being submitted
    error_log("Description submitted: " . substr($description, 0, 100));

    // Update project in database
    $result = $conn->query("UPDATE projects SET 
                  title = '$title', 
                  description = '$description', 
                  category = '$category', 
                  tech_used = '$tech_used', 
                  link = '$link',
                  updated_at = NOW()
                  WHERE id = $id");

    if ($result) {
        // Handle new image uploads
        if (!empty($_FILES['images']['name'][0])) {
            $upload_dir = "../uploads/projects/";
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
            
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['images']['error'][$key] === 0) {
                    $filename = time() . '_' . $key . '_' . basename($_FILES['images']['name'][$key]);
                    $target_file = $upload_dir . $filename;
                    
                    if (move_uploaded_file($tmp_name, $target_file)) {
                        $image_path = "uploads/projects/" . $filename;
                        $conn->query("INSERT INTO project_images (project_id, image_path) VALUES ($id, '$image_path')");
                    }
                }
            }
        }

        header("Location: manage_projects.php?msg=updated");
        exit();
    } else {
        $error = "Failed to update project: " . $conn->error;
    }
}

// 🗑️ Delete Single Image
if (isset($_GET['delete_image'])) {
    $image_id = intval($_GET['delete_image']);
    
    // Get image path before deleting
    $image_data = $conn->query("SELECT image_path FROM project_images WHERE id = $image_id")->fetch_assoc();
    
    if ($image_data) {
        // Delete physical file
        if (!empty($image_data['image_path']) && file_exists("../" . $image_data['image_path'])) {
            unlink("../" . $image_data['image_path']);
        }
        
        // Delete from database
        $conn->query("DELETE FROM project_images WHERE id = $image_id");
    }
    
    header("Location: edit_project.php?id=$id&msg=image_deleted");
    exit();
}

include('../includes/admin_header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project - Admin Panel</title>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .editor-container {
            height: 300px;
            margin-bottom: 20px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        .template-btn {
            margin-right: 5px;
            margin-bottom: 5px;
        }
        
        .ql-editor {
            min-height: 250px;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .note-content ul, .note-content ol {
            padding-left: 20px;
        }
        
        .read-only-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
        .read-only-content {
            white-space: pre-wrap;
            font-family: inherit;
        }
        
        .read-only-content ul, .read-only-content ol {
            padding-left: 20px;
        }
        
        .read-only-content img {
            max-width: 100%;
            height: auto;
        }
        
        .template-section {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        
        .template-section h6 {
            margin-bottom: 10px;
            color: #495057;
        }
        
        .formatting-buttons {
            margin-bottom: 10px;
        }
        
        .formatting-buttons .btn {
            margin-right: 5px;
            margin-bottom: 5px;
        }
        
        /* Custom styling for the editor toolbar */
        .ql-toolbar.ql-snow {
            border: 1px solid #ccc;
            border-bottom: none;
            border-radius: 4px 4px 0 0;
            background-color: #f8f9fa;
        }
        
        .ql-container.ql-snow {
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 4px 4px;
        }
        
        /* Custom button styles */
        .btn-format {
            background-color: #6c757d;
            color: white;
            border: none;
        }
        
        .btn-format:hover {
            background-color: #5a6268;
            color: white;
        }
        
        .alert {
            margin-bottom: 20px;
        }
        
        .optional-field {
            color: #6c757d;
            font-weight: normal;
        }
    </style>
</head>
<body>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="manage_projects.php" class="text-decoration-none">Projects</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Project</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Edit Project</h2>
                    <p class="text-muted mb-0">Update project details and manage images</p>
                </div>
                <a href="manage_projects.php" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back to Projects
                </a>
            </div>
        </div>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-pen-to-square me-2"></i>
                        Editing: <?= htmlspecialchars($project['title']); ?>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" enctype="multipart/form-data" id="projectForm">
                        <input type="hidden" name="update_project" value="1">
                        
                        <div class="row g-4">
                            <!-- Title -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Project Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($project['title']); ?>" required>
                            </div>

                            <!-- Category -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                <select name="category" class="form-select" required>
                                    <option value="Web Development" <?= $project['category'] == 'Web Development' ? 'selected' : ''; ?>>Web Development</option>
                                    <option value="Real Estate Systems" <?= $project['category'] == 'Real Estate Systems' ? 'selected' : ''; ?>>Real Estate Systems</option>
                                    <option value="GIS Projects" <?= $project['category'] == 'GIS Projects' ? 'selected' : ''; ?>>GIS Projects</option>
                                    <option value="Academic Systems" <?= $project['category'] == 'Academic Systems' ? 'selected' : ''; ?>>Academic Systems</option>
                                    <option value="Other" <?= $project['category'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </div>

                            <!-- Description with Rich Text Editor -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                                
                                <!-- Quick Formatting Buttons -->
                                <div class="formatting-buttons">
                                    <h6>Quick Formatting:</h6>
                                    <button type="button" class="btn btn-sm btn-format" id="boldBtn" title="Bold">
                                        <i class="fa-solid fa-bold"></i> Bold
                                    </button>
                                    <button type="button" class="btn btn-sm btn-format" id="bulletBtn" title="Bullet List">
                                        <i class="fa-solid fa-list-ul"></i> Bullets
                                    </button>
                                    <button type="button" class="btn btn-sm btn-format" id="numberBtn" title="Numbered List">
                                        <i class="fa-solid fa-list-ol"></i> Numbers
                                    </button>
                                    <button type="button" class="btn btn-sm btn-format" id="h2Btn" title="Heading 2">
                                        <i class="fa-solid fa-heading"></i> H2
                                    </button>
                                    <button type="button" class="btn btn-sm btn-format" id="h3Btn" title="Heading 3">
                                        <i class="fa-solid fa-heading"></i> H3
                                    </button>
                                </div>
                                
                                <div class="template-section">
                                    <h6>Quick Templates:</h6>
                                    <button type="button" class="btn btn-sm btn-outline-secondary template-btn" data-target="descriptionEditor" data-template="project-overview">
                                        Project Overview
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary template-btn" data-target="descriptionEditor" data-template="features">
                                        Features List
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary template-btn" data-target="descriptionEditor" data-template="technical">
                                        Technical Details
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary template-btn" data-target="descriptionEditor" data-template="challenges">
                                        Challenges & Solutions
                                    </button>
                                </div>
                                
                                <!-- Quill Editor Container -->
                                <div id="descriptionEditor" class="editor-container"><?= htmlspecialchars_decode($project['description']); ?></div>
                                <input type="hidden" name="description" id="descriptionContent" value="<?= htmlspecialchars($project['description']); ?>">
                                <div class="form-text">
                                    <i class="fa-solid fa-bold text-primary"></i> Use <strong>Bold</strong> for emphasis | 
                                    <i class="fa-solid fa-list-ul text-success"></i> Use <strong>Bullets</strong> for lists | 
                                    <i class="fa-solid fa-heading text-warning"></i> Use <strong>Headings</strong> for sections
                                </div>
                            </div>

                            <!-- Tech Used -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Technologies Used</label>
                                <input type="text" name="tech_used" class="form-control" 
                                       value="<?= htmlspecialchars($project['tech_used']); ?>" 
                                       placeholder="e.g., PHP, MySQL, Bootstrap, JavaScript">
                            </div>

                            <!-- Project Link - NOW OPTIONAL -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Project Link 
                                    <span class="optional-field">(Optional)</span>
                                </label>
                                <input type="url" name="link" class="form-control" 
                                       value="<?= htmlspecialchars($project['link']); ?>" 
                                       placeholder="https://example.com/demo">
                                <div class="form-text">Leave empty if no live demo is available</div>
                            </div>

                            <!-- Current Images -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">Current Images</label>
                                <div class="row g-3">
                                    <?php if ($images_result->num_rows > 0): ?>
                                        <?php while ($image = $images_result->fetch_assoc()): ?>
                                            <div class="col-md-3 col-6">
                                                <div class="card border-0 shadow-sm">
                                                    <img src="../<?= htmlspecialchars($image['image_path']); ?>" 
                                                         class="card-img-top" 
                                                         style="height: 120px; object-fit: cover;"
                                                         alt="Project image">
                                                    <div class="card-body p-2 text-center">
                                                        <a href="?id=<?= $id ?>&delete_image=<?= $image['id'] ?>" 
                                                           class="btn btn-sm btn-outline-danger"
                                                           onclick="return confirm('Are you sure you want to delete this image?')">
                                                            <i class="fa-solid fa-trash me-1"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <div class="col-12">
                                            <div class="text-center text-muted p-4 bg-light rounded">
                                                <i class="fa-solid fa-image fa-2x mb-2 d-block"></i>
                                                <span>No images uploaded for this project</span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- New Image Upload -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">Add More Images</label>
                                <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                                <div class="form-text">Select multiple images to add to this project. Existing images will be preserved.</div>
                            </div>

                            <!-- Project Metadata -->
                            <div class="col-md-6">
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <h6 class="fw-semibold mb-3">Project Information</h6>
                                        <div class="row g-2 small">
                                            <div class="col-6">
                                                <span class="text-muted">Created:</span>
                                            </div>
                                            <div class="col-6">
                                                <span class="fw-semibold"><?= date('M j, Y', strtotime($project['created_at'])); ?></span>
                                            </div>
                                            <?php if (!empty($project['updated_at']) && $project['updated_at'] != $project['created_at']): ?>
                                                <div class="col-6">
                                                    <span class="text-muted">Last Updated:</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="fw-semibold"><?= date('M j, Y', strtotime($project['updated_at'])); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <div class="col-6">
                                                <span class="text-muted">Total Images:</span>
                                            </div>
                                            <div class="col-6">
                                                <span class="fw-semibold"><?= $images_result->num_rows; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="col-12">
                                <div class="d-flex gap-2 pt-3 border-top">
                                    <button type="submit" class="btn btn-success px-4 py-2" id="submitBtn">
                                        <i class="fa-solid fa-floppy-disk me-2"></i>Update Project
                                    </button>
                                    <a href="manage_projects.php" class="btn btn-outline-secondary px-4 py-2">
                                        <i class="fa-solid fa-times me-2"></i>Cancel
                                    </a>
                                    <a href="manage_projects.php?delete=<?= $project['id']; ?>" 
                                       onclick="return confirm('Are you sure you want to delete this project? This will also delete all associated images and cannot be undone.');" 
                                       class="btn btn-outline-danger px-4 py-2 ms-auto">
                                        <i class="fa-solid fa-trash me-2"></i>Delete Project
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Quill editor
        const editorOptions = {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['link', 'image'],
                    ['clean']
                ]
            },
            placeholder: 'Enter project description here...'
        };
        
        const descriptionEditor = new Quill('#descriptionEditor', editorOptions);
        
        // Update hidden input with editor content in real-time
        descriptionEditor.on('text-change', function() {
            const content = descriptionEditor.root.innerHTML;
            document.getElementById('descriptionContent').value = content;
            console.log('Editor content updated:', content.substring(0, 100));
        });
        
        // Also update on form submission as a backup
        document.getElementById('projectForm').addEventListener('submit', function(e) {
            // Ensure the content is updated before submission
            const content = descriptionEditor.root.innerHTML;
            document.getElementById('descriptionContent').value = content;
            console.log('Form submitted with content:', content.substring(0, 100));
            
            // Optional: Validate that content is not empty
            if (!content || content === '<p><br></p>' || content === '<p></p>') {
                e.preventDefault();
                alert('Please enter a project description');
                return false;
            }
            
            return true;
        });
        
        // Quick Formatting Button Handlers
        document.getElementById('boldBtn').addEventListener('click', function() {
            const range = descriptionEditor.getSelection();
            if (range) {
                descriptionEditor.formatText(range.index, range.length, 'bold', true);
            } else {
                // If no selection, insert bold text at cursor
                const currentPosition = descriptionEditor.getSelection()?.index || 0;
                descriptionEditor.insertText(currentPosition, 'Bold Text', 'bold', true);
                descriptionEditor.setSelection(currentPosition + 9, 0);
            }
        });
        
        document.getElementById('bulletBtn').addEventListener('click', function() {
            descriptionEditor.format('list', 'bullet');
        });
        
        document.getElementById('numberBtn').addEventListener('click', function() {
            descriptionEditor.format('list', 'ordered');
        });
        
        document.getElementById('h2Btn').addEventListener('click', function() {
            descriptionEditor.format('header', 2);
        });
        
        document.getElementById('h3Btn').addEventListener('click', function() {
            descriptionEditor.format('header', 3);
        });
        
        // Templates for project descriptions
        const templates = {
            'project-overview': `<h2>Project Overview</h2>
<p>This project was developed to address <strong>[problem/need]</strong>. It provides a comprehensive solution for <strong>[target audience]</strong> by offering <strong>[key benefits]</strong>.</p>

<h3>Key Objectives</h3>
<ul>
    <li><strong>Objective 1:</strong> Description of objective</li>
    <li><strong>Objective 2:</strong> Description of objective</li>
    <li><strong>Objective 3:</strong> Description of objective</li>
</ul>

<h3>Target Audience</h3>
<p>The application is designed for <strong>[describe target users]</strong>.</p>`,
            
            'features': `<h2>Key Features</h2>
<ul>
    <li><strong>Feature 1:</strong> Detailed description of feature 1 and its benefits</li>
    <li><strong>Feature 2:</strong> Detailed description of feature 2 and its benefits</li>
    <li><strong>Feature 3:</strong> Detailed description of feature 3 and its benefits</li>
    <li><strong>Feature 4:</strong> Detailed description of feature 4 and its benefits</li>
</ul>

<h3>User Benefits</h3>
<ul>
    <li>Increased productivity and efficiency</li>
    <li>Improved user experience</li>
    <li>Cost-effective solution</li>
</ul>`,
            
            'technical': `<h2>Technical Implementation</h2>
<h3>System Architecture</h3>
<p>This project follows a <strong>[architecture pattern]</strong> with the following components:</p>
<ul>
    <li><strong>Frontend:</strong> [technologies used]</li>
    <li><strong>Backend:</strong> [technologies used]</li>
    <li><strong>Database:</strong> [technologies used]</li>
    <li><strong>Deployment:</strong> [platform/infrastructure]</li>
</ul>

<h3>Key Technologies</h3>
<ul>
    <li><strong>Technology 1:</strong> Purpose and role in the project</li>
    <li><strong>Technology 2:</strong> Purpose and role in the project</li>
    <li><strong>Technology 3:</strong> Purpose and role in the project</li>
</ul>`,
            
            'challenges': `<h2>Development Challenges</h2>
<h3>Challenges Faced</h3>
<ul>
    <li><strong>Challenge 1:</strong> Detailed description of the technical or design challenge</li>
    <li><strong>Challenge 2:</strong> Detailed description of the technical or design challenge</li>
    <li><strong>Challenge 3:</strong> Detailed description of the technical or design challenge</li>
</ul>

<h3>Solutions Implemented</h3>
<ul>
    <li><strong>Solution 1:</strong> Innovative approach to solve challenge 1</li>
    <li><strong>Solution 2:</strong> Innovative approach to solve challenge 2</li>
    <li><strong>Solution 3:</strong> Innovative approach to solve challenge 3</li>
</ul>`
        };
        
        // Apply templates to editor
        document.querySelectorAll('button[data-template]').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                const template = this.getAttribute('data-template');
                
                if (target === 'descriptionEditor' && templates[template]) {
                    descriptionEditor.clipboard.dangerouslyPasteHTML(0, templates[template]);
                }
            });
        });
        
        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
                e.preventDefault();
                document.getElementById('boldBtn').click();
            }
        });
        
        // Debug: Log initial state
        console.log('Editor initialized with content:', descriptionEditor.root.innerHTML.substring(0, 100));
    });
</script>

<?php include('../includes/admin_footer.php'); ?>