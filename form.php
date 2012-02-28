<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" media="all" type="text/css" href="css/stylesheets/style.css"/>
        <title></title>
    </head>
    <body>
        
        <!-- Form test -->
        <div id="formErrors"></div>
        <form name="testForm" action="doValidate.php" method="post">
            
            <label for="formFirstName">First Name: </label>
            <input type="text" name="firstname" id="formFirstName" value="josh"/>
            <br />
            <label for="formEmail">Last Name: </label>
            <input type="email" name="email" id="formEmail"  value="frnak@.com"/>
            <br />
            <input type="hidden" name="hiddenField" id="formHidden" value="hid"/>
            <br />
            <label for="formPhone">Phone: </label>
            <input type="tel" name="phone" id="formPhone" required/>
            <br />
            <label for="formCountry">Country: </label>
            <input type="text" name="country" class="test" id="formCountry" pattern="[A-z]{3}" />
            <br />
            <label for="formZip">Zip Code: </label>
            <input type="number" name="zip" id="formZip" min="10000" max="50000" data-validate="zipcode" required/>
            <br />
            <label for="formGender">Gender: </label>
            <input type="checkbox" name="gender" id="formGender"/>
            <br />
            <input type="submit" name="formSubmit" />
        </form>
        
        
        
    </body>
</html>
