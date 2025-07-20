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
    const plansBtn = document.getElementById("toggle-plans");
    const faq = document.getElementById("faq-section");
    const plans = document.getElementById("plans-section");

    // Initial state
    faqBtn.classList.add("active");

    faqBtn.addEventListener("click", function(e) {
        e.preventDefault();
        faq.style.display = "block";
        plans.style.display = "none";
        faqBtn.classList.add("active");
        plansBtn.classList.remove("active");
    });

    plansBtn.addEventListener("click", function(e) {
        e.preventDefault();
        faq.style.display = "none";
        plans.style.display = "block";
        plansBtn.classList.add("active");
        faqBtn.classList.remove("active");
    });
});