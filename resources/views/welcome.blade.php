<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>FrontDesk</title>

        <!-- jQuery core -->
        <script src="{{asset('vendor/jquery/jquery-3.1.1.min.js')}}"></script>

        <!-- Bootstrap core-->
        <link rel="stylesheet" href="{{asset('vendor/bootstrap4-alpha/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="./vendor/font-awesome-4.7.0/css/font-awesome.min.css">
        <script src="{{asset('vendor/bootstrap4-alpha/js/bootstrap.min.js')}}"></script>

        <!-- Custom styles for this template -->
        <link href="{{asset('assets/css/logIn.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/utilities.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/win8loader.css')}}" rel="stylesheet">

        <style>

        </style>
    </head>
    <body>
        <div class="container">
            <div class = "adminform row justify-content-center" style="height: 100vh;">
                <form autocomplete="off" role="form" method="post" action = "../php1/front_desk/frontdesk_logon.php" class="align-self-center">
                    <div class="formhd text-center px-4 pt-4">
                        <img  class = "" width = 110px height = 100px src = "assets/img/icon.png"/>
                        
                        <img  class = "my-4 ml-2" width = 280px height = 65px src = "assets/img/title.png"/>
                        <div class="row mb-4 pb-2">
                            <input type="text" name="username" class="form-control text-center font-fam-Montserrat-bold inputcolor" required id="username" required value = "Username" placehd = "Username"/>
                            <input type="text" name="password" class="form-control text-center font-fam-Montserrat-bold inputcolor" id="password" value="Password" required placehd = "Password"/>
                            <button type="submit" class="btn btn-lg w-100 font-fam-Myriad mt-2" name="B1" style="" onclick="login();">Sign In </button> 
                        </div>
                    </div>
                    <div class="row justify-content-center pb-5" style="height:120px;">
                        <div style = "margin-top:-20px;" class="text-center row w-100 justify-content-center" ><img id="sendGif" class=""  style = "" src="assets/img/loadersquash1.gif" width="100px" height="100px" />
                        </div>
                        <div class="row justify-content-center w-100" style="margin-top:-66px !important;" >
                            <p id="output" class="str text-center " style="opacity:.8; font-size:17px; font-weight: 700" ><?php $output = ""; if(array_key_exists("output", $_GET)){
                                $output = $_GET["output"] ? $_GET["output"] : "";
                            } echo "<script type = 'text/javascript'>
            jQuery(function(){
            jQuery('#sendGif').toggleClass('notvisible');
            if('$output' != ''){
            if ('$output' != 'Authorization Granted') {
                jQuery('#output').css('color', '#333');
            } else {
                jQuery('#output').css('color', '#333');
            }
            jQuery('#output').text('$output').fadeTo('slow', .8).delay(4000)
            .fadeTo('slow', 0,function(){
            jQuery('#output').text('');
            });
            jQuery('.btn').prop('disabled', false);}
            });</script>" ?></p>
                        </div>
                    </div>
                   
                </form>
            </div>
        </div>
        <footer class="f-12">
            <p class = "text-center"><?php echo date('Y') ?></p>
        </footer>
    </body>
    <script>
        $(document).ready(function () {
            $("input").on("focus", function(){
                console.log($(this).attr("placehd"));
                if($(this).val()==$(this).attr("placehd")){
                    $(this).val("");
                    $(this).toggleClass("inputcolor");
                    $(this).attr("placehd") == "Password" ? $(this).attr("type", "password") : null;
                }
            }); 
            $("input").on("blur", function(){
                console.log($(this).attr("placehd"));
                if($(this).val()==""){
                    $(this).val($(this).attr("placehd"));
                    $(this).toggleClass("inputcolor");
                    $(this).attr("placehd") == "Password" ? $(this).attr("type", "text") : null;
                }
            });
        });
        function login(){
            if($("#username").val() != "" && $("#password").val() != ""){
                jQuery('#sendGif').toggleClass('notvisible');
            }
        }

    </script>
</html>
