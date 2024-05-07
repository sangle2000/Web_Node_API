const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const back_btn = $(".btn_back")

back_btn.onclick = (e) => {
    e.preventDefault()
    window.location.href = "index.php"
}