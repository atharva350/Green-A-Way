const forms = document.querySelector(".forms"),
pwShowHide = document.querySelectorAll(".eye-icon"),
links = document.querySelectorAll(".link");

pwShowHide.forEach(eyeIcon =>{
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");

        pwFields.forEach(password => {
            if(password.type === "password"){
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("bx-show", "bx-hide");
        })
    })
})

links.forEach(link => {
    link.addEventListener("click", e => {
        e.preventDefault();       //preventing form submit
        forms.classList.toggle("show-signup");
    })
})

function validate()
{
var username =document.getElementById("email").value;
var password =document.getElementById("password").value;

if(username=="atharva@gmail.com" && password=="atharva_48")
{
window.open("temp.html");
return false;
}
else if(username=="anuj@gmail.com" && password=="anuj_51")
{
window.open("temp.html");
return false;
}
else
{
alert("Username or Password is incorrect");
}
}
