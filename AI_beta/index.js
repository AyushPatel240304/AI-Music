window.onload = function() {
    // Start the zoom-in animation 1 second before redirecting
    setTimeout(function() {
        document.body.style.animation = "zoomIn 1s forwards"; // "forwards" keeps the final state after animation ends
    }, 4000); // Adjust the timing as needed
    
    // Redirect after the zoom-in animation has a chance to complete
    setTimeout(function() {
        window.location.href = 'intro.html';
    }, 5000);
};
