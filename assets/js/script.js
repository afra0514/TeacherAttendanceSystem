function deleteConfirm(event, url) {
    event.preventDefault(); // স্টপ করবে সাথে সাথে লিংকে যাওয়া

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ee5d50',
        cancelButtonColor: '#a3aed0',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // যদি ইউজার 'Yes' ক্লিক করে, তবে ডিলিট ফাইলে নিয়ে যাবে
            window.location.href = url;
        }
    });
}

// সাইডবার টগল লজিক (আগের মতোই থাকবে)
document.addEventListener("DOMContentLoaded", function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            document.body.classList.toggle('sidebar-toggled');
        });
    }
});