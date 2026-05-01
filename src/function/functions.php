<?php

function update1($a, $b, $c)
{
    include("connection.php");
    $con->query("UPDATE orderhistory set admindec='$a' ,quantity='$c' where his_id='$b'");
}
function update2($x, $y)
{
    include("connection.php");
    $con->query("UPDATE closet set instock='$x' where clo_id='$y'");
}
function update4($his_id, $dec)
{
    include("connection.php");
    $con->query("UPDATE orderhistory set admindec='$dec' where his_id='$his_id'");
}

function update3($dec, $cus_id, $or_date)
{
    include("connection.php");
    $result = $con->query("SELECT * FROM orderhistory JOIN closet ON closet.clo_id=orderhistory.clo_id JOIN customers ON customers.cus_id=orderhistory.cus_id where admindec='Pending' and orderhistory.or_date='$or_date' and orderhistory.cus_id='$cus_id' ");
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            update4($row["his_id"], $dec);
        }
    }
}
function pendingitemks()
{
    include("connection.php");
    $pendKS = 0;
    $result = $con->query("SELECT orderprice FROM orderhistory where admindec='Pending'  ");
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pendKS += $row["orderprice"];
        }
    }
    return $pendKS;
}

function acceptitemks()
{
    include("connection.php");
    $acceptKS = 0;
    $result = $con->query("SELECT orderprice FROM orderhistory where admindec='Accept'  ");
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $acceptKS += $row["orderprice"];
        }
    }
    return $acceptKS;
}


function itemcount()
{
    include("connection.php");
    $itemcount = 0;
    $result = $con->query("SELECT * FROM closet group by type ");
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $itemcount++;
        }
    }
    return $itemcount;
}


function userscount()
{
    include("connection.php");
    $userscount = 0;
    $result = $con->query("SELECT * FROM customers   ");
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userscount++;
        }
    }
    return $userscount;
}


function adminsize($clo_id, $small, $medium, $large, $xl, $xxl)
{
    include("connection.php");
    $con->query("UPDATE size set Small='$small',Medium='$medium',Large='$large',XL='$xl' ,XXL='$xxl' where clo_id=$clo_id");
}

function update($a, $b)
{
    include("connection.php");
    $con->query("UPDATE closet set instock='$a' where clo_id='$b'");
}
function profileimgvalidate($user_id)
{
    include("connection.php");
    $result = $con->query("SELECT * FROM customers  WHERE cus_id=$user_id");
    if (!empty($result) && $result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            if (empty($row["per_img"])) {
                return false;
            }
            if (isset($row["per_img"])) {
                return true;
            }
        }
    }
}



function sizeid()
{
    include("connection.php");
    $result = $con->query("SELECT * FROM closet order by clo_id desc");
    if (!empty($result) && $result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            return $row["clo_id"];
        }
    }
}

function size($small, $medium, $large, $XL, $XXL)
{
    include("connection.php");
    $id = sizeid();
    $con->query("INSERT INTO size (clo_id,Small,Medium,Large,XL,XXL) VALUES ('$id','$small','$medium','$large','$XL','$XXL')");
}

function sizeupdate($xxx, $left, $clo_id)
{
    include("connection.php");
    $con->query("UPDATE size set $xxx=$left  where clo_Id=$clo_id");
}

function removeitemfromcart($xxx, $yyy, $clo_id)
{
    include("connection.php");

    $result = $con->query("SELECT $xxx,clo_id from size  where clo_Id=$clo_id");
    if (!empty($result) && $result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            $left = $row[$xxx] + $yyy;

            echo $row[$xxx];
            echo $left;

            sizeupdate($xxx, $left, $row["clo_id"]);
        }
    }
}
function sizeretri($xxx, $yyy, $clo_id)
{
    include("connection.php");

    $result = $con->query("SELECT $xxx,clo_id from size  where clo_Id=$clo_id");
    if (!empty($result) && $result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            $left = $row[$xxx] - $yyy;

            echo $row[$xxx];
            echo $left;

            sizeupdate($xxx, $left, $row["clo_id"]);
        }
    }
}

