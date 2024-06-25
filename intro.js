document.addEventListener("DOMContentLoaded", function() {
    // First JS
    var logoText = document.getElementById("logoText");
    var actionButton = document.getElementById("actionButton");

    // Get the duration of the stroke animation in milliseconds
    var animationDuration = parseFloat(getComputedStyle(logoText).animationDuration) * 1000;

    // Set a timeout to make the button visible after the animation ends
    setTimeout(function() {
        actionButton.classList.remove("hidden");
        actionButton.classList.add("visible");
    }, animationDuration);
});
