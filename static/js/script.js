let form = document.querySelector("#myForm")
let ok = true;
let inputs = document.querySelectorAll(".controllo")

form.addEventListener("submit", function(e){
    e.preventDefault()

   
    
    for(let i = 0; i<inputs.length;i++){
        let inp = parseInt(inputs[i].value);
        if(inp != null && inp != undefined && !(isNaN(inp))){
            
            if(inp > 0 && inp <= 300){
             ok = true;
            }else{
             ok = false;
            }
        }else{
         ok = false;
        }
        console.log(ok)
    }

    if(ok){
        form.submit();
    }else{
        alert("Dati inseriti non validi");
    }
})
