// Default login credentials
const defaultUsername = 'pitaji';
const defaultPassword = 'baap_hai_woh';

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const loginMessage = document.getElementById('loginMessage');

    if (username === defaultUsername && password === defaultPassword) {
        loginMessage.style.color = 'green';
        loginMessage.textContent = 'Login successful!';
        // Redirect to profile page after a short delay
        setTimeout(() => {
            window.location.href = '../../Profile/profile.html';
        }, 1000); // 1-second delay for user feedback
    } else {
        loginMessage.style.color = 'red';
        loginMessage.textContent = 'Invalid username or password.';
    }
});
