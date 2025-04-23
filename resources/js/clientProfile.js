document.addEventListener('DOMContentLoaded', () => {
    // Elements
    const modalBackdrop = document.getElementById('modal-backdrop');
    const basicProfileModal = document.getElementById('basic-profile-modal');
    const contactModal = document.getElementById('contact-modal');
    const healthModal = document.getElementById('health-modal');
    const photoModal = document.getElementById('photo-modal');

    // Buttons
    const editBasicProfileBtn = document.getElementById('edit-basic-profile-btn');
    const editContactBtn = document.getElementById('edit-contact-btn');
    const editHealthBtn = document.getElementById('edit-health-btn');
    const changePhotoBtn = document.getElementById('change-photo-btn');
    const closeModalBtns = document.querySelectorAll('.close-modal-btn');

    // Photo upload elements
    const photoUploadInput = document.getElementById('photo-upload');
    const photoPreview = document.getElementById('photo-preview');
    const photoPlaceholder = document.getElementById('photo-placeholder');
    const profileImageUpload = document.getElementById('profile-image-upload');

    // Show modal function
    function showModal(modal) {
        modalBackdrop.classList.remove('hidden');
        modal.classList.remove('hidden');
    }

    // Hide all modals function
    function hideAllModals() {
        modalBackdrop.classList.add('hidden');
        basicProfileModal.classList.add('hidden');
        contactModal.classList.add('hidden');
        healthModal.classList.add('hidden');
        photoModal.classList.add('hidden');
    }

    // Event listeners for opening modals
    if (editBasicProfileBtn) {
        editBasicProfileBtn.addEventListener('click', () => showModal(basicProfileModal));
    }
    
    if (editContactBtn) {
        editContactBtn.addEventListener('click', () => showModal(contactModal));
    }
    
    if (editHealthBtn) {
        editHealthBtn.addEventListener('click', () => showModal(healthModal));
    }
    
    if (changePhotoBtn) {
        changePhotoBtn.addEventListener('click', () => showModal(photoModal));
    }

    // Event listeners for closing modals
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', hideAllModals);
    });

    // Close modal when clicking outside
    modalBackdrop.addEventListener('click', (e) => {
        if (e.target === modalBackdrop) {
            hideAllModals();
        }
    });

    // Handle photo preview in photo modal
    if (photoUploadInput) {
        photoUploadInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    photoPreview.src = e.target.result;
                    photoPreview.classList.remove('hidden');
                    photoPlaceholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Handle profile image file selection button
    if (changePhotoBtn && profileImageUpload) {
        changePhotoBtn.addEventListener('click', function() {
            profileImageUpload.click();
        });
    }
});
