<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="public/responsivity/responsivity.js"></script>

</head>

<body style="left:100px; top:100px; width:70%; padding:50px; background-color:gray">
    <label id="msgStatus" style="margin-bottom:5px; padding:5px; background-color:burlywood; display:none;"></label>
    <form id="form" style="padding:50px; background-color:darkcyan">
        <div class="form-group row">
            <label for="name" class="col-4 col-form-label">Name</label>
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-address-card-o"></i>
                        </div>
                    </div>
                    <input id="name" name="name" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="type" class="col-4 col-form-label">Type</label>
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <!-- Update the icon for 'type' -->
                            <i class="fa fa-paw"></i>
                        </div>
                    </div>
                    <input id="type" name="type" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="weight" class="col-4 col-form-label">Weight</label>
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <!-- Update the icon for 'weight' -->
                            <i class="fa fa-balance-scale"></i>
                        </div>
                    </div>
                    <input id="weight" name="weight" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="bornDate" class="col-4 col-form-label">Data of Birth</label>
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                    <input id="bornDate" name="bornDate" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="location" class="col-4 col-form-label">Location</label>
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-map-marker"></i>
                        </div>
                    </div>
                    <input id="location" name="location" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button type="button" id="button" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <input type="hidden" id="id" name="id" value="-1"> <!-- pet id -->
    </form>


    <script>

        function submitNewPetData() {
            const form = document.getElementById('form');
            const formData = new FormData(form);

            ajax_post_request("app.php?service=insertPetFromView", formData,
                function success(result) {
                    console.log(result);
                    const requestResult = JSON.parse(result);

                    if (requestResult.result == requestResult.resultTypes.SUCCESS) {
                        document.getElementById("msgStatus").innerHTML = "Inserted pet with id = " + requestResult.id;
                        document.getElementById("msgStatus").style.display = "block";
                        document.getElementById('button').innerText = "Go back";
                        document.getElementById('button').onclick = function() {
                            window.location.href = "app.php?service=showPetsAsTable";
                        };
                    } else {
                        document.getElementById("msgStatus").innerHTML = requestResult.msg;
                        document.getElementById("msgStatus").style.display = "block";
                    }
                },
                function error(error) {
                    document.getElementById("msgStatus").innerHTML = error;
                    document.getElementById("msgStatus").style.display = "block";
                });
        }

        function fetchPet(id) {
            ajax_post_request("app.php?service=selectPet&id=" + id , "",
                function success(result) {
                    console.log(result);
                    const requestResult = JSON.parse(result);

                    if (requestResult.result == requestResult.resultTypes.SUCCESS) {
                        document.getElementById("msgStatus").innerHTML = "Got pet with id = " + requestResult.data[0].id;
                        document.getElementById("msgStatus").style.display = "block";

                        document.getElementById("id").value= requestResult.data[0].id;
                        document.getElementById("name").value= requestResult.data[0].name;
                        document.getElementById("type").value= requestResult.data[0].type;
                        document.getElementById("weight").value= requestResult.data[0].weight;
                        document.getElementById("bornDate").value= requestResult.data[0].bornDate;
                        document.getElementById("location").value= requestResult.data[0].location;

                    } else {
                        document.getElementById("msgStatus").innerHTML = requestResult.msg;
                        document.getElementById("msgStatus").style.display = "block";
                    }
                },
                function error(error) {
                    document.getElementById("msgStatus").innerHTML = error;
                    document.getElementById("msgStatus").style.display = "block";
                });
        }

        function updatePet() {
            const form = document.getElementById('form');
            const formData = new FormData(form);

            ajax_post_request("app.php?service=updatePet", formData,
                function success(result) {
                    console.log(result);
                    const requestResult = JSON.parse(result);

                    if (requestResult.result == requestResult.resultTypes.SUCCESS) {
                        document.getElementById("msgStatus").innerHTML = "Updated pet with id = " + requestResult.id;
                        document.getElementById("msgStatus").style.display = "block";
                        document.getElementById('button').innerText = "Go back";
                        document.getElementById('button').style.backgroundColor="Blue";
                        document.getElementById('button').onclick = function() {
                            window.location.href = "app.php?service=showPetAsTable";
                        };
                    } else {
                        document.getElementById("msgStatus").innerHTML = requestResult.msg;
                        document.getElementById("msgStatus").style.display = "block";
                    }
                },
                function error(error) {
                    document.getElementById("msgStatus").innerHTML = error;
                    document.getElementById("msgStatus").style.display = "block";
                });
        }

        function deletePet(id) {
            ajax_post_request("app.php?service=deletePet&id=" + id , "",
                function success(result) {
                    console.log(result);
                    const requestResult = JSON.parse(result);

                    if (requestResult.result == requestResult.resultTypes.SUCCESS) {
                        document.getElementById("msgStatus").innerHTML = "Deleted pet with id = " + requestResult.id;
                        document.getElementById("msgStatus").style.display = "block";
                        document.getElementById('button').innerText = "Go back";
                        document.getElementById('button').style.backgroundColor="Blue";
                        document.getElementById('button').onclick = function() {
                            window.location.href = "app.php?service=showPetsAsTable";
                        };
                    } else {
                        document.getElementById("msgStatus").innerHTML = requestResult.msg;
                        document.getElementById("msgStatus").style.display = "block";
                    }
                },
                function error(error) {
                    document.getElementById("msgStatus").innerHTML = error;
                    document.getElementById("msgStatus").style.display = "block";
                });
        }

        const QueryString = window.location.search;
        const urlParams = new URLSearchParams(QueryString);
        var mode = "";
        var id="";  
        // debugger;
        if (urlParams.get('MODE') !== null) {
            mode = urlParams.get('MODE');
            if (mode === "INSERT" ) {
                document.getElementById('name').readOnly = false;
                document.getElementById('type').readOnly = false;
                document.getElementById('weight').readOnly = false;
                document.getElementById('bornDate').readOnly = false;
                document.getElementById('location').readOnly = false;
                document.getElementById('button').innerText = "Add";
                document.getElementById('button').onclick = submitNewPetData;
            } 
            else if (mode === "SEE") {
                document.getElementById('name').readOnly = true;
                document.getElementById('type').readOnly = true;
                document.getElementById('weight').readOnly = true;
                document.getElementById('bornDate').readOnly = true;
                document.getElementById('location').readOnly = true;
                document.getElementById('button').innerText = "Go back";
                document.getElementById('button').onclick = function() {
                    window.location.href = "app.php?service=showPetsAsTable";
                };
            }
            else if (mode === "UPDATE" ) {  
                document.getElementById('name').readOnly = false;
                document.getElementById('type').readOnly = false;
                document.getElementById('weight').readOnly = false;
                document.getElementById('bornDate').readOnly = false;
                document.getElementById('location').readOnly = false;
                document.getElementById('button').innerText = "Update";
                document.getElementById('button').style.backgroundColor="red"; 
                document.getElementById('button').onclick = updatePet;
            }
            else if (mode === "DELETE") {
                document.getElementById('name').readOnly = true;
                document.getElementById('type').readOnly = true;
                document.getElementById('weight').readOnly = true;
                document.getElementById('bornDate').readOnly = true;
                document.getElementById('location').readOnly = true;
                document.getElementById('button').innerText = "DELETE";
                document.getElementById('button').style.backgroundColor="red"; 
                id = urlParams.get('id');
                document.getElementById('button').onclick = function() { deletePet(id); };
            }

            if(mode==="UPDATE" || mode==="SEE" || mode==="DELETE") {
                id = urlParams.get('id');
                fetchPet(id);
            }

        }

    </script>

    

</body>

</html>
