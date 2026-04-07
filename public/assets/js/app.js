// ===============================
// GLOBAL SWEETALERT HELPERS
// ===============================

// ✅ Toast Success (default)
function showToastSuccess(message) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: 'success',
        title: message,
    });
}

// ❌ Toast Error
function showToastError(message) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true
    });

    Toast.fire({
        icon: 'error',
        title: message,
    });
}

// ⚠️ Confirm Dialog
function confirmAction(title = 'Yakin?', text = '') {
    return Swal.fire({
        title: title,
        text: text,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    });
}

// ===============================
// AJAX HELPER
// ===============================
function ajaxPost(url, data = {}, callback = null) {
    $.post(url, data, function(response) {

        if (response.sukses) {
            showToastSuccess(response.sukses);
        }

        if (response.error) {
            showToastError(response.error);
        }

        if (callback) callback(response);

    }).fail(function() {
        showToastError('Terjadi kesalahan server');
    });
}