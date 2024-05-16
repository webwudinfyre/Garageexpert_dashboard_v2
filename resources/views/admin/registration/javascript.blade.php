<script>

document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById(
        "floatingpasswordchanged"
    );
    const confirmPasswordInput = document.getElementById("ConfirmPassword");
    const passwordHelp = document.getElementById("passwordHelp");
    const submitButton = document.getElementById("UpdatePassword");

    confirmPasswordInput.addEventListener("input", function () {
        if (passwordInput.value === confirmPasswordInput.value) {
            confirmPasswordInput.classList.remove("is-invalid");
            confirmPasswordInput.classList.add("is-valid");
            passwordHelp.textContent = "Passwords match!";
            passwordHelp.classList.remove("text-danger");
            passwordHelp.classList.add("text-success");
            submitButton.removeAttribute("disabled");
        } else {
            confirmPasswordInput.classList.remove("is-valid");
            confirmPasswordInput.classList.add("is-invalid");
            passwordHelp.textContent = "Passwords do not match!";
            passwordHelp.classList.remove("text-success");
            passwordHelp.classList.add("text-danger");
            submitButton.setAttribute("disabled", "true");
        }
    });
});

</script>
<script>

    $(document).ready(function() {
        $('#togglePassword').on('click', function() {
            const passwordField = $('#floatingPassword');
            const passwordFieldType = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', passwordFieldType);
            $(this).toggleClass('bi-eye bi-eye-slash');
        });
    });
    $(document).ready(function() {
        $('#togglePasswordchanged').on('click', function() {
            const passwordField = $('#floatingpasswordchanged');
            const passwordFieldType = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', passwordFieldType);
            $(this).toggleClass('bi-eye bi-eye-slash');
        });
    });
    // $(document).ready(function() {
    //     $('#toggleConfirmPasswordchanged').on('click', function() {
    //         const passwordField = $('#ConfirmPassword');
    //         const passwordFieldType = passwordField.attr('type') === 'password' ? 'text' : 'password';
    //         passwordField.attr('type', passwordFieldType);
    //         $(this).toggleClass('bi-eye bi-eye-slash');
    //     });
    // });

</script>
