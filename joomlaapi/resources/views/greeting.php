<html>
    <head>
        <title>Тестовая страница</title>
    </head>
    <body>
        
        <h1>[url]/place_order</h1>
        <form method="post" action="/place_order" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/><br />
            <label for="first_name">first_name</label>
            <input type="text" name="first_name"/><br />
            <label for="middle_name">middle_name</label>
            <input type="text" name="middle_name"/><br />
            <label for="last_name">last_name</label>
            <input type="text" name="last_name"/><br />
            <label for="countryid">countryid</label>
            <input type="text" name="countryid"/><br />
            <label for="stateid">stateid</label>
            <input type="text" name="stateid"/><br />
            <label for="city">city</label>
            <input type="text" name="city"/><br />
            <label for="zip">zip</label>
            <input type="text" name="zip"/><br />
            <label for="address_1">address_1</label>
            <input type="text" name="address_1"/><br />
            <label for="address_2">address_2</label>
            <input type="text" name="address_2"/><br />
            <label for="phone1">phone1</label>
            <input type="text" name="phone1"/><br />
            <label for="phone2">phone2</label>
            <input type="text" name="phone2"/><br />
            <label for="payment_type">payment_type</label>
            <input type="text" name="payment_type"/><br />
            <label for="ship_type">ship_type</label>
            <input type="text" name="ship_type"/><br />
            <label for="info">info</label>
            <input type="text" name="info"/><br />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/product</h1>
        <form method="get" action="/product" >
            <label for="productid">productid</label>
            <input type="text" name="id"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/update_user</h1>
        <form method="post" action="/update_user" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/><br />
            <label for="first_name">first_name</label>
            <input type="text" name="first_name"/><br />
            <label for="middle_name">middle_name</label>
            <input type="text" name="middle_name"/><br />
            <label for="last_name">last_name</label>
            <input type="text" name="last_name"/><br />
            <label for="countryid">countryid</label>
            <input type="text" name="countryid"/><br />
            <label for="stateid">stateid</label>
            <input type="text" name="stateid"/><br />
            <label for="city">city</label>
            <input type="text" name="city"/><br />
            <label for="zip">zip</label>
            <input type="text" name="zip"/><br />
            <label for="address_1">address_1</label>
            <input type="text" name="address_1"/><br />
            <label for="address_2">address_2</label>
            <input type="text" name="address_2"/><br />
            <label for="phone1">phone1</label>
            <input type="text" name="phone1"/><br />
            <label for="phone2">phone2</label>
            <input type="text" name="phone2"/><br />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/user_info</h1>
        <form method="get" action="/user_info" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/search</h1>
        <form method="get" action="/search" >
            <label for="search">search</label>
            <input type="text" name="search"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/catalog</h1>
        <form method="get" action="/catalog" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="limit">limit</label>
            <input type="text" name="limit"/>
            <label for="offset">offset</label>
            <input type="text" name="offset"/>
            <label for="categoryid">categoryid</label>
            <input type="text" name="categoryid"/>
            <label for="sort">sort</label>
            <input type="checkbox" name="sort"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/sub_categories</h1>
        <form method="get" action="/sub_categories" >
            <label for="category">category</label>
            <input type="text" name="categoryid"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/banners</h1>
        <form method="get" action="/banners" >
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/same_items</h1>
        <form method="get" action="/same_items" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="page">page</label>
            <input type="text" name="page"/>
            <label for="item_id">item_id</label>
            <input type="text" name="item_id"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/recent_viewed</h1>
        <form method="get" action="/recent_viewed" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/hits</h1>
        <form method="get" action="/hits" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/new_items</h1>
        <form method="get" action="/new_items" >
            <label for="offset">offset</label>
            <input type="text" name="offset"/>
            <label for="limit">limit</label>
            <input type="text" name="limit"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        
        <h1>[url]/discounts</h1>
        <form method="get" action="/discounts" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="page">page</label>
            <input type="text" name="page"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/popular</h1>
        <form method="get" action="/popular" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/basket_change_quantity</h1>
        <form method="post" action="/basket_change_quantity" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="id">id product</label>
            <input type="text" name="item_id" />
            <label for="id">quantity</label>
            <input type="text" name="quantity" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/basket_remove_item</h1>
        <form method="post" action="/basket_remove_item" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="id">id product</label>
            <input type="text" name="item_id" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/basket_add</h1>
        <form method="post" action="/basket_add" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="id">id product</label>
            <input type="text" name="id" />
            <label for="id">quantity</label>
            <input type="text" name="quantity" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/basket</h1>
        <form method="get" action="/basket" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/change_password</h1>
        <form method="post" action="/change_password" >
            <label for="uid">uid</label>
            <input type="text" name="uid"/>
            <label for="password">password</label>
            <input type="text" name="password" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/login</h1>
        <form method="post" action="/login" >
            <label for="uid">email</label>
            <input type="text" name="email" />
            <label for="password">password</label>
            <input type="text" name="password" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/register</h1>
        <form method="post" action="/register" >
            <label for="name">name</label>
            <input type="text" name="name" />
            <label for="email">email</label>
            <input type="text" name="email" />
            <label for="password">password</label>
            <input type="text" name="password" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/remind_pass</h1>
        <form method="post" action="/remind_pass" >
            <label for="email">email</label>
            <input type="text" name="email" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/send_restore_code</h1>
        <form method="post" action="/send_restore_code" >
            <label for="username">username</label>
            <input type="text" name="username" />
            <label for="code">code</label>
            <input type="text" name="code" />
            <input type="submit" name="submit" value="submit" />
        </form>
        
        <h1>[url]/basket</h1>
        <form method="post" action="/basket" >
            <label for="uid">uid</label>
            <input type="text" name="uid" />
            <input type="submit" name="submit" value="submit" />
        </form>-->
        
    </body>
</html>