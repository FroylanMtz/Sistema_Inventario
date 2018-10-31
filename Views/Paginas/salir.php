<?php
session_destroy(); // Se destruye la sesión

echo '<script> window.location.href = "index.php"; </script>'; // Se redirecciona al inicio (login) donde comenzamos