<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    include('includes/header1.php');
} else {
    include('includes/header.php');
}
?>

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f8;
  }

  main {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 80px 20px; /* space to clear header */
    min-height: calc(60vh - 100px); /* Adjust this if your header/footer takes up more space */
  }

  .forgot-password-container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 360px;
    text-align: center;
  }

  .forgot-password-container h2 {
    margin-bottom: 20px;
    color: #333;
  }

  .forgot-password-container input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
  }

  .forgot-password-container button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
  }

  .forgot-password-container button:hover {
    background-color: #0056b3;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<main>
  <div class="forgot-password-container">
    <h2>Forgot Password??</h2>
    <form id="forgot-password-form">
      <input type="text" id="email" name="email" placeholder="Enter your email" required>
      <button type="submit">Submit</button>
    </form>
  </div>
</main>
<script>
  document.getElementById('forgot-password-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const email = document.getElementById('email').value;

    fetch('forgot-password-post-code.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: 'email=' + encodeURIComponent(email)
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: data.message
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: data.message
        });
      }
    })
    .catch(error => {
      console.error('Error:', error);
      Swal.fire({
        icon: 'error',
        title: 'Unexpected error',
        text: 'Something went wrong. Please try again later.'
      });
    });
  });
</script>

<?php include ('includes/footer.php'); ?>
