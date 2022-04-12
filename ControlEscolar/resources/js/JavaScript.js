//Class
function _c(name){
    return document.querySelector("."+name);
}

//ID
function _i(name){
    return document.querySelector("#"+name);
}

//New Element
function createElementStudent(pos){

    switch(pos){
        
        //Add
        case 1:
            //Create
            if (window.XMLHttpRequest) {
                xhhtp=new XMLHttpRequest();
            }
            else {
                xhhtp=new ActiveXObject(Microsoft.XMLHTTP);
            }
            xhhtp.open('GET','resources/Views/Response/Students/addStudent.html');
            xhhtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            //Upload
            xhhtp.upload.onprogress = function (){
                
            };

            //Ready
            xhhtp.onreadystatechange = function () {
                if (xhhtp.readyState == 4) {
                    if(xhhtp.status == 200){
                        _i('insertElementStudent').innerHTML = xhhtp.responseText;
                        addEventKey(pos);
                    }else{
                        alert('Ha ocurrido un error, favor de volver a intentarlo, si el problema persiste intenta recargando la página!');
                    }
                }
            };

            xhhtp.send();
            _i('btnAddStudent').disabled = true;
            _i('btnDeleteStudent').disabled = false;
           // _i('btnSearchStudent').disabled = false;
            break;
        //Delete
            case 2:
            //Create
            if (window.XMLHttpRequest) {
                xhhtp=new XMLHttpRequest();
            }
            else {
                xhhtp=new ActiveXObject(Microsoft.XMLHTTP);
            }
            xhhtp.open('GET','resources/Views/Response/Students/deleteStudent.html');
            xhhtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //Ready
            xhhtp.onreadystatechange = function () {
                if (xhhtp.readyState == 4) {
                    if(xhhtp.status == 200){
                        _i('insertElementStudent').innerHTML = xhhtp.responseText;
                    }else{
                        alert('Ha ocurrido un error, favor de volver a intentarlo, si el problema persiste intenta recargando la página!');
                    }
                }
            };
            xhhtp.send();

            fetch('Logic/Controllers/StudentsController/tableStudents.php')
            .then(datos=>datos.json()) 
            .then(function(datos){
                let u = datos[0]["Students"];
                u.forEach(element => {
                    console.log(element);
                    //Create tr
                    let tr = document.createElement("tr");
                    tr.id = "trStudent"+element.idAlumno;

                    //Create td
                    let tdName = document.createElement("td");
                    let tdUser = document.createElement("td");
                    let tdButtons = document.createElement("td");
                    tdButtons.classList.add("alignRow7");

                    //Create buttons
                    let buttonInfo = document.createElement("button");
                    buttonInfo.classList.add("btn","btn-warning");
                    buttonInfo.innerHTML = "<i class='fas fa-info'></i>";
                    buttonInfo.addEventListener('click',function(){
                        showModal(element.idAlumno);
                    })

                    let buttonDelete = document.createElement("button");
                    buttonDelete.classList.add("btn","btn-danger");
                    buttonDelete.innerHTML = "<i class='fas fa-trash'></i>";
                    buttonDelete.addEventListener('click',function(){
                        deleteStudent(element.idAlumno);
                    });

                    //Data
                    tdName.innerHTML = element.nombre+" "+element.apellidoPaterno+" "+element.apellidoMaterno;
                    tdUser.innerHTML = element.usuario;
                    tdButtons.appendChild(buttonInfo);
                    tdButtons.appendChild(buttonDelete);

                    //AppendChild
                    tr.appendChild(tdName);
                    tr.appendChild(tdUser);
                    tr.appendChild(tdButtons);

                    //Insertar
                    _i('bodyTableStudents').appendChild(tr);
                });
            });
            _i('btnAddStudent').disabled = false;
            _i('btnDeleteStudent').disabled = true;
           // _i('btnSearchStudent').disabled = false;
            break;
        //Search
        case 3:
            //Create
            if (window.XMLHttpRequest) {
                xhhtp=new XMLHttpRequest();
            }
            else {
                xhhtp=new ActiveXObject(Microsoft.XMLHTTP);
            }
            xhhtp.open('GET','resources/Views/Response/Students/searchStudent.html');
            xhhtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //Ready
            xhhtp.onreadystatechange = function () {
                if (xhhtp.readyState == 4) {
                    if(xhhtp.status == 200){
                        _i('insertElementStudent').innerHTML = xhhtp.responseText;
                    }else{
                        alert('Ha ocurrido un error, favor de volver a intentarlo, si el problema persiste intenta recargando la página!');
                    }
                }
            };
            xhhtp.send();
            _i('btnAddStudent').disabled = false;
            _i('btnDeleteStudent').disabled = false;
           // _i('btnSearchStudent').disabled = true;
            break;
    }
    
}

