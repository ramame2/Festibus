
//news

    document.addEventListener("DOMContentLoaded", function () {
    const newsItems = document.querySelectorAll('.news-item');
    let currentIndex = 0;

    // Show the first news item initially
    if (newsItems.length > 0) {
    newsItems[currentIndex].style.display = 'block';
}

    // Function to show the next news item every 5 seconds
    setInterval(function () {
    // Hide the current news item
    newsItems[currentIndex].style.display = 'none';

    // Move to the next news item (loop back to the first item if at the end)
    currentIndex = (currentIndex + 1) % newsItems.length;

    // Show the new news item
    newsItems[currentIndex].style.display = 'block';
}, 3000); // 5000ms = 5 seconds
});

//
    document.getElementById('departure_date').addEventListener('input', function() {
    var selectedDate = this.value;  // Get the value of the input field
    document.getElementById('selected_date').textContent = selectedDate; // Display it in the <span>
});




// login options modal
    // Show the login options modal
    function showLoginOptions() {
    document.getElementById('loginOptionsModal').style.display = 'block';
}

    // Close the login options modal
    function closeModal() {
    document.getElementById('loginOptionsModal').style.display = 'none';
}

    // Submit the form as a guest
    function submitAsGuest() {
    // Optionally, you can add more guest-related handling here (e.g., passing a 'guest' flag)
    document.getElementById('booking-form').submit();
}


   // Date and Time Validation
    document.addEventListener('DOMContentLoaded', function() {
    const departureDate = document.getElementById('departure_date');
    const departureTime = document.getElementById('departure_time');

    // Ensure both date and time are in the future
    function validateDateTime() {
    const selectedDate = new Date(departureDate.value + 'T' + departureTime.value);
    const now = new Date();

    if (selectedDate < now) {
    alert('De geselecteerde datum en tijd kunnen niet in het verleden liggen.');
    departureDate.setCustomValidity('De geselecteerde datum en tijd kunnen niet in het verleden liggen.');
    departureTime.setCustomValidity('De geselecteerde tijd kan niet in het verleden liggen.');
} else {
    departureDate.setCustomValidity('');
    departureTime.setCustomValidity('');
}
}

    // Add event listeners for changes in date or time
    departureDate.addEventListener('change', validateDateTime);
    departureTime.addEventListener('change', validateDateTime);
});

// Smooth scroll to route-options after form submission
document.getElementById('route-form').addEventListener('submit', function (event) {
    // Wait until the form submission is completed before scrolling
    setTimeout(function () {
        document.getElementById('route-options').scrollIntoView({ behavior: 'smooth' });
    }, 500);
});
