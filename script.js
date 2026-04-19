document.querySelectorAll("form").forEach(form => {
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        alert("✅ Submitted successfully!");
    });
});