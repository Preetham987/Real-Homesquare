<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    include('includes/header1.php');
} else {
    include('includes/header.php');
}

$token = isset($_GET['token']) ? $_GET['token'] : '';
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

  .forgot-password-container input[type="password"] {
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
    <h2>Reset Password</h2>
    <form action="reset-password-post-code.php?token=<?php echo urlencode($_GET['token']); ?>" method="POST">
      <input type="password" name="password" placeholder="Enter your New Password" required>
        <input type="password" name="confirmPassword" placeholder="Confirm New Password" required>
      <button type="submit">Submit</button>
    </form>
  </div>
</main>
<script>
  document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form from submitting normally

    const form = e.target;
    const formData = new FormData(form);
    const token = new URLSearchParams(window.location.search).get("token");

    fetch(`reset-password-post-code.php?token=${token}`, {
      method: 'POST',
      body: formData,
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === "success") {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: data.message,
          confirmButtonText: 'OK'
        }).then(() => {
          window.location.href = 'index.php';
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: data.message
        });
      }
    })
    .catch(error => {
      console.error('Error:', error);
      Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: 'Something went wrong. Please try again later.'
      });
    });
  });
</script>
<?php include ('includes/footer.php'); ?>
