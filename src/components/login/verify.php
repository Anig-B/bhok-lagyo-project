<?php
include '../../../connection/connection.php';

if (isset($_GET['email']) && isset($_GET['v_code'])) {
    $email = $_GET['email'];
    $v_code = $_GET['v_code'];

    echo "Email: $email<br/>";
    echo "Verification Code: $v_code<br/>";

    // Prepare the statement
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ? AND verification_code = ?");
    $stmt->bind_param("ss", $email, $v_code);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows == 1) {
            $result_fetch = $result->fetch_assoc();
            if ($result_fetch['is_verified'] == 0) {
                $update_stmt = $db->prepare("UPDATE users SET is_verified = 1 WHERE email = ?");
                $update_stmt->bind_param("s", $email);

                if ($update_stmt->execute()) {
                    echo "<script>
                            window.location.href = 'index.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('Failed to update verification status. Please try again later.');
                            window.location.href = 'index.php';
                          </script>";
                }
            } else {
                echo "<script>
                        alert('Email already verified!');
                        window.location.href = 'index.php';
                      </script>";
            }
        } else {
            echo "Invalid verification code or email.";
        }
    } else {
        echo "Failed to execute query.";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Failed to Sign up.";
}

