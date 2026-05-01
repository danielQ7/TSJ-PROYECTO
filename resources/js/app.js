// ============================================================
// app.js - Sistema de Gestión
// ============================================================

// Bootstrap JS (importar desde node_modules en proyecto real)
// import 'bootstrap';

document.addEventListener('DOMContentLoaded', function () {

    // ── Auto-cierre de alertas ──────────────────────────────
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 4000);
    });

    // ── Confirmación de eliminación ─────────────────────────
    document.querySelectorAll('[data-confirm]').forEach(btn => {
        btn.addEventListener('click', function (e) {
            const msg = this.dataset.confirm || '¿Estás seguro de eliminar este registro?';
            if (!confirm(msg)) {
                e.preventDefault();
            }
        });
    });

    // ── Tooltips Bootstrap ──────────────────────────────────
    const tooltipTriggers = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggers.forEach(el => new bootstrap.Tooltip(el));

    // ── DataTables (si está incluido) ───────────────────────
    if (typeof $.fn !== 'undefined' && typeof $.fn.DataTable !== 'undefined') {
        $('.table-datatable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            },
            responsive: true,
        });
    }

    // ── Función global: mostrar spinner al enviar forms ─────
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function () {
            const btn = this.querySelector('[type="submit"]');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Procesando...';
            }
        });
    });
});
