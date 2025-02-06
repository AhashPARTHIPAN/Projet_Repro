const demande_status = document.querySelectorAll(".status");
if (demande_status != []){
    demande_status.forEach(stat => {
        let status_content = stat.textContent;
        if(status_content == "En cours"){
            stat.style.color = "orange";
        }
        else if(status_content == "Non traitée"){
            stat.style.color = "red";
        }
        else {
            stat.style.color = "green";
        }
    })
}