const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const username_input = $(".username_input")
const password_input = $(".password_input")
const fullname_input = $(".fullname_input")
const btn_create = $(".create_btn")

const create_user_acc_btn = $(".create-user-acc")

const create_form = $(".create_form")

const user_table = $(".user_table")

const user_list = JSON.parse(localStorage.getItem("user_list")) ? JSON.parse(localStorage.getItem("user_list")) : []

function addUserInfo(userName, passWord, fullName, timeStart, apiKey) {
    user_list.push({
        id: user_list.length,
        user_name: userName,
        pass:passWord,
        user_full_name: fullName,
        time_start: timeStart,
        api_key: apiKey,
    })

    localStorage.setItem("user_list", JSON.stringify(user_list));
}

function showUserTable(){
    let export_user_info = JSON.parse(localStorage.getItem("user_list")) ? JSON.parse(localStorage.getItem("user_list")) : []
        let export_user_list = [`<tr>
                                    <th>Number</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Full Name</th>
                                    <th>Time Start Running</th>
                                    <th>Key</th>
                                </tr>`]
        for (let i = 0; i < export_user_info.length; i++){
            export_user_list.push(`<tr>
                                        <th class="normal_style">${export_user_info[i]["id"]}</th>
                                        <th class="normal_style">${export_user_info[i]["user_name"]}</th>
                                        <th class="normal_style">${export_user_info[i]["pass"]}</th>
                                        <th class="normal_style">${export_user_info[i]["user_full_name"]}</th>
                                        <th class="normal_style">${export_user_info[i]["time_start"]}</th>
                                        <th class="normal_style">${export_user_info[i]["api_key"]}</th>
                                    </tr>`)
        }

        user_table.innerHTML = export_user_list.join("")
}

create_user_acc_btn.onclick = () => {
    create_form.classList.remove("hide")
}

btn_create.onclick = () => {
    let ps_acc = true
    if (user_list.length != 0){
        for (let i = 0; i < user_list.length; i++){
            if (username_input.value === user_list[i]["user_name"]){
                alert("Please choose another username")
                ps_acc = false
                break
            }
        }
    }

    if(ps_acc){
        addUserInfo(username_input.value, password_input.value, fullname_input.value, "", "")
        showUserTable()
    }
}

showUserTable()