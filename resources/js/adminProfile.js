document.addEventListener('DOMContentLoaded', function () {
    // Photo upload functionality
    const changePhotoBtn = document.getElementById('change-photo-btn');
    const photoModal = document.getElementById('photo-modal');
    const modalBackdrop = document.getElementById('modal-backdrop');
    const photoUpload = document.getElementById('photo-upload');
    const photoPreview = document.getElementById('photo-preview');
    const photoPlaceholder = document.getElementById('photo-placeholder');

    // Basic profile edit functionality
    const editBasicProfileBtn = document.getElementById('edit-basic-profile-btn');
    const basicProfileModal = document.getElementById('basic-profile-modal');

    // All close modal buttons
    const closeModalBtns = document.querySelectorAll('.close-modal-btn');

    // Show photo modal
    if (changePhotoBtn) {
        changePhotoBtn.addEventListener('click', function () {
            modalBackdrop.classList.remove('hidden');
            photoModal.classList.remove('hidden');
        });
    }

    // Show basic profile modal
    if (editBasicProfileBtn) {
        editBasicProfileBtn.addEventListener('click', function () {
            modalBackdrop.classList.remove('hidden');
            basicProfileModal.classList.remove('hidden');
        });
    }

    // Close modals
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            modalBackdrop.classList.add('hidden');
            photoModal.classList.add('hidden');
            basicProfileModal.classList.add('hidden');
        });
    });

    // Photo preview
    if (photoUpload) {
        photoUpload.addEventListener('change', function (e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();

                reader.onload = function (event) {
                    photoPreview.src = event.target.result;
                    photoPreview.classList.remove('hidden');
                    photoPlaceholder.classList.add('hidden');
                }

                reader.readAsDataURL(e.target.files[0]);
            }
        });
    }

    // Close modal on backdrop click
    if (modalBackdrop) {
        modalBackdrop.addEventListener('click', function (e) {
            if (e.target === modalBackdrop) {
                modalBackdrop.classList.add('hidden');
                photoModal.classList.add('hidden');
                basicProfileModal.classList.add('hidden');
            }
        });
    }
});
