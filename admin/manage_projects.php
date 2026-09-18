<?php
include('../config/db_connect.php');
session_start();

// 🔒 Restrict access
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// 🗑️ Delete Project
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // Delete project images first
    $images_result = $conn->query("SELECT image_path FROM project_images WHERE project_id = $id");
    while ($image = $images_result->fetch_assoc()) {
        if (!empty($image['image_path']) && file_exists("../" . $image['image_path'])) {
            unlink("../" . $image['image_path']);
        }
    }
    
    // Delete image records from database
    $conn->query("DELETE FROM project_images WHERE project_id = $id");
    
    // Delete project
    $conn->query("DELETE FROM projects WHERE id = $id");
    header("Location: manage_projects.php?msg=deleted");
    exit();
}

// 💾 Add New Project
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_project'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $category = $conn->real_escape_string($_POST['category']);
    $tech_used = $conn->real_escape_string($_POST['tech_used']);
    $link = $conn->real_escape_string($_POST['link']);

    // Insert project
    $conn->query("INSERT INTO projects (title, description, category, tech_used, link)
                  VALUES ('$title', '$description', '$category', '$tech_used', '$link')");
    
    $project_id = $conn->insert_id;
    
    // Handle multiple image uploads
    if (!empty($_FILES['images']['name'][0])) {
        $upload_dir = "../uploads/projects/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['images']['error'][$key] === 0) {
                $filename = time() . '_' . $key . '_' . basename($_FILES['images']['name'][$key]);
                $target_file = $upload_dir . $filename;
                
                if (move_uploaded_file($tmp_name, $target_file)) {
                    $image_path = "uploads/projects/" . $filename;
                    $conn->query("INSERT INTO project_images (project_id, image_path) VALUES ($project_id, '$image_path')");
                }
            }
        }
    }
    
    header("Location: manage_projects.php?msg=added");
    exit();
}

// 🧾 Fetch All Projects with their images
$projects = $conn->query("
    SELECT p.*, 
           GROUP_CONCAT(pi.image_path) as images,
           COUNT(pi.id) as image_count
    FROM projects p 
    LEFT JOIN project_images pi ON p.id = pi.project_id 
    GROUP BY p.id 
    ORDER BY p.created_at DESC
");

include('../includes/admin_header.php');
?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold mb-0">Manage Projects</h2>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#addProjectForm">
                    <i class="fa-solid fa-plus me-2"></i>Add New Project
                </button>
            </div>
        </div>
    </div>

    <!-- 🟩 Add Project Form (Collapsed) -->
    <div class="collapse mb-5" id="addProjectForm">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0"><i class="fa-solid fa-folder-plus me-2"></i>New Project</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="add_project" value="1">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="category" class="form-select">
                                <option value="Web Development">Web Development</option>
                                <option value="Real Estate Systems">Real Estate Systems</option>
                                <option value="GIS Projects">GIS Projects</option>
                                <option value="Academic Systems">Academic Systems</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tech Used</label>
                            <input type="text" name="tech_used" class="form-control" placeholder="e.g. PHP, MySQL, Bootstrap">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Project Link</label>
                            <input type="url" name="link" class="form-control" placeholder="https://example.com/demo">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Upload Screenshots (Multiple)</label>
                            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                            <div class="form-text">You can select multiple images. Hold Ctrl/Cmd to select multiple files.</div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success px-4 py-2 mt-2">
                                <i class="fa-solid fa-floppy-disk me-2"></i>Save Project
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 🟦 Projects Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="mb-0"><i class="fa-solid fa-list me-2"></i>All Projects</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Images</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Tech Used</th>
                            <th>Link</th>
                            <th class="text-center pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; while ($p = $projects->fetch_assoc()) { 
                            $images = !empty($p['images']) ? explode(',', $p['images']) : [];
                        ?>
                            <tr>
                                <td class="ps-4 fw-semibold"><?= $i++; ?></td>
                                <td>
                                    <?php if (!empty($images[0])): ?>
                                        <div class="position-relative">
                                            <img src="../<?= htmlspecialchars($images[0]); ?>" 
                                                 width="80" height="60" 
                                                 class="rounded shadow-sm" 
                                                 style="object-fit: cover;"
                                                 alt="Project image">
                                            <?php if (count($images) > 1): ?>
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                                    +<?= count($images) - 1 ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:80px; height:60px;">
                                            <span class="text-muted small">No Image</span>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-semibold"><?= htmlspecialchars($p['title']); ?></div>
                                    <div class="text-muted small mt-1" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?= htmlspecialchars($p['description']); ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary"><?= htmlspecialchars($p['category']); ?></span>
                                </td>
                                <td>
                                    <div class="small text-muted"><?= htmlspecialchars($p['tech_used']); ?></div>
                                </td>
                                <td>
                                    <?php if (!empty($p['link'])): ?>
                                        <a href="<?= htmlspecialchars($p['link']); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-up-right-from-square me-1"></i>View
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small">N/A</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="btn-group" role="group">
                                        <a href="edit_project.php?id=<?= $p['id']; ?>" class="btn btn-sm btn-outline-warning me-1">
                                            <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                                        </a>
                                        <a href="?delete=<?= $p['id']; ?>" 
                                           onclick="return confirm('Are you sure you want to delete this project? This will also delete all associated images.');" 
                                           class="btn btn-sm btn-outline-danger">
                                            <i class="fa-solid fa-trash me-1"></i>Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/admin_footer.php'); ?>