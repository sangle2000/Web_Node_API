const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const btn_ad = $(".admin")
const btn_user = $(".user")

btn_ad.onclick = (event) => {
    event.preventDefault()
    window.location.href = "./login_admin.php"
}

btn_user.onclick = (event) => {
    event.preventDefault()
    window.location.href = "./login_user.php"
}