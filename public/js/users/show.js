

window.addEventListener("load", () => {
    first_name = document.querySelector("#first_name");
    last_name = document.querySelector("#last_name");
    email = document.querySelector("#email");
    title = document.querySelector("#title");
    service_name = document.querySelector("#service_name");
    service = document.querySelector("#service");
    role = document.querySelector("#role");
    modify = document.querySelector("#modify");
    update = document.querySelector("#update");

    update.style.display = "none";
    service.style.display = "none";
});

modify.addEventListener("click", (e)=> {
    first_name.disabled = false;
    last_name.disabled = false;
    email.disabled = false;
    title.disabled = false;
    service_name.disabled = false;
    role.disabled = false;
    service_name.disabled = true;

    update.style.display = "block";
    service.style.display = "block";
    service_name.style.display = "none";
    modify.style.display = "none";
    e.preventDefault();
});

