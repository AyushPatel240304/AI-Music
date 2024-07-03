document.addEventListener("DOMContentLoaded", function() {
    // Generate boxes in the container
    for (var i = 0; i < 250; i++) {
        let box = document.createElement('span');
        document.getElementById('container').appendChild(box);
    }

    // Cursor effect
    let cursor = document.getElementById('cursor');
    window.onmousemove = function(e) {
        // Center the cursor element on the mouse position
        // Assuming the cursor element is 500x500 pixels
        cursor.style.left = (e.clientX ) + 'px'; // Center the cursor horizontally
        cursor.style.top = (e.clientY ) + 'px'; // Center the cursor vertically
    }
});
