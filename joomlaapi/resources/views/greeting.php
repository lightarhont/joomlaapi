<html>
    <head>
        <title>Тестовая страница</title>
    </head>
    <body>
        
        <h1>[url]/catalog</h1>
        <form method="get" action="/public/catalog" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="limit">limit</label>
            <input type="text" name="limit"/>
            <label for="offset">offset</label>
            <input type="text" name="offset"/>
            <label for="categoryid">categoryid</label>
            <input type="text" name="categoryid"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/sub_categories</h1>
        <form method="get" action="/public/sub_categories" >
            <label for="category">category</label>
            <input type="text" name="categoryid"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/banners</h1>
        <form method="get" action="/public/banners" >
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/same_items</h1>
        <form method="get" action="/public/same_items" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="page">page</label>
            <input type="text" name="page"/>
            <label for="item_id">item_id</label>
            <input type="text" name="item_id"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/recent_viewed</h1>
        <form method="get" action="/public/recent_viewed" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/hits</h1>
        <form method="get" action="/public/hits" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/new_items</h1>
        <form method="get" action="/public/new_items" >
            <label for="offset">offset</label>
            <input type="text" name="offset"/>
            <label for="limit">limit</label>
            <input type="text" name="limit"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        
        <h1>[url]/discounts</h1>
        <form method="get" action="/public/discounts" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="page">page</label>
            <input type="text" name="page"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/popular</h1>
        <form method="get" action="/public/popular" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/basket_change_quantity</h1>
        <form method="post" action="/public/basket_change_quantity" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="id">id product</label>
            <input type="text" name="item_id" />
            <label for="id">quantity</label>
            <input type="text" name="quantity" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/basket_remove_item</h1>
        <form method="post" action="/public/basket_remove_item" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="id">id product</label>
            <input type="text" name="item_id" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/basket_add</h1>
        <form method="post" action="/public/basket_add" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="id">id product</label>
            <input type="text" name="id" />
            <label for="id">quantity</label>
            <input type="text" name="quantity" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/basket</h1>
        <form method="get" action="/public/basket" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
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
        </form>-->
        
    </body>
</html>