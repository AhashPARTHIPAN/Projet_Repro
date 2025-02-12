const demande_statut = document.querySelectorAll(".statut");
if (demande_statut != []){
    demande_statut.forEach(stat => {
        let statut_content = stat.textContent;
        if(statut_content == "En cours"){
            stat.style.color = "orange";
        }
        else if(statut_content == "Non traitée"){
            stat.style.color = "red";
        }
        else {
            stat.style.color = "green";
        }
    })
}