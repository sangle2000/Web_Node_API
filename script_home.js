const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const btn_ad = $(".admin")
const btn_user = $(".user")

const ad_acc = [
    {
        ad: "admin_1",
        pass: "1234"
    }
]

btn_ad.onclick = (event) => {
    event.preventDefault()
    localStorage.setItem("role", "Admin");
    localStorage.setItem("admin-account", JSON.stringify(ad_acc));
    window.location.href = "./login/login.html"
}

btn_user.onclick = (event) => {
    event.preventDefault()
    localStorage.setItem("role", "User");
    window.location.href = "./login/login.html"
}