<?php
error_reporting(0);
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id))
{
    header('location:login.php');
}
if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    $select_category_query = mysqli_query($conn, "SELECT category_name FROM `category` WHERE `id` = '$category_id'");
    $delete_category_query = mysqli_query($conn, "DELETE FROM `category` WHERE category_id = '$category_id'") or die ('query failed');

    header('location:admin_categories.php');
 }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>    
    <!-- website_icon  -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- bootstrap css file link  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="css/category_seperate_style.css">

</head>
<body>
    
    <?php include 'admin_header.php'; ?>
    
    <!--Display Category List-->
    
    <div class="container">
        <div class="border border-dark p-2">
            <div class="mob-table">
            <h1>Categories</h1>
            <a href="add_category.php" class="btn add">Add Category</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $select_category = mysqli_query($conn, "SELECT * FROM `category`") or die('query failed');
                        if(mysqli_num_rows($select_category) > 0)
                            {
                                while($fetch_category = mysqli_fetch_assoc($select_category))
                                {
                                    echo 
                                        "<tr>
                                            <td>" . $fetch_category['category_name'] . "</td>
                                            <td> 
                                                <a href ='admin_categories.php?category_id=" . $fetch_category['category_id'] . " 'class='btn delete 'onclick='return confirm('Delete this Category?');'>Delete</a>      
                                                <a href ='update_category.php?category_id=" . $fetch_category['category_id'] . " 'class='btn update' >Update</a> 
                                                                    
                                            </td>
                                        </tr>";
                                }
                        }else{
                                    echo '<p class="empty">No categories added yet!</p>';
                                }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>


</body>
</html>