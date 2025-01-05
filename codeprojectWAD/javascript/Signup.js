document.getElementById('signup').addEventListener('submit', async function (e) {
       e.preventDefault(); // Prevent default form submission
   
       const email = document.getElementById('email').value;
       const password = document.getElementById('password').value;
       const confirmPassword = document.getElementById('confirmPassword').value;
   
       try {
           const response = await fetch('Register.php', {
               method: 'POST',
               headers: {
                   'Content-Type': 'application/x-www-form-urlencoded',
               },
               body: new URLSearchParams({
                   Email: email,
                   Password: password,
                   ConfirmPassword: confirmPassword,
               }),
           });
   
           const result = await response.json();
   
           if (!result.success) {
               // Display error as a popup
               alert(result.message);
           } else {
               // Success popup and redirect
               alert(result.message);
               window.location.href = 'addashboard.php'; // Redirect to dashboard
           }
       } catch (error) {
           console.error('Error submitting the form:', error);
           alert('An unexpected error occurred. Please try again later.');
       }
       
   });
   