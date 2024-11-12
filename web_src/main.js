//this is the javascript file for the website
//TODO

function switchUsername(){
    //TODO: when user log's in, say instead of "login" say "hi (name)"
}

function init(){
    for (let i = 0; i < elements.length; i++) {
        elements[i].addEventListener("mouseover", function () {
            elements[i].classList.add("active");
        });
        elements[i].addEventListener("mouseout", () => {
            elements[i].classList.remove("active");
        });
        elements[i].addEventListener("click", function () {
            let sections = qsa(".section-text");
            for (let i = 0; i < sections.length; i++) {
                sections[i].classList.add("hidden");
            }
            let list1 = elements[i].id.split("-"); //when you want to get the first item
            let sectionID = list1[0] + "-text"; //id becomes efd-text
            id(sectionID).classList.remove("hidden");
            let cateID = this.id.split("-")[0];
            showImages(cateID);
        })
    }
}

function toggleInfo(id) {
    const info = document.getElementById(id);
    info.style.display = info.style.display === 'none' || info.style.display === '' ? 'block' : 'none';
}

function setUserStatus(status){
    const statusBox = document.getElementById("statusBox")
    const statusText = document.getElementById("statusText");

    // This is clearing previous classes
    statusBox.classList.remove("patient", "nurse", "hr");

    // This is updating the box based on user status
    if(status === "patient"){
        statusBox.classList.add("patient");
        statusText.innerText = "Patient View";
    }
    if(status === "nurse"){
        statusBox.classList.add("nurse");
        statusText.innerText = "Nurse View";
    }
    if(status === "hr"){
        statusBox.classList.add("hr");
        statusText.innerText = "HR View";
    }
}
