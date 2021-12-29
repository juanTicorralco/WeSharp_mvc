<?php
session_destroy();

echo '<script>
    window.location= "' . $path .'acount&login";
</script>';
?>