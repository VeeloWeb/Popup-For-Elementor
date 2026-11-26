document.addEventListener("DOMContentLoaded", function () {
    // FAQ toggle
    document.querySelectorAll(".faq-question").forEach(q => {
        q.addEventListener("click", function () {
            const isActive = q.classList.contains("active");
            document.querySelectorAll(".faq-answer").forEach(a => a.style.display = "none");
            document.querySelectorAll(".faq-question").forEach(el => el.classList.remove("active"));
            if (!isActive) {
                q.classList.add("active");
                q.nextElementSibling.style.display = "block";
            }
        });
    });

    const faqBtn = document.getElementById("toggle-faq");
    const faq = document.getElementById("faq-section");
    if (faqBtn && faq) {
        faqBtn.classList.add("active");
        faqBtn.addEventListener("click", function (event) {
            event.preventDefault();
            faq.scrollIntoView({ behavior: "smooth", block: "start" });
        });
    }
});
