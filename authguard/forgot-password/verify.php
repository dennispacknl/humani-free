<?php
// See the password_hash() example to see where this came from.
$hash = '$2y$10$uAe0ly4RExzS50TPf5e.buZIo4dSpz2Dyi2NTZSq.1VUf3c1NkWEG';

if (password_verify('Abidjan*18', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
?>