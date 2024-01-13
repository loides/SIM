<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet</title>
  <script src="public/responsivity/responsivity.js"></script>
  <style>
    body {
      position: absolute;
      left: 50px;
      top: 10px;
      width: 70%
    }
    table {
      border-collapse: collapse;
      width: 100%;
      background-color: lightgrey;
    }
    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid green;
    }

    tr:hover {
      background-color: coral;
    }
    tr:nth-child(1):hover{
      background-color: lightyellow;
    }
  </style>
</head>

<body>
  <h1>Pet in the database</h1>
  <label id="msgStatus"></label>
  <input type="button" value="Add Pet" onclick="addPet();" style="margin:5px">
  
    <table id="tablePets">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Type</th>
          <th>Weight</th>
          <th>Date of Birth</th>
          <th>Location</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    
    <script>
    ajax_post_request("app.php?service=selectAllPets", "", function(result) {
      const pets = JSON.parse(result);
      var table = document.getElementById("tablePets");
      // debugger;
      if (pets.result == pets.resultTypes.SUCCESS) {
        pets.data.forEach((pet) => {
          var row = table.insertRow();
          row.insertCell().innerHTML = pet.id;
          row.insertCell().innerHTML = pet.name;
          row.insertCell().innerHTML = pet.type;
          row.insertCell().innerHTML = pet.weight;
          row.insertCell().innerHTML = pet.bornDate;
          row.insertCell().innerHTML = pet.location;

           let btnSee = document.createElement("button");
          btnSee.innerHTML = "See";
          btnSee.onclick = function() {
            seePet(pet.id)
          };

          let btnUpdate = document.createElement("button");
          btnUpdate.innerHTML = "Update";
          btnUpdate.onclick = function() {
            updatePet(pet.id)
          };

          let btnDelete = document.createElement("button");
          btnDelete.innerHTML = "Delete";    
          btnDelete.onclick = function() {
            deletePet(pet.id)
          };

          let actionsCell = row.insertCell();
          actionsCell.appendChild(btnSee);
          actionsCell.appendChild(btnUpdate);
          actionsCell.appendChild(btnDelete);
        });
      } else {
        document.getElementById("msgStatus").innerHTML = pets.msg;
      }
    });

    function addPet() {
      window.location.href = "app.php?service=showPetForm&MODE=INSERT";
    }

    function seePet(id) {
      window.location.href = `app.php?service=showPetForm&id=${id}&MODE=SEE`;
    }

    function updatePet(id) {
      window.location.href = `app.php?service=showPetForm&id=${id}&MODE=UPDATE`;
    }

    function deletePet(id) {
      window.location.href = `app.php?service=showPetForm&id=${id}&MODE=DELETE`;
    }


</script>

</body>
</html>