function updatequanity($xxx, $clo_id) {}
function sizequantity($xxx, $clo_id)
{
    include("connection.php");

    $result = $con->query("SELECT $xxx,clo_id from size  where clo_Id='$clo_id'");
    if (!empty($result) && $result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            return $row[$xxx];
        }
    }
}
function perimg($cus_id)
{
    include("connection.php");

    $result = $con->query("SELECT per_img from customers  where cus_Id='$cus_id'");
    if (!empty($result) && $result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            return $row["per_img"];
        }
    }
}


function insertintocloset($type, $price, $gender, $instock, $productdesc, $productname, $color)
{
    include("connection.php");
    $con->query("INSERT INTO closet (type,price,gender,instock,productdesc,productname,color) VALUES ('$type','$price','$gender','$instock','$productdesc','$productname','$color')");
    return sizeid();
}



function cartnoti($cus_id)
{
    include("connection.php");
    $count = 0;
    $result = $con->query("SELECT *  from cart  where cus_id=$cus_id");
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $count++;
        }
        return $count;
    }
}
function retriimgid($clo_id)
{
    include("connection.php");
    $arr = array();
    $result = $con->query("SELECT *  from closet_img  where clo_id=$clo_id order by img_id desc");
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row["img_id"]);
        }
    }
    return $arr;
}






function retrimulimg($clo_id)
{
    include("connection.php");
    $arr = retriimgid($clo_id);
    $num = $arr[0];
    $result = $con->query("SELECT *  from closet_img  where clo_id=$clo_id and img_id=$num");
    if (!empty($result) && $result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            return $row["img"];
        }
    }
}

function retrimulimg2($clo_id)
{
    include("connection.php");
    $arr = retriimgid($clo_id);
    $num = $arr[1];
    $result = $con->query("SELECT *  from closet_img  where clo_id=$clo_id and img_id=$num");
    if (!empty($result) && $result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            return $row["img"];
        }
    }
}

function deleimg($clo_id)
{
    include("connection.php");
    $con->query("DELETE FROM  closet_img where  clo_id=$clo_id");
}
function retriimg($clo_id)
{
    include("connection.php");

    $result = $con->query("SELECT *  from closet_img  where clo_id=$clo_id order by img_id ");
    if (!empty($result) && $result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            return $row["img"];
        }
    }
}
function insertorder($clo_id, $cus_id, $quantity, $size, $orderprice, $color)
{
    include("connection.php");
    $con->query("INSERT INTO orderhistory (clo_id,cus_id,quantity,size,orderprice,or_color,admindec) values ('$clo_id','$cus_id','$quantity','$size','$orderprice','$color','Pending')");
}
function movtoorder($user_id)
{
    include("connection.php");

    $result = $con->query("SELECT *  from cart  where cus_id=$user_id");
    if (!empty($result) && $result->num_rows > 0) {
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            insertorder($row["clo_id"], $row["cus_id"], $row["quantity"], $row["size"], $row["orderprice"], $row["cart_color"]);
            $count++;
        }
    }
    echo $count;
}


function deletcartcartid($cart_id)
{
    include("connection.php");
    $con->query("DELETE from cart where cart_id='$cart_id'");
}
function deletcart($user_id)
{
    include("connection.php");
    $con->query("DELETE from cart where cus_id='$user_id'");
}
function emailout($user_id)
{
    include("connection.php");

    $result = $con->query("SELECT *  from customers  where cus_id=$user_id");
    if (!empty($result) && $result->num_rows > 0) {
        $count = 0;
        if ($row = $result->fetch_assoc()) {
            return $row["email"];
        }
    }
}
function usernameout($user_id)
{
    include("connection.php");

    $result = $con->query("SELECT *  from customers  where cus_id=$user_id");
    if (!empty($result) && $result->num_rows > 0) {
        $count = 0;
        if ($row = $result->fetch_assoc()) {
            return $row["user_name"];
        }
    }
}
function sizeout($size, $clo_id)
{
    include("connection.php");

    $result = $con->query("SELECT $size  from size  where clo_id=$clo_id");
    if (!empty($result) && $result->num_rows > 0) {

        if ($row = $result->fetch_assoc()) {
            return $row[$size];
        }
    }
}
function profileout($content, $cus_id)
{
    include("connection.php");

    $result = $con->query("SELECT $content  from customers  where cus_id=$cus_id");
    if (!empty($result) && $result->num_rows > 0) {

        if ($row = $result->fetch_assoc()) {
            return $row[$content];
        }
    }
}