function createUser(name,lastName){
    let letterName = name.charAt(0).toLowerCase();
    let lastNameLower = lastName.toLowerCase();
    return (letterName+"."+lastNameLower+Math.floor(Math.random() * (100 - 1) + 1)).split(" ").join("") ;
}

function checkText(){
    if(_i('nameStudent').value == '' || _i('lastNameStudent1').value == ''){
        _i('userStudent').value = "";
    }      
}

function addEventKey(pos){
    switch(pos){
        case 1:
            //Name
            _i('nameStudent').addEventListener("keyup", (event) => {
                if(_i('nameStudent').value != '' && _i('lastNameStudent1').value != ''){
                    _i('userStudent').value = createUser(_i('nameStudent').value,_i('lastNameStudent1').value);
                }
                checkDisabledButton();
                checkText();
             });
             //LastName
             _i('lastNameStudent1').addEventListener("keyup", (event) => {
                if(_i('nameStudent').value != '' && _i('lastNameStudent1').value != ''){
                    _i('userStudent').value = createUser(_i('nameStudent').value,_i('lastNameStudent1').value);
                }
                checkDisabledButton();
                checkText();
             });

            break;
        default:
            break;
    }
}

function generatePassword(){
    let long = Math.floor(Math.random() * (21 - 8) + 8);
    let letters = "abcdefghijklmnopqrstuvwxyz";
    let numbers = "0123456789";
    let result = "";
    for(let i = 0; i<long; i++){
        let ran = (Math.floor(Math.random() * (4 - 1) + 1));
        //Upper
        if( ran == 1){
            result += letters.charAt((Math.random() * (26 - 0) + 0)).toUpperCase();
        }
        //Lower
        else if(ran == 2){
            result += letters.charAt((Math.random() * (26 - 0) + 0));
        }
        //Number
        else if(ran == 3){
            result += numbers.charAt((Math.random() * (10 - 0) + 0));
        }
    }
    _i('studentPassword').value=result;
    checkDisabledButton();
}

function checkDisabledButton(){
    if( _i('nameStudent').value != '' && _i('lastNameStudent1').value != '' && _i('userStudent').value != '' && _i('studentPassword').value != ''){
        _i('btnSubStu').disabled = false;
    }
    else{
        _i('btnSubStu').disabled = true;
        console.log("C5");
    }
}

function fetchAddStudent(){
    let nombre = _i('nameStudent').value;
    let lastName1 = _i('lastNameStudent1').value;
    let lastName2 = _i('lastNameStudent2').value;
    let user = _i('userStudent').value;
    let pass = _i('studentPassword').value;
    
    let url = 'Logic/Controllers/StudentsController/addStudent.php';
    let data = {
        nombre:nombre,
        lastName1:lastName1,
        lastName2:lastName2,
        user:user,
        pass:pass
    };
    fetch(url, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
        })
    .then(response=>{
        if(response.ok){
            cleanInputs();
            responseAlertStudent(1,1);
            fadeOutDiv(1);
        }
        else{
            cleanInputs();
            responseAlertStudent(1,2);
        }
    })
    .catch(function(err) {
        console.log(err);
    });
}

function deleteStudent(id){
    if(confirm("¿Se encuentra seguro de eliminar al alumno?")){
        let url = 'Logic/Controllers/StudentsController/deleteStudent.php';
        let data = {
            idAlumno:id
        };
        fetch(url,{
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        }).then(response=>{
            if(response.ok){
                _i('bodyTableStudents').removeChild(_i('trStudent'+id));
            responseAlertStudent(2,1);
            fadeOutDiv(2);
            }
            else{
            }
        });
    }
}

