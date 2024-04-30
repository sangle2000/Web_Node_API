const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const login_title = $(".login-title")
const user_input = $(".username_input")
const pass_input = $(".pass_input")
const login_btn = $(".btn_login")
const back_btn = $(".btn_back")

var role = localStorage.getItem("role")

login_title.innerHTML = `<h1 class="login-title">Login ${role}</h1>`

if (role == "Admin"){
    let acc = JSON.parse(localStorage.getItem("admin-account"))

    login_btn.onclick = (event) => {
        event.preventDefault()
        if (user_input.value === acc[0]["ad"] && pass_input.value === acc[0]["pass"]) {
            alert("Login Admin Success")
        }
    }
}

if (role == "User"){
    let acc = JSON.parse(localStorage.getItem("user_list")) ? JSON.parse(localStorage.getItem("user_list")) : []

    login_btn.onclick = (event) => {
        event.preventDefault()
        if (acc.length != 0){
            for (let i = 0; i < acc.length; i++){
                if (user_input.value === acc[i]["user_name"] && pass_input.value === acc[i]["pass"]) {
                    alert("Login User Success")
                    acc[i]["login"] = true
                    localStorage.setItem("user_list", JSON.stringify(acc));
                    window.location.href = "user.html"
                }
            }
        }
    }
}

back_btn.onclick = (e) => {
    e.preventDefault()
    window.location.href = "index.html"
}