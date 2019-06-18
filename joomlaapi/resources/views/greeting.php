<html>
    <head>
        <title>Тестовая страница</title>
    </head>
    <body>
        <h1>[url]/change_password</h1>
        <form method="post" action="/public/change_password" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="password">password</label>
            <input type="text" name="password" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/login</h1>
        <form method="post" action="/public/login" >
            <label for="uid">email</label>
            <input type="text" name="email" />
            <label for="password">password</label>
            <input type="text" name="password" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/register</h1>
        <form method="post" action="/public/register" >
            <label for="name">name</label>
            <input type="text" name="name" />
            <label for="email">email</label>
            <input type="text" name="email" />
            <label for="password">password</label>
            <input type="text" name="password" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/remind_pass</h1>
        <form method="post" action="/public/remind_pass" >
            <label for="email">email</label>
            <input type="text" name="email" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/send_restore_code</h1>
        <form method="post" action="/public/send_restore_code" >
            <label for="username">username</label>
            <input type="text" name="username" />
            <label for="code">code</label>
            <input type="text" name="code" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/basket</h1>
        <form method="post" action="/public/basket" >
            <label for="uid">uid</label>
            <input type="text" name="uid" />
            <input type="submit" name="submit" value="submit" />
        </form>
    </body>
</html>