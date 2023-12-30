function showLoader() {
    const loaderElement = document.getElementById('loader'); 
    if (loaderElement) {
        loaderElement.classList.add('show');
    }
}
function hideLoader() {
    const loaderElement = document.getElementById('loader'); 
    if (loaderElement) {
        loaderElement.classList.remove('show');
    }
}

function openModal(modalId) {
    let myModal = new bootstrap.Modal(document.getElementById(modalId));
    myModal.show();
}

function closeModal(modalId) {
    let modalElement = document.getElementById(modalId);
    let myModal = bootstrap.Modal.getInstance(modalElement);
    if (myModal) {
        myModal.hide();
    }
}