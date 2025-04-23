// Doctor Profile JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Elements for displaying profile data
    const profileImage = document.getElementById('profile-image');
    const firstNameElement = document.getElementById('first-name');
    const lastNameElement = document.getElementById('last-name');
    const emailElement = document.getElementById('email');
    const usernameElement = document.getElementById('username');
    const officePhoneElement = document.getElementById('office-phone');
    const officeAddressElement = document.getElementById('office-address');
    const specializationElement = document.getElementById('specialization');
    const consultationFeeElement = document.getElementById('consultation-fee');
    const bioElement = document.getElementById('bio');
    
    // Modal backdrop
    const modalBackdrop = document.getElementById('modal-backdrop');
    
    // Modals
    const basicProfileModal = document.getElementById('basic-profile-modal');
    const contactModal = document.getElementById('contact-modal');
    const professionalModal = document.getElementById('professional-modal');
    const photoModal = document.getElementById('photo-modal');
    
    // Modal toggle buttons
    const editBasicProfileBtn = document.getElementById('edit-basic-profile-btn');
    const editContactBtn = document.getElementById('edit-contact-btn');
    const editProfessionalBtn = document.getElementById('edit-professional-btn');
    const changePhotoBtn = document.getElementById('change-photo-btn');
    
    // Close buttons
    const closeModalBtns = document.querySelectorAll('.close-modal-btn');
    
    // Photo upload elements
    const photoUploadInput = document.getElementById('photo-upload');
    const photoPreview = document.getElementById('photo-preview');
    const photoPlaceholder = document.getElementById('photo-placeholder');
    
    // Show modal functions
    function showModal(modal) {
        if (modalBackdrop && modal) {
            modalBackdrop.classList.remove('hidden');
            modal.classList.remove('hidden');
        }
    }
    
    // Hide all modals
    function hideAllModals() {
        if (modalBackdrop) {
            modalBackdrop.classList.add('hidden');
        }
        
        // Hide all modals
        if (basicProfileModal) basicProfileModal.classList.add('hidden');
        if (contactModal) contactModal.classList.add('hidden');
        if (professionalModal) professionalModal.classList.add('hidden');
        if (photoModal) photoModal.classList.add('hidden');
    }
    
    // Toggle basic profile modal
    if (editBasicProfileBtn) {
        editBasicProfileBtn.addEventListener('click', function() {
            showModal(basicProfileModal);
        });
    }
    
    // Toggle contact modal
    if (editContactBtn) {
        editContactBtn.addEventListener('click', function() {
            showModal(contactModal);
        });
    }
    
    // Toggle professional modal
    if (editProfessionalBtn) {
        editProfessionalBtn.addEventListener('click', function() {
            showModal(professionalModal);
        });
    }
    
    // Toggle photo modal
    if (changePhotoBtn) {
        changePhotoBtn.addEventListener('click', function() {
            showModal(photoModal);
        });
    }
    
    // Close modals when clicking close button
    closeModalBtns.forEach(function(btn) {
        btn.addEventListener('click', hideAllModals);
    });
    
    // Close modals when clicking outside
    if (modalBackdrop) {
        modalBackdrop.addEventListener('click', function(e) {
            if (e.target === modalBackdrop) {
                hideAllModals();
            }
        });
    }
    
    // Handle photo preview
    if (photoUploadInput) {
        photoUploadInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    if (photoPreview) {
                        photoPreview.src = e.target.result;
                        photoPreview.classList.remove('hidden');
                    }
                    if (photoPlaceholder) {
                        photoPlaceholder.classList.add('hidden');
                    }
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});