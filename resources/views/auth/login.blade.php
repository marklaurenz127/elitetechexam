<!doctype html>
<html lang="en">
 
<head>
    @include('includes.head')
    <style>
    html, body {
        height: 100%;
    }
    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #333333;
    }
    </style>
</head>

<body>
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="javascript:void(0)"></a><span class="splash-description">Login</span></div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="">Enter your username</label>
                        <input class="form-control form-control-lg" id="username" type="text" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">Enter your password</label>
                        <input class="form-control form-control-lg" id="password" type="password" placeholder="Password">
                    </div>
                    <p class="text-center" id="errorlbl" style="color: red; display: none!important"></p>
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="login">Sign in</button>
                </form>
            </div>
        </div>
    </div>
    @include('includes.foot')
    <script>
        $(document).ready(function(){
            $('#login').click(function(){
                $.post('/auth/login',{
                    username: $('#username').val(),
                    password: $('#password').val(),
                }, function(data){
                    if(data.status){
                        window.location.href = "/";
                    }else{
                        alert(data.msg);
                    }
                }, 'json');
            });
        });
    </script>
</body>
 
</html>