function deletecloset($clo_Id)
{
    include("connection.php");
    $con->query("DELETE FROM closet where clo_id='$clo_Id'");
}

function deletesize($clo_Id)
{
    include("connection.php");
    $con->query("DELETE FROM size where clo_id='$clo_Id'");
}

function updatecart($quantity, $size, $orderprice, $color, $cart_id)
{
    include("connection.php");
    $con->query("UPDATE cart set quantity='$quantity' , size='$size' ,orderprice='$orderprice', cart_color='$color' where cart_id='$cart_id'");
}
function subtotal($or_date, $cus_id)
{
    $subtotal = 0;
    include("connection.php");

    $result = $con->query("SELECT * FROM orderhistory JOIN closet ON closet.clo_id=orderhistory.clo_id JOIN customers ON customers.cus_id=orderhistory.cus_id where admindec='Accept' and orderhistory.or_date='$or_date' and orderhistory.cus_id='$cus_id' ");
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $subtotal += $row["orderprice"];
        }
    }
    return $subtotal;
}
function subtotal2($or_date, $cus_id)
{
    $subtotal = 0;
    include("connection.php");

    $result = $con->query("SELECT * FROM orderhistory JOIN closet ON closet.clo_id=orderhistory.clo_id JOIN customers ON customers.cus_id=orderhistory.cus_id where admindec='Pending' and orderhistory.or_date='$or_date' and orderhistory.cus_id='$cus_id' ");
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $subtotal += $row["orderprice"];
        }
    }
    return $subtotal;
}
function subtotal3($or_date, $cus_id)
{
    $subtotal = 0;
    include("connection.php");

    $result = $con->query("SELECT * FROM orderhistory JOIN closet ON closet.clo_id=orderhistory.clo_id JOIN customers ON customers.cus_id=orderhistory.cus_id where  orderhistory.or_date='$or_date' and orderhistory.cus_id='$cus_id' ");
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $subtotal += $row["orderprice"];
        }
    }
    return $subtotal;
}
function admindec($or_date, $cus_id)
{

    include("connection.php");

    $result = $con->query("SELECT * FROM orderhistory JOIN closet ON closet.clo_id=orderhistory.clo_id JOIN customers ON customers.cus_id=orderhistory.cus_id where  orderhistory.or_date='$or_date' and orderhistory.cus_id='$cus_id' ");
    if (!empty($result) && $result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            return $row["admindec"];
        }
    }
}
function layout($or_date, $cus_id)
{

    include("connection.php");
    $layout = 0;
    $result = $con->query("SELECT * FROM orderhistory JOIN closet ON closet.clo_id=orderhistory.clo_id JOIN customers ON customers.cus_id=orderhistory.cus_id where  orderhistory.or_date='$or_date' and orderhistory.cus_id='$cus_id' ");
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $layout++;
        }
    }
    return $layout;
}

function personaldetail($content, $cus_id)
{
    include("connection.php");
    $result = $con->query("SELECT $content FROM customers WHERE cus_id='$cus_id'");
    if (!empty($result) && $result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            return $row[$content];
        }
    }
}


function select()
{;
    include("../function/connection.php");
    $arr = array();
    $cus_id = $_SESSION["user_id"];
    $result = $con->query("SELECT * FROM orderhistory JOIN closet ON closet.clo_id=orderhistory.clo_id JOIN customers ON customers.cus_id=orderhistory.cus_id where   orderhistory.cus_id='$cus_id' group by orderhistory.or_date order by orderhistory.or_date desc");
    if (!empty($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row["or_date"]);
        }
    }
    return $arr;
}



//role check 

function checkrole($email)
{
    include("../function/connection.php");

    $result = $con->query("SELECT * FROM customers WHERE email='$email' ");
    if (!empty($result) && $result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
           
                return $row['role'];
            
        }
    }
}
