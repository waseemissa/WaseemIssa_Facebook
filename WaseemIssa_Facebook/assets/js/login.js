var inputEmail = document.getElementById("login_email");
inputEmail.addEventListener('keyup', function(){
    checkEmail();
});

function checkEmail(){
    checkEmailAPI().then(check_email_response=>{
        document.getElementById("error_email").innerHTML = check_email_response.message;
    }).catch(error => {
    console.log(error.message);
    });
}


async function checkEmailAPI(){
    var email = $("#login_email").val();
    const response = await fetch("http://localhost/WaseemIssa_Facebook/php/check_email.php", {
        method: 'POST',
        body: new URLSearchParams({
            "email" : email,
        })
    });
    
    if(!response.ok){
        const message = "ERROR OCCURED";
        throw new Error(message);
    }
    
    const check_email_response = await response.json();
    return check_email_response;
}