function cleanInputs(){
    _i('nameStudent').value = "";
    _i('lastNameStudent1').value = "";
    _i('lastNameStudent2').value = "";
    _i('userStudent').value = "";
    _i('studentPassword').value = "";
    checkDisabledButton();
    checkText();
}

function responseAlertStudent(id,opc){

    //Select Response
    switch(id){
        case 1:
            var alert = _i('responseAddStudent');
            break;
        case 2:
            var alert = _i('responseDeleteStudent');
            break;
    }

    //Styles Response
    alert.style.display = "block";
    alert.style.opacity = 1;

    //Class response
    switch(opc){
        case 1:
            alert.classList.remove('alert-danger');
            alert.classList.add('alert-success');
            break;
        case 2:
            alert.classList.remove('alert-success');
            alert.classList.add('alert-danger');
            break;
    }

    //Text Response
    switch(opc){
        case 1:
            if(id == 1){
                alert.innerHTML = "Se ha dado de alta correctamente al alumno";
            }
            else if(id == 2){
                alert.innerHTML = "Se ha eliminado correctamente al alumno";
            }
            break;
        case 2:
            alert.innerHTML = "Ha ocurrido un error, favor de volver a intentarlo"
            break;
    }

}

function fadeOutDiv(opc){
    switch(opc){
        case 1:
            var target = _i('responseAddStudent');
            var effect = setInterval(function(){
                if (!target.style.opacity) {
                    target.style.opacity = 1;
                }
                if (target.style.opacity > 0) {
                    target.style.opacity -= 0.1;
                } else {
                    clearInterval(effect);
                }
            },200);
        
            setTimeout("_i('responseAddStudent').style.display = 'none'",800);
            break;
        case 2: 
            var target = _i('responseDeleteStudent');
            var effect = setInterval(function(){
                if (!target.style.opacity) {
                    target.style.opacity = 1;
                }
                if (target.style.opacity > 0) {
                    target.style.opacity -= 0.1;
                } else {
                    clearInterval(effect);
                }
            },200);
        
            setTimeout("_i('responseDeleteStudent').style.display = 'none'",800);
            break;
    }
    
}

function showModal(idAlumno){
    //Create
    if (window.XMLHttpRequest) {
        xhhtp=new XMLHttpRequest();
    }
    else {
        xhhtp=new ActiveXObject(Microsoft.XMLHTTP);
    }
    xhhtp.open('GET','resources/Views/Response/Students/modalStudent.html');
    xhhtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //Ready
    xhhtp.onreadystatechange = function () {
        if (xhhtp.readyState == 4) {
            if(xhhtp.status == 200){
                _i('modalInfoStudent').innerHTML = xhhtp.responseText;
                refreshCardModal(idAlumno);
            }else{
                alert('Ha ocurrido un error, favor de volver a intentarlo, si el problema persiste intenta recargando la página!');
            }
        }
    };
    xhhtp.send();
    
    $('#modalStudent').modal('show')
}

function createCardAsignature(nombre,costo,nameBody,idAlumno,idMateria){
    
    //Create Body
    let divCard = document.createElement('div');
    divCard.classList.add("card","text-center","cardAssignature");

    //Create Childs
        //Header
    let divH = document.createElement('div');
    divH.classList.add('card-header','alignRow'); 
        //Header childs
            //Button
    let buttonD = document.createElement("button");
    buttonD.classList.add('btn','btn-danger','fixButtonsm');
    buttonD.addEventListener("click",function(){
        deleteAssignature(idAlumno,idMateria);
    });
    let iconButton = document.createElement("i");
    iconButton.classList.add('fas' , 'fa-times' , 'fa-sm' , 'fixIcon');
    buttonD.appendChild(iconButton);
            //Span
    let spanN = document.createElement("span");
    spanN.innerHTML = nombre;

    divH.appendChild(buttonD);
    divH.appendChild(spanN);

        //Body
    let divB = document.createElement('div');
    divB.classList.add("card-body");
    divB.innerHTML = "$ "+costo;

    //InsertChilds
    divCard.appendChild(divH);
    divCard.appendChild(divB);

    _i(nameBody).appendChild(divCard);
    
}

