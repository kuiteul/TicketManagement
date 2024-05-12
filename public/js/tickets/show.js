const transfert_ticket = document.querySelector("#transfert_ticket");
const transfert_ticket_form = document.querySelector("#transfert_ticket_form");
const ticket_view = document.querySelector('#ticket_view');
const back = document.querySelector("#back");
const result = document.querySelector('#result');
const resolved_block = document.querySelector(' #resolved_bloc');
const validate = document.querySelector('#validate');
const create_archive = document.querySelector('#create_archive');
const scheduled_form = document.querySelector('#scheduled_form');
const not_resolved_reason = document.querySelector('#not_resolved_reason');


/**
 * 
 */

hideBlock(transfert_ticket_form);

if(not_resolved_reason){

hideBlock(not_resolved_reason);

}

transfert_ticket.addEventListener("click", (e) => {
    displayBlock(transfert_ticket_form);
    hideBlock(ticket_view);
    hideBlock(scheduled_form);

    e.preventDefault();
});

back.addEventListener("click", (e) => {
    hideBlock(transfert_ticket_form);
    hideBlock(scheduled_form);
    displayBlock(ticket_view);

    e.preventDefault();
});


if(result){
    
    result.addEventListener('change', () => {
    if(result.value == 'resolved_with_confirm')
        {
            displayFlex(resolved_block);
            removeClass(validate, "offset-4");
            displayBlock(create_archive);
            hideBlock(scheduled_form);
            hideBlock(not_resolved_reason);
            
        }
        else if(result.value == "resolved_waiting_confirm")
        {
            displayBlock(resolved_block);
            addClass(validate, "offset-4");
            hideBlock(create_archive);
            hideBlock(scheduled_form);
            hideBlock(not_resolved_reason);
        }
        else if(result.value == "not_resolved")
        {
            displayBlock(resolved_block);
            displayBlock(not_resolved_reason);
            hideBlock(create_archive);
            removeClass(validate, "col-4");
            addClass(validate, "col-6 offset-3");
        }
        else{
            hideBlock(resolved_block);
            hideBlock(not_resolved_reason);
            displayBlock(scheduled_form);
        }
        
    });

}


function displayFlex(data)
{
    data.style.display = "flex";
}
function displayBlock(data)
{
    data.style.display = "block";
}

function hideBlock(data)
{
    data.style.display = "none";
}

function addClass(className, value)
{
    className.classList.add(value);
}

function removeClass(className, value)
{
    className.classList.remove(value);
}
