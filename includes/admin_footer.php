    <!-- Footer -->
    <footer class="text-center mt-5 py-3 border-top">
        <small class="text-muted">
            &copy; <?php echo date('Y'); ?> Tuli Moses Kimatu | Portfolio Admin Panel
        </small>
    </footer>
</div> <!-- End of admin-content -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Optional: Custom JS -->
<script>
    // Example JS: Auto-hide alerts after a few seconds
    document.addEventListener('DOMContentLoaded', () => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = "opacity 0.5s";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }, 4000);
        });
    });
</script>

</body>
</html>
