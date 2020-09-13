<body class="bg-grey-100 h-screen font-sans">
  <div class="container mx-auto h-full flex justify-center items-center">
    <div class="w-2/3 lg:w-1/3">
      <h1 class="font-light text-4xl mb-6 text-center">Register</h1>
      <form id="newUserForm" onsubmit="return validateRegistation();">
        <div class="border-blue-500 p-8 border-t-8 bg-white mb-6 rounded-lg shadow-lg">
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              ID Number
            </label>
            <input type="text" id="idNum" name="idNum"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="930601 XXXX 082" />
          </div>
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Name
            </label>
            <input type="text" id="firstname" name="firstname"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="Nkosinathi" />
          </div>
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Lastname
            </label>
            <input type="text" id="lastname" name="lastname"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="Nkomo" />
          </div>
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Email
            </label>
            <input type="text" id="email" name="email"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="n.nkomo@campus.ru.ac.za" />
          </div>
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Contact Number
            </label>
            <input type="number" id="contact" name="contact"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="076 XXX XX87" />
          </div>
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Password
            </label>
            <input type="password" id="password" name="password"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="Password" />
          </div>
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Confirm Password
            </label>
            <input type="password" id="confirm_password" name="confirm_password"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="Password" />
          </div>
          <div class="inline-flex">
            <div class="flex items-center">
              <button id="newUser" name="newUser" class="bg-blue-600 hover:bg-teal text-white font-bold py-2 px-4 rounded">
                Register
              </button>
            </div>
            <div class="flex items-center ml-2">
              <button type="button" class="bg-red-600 hover:bg-teal text-white font-bold py-2 px-4 rounded">
                Cancel
              </button>
            </div>
          </div>
        </div>
      </form>
      <div class="text-center">
        <p class="text-grey-dark text-sm">Already have an account? <a href="#"
            class="no-underline text-blue font-bold">Sign In</a>.</p>
      </div>
    </div>
  </div>
</body>
<script>
  var validateRegistation = function() {
    var isValid = inputValidator
      .getElementById("idNum")
      .exactNumberOfDigits(13)
      .getState();
    
    isValid = 
      inputValidator
      .getElementById("firstname")
      .isNotEmptyOrWhitespace()
      .getState()
      && isValid;
  
    isValid =
      inputValidator
      .getElementById("lastname")
      .isNotEmptyOrWhitespace()
      .getState()
      && isValid;

    isValid =
      inputValidator
      .getElementById("email")
      .emailFormat()
      .getState()
      && isValid;
    
    isValid = 
      inputValidator
      .getElementById("contact")
      .predicate(
        function(value) {
          return value!==undefined && length>=10 && value.length<12;
        }
      )
      .getState()
      && isValid;

    isValid = 
      inputValidator
      .getElementById("password")
      .isNotEmptyOrWhitespace()
      .getState()
      && isValid;
      
    isValid = 
      inputValidator
      .getElementById("confirm_password")
      .matchingValue(document.getElementById('password').value)
      .getState()
      && isValid;
    
    if(isValid) document.getElementById("newUserForm").submit();
    return isValid;
  }
</script>
