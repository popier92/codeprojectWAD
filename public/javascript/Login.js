document.getElementById('loginForm').addEventListener('submit', async function (e) {
    e.preventDefault(); // Prevent default form submission and page reload

    const email = document.getElementById('Email').value;
    const password = document.getElementById('Password').value;

    if (!email || !password) {
        alert('Email and password are required');
        return;
    }

    try {
        const response = await fetch('Login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                Email: email,
                Password: password,
            }),
        });

        const result = await response.text(); // Get the server response as text
        if (result.includes('Invalid email or password')) {
            alert('Invalid email or password');
        } else if (result.includes('Location: addashboard.php')) {
            window.location.href = 'addashboard.php'; // Redirect to admin dashboard
        } else if (result.includes('Location: cusdashboard.php')) {
            window.location.href = 'cusdashboard.php'; // Redirect to user dashboard
        } else {
            alert('An unexpected error occurred. Please try again.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while logging in. Please try again.');
    }
});