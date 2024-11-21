document.querySelector('input[name="phone"]').addEventListener('keypress', function (e) {
    // Permite apenas números
    if (!/[0-9]/.test(e.key)) {
        e.preventDefault();
    }
});