function refreshCardModal(idAlumno){
    let url = "Logic/Controllers/StudentsController/modalStudents.php";
    data = {
        idAlumno:idAlumno
    };
    fetch(url,{
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(datos=>datos.json()) 
    .then(function(datos){
        console.log(datos);
        let nombre = datos[0]["Name"];
        let nAsignatures = datos[0]["nAsignatures"];
        let materias = datos[0]["Asignatures"];
        let costo = datos[0]["Price"];
       
        try{
            nombre.forEach(element => {
                console.log(element);
                _i('ModalNameStudent').innerHTML = element.nombre + " " + element.apellidoPaterno + " " + element.apellidoMaterno;
            });

            try{
                nAsignatures.forEach(element => {
                    console.log(element);
                    createAsignature(element.idMateria,element.nombre,"freeAsignatures",idAlumno);
                    
                });
            }
            catch{

            }
            
            try{
                materias.forEach(element => {
                    console.log(element);
                    createCardAsignature(element.nombre,element.costo,"contentCards",idAlumno,element.idMateria);
                });
            }
            catch{
                _i('contentCard').innerHTML = "No hay materias registradas";
                _i('costoTotalModal').innerHTML = "";
            }
            
            costo.forEach(element => {
                _i('costoTotalModal').innerHTML = "Costo Total: $ " + element.costo;
            });
            
        }
        catch{
            _i('contentCards').innerHTML = "<span>No hay materias registradas</span>";
        }
    });
}

function deleteAssignature(idAlumno,idMateria){
    if(confirm('¿Desea eliminar esta materia del alumno?')){
        let url = "Logic/Controllers/StudentsController/removeAssignature.php";
        data = {
            idAlumno:idAlumno,
            idMateria:idMateria
        };
        fetch(url,{
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        })
        .then(function(){
            refreshAsignatures();
            refreshCardModal(idAlumno);
        })
        .catch(function(err) {
            console.log(err);
        });
    }

}

function createAsignature(id,nombre,nameBody,idAlumno){
    //Create Parent
    let divP = document.createElement("div");
    divP.classList.add("asignature");

    //Create childs
        //Button
    let buttonC = document.createElement("button");
    buttonC.classList.add('btn','btn-success','fixButton');
    let iconC = document.createElement("i");
    iconC.classList.add('fas','fa-plus');
    buttonC.appendChild(iconC);
    buttonC.addEventListener("click",function(){
        addAsignatureStudent(idAlumno,id);
    });
        //Span
    let spanC = document.createElement("span");
    spanC.innerHTML = nombre;
    
    //Insert Childs
    divP.appendChild(buttonC);
    divP.appendChild(spanC);

    //Insert
    _i(nameBody).appendChild(divP);

}

function addAsignatureStudent(idAlumno,idMateria){
    let url = 'Logic/Controllers/StudentsController/addAsignatureStudent.php';
    let data = {
        idAlumno:idAlumno,
        idMateria:idMateria
    };
    fetch(url,{
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    }).then(function(){
        refreshAsignatures();
        refreshCardModal(idAlumno);
    });
}

function refreshAsignatures(){
    let ch = _i('freeAsignatures').firstElementChild;
    while(ch){
        ch.remove();
        ch = _i('freeAsignatures').firstElementChild;
    }
    let ch1 = _i('contentCards').firstElementChild;
    while(ch1){
        ch1.remove();
        ch1 = _i('contentCards').firstElementChild;
    }
}

function refreshCardModalAsignature(idMateria){
    let url = "Logic/Controllers/SignaturesController/modalAsignature.php";
    data = {
        idMateria:idMateria
    };
    fetch(url,{
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(datos=>datos.json()) 
    .then(function(datos){
        console.log(datos);
        let nombre = datos[0]["Name"];
        try{
            nombre.forEach(element => {
                console.log(element);
                let trA = document.createElement("tr");
                let tdA = document.createElement("td");
                let tdU = document.createElement("td")

                tdA.innerHTML = element.nombre + " " + element.apellidoPaterno + " " + element.apellidoMaterno;
                tdU.innerHTML = element.usuario;
                trA.appendChild(tdA);
                trA.appendChild(tdU);

                _i('bodyTableAsignaturesS').appendChild(trA);
            });
        }catch{

        }
    });
}
