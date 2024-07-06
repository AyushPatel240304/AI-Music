document.getElementById('profile-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var form = this;
    var formData = new FormData(form);

    fetch('profile.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Update the UI to show the 'Done' state
        var button = document.getElementById('update-button');
        button.classList.add('sent');

        // Reload the page after 2 seconds
        setTimeout(() => {
            location.reload();
        }, 2000);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});