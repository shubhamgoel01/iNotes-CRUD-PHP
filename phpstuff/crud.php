<?php
$insert = false;
$update = false;
$delete = false;
include 'cruddb.php';
if(isset($_GET['delete'])){
    $sno = $_GET['delete']; 
    //  YNHA -> delete ,GET method k URl se aara ->`/phpstuff/crud.php?delete=${sno}`;   
    // echo $sno;
    $delete = true;
    $sql = "DELETE FROM `notes` WHERE `sno` = '$sno' ";
    $result = mysqli_query($conn, $sql);
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // echo $_SERVER['REQUEST_METHOD'] ;     iska output -----POST ------aayga 
    if(isset($_POST['snoEdit'])){
        $sno = $_POST['snoEdit'];   
        $title = $_POST['titleEdit'];
        $description = $_POST['descEdit'];  
        // echo $sno;      
        // echo "<br>".$title;      
        // echo "<br>".$description;    
        $sql = "UPDATE `notes` SET `title` = '$title' ,`description` = '$description' WHERE `notes`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if($result){
            $update = true;
        }
        else{
            echo 'Updation failed ' . mysqli_error();
        }
    }  
    else{
        $title = $_POST['title'];
        $description = $_POST['desc'];
        // echo $title;
        // echo $description;
        $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')" ;
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $insert = true;
        } else {
            echo 'inserted failed ' . mysqli_error();
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

    <title>iNotes</title>
  
</head>

<body>
<!-- --------------------------edit modal ---------------> 
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit this Node</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

    <form action="/phpstuff/crud.php" method="post">
        <div class="modal-body">
        <!-- -------------------snoEdit hidden pass------------ -->
            <input type="hidden" name="snoEdit" id="snoEdit"> 
            <!-- .................titleEdit............... -->
            <div class="mb-3">
                <label for="title" class="form-label">Notes Title</label>
                <input type="text" class="form-control" id="titleEdit" name="titleEdit">
            </div>
            <!-- ................descEdit............ -->
            <div class="mb-3">
                <label for="desc " class="form-label">Notes Descriptions</label>
                <textarea class="form-control" id="descEdit" name="descEdit" rows="3"></textarea>
            </div>                
        </div>
        <div class="modal-footer d-block mr-auto">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
    </div>
  </div>
</div>

<!---------------------- --Navbar -------------------------->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="/phpstuff/phplogo.svg" height="40px" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact-Us</a>
                    </li>


                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
   <!-- -------------- ----alert--------------- -->
<?php
    if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>success!! </strong> Your note has inserted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    if($update){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>success!! </strong> Your note has Updated successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    if($delete){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>success!! </strong> Your note has Deleted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
?>

<!-- -----------------------add note form--------------- -->
    <div class="container my-4"> 
        <h2>Add a Note to iNotes</h2>
        <form action="/phpstuff/crud.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Notes Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="desc " class="form-label">Notes Descriptions</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>

<!--------------------------table------------------------------->
    <div class="container my-4">      
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM `notes`";
                    $result = mysqli_query($conn, $sql);
                    $sno = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sno = $sno + 1;
                       echo " <tr>  
                                <th scope='row'> " .$sno. "</th>
                                <td>" .$row['title']." </td>
                                <td> ".$row['description']." </td>
                                <td><button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button>  <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button> </td>
                             </tr> ";                        
                    }
                ?>
                       
            </tbody>
        </table>
    </div>
    <hr>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
            element.addEventListener("click",(e)=>{
                console.log("edit e",e);
                console.log("edit etarget",e.target);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName('td')[0].innerText;
                description = tr.getElementsByTagName('td')[1].innerText;
                console.log(title,description);
                $('#editModal').modal('toggle');
                titleEdit.value = title;
                descEdit.value = description;
                snoEdit.value = e.target.id;
                console.log(snoEdit.value);         
              })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element)=>{
            element.addEventListener("click",(e)=>{
                sno = e.target.id.substr(1,);                                         
                console.log(sno);                           
                if(confirm("Are you sure?")){
                    window.location = `/phpstuff/crud.php?delete=${sno}`;     
                }
                else{
                    console.log("No");
                }
            })
        })
    
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>

</html>