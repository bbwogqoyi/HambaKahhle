<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <title></title>
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <link href="style1.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">

</head>
<?php 
    
    //add database credentials
    require_once("config.php");

    //store the ID from the previous page
    if(!isset($_COOKIE['ClientID']))
    {
    
    //connect to the database
    $connection = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database!");
    
    //issue the query instructions
    $query = "SELECT lastname, firstName,contactNumber,ClientID,email FROM clients WHERE ClientID = $id";
    $result = mysqli_query($connection, $query) or die("Could not retrieve data!");
    
    //get original details from database
    while ($row = mysqli_fetch_array($result)) {
       $lastname = $row['lastname']; 
       $firstname = $row['firstName']; 
       $contactnum = $row['contactNumber'];
       $clientid = $row['ClientID'];
       $email = $row['email'];
       
       
    }       
    
    //end the connection to the database
    mysqli_close($connection);   
    }
?>

<body class="bg-grey-100 h-screen font-sans">
  <form action="BonaniProfilepage.php" method="POST">
    <div class="container mx-auto h-full flex justify-center items-center">
      <div class="w-2/3 lg:w-1/3">
        <h1 class="font-light text-4xl mb-6 text-center">Profile Page</h1>
        <div class="border-blue-500 p-8 border-t-8 bg-white mb-6 rounded-lg shadow-lg">

          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Last Name
            </label>
            <input type="text" name="lastname" id="lastN"
                   class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
                   value="<?php echo $lastname; ?>" />
          </div>

          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              First Name
            </label>
            <input type="text" name="firstname" id="firstN"
                   class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
                   value="<?php echo $firstname; ?>" />
          </div>

          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Contact Number
            </label>
            <input type="text" name="contact_num" id="ConNum"
                   class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
                   value="<?php echo $contactnum; ?>" />
          </div>

          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Email
            </label>
            <input type="email" name="e_mail" id="Email"
                   class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
                   value="<?php echo $email; ?>" />
          </div>

          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              ClientID
            </label>
            <input type="email" name="client-id" id="client-id"
                   class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
                   value="<?php echo $clientid; ?>" />
          </div>

          <div class="flex items-center justify-between">
            <div class="inline-flex">
              <button class=" text-green-500 bg-white-600 hover:text-white hover:bg-green-500 font-bold py-2 px-4 rounded"> <a href="Update.php">
                Update
              </button>
              <button class="text-red-500 bg-white-600 hover:text-white hover:bg-red-500 font-bold py-2 px-4 rounded">
                Cancel
              </button>
            </div>
            <a class="no-underline inline-block align-baseline font-bold text-sm text-blue hover:text-blue-dark float-right" href="#">
              Forgot Password?
            </a>
          </div>

        </div>
        <div class="text-center">
          <p class="text-grey-dark text-sm">Don't have an account? <a href="#" class="no-underline text-blue font-bold">Create an Account</a>.</p>
        </div>
      </div>
    </div>
  </form>

  
</body>

</html>