<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global_style.css">
    <title>Zink ChitChat</title>
    <!-- <link rel="icon" type="image/svg+xml" href="ICONS/shot.svg"> -->
    <link rel="icon" type="image/svg+xml" href="ICONS/logo.png">

</head>

<body>
   <div id="wrapper1">
       <div id="header1">
           Zink ChitChat
           <div id="divSignup"> Sign up </div> 
       </div>
       <div id="error"> 
           

       </div>
       <form id="myform">
           <input type="text"   name="firstname" id="" placeholder="Firstname"> <br>
           <input type="text"   name="lastname"  id=""     placeholder="Lastname"> <br>
           <input type="text"   name="username"  id=""     placeholder="Username"> <br>
           <input type="text"   name="email"     id=""     placeholder="email"> <br>
           <input type="date"   name="birthday"  id=""     placeholder="birthday"> <br>
           <input type="text"   name="number"    id=""       placeholder="mobile no." maxlength="13" > <br>
  
           <div style="padding: 10px;">
           <br> Sex: <br>
           <input type="radio" value="male" name="gender">Male<br>
           <input type="radio" value="female" name="gender" >Female<br>

           
           </div>
           <input type="password" name="password" id="" placeholder="Password"> <br>
           <input type="password" name="password2" id="" placeholder="Retype Password"> <br>
           <input type="button" value="Sign up" id="signup_button"> <br>
           <br>
            <a href="login.php" style="display: block; text-align: center; text-decoration:none;">
                Already have an Account? Login here.
            </a>
       </form>
   </div>
</body>

</html>
<script>
    function _(element){
         return document.getElementById(element);
    }
    var signup_button = _("signup_button");
    signup_button.addEventListener("click", collect_data);

    function collect_data(){

        signup_button.disabled=true;
        signup_button.value="loading...please wait...";

        var myform = _("myform");
        var inputs = myform.getElementsByTagName("INPUT");
        var data = {};
        for(var i= inputs.length -1; i>=0; i--){
            var key = inputs[i].name;

            switch(key){
                case "firstname":
                    data.firstname = inputs[i].value;
                    break;
                case "lastname":
                    data.lastname = inputs[i].value;
                    break;
                case "username":
                    data.username = inputs[i].value;
                    break;
                case "birthday":
                    data.birthday = inputs[i].value;
                    break;
                case "number":
                    data.number = inputs[i].value;
                    break;
                    
                    
                case "gender":
                case "gender":
                    if(inputs[i].checked){
                        data.gender = inputs[i].value;
                    }
                    break;

                case "email":   
                    data.email = inputs[i].value;
                    break;

                case "password":
                    data.password = inputs[i].value;
                    break;
                case "password2":
                    data.password2 = inputs[i].value;
                    break;

            }
        }

        send_data(data,"signup");
        
    }

    function send_data(data,type){
        var xml = new XMLHttpRequest();
        xml.onload = function(){
            if(xml.readyState == 4 || xml.status == 200){
                handle_result(xml.responseText);
                signup_button.disabled=false;
                signup_button.value="Signup";
            }
        }
        data.data_type = type;
        var data_string = JSON.stringify(data) //only string accept the internet so need to parse to string.

        xml.open("POST", "api.php", true);
        xml.send(data_string);
        
    }
    function handle_result(result)
    {
        // alert(result);
        var data = JSON.parse(result);
        if(data.data_type == "info"){
            window.location ="index1.php";
        }else{
            var error = _("error");
            error.innerHTML = data.message;
            error.style.display = "block";
        }
    }
    
</script>