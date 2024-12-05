const forms = document.querySelector(".forms");
const pwShowHide = document.querySelectorAll(".eye-icon");
const cpwShowHide = document.querySelectorAll(".c-eye-icon");
const links = document.querySelectorAll(".link");
const forgots = document.querySelectorAll(".forgot-link");

pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
        pwFields.forEach(password => {
            if(password.type === "password") {
                password.type = "text";
                eyeIcon.classList.replace("ri-eye-off-line", "ri-eye-line");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("ri-eye-line", "ri-eye-off-line");
        })
    })
})

cpwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let cpwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".confirm-password");
        cpwFields.forEach(password => {
            if(password.type === "password") {
                password.type = "text";
                eyeIcon.classList.replace("ri-eye-off-line", "ri-eye-line");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("ri-eye-line", "ri-eye-off-line");
        })
    })
})

links.forEach(link => {
    link.addEventListener("click", e => {
        e.preventDefault();
        forms.classList.toggle("show-signup")
    })
})

forgots.forEach(forgot => {
    forgot.addEventListener("click", e => {
        e.preventDefault();
        forms.classList.toggle("show-forgot")
    })
})

function validateNumberInput(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
}